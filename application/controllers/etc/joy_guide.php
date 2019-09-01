<?php

class Joy_guide extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
	}


	function index()
	{
		
		$navs = array('메인','조이톡소개'); //상단메뉴에 들어가는 현재위치

		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("etc/joy_guide_css");
		$top_data['add_js'] = array("etc/joy_guide_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('etc/joy_guide_v');
		$this->load->view('bottom_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */