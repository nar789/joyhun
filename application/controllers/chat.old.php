<?php

class Chat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->model('chat_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
		$this->load->helper('point_helper');

		$this->seg_exp = segment_explode($this->uri->uri_string());
	}

	function chat_request(){
		//일대일 채팅신청화면 레이어팝업 AJAX
	
		$user_id		= rawurldecode($this->input->post('user_id',TRUE));

		if(empty($user_id)){exit;}

		//로그인 여부 체크
		user_check(null, 0);

		$top_data['add_css'] = array("layer_popup/chat_request_css");
		$top_data['add_js'] = array("layer_popup/chat_request_js");
		$top_data['add_text'] = "";

		$data = $this->member_lib->get_member($user_id); //회원정보
		
		//동성채팅 체크
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error";
			exit;
		}		

		//데이터가 있을경우 두사람이 이미 채팅중이었으나 한사람만 나간경우, 데이터가 없을 경우 이미 채팅중인경우
		$chat_yn = $this->chat_m->already_chat_yn($data['m_userid'], 'already', null);
		
		if(!@empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($data['m_userid'], 'del', $chat_yn['idx']);

			if(!@empty($del_yn)){
				//한몀이라도 나간경우 

			}else{
				//이미 채팅중인경우
				echo "alreay_chat"; exit;
			}
			
		}
		
		//채팅신청을 한회원에게 계속된 채팅신청 금지
		$chat_member_ban = $this->chat_m->chat_member_ban($data['m_userid']);

		if(!@empty($chat_member_ban)){
			//허용
			$this->call_chat_continue($chat_member_ban['idx']);
			//echo "ban"; exit;
		}


		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));		//회원 보유 포인트
		
		$data['add_text'] = "";
		if($data['m_conregion']){ $data['add_text'] = $data['m_conregion'];	}
		if($data['m_conregion2']){ $data['add_text'] .= " / ".$data['m_conregion2'];	}
		if($data['m_age']){	$data['add_text'] .= " / ".$data['m_age']."세";	}
	
		$rtn = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'ex_status' => 'status not in("수락", "거절") and is_delete is null'));
		
		if(!empty($rtn)){

			if($rtn['mode'] == "profile"){
				echo $rtn['mode']; exit;				
			}else{

				$data['idx'] = $rtn['idx'];
				$data['contents'] = $rtn['contents'];
				$data['readonly'] = "readonly";
				$data['text_value'] = "수락";
				$data['v_function'] = "chat_accept";

				$data['inner_text'] = "절대비밀보장! ".$data['m_nick']."님과 즐거운 채팅되세요!";
				
				if($rtn['mode'] == "map"){
					//채팅신청 mode값이 map일경우
					$chat_request_view = "chat_request_map_v";		//map view value
				}else{
					//일반적인 채팅신청
					$chat_request_view = "chat_request_map_v";			//view value
					//$chat_request_view = "chat_request_v";			//view value
				}

				$my_map_data = getGeo($this->session->userdata['m_userid']);		//현재 접속한 회원의 아이디의 좌표가져오기(code_change_helper)
				
				if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
					//특별회원의 좌표가 없을경우
					$data['map_point'] = $user_map_data = getGeo($data['m_userid']);	//채팅신청한 회원의 아이디의 좌표가져오기(code_change_helper)
				}else{
					//특별회원의 좌표가 있을경우
					$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
				}
				
				$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)
				
				$rtn_distance = str_replace("km", "", $data['to_distance']);
				if($rtn_distance <= "10"){
					$add_title = "회원님과 10km이내 근접회원!";
				}else{
					$add_title = "채팅수락하기";
				}

				
				$top_data['add_title'] = $add_title;		

				$this->load->view('layer_popup/popup_top_v', $top_data);
				$this->load->view('layer_popup/'.$chat_request_view, $data);
				$this->load->view('layer_popup/popup_bottom_v');
			}
			

		}else{

			$my_map_data = getGeo($this->session->userdata['m_userid']);		//현재 접속한 회원의 아이디의 좌표가져오기(code_change_helper)
				
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
				//특별회원의 좌표가 없을경우
				$data['map_point'] = $user_map_data = getGeo($data['m_userid']);	//채팅신청한 회원의 아이디의 좌표가져오기(code_change_helper)
			}else{
				//특별회원의 좌표가 있을경우
				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)

			$top_data['add_title'] = "채팅신청하기";

			$data['text_value'] = "신청";
			$data['v_function'] = "chat_submit";
			$data['inner_text'] = "절대비밀보장! 용기내어 채팅신청해 주세요.";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/chat_request_map_v',$data);
			//원본 view 지도없는 레이어팝업
			//$this->load->view('layer_popup/chat_request_v',$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}	

		
	}
	

	function chat_request_pro(){
	//일대일 채팅신청 처리

		//로그인 여부 체크
		user_check(null,5,'exit');

		//채팅을 신청하는 사람이 남성일경우 채팅신청시 포인트가 부족할경우 체크
		if($this->session->userdata['m_sex'] == "M"){

			$chat_pd = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' =>'Y', 'm_gubn' => 'A'));
			if(member_point_chk($this->session->userdata['m_userid'], $chat_pd['m_point']) == "error"){
				echo "error"; exit;
			}

			//채팅을 신청하는 회원의 성별이 남성일 경우 신청시 바로 채팅포인트 차감
			member_point_insert($this->session->userdata['m_userid'], $chat_pd['m_product_code'], $chat_pd['m_goods'], $chat_pd['m_point'], null, null, NOW, null);

		}
		
		$contents		= rawurldecode($this->input->post('contents',TRUE));
		$user_id		= rawurldecode($this->input->post('user_id',TRUE));
		$v_gubn			= rawurldecode($this->input->post('v_gubn',TRUE));

		if(!empty($v_gubn)){
			$mode_gubn = $v_gubn;
		}else{
			$mode_gubn = null;
		}

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($this->session->userdata['m_userid'], $user_id);
		if($cnt > 0){ echo "bad"; exit; }
		
		//채팅신청 버튼을 여러번 클릭 또는 터치시 동일 채팅 중복체크
		$chat_chk = $this->chat_req_chk($user_id);
		if($chat_chk == "false"){
			echo "10";
			exit;
		}

		$chat_yn = $this->chat_m->already_chat_yn($user_id, 'already', null);

		if(!@empty($chat_yn)){
			
			$del_yn = $this->chat_m->already_chat_yn($user_id, 'del', $chat_yn['idx']);
			if(!@empty($del_yn)){
				//한사람만 나간경우 같은 대화상대에게 채팅신청을 했을경우
				$this->my_m->update('chat_request', array('idx' => $chat_yn['idx']), array('send_id' => $this->session->userdata['m_userid'], 'recv_id' => $user_id, 'request_date' => NOW, 'status' => '', 'alrim_del' => null, 'out_member' => null));
				$this->my_m->update('chat', array('req_idx' => $chat_yn['idx'], 'mode' => 'exit'), array('mode' => $del_yn['mode'].'2'));
				$req_idx = $chat_yn['idx'];
			}
		}else{

			//채팅 신청 추가
			$request_data = array(
				'send_id' =>$this->session->userdata('m_userid'),
				'recv_id' => $user_id,
				'request_date' => NOW,
				'accept_date' => Null,
				'contents' => $contents,
				'status' => '',
				'send_user_nick' => $this->session->userdata('m_nick'),
				'mode'		=> $mode_gubn
			);

			$req_idx = $this->chat_m->add_request_chat($request_data);

		}		

		//본문에 "채팅 내용" 추가
		$chat_data = array(
			'mode' => 'chat_request',
			'send_id' =>$this->session->userdata('m_userid'),
			'recv_id' => $user_id,
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => $contents,
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'send_user_nick' => $this->session->userdata('m_nick'),
			'req_idx'		 => $req_idx

		);

		$last_id = $this->chat_m->add_chat($chat_data);
		

		//본문에 채팅 "신청내용" 추가
		$this->chatting_add_request($req_idx);

		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->chat_m->last_chat_data_insert($req_idx);
		

		//신규 채팅신청 알림 추가
		$user_pic = $this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71);

		$alrim_data = array(
			'mode' => 'chat',
			'send_id' => $this->session->userdata('m_userid'),
			'user_pic' => rawurldecode($user_pic),
			'recv_id' => $user_id,
			'new_text' => $contents,
			'new_nick' => $this->session->userdata('m_nick'),
			'idx' => $req_idx
		);

		$rtn = $this->chat_m->add_alrim($alrim_data);
		
		//GCM 알림 처리
		gcm_send($user_id, "조이헌팅 채팅", $this->session->userdata('m_nick')."님이 채팅신청을 보냈습니다.");
		
		//여성전용 이벤트 데이터 insert(여성만 가능)
		if($this->session->userdata['m_sex'] == "F"){
			call_woman_event_data_reg('request', $this->session->userdata['m_userid'], $user_id);
		}
		

		if($rtn){echo 1;}else{echo 0;} // 1 성공  0 실패


	}


	function chatting(){
	//채팅창 열기
	
		//로그인 여부 체크
		user_check(null,5);	

		$data['recv_mem'] = $this->member_lib->get_member($this->seg_exp[2]); //회원정보

		$bot_data['add_script'] = "";

		//채팅방 상태 체크
		$chat_status = $this->chat_m->already_chat_yn($this->seg_exp[2], 'del', null);

		if(!empty($chat_status)){
			if($chat_status['status'] == "거절"){
				//거절당한 채팅방의 경우
				$bot_data['add_script'] = "<script>$(document).ready(function(){ $('.chat_result').show();$('.chat_text_area').hide();});</script>";
			}
		}
		
		
		//데이터가 있을경우 두사람이 이미 채팅중이었으나 한사람만 나간경우, 데이터가 없을 경우 이미 채팅중인경우
		$chat_yn = $this->chat_m->already_chat_yn($this->seg_exp[2], 'already', null);
						
		if(!@empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($this->seg_exp[2], 'exit', $chat_yn['idx']);

			if(!@empty($del_yn)){
				//한명이라도 나간경우 
				$bot_data['add_script'] = "<script>$(document).ready(function(){ $('.chat_result').show();$('.chat_text_area').hide();});</script>";
			}
			
		}

		if(IS_MOBILE == true){
			$top_data['add_css'] = array("chat/chat_css");
		}else{
			$top_data['add_css'] = array("chat/chat_css","chat/chat_add_css");
		}

		if(IS_MOBILE == true){
			$top_data['add_js'] = array("chat/chat_js", "m/m_chat_js");
		}else{
			$top_data['add_js'] = array("chat/chat_js");
		}
		
		$top_data['add_title'] = $data['recv_mem']['m_nick']."님 채팅 - 조이헌팅";

		$bot_data['add_script'] .= "<script>var chat_user_id = '".$this->seg_exp[2]."';</script>";

		$this->load->view('top0_v',$top_data);
		$this->load->view('/chat/chat_main_v',$data);
		$this->load->view('bottom0_v',$bot_data);

	}

	function chatting_submit(){
		//채팅 전송시
		user_check(null,0,'exit');

		//로그인 상태가 아닐시
		if(IS_LOGIN == FALSE){
			echo "not-login";
			exit;
		}

		$contents		= rawurldecode($this->input->post('contents', TRUE));
		$user_id		= rawurldecode($this->input->post('user_id', TRUE));
 
		//승인된 채팅인지 체크
		$r_row = $this->chat_m->select_request_chat($this->session->userdata('m_userid'),rawurldecode($this->input->post('user_id',TRUE)));  //상대방 채팅
		$r_row2 = $this->chat_m->select_request_chat(rawurldecode($this->input->post('user_id',TRUE)),$this->session->userdata('m_userid'));  //나의 채팅
			
		$req_idx = "";

		if(!@empty($r_row)){
			$req_idx = $r_row['idx'];
		}else{
			$req_idx = $r_row2['idx'];
		}

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($this->session->userdata['m_userid'], $user_id);
		if($cnt > 0){ echo "bad"; exit; }

		if(@$r_row['status'] == "수락" or @$r_row2['status'] == "수락"){

			$chat_exit = $this->my_m->row_array('chat', array('mode' => 'exit', 'req_idx' => $req_idx));

			if(!@empty($chat_exit)){
				echo "exit";
			}else{
				$rtn = $this->chatting_save($user_id, $contents, $req_idx);

				//GCM 알림 처리
				gcm_send($user_id, "조이헌팅 채팅", $this->session->userdata('m_nick')." : ".$contents);

				//여성전용 이벤트 데이터 insert(여성만 가능)
				if($this->session->userdata['m_sex'] == "F"){
					call_woman_event_data_reg('chat', $this->session->userdata['m_userid'], $user_id);
				}

				echo $rtn;
			}
		}else if(@$r_row['status'] == "거절"){
			echo "deny";
		}else{
			echo "not-ready";
		}

	}

	function chatting_save($user_id, $contents, $req_idx){
		//채팅 저장
	
		user_check(null,5,'exit');

		//채팅 내용추가
		$chat_data = array(
			'mode' => 'chat',
			'send_id' =>$this->session->userdata('m_userid'),
			'recv_id' => $user_id,
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => $contents,
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'send_user_nick' => $this->session->userdata('m_nick'),
			'req_idx'		 => $req_idx
		);
		$last_id = $this->chat_m->add_chat($chat_data);
		
		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->chat_m->last_chat_data_insert($req_idx);
		

		//메시지 도착 알림내역 추가
		$user_pic = $this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71);

		$alrim_data = array(
			'mode' => 'msg',
			'send_id' => $this->session->userdata('m_userid'),
			'user_pic' => rawurldecode($user_pic),
			'recv_id' => $user_id,
			'new_text' => $contents,
			'new_nick' => $this->session->userdata('m_nick'),
			'idx' => $last_id
		);
		$rtn = $this->chat_m->add_alrim($alrim_data);


		return $last_id;
	}

	//본문에 채팅 신청내용 추가
	function chatting_add_request($req_idx){

		//로그인 여부 체크
		user_check(null,5,'exit');	

		//본문에 채팅 신청내용추가
		$chat_data = array(
			'mode' => 'request',
			'send_id' =>rawurldecode($this->input->post('user_id',TRUE)),
			'recv_id' => $this->session->userdata('m_userid'),
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => "채팅신청을 보냈습니다.",
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'req_idx'		 => $req_idx
		);
		$last_id = $this->chat_m->add_chat($chat_data);

		//본문에 채팅 신청내용추가 (상대방것도)
		$chat_data = array(
			'mode' => 'request',
			'send_id' =>$this->session->userdata('m_userid'),
			'recv_id' => rawurldecode($this->input->post('user_id',TRUE)),
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => $this->session->userdata('m_nick')." 님이 채팅신청을 보냈습니다",
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'req_idx'		 => $req_idx
		);
		$last_id = $this->chat_m->add_chat($chat_data);
		
		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->chat_m->last_chat_data_insert($req_idx);
		
	}

	function chat_accept(){
	//채팅수락

		if(IS_MOBILE == true){
			$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		}else{
			$user_id = rawurldecode($this->input->post('user_id', true));
		}

		//채팅수락 DB처리 (AJAX)

		//채팅 수락시 포인트 차감부분
		if($this->session->userdata['m_sex'] == "M"){
			//세션아이디의 성별이 남성일경우
			$m_userid = $this->session->userdata['m_userid'];
		}else{
			//세션아이디의 성별이 여성일경우
			$m_userid = $user_id;
		}

		//채팅 상품 가져오기(채팅포인트 차감 코드 : 9999)
		$chat_product = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' => 'Y', 'm_gubn' => 'A'));

		if(IS_MOBILE == true){
			//모바일버전의 경우
			//모바일 로그인 여부 체크
			user_check(null,5,'exit');
			
			//보유포인트 체크
			$mpc = member_point_chk($m_userid, $chat_product['m_point']);

			if($mpc == "success" or $this->session->userdata['m_sex'] == "F"){
				//보유포인트 충분
				//포인트차감
				if($this->session->userdata['m_sex'] == "M"){
					//남자만 채팅수락시 포인트 차감
					$rtn = member_point_insert($m_userid, $chat_product['m_product_code'], $chat_product['m_goods'], $chat_product['m_point'], null, null, NOW, null);
				}else{
					$rtn = "1";
				}				

				if($rtn == "1"){
					
					$data= array('status' => '수락');
					$this->chat_m->mod_chat_request($data, $user_id);

					//신규알림 갯수 줄이기 
					$this->chat_m->mod_alrim_new($data, $user_id);
		
					//채팅수락 idx 가져오기
					$chat_req = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'status' => '수락', 'ex_is_delete' => 'is_delete is null'));
					
					//채팅 수락 메시지 남기기
					$chat_data = array(
						'mode' => 'accept',
						'send_id' => $user_id,
						'recv_id' => $this->session->userdata('m_userid'),
						'reg_date' => NOW,
						'read_date' => Null,
						'contents' => '채팅신청을 수락하였습니다.',
						'send_ip' => $_SERVER['REMOTE_ADDR'],
						'is_delete_send' => '0',
						'is_delete_recv' => '0',
						'req_idx'		 => $chat_req['idx']
					);
					$this->chat_m->add_chat($chat_data);

					//채팅 수락 메시지 남기기 (상대방)
					$chat_data = array(
						'mode' => 'accept',
						'send_id' =>$this->session->userdata('m_userid'),
						'recv_id' => $user_id,
						'reg_date' => NOW,
						'read_date' => Null,
						'contents' => $this->session->userdata('m_nick')." 님이 채팅신청을 수락하였습니다.",
						'send_ip' => $_SERVER['REMOTE_ADDR'],
						'is_delete_send' => '0',
						'is_delete_recv' => '0',
						'req_idx'		 => $chat_req['idx']
					);
					$this->chat_m->add_chat($chat_data);

					//마지막 채팅 순번, 채팅내용, 날짜 넣기
					$this->chat_m->last_chat_data_insert($chat_req['idx']);
					
					echo "1";		//포인트 차감성공(채팅시작)

				}else{
					echo "2";		//포인트 차감실패(채팅보류)
				}

			}else if($mpc == "error"){
				//보유포인트 부족
				if($this->session->userdata['m_sex'] == "F"){
					echo "10";
				}else{
					echo "0";
				}	
			}else{
				echo "9";		//잘못된 접근
				exit;
			}


		}else{
			//PC버전의 경우
			//로그인 여부 체크
			user_check(null,5,'exit');	
			
			//보유포인트 체크
			$mpc = member_point_chk($m_userid, $chat_product['m_point']);

			if($mpc == "success" or $this->session->userdata['m_sex'] == "F"){
				//보유포인트 충분
				//포인트차감
				if($this->session->userdata['m_sex'] == "M"){
					//남자만 채팅수락시 포인트 차감
					$rtn = member_point_insert($m_userid, $chat_product['m_product_code'], $chat_product['m_goods'], $chat_product['m_point'], null, null, NOW, null);
				}else{
					$rtn = "1";
				}				

				if($rtn == "1"){

					$data= array('status' => '수락');
					$this->chat_m->mod_chat_request($data,$user_id);

					//신규알림 갯수 줄이기 
					$this->chat_m->mod_alrim_new($data,$user_id);

					//채팅수락 idx 가져오기
					$chat_req = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'status' => '수락'));

					//채팅 수락 메시지 남기기
					$chat_data = array(
						'mode' => 'accept',
						'send_id' => $user_id,
						'recv_id' => $this->session->userdata('m_userid'),
						'reg_date' => NOW,
						'read_date' => Null,
						'contents' => '채팅신청을 수락하였습니다.',
						'send_ip' => $_SERVER['REMOTE_ADDR'],
						'is_delete_send' => '0',
						'is_delete_recv' => '0',
						'req_idx'		 => $chat_req['idx']
					);
					$this->chat_m->add_chat($chat_data);
					
					//채팅 수락 메시지 남기기 (상대방)
					$chat_data = array(
						'mode' => 'accept',
						'send_id' =>$this->session->userdata('m_userid'),
						'recv_id' => $user_id,
						'reg_date' => NOW,
						'read_date' => Null,
						'contents' => $this->session->userdata('m_nick')." 님이 채팅신청을 수락하였습니다.",
						'send_ip' => $_SERVER['REMOTE_ADDR'],
						'is_delete_send' => '0',
						'is_delete_recv' => '0',
						'req_idx'		 => $chat_req['idx']
					);
					$this->chat_m->add_chat($chat_data);

					//마지막 채팅 순번, 채팅내용, 날짜 넣기
					$this->chat_m->last_chat_data_insert($chat_req['idx']);
					
					echo "1";		//포인트 차감성공(채팅시작)
				}else{
					echo "2";		//포인트 차감실패(채팅보류)
				}
				
			}else if($mpc == "error"){
				//보유포인트 부족
				if($this->session->userdata['m_sex'] == "F"){
					echo "10";
				}else{
					echo "0";
				}			
			}else{
				//잘못된 접근
				echo "9";
			}

		}

	}

	//채팅 거절
	function chat_deny(){
		//로그인 여부 체크
		user_check(null,0,'exit');	

		//채팅거절 DB처리 (AJAX)
		$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$deny_msg = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'deny_msg')));

		if(empty($user_id)){exit;}

		$data= array('status' => '거절', 'deny_id' => $this->session->userdata['m_userid']);
		$this->chat_m->mod_chat_request($data,$user_id);

		$data= array(
			'chat_new_text' => '', 
			'chat_new_nick' => '', 
			'chat_new_pic' => '', 
			'chat_new_userid' => '',
			'chat_pop_idx' => Null
		);
		//신규알림 갯수 줄이기 
		$this->chat_m->mod_alrim_new($data, $user_id);

		//채팅거절 idx 가져오기
		$chat_req = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'status' => '거절'));

		//채팅 거절 메시지 남기기
		$chat_data = array(
			'mode' => 'deny',
			'send_id' => $user_id,
			'recv_id' => $this->session->userdata('m_userid'),
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => '채팅신청을 거절하였습니다.',
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'req_idx'		 => $chat_req['idx']
		);
		$this->chat_m->add_chat($chat_data);

		//채팅 거절 메시지 남기기 (상대방)
		$chat_data = array(
			'mode' => 'deny',
			'send_id' =>$this->session->userdata('m_userid'),
			'recv_id' => $user_id,
			'reg_date' => NOW,
			'read_date' => Null,
			'contents' => $this->session->userdata('m_nick')." 님이 채팅신청을 거절하였습니다.",
			'send_ip' => $_SERVER['REMOTE_ADDR'],
			'is_delete_send' => '0',
			'is_delete_recv' => '0',
			'req_idx'		 => $chat_req['idx']
		);
		$this->chat_m->add_chat($chat_data);

		if(!empty($deny_msg)){
			//거절 사유가 있을때
			$deny_msg = chat_deny_msg($deny_msg);
			$this->chatting_save($user_id, $deny_msg);
		}

		//거절시 신청자의 채팅 모두 읽음처리
		$this->chat_m->deny_last_chat_update($chat_req['idx']);

		//마지막 채팅 순번, 채팅내용, 날짜 넣기
		$this->chat_m->last_chat_data_insert($chat_req['idx']);
				
		//채팅 거절시 채팅방 삭제처리 및 채팅내역 삭제처리, (남은사람은 보여야해서 취소)
		//$this->my_m->update('chat_request', array('idx' => $chat_req['idx']), array('is_delete' => 'D'));
		//$this->my_m->update('chat', array('req_idx' => $chat_req['idx']), array('is_delete_gubn' => 'D'));

		user_alrim_cnt($this->session->userdata('m_userid')); //채팅알림 카운트해서 재정의

	}

	function chat_list_del(){
		user_check(null,0,'exit');	

		//채팅신청 리스트에서 삭제
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->chat_list_delete($idx);

	}

	function chat_list_del_all(){
		user_check(null,0,'exit');	

		//채팅신청 리스트에서 전체 삭제

		$this->chat_m->chat_list_delete_all();	
	}

	function msg_list_del(){
		user_check(null,0,'exit');	

		//메시지 리스트에서 삭제
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->msg_list_delete($idx);

	}

	function msg_list_del_all(){
		user_check(null,0,'exit');	

		//메시지 리스트에서 전체 삭제

		$this->chat_m->msg_list_delete_all();	
	}

	function joy_list_del(){
		user_check(null,0,'exit');	

		//조이헌팅 리스트에서 삭제
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->joy_list_delete($idx);

	}

	function joy_list_del_all(){
		user_check(null,0,'exit');	

		//조이헌팅 리스트에서 전체 삭제

		$this->chat_m->joy_list_delete_all();	
	}


	function chat_request_mobile(){
		//모바일 일대일 채팅신청화면 레이어팝업 AJAX
		
		//로그인 여부 체크
		user_check(null,5);
		
		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$gubn		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gubn')));

		$data = $this->member_lib->get_member($user_id); //회원정보

		//성별이 같을 경우 채팅불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}
		
		//현재 채팅중인 회원에세 채팅신청을 할경우 채팅창으로 넘기기(현재 채팅이 진행중인 회원에게는 채팅신청불가)
		$chat_yn = $this->chat_m->already_chat_yn($user_id, 'already', null);
		
		if(!empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($user_id, 'del', $chat_yn['idx']);

			if(!empty($del_yn['out_member'])){
				//한몀이라도 나간경우 

			}else{
				//이미 채팅중인경우
				echo "alreay_chat"; exit;
			}
			
		}

		//채팅신청을 한회원에게 계속된 채팅신청 처리
		$chat_member_ban = $this->chat_m->chat_member_ban($user_id);

		if(!empty($chat_member_ban)){
			//계속된 채팅 신청 허용
			$this->call_chat_continue($chat_member_ban['idx']);
			//echo "ban"; exit;
		}
		

		//채팅을 신청할경우 채팅신청이 들어와있는지 혹은 채팅중인 사람인지 체크하기
//		$chat_status = $this->chat_m->chat_status_gubn($user_id);
//
//		if(!@empty($chat_status)){
//			if($chat_status['send_id'] != $this->session->userdata['m_userid']){
//				if($this->session->userdata['m_sex'] == "F"){
//					echo $chat_status['status']; exit;
//				}				
//			}
//		}

		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));		//회원 보유 포인트
		
		$data['add_text'] = "";
		if($data['m_conregion']){ $data['add_text'] = $data['m_conregion'];	}
		if($data['m_conregion2']){ $data['add_text'] .= " / ".$data['m_conregion2'];	}
		if($data['m_age']){	$data['add_text'] .= " / ".$data['m_age']."세";	}


		$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "비밀채팅신청";
		$top_data['add_text'] = "";
		
		$this->load->view('layer_popup/popup_top_v',$top_data);

//		일반채팅 돌릴경우 주석풀면됨
//		if($gubn == "map"){
			//5분거리에서 채팅신청 했을경우
			$data['user_img_src'] = img_src_ex($this->member_lib->member_thumb($user_id));

			$my_map_data = getGeo($this->session->userdata['m_userid']);			//현재 접속한 회원의 아이디의 좌표가져오기(code_change_helper)
				
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
				//특별회원의 좌표가 없을경우
				$data['map_point'] = $user_map_data = getGeo($user_id);				//채팅신청한 회원의 아이디의 좌표가져오기(code_change_helper)
			}else{
				//특별회원의 좌표가 있을경우
				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)

			$this->load->view('layer_popup/m_send_chat_request_map_v',@$data);
//		}else{
//			//일반 채팅신청의 경우
//			$this->load->view('layer_popup/m_send_chat_request_v',@$data);
//		}

		$this->load->view('layer_popup/popup_bottom_v');

	}

	function m_recv_chat_request(){
		//모바일 채팅신청 받았을때 레이어팝업

		//모바일 로그인 여부 체크
		user_check(null,0);
	
		$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$chat_pop_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chat_pop_idx')));
		
		$data = $this->member_lib->get_member($user_id); //회원정보

		$data['chat'] = $this->my_m->row_array('chat_request', array("idx" => $chat_pop_idx, "ex_send_id" => "send_id <> '".$this->session->userdata['m_userid']."' "));	//채팅 신청 내용 읽어오기

		if(empty($data['chat'])){
			echo "already_chat"; exit;
		}

		//회원의 총포인트 가져오기
		$tp = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));
		
		if(empty($tp)){
			$data['total_point'] = "0";
		}else{
			$data['total_point'] = $tp['total_point'];
		}

		//채팅상품 금액가져오기 
		$data['chat_pd'] = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' => 'Y', 'm_gubn' => 'A'));

		if($data['chat']['mode'] == "profile"){

			echo $data['chat']['mode'];
			exit;
	
		}else{

			if($data['chat']['mode'] == "map"){
				//mode값이 map일경우
				$recv_chat_request_view = "m_recv_chat_request_map_v";
			}else{
				//일반채팅의 경우
				$recv_chat_request_view = "m_recv_chat_request_map_v";
				//$recv_chat_request_view = "m_recv_chat_request_v";
			}

			//10km이내 근접회원 표시하기 (일반채팅신청에도 똑같이 거리도 출력)
			$my_map_data = getGeo($this->session->userdata['m_userid']);	//현재 접속한 회원의 아이디의 좌표가져오기(code_change_helper)
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
				//특별회원의 좌표가 없을경우
				$data['map_point'] = $user_map_data = getGeo($data['m_userid']);	//채팅신청한 회원의 아이디의 좌표가져오기(code_change_helper)
			}else{
				//특별회원의 좌표가 있을경우
				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)

			$rtn_distance = str_replace("km", "", $data['to_distance']);

			if($rtn_distance <= "10"){
				$add_title = "회원님과 10km이내 근접회원!";
			}else{
				$add_title = "비밀채팅수락";
			}


			//일반 채팅
			$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
			$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
			$top_data['add_title'] = $add_title;
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/'.$recv_chat_request_view, @$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}

	}

	//모바일 채팅 수락 팝업에서 데이터 처리 ajax
	function m_recv_chat_ajax(){
		
		user_check(null,0,'exit');	

		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$idx		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));
		
		//채팅상품 포인트가져오기
		$chat_pd = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' => 'Y', 'm_gubn' => 'A'));
		//채팅을 수락하는 회원이 남성일 경우 포인트검사
		if($this->session->userdata['m_sex'] == "M"){
			$m_userid = $this->session->userdata['m_userid'];
		}else{
			$m_userid = $user_id;
		}

		//잔여 포인트가 채팅포인트보다 많은지 체크
		$rtn2 = member_point_chk($m_userid, $chat_pd['m_point']);
		
		if($rtn2 == "error"){
			echo "error"; exit;			//차감포인트가 적을경우
		}

	}

	//남성이 채팅수락을 하는경우일경우 체크
	function chat_accept_flg(){
		echo $this->session->userdata['m_sex'];
	}

	//채팅신청 버튼을 여러번 클릭 또는 터치시 동일 채팅 중복체크
	function chat_req_chk($user_id){

		user_check(null,0,'exit');

		if(empty($user_id)){
			return "false";			//채팅신청을 받는 회원의 아이디가 없는경우 에러처리
			exit;
		}

		$arrData = array(
			"send_id"			=> $this->session->userdata['m_userid'],
			"recv_id"			=> $user_id,
			"ex_status"			=> "status not in('수락', '거절', '나감')",
			"ex_is_delete"		=> "is_delete is null"
		);

		$chk = $this->my_m->row_array('chat_request', $arrData);
		
		if(!@empty($chk)){
			return "false";			//이미 동일회원에게 채팅을 신청한 이력이 있는경우
		}else{
			return "true";			//채팅신청을 하지 않을경우
		}
	}

	//채팅방 나가기 함수(PC, 모바일 공통)
	function chat_exit(){
		
		user_check(null,0,'exit');

		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		
		if(empty($user_id)){exit;}
		
		//채팅방 idx 가져오기
		$chat_req = $this->chat_m->chat_request_idx($user_id);

		//해당 채팅방의 idx값을 못가져올 경우 예외처리
		if(empty($chat_req)){

			if(IS_MOBILE == true){
				alert_goto('잘못된 접근입니다.', '/');
				exit;
			}else{
				alert_close('잘못된접근입니다.');
				exit;
			}

		}		

		$exit_chk = $this->my_m->row_array('chat', array('mode' => 'exit', 'req_idx' => $chat_req['idx']), 'idx', 'desc', '1');

		if(!@empty($exit_chk)){
			
			//채팅방을 나갔는데 채팅방이 유지될경우(에러처리)
			if($exit_chk['is_delete_send'] == $this->session->userdata['m_userid']){
				//채팅방을 먼저 나간사람과 본인의 세션 아이디가 같을경우 에러
				echo "10";
				exit;
			}

			//대화상대가 먼저 채팅방을 나갔을경우
			$data = array(
				"mode"		=> 'exit',
				"req_idx"	=> $chat_req['idx']
			);

			$rtn = $this->my_m->update('chat', $data, array('is_delete_recv' => $this->session->userdata['m_userid']));

			if($rtn == "1"){
				//대화상대 모두 채팅방을 나갔을경우 채팅방과 채팅내역 삭제처리 (여러 req 모두 처리)
				$this->my_m->update('chat', array('send_id' =>$chat_req['send_id'], 'recv_id' => $chat_req['recv_id']), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat', array('recv_id' =>$chat_req['send_id'], 'send_id' => $chat_req['recv_id']), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat_request', array('send_id' =>$chat_req['send_id'], 'recv_id' => $chat_req['recv_id']), array('is_delete' => 'D'));
				$this->my_m->update('chat_request', array('recv_id' =>$chat_req['send_id'], 'send_id' => $chat_req['recv_id']), array('is_delete' => 'D'));
			}

		}else{
			if( $this->session->userdata['m_userid'] == $chat_req['send_id'] and $chat_req['status'] == '' ){
				//상대방이 수락을 하지 않았는데, 신청자가 먼저 나갔을 경우. 실수방지.
				echo "1";exit;
			}

			//먼저 채팅방을 나갈경우
			//채팅방 나가기 데이터 insert
			$data = array(
				"mode"					=> 'exit',
				"send_id"				=> $this->session->userdata['m_userid'],
				"recv_id"				=> $user_id,
				"reg_date"				=> NOW,
				"contents"				=> $this->session->userdata['m_nick']."님이 채팅방을 나가셨습니다.",
				"send_ip"				=> $_SERVER['REMOTE_ADDR'],
				"is_delete_send"		=> $this->session->userdata['m_userid'],
				"send_user_nick"		=> $this->session->userdata['m_nick'],	
				"req_idx"				=> $chat_req['idx']
			);

			$rtn = $this->my_m->insert('chat', $data);
			
			//아직 수락하지 않은 채팅방을 먼저 나갈경우
			if($chat_req['status'] == ''){
				$this->my_m->update('alrim_new', array('user_id' => $user_id), array('ex_chat_new_cnt' => 'chat_new_cnt = chat_new_cnt-1'));
				$this->my_m->update('chat', array('req_idx' => $chat_req['idx']), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat_request', array('idx' => $chat_req['idx']), array('is_delete' => 'D'));
			}

		}	

		$this->my_m->update('chat_request', array('idx' => $chat_req['idx'], 'status' => '수락', 'recv_id' => $this->session->userdata['m_userid']), array('alrim_del' => 'D'));
		$this->my_m->update('alrim_new', array('user_id' => $this->session->userdata['m_userid']), array('chat_new_cnt' => 'chat_new_cnt-1'));
		
		if($rtn == "1"){
			echo "1";			//채팅방 나가기 성공
		}else{
			echo "0";			//데이터 오류
		}

	}



	//채팅 신청 계속 허용 처리
	function call_chat_continue($idx){
		
		if(empty($idx)){exit;}

		//기존 신청 채팅방 삭제처리
		$this->my_m->update('chat_request', array('idx' => $idx), array('is_delete' => 'D', 'alrim_del' => 'D'));

		//기존 신청 채팅 내용 삭제처리
		$this->my_m->update('chat', array('req_idx' => $idx), array('is_delete_gubn' => 'D'));
	}
	

	

	//프로필 이미지 쪽지 레이어팝업 호출
	function profile_image_layer(){

		$data['idx']	 = $idx		= $this->input->post('idx', true);			//채팅방번호
		$data['send_id'] = $send_id = $this->input->post('user_id', true);		//보낸사람 아이디

		$recv_id = $this->session->userdata['m_userid'];	//받는사람 아이디

		if(empty($send_id) or empty($recv_id)){ echo "1000"; exit; }		//잘못된 접근
		
		$search = array(
			"idx"		=> $idx,
			"send_id"	=> $send_id,
			"recv_id"	=> $recv_id,
			"mode"		=> "profile",
			"ex_data"	=> "status = '' and is_delete is null"
		);

		$data['request_data'] = $request_data = $this->my_m->row_array('chat_request', $search, 'idx', 'desc', '1');

		if(empty($request_data)){ echo "1000"; exit; }		//잘못된 접근

		//보낸 회원 정보 가져오기
		$data['send_data'] = $this->member_lib->get_member($send_id);

		//받는 회원 포인트 가져오기
		$data['mtp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $recv_id));
		if(!$data['mtp']){
			$data['mtp'] = 0;
		}
		
		$top_data['add_css'] = array("layer_popup/chat_lay_pop_01_css");
		$top_data['add_js'] = array("layer_popup/chat_lay_pop_01_js");
		$top_data['add_title'] = $request_data['send_user_nick'];
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top2_v', $top_data);
		$this->load->view('layer_popup/profile_chat_layer_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	
	//채팅방 나가기 처리
	function renew_chat_exit(){

		user_check(null,0,'exit');

		$user_id	= rawurldecode($this->input->post('user_id', true));	//상대방 아이디		
		if(empty($user_id)){ echo "1000"; exit; }							//상대방아이디가 없을 경우
		
		$my_id		= $this->session->userdata['m_userid'];
		$idx		= "";
		$status		= "";
		$out_member = "";
		$result		= "";		//결과값

		//채팅방 내역 가져오기
		$request_data = $this->chat_m->chat_request_idx($user_id);
		if(empty($request_data)){ echo ""; exit; }		//채팅방이 없을 경우

		$idx		= $request_data['idx'];				//채팅방 번호
		$status		= $request_data['status'];			//채팅방 상태
		$out_member	= $request_data['out_member'];		//채팅방을 먼저 나간회원
		
		if($status == "" or $status == "대기"){ echo "ready"; exit;}	//채팅수락전 나가기 막기

		if(empty($out_member)){
			//아직 아무도 채팅방을 나가지 않은 경우
			$result = $this->chat_m->last_chat_exit_check($idx, $my_id, $user_id);
		}else{
			//누군가 한명이 먼저 채팅방을 나간 경우
			if($out_member <> $my_id){
				//먼저 나간 회원과 나의 아이디가 다를 경우
				//채팅방, 채팅내역 삭제
				$this->my_m->update('chat_request', array('idx' => $idx), array('is_delete' => 'D'));
				$this->my_m->update('chat', array('req_idx' => $idx), array('is_delete_gubn' => 'D'));
			}

			$result = "2";
		}

		echo $result;
		exit;

	}
	


}

/* End of file main.php */
/* Location: ./application/controllers/ */