<?PHP
class Sms_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function smsting_list($page, $rp, $search, $tab_name){

		//내 문자팅 관리함 리스트 요청
		$this->db->start_cache();
		$this->db->select('msg.*, msg_l.*, tm.*')->from('T_JoyHunting_MsgTing msg, T_JoyHunting_MsgTing_List msg_l, TotalMembers tm');

		$this->db->where('msg_l.'.$tab_name.'','msg.m_userid',FALSE);
		$this->db->where('msg_l.r_userid','tm.m_userid',FALSE);

		if ($search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					$this->db->where($key, $value);
				}
			}
  		}

		if ($tab_name == 's_userid'){	//보낸사람이 삭제
			$this->db->where('msg_l.is_delete_send IS NULL');
			$this->db->where('msg_l.r_userid IN (select m_userid from T_JoyHunting_MsgTing)');
		}else{							//받은사람이 삭제
			$this->db->where('msg_l.is_delete_recv IS NULL');
			$this->db->where('msg_l.s_userid IN (select m_userid from T_JoyHunting_MsgTing)');
		}
		

		$this->db->stop_cache();
		$query = $this->db->order_by('msg_l.sms_idx', 'desc')->limit($rp, $page)->get();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}

	function userid_add($v_table, $search, $order_filed = "", $desc = "desc"){
		$this->db->select('*');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_JoyHunting_MsgTing.m_userid');

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
        return $query->row_array();
	}
	

}



	

?>
