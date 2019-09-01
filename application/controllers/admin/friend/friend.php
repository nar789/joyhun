<?php
class Friend extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');

		admin_check();
	}

	function index()  //관리자 처음화면
	{
		$this->friend_list();
	}

	function friend_list()  //친구만들기 PR 리스트
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

		$result = $this->my_m->get_list($start, $rp, @$search, 'T_MakeFriend_PR', 'm_idx', 'm_userid');  //친구만들기 PR 리스트
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/friend/friend_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//친구만들기 리스트 삭제
	function del_friend(){

		$m_idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_idx')));
		
		$rtn = $this->my_m->del('T_MakeFriend_PR',array('m_idx' => $m_idx));

		echo $rtn;
	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */