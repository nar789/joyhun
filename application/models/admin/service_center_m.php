<?PHP
	//관리자페이지 서비스센터 관련 모델
	class Service_center_m extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		//출석체크 이벤트 당첨자 추첨
		function call_win_member_m($search, $cnt){

			$sql = "";
			$sql .= " SELECT * ";
			$sql .= " FROM attend_member_list ";
			$sql .= " WHERE 1=1 ";
			
			if(!empty($search)){
				foreach($search as $key => $value){
					$sql .= " AND ".$key." = '".$value."' ";
				}
			}

			$sql .= " ORDER BY RAND() ";
			$sql .= " LIMIT ".$cnt." ";

			$query = $this->db->query($sql);

			return $query->result_array();

		}

	}

?>