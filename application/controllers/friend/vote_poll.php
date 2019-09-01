<?php

class Vote_poll extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('vote_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		
		$this->load->helper('code_change_helper');
		$this->load->helper('vote_helper');
	}
	
	function index(){
		$this->poll_list();
	}
	
	//투표하기 리스트페이지
	function poll_list(){

		$m_code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$search['m_use_yn'] = "Y";
		$m_result = $this->vote_m->vote_list($start, $rp, @$search, 'reg_vote_list');

		$data['mlist'] = $m_result[0];
		$data['getTotalData']= $total = $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		$navs = array('친구만들기','공감Poll'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('friend',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		// View 설정 
		$top_data['add_css'] = array("friend/friend_css");
		$top_data['add_js'] = array("friend/vote_js");

		$data['call_top'] = $this->call_top(@$m_code); //본문 상단

		$this->load->view('top_v',$top_data);
		$this->load->view('friend/vote_poll_v', $data);
		$this->load->view('bottom_v');
	}

	//투표하기 리스트페이지 상단부분
	function call_top($m_code = null){
		
		ob_start();
		
		if(!@empty($m_code)){
			//투표코드값이 있을경우
			$search['m_code'] = $m_code;
		}else{
			//투표코드값이 없을경우 코드값이 가장 큰 투표 가져오기
			$search['ex_m_code'] = "m_code = (select max(m_code) from reg_vote_list where 1=1 and m_use_yn = 'Y')";	
		}
		
		$arrData = $this->my_m->row_array('reg_vote_list', $search);

		$this->load->view('friend/vote_poll_top_v', $arrData);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	//회원 투표하기 이벤트
	function reg_member_vote(){
		
		//로그인 여부 체크
		user_check(null,9,"exit");

		$m_code		= rawurldecode($this->input->post('m_code', true));
		$m_example  = rawurldecode($this->input->post('m_example', true));
		
		//투표가 종료되었는지 여부 확인
		$vote_list = $this->my_m->row_array('reg_vote_list', array('m_code' => $m_code));

		if($vote_list['m_last_day'] < date('Y-m-d')){
			echo "8";		//투표종료
			exit;
		}

		//투표하기전 투표에 참여했는지 검사
		$member_chk = $this->my_m->row_array('vote_member_list', array('m_code' => $m_code, 'm_userid' => $this->session->userdata['m_userid']));
		
		if(!@empty($member_chk)){
			echo "9";		//이미 참여
			exit;
		}else{
		
			$arrData = array(
				"m_code"			=> $m_code,
				"m_userid"			=> $this->session->userdata['m_userid'],
				"m_example"			=> $m_example,
				"m_write_day"		=> NOW
			);

			$rtn = $this->my_m->insert('vote_member_list', $arrData);

			if($rtn == "1"){
				$cnt = $this->my_m->cnt('vote_member_list', array('m_code' => $m_code));							//투표챀가자 카운트
				$this->my_m->update('reg_vote_list', array('m_code' => $m_code), array('m_readnum' => $cnt));		//투표참가자 업데이트

				echo "1";		//성공
			}else{
				echo "0";		//실패
			}
		}
		
		
	}
	
	//공감 poll 보기
	function poll_view(){

		//로그인 여부 체크
		user_check();

		$data['m_code']	  = $m_code	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기
		$data['m_idx']	  = $m_idx	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_idx')));		//설문번호 받아오기

		$data['mlist'] = $result = $this->vote_m->vote_poll_view($m_code, $this->session->userdata['m_userid']);		//투표결과 불러오기

		//참여인원 view
		if(empty($data['m_idx']) || $data['m_idx'] == ""){			
			$data['m_idx'] = "1";
		}else{
			$bot_data['add_script'] = "
				<script type='text/javascript'>
					$(document).ready(function(){
						poll_detail_view();
					});
				</script>
			";
		}
		$data['sub_title'] = $this->my_m->row_array('reg_vote_list', array('m_code' => $m_code));

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 5; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$search = array(
			"m_code"		=> $data['m_code'],
			"m_example"		=> $data['m_idx']
		);

		$m_result = $this->my_m->get_list($start, $rp, $search, 'vote_member_list', 'm_write_day', 'm_userid', 'desc', '*');		//참여회원 리스트

		$data['slist'] = $m_result[0];
		$data['getTotalData']= $total = $m_result[1];
	
		//$r_result = $this->my_m->get_list($start, $rp, array('m_code' => $m_code), 'vote_rp_list', 'm_write_day', 'm_userid', 'desc', '*');		//서브주제 리플 리스트

		$data['r_result'] = $this->vote_m->result_array('vote_rp_list', array('m_code' => $m_code), 'm_write_day');		//서브주제 리플 리스트

		$data['r_cnt'] = count($data['r_result']);

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));


		$navs = array('친구만들기','공감Poll'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('friend',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		// View 설정 
		$top_data['add_css'] = array("friend/friend_css");
		$top_data['add_js'] = array("friend/vote_js");
		
		
		$this->load->view('top_v',$top_data);
		$this->load->view('friend/poll_view_v', $data);
		$this->load->view('bottom_v', @$bot_data);

	}

	//리플저장
	function reg_vote_reply(){

		//로그인 여부 체크
		user_check();

		$m_code		= rawurldecode($this->input->post('m_code', true));
		$m_reply	= rawurldecode($this->input->post('m_reply', true));

		if(empty($m_code) || empty($m_reply)){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}

		$arrData = array(
			"m_code"		=> $m_code,
			"m_userid"		=> $this->session->userdata['m_userid'],
			"m_reply"		=> $m_reply,
			"m_write_day"	=> NOW
		);

		$rtn = $this->my_m->insert('vote_rp_list', $arrData);

		if($rtn == "1"){
			echo "1";		//성공
		}else{
			echo "0";		//실패
		}


	}

	//본인 리플 삭제
	function rp_del(){
		
		//로그인 여부 체크
		user_check();

		$m_code			= rawurldecode($this->input->post('m_code', true));
		$m_write_day	= rawurldecode($this->input->post('m_write_day', true));
		
		if(empty($m_code) || empty($m_write_day)){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}

		$arrData = array(
			"m_code"		=> $m_code,
			"m_userid"		=> $this->session->userdata['m_userid'],
			"m_write_day"	=> $m_write_day
		);

		$rtn = $this->my_m->del('vote_rp_list', $arrData);
		
		if($rtn == "1"){
			echo "1";		//성공
		}else{
			echo "0";		//실패
		}

	}


	// 참여회원보기 자신이 선택한거 뜨기
	function chk_view(){

		//로그인 여부 체크
		user_check();

		$search['m_userid']			= rawurldecode($this->input->post('user', true));
		$search['m_code']			= rawurldecode($this->input->post('idx', true));

		$vote_array = $this->my_m->row_array('vote_member_list', $search);

		if(empty($vote_array)){
			echo "666";
		}else{
			echo $vote_array['m_example'].",".$vote_array['m_code'];
		}


	}

	

}

/* End of file main.php */
/* Location: ./application/controllers/*/

