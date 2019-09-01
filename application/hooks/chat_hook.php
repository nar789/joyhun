<?php
//알림 읽어오기 HOOK
function hook_get_alrim() 
{
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_alrim"){
		$CI->load->library('session');

		if($CI->session->userdata('m_userid')){
			$chat_mode = "mode = 'chat'";
			if(IS_MOBILE == true){
				$chat_mode .= " or mode = 'chat_req' or mode = 'deny' or mode = 'gift' or mode = 'gift_req' or mode = 'exit'";
			}
			
			$sql = "";
			$sql .= " update alrim_new ";
			$sql .= " set chat_new_cnt = (select count(*) cnt from chat_request where 1=1 and recv_id = '".$CI->session->userdata['m_userid']."' and status = '' and is_delete is null) ";
			$sql .= " , msg_new_cnt = ( ";
			$sql .= " select count(*) cnt ";
			$sql .= " from chat ";
			$sql .= " where 1=1 ";
			$sql .= " and recv_id = '".$CI->session->userdata['m_userid']."' ";
			$sql .= " and read_date is null ";
			$sql .= " and is_delete_gubn is null ";
			$sql .= " and req_idx is not null ";
			$sql .= " and (".$chat_mode.") ";
			$sql .= " ) ";			
			$sql .= " where user_id = '".$CI->session->userdata['m_userid']."' ";
			$CI->db->query($sql);				
		

			$CI->db->where('user_id',$CI->session->userdata('m_userid'));
			$query = $CI->db->get("alrim_new");
			$result = $query->row_array();

			if($result == FALSE){exit;} 

			$clear = false;
			$flag = false;
			foreach($result as $key => $val){

				if($flag == true){echo "|";}else{$flag = true;}

				if($key == "chat_new_text" or $key == "msg_new_text" or $key == "joy_new_text"){
					echo "$key=".rawurlencode(mb_substr($val,0,50));
					if(mb_strlen($val) > 50){echo "...";}
				}else{
					echo "$key=".rawurlencode ($val);
				}

				if($key == "chat_pop_idx" or $key == "msg_pop_idx" or $key == "joy_pop_idx"){
					if($val > 0 and $clear == false){ 
						$CI->db->set($key, NULL);
						$CI->db->where('user_id', $CI->session->userdata('m_userid'));
						$CI->db->update('alrim_new');			

						$clear = true;
					}
				} 

			}//end foreach

			exit;

		}else{
		
			exit;
		}
	} //end if hook_get_alrim

}


function hook_get_chat(){
	
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_chat"){
		$CI->load->library('session');
		if($CI->session->userdata('m_userid') and $CI->uri->segment(3) == true ){
	
			

			$CI->db->where('send_id',$CI->session->userdata('m_userid'));
			$CI->db->where('recv_id',$CI->uri->segment(3));

			$query = $CI->db->limit(20)->order_by('idx', 'desc')->get("chat");
			$result = $query->result_array();	

			$flag = false;
			foreach($result as $data){

				if($data['read_date'] != NULL){
					if($flag == true){echo "|";}else{$flag = true;}
					echo $data['idx'];
				}
				
			}
			echo "↕";

			$CI->db->where('send_id',$CI->uri->segment(3));
			$CI->db->where('recv_id',$CI->session->userdata('m_userid'));
			$CI->db->where('read_date',NULL);
			$CI->db->where('is_delete_gubn', null);
			$CI->db->where('req_idx is not null', null, false);
			$CI->db->order_by('idx', 'asc');
			$query = $CI->db->limit(20)->get("chat");
			$result = $query->result_array();	
			
			$user_id = $CI->uri->segment(3);
			$user_pic = $CI->member_lib->member_thumb($user_id, 50, 50);	

			$flag = false;
			foreach($result as $data){

				if($flag == true){echo "¶";}else{$flag = true;}

				$flag2 = false;
				foreach($data as $key => $val){

					if($flag2 == true){echo "|";}else{$flag2 = true;}

					echo "$key=".rawurlencode ($val);
					
					if($key == "idx"){
						//읽음 표시
						$CI->db->set('read_date', 'NOW()', FALSE);
						$CI->db->where('idx', $val);
						$CI->db->update('chat');		
						
						echo "|user_pic=".rawurlencode($user_pic);
					}

					if($key == "read_date"){

				
						$query = $CI->db->select('*')->where('user_id',$CI->session->userdata('m_userid'))->get('alrim_new');
						$cnt_row = $query->row_array();		

		
						if($cnt_row['msg_new_cnt'] > 0){
							$CI->db->where('user_id', $CI->session->userdata('m_userid'));
							$data_arr2['msg_new_cnt'] = $cnt_row['msg_new_cnt'] - 1;
							$data_arr2['msg_new_text'] = '';
							$CI->db->update('alrim_new', $data_arr2);
						}

					}
				}//end foreach
				
			}

			exit;

		}else{
		
			exit;
		}
	} //end if hook_get_chat

}

function hook_get_chat_first_load(){
	
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_chat_first_load"){
		$CI->load->library('session');
		$CI->load->library('member_lib');
		$CI->load->model('chat_m');

		if($CI->session->userdata('m_userid') and $CI->uri->segment(3) == true ){


			$my_id = $CI->session->userdata('m_userid');
			$user_id = $CI->uri->segment(3);
			$CI->db->where('req_idx is not null', null, false);
			$CI->db->where('is_delete_gubn', null);
			$CI->db->where("((send_id = '$my_id' and recv_id = '$user_id') or (send_id = '$user_id' and recv_id = '$my_id'))", NULL, FALSE);
			$CI->db->order_by('idx', 'asc');

			$query = $CI->db->get("chat");
			$result = $query->result_array();								

			$user_pic = $CI->member_lib->member_thumb($user_id, 50, 50);

			echo "↕";			

			$flag = false;
			foreach($result as $data){

				if($flag == true){echo "¶";}else{$flag = true;}				

				$flag2 = false;
				$recv_id = ""; //임시변수
				$mode = ""; //임시변수
				foreach($data as $key => $val){

					if($flag2 == true){echo "|";}else{$flag2 = true;}
				
					if($key == "read_date"){
						if($val == NULL){
							echo "read_cnt=1";	
						}else{
							echo "read_cnt=&nbsp;";
						}

						echo "|user_pic=".rawurlencode($user_pic);

					}else{
						echo "$key=".rawurlencode ($val);
					}

					if($key == "idx"){
					
						$CI->db->set('read_date', 'NOW()', FALSE);
						$CI->db->where('idx', $val);
						$CI->db->where('recv_id', $my_id);
						$CI->db->update('chat');
					}
					
					if($key == "recv_id"){	$recv_id = $val;	}
					if($key == "mode"){	$mode = $val;	}

					if($key == "read_date" and $val == null and $recv_id == $CI->session->userdata('m_userid') and ($mode == "chat" or $mode == "chat_req")){

			
						$query = $CI->db->select('*')->where('user_id',$CI->session->userdata('m_userid'))->get('alrim_new');
						$cnt_row = $query->row_array();		
					
	
						if($cnt_row['msg_new_cnt'] > 0){
							$CI->db->where('user_id', $CI->session->userdata('m_userid'));
							$data_arr2['msg_new_cnt'] = $cnt_row['msg_new_cnt'] - 1;
							$data_arr2['msg_new_text'] = '';
							$CI->db->update('alrim_new', $data_arr2);
						}

					}
				}//end foreach
				
			}

	
			$CI->chat_m->last_chat_cnt_up($result[0]['req_idx']);

			exit;

		}else{

			exit;
		}
	} //end if hook_get_chat

}


function hook_get_alrim_chat_list(){
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_alrim_chat_list"){
		$CI->load->library('session');
		$CI->load->library('member_lib');
		if($CI->session->userdata('m_userid')){
			

			$my_id = $CI->session->userdata('m_userid');

			$CI->db->where('recv_id', $my_id);
			$CI->db->where('is_delete', NULL);
			$CI->db->where('alrim_del', NULL);
			$CI->db->where('status <> ', '나감');

			$query = $CI->db->limit(10)->order_by('idx', 'desc')->get("chat_request");
			$result = $query->result_array();

			$flag = false;
			foreach($result as $data){

				if($flag == true){echo "¶";}else{$flag = true;}

				$flag2 = false;
				foreach($data as $key => $val){

					if($flag2 == true){echo "|";}else{$flag2 = true;}

					if($key == "contents"){
						echo "$key=".rawurlencode(mb_substr($val,0,50));
						if(mb_strlen($val) > 50){echo "...";}
					}else if($key == "send_id"){			
						$thumb = rawurlencode($CI->member_lib->member_thumb($val,74,71));
						echo "thumb=$thumb|";
						echo "$key=".rawurlencode($val);
					}else{
						echo "$key=".rawurlencode($val);
					}
				}//end foreach
				
			}

			exit;

		}else{
		
			exit;
		}


	}

}



function hook_get_alrim_msg_list(){
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_alrim_msg_list"){
		$CI->load->library('session');
		$CI->load->library('member_lib');
		if($CI->session->userdata('m_userid')){
		

			$my_id = $CI->session->userdata('m_userid');

			$CI->db->where('recv_id', $my_id);
			$CI->db->where('read_date', NULL);
			$CI->db->where('mode', 'chat');			

			$query = $CI->db->limit(20)->order_by('idx', 'desc')->get("chat");

			$result = $query->result_array();
			
			$flag = false;
			foreach($result as $data){

				if($flag == true){echo "¶";}else{$flag = true;}

				$flag2 = false;
				foreach($data as $key => $val){

					if($flag2 == true){echo "|";}else{$flag2 = true;}

					if($key == "contents"){
						echo "$key=".rawurlencode(mb_substr($val,0,50));
						if(mb_strlen($val) > 50){echo "...";}
					}else if($key == "send_id"){			
						$thumb = rawurlencode($CI->member_lib->member_thumb($val,74,71)); //썸네일
						echo "thumb=$thumb|";
						$nick = $CI->member_lib->get_member($val); //닉네임
						echo "msg_new_nick=".$nick['m_nick']."|";
						echo "$key=".rawurlencode($val);
					}else{
						echo "$key=".rawurlencode($val);
					}

				}//end foreach
				
			}

			exit;

		}else{
			//비로그인 상태
			exit;
		}


	}

}



function hook_get_alrim_joy_list(){
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_get_alrim_joy_list"){
		$CI->load->library('session');
		$CI->load->library('member_lib');
		if($CI->session->userdata('m_userid')){

			$my_id = $CI->session->userdata('m_userid');

			$CI->db->where('user_id ', $my_id);	

			$query = $CI->db->limit(20)->order_by('idx', 'desc')->get("alrim_msg");
			$result = $query->result_array();

			$flag = false;
			foreach($result as $data){

				if($flag == true){echo "¶";}else{$flag = true;}

				$flag2 = false;
				foreach($data as $key => $val){

					if($flag2 == true){echo "|";}else{$flag2 = true;}

					echo "$key=".rawurlencode($val);

				}//end foreach
				
			}

			exit;

		}else{

			exit;
		}


	}

}



function hook_auto_check(){
	$CI = & get_instance();

	if($CI->uri->segment(2) == "hook_auto_check"){
		$CI->load->library('session');
		$CI->load->model('chat_m');
		$CI->load->helper('chat_helper');
		$CI->load->helper('alrim_helper');


	
		if($CI->session->userdata('m_userid') and $CI->session->userdata('m_type') == "F" and $CI->session->userdata('m_sex') == "M"){

			$info = $CI->member_lib->get_member($CI->session->userdata('m_userid')); 
			if($info['m_send_stop'] == "1"){exit;}

		
			$my_id = $CI->session->userdata('m_userid');
		
			//if($my_id != "wwkorea1105"){exit;}

			$CI->db->select('*');
		    $CI->db->from('auto_text_history');
			$CI->db->where('m_userid', $my_id);
			$CI->db->where("send_date like '".TODAY."%'");
			$CI->db->order_by("idx", "desc"); 
			$query = $CI->db->get();
			$cnt = $query->num_rows();

	
			$CI->db->select('*');
		    $CI->db->from('admin_setting');
			$CI->db->where('idx', 1);
			$query2 = $CI->db->get();			
			$row2 = $query2->row();

		
			if($cnt == 0){
				$wait_sec = 0;

		
				$data = array(
					"text_idx"					=> 0,
					"m_userid"				=> $my_id,
					"send_id"				=> 'start',
					"send_date"				=> NOW
				);
				$CI->db->insert('auto_text_history', $data); exit;

			}else if($cnt == 1 and $row2->chat_time_1 > 0){
				$wait_sec = $row2->chat_time_1;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_1;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 2 and $row2->chat_time_2 > 0){
				$wait_sec = $row2->chat_time_2;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_2;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 3 and $row2->chat_time_3 > 0){
				$wait_sec = $row2->chat_time_3;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_3;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 4 and $row2->chat_time_4 > 0){
				$wait_sec = $row2->chat_time_4;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_4;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 5 and $row2->chat_time_5 > 0){
				$wait_sec = $row2->chat_time_5;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_5;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 6 and $row2->chat_time_6 > 0){
				$wait_sec = $row2->chat_time_6;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_6;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 7 and $row2->chat_time_7 > 0){
				$wait_sec = $row2->chat_time_7;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_7;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 8 and $row2->chat_time_8 > 0){
				$wait_sec = $row2->chat_time_8;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_8;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 9 and $row2->chat_time_9 > 0){
				$wait_sec = $row2->chat_time_9;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_9;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else if($cnt == 10 and $row2->chat_time_10 > 0){
				$wait_sec = $row2->chat_time_10;
				$row = $query->row(); 
				$last_date = $row->send_date;
				$mode = $row2->chat_style_10;
				$next_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));
			}else{
				exit;
			}

			if(NOW > $next_time ){


				
				$query = $CI->db->query("
					SELECT A.*, B.text_idx
					FROM INTRO_TEXT A
					LEFT OUTER JOIN (SELECT text_idx FROM auto_text_history WHERE m_userid = '$my_id') B ON A.V_IDX = B.text_idx
					WHERE B.text_idx IS NULL
					ORDER BY RAND() LIMIT 1
				");

				if ($query->num_rows() > 0)
				{
					$row = $query->row(); 
					$text_idx = $row->V_IDX;
					$contents = $row->V_TEXT;	

			
					$m_conregion2 = $CI->session->userdata('m_conregion2');
					if($m_conregion2 == ""){$m_conregion2 = "서울";}
					$contents = str_replace("[지역]", $m_conregion2, $contents);
					
					$use_cnt = $row->use_cnt + 1;

			
					$data = array(
						"use_cnt"					=> $use_cnt,
						"last_use_date"				=> NOW
					);					
					
					$CI->db->where('V_IDX', $text_idx);
					$CI->db->update('INTRO_TEXT', $data);

				}else{exit;}



	
				$m_conregion = $CI->session->userdata('m_conregion');

	
				$query = $CI->db->query("
					SELECT A.*, B.send_id, C.m_gubun
					FROM TotalMembers AS A
					LEFT OUTER JOIN (SELECT send_id FROM auto_text_history WHERE m_userid = '$my_id') B ON A.m_userid = B.send_id
					LEFT OUTER JOIN (SELECT m_userid user_id, m_gubun FROM T_MakeFriend_List WHERE m_fuserid = '$my_id' AND m_gubun = '나쁜친구') C ON A.m_userid = C.user_id
					WHERE A.m_sex = 'F' AND A.m_special = '1' AND B.send_id IS NULL AND IFNULL(C.m_gubun, 'OK') <> '나쁜친구' AND (A.m_select_conregion like '%$m_conregion%')
					ORDER BY RAND() LIMIT 1
				");

				if ($query->num_rows() > 0)
				{
					$row = $query->row(); 
					$send_id = $row->m_userid;
					$send_nick = $row->m_nick;	

				}else{
				
			
					$query = $CI->db->query("
						SELECT A.*, B.send_id, C.m_gubun
						FROM TotalMembers AS A
						LEFT OUTER JOIN (SELECT send_id FROM auto_text_history WHERE m_userid = '$my_id') B ON A.m_userid = B.send_id
						LEFT OUTER JOIN (SELECT m_userid user_id, m_gubun FROM T_MakeFriend_List WHERE m_fuserid = '$my_id' AND m_gubun = '나쁜친구') C ON A.m_userid = C.user_id
						WHERE A.m_sex = 'F' AND A.m_special = '1' AND B.send_id IS NULL AND IFNULL(C.m_gubun, 'OK') <> '나쁜친구' AND (A.m_select_conregion is NULL)
						ORDER BY RAND() LIMIT 1
					");

					if ($query->num_rows() > 0)
					{
						$row = $query->row(); 
						$send_id = $row->m_userid;	
						$send_nick = $row->m_nick;	
					}else{exit;}

				}


				super_chat_request($send_id, $send_nick, $my_id, $contents,$mode);


				$data = array(
					"text_idx"					=> $text_idx,
					"m_userid"				=> $my_id,
					"send_id"				=> $send_id,
					"send_date"				=> NOW
				);
				
				$CI->db->insert('auto_text_history', $data);


				$data = array(
					"my_intro"					=> $contents
				);				
				$CI->db->where('m_userid', $send_id);
				$CI->db->update('TotalMembers', $data);



				gcm_send($my_id, "조이헌팅 채팅", $send_nick."님이 채팅신청을 보냈습니다.");

			}



		}

		exit;
	}

}




?>