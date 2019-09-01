<?php
class Event_love extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change_helper');
		$this->load->library('member_lib');
		$this->load->model('admin/event_m');

		admin_check();
	}
	
	function index(){
		$this->event_list();
	}

	
	function event_list(){

		$data['v_search']	= $v_search		= $this->input->post('v_search', true);
		$data['q']			= $q			= $this->input->post('q', true);

		//페이징 변수
		//이벤트
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->event_m->event_love_list($start, $rp, $v_search, $q);

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/event_love_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}
	

	//삭제
	function event_love_del(){

		$idx = $this->input->post('idx', true);
		if(empty($idx)){ echo "1000"; exit; }

		$rtn = $this->my_m->del('event_love_list', array('idx' => $idx));

		echo $rtn;
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */