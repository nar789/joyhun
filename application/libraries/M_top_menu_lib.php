<?php 
/*place this in libraries folder*/ 
class M_top_menu_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
	}

	//$style = 메뉴바 스타일 , $navs = 서브메뉴안에 들어가는 위치텍스트
	function view($style="default",$navs = ''){
		
		ob_start();
		
		if($style =="default"){
			$this->top_menu_bar(); //메뉴바
		}else if($style =="single_back"){
			$this->top_single_back_bar($navs); //뒤로가기와 타이틀이 있는 메뉴바
		}

		$output = ob_get_contents();

		@ob_end_clean();
		return $output;

	}

	function top_menu_bar(){
		//메뉴바
		$this->ci->load->view('m/top_menu/m_menu_v', @$data);
	}

	function top_single_back_bar($navs){
		//뒤로가기와 타이틀이 있는 메뉴바
		$data['nav_txt'] = $navs;
		$this->ci->load->view('m/top_menu/m_menu_single_back_v',$data);
	}



}
?>
