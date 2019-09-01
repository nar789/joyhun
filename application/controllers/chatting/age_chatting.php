<?php

class Age_chatting extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');

	}

	function age_chatting_list($tab_menu)
	{

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu);

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		// view 설정
		$navs = array('실시간채팅','지역/나이채팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("chatting/chatting_css");
		$top_data['add_js'] = array("chatting/age_chatting_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu($tab_menu); //탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('chatting/age_chatting_v', $data);
		$this->load->view('bottom_v');
	}

	function order_login(){
		$this->age_chatting_list(1); //최근 로그인순
	}

	function order_join_date(){
		$this->age_chatting_list(2); //최근 가입순
	}

	function order_activity(){
		$this->age_chatting_list(3); //활동량 많은순
	}

	function order_activity_cnt(){
		$this->age_chatting_list(4); //활동현황순
	}

	function order_like_cnt(){
		$this->age_chatting_list(5); //인기 지수순
	}

	function order_manner(){
		$this->age_chatting_list(6); //매너 점수순
	}


	function call_top(){
		//본문 상단
		ob_start();
		
		$this->load->view('chatting/age_chatting_top_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($tab_menu){
		//상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == 1){  //첫번째의경우 다른 css 사용
				if($i == $tab_menu){
					$data["tap_menu_css_$i"]  = "first-on";			
				}else{
					$data["tap_menu_css_$i"]  = "first-off";			
				}
			}else{
				if($i == $tab_menu){
					$data["tap_menu_css_$i"]  = "etc-on";			
				}else{
					$data["tap_menu_css_$i"]  = "etc-off";			
				}
			}
		}

		ob_start();
		
		$this->load->view('chatting/age_chatting_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



}

/* End of file main.php */
/* Location: ./application/controllers/ */