<?PHP
	
	class Chat_app_push_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//검색회원 리스트(app 설치회원 기준)
	function chat_app_user_list($sex, $point, $area, $age_1, $age_2, $type, $join_date_1, $join_date_2, $reg_date_1, $reg_date_2){
		
		$sql = "";
		$sql .= " SELECT a.device_id, a.reg_id, b.*, IFNULL(c.total_point, 0) total_point ";
		$sql .= " FROM joytalk_id a ";
		$sql .= " LEFT OUTER JOIN TotalMembers b ON a.m_userid = b.m_userid ";
		$sql .= " LEFT OUTER JOIN member_total_point c ON a.m_userid = c.m_userid ";
		$sql .= " WHERE 1=1 ";
		
		if($sex <> "A"){ $sql .= "AND b.m_sex = '".$sex."' "; }
		if(!empty($point)){ $sql .= "AND IFNULL(c.total_point, 0) >= '".$point."' "; }
		if(!empty($area)){
			if($area == "1"){ $sql .= "AND (b.m_conregion = '서울' or b.m_conregion = '경기' or b.m_conregion = '인천')"; }
			if($area == "2"){ $sql .= "AND (b.m_conregion = '부산' or b.m_conregion = '울산' or b.m_conregion = '경남')"; }
			if($area == "3"){ $sql .= "AND (b.m_conregion = '대구' or b.m_conregion = '경북')"; }
			if($area == "4"){ $sql .= "AND (b.m_conregion = '광주' or b.m_conregion = '전남' or b.m_conregion = '전북')"; }
			if($area == "5"){ $sql .= "AND (b.m_conregion = '대전' or b.m_conregion = '충남' or b.m_conregion = '충북')"; }
			if($area == "6"){ $sql .= "AND b.m_conregion = '강원'"; }
			if($area == "7"){ $sql .= "AND b.m_conregion = '제주'"; }
			if($area == "8"){ $sql .= "AND b.m_conregion = '해외'"; }
		}
		if(!empty($age_1)){ $sql .= "AND b.m_age >= '".$age_1."' "; }
		if(!empty($age_2)){ $sql .= "AND b.m_age <= '".$age_2."' "; }
		if(!empty($type)){ $sql .= "AND b.m_type = '".$type."' "; }
		if(!empty($join_date_1)){ $sql .= "AND a.up_date >= '".$join_date_1." 00:00:00' "; }
		if(!empty($join_date_2)){ $sql .= "AND a.up_date <= '".$join_date_2." 23:59:59' "; }
		if(!empty($reg_date_1)){ $sql .= "AND b.m_in_date >= '".$reg_date_1." 00:00:00' "; }
		if(!empty($reg_date_2)){ $sql .= "AND b.m_in_date <= '".$reg_date_2." 23:59:59' "; }

		$sql .= " ORDER BY b.m_num DESC ";
		$sql2 = $sql." LIMIT 50 ";

		$query1 = $this->db->query($sql);
		$query2 = $this->db->query($sql2);

		return array($query2->result_array(), $query1->num_rows(), $sql);

	}

	//넘어온 쿼리 실행
	function chat_app_user_query($sql){

		if(empty($sql)){ return; }

		$query = $this->db->query($sql);

		return $query->result_array();

	}

}

?>
