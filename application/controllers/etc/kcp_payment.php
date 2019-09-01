<?php

class Kcp_payment extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');
		$this->load->library('pp_cli_hub_lib');
	}

	
	//KCP 결제창 호출	
	function payment_pop(){

		user_check();

		$mode = $this->input->post('mode', TRUE);		//mode(결제방식)
		$code = $this->input->post('code', TRUE);		//code(상품코드)
		
		//mode 값이나 code 값이 없을경우 닫기
		if($mode == "" || $code == ""){
			alert_close('잘못된 접근입니다.');
		}

		$hidden = array("mode" => $mode, "code" => $code);		//form테이터(mode:결제방식, code:상품코드)
			
		//form생성, form값으로 mode, code 넘기기
		echo form_open('#', array('name' => 'hidden_form', 'accept-charset' => 'utf-8'), $hidden);
		echo form_close();
	
		$top_data['add_css'] = array('etc/sample');						//KCP SAMPLE CSS 추가
		$top_data['add_js'] = array('etc/kcp_payment_pop_js');			//KCP KCP_PAYMENT_POP_JS JS 추가
		
		//KCP 모듈 설치 추가 스크립트
		$bot_data['add_script'] = "
			<script type='text/javascript' src='http://pay.kcp.co.kr/plugin/payplus.js'></script>
			<script type='text/javascript'>
				StartSmartUpdate();
				setTimeout('jsf__chk_plugin()', '1000');
			</script>
		";
		
		//view설정
		$this->load->view('top0_v', $top_data);
		$this->load->view('etc/kcp_chk_plugin_v');
		$this->load->view('bottom0_v', $bot_data);
	}

	//KCP ORDER 페이지
	function kcp_order(){
		
		user_check();
	
		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);

		$mode = $this->input->post('mode', TRUE);		//mode(결제방식)
		$code = $this->input->post('code', TRUE);		//code(상품코드)
			
		if($mode == "card"){
			//결제방법이 카드결제일경우
			$m_cash_gb		= "CD";
			$m_payment_gb	= "CD";
			$payment_method = "신용카드";
			$pay_method = "100000000000";
		}else if($mode == "account"){
			//결제방법이 실시간 계좌이체일경우
			$m_cash_gb		= "AC";
			$m_payment_gb	= "AC";
			$payment_method = "실시간 계좌이체";
			$pay_method = "010000000000";
		}
		
		//mode 값이나 code 값이 없을경우 닫기
		if($mode == "" || $code == ""){
			alert_close('잘못된 접근입니다.');
		}
		
		//회원정보 가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//상품정보 가져오기
		$product_data = $this->my_m->row_array('product_list', array('m_product_code' => $code));

		//주문번호 만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$m_tradeid = $m_cash_gb."_joyhunting_".date('YmdHis')."_".$str_rand;	//주문번호

		//결제요청전 temp_data 저장(결제 시도)
		$temp_data = array(
			"m_userid"				=> $member_data['m_userid'],											//결제자 아이디
			"m_product_code"		=> $product_data['m_product_code'],										//상품코드
			"m_goods"				=> $product_data['m_goods'],											//상품명
			"m_price"				=> $product_data['m_price'],											//상품가격
			"m_point"				=> $product_data['m_point'],											//결제포인트
			"m_cash_gb"				=> $m_cash_gb,															//결제방법(타입)
			"m_commid"				=> '',																	//결제방법이 신용카드일경우 (카드은행 코드), 실시간계좌 일경우(은행 코드)
			"m_hp"					=> $member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3'],	//결제자 핸드폰 번호
			"m_payeremail"			=> $member_data['m_mail'],												//결제자 이메일
			"m_card_ok"				=> 'N',																	//결제완료구분(N : 결제 미완료, Y : 결제 완료)
			"m_tradeid"				=> $m_tradeid,															//주문번호
			"m_payment_gb"			=> $m_payment_gb,														//결제방법(구분)
			"m_result_code"			=> '',																	//결제완료코드
			"m_writedate"			=> NOW,																	//결제시도시간
			"m_pay_gubn"			=> 'P'																	//결제시도기기
		);

		//결제시도 데이터 삽입
		$temp_insert = $this->my_m->insert('payment_temp', $temp_data);

		if($temp_insert <> "1"){
			alert_close('다시 시도하여주시기 바랍니다.');
		}

		
		//결제자 기본 주문정보 데이터
		$data = array(
			"pay_method"		=> $pay_method,															//결제방법(코드)
			"v_goods"			=> $product_data['m_goods'],											//상품명
			"v_price"			=> $product_data['m_price'],											//상품가격
			"v_name"			=> $member_data['m_name'],												//결제자
			"v_mail"			=> $member_data['m_mail'],												//결제자이메일
			"v_hptele"			=> $member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3'],	//핸드폰번호
			"g_conf_site_cd"	=> $g_conf_site_cd,														//사이트코드
			"g_conf_site_name"	=> $g_conf_site_name,													//사이트명
			"module_type"		=> $module_type,														//모듈타입
			"m_tradeid"			=> $m_tradeid,															//주문번호
			"payment_method"	=> $payment_method														//결제방법(한글)
		);


		//view설정
		$top_data['add_css'] = array('etc/style');								//KCP STYLE CSS 추가
		$top_data['add_js'] = array('etc/kcp_order_js');						//KCP_ORDER JS 추가
		
		//추가스크립트
		$bot_data['add_script'] = "
			<script type='text/javascript' src='".$g_conf_js_url."'></script>
			<script type='text/javascript'>StartSmartUpdate();</script>			
		";

		$this->load->view('top0_v', $top_data);
		$this->load->view('etc/kcp_order_v', @$data);
		$this->load->view('bottom0_v', $bot_data);
	
	}

	//KCP결제 모바일버전
	function kcp_order_mobile(){
		
		//모바일 로그인체크
		user_check();

		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);

		$data['g_conf_site_name']	= $g_conf_site_name;
		$data['g_conf_site_cd']		= $g_conf_site_cd;

		//변수받기
		$data['mode'] = $mode = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));		//결제모드
		$data['code'] = $code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'code')));		//상품코드
		$data['tid']  = $tid  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'tid')));		//거래번호

		//kcp_ajax 변수
		$data['req_tx']				= $this->security->xss_clean(@$_REQUEST['req_tx']);
		$data['res_cd']				= $this->security->xss_clean(@$_REQUEST['res_cd']);
		$data['tran_cd']			= $this->security->xss_clean(@$_REQUEST['tran_cd']);
		$data['ordr_idxx']			= $this->security->xss_clean(@$_REQUEST['ordr_idxx']);
		$data['good_mny']			= $this->security->xss_clean(@$_REQUEST['good_mny']);
		$data['good_name']			= $this->security->xss_clean(@$_REQUEST['good_name']);
		$data['buyr_name']			= $this->security->xss_clean(@$_REQUEST['buyr_name']);
		$data['buyr_tel1']			= $this->security->xss_clean(@$_REQUEST['buyr_tel1']);
		$data['buyr_tel2']			= $this->security->xss_clean(@$_REQUEST['buyr_tel2']);
		$data['buyr_mail']			= $this->security->xss_clean(@$_REQUEST['buyr_mail']);
		$data['cash_yn']			= $this->security->xss_clean(@$_REQUEST['cash_yn']);
		$data['enc_info']			= $this->security->xss_clean(@$_REQUEST['enc_info']);
		$data['enc_data']			= $this->security->xss_clean(@$_REQUEST['enc_data']);
		$data['use_pay_method']		= $this->security->xss_clean(@$_REQUEST['use_pay_method']);
		$data['cash_tr_code']		= $this->security->xss_clean(@$_REQUEST['cash_tr_code']);
		$data['param_opt_1']		= $this->security->xss_clean(@$_REQUEST['param_opt_1']);
		$data['param_opt_2']		= $this->security->xss_clean(@$_REQUEST['param_opt_2']);
		$data['param_opt_3']		= $this->security->xss_clean(@$_REQUEST['param_opt_3']);
		
		//사용자 취소시
		if($data['res_cd'] == "3001"){
			alert_goto('사용자가 취소했습니다.', '/profile/point/point_list');
			exit;
		}else if($data['res_cd'] == "3000"){
			alert_goto('30만원 이상은 결제가 불가능합니다..', '/profile/point/point_list');
			exit;
		}
		
		//임시저장된 거래내역 가져오기(거래번호 key)
		$data['payment_temp_data'] = $this->my_m->row_array('payment_temp', array('m_tradeid' => $tid));
		//회원정보가져오기
		$data['member_data'] = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//회원정보와 거래정보의 결제자 아이디가 다를경우 거래중지
		if($data['payment_temp_data']['m_userid'] != $data['member_data']['m_userid']){
			alert_goto('거래정보와 회원정보가 일치하지 않습니다.', '/profile/point/point_list');
			exit;
		}

		$data['Ret_URL'] = "http://m.joyhunting.com/etc/kcp_payment/kcp_order/mode/".$mode."/code/".$code."/tid/".$tid;
		
		//view 설정
		$top_data['add_css'] = array('etc/style_mobile');							//KCP STYLE_MOBILE CSS 추가
		$top_data['add_js'] = array('etc/m_kcp_approval_key_js');					//M_KCP_APPROVAL_KEY JS 추가

		$bot_data['add_script'] = "
		<script type='text/javascript'>
			$(document).ready(function(){
				chk_pay();
				kcp_AJAX();
			});
		</script>
		";

		$this->load->view('m/m_top_v', $top_data);
		$this->load->view('etc/m_kcp_order_v', $data);
		$this->load->view('m/m_bottom0_v', $bot_data);
	}


	//KCP 모바일 결제 order_approval
	function kcp_order_approval(){
		
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-store");
		header("Pragma: no-cache");

		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);

		include "/home/joyhunting/www/application/libraries/KCPComLibrary.php";

		// 쇼핑몰 페이지에 맞는 문자셋을 지정해 주세요.
		$charSetType      = "utf-8";             // UTF-8인 경우 "utf-8"로 설정
		
		$siteCode         = $_REQUEST[ "site_cd"     ];
		$orderID          = $_REQUEST[ "ordr_idxx"   ];
		$paymentMethod    = $_REQUEST[ "pay_method"  ];
		$escrow           = ( $_REQUEST[ "escw_used"   ] == "Y" ) ? true : false;
		$productName      = $_REQUEST[ "good_name"   ];

		// 아래 두값은 POST된 값을 사용하지 않고 서버에 SESSION에 저장된 값을 사용하여야 함.
		$paymentAmount    = $_REQUEST[ "good_mny"    ]; // 결제 금액
		$returnUrl        = $_REQUEST[ "Ret_URL"     ];

		// Access Credential 설정
		$accessLicense    = "";
		$signature        = "";
		$timestamp        = "";

		// Base Request Type 설정
		$detailLevel      = "0";
		$requestApp       = "WEB";
		$requestID        = $orderID;
		$userAgent        = $_SERVER['HTTP_USER_AGENT'];
		$version          = "0.1";


		try
		{
			$payService = new PayService( $g_wsdl );

			$payService->setCharSet( $charSetType );
			
			$payService->setAccessCredentialType( $accessLicense, $signature, $timestamp );
			$payService->setBaseRequestType( $detailLevel, $requestApp, $requestID, $userAgent, $version );
			$payService->setApproveReq( $escrow, $orderID, $paymentAmount, $paymentMethod, $productName, $returnUrl, $siteCode );

			$approveRes = $payService->approve();
					
			printf( "%s,%s,%s,%s", $payService->resCD,  $approveRes->approvalKey,
								   $approveRes->payUrl, $payService->resMsg );

		}
		catch (SoapFault $ex )
		{
			printf( "%s,%s,%s,%s", "95XX", "", "", "연동 오류 (PHP SOAP 모듈 설치 필요)" );
		}


	}

	//결제요청 submit페이지
	function pp_cli_hub(){

		user_check();
		
		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);

		if($_SERVER['REQUEST_METHOD'] != "POST"){
			alert_close('잘못된 접근입니다.');
		}

		/* ============================================================================== */
		/* =   01. 지불 요청 정보 설정                                                  = */
		/* = -------------------------------------------------------------------------- = */
		$req_tx         = $this->security->xss_clean($_REQUEST['req_tx']);						// 요청 종류
		$tran_cd        = $this->security->xss_clean($_REQUEST['tran_cd']);						// 처리 종류
		/* = -------------------------------------------------------------------------- = */
		$cust_ip        = getenv( "REMOTE_ADDR"    );											// 요청 IP
		$ordr_idxx      = $this->security->xss_clean($_REQUEST['ordr_idxx']);					// 쇼핑몰 주문번호
		$good_name      = $this->security->xss_clean($_REQUEST['good_name']);					// 상품명
		$good_mny       = $this->security->xss_clean($_REQUEST['good_mny']);					// 결제 총금액
		/* = -------------------------------------------------------------------------- = */
		$res_cd         = "";																	// 응답코드
		$res_msg        = "";																	// 응답메시지
		$res_en_msg     = "";																	// 응답 영문 메세지
		$tno            = $this->security->xss_clean($_REQUEST['tno']);							// KCP 거래 고유 번호
		/* = -------------------------------------------------------------------------- = */
		$buyr_name      = $this->security->xss_clean($_REQUEST['buyr_name']);					// 주문자명
		//$buyr_tel1      = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호
		$buyr_tel2      = $this->security->xss_clean($_REQUEST['buyr_tel2']);					// 주문자 핸드폰 번호
		$buyr_mail      = $this->security->xss_clean($_REQUEST['buyr_mail']);					// 주문자 E-mail 주소
		/* = -------------------------------------------------------------------------- = */
		$use_pay_method = $this->security->xss_clean($_REQUEST['use_pay_method']);				// 결제 방법
		$bSucc          = "";                         // 업체 DB 처리 성공 여부
		/* = -------------------------------------------------------------------------- = */
		$app_time       = "";                         // 승인시간 (모든 결제 수단 공통)
		$amount         = "";                         // KCP 실제 거래 금액
		$total_amount   = 0;                          // 복합결제시 총 거래금액
		$coupon_mny     = "";                         // 쿠폰금액
		/* = -------------------------------------------------------------------------- = */
		$card_cd        = "";                         // 신용카드 코드
		$card_name      = "";                         // 신용카드 명
		$app_no         = "";                         // 신용카드 승인번호
		$noinf          = "";                         // 신용카드 무이자 여부
		$quota          = "";                         // 신용카드 할부개월
		$partcanc_yn    = "";                         // 부분취소 가능유무
		$card_bin_type_01 = "";                       // 카드구분1
		$card_bin_type_02 = "";                       // 카드구분2
		$card_mny       = "";                         // 카드결제금액
		/* = -------------------------------------------------------------------------- = */
		$bank_name      = "";                         // 은행명
		$bank_code      = "";                         // 은행코드
		$bk_mny         = "";                         // 계좌이체결제금액
		/* = -------------------------------------------------------------------------- = */
		$bankname       = "";                         // 입금할 은행명
		$depositor      = "";                         // 입금할 계좌 예금주 성명
		$account        = "";                         // 입금할 계좌 번호
		$va_date        = "";                         // 가상계좌 입금마감시간
		/* = -------------------------------------------------------------------------- = */
		$pnt_issue      = "";                         // 결제 포인트사 코드
		$pnt_amount     = "";                         // 적립금액 or 사용금액
		$pnt_app_time   = "";                         // 승인시간
		$pnt_app_no     = "";                         // 승인번호
		$add_pnt        = "";                         // 발생 포인트
		$use_pnt        = "";                         // 사용가능 포인트
		$rsv_pnt        = "";                         // 총 누적 포인트
		/* = -------------------------------------------------------------------------- = */
		$commid         = "";                         // 통신사 코드
		$mobile_no      = "";                         // 휴대폰 번호
		/* = -------------------------------------------------------------------------- = */
		$shop_user_id   = $this->security->xss_clean($_REQUEST['shop_user_id']);				// 가맹점 고객 아이디
		$tk_van_code    = "";                         // 발급사 코드
		$tk_app_no      = "";                         // 상품권 승인 번호
		/* = -------------------------------------------------------------------------- = */
		$cash_yn        = $this->security->xss_clean($_REQUEST['cash_yn']);						// 현금영수증 등록 여부
		$cash_authno    = "";                         // 현금 영수증 승인 번호
		$cash_tr_code   = $this->security->xss_clean($_REQUEST['cash_tr_code']);				// 현금 영수증 발행 구분
		$cash_id_info   = $this->security->xss_clean($_REQUEST['cash_id_info']);				// 현금 영수증 등록 번호

		/* ============================================================================== */

		/* ============================================================================== */
		/* =   02. 인스턴스 생성 및 초기화                                              = */
		/* = -------------------------------------------------------------------------- = */
		/* =       결제에 필요한 인스턴스를 생성하고 초기화 합니다.                     = */
		/* = -------------------------------------------------------------------------- = */
		$c_PayPlus = $this->pp_cli_hub_lib->C_PP_CLI();

		$c_PayPlus = $this->pp_cli_hub_lib->mf_clear();	
		/* ------------------------------------------------------------------------------ */
		/* =   02. 인스턴스 생성 및 초기화 END                                          = */
		/* ============================================================================== */


		/* ============================================================================== */
		/* =   03. 처리 요청 정보 설정                                                  = */
		/* = -------------------------------------------------------------------------- = */

		/* = -------------------------------------------------------------------------- = */
		/* =   03-1. 승인 요청                                                          = */
		/* = -------------------------------------------------------------------------- = */
		if ($req_tx == "pay"){
			/* 1004원은 실제로 업체에서 결제하셔야 될 원 금액을 넣어주셔야 합니다. 결제금액 유효성 검증 */
			/* $c_PayPlus->mf_set_ordr_data( "ordr_mony",  "1004" );                                    */
			$c_PayPlus = $this->pp_cli_hub_lib->mf_set_encx_data( $this->security->xss_clean($_REQUEST['enc_data']), $this->security->xss_clean($_REQUEST['enc_info']) );
		}

		/* ------------------------------------------------------------------------------ */
		/* =   03.  처리 요청 정보 설정 END                                             = */
		/* ============================================================================== */


		/* ============================================================================== */
		/* =   04. 실행                                                                 = */
		/* = -------------------------------------------------------------------------- = */
		if ( $tran_cd != "" ){
			
			$c_PayPlus = $this->pp_cli_hub_lib->mf_do_tx(@$trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
								  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
								  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

			$res_cd  = $c_PayPlus = $this->pp_cli_hub_lib->m_res_cd;  // 결과 코드
			$res_msg = $c_PayPlus = $this->pp_cli_hub_lib->m_res_msg; // 결과 메시지
			/* $res_en_msg = $c_PayPlus->mf_get_res_data( "res_en_msg" );  // 결과 영문 메세지 */ 
			
		}else{
			$c_PayPlus = $this->pp_cli_hub_lib->m_res_cd  = "9562";
			$c_PayPlus = $this->pp_cli_hub_lib->m_res_msg = "연동 오류|Payplus Plugin이 설치되지 않았거나 tran_cd값이 설정되지 않았습니다.";
		}


		/* = -------------------------------------------------------------------------- = */
		/* =   04. 실행 END                                                             = */
		/* ============================================================================== */
		

		/* ============================================================================== */
		/* =   05. 승인 결과 값 추출                                                    = */
		/* = -------------------------------------------------------------------------- = */
		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )		//결제완료
			{
				$tno       = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "tno"       ); // KCP 거래 고유 번호
				$amount    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "amount"    ); // KCP 실제 거래 금액
				$pnt_issue = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "pnt_issue" ); // 결제 포인트사 코드
				$coupon_mny = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "coupon_mny" ); // 쿠폰금액

		/* = -------------------------------------------------------------------------- = */
		/* =   05-1. 신용카드 승인 결과 처리                                            = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "100000000000" )
				{
					$card_cd   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_cd"   ); // 카드사 코드
					$card_name = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_name" ); // 카드 종류
					$app_time  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "app_time"  ); // 승인 시간
					$app_no    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "app_no"    ); // 승인 번호
					$noinf     = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "noinf"     ); // 무이자 여부 ( 'Y' : 무이자 )
					$quota     = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "quota"     ); // 할부 개월 수
					$partcanc_yn = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "partcanc_yn" ); // 부분취소 가능유무
					$card_bin_type_01 = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_bin_type_01" ); // 카드구분1
					$card_bin_type_02 = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_bin_type_02" ); // 카드구분2
					$card_mny = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_mny" ); // 카드결제금액

					/* = -------------------------------------------------------------- = */
					/* =   05-1.1. 복합결제(포인트+신용카드) 승인 결과 처리               = */
					/* = -------------------------------------------------------------- = */
					if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
					{
						$pnt_amount   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_amount"   ); // 적립금액 or 사용금액
						$pnt_app_time = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_app_time" ); // 승인시간
						$pnt_app_no   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_app_no"   ); // 승인번호
						$add_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "add_pnt"      ); // 발생 포인트
						$use_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "use_pnt"      ); // 사용가능 포인트
						$rsv_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "rsv_pnt"      ); // 총 누적 포인트
						$total_amount = $amount + $pnt_amount;                          // 복합결제시 총 거래금액
					}
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-2. 계좌이체 승인 결과 처리                                            = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "010000000000" )
				{
					$app_time  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "app_time"   );  // 승인 시간
					$bank_name = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "bank_name"  );  // 은행명
					$bank_code = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "bank_code"  );  // 은행코드
					$bk_mny = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "bk_mny" ); // 계좌이체결제금액
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-3. 가상계좌 승인 결과 처리                                            = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "001000000000" )
				{
					$bankname  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "bankname"  ); // 입금할 은행 이름
					$depositor = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "depositor" ); // 입금할 계좌 예금주
					$account   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "account"   ); // 입금할 계좌 번호
					$va_date   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "va_date"   ); // 가상계좌 입금마감시간
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-4. 포인트 승인 결과 처리                                               = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "000100000000" )
				{
					$pnt_amount   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "pnt_amount"   ); // 적립금액 or 사용금액
					$pnt_app_time = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "pnt_app_time" ); // 승인시간
					$pnt_app_no   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "pnt_app_no"   ); // 승인번호 
					$add_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "add_pnt"      ); // 발생 포인트
					$use_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "use_pnt"      ); // 사용가능 포인트
					$rsv_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "rsv_pnt"      ); // 적립 포인트
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-5. 휴대폰 승인 결과 처리                                              = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "000010000000" )
				{
					$app_time  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "hp_app_time"  ); // 승인 시간
					$commid    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "commid"	     ); // 통신사 코드
					$mobile_no = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "mobile_no"	 ); // 휴대폰 번호
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-6. 상품권 승인 결과 처리                                              = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "000000001000" )
				{
					$app_time    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "tk_app_time"  ); // 승인 시간
					$tk_van_code = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "tk_van_code"  ); // 발급사 코드
					$tk_app_no   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "tk_app_no"    ); // 승인 번호
				}

		/* = -------------------------------------------------------------------------- = */
		/* =   05-7. 현금영수증 결과 처리                                               = */
		/* = -------------------------------------------------------------------------- = */
				$cash_authno  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "cash_authno"  ); // 현금 영수증 승인 번호
		   
			}
		}
		/* = -------------------------------------------------------------------------- = */
		/* =   05. 승인 결과 처리 END                                                   = */
		/* ============================================================================== */
		
		/* ============================================================================== */
		/* =   06. 승인 및 실패 결과 DB처리                                             = */
		/* = -------------------------------------------------------------------------- = */
		/* =       결과를 업체 자체적으로 DB처리 작업하시는 부분입니다.                 = */
		/* = -------------------------------------------------------------------------- = */

		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )
			{
				// 06-1-1. 신용카드
				if ( $use_pay_method == "100000000000" )
				{

					//결제완료 처리 전 데이터 검사(금액 비교)
					$payment_temp_data = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx));

					if($payment_temp_data['m_price'] <> $good_mny){
						//선택한 상품과 결제 금액이 일치하지 않을경우
						$bSucc = "false";		//결제가 완료되었으나, 상품금액과 결제금액이 맞지 않기때문에 자동취소를 위해 false처리
					}else{
						//상품금액과 결제금액이 일치할경우 결제완료 데이터 처리
						//결제완료 처리 데이터(update)
						$payment_data = array(
							"m_commid"				=> $card_cd,					//카드사코드
							"m_mobilid"				=> $tno,						//KCP거래 고유번호
							"m_mrchid"				=> $app_no,						//카드결제 승인번호
							//"m_mstr"				=> '',							//파라미터(필요할경우 사용, '|')
							"m_card_ok"				=> 'Y',							//결제완료구분
							"m_signdate"			=> $app_time,					//카드결제 승인시간
							"m_result_code"			=> $res_cd,						//결과코드
							"m_okdate"				=> NOW							//결제완료시간
						);
						
						//업데이트 조건 
						$set_where = array(
							"m_payment_gb"	=> 'CD',				//거래종류
							"m_card_ok"		=> 'N',					//결제미완료상태
							"m_tradeid"		=> $ordr_idxx			//주문번호
						);

						//결제완료 데이터 업데이트
						$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

						if($payment_result <> "1"){
							//데이터 업데이트 실패
							$bSucc = "false";		//결제는 완료 되었으나 DB업데이트 안될시 false지정 자동 승인 취소
						}else{
							//데이터 업데이트 성공
							$bSucc = "";			//결제 완료 DB업데이트 성공시 공백
							
							//포인트 업데이트 처리를 위해서 결제완료 데이터 가져오기
							$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx, 'm_card_ok' => 'Y'));		
							
							//결제완료 또는 포인트 사용처리 helper
							//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
							$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, null);
							
							if($rtn <> "1"){
								$bSucc = "false";		//포인트 충전 실패시 결제 자동취소
							}else{
								//첫 결제시 일반회원의 경우 정회원 등업
								$rtn2 = member_level_up($arrData['m_userid'], $arrData['m_tradeid']);

								//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
								$m_data = $this->member_lib->get_member($arrData['m_userid']);
								if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
									partner_send_curl('PAY', $arrData['m_userid'], $arrData['m_tradeid']);
								}
							}
						}


					}					
					

					// 06-1-1-1. 복합결제(신용카드 + 포인트)
					if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
					{
					}


				}
				// 06-1-2. 계좌이체
				if ( $use_pay_method == "010000000000" )
				{
					
					//결제완료 처리 전 데이터 검사(금액 비교)
					$payment_temp_data = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx));

					if($payment_temp_data['m_price'] <> $good_mny){
						//선택한 상품과 결제 금액이 일치하지 않을경우
						$bSucc = "false";		//결제가 완료되었으나, 상품금액과 결제금액이 맞지 않기때문에 자동취소를 위해 false처리
					}else{

						//상품금액과 결제금액이 일치할경우 결제완료 데이터 처리
						//결제완료 처리 데이터(update)
						$payment_data = array(
							"m_commid"				=> $bank_code,					//은행사코드
							"m_mobilid"				=> $tno,						//KCP거래 고유번호
							"m_mrchid"				=> $bank_name,					//은행명
							//"m_mstr"				=> '',							//파라미터(필요할경우 사용, '|')
							"m_card_ok"				=> 'Y',							//결제완료구분
							"m_signdate"			=> $app_time,					//계좌이체 승인시간
							"m_result_code"			=> '0000',						//결과코드
							"m_okdate"				=> NOW							//결제완료시간
						);
						
						//업데이트 조건 
						$set_where = array(
							"m_payment_gb"	=> 'AC',				//거래종류
							"m_card_ok"		=> 'N',					//결제미완료상태
							"m_tradeid"		=> $ordr_idxx			//주문번호
						);

						//결제완료 데이터 업데이트
						$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

						if($payment_result <> "1"){
							//데이터 업데이트 실패
							$bSucc = "false";		//결제는 완료 되었으나 DB업데이트 안될시 false지정 자동 승인 취소
						}else{
							//데이터 업데이트 성공
							$bSucc = "";			//결제 완료 DB업데이트 성공시 공백
							
							//포인트 업에이트 처리를 위해서 결제완료 데이터 가져오기
							$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx, 'm_card_ok' => 'Y'));		
							
							//결제완료 또는 포인트 사용처리 helper
							//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
							$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, null);
							
							if($rtn <> "1"){
								$bSucc = "false";		//포인트 충전 실패시 결제 자동취소
							}else{
								//첫 결제시 일반회원의 경우 정회원 등업
								$rtn2 = member_level_up($arrData['m_userid'], $arrData['m_tradeid']);

								//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
								$m_data = $this->member_lib->get_member($arrData['m_userid']);
								if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
									partner_send_curl('PAY', $arrData['m_userid'], $arrData['m_tradeid']);
								}
							}
						}

					}


				}
				// 06-1-3. 가상계좌
				if ( $use_pay_method == "001000000000" )
				{
				}
				// 06-1-4. 포인트
				if ( $use_pay_method == "000100000000" )
				{
				}
				// 06-1-5. 휴대폰
				if ( $use_pay_method == "000010000000" )
				{
				}
				// 06-1-6. 상품권
				 if ( $use_pay_method == "000000001000" )
				{
				}
			}

		/* = -------------------------------------------------------------------------- = */
		/* =   06. 승인 및 실패 결과 DB처리                                             = */
		/* ============================================================================== */
			else if ( $res_cd != "0000" )
			{
				//결제실패 처리 데이터(update)
				$payment_data = array(
					"m_mobilid"				=> $tno,						//KCP거래 고유번호
					"m_card_ok"				=> 'N',							//결제완료구분
					"m_result_code"			=> $res_cd,						//결과코드
					"m_okdate"				=> NOW							//결제실패시간
				);
					
				//업데이트 조건 
				$set_where = array(
					"m_tradeid"		=> $ordr_idxx			//주문번호
				);

				//결제실패 데이터 업데이트
				$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

				if($payment_result <> "1"){
					alert_close("결제오류 입니다. 다시 시도해 주시기 바랍니다.");
				}
			}
		}

		/* ============================================================================== */
		/* =   07. 승인 결과 DB처리 실패시 : 자동취소                                   = */
		/* = -------------------------------------------------------------------------- = */
		/* =         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해      = */
		/* =         DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로       = */
		/* =         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.                = */
		/* =                                                                            = */
		/* =         DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"     = */
		/* =         로 설정해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의 = */
		/* =         값을 설정하시면 됩니다.)                                           = */
		/* = -------------------------------------------------------------------------- = */
		
		//$bSucc = ""; // DB 작업 실패 또는 금액 불일치의 경우 "false" 로 세팅

		/* = -------------------------------------------------------------------------- = */
		/* =   07-1. DB 작업 실패일 경우 자동 승인 취소                                 = */
		/* = -------------------------------------------------------------------------- = */
		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )
			{
				if ( $bSucc == "false" )
				{
					$c_PayPlus = $this->pp_cli_hub_lib->mf_clear();

					$tran_cd = "00200000";

					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "tno",      $tno                         );  // KCP 원거래 거래번호
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_type", "STSC"                       );  // 원거래 변경 요청 종류
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_ip",   $cust_ip                     );  // 변경 요청자 IP
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_desc", "결과 처리 오류 - 자동 취소" );  // 변경 사유

					$c_PayPlus = $this->pp_cli_hub_lib->mf_do_tx( @$trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
								  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
								  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

					$res_cd  = $c_PayPlus = $this->pp_cli_hub_lib->m_res_cd;
					$res_msg = $c_PayPlus = $this->pp_cli_hub_lib->m_res_msg;

				}
			}
		} // End of [res_cd = "0000"]
		/* ============================================================================== */
		
		//임시로 찍어논거
		//echo iconv('euc-kr', 'utf-8', $res_cd)."<br>";
		//echo iconv('euc-kr', 'utf-8', $res_msg)."<br>";
		

		/* ============================================================================== */
		/* =   08. 폼 구성 및 결과페이지 호출                                           = */
		/* ============================================================================== */
		
		//결제 완료 form 구성
		$hidden = array(
			"site_cd"					=> iconv('euc-kr', 'utf-8', @$g_conf_site_cd),				//사이트코드                                     
			"req_tx"					=> iconv('euc-kr', 'utf-8', @$req_tx),						//요청 구분                                      
			"use_pay_method"			=> iconv('euc-kr', 'utf-8', @$use_pay_method),				//사용한 결제 수단                               
			"bSucc"						=> iconv('euc-kr', 'utf-8', @$bSucc),						//쇼핑몰 DB 처리 성공 여부                       
			"amount"					=> iconv('euc-kr', 'utf-8', @$amount),						//금액                                           
			"res_cd"					=> iconv('euc-kr', 'utf-8', @$res_cd),						//결과 코드                                      
			"res_msg"					=> iconv('euc-kr', 'utf-8', @$res_msg),						//결과 메세지                                    
			"res_en_msg"				=> iconv('euc-kr', 'utf-8', @$res_en_msg),					//결과 영문 메세지                               
			"ordr_idxx"					=> iconv('euc-kr', 'utf-8', @$ordr_idxx),					//주문번호                                       
			"tno"						=> iconv('euc-kr', 'utf-8', @$tno),							//KCP 거래번호                                   
			"good_mny"					=> iconv('euc-kr', 'utf-8', @$good_mny),					//결제금액                                       
			"good_name"					=> @$good_name,												//상품명                                         
			"buyr_name"					=> @$buyr_name,												//주문자명                                       
			"buyr_tel1"					=> iconv('euc-kr', 'utf-8', @$buyr_tel1),					//주문자 전화번호                                
			"buyr_tel2"					=> iconv('euc-kr', 'utf-8', @$buyr_tel2),					//주문자 휴대폰번호                              
			"buyr_mail"					=> iconv('euc-kr', 'utf-8', @$buyr_mail),					//주문자 E-mail                                  
			"card_cd"					=> iconv('euc-kr', 'utf-8', @$card_cd),						//카드코드                                       
			"card_name"					=> iconv('euc-kr', 'utf-8', @$card_name),					//카드명                                         
			"app_time"					=> iconv('euc-kr', 'utf-8', @$app_time),					//승인시간                                       
			"app_no"					=> iconv('euc-kr', 'utf-8', @$app_no),						//승인번호                                       
			"quota"						=> iconv('euc-kr', 'utf-8', @$quota),						//할부개월                                       
			"noinf"						=> iconv('euc-kr', 'utf-8', @$noinf),						//무이자여부                                     
			"partcanc_yn"				=> iconv('euc-kr', 'utf-8', @$partcanc_yn),					//부분취소가능유무                               
			"card_bin_type_01"			=> iconv('euc-kr', 'utf-8', @$card_bin_type_01),			//카드구분1                                      
			"card_bin_type_02"			=> iconv('euc-kr', 'utf-8', @$card_bin_type_02),			//카드구분2                                      
			"bank_name"					=> iconv('euc-kr', 'utf-8', @$bank_name),					//은행명                                         
			"bank_code"					=> iconv('euc-kr', 'utf-8', @$bank_code),					//은행코드                                       
			"bankname"					=> iconv('euc-kr', 'utf-8', @$bankname),					//입금할 은행                                    
			"depositor"					=> iconv('euc-kr', 'utf-8', @$depositor),					//입금할 계좌 예금주                             
			"account"					=> iconv('euc-kr', 'utf-8', @$account),						//입금할 계좌 번호                               
			"va_date"					=> iconv('euc-kr', 'utf-8', @$va_date),						//가상계좌 입금마감시간                          
			"pnt_issue"					=> iconv('euc-kr', 'utf-8', @$pnt_issue),					//포인트 서비스사                                
			"pnt_app_time"				=> iconv('euc-kr', 'utf-8', @$pnt_app_time),				//승인시간                                       
			"pnt_app_no"				=> iconv('euc-kr', 'utf-8', @$pnt_app_no),					//승인번호                                       
			"pnt_amount"				=> iconv('euc-kr', 'utf-8', @$pnt_amount),					//적립금액 or 사용금액                           
			"add_pnt"					=> iconv('euc-kr', 'utf-8', @$add_pnt),						//발생 포인트                                    
			"use_pnt"					=> iconv('euc-kr', 'utf-8', @$use_pnt),						//사용가능 포인트                                
			"rsv_pnt"					=> iconv('euc-kr', 'utf-8', @$rsv_pnt),						//적립 포인트                                    
			"commid"					=> iconv('euc-kr', 'utf-8', @$commid),						//통신사 코드                                    
			"mobile_no"					=> iconv('euc-kr', 'utf-8', @$mobile_no),					//휴대폰 번호                                    
			"tk_van_code"				=> iconv('euc-kr', 'utf-8', @$tk_van_code),					//발급사 코드                                    
			"tk_app_time"				=> iconv('euc-kr', 'utf-8', @$tk_app_time),					//승인 시간                                      
			"tk_app_no"					=> iconv('euc-kr', 'utf-8', @$tk_app_no),					//승인 번호                                      
			"cash_yn"					=> iconv('euc-kr', 'utf-8', @$cash_yn),						//현금영수증 등록 여부                           
			"cash_authno"				=> iconv('euc-kr', 'utf-8', @$cash_authno),					//현금 영수증 승인 번호                          
			"cash_tr_code"				=> iconv('euc-kr', 'utf-8', @$cash_tr_code),				//현금 영수증 발행 구분                          
			"cash_id_info"				=> iconv('euc-kr', 'utf-8', @$cash_id_info)					//현금 영수증 등록 번호                          

		);

		//form생성, form값으로 mode, code 넘기기
		echo form_open('etc/kcp_payment/kcp_result', array('name' => 'pay_info', 'accept-charset' => 'utf-8'), $hidden);
		echo form_close();
		
		$top_data['add_js'] = array('etc/kcp_pp_cli_hub_js');			//kcp_pp_cli_hub_js 추가

		$this->load->view('top0_v', $top_data);
		$this->load->view('bottom0_v');
		
	}

	//모바일 결제요청 submit페이지
	function pp_cli_hub_mobile(){

		//모바일 로그인 체크
		user_check();
	
		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);

		if ( $_SERVER['REQUEST_METHOD'] != "POST" ){
			alert_goto('잘못된 경로입니다.', '/');
		}

		/* ============================================================================== */
		/* =   01. 지불 요청 정보 설정                                                  = */
		/* = -------------------------------------------------------------------------- = */
		$req_tx         = $this->security->xss_clean($_REQUEST[ "req_tx"         ]); // 요청 종류
		$tran_cd        = $this->security->xss_clean($_REQUEST[ "tran_cd"        ]); // 처리 종류
		/* = -------------------------------------------------------------------------- = */
		$cust_ip        = getenv( "REMOTE_ADDR"    ); // 요청 IP
		$ordr_idxx      = $this->security->xss_clean($_REQUEST[ "ordr_idxx"      ]); // 쇼핑몰 주문번호
		$good_name      = $this->security->xss_clean($_REQUEST[ "good_name"      ]); // 상품명
		$good_mny       = $this->security->xss_clean($_REQUEST[ "good_mny"       ]); // 결제 총금액
		/* = -------------------------------------------------------------------------- = */
		$res_cd         = "";                         // 응답코드
		$res_msg        = "";                         // 응답메시지
		$tno            = $this->security->xss_clean($_REQUEST[ "tno"            ]); // KCP 거래 고유 번호
		/* = -------------------------------------------------------------------------- = */
		$buyr_name      = $this->security->xss_clean($_REQUEST[ "buyr_name"      ]); // 주문자명
		$buyr_tel1      = $this->security->xss_clean($_REQUEST[ "buyr_tel1"      ]); // 주문자 전화번호
		$buyr_tel2      = $this->security->xss_clean($_REQUEST[ "buyr_tel2"      ]); // 주문자 핸드폰 번호
		$buyr_mail      = $this->security->xss_clean($_REQUEST[ "buyr_mail"      ]); // 주문자 E-mail 주소
		/* = -------------------------------------------------------------------------- = */
		$use_pay_method = $this->security->xss_clean($_REQUEST[ "use_pay_method" ]); // 결제 방법
		$bSucc          = "";                         // 업체 DB 처리 성공 여부
		/* = -------------------------------------------------------------------------- = */
		$app_time       = "";                         // 승인시간 (모든 결제 수단 공통)
		$amount         = "";                         // KCP 실제 거래 금액
		/* = -------------------------------------------------------------------------- = */
		$card_cd        = "";                         // 신용카드 코드
		$card_name      = "";                         // 신용카드 명
		$app_no         = "";                         // 신용카드 승인번호
		$noinf          = "";                         // 신용카드 무이자 여부
		$quota          = "";                         // 신용카드 할부개월
		$partcanc_yn    = "";                         // 부분취소 가능유무
		$card_bin_type_01 = "";                       // 카드구분1
		$card_bin_type_02 = "";                       // 카드구분2
		/* = -------------------------------------------------------------------------- = */
		$bank_name      = "";                         // 은행명
		$bank_code      = "";                         // 은행코드
		/* = -------------------------------------------------------------------------- = */
		$bankname       = "";                         // 입금할 은행명
		$depositor      = "";                         // 입금할 계좌 예금주 성명
		$account        = "";                         // 입금할 계좌 번호
		$va_date        = "";                         // 가상계좌 입금마감시간
		/* = -------------------------------------------------------------------------- = */
		$pnt_issue      = "";                         // 결제 포인트사 코드
		$pnt_amount     = "";                         // 적립금액 or 사용금액
		$pnt_app_time   = "";                         // 승인시간
		$pnt_app_no     = "";                         // 승인번호
		$add_pnt        = "";                         // 발생 포인트
		$use_pnt        = "";                         // 사용가능 포인트
		$rsv_pnt        = "";                         // 적립 포인트
		/* = -------------------------------------------------------------------------- = */
		$commid         = "";                         // 통신사 코드
		$mobile_no      = "";                         // 휴대폰 번호
		$van_cd         = "";
		/* = -------------------------------------------------------------------------- = */
		$tk_van_code    = "";                         // 발급사 코드
		$tk_app_no      = "";                         // 상품권 승인 번호
		/* = -------------------------------------------------------------------------- = */
		$cash_yn        = $this->security->xss_clean($_REQUEST[ "cash_yn"        ]); // 현금영수증 등록 여부
		$cash_authno    = "";                         // 현금 영수증 승인 번호
		$cash_tr_code   = $this->security->xss_clean(@$_REQUEST[ "cash_tr_code"   ]); // 현금 영수증 발행 구분
		$cash_id_info   = $this->security->xss_clean(@$_REQUEST[ "cash_id_info"   ]); // 현금 영수증 등록 번호

		$param_opt_1    = $this->security->xss_clean($_REQUEST[ "param_opt_1" ]);
		$param_opt_2    = $this->security->xss_clean($_REQUEST[ "param_opt_2" ]);
		$param_opt_3    = $this->security->xss_clean($_REQUEST[ "param_opt_3" ]);

		/* ============================================================================== */

		/* ============================================================================== */
		/* =   02. 인스턴스 생성 및 초기화                                              = */
		/* = -------------------------------------------------------------------------- = */
		/* =       결제에 필요한 인스턴스를 생성하고 초기화 합니다.                     = */
		/* = -------------------------------------------------------------------------- = */
		$c_PayPlus = $this->pp_cli_hub_lib->C_PP_CLI();

		$c_PayPlus = $this->pp_cli_hub_lib->mf_clear();	
		/* ------------------------------------------------------------------------------ */
		/* =   02. 인스턴스 생성 및 초기화 END                                          = */
		/* ============================================================================== */


		/* ============================================================================== */
		/* =   03. 처리 요청 정보 설정                                                  = */
		/* = -------------------------------------------------------------------------- = */

		/* = -------------------------------------------------------------------------- = */
		/* =   03-1. 승인 요청                                                          = */
		/* = -------------------------------------------------------------------------- = */
		if ($req_tx == "pay"){
			/* 1004원은 실제로 업체에서 결제하셔야 될 원 금액을 넣어주셔야 합니다. 결제금액 유효성 검증 */
			/* $c_PayPlus->mf_set_ordr_data( "ordr_mony",  "1004" );                                    */
			$c_PayPlus = $this->pp_cli_hub_lib->mf_set_encx_data( $this->security->xss_clean($_REQUEST['enc_data']), $this->security->xss_clean($_REQUEST['enc_info']) );
		}

		/* ------------------------------------------------------------------------------ */
		/* =   03.  처리 요청 정보 설정 END                                             = */
		/* ============================================================================== */


		/* ============================================================================== */
		/* =   04. 실행                                                                 = */
		/* = -------------------------------------------------------------------------- = */
		if ( $tran_cd != "" ){
			
			$c_PayPlus = $this->pp_cli_hub_lib->mf_do_tx(@$trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
								  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
								  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

			$res_cd  = $c_PayPlus = $this->pp_cli_hub_lib->m_res_cd;  // 결과 코드
			$res_msg = $c_PayPlus = $this->pp_cli_hub_lib->m_res_msg; // 결과 메시지
			/* $res_en_msg = $c_PayPlus->mf_get_res_data( "res_en_msg" );  // 결과 영문 메세지 */ 
			
		}else{
			$c_PayPlus = $this->pp_cli_hub_lib->m_res_cd  = "9562";
			$c_PayPlus = $this->pp_cli_hub_lib->m_res_msg = "연동 오류|Payplus Plugin이 설치되지 않았거나 tran_cd값이 설정되지 않았습니다.";
		}


		/* = -------------------------------------------------------------------------- = */
		/* =   04. 실행 END                                                             = */
		/* ============================================================================== */
		

		/* ============================================================================== */
		/* =   05. 승인 결과 값 추출                                                    = */
		/* = -------------------------------------------------------------------------- = */
		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )		//결제완료
			{
				$tno       = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "tno"       ); // KCP 거래 고유 번호
				$amount    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "amount"    ); // KCP 실제 거래 금액
				$pnt_issue = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "pnt_issue" ); // 결제 포인트사 코드
				$coupon_mny = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "coupon_mny" ); // 쿠폰금액

		/* = -------------------------------------------------------------------------- = */
		/* =   05-1. 신용카드 승인 결과 처리                                            = */
		/* = -------------------------------------------------------------------------- = */
				if ( $use_pay_method == "100000000000" )
				{
					$card_cd   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_cd"   ); // 카드사 코드
					$card_name = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_name" ); // 카드 종류
					$app_time  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "app_time"  ); // 승인 시간
					$app_no    = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "app_no"    ); // 승인 번호
					$noinf     = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "noinf"     ); // 무이자 여부 ( 'Y' : 무이자 )
					$quota     = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "quota"     ); // 할부 개월 수
					$partcanc_yn = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "partcanc_yn" ); // 부분취소 가능유무
					$card_bin_type_01 = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_bin_type_01" ); // 카드구분1
					$card_bin_type_02 = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_bin_type_02" ); // 카드구분2
					$card_mny = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "card_mny" ); // 카드결제금액

					/* = -------------------------------------------------------------- = */
					/* =   05-1.1. 복합결제(포인트+신용카드) 승인 결과 처리               = */
					/* = -------------------------------------------------------------- = */
					if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
					{
						$pnt_amount   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_amount"   ); // 적립금액 or 사용금액
						$pnt_app_time = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_app_time" ); // 승인시간
						$pnt_app_no   = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "pnt_app_no"   ); // 승인번호
						$add_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "add_pnt"      ); // 발생 포인트
						$use_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "use_pnt"      ); // 사용가능 포인트
						$rsv_pnt      = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data ( "rsv_pnt"      ); // 총 누적 포인트
						$total_amount = $amount + $pnt_amount;                          // 복합결제시 총 거래금액
					}
				}

	
		/* = -------------------------------------------------------------------------- = */
		/* =   05-7. 현금영수증 결과 처리                                               = */
		/* = -------------------------------------------------------------------------- = */
				$cash_authno  = $c_PayPlus = $this->pp_cli_hub_lib->mf_get_res_data( "cash_authno"  ); // 현금 영수증 승인 번호
		   
			}
		}
		/* ============================================================================== */
		/* =   06. 승인 및 실패 결과 DB처리                                             = */
		/* = -------------------------------------------------------------------------- = */
		/* =       결과를 업체 자체적으로 DB처리 작업하시는 부분입니다.                 = */
		/* = -------------------------------------------------------------------------- = */

		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )
			{
				// 06-1-1. 신용카드
				if ( $use_pay_method == "100000000000" )
				{

					//결제완료 처리 전 데이터 검사(금액 비교)
					$payment_temp_data = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx));

					if($payment_temp_data['m_price'] <> $good_mny){
						//선택한 상품과 결제 금액이 일치하지 않을경우
						$bSucc = "false";		//결제가 완료되었으나, 상품금액과 결제금액이 맞지 않기때문에 자동취소를 위해 false처리
					}else{
						//상품금액과 결제금액이 일치할경우 결제완료 데이터 처리
						//결제완료 처리 데이터(update)
						$payment_data = array(
							"m_commid"				=> $card_cd,					//카드사코드
							"m_mobilid"				=> $tno,						//KCP거래 고유번호
							"m_mrchid"				=> $app_no,						//카드결제 승인번호
							//"m_mstr"				=> '',							//파라미터(필요할경우 사용, '|')
							"m_card_ok"				=> 'Y',							//결제완료구분
							"m_signdate"			=> $app_time,					//카드결제 승인시간
							"m_result_code"			=> $res_cd,						//결과코드
							"m_okdate"				=> NOW							//결제완료시간
						);
						
						//업데이트 조건 
						$set_where = array(
							"m_payment_gb"	=> 'CD',				//거래종류
							"m_card_ok"		=> 'N',					//결제미완료상태
							"m_tradeid"		=> $ordr_idxx			//주문번호
						);

						//결제완료 데이터 업데이트
						$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

						if($payment_result <> "1"){
							//데이터 업데이트 실패
							$bSucc = "false";		//결제는 완료 되었으나 DB업데이트 안될시 false지정 자동 승인 취소
						}else{
							//데이터 업데이트 성공
							$bSucc = "";			//결제 완료 DB업데이트 성공시 공백
							
							//포인트 업데이트 처리를 위해서 결제완료 데이터 가져오기
							$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $ordr_idxx, 'm_card_ok' => 'Y'));		
							
							//결제완료 또는 포인트 사용처리 helper
							//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
							$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, null);
							
							if($rtn <> "1"){
								$bSucc = "false";		//포인트 충전 실패시 결제 자동취소
							}else{
								//첫 결제시 일반회원의 경우 정회원 등업
								$rtn2 = member_level_up($arrData['m_userid'], $arrData['m_tradeid']);
							}
						}
					}					
					

					// 06-1-1-1. 복합결제(신용카드 + 포인트)
					if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
					{
					}


				}
				
			}

		/* = -------------------------------------------------------------------------- = */
		/* =   06. 승인 및 실패 결과 DB처리                                             = */
		/* ============================================================================== */
			else if ( $res_cd != "0000" )
			{
				//결제실패 처리 데이터(update)
				$payment_data = array(
					"m_mobilid"				=> $tno,						//KCP거래 고유번호
					"m_card_ok"				=> 'N',							//결제완료구분
					"m_result_code"			=> $res_cd,						//결과코드
					"m_okdate"				=> NOW							//결제실패시간
				);
					
				//업데이트 조건 
				$set_where = array(
					"m_tradeid"		=> $ordr_idxx			//주문번호
				);

				//결제실패 데이터 업데이트
				$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

				if($payment_result <> "1"){
					alert_close("결제오류 입니다. 다시 시도해 주시기 바랍니다.");
				}
			}
		}

		/* ============================================================================== */
		/* =   07. 승인 결과 DB처리 실패시 : 자동취소                                   = */
		/* = -------------------------------------------------------------------------- = */
		/* =         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해      = */
		/* =         DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로       = */
		/* =         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.                = */
		/* =                                                                            = */
		/* =         DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"     = */
		/* =         로 설정해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의 = */
		/* =         값을 설정하시면 됩니다.)                                           = */
		/* = -------------------------------------------------------------------------- = */
		
		//$bSucc = ""; // DB 작업 실패 또는 금액 불일치의 경우 "false" 로 세팅

		/* = -------------------------------------------------------------------------- = */
		/* =   07-1. DB 작업 실패일 경우 자동 승인 취소                                 = */
		/* = -------------------------------------------------------------------------- = */
		if ( $req_tx == "pay" )
		{
			if( $res_cd == "0000" )
			{
				if ( $bSucc == "false" )
				{
					$c_PayPlus = $this->pp_cli_hub_lib->mf_clear();

					$tran_cd = "00200000";

					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "tno",      $tno                         );  // KCP 원거래 거래번호
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_type", "STSC"                       );  // 원거래 변경 요청 종류
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_ip",   $cust_ip                     );  // 변경 요청자 IP
					$c_PayPlus = $this->pp_cli_hub_lib->mf_set_modx_data( "mod_desc", "결과 처리 오류 - 자동 취소" );  // 변경 사유

					$c_PayPlus = $this->pp_cli_hub_lib->mf_do_tx( @$trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
								  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
								  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

					$res_cd  = $c_PayPlus = $this->pp_cli_hub_lib->m_res_cd;
					$res_msg = $c_PayPlus = $this->pp_cli_hub_lib->m_res_msg;

				}
			}
		} // End of [res_cd = "0000"]
		/* ============================================================================== */

		
		//임시로 찍어논거
		echo $res_cd."<br>";
		echo $res_msg."<br>";
		

		/* ============================================================================== */
		/* =   08. 폼 구성 및 결과페이지 호출                                           = */
		/* ============================================================================== */
		
		$bot_data['add_script'] = "
		<script type='text/javascript'>
			$(document).ready(function(){
				$(location).attr('href', '/profile/point/point_list/code/".$arrData['m_product_code']."/mode/card');
			});
		</script>
		";

		$this->load->view('m/m_top0_v');
		$this->load->view('m/m_bottom0_v', $bot_data);

	}


	//결제 결과 통보 result
	function kcp_result(){

		/* ============================================================================== */
		/* =   지불 결과                                                                = */
		/* = -------------------------------------------------------------------------- = */
		$data['site_cd']          = $this->security->xss_clean($_REQUEST['site_cd']);			// 사이트코드
		$data['req_tx']           = $this->security->xss_clean($_REQUEST['req_tx']);			// 요청 구분(승인/취소)
		$data['use_pay_method']   = $this->security->xss_clean($_REQUEST['use_pay_method']);    // 사용 결제 수단
		$data['bSucc']            = $this->security->xss_clean($_REQUEST['bSucc']);				// 업체 DB 정상처리 완료 여부
		/* = -------------------------------------------------------------------------- = */
		$data['res_cd']           = $this->security->xss_clean($_REQUEST['res_cd']);			// 결과코드
		$data['res_msg']          = $this->security->xss_clean($_REQUEST['res_msg']);			// 결과메시지
		$data['res_msg_bsucc']    = "";
		/* = -------------------------------------------------------------------------- = */
		$data['amount']           = $this->security->xss_clean($_REQUEST['amount']);			// 금액
		$data['ordr_idxx']        = $this->security->xss_clean($_REQUEST['ordr_idxx']);			// 주문번호
		$data['tno']              = $this->security->xss_clean($_REQUEST['tno']);				// KCP 거래번호
		$data['good_mny']         = $this->security->xss_clean($_REQUEST['good_mny']);			// 결제금액
		$data['good_name']        = $this->security->xss_clean($_REQUEST['good_name']);			// 상품명
		$data['buyr_name']        = $this->security->xss_clean($_REQUEST['buyr_name']);			// 구매자명
		$data['buyr_tel1']        = $this->security->xss_clean($_REQUEST['buyr_tel1']);			// 구매자 전화번호
		$data['buyr_tel2']        = $this->security->xss_clean($_REQUEST['buyr_tel2']);			// 구매자 휴대폰번호
		$data['buyr_mail']        = $this->security->xss_clean($_REQUEST['buyr_mail']);			// 구매자 E-Mail
		/* = -------------------------------------------------------------------------- = */
		// 공통
		$data['pnt_issue']        = $this->security->xss_clean($_REQUEST['pnt_issue']);			// 포인트 서비스사
		$data['app_time']         = $this->security->xss_clean($_REQUEST['app_time']);			// 승인시간 (공통)
		/* = -------------------------------------------------------------------------- = */
		// 신용카드
		$data['card_cd']          = $this->security->xss_clean($_REQUEST['card_cd']);			// 카드코드
		$data['card_name']        = $this->security->xss_clean($_REQUEST['card_name']);			// 카드명
		$data['noinf']            = $this->security->xss_clean($_REQUEST['noinf']);				// 무이자 여부
		$data['quota']            = $this->security->xss_clean($_REQUEST['quota']);				// 할부개월
		$data['app_no']           = $this->security->xss_clean($_REQUEST['app_no']);			// 승인번호
		/* = -------------------------------------------------------------------------- = */
		// 계좌이체
		$data['bank_name']        = $this->security->xss_clean($_REQUEST['bank_name']);			// 은행명
		$data['bank_code']        = $this->security->xss_clean($_REQUEST['bank_code']);			// 은행코드
		/* = -------------------------------------------------------------------------- = */
		// 가상계좌
		$data['bankname']         = $this->security->xss_clean($_REQUEST['bankname']);			// 입금할 은행
		$data['depositor']        = $this->security->xss_clean($_REQUEST['depositor']);			// 입금할 계좌 예금주
		$data['account']          = $this->security->xss_clean($_REQUEST['account']);			// 입금할 계좌 번호
		$data['va_date']          = $this->security->xss_clean($_REQUEST['va_date']);			// 가상계좌 입금마감시간
		/* = -------------------------------------------------------------------------- = */
		// 포인트
		$data['add_pnt']          = $this->security->xss_clean($_REQUEST['add_pnt']);			// 발생 포인트
		$data['use_pnt']          = $this->security->xss_clean($_REQUEST['use_pnt']);			// 사용가능 포인트
		$data['rsv_pnt']          = $this->security->xss_clean($_REQUEST['rsv_pnt']);			// 총 누적 포인트
		$data['pnt_app_time']     = $this->security->xss_clean($_REQUEST['pnt_app_time']);      // 승인시간
		$data['pnt_app_no']       = $this->security->xss_clean($_REQUEST['pnt_app_no']);		// 승인번호
		$data['pnt_amount']       = $this->security->xss_clean($_REQUEST['pnt_amount']);		// 적립금액 or 사용금액
		/* = -------------------------------------------------------------------------- = */
		//상품권
		$data['tk_van_code']      = $this->security->xss_clean($_REQUEST['tk_van_code']);		// 발급사 코드
		$data['tk_app_no']        = $this->security->xss_clean($_REQUEST['tk_app_no']);			// 승인 번호
		/* = -------------------------------------------------------------------------- = */
		//휴대폰
		$data['commid']           = $this->security->xss_clean($_REQUEST['commid']);			// 통신사 코드
		$data['mobile_no']        = $this->security->xss_clean($_REQUEST['mobile_no']);			// 휴대폰 번호
		/* = -------------------------------------------------------------------------- = */
		// 현금영수증
		$data['cash_yn']          = $this->security->xss_clean($_REQUEST['cash_yn']);			//현금영수증 등록 여부
		$data['cash_authno']      = $this->security->xss_clean($_REQUEST['cash_authno']);		//현금영수증 승인 번호
		$data['cash_tr_code']     = $this->security->xss_clean($_REQUEST['cash_tr_code']);      //현금영수증 발행 구분
		$data['cash_id_info']     = $this->security->xss_clean($_REQUEST['cash_id_info']);      //현금영수증 등록 번호
		/* = -------------------------------------------------------------------------- = */
		
		$req_tx_name = "";

		if( $data['req_tx'] == "pay" )
		{
			$req_tx_name = "지불";
		}
		else if( $data['req_tx'] == "mod" )
		{
			$req_tx_name = "매입/취소";
		}

		/* ============================================================================== */
		/* =   가맹점 측 DB 처리 실패시 상세 결과 메시지 설정                           = */
		/* = -------------------------------------------------------------------------- = */

		if($data['req_tx'] == "pay")
		{
			//업체 DB 처리 실패
			if($data['bSucc'] == "false")
			{
				if ($data['res_cd'] == "0000")
				{
					$data['res_msg_bsucc'] = "결제는 정상적으로 이루어졌지만 업체에서 결제 결과를 처리하는 중 오류가 발생하여 시스템에서 자동으로 취소 요청을 하였습니다. <br> 업체로 문의하여 확인하시기 바랍니다.";
				}
				else
				{
					$data['res_msg_bsucc'] = "결제는 정상적으로 이루어졌지만 업체에서 결제 결과를 처리하는 중 오류가 발생하여 시스템에서 자동으로 취소 요청을 하였으나, <br> <b>취소가 실패 되었습니다.</b><br> 업체로 문의하여 확인하시기 바랍니다.";
				}
			}
		}

		/* = -------------------------------------------------------------------------- = */
		/* =   가맹점 측 DB 처리 실패시 상세 결과 메시지 설정 끝                        = */
		/* ============================================================================== */

		//view 설정
		$top_data['add_js'] = array('etc/kcp_result_js');		//KCP KCP_REUSLT_JS 추가
		$top_data['add_css'] = array('etc/style');				//KCP STYLE CSS 추가
	

		$this->load->view('top0_v', $top_data);
		$this->load->view('etc/kcp_result_v', $data);
		$this->load->view('bottom0_v');	

	}

	


	//결제정보환경설정
	function kcp_conf(){

		/* ==============================결제정보환경설정================================ */
		$conf['g_conf_home_dir']	= "/home/joyhunting/www/include/kcp";       // BIN 절대경로 입력 (bin전까지) 
		$conf['g_conf_log_path']	= "/home/joyhunting/www/include/kcp/log";	// log기록 경로

		$conf['g_conf_gw_url']		= "paygw.kcp.co.kr";		//테스트 시 : testpaygw.kcp.co.kr, 실결제 시 : paygw.kcp.co.kr

		/* ============================================================================== */
		/* = ※ 주의 ※                                                                 = */
		/* = * g_conf_js_url 설정                                                       = */
		/* =----------------------------------------------------------------------------= */
		/* = 테스트 시 : src="http://pay.kcp.co.kr/plugin/payplus_test.js"              = */
		/* =             src="https://pay.kcp.co.kr/plugin/payplus_test.js"             = */
		/* = 실결제 시 : src="http://pay.kcp.co.kr/plugin/payplus.js"                   = */
		/* =             src="https://pay.kcp.co.kr/plugin/payplus.js"                  = */
		/* =                                                                            = */
		/* = 테스트 시(UTF-8) : src="http://pay.kcp.co.kr/plugin/payplus_test_un.js"    = */
		/* =                    src="https://pay.kcp.co.kr/plugin/payplus_test_un.js"   = */
		/* = 실결제 시(UTF-8) : src="http://pay.kcp.co.kr/plugin/payplus_un.js"         = */
		/* =                    src="https://pay.kcp.co.kr/plugin/payplus_un.js"        = */
		/* ============================================================================== */
		$conf['g_conf_js_url']    = "https://pay.kcp.co.kr/plugin/payplus_un.js";

		/* ============================================================================== */
		/* = 스마트폰 SOAP 통신 설정                                                     = */
		/* =----------------------------------------------------------------------------= */
		/* = 테스트 시 : KCPPaymentService.wsdl                                         = */
		/* = 실결제 시 : real_KCPPaymentService.wsdl                                    = */
		/* ============================================================================== */
		$conf['g_wsdl']           = "/home/joyhunting/www/include/kcp/real_KCPPaymentService.wsdl";

		/* ============================================================================== */
		/* = g_conf_site_cd, g_conf_site_key 설정                                       = */
		/* = 실결제시 KCP에서 발급한 사이트코드(site_cd), 사이트키(site_key)를 반드시   = */
		/* = 변경해 주셔야 결제가 정상적으로 진행됩니다.                                = */
		/* =----------------------------------------------------------------------------= */
		/* = 테스트 시 : 사이트코드(T0000)와 사이트키(3grptw1.zW0GSo4PQdaGvsF__)로      = */
		/* =            설정해 주십시오.                                                = */
		/* = 실결제 시 : 반드시 KCP에서 발급한 사이트코드(site_cd)와 사이트키(site_key) = */
		/* =            로 설정해 주십시오.  E8675, 39Aeb-SkuSKs.lRqazs-Qe7__           = */
		/* ============================================================================== */
		$conf['g_conf_site_cd']   = "E8675";
		$conf['g_conf_site_key']  = "39Aeb-SkuSKs.lRqazs-Qe7__";

		/* ============================================================================== */
		/* = g_conf_site_name 설정                                                      = */
		/* =----------------------------------------------------------------------------= */
		/* = 사이트명 설정(한글 불가) : 반드시 영문자로 설정하여 주시기 바랍니다.       = */
		/* ============================================================================== */
		if(IS_MOBILE == true){
			$conf['g_conf_site_name'] = "m.joyhunting.com";
		}else{
			$conf['g_conf_site_name'] = $_SERVER['HTTP_HOST'];
		}	

		/* ============================================================================== */
		/* = 지불 데이터 셋업 (변경 불가)                                               = */
		/* ============================================================================== */
		$conf['g_conf_log_level'] = "3";
		$conf['g_conf_gw_port']   = "8090";        // 포트번호(변경불가)
		$conf['module_type']      = "01";          // 변경불가
		/* ==============================결제정보환경설정================================ */
		
		return $conf;
	}

}