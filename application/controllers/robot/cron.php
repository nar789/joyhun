<?php

class Cron extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('chat_helper');
		
	}

	function auto_10_sec(){
		
		//테스트 테이블에 인서트
		//$arr_data = array('w_date' => NOW, 'mode' => '10초');
		//$rtn = $this->my_m->insert("test_table", $arr_data);
	
	}


	function auto_1_min(){		//1분마다 실행

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '1분');
		$rtn = $this->my_m->insert("test_table", $arr_data);

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '1분끝');
		$rtn = $this->my_m->insert("test_table", $arr_data);

	}

	function auto_10_min(){		//10분마다 실행.

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '10분');
		$rtn = $this->my_m->insert("test_table", $arr_data);

		//슈퍼채팅 및 슈퍼찜 예약 발송 처리 헬퍼(chat_helper)
		call_booking_super_chat_send();
		
		//app회원 공지사항 예약발송 처리 헬퍼(latest_helper)
		chat_app_push_book();

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '10분끝');
		$rtn = $this->my_m->insert("test_table", $arr_data);

	}

	function auto_30_min(){		//매시 01분, 31분마다 실행.

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '30분');
		$rtn = $this->my_m->insert("test_table", $arr_data);


		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '30분끝');
		$rtn = $this->my_m->insert("test_table", $arr_data);

	}


	function auto_1_hour(){

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '1시간');
		$rtn = $this->my_m->insert("test_table", $arr_data);

		//채팅신청내역 및 채팅내용 삭제처리 헬퍼(chat_helper)
		chat_request_flg();	

		//3개월 지난 메세지 삭체처리 헬퍼(chat_helper)
		call_message_del();

		//회원가입하고 2시간이 지난회원에게 회원가입 문자 다시 보내기 헬퍼(latest_helper)
		reg_member_sms_represend();

		//정해진 시간마다 특별아이디 로그인
		if(date("H") == "03" or date("H") == "06" or date("H") == "09" or date("H") == "12" or date("H") == "15" or date("H") == "18" or date("H") == "21" or date("H") == "23"){
			$this->member_lib->login_special_member();
		}

		//불필요한 세션 삭제
		$this->my_m->del("ci_sessions", array('ip_address' => '211.115.88.113'));
		$this->my_m->del("ci_sessions", array('user_agent' => 'Wget/1.12 (linux-gnu)'));

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW,'mode' => '1시간끝');
		$rtn = $this->my_m->insert("test_table", $arr_data);

	}

	function auto_1_day_02hour(){

		//테스트 테이블에 인서트
		$arr_data = array(
			'w_date' => NOW,
			'mode' => '1일'
		);
		$rtn = $this->my_m->insert("test_table", $arr_data);

		//3개월이 지난 메세지 내역 삭제처리 업데이트(일단주석처리)
		//$arr_search['ex_where'] = "V_DEL_GUBN IS NULL AND DATE_ADD(V_WRITE_DATE, INTERVAL 3 MONTH) <= SYSDATE()";
		//$arr_set = array('V_DEL_GUBN' => 'D');
		//$this->my_m->update('MESSAGE_LIST', $arr_search, $arr_set);
		
		//테스트 테이블에 인서트
		$arr_data = array(
			'w_date' => NOW,
			'mode' => '1일끝'
		);
		$rtn = $this->my_m->insert("test_table", $arr_data);

	}	

	function auto_1_day_10hour(){

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW, 	'mode' => '10시');
		$rtn = $this->my_m->insert("test_table", $arr_data);

		//무통장입금 입금하지 않은 회원에게 매일 아침 10시에 알림 메세지 보내기(latest_helper)
		payment_mu_user_msg();
		
		//회원 이동경로 7일이상 지난 데이터 삭제처리
		$sql = "";
		$sql .= "DELETE FROM member_site_analytics WHERE 1=1 AND SYSDATE() > DATE_ADD(write_date, INTERVAL 7 DAY)";
		$this->db->query($sql);

		//테스트 테이블에 인서트
		$arr_data = array('w_date' => NOW, 	'mode' => '10시끝');
		$rtn = $this->my_m->insert("test_table", $arr_data);
				
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */