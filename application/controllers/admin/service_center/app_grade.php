<?php
class App_grade extends MY_Controller {

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

	function event_list(){

		//검색조건 변수받기
		$data['v'] = $v = rawurldecode($this->input->post('v_search', true));
		$data['q'] = $q = rawurldecode($this->input->post('q', true));
		
		if(!@empty($v)){
			$search['ex_v'] = $v." = '".$q."'";
		}	

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list($start, $rp, @$search, 'app_grade_event', 'write_date', 'user_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/app_grade_event_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//업로드 파일보기
	function user_upload_pic(){

		$user_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id'));		//선택회원 아이디

		$data = $this->my_m->row_array('app_grade_event', array('user_id' => $user_id), 'write_date', 'desc', '1');
		
		$this->load->view('admin/layer_popup/app_grade_upload_pic_v', @$data);
	}

	//삭제하기
	function user_del(){
		
		$user_id = $this->input->post('user_id', true);
		if(empty($user_id)){ echo "1000"; exit; }

		$rtn = $this->my_m->del('app_grade_event', array('user_id' => $user_id));

		echo $rtn;
	}

	//상태수정
	function user_up(){
		
		$user_id = $this->input->post('user_id', true);
		$rc_use_yn = $this->input->post('rc_use_yn', true);

		if(empty($user_id)){ echo "1000"; exit; }

		$rtn = $this->my_m->update('app_grade_event', array('user_id' => $user_id), array('rc_use_yn' => $rc_use_yn));

		echo $rtn;
	}

	



}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */