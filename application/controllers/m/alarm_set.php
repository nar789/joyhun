<?php

class Alarm_set extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
	}

	function index()
	{
		//view 설정

		$top_data['add_css'] = array("/m/m_alarm_set_css");
		$top_data['add_js'] = array("/m/m_alarm_set_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"알림설정"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/m_alaretc/m_set_v', @$data);
		$this->load->view('m/m_bottom0_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */