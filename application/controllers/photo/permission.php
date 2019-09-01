<?php

class Permission extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('photo_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index()
	{
		$this->permission_list(1);
	}

	function permission_list($tabmenu)
	{
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		//파라미터 받기
		$search['m_conregion']	 = $search_data['m_conregion']	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'conregion')));
		$search['m_reason']		 = $search_data['m_reason']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'reason')));
		$search_data['m_age']	 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'age')));		

		if($search_data['m_age'] <> ""){
			if($search_data['m_age'] == "20"){ $search['ex_m_age'] = "m_age >= 20 and m_age <= 29"; }
			if($search_data['m_age'] == "30"){ $search['ex_m_age'] = "m_age >= 30 and m_age <= 39"; }
			if($search_data['m_age'] == "40"){ $search['ex_m_age'] = "m_age >= 40 and m_age <= 49"; }
			if($search_data['m_age'] == "50"){ $search['ex_m_age'] = "m_age >= 50"; }
		}
		
		
		if($tabmenu == "1"){ $v_order_by = "pic_w_date"; }					//신규사진 인증회원
		if($tabmenu == "2"){ $v_order_by = "last_login_day"; }				//최근 로그인한 인증회원
		if($tabmenu == "3"){ $v_order_by = "m_filename_update"; }			//최근 사진변경회원

		search_sex($data, $search, "TotalMembers_login", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$m_result = $this->photo_m->photo_list($start, $rp, $search, "member_pic", $v_order_by);		//사진 인증회원 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $total = $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));
		
		//view 설정
		$navs = array('포토미팅','인증사진'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('photo',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('photo_meeting'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("photo/photo_js");
		
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //포토미팅 탭메뉴
		$data['call_search'] = $this->call_search($search_data); //포토미팅 검색창

		$this->load->view('top_v',$top_data);
		$this->load->view('photo/permission_v', $data);
		$this->load->view('bottom_v');

	}

	function new_photo()
	{
		$this->permission_list(1); //신규사진 인증회원
	}

	function login()
	{
		$this->permission_list(2); //최근 로그인한 인증회원
	}

	function change()
	{
		$this->permission_list(3); //최근 사진변경회원
	}
	
	function call_tabmenu($num){
		//인증사진 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('photo/permission_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_search($search_data){
		//인증사진 검색
		ob_start();

		$this->load->view('photo/permission_search_v', $search_data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



}

/* End of file main.php */
/* Location: ./application/controllers/*/