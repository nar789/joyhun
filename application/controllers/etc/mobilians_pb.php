<?php

//폰빌결제(일반전화 받기)

class Mobilians_pb extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');

		define("SEEDEXE", "/opt/mcash/seed/libCipher");		//암호화경로
	}
	

	//결제페이지 임시팝업
	function payment_pop(){

		user_check();

		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);				//회원데이터 가져오기

		$code = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));						//상품코드

		$product_rtn = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//코드값으로 상품내역 가져오기
				
		$v_goods = $product_rtn['m_goods'];				//상품이름
		$v_price = $product_rtn['m_price'];				//상품가격
		$v_point = $product_rtn['m_point'];				//포인트

		$v_payment_gb = "PB";					//결재방식
		
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);		//랜덤 6자리 숫자 
		$tid = "joyhunting_".date('YmdHis')."_".$str_rand;				//거래번호만들기

		//######################################################################
		// 휴대폰 결제 / KT폰빌결제  구분은  CASH_GB 변수를 통해 구분함
		//	$CASH_GB = 'MC' 휴대폰 결제창 호출
		//	$CASH_GB = 'PB'  폰빌 결제창  호출
		//######################################################################
		$CASH_GB = "PB"; 	//모빌리언스 결제창을 호출할 결제수단 구분


		//######################################################################
		// 공통 필수 입력 항목
		//######################################################################
		$PAY_MODE	= "10";	//연동시 테스트,실결제구분 (00 : 테스트결제, 10 : 실거래결제)
		$Prdtnm		= $v_goods;	//상품명 ( KT폰빌 PB : 30byte 이내)
		$Prdtprice	= $v_price;	//결제요청금액
		$Siteurl	= $_SERVER['HTTP_HOST'];	//가맹점측 도메인URL
		$Tradeid	= "PB_".$tid;	//가맹점거래번호 Unique 값으로 세팅 권장
		$Okurl 		= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_pb/okurl";		//성공URL : 결제완료통보페이지 full Url (예:http://www.cpdomain.co.kr/sample/okurl_hybrid.php)

		//######################################################################
		// 폰빌결제 필수 입력 항목
		//######################################################################
		$PB_SVCID	= "020307010010";	//서비스아이디(KT폰빌 서비스ID 세팅)
		//######################################################################
		// 폰빌결제 선택 입력 항목
		//######################################################################
		$PB_DEFAULTCOMMID	= "KT";	// 폰빌 결제창의 이통사 표시항목 (Default:KT 만 표시 , ALL:KT 와 LG U+ 둘다 표시 , KT :KT만 표시 , LGD :LG U+ / LGD경우 사전에 별도 등록 후 가능)
		$PB_Cpcode		= "";	// 리셀러하위상점key (현재 미사용)

		//######################################################################
		// 공통 선택 입력 항목
		//######################################################################
		$Userid			= $member_data['m_userid'];	//가맹점결제자ID 
		$Notiurl		= "http://".$_SERVER['HTTP_HOST']."/etc/mobilians_pb/notiurl";	//결제처리URL : 결제 완료 후, 가맹점측 과금 등 처리할 가맹점측 URL
		$Notiemail		= "webmaster@joyhunting.com";	//알림email : 입금완료 후 당사와 가맹점간의 연동이 실패한 경우 알람 메일을 받을 가맹점 담당자 이메일주소

		$Failurl		= "";	//실패URL : 결제실패시통보페이지 full Url (예:http://www.mcash.co.kr/failurl.asp)
								//결제처리에 대한 실패처리 안내를 가맹점에서 제어해야 할 경우만 사용
		$Closeurl		= "";	//모빌리언스 결제창이 강제로 닫힌 경우 호출될 가맹점측 full url (현재 폰빌은 미지원)
		$MSTR			= "code=$code|pay_gb=$v_payment_gb";	//가맹점콜백변수으로 구분자 중 & 는 사용불가
								//가맹점에서 추가적으로 파라미터가 필요한 경우 사용하며 &, % 는 사용불가 (예 : MSTR="a=1|b=2|c=3")
		$Payeremail		= $member_data['m_mail'];	//결제자email
		$EMAIL_HIDDEN	= "N";	//결제자창 email 입력창 숨김(N default, Y 인경우 결제창에서 이메일항목 삭제)
		$Item			= "";	//아이템코드 (8byte 이내)
		$Prdtcd			= $code;	//상품코드(40byte 이내)

		//######################################################################
		//- 디자인 관련 선택항목 ( 향후  변경될 수 있습니다  )
		//######################################################################
		$LOGO_YN	= "N";		//폰빌 경우는 현재 미지원
		$CALL_TYPE	= "SELF";	//결제창 호출방식(SELF 페이지전환 , P 팝업)

		//######################################################################
		//- 암호화 ( 암호화 사용시 )
		// Cryptstring 항목은 금액변조에 대한 확인용으로  반드시 아래와 같이 문자열을 생성하여야 합니다.
		//
		// 주) 암호화 해쉬키는 가맹점에서 전달하는 거래번호로 부터 추출되어 사용되므로
		//           암호화에 이용한 거래번호가  변조되어 전달될 경우 복호화 실패로 결제 진행 불가
		//######################################################################
		$Cryptyn		= "Y";					//"Y" 암호화사용, "N" 암호화미사용		

		if($Cryptyn == "Y"){
			$Cryptstring	= $Prdtprice.$Okurl; 	//금액변조확인 (결제요청금액 + Okurl)

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

			"CASH_GB"				=> @$CASH_GB,					//결제수단
			"PAY_MODE"				=> @$PAY_MODE,					//거래종류 실거래 유무(테스트:00, 실거래:10)
			"PB_SVCID"				=> @$PB_SVCID,					//상점아이디
			"Tradeid"				=> @$Tradeid,					//거래번호
			"Siteurl"				=> @$Siteurl,					//가맹점URL
			"Okurl"					=> @$Okurl,						//가맹점측 성공URL
			"Prdtnm"				=> $Prdtnm,						//상품이름
			"Prdtprice"				=> @$Prdtprice,					//상품가격
			"CALL_TYPE"				=> @$CALL_TYPE,					//결제창호출방식
			"LOGO_YN"				=> @$LOGO_YN,					//로고사용여부
			"Failurl"				=> @$Failurl,					//실패URL
			"MSTR"					=> @$MSTR,						//파라미터
			"Notiemail"				=> @$Notiemail,					//알림이메일
			"Notiurl"				=> @$Notiurl,					//가맹점측결제처리URL
			"Payeremail"			=> @$Payeremail,				//결제자이메일
			"Userid"				=> @$Userid,					//결제자아이디
			"Prdtcd"				=> @$Prdtcd,					//상품코드
			"Item"					=> @$Item,						//아이템코드
			"Cryptstring"			=> @$Cryptstring,				//암호화검증
			"Cryptyn"				=> @$Cryptyn,					//암호화사용여부
			"EMAIL_HIDDEN"			=> @$EMAIL_HIDDEN,				//이메일항목숨김여부
			"PB_DEFAULTCOMMID"		=> @$PB_DEFAULTCOMMID,			//결제창 폰빌이동통신사 표시
			"PB_Cpcode"				=> @$PB_Cpcode					//리셀러하위상점Key(미사용)

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

	//notiurl(back결과 처리페이지)
	function notiurl(){
		
		$CASH_GB    = $this->security->xss_clean($_REQUEST['CASH_GB']);		//결제수단
		//$Mrchid     = $this->security->xss_clean($_REQUEST['Mrchid']);		//상점아이디
		$Svcid      = $this->security->xss_clean($_REQUEST['Svcid']);		//서비스아이디
		$Mobilid    = $this->security->xss_clean($_REQUEST['Mobilid']);		//모빌리언스 거래번호
		$Signdate   = $this->security->xss_clean($_REQUEST['Signdate']);	//결제일자
		$Tradeid    = $this->security->xss_clean($_REQUEST['Tradeid']);		//상점거래번호
		$Prdtnm     = $this->security->xss_clean($_REQUEST['Prdtnm']);		//상품명
		//$Prdtcd     = $this->security->xss_clean($_REQUEST['Prdtcd']);		//상품코드
		$Prdtprice  = $this->security->xss_clean($_REQUEST['Prdtprice']);	//상품가격
		$Commid     = $this->security->xss_clean($_REQUEST['Commid']);		//이통사
		$No         = $this->security->xss_clean($_REQUEST['No']);			//폰번호
		$Resultcd   = $this->security->xss_clean($_REQUEST['Resultcd']);	//결과코드
		$Resultmsg  = $this->security->xss_clean($_REQUEST['Resultmsg']);	//결과메세지
		$Userid     = $this->security->xss_clean($_REQUEST['Userid']);		//사용자ID
		$MSTR       = $this->security->xss_clean($_REQUEST['MSTR']);		//가맹점 전달 콜백변수
		$Payeremail = $this->security->xss_clean($_REQUEST['Payeremail']);	//결제자 이메일
		//$Item		= $this->security->xss_clean($_REQUEST['Item']);		//아이템

		
			
		/******************************************************
		* 결제가 정상적으로 완료되었을 경우(Resultcd=0000) 진행
		******************************************************/
		if($Resultcd  == "0000") {
			/*******************************************
			* 여기에서 가맹점 측 결제 처리를 진행한다.
			*******************************************/
			
			//결제 전에 저장한 temp 데이터 가져오기
			$temp_arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $Tradeid, 'm_cash_gb' => 'PB', 'm_payment_gb' => 'PB', 'm_card_ok' => 'N'));
			
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

					"m_commid"			=> $Commid,				//통신사
					"m_mobilid"			=> $Mobilid,
					"m_mrchid"			=> @$Mrchid,
					"m_hp"				=> $No,					//전화번호
					"m_payeremail"		=> $Payeremail,
					"m_card_ok"			=> 'Y',
					"m_signdate"		=> $Signdate,
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

			echo "FAIL";
		}

	}

	//okurl(사용자결과 처리페이지)
	function okurl(){


		$CASH_GB    = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['CASH_GB']));			//결제수단
		//$Mrchid     = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Mrchid']));			//상점아이디
		$Svcid      = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Svcid']));				//서비스아이디
		$Mobilid    = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Mobilid']));			//모빌리언스 거래번호
		$Signdate   = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Signdate']));			//결제일자
		$Tradeid    = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Tradeid']));			//상점거래번호
		$Prdtnm     = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Prdtnm']));			//상품명
		//$Prdtcd     = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Prdtcd']));			//상품코드
		$Prdtprice  = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Prdtprice']));			//상품가격
		$Commid     = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Commid']));			//이통사
		$No         = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['No']));				//전화번호
		$Resultcd   = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Resultcd']));			//결과코드
		$Resultmsg  = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Resultmsg']));			//결과메세지
		$Userid     = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Userid']));			//사용자ID
		$MSTR       = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['MSTR']));				//가맹점 전달 콜백변수
		$Payeremail = iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Payeremail']));		//결제자 이메일
		//$Item		= iconv('EUC-KR', 'UTF-8', $this->security->xss_clean($_REQUEST['Item']));				//아이템
		

		//결제가 정상적으로 성공했을경우
		if($Resultcd == "0000"){
			
			@$this->session->set_userdata(array(
				'm_type' => 'V'
			));

			//결과 레이어 팝업
			$bot_data['add_script'] = "
			<script>
				$(document).ready(function(){
					result_pop('$MSTR', 'pb');
				});
			</script>
			";

		//결제가 실패했을경우
		}else{
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
			
		$data['v_goods']  = $this->my_m->row_array('product_list', array('m_product_code' => $code));		//구매상품상세정보
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
	사용법 : cipher ("암복호화구분값E,D","암호화할데이터", "가맹점거래번호")
	주의사항 : 절대수정금지
	*****************************************************************/
	function cipher($seedStr, $seedKey) {
		if( $seedStr == "" ) return "";
		return exec(SEEDEXE." E ".escapeshellarg($this->getKey($seedKey))." ".escapeshellarg($seedStr)." ");
	}



	function getKey( $value ){
		$result = "";
		$padding = "123456789123456789";
		$tmpKey = $value;
		$keyLength = strlen( $value );
		if( $keyLength < 16 ) $tmpKey = $tmpKey.substr($padding, 0, 16-$keyLength);
		else  $tmpKey = substr( $tmpKey, strlen( $tmpKey )-16,  strlen( $tmpKey ) );
		for($i = 0 ; $i < 16; $i++) {
			$result = $result.chr(ord( substr( $tmpKey, $i, 1 ))^($i+1));
		}
		return $result;
	}
	
	

}
