<?php

//가상계좌
class Mobilians_bk extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		define("SEEDEXE", "/opt/mcash/seed/libCipher");
	}	
	

	//가상계좌 임시팝업
	function payment_pop(){

		user_check();

		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);		//회원데이터 가져오기
			
		$code = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));		//상품코드
		
		$product_rtn = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//코드값으로 상품내역 가져오기
		
		$v_goods = $product_rtn['m_goods'];		//상품이름
		$v_price = $product_rtn['m_price'];		//상품가격
		$v_point = $product_rtn['m_point'];		//포인트
		$v_payment_gb = "BK";					//결재방식
		
		$v_day = date('Ymd');		//입금 마감일자 및 계좌 만기일을 위한 오늘날짜 생성

		$va_rcplimit_date = date('Ymd', strtotime($v_day."+3day"));		//입금마감 날짜		(오늘날짜 +3일)
		$va_acclimit_date = date('Ymd', strtotime($v_day."+10day"));	//계좌만료 날짜		(입금마감 +7일)
	
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$tid = 'joyhunting_'.date('YmdHis')."_".$str_rand;			//거래번호만들기

		/*****************************************************************************************
		- 필수 입력 항목
		*****************************************************************************************/
		$CASH_GB	= "VA";		//[   2byte 고정] 결제수단구분. "VA" 고정값. 수정불가!
		$VA_SVCID	= "020307010035";		//[  12byte 고정] 모빌리언스에서 부여한 서비스ID (12byte 숫자 형식)
		$Prdtprice	= $v_price;		//[  10byte 이하] 결제요청금액 (암호화 사용 시 암호화 대상)
		$PAY_MODE	= "10";		//[   2byte 고정] 연동시 테스트/실결제 구분 (00: 테스트결제-비과금, 10: 실거래결제-과금)
		$Okurl		= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_bk/okurl";		//[ 128byte 이하] 결제 완료 후 사용자에게 보여질 가맹점측 완료 페이지. (예: http://www.mcash.co.kr/okurl.jsp)
		$Prdtnm		= $v_goods;		//[  30byte 이하] 상품명
		$Siteurl	= $_SERVER['HTTP_HOST'];		//[  20byte 이하] 가맹점도메인 (예: www.mcash.co.kr)

		$Tradeid	= "BK_".$tid;	//[4byte 이상, 40byte 이하] 가맹점거래번호. 결제 요청 시 마다 unique한 값을 세팅해야 함.
													//해당 샘플에는 테스트를 위해 {가맹점 서비스ID + 요청일시} 형식으로 세팅하였음.

		$VA_Rcptlimitdt	= $va_rcplimit_date;		//[   8byte 고정] 입금 마감 일자 ex) 20140425 보통 현재날짜에서 3일 후 (max : 거래일 + 7일)
		$VA_Acctlimitdt	= $va_acclimit_date;		//[   8byte 고정] 계좌 만기일 - 입금마감일 + 7일 
		

		/*****************************************************************************************
		- 디자인 관련 필수항목
		*****************************************************************************************/
		$LOGO_YN	= "N";		//[   1byte 고정] 가맹점 로고 사용 여부 (N: 모빌리언스 로고-default, Y: 가맹점 로고 (사전에 모빌리언스에 가맹점 로고 이미지를 등록해야함))
		$CALL_TYPE	= "SELF";		//[   4byte 이하] 결제창 호출 방식 (P: 팝업-default, SELF: 페이지전환, I: 아이프레임)


		/*****************************************************************************************
		- 선택 입력 항목
		*****************************************************************************************/
		$Payeremail			= $member_data['m_mail'];	//[  30byte 이하] 결제자 e-mail
		$Userid				= $member_data['m_userid'];	//[  20byte 이하] 가맹점 결제자ID
		$Username			= "";	//[  30byte 이하] 결제자 이름
		$Notiemail			= "webmaster@joyhunting.com";	//[  30byte 이하] 알림 e-mail: 결제 완료 후 당사와 가맹점간의 Noti 연동이 실패한 경우 알람 메일을 받을 가맹점 담당자 이메일주소
		$Notiurl			= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_bk/notiurl";	//[ 128byte 이하] 결제 완료 후 가맹점 측 결제 처리를 담당하는 페이지. System back단으로 호출이 되며 사용자에게는 보여지지 않는다.
		$Closeurl			= "";	//[ 128byte 이하] 결제창 취소버튼, 닫기버튼 클릭 시 호출되는 가맹점 측 페이지. iframe 호출 시 필수! (예: http://www.mcash.co.kr/closeurl.jsp)
		$Failurl			= "";	//[ 128byte 이하] 결제 실패 시 사용자에게 보여질 가맹점 측 실패 페이지. 결제처리에 대한 실패처리 안내를 가맹점에서 제어해야 할 경우만 사용.
									//                iframe 호출 시 필수! (예: http://www.mcash.co.kr/failurl.jsp)
		$MSTR				= "code=$code|pay_gb=$v_payment_gb";	//[2000byte 이하] 가맹점 콜백 변수. 가맹점에서 추가적으로 파라미터가 필요한 경우 사용하며 &, % 는 사용불가 (예: MSTR="a=1|b=2|c=3")

		/*****************************************************************************************
		- 디자인 관련 선택항목 (향후 변경될 수 있습니다.)
		*****************************************************************************************/
		$IFRAME_NAME		= "";	//[   1byte 고정] 결제창을 iframe으로 호출 할 경우 iframe 명칭 세팅
		$INFOAREA_YN		= "Y";	//[   1byte 고정] 결제창 안내문 표시여부 (Y: 표시-default,  N: 미표시)
		$FOOTER_YN			= "Y";	//[   1byte 고정] 결제창 하단 안내 표시여부 (Y: 표시-default,  N: 미표시)
		$HEIGHT				= "";	//[   4byte 이하] 결제창 높이 (px단위: iframe 등 사용시 결제창 높이 조절, 팝업창 등 호출시 "" 로 세팅)
		$PRDT_HIDDEN		= "";	//[   1byte 고정] iframe 사용시 상품명 숨김 여부 (가맹점 디자인 결제창으로 결제 입력 사항만 iframe에서 사용시)
		$CONTRACT_HIDDEN	= "Y";	//[   1byte 고정] 이용약관 숨김 여부 (Y: 표시-default,  N: 미표시)



		/*****************************************************************************************
		- 암호화 처리 (암호화 사용 시)
		Cryptstring 항목은 금액변조에 대한 확인용으로 반드시 아래와 같이 문자열을 생성하여야 합니다.

		주) 암호화 스트링은 가맹점에서 전달하는 거래번호로 부터 추출되어 사용되므로
		암호화에 이용한 거래번호가  변조되어 전달될 경우 복호화 실패로 결제 진행 불가
		*****************************************************************************************/
		$Cryptyn		= "Y";		//Y: 암호화 사용, N: 암호화 미사용
		$Cryptstring	= "";		//암호화 사용 시 암호화된 스트링

		if($Cryptyn == "Y") {
			$Cryptstring	= $Prdtprice.$Okurl;	//금액변조확인 (결제요청금액 + Okurl)
			$Okurl			= $this->cipher($Okurl, $Tradeid);
			$Failurl		= $this->cipher($Failurl, $Tradeid);
			$Notiurl		= $this->cipher($Notiurl, $Tradeid);
			$Prdtprice		= $this->cipher($Prdtprice, $Tradeid);
			$Cryptstring	= $this->cipher($Cryptstring, $Tradeid);
		}

		//결제 전 temp 데이터 insert
		$temp_arrData = array(

			"m_userid"			=> $Userid,
			"m_product_code"	=> $code,
			"m_goods"			=> $v_goods,
			"m_price"			=> $v_price,
			"m_point"			=> $v_point,
			"m_cash_gb"			=> $CASH_GB,
			"m_commid"			=> '',
			"m_mobilid"			=> '',
			"m_mrchid"			=> '',
			"m_mstr"			=> $MSTR,
			"m_hp"				=> '',
			"m_payeremail"		=> '',
			"m_card_ok"			=> 'N',
			"m_tradeid"			=> $Tradeid,
			"m_signdate"		=> '',
			"m_payment_gb"		=> $v_payment_gb,
			"m_result_code"		=> '',
			"m_writedate"		=> NOW,
			"m_pay_gubn"		=> 'P'

		);

		$temp_rtn = $this->my_m->insert('payment_temp', $temp_arrData);		//결제시도 확인을 위한 temp 데이터 삽입
		
		if($temp_rtn <> "1"){
			alert_close('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.');
		}

		//결제관련 필요한 데이터 넘기기
		$data['payform'] = array(
	
			"CASH_GB"				=> @$CASH_GB,
			"Okurl"					=> @$Okurl,
			"VA_SVCID"				=> @$VA_SVCID,
			"Prdtnm"				=> $Prdtnm,
			"Prdtprice"				=> @$Prdtprice,
			"Siteurl"				=> @$Siteurl,
			"PAY_MODE"				=> @$PAY_MODE,
			"Tradeid"				=> @$Tradeid,
			"LOGO_YN"				=> @$LOGO_YN,
			"CALL_TYPE"				=> @$CALL_TYPE,
			"Notiurl"				=> @$Notiurl,
			"Closeurl"				=> @$Closeurl,
			"Failurl"				=> @$Failurl,
			"Userid"				=> @$Userid,
			"Item"					=> @$Item,
			"Prdtcd"				=> @$Prdtcd,
			"Payeremail"			=> @$Payeremail,
			"MSTR"					=> @$MSTR,
			"Notiemail"				=> @$Notiemail,
			"IFRAME_NAME"			=> @$IFRAME_NAME,
			"INFOAREA_YN"			=> @$INFOAREA_YN,
			"FOOTER_YN"				=> @$FOOTER_YN,
			"HEIGHT"				=> @$HEIGHT,
			"PRDT_HIDDEN"			=> @$PRDT_HIDDEN,
			"CONTRACT_HIDDEN"		=> @$CONTRACT_HIDDEN,
			"Cryptyn"				=> @$Cryptyn,
			"Cryptstring"			=> @$Cryptstring,
			"VA_Rcptlimitdt"		=> @$VA_Rcptlimitdt,
			"VA_Acctlimitdt"		=> @$VA_Acctlimitdt,
			"Username"				=> @$Username

		);

		//view 설정
		$top_data['add_js'] = array("/etc/mobilians_pay_js");

		$bot_data['add_script'] = "
		<script src='https://mup.mobilians.co.kr/js/ext/ext_inc_comm.js'></script>
		<script type='text/javascript'>
			$(document).ready(function(){
				payRequest();
			});
		</script>
		";

		$this->load->view('top0_v', $top_data);
		$this->load->view('/etc/mobilians_form_v', $data);		
		$this->load->view('bottom0_v', $bot_data);


	}

	//notiurl
	function notiurl(){

		$Resultcd		= $this->security->xss_clean($_REQUEST['Resultcd']);			//[   4byte 고정] 결과코드
		$Mobilid		= $this->security->xss_clean($_REQUEST['Mobilid']);			//[  15byte 이하] 모빌리언스 거래번호
		$Mrchid			= $this->security->xss_clean($_REQUEST['Mrchid']);			//[   8byte 고정] 상점ID
		$Prdtnm			= $this->security->xss_clean($_REQUEST['Prdtnm']);			//[  30byte 이하] 상품명
		$Prdtprice		= $this->security->xss_clean($_REQUEST['Prdtprice']);			//[  10byte 이하] 상품가격
		$Svcid			= $this->security->xss_clean($_REQUEST['Svcid']);				//[  12byte 고정] 서비스ID
		$Tradeid		= $this->security->xss_clean($_REQUEST['Tradeid']);			//[  40byte 이하] 상점거래번호
		$Userid			= $this->security->xss_clean($_REQUEST['Userid']);			//[  20byte 이하] 사용자ID
		$Bankcode		= $this->security->xss_clean($_REQUEST['Bankcode']);			//[   3byte 이하] 은행코드
		$Accountno		= $this->security->xss_clean($_REQUEST['Accountno']);			//[  30byte 이하] 가상계좌번호
		$Rcptresultdt	= $this->security->xss_clean($_REQUEST['Rcptresultdt']);		//[  14byte 이하] 결제완료(계좌이체) 일자 
		$Rcptname		= $this->security->xss_clean($_REQUEST['Rcptname']);			//[  64byte 이하] 결제자명(계좌이체자명)
		$Name			= $this->security->xss_clean($_REQUEST['Name']);			//[  30byte 이하] 결제자명(Okurl의 가맹점 결제자명 Username과 동일)

	
		/******************************************************
		* 결제가 정상적으로 완료되었을 경우(Resultcd=0000) 진행
		******************************************************/
		if($Resultcd  == "0000") {
			/*******************************************
			* 여기에서 가맹점 측 결제 처리를 진행한다.
			*******************************************/

			$temp_arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $Tradeid, 'm_cash_gb' => 'VA', 'm_payment_gb' => 'BK', 'm_card_ok' => 'N'));		//temp data 가져오기
			
			//temp 데이터가 없을경우 처리
			if(!@$temp_arrData['m_userid']){
				echo "SUCCESS"; exit;
			}
			
			//결제완료 처리전 결제금액검사
			if($temp_arrData['m_price'] <> $Prdtprice){
				//결제금액이 DB데이터와 일치하지 않을경우 
				alert_close('상품금액과 결제금액이 일치하지 않습니다. 관리자에게 문의 바랍니다.');				
			}else{
				//결제금액이 DB데이터와 일치할경우 결제완료처리 진행
				//결제완료후 필요한 데이터
				$payment_arrData = array(

					"m_commid"			=> $Bankcode,			//은행코드
					"m_mobilid"			=> $Mobilid,
					"m_mrchid"			=> $Mrchid,
					"m_hp"				=> $Accountno,			//가상계좌번호
					//"m_payeremail"		=> $Payeremail,
					"m_card_ok"			=> 'Y',
					"m_signdate"		=> $Rcptresultdt,
					"m_result_code"		=> $Resultcd,
					"m_okdate"			=> NOW					//결제완료시간
	 
				);
				
				//결제완료 후 결제완료데이터 업데이트
				$payment_update = $this->my_m->update('payment_temp', array('m_userid' => $temp_arrData['m_userid'], 'm_tradeid' => $Tradeid), $payment_arrData);		
				
				if($payment_update <> "1"){
					alert_close('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.');
				}else{
					
					//결제완료 또는 포인트 사용처리 helper
					//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
					$rtn = member_point_insert($temp_arrData['m_userid'], $temp_arrData['m_product_code'], $temp_arrData['m_goods'], $temp_arrData['m_point'], $temp_arrData['m_price'], $Tradeid, NOW, null);
					
					//첫 결제시 일반회원의 경우 정회원 등업
					$rtn2 = member_level_up($temp_arrData['m_userid'], $temp_arrData['m_tradeid']);

					if($rtn == "1"){
						//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
						$m_data = $this->member_lib->get_member($temp_arrData['m_userid']);
						if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
							partner_send_curl('PAY', $m_data['m_userid'], $Tradeid);
						}
						echo "SUCCESS";
					}else{
						echo "FAIL";
					}
				}

			}

			

		}else{
			
			//noti에서 실패했을경우 에러코드 업데이트
			$fail_data = $this->my_m->update('payment_temp', array('m_userid' => $temp_arrData['m_userid'], 'm_tradeid' => $Tradeid), array('m_result_code' => $Resultcd));

			echo "FAIL";

		}

	}

	//okurl(결과처리페이지)
	function okurl(){

		user_check();		//로그인 여부 체크

		$Resultcd		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Resultcd']));			//[   4byte 고정] 결과코드
		$Resultmsg		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Resultmsg']));			//[ 100byte 이하] 결과메세지

		$CASH_GB		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['CASH_GB']));			//[   2byte 고정] 결제수단(RA)
		$Mobilid		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Mobilid']));			//[  15byte 이하] 모빌리언스 거래번호
		$Mrchid			= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Mrchid']));			//[   8byte 고정] 상점ID
		$MSTR			= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['MSTR']));				//[2000byte 이하] 가맹점 전달 콜백변수
		$Payeremail		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Payeremail']));		//[  30byte 이하] 결제자 이메일
		$Prdtnm			= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Prdtnm']));			//[  30byte 이하] 상품명
		$Prdtprice		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Prdtprice']));			//[  10byte 이하] 상품가격
		$Svcid			= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Svcid']));				//[  12byte 고정] 서비스ID
		$Tradeid		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Tradeid']));			//[  40byte 이하] 상점거래번호
		$Userid			= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Userid']));			//[  20byte 이하] 사용자ID
		$Username		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Username']));			//[  30byte 이하] 결제자 이름
		$Bankcode		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Bankcode']));			//[   3byte 이하] 은행코드
		$Accountno		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Accountno']));			//[  30byte 이하] 가상계좌번호
		

		//가상계좌일때만 파라미터에 은행코드와 계좌번호 연결
		$MSTR = $MSTR."|bk_code=".$Bankcode."|account_no=".$Accountno;
	
		//결제 이메일 업데이트(notiurl로 이메일 변수 넘어오지 않아서 여기서함)
		$email_update = $this->my_m->update('payment_temp', array('m_tradeid' => $Tradeid), array('m_payeremail' => $Payeremail, 'm_mstr' => $MSTR));

		if($Resultcd == "0000"){
			//결제 성공일경우
			@$this->session->set_userdata(array(
				'm_type' => 'V'
			));

			//문자메시지로 결제은행과 계좌번호 발송 이벤트(휴대전화 인증을 받은 회원만 발송)

			$mem_data = $this->member_lib->get_member($this->session->userdata['m_userid']);		//회원정보 가져오기
			
			//휴대전화 인증을 받은 회원만 문자메시지 발송
			if($mem_data['m_mobile_chk'] == "1"){				

				$hptele = $mem_data['m_hp1'].$mem_data['m_hp2'].$mem_data['m_hp3'];

				$sms_rtn = $this->sms_lib->sms_send('', array($hptele), "조이헌팅 상품가격 : ".$Prdtprice."원 입금하실 계좌번호는 ".bank_code($Bankcode)." $Accountno 입니다. ");		//문자메시지 발송
			}
			
			//결과 레이어 팝업
			$bot_data['add_script'] = "
			<script>
				$(document).ready(function(){
					result_pop('$MSTR', 'bk');
				});
			</script>
			";
		}else{
			//결제 실패할경우
			alert_close('결제가 실패했습니다.\n다시 시도해 주시기 바랍니다.');
		}

		$this->load->view('top0_v');
		$this->load->view('bottom0_v', @$bot_data);
		

		
	}
	

	//결제 결과 레이어팝업
	function pay_result(){

		user_check();		//로그인 여부 체크
	
		$code	       = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));					//상품코드
		$pay_gb		   = $this->security->xss_clean(@url_explode($this->seg_exp, 'pay_gb'));				//결제방법
		$bk_code	   = $this->security->xss_clean(@url_explode($this->seg_exp, 'bk_code'));				//은행코드
		$account_no    = $this->security->xss_clean(@url_explode($this->seg_exp, 'account_no'));			//가상계좌
	
		$data['v_goods']  = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//구매상품상세내역
		$data['pay_mode'] = $pay_gb;

		$data['result_text'] = "<font style='font-size:0.9em; font-weight:bold;'>".bank_code($bk_code)." : ".$account_no."</font>";	//레이어팝업 결과
		
		//가상계좌의 경우 계좌번호 안내 추가 스크립트
		$data['add_script'] = "
		<script type='text/javascript'>
			$(document).ready(function(){
				$('#pay_table').append('<tr><td>계좌번호</td><td><b>".bank_code($bk_code)." : $account_no</b></td></tr>');
				$('#pay_table').append('<tr><td>기간</td><td>3일내로 입금하셔야 합니다.</td></tr>');
			});
		</script>
		";

		$top_data['add_css']    = array("layer_popup/group_popup_css");
		$top_data['add_js']     = array("layer_popup/group_popup_js");
		$top_data['add_title']  = "포인트충전";
		$top_data['add_text']   = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/payment_result_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	/*****************************************************************
	함수명 : cipher 암호화 실행
	사용법 : cipher ("암호화할데이터", "가맹점거래번호")
	주의사항 : 절대수정금지
	*****************************************************************/

	function cipher($seedStr, $seedKey) {
		if($seedStr == "") return "";
		return exec(SEEDEXE." E ".escapeshellarg($this->getKey($seedKey))." ".escapeshellarg($seedStr)." ");
	}

	function getKey($value) {
		$result = "";
		$padding = "123456789123456789";
		$tmpKey = $value;
		$keyLength = strlen($value);
		if($keyLength < 16) $tmpKey = $tmpKey.substr($padding, 0, 16-$keyLength);
		else $tmpKey = substr($tmpKey, strlen($tmpKey)-16,  strlen($tmpKey));
		for($i = 0; $i < 16; $i++) {
			$result = $result.chr(ord(substr($tmpKey, $i, 1))^($i+1));
		}
		return $result;
	}

	/*****************************************************************
	함수명 : appr_dtm 결제 요청일시 구하기
	*****************************************************************/
	function appr_dtm() {
		$microtime = microtime();
		$comps = explode(" ", $microtime);
		return date("YmdHis") . sprintf("%04d", $comps[0] * 10000);
	}

}
