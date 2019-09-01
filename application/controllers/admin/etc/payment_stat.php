<?php
class Payment_stat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/payment_stat_m');

		admin_check();

	}

	function index(){
		$this->payment_stat_view();
	}
	
	//결제 통계페이지
	function payment_stat_view(){

		$m_year		= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//년
		$m_month	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//월

		if(empty($m_year)){ $m_year = date('Y'); }			//년도가 없을 경우 초기화
		if(empty($m_month)){ $m_month = date('m'); }		//월이 없을 경우 초기화

		$this_month = $m_year."-".$m_month."-01";			//해당달의 1일 초기화

		$data['m_year']		= $m_year;
		$data['m_month']	= $m_month;
		
		//해달 달의 결제 통계 데이터 가져오기
		$data['total_sales'] = $this->payment_stat_m->total_sales($this_month);
		$mlist = $this->payment_stat_m->from_to_date($this_month);

		$data['mlist']			= $mlist[0];		//결제내역 데이터
		$data['getTotalData']	= $mlist[1];		//이달의 총 결제 성공 건수

		$data['TOTAL_HP1'] = "0";		//PC결제 휴대전화 결제 초기화
		$data['TOTAL_CD1'] = "0";		//PC결제 신용카드 결제 초기화
		$data['TOTAL_BK1'] = "0";		//PC결제 가상계좌 결제 초기화
		$data['TOTAL_AC1'] = "0";		//PC결제 계좌이체 결제 초기화
		$data['TOTAL_MU1'] = "0";		//PC결제 무통장입금 결제 초기화
		$data['TOTAL_TP1'] = "0";		//PC결제 ARS(걸기) 결제 초기화
		$data['TOTAL_PB1'] = "0";		//PC결제 ARS(받기) 결제 초기화
		$data['TOTAL_HP2'] = "0";		//모바일결제 휴대전화 결제 초기화
		$data['TOTAL_CD2'] = "0";		//모바일결제 신용카드 결제 초기화
		$data['TOTAL_MU2'] = "0";		//모바일결제 무통장입금 결제 초기화
		$data['TOTAL_GG'] = "0";			//APP 구글인앱 결제 초기화
		$data['TOTAL_HP3'] = "0";		//APP 휴대전화 결제 초기화
		$data['TOTAL_CD3'] = "0";		//APP 신용카드 결제 초기화
		$data['TOTAL_MU3'] = "0";		//APP 무통장입금 결제 초기화
		$data['TOTAL_ALL'] = "0";		//이달의 총결제 금액 초기화
		$data['TOTAL_CNT'] = "0";		//이달의 총결제 건수
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/payment_stat_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/