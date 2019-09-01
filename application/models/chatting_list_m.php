<?PHP
class Chatting_list_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
		
	//채팅리스트 쿼리
	//마지막 채팅 순번, 마지막 채팅 내용, 마지막 채팅 시간, 나간사람, 거절자, 개인 읽지 않은 채팅 갯수 포함
	function get_chatting_list_new($rp, $start){

		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ exit; }

		$sql = "";
		$sql .= " select a.*, b.m_nick, b.m_age, b.m_sex, b.m_conregion, b.m_conregion2 ";
		$sql .= " from ";
		$sql .= " ( ";
		$sql .= " select a.idx, a.request_date, a.mode, a.chat_idx, a.chat_contents, a.chat_date, a.out_member, a.send_id ";
		$sql .= " , (case when a.status = '' then '대기' else a.status end) status ";
		$sql .= " , (case when a.send_id = '".$user_id."' then ifnull(a.send_cnt, 0) else ifnull(a.recv_cnt, 0) end) cnt ";
		$sql .= " , (case when a.send_id = '".$user_id."' then a.recv_id else a.send_id end) user_id ";
		$sql .= " , a.deny_id ";
		$sql .= " from chat_request a ";
		$sql .= " where 1=1 ";
		$sql .= " and (a.send_id = '".$user_id."' or a.recv_id = '".$user_id."') ";
		$sql .= " and (a.out_member <> '".$user_id."' or a.out_member is null) ";
		$sql .= " AND a.is_delete IS NULL ";
		$sql .= " ) a, TotalMembers b ";
		$sql .= " where 1=1 ";
		$sql .= " and a.user_id = b.m_userid ";
		$sql .= " and (a.deny_id <> '".$user_id."' or a.deny_id is null) ";
		$sql .= " order by a.cnt desc, a.idx desc ";
		$sql .= " limit 99 "; 
		
		$query = $this->db->query($sql);

		//내부만 확인
		if($this->input->ip_address() == "115.23.169.232"){
			//echo $sql;
		}	

		return array($query->result_array(), $query->num_rows());
	}

}
?>