<?php
class Blind extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->model('admin/blind_m');

		admin_check();
	}

	function index()  //관리자 처음화면
	{
		$this->blind_list();
	}

	function blind_list()  //소개팅 리스트
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
		$rp = 40; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'blind_cnt', 'b_idx', 'b_id');  // 소개팅 리스트

		$cnt = count($result[0]);

		// 보낸 좋아요
		for ($i=0; $i<$cnt; $i++){
			$search2['s_userid'] = $result[0][$i]['b_id'];
			$m_result[$i] = $this->my_m->row_array('blind_history', $search2);
	
			if (count(@$m_result[$i]) != 0){	//값이 있으면 보낸좋아요가 있는것
				$data['good'][$i] = $m_result[$i]['r_userid'];
			}else{
				$data['good'][$i] = "NULL";
			}
		}

		// 서로 좋아요
		for ($i=0; $i<$cnt; $i++){

			$search2 = $result[0][$i]['b_id'];
			$mb_result[$i] = $this->blind_m->row_array('blind_history', $search2);

			if (count(@$mb_result[$i][0][0]) != 0){	//값이 있으면 서로좋아요가 없는것
				$data['together'][$i] = $mb_result[$i][0][0]['r_userid'];
			}else{
				$data['together'][$i] = "NULL";
			}
		}


		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];

		$data['blind_total'] = $data['getTotalData']/4;
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit,$data['blind_total']));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/blindmeet/blind_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/