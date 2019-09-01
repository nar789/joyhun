<?PHP
	//소개팅 좋아요
	class Blind_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//서로 좋아요
	function row_array($v_table, $search1){

		$sql  = "";
		$sql .= " SELECT bb.* ";
		$sql .= " FROM TotalMembers aa, blind_history bb ";
		$sql .= " WHERE aa.m_userid = bb.s_userid ";
		$sql .= " AND bb.s_userid = '".$search1."' and bb.r_userid = '".$search1."' ";


		$query = $this->db->query($sql);
		
		return array($query->result_array());
	}


}

?>
