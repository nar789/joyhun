<?php
class Cs extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('my_m');
		$this->load->model('admin/cs_m');

		admin_check();
	}


	function cs_question()  //CS 리스트
	{
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'T_Consult_Admin', 'm_idx');  // CS 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		$data['user'] = $this->session->userdata('username');
		
		$this->load->view('admin/admin_top_v');
		//$this->load->view('admin/service_center/consult_list_v',$data);
		$this->load->view('admin/service_center/cs_list_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}

	function username_chk(){

		$search['m_userid'] = rawurldecode($this->input->post('m_userid',TRUE));

		// 존재하는 유저인지 확인
		$user_cnt = $this->my_m->row_array('TotalMembers', $search);
		$cnt = count($user_cnt);

		// 존재하면 이름+핸드폰번호추가, 없으면 alert
		if ($cnt > 0){
			echo $user_cnt['m_name']."|".$user_cnt['m_hp1'].$user_cnt['m_hp2'].$user_cnt['m_hp3'];
		}else{
			echo "4";
		}
	}

	// 등록
	function cs_add(){

		$m_idx = $this->cs_m->max_cnt("T_Consult_Admin");

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

		$rtn = $this->my_m->insert('T_Consult_Admin', $data_array);
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

		$rtn = $this->my_m->update('T_Consult_Admin', $search, $data_array);
		echo $rtn;
	}

	// 삭제
	function cs_del(){

		$search['m_idx'] = rawurldecode($this->input->post('m_idx',TRUE));
		$rtn = $this->my_m->del('T_Consult_Admin', $search);
		echo $rtn;
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */