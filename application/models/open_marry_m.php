<?PHP
class Open_marry_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	/*************** 메인 투데이매칭회원 ************/

	function today_mb($check,$check_me,$search){

		$up = ($check)+10;
		$down = ($check)-10;
		
		$this->db->where('(b_age < '.$up.' AND b_age > '.$down.')');
		$this->db->where('b_type IS NOT NULL ');
		$this->db->where("b_type != '' ");

		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_CoupleMarry_OpenguhonMan.b_userid');

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

		$this->db->where_not_in("b_userid","(select b_userid from T_CoupleMarry_OpenguhonMan where b_userid = ".$check_me.")");

		$this->db->order_by('rand()')->limit('1', '0');

		$query = $this->db->get('T_CoupleMarry_OpenguhonMan');
        return $query->result_array();

	}

	

	/*************** 메인 매니저의 추천회원 ************/



	function result_array($v_table, $search, $order_filed = "", $desc = "desc", $limit = null){
		$this->db->select('*');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_CoupleMarry_OpenguhonMan.b_userid');

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


	/********************결혼신청********************/
	
	//결혼신청 등록 리스트
	function open_marry_list($page, $rp, $search, $search2){

		//print_r($search);
		//exit;

		$this->db->start_cache();
		$this->db->select('T_CoupleMarry_MarryMan.*')->from('T_CoupleMarry_MarryMan');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_CoupleMarry_MarryMan.m_userid');
		
		if ($search) {
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

		if($search2['m_marry'] == "결혼"){ $this->db->where('T_CoupleMarry_MarryMan.m_marry', '1');	};
		if($search2['m_conregion']){ $this->db->where('T_CoupleMarry_MarryMan.m_conregion', $search2['m_conregion']);	};
		if($search2['m_age']){ 
			$this->db->where('T_CoupleMarry_MarryMan.m_age >=', substr($search2['m_age'], 0, 2));	
			$this->db->where('T_CoupleMarry_MarryMan.m_age <=', substr($search2['m_age'], -2));	
		};
		if($search2['file_ok'] == "1"){
			$this->db->where('m_filename is not null');	
			$this->db->where('m_filename <>', '');	
		}

		$this->db->stop_cache();

		$query = $this->db->order_by('T_CoupleMarry_MarryMan.m_idx', 'desc')->limit($rp, $page)->get();

		$totalRows = $this->db->count_all_results();
		
		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);
	}



	/********************재혼신청********************/
	
	//재혼신청 리스트
	function open_remarry_list($page, $rp, $search, $search2){

		$this->db->start_cache();
		$this->db->select('T_CoupleMarry_ReMarryMan.*')->from('T_CoupleMarry_ReMarryMan');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_CoupleMarry_ReMarryMan.m_userid');
		
		if ($search) {
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

		if($search2['m_marry'] == "결혼"){ $this->db->where('T_CoupleMarry_ReMarryMan.m_marry', '1');	};
		if($search2['m_conregion']){ $this->db->where('T_CoupleMarry_ReMarryMan.m_conregion', $search2['m_conregion']);	};
		if($search2['m_age']){ 
			$this->db->where('T_CoupleMarry_ReMarryMan.m_age >=', substr($search2['m_age'], 0, 2));	
			$this->db->where('T_CoupleMarry_ReMarryMan.m_age <=', substr($search2['m_age'], -2));	
		};
		if($search2['file_ok'] == "1"){
			$this->db->where('m_filename is not null');	
			$this->db->where('m_filename <>', '');	
		}

		$this->db->stop_cache();

		$query = $this->db->order_by('T_CoupleMarry_ReMarryMan.m_writedate', 'desc')->limit($rp, $page)->get();
		
		//echo $this->db->last_query(); 

		$totalRows = $this->db->count_all_results();
		
		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);

	}
	

	/********************공개구혼********************/

	//공개구혼 등록 리스트
	function open_guhon_list($page, $rp, $search, $search2){

		$this->db->start_cache();
		$this->db->select('openguhon.*')->from('T_CoupleMarry_OpenguhonMan as openguhon');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = openguhon.b_userid');
		
		if ($search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$this->db->where($value);
					}else{
						$this->db->where('openguhon.'.$key, $value);
					}
				}
			}
  		}

		if($search2['m_conregion']){ $this->db->where('openguhon.b_region', $search2['m_conregion']);	};
		if($search2['m_sex']){ $this->db->where('openguhon.b_sex', $search2['m_sex']);	};
		if($search2['m_age']){ 
			$this->db->where('openguhon.b_age >=', substr($search2['m_age'], 0, 2));	
			$this->db->where('openguhon.b_age <=', substr($search2['m_age'], -2));	
		};


		$this->db->stop_cache();

		$query = $this->db->order_by('openguhon.b_num', 'desc')->limit($rp, $page)->get();

		$totalRows = $this->db->count_all_results();
		
		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);
	}


}

?>
