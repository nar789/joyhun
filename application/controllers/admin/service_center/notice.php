<?php

class Notice extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();
	}

	function notice_view(){	// 공지사항 보기

		$data['idx'] = $idx = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));
		$data['notice'] = $this->my_m->row_array("notice_list", array('idx' => $idx) );

		$data['page'] = $page = $this->pre_paging();

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/notice_write_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}


	function notice_write(){	// 공지사항 수정

		$idx = rawurldecode($this->input->post('idx',TRUE));
		$data= array(
			'n_title' => rawurldecode($this->input->post('n_title',TRUE)),
			'n_content' => rawurldecode($this->input->post('n_content',TRUE)),
			'sel1' => rawurldecode($this->input->post('sel1',TRUE)),
			"nick"		=> $this->session->userdata('nickname'),
			"userid"		=> $this->session->userdata('userid'),
			'n_date' => NOW
		);
		
		if(@$idx){
			$rtn = $this->my_m->update("notice_list", array('idx' => $idx), $data);
		}else{
			$rtn = $this->my_m->insert("notice_list", $data);
		}

		echo $rtn;		//정상등록
	}

	function notice_del(){	// 공지사항 삭제

		$idx = rawurldecode($this->input->post('idx',TRUE));
			
		$rtn = $this->my_m->del('notice_list', array('idx' => $idx));
		echo $rtn;

	}

	
	function notice_list()  //공지사항 리스트
	{
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$search["ex_".$data['method']] = $data['method']." like '%".$data['s_word']."%'";
		}

		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'notice_list', 'idx', 'desc', '*'); //FAQ 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));


		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/notice_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}
}