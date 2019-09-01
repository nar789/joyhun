<?php

class Find_login extends MY_Controller {

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

		$top_data['add_css'] = array("/m/m_find_login_css");
		$top_data['add_js'] = array("/m/m_find_login_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"아이디/비밀번호 찾기"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/auth/m_find_login_v', @$data);
	}

	//아이디 찾기 ajax
	function search_id(){
		
		//변수받기
		$m_name		= rawurldecode($this->input->post('m_name', true));			//이름
		$m_year		= rawurldecode($this->input->post('m_year', true));			//년
		$m_month	= rawurldecode($this->input->post('m_month', true));		//월
		$m_day		= rawurldecode($this->input->post('m_day', true));			//일
		$m_sex		= rawurldecode($this->input->post('m_sex', true));			//성별

		//생년월일 합치기
		$m_birth =  substr($m_year, 2, 2).$this->add_zero($m_month).$this->add_zero($m_day);		//생년월일(6자리)
		
		$search_data = array(
			"m_name"		=> $m_name,
			"m_jumin1"		=> $m_birth,
			"m_sex"			=> $m_sex
		);

		$m_result = $this->my_m->result_array('TotalMembers', $search_data, 'm_num', 'desc');
		
		$i = 0;
		$option_html = "<option value=''>- 검색 결과 -</option>";

		foreach($m_result as $data){
			$i++;
			$option_html .= "<option value=''>".$data['m_userid']."</option>";
		}

		$search_id_html = "<p class='color_333 padding_top_10 margin_bottom_10'>검색된 아이디의 갯수는 총 ".$i."개 입니다.</p>";
		$search_id_html .= "<table class='mobile_border_table width_100per margin_top_10'>";
		$search_id_html .= "<tr>";
		$search_id_html .= "<td>아이디</td>";
		$search_id_html .= "<td class='ver_top padding_top_5'>";
		$search_id_html .= "<div class='width_95per margin_auto'>";
		$search_id_html .= "<div class='width_95per float_left border_1_cccccc mobile_select'><select class='border_none width_100per border_0 text_5 color_666'>".$option_html."</select></div>";
		$search_id_html .= "</div>";
		$search_id_html .= "</td>";
		$search_id_html .= "</tr>";
		$search_id_html .= "</table>";
		
		echo $search_id_html;
		
	}

	//비밀번호 찾기는 PC버전 그대로 이용(/profile/pass_search)


	//월, 일 한자리수일경우
	function add_zero($val){
		
		if(strlen($val) == "1"){
			$val = "0".$val;
		}

		return $val;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */