<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->model('open_marry_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}

	function index()
	{

		// 로그인했으면 실제매칭회원
		if (IS_LOGIN){

			$sex_check = $this->session->userdata['m_sex'];
			$check = $this->session->userdata['m_age'];
			$check_me = $this->session->userdata['m_userid'];

			if ($sex_check == "F"){
				$search['b_sex'] = "M";
			}else{
				$search['b_sex'] = "F";
			}

			$today_result = $this->open_marry_m->today_mb($check,$check_me,$search);
			$data['today'] = @$today_result[0];
			
			member_session_up(); //latest_helper 세션값 업데이트 
			
		// 아니면 고정데이터
		}else{

			$search['b_userid'] = "aerang";
			$data['today'] = $this->my_m->row_array('T_CoupleMarry_OpenguhonMan', $search);

		}

		//매니저의 추천 회원
		$search_mana['b_manager'] = '1';
		$data['manager'] =  $this->open_marry_m->result_array('T_CoupleMarry_OpenguhonMan', $search_mana, '', '', '3');

		$navs = array('공개구혼','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('marry',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('secret_talk'); //우측메뉴 로딩

		$top_data['add_css'] = array("open_marry/marry_css","main_css","meeting/main_css");
		$top_data['add_js'] = array("open_marry/main_js","main_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('open_marry/main_v', $data);
		$this->load->view('bottom_v');
	}


	function paychk(){

		$serach['m_mobile_chk'] = '1';
		$serach['m_userid'] = $this->session->userdata['m_userid'];

		$pay_chk = $this->my_m->cnt('TotalMembers', $search);
		return $pay_chk;

	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/