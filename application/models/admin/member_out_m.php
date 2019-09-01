<?PHP
	
	class Member_out_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function get_list($start, $rp, $desc = "desc", $select = "*"){

		$this->db->start_cache();
		$this->db->select('*')->from('TotalMembers');
		$this->db->join('member_total_point', 'TotalMembers.m_userid = member_total_point.m_userid','left');

		$this->db->stop_cache();

		$query = $this->db->order_by('TotalMembers.m_num', $desc)->limit($rp, $start)->get();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();

        return array($query->result_array(),$totalRows);

	}



	function member_list($page, $rp, $data, $table)
	{
		$this->db->start_cache();
		$this->db->select('*')->from($table);
		$this->db->join('member_total_point', 'TotalMembers.m_userid = member_total_point.m_userid','left outer');
		$this->db->join('payment_temp', 'TotalMembers.m_userid = payment_temp.m_userid','left outer');

		if ($data) {
			if(@$data['method'] && @$data['s_word']){
				//휴대폰 검색처리
				if($data['method'] == "m_hp"){
					$tmp =explode("-",$data['s_word']);
					if(count($tmp) == 1){
						$where = array('m_hp3' => $tmp[0]);
					}elseif(count($tmp) == 2){
						$where = array('m_hp2' => $tmp[0], 'm_hp3' >= $tmp[1]);
					}elseif(count($tmp) == 3){
						$where = array('m_hp1' => $tmp[0], 'm_hp2' >= $tmp[1], 'm_hp3' >= $tmp[2]);
					}
				}else{
				//그외 검색처리
					$where = array($data['method'] => $data['s_word']);
				}
				$this->db->where($where);
			}

			if(@$data['method2'] && @$data['s_word2']){
				//휴대폰 검색처리
				if($data['method2'] == "m_hp"){
					$tmp =explode("-",$data['s_word2']);
					if(count($tmp) == 1){
						$where = array('m_hp3' => $tmp[0]);
					}elseif(count($tmp) == 2){
						$where = array('m_hp2' => $tmp[0], 'm_hp3' >= $tmp[1]);
					}elseif(count($tmp) == 3){
						$where = array('m_hp1' => $tmp[0], 'm_hp2' >= $tmp[1], 'm_hp3' >= $tmp[2]);
					}
				}else{
				//그외 검색처리
					$where = array($data['method2'] => $data['s_word2']);
				}
				$this->db->where($where);
			}
  		}
		$this->db->stop_cache();

		$totalRows = $this->db->count_all_results();
		$query = $this->db->order_by('m_num', 'desc')->limit($rp, $page)->get();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}




}

?>
