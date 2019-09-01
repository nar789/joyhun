<?php

//휴대폰결제 

class Mobilians_hp extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->helper('mobilians_helper');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');

		define("SEEDEXE", "/opt/mcash/seed/libCipher");
	}
	

	//휴대폰결제 임시팝업
	function payment_pop(){
		
		if(IS_MOBILE == true){
			//모바일버전의 경우

			user_check();
			$v_Okurl		= "http://m.joyhunting.com/etc/mobilians_hp/okurl";
			$v_Siteurl		= "m.joyhunting.com";
			$v_Notiurl		= "http://m.joyhunting.com/etc/mobilians_hp/notiurl";
			$v_close_url    = "http://m.joyhunting.com";

			if(IS_APP == true){
				//app인경우
				$m_pay_gubn		= "A";
			}else{
				$m_pay_gubn		= "M";
			}			

		}else{
			//PC버전의 경우

			user_check();
			$v_Okurl		= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_hp/okurl";
			$v_Siteurl		= $_SERVER['HTTP_HOST'];
			$v_Notiurl		= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_hp/notiurl";
			$v_close_url	= "";
			$m_pay_gubn		= "P";

		}		

		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);		//회원데이터 가져오기
				
		$code = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));		//상품코드
		
		$product_rtn = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//코드값으로 상품내역 가져오기
		
		$v_goods = $product_rtn['m_goods'];		//상품이름
		$v_price = $product_rtn['m_price'];		//상품가격
		$v_point = $product_rtn['m_point'];		//포인트
		$v_payment_gb = "HP";					//결재방식
		
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$tid = 'joyhunting_'.date('YmdHis')."_".$str_rand;			//거래번호만들기

		/*****************************************************************************************
		- 필수 입력 항목
		*****************************************************************************************/
		$CASH_GB	= "MC";		//[   2byte 고정] 결제수단구분. "MC" 고정값. 수정불가!
		$MC_SVCID	= "121009930001";		//[  12byte 고정] 모빌리언스에서 부여한 서비스ID (12byte 숫자 형식)
		$Prdtprice	= $v_price;		//[  10byte 이하] 결제요청금액 (암호화 사용 시 암호화 대상)
		$PAY_MODE	= "10";		//[   2byte 고정] 연동시 테스트/실결제 구분 (00: 테스트결제-비과금, 10: 실거래결제-과금)
		$Okurl		= $v_Okurl;		//[ 128byte 이하] 결제 완료 후 사용자에게 보여질 가맹점측 완료 페이지. (예: http://www.mcash.co.kr/okurl.jsp)
		$Prdtnm		= $v_goods;		//[  50byte 이하] 상품명
		$Siteurl	= $v_Siteurl;		//[  20byte 이하] 가맹점도메인 (예: www.mcash.co.kr)

		$Tradeid	= "MC_".$tid;	//[4byte 이상, 40byte 이하] 가맹점거래번호. 결제 요청 시 마다 unique한 값을 세팅해야 함.
														//해당 샘플에는 테스트를 위해 {가맹점 서비스ID + 요청일시} 형식으로 세팅하였음.

		/*****************************************************************************************
		- 디자인 관련 필수항목
		*****************************************************************************************/
		$LOGO_YN	= "N";		//[   1byte 고정] 가맹점 로고 사용 여부 (N: 모빌리언스 로고-default, Y: 가맹점 로고 (사전에 모빌리언스에 가맹점 로고 이미지를 등록해야함))
		$CALL_TYPE	= "SELF";	//[   4byte 이하] 결제창 호출 방식 (P: 팝업-default, SELF: 페이지전환, I: 아이프레임)

		/*****************************************************************************************
		- 선택 입력 항목
		*****************************************************************************************/
		$MC_AUTHPAY			= "N";	//[   1byte 고정] 하이브리드 방식 사용시  "Y" 로 설정 (휴대폰 SMS인증 후 일반 소켓모듈 결제 연동시 사용) (N: 미사용-default, Y: 사용)
		$MC_AUTOPAY			= "N";	//[   1byte 고정] 자동결제를 위한 최초 일반결제 시 "Y" 세팅. 결제 완료 후 휴대폰정보 대체용 USERKEY 발급 및 자동결제용 AutoBillKey 발급 (N: 미사용-default, Y: 사용)
		$MC_PARTPAY			= "N";	//[   1byte 고정] 부분취소를 위한 일반결제 시 "Y" 세팅. 결제 완료 후 자동결제 USERKEY 발급 (N: 미사용-default, Y: 사용)
		$MC_No				= "";	//[  11byte 이하] 사용자 폰번호 (결제창 호출시 세팅할 폰번호)
		$MC_FIXNO			= "N";	//[   1byte 고정] 사용자 폰번호 수정불가 여부(N: 수정가능-default, Y: 수정불가)
		$MC_DEFAULTCOMMID	= "";	//[   3byte 고정] 통신사 기본 선택 값. SKT, KTF, LGT 3개의 값 중 원하는 통신사 세팅 시 해당 통신사가 미리 선택되어짐.
		$MC_FIXCOMMID		= "";	//[   1byte 고정] 통신사 고정 선택 값. SKT, KTF, LGT 3개의 값 중 원하는 통신사 세팅 시 해당 통신사만 결제창에 보여짐.
		$Payeremail			= $member_data['m_mail'];	//[  30byte 이하] 결제자 e-mail
		$Userid				= $member_data['m_userid'];	//[  20byte 이하] 가맹점 결제자ID
		$Item				= "";	//[   8byte 이하] 아이템코드. 미사용 시 반드시 공백으로 세팅.
		$Prdtcd				= $product_rtn['m_product_code'];	//[  40byte 이하] 상품코드. 자동결제인 경우 상품코드별 SMS문구를 별도 세팅할 때 사용하며 사전에 모빌리언스에 등록이 필요함.
		$MC_Cpcode			= "";	//[  20byte 이하] 리셀러하위상점key. 리셀러 업체인 경우에만 세팅.
		$Notiemail			= "webmaster@humanfirst.co.kr";	//[  30byte 이하] 알림 e-mail: 결제 완료 후 당사와 가맹점간의 Noti 연동이 실패한 경우 알람 메일을 받을 가맹점 담당자 이메일주소
		$Notiurl			= $v_Notiurl;	//[ 128byte 이하] 결제 완료 후 가맹점 측 결제 처리를 담당하는 페이지. System back단으로 호출이 되며 사용자에게는 보여지지 않는다.
		$Closeurl			= $v_close_url;	//[ 128byte 이하] 결제창 취소버튼, 닫기버튼 클릭 시 호출되는 가맹점 측 페이지. iframe 호출 시 필수! (예: http://www.mcash.co.kr/closeurl.jsp)
		$Failurl			= "";	//[ 128byte 이하] 결제 실패 시 사용자에게 보여질 가맹점 측 실패 페이지. 결제처리에 대한 실패처리 안내를 가맹점에서 제어해야 할 경우만 사용.
									//                iframe 호출 시 필수! (예: http://www.mcash.co.kr/failurl.jsp)
		$MSTR				= "code=$code|pay_gb=$v_payment_gb";	//[2000byte 이하] 가맹점 콜백 변수. 가맹점에서 추가적으로 파라미터가 필요한 경우 사용하며 &, % 는 사용불가 (예: MSTR="a=1|b=2|c=3")
		$MC_EZ_YN		= "N";	//[   1byte 고정] 간소화결제여부. 간소화결제 사용시  "Y" 로 설정 (N: 미사용-default, Y: 사용)
		$MC_EZ_KEY		= "";	//[   20byte 고정] 간소화결제 사용자키

		/*****************************************************************************************
		- 오픈마켓의 경우 아래의 정보를 입력해야 합니다.
		장바구니 결제의 경우 대표 판매자 외 n명, 대표 판매자 연락처를 입력하세요.
		예)	Sellernm  = "홍길동외 2명";
			Sellertel = "0212345678";
		*****************************************************************************************/
		$Sellernm			= "";	//[  50byte 이하] 실판매자 이름 (오픈마켓의 경우 실 판매자 정보 필수)
		$Sellertel			= "";	//[  15byte 이하] 실판매자 전화번호 (오픈마켓의 경우 실 판매자 정보 필수)

		/*****************************************************************************************
		- 디자인 관련 선택항목 (향후 변경될 수 있습니다.)
		*****************************************************************************************/
		$IFRAME_NAME		= "";	//[   1byte 고정] 결제창을 iframe으로 호출 할 경우 iframe 명칭 세팅
		$INFOAREA_YN		= "Y";	//[   1byte 고정] 결제창 안내문 표시여부 (Y: 표시-default,  N: 미표시)
		$FOOTER_YN			= "Y";	//[   1byte 고정] 결제창 하단 안내 표시여부 (Y: 표시-default,  N: 미표시)
		$HEIGHT				= "";	//[   4byte 이하] 결제창 높이 (px단위: iframe 등 사용시 결제창 높이 조절, 팝업창 등 호출시 "" 로 세팅)
		$PRDT_HIDDEN		= "";	//[   1byte 고정] iframe 사용시 상품명 숨김 여부 (가맹점 디자인 결제창으로 결제 입력 사항만 iframe에서 사용시)
		$EMAIL_HIDDEN		= "N";	//[   1byte 고정] 결제자 e-mail 입력창 숨김 여부 (N: 표시-default, Y: 미표시)
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

			"m_userid"			=> $this->session->userdata['m_userid'],
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
			"m_pay_gubn"		=> $m_pay_gubn

		);

		$temp_rtn = $this->my_m->insert('payment_temp', $temp_arrData);		//결제시도 확인을 위한 temp 데이터 삽입
		
		if($temp_rtn <> "1"){
			alert_close('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.');
		}
	
		//결제관련 필요한 데이터 넘기기
		$data['payform'] = array(

			"CASH_GB"				=> @$CASH_GB,
			"Okurl"					=> @$Okurl,
			"MC_SVCID"				=> @$MC_SVCID,
			"Prdtnm"				=> $Prdtnm,
			"Prdtprice"				=> @$Prdtprice,
			"Siteurl"				=> @$Siteurl,
			"PAY_MODE"				=> @$PAY_MODE,
			"Tradeid"				=> @$Tradeid,
			"LOGO_YN"				=> @$LOGO_YN,
			"CALL_TYPE"				=> @$CALL_TYPE,
			"MC_AUTHPAY"			=> @$MC_AUTHPAY,
			"Notiurl"				=> @$Notiurl,
			"MC_AUTOPAY"			=> @$MC_AUTOPAY,
			"Closeurl"				=> @$Closeurl,
			"MC_PARTPAY"			=> @$MC_PARTPAY,
			"Failurl"				=> @$Failurl,
			"MC_No"					=> @$MC_No,
			"MC_FIXNO"				=> @$MC_FIXNO,
			"MC_Cpcode"				=> @$MC_Cpcode,
			"Userid"				=> @$Userid,
			"Item"					=> @$Item,
			"Prdtcd"				=> @$Prdtcd,
			"Payeremail"			=> @$Payeremail,
			"MC_DEFAULTCOMMID"		=> @$MC_DEFAULTCOMMID,
			"MC_FIXCOMMID"			=> @$MC_FIXCOMMID,
			"MSTR"					=> @$MSTR,
			"Sellernm"				=> @$Sellernm,
			"Sellertel"				=> @$Sellertel,
			"Notiemail"				=> @$Notiemail,
			"IFRAME_NAME"			=> @$IFRAME_NAME,
			"INFOAREA_YN"			=> @$INFOAREA_YN,
			"FOOTER_YN"				=> @$FOOTER_YN,
			"HEIGHT"				=> @$HEIGHT,
			"PRDT_HIDDEN"			=> @$PRDT_HIDDEN,
			"EMAIL_HIDDEN"			=> @$EMAIL_HIDDEN,
			"CONTRACT_HIDDEN"		=> @$CONTRACT_HIDDEN,
			"Cryptyn"				=> @$Cryptyn,
			"Cryptstring"			=> @$Cryptstring,
			"Crypthash"				=> @$Crypthash,
			"MC_EZ_YN"				=> @$MC_EZ_YN,
			"MC_EZ_KEY"				=> @$MC_EZ_KEY

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

		if(IS_MOBILE == true){

			//모바일 버전의 경우
			$this->load->view('m/m_top0_v', $top_data);
			$this->load->view('/etc/mobilians_form_v', $data);
			$this->load->view('m/m_bottom0_v', $bot_data);

		}else{

			//PC버전의 경우 
			$this->load->view('top0_v', $top_data);
			$this->load->view('/etc/mobilians_form_v', $data);		
			$this->load->view('bottom0_v', $bot_data);

		}
		
	}

	//notiurl
	function notiurl(){

		$Resultcd		= $this->input->post('Resultcd',TRUE);				//[   4byte 고정] 결과코드
		$Resultmsg		= $this->input->post('Resultmsg',TRUE);				//[ 100byte 이하] 결과메세지

		$AutoBillKey	= $this->input->post('AutoBillKey',TRUE);			//[  15byte 이하] 자동결제 최초등록키	
		$CASH_GB		= $this->input->post('CASH_GB',TRUE);				//[   2byte 고정] 결제수단(MC)
		$Commid			= $this->input->post('Commid',TRUE);				//[   3byte 고정] 이통사
		$Mobilid		= $this->input->post('Mobilid',TRUE);				//[  15byte 이하] 모빌리언스 거래번호
		$Mrchid			= $this->input->post('Mrchid',TRUE);				//[   8byte 고정] 상점ID
		$MSTR			= $this->input->post('MSTR',TRUE);					//[2000byte 이하] 가맹점 전달 콜백변수
		$No				= $this->input->post('No',TRUE);					//[  11byte 이하] 폰번호
		$Payeremail		= $this->input->post('Payeremail',TRUE);			//[  11byte 이하] 결제자 이메일
		$Prdtnm			= $this->input->post('Prdtnm',TRUE);				//[  50byte 이하] 상품명
		$Prdtprice		= $this->input->post('Prdtprice',TRUE);				//[  10byte 이하] 상품가격
		$Signdate		= $this->input->post('Signdate',TRUE);				//[  14byte 이하] 결제일자
		$Svcid			= $this->input->post('Svcid',TRUE);					//[  12byte 고정] 서비스ID
		$Tradeid		= $this->input->post('Tradeid',TRUE);				//[  40byte 이하] 상점거래번호
		$Userid			= $this->input->post('Userid',TRUE);				//[  20byte 이하] 사용자ID
		$USERKEY		= $this->input->post('USERKEY',TRUE);				//[  15byte 이하] 휴대폰정보(이통사, 휴대폰번호, 주민번호) 대체용 USERKEY
		$MC_EZ_KEY		= $this->input->post('MC_EZ_KEY',TRUE);				//[  20byte 고정] 간소화결제 사용자키
		
		//$Autoyn			= $_POST["Autoyn"];			//[   1byte 고정] 
		
		
		/******************************************************
		* 결제가 정상적으로 완료되었을 경우(Resultcd=0000) 진행
		******************************************************/
		if($Resultcd  == "0000") {
			/*******************************************
			* 여기에서 가맹점 측 결제 처리를 진행한다.
			*******************************************/
			$temp_arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $Tradeid, 'm_cash_gb' => 'MC', 'm_payment_gb' => 'HP', 'm_card_ok' => 'N'));		//temp data 가져오기
			
			//temp 데이터가 없을경우 처리
			if(!@$temp_arrData['m_userid']){
				echo "SUCCESS"; exit;
				//alert_close('잠시후 다시 시도해주시기 바랍니다.');
			}

			//결제완료 처리전 결제금액검사
			if($temp_arrData['m_price'] <> $Prdtprice){
				//결제금액이 DB데이터와 일치하지 않을경우 
				alert_close('상품금액과 결제금액이 일치하지 않습니다. 관리자에게 문의 바랍니다.');
				exit;
			}else{
				//결제금액이 DB데이터와 일치할경우 결제완료처리 진행
				//결제완료후 필요한 데이터
				$payment_arrData = array(

					"m_commid"			=> $Commid,
					"m_mobilid"			=> $Mobilid,
					"m_mrchid"			=> $Mrchid,
					"m_hp"				=> $No,
					"m_payeremail"		=> $Payeremail,
					"m_card_ok"			=> 'Y',
					"m_signdate"		=> $Signdate,
					"m_result_code"		=> $Resultcd,
					"m_okdate"			=> NOW

				);
				
				//결제완료 후 결제완료데이터 업데이트
				$payment_update = $this->my_m->update('payment_temp', array('m_userid' => $temp_arrData['m_userid'], 'm_tradeid' => $Tradeid), $payment_arrData);		
				
				if($payment_update <> "1"){
					alert_close('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.');
					exit;
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

			echo "FAIL";
		}

	}

	//okurl(결과처리페이지)
	function okurl(){

		$Resultcd		= $this->input->post('Resultcd',TRUE);				//[   4byte 고정] 결과코드
		$Resultmsg		= $this->input->post('Resultmsg',TRUE);				//[ 100byte 이하] 결과메세지

		$AutoBillKey	= $this->input->post('AutoBillKey',TRUE);			//[  15byte 이하] 자동결제 최초등록키
		$CASH_GB		= $this->input->post('CASH_GB',TRUE);				//[   2byte 고정] 결제수단(MC)
		$Commid			= $this->input->post('Commid',TRUE);				//[   3byte 고정] 이통사
		$Mobilid		= $this->input->post('Mobilid',TRUE);				//[  15byte 이하] 모빌리언스 거래번호
		$Mrchid			= $this->input->post('Mrchid',TRUE);				//[   8byte 고정] 상점ID
		$MSTR			= $this->input->post('MSTR',TRUE);					//[2000byte 이하] 가맹점 전달 콜백변수
		$No				= $this->input->post('No',TRUE);					//[  11byte 이하] 폰번호
		$Payeremail		= $this->input->post('Payeremail',TRUE);			//[  30byte 이하] 결제자 이메일
		$Prdtnm			= $this->input->post('Prdtnm',TRUE);				//[  50byte 이하] 상품명
		$Prdtprice		= $this->input->post('Prdtprice',TRUE);				//[  10byte 이하] 상품가격
		$Signdate		= $this->input->post('Signdate',TRUE);				//[  14byte 이하] 결제일자
		$Svcid			= $this->input->post('Svcid',TRUE);					//[  12byte 고정] 서비스ID
		$Tradeid		= $this->input->post('Tradeid',TRUE);				//[  40byte 이하] 상점거래번호
		$Userid			= $this->input->post('Userid',TRUE);				//[  20byte 이하] 사용자ID
		$USERKEY		= $this->input->post('USERKEY',TRUE);				//[  15byte 이하] 휴대폰정보(이통사, 휴대폰번호, 주민번호) 대체용 USERKEY
		$MC_EZ_KEY		= $this->input->post('MC_EZ_KEY',TRUE);				//[  20byte 고정] 간소화결제 사용자키
		
		//결재 이메일 업데이트(notiurl로 이메일 변수 넘어오지 않아서 여기서함)
		$email_update = $this->my_m->update('payment_temp', array('m_tradeid' => $Tradeid), array('m_payeremail' => $Payeremail));
		
		if($Resultcd == "0000"){

			@$this->session->set_userdata(array(
				'm_type' => 'V'
			));

			//결제 성공일경우
			$bot_data['add_script'] = "
			<script type='text/javascript'>
				$(document).ready(function(){
					result_pop('$MSTR', 'hp');
				});
			</script>
			";

		}else{
			//결제 실패할경우
			alert_close('결제가 실패했습니다.\n다시 시도해 주시기 바랍니다.');
		}

		if(IS_MOBILE == true){
			//모바일버전의 경우
			$this->load->view('m/m_top0_v');
			$this->load->view('m/m_bottom0_v', @$bot_data);
			
		}else{
			//PC버전의 경우
			$this->load->view('top0_v');
			$this->load->view('bottom0_v', @$bot_data);
			
		}
	
	}


	//결제 결과 레이어팝업
	function pay_result(){

		user_check();		//로그인 여부 체크

		$code	   = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));		//상품코드
		$pay_gb    = $this->security->xss_clean(@url_explode($this->seg_exp, 'pay_gb'));	//결제방법
		
		$data['v_goods']  = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//구매상품내역
		$data['pay_mode'] = $pay_gb;

		$data['result_text'] = "<font style='color:red; font-size:1.0em; font-weight:bold;'>결제가 완료</font>되었습니다.";	//레이어팝업 결과

		$top_data['add_css']    = array("layer_popup/group_popup_css");
		$top_data['add_js']     = array("layer_popup/group_popup_js");
		$top_data['add_title']  = "결제완료";
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
