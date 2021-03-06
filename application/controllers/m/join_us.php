<?php

class Join_us extends MY_Controller {

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

		$top_data['add_css'] = array("/m/m_join_css");
		$top_data['add_js'] = array("/m/m_join_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"회원가입"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/auth/m_join_v', @$data);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */