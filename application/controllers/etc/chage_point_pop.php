<?php

class Chage_point_pop extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}


	function test()
	{


		@$chk_id = $this->session->userdata['m_userid'];
		if(!$chk_id){ exit; }

		$return = "Sdfsdf,";

		if($chk_id == 'wldnwlaktpdy'){
			$return .= "1";
		}

		echo $return;

	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */