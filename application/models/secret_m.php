<?PHP
class Secret_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function secret_list($page, $rp, $search)
	{

		// 비밀톡챗리스트
		$this->db->start_cache();

		$this->db->select('*')->from('TotalMembers');

		$this->db->stop_cache();
		
		$this->db->where('m_nick_chk', null);

		if ($search) {
			foreach($search as $key => $value)
			{
				if(trim($value)){
					$this->db->where($key, $value);
				}
			}
  		}

		$query = $this->db->order_by('last_login_day', 'desc')->limit($rp, $page)->get();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}


}

?>
