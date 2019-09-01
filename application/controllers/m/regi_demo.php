<?php

class Regi_demo extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index(){

		if($this->session->userdata('regi_id') == ""){
			redirect('/auth/register/');
		}

		$this->demo_menu();
	}
	
	//데모페이지
	function demo_menu($menu = "1"){
		
		if(@$this->session->userdata['m_userid']){
			goto('/m/online_mb');
		}

		$data['menu'] = $menu;
		
		//view 설정
		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

		$bot_data['add_script'] = "
		<script type='text/javascript'>
			
			$(document).ready(function(){
				reg_modify();
			});

		</script>
		";
		
		$this->load->view('m/m_top_v', $top_data);
		$this->load->view('m/etc/m_demo_v', @$data);
		$this->load->view('m/m_bottom0_v', $bot_data);

	}
	
	//데모 메뉴1
	function demo1(){
		$this->demo_menu(1);
	}
	
	//데모 메뉴2
	function demo2(){
		$this->demo_menu(2);
	}
	
	//데모 메뉴3
	function demo3(){
		$this->demo_menu(3);
	}
	
	//데모 메뉴4
	function demo4(){
		$this->demo_menu(4);
	}
	
	//데모 메뉴5
	function demo5(){
		$this->demo_menu(5);
	}

	//본인인증 레이어팝업
	function reg_modify_layer(){
		
		//view설정
		$top_data['add_title'] = "본인인증";

		$data['add_style'] = "
			<style>
				.register_text_box{position:relative; width:90%; margin:auto; margin-top:10px; height:80px; border-radius:8px; background-color:#E7F4FF; text-align:center; line-height:20px;}
				.register_text_box p{padding-top:20px; font-size:1.1em; font-weight:bold;}
				.register_text_box span{color:red; font-size:1.0em;}
			</style>
		";

		$data['add_script'] = "
			<script type='text/javascript'>

				$(document).ready(function(){
					$('#modal_close_btn').hide();
					$('.modal_pop_title').css('background-color', '#0950BA');
				});

			</script>
		";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/m_demo_register_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */