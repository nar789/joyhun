<?php

class My_alarm extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
	}
	
	//알림설정 PC버전
	function alarm_list()
	{

		user_check(null,0);

		if(@$this->session->userdata['m_userid'] == "samdasoo1"){
			$this->load->helper('alrim_helper');
			joyhunting_email_alrim("찜", $this->session->userdata['m_userid'], $this->session->userdata['m_userid']);
		}

		//알림 변경페이지 접속시 알림등록여부 확인
		$a_cnt = auto_member_alrim($this->session->userdata['m_userid']);

		if($a_cnt == "0"){
			alert_goto('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.', '/');
			exit;
		}
		
		//회원 알림 설정 데이터 가져오기
		$data['m_alarm'] = $this->my_m->row_array('set_member_alarm', array('m_userid' => $this->session->userdata['m_userid']));

		$navs = array('프로필','알림'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_chat_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/alarm_v', $data);
		$this->load->view('bottom_v');

	}
	

	//알림설정 모바일 버전
	function alarm_list_mobile(){
		
		//모바일 로그인 체크
		user_check(null,0);

		$this->load->library('m_top_menu_lib');

		//view 설정
	
		$top_data['add_css'] = array();
		$top_data['add_js'] = array("profile/my_chat_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', "알림설정");  //탑메뉴 로딩

		//알림 변경페이지 접속시 알림등록여부 확인
		$a_cnt = auto_member_alrim($this->session->userdata['m_userid']);

		if($a_cnt == "0"){
			alert_goto('잘못된 접근입니다. 관리자에게 문의하시기 바랍니다.', '/');
			exit;
		}
		
		//회원 알림 설정 데이터 가져오기
		$data['m_alarm'] = $this->my_m->row_array('set_member_alarm', array('m_userid' => $this->session->userdata['m_userid']));

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/etc/m_alarm_set_v', @$data);		
		$this->load->view('m/m_bottom0_v');

	}
	

	//알림 변경사항 저장
	function alarm_set(){
		
		user_check(null,0);

		$m_propose_1	= $this->input->post('m_propose_1', true);
		$m_propose_2	= $this->input->post('m_propose_2', true);
		$m_meeting_1	= $this->input->post('m_meeting_1', true);
		$m_meeting_2	= $this->input->post('m_meeting_2', true);
		$m_beongae_1	= $this->input->post('m_beongae_1', true);
		$m_beongae_2	= $this->input->post('m_beongae_2', true);
		$m_jjack_1		= $this->input->post('m_jjack_1', true);
		$m_jjack_2		= $this->input->post('m_jjack_2', true);
		$m_jjim_1		= $this->input->post('m_jjim_1', true);
		$m_jjim_2		= $this->input->post('m_jjim_2', true);
		$m_reg_f1_1		= $this->input->post('m_reg_f1_1', true);
		$m_reg_f1_2		= $this->input->post('m_reg_f1_2', true);
		$m_reg_f2_1		= $this->input->post('m_reg_f2_1', true);
		$m_reg_f2_2		= $this->input->post('m_reg_f2_2', true);
		$m_f_profile_1	= $this->input->post('m_f_profile_1', true);
		$m_f_profile_2	= $this->input->post('m_f_profile_2', true);
		$m_f_beongae_1	= $this->input->post('m_f_beongae_1', true);
		$m_f_beongae_2	= $this->input->post('m_f_beongae_2', true);
		$m_reg_anne_1	= $this->input->post('m_reg_anne_1', true);
		$m_reg_anne_2	= $this->input->post('m_reg_anne_2', true);
		$m_to_anne_1	= $this->input->post('m_to_anne_1', true);
		$m_to_anne_2	= $this->input->post('m_to_anne_2', true);
			
		if($m_propose_1	  <> 'Y'){ $m_propose_1	  = 'N'; }
		if($m_propose_2	  <> 'Y'){ $m_propose_2	  = 'N'; }
		if($m_meeting_1	  <> 'Y'){ $m_meeting_1	  = 'N'; }
		if($m_meeting_2	  <> 'Y'){ $m_meeting_2	  = 'N'; }
		if($m_beongae_1	  <> 'Y'){ $m_beongae_1	  = 'N'; }
		if($m_beongae_2	  <> 'Y'){ $m_beongae_2	  = 'N'; }
		if($m_jjack_1	  <> 'Y'){ $m_jjack_1	  = 'N'; }
		if($m_jjack_2	  <> 'Y'){ $m_jjack_2	  = 'N'; }
		if($m_jjim_1	  <> 'Y'){ $m_jjim_1	  = 'N'; }
		if($m_jjim_2	  <> 'Y'){ $m_jjim_2	  = 'N'; }
		if($m_reg_f1_1	  <> 'Y'){ $m_reg_f1_1	  = 'N'; }
		if($m_reg_f1_2	  <> 'Y'){ $m_reg_f1_2	  = 'N'; }
		if($m_reg_f2_1 	  <> 'Y'){ $m_reg_f2_1 	  = 'N'; }
		if($m_reg_f2_2	  <> 'Y'){ $m_reg_f2_2	  = 'N'; }
		if($m_f_profile_1 <> 'Y'){ $m_f_profile_1 = 'N'; }
		if($m_f_profile_2 <> 'Y'){ $m_f_profile_2 = 'N'; }
		if($m_f_beongae_1 <> 'Y'){ $m_f_beongae_1 = 'N'; }
		if($m_f_beongae_2 <> 'Y'){ $m_f_beongae_2 = 'N'; }
		if($m_reg_anne_1  <> 'Y'){ $m_reg_anne_1  = 'N'; }
		if($m_reg_anne_2  <> 'Y'){ $m_reg_anne_2  = 'N'; }
		if($m_to_anne_1	  <> 'Y'){ $m_to_anne_1	  = 'N'; }
		if($m_to_anne_2	  <> 'Y'){ $m_to_anne_2	  = 'N'; }

		$arrData = array(			
			"m_propose_1"			=> $m_propose_1,
			"m_propose_2"			=> $m_propose_2,
			"m_meeting_1"			=> $m_meeting_1,
			"m_meeting_2"			=> $m_meeting_2,
			"m_beongae_1"			=> $m_beongae_1,
			"m_beongae_2"			=> $m_beongae_2,
			"m_jjack_1"				=> $m_jjack_1,
			"m_jjack_2"				=> $m_jjack_2,
			"m_jjim_1"				=> $m_jjim_1,
			"m_jjim_2"				=> $m_jjim_2,
			"m_reg_f1_1"			=> $m_reg_f1_1,
			"m_reg_f1_2"			=> $m_reg_f1_2,
			"m_reg_f2_1"			=> $m_reg_f2_1,
			"m_reg_f2_2"			=> $m_reg_f2_2,
			"m_f_profile_1"			=> $m_f_profile_1,
			"m_f_profile_2"			=> $m_f_profile_2,
			"m_f_beongae_1"			=> $m_f_beongae_1,
			"m_f_beongae_2"			=> $m_f_beongae_2,
			"m_reg_anne_1"			=> $m_reg_anne_1,
			"m_reg_anne_2"			=> $m_reg_anne_2,
			"m_to_anne_1"			=> $m_to_anne_1,
			"m_to_anne_2"			=> $m_to_anne_2,
			"m_update_day"			=> NOW
		);

		$rtn = $this->my_m->update('set_member_alarm', array('m_userid' => $this->session->userdata['m_userid']), $arrData);

		if($rtn == "1"){
			return "1";		//변경성공
		}else{
			return "0";		//변경실패
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/