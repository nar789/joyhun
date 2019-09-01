<?php 
/*****************************************************************************************************************************************/

	//남녀섞어서 최신기준으로 가져오기 (가져올갯수, 가져올테이블, 찾을필드, idx값, 성별(ex.m_sex or b_sex) , $set_day 는 몇일전구하기
	function sex_rand($cnt, $get_table, $select, $search, $gender = '', $order_filed='',$where='', $desc= 'desc', $set_day=''){
		
		$CI =& get_instance();

		if ($cnt%2 != '0') {	// cnt가 홀수이면
			$cnt1 = $cnt/2-0.5; $cnt2 = $cnt/2+0.5; //여자가 1명 더 많게
		}else{	// cnt가 짝수이면
			$cnt1 = $cnt2 = $cnt/2;
		}

		// 남자
		$CI->db->select($select)->from($get_table);

		if ($get_table != 'TotalMembers'){
			$CI->db->join('TotalMembers', 'TotalMembers.m_userid = '.$get_table.'.'.$search);
		}

		if(!@empty($gender)){	//성별검색있으면
			$CI->db->where($gender.' =','M');
		}

		// 조이톡은 3일이후의 것만 가져옴
		if ($get_table == 'T_JoyTalk' || @$set_day) {
			foreach($set_day as $key => $value)
			{				
				if(trim($value)){
					$CI->db->where($get_table.'.'.$key.' <= DATE_ADD(NOW(), '.$value.')');
					$CI->db->where("m_filename IS NOT NULL");
					$CI->db->where("m_filename != ''");
				}
			}
		}

		if(@$where) {
			foreach($where as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$CI->db->where($value);
					}else{
						$CI->db->where($key, $value);
					}
				}
			}
		}

		$query = $CI->db->order_by($get_table.'.'.$order_filed, $desc)->limit($cnt1)->get();
        $result1 = $query->result_array();

		// 여자
		$CI->db->select($select)->from($get_table);

		if ($get_table != 'TotalMembers'){
			$CI->db->join('TotalMembers', 'TotalMembers.m_userid = '.$get_table.'.'.$search);
		}

		if(!@empty($gender)){	//성별검색있으면
			$CI->db->where($gender.' =','F');
		}

		// 조이톡은 3일이후의 것만 가져옴
		if ($get_table == 'T_JoyTalk' || @$set_day) {
			foreach($set_day as $key => $value)
			{				
				if(trim($value)){
					$CI->db->where($get_table.'.'.$key.' <= DATE_ADD(NOW(), '.$value.')');
					$CI->db->where("m_filename IS NOT NULL");
					$CI->db->where("m_filename != ''");
				}
			}
		}
		if (@$where) {
			foreach($where as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$CI->db->where($value);
					}else{
						$CI->db->where($key, $value);
					}
				}
			}
		}
		
		$query2 = $CI->db->order_by($get_table.'.'.$order_filed, $desc)->limit($cnt2)->get();

        $result2 = $query2->result_array();

		$merge = array_merge($result1, $result2);
		shuffle($merge);

		return $merge;


	}

/*****************************************************************************************************************************************/

	// 최근 게시물 불러오기
	function board_list($cnt, $get_table, $select, $order_filed='',$search='', $desc='desc'){

		$CI =& get_instance();

		$CI->db->select($select)->from($get_table);

		if (@$search) { $CI->db->where($search); }

		$query = $CI->db->order_by($get_table.'.'.$order_filed, $desc)->limit($cnt)->get();
        $result = $query->result_array();

		return $result;

	}

	//미팅신청메인 찜베스트
	function jjim_best($m_sex){

		$CI =& get_instance();

		$cnt_sql = "";
		$cnt_sql .= " SELECT *, max( jjim_cnt ) ";
		$cnt_sql .= " FROM ( ";
		$cnt_sql .= " SELECT m_fuserid, count( * ) AS jjim_cnt ";
		$cnt_sql .= " FROM T_MakeFriend_List ";
		$cnt_sql .= " WHERE `m_gubun` = '찜' ";
		$cnt_sql .= " AND `m_fsex` = '".$m_sex."' ";
		$cnt_sql .= " GROUP BY m_fuserid ";
		$cnt_sql .= " HAVING count( * ) >1 ";
		$cnt_sql .= " )aa ";
		$cnt_sql .= " JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = m_fuserid ";

		$query = $CI->db->query($cnt_sql);

		return $query->result_array();
	}


	// 신규미팅신청자
	function new_meet_member(){

		$CI =& get_instance();

		//번개팅 남녀(5명씩)
		$sql_1_M  =	" SELECT * FROM `T_MeetingDate_Bun` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = b_userid ";
		$sql_1_M .= " WHERE `b_sex` = 'M' ORDER BY `T_MeetingDate_Bun`.`b_date` DESC LIMIT 0 , 5";
		$query_1_M = $CI->db->query($sql_1_M);
		$array_1 = $query_1_M->result_array();

		$sql_1_F  = " SELECT * FROM `T_MeetingDate_Bun` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = b_userid ";
		$sql_1_F .= " WHERE `b_sex` = 'F' ORDER BY `T_MeetingDate_Bun`.`b_date` DESC LIMIT 0 , 5";
		$query_1_F = $CI->db->query($sql_1_F);
		$array_2 = $query_1_F->result_array();

		//문자팅 남녀(5명씩)
		$sql_2_M  = " SELECT * FROM `T_JoyHunting_MsgTing` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_JoyHunting_MsgTing`.m_userid ";
		$sql_2_M .= " WHERE `T_JoyHunting_MsgTing`.`m_sex` = 'M' ORDER BY `T_JoyHunting_MsgTing`.`m_update` DESC LIMIT 0 , 5";
		$query_2_M = $CI->db->query($sql_2_M);
		$array_3 = $query_2_M->result_array();

		$sql_2_F  = " SELECT * FROM `T_JoyHunting_MsgTing` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_JoyHunting_MsgTing`.m_userid ";
		$sql_2_F .= " WHERE `T_JoyHunting_MsgTing`.`m_sex` = 'F' ORDER BY `T_JoyHunting_MsgTing`.`m_update` DESC LIMIT 0 , 5";
		$query_2_F = $CI->db->query($sql_2_F);
		$array_4 = $query_2_F->result_array();

		//소셜팅 남녀(5명씩)
		$sql_3_M  = " SELECT * FROM `T_sns_event` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_sns_event`.m_userid ";
		$sql_3_M .= " WHERE `T_sns_event`.`m_sex` = 'M' ORDER BY `T_sns_event`.`m_update` DESC LIMIT 0 , 5";
		$query_3_M = $CI->db->query($sql_3_M);
		$array_5 = $query_3_M->result_array();

		$sql_3_F  = " SELECT * FROM `T_sns_event` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_sns_event`.m_userid ";
		$sql_3_F .= " WHERE `T_sns_event`.`m_sex` = 'F' ORDER BY `T_sns_event`.`m_update` DESC LIMIT 0 , 5";
		$query_3_F = $CI->db->query($sql_3_F);
		$array_6 = $query_3_F->result_array();

		//짝 애정촌 남녀(5명씩)
		$sql_4_M  = " SELECT * FROM `T_Event_Mate_Reg` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_Event_Mate_Reg`.m_userid ";
		$sql_4_M .= " WHERE `T_Event_Mate_Reg`.`m_sex` = 'M' ORDER BY `T_Event_Mate_Reg`.`m_writedate` DESC LIMIT 0 , 5";
		$query_4_M = $CI->db->query($sql_4_M);
		$array_7 = $query_4_M->result_array();

		$sql_4_F  = " SELECT * FROM `T_Event_Mate_Reg` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_Event_Mate_Reg`.m_userid ";
		$sql_4_F .= " WHERE `T_Event_Mate_Reg`.`m_sex` = 'F' ORDER BY `T_Event_Mate_Reg`.`m_writedate` DESC LIMIT 0 , 5";
		$query_4_F = $CI->db->query($sql_4_F);
		$array_8 = $query_4_F->result_array();

		$merge = array_merge($array_1,$array_2,$array_3,$array_4,$array_5,$array_6,$array_7,$array_8);
		shuffle($merge);

		return $merge;
	}



	// 업데이트된 결혼 & 재혼
	function new_marry_member(){

		$CI =& get_instance();

		//결혼 남녀(3명씩)
		$sql_1_M  =	" SELECT * FROM `T_CoupleMarry_MarryMan` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_CoupleMarry_MarryMan`.m_userid ";
		$sql_1_M .= " WHERE `T_CoupleMarry_MarryMan`.`m_sex` = 'M' ORDER BY `T_CoupleMarry_MarryMan`.`m_writedate` DESC LIMIT 0 , 3";
		$query_1_M = $CI->db->query($sql_1_M);
		$array_1 = $query_1_M->result_array();
		$array_1[0]['m_cate'] = $array_1[1]['m_cate'] = $array_1[2]['m_cate'] = '결혼'; 

		//print_r($array_1);

		$sql_1_F  = " SELECT * FROM `T_CoupleMarry_MarryMan` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_CoupleMarry_MarryMan`.m_userid ";
		$sql_1_F .= " WHERE `T_CoupleMarry_MarryMan`.`m_sex` = 'F' ORDER BY `T_CoupleMarry_MarryMan`.`m_writedate` DESC LIMIT 0 , 3";
		$query_1_F = $CI->db->query($sql_1_F);
		$array_2 = $query_1_F->result_array();
		$array_2[0]['m_cate'] = $array_2[1]['m_cate'] = $array_2[2]['m_cate'] = '결혼'; 

		//재혼 남녀(3명씩)
		$sql_2_M  = " SELECT * FROM `T_CoupleMarry_ReMarryMan` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_CoupleMarry_ReMarryMan`.m_userid ";
		$sql_2_M .= " WHERE `T_CoupleMarry_ReMarryMan`.`m_sex` = 'M' ORDER BY `T_CoupleMarry_ReMarryMan`.`m_writedate` DESC LIMIT 0 , 3";
		$query_2_M = $CI->db->query($sql_2_M);
		$array_3 = $query_2_M->result_array();
		$array_3[0]['m_cate'] = $array_3[1]['m_cate'] = $array_3[2]['m_cate'] = '재혼'; 

		$sql_2_F  = " SELECT * FROM `T_CoupleMarry_ReMarryMan` JOIN `TotalMembers` ON `TotalMembers`.`m_userid` = `T_CoupleMarry_ReMarryMan`.m_userid ";
		$sql_2_F .= " WHERE `T_CoupleMarry_ReMarryMan`.`m_sex` = 'F' ORDER BY `T_CoupleMarry_ReMarryMan`.`m_writedate` DESC LIMIT 0 , 3";
		$query_2_F = $CI->db->query($sql_2_F);
		$array_4 = $query_2_F->result_array();
		$array_4[0]['m_cate'] = $array_4[1]['m_cate'] = $array_4[2]['m_cate'] = '재혼'; 

		$merge = array_merge($array_1,$array_2,$array_3,$array_4);
		shuffle($merge);

		return $merge;
	}


	//베스트 회원
	function best_mb($m_sex){

		$CI =& get_instance();

		$sql = "";
		$sql .= " SELECT AA.* FROM ( ";
		$sql .= "  `TotalMembers_login` AS AA) ";
		$sql .= " JOIN `TotalMembers` ON `TotalMembers`.`m_userid` =  `AA`.`m_userid` ";
		$sql .= " LEFT JOIN `ci_sessions` ON `ci_sessions`.`m_userid` = `AA`.`m_userid` ";
		$sql .= " WHERE  `AA`.`m_sex` = '".$m_sex."' ";
		$sql .= " ORDER BY `AA`.`last_login_day` DESC ";
		$sql .= " LIMIT 0 , 1 ";

		$query = $CI->db->query($sql);

		return $query->result_array();

	}

	//추천 이성친구
					//  검색할테이블, 사용자의성별, 찾을필드,정렬할필드, 갯수
	function push_friend($v_table,$user_sex,$search,$order_by,$limit,$desc = 'desc'){

		if ($user_sex == 'M'){ $user_sex = 'F'; }else{ $user_sex = 'M'; }

		$CI =& get_instance();

		$CI->db->select('*, count(*)')->from($v_table);
		$CI->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.m_userid');
			
		if (@$search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$CI->db->where($value);
					}else{
						$CI->db->where($key, $value);
					}
				}
			}
		}

		$CI->db->where('TotalMembers.m_sex',$user_sex);

		$CI->db->group_by($v_table.'.m_userid');
		$CI->db->having('count( * ) > 1');

		$push_sql = $CI->db->order_by($v_table.'.'.$order_by, $desc)->limit($limit)->get();

        return $push_sql->result_array();
	}

	// 이상형 초대하기
	function push_invite(){

		$CI =& get_instance();

		$user_val = $CI->member_lib->get_member($CI->session->userdata['m_userid']);

		if ($user_val['m_sex'] == 'M'){ $user_val['m_sex'] = 'F'; }else{ $user_val['m_sex'] = 'M'; }

		$CI->db->select('*')->from('TotalMembers_login');
		$CI->db->join('TotalMembers', 'TotalMembers.m_userid = TotalMembers_login.m_userid');
		$CI->db->where('TotalMembers_login.m_reason', $user_val['m_reason']);
		$CI->db->where('TotalMembers_login.m_sex', $user_val['m_sex']);

		$query = $CI->db->order_by('TotalMembers_login.last_login_day', 'desc')->limit('5')->get();

		return $query->result_array();

	}

	//내 프로필 방문자 조회
	function profile_visit($user_id,$today=''){

		$CI =& get_instance();

		$search['user_id'] = $user_id;

		if($today != '') {	//오늘방문자
			$search['ex_v_date'] = "v_date LIKE '".$today."%'";
		}

		$m_result = $CI->my_m->cnt('profile_visit', $search);

		return $m_result;

	}



	//친구접속 알리미
	function auto_friend_alrim($m_userid){

		$CI =& get_instance();

		$sql = "";
		$sql .= " SELECT DISTINCT a.m_userid ";
		$sql .= " FROM ci_sessions a, ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_userid ";
		$sql .= " FROM TotalMembers a, T_MakeFriend_List b  ";
		$sql .= " WHERE a.m_userid = b.m_fuserid  ";
		$sql .= " AND b.m_userid = '".$m_userid."' ";
		$sql .= " AND b.m_gubun = '친구' ";
		$sql .= " ) b ";
		$sql .= " WHERE a.m_userid = b.m_userid ";
		
		$query = $CI->db->query($sql);

		return $query->result_array();
		
	}


	//알림 페이지 첫접속 또는 첫 알림 보낼때 알림테이블에 insert
	function auto_member_alrim($m_userid){

		$CI =& get_instance();
		$CI->load->model('my_m');

		$alrim_value = $CI->my_m->row_array('set_member_alarm', array('m_userid' => $m_userid));

		if(empty($alrim_value)){
			$rtn = $CI->my_m->insert('set_member_alarm', array('m_userid' => $m_userid, 'm_update_day' => NOW));
			
			if($rtn == "1"){
				return "1";		//알림 새로 등록 성공
			}else{
				return "0";		//알림 새로 등록 실패
			}

		}else{
			return "9";			//이미 알림 등록
		}
		
	}

	//정보수정시 이메일 수신여부 변경시 알림 변경
	function call_email_staus($m_userid, $m_mail_yn){

		$CI =& get_instance();
		$CI->load->model('my_m');

		if($m_mail_yn == "Y" || $m_mail_yn == "N"){
			
			$arrData = array(
				'm_chat_1'			=> $m_mail_yn,
				'm_propose_1'		=> $m_mail_yn,
				'm_meeting_1'		=> $m_mail_yn,
				'm_beongae_1'		=> $m_mail_yn,
				'm_jjack_1'			=> $m_mail_yn,
				'm_jjim_1'			=> $m_mail_yn,
				'm_reg_f1_1'		=> $m_mail_yn,
				'm_reg_f2_1'		=> $m_mail_yn,
				'm_f_profile_1'		=> $m_mail_yn,
				'm_f_meeting_1'		=> $m_mail_yn,
				'm_f_beongae_1'		=> $m_mail_yn,
				'm_reg_anne_1'		=> $m_mail_yn,
				'm_to_anne_1'		=> $m_mail_yn,
				'm_update_day'		=> NOW
			);

			$rtn = $CI->my_m->update('set_member_alarm', array('m_userid' => $m_userid), $arrData);

			if($rtn == "1"){
				return "1";		//이메일 수신 설정 변경 성공
			}else{
				return "0";		//이메일 수신 설정 변경 실패
			}

		}else{
			return "9";		//잘못된 접근
		}

	}


	//1자리 숫자 앞에 0 붙이기 
	function zero_num($val){
		
		if(strlen($val) == "1"){
			return "0".$val;
		}else{
			return $val;
		}

	}

	//PC or 모바일 메인페이지 들어왔을경우 정회원 세션값 업데이트 
	function member_session_up(){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		if(empty($CI->session->userdata['m_userid'])){
			//회원 아이디가 없을경우 
			return;
		}else{
			//회원아이디가 있을경우
			$data = $CI->member_lib->get_member($CI->session->userdata['m_userid']);
			@$CI->session->set_userdata(array('m_type' => $data['m_type']));		//회원 등급 세선 업데이트
			return;
		}

	}

	//1년 초과 정회원 자동 강등 처리 업데이트
	function call_member_type_up($user_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		if(empty($user_id)){
			//회원 아이디가 없을경우 
			return;
		}else{
			//회원아이디가 있을경우
			$data = $CI->member_lib->get_member($user_id);

			if(!empty($data)){

				$sql = "";
				$sql .= " UPDATE TotalMembers a  ";
				$sql .= " LEFT OUTER JOIN ";
				$sql .= " ( ";
				$sql .= " SELECT m_userid, CASE WHEN m_okdate IS NULL THEN MAX(m_writedate) ELSE MAX(m_okdate) END m_pay_date ";
				$sql .= " FROM payment_temp ";
				$sql .= " WHERE m_userid = '".$data['m_userid']."' AND (m_product_code = '1001' OR m_product_code = '2000') AND m_card_ok = 'Y' AND m_cancel IS NULL ";
				$sql .= " ORDER BY m_idx DESC ";
				$sql .= " LIMIT 1 ";
				$sql .= " ) b ";
				$sql .= " ON a.m_userid = b.m_userid ";
				$sql .= " SET a.m_type = 'F' ";
				$sql .= " WHERE a.m_userid = '".$data['m_userid']."'  ";
				$sql .= " AND DATE_ADD((CASE WHEN b.m_pay_date IS NULL THEN '2016-06-16 00:00:00' ELSE b.m_pay_date END), INTERVAL 1 YEAR) <= SYSDATE() ";
				
				$CI->db->query($sql);
			}
			
			return ;
		}

	}


	//여성전용 이벤트 통계 관리자용(상품금액 계산 헬퍼)
	function call_woman_event_gift_price($date){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		$sql = "";
		$sql .= " SELECT IFNULL(SUM(A.PRICE), 0) PRICE ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT (SELECT B.V_PRICE_W FROM GIFT_LIST B WHERE A.V_ETC = B.V_IDX) PRICE ";
		$sql .= " FROM WOMAN_EVENT A ";
		$sql .= " WHERE A.V_MODE = 'gift' AND A.V_WRITE_DATE >= '".$date." 00:00:00' AND A.V_WRITE_DATE <= '".$date." 24:00:00' ";
		$sql .= " ) A ";
		$sql .= " WHERE 1=1 ";

		$query = $CI->db->query($sql);
		
		return $query->row()->PRICE;
	}
	

	//채팅신청, 채팅내역 전송, 메세지 전송, 관리자 슈퍼채팅 신청 등 나쁜친구로 등록된 경우 처리 함수 헬퍼
	function call_bad_friend_chk($send_id, $recv_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		
		$cnt = $CI->my_m->cnt('T_MakeFriend_List', array('m_userid' => $recv_id, 'm_fuserid' => $send_id, 'm_gubun' => '나쁜친구'));
		
		return $cnt;
	}
	

	//회원 접속여부 확인
	function call_connect_member($user_id){

		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($user_id)){ return "0"; }

		$cnt = $CI->my_m->cnt('ci_sessions', array('m_userid' => $user_id));

		return $cnt;
	}


	//관리자 페이지 전용 접속차단 회원 로그아웃 처리 헬퍼
	function call_block_member_logout($idx){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		$rtn = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('IDX' => $idx), 'IDX', 'DESC', NULL);

		if(!empty($rtn)){
			//데이터가 있을경우
			
			//차단종류가 휴대전화번호일경우
			if($rtn['GUBN'] == "HP"){
				$hp_val = explode('-', $rtn['GUBN_VAL']);
				$mlist = $CI->my_m->result_array('TotalMembers', array('m_hp1' => $hp_val[0], 'm_hp2' => $hp_val[1], 'm_hp3' => $hp_val[2]), 'm_num', 'desc', null);
			}
			
			//차단종류가 아이피일경우
			if($rtn['GUBN'] == "IP"){
				$ip_val = explode('.', $rtn['GUBN_VAL']);

				if($ip_val[3] == "*"){
					//아이피 대역대로 차단된 경우
					$last_login_ip = $ip_val[0].".".$ip_val[1].".".$ip_val[2].".";
					
					$search = array(
						"ex_data_1"	=> "substr(last_login_ip, 0, ".strlen($last_login_ip).") = '".$last_login_ip."' "
					);

					$mlist = $CI->my_m->result_array('TotalMembers', $search, 'm_num', 'desc', null);
				}else{
					//아이피로 차단된 경우
					$last_login_ip = $ip_val[0].".".$ip_val[1].".".$ip_val[2].".".$ip_val[3];
					$mlist = $CI->my_m->result_array('TotalMembers', array('last_login_ip' => $last_login_ip), 'm_num', 'desc', null);
				}

			}			

			if(!empty($mlist)){
				foreach($mlist as $data){
					$CI->my_m->del('ci_sessions', array('m_userid' => $data['m_userid']));
				}
			}

			return;

		}else{
			//데이터가 없을경우
			return;
		}

	}


	//IP/HP 차단회원 로그인시 차단 내역 보여주기(gubn = admin 경우 관리자용)
	function call_block_member_chk($user_id, $gubn = null){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');
		
		//회원 아이디가 없을경우 return
		if(empty($user_id)){ return; }

		//회원 데이터 가져오기
		$mdata = $CI->member_lib->get_member($user_id);
		if(empty($mdata)){ return; }						//회원 데이터가 없을경우 return
		
		//현재 접속한 ip
		if(empty($gubn)){
			$member_connect_ip = $_SERVER['REMOTE_ADDR'];
		}else{
			$member_connect_ip = $mdata['last_login_ip'];
		}
		

		//반환 변수 초기화 
		$block_idx = "";

		$block_cnt = $CI->my_m->cnt('MEMBER_BLOCK_LIST', array('USER_ID' => $user_id, 'STATUS' => '차단'));

		if($block_cnt > 0){
			//해당 아이디로 차단된 내역이 있는경우(가장 최근에 차단된 내역 1개만 보이기)
			$block_list = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('USER_ID' => $user_id, 'STATUS' => '차단'), 'IDX', 'DESC', '1');
			$block_idx = $block_list['IDX'];
			$CI->my_m->del('ci_sessions', array('m_userid' => $mdata['m_userid']));	//강제로그아웃
		}else{
			//해당 아이디로 차단된 내역이 없는경우

			//휴대전화번호로 차단내역 체크하기(없을경우 IP로 체크하기)
			$member_hp = $mdata['m_hp1']."-".$mdata['m_hp2']."-".$mdata['m_hp3'];

			$block_list_hp = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => 'HP', 'GUBN_VAL' => $member_hp, 'STATUS' => '차단'), 'IDX', 'DESC', '1');

			if(!empty($block_list_hp)){
				//휴대폰정보로 차단된 내역이 있는경우
				$block_idx = $block_list_hp['IDX'];
				$CI->my_m->del('ci_sessions', array('m_userid' => $mdata['m_userid']));	//강제로그아웃
			}else{
				//휴대폰정보로 차단된 내역이 없는경우(아이피로 차단된 내역 확인하기)
				//아이피로 확인할경우 (1. 아이피로 차단내역확인하기, 2. 아이피 대역대로 차단내역 확인하기)

				$block_list_ip = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => 'IP', 'GUBN_VAL' => $member_connect_ip, 'STATUS' => '차단'), 'IDX', 'DESC', '1');

				if(!empty($block_list_ip)){
					//해당회원의 마지막 로그인 아이피로 차단된 내역이 있는경우
					$block_idx = $block_list_ip['IDX'];
					$CI->my_m->del('ci_sessions', array('m_userid' => $mdata['m_userid']));	//강제로그아웃
				}else{
					//아이피로 차단된 내역이 없을경우 아이피 대역대 차단 확인
					//회원 아이피 쪼개기
					$member_ip = explode('.', $member_connect_ip);

					$ip_mask = $member_ip[0].".".$member_ip[1].".".$member_ip[2]."*";

					$block_list_ip_mask = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => 'IP', 'GUBN_VAL' => $ip_mask, 'STATUS' => '차단'), 'IDX', 'DESC', '1');

					if(!empty($block_list_ip_mask)){
						//아이피대역대로 차단된 내역이 있는경우
						$block_idx = $block_list_ip_mask['IDX'];
						$CI->my_m->del('ci_sessions', array('m_userid' => $mdata['m_userid']));	//강제로그아웃
					}else{
						//모든 차단내역이 없는경우
						$block_idx = "";
					}

				}

			}

		}

		return $block_idx;

	}


	//회원가입시 아이피 체크후 차단아이피인지 확인하기
	function call_block_member_ip_chk($user_ip){

		$CI =& get_instance();
		$CI->load->model('my_m');

		//아이피가 없을경우
		if(empty($user_ip)){ return; }

		$block_idx = "";

		$block_list = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => 'IP', 'GUBN_VAL' => $user_ip, 'STATUS' => '차단'), 'IDX', 'DESC', '1');

		if(!empty($block_list)){
			$block_idx = $block_list['IDX'];
		}else{
			$block_idx = "";
		}

		return $block_idx;
	}

	//회원 강제 로그아웃 처리(관리자용)
	function call_member_log_out($user_id){

		$CI =& get_instance();
		$CI->load->model('my_m');
		
		//회원 아이디가 없을경우
		if(empty($user_id)){ return; }
		
		$cnt = $CI->my_m->cnt('ci_sessions', array('m_userid' => $user_id));

		if($cnt > 0){
			//로그인중인경우
			$rtn = $CI->my_m->del('ci_sessions', array('m_userid' => $user_id));
		}else{
			//비로그인중인경우
			$rtn = "3";
		}

		return $rtn;

	}


	//HP/IP가 차단된 회원인지 확인후 버튼 리턴하기
	function call_chk_block_member_btn_rtn($user_id, $val = '1', $gubn = 'HP'){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		if(empty($user_id)){ return; }		//회원 아이디가 없을경우 return

		//회원정보 가져오기
		$mdata = $CI->member_lib->get_member($user_id);

		if(empty($mdata)){
			$mdata = $CI->member_lib->get_member_old($user_id);
		}

		if(empty($mdata)){
			$mdata = $CI->member_lib->get_member_out($user_id);
		}

		if($gubn == "HP"){
			$btn_val = "휴대폰";
			$block_data = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => $gubn, 'GUBN_VAL' => $mdata['m_hp1']."-".$mdata['m_hp2']."-".$mdata['m_hp3']), 'IDX', 'DESC', '1');
		}else if($gubn == "IP"){
			$btn_val = "아이피";
			$m_ip = explode('.', $mdata['last_login_ip']);
			$mdata_ip = @$m_ip[0].".".@$m_ip[1].".".@$m_ip[2].".";

			$block_data = $CI->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => $gubn, 'ex_data_1' => "SUBSTR(GUBN_VAL, 1, ".strlen($mdata_ip).") = '".$mdata_ip."' "), 'IDX', 'DESC', '1');
		}else{
			return;		//잘못된 접근
		}

		if(!empty($block_data)){
			//차단 당한경우
			if($val == "1"){
				$btn_html = "<a class='btn btn-danger btn-xs' href='/admin/service_center/member_block/block_list' target='_blank'><i class='fa fa-times white'></i> ".$btn_val." 차단됨</a>";
			}else{
				$btn_html = "<button id='btn_block_".$gubn."' name='btn_block_".$gubn."' class='btn btn btn-danger' onclick='javascript:location.href=\"/admin/service_center/member_block/block_list\";'> ".$btn_val." 차단됨</button>";
			}
		}else{
			//차단당하지 않은경우
			if($val == "1"){
				$btn_html = "<a class='btn btn-default btn-xs' href='javascript:member_block_pop(\"$gubn\", \"$user_id\");'><i class='fa fa-times white'></i> ".$btn_val." 차단</a>";
			}else{
				$btn_html = "<button id='btn_block_".$gubn."' name='btn_block_".$gubn."' class='btn btn btn-default' onclick='javascript:member_block_pop(\"$gubn\", \"$user_id\");'> ".$btn_val." 차단</button>";
			}
		}

		return $btn_html; 
	}
	


	//회원 로그인 or 로그아웃 접속내역 로그남기기 헬퍼
	function user_login_log($gubn, $user_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($user_id)){ return; }		//아이디가 없을경우 리턴

		$arrData = array(
			"gubn"				=> $gubn,
			"user_id"			=> $user_id,
			"write_date"		=> NOW,
			"ip"				=> $_SERVER['REMOTE_ADDR'],
			"browser"			=> $_SERVER['HTTP_USER_AGENT']
		);

		$rtn = $CI->my_m->insert('user_login_log', $arrData);

		return;
	}

	
	//오늘 날짜 기준으로 무통장입금 신청 회원 3일전 회원리스트 뽑아서 입금 요구 문자 보내기 헬퍼
	function payment_mu_user_msg(){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('sms_lib');
		
		$today		= date('Y-m-d');									//오늘날짜
		$ago_day	= date('Y-m-d', strtotime($today. '-3day'));		//3일전날짜

		$sql = "";
		$sql .= " SELECT a.* ";
		$sql .= " FROM ";
		$sql .= " ( ";

		$sql .= " select a.m_idx, b.m_userid, b.m_product_code, b.m_goods, b.m_price, b.m_mstr, b.m_hp, b.m_writedate, b.m_card_ok ";
		$sql .= " from( ";
		$sql .= " SELECT max(m_idx) m_idx, m_userid ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_cash_gb = 'MU' ";
		$sql .= " AND m_writedate <= '$today 00:00:00' ";
		$sql .= " AND m_writedate >= '$ago_day 00:00:00' ";
		$sql .= " GROUP BY m_userid ";
		$sql .= " ORDER BY m_writedate DESC ";
		$sql .= " ) a, payment_temp b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " and a.m_idx = b.m_idx ";
		$sql .= " and b.m_card_ok = 'N' ";

		$sql .= " ) a, TotalMembers b ";
		$sql .= " WHERE a.m_userid = b.m_userid ";
		$sql .= " ORDER BY a.m_writedate DESC ";

		$query = $CI->db->query($sql);

		$result = $query->result_array();
		
		if(!empty($result)){
			//데이터가 있을경우

			$pattern = "/([\xEA-\xED][\x80-\xBF]{2}|[\ -\~])+/";

			foreach($result as $data){

				if($data['m_product_code'] == "1001" OR $data['m_product_code'] == "2001" OR $data['m_product_code'] == "2002" OR $data['m_product_code'] == "2003"){
					//준회원결제 상품일경우
					$sms_msg = "조이헌팅\n".$data['m_price']."원\n우리은행 1005-301-131626 위드유(이흥일)\n입금후 정회원사용가능";
				}else{
					//정회원결제 상품일경우
					$sms_msg = "조이헌팅\n".$data['m_price']."원\n우리은행 1005-301-131626 위드유(이흥일)\n입금후 포인트충전가능";
				}
				
				//정규식 처리
				preg_match_all($pattern, $data['m_hp'], $match);

				if(strlen($match[0][0]) <= "11" and strlen($match[0][0]) >= "10"){

					$CI->sms_lib->sms_send('', array($data['m_hp']), $sms_msg);

					//로그남기기
					$arrData = array(
						"user_id"			=> $data['m_userid'],
						"hp_num"			=> $data['m_hp'],
						"product_code"		=> $data['m_product_code'],
						"msg"				=> $sms_msg,
						"write_date"		=> NOW
					);

					$CI->my_m->insert('mu_alrim_log', $arrData);

				}

			}			

			return;

		}else{
			//데이터가 없을경우
			return;
		}

	}
	

	//조이헌팅 app회원 공지사항 예약발송 헬퍼
	function chat_app_push_book(){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->model('admin/chat_app_push_m');
		$CI->load->helper('alrim_helper');

		$book_list = $CI->my_m->result_array('APP_USER_PUSH_LOG', array('V_GUBN' => 'book', 'ex_V_WRITE_DATE' => 'V_WRITE_DATE IS NULL'), 'V_IDX', 'DESC', null);

		if(!empty($book_list)){

			foreach($book_list as $blist){
				
				if($blist['V_BOOK_DATE'] <= NOW){

					$mlist = $CI->chat_app_push_m->chat_app_user_query($blist['V_QUERY']);
				
					foreach($mlist as $data){		
						//app push 보내기 (alrim_helper)
						gcm_send($data['m_userid'], $blist['V_TITLE'], $blist['V_MSG'], $data['reg_id']);
					}

					$CI->my_m->update('APP_USER_PUSH_LOG', array('V_IDX' => $blist['V_IDX']), array('V_WRITE_DATE' => NOW));

				}
				
			}

		}

		return;

	}

	//회원가입시 선택 지역에 따라 임시 맵 좌표 생성 업데이트
	function get_coordination_member($user_id){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		if(empty($user_id)){ return; }

		$mdata = $CI->member_lib->get_member($user_id);
		
		$sql = "";
		$sql .= " SELECT * ";
		$sql .= " FROM( ";
		$sql .= " SELECT sido, gugun, dong ";
		$sql .= " FROM addr_temp ";
		$sql .= " GROUP BY dong ";
		$sql .= " ORDER BY sido ASC, gugun ASC, dong ASC ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND SIDO = '".$mdata['m_conregion']."' AND GUGUN LIKE '".$mdata['m_conregion2']."%' ";
		
		$query = $CI->db->query($sql);

		$address = $query->result_array();

		if(count($address) > 0){
			$rand_num = mt_rand(0, count($address)-1);
			$addr = $mdata['m_conregion']." ".$mdata['m_conregion2']." ".$address[$rand_num]['dong'];
		}else{
			if($mdata['m_conregion2'] == "세부지역"){
				$addr = $mdata['m_conregion'];
			}else{
				$addr = $mdata['m_conregion']." ".$mdata['m_conregion2'];
			}					
		}
		
		$map_data = get_map_addr($addr);		//지역으로 위치 좌표 생성하기(code_change_helper)
		
		//좌표 업데이트
		$CI->my_m->update('TotalMembers', array('m_userid' => $mdata['m_userid']), array('m_xpoint' => $map_data[0], 'm_ypoint' => $map_data[1]));

		return;

	}


	//회원가입 후 2시간 뒤 회원에게 앱설치 문자 보내기 헬퍼
	function reg_member_sms_represend(){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('sms_lib');

		$today		= date('Y-m-d');									//오늘날짜
		$ago_day	= date('Y-m-d', strtotime($today. '-1day'));		//하루전날짜
		
		$sql = "";
		$sql .= " SELECT a.*, b.cnt ";
		$sql .= " FROM TotalMembers a ";
		$sql .= " LEFT OUTER JOIN reg_member_msg_log b ON a.m_userid = b.user_id ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.m_hp1 IS NOT NULL AND a.m_hp2 IS NOT NULL AND a.m_hp3 IS NOT NULL ";
		$sql .= " AND a.m_hp1 <> '' AND a.m_hp2 <> '' AND a.m_hp3 <> '' ";
		$sql .= " AND a.m_hp_sms = '1' ";
		$sql .= " AND b.cnt IS NOT NULL AND b.cnt < 2 ";
		$sql .= " AND DATE_ADD(a.m_in_date, INTERVAL 2 HOUR) < SYSDATE() ";
		$sql .= " ORDER BY a.m_num DESC ";

		$query = $CI->db->query($sql);

		$result = $query->result_array();

		if(!empty($result)){
			//데이터가 있을경웅

			$cut_url = str_replace("https://", "", google_url_create());		//조이헌팅 단축 url(common_helper)
			$sms_msg = "조이헌팅 가입을 축하드립니다.\n\n앱설치\n".$cut_url;
			
			foreach($result as $data){
				$my_phone = $data['m_hp1']."-".$data['m_hp2']."-".$data['m_hp3'];
				$CI->sms_lib->sms_send("#1470", array($my_phone), $sms_msg);
				reg_member_msg_log($data['m_userid']);	//로그남기기
			}			

		}else{
			//데이터가 없을경우
		}

		return;

	}

	//회원가입 문자 발송 로그 데이터 
	function reg_member_msg_log($user_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		
		if(empty($user_id)){ return; }

		$cnt = $CI->my_m->cnt('reg_member_msg_log', array('user_id' => $user_id));

		if($cnt > 0){
			$reg_data = $CI->my_m->row_array('reg_member_msg_log', array('user_id' => $user_id), 'idx', 'desc', '1');
			$CI->my_m->update('reg_member_msg_log', array('user_id' => $user_id), array('cnt' => $reg_data['cnt']+1, 'date' => NOW));
		}else{
			$CI->my_m->insert('reg_member_msg_log', array('user_id' => $user_id, 'date' => NOW, 'cnt' => '1'));
		}

		return;
	}
	

	//회원 본인인증 로그 체크(테스트용 임시)
	function user_auth_log_chk($idx, $user_id = null, $result = null){

		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($mode) and empty($user_id)){ return; }
		
		$arrData['user_id'] = $user_id;

		if($idx == 1){
			$arrData['a1'] = "본인인증요청";
		}else if($idx == 2){
			$arrData['a2'] = "회원가입 : ".$result;
		}else if($idx == 3){
			$arrData['a3'] = "정보수정 : ".$result;
		}else if($idx == 4){
			$arrData['a4'] = "결과 : ".$result;
		}
		
		$cnt = $CI->my_m->cnt('user_auth_log', array('user_id' => $user_id));
		if($cnt > 0){
			$CI->my_m->update('user_auth_log', array('user_id' => $user_id), $arrData);
		}else{
			$CI->my_m->insert('user_auth_log', $arrData);
		}
		
	}


	//복주머니 이벤트 포인트 지급 체크 헬퍼
	function new_pocket_chk($user_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		
		if(empty($user_id)){ return; }

		$month	= date("m");		//현재의 월
		$day	= date("d");		//현재의 일
		$hour	= date("H");		//현재의 시간
		
		$arrData = array(
			"m_userid"			=> $user_id,
			"m_product_code"	=> "0000",
			"m_tradeid"			=> "0000",
			"m_goods"			=> "이벤트 포인트 지급",
			"ex_data_1"			=> "m_writedate >= '".date('Y-m-d H').":00:00' AND m_writedate <= '".date('Y-m-d H').":59:59' "
		);

		$cnt = $CI->my_m->cnt('member_point_list', $arrData);

		return $cnt;
	}


	//복주머니 포인트 지급 처리 헬퍼
	function new_pocket_point($user_id, $point){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');
		$CI->load->helper('point_helper');

		if(empty($user_id)){ return "1000"; }
		$data = $CI->member_lib->get_member($user_id);
		if(empty($data)){ return "1001"; }

		//포인트지급여부 한번더 체크
		$cnt = new_pocket_chk($data['m_userid']);
		if($cnt > 0){ return "5000"; }

		if($data['m_type'] == "V"){
			//정회원의 경우만 포인트 지급처리

			$m_etc = "새해 이벤트 ".$point."포인트 지급";

			$arrData = array(
				"m_userid"			=> $data['m_userid'],
				"m_product_code"	=> "0000",
				"m_goods"			=> "이벤트 포인트 지급",
				"m_point"			=> $point,
				"m_tradeid"			=> "0000",
				"m_etc"				=> $m_etc,
				"m_writedate"		=> NOW
			);

			$rtn = $CI->my_m->insert('member_point_list', $arrData);

			if($rtn == 1){
				//총포인트 업데이트 처리
				$total_point = total_point_sum($user_id);		//point_helper
				$CI->my_m->update('member_total_point', array('m_userid' => $user_id), array('total_point' => $total_point));
			}
						
		}else{
			//준회원의 경우 포인트 지금안함 및 이벤트 코드 세션 추가
			$CI->session->set_userdata(array('new_event_code' => 'new_pocket'));
			$rtn = "9999";
		}

		return $rtn;

	}
	
	//모바일 리스트 배너 랜덤으로 출력
	function m_list_banner(){
		
		$CI =& get_instance();
		$str = "";		
		
		$app_gubn = "";
		if(IS_APP and APP_OS == "IOS"){
			$app_gubn = "ios";
		}

		if(@$CI->session->userdata['m_type'] == "V" and @$CI->session->userdata['m_sex'] == "M" and $app_gubn <> "ios"){

				$rand = mt_rand(1, 2);
				if($rand == 1){
					$file_gubn = "gif";
				}else{
					$file_gubn = "png";
				}
				$banner_url = "javascript:nomotv_pop_layer(1);";
				//$banner_url = "/event/tv_event";
				$str .= "<div class='posi_rel width_100per'><a href='".$banner_url."'><img src='".IMG_DIR."/m/banner/fulltv_0".$rand.".".$file_gubn."' class='width_100per'></a></div>";


		}else if(@$CI->session->userdata['m_type'] == "F" and @$CI->session->userdata['m_sex'] == "M" and $app_gubn <> "ios"){

			$rand = mt_rand(1, 2);
			if($rand == 1){
				$file_gubn = "gif";
			}else{
				$file_gubn = "png";
			}
			//$banner_url = "http://partner.jjangtv.co.kr/?p_id=joyhunting";
			$banner_url = "javascript:nomotv_pop_layer(1);";
			$str .= "<div class='posi_rel width_100per'><a href='".$banner_url."'><img src='".IMG_DIR."/m/banner/fulltv_0".$rand.".".$file_gubn."' class='width_100per'></a></div>";
			//$str .= "<div class='posi_rel width_100per'><a href='".$banner_url."' target='_blank'><img src='".IMG_DIR."/m/banner/jjangtv0".$rand.".gif' class='width_100per'></a></div>";

		}else{

			$num = mt_rand(1, 3);
			
			if(empty($num)){ $num = 1; }

			//여름배너 고정배너
			$num = 6;			

			switch($num){
				case 1 : $str = "<div><a href='/service_center/event/trip'><img src='".IMG_DIR."/m/banner/20170315_banner.jpg' class='width_100per'></a></div>";	break;
				case 2 : $str = "<div><a href='/service_center/event_talk/talk_list'><img src='".IMG_DIR."/m/m_banner_spring.jpg' class='width_100per'></a></div>"; break;
				case 3 : $str = "<div><a href='/service_center/event/app_grade'><img src='".IMG_DIR."/m/banner/m_app_grade_banner.jpg' class='width_100per'></a></div>";	break;
				case 4 : $str = "<div><img src='".IMG_DIR."/m/banner/summer.jpg' class='width_100per'></div>";	break;
				case 5 : $str = "<div><a href='/service_center/event/vacance'><img src='".IMG_DIR."/m/banner/20170706_banner.jpg' class='width_100per'></a></div>";	break;
				case 6 : $str = "<div><a href='/profile/point/point_list'><img src='".IMG_DIR."/m/banner/20171017_banner.gif' class='width_100per'></a></div>";	break;
			}

		}
			
		return $str;

	}
	
	//회원 사이트내 url 추적
	function member_site_analytics(){

		$CI =& get_instance();

		if(IS_LOGIN){
			
			$user_id = @$CI->session->userdata['m_userid'];
			if(empty($user_id)){ return; }
					
			//현재위치 ( 전체 url  = current_url(); )
			$site_url = "/".uri_string();
			if($site_url == "/"){ $site_url = "메인페이지"; }

			$view_gubn = "P";
			if(IS_MOBILE){ $view_gubn = "M"; }

			$arrData = array(
				"user_id"		=> $user_id,
				"site_url"		=> $site_url,
				"user_ip"		=> $CI->input->ip_address(),
				"view_gubn"		=> $view_gubn,
				"write_date"	=> NOW
			);

			$CI->my_m->insert('member_site_analytics', $arrData);

		}

		return;

	}

?>