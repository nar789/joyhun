<?php

class Add_menu extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('m_top_menu_test_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('level_helper');
	}
	
	function index(){
		goto('/');
	}

	function index_mobile(){

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		//로그인 체크
		user_check(null,0);

		//회원정보가져오기
		$data['member_data'] = $this->member_lib->get_member($this->session->userdata['m_userid']);

		//조이매거진 랜덤리스트(2개)
		$data['magazine_list'] = $this->main_m->joy_magazine_rand_list();
		
		//view 설정
		$top_data['add_css'] = array("/m/m_add_menu_css");
		$top_data['add_js'] = array("/m/m_add_menu_js");
	
		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩
	
		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/etc/m_add_menu_v',@$data);
		$this->load->view('m/m_bottom_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */