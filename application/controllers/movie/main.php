<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index()
	{
		$navs = array('홈','최신영화'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('movie',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('movie'); //우측메뉴 로딩

		$top_data['add_css'] = array("movie/movie_css");
		$top_data['add_js'] = array("movie/movie_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('movie/movie_v', $data);
		$this->load->view('bottom_v');
	}

	function movie_request_popup(){
	//내 관람내역 레이어팝업 AJAX
	user_check();

	$top_data['add_css'] = array("layer_popup/movie_css");
	$top_data['add_js'] = array("layer_popup/marriage_js");
	$top_data['add_title'] = "내 관람내역";
	$top_data['add_text'] = "";

	$this->load->view('layer_popup/popup_top_v',$top_data);
	$this->load->view('layer_popup/movie_list_v',@$data);
	$this->load->view('layer_popup/popup_bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/ */