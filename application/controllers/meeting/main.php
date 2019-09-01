<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->model('meeting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index()
	{
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		$navs = array('미팅신청','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/main_js");

		$bot_data['add_script'] = '<script>';

		//연극/영화 -> 5, 기타 -> 14, 스포츠 -> 2,  드라이브 -> 10
		$b_interest = array('5','14','2','10');
		$cnt = 0;

		foreach ($b_interest as $k => $v) { 
			$search['b_interest'] = $v; 
			$main_met = $this->meeting_m->main_live_met('T_MeetingDate_Bun',$search,'6','b_date','b_userid');

			$val = $main_met[0];

			for ($i=0; $i<6; $i++){

				$b_intro = trim_text($val[$i]['b_intro'],40);
				$b_intro = str_replace("\n","",$b_intro);
				$b_intro = str_replace("\r","",$b_intro);

				$bot_data['add_script'] .=
				'mdata["'.$cnt.'"]["'.$i.'"]=["'.$this->member_lib->member_thumb($val[$i]['b_userid'],130,168).'","'.$val[$i]['m_nick'].'","'.$val[$i]['b_age'].'세","'.interest_text($val[$i]['b_interest']).'","'.$val[$i]['b_region'].'","'.str_replace("-",".",$val[$i]['b_day']).'","'.$b_intro.'","'.$val[$i]['idx'].'","'.$val[$i]['b_userid'].'"];';	
			}

			$cnt++;
		}

		$bot_data['add_script'] .= '</script>';


		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/main_v', $data);
		$this->load->view('bottom_v',$bot_data);
	}

	function find_mb()
	{

		$userchk = @$this->session->userdata('m_userid');

		// 로그인 안했으면
		if ($userchk == NULL){
			
			echo "4";
		
		// 로그인 후면 검색
		} else {

			$cate	= rawurldecode($this->input->post('m_cate',TRUE));
			$val	= rawurldecode($this->input->post('m_val',TRUE));
			
			$search[$cate] = $val;

			$chk = $this->my_m->row_array('TotalMembers', $search);

			if (count($chk) == 0){ echo "8"; return false; }

			echo $chk['m_userid'];

		};
	
	}




	function area_meeting_mb()
	{
		$m_conregion	= rawurldecode($this->input->post('search',TRUE));

		$area_cnt = $this->meeting_m->area_cnt($m_conregion);

		echo $area_cnt;
	}


}

/* End of file main.php */
/* Location: ./application/controllers/ */