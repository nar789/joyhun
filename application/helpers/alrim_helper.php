<?php
	
	//회원별 알림 설정에 따른 알림관련 함수들 모아놓음(조이헌팅알림)
	//1.프로포즈신청 2.소개팅 3.번개팅신청 4.짝애정촌 프로포즈 5. 찜하기
	//6.친구등록 7.서로친구등록 8.친구프로필사진변경 9.친구번개팅등록 10.앤등록
	//11.서로앤등록 12.기타알림
	
	//알림보내기 함수
	//mode = 구분값, recv_id = 받는회원아이디, send_id = 보내는회원아이디
	function joyhunting_alrim($mode, $recv_id, $send_id = null){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->model('chat_m');
		$CI->load->library('member_lib');

		//받는사람의 알림설정가져오기
		
		//보내는 사람의 아이디가 있을경우
		if($send_id){
			$s_member_data  = $CI->member_lib->get_member($send_id);				//보내는 사람의 회원정보가져오기
			$s_nick			= $s_member_data['m_nick'];								//보내는 사람의 닉네임
			$s_pic			= $CI->member_lib->member_thumb($send_id, 74, 71);		//보내는 사람의 사진
		}
		
		//알림 분류별 변수 설정
		switch($mode){
			
			case "프로포즈" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기

				//프로포즈보내기(O)
				$contents		= $s_nick."님이 회원님에게 프로포즈를 보냈습니다.";
				$event_url		= "/profile/propose/receive_propose";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;
			
			case "번개팅" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기

				//미팅신청 번개팅 -> 번개팅요청(O)
				$contents		= $s_nick."님이 회원님에게 번개팅을 보냈습니다.";
				$event_url		= "/meeting/beongae/mypage_recv";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "짝대기" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기	

				//짝/애정촌 -> 짝대기보내기(O)
				$contents		= $s_nick."님이 회원님에게 짝대기를 보냈습니다.";
				$event_url		= "/meeting/jjack/mypage_recv";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;
			
			case "찜" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//찜하기(O)
				$contents		= $s_nick."님이 회원님을 찜 했습니다.";
				$event_url		= "/profile/jjim/receive_jjim";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;
			
			case "소개팅좋아요" :
				
				//소개팅좋아요(O)
				$contents		= $s_nick."님이 소개팅에서 회원님에게 좋아요를 보냈습니다.";
				$event_url		= "/blindmeet/blind/recv_like";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "친구등록" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//친구등록(O)
				$contents		= $s_nick."님이 회원님을 친구등록 했습니다.";
				$event_url		= "/profile/my_friend/receive_friend";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "서로친구" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//서로친구가 되었을경우(O)
				$contents		= $s_nick."님과 서로 친구가 되었습니다.";
				$event_url		= "/profile/my_friend/together_friend";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;
			
			case "친구사진변경" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//친구의 프로필사진이 변경되었을경우(O)
				$contents		= $s_nick."님의 프로필 사진이 변경되었습니다.";
				$event_url		= "/profile/main/user/user_id/".$send_id;
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;


			case "친구번개팅" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//친구가 번개팅을 등록했을경우(O)
				$contents		= $s_nick."님이 번개팅을 등록했습니다.";
				$event_url		= "/meeting/beongae/all";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "앤" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//앤되기(O)
				$contents		= $s_nick."님이 회원님을 앤으로 등록했습니다.";
				$event_url		= "/profile/my_anne/receive_anne";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "서로앤" :
				$rtn = member_alrim_chk($mode, $recv_id, '2');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				
				//서로앤이 됐을경우(O)
				$contents		= $s_nick."님과 서로 앤이 되었습니다.";
				$event_url		= "/profile/my_anne/send_anne";
				$event_btn_text = "보러가기";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "출석체크" :
				
				//기타(출석체크)(O)
				$contents		= "출석체크하여 인기점수 5점을 획득하셨습니다.";
				$event_url		= "/service_center/event_stamp/stamp_event";
				$event_btn_text = "확인";
				$send_user_id	= "joyhunting";
				$send_user_nick = "조이헌팅";
				$send_user_pic	= "";
				break;

			case "고객문의답변" :
				
				//기타(고객문의답변)(O)
				$contents		= "문의하신 내용에 답변이 도착했습니다.";
				$event_url		= "/service_center/my_question/my_question_list";
				$event_btn_text = "보러가기";
				$send_user_id	= "joyhunting";
				$send_user_nick = "조이헌팅";
				$send_user_pic	= "";
				break;

			case "경고" :
				
				//경고를 받았을경우(O)
				$contents		= "회원님은 경고를 처벌받았습니다.";
				$event_url		= "/service_center/joy_police/my_caution/chk_cnt/q";
				$event_btn_text = "보러가기";
				$send_user_id	= "joyhunting";
				$send_user_nick = "조이헌팅";
				$send_user_pic	= "";
				break;
			
			case "음악채팅" :
				
				//음악채팅(O)
				$contents		= $s_nick."님이 회원님과 음악채팅을 같이 하길 원합니다.";
				$event_url		= "/chatting/music_chatting";
				$event_btn_text = "확인";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

			case "메세지" :
				
				//메세지(O)
				$contents		= $s_nick."님이 회원님께 메세지를 보냈습니다.";
				$event_url		= "/profile/message/recv_message";
				$event_btn_text = "확인";
				$send_user_id	= $send_id;
				$send_user_nick = $s_nick;
				$send_user_pic	= $s_pic;
				break;

		}
		
		//알림설정이 Y일경우에만 보내기
		if(empty($rtn) || $rtn <> "N"){

			//알림 리스트에 추가	
			$data_array = array(
				'user_id'			=> $recv_id,
				'contents'			=> $contents,
				'event_url'			=> $event_url,
				'event_btn_text'	=> $event_btn_text,
				'mode'				=> $mode,
				'w_date'			=> NOW,
				'send_user_id'		=> $send_user_id,
				'send_user_nick'	=> $send_user_nick,
				'send_user_pic'		=> $send_user_pic
			);

			$last_id = $CI->my_m->insert("alrim_msg", $data_array);


			//알림 테이블에 추가
			$alrim_data = array(
				'mode'				=> 'joy',
				'send_id'			=> $send_user_id,
				'user_pic'			=> $send_user_pic,
				'recv_id'			=> $recv_id,
				'new_text'			=> $contents,
				'new_nick'			=> $send_user_nick,
				'joy_pop_url'		=> $event_url,
				'event_btn_text'	=> $event_btn_text,
				'idx'				=> $last_id
			);

			$rtn = $CI->chat_m->add_alrim($alrim_data);

		}

		
		
	}

	//받는 사람의 알림(조이헌팅 or 이메실수신) 설정 체크 함수 ($flg: 1.이메일알림, 2.조이헌팅알림)
	function member_alrim_chk($mode, $m_userid, $flg){

		$CI =& get_instance();
		$CI->load->model('my_m');

		//mode별 변수 변환 
		switch($mode){			
			case "프로포즈"		: $value = "m_propose_".$flg;		break;
			//case "데이트신청"	: $value = "m_meeting_".$flg;		break;
			case "번개팅"			: $value = "m_beongae_".$flg;		break;
			case "짝대기"			: $value = "m_jjack_".$flg;			break;
			case "찜"			: $value = "m_jjim_".$flg;			break;
			case "친구등록"		: $value = "m_reg_f1_".$flg;		break;
			case "서로친구"		: $value = "m_reg_f2_".$flg;		break;
			case "친구사진변경"		: $value = "m_f_profile_".$flg;		break;
			case "친구미팅"		: $value = "m_f_meeting_".$flg;		break;
			case "친구번개팅"		: $value = "m_f_beongae_".$flg;		break;
			case "앤"			: $value = "m_reg_anne_".$flg;		break;
			case "서로앤"			: $value = "m_to_anne_".$flg;		break;
		}

		//받는사람의 알림정보 가져오기
		$member_alarm = $CI->my_m->row_array('set_member_alarm', array('m_userid' => $m_userid));
		
		//받는 사람이 알림설정 테이블에 데이터가 입력이 안되어있을경우 insert
		if(empty($member_alarm)){
			$CI->my_m->insert('set_member_alarm', array('m_userid' => $m_userid));
			$member_alarm = $CI->my_m->row_array('set_member_alarm', array('m_userid' => $m_userid));
		}
		
		if($member_alarm[$value] != "Y"){
			//알림 설정이 Y값이 아닐경우 조이헌팅 알림, 이메일 보내지 않기
			return "N";
			exit;
		}
	}
	
	//친구가 번개팅, 프로필 사진변경, 미팅을 등록했을 경우 서로친구들에게 알림메시지 보내기
	//서로친구에게만 서로친구 수만큼 반복
	function joyhunting_alrim_repetition($mode, $m_userid){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		
		//서로친구 아이디 가져오기
		$sql = "";
		$sql .= " SELECT A.m_fuserid ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT b.* ";
		$sql .= " FROM TotalMembers a, T_MakeFriend_List b ";
		$sql .= " WHERE a.m_userid = b.m_fuserid ";
		$sql .= " AND b.m_userid = '".$m_userid."' ";
		$sql .= " ) A ";
		$sql .= " WHERE A.m_fuserid IN (SELECT m_userid FROM T_MakeFriend_List WHERE m_fuserid = '".$m_userid."' and m_gubun = '친구') ";
		$sql .= " AND A.m_gubun = '친구' ";
		$sql .= " ORDER BY A.m_idx DESC ";


		$query = $CI->db->query($sql);

		$arrData = $query->result_array();

		//친구아이디 셋팅
		$friend_list = "";

		// 친구가 있으면
		if (count($arrData) > 0){
		
			foreach($arrData as $data){
				
				if(empty($friend_list) || $friend_list == ""){
					$friend_list = $data['m_fuserid'];
				}else{
					$friend_list = $friend_list."|".$data['m_fuserid'];
				}
			}

			$f_userid = explode('|', $friend_list);
			
			//조이헌팅 알림 보내기 친구 수 만큼 반복
			for($i=0; $i<count(explode('|', $friend_list)); $i++){
				joyhunting_alrim($mode, $f_userid[$i], $m_userid);
				joyhunting_email_alrim($mode, $f_userid[$i], $m_userid);
			}
		// 친구가 없으면
		}else{
			return false;
		}

	}
	
	//조이헌팅 이메일 알림 보내기 함수
	//mode = 구분값, recv_id = 받는회원아이디, send_id = 보내는회원아이디
	function joyhunting_email_alrim($mode, $recv_id, $send_id){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->helper('code_change_helper');
		$CI->load->library('member_lib');

		//이메일 알림을 받는 회원의 정보가져오기
		$data['recv_data'] = $recv_data = $CI->member_lib->get_member($recv_id);

		//이메일 알림을 보내는 회원의 정보가져오기
		$data['send_data'] = $send_data = $CI->member_lib->get_member($send_id);
		
		//알림 분류별 변수 설정
		switch($mode){
			
			case "프로포즈" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 프로포즈가 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님으로부터 프로포즈가 도착했습니다.";
				
				break;
			
			case "번개팅" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 번개팅이 도작했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님으로부터 번개팅이 도착했습니다.";
				
				break;

			case "짝대기" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 짝/애정촌 짝대기가 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님으로부터 짝/애정촌 짝대기가 도착했습니다.";
				
				break;
			
			case "찜" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 찜이 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님이 찜하기를 하셨습니다.";
				
				break;

			case "친구등록" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 친구등록 알림이 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님이 친구등록을 하셨습니다.";
				
				break;

			case "서로친구" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 친구등록 알림이 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님과 서로친구가 되었습니다.";
				
				break;
			
			case "친구사진변경" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 친구의 프로필 사진이 변경되었습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님의 프로필 사진이 변경되었습니다.";
				
				break;

			case "친구번개팅" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 친구가 번개팅을 등록했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님이 번개팅을 등록하셨습니다.";
				
				break;

			case "앤" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 앤등록 알림이 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님이 앤으로 등록하셨습니다.";
				
				break;

			case "서로앤" :
				$rtn = member_alrim_chk($mode, $recv_id, '1');	//해당 알림 분류의 설정이 Y일경우만 알림 보내기
				$title = "조이헌팅 앤등록 알림이 도착했습니다.";
				$contents = "<b style='color:red;'>".$recv_data['m_name']."</b> 고객님,<br>".$send_data['m_nick']."님과 서로 앤으로 등록하셨습니다.";
				
				break;

		}
		
		//알림설정이 Y일때만 보내기
		if(empty($rtn) || $rtn <> "N"){

			$data['contents'] = $contents;
			
			//알림 내용 html
			$html = "";
			$html .= $CI->load->view('top0_v', @$top_data, true);	
			$html .= $CI->load->view('intro/e_mail_notice_v', @$data, true);
			$html .= $CI->load->view('bottom0_v', @$bot_data, true);

			
			//이메일보내기
			//변수: 1.받는사람의 이메일주소, 2.이메일 제목, 3.이메일 내용(html로 처리), 4.스팸성구분
			joyhunting_email($recv_data['m_mail'], $title, $html,'spam');

		}

	}

	//이메일 헬퍼
	function joyhunting_email($m_email, $title, $contents, $alrim_mode = ''){

		$CI =& get_instance();

		$config = Array(        
             'mailtype'  => 'html'
         );

		$CI->load->library('email', $config);
		
		// 발신불가메일 설정
		$result = strstr($m_email, 'apple.com');

		if($result){
			return "0"; // 발신불가메일이면 보내지않음
		}
		

		// 스팸성 메일일 경우 하루 MAX = 3통 카운트
		if($alrim_mode != ''){

			//메일 아이디와 주소 나누기
			$mail_cut = strpos($m_email, '@');

			// 메일 아이디
			$mail_id = substr($m_email, 0, $mail_cut);

			// 메일 주소
			$mail_adv = substr($m_email,$mail_cut);
			$mail_adr = str_replace('@','',$mail_adv);

			// 메일발송횟수 카운트(오늘)
			$mail_use_chk = $CI->my_m->result_array('mail_cnt', array('mail_id' => $mail_id, 'mail_adr' => $mail_adr, "ex_time" => "em_time >= '".TODAY." 00:00:00' and em_time <= '".TODAY." 24:00:00'"));
			
			// 메일발송횟수가 3번이 넘었으면 발송하지 않음
			if(count($mail_use_chk) >= 3){
				return "0";
			}else{

				// 메일발송 카운트 테이블에 추가
				$mail_data = array(
					'em_cnt'			=> count($mail_use_chk)+1,
					'mail_id'			=> $mail_id,
					'mail_adr'			=> $mail_adr,
					'mail_title'		=> $title,
					'em_time'			=> NOW
				);

				$mail_up = $CI->my_m->insert("mail_cnt", $mail_data);
			}
		}

		if(empty($m_email)){
			$m_email = "jsm1394@nate.com";
		}		

		$CI->email->from('admin@joyhunting.com', '조이헌팅');
		$CI->email->to($m_email." Content-Type:text/html");
		$CI->email->subject($title);
		$CI->email->message($contents);

		if($CI->email->send()){
			return "1";		//이메일 발송성공
		}else{
			return "0";		//이메일 발송실패
		}

	}

	//로그인박스 new알림 처리(친구)
	function new_friend_chk($user_id, $gubn){

		$CI =& get_instance();
		$CI->load->model('my_m');
		
		$set_time = "24";
		
		$strSQL = "";
		if($gubn == "친구" || $gubn == "찜"){

			$strSQL .= " SELECT m_writedate n ";
			$strSQL .= " FROM T_MakeFriend_List ";
			$strSQL .= " WHERE m_fuserid = '".$user_id."' AND m_gubun = '".$gubn."' AND DATE_ADD(m_writedate, INTERVAL ".$set_time." HOUR) >= SYSDATE() ";
			$strSQL .= " ORDER BY m_idx DESC ";
			
		}else if($gubn == "톡챗"){

			$strSQL .= " SELECT request_date n ";
			$strSQL .= " FROM chat_request ";
			$strSQL .= " WHERE recv_id = '".$user_id."' AND is_delete IS NULL AND DATE_ADD(request_date, INTERVAL ".$set_time." HOUR) >= SYSDATE() ";
			$strSQL .= " ORDER BY idx DESC ";

		}

		$strSQL .= " LIMIT 1 ";

		$query = $CI->db->query($strSQL);
		
		return $query->row_array();
	}


	//메세지 알림
	//회원이 받은 메세지 중에서 수신시간이 없는 가장 최근 메세지 호출하기
	function get_message_data(){

		$CI = & get_instance();

		$CI->load->library('session');
		$CI->load->library('member_lib');
		
		if($CI->session->userdata('m_userid')){
			//로그인 상태
			//읽지않은 최근 수신한 메세지가 있는지 체크
			$sql = "";
			$sql .= " SELECT A.* ";
			$sql .= " FROM MESSAGE_LIST A, TotalMembers B ";
			$sql .= " WHERE A.V_SEND_ID = B.m_userid ";
			$sql .= " AND A.V_RECV_ID = '".$CI->session->userdata['m_userid']."' AND A.V_READ_DATE IS NULL AND A.V_RECV_DEL IS NULL AND A.V_DEL_GUBN IS NULL ";
			$sql .= " ORDER BY A.V_IDX DESC ";
			$sql .= " LIMIT 1 ";

			$query = $CI->db->query($sql);
			$result = $query->row_array();

			if(!empty($result)){
				//데이터가 있을경우
				return $result['V_IDX']."|".$result['V_SEND_ID'];
			}else{
				//데이터가 없을경우
				return;
			}

		}else{
			//비로그인상태
			return;
		}

	}

	//GCM 알림 발송 (FCM으로 바뀜)
	function gcm_send_old($user_id, $title, $message, $reg_id = null)
	{
		//어플 등록키 존재하는지 검사
		$CI = & get_instance();
		
		//고유 아이디를 변수를 받았을경우
		if(!empty($reg_id)){
			$arr['registration_ids'][] =  $reg_id;
		}else{

			$CI->db->where('m_userid', $user_id);
			$CI->db->order_by('idx', 'DESC');
			$query = $CI->db->limit(1)->get('joytalk_id');
			$result = $query->row_array();		

			if(!empty($result)){
				//데이터가 있을경우
				$arr['registration_ids'][] =  $result['reg_id'];
			}else{
				//데이터가 없을경우
				return;
			}

		}		

		$headers = array("Content-Type:application/json","Authorization:key=AIzaSyDAZCCVIf_qLr7ff46yp2BPmQYu3jOU4pE");
		$arr['data']['title'] = $title;
		$arr['data']['message'] = $message;

		//$arr['data']['title'] = "조이헌팅";
		//$arr['data']['message'] = "조이헌팅 푸시 테스트 합니다2";
		$arr['data']['count'] = 0;
		//$arr['registration_ids'][] = "dSDzesKDLvc:APA91bFoyHVJb7uMuQBlh-K-WaTh1xUswRpfmFJ6P-S1NgqBEevmvqgTG3VYquLUU1n8PaPPkIXXBk5iOdk_xGw52WDImFp1EVALIfkbwuSD4dEe-sC2JZi1xI3IEfEC2ufnc20Q-fSA"; # 회사 테스트폰

		//$arr['data']['style'] = "picture";
		//$arr['data']['picture'] = "http://joyhunting.com/upload/thumb/ae/aera/aerang/girl_01.gif.80x56.jpg";
		//$arr['data']['summaryText'] = "테스트 사진";
		//$arr['data']['link']  = "http://hm.auton-gift.com/search/item/view/1736";
		//$arr['data']['image'] = "http://kiatest.auton.kr/dev/upload/images/product/Product_1427928945933.jpg";
		//$arr['data']['sound'] = "ping.wav";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
		curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
		curl_setopt($ch, CURLOPT_POST,    true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
		$response = curl_exec($ch);
		curl_close($ch);
	}


	//FCM 알림 발송
	function gcm_send($user_id, $title, $message, $reg_id = null)
	{
		//어플 등록키 존재하는지 검사
		$CI = & get_instance();

		//고유 아이디를 변수를 받았을경우
		if(!empty($reg_id)){
			$tokens[0] =  $reg_id;
		}else{

			$CI->db->where('m_userid', $user_id);
			$CI->db->order_by('idx', 'DESC');
			$query = $CI->db->limit(1)->get('joytalk_id');
			$result = $query->row_array();		

			if(!empty($result)){
				//데이터가 있을경우
				$tokens[0] =  $result['reg_id'];
			}else{
				//데이터가 없을경우
				return;
			}

		}		

	   $fields = array(
			'registration_ids' => $tokens,
			'notification' => array(
				"title" => $title, 
				"body" => $message,
				"click_action" => "FCM_PLUGIN_ACTIVITY",
				"sound" => "default",
				"icon" => "appicon"
				),
			'data' =>  array(
				'message' => $message
			 )
		);

		$headers = array(
			'Authorization:key=AAAAnyYXXzg:APA91bGTNWfshvnCRE93-6WD-jWALIOaTTya3uanvvLebxyIJlCH16FIRuKhtxydNtyLpYkvcAuZJDaURSZULl-la5O6KHgoai54I3aj6GpwCp6l0OcPhRrQ8nkQOPVnKrJHSOlC3MJR',
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);  
		//echo $result ;
		curl_close($ch);

	}
?>