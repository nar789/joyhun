<?php

class Privacy_policy extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('policy_m');
		$this->load->library('top_menu_lib');

	}

	function policy_list($radio_num){

		$navs = array('홈','개인정보 취급방침'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$agree_arr =  $this->my_m->row_array("admin_setting", array('idx' => 1) );
		$data['agree1'] = nl2br($agree_arr['agree1']);
		$data['agree2'] = nl2br($agree_arr['agree2']);
		$data['agree3'] = nl2br($agree_arr['agree3']);
		$data['agree4'] = nl2br($agree_arr['agree4']);
		$data['agree5'] = nl2br($agree_arr['agree5']);

		$data['call_tab_radio'] = $this->call_tab_radio($radio_num); //약관 탭메뉴

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/privacy_poolicy_js");
		
		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/privacy_v',$data);
		$this->load->view('bottom_v');
	}

	function policy_1(){
		$this->policy_list(1);
	}

	function policy_2(){
		$this->policy_list(2);
	}

	function policy_3(){
		$this->policy_list(3);
	}

	function call_tab_radio($num){
		//약관 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "checked";			
			}else{
				$data["tap_menu_css_$i"]  = "";			
			}
		}

		ob_start();
		
		$this->load->view('service_center/privacy_tab_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	

	//모바일 설정페이지
	function mobile_set(){
		
		//모바일 로그인 체크
		user_check(null,0);

		$this->load->library('m_top_menu_lib');
		
		//view 설정

		$top_data['add_css'] = array("/m/m_set_css");
		$top_data['add_js'] = array("/m/m_set_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"설정"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/etc/m_set_v', @$data);
		$this->load->view('m/m_bottom0_v');
	}

	//모바일 이용약관, 개인정보취급방침, 청소년보호정책
	function policy_list_mobile(){

		$this->load->library('m_top_menu_lib');
		
		//변수받기
		$gubn = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gubn')));
		
		if(empty($gubn)){ $gubn = "1"; }		//구분 변수가 없을경우 이용약관으로 보내기

		$agree_arr =  $this->my_m->row_array("admin_setting", array('idx' => 1) );
		$data['agree1'] = nl2br($agree_arr['agree1']);
		$data['agree2'] = nl2br($agree_arr['agree2']);
		$data['agree3'] = nl2br($agree_arr['agree3']);
		$data['agree4'] = nl2br($agree_arr['agree4']);
		$data['agree5'] = nl2br($agree_arr['agree5']);

		if($gubn == "1"){
			$file_name = "m_terms_use";
			$sub_title = "이용약관";
		}else if($gubn == "2"){
			$file_name = "m_privacy";
			$sub_title = "개인정보취급방침";
		}else if($gubn == "3"){
			$file_name = "m_youth_policy";
			$sub_title = "청소년보호정책";
		}

		//view 설정

		$top_data['add_css'] = array("/m/".$file_name."_css");
		$top_data['add_js'] = array("/m/".$file_name."_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', $sub_title);  //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/etc/'.$file_name.'_v', @$data);
		$this->load->view('m/m_bottom0_v');

	}
}

/* End of file main.php */
/* Location: ./application/controllers/*/

