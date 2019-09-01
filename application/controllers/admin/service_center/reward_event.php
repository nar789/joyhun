<?php
class Reward_event extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/event_m');

		admin_check();
	}
	

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성회원 전용 리워드 이벤트 관련 관리자 페이지
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	//여성회원 리워드 이벤트 통계
	function reward_event_stat(){
		
		$m_year		= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//년
		$m_month	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//월

		if(empty($m_year)){ $m_year = date('Y'); }			//년도가 없을 경우 초기화
		if(empty($m_month)){ $m_month = date('m'); }		//월이 없을 경우 초기화

		$this_month = $m_year."-".$m_month."-01";			//해당달의 1일 초기화

		$data['m_year']		= $m_year;
		$data['m_month']	= $m_month;
		
		//해달 달의 결제 통계 데이터 가져오기
		$data['mlist'] = $this->event_m->reward_event_list($this_month);
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/reward_event_stat_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}



}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */