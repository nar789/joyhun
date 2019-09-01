<?php

class Intro_ann extends MY_Controller {

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

		$navs = array('미팅신청','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('intro_ann'); //우측메뉴 로딩

		$top_data['add_css'] = array("intro/ann_intro_css");
		$top_data['add_js'] = array("intro/ann_intro_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('intro/ann_main_v', $data);
		$this->load->view('bottom_v');

	}
}
/* End of file main.php */
/* Location: ./application/controllers/ */