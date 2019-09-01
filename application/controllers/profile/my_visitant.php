<?php

class My_visitant extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
	}

	function index()
	{

		user_check();

		$navs = array('프로필','채팅함'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_visitant_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/my_visitant_v', $data);
		$this->load->view('bottom_v');
	}

	//프로필 방문자 화면에서 선택삭제
	function v_list_remove(){
		
		$v_table = "profile_visit";
		
		$data['idx']		= rawurldecode($this->input->post('idx', true));			//인덱스번호
		
		$arr_data = array(
			"idx"			=> $data['idx'],
			"user_id"		=> $this->session->userdata('m_userid')

		);

		$rtn = $this->my_m->del($v_table, $arr_data);

		echo $rtn;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/