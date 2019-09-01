<?php

class Rank extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');

	}

	//모바일 랭킹정보 메인
	function rank_info()
	{

		$top_data['add_css'] = array("layer_popup/rank_css");
		$top_data['add_js'] = array("layer_popup/friend_add_popup_js");
		$top_data['add_title'] = "조이헌팅 멤버십 정보";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);

		if(IS_MOBILE == TRUE){
			$this->load->view('layer_popup/m_rank_v', @$data);
		}else{
			$this->load->view('layer_popup/rank_v', @$data);
		}

		$this->load->view('layer_popup/popup_bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/ */