<?php

class Recognition_mu extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('mcrypt_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->model('member_m');
	}

	function main(){

		$code	= $_REQUEST['code'];		//데이터
		$key	= "1234567891234567";		//key 값
		$gubn	= "MU";						//구분값
		
		$value = $this->mcrypt_lib->decrypt($code, $key);
		
		$val = explode('§', $value);
		$user_name		= $val[0];		//이름
		$user_price		= $val[1];		//가격
		$return_data	= $val[2];		//결과

		$result = $this->member_m->recoginition_mu_m($user_name, str_replace(',', '', $user_price), $gubn, null);

		$comment = "";
		
		if(!empty($result)){

			//조회 데이터가 있을경우
			if($result['m_card_ok'] == 'Y'){
				//결제처리가 이미 왼료된 경우
				$comment = "01/".$user_name."/이미 결제처리 완료된 항목입니다.";
			}else if($result['m_card_ok'] == 'N'){
				//정상처리완료
				//회원 데이터 업데이트
				
				//무통장 거래내역 승인처리
				$mu_rtn = $this->my_m->update('payment_temp', array('m_tradeid' => $result['m_tradeid']), array('m_okdate' => NOW, 'm_card_ok' => 'Y', 'm_result_code' => '0000'));	

				if($mu_rtn == "1"){

					//결제완료 또는 포인트 사용처리 helper
					//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
					$rtn = member_point_insert($result['m_userid'], $result['m_product_code'], $result['m_goods'], $result['m_point'], $result['m_price'], $result['m_tradeid'], NOW, null);
						
					//첫 결제시 일반회원의 경우 정회원 등업
					$rtn2 = member_level_up($result['m_userid'], $result['m_tradeid']);
	
					if($rtn == "1"){
						//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
						$m_data = $this->member_lib->get_member($result['m_userid']);
						if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
							partner_send_curl('PAY', $m_data['m_userid'], $result['m_tradeid']);
						}
						$comment = "00/".$user_name."/자동입금처리 완료";
					}else{
						$comment = "99/".$user_name."/(오류)잘못된접근";
					}

				}else{
					$comment = "99/".$user_name."/(오류)잘못된접근";
				}

			}else{
				$comment = "99/".$user_name."/(오류)잘못된접근";
			}

		}else{
			
			//조회 데이터가 없을경우
			$result2 = $this->member_m->recoginition_mu_m($user_name, str_replace(',', '', $user_price), $gubn, 'empty');

			if(!empty($result2)){
				//이름으로 검색시 데이터가 존재할경우
				if($val[1] == $result2['m_price']){
					//잘못된 접근
					$comment = "99/".$user_name."/(오류)잘못된접근";
				}else{
					$comment = "03/".$user_name."/(오류)일치하지 않는 금액입니다.";
				}

			}else{
				//이름으로 검색시 데이터가 존재하지 않을경우
				$comment = "02/".$user_name."/(오류)존재하지 않는 이름입니다.";
			}

		}
		
		//데이터 로그 남기기
		$this->my_m->insert('mu_sms_log', array('credit' => $return_data, 'result' => $comment, 'write_date' => NOW));

		echo $this->mcrypt_lib->encrypt($comment, $key);

	}



}

/* End of file main.php */
/* Location: ./application/controlle */