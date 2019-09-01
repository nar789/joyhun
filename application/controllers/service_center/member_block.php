<?php

class Member_block extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}


	//차단 알림 레이어팝업
	function block_popup_layer(){

		$idx	= $this->security->xss_clean(@url_explode($this->seg_exp, 'idx'));
		$reg_hp = $this->security->xss_clean(@url_explode($this->seg_exp, 'reg_hp'));

		$data['block_data'] = $block_data = $this->my_m->row_array('MEMBER_BLOCK_LIST', array('IDX' => $idx), 'IDX', 'DESC', '1');
		
		//데이터가 없을경우 메인으로 이동
		if(empty($block_data)){ goto('/'); }

		if($block_data['GUBN'] == "HP"){
			$add_title = "귀하의 휴대전화번호는 접속이 제한되었습니다.";
			$data['GUBN'] = "휴대전화번호";
		}else if($block_data['GUBN'] == "IP"){
			$add_title = "귀하의 아이피는 접속이 제한되었습니다.";
			$data['GUBN'] = "아이피";
		}

		$top_data['add_js'] = "";
		$top_data['add_title'] = $add_title;
		$top_data['add_text'] = "";
		
		if($reg_hp == "ok"){
			//회원가입시 휴대전화번호 차단처리
			$data['add_title'] = $add_title;

			$this->load->view('top0_v');
			$this->load->view('service_center/member_block_pop_v', @$data);
			$this->load->view('bottom0_v');
		}else{
			$this->load->view('layer_popup/popup_top_v', $top_data);
			$this->load->view('layer_popup/member_block_alrim_v', @$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}		

	}
	


}

/* End of file main.php */
/* Location: ./application/controllers/*/

