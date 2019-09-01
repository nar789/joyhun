<?php

class Profile_view extends MY_Controller {

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
		
		$top_data['add_css'] = array("/m/m_profile_css","/m/profile/m_profile_view_css");
		$top_data['add_js'] = array("/m/m_profile_js","/m/m_blindmeet_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"완다엄마냐오오옹 님"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/profile/profile/m_profile_view_v',@$data);
		$this->load->view('m/m_bottom0_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */