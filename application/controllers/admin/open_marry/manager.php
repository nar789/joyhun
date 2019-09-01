<?php
class Manager extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/manager_m');

		admin_check();

	}

	function index()  //관리자 처음화면
	{
		$this->marriage_list();
	}

	function manager_list()  //공개구혼 리스트
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

		//결혼신청 리스트
		$result = $this->my_m->get_list($start, $rp, @$search, 'T_CoupleMarry_OpenguhonMan', 'b_num', 'b_userid', 'desc');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));


		//매니저의 추천회원 리스트
		$search2['b_manager'] = '1';
		$data['manager'] = $this->manager_m->result_array('T_CoupleMarry_OpenguhonMan', $search2);

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/open_marry/manager_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//매니저의 추천회원 등록
	function manager_add(){

		$search_ctn['b_manager'] = '1';

		// 추가할시 3명이 넘는지 검사
		$check = $this->my_m->cnt('T_CoupleMarry_OpenguhonMan', $search_ctn);

		if ($check > 3){ echo '4';exit; };

		$search['b_userid']			= rawurldecode($this->input->post('m_userid',TRUE));
		$search['b_num']			= rawurldecode($this->input->post('m_num',TRUE));

		$test = $this->manager_m->result_array('T_CoupleMarry_OpenguhonMan', $search_ctn);

		// 이미 추천회원인지 검사
		for($i=0; $i<$check-1; $i++){
			if ($test[$i]['b_userid'] == $search['b_userid']){
				echo "8";
				exit;
			}
		}

		$arr_data = array(

			"b_manager"			=> '1',
			"b_manager_date"	=> NOW

		);

		$rtn = $this->my_m->update('T_CoupleMarry_OpenguhonMan', $search, $arr_data);
		echo $rtn;

	}


	//매니저의 추천회원 해제
	function manager_del(){

		$search['b_userid']			= rawurldecode($this->input->post('m_userid',TRUE));
		$search['b_num']			= rawurldecode($this->input->post('m_num',TRUE));

		$arr_data = array(

			"b_manager"			=> NULL,
			"b_manager_date"	=> NULL

		);

		$rtn = $this->my_m->update('T_CoupleMarry_OpenguhonMan', $search, $arr_data);
		echo $rtn;

	}
	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/meeting/beongae.php */