<?php
class Ideal_type extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/a_member_m');
		$this->load->model('admin/ideal_m');

		admin_check();
	}


	function ideal_list()  //추천이상형 리스트
	{
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->ideal_m->ideal_list($start, $rp, @$search, 'TotalMembers', 'm_num', 'm_userid', 'desc');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//추천이상형 리스트 ( 남자 )
		$search_m['m_sex'] = "M";
		$search_m['m_main_chu'] = '1';
		$search_m['ex_m_chu'] = 'm_main_chu_date IS NOT NULL';
		$data['m_ideal'] = $this->ideal_m->result_array('TotalMembers', $search_m,'m_userid');

		//추천이상형 리스트 ( 여자 )
		$search_f['m_sex'] = "F";
		$search_f['m_main_chu'] = '1';
		$search_f['ex_m_chu'] = 'm_main_chu_date IS NOT NULL';
		$data['f_ideal'] = $this->ideal_m->result_array('TotalMembers', $search_f);

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/profile/ideal_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	//추천이상형 등록
	function manager_add(){

		$search_ctn['m_sex']			= rawurldecode($this->input->post('m_sex',TRUE));
		$search_ctn['m_main_chu'] = '1';

		// 추가할시 3명이 넘는지 검사
		$check = $this->my_m->cnt('TotalMembers', $search_ctn);

		if ($check >= 3){ echo '4'; exit; };

		$find_use = rawurldecode($this->input->post('m_userid',TRUE));

		$search['m_sex'] = $search_ctn['m_sex'];
		$search['m_main_chu'] = '1';
		$search['ex_m_chu'] = 'm_main_chu_date IS NOT NULL';

		$test = $this->ideal_m->result_array('TotalMembers', $search);

		// 이미 추천회원인지 검사
		for($i=0; $i<$check; $i++){
	
			if ($test[$i]['m_userid'] == $find_use){
				echo "8";
				exit;
			}
		}

		// 이상없으면 추천이상형으로 등록
		$search_final['m_userid'] = $find_use;
		$arr_data = array(

			"m_main_chu"			=> '1',
			"m_main_chu_date"		=> NOW

		);

		$rtn = $this->my_m->update('TotalMembers', $search_final, $arr_data);
		echo $rtn;

	}



	//매니저의 추천회원 해제
	function manager_del(){

		$search['m_userid']			= rawurldecode($this->input->post('m_userid',TRUE));
		$search['m_num']			= rawurldecode($this->input->post('m_num',TRUE));

		$arr_data = array(

			"m_main_chu"			=> NULL,
			"m_main_chu_date"		=> NULL

		);

		$rtn = $this->my_m->update('TotalMembers', $search, $arr_data);
		echo $rtn;

	}



}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */