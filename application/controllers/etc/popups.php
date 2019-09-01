<?php

class Popups extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->model('rand_m');
	}


	function call_popup(){

		// 준회원일 경우
		if($this->session->userdata('m_type') == 'F' && $this->session->userdata('m_sex') == 'M'){
	
			// count session
			$pop_cnt = @$this->session->userdata('m_pop_cnt');
			$last_date = @$this->session->userdata('last_date');

			if((IS_MOBILE == TRUE) or (IS_MOBILE == FALSE && $pop_cnt > 6)){exit;}	//관리자 설정 갯수보다 많으면 정지

			$row = $this->my_m->row_array('admin_setting', array("idx" => "1"));	//관리자 환경설정 불러오기

			// pop_cnt 팝업이 없으면
			if (empty($pop_cnt)){
				$this->session->set_userdata(array('m_pop_cnt' => '1','last_date' => NOW));
				exit;
			}
			
			$wait_sec = $row['v_popup_time_'.$pop_cnt];
			//마지막 세션시간 + 60초
			$check_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));

			//디버깅용 테스트
			//if($this->session->userdata('m_userid') == "wwkorea1106"){echo $pop_cnt;exit;} 

			if(NOW > $check_time ){

				//보낸횟수 및 현지시간을 마지막 시간으로 셋팅
				$new_pop_cnt = $pop_cnt +1;
				$this->session->set_userdata(array('m_pop_cnt' => $new_pop_cnt,'last_date' => NOW));

				//5분안에 만날수 있는 이성
				if($pop_cnt == '1' and $row['popup_time_1'] > 0){
						echo $this->minutes5();
				
				//이상형 접속 알림!! 4인 출력
				}else if($pop_cnt == '2' and $row['popup_time_2'] > 0){
						echo $this->ideal_type();
				
				//사진과 문자를 동시에 주고받는 문자팅
				}else if($pop_cnt == '3' and $row['popup_time_3'] > 0){
						echo $this->munjating();

				//메세지 
				}else if($pop_cnt == '4' and $row['popup_time_4'] > 0){
						echo $this->message();

				//오늘 번개팅 하실래요??
				}else if($pop_cnt == '5' and $row['popup_time_5'] > 0){
						echo $this->beongaeting();
				
				 //스폐셜 매칭 회원
				}else if($pop_cnt == '6' and $row['popup_time_6'] > 0){
						echo $this->special_meeting();
				}

			}

		// 정회원일 경우
		}else if($this->session->userdata('m_type') == 'V' && $this->session->userdata('m_sex') == 'M'){

			$pop_cnt = @$this->session->userdata('m_pop_cnt');
			$last_date = @$this->session->userdata('last_date');

			if((IS_MOBILE == TRUE && $pop_cnt > 10) or (IS_MOBILE == FALSE && $pop_cnt > 13)){exit;}	//관리자 설정 갯수보다 많으면 정지

			//관리자에서 시간설정 불러오기
			$row = $this->my_m->row_array('admin_setting', array("idx" => "1"));

			if (empty($pop_cnt)){
				//기본 쿠키 셋팅
				$pop_cnt = 1;
				$this->session->set_userdata(array('m_pop_cnt' => '1','last_date' => NOW));
			}

			// 비밀채팅신청 팝업이 끝났으면 지정팝업시작
			if(($row["v_popup_time_".$pop_cnt] == '' || $row["v_popup_time_".$pop_cnt] == 0) && $pop_cnt < 11){
				$pop_cnt = 10;
			}

			$wait_sec = $row['v_popup_time_'.$pop_cnt];
			//마지막 세션시간 + 60초
			$check_time = date("Y-m-d H:i:s", strtotime("$last_date +$wait_sec seconds"));

			if(NOW > $check_time ){

				$pop_cnt = $pop_cnt +1;

				//보낸횟수 및 현지시간을 마지막 시간으로 셋팅
				$this->session->set_userdata(array('m_pop_cnt' => $pop_cnt,'last_date' => NOW));

				// 10개까지는 추천채팅팝업 (위에서 더했기때문에 여기도 +1)
				if(IS_MOBILE == TRUE){
					if($pop_cnt < 12){
						echo $this->chat_push_mobile(); //모바일 정회원 비밀채팅 추천팝업 1~10
					}
				}else{
					if($pop_cnt < 12){
						echo $this->chat_push("type_v"); //PC 정회원 비밀채팅 추천팝업 1~10
					// 11~13개는 지정팝업 (위에서 더했기때문에 여기도 +1)
					}else if($pop_cnt == 12){
						echo $this->ideal_type("type_v"); //추천회원 접속 알림!! 4인 출력
					}else if($pop_cnt == 13){
						echo $this->beongaeting("type_v"); //오늘 번개팅 하실래요??
					}else if($pop_cnt == 14){
						echo $this->special_meeting("type_v"); //스폐셜 매칭 회원
					}
				}

			} //end if(NOW > $check_time ){

			//정회원일경우 끝	
		}else if(@$this->session->userdata['m_sex'] == "F"){
			//여성회원의 경우 팝업호출
			//접속후 10초, 1분, 3분 3회 뜨게 처리

			//접속시간 셋팅
			if(empty($this->session->userdata['set_last_date'])){
				$this->session->set_userdata(array('set_last_date' => NOW, 'w_pop_cnt' => 3));
				exit;
			}

			$last_date	= $this->session->userdata['set_last_date'];
			$pop_cnt	= $this->session->userdata['w_pop_cnt'];
			
			//세션이 살아있을경우 현재날짜와 세션날짜가 다를경우 초기화
			if(date("d", strtotime($last_date)) <> date("d", strtotime(NOW))){
				$this->session->set_userdata(array('set_last_date' => NOW, 'w_pop_cnt' => 3));
				exit;
			}
			
			if($pop_cnt == 0){ exit; }

			$timer_1 = "10";		//10초
			$timer_2 = "60";		//60초
			$timer_3 = "180";		//180초

			$check_time_1 = date("Y-m-d H:i:s", strtotime("$last_date +$timer_1 seconds"));
			$check_time_2 = date("Y-m-d H:i:s", strtotime("$last_date +$timer_2 seconds"));
			$check_time_3 = date("Y-m-d H:i:s", strtotime("$last_date +$timer_3 seconds"));
			
			if($check_time_1 <= NOW and NOW < $check_time_2 and $pop_cnt == 3){
				//접속시간 10초 이후
				$this->session->set_userdata(array('w_pop_cnt' => $pop_cnt-1));
				echo $this->woman_pop_push('1');
			}else if($check_time_2 <= NOW and NOW < $check_time_3 and $pop_cnt == 2){
				//접속시간 60초 이후
				$this->session->set_userdata(array('w_pop_cnt' => $pop_cnt-1));
				echo $this->woman_pop_push('2');
			}else if($check_time_3 <= NOW and $pop_cnt == 1){
				//접속시간 180초 이후
				$this->session->set_userdata(array('w_pop_cnt' => $pop_cnt-1));
				echo $this->woman_pop_push('3');
			}

		}

	}

	//5분안에 만날수 있는 이성
	function minutes5()
	{
		ob_start();		
		$top_data['add_css'] = array("layer_popup/minutes5_css");
		$top_data['add_js'] = array("layer_popup/minutes5_js");

		$rand_array = $this->rand_m->result_array('TotalMembers_login', array("m_sex" => "F"));

		$top_data['rand_mb'] = $rand_array[0];
		$top_data['rand_num'] = rand(1, 32);

		$this->load->view('layer_popup/minutes5_v',$top_data);

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	//이상형 접속 알림!! 4인 출력
	function ideal_type($mode = '')
	{
		ob_start();

		$top_data['add_css'] = array("layer_popup/ideal_type_css");
		$top_data['add_js'] = array("layer_popup/ideal_type_js");
		
		// 정회원이면
		if($mode == 'type_v'){
			$search['m_type'] = "V";
			$search['ex_pic'] = "m_filename IS NOT NULL";
		}

		$search['m_sex'] = "F";

		$rand_array = $this->rand_m->result_array('TotalMembers_login', $search,'4');

		$top_data['rand_mb1'] = $rand_array[0];
		$top_data['rand_mb2'] = $rand_array[1];
		$top_data['rand_mb3'] = $rand_array[2];
		$top_data['rand_mb4'] = $rand_array[3];

		// 정회원이면
		if($mode == 'type_v'){
			$this->load->view('layer_popup/ideal_type_v_v',$top_data);
		}else{
			$this->load->view('layer_popup/ideal_type_v',$top_data);
		}

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	//사진과 문자를 동시에 주고받는 문자팅
	function munjating()
	{
		ob_start();	
		
		$top_data['add_css'] = array("layer_popup/munjating_css");
		$top_data['add_js'] = array("layer_popup/munjating_js");

		$rand_array = $this->rand_m->result_array('TotalMembers_login', array("m_sex" => "F"));

		$top_data['rand_mb'] = $rand_array[0];
		$top_data['rand_num'] = rand(1, 32);

		$this->load->view('layer_popup/munjating_v',$top_data);

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
	
	//메세지 
	function message()
	{
		ob_start();		

		$top_data['add_css'] = array("layer_popup/message_css");
		$top_data['add_js'] = array("layer_popup/message_js");

		$rand_array = $this->rand_m->result_array('TotalMembers_login', array("m_sex" => "F","ex_search" => "my_intro IS NOT NULL","ex_search" => "my_intro != ''"));

		$top_data['rand_mb'] = $rand_array[0];
		$top_data['rand_num'] = rand(1, 32);

		$this->load->view('layer_popup/message_v',$top_data);

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
	
	//오늘 번개팅 하실래요??
	function beongaeting($mode= '')
	{
		ob_start();		
		$top_data['add_css'] = array("layer_popup/beongaeting_css");
		$top_data['add_js'] = array("layer_popup/beongaeting_js");

		$rand_array = $this->rand_m->result_array('T_MeetingDate_Bun', array("b_sex" => "F"),'7');

		$top_data['rand_mb1'] = $rand_array[0];
		$top_data['rand_mb2'] = $rand_array[1];
		$top_data['rand_mb3'] = $rand_array[2];
		$top_data['rand_mb4'] = $rand_array[3];
		$top_data['rand_mb5'] = $rand_array[4];
		$top_data['rand_mb6'] = $rand_array[5];
		$top_data['rand_mb7'] = $rand_array[6];

		$top_data['rand_num1'] = rand(1, 32);
		$top_data['rand_num2'] = rand(1, 32);
		$top_data['rand_num3'] = rand(1, 32);
		$top_data['rand_num4'] = rand(1, 32);
		$top_data['rand_num5'] = rand(1, 32);
		$top_data['rand_num6'] = rand(1, 32);
		$top_data['rand_num7'] = rand(1, 32);


		// 정회원이면
		if($mode == 'type_v'){
			$this->load->view('layer_popup/beongaeting_v_v',$top_data);
		}else{
			$this->load->view('layer_popup/beongaeting_v',$top_data);
		}

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	//스폐셜 매칭 회원
	function special_meeting($mode = '')
	{
		ob_start();		
		$top_data['add_css'] = array("layer_popup/special_meeting_css");
		$top_data['add_js'] = array("layer_popup/special_meeting_js");

		// 정회원이면
		if($mode == 'type_v'){
			$search['m_type'] = "V";
			$search['ex_pic'] = "m_filename IS NOT NULL";
		}
		$search['m_sex'] = "F";

		$rand_array = $this->rand_m->result_array('TotalMembers_login', $search);

		$top_data['rand_mb'] = $rand_array[0];

		$this->load->view('layer_popup/special_meeting_v',$top_data);

		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	// 정회원 비밀채팅 추천팝업 PC
	function chat_push(){

		$data['width'] = "450px";

		$data['push_info'] = $this->rand_m->result_array('TotalMembers_login', array("m_sex" => "F", "m_type" => "V"));

		$top_data['add_css'] = array("layer_popup/chat_request_css");
		$top_data['add_js'] = array("layer_popup/chat_push_popup_js");
		$top_data['add_title'] = "비밀채팅추천";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/chat_push_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	// 정회원 비밀채팅 추천팝업 MOBILE
	function chat_push_mobile(){

		$data['push_info'] = $this->rand_m->result_array('TotalMembers_login', array("m_sex" => "F", "m_type" => "V","ex_pic" => "m_filename IS NOT NULL AND m_filename != ''"));

		$top_data['add_css'] = array("layer_popup/chat_request_css");
		$top_data['add_js'] = array("layer_popup/chat_push_popup_js");
		$top_data['add_title'] = "비밀채팅추천";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/chat_push_m_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//여성용 추천 레이업팝업
	//접속후 10초, 1분, 3분 3회 뜨게 처리
	function woman_pop_push($mode = '1'){
	
		$data['mlist'] = $mlist = $this->rand_m->result_array('TotalMembers_login', array('m_sex' => 'M'), '3');
		if(empty($mlist)){ exit; }		//데이터가 없을 경우

		if(IS_MOBILE == true){
			
			ob_start();			

			$top_data['add_css'] = array("layer_popup/m_woman_pop_push_css");
			$top_data['add_js'] = array("layer_popup/m_woman_pop_push_js");
			$top_data['add_title'] = "볼수록 치명적인 매력남 추천";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/m_woman_pop_v', $data);
			$this->load->view('layer_popup/popup_bottom_v');

			$output = ob_get_contents();
			ob_end_clean();

			return $output;

		}else{
			
			$data['mode'] = $mode;
			$data['rand_num'] = mt_rand(100, 600);

			switch($mode){
				case "1" : $data['btn_bg_class'] = "bg_42b2bd"; $data['color_class_1'] = "color_fff"; $data['color_class_2'] = "color_fcafd3"; break;
				case "2" : $data['btn_bg_class'] = "bg_e35831"; $data['color_class_1'] = "color_000"; $data['color_class_2'] = "color_e35831"; break;
				case "3" : $data['btn_bg_class'] = "bg_c7404f"; $data['color_class_1'] = "color_000"; $data['color_class_2'] = "color_c7404f"; break;
			}
			
			$data['add_css'] = array("layer_popup/woman_pop_push_css");
			$data['add_js'] = array("layer_popup/woman_pop_push_js");

			$this->load->view('layer_popup/woman_pop_v', $data);

		}		

	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */


//chat_push