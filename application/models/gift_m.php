<?PHP
class Gift_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//보낸선물함 및 받은선물함
	function gift_box($start = null, $rp = null, $search, $user_id, $gubn = 'chat'){

		$sql = "";
		$sql .= " SELECT A.V_IDX, A.V_SEND_ID ";
		$sql .= " , (SELECT B.m_nick FROM TotalMembers B WHERE B.m_userid = A.V_SEND_ID) SEND_NICK ";
		$sql .= " , (SELECT B.m_age FROM TotalMembers B WHERE B.m_userid = A.V_SEND_ID) SEND_AGE ";
		$sql .= " , (SELECT B.m_sex FROM TotalMembers B WHERE B.m_userid = A.V_SEND_ID) SEND_SEX ";
		$sql .= " , A.V_RECV_ID ";
		$sql .= " , (SELECT B.m_nick FROM TotalMembers B WHERE B.m_userid = A.V_RECV_ID) RECV_NICK ";
		$sql .= " , (SELECT B.m_age FROM TotalMembers B WHERE B.m_userid = A.V_RECV_ID) RECV_AGE ";
		$sql .= " , (SELECT B.m_sex FROM TotalMembers B WHERE B.m_userid = A.V_RECV_ID) RECV_SEX ";
		$sql .= " , A.V_GIFT_NUM, (SELECT B.V_PRODUCT_NAME FROM GIFT_LIST B WHERE A.V_GIFT_NUM = B.V_IDX) GIFT_NAME, A.V_RECV_YN, A.V_SEND_DATE ";
		$sql .= " , TO_DAYS(CAST(DATE_ADD(A.V_SEND_DATE, INTERVAL 30 DAY) AS DATE)) - TO_DAYS(SYSDATE()) USE_DATE, A.V_SEND_YN ";
		$sql .= " FROM GIFT_SEND A ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND A.".$search." = '".$user_id."' ";
		$sql .= " AND A.V_DEL_GUBN IS NULL ";
		$sql .= " ORDER BY A.V_IDX DESC ";
		
		if(!empty($start) and !empty($rp)){
			$limit = " LIMIT ".$start.", ".$rp." ";
		}
		
		$query1 = $this->db->query($sql.@$limit);
		$query2 = $this->db->query($sql);

			
		if(IS_MOBILE == true){
			//MOBILE버전의 경우		
			return $query2->result_array();
		}else{
			//PC버전의 경우
			if($gubn == 'chat'){
				return $query2->result_array();
			}else{
				return array($query1->result_array(), $query2->num_rows());
			}			
		}
		
	}


}
?>
