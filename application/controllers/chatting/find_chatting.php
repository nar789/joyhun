<?php

class Find_chatting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function main_list($tab_menu)
	{
		
		//로그인 여부 체크
		user_check(null,0);

		$data['mode'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));			//(1:원클릭 상대찾기, 2:회원상세찾기)
		$data['top_text'] = "";

		//검색조건
		if($data['mode'] == "1"){
			//원클릭 상대찾기
			$data['chk1'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chk1')));		//동일한 나이대
			$data['chk2'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chk2')));		//동일한 지역
			$data['chk3'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chk3')));		//동일한 관심사
			$data['chk4'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chk4')));		//사진있는 회원

			//검색 checkbox checked 기능
			for($i=1; $i<5; $i++){
				if($data['chk'.$i] == "on"){ $data['v_check'.$i] = "checked"; }else{ $data['v_check'.$i] = ""; }
			}

			$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);		//회원정보 가져오기
			
			//탭메뉴 위에 텍스트만들기
			$data['top_text'] = "<b class='ont-size_14'>동일한&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>";

			//동일한 나이대 검색
			if($data['chk1'] == "on"){
				$v_age1 = substr($member_data['m_age'], 0, 1)."0";
				$v_age2 = $v_age1 + 10;
				$search['ex_m_age'] = "AA.m_age >= '".$v_age1."' and AA.m_age < '".$v_age2."' ";
				$data['top_text'] = $data['top_text']."[나이]&nbsp;";
			}
		
			//동일한 지역 검색
			if($data['chk2'] == "on"){ 
				$search['AA.m_conregion']	= $member_data['m_conregion']; 
				$data['top_text'] = $data['top_text']."[지역]&nbsp;";
			}

			//동일한 관심사 검색
			if($data['chk3'] == "on"){ 
				$search['AA.m_reason']		= $member_data['m_reason']; 
				$data['top_text'] = $data['top_text']."[관심사]&nbsp;";
			}				

			//사진있는 회원 검색
			if($data['chk4'] == "on"){ 
				$search['ex_m_filename']	= "AA.m_filename is not null";
				$search['ex_m_filename2']	= "AA.m_filename != ''";
				$data['top_text'] = $data['top_text']."[사진있는 회원]&nbsp;";
			}				
			
			$data['top_text'] = $data['top_text']."</span> 접속회원</b>";
			
		}else if($data['mode'] == "2"){
			//회원 상세찾기
			$data['wanna_age']		 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val1')));											//원하는 나이대
			$data['conregion']		 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val2')));											//원하는 지역

			$data['want_reason']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val3')));			//원하는 만남
			if($data['want_reason']){
				$search['AA.m_reason']	= $data['want_reason'];
			}
			$data['character_text']	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val4')));			//대화 스타일
			if($data['character_text']){
				$search['AA.m_character']	= $data['character_text'];
			}
			
			//원하는 나이대 검색
			if($data['wanna_age'] <> "00"){
				$v_age = $data['wanna_age'] + 10;
				$search['ex_m_age'] = "AA.m_age >= '".$data['wanna_age']."' and AA.m_age < '".$v_age."' ";
			}
			
			//원하는 지역
			if($data['conregion'] == "00"){
				$search['AA.m_conregion'] = "";		//상관없음
			}else{
				$search['AA.m_conregion'] = $data['conregion'];
			}
			
			//탭메뉴 위에 텍스트만들기
			if($data['wanna_age']){
				if($data['wanna_age'] == "00"){
					$data['top_text'] = "<b class='ont-size_14'>나이&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[전체]</span>&nbsp;";
				}else{
					$data['top_text'] = "<b class='ont-size_14'>나이&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".$data['wanna_age']."대]</span>&nbsp;";
				}
			}
			if($data['conregion']){
				if($data['conregion'] == "00"){
					$data['top_text'] = $data['top_text']."지역&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[상관없음]</span>&nbsp;";
				}else{
					$data['top_text'] = $data['top_text']."지역&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".$data['conregion']."]</span>&nbsp;";
				}
			}
			if($data['want_reason']){
				$data['top_text'] = $data['top_text']."원하는 만남&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".want_reason_data($data['want_reason'])."]</span> 접속회원</b>";
			}

		// 메인에서 넘어온 "나는 원해요"
		}else if ($data['mode'] == "3"){

			$data['m_age']			 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'se_age')));
			$search['AA.m_conregion'] = $data['m_conregion']	 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'se_area')));
			$data['m_sex']			 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'se_sex')));
			$search['AA.m_reason'] = $data['m_reason']		 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'se_re')));

			//나이
			if($data['m_age'] <> "70"){
				$v_age = $data['m_age'] + 4;
				$search['ex_m_age'] = "AA.m_age >= '".$data['m_age']."' and AA.m_age <= '".$v_age."' ";
			}else{
				$search['ex_m_age'] = "AA.m_age >= '".$data['m_age'];
			}

			//성별
			if($data['m_age'] <> "A"){
				$search['AA.m_sex'] = '';
			}else{
				$search['AA.m_sex'] = $data['m_sex'];
			}

			//탭메뉴 위에 텍스트만들기
			if($data['m_age']){
				if($data['m_age'] == "70"){
					$data['top_text'] = "<b class='ont-size_14'>나이&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[70대 이상]</span>&nbsp;";
				}else{
					$data['top_text'] = "<b class='ont-size_14'>나이&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".$data['m_age']." ~ ".$v_age."세]</span>&nbsp;";
				}
			}
			if($data['m_conregion']){
				$data['top_text'] = $data['top_text']."지역&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".$data['m_conregion']."]</span>&nbsp;";
			}
			if($data['m_sex']){
				if ($data['m_sex'] == "A"){
					$data['top_text'] = $data['top_text']."성별&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[모든 분]</span>&nbsp;";
				}else if ($data['m_sex'] == "M"){
					$data['top_text'] = $data['top_text']."성별&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[남성]</span>&nbsp;";
				}else if ($data['m_sex'] == "F"){
					$data['top_text'] = $data['top_text']."성별&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[여성]</span>&nbsp;";
				}
			}
			if($data['m_reason']){
				$data['top_text'] = $data['top_text']."원하는 만남&nbsp;&nbsp;<span class='color_ea3c3c font-size_14'>[".want_reason_data($data['m_reason'])."]</span> 접속회원</b>";
			}
			
		}


		
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		//페이지가 1일경우만 캐시적용
		if($page == "1"){
			if(!$m_result = $this->cache->get('TotalMembers_login.find_chatting')){
				$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
				$this->cache->save('TotalMembers_login.find_chatting', $m_result, 600);	//10분 캐시 사용
			}
		}else{
			$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
		}
		

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$navs = array('조이채팅','채팅상대찾기'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('blind_talk'); //우측메뉴 로딩

		$top_data['add_css'] = array("chatting/chatting_css");
		$top_data['add_js'] = array("chatting/find_chatting_js");
		
		$data['call_top'] = $this->call_top($data); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu($tab_menu); //탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('chatting/find_chatting_v', $data);
		$this->load->view('bottom_v');
	}

	function index(){
		$this->main_list(1);	//최근 접속순
	}

	function order_join_date(){
		$this->main_list(2);	//최근 가입순
	}

	function order_activity_v(){
		$this->main_list(3);	//활동량 많은순
	}

	function order_activity_cnt(){
		$this->main_list(4);	//활동현황순
	}

	function order_like_cnt(){
		$this->main_list(5);	//인기 지수순
	}

	function order_manner(){
		$this->main_list(6);	//매너 점수순
	}


	function call_top($data){
		//본문 상단
		ob_start();
		
		$this->load->view('/chatting/find_chatting_top_v', @$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
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
		
		$this->load->view('/chatting/find_chatting_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */