<?php

class Socialting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('meeting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		
	}


	function social_list(){

		user_check(null,0);
		
		$uri_array = $this->seg_exp;

	    search_sex($data, $search, "T_sns_event", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);


		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_sns_event', 'm_idx', 'm_userid'); //소셜팅 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		//view 설정
		$navs = array('미팅신청','소셜팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/socialting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/socialting_v', $data);
		$this->load->view('bottom_v');
	}

	function socialting_add_popup(){
		//소셜팅 프로필등록 레이어팝업 AJAX
		
		user_check(null,9);

		//$data['already_write'] = mode~  if($already_write){}
		
		$search['m_userid'] = $this->session->userdata('m_userid');
		$data['my_data'] = $this->my_m->row_array('T_sns_event', $search, "", "desc");

		$top_data['add_css'] = array("layer_popup/socialting_add_popup_css");
		$top_data['add_js'] = array("layer_popup/socialting_add_popup_js");
		$top_data['add_title'] = "소셜팅 등록하기";
		$top_data['add_text'] = "";

		$data['placeholder'] = true;

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/socialting_add_popup_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


	function call_top(){
		//소셜팅 본문 상단
		ob_start();
		
		$search['m_userid'] = $this->session->userdata('m_userid');
		$data['my_data'] = $this->my_m->row_array('T_sns_event', $search, "", "desc");

		$this->load->view('meeting/socialting_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	//소셜팅 신규등록
	function reg_socialting(){
		
		//로그인 여부 체크
		user_check();
			
		$data['m_content']		= strip_tags(rawurldecode($this->input->post('m_content',TRUE)));
		$data['m_kakao']		= rawurldecode($this->input->post('m_kakao',TRUE));
		$data['m_nateon']		= rawurldecode($this->input->post('m_nateon',TRUE));
		$data['m_cyworld']		= rawurldecode($this->input->post('m_cyworld',TRUE));
		$data['m_facebook']		= rawurldecode($this->input->post('m_facebook',TRUE));
		$data['m_facebook_url'] = rawurldecode($this->input->post('m_facebook_url',TRUE));
		$data['m_twitter']		= rawurldecode($this->input->post('m_twitter',TRUE));
		$data['m_me2day']		= rawurldecode($this->input->post('m_me2day',TRUE));

		$arr_data = array(
				
				'm_userid' => $this->session->userdata('m_userid'),
				'm_sex' => $this->session->userdata('m_sex'),
				'm_age' => $this->session->userdata('m_age'),
				'm_content' => $data['m_content'],
				'm_kakao' => $data['m_kakao'],
				'm_nateon' => $data['m_nateon'],
				'm_cyworld' => $data['m_cyworld'],
				'm_facebook' => $data['m_facebook'],
				'm_twitter' => $data['m_twitter'],
				'm_me2day' => $data['m_me2day'],
				'm_date' => NOW,
				'm_update' => NOW	
			
		);
	

		$rtn = $this->my_m->insert('T_sns_event', $arr_data);

		echo $rtn;

	
	}

	//소셜팅 수정
	function mod_socialting(){

		//로그인 여부 체크
		user_check();
		
		$data['m_idx']			= rawurldecode($this->input->post('m_idx',TRUE));
		$data['m_userid']		= rawurldecode($this->input->post('m_userid',TRUE));
		$data['m_content']		= strip_tags(rawurldecode($this->input->post('m_content',TRUE)));
		$data['m_kakao']		= rawurldecode($this->input->post('m_kakao',TRUE));
		$data['m_nateon']		= rawurldecode($this->input->post('m_nateon',TRUE));
		$data['m_cyworld']		= rawurldecode($this->input->post('m_cyworld',TRUE));
		$data['m_facebook']		= rawurldecode($this->input->post('m_facebook',TRUE));
		$data['m_facebook_url'] = rawurldecode($this->input->post('m_facebook_url',TRUE));
		$data['m_twitter']		= rawurldecode($this->input->post('m_twitter',TRUE));
		$data['m_me2day']		= rawurldecode($this->input->post('m_me2day',TRUE));
		
		$arr_data = array(
				'm_content' => $data['m_content'],
				'm_kakao' => $data['m_kakao'],
				'm_nateon' => $data['m_nateon'],
				'm_cyworld' => $data['m_cyworld'],
				'm_facebook' => $data['m_facebook'],
				'm_twitter' => $data['m_twitter'],
				'm_me2day' => $data['m_me2day'],
				'm_update' => NOW			
		);


		$search['m_userid'] = $this->session->userdata('m_userid');
		$rtn = $this->my_m->update('T_sns_event', $search , $arr_data);

		if($rtn == "1"){
			echo "1"; //정상등록
		}else{
			echo "9"; //오류
		}
	}

	//소셜팅 프로필삭제
	function remove_socialting(){

		//로그인 여부 체크
		user_check();

		$data['m_userid'] = rawurldecode($this->input->post('m_userid', TRUE));

		$search['m_userid'] = $this->session->userdata('m_userid');
		$rtn = $this->my_m->del('T_sns_event', $search);

		if($rtn == "1"){
			echo "1"; //정상등록
		}else{
			echo "9"; //오류
		}

	}


	//연락처 확인하기 팝업
	function socialting_check_popup(){

		//로그인 여부 체크
		user_check(null,9);

		$search['m_idx'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_idx')));
		$search['m_userid'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_userid')));

		$result = $this->my_m->row_array('T_sns_event', $search, "", "desc");

		$data['my_data'] = $result;

		$top_data['add_css'] = array("layer_popup/socialting_add_popup_css");
		$top_data['add_js'] = array("layer_popup/socialting_add_popup_js");
		$top_data['add_title'] = "연락처 확인하기";
		$top_data['add_text'] = "";

		$data['read_only'] = "readonly";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/socialting_add_popup_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/