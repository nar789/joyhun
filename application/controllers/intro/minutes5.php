<?php

class Minutes5 extends MY_Controller {

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
		if(IS_MOBILE == true){
			//모바일 버전일 경우
			$this->load->view('top0_v',@$top_data);
			$this->load->view('m/etc/minutes5_v', @$data);
		}else{
			//PC 버전일 경우
			$this->load->view('top0_v',@$top_data);
			$this->load->view('intro/minutes5_v', @$data);
		}
	}
}


/* End of file main.php */
/* Location: ./application/controllers/ */