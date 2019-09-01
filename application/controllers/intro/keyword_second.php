<?php

class Keyword_second extends MY_Controller {

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
		
		$data['right_menu'] = $this->right_menu_lib->view('intro_keyword'); //우측메뉴 로딩

		$top_data['add_css'] = array("intro/keyword_02_css");
		$top_data['add_js'] = array("intro/keyword_02_js");

		$this->load->view('top_intro_v',$top_data);
		$this->load->view('intro/keyword_02_main_v', $data);
		$this->load->view('bottom_secend_v');

	}
}
/* End of file main.php */
/* Location: ./application/controllers/ */