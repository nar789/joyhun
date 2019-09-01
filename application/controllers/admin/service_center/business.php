<?php
class Business extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/business_m');

		admin_check();
	}
	
	function index(){
		$this->event_list();
	}

	//관리자 페이지
	function business_list(){
		
		//검색조건 변수받기
		$data['v'] = $v = rawurldecode($this->input->post('v_search', true));
		$data['q'] = $q = rawurldecode($this->input->post('q', true));
		
		if(!@empty($v)){
			if($v == "m_idx"){
				$search['ex_v'] = $v." = ".$q;
			}else{
				$search['ex_v'] = $v." like '%".$q."%' ";
			}
		}		

		//페이징 변수
		//이벤트
		$page = $data['page'] = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->business_m->event_list($start, $rp, @$search, 'business_call');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/business_v', $data);
		$this->load->view('admin/admin_bottom_v');


	}
	


	function business_view(){	// 보기

		$data['idx'] = $idx = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));
		$data['bu'] = $this->my_m->row_array("business_call", array('idx' => $idx) );

		$data['page'] = $page = $this->pre_paging();

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/business_view_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}



}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */