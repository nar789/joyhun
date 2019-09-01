<?php

class Super_chat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->library('m_top_menu_lib');
		$this->load->helper('chat_helper');
		$this->load->helper('point_helper');
	
	}

	function index(){

		user_check(null, 5, null);
		
		//지역데이터 베앨
		$data['area'] = array('서울', '경기', '인천', '강원', '경남', '부산', '경북', '대구', '전북', '전주', '전남', '광주', '충북', '청주', '충남', '대전', '제주', '울산', '해외');

		//현재 로그인한 성별에 따른 기본값 가져오기(여성회원의 경우 하루 10건의 슈퍼채팅 무료이기 때문에)
		$data['set_data'] = $this->call_set_data($this->session->userdata['m_sex'], $this->session->userdata['m_userid']);	
	
		//현재 로그인한 회원의 보유 포인트 가져오기
		$data['mtp'] = $this->call_member_point($this->session->userdata['m_userid']);

		//최근접속 이성 데이터가져오기(기본값 : 10명)
		$data['mlist'] = $this->my_m->result_array('TotalMembers', array('m_sex' => $data['set_data'][0], 'ex_data_1' => 'm_filename is not null'), 'last_login_day', 'desc', '12');
		
		//veiw 설정
		if(IS_MOBILE == true){
			
			//모바일 버전 
			$top_data['add_css'] = array("chatting/m_super_chat_css");
			$top_data['add_js'] = array("joy_chatting/super_chat_js");
			
			//여성회원의 경우 추가문구때문에 css변경
			if($this->session->userdata['m_sex'] == "F"){

				$bot_data['add_script'] = "
				<script type='text/javascript'>
					
					$(document).ready(function(){
						$('.super_top_text_box').css('height', '100px');
					});

				</script>
				";
			}
			$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

			$this->load->view('/m/m_top_v',$top_data);
			$this->load->view('/m/joy_chatting/m_super_chatting_v', $data);
			$this->load->view('m/m_bottom0_v', @$bot_data);

		}else{
			
			//PC버전
			$navs = array('미팅신청','메인'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

			$top_data['add_css'] = array("chatting/super_chat_css");
			$top_data['add_js'] = array("joy_chatting/super_chat_js");
			
			//여성회원의 경우 추가문구때문에 css 변경
			if($this->session->userdata['m_sex'] == "F"){

				$bot_data['add_script'] = "
				<script type='text/javascript'>
				
					$(document).ready(function(){
						$('.super_top_content').css('padding-top', '290px');
						$('.super_top_box').css('height', '392px');
						$('.super_top_text_box').css('height', '100px');
					});

				</script>
				";
			}
			

			$this->load->view('top_v',$top_data);
			$this->load->view('joy_chatting/super_chat_v', $data);
			$this->load->view('bottom_v',@$bot_data);	
		}

	}

	//슈퍼채팅 보내기 함수
	function call_super_chat_send(){
		
		user_check(null, 5, 'exit');

		//변수받기
		$mode		= rawurldecode($this->input->post('mode', true));		//모드값(super)
		$num		= rawurldecode($this->input->post('num', true));		//대상자수
		$area		= rawurldecode($this->input->post('area', true));		//지역
		$age_1		= rawurldecode($this->input->post('age_1', true));		//나이1
		$age_2		= rawurldecode($this->input->post('age_2', true));		//나이2
		$contents	= rawurldecode($this->input->post('contents', true));	//내용
		$sex		= rawurldecode($this->input->post('sex', true));		//받을회원의 성별
		$point		= rawurldecode($this->input->post('point', true));		//사용될 포인트

		//세션 아이디가 없을경우 1000반환
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		//보내는 회원 정보 가져오기
		$send_data = $this->member_lib->get_member($user_id);
		
		//회원 보유 포인트 가져오기
		$mtp = $this->call_member_point($user_id);
		
		//보유포인트가 사용될포인트보다 적을경우 9999반환
		if($mtp < $point){ echo "9999"; exit; }
		
		//포인트 조각 가능여부 체크
		$point_result = $this->check_use_point($num, $point, $send_data['m_sex']);
		if($point_result[0] == "error"){ echo "9999"; exit; }

		//선택조건에 해당되는 회원 리스트 가져오기
		$mlist = $this->chatting_m->user_super_chat_list($num, $area, $age_1, $age_2, $sex, $user_id);

		$recv_member = ""; //로그용 받는 회원 변수
		
		foreach($mlist as $data){
			//순차적으로 슈퍼채팅 보내기(chat_helper)
			call_super_chat_chk($send_data['m_userid'], $send_data['m_nick'], $data['m_userid'], $contents, $mode);
			
			//로그용 받은회원 변수에 회원 아이디 담기
			if(empty($recv_member)){
				$recv_member = $data['m_userid'];
			}else{
				$recv_member = $recv_member.", ".$data['m_userid'];
			}
		}
		
		//상품가져오기(슈퍼채팅 상품코드 : 9995)
		$pdata = $this->my_m->row_array('product_list', array('m_product_code' => '9995'), 'm_idx', 'desc', '1');

		//채팅 전송 성공후 포인트 차감(point_helper)
		$rtn = member_point_insert($user_id, $pdata['m_product_code'], $pdata['m_goods'], "-".$point_result[1], null, null, NOW, null);
		
		//구분값
		if(IS_MOBILE == true){
			if(IS_APP == true){
				$v_gubn = "A";
			}else{
				$v_gubn = "M";
			}
		}else{
			$v_gubn = "P";
		}

		//슈퍼채팅 보냈을시 로그남기기
		$log_array = array(
			"V_SEND_ID"				=> $send_data['m_userid'],
			"V_SEND_CONTENTS"		=> $contents,
			"V_RECV_TERMS"			=> $num.", ".@$area.", ".@$age_1.", ".@$age_2.", ".$sex,
			"V_RECV_LIST"			=> $recv_member,
			"V_WRITE_DATE"			=> NOW,
			"V_IP"					=> $_SERVER['REMOTE_ADDR'],
			"V_GUBN"				=> $v_gubn
		);

		$this->my_m->insert('USER_SU_CHAT_LOG', $log_array);

		echo $rtn;

	}

	//현재 로그인한 세션에 대한 기본셋팅 데이터 가져오기
	function call_set_data($sex, $user_id){

		if($sex == "M"){
			$sex_flag = "F";
			$sex_text = "여성";
			$add_text = "";
		}else if($sex == "F"){

			$sex_flag = "M";
			$sex_text = "남성";
			$add_text = "<div class='color_666'><b>여성회원님은 오늘 10명에게 발송이 무료입니다.</b></div>";
		}

		return array($sex_flag, $sex_text, $add_text);
	}


	//회원의 보유 포인트 가져오기
	function call_member_point($user_id){

		if(empty($user_id)){
			goto('/');
			return;
		}

		$mtp = $this->my_m->row_array('member_total_point', array('m_userid' => $user_id));

		if(!empty($mtp)){
			return $mtp['total_point'];
		}else{
			return "0";
		}

	}
	

	//슈퍼채팅 대상자 수에 따른 사용될 포인될 계산
	function call_use_point(){

		user_check(null, 5, 'exit');

		$val = $this->input->post('val', true);		//대상자 수
		
		//세션 아이디가 없을경우 1000반환
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$mdata = $this->member_lib->get_member($user_id);
		
		$add_html = "";

		if($mdata['m_sex'] == "M"){

			$add_html = "사용될 포인트 : <p>".number_format(50*$val)."P</p>";

		}else if($mdata['m_sex'] == "F"){

			$search = array(
				"mode"			=> "super",
				"send_id"		=> $mdata['m_userid'],
				"ex_data_1"		=> "request_date >= '".date('Y-m-d')." 00:00:00' and request_date <= '".date('Y-m-d')." 24:00:00' "
			);

			$chat_req_data = $this->my_m->result_array('chat_request', $search, 'idx', 'desc', null);

			if(!empty($chat_req_data)){
				$add_html = "사용될 포인트 : <p>".number_format(50*$val)."P</p>";
			}else{
				$add_html = "사용될 포인트 : <p>".number_format(50*($val-10))."P</p>";
			}

		}else{
			$add_html = "1000";	//잘못된 접근
		}

		echo $add_html;

	}

	//사용될 포인트 비교하기 함수
	function check_use_point($num, $point, $sex){
		
		//슈퍼채팅의 경우만 50포인트 차감
		$chat_point = 50;		

		$result = "";
		$use_point = "";

		if($sex == "M"){
			$use_point = $num*$chat_point;
			if($point == $use_point){
				$result = "success";
			}else{
				$result = "error";
			}
		}else if($sex == "F"){
			$use_point = ($num-10)*$chat_point;
			if($point == $use_point){
				$result = "success";
			}else{
				$result = "error";
			}
		}else{
			$result = "error";
		}

		return array($result, $use_point);
	}


}

/* End of file main.php */
/* Location: ./application/controllers/ */