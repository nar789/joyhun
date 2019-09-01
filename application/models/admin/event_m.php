<?PHP
	
	class Event_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	//이벤트 등록 리스트
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



	//이벤트 등록시 게시물번호 생성
	function event_idx($v_table){
		
		$this->db->select('IFNULL(MAX(m_idx), 1000)+1 as m_idx', false);
		$query = $this->db->from($v_table)->get();

		return $query->row()->m_idx;
	}
	

	//여성전용 이벤트 리스트 
	function woman_event_list($start, $rp, $v_date_1, $v_date_2, $v_user_id){
		
		$sql = "";
		$sql .= " SELECT A.*, (CASE WHEN ISNULL(m_userid) = '0' THEN '회원' ELSE '탈퇴회원' END) V_GUBN, C.V_PRODUCT_NAME, C.V_PRODUCT_CODE ";
		$sql .= " FROM WOMAN_EVENT A ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " TotalMembers B ";
		$sql .= " ON A.V_SEND_ID = B.m_userid ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " GIFT_LIST C ";
		$sql .= " ON A.V_ETC = C.V_IDX ";
		$sql .= " WHERE 1=1 AND A.V_GUBN IS NULL ";

		if(!empty($v_date_1)){ $sql .= " AND A.V_WRITE_DATE >= '".$v_date_1." 00:00:00' "; }
		if(!empty($v_date_2)){ $sql .= " AND A.V_WRITE_DATE <= '".$v_date_2." 24:00:00' "; }
		if(!empty($v_user_id)){ $sql .= " AND A.V_SEND_ID = '".$v_user_id."' "; }

		$sql .= " ORDER BY A.V_IDX DESC ";
		
		$limit = " LIMIT ".$start.", ".$rp." ";

		$query1 = $this->db->query($sql.$limit);
		$query2 = $this->db->query($sql);

		return array($query1->result_array(), $query2->num_rows());
	}

	//여성전용 이벤트 개인별 통계
	function woman_event_member_stat($date_1, $date_2, $user_id){

		$sql = "";
		$sql .= " SELECT DATE(A.V_WRITE_DATE) DATE, A.V_SEND_ID SEND_ID ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'request' AND DATE(A.V_WRITE_DATE) = DATE(B.V_WRITE_DATE)) REQ_CNT ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'chat' AND DATE(A.V_WRITE_DATE) = DATE(B.V_WRITE_DATE)) CHAT_CNT ";
		$sql .= " ,(SELECT COUNT(*) FROM WOMAN_EVENT B WHERE A.V_SEND_ID = B.V_SEND_ID AND B.V_MODE = 'gift' AND DATE(A.V_WRITE_DATE) = DATE(B.V_WRITE_DATE)) GIFT_CNT ";
		$sql .= " FROM WOMAN_EVENT A ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND A.V_SEND_ID = '".$user_id."' ";
		$sql .= " AND A.V_WRITE_DATE >= '".$date_1." 00:00:00' AND A.V_WRITE_DATE <= '".$date_2." 24:00:00' ";
		$sql .= " GROUP BY DATE(A.V_WRITE_DATE) ";
		$sql .= " ORDER BY DATE(A.V_WRITE_DATE) DESC ";

		$query = $this->db->query($sql);

		return $query->result_array();
	}


	//여성전용 이벤트 통계
	function woman_event_stat($m_year, $m_month){
		
		//속도 때문에 쿼리 변경
		$sql = "";
		$sql .= " SELECT A.V_DATE, A.V_JOIN_CNT, B.V_SUCCESS_CNT, B.V_GIFT_CNT ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, COUNT(A.V_SEND_ID) V_JOIN_CNT ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_SEND_ID ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_GUBN IS NULL";
		$sql .= " GROUP BY DATE(V_WRITE_DATE), V_SEND_ID ";
		$sql .= " ) A ";
		$sql .= " GROUP BY A.V_DATE ";
		$sql .= " ) A ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, COUNT(A.V_SEND_ID) V_SUCCESS_CNT, SUM(A.GIFT_CNT) V_GIFT_CNT ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, A.V_SEND_ID, IFNULL(B.V_CNT, 0) CHAT_CNT, IFNULL(C.V_CNT, 0) REQ_CNT, IFNULL(D.V_CNT, 0) GIFT_CNT ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_SEND_ID ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_GUBN IS NULL";
		$sql .= " GROUP BY DATE(V_WRITE_DATE), V_SEND_ID ";
		$sql .= " ) A ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_SEND_ID, COUNT(V_SEND_ID) V_CNT ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_MODE = 'chat' AND V_GUBN IS NULL ";
		$sql .= " GROUP BY DATE(V_WRITE_DATE), V_SEND_ID ";
		$sql .= " ) B ";
		$sql .= " ON A.V_DATE = B.V_DATE AND A.V_SEND_ID = B.V_SEND_ID ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_SEND_ID, COUNT(V_SEND_ID) V_CNT ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_MODE = 'request' AND V_GUBN IS NULL ";
		$sql .= " GROUP BY DATE(V_WRITE_DATE), V_SEND_ID ";
		$sql .= " ) C ";
		$sql .= " ON A.V_DATE = C.V_DATE AND A.V_SEND_ID = C.V_SEND_ID ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_SEND_ID, COUNT(V_SEND_ID) V_CNT ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_MODE = 'gift' AND V_GUBN IS NULL ";
		$sql .= " GROUP BY DATE(V_WRITE_DATE), V_SEND_ID ";
		$sql .= " ) D ";
		$sql .= " ON A.V_DATE = D.V_DATE AND A.V_SEND_ID = D.V_SEND_ID ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND IFNULL(C.V_CNT, 0) >= '10' ";
		$sql .= " ) A ";
		$sql .= " GROUP BY A.V_DATE ";
		$sql .= " ) B ";
		$sql .= " ON A.V_DATE = B.V_DATE ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND SUBSTR(A.V_DATE, 1, 4) = '".$m_year."' AND SUBSTR(A.V_DATE, 6, 2) = '".$m_month."' ";
		$sql .= " ORDER BY V_DATE DESC ";
		
		$query = $this->db->query($sql);

		return $query->result_array();
	}


	//여성전용 리워드 이벤트 리스트 
	function reward_event_list($this_month){
		
		$sql = " select day(last_day('".$this_month."')) last_day ";

		$q = $this->db->query($sql);

		$last_day = $q->row()->last_day;
		
		$sql2 = "";
		$union = "union all";

		$m_date = explode('-', $this_month);
		$m_year		= $m_date[0];		//년
		$m_month	= $m_date[1];		//월

		$m_day = $m_year."-".$m_month;

		$m_last_day = $m_day."-".$last_day;		//해당달의 마지막 날짜

		for($i=$last_day; $i>=1; $i--){

			if($i == "1"){
				$union = "";
			}
		
			$sql2 .= " select '".$m_day."-".zero_num($i)."' m_day ".$union." ";	
		}
		
		$sql = "";
		$sql .= " SELECT A.m_day, B.R_POINT, B.G_POINT, B.R_USER, B.G_USER ";
		$sql .= " FROM ";
		$sql .= " (".$sql2.") A ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, A.V_POINT R_POINT, B.V_POINT G_POINT, A.R_USER, B.G_USER  ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, SUM(V_POINT) V_POINT, COUNT(DISTINCT V_SEND_ID) R_USER ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_MODE, V_SEND_ID ";
		$sql .= " ,(CASE WHEN V_MODE = 'request' THEN 20 ELSE 10 END) V_POINT ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE (V_MODE = 'request' OR V_MODE = 'msg') AND V_GUBN = 'REWARD' ";
		$sql .= " ) A ";
		$sql .= " GROUP BY V_DATE ";
		$sql .= " ) A, ";
		$sql .= " ( ";
		$sql .= " SELECT A.V_DATE, SUM(V_ETC) V_POINT, COUNT(DISTINCT V_RECV_ID) G_USER  ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(V_WRITE_DATE) V_DATE, V_MODE, V_SEND_ID, V_ETC, V_RECV_ID ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE V_MODE = 'receive' AND V_GUBN = 'REWARD' ";
		$sql .= " ) A ";
		$sql .= " GROUP BY V_DATE ";
		$sql .= " ) B ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND A.V_DATE = B.V_DATE ";
		$sql .= " ORDER BY A.V_DATE DESC ";
		$sql .= " ) B ";
		$sql .= " ON A.m_day = B.V_DATE ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND B.R_POINT IS NOT NULL ";
		$sql .= " AND B.G_POINT IS NOT NULL ";
		$sql .= " ORDER BY A.m_day DESC ";
		
		$query = $this->db->query($sql);
		
		return $query->result_array();

	}

	//매거진 등록시 게시물번호 생성
	function magazine_idx($v_table){
		
		$this->db->select('IFNULL(MAX(idx), 1000)+1 as idx', false);
		$query = $this->db->from($v_table)->get();

		return $query->row()->idx;
	}

	
	//조이헌팅 일대일 데이트 신청하기 리스트
	function event_love_list($start, $rp, $search, $q){

		$sql = "";
		$sql .= " select b.idx, b.user_id, a.m_name, a.m_sex, b.age, b.conregion, b.conregion2, b.intro, b.write_date ";
		$sql .= " from TotalMembers a, event_love_list b ";
		$sql .= " where 1=1 ";
		$sql .= " and a.m_userid = b.user_id ";
		$sql .= " and b.intro is not null ";

		if($search){ $sql .= " and a.".$search." = '".$q."' "; }

		$sql .= " order by b.idx desc ";

		$limit = " LIMIT ".$start.", ".$rp." ";
		
		$query1 = $this->db->query($sql.$limit);
		$query2 = $this->db->query($sql);

		return array($query1->result_array(), $query2->num_rows());
	}
}

?>
