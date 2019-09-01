<?PHP
	//슈퍼채팅 모델
	class Super_chat_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	//받는회원 리스트
	function result_array($v_table, $search='', $limit = null){

		$this->db->select('*,TotalMembers.m_userid');
		$this->db->join('member_total_point', 'member_total_point.m_userid = '.$v_table.'.m_userid','left');

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

		$this->db->where("m_sex","M");

		if(@$limit){
			$this->db->limit($limit);
		}
		$query = $this->db->get($v_table);

        return $query->result_array();
	}



	function cnt($v_table, $search=''){
		$this->db->select('count(*) as cnt,TotalMembers.m_userid');
		$this->db->join('member_total_point', 'member_total_point.m_userid = '.$v_table.'.m_userid','left');

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

		$this->db->where("m_sex","M");
		$query = $this->db->get($v_table);

        return $query->row()->cnt;
	}



	//받는회원 리스트
	function repeat_list($v_table, $search='', $start, $limit){


		$this->db->select('*,TotalMembers.m_userid');
		$this->db->join('member_total_point', 'member_total_point.m_userid = '.$v_table.'.m_userid','left');

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

		$this->db->where("m_sex","M");

		if(@$limit){
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get($v_table);
        return $query->result_array();
	}
	

}

?>
