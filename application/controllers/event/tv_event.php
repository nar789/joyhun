<?php

class Tv_event extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->library('m_top_menu_lib');

	}

	function index(){

		$top_data['add_css'] = array("/m/m_point_css");
		$top_data['add_js'] = array("/m/m_point_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"실시간 방송"); //탑메뉴 로딩

		$this->load->view('/m/m_top_v',$top_data);
		$this->load->view('/m/event/m_event_tv_v');
		$this->load->view('m/m_bottom0_v');



	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */