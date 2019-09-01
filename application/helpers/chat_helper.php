<?php
	
	//채팅관련 헬퍼

	//채팅신청시 수락 or 거절을 2시간내에 하지 않은경우 채팅신청 삭제처리
	//현재 진행중인 채팅중 마지막 채팅으로부터 12시간이 지난 채팅등 삭제처리
	//관련 테이블 chat, chat_request, alrim_new

	//2016-08-02 전부 7일로 수정 
	function chat_request_flg(){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->helper('point_helper');
		$CI->load->library('member_lib');

		/******* 정회원 채팅삭제 ********/

		$set_time_v = "24"; //설정시간

		//채팅신청후 설정시간 이내에 수락되지 않은 채팅신청내역 삭제처리 업데이트(거절 or 미응답)
		$strSQL_V = " UPDATE chat_request a, TotalMembers b SET a.is_delete = 'D', a.alrim_del = 'D' WHERE a.recv_id = b.m_userid AND (a.STATUS = '' OR a.STATUS = '거절') AND DATE_ADD(a.request_date, INTERVAL ".$set_time_v." HOUR) <= SYSDATE() AND a.is_delete is NULL AND b.m_type = 'V' ";
		
		$CI->db->query($strSQL_V);

		/******* 준회원 채팅삭제 ********/

		$set_time_f = "6"; //설정시간

		//채팅신청후 설정시간 이내에 수락되지 않은 채팅신청내역 삭제처리 업데이트(거절 or 미응답)
		$strSQL_F = " UPDATE chat_request a, TotalMembers b SET a.is_delete = 'D', a.alrim_del = 'D' WHERE a.recv_id = b.m_userid AND (a.STATUS = '' OR a.STATUS = '거절') AND DATE_ADD(a.request_date, INTERVAL ".$set_time_f." HOUR) <= SYSDATE() AND a.is_delete is NULL AND b.m_type = 'F' ";
		
		$CI->db->query($strSQL_F);


		//24시간이 지난 포인트 환불처리
		/*
		$p_data = $CI->my_m->result_array('chat_request', array('refund' => '환불대상',  'ex_date' => 'DATE_ADD(request_date, INTERVAL 24 HOUR) <= SYSDATE()' )	, 'idx', 'DESC', NULL);		

		if(!empty($p_data)){
			foreach($p_data as $data){
				
				//	var_dump($data);

				//1. 발송자 / 수신자 누가 남자인가?
				$mem = $CI->member_lib->get_member($data['send_id']);

					if( $mem["m_sex"] == "M"){
						$user_id = $data['send_id'];
					}else{
						$user_id = $data['recv_id'];
					}
				//2. 포인트 돌려주기

					$chat_pd = $CI->my_m->row_array('product_list', array('m_product_code' => '8000', 'm_use_yn' =>'Y', 'm_gubn' => 'A'));
					member_point_insert($user_id, $chat_pd['m_product_code'], $chat_pd['m_goods'], $chat_pd['m_point'], null, null, NOW, null);

				//3.  환불완료 체크

					$CI->my_m->update('chat_request', array('idx' => $data['idx']), array('refund' => '환불완료'));

			}
		}
		*/
		

		/******* 정회원 및 기타 탈퇴자들 채팅삭제 ********/

		$set_time = "168"; //설정시간

		//채팅신청후 설정시간 이내에 수락되지 않은 채팅신청내역 삭제처리 업데이트(거절 or 미응답)
		$strSQL1 = " UPDATE chat_request SET is_delete = 'D', alrim_del = 'D' WHERE (STATUS = '' OR STATUS = '거절') AND DATE_ADD(request_date, INTERVAL ".$set_time." HOUR) <= SYSDATE() AND is_delete is NULL";

		//채팅신청후 설정시간 이내에 수락되지 않은 채팅신청내역 삭제처리시 채팅관련내용 삭제 업데이트
		$strSQL2 = " UPDATE chat SET is_delete_gubn = 'D' WHERE req_idx IN (SELECT idx FROM chat_request WHERE is_delete = 'D') AND is_delete_gubn is NULL";
		
		//마지막 채팅시간으로부터 설정시간이 지난 채팅 관련 리스트 전부 삭제 처리 업데이트(수락된 채팅들 처리)
		$strSQL3 = "";
		$strSQL3 .= " UPDATE chat c, ";
		$strSQL3 .= " ( ";
		$strSQL3 .= " select b.* ";
		$strSQL3 .= " from ";
		$strSQL3 .= " ( ";
		$strSQL3 .= " SELECT max(idx) idx ";
		$strSQL3 .= " from chat ";
		$strSQL3 .= " where is_delete_gubn is null ";
		$strSQL3 .= " group by req_idx ";
		$strSQL3 .= " ) a, chat b  ";
		$strSQL3 .= " where a.idx = b.idx ";
		$strSQL3 .= " and DATE_ADD(b.reg_date, INTERVAL ".$set_time." hour) < SYSDATE() ";
		$strSQL3 .= " order by b.idx desc ";
		$strSQL3 .= " ) d ";
		$strSQL3 .= " SET c.is_delete_gubn = 'D' ";
		$strSQL3 .= " WHERE c.req_idx = d.req_idx ";
		
		//마지막 채팅시간으로부터 설정시간이 지난 채팅 관련 리스트에 대한 채팅 신청 내역 삭제 처리 업데이트
		$strSQL4 = "";
		$strSQL4 .= " UPDATE chat_request a, (SELECT req_idx FROM chat WHERE is_delete_gubn = 'D' GROUP BY req_idx ORDER BY req_idx DESC) b ";
		$strSQL4 .= " SET a.is_delete = 'D' ";
		$strSQL4 .= " WHERE a.idx = b.req_idx ";

		//사라진 채팅방에 대한 알림카운트 빼기 업데이트

		$CI->db->query($strSQL1);
		$CI->db->query($strSQL2);
		$CI->db->query($strSQL3);
		$CI->db->query($strSQL4);

		/******* DISK 에서 완전삭제 ********/

		//삭제된 채팅 데이터 DISK에서 완전 삭제 (2016-08-08)
		$strSQL5 = "delete from chat where is_delete_gubn = 'D' ";
		$CI->db->query($strSQL5);
		$strSQL6 = "delete from chat_request where is_delete = 'D' ";
		$CI->db->query($strSQL6);
	}
	
	//만약 채팅방을 나갔는데도 채팅 데어터가 살아있을경우 삭제 처리 돌리면됨(임시) 
	//두명의 회원이 채팅을 하다가 둘다 채팅방을 나간경우 채팅방과 채팅내역 삭제 처리(예외처리)
	function chat_exit_flg(){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		$strSQL1 = "";
		$strSQL1 .= " UPDATE chat ";
		$strSQL1 .= " SET is_delete_gubn = 'D' ";
		$strSQL1 .= " WHERE req_idx IN(SELECT req_idx FROM chat WHERE MODE = 'exit' AND is_delete_send <> '0' AND is_delete_recv <> '0' GROUP BY req_idx) ";

		$strSQL2 = "";
		$strSQL2 .= " UPDATE chat_request ";
		$strSQL2 .= " SET is_delete = 'D' ";
		$strSQL2 .= " WHERE idx IN(SELECT req_idx FROM chat WHERE MODE = 'exit' AND is_delete_send <> '0' AND is_delete_recv <> '0' GROUP BY req_idx) ";

		$CI->db->query($strSQL1);
		$CI->db->query($strSQL2);

	}
	
	//두 아이디로 채팅신청 보내기
	//$send_id = 발송자 (여성) 아이디, 닉네임
	//$my_id = 받을 대상 아이디
	//$contents = 채팅신청 내용
	//$mode = 슈퍼채팅에서 보내는 종류
	//$is_super = 관리자 슈퍼채팅에서 보내는것인가(1), 기타 페이지에서 사용하는 함수인가(0)
	function super_chat_request($send_id, $send_nick, $my_id, $contents, $mode = null, $is_super = 0){

		$CI =& get_instance();
		$CI->load->model('chat_m');
		$CI->load->helper('alrim_helper');
		$CI->load->library('member_lib');
			
			//전송 내용에 [지역] 이 있을경우 받는 회원의 지역2로 데이터 치환
			if(strpos($contents, '[지역]') !== false){
				$my_data = $CI->member_lib->get_member($my_id);
				if($my_data['m_conregion2'] == ""){$my_data['m_conregion2'] = "서울";}
				$contents = str_replace('[지역]', $my_data['m_conregion2'], $contents);
			}

			//채팅 신청 추가
			$request_data = array(
				'send_id' =>$send_id,
				'recv_id' => $my_id,
				'request_date' => NOW,
				'accept_date' => Null,
				'contents' => $contents,
				'status' => '',
				'send_user_nick' => $send_nick,
				'mode' => $mode
			);


			$req_idx = $CI->chat_m->add_request_chat($request_data);


			//본문에 "채팅 내용" 추가
			$chat_data = array(
				'mode' => 'chat_request',
				'send_id' =>$send_id,
				'recv_id' => $my_id,
				'reg_date' => NOW,
				'read_date' => Null,
				'contents' => $contents,
				'send_ip' => $_SERVER['REMOTE_ADDR'],
				'is_delete_send' => '0',
				'is_delete_recv' => '0',
				'send_user_nick' => $send_nick,
				'req_idx'		 => $req_idx,
				'is_super' => $is_super
			);

			$last_id = $CI->chat_m->add_chat($chat_data);
			

			//본문에 채팅 신청내용추가 (상대방이 보는것)
			$chat_data = array(
				'mode' => 'request',
				'send_id' =>$my_id,
				'recv_id' => $send_id,
				'reg_date' => NOW,
				'read_date' => Null,
				'contents' => "채팅신청을 보냈습니다",
				'send_ip' => $_SERVER['REMOTE_ADDR'],
				'is_delete_send' => '0',
				'is_delete_recv' => '0',
				'req_idx'		 => $req_idx
			);
			$last_id = $CI->chat_m->add_chat($chat_data);

			//본문에 채팅 신청내용추가 (전송자가 보는것)
			$chat_data = array(
				'mode' => 'request',
				'send_id' =>$send_id,
				'recv_id' => $my_id,
				'reg_date' => NOW,
				'read_date' => Null,
				'contents' => $send_nick."님이 채팅신청을 보냈습니다.",
				'send_ip' => $_SERVER['REMOTE_ADDR'],
				'is_delete_send' => '0',
				'is_delete_recv' => '0',
				'req_idx'		 => $req_idx
			);
			$last_id = $CI->chat_m->add_chat($chat_data);


			//신규 채팅신청 알림 추가
			$user_pic = $CI->member_lib->member_thumb($send_id,74,71);

			$alrim_data = array(
				'mode' => 'chat',
				'send_id' => $send_id,
				'user_pic' => rawurldecode($user_pic),
				'recv_id' => $my_id,
				'new_text' => $contents,
				'new_nick' => $send_id,
				'idx' => $req_idx
			);

			$rtn = $CI->chat_m->add_alrim($alrim_data);

			$CI->chat_m->last_chat_data_insert($req_idx);

			//GCM 알림 처리
			gcm_send($my_id, "조이헌팅 채팅", $send_nick." : ".$contents);

	}


	//슈퍼채팅 관련
	//채팅을 받은 회원의 리스트 가져오기(포인트, 지역, 나이1, 나이2, 접속날짜1, 접속날짜2, 가입날짜1, 가입날짜2, 회원구분)
	function call_chat_recv_list($start = null, $limit = null, $point = null, $area = null, $age_1 = null, $age_2 = null, $online_1 = "null", $online_2 = "null", $join_1 = "null", $join_2 = "null", $type = null, $send_id){
		
		$CI =& get_instance();

		$sql = "";
		$sql .= " SELECT a.m_userid user_id, a.m_nick user_nick, IFNULL(b.total_point, 0) total_point, IFNULL(c.m_gubun, 'OK') m_gubun ";
		$sql .= " FROM TotalMembers a ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " member_total_point b ";
		$sql .= " ON a.m_userid = b.m_userid ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " (SELECT m_userid, m_gubun FROM T_MakeFriend_List WHERE m_fuserid = '".$send_id."' AND m_gubun = '나쁜친구') c ";
		$sql .= " ON a.m_userid = c.m_userid ";
		$sql .= " WHERE 1=1 AND a.m_sex = 'M' AND a.m_send_stop != '1' AND IFNULL(c.m_gubun, 'OK') <> '나쁜친구' ";
		
		//검색조건
		//포인트
		if(!empty($point)){ $sql .= " AND IFNULL(b.total_point, 0) >= '".$point."' "; }

		//지역
		if(!empty($area)){
			if($area == "1"){ $sql .= " AND (m_conregion = '서울' OR m_conregion = '경기' OR m_conregion = '인천') "; }
			if($area == "2"){ $sql .= " AND (m_conregion = '부산' OR m_conregion = '울산' OR m_conregion = '경남') "; }
			if($area == "3"){ $sql .= " AND (m_conregion = '대구' OR m_conregion = '경북') "; }
			if($area == "4"){ $sql .= " AND (m_conregion = '광주' OR m_conregion = '전남' OR m_conregion = '전북') "; }
			if($area == "5"){ $sql .= " AND (m_conregion = '대전' OR m_conregion = '충남' OR m_conregion = '충북') "; }
			if($area == "6"){ $sql .= " AND (m_conregion = '강원') "; }
			if($area == "7"){ $sql .= " AND (m_conregion = '제주') "; }
			if($area == "8"){ $sql .= " AND (m_conregion = '해외') "; }
		}
		
		//나이
		if(!empty($age_1) and $age_1 != "0"){ $sql .= " AND m_age >= '".$age_1."' "; }
		if($age_2 != "null" and $age_2 != "0"){ $sql .= " AND m_age <= '".$age_2."' "; }
		
		//접속날짜
		if($online_1 != "null"){ $sql .= " AND last_login_day >= '".$online_1." 00:00:00' "; }
		if($online_2 != "null"){ $sql .= " AND last_login_day <= '".$online_2." 24:00:00' "; }
	
		//가입날짜
		if($join_1 != "null"){ $sql .= " AND m_in_date >= '".$join_1." 00:00:00' "; }
		if($join_2 != "null"){ $sql .= " AND m_in_date <= '".$join_2." 24:00:00' "; }
		
		//회원등급
		if(!empty($type)){
			if($type != "A"){ $sql .= " AND m_type = '".$type."' "; }
		}
		
		if(!empty($start) and !empty($limit)){
			$sql .= "LIMIT ".$start.", ".$limit." ";
		}		

		$query = $CI->db->query($sql);
		
		return $query->result_array();

	}

	//슈퍼채팅 예약발송 관련 헬퍼
	function call_booking_super_chat_send(){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->helper('alrim_helper');
		$CI->load->library('member_lib');

		//발송상태가 예약상태인 리스트 가져오기
		$book = $CI->my_m->result_array('SUPER_CHAT_LOG', array('V_STAT' => '예약', 'V_OK_DATE' => NULL, 'ex_data_1' => 'V_BOOK_DATE <= SYSDATE()'), 'V_IDX', 'DESC', NULL);
		
		//예약완료로 즉시 바꿈 (무한루프 방지)
		$CI->my_m->update('SUPER_CHAT_LOG', array('V_STAT' => '예약', 'V_OK_DATE' => NULL, 'ex_data_1' => 'V_BOOK_DATE <= SYSDATE()'), array('V_STAT' => '발송완료', 'V_OK_DATE' => NOW));

		if(!empty($book)){
			//예약상태인 채팅신청 혹은 찜신청이 있을경우
			
			//조건별로 발송대상자 리스트 조회해서 발송처리
			foreach($book as $data){
				
				$mlist = call_chat_recv_list(null, null, $data['V_POINT'], $data['V_AREA'], $data['V_AGE_1'], $data['V_AGE_2'], $data['V_ONLINE_1'], $data['V_ONLINE_2'], $data['V_JOIN_1'], $data['V_JOIN_2'], $data['V_TYPE'], $data['V_SEND_ID']);
				
				if(!empty($mlist)){

					if($data['V_MODE'] == 'chat'){

						//채팅을 보내는경우
						foreach($mlist as $val){
							//채팅 보내기(chat_helper)	 채팅 보내기전 체크후 채팅 보내기
							call_super_chat_chk($data['V_SEND_ID'], $data['V_SEND_NICK'], $val['user_id'], $data['V_CONTENTS'],1);
						}

					}else if($data['V_MODE'] == 'jjim'){
						//찜신청을 하는경우

						foreach($mlist as $val){

							$arrData = array(
								"m_userid"			=> $data['V_SEND_ID'],
								"m_nick"			=> $data['V_SEND_NICK'],
								"m_sex"				=> "F",
								"m_age"				=> $data['V_SEND_AGE'],
								"m_writedate"		=> NOW,
								"m_fuserid"			=> $val['user_id'],
								"m_fnick"			=> $val['user_nick'],
								"m_fsex"			=> "M",
								"m_content"			=> "",
								"m_gubun"			=> "찜"
							);

							$rtn = $CI->friend_m->reg_f_list($arrData);

							if($rtn == 1){
								//찜 조이헌팅알림 alrim_helper
								joyhunting_alrim("찜", $arrData['m_fuserid'], $arrData['m_userid']);

								//찜 조이헌팅 이메일 알림 alrim_helper
								joyhunting_email_alrim("찜", $arrData['m_fuserid'], $arrData['m_userid']);
								
								//(찜, 앤, 친구)등록시 인기점수 +10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
								member_popularity('1', $arrData['m_fuserid'], '10');
							}

						}


					}else if($data['V_MODE'] == 'profile'){
						//프로필 메세지 쪽지 보내기인 경우

						//채팅을 보내는경우
						foreach($mlist as $val){
							//채팅 보내기(chat_helper)	채팅 보내기전 체크후 채팅 보내기
							call_super_chat_chk($data['V_SEND_ID'], $data['V_SEND_NICK'], $val['user_id'], $data['V_CONTENTS'], $data['V_MODE'],1);
						}


					}else if($data['V_MODE'] == 'message'){
						//메세지 보내기인경우

						foreach($mlist as $val){
							
							//전송 내용에 [지역] 이 있을경우 받는 회원의 지역2로 데이터 치환
							if(strpos($data['V_CONTENTS'], '[지역]') !== false){
								$my_data = $CI->member_lib->get_member($val['user_id']);
								if($my_data['m_conregion2'] == ""){$my_data['m_conregion2'] = "서울";}
								$data['V_CONTENTS'] = str_replace('[지역]', $my_data['m_conregion2'], $data['V_CONTENTS']);
							}

							$arrData = array(
								"V_SEND_ID"		=> $data['V_SEND_ID'],
								"V_RECV_ID"		=> $val['user_id'],
								"V_CONTENTS"	=> $data['V_CONTENTS'],
								"V_WRITE_DATE"	=> NOW
							);

							$rtn = $CI->my_m->insert('MESSAGE_LIST', $arrData);

							if($rtn == "1"){
								joyhunting_alrim('메세지', $arrData['V_RECV_ID'], $arrData['V_SEND_ID']);
							}
						}

					}else if($data['V_MODE'] == 'map'){
						
						//채팅을 보내는경우
						foreach($mlist as $val){
							//채팅 보내기(chat_helper)	 채팅 보내기전 체크후 채팅 보내기
							call_super_chat_chk($data['V_SEND_ID'], $data['V_SEND_NICK'], $val['user_id'], $data['V_CONTENTS'], $data['V_MODE'],1);
						}

					}else{
						//해당사항에 없는경우
					}


				}
				
				
			}

			//슈퍼채팅 회원 로그인하기
			$CI->member_lib->total_members_log($data['V_SEND_ID'], "super");

			return;

		}else{
			//예약상태인 채팅신청 혹은 찜신청이 없을경우 중지처리
			return;
		}

	}

	//관리자 슈퍼채팅 보낼때 이미 채팅중인 회원인지 수락대기중인 회원인지 체크하기
	function call_super_chat_chk($send_id, $send_nick, $my_id, $contents, $mode = null, $is_super = 0){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		$search = array(
			"ex_data_1"	=> "((send_id = '".$send_id."' AND recv_id = '".$my_id."') OR (send_id = '".$my_id."' AND recv_id = '".$send_id."'))",
			"ex_data_2"	=> "is_delete is null"
		);
		
		//채팅 신청회원과 받는회원의 채팅 삭제되지 않은 채팅 신청 내역이 있는지 확인
		$req_data = $CI->my_m->row_array('chat_request', $search, 'idx', 'desc', '1');
		
		if(!empty($req_data)){
			//신청내역이 있는경우
			
			if(empty($req_data['status'])){
				//상태가 수락대기중인경우 삭제처리하고 다시보내기
				$rtn_1 = $CI->my_m->update('chat_request', array('idx' => $req_data['idx']), array('is_delete' => 'D'));			//신청내역 삭제처리
				$rtn_2 = $CI->my_m->update('chat', array('req_idx' => $req_data['idx']), array('is_delete_gubn' => 'D'));			//기본대화 삭제처리
				
				//삭제처리가 모두 완료된 경우만 다시 채팅 보내기
				if($rtn_1 == "1" and $rtn_2 == "1"){
					super_chat_request($send_id, $send_nick, $my_id, $contents, $mode, $is_super);
				}				
			}

		}else{
			//신청내역이 없는경우(채팅신청)
			super_chat_request($send_id, $send_nick, $my_id, $contents, $mode, $is_super);
		}

		return;

	}


	//메세지 관련 

	//3개월 지난 메세지 삭제 처리 
	function call_message_del(){

		$CI =& get_instance();
		$CI->load->model('my_m');

		//디스크에서 완전 삭제 (2016-08-08)
		$sql = "";
		$sql .= " DELETE FROM MESSAGE_LIST ";
		$sql .= " WHERE V_DEL_GUBN IS NULL AND DATE_ADD(V_WRITE_DATE, INTERVAL 3 MONTH) < SYSDATE() ";

		$CI->db->query($sql);

	}

	
?>