<?php

class Chatting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
	}

	function index()
	{

		$top_data['add_css'] = array("/m/m_chatting_css");
		$top_data['add_js'] = array("/m/m_chatting_js");

		$this->load->view('/m/m_top_v',$top_data);
		$this->load->view('/m/chatting_list/m_chatting_v');
		$this->load->view('m/m_bottom0_v');
	}

	function test()
	{

		$top_data['add_css'] = array("/m/m_chatting_css");
		$top_data['add_js'] = array("/m/m_chatting_js");

		$this->load->view('/m/m_top_v',$top_data);
		$this->load->view('/m/chatting_list/m_chatting_test_v');
		$this->load->view('m/m_bottom0_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */