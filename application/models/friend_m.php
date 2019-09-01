<?PHP
class Friend_m extends CI_Model {

    function __construct()
    {
        parent::__construct();

		$this->load->model('profile_m');
    }

/************************************************************************************/
/************************** 친구만들기 / 앤만들기 / 찜하기 **************************/
/************************************************************************************/	


	// 친구 등록하기 
	function reg_f_list($arr_data)
	{
		// 이미 친구로 등록되었는지 확인 (중복체크) 

		$m_fuserid = $arr_data['m_fuserid'];

		$this->db->select('*');
		$this->db->from('T_MakeFriend_List');
		$this->db->where('m_userid', $arr_data['m_userid']);
		$this->db->where('m_fuserid', $arr_data['m_fuserid']);

		if($arr_data['m_gubun'] == '앤'){
			$this->db->where('m_gubun', '앤');

		}else if($arr_data['m_gubun'] == '찜'){
			$this->db->where('m_gubun', '찜');

		}else{
			$this->db->where("( m_gubun = '친구' or  m_gubun = '나쁜친구')");
		}
		$query = $this->db->get();	

		if (@$query->row()->m_idx != ""){
			if($query->row()->m_gubun == "나쁜친구"){
				return	"5";  //이미 나쁜친구 등록
			}else if($query->row()->m_gubun == "찜"){
				return	"7";  //이미 찜 등록
			}else{
				return	"3";  //이미 친구 등록
			}

		}else{
			$rtn = $this->db->insert("T_MakeFriend_List", $arr_data);
			if($rtn > 0){				
				return "1"; //입력성공
			}else{
				return "9"; //입력실패
			}
		}

	}


	//서로친구, 서로앤 여부 확인하기
	function reg_f_chk($m_userid, $m_fuserid, $m_gubun){

		$sql = "";
		$sql .= " SELECT a.* ";
		$sql .= " FROM T_MakeFriend_List a, TotalMembers b ";
		$sql .= " WHERE a.m_fuserid = b.m_userid ";
		$sql .= " AND a.m_userid = '".$m_fuserid."' ";
		$sql .= " AND a.m_fuserid = '".$m_userid."' ";
		$sql .= " AND a.m_gubun = '".$m_gubun."' ";
		
		$query = $this->db->query($sql);

		return $query->row_array();

	}


	
}