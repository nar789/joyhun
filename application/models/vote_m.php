<?PHP
	class Vote_m extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}
		
		
		//투표 리스트
		function vote_list($start, $rp, $search, $v_table){

			$this->db->start_cache();
			$this->db->select('*')->from($v_table);
				
			if(@$search) {
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

			$query = $this->db->order_by('m_code', 'desc')->limit($rp, $start)->get();
			$totalRows = $this->db->count_all_results();
			$this->db->flush_cache();

			return array($query->result_array(), $totalRows);
			
		}

		//투표 공감 POLL 결과보기
		function vote_poll_view($m_code, $m_userid){

			$sql = "";
			$sql .= " SELECT B.ex idx, IFNULL(A.per, 0) per, IFNULL(A.userid, 0) userid ";
			$sql .= " FROM( ";
			$sql .= " SELECT a.m_example ex, ROUND(SUM(CASE WHEN a.m_userid IS NOT NULL THEN 1 ELSE 0 END)/(SELECT COUNT(*) FROM vote_member_list WHERE m_code = '".$m_code."')*100) per ";
			$sql .= " , (SELECT b.m_userid FROM vote_member_list b WHERE a.m_example = b.m_example AND a.m_code = b.m_code AND b.m_userid = '".$m_userid."') userid ";
			$sql .= " FROM vote_member_list a ";
			$sql .= " WHERE a.m_code = '".$m_code."' ";
			$sql .= " GROUP BY a.m_example ";
			$sql .= " ) A ";
			$sql .= " RIGHT OUTER JOIN ";
			$sql .= " ( ";
			$sql .= " SELECT 1 ex, 0 per FROM DUAL UNION ALL ";
			$sql .= " SELECT 2 ex, 0 per FROM DUAL UNION ALL ";
			$sql .= " SELECT 3 ex, 0 per FROM DUAL UNION ALL ";
			$sql .= " SELECT 4 ex, 0 per FROM DUAL UNION ALL ";
			$sql .= " SELECT 5 ex, 0 per FROM DUAL ";
			$sql .= " ) B ";
			$sql .= " ON A.ex = B.ex ";
			$sql .= " WHERE 1=1 ";
			$sql .= " ORDER BY A.per DESC, A.userid DESC ";			

			$query = $this->db->query($sql);

			return $query->result_array();
		}

		//다배열 셀렉트
		//(대상 테이블, 검색어 배열 array($k => $v) , 정렬할 필드)
		//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
		function result_array($v_table, $search, $order_filed = "", $desc = "desc", $limit = null){

			if($v_table == "TotalMembers" and empty($search)){
				if(empty($user_id)){goto("/");exit;}	//totalmembers 슬로우 쿼리 방지
			}

			$this->db->select('*');

			
			$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.m_userid');

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

			if(@$order_filed){
				$this->db->order_by($v_table.'.'.$order_filed, $desc);
			}

			if(@$limit){
				$this->db->limit($limit);
			}

			$query = $this->db->get($v_table);

			return $query->result_array();
		}


	}

?>
