<?PHP
	//추천이상형
	class Cs_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function max_cnt($v_table){
		$this->db->select('max(m_idx)+1 as m_idx');

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

        return $query->row()->m_idx;
	}


}

?>
