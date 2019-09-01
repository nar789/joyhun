<?php

class Chat_app_push extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
		$this->load->library('member_lib');
		$this->load->model('admin/chat_app_push_m');

		admin_check();
	}
	
	//회원리스트 검색
	function user_list(){
		
		//검색조건
		$data['sex']			= $sex				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'sex')));				//받는회원 성별
		$data['point']			= $point			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'point')));				//포인트
		$data['area']			= $area				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'area')));				//지역
		$data['age_1']			= $age_1			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'age_1')));				//나이1
		$data['age_2']			= $age_2			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'age_2')));				//나이2
		$data['type']			= $type				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'type')));				//정회원여부
		$data['join_date_1']	= $join_date_1		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'join_date_1')));		//접속날짜1
		$data['join_date_2']	= $join_date_2		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'join_date_2')));		//접속날짜2
		$data['reg_date_1']		= $reg_date_1		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'reg_date_1')));			//가입날짜1
		$data['reg_date_2']		= $reg_date_2		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'reg_date_2')));			//가입날짜2
		
		//받는 회원 기본성별 전체 셋팅
		if(empty($data['sex'])){ $data['sex'] = "A"; }

		//년도, 월, 일 기본셋팅
		$data['year']		= date("Y");
		$data['month']		= date("m");
		$data['day']		= date("d");

		//검색조건이 있을경우 받는회원 리스트 출력
		if(str_replace("admin/chatting/chat_app_push/user_list", "", uri_string())){
			$result = $this->chat_app_push_m->chat_app_user_list($sex, $point, $area, $age_1, $age_2, $type, $join_date_1, $join_date_2, $reg_date_1, $reg_date_2);
			$data['mlist']		= $result[0];
			$data['total_cnt']	= $result[1];
			$data['query']		= $result[2];

			$data['search_value'] = "true";
		}
		
		$data['log'] = $this->my_m->result_array('APP_USER_PUSH_LOG', @$search, 'V_IDX', 'DESC', '50');

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/chat_app_push_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//발송관련 함수
	function call_notice_send(){

		$gubn				= rawurldecode($this->input->post('gubn', true));
		$sql				= rawurldecode($this->input->post('query', true));
		$title				= rawurldecode($this->input->post('title', true));
		$message			= rawurldecode($this->input->post('notice_text', true));
		$year				= rawurldecode($this->input->post('year', true));
		$month				= rawurldecode($this->input->post('month', true));
		$day				= rawurldecode($this->input->post('day', true));
		$time				= rawurldecode($this->input->post('time', true));
		$minute				= rawurldecode($this->input->post('minute', true));
		
		$book_date = $year."-".$month."-".$day." ".$time.":".$minute.":00";		//예약시간

		if($gubn == "send"){
			//즉시발송 처리

			$mlist = $this->chat_app_push_m->chat_app_user_query($sql);

			if(!empty($mlist)){
				foreach($mlist as $data){
					//app push 보내기 (alrim_helper)
					gcm_send($data['m_userid'], $title, $message, $data['reg_id']);
				}
			}
			
			$rtn = $this->call_notice_log($gubn, $title, $message, $sql, NOW, null, count($mlist));

		}else if($gubn == "book"){
			//예약발송 처리

			$mlist = $this->chat_app_push_m->chat_app_user_query($sql);

			$rtn = $this->call_notice_log($gubn, $title, $message, $sql, null, $book_date, count($mlist));			
		}else{
			//잘못된 접근처리
			$rtn = "1000";
		}

		echo $rtn;

	}

	//로그남기기 함수
	function call_notice_log($gubn, $title, $msg, $sql, $write_date = null, $book_date = null, $cnt = null){

		$arrData = array(
			"V_GUBN"			=> $gubn,
			"V_TITLE"			=> $title,
			"V_MSG"				=> $msg,
			"V_QUERY"			=> $sql,
			"V_WRITE_DATE"		=> $write_date,
			"V_BOOK_DATE"		=> $book_date,
			"V_CNT"				=> $cnt
		);

		$rtn =  $this->my_m->insert('APP_USER_PUSH_LOG', $arrData);

		return $rtn;

	}

	//예약발송 취소함수
	function call_book_send_cancel_ajax(){

		$idx = $this->input->post('idx', true);

		if(empty($idx)){ echo "1000"; exit; }

		$rtn = $this->my_m->update('APP_USER_PUSH_LOG', array('V_IDX' => $idx), array('V_WRITE_DATE' => NOW));

		echo $rtn;

	}

}