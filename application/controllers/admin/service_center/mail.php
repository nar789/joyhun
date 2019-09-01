<?php
class Mail extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();
	}

	function mail_list(){
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}
		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = $data['rp'] = 15; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'mail_cnt', 'em_idx');

		$data['mlist'] = $result[0];

		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/mail_v', @$data);
		$this->load->view('admin/admin_bottom_v');


	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */