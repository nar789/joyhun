<?PHP
	//추천이상형
	class Complaint_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	function get_list($start, $rp, $search, $v_table){

		$comp_sql  = "";
		$comp_sql .= "SELECT ".$v_table.".* FROM (";
		$comp_sql .= "SELECT * FROM ".$v_table." ORDER BY c_idx DESC ";
		$comp_sql .= ") ".$v_table." join ";
		$comp_sql .= "TotalMembers on TotalMembers.m_userid = ".$v_table.".r_id ";

		if (@$search) {
			foreach($search as $key => $value)
			{				
				$comp_sql .= "where `Police_complaint`.".$key." = '".$value."' ";
			}
		}
		$comp_sql .= "GROUP BY r_id ";
		$comp_sql .= "ORDER BY  `Police_complaint`.`c_date` DESC ";
		$comp_sql .= "limit ".$start.",".$rp;
		
		$query = $this->db->query($comp_sql);


		$comp_cnt  = "";
		$comp_cnt .= "SELECT Count(Distinct `Police_complaint`.`r_id`) cnt from Police_complaint";
		$num_query = $this->db->query($comp_cnt);


		return array($query->result_array(), $num_query->row()->cnt);

	
	}






}

?>