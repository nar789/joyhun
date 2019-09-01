<?php

class Chat_time extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();
	}

	function setting(){	// 채팅신청 시간셋팅

		$data['preference'] = $this->my_m->row_array("admin_setting", array('idx' => 1) );

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/auto_text_list/chat_time_setting_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	function setting_mod(){	//채팅시간 적용

		$data = array(
			'chat_time_1'		=> rawurldecode($this->input->post('chat_time_1',TRUE)),
			'chat_time_2'		=> rawurldecode($this->input->post('chat_time_2',TRUE)),
			'chat_time_3'		=> rawurldecode($this->input->post('chat_time_3',TRUE)),
			'chat_time_4'		=> rawurldecode($this->input->post('chat_time_4',TRUE)),
			'chat_time_5'		=> rawurldecode($this->input->post('chat_time_5',TRUE)),
			'chat_time_6'		=> rawurldecode($this->input->post('chat_time_6',TRUE)),
			'chat_time_7'		=> rawurldecode($this->input->post('chat_time_7',TRUE)),
			'chat_time_8'		=> rawurldecode($this->input->post('chat_time_8',TRUE)),
			'chat_time_9'		=> rawurldecode($this->input->post('chat_time_9',TRUE)),
			'chat_time_10'		=> rawurldecode($this->input->post('chat_time_10',TRUE)),
			'chat_style_1'		=> rawurldecode($this->input->post('chat_style_1',TRUE)),
			'chat_style_2'		=> rawurldecode($this->input->post('chat_style_2',TRUE)),
			'chat_style_3'		=> rawurldecode($this->input->post('chat_style_3',TRUE)),
			'chat_style_4'		=> rawurldecode($this->input->post('chat_style_4',TRUE)),
			'chat_style_5'		=> rawurldecode($this->input->post('chat_style_5',TRUE)),
			'chat_style_6'		=> rawurldecode($this->input->post('chat_style_6',TRUE)),
			'chat_style_7'		=> rawurldecode($this->input->post('chat_style_7',TRUE)),
			'chat_style_8'		=> rawurldecode($this->input->post('chat_style_8',TRUE)),
			'chat_style_9'		=> rawurldecode($this->input->post('chat_style_9',TRUE)),
			'chat_style_10'		=> rawurldecode($this->input->post('chat_style_10',TRUE)),
			'popup_time_1'		=> rawurldecode($this->input->post('popup_time_1',TRUE)),
			'popup_time_2'		=> rawurldecode($this->input->post('popup_time_2',TRUE)),
			'popup_time_3'		=> rawurldecode($this->input->post('popup_time_3',TRUE)),
			'popup_time_4'		=> rawurldecode($this->input->post('popup_time_4',TRUE)),
			'popup_time_5'		=> rawurldecode($this->input->post('popup_time_5',TRUE)),
			'popup_time_6'		=> rawurldecode($this->input->post('popup_time_6',TRUE)),
			'v_popup_time_1'	=> rawurldecode($this->input->post('v_popup_time_1',TRUE)),
			'v_popup_time_2'	=> rawurldecode($this->input->post('v_popup_time_2',TRUE)),
			'v_popup_time_3'	=> rawurldecode($this->input->post('v_popup_time_3',TRUE)),
			'v_popup_time_4'	=> rawurldecode($this->input->post('v_popup_time_4',TRUE)),
			'v_popup_time_5'	=> rawurldecode($this->input->post('v_popup_time_5',TRUE)),
			'v_popup_time_6'	=> rawurldecode($this->input->post('v_popup_time_6',TRUE)),
			'v_popup_time_7'	=> rawurldecode($this->input->post('v_popup_time_7',TRUE)),
			'v_popup_time_8'	=> rawurldecode($this->input->post('v_popup_time_8',TRUE)),
			'v_popup_time_9'	=> rawurldecode($this->input->post('v_popup_time_9',TRUE)),
			'v_popup_time_10'	=> rawurldecode($this->input->post('v_popup_time_10',TRUE)),
			'v_popup_time_11'	=> rawurldecode($this->input->post('v_popup_time_11',TRUE)),
			'v_popup_time_12'	=> rawurldecode($this->input->post('v_popup_time_12',TRUE)),
			'v_popup_time_13'	=> rawurldecode($this->input->post('v_popup_time_13',TRUE))
		);

		$rtn = $this->my_m->update("admin_setting", array('idx' => 1), $data);

		echo $rtn;

	}

}