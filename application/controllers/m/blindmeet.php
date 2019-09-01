<?php

class Blindmeet extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
	}

	function index()
	{
		//view 설정

		//로그인 체크
		user_check();

		$top_data['add_css'] = array("/m/m_blindmeet_css");
		$top_data['add_js'] = array("/m/m_blindmeet_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/blindmeet/m_blindmeet_v',@$data);
		$this->load->view('m/m_bottom0_v');
	}

	function mylike_list($tabmenu,$page_name)
	{

		//view 설정

		$top_data['add_css'] = array("/m/m_blind_set_css");
		$top_data['add_js'] = array("/m/m_blind_set_js");
		
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //소개팅 > 좋아요관리함 탭메뉴

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"좋아요 관리함"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/blindmeet/m_'.$page_name,@$data);
	}

	function call_tabmenu($num){
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


	function recv_like()
	{
		$this->mylike_list($tabmenu = 1,"recv_like_v"); //받은 좋아요
	}

	function send_like()
	{
		$this->mylike_list($tabmenu = 2,"send_like_v"); //보낸 좋아요
	}

	function together_like()
	{
		$this->mylike_list($tabmenu = 3,"together_like_v"); //서로 좋아요
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */