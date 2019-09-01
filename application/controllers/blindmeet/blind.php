<?php

class Blind extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('blind_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('alrim_helper');
		
		//모바일 top메뉴 라이브러리
		$this->load->library('m_top_menu_lib');

	}

	//PC버전 소개팅
	function index()
	{	
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}


		$navs = array('홈','소개팅'); //상단메뉴에 들어가는 현재위치

		$top_data['top_menu'] = $this->top_menu_lib->view('blind_date',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('blind_like'); //우측메뉴 로딩

		$top_data['add_css'] = array("blindmeet/blindmeet_css");
		$top_data['add_js'] = array("blindmeet/blindmeet_js");

		$data['call_tabmenu'] = $this->call_tabmenu(1); //탭메뉴

		$this->load->view('top_v',$top_data);

		if (IS_LOGIN == FALSE){
			// 로그인하지 않았으면
			$this->load->view('blindmeet/today_meet_v', $data);
		}else{
			// 로그인했으면

			$use_blind = $this->today_am_nine('time');			//현재시간에 따라서 데이터 불러오기 조건(매일 오전 9시 기준)

			if(!@empty($use_blind)){
				
				for($i=0; $i<count($use_blind); $i++){
					$data['today_list'][$i] = $this->my_m->row_array('TotalMembers', array('m_userid' => $use_blind[$i]['b_mb']));
				}

				$more_cnt = $this->today_am_nine('more');		//현재시간에 따라서 한번더 여부 데이터 불러오기 조건(매일 오전 9시 기준)
				if($more_cnt == "4"){
					$data['more_cnt'] = 'confirm';
				}

				$this->load->view('blindmeet/today_meet_use_v',$data);

			// 오늘 소개팅한적 없으면
			}else{
				$this->load->view('blindmeet/today_meet_login_v',$data);
			}
		}
		$this->load->view('bottom_v');
	}

	//모바일버전 소개팅
	function index_mobile(){

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		//모바일 로그인 체크
		user_check(null,0);
		
		//회원정보 가져오기
		$data['member_data'] = $member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		$data['cnt'] = $this->today_blind();	//오늘 소개팅을 받았는지 여부확인(cnt가 0보다 크면 오늘 소개팅 받은거임)
		
		//현재시간에 따라서 데이터 불러오기 조건(매일 오전 9시 기준)
		$use_blind = $this->today_am_nine('time');

		if(!@empty($use_blind)){
				
			for($i=0; $i<count($use_blind); $i++){
				$data['today_list_'.$i] = $this->my_m->row_array('TotalMembers', array('m_userid' => $use_blind[$i]['b_mb']));
			}

			$more_cnt = $this->today_am_nine('more');		//현재시간에 따라서 한번더 여부 데이터 불러오기 조건(매일 오전 9시 기준)
			if($more_cnt == "4"){
				$data['more_cnt'] = 'confirm';
			}
		}

		//view 설정	
		$top_data['add_css'] = array("/m/m_blindmeet_css");
		$top_data['add_js'] = array("/m/m_blindmeet_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

		$this->load->view('m/m_top_v', $top_data);

		if($member_data['m_mobile_chk'] == "1"){
			//휴대전화 본인인증이 완료된 회원
			$this->load->view('m/blindmeet/m_blindmeet_v', $data);		
		}else{
			//휴대전화 본인인증을 하지 않은 회원
			$this->load->view('m/blindmeet/m_blindmeet_start_v', $data);
		}
		
		$this->load->view('m/m_bottom0_v');

	}

	//PC버전 소개팅 시작하기
	function blind_start(){

		user_check(null,9, 'exit');
		
		$data = $this->blind_data_call();

		$ajax_view = $this->load->view('ajax_view/blindmeet_ajax_p_v', @$data, true);

		echo $ajax_view;
	}

	//모바일 버전 소개팅 시작하기
	function m_blind_start(){

		//모바일 로그인 체크
		user_check(null,9,'exit');

		$cnt = $this->today_blind();		//오늘 소개팅 했는지 여부 확인

		if($cnt > 0){
			echo "1";		//오늘은 이미 소개팅 받음(다음 기회에)
		}else{
			$data = $this->blind_data_call();
			echo "0";		//소개팅 insert 완료
		}	
		
	}


	function call_tabmenu($tab_menu){
		//상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $tab_menu){
				$data["tap_menu_css_$i"]  = "tab_on";
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";
			}
		}

		ob_start();
		
		$this->load->view('blindmeet/blind_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu2($num){
		//소개팅 > 좋아요 관리함 탭메뉴

		for($i=1;$i<10;$i++){

				if($i == $num){
					$data["tap_menu_css2_$i"]  = "bg_36c8e9 color_fff";			
				}else{
					$data["tap_menu_css2_$i"]  = "bg_e7e7e7 color_666";				
				}
		}

		ob_start();
		
		$this->load->view('blindmeet/blind_like_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function request_popup(){
		//좋아요 레이어팝업 AJAX

		$idx	= urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx'))); if(!$idx){exit;}

		$search['m_num']	= $idx;
		$data['good_pop']	= $this->my_m->row_array('TotalMembers', $search, "", "desc");	

		$top_data['add_css'] = array("layer_popup/ilike_css");
		$top_data['add_js'] = array("layer_popup/ilike_js");
		$top_data['add_title'] = "좋아요 보내기";
		$top_data['add_text'] = "";

		$this->good_request($data);

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/ilike_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}
	
	//좋아요 보내기
	function good_request($info){

		$search['s_userid'] = $this->session->userdata('m_userid');
		$search['r_userid'] = $info['good_pop']['m_userid'];

		$good_recnt = $this->my_m->cnt('blind_history', $search);

		// 좋아요를 보낸적이 있으면 업데이트
		if ($good_recnt > 0) {

			$arr_data = array(
					's_time'	 => NOW
			);

			$this->my_m->update('blind_history', $search, $arr_data);

		// 좋아요를 보낸적이 없으면 인서트
		}else{

			$arr_data = array(
				's_userid'	 => $this->session->userdata('m_userid'),
				's_useridx'	 => $this->session->userdata('m_num'),
				'r_userid'	 => $info['good_pop']['m_userid'],
				'r_useridx'	 => $info['good_pop']['m_num'],
				's_time'	 => NOW
			);

			$this->my_m->insert('blind_history', $arr_data);

		}
		
		//소개팅 좋아요 알림보내기 alrim_helper
		joyhunting_alrim("소개팅좋아요", $info['good_pop']['m_userid'], $this->session->userdata['m_userid']);

	}

	function mylike_list($tabmenu,$page_name)
	{	
		//좋아요관리함 리스트 (공통 사용)
		user_check(null,9);

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);


		if($tabmenu == '1'){	//받은 좋아요
			$search['r_userid'] = $this->session->userdata('m_userid');
			$m_result = $this->blind_m->re_se_good($start, $rp, @$search, 'blind_history', 'b_idx', 'r_userid', 'desc');

		}else if($tabmenu == '2'){	//보낸 좋아요
			$search['s_userid'] = $this->session->userdata('m_userid');
			$m_result = $this->blind_m->re_se_good($start, $rp, @$search, 'blind_history', 's_time', 'r_userid', 'desc');

		}else{
			$m_result = $this->blind_m->together_good($start, $rp, @$search, 'blind_history');

			$asdf = count($m_result[0]);
			for ($i=0; $i<$asdf; $i++){

				$search['m_userid'] = $m_result[0][$i]['r_userid'];
				$data['together'][$i] = $this->my_m->row_array('TotalMembers', $search);
				$data['user_info'] = $data['together'][$i]['m_userid'];
			}
		}
		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit),'/page','pagination2');

		//view 설정
		$navs = array('홈','소개팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('blind_date',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('blind_like'); //우측메뉴 로딩

		$top_data['add_css'] = array("blindmeet/blindmeet_css");
		$top_data['add_js'] = array("blindmeet/blindmeet_js");
		
		$data['call_tabmenu'] = $this->call_tabmenu(2); //탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2($tabmenu); //소개팅 > 좋아요관리함 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('blindmeet/'.$page_name, $data);
		$this->load->view('bottom_v');
	}

	function recv_like()
	{
		$this->mylike_list($tabmenu = 1, "recv_like_v"); //받은 좋아요
	}

	function send_like()
	{
		$this->mylike_list($tabmenu = 2, "send_like_v"); //보낸 좋아요
	}

	function together_like()
	{
		$this->mylike_list($tabmenu = 3, "together_like_v"); //서로 좋아요
	}

	// 마우스오버 정보뿌리기
	function user_info(){

		$search['m_num']	= strip_tags(rawurldecode($this->input->post('user',TRUE)));
		
		$result = $this->my_m->row_array('TotalMembers', $search, "", "desc");

		$birth1 = substr($result['m_jumin1'], 0, 2);
		$birth2 = substr($result['m_jumin1'], 2, 2);
		$birth3 = substr($result['m_jumin1'], 4, 2);
		
		$arrData = array(
			"m_userid"		=> $result['m_userid'],
			"m_nick"		=> $result['m_nick'],
			"m_birthday"	=> "19".$birth1.".".$birth2.".".$birth3,
			"m_conregion"	=> $result['m_conregion'],
			"m_conregion2"	=> $result['m_conregion2'],
			"m_character"	=> talk_style_data($result['m_character']),
			"m_reason"		=> want_reason_data($result['m_reason'])
		);

		echo json_encode(@$arrData);
	}

	// 상대방 알아보기 서로좋아요인지 체크
	function id_show(){

		$search['m_num']	= strip_tags(rawurldecode($this->input->post('idx',TRUE)));
		$together_check = $this->my_m->row_array('TotalMembers', $search);

		$user_id	 = $together_check['m_userid']; // 상대방아이디
		$my_id		 = $this->session->userdata('m_userid'); //내 아이디

		$together = $this->blind_m->togeter_check('blind_history',$user_id,$my_id);

		if ($together > 0){ // 서로 좋아요일 경우

			echo $user_id;

		}else{	// 서로 좋아요가 아니면

			echo "9";
		}
	}
	
	//한명더 소개받기
	function one_more(){
		
		//한명더 소개받기 업데이트
		$m_result = $this->call_one_more();

		$today_list	 = $m_result[0];		//소개팅 추가 한명더
		$rtn		 = $m_result[1];		//업데이트 성공여부
		
		$list = $today_list[0];
		
		$blind_info = '<div class="today_list" id="today_list_4" onmouseover="javascript:today_over(\''.$list['b_mb_num'].'\',\'4\');">
				  <div class="pointer">'.$this->member_lib->member_thumb($list['b_mb'],131,172).'</div>
				  <div class="text_btn_36c8e9 font-size_16 good_btn" id="good_4" onclick="ilike_check(\''.$list['b_mb_num'].'\');">
					<img src="'.IMG_DIR.'/blindmeeting/good_heart.png" class="ver_top">좋아요</div></div>';
		
		echo $blind_info;

	}

	//한명더 소개받기 모바일
	function m_one_more(){

		//한명더 소개받기 업데이트
		$m_result = $this->call_one_more();

		$today_list	 = $m_result[0];		//소개팅 추가 한명더
		$rtn		 = $m_result[1];		//업데이트 성공여부

		$list = $today_list[0];

		//추가 소개팅 회원의 정보 가져오기
		$m_data = $this->member_lib->get_member($list['b_mb']);

		$blind_info = "
			<div class='blind_thum'>
				".$this->member_lib->member_thumb($m_data['m_userid'], 200, 200)."
			</div>
			<div class='blind_text'>
				<p>".$m_data['m_nick']." <span class='color_999'>".$m_data['m_age']."세</span></p>
				<p class='color_666'>".$m_data['m_conregion']." ".$m_data['m_conregion2']." | ".want_reason_data($m_data['m_reason'])."</p>
			</div>
			<div class='blind_good_btn' onclick='javascript:m_ilike_check(".$m_data['m_num'].");'>
				<img src='".IMG_DIR."/m/good_ic.png'> 좋아요
			</div>
		";

		echo $blind_info;

	}

	//한명더 소개받기 업데이트(공통)
	function call_one_more(){

		$search['b_id'] = $this->session->userdata('m_userid');
		
		if(date("G") >= "9"){
			$search['ex_b_today'] = "b_today >= '".TODAY." 09:00:00' and b_today < '".date('Y-m-d', strtotime('+1 day'))." 09:00:00' ";		
		}else{
			$search['ex_b_today'] = "b_today < '".TODAY." 09:00:00' and b_today >= '".date('Y-m-d', strtotime('-1 day'))." 09:00:00' ";
		}

		$blind_list = $this->my_m->result_array('blind_cnt', $search, 'b_idx', 'desc', '1');
		
		$rtn = $this->my_m->update('blind_cnt', $search, array("b_more_cnt" => "1"));
		
		return array($blind_list, $rtn);

	}

	//랜덤 4명 회원 소개팅
	function blind_data_call(){

		$search_id['b_id'] = $search['m_userid'] = $this->session->userdata('m_userid');
		$search2['m_sex'] = reverse_sex($this->session->userdata('m_sex'));		//반대성별(search_helper)

		$check_my_age = $this->session->userdata('m_age');
		$check_my_userid = $this->session->userdata('m_userid');

		// rand 쿼리부분
		$data['today_list'] = $this->blind_m->check_meet($check_my_age,$check_my_userid,$search2);
		
		for($i=0; $i<4; $i++){
			$today_array = array(
					'b_id'			=> $this->session->userdata('m_userid'),
					'b_today'		=> NOW,
					'b_mb'			=> $data['today_list'][$i]['m_userid'], 
					'b_mb_num'		=> $data['today_list'][$i]['m_num']
			);
			$this->my_m->insert('blind_cnt', $today_array);
		}

		return $data;
	}

	//오늘 소개팅을 클릭했는지 여부 확인
	function today_blind(){

		$to_day		= date('Y-m-d')." 09:00:00";								//오늘 09시 기준
		$next_day	= date('Y-m-d', strtotime('+1 day'))." 09:00:00";			//내일 09시 기준
		
		$search = array(
			"b_id"				=> $this->session->userdata['m_userid'],
			"ex_b_today1"		=> "b_today > '".$to_day."' ",
			"ex_b_today2"		=> "b_today < '".$next_day."' "
		);

		$rtn = $this->my_m->cnt('blind_cnt', $search);

		return $rtn;
	}

	//현재시간에 따라서 데이터 불러오기(매일 오전 9시 기준)
	//$val이 time일 경우 리스트 가져오기, more일경우 한번더 조건이 일치하는지 여부 가져오기
	function today_am_nine($val){
		
		$search['b_id'] = $this->session->userdata['m_userid'];

		if(date("G") >= "9"){
			$search['ex_b_today'] = "b_today >= '".TODAY." 09:00:00' and b_today < '".date('Y-m-d', strtotime('+1 day'))." 09:00:00' ";		
		}else{
			$search['ex_b_today'] = "b_today < '".TODAY." 09:00:00' and b_today >= '".date('Y-m-d', strtotime('-1 day'))." 09:00:00' ";
		}
		
		if($val == "time"){
			return $this->my_m->result_array('blind_cnt', $search, 'b_idx', 'asc');
		}else if($val == "more"){
			$search['b_more_cnt'] = "1";
			return $this->my_m->cnt('blind_cnt', $search);
		}

		

	}
	

	//모바일 좋아요 관리함
	function mylike_list_mobile($tabmenu, $page_name){

		//모바일 로그인 체크
		user_check();

		//페이징 변수
		$page = $this->pre_paging();
		$data['rp'] = $rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		if($tabmenu == "1"){
			//받은 좋아요
			$search['r_userid'] = $this->session->userdata('m_userid');
			$m_result = $this->blind_m->re_se_good($start, $rp, @$search, 'blind_history', 'b_idx', 'r_userid', 'desc');
		}else if($tabmenu == "2"){
			//보낸 좋아요
			$search['s_userid'] = $this->session->userdata('m_userid');
			$m_result = $this->blind_m->re_se_good($start, $rp, @$search, 'blind_history', 's_time', 'r_userid', 'desc');
		}else if($tabmenu == "3"){
			//서로 좋아요
			$m_result = $this->blind_m->together_good($start, $rp, @$search, 'blind_history');

			$asdf = count($m_result[0]);
			for ($i=0; $i<$asdf; $i++){

				$search['m_userid'] = $m_result[0][$i]['r_userid'];
				$data['together'][$i] = $this->my_m->row_array('TotalMembers', $search);
				$data['user_info'] = $data['together'][$i]['m_userid'];
			}
		}else{
			alert_goto('잘못된 접근입니다.', '/');
		}

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $total = $m_result[1];
		
		$row = $total/2;
		
		if(strpos($row, '.')){
			//좋아요의 갯수가 홀수일경우
			$max_row = explode('.', $row);
			$data['max_row'] = $max_row[0];
			$data['dot'] = "null";
		}else{
			//좋아요의 갯수가 짝수일경우
			$data['max_row'] = $row;
			$data['dot'] = "";
		}

		//view 설정
		$top_data['add_css'] = array("/m/m_blind_set_css");
		$top_data['add_js'] = array("/m/m_blind_set_js", "/m/m_blindmeet_js");
		
		$data['call_tabmenu'] = $this->call_tabmenu_mobile($tabmenu); //소개팅 > 좋아요관리함 탭메뉴

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"좋아요 관리함"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/blindmeet/m_'.$page_name, @$data);
		$this->load->view('m/m_bottom0_v');

	}

	function call_tabmenu_mobile($num){
		//소개팅 > 좋아요 관리함 탭메뉴

		for($i=1;$i<10;$i++){

				if($i == $num){
					$data["tap_menu_css_$i"]  = "color_ea3c3c";			
				}else{
					$data["tap_menu_css_$i"]  = "color_333";				
				}
		}

		ob_start();
		
		$this->load->view('m/top_menu/m_blind_like_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	function recv_like_mobile()
	{
		$this->mylike_list_mobile($tabmenu = 1, "recv_like_v"); //받은 좋아요
	}

	function send_like_mobile()
	{
		$this->mylike_list_mobile($tabmenu = 2, "send_like_v"); //보낸 좋아요
	}

	function together_like_mobile()
	{
		$this->mylike_list_mobile($tabmenu = 3, "together_like_v"); //서로 좋아요
	}


	//소개팅 좋아요 정회원만 보내기 처리
	function ilike_v(){

		$user_id = $this->session->userdata['m_userid'];

		$member_data = $this->member_lib->get_member($user_id);

		echo $member_data['m_type'];
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */