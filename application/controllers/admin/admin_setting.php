<?php
class Admin_setting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('html');
		$this->load->helper('text');
		$this->load->helper('date');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
		$this->load->model('admin/a_member_m');
		$this->load->model('chat_m');
		$this->load->library('member_lib');

		admin_check(3);

	}

	function agree()  //약관설정
	{
		$data['list'] = $this->my_m->row_array("admin_setting", array('idx' => 1) );

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/agree_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}


	function agree_modi()  //약관설정 저장
	{

		$data = array(
			'agree1' => rawurldecode($this->input->post('agree1',TRUE)),
			'agree2' => rawurldecode($this->input->post('agree2',TRUE)),
			'agree3' => rawurldecode($this->input->post('agree3',TRUE)),
			'agree4' => rawurldecode($this->input->post('agree4',TRUE)),
			'agree5' => rawurldecode($this->input->post('agree5',TRUE))
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);
		echo $rtn;
	}


	function banned()  //금지아이디 설정
	{
		$banned_id['banned'] = $this->my_m->row_array("admin_setting", array('idx' => 1) );

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/banned_v',$banned_id);
		$this->load->view('admin/admin_bottom_v');
	}

	function banned_modi()  //금지아이디 저장
	{
		$data = array(
			'banned_id' => rawurldecode($this->input->post('banned_id',TRUE))
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);
		
		echo $rtn;
	}

	function banned_modi_nick()  //금지닉네임 저장
	{
		$data = array(
			'banned_nick' => rawurldecode($this->input->post('banned_nick',TRUE))
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);
		
		echo $rtn;
	}

	function chat_preference()  //채팅환경설정
	{
		$data['preference'] = $this->my_m->row_array("admin_setting", array('idx' => 1) );

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/chat_preference_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}

	function chat_preference_modi()  //채팅환경설정 저장
	{
		$data = array(
			'chat_request_point' => $this->input->post('chat_request_point',TRUE),
			'alarm_refresh' => $this->input->post('alarm_refresh',TRUE),
			'chat_refresh' => $this->input->post('chat_refresh',TRUE)
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);
		
		echo $rtn;
	}


	function manager_set()  //관리자 설정
	{		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'users', 'id', 'userid'); 

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/manager_set_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}


	// 관리자 등록 레이어팝업
	function manager_add_pop(){

		@$search_user['userid'] = $data['chk'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));		//선택회원 아이디

		$data['user'] = $this->my_m->row_array('users', $search_user);
		
		$this->load->view('admin/layer_popup/add_manager_layer_v', @$data);
	}

	// 관리자 등록
	function manager_add(){

		$auth_code		 = strip_tags(rawurldecode($this->input->post('auth_code', true)));
		$search['userid'] = $userid	= strip_tags(rawurldecode($this->input->post('userid', true)));
		$username		 = strip_tags(rawurldecode($this->input->post('username', true)));
		$nickname		 = strip_tags(rawurldecode($this->input->post('nickname', true)));
		$mana_pwd		 = strip_tags(rawurldecode($this->input->post('pawd', true)));
		$hashed_password = encryption_pass($mana_pwd);		//비밀번호 암호화	

		// 수정(원래아이디값)인지, 등록('')인지
		$is_modi		 = strip_tags(rawurldecode($this->input->post('is_modi', true)));

		// 등록이면 
		if ($is_modi == '' ){

			//중복검사
			$user_chk = $this->my_m->cnt('users', $search);
			if ($user_chk > 0){
				echo "6";
				exit;
			}

		// 수정이면
		}else{
			
			// 원래아이디와 수정할 아이디가 같지 않을때만 중복검사
			if ($is_modi != $userid){
				$user_chk = $this->my_m->cnt('users', $search);
				if ($user_chk > 0){
					echo "6";
					exit;
				}
			}
		}
		
		$data_array = array(
			'auth_code'	=> $auth_code,
			'userid'	=> $userid,
			'username'	=> $username,
			'nickname'	=> $nickname,
			'password'	=> $hashed_password
		);

		// 등록이면 추가
		if ($is_modi == '' ){

			$data_array['created'] = NOW;
			$add_fin = $this->my_m->insert('users', $data_array);

		// 수정이면 업데이트
		}else{

			$data_array['modified'] = NOW;
			$orig_id['userid'] = $is_modi;
			$add_fin = $this->my_m->update('users', $orig_id, $data_array);

		}
		echo $add_fin;

	}
	// 관리자 삭제
	function manager_del(){

		$search['userid'] = strip_tags(rawurldecode($this->input->post('userid', true)));

		$mana_del = $this->my_m->del('users', $search);
		echo $mana_del;
	}

	//특별아이디 채팅관리
	function special_chat_list(){
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		$search['ex_m_special'] = "(TotalMembers.m_special = '1' or  TotalMembers.m_special = '2') ";
		$search['ex_mode'] = "(chat.mode = 'chat' or  chat.mode = 'chat_req') ";

		foreach( chat_deny_msg('all') as $key => $val ){	//code change helper
			$search['ex_contents'.$key] = "chat.contents != '$val' ";
		}

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =25; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'chat', 'idx', 'recv_id', $desc = "desc", $select = "*");

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];

		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/special_chat_list_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}

	//특별아이디 채팅내용 저장
	function special_chat_save(){
		$contents		= rawurldecode($this->input->post('chat_val', true));
		$idx		= rawurldecode($this->input->post('idx', true));

		$search = array('idx' => $idx);
		$old_chat = $this->my_m->row_array('chat', $search,'idx','desc',1); //기존 채팅 주고받은정보

		$send_id = $old_chat['recv_id'];	//받는사람 
		$recv_id = $old_chat['send_id'];	//보내는사람 

		//보내는  사람의 닉네임 구해오기
		$mem = $this->member_lib->get_member($send_id);
		$sender_nick = $mem['m_nick'];	//받는사람 

		//채팅신청일경우 채팅수락하기
		if($old_chat['mode']  == "chat_req"){
			
				$data_req= array('status' => '수락');
				$this->db->where('is_delete', null);
				$this->db->where('status', '');
				$this->db->where('send_id', $recv_id);
				$this->db->where('recv_id', $send_id);
				$this->db->update('chat_request', $data_req);
	
				//채팅수락 idx 가져오기
				$chat_req = $this->my_m->row_array('chat_request', array('send_id' => $recv_id, 'recv_id' => $send_id, 'status' => '수락', 'ex_is_delete' => 'is_delete is null'));
				
				//채팅 수락 메시지 남기기
				$chat_data = array(
					'mode' => 'accept',
					'send_id' => $recv_id,
					'recv_id' => $send_id,
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
					'send_id' =>$send_id,
					'recv_id' => $recv_id,
					'reg_date' => NOW,
					'read_date' => Null,
					'contents' => $sender_nick." 님이 채팅신청을 수락하였습니다.",
					'send_ip' => $_SERVER['REMOTE_ADDR'],
					'is_delete_send' => '0',
					'is_delete_recv' => '0',
					'req_idx'		 => $chat_req['idx']
				);
				$this->chat_m->add_chat($chat_data);

				$this->chat_m->last_chat_data_insert($chat_req['idx']);

		}


		//승인된 채팅인지 체크
		$r_row = $this->chat_m->select_request_chat($send_id,$recv_id);  //상대방 채팅
		$r_row2 = $this->chat_m->select_request_chat($recv_id,$send_id);  //나의 채팅
			
		$req_idx = "";

		if(!@empty($r_row)){
			$req_idx = $r_row['idx'];
		}else{
			$req_idx = $r_row2['idx'];
		}

		//상대방이 나를 나쁜친구로 등록했는지 체크하기(latest_helper)
		$cnt = call_bad_friend_chk($send_id, $recv_id);
		if($cnt > 0){ echo "bad"; exit; }

		if(@$r_row['status'] == "수락" or @$r_row2['status'] == "수락"){

			$chat_exit = $this->my_m->row_array('chat', array('mode' => 'exit', 'req_idx' => $req_idx));

			if(!@empty($chat_exit)){
				echo "exit";
			}else{

				//지난 게시물 읽음으로 표시
				$search_up['ex_read'] = "send_id = '$recv_id' and recv_id = '$send_id'";
				$set_array = array("read_date" => NOW);
				$this->my_m->update('chat', $search_up, $set_array);

				//채팅전송 시작
				//채팅 내용추가
				$chat_data = array(
					'mode' => 'chat',
					'send_id' =>$send_id,
					'recv_id' => $recv_id,
					'reg_date' => NOW,
					'read_date' => Null,
					'contents' => $contents,
					'send_ip' => $_SERVER['REMOTE_ADDR'],
					'is_delete_send' => '0',
					'is_delete_recv' => '0',
					'send_user_nick' => $sender_nick,
					'req_idx'		 => $req_idx
				);
				$last_id = $this->chat_m->add_chat($chat_data);

				//메시지 도착 알림내역 추가
				$user_pic = $this->member_lib->member_thumb($send_id,74,71);

				$alrim_data = array(
					'mode' => 'msg',
					'send_id' => $send_id,
					'user_pic' => rawurldecode($user_pic),
					'recv_id' => $recv_id,
					'new_text' => $contents,
					'new_nick' => $sender_nick,
					'idx' => $last_id
				);
				$rtn = $this->chat_m->add_alrim($alrim_data);

				//환불대상에서 빼기
				$this->my_m->update('chat_request', array('idx' => $req_idx), array('refund' => ''));

				//GCM 알림 처리
				gcm_send($recv_id, "조이헌팅 채팅", $send_id." : ".$contents);
				$rtn = 1;
				echo $rtn;

			}
		}else if(@$r_row['status'] == "거절"){
			echo "deny";exit;
		}else{
			echo "not-ready";exit;
		}
		
	}

	function special_chat_exit(){

		$idx		= rawurldecode($this->input->post('idx', true));

		$search = array('idx' => $idx);
		$old_chat = $this->my_m->row_array('chat', $search); //기존 채팅 주고받은정보

		//채팅방정보
		$chat_r = $this->my_m->row_array('chat_request', array("idx" => $old_chat['req_idx'])); //기존 채팅 주고받은정보

		$result = $this->chat_m->last_chat_exit_check($old_chat['req_idx'], $old_chat['recv_id'], $old_chat['send_id']);

		echo $result;

//		$recv_id = $old_chat['recv_id'];	//받은사람 (여성)
//		$send_id = $old_chat['send_id'];	//보낸사람 (남성)
//
//		//받은사람 정보 가져오기
//		$recv_id_data = $this->member_lib->get_member($recv_id);
//
//		//먼저 채팅방을 나갈경우
//		//채팅방 나가기 데이터 insert
//		$data = array(
//			"mode"					=> 'exit',
//			"send_id"				=> $recv_id,
//			"recv_id"				=> $send_id,
//			"reg_date"				=> NOW,
//			"contents"				=> $recv_id_data['m_nick']."님이 채팅방을 나가셨습니다.",
//			"send_ip"				=> $_SERVER['REMOTE_ADDR'],
//			"is_delete_send"		=> $recv_id,
//			"send_user_nick"		=> $recv_id_data['m_nick'],	
//			"req_idx"				=> $old_chat['req_idx']
//		);
//
//		$rtn = $this->my_m->insert('chat', $data);
//		
//		$this->my_m->update('chat_request', array('idx' => $old_chat['req_idx']), array('alrim_del' => 'D'));
//
//		//아직 수락하지 않은 채팅방을 먼저 나갈경우
//		if($chat_r['status'] == ''){
//			$this->my_m->update('chat', array('req_idx' => $old_chat['req_idx']), array('is_delete_gubn' => 'D'));
//			$this->my_m->update('chat_request', array('idx' => $old_chat['req_idx']), array('is_delete' => 'D'));
//		}
//
//		echo $rtn;

	}

	// 특별아이디 관리
	function special_id(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			if($data['method'] == "ex_data_1"){
				//지역검색의 경우
				$search[$data['method']] = "(m_conregion like '%".$data['s_word']."%' or m_conregion2 like '%".$data['s_word']."%')";
			}else{
				$search[$data['method']] = $data['s_word'];
			}	
		}
		
		$search['ex_not'] = "m_special = '1'";

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =25; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//$result = $this->a_member_m->member_list($start, $rp, @$data, 'TotalMembers'); //회원 리스트
		//$data['m_special'] = $this->my_m->result_array('TotalMembers', $search);

		//특별회원 페이징처리
		$result = $this->my_m->get_list_solo($start, $rp, $search, 'TotalMembers', 'm_num', 'desc', '*');
		

		$data['m_special'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/special_list_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}

	// 특별회원 삭제+등록
	function special_modi(){

		$search['m_userid'] = strip_tags(rawurldecode($this->input->post('m_userid', true)));
		$search['m_num']	= strip_tags(rawurldecode($this->input->post('m_num', true)));
		$cate				= strip_tags(rawurldecode($this->input->post('cate', true)));

		//특별회원 지정할경우 지역좌표 셋팅
		$map_data = getGeo($search['m_userid']);

		if($cate == 'del'){
			$data_array['m_special'] = NULL;
			$data_array['m_xpoint'] = NULL;
			$data_array['m_ypoint'] = NULL;
		}else{
			$data_array['m_special'] = '1';
			$data_array['m_xpoint'] = $map_data[0];
			$data_array['m_ypoint'] = $map_data[1];
			$data_array['m_mobile_chk'] = '1';
		}

		$spe_del = $this->my_m->update('TotalMembers', $search, $data_array);

		echo $spe_del;
	}

	//특별회원 선택지역 설정하기 레이어팝업
	function conregion_layer(){

		$data['user_id'] = $user_id = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'user_id')));
		
		if(empty($user_id)){ exit; }
		$mdata = $this->member_lib->get_member($user_id);

		if(!empty($mdata['m_select_conregion'])){
			$val = explode("/", $mdata['m_select_conregion']);

			for($i=0; $i<count($val); $i++){
				if($val[$i] == "서울"){ $data['chk_1'] = $val[$i]; }
				if($val[$i] == "인천"){ $data['chk_2'] = $val[$i]; }
				if($val[$i] == "부산"){ $data['chk_3'] = $val[$i]; }
				if($val[$i] == "대구"){ $data['chk_4'] = $val[$i]; }
				if($val[$i] == "대전"){ $data['chk_5'] = $val[$i]; }
				if($val[$i] == "광주"){ $data['chk_6'] = $val[$i]; }
				if($val[$i] == "울산"){ $data['chk_7'] = $val[$i]; }
				if($val[$i] == "경기"){ $data['chk_8'] = $val[$i]; }
				if($val[$i] == "강원"){ $data['chk_9'] = $val[$i]; }
				if($val[$i] == "충남"){ $data['chk_10'] = $val[$i]; }
				if($val[$i] == "충북"){ $data['chk_11'] = $val[$i]; }
				if($val[$i] == "경남"){ $data['chk_12'] = $val[$i]; }
				if($val[$i] == "경북"){ $data['chk_13'] = $val[$i]; }
				if($val[$i] == "전남"){ $data['chk_14'] = $val[$i]; }
				if($val[$i] == "전북"){ $data['chk_15'] = $val[$i]; }
				if($val[$i] == "제주"){ $data['chk_16'] = $val[$i]; }
			}
		}

		$this->load->view('admin/layer_popup/select_conregion_v', @$data);
	}

	//특별회원 선택지역 업데이트
	function sel_conregion_up(){
		
		$user_id		= rawurldecode($this->input->post('user_id', true));
		$sel_conregion	= rawurldecode($this->input->post('sel_conregion', true));
		
		if(empty($user_id) or empty($sel_conregion)){ echo "1000"; exit; }		//잘못된접근

		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id, 'm_special' => '1'), array('m_select_conregion' => $sel_conregion));

		echo $rtn;
	}



	// 메인추천아이디 관리
	function special_id2(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		$search['ex_not'] = "m_special = '2'";

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->a_member_m->member_list($start, $rp, @$data, 'TotalMembers'); //회원 리스트

		$data['m_special'] = $this->my_m->result_array('TotalMembers', $search);

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/special_list2_v',$data);
		$this->load->view('admin/admin_bottom_v');
	}


	// 특별회원 삭제+등록
	function special_modi2(){

		$search['m_userid'] = strip_tags(rawurldecode($this->input->post('m_userid', true)));
		$search['m_num']	= strip_tags(rawurldecode($this->input->post('m_num', true)));
		$cate				= strip_tags(rawurldecode($this->input->post('cate', true)));

		if($cate == 'del'){
			$data_array['m_special'] = NULL;
		}else{
			$data_array['m_special'] = '2';
		}

		$spe_del = $this->my_m->update('TotalMembers', $search, $data_array);

		echo $spe_del;
	}
	


	//회원 인사말 관리 
	function intro_list(){

		//변수받기
		$v_text		= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'v_text')));			//검색어
		$v_code		= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'v_code')));			//구분값
		$v_sex		= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'v_sex')));			//성별
		$v_use_yn	= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'v_use_yn')));		//사용여부

		if(empty($v_code)){ $data['v_code'] = $v_code = "intro"; }else{ $data['v_code'] = $v_code; }			//구분값 기본값 셋팅
		if(empty($v_sex)){ $data['v_sex'] = $v_sex = "A"; }else{ $data['v_sex'] = $v_sex; }						//성별 기본값 셋팅
		if(empty($v_use_yn)){ $data['v_use_yn'] = $v_use_yn = "A"; }else{ $data['v_use_yn'] = $v_use_yn; }		//사용여부 기본값 셋팅

		$data['v_text'] = $v_text;
		
		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$data['rp'] = $rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$search['V_CODE'] = $v_code;

		if($v_sex <> "A"){ $search['V_SEX'] = $v_sex; }
		if($v_use_yn <> "A"){ $search['V_USE_YN'] = $v_use_yn; }

		if(!empty($v_text)){
			$search['ex_data_1'] = "V_TEXT LIKE '%".$v_text."%'";
		}

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'INTRO_TEXT', 'V_IDX', 'DESC', '*'); //인사말 리스트

		$data['list'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_setting/intro_list_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}

	//인사말 등록 레이어 팝업
	function intro_layer(){
		
		$idx		= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));			//고유번호

		if(!empty($idx)){
			$data = $this->my_m->row_array('INTRO_TEXT', array('V_IDX' => $idx), 'V_IDX', 'DESC', '1');
		}else{
			$data['V_CODE']		= "intro";
			$data['V_SEX']		= "A";
			$data['V_USE_YN']	= "Y";
			$data['V_TEXT']		= "";
		}
		
		$this->load->view('admin/layer_popup/reg_intro_layer_v', @$data);
	}

	//인사말 등록하기 함수
	function call_reg_intro(){

		//변수받기
		$v_idx			= rawurldecode($this->input->post('v_idx', true));			//순번(없으면 신규등록)
		$v_code			= rawurldecode($this->input->post('v_code', true));			//구분값(인사말) 나중에 추가할지도 몰라서 만들어놓음 (대화스타일, 원하는 만남)
		$v_sex			= rawurldecode($this->input->post('v_sex', true));			//성별
		$v_use_yn		= rawurldecode($this->input->post('v_use_yn', true));		//사용여부
		$v_text			= rawurldecode($this->input->post('v_text', true));			//내용
		$v_gubn			= rawurldecode($this->input->post('v_gubn', true));			//신규등록인지 수정인지 구분(insert, update)
		
		//저장할 데이터 배열로 만들기
		$arrData = array(
			"V_CODE"		=> $v_code,
			"V_SEX"			=> $v_sex,
			"V_USE_YN"		=> $v_use_yn,
			"V_TEXT"		=> $v_text
		);

		if($v_gubn == "insert"){
			//신규등록
			$rtn = $this->my_m->insert('INTRO_TEXT', $arrData);
		}else if($v_gubn == "update"){
			$rtn = $this->my_m->update('INTRO_TEXT', array('V_IDX' => $v_idx), $arrData);
			//수정
		}else{
			//잘못된 접근
			$rtn = "1000";
		}

		echo $rtn; exit;

	}

	//인사말 삭제하기 함수
	function intro_list_del(){

		$val = rawurldecode($this->input->post('val', true));

		if(strpos($val, "|")){
			//여러개를 선택하여 삭제할경우	
			$chk_val = explode("|", $val);
			
			for($i=0; $i<count($chk_val); $i++){
				$rtn = $this->my_m->del('INTRO_TEXT', array('V_IDX' => $chk_val[$i]));
			}
			
		}else{
			//한개의 리스트만 삭제할경우
			$rtn = $this->my_m->del('INTRO_TEXT', array('V_IDX' => $val));
		}

		echo $rtn;
	}



	function chat_text_list_setup()  //설정 저장
	{

		$data = array(
			'auto_reply' => rawurldecode($this->input->post('checked',TRUE))
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);
		echo $rtn;
	}


	function stop_chat(){	//채팅추천 금지 설정

		$search['m_userid'] = strip_tags(rawurldecode($this->input->post('m_userid', true)));
		$search['m_num']	= strip_tags(rawurldecode($this->input->post('m_num', true)));
		$cate				= strip_tags(rawurldecode($this->input->post('cate', true)));

		if($cate == 'del'){
			$data_array['m_send_stop'] = NULL;
		}else{
			$data_array['m_send_stop'] = '1';
		}

		$spe_del = $this->my_m->update('TotalMembers', $search, $data_array);

		echo $spe_del;

	}

}