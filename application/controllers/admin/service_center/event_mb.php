<?php
class Event_mb extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/event_m');

		admin_check();
	}
	
	function index(){
		$this->event_list();
	}

	//관리자 페이지 당첨자 등록 리스트
	function event_list(){
		
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

		$data['m_type'] = "frmList";

		//페이징 변수
		//당첨자
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->event_m->event_list($start, $rp, @$search, 'reg_event_member');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/event_mb_v', $data);
		$this->load->view('admin/admin_bottom_v');


	}



	//관리자 페이지 당첨자 등록/수정 페이지
	function event_mb_write(){

		$m_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_idx')));		//게시물번호 받아오기
		
		if(!@empty($m_idx)){
			$data = $this->my_m->row_array('reg_event_member', array('m_idx' => $m_idx));		//등록된 당첨자 내용 가져오기
			$data['m_type'] = "frmView";
		}else{
			$data['m_type'] = "frmWrite";
		}	

		//view 설정
		$top_data['add_js'] = array("naver/HuskyEZCreator");

		$this->load->view('admin/admin_top_v', $top_data);
		$this->load->view('admin/service_center/event_mb_write_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}


	
	//당첨자 등록하기
	function reg_event_mb_data(){
		
		$fname			= rawurldecode($this->input->post('fname', true)); 
		$m_idx			= rawurldecode($this->input->post('m_idx', true)); 
		$m_start_day	= rawurldecode($this->input->post('m_start_day', true)); 
		$m_last_day		= rawurldecode($this->input->post('m_last_day', true)); 
		$m_title		= rawurldecode($this->input->post('m_title', true)); 
		$m_contents		= rawurldecode($this->input->post('m_contents', true)); 
		
		$v_table = "reg_event_member";		//당첨자 등록 테이블

		if(empty($m_idx) || $m_idx == ""){
			$m_idx = $this->event_m->event_idx($v_table);		//첫 당첨자 동록이나 신규등록일경우 m_idx 값 추가
		}
		
		$arrData = array(
			"m_idx"				=> $m_idx,
			"m_title"			=> $m_title,
			"m_contents"		=> $m_contents,
			"m_write_day"		=> date('Y-m-d'),
			"m_start_day"		=> $m_start_day,
			"m_last_day"		=> $m_last_day
		);

		if($fname == "frmWrite"){
			//당첨자 신규등록
			$rtn = $this->my_m->insert($v_table, $arrData);

			if($rtn == "1"){
				echo "1";		//성공
			}else{
				echo "0";		//실패
			}

		}else if($fname == "frmView"){
			//당첨자 수정
			$rtn = $this->my_m->update($v_table, array("m_idx" => $m_idx), $arrData);

			if($rtn == "1"){
				echo "1";		//성공
			}else{
				echo "0";		//실패
			}
		}else{
			//잘못된 접근
			echo "9";
		}
		
	}

	//당첨자 삭제하기 
	function del_mb_event(){
		
		$m_idx			= rawurldecode($this->input->post('m_idx', true));	//삭제할 게시물 번호

		$rtn = $this->my_m->del('reg_event_member', array('m_idx' =>  $m_idx));

		if($rtn == "1"){
			echo "1";		//성공
		}else{
			echo "9";		//실패
		}
	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */