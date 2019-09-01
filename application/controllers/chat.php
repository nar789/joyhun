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


		$user_id		= rawurldecode($this->input->post('user_id',TRUE));

		if(empty($user_id)){exit;}


		user_check(null, 0);

		$top_data['add_css'] = array("layer_popup/chat_request_css");
		$top_data['add_js'] = array("layer_popup/chat_request_js");
		$top_data['add_text'] = "";

		$data = $this->member_lib->get_member($user_id); //회원정보
		

		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error";
			exit;
		}		


		$chat_yn = $this->chat_m->already_chat_yn($data['m_userid'], 'already', null);
		
		if(!@empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($data['m_userid'], 'del', $chat_yn['idx']);

			if(!@empty($del_yn['out_member'])){


			}else{

				echo "alreay_chat"; exit;
			}
			
		}


		$chat_member_ban = $this->chat_m->chat_member_ban($data['m_userid']);
		if(!empty($chat_member_ban)){
	
		}

		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));		
		
		$data['add_text'] = "";
		if($data['m_conregion']){ $data['add_text'] = $data['m_conregion'];	}
		if($data['m_conregion2']){ $data['add_text'] .= " / ".$data['m_conregion2'];	}
		if($data['m_age']){	$data['add_text'] .= " / ".$data['m_age']."세";	}
	
		$rtn = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'ex_status' => 'status not in("수락", "거절") and is_delete is null'));
		
		$data['greeting'] = "0";

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

					$chat_request_view = "chat_request_map_v";		//map view value
				}else{
		
					$chat_request_view = "chat_request_map_v";			//view value
					//$chat_request_view = "chat_request_v";			//view value
				}
				
				
				if(strpos($data['contents'], "(인사말)") !== false){
					$data['greeting'] = "1";
				}

				$my_map_data = getGeo($this->session->userdata['m_userid']);		
				
				if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
	
					$data['map_point'] = $user_map_data = getGeo($data['m_userid']);
				}else{
				
					$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
				}
				
				$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		
				
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

			$my_map_data = getGeo($this->session->userdata['m_userid']);		
				
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
				
				$data['map_point'] = $user_map_data = getGeo($data['m_userid']);
			}else{
				
				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		

			$top_data['add_title'] = "채팅신청하기";

			$data['text_value'] = "신청";
			$data['v_function'] = "chat_submit";
			$data['inner_text'] = "절대비밀보장! 용기내어 채팅신청해 주세요.";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/chat_request_map_v',$data);
			
			//$this->load->view('layer_popup/chat_request_v',$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}	

		
	}
	

	function chat_request_pro(){
	

		
		user_check(null,5,'exit');		
		
		$contents		= rawurldecode($this->input->post('contents',TRUE));
		$user_id		= rawurldecode($this->input->post('user_id',TRUE));
		$v_gubn			= rawurldecode($this->input->post('v_gubn',TRUE));

		if(!empty($v_gubn)){
			$mode_gubn = $v_gubn;
		}else{
			$mode_gubn = null;
		}

		
		$cnt = call_bad_friend_chk($this->session->userdata['m_userid'], $user_id);
		if($cnt > 0){ echo "bad"; exit; }
		
		
		$chat_chk = $this->chat_req_chk($user_id);
		if($chat_chk == "false"){
			echo "10";
			exit;
		}

		$chat_yn = $this->chat_m->already_chat_yn($user_id, 'already', null);

		if(!@empty($chat_yn)){
			
			$del_yn = $this->chat_m->already_chat_yn($user_id, 'del', $chat_yn['idx']);
			if(!@empty($del_yn)){
				
				$this->my_m->update('chat_request', array('idx' => $chat_yn['idx']), array('send_id' => $this->session->userdata['m_userid'], 'recv_id' => $user_id, 'request_date' => NOW, 'status' => '', 'alrim_del' => null, 'out_member' => null));
				$this->my_m->update('chat', array('req_idx' => $chat_yn['idx'], 'mode' => 'exit'), array('mode' => $del_yn['mode'].'2'));
				$req_idx = $chat_yn['idx'];
			}

		}else{
			
			
			$deny_yn = $this->chat_m->already_chat_yn($user_id, 'deny', null);
			if(!empty($deny_yn)){
				$this->my_m->update('chat_request', array('idx' => $deny_yn['idx']), array('status' => '', 'deny_id' => ''));
				$req_idx = $deny_yn['idx'];
			}else{

				
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

		}	
		
		
		if($this->session->userdata['m_sex'] == "M"){

			$chat_pd = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' =>'Y', 'm_gubn' => 'A'));
			if(member_point_chk($this->session->userdata['m_userid'], $chat_pd['m_point']) == "error"){
				echo "error"; exit;
			}

			
			member_point_insert($this->session->userdata['m_userid'], $chat_pd['m_product_code'], $chat_pd['m_goods'], $chat_pd['m_point'], null, null, NOW, null);
		
		}

		
		if($this->session->userdata['m_sex'] == "M"){
			$this->my_m->update('chat_request', array('idx' => $req_idx), array('refund' => '환불대상' ));
		}

		
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
		

		
		$this->chatting_add_request($req_idx);

		
		$this->chat_m->last_chat_data_insert($req_idx);
		

		
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
		
		
		gcm_send($user_id, "조이헌팅 채팅", $this->session->userdata('m_nick')."님이 채팅신청을 보냈습니다.");

		
		if($this->session->userdata['m_sex'] == "F"){
			call_woman_event_data_reg('request', $this->session->userdata['m_userid'], $user_id);
		}
		

		if($rtn){echo 1;}else{echo 0;} // 1 성공  0 실패


	}


	function chatting(){
	
	
		
		user_check(null,5);	

		$data['recv_mem'] = $this->member_lib->get_member($this->seg_exp[2]); //회원정보

		$bot_data['add_script'] = "";

		
		$chat_status = $this->chat_m->already_chat_yn($this->seg_exp[2], 'del', null);

		if(!empty($chat_status)){
			if($chat_status['status'] == "거절"){
				
				$bot_data['add_script'] = "<script>$(document).ready(function(){ $('.chat_result').show();$('.chat_text_area').hide();});</script>";
			}
		}
		
		
		
		$chat_yn = $this->chat_m->already_chat_yn($this->seg_exp[2], 'already', null);
						
		if(!@empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($this->seg_exp[2], 'exit', $chat_yn['idx']);

			if(!@empty($del_yn)){
			
				$bot_data['add_script'] = "<script>$(document).ready(function(){ $('.chat_result').show();$('.chat_text_area').hide();});</script>";
			}
			
		}

	
		$this->chat_m->chat_read_cnt_up($this->session->userdata['m_userid'], $this->seg_exp[2]);

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
	
		user_check(null,0,'exit');

	
		if(IS_LOGIN == FALSE){
			echo "not-login";
			exit;
		}

		$contents		= rawurldecode($this->input->post('contents', TRUE));
		$user_id		= rawurldecode($this->input->post('user_id', TRUE));
 
		
		$r_row = $this->chat_m->select_request_chat($this->session->userdata('m_userid'),rawurldecode($this->input->post('user_id',TRUE)));  //상대방 채팅
		$r_row2 = $this->chat_m->select_request_chat(rawurldecode($this->input->post('user_id',TRUE)),$this->session->userdata('m_userid'));  //나의 채팅
			
		$req_idx = "";

		if(!@empty($r_row)){
			$req_idx = $r_row['idx'];
		}else{
			$req_idx = $r_row2['idx'];
		}

		
		$cnt = call_bad_friend_chk($this->session->userdata['m_userid'], $user_id);
		if($cnt > 0){ echo "bad"; exit; }

		if(@$r_row['status'] == "수락" or @$r_row2['status'] == "수락"){

			$chat_exit = $this->my_m->row_array('chat', array('mode' => 'exit', 'req_idx' => $req_idx));

			if(!@empty($chat_exit)){
				echo "exit";
			}else{
				$rtn = $this->chatting_save($user_id, $contents, $req_idx);

				
				gcm_send($user_id, "조이헌팅 채팅", $this->session->userdata('m_nick')." : ".$contents);

				
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

	function chatting_save($user_id, $contents, $req_idx,$mode = ""){
		
	
		user_check(null,5,'exit');

	
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
		

		$this->chat_m->last_chat_data_insert($req_idx);
		

	
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

		
		if($this->session->userdata('m_sex') == "F" and $mode != "deny"){
			$this->my_m->update('chat_request', array('idx' => $req_idx), array('refund' => ''));
		}

		return $last_id;
	}

	
	function chatting_add_request($req_idx){

	
		user_check(null,5,'exit');	

		
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
		
		
		$this->chat_m->last_chat_data_insert($req_idx);
		
	}
	

	function chat_accept(){
	
		user_check(null,5,'exit');
		
		$user_id = "";
		if(IS_MOBILE == true){
			$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		//상대방 아이디
		}else{
			$user_id = rawurldecode($this->input->post('user_id', true));										//상대방 아이디
		}
		
		if(empty($user_id)){ echo "9"; exit; }
		
		
		$point_chk = "";
		if($this->session->userdata['m_sex'] == "M"){
			$m_userid = $this->session->userdata['m_userid'];
			$point_chk = "차감";
		}else{
			$m_userid = $user_id;
			$point_chk = "";
		}	
		
		
		$chat_product = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' => 'Y'), 'm_idx', 'desc', '1');
		
		$chat_code	= $chat_product['m_product_code'];		//상품코드
		$chat_goods = $chat_product['m_goods'];				//상품명
		$chat_point = $chat_product['m_point'];				//포인트
		
	
		$mpc = member_point_chk($m_userid, $chat_point);
		
		
		if($this->session->userdata['m_sex'] == "F" and $mpc == "error"){
			$mpc = "success";
		}

		if($mpc == "success"){
			

			$send_id = $user_id;									
			$recv_id = $this->session->userdata['m_userid'];		

			
			$this->my_m->update('chat_request', array('send_id' => $send_id, 'recv_id' => $recv_id, 'status' => '', 'is_delete' => null), array('status' => '수락'));

			
			$this->chat_m->mod_alrim_new(array('status' => '수락'), $send_id);

			
			$req_data = $this->my_m->row_array('chat_request', array('send_id' => $send_id, 'recv_id' => $recv_id, 'status' => '수락', 'is_delete' => null), 'idx', 'desc', '1');
			if(empty($req_data)){ echo "9"; exit; }
			
			$req_idx = $req_data['idx'];		

			
			$accept_data = $this->my_m->row_array('chat', array('mode' => 'accept', 'req_idx' => $req_idx), 'idx', 'desc', '1');
			if(!empty($accept_data)){
				
				if($accept_data['is_delete_gubn'] == "D"){
				
					$this->my_m->update('chat_request', array('idx' => $req_idx), array('is_delete' => 'D'));
					$this->my_m->update('chat', array('req_idx' => $req_idx), array('is_delete_gubn' => 'D'));
					echo "9";
					exit;
				}else{
				
					echo "accept";
					exit;
				}
			}

		
			$chat_data = array(
				'mode'				=> 'accept',
				'send_id'			=> $send_id,
				'recv_id'			=> $recv_id,
				'reg_date'			=> NOW,
				'read_date'			=> Null,
				'contents'			=> '채팅신청을 수락하였습니다.',
				'send_ip'			=> $this->input->ip_address(),
				'is_delete_send'	=> '0',
				'is_delete_recv'	=> '0',
				'req_idx'			=> $req_idx
			);
			$this->chat_m->add_chat($chat_data);

		
			$chat_data = array(
				'mode'				=> 'accept',
				'send_id'			=> $recv_id,
				'recv_id'			=> $send_id,
				'reg_date'			=> NOW,
				'read_date'			=> Null,
				'contents'			=> $this->session->userdata['m_nick']." 님이 채팅신청을 수락하였습니다.",
				'send_ip'			=> $this->input->ip_address(),
				'is_delete_send'	=> '0',
				'is_delete_recv'	=> '0',
				'req_idx'			=> $req_idx
			);
			$this->chat_m->add_chat($chat_data);

			
			$this->chat_m->last_chat_data_insert($req_idx);

			
			if($this->session->userdata['m_sex'] == "M"){
				$this->my_m->update('chat_request', array('idx' => $req_idx), array('refund' => '환불대상' ));
			}

			
			if($point_chk == "차감"){
				
				$result = member_point_insert($m_userid, $chat_code, $chat_goods, $chat_point, null, null, NOW, null);
			}else{
				$result = "1";
			}

			if($result == "1"){
				echo "1";
			}else{
				echo "2";
			}

		}else if($mpc == "error"){
			
			if($this->session->userdata['m_sex'] == "F"){
				echo "10";
			}else{
				echo "0";
			}
		}else{
		
			echo "9";
		}

	}

	
	function chat_deny(){
	
		user_check(null,0,'exit');	

		
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
		
		$this->chat_m->mod_alrim_new($data, $user_id);

	
		$chat_req = $this->my_m->row_array('chat_request', array('send_id' => $user_id, 'recv_id' => $this->session->userdata['m_userid'], 'status' => '거절'));

		
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
			
			$deny_msg = chat_deny_msg($deny_msg);
			$this->chatting_save($user_id, $deny_msg,$chat_req['idx'],"deny");
		}

	
		$this->chat_m->deny_last_chat_update($chat_req['idx']);

		
		$this->chat_m->last_chat_data_insert($chat_req['idx']);
				
	}

	function chat_list_del(){
		user_check(null,0,'exit');	

		
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->chat_list_delete($idx);

	}

	function chat_list_del_all(){
		user_check(null,0,'exit');	

	

		$this->chat_m->chat_list_delete_all();	
	}

	function msg_list_del(){
		user_check(null,0,'exit');	

	
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->msg_list_delete($idx);

	}

	function msg_list_del_all(){
		user_check(null,0,'exit');	

		

		$this->chat_m->msg_list_delete_all();	
	}

	function joy_list_del(){
		user_check(null,0,'exit');	

		
		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$this->chat_m->joy_list_delete($idx);

	}

	function joy_list_del_all(){
		user_check(null,0,'exit');	

		

		$this->chat_m->joy_list_delete_all();	
	}


	function chat_request_mobile(){
		
		
	
		user_check(null,5);
		
		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$gubn		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gubn')));

		$data = $this->member_lib->get_member($user_id); //회원정보

	
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}
		
	
		$chat_yn = $this->chat_m->already_chat_yn($user_id, 'already', null);
		
		if(!empty($chat_yn)){

			$del_yn = $this->chat_m->already_chat_yn($user_id, 'del', $chat_yn['idx']);

			if(!empty($del_yn['out_member'])){
			

			}else{
				
				echo "alreay_chat"; exit;
			}
			
		}

	
		$chat_member_ban = $this->chat_m->chat_member_ban($user_id);
		if(!empty($chat_member_ban)){
			//$this->call_chat_continue($chat_member_ban['idx']);  //2017-08-21 중복채팅신청 못하게 막음
		}

		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));		//회원 보유 포인트
		
		$data['add_text'] = "";
		if($data['m_conregion']){ $data['add_text'] = $data['m_conregion'];	}
		if($data['m_conregion2']){ $data['add_text'] .= " / ".$data['m_conregion2'];	}
		if($data['m_age']){	$data['add_text'] .= " / ".$data['m_age']."세";	}


		$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "비밀채팅신청";
		$top_data['add_text'] = "";

		if(IS_APP and APP_OS == "IOS"){
			array_push($top_data['add_css'], "/m/m_ios_add_css");
		}
		
		$this->load->view('layer_popup/popup_top_v',$top_data);


//		if($gubn == "map"){
		
			$data['user_img_src'] = img_src_ex($this->member_lib->member_thumb($user_id));

			$my_map_data = getGeo($this->session->userdata['m_userid']);			
				
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
			
				$data['map_point'] = $user_map_data = getGeo($user_id);				
			}else{
			
				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)

			$this->load->view('layer_popup/m_send_chat_request_map_v',@$data);
//		}else{

//			$this->load->view('layer_popup/m_send_chat_request_v',@$data);
//		}

		$this->load->view('layer_popup/popup_bottom_v');

	}

	function m_recv_chat_request(){
	
		user_check(null,0);
	
		$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$chat_pop_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chat_pop_idx')));
		
		$data = $this->member_lib->get_member($user_id); //회원정보

		$data['chat'] = $this->my_m->row_array('chat_request', array("idx" => $chat_pop_idx, "ex_send_id" => "send_id <> '".$this->session->userdata['m_userid']."' "));

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
		
		$data['greeting'] = "0";

		if($data['chat']['mode'] == "profile"){

			echo $data['chat']['mode'];
			exit;
	
		}else{

			if($data['chat']['mode'] == "map"){
				
				$recv_chat_request_view = "m_recv_chat_request_map_v";
			}else{
				
				$recv_chat_request_view = "m_recv_chat_request_map_v";
				//$recv_chat_request_view = "m_recv_chat_request_v";
			}

		
			$my_map_data = getGeo($this->session->userdata['m_userid']);	
			if(empty($data['m_xpoint']) and empty($data['m_ypoint'])){
		
				$data['map_point'] = $user_map_data = getGeo($data['m_userid']);	
			}else{

				$data['map_point'] = $user_map_data = array($data['m_xpoint'], $data['m_ypoint']);
			}
			$data['to_distance'] = getDistance($user_map_data[0], $user_map_data[1], $my_map_data[0], $my_map_data[1]);		//거리구하기(code_change_helper)

			$rtn_distance = str_replace("km", "", $data['to_distance']);

			if($rtn_distance <= "10"){
				$add_title = "회원님과 10km이내 근접회원!";
			}else{
				$add_title = "비밀채팅수락";
			}

			if(strpos($data['chat']['contents'], "(인사말)") !== false){
				$data['greeting'] = "1";
			}



			$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
			$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
			$top_data['add_title'] = $add_title;
			$top_data['add_text'] = "";

			if(IS_APP and APP_OS == "IOS"){
				array_push($top_data['add_css'], "/m/m_ios_add_css");
			}

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/'.$recv_chat_request_view, @$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}

	}


	function m_recv_chat_ajax(){
		
		user_check(null,0,'exit');	

		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$idx		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));
		

		$chat_pd = $this->my_m->row_array('product_list', array('m_product_code' => '9999', 'm_use_yn' => 'Y', 'm_gubn' => 'A'));

		if($this->session->userdata['m_sex'] == "M"){
			$m_userid = $this->session->userdata['m_userid'];
		}else{
			$m_userid = $user_id;
		}


		$rtn2 = member_point_chk($m_userid, $chat_pd['m_point']);
		
		if($rtn2 == "error"){
			echo "error"; exit;			
		}

	}


	function chat_accept_flg(){
		echo $this->session->userdata['m_sex'];
	}


	function chat_req_chk($user_id){

		user_check(null,0,'exit');

		if(empty($user_id)){
			return "false";			
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
			return "false";		
		}else{
			return "true";		
		}
	}


	function chat_exit(){
		
		user_check(null,0,'exit');

		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		
		if(empty($user_id)){exit;}
		
	
		$chat_req = $this->chat_m->chat_request_idx($user_id);


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
			
			
			if($exit_chk['is_delete_send'] == $this->session->userdata['m_userid']){
				echo "10";
				exit;
			}


			$data = array(
				"mode"		=> 'exit',
				"req_idx"	=> $chat_req['idx']
			);

			$rtn = $this->my_m->update('chat', $data, array('is_delete_recv' => $this->session->userdata['m_userid']));

			if($rtn == "1"){
				$this->my_m->update('chat', array('send_id' =>$chat_req['send_id'], 'recv_id' => $chat_req['recv_id']), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat', array('recv_id' =>$chat_req['send_id'], 'send_id' => $chat_req['recv_id']), array('is_delete_gubn' => 'D'));

				$this->my_m->update('chat_request', array('send_id' =>$chat_req['send_id'], 'recv_id' => $chat_req['recv_id']), array('is_delete' => 'D'));
				$this->my_m->update('chat_request', array('recv_id' =>$chat_req['send_id'], 'send_id' => $chat_req['recv_id']), array('is_delete' => 'D'));
			}

		}else{
			if( $this->session->userdata['m_userid'] == $chat_req['send_id'] and $chat_req['status'] == '' ){
				echo "1";exit;
			}

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
			

			if($chat_req['status'] == ''){
				$this->my_m->update('alrim_new', array('user_id' => $user_id), array('ex_chat_new_cnt' => 'chat_new_cnt = chat_new_cnt-1'));
				$this->my_m->update('chat', array('req_idx' => $chat_req['idx']), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat_request', array('idx' => $chat_req['idx']), array('is_delete' => 'D'));
			}

		}	

		$this->my_m->update('chat_request', array('idx' => $chat_req['idx'], 'status' => '수락', 'recv_id' => $this->session->userdata['m_userid']), array('alrim_del' => 'D'));
		$this->my_m->update('alrim_new', array('user_id' => $this->session->userdata['m_userid']), array('chat_new_cnt' => 'chat_new_cnt-1'));
		
		if($rtn == "1"){
			echo "1";			
		}else{
			echo "0";		
		}

	}




	function call_chat_continue($idx){
		
		if(empty($idx)){exit;}


		$this->my_m->update('chat_request', array('idx' => $idx), array('is_delete' => 'D', 'alrim_del' => 'D'));


		$this->my_m->update('chat', array('req_idx' => $idx), array('is_delete_gubn' => 'D'));
	}


	function profile_image_layer(){

		$data['idx']	 = $idx		= $this->input->post('idx', true);			
		$data['send_id'] = $send_id = $this->input->post('user_id', true);		

		$recv_id = $this->session->userdata['m_userid'];	

		if(empty($send_id) or empty($recv_id)){ echo "1000"; exit; }		
		
		$search = array(
			"idx"		=> $idx,
			"send_id"	=> $send_id,
			"recv_id"	=> $recv_id,
			"mode"		=> "profile",
			"ex_data"	=> "status = '' and is_delete is null"
		);

		$data['request_data'] = $request_data = $this->my_m->row_array('chat_request', $search, 'idx', 'desc', '1');

		if(empty($request_data)){ echo "1000"; exit; }		
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

		$user_id	= rawurldecode($this->input->post('user_id', true));	
		if(empty($user_id)){ echo "1000"; exit; }					
		
		$my_id		= $this->session->userdata['m_userid'];
		$idx		= "";
		$status		= "";
		$out_member = "";
		$result		= "";		


		$request_data = $this->chat_m->last_chat_status_request($my_id, $user_id);
		if(empty($request_data)){ echo ""; exit; }		

		$idx		= $request_data['idx'];				
		$status		= $request_data['status'];			
		$out_member	= $request_data['out_member'];		
		
		if($status == "" or $status == "대기"){ echo "ready"; exit;}	

		if(empty($out_member)){
		
			$result = $this->chat_m->last_chat_exit_check($idx, $my_id, $user_id);
		}else{
		
			if($out_member <> $my_id){
				$this->my_m->update('chat_request', array('idx' => $idx), array('is_delete' => 'D'));

				$this->my_m->update('chat', array('req_idx' => $idx), array('is_delete_gubn' => 'D'));
				$this->my_m->update('chat_backup', array('req_idx' => $idx), array('is_delete_gubn' => 'D'));
			}

			$result = "2";
		}

		echo $result;
		exit;

	}
	


}

/* End of file main.php */
/* Location: ./application/controllers/ */