<?php

class Propose extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
	}

	function ma_propose($tabmenu, $chatset_sub, $v_mode)
	{

		user_check(null,0);

		$v_table		= "open_marry_propose";		//테이블명
		$order_filed	= "m_idx";					//순서컬림
		
		if($v_mode == "보낸"){
			$m_userid = "m_userid";						//조인멤버아이디(보낸)
			$search[$v_table.'.m_userid'] = $this->session->userdata['m_userid'];
			$data['flag'] = "p";		//보낸 컬럼 앞자리 변수
		}else if($v_mode == "받은"){
			$m_userid		= "p_userid";				//조인멤버아이디(받은)
			$search[$v_table.'.p_userid'] = $this->session->userdata['m_userid'];
			$data['flag'] = "m";		//받은 컬럼 앞자리 변수
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 6; //리스트 갯수
		$limit = 10; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$m_result = $this->my_m->get_list($start, $rp, $search, $v_table, $order_filed, $m_userid, 'desc', 'open_marry_propose.*');		//보낸, 받은 프로포즈 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));
		
		$navs = array('프로필','프로포즈'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_propose_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //프로포즈 탭메뉴

		$data['propose'] = $tabmenu;

		$data['v_mode'] = $v_mode;

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/propose_v', @$data);
		$this->load->view('bottom_v');
	}

	function send_propose()
	{
		$this->ma_propose(1,5, '보낸'); //보낸 프로포즈
	}
	function receive_propose()
	{
		$this->ma_propose(2,6, '받은'); //받은 프로포즈
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
		
		$this->load->view('profile/propose_tabmenu_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



	//선택 프로포즈 삭제
	function propose_del(){

		$m_idx = rawurldecode($this->input->post('m_idx', true));
		
		$rtn = $this->my_m->del('open_marry_propose', array('m_idx' => $m_idx));

		echo $rtn;

	}



}

/* End of file main.php */
/* Location: ./application/controllers/*/