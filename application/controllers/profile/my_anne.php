<?php

class My_anne extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}

	function ma_anne($tabmenu,$setting_num)
	{

		user_check();

		//변수
		$v_table = 'T_MakeFriend_List';		
		$order_filed = 'm_idx';				
		if($tabmenu == "1"){ 
			$m_userid = 'm_fuserid'; 
			$search[$v_table.'.m_userid'] = $this->session->userdata['m_userid'];

			$data['f'] = "";

		}else{ 
			$m_userid = 'm_userid';
			$search[$v_table.'.m_fuserid'] = $this->session->userdata['m_userid'];

			$data['f'] = "f";
		}

		$search['m_gubun'] = "앤";		//구분값
		

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);	
		
		$result = $this->my_m->get_list($start, $rp, $search, $v_table, $order_filed, $m_userid);

		$data['mlist'] = $result[0];
		$data['getTotalData']=$total= $result[1];
		
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		$navs = array('프로필','친구'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_anne_js","profile/profile_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //내 앤 탭메뉴
		$data['call_setting'] = $this->call_setting($setting_num); //내 앤 > 선택한 앤을

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/my_anne_v', @$data);
		$this->load->view('bottom_v');

	}

	function send_anne()
	{
		$this->ma_anne(1,1); //내가 등록한 앤
	}
	function receive_anne()
	{
		$this->ma_anne(2,2); //나를 등록한 앤
	}

	function call_tabmenu($num){
		//내 앤 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('profile/my_anne_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_setting($setting_num){
		//내 앤 > 선택한 앤을
		ob_start();

		$data["style"] = $setting_num;
		
		$this->load->view('profile/my_anne_settingmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	//선택 앤 삭제
	function chk_remove_anne(){
		
		$v_table = "T_MakeFriend_List";

		$data['m_idx']		= rawurldecode($this->input->post('m_idx', true));			//순번
		
		$arr_data = array(

			"m_idx"			=> $data['m_idx'],
			"m_userid"		=> $this->session->userdata['m_userid']

		);

		//(찜, 앤, 친구) 삭제 전에 인기지수 -10 하기
		$member_data = $this->my_m->row_array('T_MakeFriend_List', array('m_idx' => $data['m_idx']));

		//(찜, 앤, 친구)등록시 인기점수 -10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
		member_popularity('2', $member_data['m_fuserid'], '10');

		$rtn = $this->my_m->del($v_table, $arr_data);

		echo $rtn;

	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/