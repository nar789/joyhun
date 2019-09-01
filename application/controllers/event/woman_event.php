<?php

class Woman_event extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');

	}

	function index(){
		goto('/');
	}

	//채팅신청 3회하기 레이어팝업
	function w_e_guide() {
		if(IS_MOBILE == true){
			//모바일 버전일 경우

			$top_data['add_css'] = array("layer_popup/woman_event_css");
			$top_data['add_title'] = "채팅신청 10회 보내기";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/w_g_guide_v', @$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}else{
			//pc버전일 경우
			
			$top_data['add_css'] = array("layer_popup/woman_event_css");
			$top_data['add_title'] = "채팅신청 10회 보내기";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/woman_gift_guide_v', @$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}
	}


	//채팅대화 3회하기 레이어팝업
	function w_e_guide_second()	{
		if(IS_MOBILE == true){
			$top_data['add_css'] = array("layer_popup/woman_event_css");
			$top_data['add_title'] = "채팅대화 3회하기";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/w_g_guide_second_v', @$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}else{
			//pc버전일 경우
			
			$top_data['add_css'] = array("layer_popup/woman_event_css");
			$top_data['add_title'] = "채팅대화 3회하기";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/woman_gift_guide_second_v', @$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}
	}
	

	//복주머니 이벤트 
	function new_pocket_proc(){

		header("Content-Type:application/json");
		
		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }		//세션 아이디가 없을 경우 잘못된 접근

		//회원 데이터 가져오기
		$data = $this->member_lib->get_member($user_id);
		
		//포인트 확률 : 100포인트 -> 10%, 50포인트 -> 20%, 20포인트 -> 30%, 10포인트 -> 40%			
		$rand = mt_rand(1, 100);

		//해당회원이 몇번의 이벤트 포인트를 받아갔는지 체크하기
		$cnt = $this->my_m->cnt('member_point_list', array('m_userid' => $user_id, 'm_product_code' => '0000', 'm_goods' => '이벤트 포인트 지급', 'm_tradeid' => '0000'));
		$max_cnt = 15;
		
		if($cnt > $max_cnt){

			if($rand > 0 and $rand <= 70){
				//10포인트
				$point = 10;
			}else if($rand >= 71 and $rand <= 80){
				//20포인트
				$point = 20;
			}else if($rand >= 81 and $rand <= 90){
				//50포인트
				$point = 50;
			}else{
				//100포인트
				$point = 100;
			}

		}else{
			if($rand > 0 and $rand <= 40){
				//10포인트
				$point = 10;
			}else if($rand >= 41 and $rand <= 70){
				//20포인트
				$point = 20;
			}else if($rand >= 71 and $rand <= 90){
				//50포인트
				$point = 50;
			}else{
				//100포인트
				$point = 100;
			}

		}	

		//return code(result)
		//0:포인트지급 실패, 1:포인트지급 성공, 1000:잘못된접근(아이디없음), 1001:잘못된접근(회원데이터없음), 5000:이번타임이미지급완료, 9999:준회원
		$rtn = new_pocket_point($data['m_userid'], $point);
		
		$result[] = $rtn;
		$result[] = $point;
		
		echo json_encode($result);
			
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */