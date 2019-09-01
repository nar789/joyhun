<?PHP
class Blind_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function check_meet($check,$check_me,$search2){

		$up = ($check)+10;
		$down = ($check)-10;
		
		$this->db->where('(m_age < '.$up.' AND m_age > '.$down.')');
		$this->db->where('m_filename IS NOT NULL ');
		$this->db->where("m_filename != '' ");
		
		$this->db->select('*');

		if (@$search2) {
			foreach($search2 as $key => $value)
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

		$this->db->where_not_in("m_userid","(select b_mb from blind_cnt where b_id = ".$check_me.")");

		$this->db->order_by('rand()')->limit('4', '0');

		$query = $this->db->get('TotalMembers');
        return $query->result_array();
	}

	// 받은,보낸 좋아요
	function re_se_good($start, $rp, $search, $v_table, $order_filed, $m_userid, $desc = "desc", $select = "*"){


		$this->db->start_cache();
		$this->db->select($select)->from($v_table);
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.'.$m_userid);
			
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
		//$this->db->group_by($mode);
			
		$this->db->stop_cache();
	
		$query = $this->db->order_by($v_table.'.'.$order_filed, $desc)->limit($rp, $start)->get();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);

	}

	// 서로 좋아요
	function together_good($page, $rp, $search, $v_table){

		$sql = "";
		$sql .= " SELECT a.* ";
		$sql .= " FROM( ";
		$sql .= " SELECT a.* ";
		$sql .= " FROM( ";
		$sql .= " SELECT a.*, (SELECT COUNT(*) FROM blind_history b WHERE 1=1 AND a.r_userid = b.s_userid AND b.r_userid = '".$this->session->userdata['m_userid']."') cnt ";
		$sql .= " FROM( ";
		$sql .= " SELECT * ";
		$sql .= " FROM blind_history ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND s_userid = '".$this->session->userdata['m_userid']."' ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " ) a, TotalMembers b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.s_userid = b.m_userid ";
		$sql .= " AND a.cnt > 0 ";
		$sql .= " ) a, TotalMembers b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.r_userid = b.m_userid ";
		$sql .= " ORDER BY a.b_idx DESC ";

//		$strSQL  = "";
//		$strSQL .= " SELECT bb.* ";
//		$strSQL .= " FROM TotalMembers aa, blind_history bb ";
//		$strSQL .= " WHERE aa.m_userid = bb.s_userid ";
//		$strSQL .= " AND bb.s_userid = '".$this->session->userdata['m_userid']."' and bb.r_userid = '".$this->session->userdata['m_userid']."' ";
//
//		$strSQL .= " ORDER BY bb.b_idx DESC ";
		$strSQL2 = " LIMIT ".$page.", ".$rp." ";

		
		$query = $this->db->query($sql.$strSQL2);
		$query2 = $this->db->query($sql);
		
		return array($query->result_array(), $query2->num_rows());
	}


	// 서로 좋아요 갯수
	function together_cnt($search, $v_table){

		$strSQL  = "";
		$strSQL .= " SELECT count(*) as cnt ";
		$strSQL .= " FROM TotalMembers aa, blind_history bb ";
		$strSQL .= " WHERE aa.m_userid = bb.s_userid ";
		$strSQL .= " AND bb.s_userid = '".$this->session->userdata['m_userid']."' and r_userid = '".$this->session->userdata['m_userid']."' ";

		$query = $this->db->query($strSQL);
	
		return $query->row()->cnt;
	}

	function togeter_check($v_table, $user, $my){

		$strSQL  = "";
		$strSQL .= " SELECT count(*) as cnt ";
		$strSQL .= " FROM TotalMembers aa, blind_history bb ";
		$strSQL .= " WHERE aa.m_userid = bb.s_userid ";
		$strSQL .= " AND (bb.s_userid = '".$my."' AND bb.r_userid = '".$user."') or (bb.r_userid = '".$my."' AND bb.s_userid = '".$user."') ";

		$query = $this->db->query($strSQL);
		
		return $query->row()->cnt;
	}



}
?>
