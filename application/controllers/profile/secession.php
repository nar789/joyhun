<?php

class Secession extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('profile_m');
		$this->load->library('tank_auth');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');	
	}
	
	//PC탈퇴페이지
	function index()
	{

		user_check(null,0);

		$navs = array('프로필','내정보관리'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/secession_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/secession_v', $data);
		$this->load->view('bottom_v');
	}

	//모바일탈퇴페이지
	function index_mobile(){

		//모바일 로그인 체크
		user_check(null,0);

		$this->load->library('m_top_menu_lib');

		//view 설정

		$top_data['add_css'] = array("/m/m_secession_m_css");
		$top_data['add_js'] = array("/m/m_secession_m_js", "profile/secession_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"탈퇴"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/etc/m_secession_m_v', @$data);
		$this->load->view('m/m_bottom0_v');
	}


	//탈퇴처리
	function total_mem_out(){

		user_check(null,0);			//로그인 여부 체크

		$m_pwd					= rawurldecode($this->input->post('m_pwd', true));
		$m_reason				= rawurldecode($this->input->post('m_reason', true));
		$m_reason_content		= rawurldecode($this->input->post('m_reason_content', true));

		$week = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");	//오늘요일

		$pwd_rtn = $this->member_lib->password_check($m_pwd);		//패스워드확인
		if($pwd_rtn == "1"){
			
			$user_id = $this->session->userdata['m_userid'];
			if(empty($user_id)){ return "false"; }
			
			$secession_rtn = $this->profile_m->member_secession($user_id, $m_reason, $m_reason_content);		//탈퇴처리 

			if($secession_rtn == "1"){
				$rtn = "true";
			}else{
				$rtn = "false";
			}
	
		}else{
			$rtn = "false";		//입력패스워드가 틀릴경우 false를 반환
		}

		echo $rtn;

	}

	//탈퇴완료처리
	function member_destroy(){

		delete_cache("TotalMembers_login");		//탈퇴시 캐시 삭제

		$this->tank_auth->logout();
		redirect('', 'refresh');

	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/