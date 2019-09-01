<?php

class Guide extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
	}


	function index()
	{
		
		$navs = array('메인','채팅성공가이드'); //상단메뉴에 들어가는 현재위치

		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("etc/guide_css");
		$top_data['add_js'] = array("etc/guide_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('etc/guide_v');
		$this->load->view('bottom_v');
	}

}