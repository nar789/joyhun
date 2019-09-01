<?php

class Message extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');			//포인트관련 헬퍼
		$this->load->helper('alrim_helper');			//알림관려 헬퍼

	}
	
	function index(){
		$this->message_list(1);
	}

	//탭메뉴에 따른 메세지리스트 함수 호출
	//전체메세지
	function all(){
		$this->message_list(1);
	}
	//보낸메세지
	function send_message(){
		$this->message_list(2);
	}
	//받은메세지
	function recv_message(){
		$this->message_list(3);
	}


	//받은메세지함 및 보낸메세지함 view 페이지
	function message_list($tabmenu = "1"){

		//로그인 체크
		user_check(null, 9, null);

		$data['user_id'] = $user_id = $this->session->userdata['m_userid'];
		
		//세션값이 없을경우 exit 처리
		if(empty($user_id)){exit;}
			
		//탭메뉴별
		if($tabmenu == "1"){
			//전체메세지 mode = ALL 구분자
			$data['mode'] = "ALL";
			//전체메세지 SQL 조건문
			$tab_where = "(V_SEND_ID = '".$user_id."' OR V_RECV_ID = '".$user_id."')";
			$tab_where .= "AND (IFNULL(V_SEND_DEL, 0) <> '".$user_id."' OR IFNULL(V_RECV_DEL, 0) <> '".$user_id."' )";
			$tab_where .= "AND (IFNULL(V_SEND_DEL, 0) <> '".$user_id."' AND IFNULL(V_RECV_DEL, 0) <> '".$user_id."')";
		}else if($tabmenu == "2"){
			//보낸메세지 mode = SEND 구분자
			$data['mode'] = "SEND";
			//보낸메세지 SQL 조건문
			$tab_where = "V_SEND_ID = '".$user_id."' AND V_SEND_DEL IS NULL AND V_DEL_GUBN IS NULL";
		}else if($tabmenu == "3"){
			//받은메세지 mode = RECV 구분자
			$data['mode'] = "RECV";
			//받은메세지 SQL 조건문
			$tab_where = "V_RECV_ID = '".$user_id."' AND V_RECV_DEL IS NULL AND V_DEL_GUBN IS NULL";
		}
				
		//검색조건
		$search['ex_where_1'] = $tab_where;				
	
		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);	

		$result = $this->my_m->get_list($start, $rp, @$search, 'MESSAGE_LIST', 'V_IDX', 'V_SEND_ID', 'desc', '*');
		$data['mlist'] = $result[0];
		$data['getTotalData']= $total= $result[1];
				
		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		//view 설정
		$navs = array('프로필', '메세지'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/message_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //찜 탭메뉴

		$this->load->view('top_v', $top_data);
		$this->load->view('profile/message_v', $data);
		$this->load->view('bottom_v');

	}


	//메세지보내기 및 답장하기 레이어팝업 ajax
	function send_message_layer(){
		
		$user_id		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		//메세지를 받는회원 아이디
		$gubn			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gubn')));			//구분자(send : 메세지 보내기, resend : 메세지 답장하기)
		$idx			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));			//선택한 메세지 번호
		
		if(empty($user_id)){exit;}

		//로그인 체크
		user_check(null, 0);

		//메세지를 보내는 회원의 남은 무료갯수 카운트해오기(하루 무료 메세지 갯수 : 10개 기준)
		$data['cnt'] = $this->call_message_cnt($this->session->userdata['m_userid']);

		//받는 회원의 정보가져오기
		$data['mdata'] = $this->member_lib->get_member($user_id);
		
		if($gubn == "resend"){
			//구분값이 답장하기일경우
			$add_title = "메세지 답장하기";
			$data['sdata'] = $this->my_m->row_array('MESSAGE_LIST', array('V_IDX' => $idx, 'V_SEND_ID' => $user_id));
			$this->my_m->update('MESSAGE_LIST', array('V_IDX' => $idx), array('V_READ_DATE' => NOW));
		}else{
			//구분값이 메세지보내기일경우
			$add_title = "메세지 보내기";
		}

		//view 설정
		$top_data['add_css'] = array("layer_popup/send_message_css");
		$top_data['add_js'] = array("layer_popup/send_message_js");
		$top_data['add_title'] = $add_title;
		$top_data['add_text'] = "";
		
		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/'.$gubn.'_message_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	//메세지 보내기 함수
	function call_send_message(){

		//로그인 체크
		user_check(null, 9, 'exit');

		$v_send_id		= rawurldecode($this->input->post('send_id', true));
		$v_recv_id		= rawurldecode($this->input->post('recv_id', true));
		$v_contents		= rawurldecode($this->input->post('contents', true));

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($v_send_id, $v_recv_id);
		if($cnt > 0){ echo "bad"; exit; }
		
		//메세지를 보내는 회원의 잔여횟수가 0일경우 포인트 체크
		if($this->call_message_cnt($v_send_id) == "0"){
			if($this->send_user_point_chk($v_send_id) == "fail"){
				echo "100"; exit;		//포인트 부족
			}
		}
		
		//메세지 잔여횟수(포인트 차감을 위해 추가)
		$last_val = $this->call_message_cnt($v_send_id);

		//메세지 보내기 데이터
		$arrData = array(
			"V_SEND_ID"			=> $v_send_id,
			"V_RECV_ID"			=> $v_recv_id,
			"V_CONTENTS"		=> $v_contents,
			"V_WRITE_DATE"		=> NOW,
			"V_READ_DATE"		=> null,
			"V_SEND_DEL"		=> null,
			"V_RECV_DEL"		=> null,
			"V_DEL_GUBN"		=> null
		);
		
		//메세지 보내기 테이블에 insert
		$rtn = $this->my_m->insert('MESSAGE_LIST', $arrData);
		
		//메세지 보내기 성공(이메일 및 조이헌팅 메세지 알림 추가)
		if($rtn == "1"){


			//메세지를 보내는 회원의 잔여횟수가 0일경우 10포인트 차감
			if($last_val == "0"){
				
				//메세지 차감 상품 가져오기(상품코드 : 9997)
				$pl_data = $this->my_m->row_array('product_list', array('m_product_code' => '9997'));
				
				//포인트 차감 point_helper
				member_point_insert($v_send_id, $pl_data['m_product_code'], $pl_data['m_goods'], $pl_data['m_point'], null, null, NOW, null);

			}

			//메세지 알림 추가
			joyhunting_alrim('메세지', $v_recv_id, $v_send_id);

			//여성전용 이벤트 데이터 insert(여성만 가능) popup_helper
			if($this->session->userdata['m_sex'] == "F"){
				call_woman_event_data_reg('msg', $this->session->userdata['m_userid'], $v_recv_id);
			}

		}

		echo $rtn;
	}

	//선택메세지 삭제처리 함수
	function call_mesaage_del(){
		
		//로그인 체크
		user_check(null, 5, 'exit');

		$v_mode				= rawurldecode($this->input->post('v_mode', true));
		$v_chk_value		= rawurldecode($this->input->post('v_chk_value', true));

		$user_id = $this->session->userdata['m_userid'];

		if(empty($user_id)){
			//세션값이 없을경우 메세지 삭제 실패 처리
			echo "0"; exit;
		}

		$chk_value = explode('|', $v_chk_value);

		if($v_mode == "SEND" or $v_mode == "RECV"){

			//보낸메세지함 또는 받은메세지함에서 메세지를  삭제할경우
			for($i=0; $i<count($chk_value); $i++){
				$rtn = $this->my_m->update('MESSAGE_LIST', array('V_IDX' => $chk_value[$i]), array("V_".$v_mode."_DEL" => $user_id));
			}

		}else{
			//전체 메세지함에서 메세지를 삭제할경우
			//보낸 메세지인지 받은 메세지인지 확인하고 삭제처리
			for($i=0; $i<count($chk_value); $i++){
				
				$flg		 = "";		//구분값 초기화
				$arrData	 = "";		//arrData 초기화
				$arrData = $this->my_m->row_array('MESSAGE_LIST', array('V_IDX' => $chk_value[$i]));

				if($arrData['V_SEND_ID'] == $user_id){
					$flg = "SEND";
				}else{
					$flg = "RECV";
				}

				$rtn = $this->my_m->update('MESSAGE_LIST', array('V_IDX' => $chk_value[$i]), array("V_".$flg."_DEL" => $user_id));

			}

		}

		//현재의 회원이 받거나 보낸 메세지가 서로 삭제처리를 한경우 구분자 삭제처리(V_DEL_GUBN)
		$search['ex_data_1'] = "(V_SEND_ID = '".$user_id."' OR V_RECV_ID = '".$user_id."') AND V_SEND_DEL IS NOT NULL AND V_RECV_DEL IS NOT NULL AND V_DEL_GUBN IS NULL";		//WHERE문
		
		$this->my_m->update('MESSAGE_LIST', $search, array('V_DEL_GUBN' => 'D'));

		echo $rtn;
		
	}

	//상단 탭메뉴 함수
	function call_tabmenu($num){
		//찜 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('profile/message_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	//이달에 보낸 메세지의 갯수가 카운트 하기 함수 (월 30건으로 변경 2016-08-08)
	function call_message_cnt($user_id){

		if(empty($user_id)){ return; }

		$m_data = $this->member_lib->get_member($user_id);

		if($m_data['m_sex'] == "M"){
			//남성일때 메세지 카운트 차감 
			//메세지를 보내는 회원의 남은 무료갯수 카운트해오기(월 무료 메세지 갯수 : 30개 기준)
			$search = array(
				"V_SEND_ID"		=> $user_id,
				"ex_date_1"		=> "V_WRITE_DATE  LIKE  '".date('Y-m')."%' AND V_WRITE_DATE > '2016-08-07' AND V_EVENT_GUBN IS NULL"
			);

			$cnt = $this->my_m->cnt('MESSAGE_LIST', $search);

			if($cnt >= 30){
				//이달 보낸 메세지의 갯수가 30개 이상일 경우
				$use_cnt = "0";
			}else{
				//이달 보낸 메세지의 갯수가 30개 미만일 경우
				$use_cnt = 30 - $cnt;
			}

		}else{
			//여성회원일때 월 300개
			//메세지를 보내는 회원의 남은 무료갯수 카운트해오기(월 무료 메세지 갯수 : 300개 기준)
			$search = array(
				"V_SEND_ID"		=> $user_id,
				"ex_date_1"		=> "V_WRITE_DATE  LIKE  '".date('Y-m')."%' AND V_WRITE_DATE > '2016-08-07' AND V_EVENT_GUBN IS NULL"
			);

			$cnt = $this->my_m->cnt('MESSAGE_LIST', $search);

			if($cnt >= 300){
				//이달 보낸 메세지의 갯수가 300개 이상일 경우
				$use_cnt = "0";
			}else{
				//이달 보낸 메세지의 갯수가 300개 미만일 경우
				$use_cnt = 300 - $cnt;
			}
		}
		
		return $use_cnt;

	}

	//메세지 내용 문자열 길이에 맞춰 자른 내용 출력
	function call_msg_contents(){
		
		$v_idx		= rawurldecode($this->input->post('v_idx', true));

		$msg = $this->my_m->row_array('MESSAGE_LIST', array('V_IDX' => $v_idx));

		echo $msg['V_CONTENTS'];

	}
	
	//메세지를 보내는 회원의 잔여 포인트 체크 함수
	function send_user_point_chk($user_id){

		$tcp = $this->my_m->row_array('member_total_point', array('m_userid' => $user_id));
		
		$result = "";

		if(!empty($tcp)){

			if($tcp['total_point'] > 10){
				$result = "success";
			}else if($tcp['total_point'] < 0){
				$result = "fail";
			}else{
				$result = "fail";
			}

		}else{
			$result = "fail";
		}

		return $result;
	}


	//메세지 알림 체크
	function call_message_alrim(){

		$msg_data = get_message_data();		//alrim_helper

		if(!empty($msg_data)){
			echo $msg_data;
		}

	}

	
	
	
}

/* End of file main.php */
/* Location: ./application/controllers/ */