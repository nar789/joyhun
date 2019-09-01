<?php

class Test extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change_helper');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->model('my_m');
		$this->load->model('admin/cs_m');


		admin_check();
	}
	


	function index()  //금지아이디 설정
	{
		$banned_id['banned'] = $this->my_m->row_array("admin_test", array('idx' => 1) );

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/test_v',$banned_id);
		$this->load->view('admin/admin_bottom_v');
	}

	function banned_modi()  //금지아이디 저장
	{
		$data = array(
			'banned_id' => rawurldecode($this->input->post('banned_id',TRUE))
		);

		$rtn = $this->my_m->update("admin_test", array('idx' => 1), $data);
		
		echo $rtn;
	}

	function banned_modi_nick()  //금지닉네임 저장
	{
		$data = array(
			'banned_nick' => rawurldecode($this->input->post('banned_nick',TRUE))
		);

		$rtn = $this->my_m->update("admin_test", array('idx' => 1), $data);
		
		echo $rtn;
	}

	function cs_question_second()  //리스트
	{

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) ){

			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			
			$search = array(
				$data['method'] => $data['s_word']
			);
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'admin_test2', 'm_idx');  // CS 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		$data['user'] = $this->session->userdata('username');
		
		$this->load->view('admin/admin_top_v');
		//$this->load->view('admin/service_center/consult_list_v',$data);
		$this->load->view('admin/admin_setting/test2_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}

	// 등록
	function cs_add(){

		$m_idx = $this->cs_m->max_cnt("admin_test2");

		$m_consult_sel		 = rawurldecode($this->input->post('m_consult_sel',TRUE));
		$m_consult_id		 = rawurldecode($this->input->post('m_consult_id',TRUE));
		$m_consult_name		 = rawurldecode($this->input->post('m_consult_name',TRUE));
		$m_consult_hp		 = rawurldecode($this->input->post('m_consult_hp',TRUE));
		$m_consult_comment	 = rawurldecode($this->input->post('m_consult_comment',TRUE));
		$m_consult_add		 = rawurldecode($this->input->post('m_consult_add',TRUE));
		$m_consult_results	 = rawurldecode($this->input->post('m_consult_results',TRUE));
		$m_jinsang_point	 = rawurldecode($this->input->post('m_jinsang_point',TRUE));
		$m_admin_name		 = $this->session->userdata('username');

		$data_array = array(
			'm_idx'				 => $m_idx,
			'm_consult_sel'		 => $m_consult_sel,
			'm_consult_id'		 => @$m_consult_id,
			'm_consult_name'	 => @$m_consult_name,
			'm_consult_hp'		 => @$m_consult_hp,
			'm_consult_comment'	 => $m_consult_comment,
			'm_consult_add'		 => $m_consult_add,
			'm_consult_results'	 => $m_consult_results,
			'm_jinsang_point'	 => $m_jinsang_point,
			'm_admin_name'		 => $m_admin_name,
			'm_admin_date'	     => NOW
		);

		$rtn = $this->my_m->insert('admin_test2', $data_array);
		echo $rtn;
		
	}


	// 수정
	function cs_modi(){

		
		$search['m_idx']	 = rawurldecode($this->input->post('m_idx',TRUE));
		$m_consult_sel		 = rawurldecode($this->input->post('m_consult_sel',TRUE));
		$m_consult_id		 = rawurldecode($this->input->post('m_consult_id',TRUE));
		$m_consult_name		 = rawurldecode($this->input->post('m_consult_name',TRUE));
		$m_consult_hp		 = rawurldecode($this->input->post('m_consult_hp',TRUE));
		$m_consult_comment	 = rawurldecode($this->input->post('m_consult_comment',TRUE));
		$m_consult_add		 = rawurldecode($this->input->post('m_consult_add',TRUE));
		$m_consult_results	 = rawurldecode($this->input->post('m_consult_results',TRUE));
		$m_jinsang_point	 = rawurldecode($this->input->post('m_jinsang_point',TRUE));

		$data_array = array(
			'm_consult_sel'		 => $m_consult_sel,
			'm_consult_id'		 => @$m_consult_id,
			'm_consult_name'	 => @$m_consult_name,
			'm_consult_hp'		 => @$m_consult_hp,
			'm_consult_comment'	 => $m_consult_comment,
			'm_consult_add'		 => $m_consult_add,
			'm_consult_results'	 => $m_consult_results,
			'm_jinsang_point'	 => $m_jinsang_point,
			'm_admin_date'	 => NOW
		);

		$rtn = $this->my_m->update('admin_test2', $search, $data_array);
		echo $rtn;
	}

	// 삭제
	function cs_del(){

		$search['m_idx'] = rawurldecode($this->input->post('m_idx',TRUE));
		$rtn = $this->my_m->del('admin_test2', $search);
		echo $rtn;
	}

}
