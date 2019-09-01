<?PHP
	class Photo_m extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}
		
		//인증사진
		function photo_list($start, $rp, $search, $v_table, $v_order_by){
			
			$this->db->start_cache();

			$this->db->select('*')->from($v_table);
			$this->db->join('TotalMembers_login', 'TotalMembers_login.m_userid = '.$v_table.'.user_id');
			
			$this->db->where('is_main_pic = "y"');

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

			//남성은 정회원만
			if($search['TotalMembers_login.m_sex'] == 'M'){
				$this->db->where('TotalMembers_login.m_type = "V"');
			}

			$this->db->stop_cache();

			$query = $this->db->order_by($v_order_by, 'desc')->limit($rp, $start)->get();

			//q();

			$totalRows = $this->db->count_all_results();

			$this->db->flush_cache();

			return array($query->result_array(), $totalRows);


		}
	
		//인기순위 3명 순위 매겨서 가져오기
		function popularity_top3(){

			$this->db->select('@rownum := @rownum+1 rownum, a.*', false);
			$this->db->from('TotalMembers a, (select @rownum := 0) b', false);
			$this->db->where('a.m_filename != ""');
			$query = $this->db->where('a.m_filename IS NOT NULL')->order_by('a.m_popularity', 'desc')->limit(3)->get();

			return $query->result_array();


		}

		//인기순위 4위부터 가져오기
		function popularity_top4_down($start, $rp){

			$this->db->select('@rownum := @rownum+1 rownum, a.*', false)->from('TotalMembers a, (select @rownum := 3) b', false);
			$this->db->where('a.m_filename IS NOT NULL');
			$this->db->where('a.m_filename != ""');
			$this->db->where('a.m_userid NOT IN( SELECT * FROM ((SELECT m_userid FROM TotalMembers WHERE m_filename IS NOT NULL ORDER BY m_popularity DESC LIMIT 3) AS tmp) )');

			$query = $this->db->order_by('a.m_popularity', 'desc')->limit($rp, $start)->get();

			return $query->result_array();

		}

	}
?>
