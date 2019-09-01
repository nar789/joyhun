<?php

class Invite extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}

	function main_list($tab_menu)
	{	
		//로그인 여부 체크
		user_check(null,0);

		//파라미터 변수 받기
		$data['val1'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val1')));		//지역
		$data['val2'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val2')));		//나이
		$data['val3'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val3')));		//성별

		//검색조건
		if($data['val1']){ $search['AA.m_conregion'] = $data['val1']; }
		if($data['val2']){
			if($data['val2'] == "00"){
				$search['AA.m_age'] = "";											//전체
			}else if($data['val2'] == "1020"){
				$search['ex_m_age'] = "AA.m_age >= '10' and AA.m_age <= '29' ";		//10대 ~ 20대
			}else if($data['val2'] == "30"){
				$search['ex_m_age'] = "AA.m_age >= '30' and AA.m_age <= '39' ";		//30대
			}else if($data['val2'] == "40"){
				$search['ex_m_age'] = "AA.m_age >= '40' and AA.m_age <= '49' ";		//40대
			}else if($data['val2'] == "50"){
				$search['ex_m_age'] = "AA.m_age >= '50' ";							//50대 이상
			}
		}
		if($data['val3']){ $search['AA.m_sex'] = $data['val3']; }

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);

		//페이지가 1일경우만 캐시적용
		if($page == "1"){
			if(!$m_result = $this->cache->get('TotalMembers_login.invite')){
				$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
				$this->cache->save('TotalMembers_login.invite', $m_result, 600);	//10분 캐시 사용
			}
		}else{
			$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
		}

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$navs = array('조이채팅','이상형초대'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('photo_meeting'); //우측메뉴 로딩

		$top_data['add_css'] = array("chatting/chatting_css");
		$top_data['add_js'] = array("chatting/invite_chatting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu($tab_menu); //탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('chatting/invite_chatting_v', $data);
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


	function call_top(){
		//본문 상단
		ob_start();
		
		$this->load->view('chatting/invite_chatting_top_v');

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
		
		$this->load->view('chatting/invite_chatting_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



	function invite_popup(){
		//이상형초대하기 레이어팝업 AJAX

		//로그인 여부 체크
		user_check();

		$data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));		//회원 보유 포인트

		$top_data['add_css'] = array("layer_popup/invite_css");
		$top_data['add_js'] = array("layer_popup/invite_js");
		$top_data['add_title'] = "이상형 초대하기";
		$top_data['add_text'] = "";

		$data['add_text'] = "";
		if($data['m_conregion']){ $data['add_text'] = $data['m_conregion'];	}
		if($data['m_conregion2']){ $data['add_text'] .= " / ".$data['m_conregion2'];	}
		if($data['m_age']){	$data['add_text'] .= " / ".$data['m_age']."세";	}

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/invite_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


	function nick_chage(){

		$nick = rawurldecode($this->input->post('nick_ary',TRUE));

		$nick_array =explode(',' , $nick);

		$nick_ary_cnt = count($nick_array);
		$final_id = '';

		for ($i=0; $i<$nick_ary_cnt; $i++){

			// 가져온 nick값으로 id검색
			$search['m_nick'] = $nick_array[$i];
			${'check_mb'.$i} = $this->my_m->row_array('TotalMembers', $search);

			//배열에 저장
			if ($i == $nick_ary_cnt-1){
				$final_id .= ${'check_mb'.$i}['m_userid'];
			}else{
				$final_id .= ${'check_mb'.$i}['m_userid'].',';
			}

		}

		echo $final_id;

	}





}

/* End of file main.php */
/* Location: ./application/controllers/ */