<?PHP
class Meeting_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


/********************************************************************/
/****************************** 번개팅 ******************************/
/********************************************************************/


	function beongae_list_request($page, $rp, $search)
	{
		//번개팅 리스트 요청내역
		$this->db->start_cache();
		$this->db->select('beon.*, beon_sin.*, mem.*, mem2.m_nick as sin_m_nick')->from('T_MeetingDate_Bun as beon');
		$this->db->join('TotalMembers as mem', 'mem.m_userid = beon.b_userid');
		$this->db->join('T_MeetingDate_Bun_request as beon_sin', 'beon_sin.p_idx = beon.idx');
		$this->db->join('TotalMembers as mem2', 'mem2.m_userid = beon_sin.user_id'); //신청자 닉네임 가져오기

		if ($search) {
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

		$query = $this->db->order_by('beon_sin.idx', 'desc')->limit($rp, $page)->get();
		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}


/********************************************************************/
/****************************** 문자팅 ******************************/
/********************************************************************/



	function sms_list($page, $rp, $search){
		
		//문자팅 리스트
		$this->db->start_cache();
		$this->db->select('*, T_JoyHunting_MsgTing.m_job as msgting_m_job, T_JoyHunting_MsgTing.m_outstyle as msgting_m_outstyle, T_JoyHunting_MsgTing.m_character as msgting_m_character')->from('T_JoyHunting_MsgTing');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_JoyHunting_MsgTing.m_userid');

		if ($search) {
			foreach($search as $key => $value)
			{
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$this->db->where($value);
					}else{
						$this->db->where('TotalMembers.'.$key, $value);
					}
				}	
			}
  		}

		$this->db->stop_cache();

		$query = $this->db->order_by('m_idx', 'desc')->limit($rp, $page)->get();
		$totalRows = $this->db->count_all_results();
		
		$this->db->flush_cache();

        return array($query->result_array(),$totalRows);
	}

	// 문자팅 추가
	function row_array($v_table, $search, $order_filed = "", $desc = "desc"){
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



	function sms_send_request($data,$num){		// 문자팅 right_menu 보내기

		$sms_result = '';

		$this->db->select('TotalMembers.m_userid, TotalMembers.m_hp1, TotalMembers.m_hp2, TotalMembers.m_hp3')->from('TotalMembers');
		$this->db->join('T_JoyHunting_MsgTing', 'TotalMembers.m_userid =  T_JoyHunting_MsgTing.m_userid');
		$this->db->where('TotalMembers.m_hp_sms', '1');		//문자수신여부 0:거부, 1:허용
		$this->db->where('TotalMembers.m_nick', $data['recv_memeber_'.$num]);
		$sms_result = $this->db->order_by('m_idx', 'desc')->limit(1)->get();

		$result = $sms_result->row_array();

		if ($result == null){
			return "9";	//수신거부
		}else{
			return $result;	//수신허용
		}
	}

	function sms_send($p_arr,$s_user,$r_users,$send_time,$text_val,$images,$images_url,$s_code,$img_cnt){


		if($img_cnt == 0) {		// attach_file에 이미지가 없으면 새로등록
			$image_data = array(
						'attach_file_group_key'		=> $s_code,
						'attach_file_group_seq'		=> 1,
						'attach_file_seq'			=> 1,
						'attach_file_subpath'		=> $images_url,
						'attach_file_name'			=> $images
					);
			$rtn_img = $this->db->insert("em_mmt_file", $image_data);

		}

		if ($p_arr) {
			foreach($p_arr as $value){
				$arr_data = array(
					'date_client_req' => $send_time,
					'subject' => '[조이헌팅]문자팅 메세지 도착',
					'content' => $text_val."\n\r\n\r(이 번호는 회신이 불가능하오니 조이헌팅 홈페이지에서 확인해주세요.)",
					'callback' => '#14709'.$s_code,
					'service_type' => '2',
					'recipient_num' => $value,
					'attach_file_group_key' => $s_code
				);

				$rtn = $this->db->insert("em_mmt_tran", $arr_data);	
			}

			$rtn = 1;

			if ($rtn == 1){

				$ret_ary = count($p_arr);

				for ($i=0; $i<$ret_ary; $i++){

					$add_data = array(
						's_userid' => $s_user,
						'r_userid' => $r_users[$i],
						'sms_content' => $text_val,
						'recv_num' => $p_arr[$i],
						'sms_time' => $send_time
					);

					$rtn_last = $this->db->insert("T_JoyHunting_MsgTing_List", $add_data);
				}

			}

  		}
		return $rtn_last;


	}


	/********************************************************************/
	/****************************** 소셜팅 ******************************/
	/********************************************************************/

	/********************************************************************/
	/**************************** 짝/애정촌 *****************************/
	/********************************************************************/
	
	//내 프로포즈 관리 리스트
	function propose_list_request($page, $rp, $search, $tabmenu){
		
		if($tabmenu == "1"){
			//받은
			$sub_query = "(select count(*) from T_Event_Mate_request aa where aa.p_idx = mr1.m_idx group by aa.p_idx) as cnt";

		}else{
			//보낸
			$sub_query = "(select count(*) from T_Event_Mate_request aa where aa.p_idx = mr1.m_idx and aa.user_id = '".$this->session->userdata['m_userid']."' group by aa.p_idx) as cnt";
		}
		
		$this->db->start_cache();
		
		$this->db->select("mr1.*, mr2.*, mem1.*, mem2.m_nick as sin_m_nick, ".$sub_query." ")->from("T_Event_Mate_Reg as mr1");
		$this->db->join("TotalMembers as mem1", "mem1.m_userid = mr1.m_userid");
		$this->db->join("T_Event_Mate_request as mr2", "mr2.p_idx = mr1.m_idx");
		$this->db->join("TotalMembers as mem2", "mem2.m_userid = mr2.user_id");

		if ($search) {
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
		
		$this->db->group_by('mr2.p_idx');
		$query = $this->db->order_by('mr2.idx', 'desc')->limit($rp, $page)->get();
		

		$totalRows = $this->db->affected_rows();

		$this->db->flush_cache();
		
        return array($query->result_array(), $totalRows);
		

	}

	//프로포즈 댓글리스트
	function comment_propose($p_idx, $p_user_id, $mode){
		
		$this->db->start_cache();

		$this->db->select("*")->from("T_Event_Mate_request");
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_Event_Mate_request.user_id ');
		$this->db->where("T_Event_Mate_request.p_idx", $p_idx);
		
		if($mode == "1"){
		//받은
		}else{
		//보낸
		$this->db->where("T_Event_Mate_request.user_id", $this->session->userdata['m_userid']);
		}

		$query = $this->db->order_by('T_Event_Mate_request.w_date', 'asc')->get();
		
		$this->db->stop_cache();

		$totalRows2 = $this->db->affected_rows();

		$this->db->flush_cache();
		
		return array($query->result_array(), $totalRows2);
	}



	/********************************************************************/
	/********************** 메인 지역별 미팅회원 ************************/
	/********************************************************************/

	//$area_cnt = $this->my_m->cnt('TotalMembers', $search);


	function area_cnt($select){

		// 번개팅
		$b_search['b_region'] = $select;
		$b_cnt = $this->my_m->cnt('T_MeetingDate_Bun', $b_search);

		// 문자팅
		$sms_search['m_region1'] = $select;
		$m_cnt = $this->my_m->cnt('T_JoyHunting_MsgTing', $sms_search);

		// 소셜팅
		$social_search['m_conregion'] = $select;
		$s_cnt = $this->my_m->cnt('T_sns_event', $social_search);

		// 짝애정촌
		$jjack_search['m_conregion'] = $select;
		$j_cnt = $this->my_m->cnt('T_Event_Mate_Reg', $jjack_search);

		echo $b_cnt+$m_cnt+$s_cnt+$j_cnt;

	}


	function main_live_met($v_table,$search, $cnt, $order_filed, $m_userid, $desc = "desc"){

		$this->db->start_cache();
		$this->db->select(' *, count(*) ')->from($v_table);
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

		$this->db->where('TotalMembers.m_filename IS NOT NULL');
		$this->db->where("TotalMembers.m_filename <> ''");

		$this->db->group_by($v_table.'.'.$m_userid);
		$this->db->having('count( * ) > 0'); 

		$this->db->stop_cache();

		$query = $this->db->order_by($v_table.'.'.$order_filed, $desc)->limit($cnt)->get();
		$this->db->flush_cache();

        return array($query->result_array());

	}


}



	

?>
