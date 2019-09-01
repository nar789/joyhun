<?PHP
	//투표하기 모델
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

	//투표 등록시 투표코드 생성
	function vote_code($v_table){
		
		$this->db->select('IFNULL(MAX(m_code), 1000)+1 as m_code', false);
		$query = $this->db->from($v_table)->get();

		return $query->row()->m_code;
	}

	//투표 공감 POLL 결과보기
	function vote_poll_view($m_code){

		$sql = "";
		$sql .= " SELECT B.ex idx, IFNULL(A.per, 0) per ";
		$sql .= " FROM( ";
		$sql .= " SELECT a.m_example ex, ROUND(SUM(CASE WHEN a.m_userid IS NOT NULL THEN 1 ELSE 0 END)/(SELECT COUNT(*) FROM vote_member_list WHERE m_code = '".$m_code."')*100) per ";
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
		$sql .= " ORDER BY B.ex ASC ";			

		$query = $this->db->query($sql);

		$sql2 = "";
		$sql2 .= " SELECT B.ex idx, IFNULL(A.cnt, 0) cnt, (SELECT COUNT(*) FROM vote_member_list WHERE m_code = '".$m_code."') total ";
		$sql2 .= " FROM( ";
		$sql2 .= " SELECT a.m_example ex, SUM(CASE WHEN a.m_userid IS NOT NULL THEN 1 ELSE 0 END) cnt ";
		$sql2 .= " FROM vote_member_list a ";
		$sql2 .= " WHERE a.m_code = '".$m_code."' ";
		$sql2 .= " GROUP BY a.m_example ";
		$sql2 .= " )A ";
		$sql2 .= " RIGHT OUTER JOIN ";
		$sql2 .= " ( ";
		$sql2 .= " SELECT 1 ex, 0 cnt FROM DUAL UNION ALL ";
		$sql2 .= " SELECT 2 ex, 0 cnt FROM DUAL UNION ALL ";
		$sql2 .= " SELECT 3 ex, 0 cnt FROM DUAL UNION ALL ";
		$sql2 .= " SELECT 4 ex, 0 cnt FROM DUAL UNION ALL ";
		$sql2 .= " SELECT 5 ex, 0 cnt FROM DUAL ";
		$sql2 .= " ) B ";
		$sql2 .= " ON A.ex = B.ex ";
		$sql2 .= " WHERE 1=1 ";
		$sql2 .= " ORDER BY B.ex ASC ";

		$query2 = $this->db->query($sql2);

		return array($query->result_array(), $query2->result_array());
	}

}

?>
