<?PHP
class Chat_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//신규 알림 추가
	function add_alrim($data)
	{
		if(!$this->select_alrim($data['recv_id'])){
			//신규추가
			$arr_data = array(
					'user_id' => $data['recv_id'],
					$data['mode'].'_new_cnt' => 1,
					$data['mode'].'_new_userid' => $data['send_id'],
					$data['mode'].'_new_pic' => $data['user_pic'],
					$data['mode'].'_new_nick' => $data['new_nick'],
					$data['mode'].'_new_text' => $data['new_text'],
					$data['mode'].'_pop_idx' => $data['idx']
				);
			$rtn = $this->db->insert("alrim_new", $arr_data);			

		}else{
			//업데이트
			$this->db->where('user_id', $data['recv_id']);
			$arr_data = array(
					$data['mode'].'_new_userid' => $data['send_id'],
					$data['mode'].'_new_pic' => $data['user_pic'],
					$data['mode'].'_new_nick' => $data['new_nick'],
					$data['mode'].'_new_text' => $data['new_text'],
					$data['mode'].'_pop_idx' => $data['idx']
				);
			$rtn = $this->db->update("alrim_new", $arr_data);			

			//알림수 증가
			if($data['mode'] == "chat"){
				$this->db->set($data['mode'].'_new_cnt', '(SELECT COUNT(*) cnt FROM chat_request WHERE recv_id = "'.$data['recv_id'].'" AND is_delete IS NULL)', FALSE);
			}else{
				$this->db->set($data['mode'].'_new_cnt', '`'.$data['mode'].'_new_cnt` + 1', FALSE);
			}			
			$this->db->where('user_id', $data['recv_id']);
			$this->db->update('alrim_new');
		}

		//조이헌팅 알림 URL이 있을경우 추가로 업데이트
		if(!empty($data['joy_pop_url'])){

			$this->db->where('user_id', $data['recv_id']);
			$arr_data = array(
					'joy_pop_url' => $data['joy_pop_url']
				);
			$rtn = $this->db->update("alrim_new", $arr_data);

		}


		return $rtn;
	}

	//알림 내역 가져오기
	function select_alrim($user_id)
	{
		$this->db->select('*');
  		$this->db->where('user_id',$user_id);
		$query = $this->db->get('alrim_new');

        return $query->row_array();		
	}

	//알림 내역 데이터 비우기
	function clear_alrim($user_id){
			$data_arr= array(
				'chat_new_text' => '', 
				'chat_new_nick' => '', 
				'chat_new_pic' => '', 
				'chat_new_userid' => '',
				'chat_pop_idx' => Null
			);

			//데이터 비우기
			$this->db->where('user_id', $user_id);
			$this->db->update('alrim_new', $data_arr);
	}


	//채팅 신청 추가
	function add_request_chat($data)
	{
			$this->db->insert('chat_request', $data);
			$last_id = $this->db->insert_id();

			$this->db->insert('chat_request_backup', $data);		//백업데이터
			return $last_id;
	}

	//채팅 신청내역 가져오기
	function select_request_chat($send_id, $recv_id)
	{
		$this->db->select('*');
  		$this->db->where('send_id',$send_id);
  		$this->db->where('recv_id',$recv_id);
		$this->db->where('is_delete', null);
		$query = $this->db->order_by('idx', 'desc')->limit(1)->get('chat_request');

        return $query->row_array();		
	}

	

	//채팅 데이터 추가
	function add_chat($data){

		//백업 데이타 추가
		//if($data['mode'] == "chat" or $data['mode'] == "chat_req"){
			$this->db->insert('chat_backup', $data);
		//}

		$this->db->insert('chat', $data);

		$last_id = $this->db->insert_id();	

		return $last_id;
	}


	//채팅 신청 데이터 수정
	function mod_chat_request($data_arr,$userid){

		$this->db->where('is_delete', null);
		$this->db->where('status', '');
		$this->db->where('send_id', $userid);
		$this->db->where('recv_id', $this->session->userdata('m_userid'));
		$this->db->update('chat_request', $data_arr);
	}


	//채팅 수락 또는 거절시 알림 데이터 수정
	function mod_alrim_new($data_arr,$user_id){

		//신규 메시지 갯수 1개 줄이기
		$cnt_row = $this->select_alrim($this->session->userdata('m_userid'));
		if($cnt_row['chat_new_userid'] != ""){
			$this->clear_alrim($this->session->userdata('m_userid')); //알림 데이터 비우기
		}

	}


	//채팅 리스트에서 한개 삭제
	function chat_list_delete($idx){
		 $this->db->where('recv_id', $this->session->userdata('m_userid'));
		 $this->db->where('idx', $idx);

		 $this->db->update('chat_request', array('alrim_del' => 'D'));
		 $this->db->last_query();

		//알림 숫자 1빼기
		$cnt_row = $this->select_alrim($this->session->userdata('m_userid'));

		//알림숫자 줄이기 (마이너스 방지)
		if($cnt_row['chat_new_cnt'] > 0){
			$this->db->where('user_id', $this->session->userdata('m_userid'));
			$data_arr2['chat_new_cnt'] = $cnt_row['chat_new_cnt'] - 1;
			$this->db->update('alrim_new', $data_arr2);
		}


	}

	//채팅 리스트에서 전체삭제
	function chat_list_delete_all(){
		 $this->db->where('recv_id', $this->session->userdata('m_userid'));
		 $this->db->update('chat_request', array('alrim_del' => 'D'));
		 $this->db->last_query();

		//알림숫자 줄이기 (0만들기)
		$this->db->where('user_id', $this->session->userdata('m_userid'));
		$data_arr2['chat_new_cnt'] =0;
		$this->db->update('alrim_new', $data_arr2);
		echo $this->db->last_query();

	}


	//메시지 리스트에서 한개 읽음으로 빼기
	function msg_list_delete($idx){
		$where_arr = array('idx' => $idx, 'recv_id '=>$this->session->userdata('m_userid'));
      	$this->db->where($where_arr)->update('chat', array('read_date '=>NOW));

		//알림 숫자 1빼기
		$cnt_row = $this->select_alrim($this->session->userdata('m_userid'));

		//알림숫자 줄이기 (마이너스 방지)
		if($cnt_row['msg_new_cnt'] > 0){
			$this->db->where('user_id', $this->session->userdata('m_userid'));
			$data_arr2['msg_new_cnt'] = $cnt_row['msg_new_cnt'] - 1;
			$this->db->update('alrim_new', $data_arr2);
		}


	}

	//메시지 리스트에서 전체 읽음으로 빼기
	function msg_list_delete_all(){
		$where_arr = array('recv_id '=>$this->session->userdata('m_userid'));
      	$this->db->where($where_arr)->update('chat', array('read_date '=>NOW));

		//알림숫자 줄이기 (0만들기)
		$this->db->where('user_id', $this->session->userdata('m_userid'));
		$data_arr2['msg_new_cnt'] =0;
		$this->db->update('alrim_new', $data_arr2);
		echo $this->db->last_query();

	}


	//조이헌팅 알림 리스트에서 한개 삭제
	function joy_list_delete($idx){
		$where_arr = array('idx' => $idx, 'user_id '=>$this->session->userdata('m_userid'));
      	$this->db->delete('alrim_msg', $where_arr);

		//알림 숫자 1빼기
		$cnt_row = $this->select_alrim($this->session->userdata('m_userid'));

		//알림숫자 줄이기 (마이너스 방지)
		if($cnt_row['joy_new_cnt'] > 0){
			$this->db->where('user_id', $this->session->userdata('m_userid'));
			$data_arr2['joy_new_cnt'] = $cnt_row['joy_new_cnt'] - 1;
			$this->db->update('alrim_new', $data_arr2);
		}


	}

	//조이헌팅 알림 리스트에서 전체 삭제
	function joy_list_delete_all(){
		$where_arr = array('user_id '=>$this->session->userdata('m_userid'));
      	$this->db->delete('alrim_msg', $where_arr);

		//알림숫자 줄이기 (0만들기)
		$this->db->where('user_id', $this->session->userdata('m_userid'));
		$data_arr2['joy_new_cnt'] =0;
		$this->db->update('alrim_new', $data_arr2);
		echo $this->db->last_query();

	}

	//거절시 채팅 모두 읽음처리 ($idx = 채팅방 번호)
	function deny_last_chat_update($idx){
		//아직 미사용
		$sql = "";
		$sql .= " UPDATE chat ";
		$sql .= " SET read_date = SYSDATE() ";
		$sql .= " WHERE req_idx = '".$idx."' AND read_date IS NULL ";

		$this->db->query($sql);
	}



	//이미 채팅중인지 혹은 채팅방이 살아있는지 여부 확인
	//데이터가 없을 경우 이미 채팅중, 데이터가 있을경우 한사람이라도 채팅방을 나간경우
	function already_chat_yn($user_id, $mode, $req_idx = null){

		if($mode == 'already'){
			//이미 대화충 체크
			$strSQL = "";
			$strSQL .= " SELECT * ";
			$strSQL .= " FROM chat_request ";
			$strSQL .= " WHERE ((send_id = '".$this->session->userdata['m_userid']."' AND recv_id = '".$user_id."') OR (send_id = '".$user_id."' AND recv_id = '".$this->session->userdata['m_userid']."')) ";
			$strSQL .= " AND (STATUS = '수락' OR STATUS = '나감') AND is_delete IS NULL ";
			$strSQL .= " ORDER BY idx desc LIMIT 1 ";

		}else if($mode == 'del'){

			$strSQL = "";
			$strSQL .= " SELECT * FROM chat_request ";
			$strSQL .= " WHERE ((send_id = '".$this->session->userdata['m_userid']."' AND recv_id = '".$user_id."') OR (send_id = '".$user_id."' AND recv_id = '".$this->session->userdata['m_userid']."')) ";
			$strSQL .= " AND is_delete IS NULL ";
			$strSQL .= " ORDER BY idx desc LIMIT 1 ";

		}else if($mode == "deny"){
			
			$strSQL = "";
			$strSQL .= " SELECT * ";
			$strSQL .= " FROM chat_request ";
			$strSQL .= " WHERE ((send_id = '".$this->session->userdata['m_userid']."' AND recv_id = '".$user_id."') OR (send_id = '".$user_id."' AND recv_id = '".$this->session->userdata['m_userid']."')) ";
			$strSQL .= " AND STATUS = '거절' AND is_delete IS NULL ";
			$strSQL .= " ORDER BY idx desc LIMIT 1 ";

		}else{
			//채팅방을 한명이라도 나갔을경우 체크
			$strSQL = "";
			$strSQL .= " SELECT * ";
			$strSQL .= " FROM chat  ";
			$strSQL .= " WHERE (MODE = 'exit' or MODE = 'deny') AND req_idx = '".$req_idx."' AND is_delete_send <> '0' AND is_delete_recv = '0' ";
			$strSQL .= " ORDER BY idx desc LIMIT 1 ";

		}		

		$query = $this->db->query($strSQL);

		return $query->row_array();

	}

	//채팅을 신청한 회원에게 계속된 채팅신청 가능처리
	function chat_member_ban($user_id){
		
		$strSQL = " SELECT * FROM chat_request WHERE recv_id = '".$user_id."' and send_id = '".$this->session->userdata['m_userid']."' AND STATUS = '' AND is_delete IS NULL ";

		$query = $this->db->query($strSQL);

		return $query->row_array();

	}
	

	//채팅방 idx 가져오기
	function chat_request_idx($user_id){

		$strSQL = "";
		$strSQL .= " SELECT * ";
		$strSQL .= " FROM chat_request ";
		$strSQL .= " WHERE (send_id = '".$user_id."' AND recv_id = '".$this->session->userdata['m_userid']."' OR send_id = '".$this->session->userdata['m_userid']."' AND recv_id = '".$user_id."') ";
		$strSQL .= " AND is_delete IS NULL ";
		$strSQL .= " ORDER BY idx desc ";
		$strSQL .= " LIMIT 1 ";

		$query = $this->db->query($strSQL);

		return $query->row_array();
	}

	

	//채팅을 신청할경우 채팅신청이 들어와있는지 혹은 채팅중인 사람인지 체크하기
	function chat_status_gubn($user_id){
		
		$my_id = $this->session->userdata['m_userid'];

		$strSQL = "";
		$strSQL .= " SELECT * ";
		$strSQL .= " FROM chat_request ";
		$strSQL .= " WHERE ((send_id = '".$my_id."' AND recv_id = '".$user_id."') OR (send_id = '".$user_id."' AND recv_id = '".$my_id."')) ";
		$strSQL .= " AND STATUS IN('', '수락') AND is_delete IS NULL ";
		$strSQL .= " ORDER BY idx DESC LIMIT 1 ";
		
		$query = $this->db->query($strSQL);

		return $query->row_array();

	}



	/*--------------------------------------------------------------------------------*/
	//채팅 리뉴얼  모델 (작업용)
	/*--------------------------------------------------------------------------------*/
	//chat_request 테이블에 마지막 채팅 순번, 내용, 날짜 insert ($idx = 채팅방 번호)
	function last_chat_data_insert($idx){
		
		if(empty($idx)){ return; }	

		//마지막 채팅 내역 가져오기
		$chat_data = $this->my_m->row_array('chat', array('req_idx' => $idx), 'idx', 'desc', '1');
		
		$rtn = "";
		//chat_reqeust에 마지막 대화 순번, 내용, 시간 업데이트처리
		if(!empty($chat_data)){
			$rtn = $this->my_m->update('chat_request', array('idx' => $idx), array("chat_idx" => $chat_data['idx'], "chat_contents" => $chat_data['contents'], "chat_date" => $chat_data['reg_date']));

			//읽지 않은 채팅 카운트 업데이트 하기
			$this->last_chat_cnt_up($idx);
			
		}		

		return $rtn;
	}
	
	//채팅방 나가기 기능 보완
	//chat_request 테이블에 나간회원 컬럼 체크후 나가기 처리 ($idx = 채팅방 번호, $my_id = 나가기를 누른 회원, $user_id = 상대방 아이디)
	function last_chat_exit_check($idx, $my_id, $user_id){
			
		//채팅방 나간회원 필드 체크하기
		$req_data = $this->my_m->row_array('chat_request', array('idx' => $idx), 'idx', 'desc', '1');
		if(empty($req_data)){ return; }		//채팅방 데이터가 업을경우 return; 
		
		$result = "";
		if(empty($req_data['out_member'])){
			//먼저 나간 회원이 없을 경우
			
			//$my_id 회원 데이터 가져오기
			$my_data = $this->my_m->row_array('TotalMembers', array('m_userid' => $my_id), 'm_num', 'desc', '1');

			//상대방에게 나가기 메세지 추가하기
			$arrData = array(
				"mode"				=> "exit",
				"send_id"			=> $my_data['m_userid'],
				"recv_id"			=> $user_id,
				"reg_date"			=> NOW,
				"contents"			=> $my_data['m_nick']."님이 채팅방을 나가셨습니다.",
				"send_ip"			=> $_SERVER['REMOTE_ADDR'],
				"send_user_nick"	=> $my_data['m_nick'],
				"req_idx"			=> $idx
			);
			
			$this->my_m->insert('chat', $arrData);
			$this->my_m->insert('chat_backup', $arrData);
			
			//채팅방을 먼저 나갈경우 마지막 데이터 채팅방 테이블에 업데이트 처리
			$this->last_chat_data_insert($idx);

			//먼저 나간 회원 나가기 처리
			$result = $this->my_m->update('chat_request', array('idx' => $idx), array('status' => '나감', 'out_member' => $my_data['m_userid']));

		}

		return $result;

	}

	//서로의 채팅 읽지 않은 채팅 카운트 업데이트 처리($idx = 채팅방 번호)
	function last_chat_cnt_up($idx){

		//채팅방 데이터 조회하기
		$req_data = $this->my_m->row_array('chat_request', array('idx' => $idx), 'idx', 'desc', '1');
		if(empty($req_data)){ return; }		//채팅방 데이터가 업을경우 return; 
		
		//채팅방 번호 셋팅
		$req_idx = $req_data['idx'];

		//발송자 및 수신자 채팅 읽지 않은 채팅 카운트 업데이트 처리(for문 처리)
		for($i=0; $i<2; $i++){

			//$i = 0 일때 발송자 $i = 1 일때 수신자 업데이트 처리
			if($i == 0){
				$user_cnt	= "send_cnt";				//업데이트 변수 셋팅
				$recv_id	= $req_data['send_id'];		//발송자 아이디
			}else if($i == 1){
				$user_cnt	= "recv_cnt";				//업데이트 변수 셋팅
				$recv_id	= $req_data['recv_id'];		//수신자 아이디
			}else{
				//잘못된 접근 for문 중지
				break;
			}

			$sql = "";
			$sql .= " update chat_request ";
			$sql .= " set ".$user_cnt." = ( ";
			$sql .= " select count(*) ";
			$sql .= " from chat ";
			$sql .= " where 1=1 ";
			$sql .= " and req_idx = '".$req_idx."' ";
			$sql .= " and recv_id = '".$recv_id."' ";
			$sql .= " and read_date is null ";
			$sql .= " and is_delete_gubn is null ";
			$sql .= " and (mode = 'chat_req' OR mode = 'chat' OR mode = 'deny' OR mode = 'gift' OR mode = 'gift_req' OR mode = 'exit') ";
			$sql .= " ) ";
			$sql .= " where idx = '".$req_idx."' "; 

			$this->db->query($sql);
		}

		return;

	}

	//채팅방 나가기용 대기 또는 수락된 채팅방 내역 가져오기
	function last_chat_status_request($my_id, $user_id){

		$sql = "";
		$sql .= " SELECT * ";
		$sql .= " FROM chat_request ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND (status = '' OR status = '수락' OR status = '나감') ";
		$sql .= " AND (send_id = '".$user_id."' AND recv_id = '".$my_id."' OR send_id = '".$my_id."' AND recv_id = '".$user_id."')  ";
		$sql .= " AND is_delete IS NULL ";
		$sql .= " ORDER BY idx DESC ";
		$sql .= " LIMIT 1 ";

		$query = $this->db->query($sql);

		return $query->row_array();
	}

	//채팅방 들어왔을경우 받은 채팅 카운트 업데이트 처리
	function chat_read_cnt_up($my_id, $user_id){

		if(empty($my_id) or empty($user_id)){ return; }


		//채팅 리스트 내역 조회하기
		$sql = "";
		$sql .= " SELECT * ";
		$sql .= " FROM chat_request ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND (send_id = '".$user_id."' AND recv_id = '".$my_id."') OR (send_id = '".$my_id."' AND recv_id = '".$user_id."') ";
		$sql .= " AND STATUS = '수락' ";
		$sql .= " AND is_delete IS NULL ";
		$sql .= " ORDER BY idx DESC ";
		$sql .= " LIMIT 1 ";

		$query = $this->db->query($sql);

		$list_data = $query->row_array();

		if(!empty($list_data)){

			$gubn = "";
			if($list_data['send_id'] == $my_id){ $gubn = "send"; }
			if($list_data['recv_id'] == $my_id){ $gubn = "recv"; }
			
			$sql = "";
			$sql .= " update chat_request ";
			$sql .= " set ".$gubn."_cnt = '0' ";
			$sql .= " where idx = '".$list_data['idx']."' ";
			
			$this->db->query($sql);
		}

	}

}

?>