<?php

class Smsting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('meeting_m');
		$this->load->model('sms_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		$this->load->helper('point_helper');
		$this->load->helper('code_change');
		$this->load->helper('level_helper');
	}

	//문자팅 리스트
	function sms_list($tabmenu=''){

		user_check(null,0);

		$uri_array = $this->seg_exp;

		@$chk_nick_1 = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'nick1')));

		// 메인 문자팅 OPEN 에서 넘어왔으면
		if(!empty($chk_nick_1)){
			
			$chk_nick_2 = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'nick2')));
			$chk_nick_3 = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'nick3')));

			$search['ex_nick'] = "TotalMembers.m_nick = '".$chk_nick_1."' OR TotalMembers.m_nick = '".$chk_nick_2."' OR TotalMembers.m_nick = '".$chk_nick_3."'";

		// 메인 문자팅 OPEN 에서 넘어온게 아니면
		}else{

			if($tabmenu == 2){ //5분거리 친구
				$search['m_conregion'] = $this->session->userdata('m_conregion');
			}
			else if($tabmenu == 3){ //또래친구
				$str = $this->session->userdata('m_age');
				$search['m_age2'] = substr($str,0,1);
			}

			if( in_array('conregion', $uri_array))
			{
				$data['conregion'] = $search['m_conregion'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'conregion')));
				$data['age2'] = $search['m_age2'] = rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'age2')));

				$bot_data['add_script'] = "
					<script>
						$('#conregion').val('".$data['conregion']."');
						$('#age2').val('".$data['age2']."');
					</script>
				";
			}
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =12; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->meeting_m->sms_list($start, $rp, @$search);

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$navs = array('미팅신청','문자팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_smsting'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/smsting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //문자팅 탭메뉴
		$data['call_search'] = $this->call_search(); //문자팅 검색창

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/smsting_v', $data);
		$this->load->view('bottom_v',@$bot_data);
	}

	function all()
	{
		$this->sms_list(1); //전체 문자팅등록회원
	}

	function min5_friends()
	{
		$this->sms_list(2); //5분거리 친구
	}

	function peer_friends()
	{
		$this->sms_list(3); //또래친구
	}


	function my_smsting_list($tabmenu,$page_name)
	{
		//나의 문자팅 관리함
		user_check(null,9);
		if($this->check_smsting_data() == 0){alert("문자팅 등록을 먼저해 주세요.");}

		//$uri_array = $this->seg_exp;

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		
		if($tabmenu == 1){ //받은 문자
			
			$tab_name = 'r_userid';
			$search['msg_l.r_userid'] = $this->session->userdata('m_userid');
			$data['sms'] = 're';

		}else if($tabmenu == 2){ //보낸 문자

			$tab_name = 's_userid';
			$search['msg_l.s_userid'] = $this->session->userdata('m_userid');
			$data['sms'] = 'se';
		}

		$m_result = $this->sms_m->smsting_list($start, $rp, @$search,$tab_name); //내 문자팅 관리함 리스트 요청

		$se_cnt = count($m_result[0]);


			  if ($tabmenu == 1){ $ssearch = 's_userid';
		}else if ($tabmenu == 2){ $ssearch = 'r_userid'; }


		for ($i = 0; $i < $se_cnt; $i++){
			$search2['m_userid']	= $m_result[0][$i][$ssearch];
			$data['send_arr'][$i]	= $this->my_m->row_array('T_JoyHunting_MsgTing', $search2, "", "desc");	
		}

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$data['page_name'] = $page_name;

		//view 설정
		$navs = array('미팅신청','문자팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_smsting'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/smsting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu(4); //문자팅 탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2($tabmenu); //문자팅 > 내문자팅 관리함 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/smsting_mypage_v', $data);
		$this->load->view('bottom_v');
	}

	function my_smsting_recv()
	{
		$this->my_smsting_list($tabmenu = 1, "받은"); //받은 문자팅
	}

	function my_smsting_send()
	{
		$this->my_smsting_list($tabmenu = 2, "보낸"); //보낸 문자팅
	}

	function my_smsting_setting()
	{
		//내 문자팅 관리함 수신 설정 관리
		user_check(null,9,'exit');

		if($this->check_smsting_data() == 0 ){alert("문자팅 등록을 먼저해 주세요.");}

		$search['m_userid'] = $this->session->userdata('m_userid');

		$data['sms_set'] = $this->my_m->row_array('T_JoyHunting_MsgTing', $search, "", "desc");
		$data['m_result'] = $this->my_m->row_array('TotalMembers', $search, "", "desc");

		$search_re_cnt['r_userid'] = $this->session->userdata('m_userid');
		$search_se_cnt['s_userid'] = $this->session->userdata('m_userid');

		$data['sms_re_cnt'] = $this->my_m->cnt('T_JoyHunting_MsgTing_List', $search_re_cnt, "", "desc");
		$data['sms_se_cnt'] = $this->my_m->cnt('T_JoyHunting_MsgTing_List', $search_se_cnt, "", "desc");

		//전송가능 문자 갯수
		$mtp = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));

		if(empty($mtp) || $mtp['total_point'] == "0"){
			$data['m_use_cnt'] = "0";
		}else{
			$data['m_use_cnt'] = floor($mtp['total_point']/50);
		}		

		$data['pic_row'] = $this->my_m->row_array('TotalMembers', array('m_userid' => $this->session->userdata('m_userid')) );

		//view 설정
		$navs = array('미팅신청','문자팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_smsting'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/smsting_js");
		
		$data['call_top'] = $this->call_top(); //번개팅 상단
		$data['call_tabmenu'] = $this->call_tabmenu(4); //번개팅 탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2(3); //번개팅 > 내번개팅 탭메뉴

		if($data['sms_set']['m_receive_time'] == "Y"){
			$data['times'][0] = 0;
			$data['times'][1] = 0;
		}else{
			$data['times'] = explode("|",$data['sms_set']['m_receive_time']);
		}

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/smsting_mypage_setting_v', $data);
		$this->load->view('bottom_v');
	}

	function remove_mysms(){

		// 내 문자팅 관리함 > 받은,보낸 문자 삭제(이지만 update);

		$mode = rawurldecode($this->input->post('mode',TRUE));
		$search['sms_idx'] = $idx = rawurldecode($this->input->post('m_idx',TRUE));

		if ($mode == 're'){

			$search['r_userid'] = $this->session->userdata('m_userid');
			$result = $this->my_m->row_array('T_JoyHunting_MsgTing_List', $search, "", "desc");
			$del_rtn = $this->my_m->update('T_JoyHunting_MsgTing_List', $search, array('is_delete_recv'=>'1'));
			
		}else if ($mode == 'se'){	//보낸문자에서 삭제

			$search['r_userid'] = $this->session->userdata('m_userid');
			$result = $this->my_m->row_array('T_JoyHunting_MsgTing_List', $search, "", "desc");
			$del_rtn = $this->my_m->update('T_JoyHunting_MsgTing_List', $search, array('is_delete_send'=>'1'));
		}

		echo $del_rtn;
	}


	function check_smsting_data() {
		//문자팅 이미 등록했는지 체크

		$search['m_userid'] = $this->session->userdata('m_userid');

		$result = $this->my_m->cnt('T_JoyHunting_MsgTing', $search);
		
		return $result;
	}

	function check_smsting_time() {
		//문자팅 시간맞는지 체크

		$search['m_nick'] = rawurldecode($this->input->post('user_nick',TRUE));

		$result = $this->my_m->row_array('T_JoyHunting_MsgTing', $search);

		if ($result['m_receive_time'] == 'Y'){
			echo "1";	//문자수신가능
		}else{
			$nowTime = substr(NOW,11,2);
			$setTime = explode('|',$result['m_receive_time']);

			if ($setTime[0] > $setTime[1]){	//앞자리가 더 크면
				if (($nowTime >= $setTime[0] && $nowTime <= '24') || ($nowTime >= '0' && $nowTime <= $setTime[1])){
					echo "1";	//문자수신가능
				}else{
					echo "9";	//문자수신 불가능
				}
			}else{							//뒷자리가 더 크면
				if ($nowTime >= $setTime[0] && $nowTime < $setTime[1]){
					echo "1";	//문자수신가능
				}else{
					echo "9";	//문자수신 불가능
				}
			}
		}

	}


	function smsting_add_popup(){
		//문자팅 무료등록 레이어팝업 AJAX

		user_check(null,9);

		$search['m_userid'] = $this->session->userdata('m_userid');
		$data['m_row'] = $this->member_lib->get_member($this->session->userdata('m_userid'));		//회원정보 가져오기(휴대전화인증)

		$data['my_data'] = $this->my_m->row_array('T_JoyHunting_MsgTing', $search, "", "desc");

		$data['pic_row'] = $this->my_m->row_array('member_pic', array('user_id' => $this->session->userdata('m_userid'), 'is_main_pic' => 'y'));
		
		$top_data['add_css'] = array("layer_popup/smsting_add_popup_css");
		$top_data['add_js'] = array("layer_popup/smsting_add_popup_js");
		$top_data['add_title'] = "문자팅 등록하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/smsting_add_popup_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	//문자팅 신규등록
	function reg_smsting(){
		
		//로그인 여부 체크
		user_check(null,9);
			
		$data['m_job']			= rawurldecode($this->input->post('m_job',TRUE));
		$data['m_outstyle']		= rawurldecode($this->input->post('m_outstyle',TRUE));
		$data['m_character']	= rawurldecode($this->input->post('m_character',TRUE));

		$age_str = $this->session->userdata('m_age');
		$data['m_age2'] = substr($age_str,0,1);

		$arr_data = array(
				
				'm_userid' => $this->session->userdata('m_userid'),
				'm_nick' => $this->session->userdata('m_nick'),
				'm_sex' => $this->session->userdata('m_sex'),
				'm_age' => $this->session->userdata('m_age'),
				'm_age2' => $data['m_age2'],
				'm_region1' => $this->session->userdata('m_conregion'),
				'm_region2' => $this->session->userdata('m_conregion2'),
				'm_job' => $data['m_job'],
				'm_outstyle' => $data['m_outstyle'],
				'm_character' => $data['m_character'],
				'm_receive_time' => Y,
				'm_msg_cnt' => 0,
				'm_regdate' => NOW,
				'm_update' => NOW
			
		);

		$rtn = $this->my_m->insert('T_JoyHunting_MsgTing', $arr_data);

		if($rtn == "1"){
			echo "1"; //정상등록
		}else if($rtn == "3"){
			echo "3"; //이미등록
		}else{
			echo "9"; //오류

		}
	}


	//문자팅 관리함 수정
	function modi_smsting(){

		//로그인 여부 체크
		user_check();
		
		$data['m_receive_time']	= rawurldecode($this->input->post('m_receive_time',TRUE));
		$data['m_job']			= rawurldecode($this->input->post('m_job',TRUE));
		$data['m_outstyle']		= rawurldecode($this->input->post('m_outstyle',TRUE));
		$data['m_character']	= rawurldecode($this->input->post('m_character',TRUE));
		
		$arr_data = array(
				'm_receive_time'	=> $data['m_receive_time'],
				'm_job'				=> $data['m_job'],
				'm_outstyle'		=> $data['m_outstyle'],
				'm_character'		=> $data['m_character'],
				'm_update'			=> NOW			
		);

		$search['m_userid'] = $this->session->userdata('m_userid');
		$rtn = $this->my_m->update('T_JoyHunting_MsgTing', $search , $arr_data);

		if($rtn == "1"){
			echo "1"; //정상등록
		}else{
			echo "9"; //오류
		}
	}


	function remove_smsting(){	//문자팅 해지

		user_check();

		if($this->check_smsting_data() == 0){
			echo "2"; //문자팅 등록을 먼저 해 주세요.
			exit;
		}

		$search['m_userid'] = $this->session->userdata('m_userid');
		$rtn = $this->my_m->del('T_JoyHunting_MsgTing', $search);

		if($rtn == "1"){
			echo "1"; //정상등록
		}else{
			echo "9"; //오류
		}

	}


	
	function sms_phone_search(){		// 문자팅 right_menu 회원검색

		$search['m_nick'] = rawurldecode($this->input->post('search_nick', TRUE));

		$result = $this->my_m->row_array('T_JoyHunting_MsgTing', $search);

		echo @$result['m_userid'];

	}

	function sms_send_request(){		// 문자팅 right_menu 보내기

		user_check(null, 9, 'exit');

		if($this->check_smsting_data() == 0 ){
			echo "2"; //문자팅 등록을 먼저 해 주세요.
			exit;
		}

		$sms_text		= rawurldecode($this->input->post('sms_text', TRUE));
		$recv_member	= rawurldecode($this->input->post('recv_member', TRUE));
		
		//문자메시지를 받을회원의 [0] : 아이디, [1] : 닉네임, [2] : 메세지건수
		$recv_result = $this->call_recv_member($recv_member);
		
		$recv_id_array		= $recv_result[0];		//아이디배열
		$recv_nick_array	= $recv_result[1];		//닉네임배열
		$recv_count			= $recv_result[2];		//문자팅메시지를 받을 회원의 수

		$tp = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));
		
		if(empty($tp) || $tp['total_point'] < $recv_count*50){
			echo "4"; exit;		//문자팅 건당 50포인트 차감(포인트가 부족할경우 4를 반환)
		}

		$recv_phone_array = $this->call_recv_member_phone($recv_id_array, $recv_count);
		
		$r_id_array		= $recv_phone_array[0];		//실제로 문자를 받는 회원의 아이디 배열값
		$r_nk_array		= $recv_phone_array[1];		//실제로 문자를 받는 회원의 닉네임 배열값
		$r_ph_array		= $recv_phone_array[2];		//실제로 문자를 받는 회원의 폰번호 배열값
		$r_count		= $recv_phone_array[3];		//실제로 문자를 받는 회원의 수
		

		// 이미지주소 불러오는 부분
		$imgsrc = $this->member_lib->member_thumb($this->session->userdata('m_userid'),145,146);
		
		$attach_file_name = str_replace('/', '', strrchr(img_src_ex($imgsrc), '/'));																	//파일명
		$img_final_url = str_replace($attach_file_name, '', str_replace('http://'.$_SERVER['HTTP_HOST'].'/upload', '', img_src_ex($imgsrc)));			//파일경로

		$search['m_userid'] = $this->session->userdata('m_userid');
		$sms_code = $this->my_m->row_array('TotalMembers', $search, "", "desc");
		$s_code = $sms_code['m_num'];

		$send_num = "#14709".$s_code;

		$lms_title = '[조이헌팅]문자팅 메세지 도착';

		$arr_images = array(	//MMS용 배열
			'attach_file_group_key' => $s_code,
			'attach_file_subpath'	=> $img_final_url,
			'attach_file_name'		=> $attach_file_name
		);

		$time = date("Y/m/d H:i:s", mktime(date("H"), date("i"), date("s")+3, date("m"), date("d"), date("Y"))); //NOW 보다 3초뒤
		$recv_cnt = $r_count;

		if($recv_cnt == "0"){
			echo "0"; exit;
		}

		$sms_text_fianl = $sms_text."\n\r\n\r(이 번호는 회신이 불가능하오니 조이헌팅 홈페이지에서 확인해주세요.)";
		
		$rtn = $this->sms_lib->sms_send($send_num, $r_ph_array, $sms_text_fianl, $lms_title, $arr_images);	//##풀기

		for($i=0; $i<$recv_cnt; $i++){
			
			//문자 보내기 데이터
			$add_data = array(
				's_userid'		 => $this->session->userdata['m_userid'],
				'r_userid'		 => $r_id_array[$i],
				'sms_content'	 => $sms_text,
				'recv_num '		 => $r_ph_array[$i],
				'sms_time'		 => $time
			);

			$final_rtn = $this->my_m->insert('T_JoyHunting_MsgTing_List', $add_data);
			
			//문자를 받는 회원의 닉네임 셋팅
			if($i == 0){
				$result_nick = $r_nk_array[0];
			}else{
				$result_nick .= ", ".$r_nk_array[$i];
			}
		}

		if($final_rtn == "1"){
			
			//문자팅 상품 가져오기(문자팅 상품 코드 : 9998, 차감포인트 건당 50포인트)
			$pd = $this->my_m->row_array('product_list', array('m_product_code' => '9998'));

			//문자팅 실포인트 차감 
			$rtn = member_point_insert($this->session->userdata['m_userid'], $pd['m_product_code'], $pd['m_goods'], $pd['m_point']*$recv_cnt, null, null, NOW, null);

			echo $result_nick;		//문자팅 보내기 성공(문자메세지를 받은 회원 닉네임 반환)

		}else{
			echo "error";				//문자팅 보내기 실패
		}

		

	}

	function sms_mph_change(){		// 내 문자팅 관리함 > 수신번호 변경

		$data['m_hp1']	= rawurldecode($this->input->post('m_hp1', TRUE));
		$data['m_hp2']	= rawurldecode($this->input->post('m_hp2', TRUE));
		$data['m_hp3']	= rawurldecode($this->input->post('m_hp3', TRUE));
		
		$arr_data = array(
				'm_hp1'		=> $data['m_hp1'],
				'm_hp2'		=> $data['m_hp2'],
				'm_hp3'		=> $data['m_hp3'],
				'm_up_date'	=> NOW			
		);

		$search['m_userid'] = $this->session->userdata('m_userid');
		$rtn = $this->my_m->update('TotalMembers', $search , $arr_data);

		echo $rtn;
	}


	function call_top(){
		//문자팅 본문 상단
		ob_start();

		$search['m_userid'] = $this->session->userdata('m_userid');

		$data['my_data'] = $this->my_m->row_array('T_JoyHunting_MsgTing', $search, "", "desc");
		
		$this->load->view('meeting/smsting_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($num){
		//문자팅 상단 탭메뉴

		for($i=1;$i<10;$i++){
				if($i == $num){
					$data["tap_menu_css_$i"]  = "tab_on";			
				}else{
					$data["tap_menu_css_$i"]  = "tab_off";			
				}
		}

		ob_start();
		
		$this->load->view('meeting/smsting_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



	function call_tabmenu2($num){
		//문자팅 > 내문자팅 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css2_$i"]  = "meeting_2dep_on";			
			}else{
				$data["tap_menu_css2_$i"]  = "meeting_2dep_off";			
			}
		}

		ob_start();
		
		$this->load->view('meeting/smsting_my_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_search(){
		//문자팅 검색
		ob_start();
		
		$this->load->view('meeting/smsting_search_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



	//문자팅 추가
	//문자를 받을 회원 분리
	function call_recv_member($recv_array){
		
		$recv_member_array = explode('|', $recv_array);

		for($i=0; $i<count($recv_member_array); $i++){

			$m_result = $this->sms_m->userid_add('T_JoyHunting_MsgTing', array('TotalMembers.m_nick' => $recv_member_array[$i]), 'm_idx', 'desc');

			$recv_id_array[]	= $m_result['m_userid'];
			$recv_nick_array[]	= $m_result['m_nick'];

		}
		
		//받을 사람의 아이디 배열, 닉네임 배열, 받을사람수 반환
		return array($recv_id_array, $recv_nick_array, count($recv_member_array));

	}

	//문자메세지를 받을 회원의 폰번호 가져오기(메세지 거부 회원처리)
	function call_recv_member_phone($recv_id_array, $recv_count){
		
		for($i=0; $i<$recv_count; $i++){

			$m_data = $this->my_m->row_array('TotalMembers', array('m_userid' => $recv_id_array[$i], 'm_hp_sms' => '1'));

			if(!empty($m_data)){
				$recv_id_array[]	= $m_data['m_userid'];
				$recv_nick_array[]	= $m_data['m_nick'];
				$recv_phone_array[] = $m_data['m_hp1'].$m_data['m_hp2'].$m_data['m_hp3'];
			}
			
		}
		
		//실제로 문자를 받을 회원의 아이디배열, 폰번호배열, 숫자 반환
		return array($recv_id_array, $recv_nick_array, $recv_phone_array, count($recv_phone_array));

	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */