<?php

class Random_chatting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
	}

	function index()
	{
		$navs = array('실시간채팅','랜덤채팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("chatting/chatting_css");
		$top_data['add_js'] = array("chatting/random_chatting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단

		$this->load->view('top_v',$top_data);
		$this->load->view('chatting/random_chatting_v', $data);
		$this->load->view('bottom_v');
	}


	function call_top(){
		//본문 상단
		ob_start();
		
		$this->load->view('chatting/age_chatting_top_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($num){
		//문자팅 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == 1){  //첫번째의경우 다른 css 사용
				if($i == $num){
					$data["tap_menu_css_$i"]  = "first-on";			
				}else{
					$data["tap_menu_css_$i"]  = "first-off";			
				}
			}else{
				if($i == $num){
					$data["tap_menu_css_$i"]  = "etc-on";			
				}else{
					$data["tap_menu_css_$i"]  = "etc-off";			
				}
			}
		}

		ob_start();
		
		$this->load->view('meeting/smsting_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */