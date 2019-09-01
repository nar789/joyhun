<?PHP
	
	class Gift_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//공통쿼리(선물리스트, 배송관리 공통쿼리)
	function gift_common_query(){

		$sql = "";
		$sql .= " SELECT A.* ";
		$sql .= " FROM( ";
		$sql .= " SELECT B.V_IDX IDX, B.V_SEND_ID SEND_ID, B.V_RECV_ID RECV_ID, B.V_GIFT_NUM GIFT_NUM, B.V_RECV_YN RECV_YN, B.V_SEND_YN SEND_YN, B.V_SEND_DATE SEND_DATE ";
		$sql .= " , B.V_RECV_DATE RECV_DATE, B.V_DELI_DATE DELI_DATE, B.V_DEL_GUBN DEL_GUBN ,A.V_CATEGORY CATEGORY, A.V_VENDOR VENDOR, A.V_PRODUCT_CODE GIFT_CODE ";
		$sql .= " , A.V_PRODUCT_NAME GIFT_NAME, A.V_DELIVERY DELIVERY, A.V_PRICE_P PRICE_P, A.V_PRICE_W PRICE_W, A.V_IMG_URL IMG_URL ";
		$sql .= " , (SELECT C.m_num FROM TotalMembers C where C.m_userid = B.V_SEND_ID) SEND_NUM ";
		$sql .= " , (SELECT C.m_nick FROM TotalMembers C where C.m_userid = B.V_SEND_ID) SEND_NICK ";
		$sql .= " , (SELECT C.m_num FROM TotalMembers C where C.m_userid = B.V_RECV_ID) RECV_NUM ";
		$sql .= " , (SELECT C.m_nick FROM TotalMembers C where C.m_userid = B.V_RECV_ID) RECV_NICK ";
		$sql .= " , (SELECT C.m_partner FROM TotalMembers C where C.m_userid = B.V_SEND_ID) SEND_PARTNER ";
		$sql .= " , (SELECT C.m_partner FROM TotalMembers C where C.m_userid = B.V_RECV_ID) RECV_PARTNER ";
		$sql .= " , B.V_EVENT_CODE, B.V_EVENT_HP ";
		$sql .= " FROM GIFT_LIST A, GIFT_SEND B ";
		$sql .= " WHERE A.V_IDX =  B.V_GIFT_NUM ";
		$sql .= " AND B.V_DEL_GUBN IS NULL ";
		$sql .= " ) A ";
		$sql .= " WHERE 1=1 ";

		return $sql;
	}


	//선물리스트
	function member_gift_list($start, $rp, $vendor, $category, $delivery, $gift_stat, $gift_name, $gift_num, $gift_code, $date_1, $date_2, $s_user_id, $s_user_num, $s_nick, $r_user_id, $r_user_num, $r_nick){
		
		//공통 sql문 가져오기
		$sql = $this->gift_common_query();

		//검색조건이 있을경우
		if($vendor){		$sql .= " AND A.VENDOR = '".$vendor."' ";			}
		if($category){		$sql .= " AND A.CATEGORY = '".$category."' ";		}
		if($delivery){		$sql .= " AND A.DELIVERY = '".$delivery."' ";		}
		if($gift_stat){		$sql .= " AND A.RECV_YN = '".$gift_stat."' ";		}
		if($gift_name){		$sql .= " AND A.GIFT_NAME = '".$gift_name."' ";		}
		if($gift_num){		$sql .= " AND A.GIFT_NUM = '".$gift_num."' ";		}
		if($gift_code){		$sql .= " AND A.GIFT_CODE = '".$gift_code."' ";		}
		if($date_1){		$sql .= " AND A.SEND_DATE >= '".$date_1." 00:00:00' ";		}
		if($date_2){		$sql .= " AND A.SEND_DATE <= '".$date_2." 24:00:00' ";		}
		if($s_user_id){		$sql .= " AND A.SEND_ID = '".$s_user_id."' ";		}
		if($s_user_num){	$sql .= " AND A.SEND_NUM = '".$s_user_num."' ";		}
		if($s_nick){		$sql .= " AND A.SEND_NICK = '".$s_nick."' ";		}
		if($r_user_id){		$sql .= " AND A.RECV_ID = '".$r_user_id."' ";		}
		if($r_user_num){	$sql .= " AND A.RECV_NUM = '".$r_user_num."' ";		}
		if($r_nick){		$sql .= " AND A.RECV_NICK = '".$r_nick."' ";		}

		$sql .= " ORDER BY A.IDX DESC ";

		$limit = " LIMIT ".$start.", ".$rp." ";

		$query1 = $this->db->query($sql.$limit);
		$query2 = $this->db->query($sql);
		
		return array($query1->result_array(), $query2->num_rows(), $query2->result_array());
	}

	//배송관리 리스트
	function member_delivery_list($start, $rp, $vendor, $category, $delivery, $gift_stat, $gift_name, $gift_num, $gift_code, $date_1, $date_2, $user_id, $user_num, $user_nick, $partner, $product_num){
		
		//공통 sql문 가져오기
		$sql = $this->gift_common_query();

		//검색조건이 있을경우
		if($vendor){		$sql .= " AND A.VENDOR = '".$vendor."' ";			}
		if($category){		$sql .= " AND A.CATEGORY = '".$category."' ";		}
		if($delivery){		$sql .= " AND A.DELIVERY = '".$delivery."' ";		}
		if($gift_stat){		$sql .= " AND A.SEND_YN = '".$gift_stat."' ";		}
		if($gift_name){		$sql .= " AND A.GIFT_NAME = '".$gift_name."' ";		}
		if($gift_num){		$sql .= " AND A.GIFT_NUM = '".$gift_num."' ";		}
		if($gift_code){		$sql .= " AND A.GIFT_CODE = '".$gift_code."' ";		}
		if($date_1){		$sql .= " AND A.SEND_DATE >= '".$date_1." 00:00:00' ";		}
		if($date_2){		$sql .= " AND A.SEND_DATE <= '".$date_2." 24:00:00' ";		}
		if($user_id){		$sql .= " AND A.RECV_ID = '".$user_id."' ";		}
		if($user_num){		$sql .= " AND A.RECV_NUM = '".$user_num."' ";		}
		if($user_nick){		$sql .= " AND A.RECV_NICK = '".$user_nick."' ";		}
		if($partner){		$sql .= " AND A.RECV_PARTNER = '".$partner."' ";		}
		if($product_num){	$sql .= " AND A.IDX = '".$product_num."' ";		}

		$sql .= " ORDER BY A.IDX DESC ";
		
		$limit = " LIMIT ".$start.", ".$rp." ";

		$query1 = $this->db->query($sql.$limit);
		$query2 = $this->db->query($sql);
		
		return array($query1->result_array(), $query2->num_rows());

	}
	

}

?>
