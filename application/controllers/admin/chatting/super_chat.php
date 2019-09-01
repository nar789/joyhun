<?php

class Super_chat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->helper('chat_helper');
		$this->load->helper('alrim_helper');
		$this->load->helper('search_helper');
		$this->load->library('member_lib');
		$this->load->model('admin/super_chat_m');
		$this->load->model('friend_m');

		admin_check();
	}

	function super_send(){		//슈퍼채팅 리스트


			// 포인트검색
			$chat_send  =  $data['point']  = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'point')));

			if(@$chat_send != 'null' && @$chat_send != ''){

				if($chat_send == '0'){
					$search['ex_point'] = "(total_point >= ".$chat_send." OR total_point IS NULL)";
				}else{
					$search['ex_point'] = "total_point >= ".$chat_send;
				}
			}

			// 지역 검색
			$area  =  $data['area']  = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'area')));

			if(@$area != 'null' && @$area != ''){
				if($area == "1"){
					$search['ex_area'] = "(m_conregion = '서울' OR m_conregion = '경기' OR m_conregion = '인천')";
				}else if($area == "2"){
					$search['ex_area'] = "(m_conregion = '부산' OR m_conregion = '울산' OR m_conregion = '경남')";
				}else if($area == "3"){
					$search['ex_area'] = "(m_conregion = '대구' OR m_conregion = '경북')";
				}else if($area == "4"){
					$search['ex_area'] = "(m_conregion = '광주' OR m_conregion = '전남' OR m_conregion = '전북')";
				}else if($area == "5"){
					$search['ex_area'] = "(m_conregion = '대전' OR m_conregion = '충남' OR m_conregion = '충북')";
				}else if($area == "6"){
					$search['ex_area'] = "(m_conregion = '강원')";
				}else if($area == "7"){
					$search['ex_area'] = "(m_conregion = '제주')";
				}else if($area == "8"){
					$search['ex_area'] = "(m_conregion = '해외')";
				}
			}

			
			// 나이 검색
			$Sage = $data['Sage'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Sage')));
			$Eage = $data['Eage'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Eage')));
			
			if(@$Sage != 'null' && @$Sage != ''){
				$search['ex_sage'] = "m_age >= ".$Sage." AND m_age <= ".$Eage;
			}

			// 접속날짜 (def = null);
			$Sonline = $data['Sonline'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Sonline')));
			$Eonline = $data['Eonline'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Eonline')));
			
			// 접속날짜 : 시작값이 있으면 접속날짜 검색
			if(@$Sonline != 'null' && @$Sonline != ''){
	
				// 접속날짜 : 시작값도있고 끝값도있으면
				if($Eonline != 'null'){
					$search['ex_last_login'] = "(last_login_day >= '".$Sonline." 00:00:00' AND last_login_day <= '".$Eonline." 23:59:59')";

				// 접속날짜 : 시작값만있으면 오늘날짜까지
				}else{
					$search['ex_last_login'] = "(last_login_day >= '".$Sonline." 00:00:00')";
				}
			}

			// 접속날짜 (def = null);
			$Sjoin = $data['Sjoin'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Sjoin')));
			$Ejoin = $data['Ejoin'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'Ejoin')));
			

			// 가입날짜 : 시작값이 있으면 가입날짜 검색
			if(@$Sjoin != 'null' && @$Sjoin != ''){

				// 가입날짜 : 시작값도있고 끝값도있으면
				if($Ejoin != 'null'){
					$search['ex_join_date'] = "(m_in_date >= '".$Sjoin." 00:00:00' AND m_in_date <= '".$Ejoin." 23:59:59')";

				// 가입날짜 : 시작값만있으면 오늘날짜까지
				}else{
					$search['ex_join_date'] = "(m_in_date >= '".$Sjoin." 00:00:00')";
				}
			}

			// 정회원여부 (def = A);
			$type = $data['type'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'type')));
			
			$search['ex_m_send_stop'] = "m_send_stop != '1'";

			// 정회원만
			if($type == 'V'){ $search['m_type'] = "V";
			// 준회원만
			}else if($type == 'F'){	$search['m_type'] = "F"; }
		
			if(!empty($search)){ 

				// 리스트에보여질 값 (MAX 50)
				$data['recv_mb'] = $this->super_chat_m->result_array('TotalMembers', @$search,'50');

				// 총 X명 검색
				$data['all_recv_mb'] = $this->super_chat_m->cnt('TotalMembers', @$search);

			}

		$search_sp['ex_not'] = "m_special = '1' AND m_sex = 'F'";
		$data['m_special'] = $this->my_m->result_array('TotalMembers', $search_sp, 'm_userid', 'asc', null);
		

		//예약발송 관련 추가
		//예약 발송날짜 기본값 셋팅
		if(empty($data['v_year'])){ $data['v_year'] = date('Y'); }
		if(empty($data['v_month'])){ $data['v_month'] = date('m'); }
		if(empty($data['v_v_day'])){ $data['v_day'] = date('d'); }

		$data['SUP100_LIST'] = $this->my_m->result_array('SUPER_CHAT_LOG', @$search2, 'V_IDX', 'DESC', '50');


		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/super_chat_v',@$data);
		$this->load->view('admin/admin_bottom_v');

	}


	// 스페셜 아이디 설정
	function special_search(){

		$user = rawurldecode($this->input->post('user',TRUE));
		$data = $this->member_lib->get_member($user);

		// 스페셜아이디 정보 뿌리기
		echo $data['m_userid'].",".$data['m_nick'].",".$data['m_age'].",".$data['m_conregion']." ".$data['m_conregion2'].",".$this->member_lib->member_thumb($data['m_userid'],238,172);
	}



	// 찜 + 채팅 공용 보내기
	function super_send_request(){

		$start			= rawurldecode($this->input->post('start',TRUE));				//시작 : 0
		$limit			= rawurldecode($this->input->post('limit',TRUE));				//한도 : 500
		$super_cnt		= rawurldecode($this->input->post('super_cnt',TRUE));			//대상 인원수

		$point			= rawurldecode($this->input->post('point',TRUE));				//검색조건 포인트
		$area			= rawurldecode($this->input->post('area',TRUE));				//검색조건 지역
		$Sage			= rawurldecode($this->input->post('Sage',TRUE));				//검색조건 나이 from
		$Eage			= rawurldecode($this->input->post('Eage',TRUE));				//검색조건 나이 to
		$Sonline		= rawurldecode($this->input->post('Sonline',TRUE));				//검색조건 접속날짜 from
		$Eonline		= rawurldecode($this->input->post('Eonline',TRUE));				//검색조건 접속날짜 to
		$Sjoin			= rawurldecode($this->input->post('Sjoin',TRUE));				//검색조건 가입날짜 from
		$Ejoin			= rawurldecode($this->input->post('Ejoin',TRUE));				//검색조건 가입날짜 to
		$type			= rawurldecode($this->input->post('type',TRUE));				//회원구분(전체, 정회원, 준회원)
		$contents		= rawurldecode($this->input->post('content',TRUE));				//내용(채팅보내기시에만 이용)
				
		$send_id		= rawurldecode($this->input->post('send_id',TRUE));				//보내는 회원 아이디
		$send_nick		= rawurldecode($this->input->post('send_nick',TRUE));			//보내는 회원 닉네임
		$send_age		= rawurldecode($this->input->post('send_age',TRUE));			//보내느 회원 나이

		$mode			= rawurldecode($this->input->post('mode',TRUE));				//모드값 (채팅 : chat, 찜 : jjim, 프로필이미지쪽지 : profile, 메세지 : message, 지도표시 : map)
		$gubn			= rawurldecode($this->input->post('gubn',TRUE));				//구분값 (즉시 : send, 예약 : book)

		if($gubn == "send"){
			//즉시발송 처리
			
			//받은 조건으로 채팅또는 찜을 받을 회원 리스트 가져오기(chat_helper)
			$recv_mb = call_chat_recv_list(null, null, $point, $area, $Sage, $Eage, $Sonline, $Eonline, $Sjoin, $Ejoin, $type, $send_id);


			//즉시발송 로그데이터
			$sup100_array = array(
				"V_GUBN"			=> "즉시발송",
				"V_MODE"			=> $mode,
				"V_SEND_ID"			=> $send_id,
				"V_SEND_NICK"		=> $send_nick,
				"V_SEND_AGE"		=> $send_age,
				"V_CNT"				=> count($recv_mb),
				"V_CONTENTS"		=> $contents,
				"V_POINT"			=> $point,
				"V_AREA"			=> $area,
				"V_AGE_1"			=> $Sage,
				"V_AGE_2"			=> $Eage,
				"V_ONLINE_1"		=> $Sonline,
				"V_ONLINE_2"		=> $Eonline,
				"V_JOIN_1"			=> $Sjoin,
				"V_JOIN_2"			=> $Ejoin,
				"V_TYPE"			=> $type,
				"V_STAT"			=> "발송완료",
				"V_WRITE_DATE"		=> NOW,
				"V_BOOK_DATE"		=> null,
				"V_OK_DATE"			=> NOW
			);
					
			if(!empty($recv_mb)){

				if($mode == "chat"){
				//채팅보내기
					
					foreach($recv_mb as $data){
						//채팅 보내기(chat_helper)
						call_super_chat_chk($send_id, $send_nick, $data['user_id'], $contents,1);
					}

					//즉시발송 발송시 로그남기기
					$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $sup100_array);
				
				}else if($mode == "jjim"){
				//찜보내기
					foreach($recv_mb as $data){

						$arrData = array(
							"m_userid"			=> $send_id,
							"m_nick"			=> $send_nick,
							"m_sex"				=> "F",
							"m_age"				=> $send_age,
							"m_writedate"		=> NOW,
							"m_fuserid"			=> $data['user_id'],
							"m_fnick"			=> $data['user_nick'],
							"m_fsex"			=> "M",
							"m_content"			=> "",
							"m_gubun"			=> "찜"
						);

						$rtn = $this->friend_m->reg_f_list($arrData);

						if($rtn == 1){
							//찜 조이헌팅알림 alrim_helper
							joyhunting_alrim("찜", $arrData['m_fuserid'], $arrData['m_userid']);

							//찜 조이헌팅 이메일 알림 alrim_helper
							joyhunting_email_alrim("찜", $arrData['m_fuserid'], $arrData['m_userid']);
							
							//(찜, 앤, 친구)등록시 인기점수 +10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
							member_popularity('1', $arrData['m_fuserid'], '10');
						}

					}
					//즉시발송 발송시 로그남기기
					$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $sup100_array);

				}else if($mode == "profile"){
					//신청내용이 본인 인사말
					//보내는 회원 정보 가져오기

					$send_data = $this->member_lib->get_member($send_id);

					if(!empty($send_data['my_intro'])){
						$contents = $send_data['my_intro'];
					}else{
						$contents = "친하게 지내보자구요.ㅎㅎ 편안하게 즐겁게";
					}

					foreach($recv_mb as $data){
						//채팅 보내기(chat_helper)
						call_super_chat_chk($send_id, $send_nick, $data['user_id'], $contents, $mode,1);
					}

					//즉시발송 발송시 로그남기기
					$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $sup100_array);

				}else if($mode == "message"){
					
					//메세지 보내기
					foreach($recv_mb as $data){
						
						//전송 내용에 [지역] 이 있을경우 받는 회원의 지역2로 데이터 치환
						if(strpos($contents, '[지역]') !== false){
							$my_data = $this->member_lib->get_member($data['user_id']);
							$contents = str_replace('[지역]', $my_data['m_conregion2'], $contents);
						}

						$arrData = array(
							"V_SEND_ID"		=> $send_id,
							"V_RECV_ID"		=> $data['user_id'],
							"V_CONTENTS"	=> $contents,
							"V_WRITE_DATE"	=> NOW
						);

						$rtn = $this->my_m->insert('MESSAGE_LIST', $arrData);

						if($rtn == "1"){
							joyhunting_alrim('메세지', $arrData['V_RECV_ID'], $arrData['V_SEND_ID']);
						}
					}

					//즉시발송 발송시 로그남기기
					$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $sup100_array);					

				}else if($mode == "map"){

					foreach($recv_mb as $data){
						//채팅 보내기(chat_helper)
						call_super_chat_chk($send_id, $send_nick, $data['user_id'], $contents, $mode,1);
					}

					//즉시발송 발송시 로그남기기
					$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $sup100_array);

				}else{
				//잘못된 접근
					echo "9"; exit;
				}

				//슈퍼채팅 회원 로그인하기
				$this->member_lib->total_members_log($send_id, "super");

			}

			//즉시발송시

		}else if($gubn == "book"){
			//예약처리

			//추가변수 
			$v_year			= rawurldecode($this->input->post('v_year',TRUE));				//년
			$v_month		= rawurldecode($this->input->post('v_month',TRUE));				//월
			$v_day			= rawurldecode($this->input->post('v_day',TRUE));				//일
			$v_time			= rawurldecode($this->input->post('v_time',TRUE));				//시간
			$v_minute		= rawurldecode($this->input->post('v_minute',TRUE));			//분

			$v_book_date = $v_year."-".$v_month."-".$v_day." ".$v_time.":".$v_minute.":00";			//발송예정시간
			
			//발송예정시간이 현재시간보다 작을경우 처리
			if($v_book_date <= date('Y-m-d H:i:s')){
				echo "1000"; exit;
			}

			if($mode == "profile"){
				$send_data = $this->member_lib->get_member($send_id);
				if(!empty($send_data['my_intro'])){
					$contents = $send_data['my_intro'];
				}else{
					$contents = "친하게 지내보자구요.ㅎㅎ 편안하게 즐겁게";
				}
			}

			$arrData = array(
				"V_GUBN"			=> "예약발송",
				"V_MODE"			=> $mode,
				"V_SEND_ID"			=> $send_id, 
				"V_SEND_NICK"		=> $send_nick,
				"V_SEND_AGE"		=> $send_age,
				"V_CONTENTS"		=> $contents,
				"V_CNT"				=> $super_cnt,
				"V_POINT"			=> $point,
				"V_AREA"			=> $area,
				"V_AGE_1"			=> $Sage,
				"V_AGE_2"			=> $Eage,
				"V_ONLINE_1"		=> $Sonline,
				"V_ONLINE_2"		=> $Eonline,
				"V_JOIN_1"			=> $Sjoin,
				"V_JOIN_2"			=> $Ejoin,
				"V_TYPE"			=> $type,
				"V_STAT"			=> "예약",
				"V_WRITE_DATE"		=> NOW,
				"V_BOOK_DATE"		=> $v_book_date,
				"V_OK_DATE"			=> null
			);

			$rtn = $this->my_m->insert('SUPER_CHAT_LOG', $arrData);

			echo $rtn; exit;

		}else{
			//잘못된 접근
		}
		

	} // 찜 + 채팅 공용 보내기끝
	


	//발송예약 취소처리 함수
	function call_book_cancel(){

		$idx = rawurldecode($this->input->post('idx', true));

		$rtn = $this->my_m->update('SUPER_CHAT_LOG', array('V_IDX' => $idx), array('V_STAT' => '취소', 'V_OK_DATE' => NOW));

		echo $rtn;
	}


}