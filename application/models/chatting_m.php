<?PHP
class Chatting_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function age_chatting_list($page, $rp, $tab_menu, $search = '')
	{
		
		//지역/나이채팅 리스트
		$this->db->start_cache();

		$this->db->select('AA.*')->from('TotalMembers AA');

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
		
		$this->db->where('AA.m_special', null);		//나중에 뺄수도있음
		$this->db->where("IF((AA.m_sex = 'M' AND AA.m_type = 'V') OR AA.m_sex = 'F', 'OK', 'NO' ) = 'OK'", null);		
		$this->db->stop_cache();
		
		switch($tab_menu){
			case '1' : $query = $this->db->order_by('AA.last_login_day', 'desc')->limit($rp, $page)->get(); break; //최근 접속순
			case '2' : $query = $this->db->order_by('AA.m_in_date', 'desc')->limit($rp, $page)->get(); break;		//최근 가입순
			case '3' : $query = $this->db->order_by('AA.m_login_cnt', 'desc')->limit($rp, $page)->get(); break; //활동량 많은순
			case '4' : $query = $this->db->order_by('AA.last_login_day', 'desc')->limit($rp, $page)->get(); break; //활동현황순
			case '5' : $query = $this->db->order_by('AA.last_login_day', 'desc')->limit($rp, $page)->get(); break; //인기 지수순
			case '6' : $query = $this->db->order_by('AA.last_login_day', 'desc')->limit($rp, $page)->get(); break; //매너 점수순
			default :  alert('잘못된 접근입니다.'); break;

		}

		$totalRows = $this->db->count_all_results();
		//q();
		
		$this->db->flush_cache();

		return array($query->result_array(),$totalRows);

	}
	

	function result_array($v_table, $search, $order_filed = "", $desc = "desc"){
		$this->db->select('*');

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

		$query = $this->db->get($v_table);
        return $query->result_array();
	}


	function cnt($v_table, $search){

		$this->db->select('count(*) as cnt');

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
		
		$query = $this->db->get($v_table);

        return $query->row()->cnt;
	}
	

	//네이버지도에 표시될 회원 50명 추출
	function geo_naver($m_conregion, $m_conregion2, $m_limit){
		
		if($this->session->userdata['m_sex'] == "M"){
			$m_sex = "F";
		}else{
			$m_sex = "M";
		}

		$strSQL = "";
		$strSQL .= " SELECT * ";
		$strSQL .= " FROM TotalMembers ";
		$strSQL .= " WHERE m_conregion = '".$m_conregion."' AND m_conregion2 = '".$m_conregion2."' AND m_sex = '".$m_sex."' ";
		$strSQL .= " ORDER BY last_login_day DESC ";
		$limit = " LIMIT ".$m_limit." ";

		$query = $this->db->query($strSQL.$limit);

		return $query->result_array();

	}

	//사용자 슈퍼채팅 선택리스트 가져오기
	function user_super_chat_list($num, $area, $age_1, $age_2, $sex, $user_id){
		
		//이미 채팅이 진행중이거나, 채팅 신청내역이 있거나, 나쁜친구로 등록이 되어있는경우 제외하고 리스트 뽑기
		$sql = "";
		$sql .= " SELECT a.*, b.idx, c.m_gubun ";
		$sql .= " FROM TotalMembers a ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT idx, send_id user_id FROM chat_request WHERE recv_id = '".$user_id."' AND (status = '수락' or status = '') ";
		$sql .= " UNION ALL ";
		$sql .= " SELECT idx, recv_id user_id FROM chat_request WHERE send_id = '".$user_id."' AND (status = '수락' or status = '') ";
		$sql .= " ) b ";
		$sql .= " ON a.m_userid = b.user_id ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT * FROM T_MakeFriend_List WHERE m_userid = '".$user_id."' and m_gubun = '나쁜친구' ";
		$sql .= " ) c";
		$sql .= " ON a.m_userid = c.m_fuserid ";
		$sql .= " WHERE 1=1 AND a.m_sex = '".$sex."' AND b.idx is null AND IFNULL(c.m_gubun, 'ok') <> '나쁜친구' and a.m_type = 'V' ";
		
		if(!empty($area)){ $sql .= " AND a.m_conregion = '".$area."' "; }
		if(!empty($age_1)){ $sql .= " AND a.m_age >= '".$age_1."' "; }
		if(!empty($age_2)){ $sql .= " AND a.m_age <= '".$age_2."' "; }

		$sql .= " ORDER BY a.last_login_day DESC ";
		$sql .= " LIMIT ".$num." ";

		$query = $this->db->query($sql);

		return $query->result_array();

	}


	//5분거리 모바일 테스트용 근처 회원 찾기
	function age_chatting_list_test($sex, $conregion, $conregion2, $my_xpoint, $my_ypoint, $limit, $start, $rp){

//		$sql = "";
//		$sql .= " SELECT * ";
//		$sql .= " ,CONCAT(ROUND((6371 * 2  ";
//		$sql .= " * ATAN2(SQRT(POW(SIN(RADIANS($my_xpoint - m_xpoint)/2), 2) + POW(SIN(RADIANS($my_ypoint - m_ypoint)/2), 2)  ";
//		$sql .= " * COS(RADIANS(m_xpoint)) * COS(RADIANS($my_xpoint))), SQRT(1 - POW(SIN(RADIANS($my_xpoint - m_xpoint)/2), 2)  ";
//		$sql .= " + POW(SIN(RADIANS($my_ypoint - m_ypoint)/2), 2) * COS(RADIANS(m_xpoint)) * COS(RADIANS($my_xpoint)))) ";
//		$sql .= " ), 1), 'km') to_distance ";
//		$sql .= " FROM TotalMembers ";
//		$sql .= " WHERE 1=1 ";
//		$sql .= " AND m_sex = '".$sex."' ";
//		$sql .= " AND m_conregion = '".$conregion."' ";	
//		$sql .= " AND m_conregion2 LIKE '".$conregion2."%' ";	
//		$sql .= " AND (m_xpoint IS NOT NULL AND m_ypoint IS NOT NULL) ";
//		$sql .= " AND (m_xpoint <> '' AND m_ypoint <> '') ";
//		$sql .= " AND (LEFT(m_xpoint, 1) <> '0' AND LEFT(m_xpoint, 1) <> '-' AND LEFT(m_ypoint, 1) <> '0' AND LEFT(m_ypoint, 1) <> '-') ";
//		$sql .= " ORDER BY m_in_date DESC ";
//
//		$sql1 = " LIMIT ".$limit." ";
//		
//		$list_sql = " SELECT * FROM (".$sql.$sql1.") A WHERE 1=1 ORDER BY A.to_distance ASC LIMIT ".$start.", ".$rp." ";
//	
//		$query1 = $this->db->query($sql.$sql1);
//		$query2 = $this->db->query($list_sql);
//
//		return array($query1->result_array(), $query1->num_rows(), $query2->result_array());

		$conregion2_2 = str_replace("시","",$conregion2);
		$conregion2_2 = str_replace("군","",$conregion2_2);	//수원 처럼 시 가 안들어있는 데이터도 검색 추가

		//지도용 SQL
		$sql1 = $sql2_1 = $sql2_2 = $sql3 = $sql4 = $sql5_1 = $sql5_2 = "";
		$sql1 .= " SELECT * ";
		$sql1 .= " ,ROUND((6371 * 2  ";
		$sql1 .= " * ATAN2(SQRT(POW(SIN(RADIANS($my_xpoint - m_xpoint)/2), 2) + POW(SIN(RADIANS($my_ypoint - m_ypoint)/2), 2)  ";
		$sql1 .= " * COS(RADIANS(m_xpoint)) * COS(RADIANS($my_xpoint))), SQRT(1 - POW(SIN(RADIANS($my_xpoint - m_xpoint)/2), 2)  ";
		$sql1 .= " + POW(SIN(RADIANS($my_ypoint - m_ypoint)/2), 2) * COS(RADIANS(m_xpoint)) * COS(RADIANS($my_xpoint)))) ";
		$sql1 .= " ), 1) to_distance ";
		$sql1 .= " FROM TotalMembers ";
		$sql1 .= " WHERE 1=1 ";
		$sql1 .= " AND m_sex = '".$sex."' and m_type = 'V' ";
		
		//광역검색용 (리스트, 지도전체)
		if($conregion == "경기" or $conregion == "서울" or $conregion == "인천"){
			$sql2_1 .= " AND (m_conregion = '경기' or m_conregion = '서울' or m_conregion = '인천') ";	
		}else if($conregion == "부산" or $conregion == "경남" or $conregion == "경북"){
			$sql2_1 .= " AND (m_conregion = '부산' or m_conregion = '경남' or m_conregion = '경북') ";	
		}else if($conregion == "울산" or $conregion == "대구"){
			$sql2_1 .= " AND (m_conregion = '울산' or m_conregion = '대구') ";	
		}else if($conregion == "대전" or $conregion == "충남" or $conregion == '충북'){
			$sql2_1 .= " AND (m_conregion = '대전' or m_conregion = '충남' or m_conregion = '충북') ";	
		}else if($conregion == "전남" or $conregion == "전북"){
			$sql2_1 .= " AND (m_conregion = '전남' or m_conregion = '전북') ";	
		}else{
			$sql2_1 .= " AND m_conregion like '".$conregion."%' ";	
		}

		//일반 지도
		$sql2_2 .= " AND m_conregion = '".$conregion."' ";	

		$sql3 .= " AND (m_conregion2 LIKE '".$conregion2."%' or m_conregion2 LIKE '".$conregion2_2."%' )";	
		$sql4 .= " AND (m_xpoint IS NOT NULL AND m_ypoint IS NOT NULL) ";
		$sql4 .= " AND (m_xpoint <> '' AND m_ypoint <> '') ";
		$sql4 .= " AND (LEFT(m_xpoint, 1) <> '0' AND LEFT(m_xpoint, 1) <> '-' AND LEFT(m_ypoint, 1) <> '0' AND LEFT(m_ypoint, 1) <> '-') ";
		
		//리스트용
		$sql5_1 .= " ORDER BY to_distance ASC ";

		//광역검색 지도용
		$sql5_2 .= " ORDER BY m_in_date DESC ";

		$sql6 = " LIMIT ".$limit." ";
		

		//$sql_list = " SELECT * FROM (".$sql1.$sql2_1.$sql4.$sql5_1." LIMIT ".rand(500,600).") A LIMIT ".$start.", ".$rp." ";	//리스트용 sql	 (2차지역을 빼서, 주변 지역도 다 불러오기)
		$sql_list = " select * from (".$sql1.$sql2_1.$sql4.$sql5_2." limit 400) a where 1=1 order by to_distance asc limit ".$start.", ".$rp." ";		//속도문제로인해 변경

		$query1 = $this->db->query($sql1.$sql2_2.$sql3.$sql4.$sql5_1.$sql6);	//지도용
		$query2 = $this->db->query($sql_list);	//리스트용

		
		//지도용 데이터가 너무 없을경우 지도도 주변 전체에서 불러오기
		if($query1->num_rows() < 20){
			$query1 = $this->db->query($sql1.$sql2_1.$sql4.$sql5_2.$sql6);
		}

		return array($query1->result_array(), $query1->num_rows(), $query2->result_array());
	}
}

?>
