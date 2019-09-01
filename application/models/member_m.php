<?PHP

class Member_m extends CI_Model {

    function Member_m()
    {
        parent::__construct();
    }

	function get_member($user_id)
	{
		$this->db->select('*');
  		$this->db->where('m_userid',$user_id);
		$query = $this->db->get('TotalMembers');

        return $query->row_array();
	}

	function sum_payment($user_id){

		$this->db->select_sum('m_price');
		$this->db->where('m_userid','samdasoo1');
		$query = $this->db->get('payment_temp');

		return $query->row()->m_price;
	}


	//조이헌팅 안드로이드 무통장입금처리 모델
	function recoginition_mu_m($name, $price, $gubn, $empty = null){

		$sql = "";
		$sql .= " SELECT a.*, b.m_name ";
		$sql .= " FROM payment_temp a, TotalMembers b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.m_userid = b.m_userid ";
		$sql .= " AND a.m_cash_gb = '".$gubn."' ";
		$sql .= " AND (b.m_name = '".$name."' or m_mstr = '".$name."' )";

		if(empty($empty)){ $sql .= " AND a.m_price = '".$price."' "; }

		$sql .= " AND m_writedate >= '".date('Y-m-d', strtotime(date('Y-m-d').'-5day'))." 00:00:00' ";
		$sql .= " AND m_writedate <= '".date('Y-m-d')." 24:00:00' ";
		$sql .= " ORDER BY m_idx DESC ";
		$sql .= " LIMIT 1 ";

		$query = $this->db->query($sql);

		return $query->row_array();
	}

}

?>
