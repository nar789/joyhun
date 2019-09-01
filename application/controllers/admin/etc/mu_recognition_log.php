<?php
class Mu_recognition_log extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/payment_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->library('member_lib');

		admin_check();

	}
	
	//관리자 처음화면
	function index()  
	{
		$this->log_list();
	}
	
	function log_list(){
		
		$data['sfl']	 = $sfl		= $this->input->post('sfl', true); 
		$data['q']		 = $q		= $this->input->post('q', true); 
		
		//이름검색 like
		if(!empty($sfl) and !empty($q)){
			$search['ex_data_1'] = "result like '%".$q."%'";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'mu_sms_log', 'idx', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/mu_log_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	//비고 업데이트 함수
	function log_etc_save(){
		
		$v_idx = rawurldecode($this->input->post('idx', true));		//순번
		$v_etc = rawurldecode($this->input->post('etc', true));		//비고

		if(empty($v_idx)){ echo "1000"; exit;}						//잘못된 접근

		if(empty($v_etc)){ $v_etc = null; }

		$rtn = $this->my_m->update('mu_sms_log', array('idx' => $v_idx), array('etc' => $v_etc));

		echo $rtn;
		
	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/