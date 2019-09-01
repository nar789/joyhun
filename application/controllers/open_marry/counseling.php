<?php

class Counseling extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('open_marry_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('alrim_helper');

	}


	function index(){
		$navs = array('공개구혼','결혼상담'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('marry',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("#");
		$top_data['add_js'] = array("#");
		
		$this->load->view('top_v',$top_data);
		$this->load->view('open_marry/counseling_v', @$data);
		$this->load->view('bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/
