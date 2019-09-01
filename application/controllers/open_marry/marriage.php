<?php

class Marriage extends MY_Controller {

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


	function marry_list()
	{
		user_check(null,0);

		// 추천나이로 검색
		if ($this->security->xss_clean(@url_explode($this->seg_exp, 'm_search')) == 'm_age'){

			$cut_age = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_age')));
			$search['ex_m_age'] = "T_CoupleMarry_MarryMan.m_age like '".$cut_age."%'";
				

		// 추천직업으로 검색
		}else if ($this->security->xss_clean(@url_explode($this->seg_exp, 'm_search')) == 'm_search_job'){

			$table_check = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'marry_type')));
			$search['T_CoupleMarry_MarryMan.m_job'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_job')));
				
		
		}else{

			$data['marry_type']		= $search2['m_marry'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'marry_type')));			
			$data['m_conregion']	= $search2['m_conregion'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_conregion')));		
			$data['m_age']		    = $search2['m_age'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_age')));		
			$data['file_ok']		= $search2['file_ok'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'file_ok')));		

		}
		
	    search_sex($data, $search, "T_CoupleMarry_MarryMan", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->open_marry_m->open_marry_list($start, $rp, @$search, @$search2); //결혼신청 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		
		$navs = array('공개구혼','결혼신청'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('marry',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('secret_talk'); //우측메뉴 로딩

		$top_data['add_css'] = array("open_marry/marry_css","main_css");
		$top_data['add_js'] = array("open_marry/marry_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$this->load->view('top_v',$top_data);
		$this->load->view('open_marry/marriage_v', $data);
		$this->load->view('bottom_v');
	}



	function m_request_popup(){
		//결혼신청 레이어팝업 AJAX
		user_check(null,9);

		$top_data['add_css'] = array("layer_popup/marriage_css");
		$top_data['add_js'] = array("layer_popup/marriage_js");
		$top_data['add_title'] = "결혼신청 필수항목 등록";
		$top_data['add_text'] = "";

		$m_userid = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_userid')));

		if($m_userid){
			$search['m_userid'] = $m_userid;
			$data['marry_data'] = $this->my_m->row_array('T_CoupleMarry_MarryMan', $search, "", "desc");
			$data['marry_data']['read_only'] = "readonly";
		}else{
			$search['m_userid'] = $this->session->userdata['m_userid'];
			$data['marry_data'] = $this->my_m->row_array('T_CoupleMarry_MarryMan', $search, "", "desc");
		}		
		
		//형제관계 split
		if(@$data['marry_data']['m_brother']){
			$data['arr_brother'] = split(',', @$data['marry_data']['m_brother']);
		}

		//취미생활 split
		if(@$data['marry_data']['m_hobby']){
			$data['arr_hobby'] = split(',', @$data['marry_data']['m_hobby']);
					
			for($i=0; $i<count($data['arr_hobby']); $i++){
				
				for($j=1; $j<31; $j++){
					if($data['arr_hobby'][$i] == $j){
						$data['hobby_check_'.$j] = $data['arr_hobby'][$i];
					}
				};

			};
		}

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/marriage_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	function check_marriage(){

		user_check(null,9,'exit');

		$user_id = strip_tags(rawurldecode($this->input->post('m_userid', true)));

		//자기 자신에게 프로포즈 불가
		if($this->session->userdata['m_userid'] == $user_id){
			echo "error_2"; exit;
		}

		$data = $this->member_lib->get_member($user_id); //회원정보

		//성별이 같을 경우 채팅불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}

		$search['m_userid'] = $this->session->userdata['m_userid'];
		$marry_data = $this->my_m->cnt('T_CoupleMarry_MarryMan', $search);

		// 결혼신청 등록했으면 팝업 오픈, 아니면 경고창
		echo $marry_data;
	}

	function check_guhon(){

		user_check(null,9);

		$user_id = strip_tags(rawurldecode($this->input->post('m_userid', true))); 

		//자기 자신에게 프로포즈 불가
		if($this->session->userdata['m_userid'] == $user_id){
			echo "error_2"; exit;
		}

		$data = $this->member_lib->get_member($user_id); //회원정보

		//성별이 같을 경우 채팅불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}

		$search['b_userid'] = $this->session->userdata['m_userid'];
		$open_data = $this->my_m->cnt('T_CoupleMarry_OpenguhonMan', $search);

		// 공개구혼 등록했으면 팝업 오픈, 아니면 경고창
		if ($open_data > 0){ echo "1"; } else { echo "8"; }
	}



	//결혼신청 본문탑부분
	function call_top(){

		ob_start();

		$data['marry_type']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'marry_type')));			
		$data['m_conregion']	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_conregion')));		
		$data['m_age']		    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_age')));	
		$data['file_ok']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'file_ok')));	
		
		$search['m_userid'] = $this->session->userdata['m_userid'];
		$data['marry_data'] = $this->my_m->cnt('T_CoupleMarry_MarryMan', $search);
		
		$this->load->view('open_marry/marriage_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	//결혼신청 등록하기
	function reg_open_marry(){

		//로그인 여부 체크
		user_check(null,9);

		$data['m_title']			= strip_tags(rawurldecode($this->input->post('m_title', true))); 
		$data['m_content']			= strip_tags(rawurldecode($this->input->post('m_content', true))); 
		$data['m_incom']			= rawurldecode($this->input->post('m_incom', true)); 
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
			"m_writedate"		=> NOW,
			"m_brother"			=> $data['m_brother'],
			"m_age"				=> $this->session->userdata['m_age'],
			"m_conregion"		=> $this->session->userdata['m_conregion'],
			"m_conregion2"		=> $this->session->userdata['m_conregion2'],
			"m_sex"				=> $this->session->userdata['m_sex'],
			"m_hobby_text"		=> $data['m_hobby_text']

		);
		
		$search['m_userid'] = $this->session->userdata['m_userid'];
		$cnt = $this->my_m->cnt('T_CoupleMarry_MarryMan', $search);		//결혼신청 글 등록여부 확인
	
		if($cnt > 0){
			//수정
			$rtn = $this->my_m->update('T_CoupleMarry_MarryMan', $search, $arr_data);
		}else{
			//신규등록
			$rtn = $this->my_m->insert('T_CoupleMarry_MarryMan', $arr_data);
		}
		
		echo $rtn;
	}


	//공개구혼 프로포즈 레이어팝업
	function propose_request_popup(){

		user_check(null,9);

		$top_data['add_css'] = array("layer_popup/beongae_request_css");
		$top_data['add_js'] = array("layer_popup/marriage_js");
		$top_data['add_title'] = "프로포즈 보내기";
		$top_data['add_text'] = "";
		
		$data['m_userid'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_userid'))); 	//원본글 작성자 아이디
		$data['m_type']	  = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_type')));
		
		// 공개구혼
		if($data['m_type'] == "공개구혼"){
			$search['b_userid'] = $data['m_userid'];

			$data['mlist'] = $this->my_m->row_array('T_CoupleMarry_OpenguhonMan', $search, "", "desc");
			$data['m_nick'] = $data['mlist']['b_nick'];
			$data['p_userid'] = $data['mlist']['b_userid'];	//원본글 작성자 아이디
			$data['m_age'] = $data['mlist']['b_age'];		
			$data['m_conregion'] = $data['mlist']['b_region'];
			$data['m_job'] = @$data['mlist']['b_job'];
			$data['m_writedate'] = $data['mlist']['b_writedate'];	
			$data['m_idx'] = $data['mlist']['b_num'];	
			
		// 결혼신청
		}else if($data['m_type'] == "결혼신청"){
			$search['m_userid'] = $data['m_userid'];	//원본글 작성자 아이디
			$data['mlist'] = $this->my_m->row_array('T_CoupleMarry_MarryMan', $search, "", "desc");

		// 재혼신청
		}else if($data['m_type'] == "재혼신청"){		
			$search['m_userid'] = $data['m_userid'];	//원본글 작성자 아이디
			$data['mlist'] = $this->my_m->row_array('T_CoupleMarry_ReMarryMan', $search, "", "desc");
		}

		if($data['m_type'] == "결혼신청" or $data['m_type'] == "재혼신청"){

			$data['m_nick'] = $data['mlist']['m_nick'];
			$data['p_userid'] = $data['mlist']['m_userid'];
			$data['m_age'] = $data['mlist']['m_age'];
			$data['m_conregion'] = $data['mlist']['m_conregion'];
			$data['m_job'] = $data['mlist']['m_job'];
			$data['m_writedate'] = $data['mlist']['m_writedate'];
			$data['m_idx'] = $data['mlist']['m_idx'];
		}

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/open_marry_propose_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//공개구혼 프로포즈 보내기 저장
	function reg_propose(){

		//로그인 여부 체크
		user_check();

		$data['m_userid']			= $this->session->userdata['m_userid']; 
		$data['m_type']				= rawurldecode($this->input->post('m_type', true)); 
		$data['m_content']			= strip_tags(rawurldecode($this->input->post('m_content', true))); 
		$data['p_userid']			= rawurldecode($this->input->post('p_userid', true)); 
		$data['p_idx']				= rawurldecode($this->input->post('p_idx', true)); 
		$data['p_nick']				= rawurldecode($this->input->post('p_nick', true)); 

		$data['p_age']				= rawurldecode($this->input->post('p_age', true)); 
		$data['p_conregion']		= rawurldecode($this->input->post('p_conregion', true)); 
		$data['p_conregion2']		= rawurldecode($this->input->post('p_conregion2', true)); 

		$my_data = $this->member_lib->get_member($data['m_userid']);			//나의 회원정보 가져오기

		$p_data = $this->member_lib->get_member($data['p_userid']);			//상대방 회원정보 가져오기

		$arr_data = array(

			"m_userid"		=> $data['m_userid'],
			"m_gubn"		=> $data['m_type'],
			"m_content"		=> $data['m_content'],
			"m_nick"		=> $my_data['m_nick'],
			"m_age"			=> $my_data['m_age'],
			"m_sex"			=> $my_data['m_sex'],
			"m_conregion"	=> $my_data['m_conregion'],  //나의 지역
			"m_conregion2"	=> $my_data['m_conregion2'],
			"p_userid"		=> $data['p_userid'],
			"p_idx"			=> $data['p_idx'],
			"p_nick"		=> $data['p_nick'],
			"m_writedate"	=> NOW,
			"p_age"			=> $p_data['m_age'],
			"p_conregion"	=> $p_data['m_conregion'],  //상대방 (원본글) 지역
			"p_conregion2"	=> $p_data['m_conregion2']

		);
		
		$rtn = $this->my_m->insert('open_marry_propose', $arr_data);

		if($rtn == 1){
			//조이헌팅 알림 추가
			joyhunting_alrim("프로포즈",$data['p_userid'],$data['m_userid']);
		}

		echo $rtn;

	}




}

/* End of file main.php */
/* Location: ./application/controllers/*/
