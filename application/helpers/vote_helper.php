<?php 

	//투표코드로 투표타이틀 가져오기
	function vote_title($m_code){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		$vote_data = $CI->my_m->row_array('reg_vote_list', array('m_code' => $m_code));

		return $vote_data['m_title'];
	}
	
	//본인이 참여한 투표인지 확인하기
	function member_vote_chk($m_code){

		$CI =& get_instance();
		$CI->load->model('my_m');

		$member_chk = $CI->my_m->row_array('vote_member_list', array('m_code' => $m_code, 'm_userid' => @$CI->session->userdata['m_userid']));

		if(!@empty($member_chk)){
			return "1";		//투표에 참여한경우(or 로그인하지 않았을때)
		}else{
			return "0";		//투표에 참여하지 않은경우
		}

	}

	//공감 POLL view 리스트
	function vote_poll_view($m_code, $m_example){

		$CI =& get_instance();
		$CI->load->model('my_m');

		$ex_list = $CI->my_m->row_array('reg_vote_list', array('m_code' => $m_code));

		for($i=1; $i<=5; $i++){
			if($m_example == $i){ $example = $ex_list['m_example'.$i]; }
		}

		return $example;
	}
?>