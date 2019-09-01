<?php
function hook_is_login(){
	$CI = & get_instance();
	
	if($CI->session->userdata('m_userid')){
			define('IS_LOGIN',true);
	}else{
			define('IS_LOGIN',false);
	}

	define('TODAY',date("Y-m-d"));
	define('NOW',date("Y-m-d H:i:s"));
}

function hook_is_mobile(){

	$CI = & get_instance();


	$CI->load->library("Mobile_Detect");
	$CI->load->helper('cookie');

	$host_arr = explode(".",$_SERVER["HTTP_HOST"]);

	if($CI->mobile_detect->isMobile() == true){
		

		$pc_mode_cookie = get_cookie('pc_mode_cookie');

		if($host_arr[0] != "m" and $pc_mode_cookie != "pc"){
			goto("http://m.".str_replace("www.","",$_SERVER["HTTP_HOST"]).$_SERVER["REQUEST_URI"]);		
		}

	}
	
	if($host_arr[0] == "m"){
		define('IS_MOBILE',true);


		if(@get_cookie('is_app') == true){
			define('IS_APP',true);
			if(@get_cookie('app_os') == 'IOS'){
				define('APP_OS','IOS');
			}else if(@get_cookie('app_os') == 'ANDROID'){
				define('APP_OS','ANDROID');
			}

		}else{
			define('IS_APP',false);
			define('APP_OS',"");
		}

	}else{
		define('IS_MOBILE',false);
	}

}

function hook_is_https(){

	$CI = & get_instance();


	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {


		$now_url = explode("/",$_SERVER["REQUEST_URI"]);
		$now_url = "/".@$now_url[1]."/".@$now_url[2];	//현재 도메인 URL 체크

		if($now_url == "/auth/login"){	//로그인
		}else if($now_url == "/auth/register"){	//회원가입
		}else if($now_url == "/auth/nick_check"){	//닉네임 중복검사
		}else if($now_url == "/auth/id_check"){	//아이디 중복검사
		}else if($now_url == "/auth/register_cert"){	//간편 본인인증
		}else if($now_url == "/auth/register_name_check"){	//간편 본인인증
		}else if($now_url == "/auth/register_run"){	//회원가입 최종		
		}else if($now_url == "/etc/popups"){	//팝업창 제외		
		}else if($now_url == "/auth/m_talk_style_mobile"){	//모바일 성별 선택
		}else if($now_url == "/etc/hp_cert"){	//휴대폰 인증완료 (코드등록때문에 보류)
		}else if($now_url == "/service_center/main"){	//회원가입시 일대일 문의		
		}else if($now_url == "/auth/admin_login"){	//관리자 로그인
		}else if($now_url == "/profile/my_info"){	//아이디/비밀번호 찾기
		}else if($now_url == "/service_center/faq"){	//고객상담문의하기
		}else if($now_url == "/etc/change_point_pop"){	//포인트 변경안내 팝업
		}else if($now_url == "/service_center/joy_police"){	//접속제한 경고 팝업
		}else if($now_url == "/etc/app"){	//앱 버전 제외
		}else if($now_url == "/test/apptest"){	//앱 테스트 제외
			
		}else{
	
			goto("http://".str_replace(":444","",$_SERVER["HTTP_HOST"]).$_SERVER["REQUEST_URI"]);

		}

	}

}

function pre_system(){
}
?>