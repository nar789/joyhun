<?php

class User_super_chat_log extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change_helper');
		$this->load->library('member_lib');

		admin_check();
	}
	
	function index(){
		$this->chat_list();
	}

	function chat_list(){

		$uri_array = $this->seg_exp;

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//사용자 슈퍼채팅 로그 리스트 가져오기
		$result = $this->my_m->get_list($start, $rp, @$search, 'USER_SU_CHAT_LOG', 'V_IDX', 'V_SEND_ID', 'DESC', '*');

		$data['mlist']			= $result[0];
		$data['getTotalData']	= $result[1];

		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/user_super_chat_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	
}