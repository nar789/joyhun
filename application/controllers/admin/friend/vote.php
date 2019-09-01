<?php
class Vote extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/vote_m');
		$this->load->helper('vote_helper');

		admin_check();
	}
	
	//관리자 처음화면
	function index(){

		$this->vote_list();
	}
	
	//투표하기 리스트
	function vote_list(){
		
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

		$result = $this->vote_m->vote_list($start, $rp, @$search, 'reg_vote_list');  //투표하기 등록리스트
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/friend/vote_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//투표하기 내용보기 페이지
	function vote_view(){

		$data['m_code'] = $m_code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기
		$data['fname'] = "frmView";

		$v_result = $this->vote_m->vote_poll_view($m_code);
		
		$data['vlist'] = $v_result[0];
		$data['vlist2'] = $v_result[1];

		$i = 0;
		foreach($data['vlist2'] as $vlist2){
			$i += 1;
			$data['totalnum'.$i] = $vlist2['cnt']."/".$vlist2['total'];
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, array('m_code' => $m_code), 'vote_rp_list', 'm_write_day', 'm_userid', 'desc', '*');  //투표하기 등록리스트
		$data['rlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/friend/vote_view_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	//투표하기 등록/수정 페이지
	function vote_write(){
		
		$m_code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기

		if(!@empty($m_code)){
			//수정일경우
			$data = $this->my_m->row_array('reg_vote_list', array('m_code' => $m_code));
			$data['cnt'] = $this->my_m->cnt('vote_member_list', array('m_code' => $m_code));
			$data['fname'] = "frmView";
		}else{
			//신규등록일 경우
			$data['fname'] = "frmWrite";
			$data['m_code'] = "";
		}

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/friend/vote_write_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//투표하기 등록하기
	function reg_vote(){

		$fname			= rawurldecode($this->input->post('fname', true)); 
		$m_code			= rawurldecode($this->input->post('m_code', true)); 
		$m_title		= rawurldecode($this->input->post('m_title', true)); 
		$m_example1		= rawurldecode($this->input->post('m_example1', true)); 
		$m_example2		= rawurldecode($this->input->post('m_example2', true)); 
		$m_example3		= rawurldecode($this->input->post('m_example3', true)); 
		$m_example4		= rawurldecode($this->input->post('m_example4', true)); 
		$m_example5		= rawurldecode($this->input->post('m_example5', true)); 
		$m_sub_title	= rawurldecode($this->input->post('m_sub_title', true)); 
		$m_use_yn		= rawurldecode($this->input->post('m_use_yn', true)); 
		$m_start_day	= rawurldecode($this->input->post('m_start_day', true)); 
		$m_last_day		= rawurldecode($this->input->post('m_last_day', true)); 

		//투표코드가 없을경우 생성
		if(empty($m_code) || $m_code == ""){
			$m_code = $this->vote_m->vote_code('reg_vote_list');
			//$m_write_day = date('Y-m-d');
		}

		//저장 전 임시데이터 만들기
		$arrData = array(
			"m_code"		=> $m_code,
			"m_title"		=> $m_title,
			"m_example1"	=> $m_example1,
			"m_example2"	=> $m_example2,
			"m_example3"	=> $m_example3,
			"m_example4"	=> $m_example4,
			"m_example5"	=> $m_example5,
			"m_sub_title"	=> $m_sub_title,
			"m_use_yn"		=> $m_use_yn,
			"m_write_day"	=> date('Y-m-d'),
			"m_start_day"	=> $m_start_day,
			"m_last_day"	=> $m_last_day
		);

		if($fname == "frmWrite"){
			//투표 신규 등록(insert)
			$rtn = $this->my_m->insert('reg_vote_list', $arrData);

			if($rtn == "1"){
				echo "1";		//성공
			}else{
				echo "0";		//실패
			}

		}else if($fname == "frmView"){
			//투표 내용 수정(update)
			$rtn = $this->my_m->update('reg_vote_list', array('m_code' => $m_code), $arrData);

			if($rtn == "1"){
				echo "1";		//성공
			}else{
				echo "0";		//실패
			}

		}else{
			echo "9";		//잘못된 접근
		}

	}

	//투표 삭제하기
	function vote_del(){

		$data['m_code'] = $m_code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기
		
		if(empty($m_code) || $m_code == ""){
			alert_goto('잘못된 접근입니다.', '/admin/friend/vote/vote_list');
			exit;
		}

		$this->my_m->del('reg_vote_list', array('m_code' => $m_code));		//등록한 투표 리스트 지우기
		$this->my_m->del('vote_member_list', array('m_code' => $m_code));	//공감poll에 투표한 회원 리스트 지우기
		$this->my_m->del('vote_rp_list', array('m_code' => $m_code));		//공감poll에 리플단 회원 리스트 지우기

		alert_goto('삭제되었습니다.', '/admin/friend/vote/vote_list');
	}

	//댓글 삭제하기
	function rp_del(){

		$data['m_code'] = $m_code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_code')));		//투표번호 받아오기
		
		if(empty($m_code) || $m_code == ""){
			alert_goto('잘못된 접근입니다.', '/admin/friend/vote/vote_list');
			exit;
		}

		$this->my_m->del('vote_rp_list', array('m_code' => $m_code));		//공감poll에 리플단 회원 리스트 지우기
		alert_goto('삭제되었습니다.', '/admin/friend/vote/vote_view/m_code/'.$m_code);
	}

	
	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/