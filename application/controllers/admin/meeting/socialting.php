<?php
class Socialting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();

	}

	function index()  //관리자 처음화면
	{
		$this->social_list();
	}

	function social_list()  //소셜팅 리스트
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

		$result = $this->my_m->get_list($start, $rp, @$search, 'T_sns_event', 'm_idx', 'm_userid'); //소셜팅 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

	
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/meeting/socialting_list_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//소셜팅 삭제
	function social_del(){

		$data['m_idx']			= rawurldecode($this->input->post('m_idx',TRUE));
		$data['m_userid']		= rawurldecode($this->input->post('m_userid',TRUE));

		$arr_data = array(
			"m_idx"				=> $data['m_idx'],
			"m_userid"			=> $data['m_userid']
		);

		$rtn = $this->my_m->del('T_sns_event',$arr_data);

		echo $rtn;
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/meeting/ */