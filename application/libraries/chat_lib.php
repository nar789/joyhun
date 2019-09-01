<?php 

//채팅 관련 라이브러리
//구현 
//보낼아이디로 초기화 set_send_id
//받을아이디로 초기화 set_recv_id
//채팅 수락하기 chat_request_submit
//일반 채팅 보내기 chatting_submit
//실제 메시지 보내기 (공용) chatting_save

class Chat_lib{ 

	protected $ci;                 // CodeIgniter instance
	
	private $debug_mode = true; //오류출력 여부

	private $is_init = false;	//초기화 여부
	private $send_id;		//보낼아이디
	private $send_user_nick;		//보낼아이디의 닉네임
	private $recv_id;		//받을아이디
	private $chat_req;	//채팅방번호

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('chat_m');
		$this->ci->load->library('member_lib');		
		$this->ci->load->helper('alrim_helper');	
		$this->ci->load->helper('latest_helper');
		$this->ci->load->helper('popup_helper');	
		
	}	
	
	//보낼아이디로 초기화
	function set_send_id($send_id = ""){ 
		$this->check_login();

		if(empty($send_id)){	
			$this->error("보낼 아이디가 넘어오지 않았습니다.",__FUNCTION__);
		}

		$this->send_id = $send_id;

		if(empty($this->recv_id)){
			$this->recv_id = $this->ci->session->userdata('m_userid'); 
		}	

		//발송자 닉네임 찾아오기
		$member = $this->ci->member_lib->get_member($this->send_id);
		$this->send_user_nick = $member['m_nick'];

		//방번호 찾아오기
		$this->auto_set_chat_req();

		//초기화완료
		$this->is_init = true;

 	}  

	//받을아이디로 초기화
	function set_recv_id($recv_id = ""){ 
		$this->check_login();

		if(empty($recv_id)){	
			$this->error("받을 아이디가 넘어오지 않았습니다.",__FUNCTION__);
		}

		$this->recv_id = $recv_id;

		if(empty($this->send_id)){
			$this->send_id = $this->ci->session->userdata('m_userid'); 
		}

		//발송자 닉네임 찾아오기
		$member = $this->ci->member_lib->get_member($this->send_id);
		$this->send_user_nick = $member['m_nick'];

		//방번호 찾아오기
		$this->auto_set_chat_req();

		//초기화완료
		$this->is_init = true;

 	}  

	//채팅 수락하기
	function chat_request_submit($contents,$mode_gubn = null){

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($this->send_id, $this->recv_id);
		if($cnt > 0){ return "bad"; }
		
		//채팅신청 버튼을 여러번 클릭 또는 터치시 동일 채팅 중복체크
		$arrData = array(
			"send_id"			=> $this->send_id,
			"recv_id"			=> $this->recv_id,
			"ex_status"			=> "status not in('수락', '거절', '나감')",
			"ex_is_delete"		=> "is_delete is null"
		);
		$chk = $this->ci->my_m->row_array('chat_request', $arrData);

		if(!@empty($chk)){	return "10";}

		$chat_yn = $this->ci->chat_m->already_chat_yn($this->recv_id, 'already', null);

		if(!@empty($chat_yn)){
			
			$del_yn = $this->ci->chat_m->already_chat_yn($this->recv_id, 'del', $chat_yn['idx']);
			if(!@empty($del_yn)){
				//한사람만 나간경우 같은 대화상대에게 채팅신청을 했을경우
				$this->ci->my_m->update('chat_request', array('idx' => $chat_yn['idx']), array('send_id' => $this->send_id, 'recv_id' => $this->recv_id, 'request_date' => NOW, 'status' => '', 'alrim_del' => null, 'out_member' => null));
				$this->ci->my_m->update('chat', array('req_idx' => $chat_yn['idx'], 'mode' => 'exit'), array('mode' => $del_yn['mode'].'2'));
				$this->chat_req = $chat_yn['idx'];
			}
		}else{

			//채팅 신청 추가
			$request_data = array(
				'send_id' =>$this->send_id,
				'recv_id' => $this->recv_id,
				'request_date' => NOW,
				'accept_date' => Null,
				'contents' => $contents,
				'status' => '',
				'send_user_nick' => $this->send_user_nick,
				'mode'		=> $mode_gubn
			);

			$this->ci->db->insert('chat_request', $request_data);
			$this->chat_req = 	 $this->ci->db->insert_id();

			$this->ci->db->insert('chat_request_backup', $request_data);		//백업데이터
		}		

		//본문에 "채팅 내용" 추가
		$this->chatting_save($contents);

		//본문에 채팅 신청내용추가
		$this->chatting_save($this->send_user_nick." 님이 채팅신청을 보냈습니다.","request");

		//본문에 채팅 "신청내용" 추가 (상대방것도)
		$this->chatting_save("채팅신청을 보냈습니다.","request",$swap = true);

		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->ci->chat_m->last_chat_data_insert($this->chat_req);

		//신규 채팅신청 알림 추가
		$user_pic = $this->ci->member_lib->member_thumb($this->send_id,74,71);

		$alrim_data = array(
			'mode' => 'chat',
			'send_id' => $this->send_id,
			'user_pic' => rawurldecode($user_pic),
			'recv_id' => $this->recv_id,
			'new_text' => $contents,
			'new_nick' => $this->send_user_nick,
			'idx' => $this->chat_req
		);

		$rtn = $this->ci->chat_m->add_alrim($alrim_data);
		
		//GCM 알림 처리
		gcm_send($this->recv_id, "조이헌팅 채팅", $this->send_user_nick." 님이 채팅신청을 보냈습니다.");
		
		//여성전용 이벤트 데이터 insert(여성만 가능)
		if($this->ci->session->userdata['m_sex'] == "F"){
			call_woman_event_data_reg('request', $this->send_id, $this->recv_id);
		}

		return $rtn;

	}
	
	//일반 채팅 보내기
	function chatting_submit($contents){
		$this->check_init();
 
		//승인된 채팅인지 체크
		$strSQL = " SELECT * FROM chat_request WHERE ((recv_id = '".$this->recv_id."' and send_id = '".$this->send_id."') or (recv_id = '".$this->send_id."' and send_id = '".$this->recv_id."')) and is_delete IS NULL ";
		$query = $this->ci->db->query($strSQL);
		$data = $query->row_array();

		if(empty($data['idx'])){
			return "not-ready";	//ajax를위해 리턴
		}else if($data['status']=="거절"){
 			return "deny";
		}else if($data['status']=="나감"){
			return "exit";
		}else if($data['status']!="수락"){
			return "not-ready";
		}

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($this->send_id, $this->recv_id);
		if($cnt > 0){ return "bad"; }

		//살제 메시지 보내기
		$this->set_send_id($this->send_id);
		$this->set_recv_id($this->recv_id);
		$rtn = $this->chatting_save($contents);


		//여성전용 이벤트 데이터 insert(여성만 가능)
		if($this->ci->session->userdata['m_sex'] == "F"){
			call_woman_event_data_reg('chat', $this->send_id, $this->recv_id);
		}

		return $rtn;

	}

	//실제 메시지 보내기 (공용)
	function chatting_save($contents, $mode = 'chat', $swap_id = false){
		$this->check_init();

		if($swap_id == true){
			$send_id = $this->recv_id;	//채팅신청에서 (mode:request) 사용하기 위한 아이디 맞바꿈.
			$recv_id = $this->send_id;	//채팅신청문구는 닉네임을 사용하지 않으므로 무기.
		}else{
			$recv_id = $this->recv_id;
			$send_id = $this->send_id;
		}

		//채팅 내용추가
		$chat_data = array(
			'mode' => $mode,
			'send_id' =>$send_id,
			'recv_id' => $recv_id,
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => $contents,
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'send_user_nick' => $this->send_user_nick,
			'req_idx'		 => $this->chat_req
		);
		$last_id = $this->ci->chat_m->add_chat($chat_data);
		
		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->ci->chat_m->last_chat_data_insert($this->chat_req);

		if($mode == "chat"){	//특정할때만 메시지 도착 발송
			//메시지 도착 알림내역 추가
			$user_pic = $this->ci->member_lib->member_thumb($this->send_id,74,71);

			$alrim_data = array(
				'mode' => 'msg',
				'send_id' => $this->send_id,
				'user_pic' => rawurldecode($user_pic),
				'recv_id' => $this->recv_id,
				'new_text' => $contents,
				'new_nick' => $this->send_user_nick,
				'idx' => $last_id
			);
			$rtn = $this->ci->chat_m->add_alrim($alrim_data);

			//GCM 알림 처리 (alrim_helper)
			gcm_send($this->recv_id, "조이헌팅 채팅", $this->send_user_nick." : ".$contents);
		}

		return $last_id;

	}


	//채팅방번호 자동 셋팅하기
	private function auto_set_chat_req(){
		if(empty($this->send_id) or empty($this->recv_id)){	
			$this->error("아이디가 셋팅되지 않았습니다.",__FUNCTION__);
		}

		$strSQL = " SELECT * FROM chat_request WHERE ((recv_id = '".$this->recv_id."' and send_id = '".$this->send_id."') or (recv_id = '".$this->send_id."' and send_id = '".$this->recv_id."')) ";
		$query = $this->ci->db->query($strSQL);
		$data = $query->row_array();

		if(!empty($data['idx'])){
			$this->chat_req = $data['idx'];		//아직 방이 개설하지 않았을경우는 방번호 미설정
		}
	}

	//초기화 여부
	private function check_init(){
		if($this->is_init == false){
			$this->error("초기화가 되지 않았습니다.",__FUNCTION__);
		}
	}

	//로그인 여부
	private function check_login(){
		if($this->ci->session->userdata('m_userid') == ""){
			$this->error("로그인이 안됐습니다.",__FUNCTION__); 
		}
	}

	//디버그모드일때 텍스트 에러출력
	 private function error($msg,$function){
		if($this->debug_mode == true && ($this->ci->input->ip_address() == "14.47.36.51" or $this->ci->input->ip_address() == "59.11.70.223") ){
			echo $msg." ($function)<br>";
			return false;
		}else{
			return false;
		}
	 }

}
?>