<?PHP
class Service_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	//이벤트 리스트
	function event_list($start, $rp, $search, $v_table){

		$this->db->start_cache();
		$this->db->select('*')->from($v_table);
			
		if (@$search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$this->db->where($value);
					}else{
						$this->db->where($key, $value);
					}
				}
			}
		}		

		$this->db->stop_cache();

		$query = $this->db->order_by('m_idx', 'desc')->limit($rp, $start)->get();
		$totalRows = $this->db->count_all_results();
		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);

	}

	//여성전용 이벤트관련 함수
	//본인의 오늘날짜에 해당하는 미션클리어 횟수
	function woman_mission_data($user_id){
		
		$sql = "";
		$sql .= " SELECT DATE(A.V_WRITE_DATE) DATE, A.V_SEND_ID USER_ID ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'request' AND B.V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND B.V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00') REQ_CNT ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'chat' AND B.V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND B.V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00') CHAT_CNT ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'msg' AND B.V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND B.V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00') MSG_CNT ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'gift' AND B.V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND B.V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00') GIFT_CNT ";
		$sql .= " FROM WOMAN_EVENT A ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND A.V_SEND_ID = '".$user_id."' ";
		$sql .= " AND A.V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND A.V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00' ";
		$sql .= " GROUP BY A.V_SEND_ID ";

		$query = $this->db->query($sql);

		return $query->row_array();
	}

	//선물받은 회원 내역 리스트
	function woman_event_gift_list($event_code){

		$sql = "";
		$sql .= " SELECT A.V_IDX IDX, A.V_RECV_ID RECV_ID, B.m_nick NICK, A.V_SEND_DATE SEND_DATE, (SELECT C.V_PRODUCT_NAME FROM GIFT_LIST C WHERE C.V_IDX = A.V_GIFT_NUM) GIFT_NAME ";
		$sql .= " FROM GIFT_SEND A, TotalMembers B ";
		$sql .= " WHERE A.V_RECV_ID = B.m_userid ";
		$sql .= " AND A.V_EVENT_CODE = 'WOMAN_EVENT_01' ";
		$sql .= " ORDER BY A.V_IDX DESC ";
		$sql .= " LIMIT 50 ";

		$query = $this->db->query($sql);

		return $query->result_array();

	}
	

}

?>
