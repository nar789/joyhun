<?PHP
	class Rand_m extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}
		
		
		//추천 팝업
		function result_array($v_table, $search, $limit = '1'){


			if($v_table == "TotalMembers" and empty($search)){
				if(empty($user_id)){goto("/");exit;}	//totalmembers 슬로우 쿼리 방지
			}

			$this->db->select('*');

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

			$this->db->order_by("RAND()");

			if(@$limit){
				$this->db->limit($limit);
			}

			$query = $this->db->get($v_table);

			return $query->result_array();
				
		}
	}
?>
