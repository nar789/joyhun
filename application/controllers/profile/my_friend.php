<?php

class My_friend extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}

	function my_friend($tabmenu, $setting_num)
	{

		user_check(null,0);
		
		$data['v_group'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'v_group')));		//그룹이름
	
		//컬럼구분자 
		if($tabmenu == "2"){ 
			$data['f'] = "";
		}else{
			$data['f'] = "f";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =6; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		if($tabmenu == "3"){
			$m_result = $this->profile_m->to_my_friend_list($start, $rp, @$search, 'T_MakeFriend_List', $tabmenu, @$data['v_group']);		//서로등록한친구리스트
		}else{
			$m_result = $this->profile_m->my_friend_list($start, $rp, @$search, 'T_MakeFriend_List', $tabmenu, @$data['v_group']);		//친구리스트

		}
		$data['tabmenu'] = $tabmenu;

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
		
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//q();
		
		
		$navs = array('프로필','친구'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_friend_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //내 친구 탭메뉴
		$data['call_setting'] = $this->call_setting($setting_num, $data); //내 친구 > 선택한친구를

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/my_friend_v', $data);
		$this->load->view('bottom_v');
	}

	function send_friend()
	{
		$this->my_friend(1,1); //내가 등록한 친구
	}
	function receive_friend()
	{
		$this->my_friend(2,2); //나를 등록한 친구
	}
	function together_friend()
	{
		$this->my_friend(3,1); //서로 친구
	}
	function bad_friend()
	{
		$this->my_friend(4,3); //차단 친구
	}

	function call_tabmenu($num){
		//내 친구 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('profile/my_friend_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	function call_setting($setting_num, $data){
		//내 친구 > 선택한친구를
		ob_start();
		
		$data["style"] = $setting_num;		//상단 탭메뉴 구분	
				
		$this->load->view('profile/my_friend_settingmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	//친구들 그룹이동
	function f_group_move(){
		
		user_check(null,0);
		
		$data['m_idx']		 = rawurldecode($this->input->post('m_idx', true));			//순번
		$data['m_gname']	 = rawurldecode($this->input->post('m_gname', true));		//그룹이름
		
		$arr_data = array(

			"m_idx"			=> $data['m_idx'],
			"m_gname"		=> $data['m_gname']
		);
		
		$search['m_idx'] = $data['m_idx'];
		$search['m_userid'] = $this->session->userdata['m_userid'];		

		$rtn = $this->my_m->update('T_MakeFriend_List', $search, $arr_data);

		return $rtn;
		
	}

	//친구들 삭제
	function f_list_remove(){

		user_check(null,0);

		$data['m_idx']		 = rawurldecode($this->input->post('m_idx', true));			//순번

		$arr_data = array(
			"m_idx"			=> $data['m_idx']
		);

		//(찜, 앤, 친구) 삭제 전에 인기지수 -10 하기
		$member_data = $this->my_m->row_array('T_MakeFriend_List', array('m_idx' => $data['m_idx']));

		//(찜, 앤, 친구)등록시 인기점수 -10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
		member_popularity('2', $member_data['m_fuserid'], '10');

		$rtn = $this->my_m->del('T_MakeFriend_List', $arr_data);
		
		echo $rtn;
	}
	
	//나쁜친구 해제
	function remove_bad_friend(){

		user_check(null,0);

		$data['m_idx']		 = rawurldecode($this->input->post('m_idx', true));			//순번

		$arr_data = array(
			"m_idx"			=> $data['m_idx'],
			"m_userid"		=> $this->session->userdata['m_userid'],
			"m_gubun"		=> "나쁜친구"
		);

		$rtn = $this->my_m->del('T_MakeFriend_List', $arr_data);

		return $rtn;
	}



}

/* End of file main.php */
/* Location: ./application/controllers/*/