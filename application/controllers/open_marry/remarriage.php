<?php

class Remarriage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('open_marry_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');

	}

	function remarriage_list()
	{
		user_check(null,0);
		
		$uri_array = $this->seg_exp;

		// 추천나이로 검색
		if ($this->security->xss_clean(@url_explode($this->seg_exp, 'm_search')) == 'm_age'){

			$cut_age = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_age')));
			$search['ex_m_age'] = "T_CoupleMarry_ReMarryMan.m_age like '".$cut_age."%'";
				

		// 추천직업으로 검색
		}else if ($this->security->xss_clean(@url_explode($this->seg_exp, 'm_search')) == 'm_search_job'){

			$table_check = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'marry_type')));
			$search['T_CoupleMarry_ReMarryMan.m_job'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_job')));
				
		
		}else{

			$data['marry_type']		= $search2['m_marry'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'marry_type')));			
			$data['m_conregion']	= $search2['m_conregion'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_conregion')));		
			$data['m_age']		    = $search2['m_age'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_age')));		
			$data['file_ok']		= $search2['file_ok'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'file_ok')));	

		}

	    search_sex($data, $search, "T_CoupleMarry_ReMarryMan", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->open_marry_m->open_remarry_list($start, $rp, @$search, @$search2); //재혼신청 리스트


		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		
		$navs = array('공개구혼','재혼신청'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('marry',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('secret_talk'); //우측메뉴 로딩

		$top_data['add_css'] = array("open_marry/marry_css","main_css");
		$top_data['add_js'] = array("open_marry/remarry_js");

		$data['call_top'] = $this->call_top(); //본문 상단

		$this->load->view('top_v', $top_data);
		$this->load->view('open_marry/remarriage_v', $data);
		$this->load->view('bottom_v');
	}

	function check_remarriage(){

		user_check(null,9);
		
		$user_id = strip_tags(rawurldecode($this->input->post('m_userid', true))); 

		//자기 자신에게 프로포즈 불가
		if($this->session->userdata['m_userid'] == $user_id){
			echo "error_2"; exit;
		}

		$data = $this->member_lib->get_member($user_id); //회원정보

		//성별이 같을 경우 프로포즈불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}

		$search['m_userid'] = $this->session->userdata['m_userid'];
		$marry_data = $this->my_m->cnt('T_CoupleMarry_ReMarryMan', $search);

		// 재혼신청 등록했으면 팝업 오픈, 아니면 경고창
		echo $marry_data;
	}


	//재혼신청 본문탑부분
	function call_top(){

		ob_start();

		$uri_array = $this->seg_exp;

		$data['marry_type']		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'marry_type')));			
		$data['m_conregion']	= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_conregion')));		
		$data['m_age']		    = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'm_age')));	
		$data['file_ok']		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'file_ok')));	
		
		$search['m_userid'] = $this->session->userdata['m_userid'];
		$data['marry_data'] = $this->my_m->cnt('T_CoupleMarry_ReMarryMan', $search);
		
		$this->load->view('open_marry/remarriage_top_v', $data);

		$output = ob_get_contents();

		ob_end_clean();
		return $output;

	}
	
	//재혼신청 레이어팝업 AJAX
	function rem_request_popup(){
		
		user_check(null,9);

		$top_data['add_css'] = array("layer_popup/marriage_css");
		$top_data['add_js'] = array("layer_popup/marriage_js");
		$top_data['add_title'] = "재혼신청 필수항목 등록";
		$top_data['add_text'] = "";

		$m_userid = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_userid')));


		if($m_userid){
			$search['m_userid'] = $m_userid;
			$data['remarry_data'] = $this->my_m->row_array('T_CoupleMarry_ReMarryMan', $search, "", "desc");
			$data['remarry_data']['read_only'] = "readonly";
		}else{
			$search['m_userid'] = $this->session->userdata['m_userid'];
			$data['remarry_data'] = $this->my_m->row_array('T_CoupleMarry_ReMarryMan', $search, "", "desc");
		}		
		
		//형제관계 split
		if(@$data['remarry_data']['m_brother']){
			$data['arr_brother'] = split(',', @$data['remarry_data']['m_brother']);
		}

		//취미생활 split
		if(@$data['remarry_data']['m_hobby']){
			$data['arr_hobby'] = split(',', @$data['remarry_data']['m_hobby']);
					
			for($i=0; $i<count($data['arr_hobby']); $i++){
				
				for($j=1; $j<31; $j++){
					if($data['arr_hobby'][$i] == $j){
						$data['hobby_check_'.$j] = $data['arr_hobby'][$i];
					}
				};

			};
		}

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/remarriage_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	//재혼신청 등록하기
	function reg_open_remarry(){

		//로그인 여부 체크
		user_check();

		$data['m_title']			= strip_tags(rawurldecode($this->input->post('m_title', true))); 
		$data['m_content']			= strip_tags(rawurldecode($this->input->post('m_content', true))); 
		$data['m_reason']			= rawurldecode($this->input->post('m_reason', true)); 
		$data['m_incom']			= rawurldecode($this->input->post('m_incom', true)); 
		$data['m_sons']				= rawurldecode($this->input->post('m_sons', true)); 
		$data['m_job']				= rawurldecode($this->input->post('m_job', true)); 
		$data['m_brother']			= rawurldecode($this->input->post('m_brother', true)); 
		$data['m_attainment']		= rawurldecode($this->input->post('m_attainment', true)); 
		$data['m_car']				= rawurldecode($this->input->post('m_car', true)); 
		$data['m_faith']			= rawurldecode($this->input->post('m_faith', true)); 
		$data['m_hobby']			= rawurldecode($this->input->post('m_hobby', true)); 
		$data['m_hobby_text']		= rawurldecode($this->input->post('m_hobby_text', true)); 
		
		$arr_data = array(
			"m_userid"			=> $this->session->userdata['m_userid'],
			"m_nick"			=> $this->session->userdata['m_nick'],
			"m_title"			=> $data['m_title'],
			"m_job"				=> $data['m_job'],
			"m_incom"			=> $data['m_incom'],
			"m_car"				=> $data['m_car'],
			"m_attainment"		=> $data['m_attainment'],
			"m_faith"			=> $data['m_faith'],
			"m_hobby"			=> $data['m_hobby'],
			"m_content"			=> $data['m_content'],
			"m_reason"			=> $data['m_reason'],
			"m_sons"			=> $data['m_sons'],
			"m_writedate"		=> NOW,
			"m_brother"			=> $data['m_brother'],
			"m_age"				=> $this->session->userdata['m_age'],
			"m_conregion"		=> $this->session->userdata['m_conregion'],
			"m_conregion2"		=> $this->session->userdata['m_conregion2'],
			"m_sex"				=> $this->session->userdata['m_sex'],
			"m_hobby_text"		=> $data['m_hobby_text']
		);
		
		$search['m_userid'] = $this->session->userdata['m_userid'];
		$cnt = $this->my_m->cnt('T_CoupleMarry_ReMarryMan', $search);		//재혼신청 글 등록여부 확인

		if($cnt > 0){
			//수정
			$rtn = $this->my_m->update('T_CoupleMarry_ReMarryMan', $search, $arr_data);
		}else{
			//신규등록
			$rtn = $this->my_m->insert('T_CoupleMarry_ReMarryMan', $arr_data);
		}
		
		echo $rtn;

	}
	
}

/* End of file main.php */
/* Location: ./application/controllers/*/