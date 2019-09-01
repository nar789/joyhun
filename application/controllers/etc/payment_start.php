<?php

class Payment_start extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	
	//결제 임시팝업 경로
	function pay_start(){
		
		$mode = $this->security->xss_clean(@url_explode($this->seg_exp, 'mode'));		//mode(결제방식)
		$code = $this->security->xss_clean(@url_explode($this->seg_exp, 'code'));		//code(상품코드)
		
		//mode 값이나 code 값이 없을경우 닫기
		if($mode == "" || $code == ""){
			alert_close('잘못된 접근입니다.');
		}

		
		if($mode == "card" || $mode == "account"){

			if(IS_MOBILE == true){
				//모바일 버전의 경우

				$rtn = $this->reg_payment_temp($code, $this->session->userdata['m_userid']);
				
				if($rtn[0] == "1"){
					goto("/etc/kcp_payment/kcp_order/mode/$mode/code/$code/tid/$rtn[1]");
				}else{
					alert_goto('다시 시도하여주시기 바랍니다.', '/profile/point/point_list');
				}				

			}else{
				//PC버전의 경우

				$hidden = array("mode" => $mode, "code" => $code);		//form테이터(mode:결제방식, code:상품코드)
			
				//form값으로 mode, code 넘기기
//				if( $this->input->ip_address() == "14.33.132.241"){
//					echo form_open('/etc/kcp_payment_new/payment_pop', array('name' => 'hidden_form', 'accept-charset' => 'utf-8'), $hidden);
//				}else{
					echo form_open('/etc/kcp_payment/payment_pop', array('name' => 'hidden_form', 'accept-charset' => 'utf-8'), $hidden);
//				}

				echo form_close();
				
				//form submit처리
				//경로이동(kcp)		카드결제, 실시간계좌이체
				echo "
				<script type='text/javascript'>
					document.hidden_form.target = '';
					document.hidden_form.submit();
				</script>
				";
			}			

		}else{
			goto("/etc/mobilians_$mode/payment_pop/code/$code");			//경로이동(모빌리언스)		휴대폰, 가상계좌, 폰빌
		}

		
		
	}


	//결제 요청전 temp data 삽입(kcp 신용카드 모바일 전용)
	function reg_payment_temp($code, $m_userid){

		//모바일 버전의 경우 ajax 방식으로 결제코드가 두번 실행되는 에러가 있어서 temp데이터를 바로 저장
		//모바일은 신용카드 결제만 있기 때문에 결제구분코드 직접설정
		$m_cash_gb = "CD";
		$m_payment_gb = "CD";
		
		//app일 경우 체크
		if(IS_APP == true){
			$m_pay_gubn = "A";
		}else{
			$m_pay_gubn = "M";
		}
		
		//회원정보 가져오기
		$member_data = $this->member_lib->get_member($m_userid);

		//상품정보 가져오기
		$product_data = $this->my_m->row_array('product_list', array('m_product_code' => $code));

		//주문번호 만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$m_tradeid = $m_cash_gb."_joyhunting_".date('YmdHis')."_".$str_rand;	//주문번호


		//사용자가 결제방법 클릭시 temp데이터 삽입(결제시도 데이터)
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
			"m_pay_gubn"			=> $m_pay_gubn															//결제시도 기기
		);

		//결제시도 데이터 삽입
		$temp_insert = $this->my_m->insert('payment_temp', $temp_data);

		if($temp_insert <> "1"){
			alert_goto('다시 시도하여주시기 바랍니다.', '/profile/point/point_list');
		}
		
		return array($temp_insert, $m_tradeid);

	}

}