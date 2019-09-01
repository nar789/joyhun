<?php

class Open_marry extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('open_marry_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('alrim_helper');

	}


	function open_guhon_list()
	{
		user_check(null,0);

		$uri_array = $this->seg_exp;

		//검색조건 
		$data['m_type']				= $search2['m_marry']		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_type')));
		$data['m_conregion']		= $search2['m_conregion']	= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_conregion')));
		$data['m_sex']				= $search2['m_sex']			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_sex')));
		$data['m_age']				= $search2['m_age']			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_age')));
	
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->open_marry_m->open_guhon_list($start, $rp, @$search, @$search2); //공개구혼 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		$navs = array('공개구혼','공개구혼'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('marry',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('secret_talk'); //우측메뉴 로딩

		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_search'] = $this->call_search(@$data); //공개구혼 검색

		$top_data['add_css'] = array("open_marry/marry_css","main_css");
		$top_data['add_js'] = array("open_marry/open_marry_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('open_marry/open_marry_v', $data);
		$this->load->view('bottom_v');


	}

	function call_top(){
		//본문 상단
		ob_start();
		
		$this->load->view('open_marry/open_marry_top_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_search($data){
		//공개구혼 검색
		ob_start();
		
		$this->load->view('open_marry/open_marry_search_v', @$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	//공개구혼 등록하기
	function reg_open_guhon(){

		user_check(null,9,"exit");

		$search['m_mobile_chk'] = '1';
		$search['m_userid'] = $this->session->userdata['m_userid'];

		$pay_chk = $this->my_m->cnt('TotalMembers', $search);
		if ($pay_chk == 0){ echo "44"; exit; }

		$data['b_userid']			= $this->session->userdata['m_userid'];
		$data['b_type']				= rawurldecode($this->input->post('b_type', true)); 
		$data['b_content']			= strip_tags(rawurldecode($this->input->post('b_content', true))); 

		$data['mlist'] = $this->member_lib->get_member($data['b_userid']);		//회원정보

		$arr_data = array(

			"b_userid"			=> $data['b_userid'],
			"b_type"			=> $data['b_type'],
			"b_content"			=> $data['b_content'],
			"b_nick"			=> $data['mlist']['m_nick'],
			"b_age"				=> $data['mlist']['m_age'],
			"b_ageyear"			=> date('Y') - $data['mlist']['m_age'] +1,
			"b_sex"				=> $data['mlist']['m_sex'],
			"b_region"			=> $data['mlist']['m_conregion'],
			"b_writedate"		=> NOW

		);
		
		$rtn = $this->my_m->insert('T_CoupleMarry_OpenguhonMan', $arr_data);

		echo $rtn;

	}

	//공개구혼 프로포즈 보내기
	function reg_propose(){

		//로그인 여부 체크
		user_check();

		$data['m_userid']			= rawurldecode($this->input->post('m_userid', true)); 
		$data['m_type']				= rawurldecode($this->input->post('m_type', true)); 
		$data['m_content']			= strip_tags(rawurldecode($this->input->post('m_content', true))); 
		$data['p_userid']			= rawurldecode($this->input->post('p_userid', true)); 
		$data['p_idx']				= rawurldecode($this->input->post('p_idx', true)); 
		$data['p_age']				= rawurldecode($this->input->post('p_age', true)); 
		$data['p_conregion']		= rawurldecode($this->input->post('p_conregion', true)); 
		$data['p_conregion2']		= rawurldecode($this->input->post('p_conregion2', true)); 

		$data['mlist'] = $this->member_lib->get_member($data['m_userid']);

		$arr_data = array(

			"m_userid"		=> $data['m_userid'],
			"m_gubn"		=> $data['m_type'],
			"m_content"		=> $data['m_content'],
			"m_nick"		=> $data['mlist']['m_nick'],
			"m_age"			=> $data['mlist']['m_age'],
			"m_sex"			=> $data['mlist']['m_sex'],
			"m_conregion"	=> $data['mlist']['m_conregion'],
			"m_conregion2"	=> $data['mlist']['m_conregion2'],
			"p_userid"		=> $data['p_userid'],
			"p_idx"			=> $data['p_idx'],
			"m_writedate"	=> NOW,
			"p_age"			=> $data['p_age'],
			"p_conregion"	=> $data['p_conregion'],
			"p_conregion2"	=> $data['p_conregion2']

		);

		$rtn = $this->my_m->insert('open_marry_propose', $arr_data);
		
		if($rtn == "1"){
			//프로포즈 보내기 알림 alrim_helper
			joyhunting_alrim('프로포즈', $arr_data['p_userid'], $arr_data['m_userid']);

			//조이헌팅 이메일 알림 추가 alrim_helper
			joyhunting_email_alrim('프로포즈', $arr_data['p_userid'], $arr_data['m_userid']);
		}

		echo $rtn;


	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/