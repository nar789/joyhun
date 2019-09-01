<?PHP
	
	class Business_m extends CI_Model {

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

		$query = $this->db->order_by('idx', 'desc')->limit($rp, $start)->get();
		$totalRows = $this->db->count_all_results();
		$this->db->flush_cache();

        return array($query->result_array(), $totalRows);

	}


}

?>
