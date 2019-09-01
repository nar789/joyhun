<?php

class Change_point_pop extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('cookie');
	}


	// 팝업 오픈
	function pop_open()
	{
		if(!IS_LOGIN){ exit;}

		@$chk_id = $this->session->userdata['m_userid'];

		$m_info = $this->member_lib->get_member(@$chk_id);

		// 기준일(2016년 7월 18일) < 이전 회원가입한 정회원 가입자
		if($m_info['m_type'] == 'V' && $m_info['m_in_date'] <= '2016-07-18 23:59:59'){ 

			// 날짜가져오기
			$day_chk = get_cookie('point_change'); 

			// 날짜가 오늘이 아니면 팝업띄우기
			if(@$day_chk != TODAY){

				$change_data = "<div class='changep_pop_bg'>
								<div class='text-right'>
									<img src='".IMG_DIR."/etc/point_close_btn.gif' class='margin_right_19 margin_top_7 pointer' onclick='point_close()'>
								</div>
								<div class='changep_bottom'></div>
								<div class='changep_bottom_text'>
									<p class='margin_right_5 block'>오늘은 그만보기 </p>
									<input type='checkbox' class='common_checkbox' id='today_show_none'>
									<label for='today_show_none' class='common_checkbox_label block margin_top_mi_5' onclick='today_show_nope()'></label>
								</div>
							</div>";
				echo $change_data;
			}
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/ */