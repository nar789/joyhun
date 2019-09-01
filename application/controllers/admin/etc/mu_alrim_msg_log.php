<?php
class Mu_alrim_msg_log extends MY_Controller {

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
		
		//아이디검색 like
		if(!empty($sfl) and !empty($q)){
			$search['ex_data_1'] = "result like '%".$q."%'";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'mu_alrim_log', 'idx', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/mu_alrim_log_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/