<?php

class Make_friends extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');

	}

	function index()
	{
		if(IS_LOGIN == TRUE){goto("/");} //비로그인일때만

		$userchk = @$this->session->userdata('m_userid');

		$navs = array('미팅신청','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('intro_chatting'); //우측메뉴 로딩

		$top_data['add_css'] = array("intro/make_friends_css");
		$top_data['add_js'] = array("intro/chatting_intro_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('intro/make_friends_v', $data);
		$this->load->view('bottom_v');

	}

}


/* End of file main.php */
/* Location: ./application/controllers/ */