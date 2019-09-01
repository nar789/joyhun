<?php 
/*place this in libraries folder*/ 
class Top_menu_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
	}

	//$style = 메뉴바 스타일 , $navs = 서브메뉴안에 들어가는 위치텍스트
	function view($style="default",$navs = ''){

//		if(@$this->ci->session->userdata['m_userid'] == "juicy1007"){
//			return;
//		}

		//현재위치 텍스트
		$nav_txt = "";

		if($navs){
			for($i=0;$i<count($navs);$i++){
				if($i > 0){$nav_txt .= " > ";}
				if($i == (count($navs)-1)){
					$nav_txt .= "<span>$navs[$i]</span>";	
				}else {
					$nav_txt .= "$navs[$i]";	
				}
			}
		}

		ob_start();
		
		if($style =="default"){
			$this->menu_bar(); //메뉴바
		}else	if($style =="meeting"){
			$this->menu_bar(); //메뉴바
			$this->sub_meeting($nav_txt); //서브 미팅메뉴
		}else	if($style =="chatting"){
			$this->menu_bar(); //메뉴바
			$this->sub_chatting($nav_txt); //서브 채팅메뉴
		}else	if($style =="photo"){
			$this->menu_bar(); //메뉴바
			$this->sub_photo($nav_txt); //서브 포토미팅메뉴
		}else	if($style =="friend"){
			$this->menu_bar(); //메뉴바
			$this->sub_friend($nav_txt); //서브 친구만들기메뉴
		}else	if($style =="profile"){
			$this->menu_bar(); //메뉴바
			$this->sub_profile($nav_txt); //서브 프로필메뉴
		}else	if($style =="marry"){
			$this->menu_bar(); //메뉴바
			$this->sub_marry($nav_txt); //서브 공개구혼메뉴
		}else	if($style =="secret"){
			$this->menu_bar(); //메뉴바
			$this->sub_secret($nav_txt); //서브 비밀톡메뉴
		}else	if($style =="blind_date"){
			$this->menu_bar($right_top_on = 1); //메뉴바
			$this->sub_talk($nav_txt); //서브 소개팅메뉴
		}else	if($style =="talk"){
			$this->menu_bar($right_top_on = 2); //메뉴바
			$this->sub_blind_date($nav_txt); //서브 토크메뉴
		}else	if($style =="movie"){
			$this->menu_bar($right_top_on = 3); //메뉴바
			$this->sub_movie($nav_txt); //서브 최신영화메뉴
		}else	if($style =="privacy"){
			$this->menu_bar(); //메뉴바
			$this->sub_privacy($nav_txt); //서브 고객센터메뉴(화살표 none)
		}else	if($style =="gift_shop"){
			$this->menu_bar($right_top_on = 3); //메뉴바
			$this->sub_gift_shop($nav_txt); //서브 선물상점
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	function menu_bar($right_top_on = ''){

		for($i=1;$i<4;$i++){
			if($i == $right_top_on){ $data['right_top_on'.$i] = "color_f5665f"; }
			else { $data['right_top_on'.$i] = "color_fff"; }
		}
		
		$this->ci->load->view('top_menu/menu_bar_v',$data);
	}

	function sub_meeting($nav_txt = ''){

		//미팅 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_meeting_v',$data);
	}

	function sub_chatting($nav_txt = ''){
		//채팅 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_chatting_v',$data);
	}

	function sub_photo($nav_txt = ''){
		//포토미팅 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_photo_v',$data);
	}

	function sub_friend($nav_txt = ''){
		//친구만들기 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_friend_v',$data);
	}

	function sub_profile($nav_txt = ''){
		//친구만들기 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_profile_v',$data);
	}

	function sub_marry($nav_txt = ''){
		//공개구혼 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_marry_v',$data);
	}

	function sub_secret($nav_txt = ''){
		//비밀톡챗 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_secret_v',$data);
	}

	function sub_blind_date($nav_txt = ''){
		//소개팅 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_talk_v',$data);
	}

	function sub_talk($nav_txt = ''){
		//토크 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_talk_v',$data);
	}


	function sub_movie($nav_txt = ''){
		//최신영화 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_movie_v',$data);
	}

	function sub_privacy($nav_txt = ''){
		//고객센터 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_none_v',$data);
	}

	function sub_gift_shop($nav_txt = ''){
		//선물상점 서브메뉴
		$data['nav_txt'] = $nav_txt;
		$this->ci->load->view('top_menu/menu_gift_v',$data);
	}


}
?>
