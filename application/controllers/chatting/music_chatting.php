<?php

class Music_chatting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
	}

	function index(){
		$this->main();
	}

	function main(){
	
		//음악채팅 방리스트 가져오기
		if(IS_LOGIN == TRUE){
			$data['room_list'] =  $this->my_m->result_array('T_ChatRoom_List',null);
			member_session_up(); //latest_helper 세션값 업데이트 
		}else{
			$data['room_list'] =  NULL;
		}

		//채팅방이 부족하면 강제 데이터 셋팅 (code_change_helper)
		$r_data = get_music_chat_rooms();

		for($i=count($data['room_list']);$i<5;$i++){
			$data['room_list'][$i] = $r_data[$i];
		}

		$navs = array('조이채팅','음악채팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("chatting/chatting_css","main_css","chatting/slick","chatting/slick-theme");
		$top_data['add_js'] = array("chatting/music_chatting_js","chatting/slick");
		
		$this->load->view('top_v',$top_data);
		$this->load->view('chatting/music_chatting_v', $data);	
		$this->load->view('bottom_v', @$bot_data);

	}

	function iframe_music_chat(){

		user_check(null, 9);

		$data['user_id'] = @$this->session->userdata['m_userid'];

		$this->load->view('chatting/iframe_music_chat_v',$data);

	}

	function go_music_chatting(){


		$top_data['add_css'] = array("layer_popup/music_guide_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "음악채팅 입장하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);

		$this->load->view('layer_popup/music_guide_v',@$data);

		$this->load->view('layer_popup/popup_bottom_v');

	}

	function go_music_chatting2(){

		$top_data['add_css'] = array("layer_popup/music_guide_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "음악채팅 입장하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);

		$this->load->view('layer_popup/music_guide2_v',@$data);

		$this->load->view('layer_popup/popup_bottom_v');

	}


	//음악채팅 레이어팝업
	function music_chat_layer(){

		user_check(null, 9);
		
		$m_userid = $this->security->xss_clean(@url_explode($this->seg_exp, 'user_id'));
		
		if(empty($m_userid) and $m_userid != $this->session->userdata['m_userid']){
			$m_userid = $this->session->userdata['m_userid'];
		}else{
			//음악채팅 알림 보내기
			joyhunting_alrim('음악채팅', $m_userid, $this->session->userdata['m_userid']);
		}

		$data['m_data'] = $this->member_lib->get_member($m_userid);
		

		$top_data['add_css'] = array("layer_popup/chat_request_css");
		$top_data['add_js'] = array("layer_popup/chat_request_js");
		$top_data['add_title'] = "음악채팅 입장하기";
		$top_data['add_text'] = "";		

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/music_chatting_layer_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/