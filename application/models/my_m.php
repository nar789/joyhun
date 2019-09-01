<?PHP
/********************************************************************/
/************************* 간소화된 공용모델 ************************/
/****공용이 아닌 기타 모델은 이곳이 아닌 각 모델파일에서 사용할것***/
/********************************************************************/
//
//공용 리스트 get_list($start, $rp, $search, $v_table, $order_filed, $m_userid, $desc = "desc", $select = "*");
//조인하지않는 리스트 get_list_solo($start, $rp, $search, $v_table, $order_filed, $desc = "desc", $select = "*");
//한줄만 셀렉트 row_array($v_table, $search, $order_filed = "", $desc = "desc");
//다배열 셀렉트 result_array($v_table, $search, $order_filed = "", $desc = "desc");
//검색된 갯수 셀렉트 cnt($v_table, $search);
//업데이트 update($v_table, $search, $set_array);
//인서트 insert($v_table, $data_array);
//삭제 del($v_table, $search);
//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것 (실행자 본인확인 필수)

class My_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	//공용 리스트 (회원테이블과 조인)
	//(페이지, 시작포인트, 검색어 배열, 테이블명, 정렬할 필드, 조인할 회원아이디,정렬순서, 셀렉트 내용)
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function get_list($start, $rp, $search, $v_table, $order_filed, $m_userid, $desc = "desc", $select = "*"){

		$this->db->start_cache();
		$this->db->select($select)->from($v_table);
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.'.$m_userid);
			
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
		//$this->db->where('TotalMembers.m_nick_chk', null);		

		$this->db->stop_cache();

		$query = $this->db->order_by($v_table.'.'.$order_filed, $desc)->limit($rp, $start)->get();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();

        return array($query->result_array(),$totalRows);

	}

	//회원테이블과 조인하지않는 공용 리스트 (m_userid 없음)
	function get_list_solo($start, $rp, $search, $v_table, $order_filed, $desc = "desc", $select = "*"){

		$this->db->start_cache();
		$this->db->select($select)->from($v_table);
			
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
		$this->db->stop_cache();

		$query = $this->db->order_by($order_filed, $desc)->limit($rp, $start)->get();

		$totalRows = $this->db->count_all_results();
		$this->db->flush_cache();

        return array($query->result_array(),$totalRows);

	}


	//한줄만 셀렉트
	//(대상 테이블, 검색어 배열 array($k => $v) , 정렬할 필드)
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function row_array($v_table, $search, $order_filed = "", $desc = "desc", $limit = null){

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

		if(@$order_filed){
			$this->db->order_by($v_table.'.'.$order_filed, $desc);
		}
		
		if(@$limit){
			$this->db->limit($limit);
		}

		$query = $this->db->get($v_table);

		//$this->insert_log(); //로그남기기

        return $query->row_array();
	}

	//다배열 셀렉트
	//(대상 테이블, 검색어 배열 array($k => $v) , 정렬할 필드)
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function result_array($v_table, $search, $order_filed = "", $desc = "desc", $limit = null){

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

		if(@$order_filed){
			$this->db->order_by($v_table.'.'.$order_filed, $desc);
		}

		if(@$limit){
			$this->db->limit($limit);
		}

		$query = $this->db->get($v_table);

		//$this->insert_log(); //로그남기기

        return $query->result_array();
	}


	//검색된 갯수 셀렉트
	//(대상 테이블, 검색어 배열 array($k => $v) )
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function cnt($v_table, $search){
		$this->db->select('count(*) as cnt');

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
		
		$query = $this->db->get($v_table);

        return $query->row()->cnt;
	}


	//업데이트
	//(테이블이름, 검색어 배열 array($k => $v) , 수정할 내용 배열 )
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function update($v_table, $search, $set_array){

			$is_null = true; //where에 변수 내용이 하나도 없는지 체크위해 기본값

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

					if(trim($value) != null and trim($value) != ""){$is_null = false;}	
					//value 값이 있는지 체크. value가 0일 경우도 있기때문에 empty 미사용.
				}
			}
			
			if($is_null == true){ goto("/");exit; } // where 없으면

			$rtn = $this->db->update($v_table, $set_array);
			
			return $rtn;
	}

	//인서트
	//(테이블이름, 데이터 배열 array($k => $v)
	function insert($v_table, $data_array){

		$rtn = $this->db->insert($v_table, $data_array);	
		return $rtn;		
	}


	//로그남겨서 분석하기
	function insert_log(){
		
		$now = date("Y-m-d H:i:s");

//		$data_array = array(
//			'w_date'	=> $now,
//			'sqls' => $this->db->last_query(),
//			'page_url' => site_url().uri_string()
//		);
//	
//		$rtn = $this->db->insert("sql_log", $data_array);	
//		return $rtn;		
	}

	//삭제
	//(테이블이름, 데이터 배열 array($k => $v)
	//보안문제로 사용자페이지일경우 search배열 안에 m_userid <= 세션아이디를 꼭 챙겨올것★
	function del($v_table, $search){		

		if(empty($search)){ goto("/");exit; } // where 없으면

		$rtn = $this->db->delete($v_table, $search);
		return $rtn;

	}

}
?>