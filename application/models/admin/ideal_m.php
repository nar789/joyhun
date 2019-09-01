<?PHP
	//추천이상형
	class Ideal_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function ideal_list($start, $rp, $search, $v_table, $order_filed, $m_userid, $desc = "desc", $select = "*"){

		$this->db->start_cache();
		$this->db->select($select)->from($v_table);
			
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
		
		$this->db->where('is_main_pic', 'y');
		
		
		$this->db->stop_cache();

		$query = $this->db->order_by($v_table.'.'.$order_filed, $desc)->limit($rp, $start)->get();
		$totalRows = $this->db->count_all_results();
		$this->db->flush_cache();

        return array($query->result_array(),$totalRows);

	}


	//추천회원 검색
	function result_array($v_table, $search){

		$this->db->select('*')->from($v_table);
		$this->db->join('member_pic', 'member_pic.user_id  = '.$v_table.'.m_userid');

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
		
		$this->db->where('pic_status', '인증완료');
		$this->db->where('is_main_pic', 'y');

		$query = $this->db->get();
        return $query->result_array();

	}




}

?>
