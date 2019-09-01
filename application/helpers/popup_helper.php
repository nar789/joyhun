<?php 

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//홈페이지 내의 이벤트 혹은 공지 팝업 관련 헬퍼
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	
	//복주머니 이벤트
	function bags_event(){

		$CI =& get_instance();

		return;
		
		//현재시간 셋팅
		$this_date = date("Y-m-d H:i:s");		
		
		//2017년 1월1일 ~ 1월3일 자정까지만 이벤트 팝업 보이기
		if($this_date >= "2017-01-01 00:00:00" and $this_date <= "2017-01-03 23:59:59"){
			
			//if($CI->input->ip_address() == "59.11.70.223" or $CI->input->ip_address() == "14.47.36.51"){	//테스트 사무실에서만 보이기

			if(IS_LOGIN){

				$user_id	= $CI->session->userdata['m_userid'];
				$m_type		= $CI->session->userdata['m_type'];
				$event_code = @$CI->session->userdata['new_event_code'];
				
				//현재 시간에 이벤트를 참여했는지 체크하기(latest_helper)
				$cnt = new_pocket_chk($user_id);

				if(IS_MOBILE == TRUE){

					$html = "";
					$html .= "<div id='woman_pop' style='position: absolute; display:block; top:29%; width:100%; max-width:720px;'>";
					$html .= "	<div style='position: relative; margin:0 auto; width:320px;' id='bag_event_img'><a href='javascript:bags_event_btn();'><img src='".IMG_DIR."/bags_img_02.png' style='width:100%;'></a>";
					$html .= "		<div id='' style='position: absolute; right:4px; top:0; width:58px; height:31px; cursor: pointer;' onclick='javascript:bags_event_btn_close();'></div>";
					$html .= "</div>";
					$html .= "</div>";

					$html .= "<div id='woman_pop2' style='position:absolute; top:29%;  width:100%; max-width:720px; display:none;'>";
					$html .= "	<div style='position: relative; cursor:pointer; margin:0 auto; width:320px;' id='bag_event_img2' onclick='javascript:bags_event_btn_close();'>";
					$html .= "		<div id='' style='position: absolute; right:4px; top:0; width:58px; height:31px; cursor: pointer;' onclick='javascript:bags_event_btn_close();'></div>";
					
					$html .= "</div>";
					$html .= "</div>";

				}else{

					$html = "";
					$html .= "<div id='woman_pop' style='position: absolute; display:block; top:16%; left:36%;'>";
					$html .= "	<div style='position: relative;' id='bag_event_img'><a href='javascript:bags_event_btn();'><img src='".IMG_DIR."/bags_img_02.png'></a>";
					$html .= "		<div id='' style='position: absolute; right:4px; top:0; width:58px; height:31px; cursor: pointer;' onclick='javascript:bags_event_btn_close();'></div>";
					$html .= "</div>";
					$html .= "</div>";

					$html .= "<div id='woman_pop2' style='position: absolute; top:16%; left:36%;display:none;'>";
					$html .= "	<div style='position: relative; cursor:pointer;' id='bag_event_img2' onclick='javascript:bags_event_btn_close();'>";
					$html .= "		<div id='' style='position: absolute; right:4px; top:0; width:58px; height:31px; cursor: pointer;' onclick='javascript:bags_event_btn_close();'></div>";

					$html .= "</div>";
					$html .= "</div>";

				}//is_mobile end
			
				$pop_result = "";

				if($cnt == 0){
					//현재 시간내에 이벤트 참여를 안했을 경우만 호출
					if($m_type == "F" and empty($event_code)){
						$pop_result = $html;
					}else if($m_type == "V"){
						$pop_result = $html;
					}

					
				}

				echo $pop_result;
				
				

			} //is_login end
			//}

		}//2017년 1월1일 부터 1월 3일까지만 보이기 끝

	}

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성전용 이벤트 관련 시작
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성전용 이벤트 상단 팝업 함수
	function call_woman_event_pop(){

		$CI =& get_instance();
		
		if(IS_LOGIN){
			if($CI->session->userdata['m_sex'] == "M" or ($CI->input->ip_address() == "59.11.70.223" or $CI->input->ip_address() == "14.47.36.51") ){  //사무실에서 배너 숨기기
				//남성회원의 경우 팝업창 안보이기
				if(IS_MOBILE){
					//모바일버전 탑 배너

					$cnt = $CI->my_m->cnt('event_trip_log', array('user_id' => $CI->session->userdata['m_userid'], 'point' => '100', 'event_page' => 'trip'));

					if($cnt == 0){
						$html = "<div><a href='/service_center/event/vacance'><img src='".IMG_DIR."/m/banner/20170706_banner.jpg' style='width:100%;'></a></div>";
						//echo $html;
						return;
					}
					
				}				
			}else{
				//여성회원만 팝업 출력
				if(IS_MOBILE == true){
					//모바일버전 탑 배너
					$html = "<div><a href='/service_center/event/w_e_point'><img src='".IMG_DIR."/m/w_e_point_banner.png' style='width:100%;'></a></div>";
					echo $html;
					return;
				}else{
					//PC버전 탑 배너
					$v_cookie = get_cookie('woman_pop');

					$html = "";
					$html .= "<div id='woman_pop' style='position:relative; width:100%; background-color:#efece7; display:block;'>";
					$html .= "<div style='position:relative; width:1400px; margin:auto; height:80px;'>";
					$html .= "<a href='/service_center/event/w_e_point'><img src='".IMG_DIR."/service_center/w_e_point_banner.png'></a>";
					$html .= "<div style='position:absolute; width:150px; height:30px; top:50px; left:1000px; z-index:100; line-height:35px; color:#878789;'>";
					$html .= "오늘은 그만보기 ";
					$html .= "<input type='checkbox' id='chk_woman' name='chk_woman' value='' style='vertical-align:-3px; cursor:pointer;' onclick='javascript:call_woman_pop();'>";
					$html .= "</div>";
					$html .= "</div>";
					$html .= "</div>";
					
					//쿠키값이 오늘날짜보다 작거나 없을경우만 팝업출력
					if($v_cookie < date('Y-m-d') or empty($v_cookie)){
						echo $html;
						return;
					}else{
						return;
					}

				}
			
			}

		}

		return;		

	}

	//여성전용 이벤트 상단 로고배너
	function call_woman_event_logo(){

		$CI =& get_instance();
		
		if(IS_LOGIN){
			if($CI->session->userdata['m_sex'] == "F"){
				$html = "<a href='/service_center/event/w_e_point'><img src='".IMG_DIR."/e_w_gift_right_banner.png'></a>";
			}else{
				$html = "<a href='/etc/joy_guide'><img src='".IMG_DIR."/top_banner.gif'></a>";
			}
		}else{
			$html = "<a href='/etc/joy_guide'><img src='".IMG_DIR."/top_banner.gif'></a>";
		}
		
		echo $html;
		return;
	}

	//여성전용 미션 수행시 데이터 INSERT 함수
	//변수 : 모드값, 보내는회원아이디, 받는회원아이디 (모드값 구분 : 채팅신청 : request, 채팅하기 : chat, 메세지보내기 : msg, 선물수령 : gift, 포인트수령 : receive)
	function call_woman_event_data_reg($mode, $send_id, $recv_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		
		//변수가 하나라도 없을경우 그냥 return
		if(empty($mode) or empty($send_id) or empty($recv_id)){ 
			return; 
		}else{

			if($CI->session->userdata['m_sex'] == "M"){
				//세션 성별이 남성회원의 경우 
				return;
			}else{
				//세션 성별이 여성회원일 경우만 insert
				//동일 회원의 계속된 데이터 유입을 막기위해 모드값과 받는회원 아이디로 오늘 하루의 카운트 체크하여 데이터 insert

				//10.1 리워드 이벤트시 V_GUBN = REWARD 추가
				$search = array(
					"V_MODE"			=> $mode,
					"V_SEND_ID"			=> $send_id,
					"V_RECV_ID"			=> $recv_id,
					"ex_data_1"			=> "V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' ",
					"ex_data_2"			=> "V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00' ",
					"V_GUBN"			=> 'REWARD'
				);
				
				$cnt = $CI->my_m->cnt('WOMAN_EVENT', $search);
				
				//금일 포인트를 받았을경우 insert중지 추가예정

				//카운트가 0일경우 insert
				if($cnt == "0"){

					$arrData = array(
						"V_MODE"			=> $mode,
						"V_SEND_ID"			=> $send_id,
						"V_RECV_ID"			=> $recv_id,
						"V_WRITE_DATE"		=> NOW,
						"V_ETC"				=> NULL,
						"V_GUBN"			=> 'REWARD'
					);

					$CI->my_m->insert('WOMAN_EVENT', $arrData);

				}

				return;

			}
			
		}

	}

	//조이헌팅 여성회원 리워드 이벤트(이벤트 기간 : 2016-10-01 ~ 2016-10-31)
	//조이헌팅 여성회원 리워드 이벤트 현재날짜 포인트 계산 및 포인트 지급여부 계산 함수(이벤트 기간 : 2016-10-01 ~ 2016-10-31)
	function call_woman_event_02_point_chk($user_id){
		
		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($user_id)){ return; }

		$v_gubn = "REWARD";				//여성전용 리워드 이벤트 구분값
		$v_date = date("Y-m-d");		//오늘날짜

		$r_cnt = call_woman_event_02_recv_chk($user_id, $v_gubn);		//오늘 날짜에 포인트를 지급받았는지 체크후 리턴
	
		$sql = "";
		$sql .= " SELECT V_MODE, V_SEND_ID, COUNT(*) V_CNT, IF(V_MODE = 'request', COUNT(*)*2, COUNT(*)*1) V_POINT ";
		$sql .= " FROM WOMAN_EVENT ";
		$sql .= " WHERE (V_MODE = 'request' OR V_MODE = 'msg') ";
		$sql .= " AND V_WRITE_DATE >= '".$v_date." 00:00:00' AND V_WRITE_DATE <= '".$v_date." 24:00:00' AND V_SEND_ID = '".$user_id."' AND V_GUBN = '".$v_gubn."' ";
		$sql .= " GROUP BY V_MODE, V_SEND_ID ";
		$sql .= " ORDER BY V_IDX DESC ";

		$query = $CI->db->query($sql);

		$w_array = $query->result_array();
		
		if(empty($w_array)){
			$r_point = "0";
		}else{

			if($r_cnt > 0){
				
				$search = array(
					"V_MODE"		=> "receive",
					"V_SEND_ID"		=> "joyhunting",
					"V_RECV_ID"		=> $user_id,
					"ex_data_1"		=> "V_WRITE_DATE >= '".$v_date." 00:00:00' ",
					"ex_data_2"		=> "V_WRITE_DATE <= '".$v_date." 24:00:00' ",
					"V_GUBN"		=> $v_gubn
				);

				$recv_data = $CI->my_m->row_array('WOMAN_EVENT', $search, 'V_IDX', 'DESC', '1');

				$r_point = $recv_data['V_ETC'];

			}else{
				
				if(count($w_array) == "1"){
					$v_point = $w_array[0]['V_POINT'];
				}else{
					$v_point = $w_array[0]['V_POINT'] + $w_array[1]['V_POINT'];
				}				
				//받을수 있는 포인트는 최대 10포인트
				if($v_point >= "10"){
					$r_point = "10";
				}else{
					$r_point = $v_point;
				}

			}
			
		}

		return array($r_cnt, $r_point);
		
	}

	//조이헌팅 여성회원 리워드 이벤트 현재날짜 포인트 지급함수(이벤트 기간 : 2016-10-01 ~ 2016-10-31)
	//cnt > 0 선물지급여부, point 받을 포인트, user_id 회원아이디
	function call_woman_event_02_point_provide($cnt, $point, $user_id){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->helper('point_helper');
		
		$v_gubn = "REWARD";			//여성전용 리워드 이벤트 구분값

		$sql = "";
		$sql .= " SELECT COUNT(*) cnt FROM WOMAN_EVENT WHERE 1=1 AND V_MODE = 'receive' AND V_GUBN = 'REWARD' AND V_RECV_ID = '".$user_id."' and V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00' ";

		$query = $CI->db->query($sql);

		$rc_cnt = $query->row()->cnt;

		if($rc_cnt > 0){ return "1000"; }		//지급내역이 있을경우 리턴처리
		
		if($cnt == 0){

			$rtn = $CI->my_m->insert('WOMAN_EVENT', array('V_MODE' => 'receive', 'V_SEND_ID' => 'joyhunting', 'V_RECV_ID' => $user_id, 'V_WRITE_DATE' => NOW, 'V_ETC' => $point, 'V_GUBN' => $v_gubn));
			if($rtn == "1"){
				member_point_insert($user_id, '9990', '이벤트포인트지급', $point, null, '0001', NOW, '여성회원전용이벤트');
			}
			
		}		

		return $rtn; 

	}

	//조이헌팅 여성회원 리워드 이벤트 현재날짜 포인트 지급받았는지 체크함수
	function call_woman_event_02_recv_chk($user_id, $gubn){

		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($user_id) or empty($gubn)){ return; }		//에러처리

		$v_date = date("Y-m-d");
		
		$search = array(
			"V_MODE"			=> 'receive',
			"V_SEND_ID"			=> 'joyhunting',
			"V_RECV_ID"			=> $user_id,
			"ex_data_1"			=> "V_WRITE_DATE >= '".$v_date." 00:00:00' ",
			"ex_data_2"			=> "V_WRITE_DATE <= '".$v_date." 24:00:00' ",
			"V_GUBN"			=> $gubn
		);
		
		$cnt = $CI->my_m->cnt('WOMAN_EVENT', $search);		//회원이 오늘 날짜에 포인트를 지급받았는지 체크($r_cnt > 0 이면 오늘날짜에 포인트를 지급받은 경우)

		return $cnt;
	}

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성전용 이벤트 관련 끝
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


?>