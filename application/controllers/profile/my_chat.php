<?php

class My_chat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_list_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');

		$this->load->config('tank_auth', TRUE);
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}
	
	function test(){
		
	}

	//채팅 리스트
	function chatting_list()
	{	
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		if(IS_MOBILE == true){

			//아이디 받으면 로그인
			$auto_login = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'auto_login')));
			if($auto_login){
			//if($auto_login and ($_SERVER['REMOTE_ADDR'] == "115.23.169.232" or $_SERVER['REMOTE_ADDR'] == "124.61.213.129" or $_SERVER['REMOTE_ADDR'] == "182.222.244.39" or $_SERVER['REMOTE_ADDR'] == "115.23.189.60" or $_SERVER['REMOTE_ADDR'] == "14.33.56.55"  or  $_SERVER['REMOTE_ADDR'] == "221.163.176.88" or substr($_SERVER['REMOTE_ADDR'],0,11) == "118.34.164." or substr($_SERVER['REMOTE_ADDR'],0,10) == "222.99.24." or substr($_SERVER['REMOTE_ADDR'],0,10) == "14.33.132."  or substr($_SERVER['REMOTE_ADDR'],0,9) == "14.33.56."  or substr($_SERVER['REMOTE_ADDR'],0,12) == "211.221.215."  or substr($_SERVER['REMOTE_ADDR'],0,11) == "175.195.95."  or substr($_SERVER['REMOTE_ADDR'],0,8) == "59.12.2."   or substr($_SERVER['REMOTE_ADDR'],0,11) == "118.34.158."  or substr($_SERVER['REMOTE_ADDR'],0,12) == "210.100.160."  or substr($_SERVER['REMOTE_ADDR'],0,11) == "221.163.75." or substr($_SERVER['REMOTE_ADDR'],0,11) == "210.99.164." )){

				//다시 로그인
				$mem = $this->member_lib->get_member($auto_login);
				$this->session->set_userdata(array(
						'm_num'				=> $mem['m_num'],
						'm_userid'			=> $mem['m_userid'],
						'm_name'			=> $mem['m_name'],
						'm_sex'				=> $mem['m_sex'],
						'm_nick'			=> $mem['m_nick'],
						'm_type'			=> $mem['m_type'],
						'm_age'				=> $mem['m_age'],
						'm_conregion'		=> $mem['m_conregion'],
						'm_conregion2'		=> $mem['m_conregion2'],
						'm_type'			=> $mem['m_type'],
						'm_mobile_chk'		=> $mem['m_mobile_chk'],
						'status'			=> 1,
						'm_partner'			=> $mem['m_partner'],
						'm_partner_code'	=> $mem['m_partner_code']
				));
				
				goto("/profile/my_chat/chatting_list/");
				exit;
			}

			//모바일 버전의 경우
			//모바일버전 로그인 체크
			user_check(null,0);

			$this->load->library('m_top_menu_lib');

			$top_data['add_css'] = array("/m/m_chatting_list_css");
			$top_data['add_js'] = array("/m/m_chatting_list_js");

			$page = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
			if(empty($page)){$page = 1;}

			$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

			$bot_data['add_script'] = "<script>get_chatting_data('$page');setTimeout(function() {location.reload();}, 300000);</script>"; //5분마다 새로고침

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/chatting_list/m_chatting_list_v',@$data);
			$this->load->view('m/m_bottom_v', $bot_data);

		}else{

			//PC버전의 경우
			//PC버전 로그인 체크
			user_check(null,0);

			//VIEW 설정

			$navs = array('프로필','채팅함'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

			$page = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
			if(empty($page)){$page = 1;}

			$top_data['add_css'] = array("profile/profile_css");
			$top_data['add_js'] = array("profile/my_chat_js");

			$bot_data['add_script'] = "<script>get_chatting_data('$page');</script>";

			$this->load->view('top_v',$top_data);
			$this->load->view('profile/my_chatting_v', $data);
			$this->load->view('bottom_v', $bot_data);

		}
		
	}

	//채팅리스트(PC, 모바일 공통 ajax)
	function ajax_chatting_list(){	

		//페이징 변수
		$page = $this->pre_paging();
		if(IS_MOBILE == TRUE){
			$rp =15; //리스트 갯수
		}else{
			$rp =15; //리스트 갯수
		}
		
		$limit = 5; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$m_result = $this->chatting_list_m->get_chatting_list_new($rp, $start);			//채팅리스트 모델 수정		

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $total = $m_result[1];
	
		$urls = array("profile", "my_chat", "chatting_list");
		$data['pagination_links'] = pagination($urls, paging($page,$rp,$total,$limit));
		
		$flg = "";
		if(IS_MOBILE == true){ $flg = "m"; }else{ $flg = "p"; }	//ajax view 페이지 flg로 구분

		//ajax의 경우 html이 필요한경우 view 페이지 처리
		$ajax_view = $this->load->view('ajax_view/chatting_list_ajax_'.$flg.'_v', @$data, true);

		echo $ajax_view;	

	}		


	//채팅창 열기 처리
	function chat_room_chk(){
		
		$user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$req_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'req_idx')));

		$member_data = $this->member_lib->get_member($user_id);

		if($member_data['m_sex'] == "M"){
			$this->my_m->update('chat_request', array('idx' => $req_idx), array('status' => '수락'));
			$rtn = "F";
		}else{
			$rtn = "M";
		}

		echo $rtn;
		
	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/