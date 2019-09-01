<?PHP

	class Manager_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	//매니저의 추천회원
	function result_array($v_table, $search, $order_filed = "", $desc = "desc"){
		$this->db->select('*');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.b_userid');

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

}

?>
