<?php

class Kcp_payment_new extends MY_Controller {

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
		//엑티브엑스 없는 버전으로 업그레이드 생략

		$mode = $this->input->post('mode', TRUE);		//mode(결제방식)
		$code = $this->input->post('code', TRUE);		//code(상품코드)

		user_check();
	
		//결제정보 환경설정
		$conf = $this->kcp_conf();
		extract($conf);
			
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

		
		//추가스크립트
		$bot_data['add_script'] = "
			<script type='text/javascript' src='".$g_conf_js_url."'></script>
			<script type='text/javascript'>StartSmartUpdate();</script>			
		";

		$this->load->view('top0_v', $top_data);
		$this->load->view('etc/kcp_order_new_v', @$data);
		$this->load->view('bottom0_v', $bot_data);

	}


	//결제정보환경설정
	function kcp_conf(){

			/* ============================================================================== */
			/* =   PAGE : 결제 정보 환경 설정 PAGE                                          = */
			/* =----------------------------------------------------------------------------= */
			/* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
			/* =   접속 주소 : http://kcp.co.kr/technique.requestcode.do                    = */
			/* =----------------------------------------------------------------------------= */
			/* =   Copyright (c)  2016   NHN KCP Inc.   All Rights Reserverd.               = */
			/* ============================================================================== */

			/* ============================================================================== */
			/* = ※ 주의 ※                                                                 = */
			/* = * g_conf_home_dir 변수 설정                                                = */
			/* =----------------------------------------------------------------------------= */
			/* =   BIN 절대 경로 입력 (bin전까지 설정                                       = */
			/* ============================================================================== */
			$conf['g_conf_home_dir']  = "/home/joyhunting/www/include/kcp_new";       // BIN 절대경로 입력 (bin전까지)
			
			/* ============================================================================== */
			/* = ※ 주의 ※                                                                 = */
			/* = * g_conf_log_path 변수 설정                                                = */
			/* =----------------------------------------------------------------------------= */
			/* =   log 경로 지정                                                            = */
			/* ============================================================================== */
			$conf['g_conf_log_path'] = "/home/joyhunting/www/include/kcp_new/log";
			
			/* ============================================================================== */
			/* = ※ 주의 ※                                                                 = */
			/* = * g_conf_gw_url 설정                                                       = */
			/* =----------------------------------------------------------------------------= */
			/* = 테스트 시 : testpaygw.kcp.co.kr로 설정해 주십시오.                         = */
			/* = 실결제 시 : paygw.kcp.co.kr로 설정해 주십시오.                             = */
			/* ============================================================================== */
			$conf['g_conf_gw_url']    = "paygw.kcp.co.kr";

			/* ============================================================================== */
			/* = ※ 주의 ※                                                                 = */
			/* = * 표준웹 결제창 g_conf_js_url 설정                                         = */
			/* =----------------------------------------------------------------------------= */
			/* = 테스트 시 : src="https://testpay.kcp.co.kr/plugin/payplus_web.jsp"         = */
			/* = 실결제 시 : src="https://pay.kcp.co.kr/plugin/payplus_web.jsp"             = */
			/* =----------------------------------------------------------------------------= */
			/* ============================================================================== */
			$conf['g_conf_js_url']    = "https://testpay.kcp.co.kr/plugin/payplus_web.jsp";

			/* ============================================================================== */
			/* = 스마트폰 SOAP 통신 설정                                                     = */
			/* =----------------------------------------------------------------------------= */
			/* = 테스트 시 : KCPPaymentService.wsdl                                         = */
			/* = 실결제 시 : real_KCPPaymentService.wsdl                                    = */
			/* ============================================================================== */
			$conf['g_wsdl']           = "KCPPaymentService.wsdl";

			/* ============================================================================== */
			/* = g_conf_site_cd, g_conf_site_key 설정                                       = */
			/* = 실결제시 KCP에서 발급한 사이트코드(site_cd), 사이트키(site_key)를 반드시   = */
			/* = 변경해 주셔야 결제가 정상적으로 진행됩니다.                                = */
			/* =----------------------------------------------------------------------------= */
			/* = 테스트 시 : 사이트코드(T0000)와 사이트키(3grptw1.zW0GSo4PQdaGvsF__)로      = */
			/* =            설정해 주십시오.                                                = */
			/* = 실결제 시 : 반드시 KCP에서 발급한 사이트코드(site_cd)와 사이트키(site_key) = */
			/* =            로 설정해 주십시오.                                             = */
			/* ============================================================================== */
			$conf['g_conf_site_cd']   = "E8675";
			$conf['g_conf_site_key']  = "39Aeb-SkuSKs.lRqazs-Qe7__";

			/* ============================================================================== */
			/* = g_conf_site_name 설정                                                      = */
			/* =----------------------------------------------------------------------------= */
			/* = 사이트명 설정(한글 불가) : 반드시 영문자로 설정하여 주시기 바랍니다.       = */
			/* ============================================================================== */
			$conf['g_conf_site_name'] = "JOYHUNTING";

			/* ============================================================================== */
			/* = 지불 데이터 셋업 (변경 불가)                                               = */
			/* ============================================================================== */
			$conf['g_conf_log_level'] = "3";
			$conf['g_conf_gw_port']   = "8090";        // 포트번호(변경불가)
			$conf['module_type']      = "01";          // 변경불가

		return $conf;

	}

}

?>