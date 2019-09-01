<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 경고메세지를 경고창으로
function alert($msg='', $url='')
{
	$CI =& get_instance();

	if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>alert('".$msg."');";
    if ($url){
        echo "location.replace('".$url."');";
	}else{
		if(IS_MOBILE == TRUE){
			goto("https://".$_SERVER["HTTP_HOST"]."/auth/login");
		}else{
			echo "history.go(-1);";
		}
	}
	echo "</script>";
	exit;
}

// 경고메세지 출력후 창을 닫음
function alert_close($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); window.close(); </script>";
	exit;
}


// 경고메세지 출력후 새로고침후 창닫기
function alert_close_reload($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); opener.location.reload(); window.close(); </script>";
	exit;
}

// 경고메세지만 출력
function alert_only($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); </script>";
	exit;
}

// 페이지 이동
function goto($url)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> location.href=('".$url."'); </script>";
	exit;
}

// 결고창 출력후 페이지이동
function alert_goto($msg, $url)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); location.href=('".$url."'); </script>";
	exit;
}




//로그인 및 권한 체커 
// str이 있을경우 텍스트 뿌려줌 onclick 용
function user_check($str = null, $mode = 5, $is_ajax = null)
{
	// user_check 걸면 무조건 로그인 체크 실행함. 비회원만 막기 ex) user_check(null,0);
	// mode가 5이거나 빈칸일때 휴대폰 본인인증 후 사용가능 알림. 미결제회원이 일반메뉴 사용가능할때. ex) user_check(null,5);
	// mode가 9이면 결제한 정회원만 사용가능 알림. 결제 정회원만 가능하도록.  ex) user_check(null,9);

	//$is_ajax = 'exit '를 줄경우 AJAX 실행단계에서 스크립트를 보여줄수 없으므로 에러코드 900~909를 내뱃고 exit 로 막아준다.   ex) user_check(null,1,'exit');

	$CI =& get_instance();
	

	//mode를 0으로 넣으면 로그인 체크만 실행
	if($str){
		if( IS_LOGIN == FALSE ){
			echo "alert('로그인 후 사용이 가능합니다.');location.href='http://".$_SERVER["HTTP_HOST"]."/auth/login/';";return;
		}
	}else if($is_ajax){
		if( IS_LOGIN == FALSE ){
			echo "900";exit;
		}
	}else{
		if(IS_LOGIN == FALSE){
			alert_goto("로그인 후 사용이 가능합니다.","http://".$_SERVER["HTTP_HOST"]."/auth/login/");		
		}
	}

	if($mode < "9" and $mode >= "5" and $CI->session->userdata('m_mobile_chk')  != "1" and $CI->session->userdata('m_sex') == "F"){
	//간편인증만 한 회원은 휴대폰 본인인증 요청
		
		if(IS_MOBILE == TRUE){
			$go_url = "/m/add_menu";
		}else{
			$go_url = "/profile/main/user";
		}

		if($str){
				echo "alert('여성회원은 휴대폰인증을 하시면 바로 정회원이 됩니다.');location.href='$go_url';";return;
		}else if($is_ajax){
			echo "905";exit;
		}else{
				alert_goto("여성회원은 휴대폰인증을 하시면 바로 정회원이 됩니다.","$go_url");
		}
		return;

	}

	if($mode >= "9" and $CI->session->userdata('m_type')  == "F"){
	//본인인증만 한 회원은 정회원 결제 요청
		
		if(IS_MOBILE == TRUE){
			$go_url = "/profile/point/payment_f";
		}else{
			$go_url = "/profile/point/point_charge";
		}

		if($str){
				echo "alert('정회원 가입후 사용이 가능합니다.');location.href='$go_url';";return;
		}else if($is_ajax){
			echo "909"; exit;
		}else{
				alert_goto("정회원 가입후 사용이 가능합니다.","$go_url");
		}
		return;

	}

	if($str){

		echo $str;  //다 통과했고, 스크립트 실행 모드일때
	}
	
}

//로그인을 했으면 $login 출력, 안했으면 $not_login 출력
function login_goto($login, $not_login){
	$CI =& get_instance();
	if( IS_LOGIN == TRUE ){
		return $login;
	}else{
		return $not_login;
	}
}

//관리자 권한체커
//제한할 관리자 권한숫자를 입력. 기본은 1레벨 이상. 사용예) admin_check(10); 또는 admin_check();
function admin_check($level = 1)
{
	$CI =& get_instance();

		if ($CI->session->userdata('auth_code'))
		{
			if ($CI->session->userdata('auth_code') < $level)
			{
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
				echo "<script>";
				echo "	alert('권한이 없습니다.');";
				echo "	location=\"" . BASEURL	 . "\"";
				echo "</script>";
			}
		}
		else
		{
			$rpath = str_replace("index.php/", "", $CI->input->server('PHP_SELF'));
			$rpath_encode = url_code($rpath, 'e');
			echo "<script>";
			echo "	location=\"" . BASEURL . "auth/admin_login/" . $rpath_encode . "\"";
			echo "</script>";
			exit;

		}
}


//본인인증을 하지 않은 임시 회원들 본인인증 페이지로 강제이동 체크
function reg_member_chk($user_id, $user_pw){
	
	$CI =& get_instance();
	$CI->load->model('my_m');
	$CI->load->library('member_lib');
	
	if(empty($user_id)){
		return "1";
	}

	$reg_member = $CI->my_m->row_array('reg_member', array('userid' => $user_id));
	
	if(!@empty($reg_member)){
		//임시회원일경우(임시 세션 추가)

		//비밀번호 체크
		if($CI->member_lib->reg_password_check($user_pw, $user_id)){
			
			//이메일 분리
			$reg_mail = explode('@', $reg_member['mail']);
			
			//임시회원 로그인시 임시세션 굽기
			$CI->session->set_userdata(array(
				'regi_id'			=> $reg_member['userid'],
				'regi_user_nick'	=> $reg_member['nick'],
				'regi_user_age'		=> $reg_member['age'],
				'regi_pw'			=> $user_pw,
				'regi_email_1'		=> $reg_mail[0],
				'regi_email_2'		=> $reg_mail[1],
				'regi_area_1'		=> $reg_member['conregion'], 
				'regi_area_2'		=> $reg_member['conregion2'],
				'regi_reason'		=> @$reg_member['reason'],
				'regi_talk_style'	=> @$reg_member['talk_style'],
				'regi_sex'			=> $reg_member['sex'],
				'regi_m_nick_chk'	=> $reg_member['nick_chk'],
				'regi_partner'		=> $reg_member['partner'],
				'regi_partner_code'	=> $reg_member['ad_code'],
				'regi_reg_mobile'	=> $reg_member['reg_mobile']
			));

			return "0";

		}else{
			//비밀번호가 틀린경우
			reg_session_init();

			return "1";
		}
		
	}else{
		//임시회원이 아닌경우
		reg_session_init();

		return "1";
	}

}


//임시세션 초기화
function reg_session_init(){
	
	$CI =& get_instance();

	$CI->session->set_userdata(array(
		'regi_id'			=> '',
		'regi_user_nick'	=> '',
		'regi_user_age'		=> '',
		'regi_pw'			=> '',
		'regi_email_1'		=> '',
		'regi_email_2'		=> '',
		'regi_area_1'		=> '',
		'regi_area_2'		=> '',
		'regi_reason'		=> '',
		'regi_talk_style'	=> '',
		'regi_sex'			=> '',
		'regi_partner'		=> '',
		'regi_partner_code' => '',
		'regi_reg_mobile'	=> ''
	));


}

//임시세션이 (본인인증) 존재할경우 리다이렉트
function reg_member_redirect(){
	
	$CI =& get_instance();

	if(!empty($CI->session->userdata['regi_id']) and $_SERVER["REQUEST_URI"] <> "/auth/register_cert"){

		if($_SERVER["REQUEST_URI"]  == "/main/start" or $_SERVER["REQUEST_URI"]  == "/auth/login/" or $_SERVER["REQUEST_URI"]  == "/auth/register/"){
			reg_session_init();
		}else{
			echo "location.href='/auth/register_cert' ";
		}	

	}

}


?>