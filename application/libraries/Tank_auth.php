<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.1/PasswordHash.php');

define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', FALSE);

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

/**
 * Tank_auth
 *
 * Authentication library for Code Igniter.
 *
 * @package		Tank_auth
 * @author		Ilya Konyukhov (http://konyukhov.com/soft/)
 * @version		1.0.3
 * @based on	DX Auth by Dexcell (http://dexcell.shinsengumiteam.com/dx_auth)
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
class Tank_auth
{
	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->model('tank_auth/users');
		$this->ci->load->config('tank_auth', TRUE);
		$this->ci->load->library('member_lib');
		$this->ci->load->helper('code_change_helper');
		$this->ci->load->helper('partner_helper');
		
		// Try to autologin
		$this->autologin();
	}

	/**
	 * Login user on the site. Return TRUE if login is successful
	 * (user exists and activated, password is correct), otherwise FALSE.
	 *
	 * @param	string	(username or email or both depending on settings in config file)
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function login($login, $password, $remember, $login_by_username, $login_by_email)
	{

		$t_data = $this->ci->my_m->row_array('TotalMembers', array('m_userid' => $login));

		//회원 테이블에 없을경우 휴먼계정 테이블 체크
		if(empty($t_data)){
			$t_data = $this->ci->my_m->row_array('TotalMembers_old', array('m_userid' => $login));
		}
		
		//회원테이블 및 휴면계정에도 없을경우
		if(empty($t_data)){
			alert_goto('아이디 혹은 비밀번호를 확인하여주시기 바랍니다.', '/auth/login');
		}
		
		//최근 접속 날짜가 없을경우 비밀번호 변경으로 수정
		if(empty($t_data['last_login_day']) or (@strlen($t_data['m_pwd']) < 11 and !empty($t_data['m_pwd'])) ){

			$t_phone = $t_data['m_hp1'].$t_data['m_hp2'].$t_data['m_hp3'];

			$this->ci->session->set_userdata(array(
				'user'	=> $login,
				'name'	=> $t_data['m_name'],
				'mail'	=> $t_data['m_mail'],
				'phone'	=> $t_phone
			));

			alert('조이헌팅이 새롭게 리뉴얼 되었습니다.\n비밀번호를 변경해주세요.', '/etc/dormancy/mb_dormancy');
			exit;
		}


		if ((strlen($login) > 0) AND (strlen($password) > 0)) {

			// Which function to use to login (based on config)
			if ($login_by_username AND $login_by_email) {
				$get_user_func = 'get_user_by_login';
			} else if ($login_by_username) {
				$get_user_func = 'get_user_by_username';
			} else {
				$get_user_func = 'get_user_by_email';
			}

			if (!is_null($user = $this->ci->users->$get_user_func($login))) {	// login ok

				// Does password match hash in database?
				$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

				if ($hasher->CheckPassword($password, $user->m_pwd)) {		// password ok

					if ($user->banned == 1) {									// fail - banned
						$this->error = array('banned' => $user->ban_reason);

					} else {
						$this->ci->session->set_userdata(array(
								'm_num'				=> $user->m_num,
								'm_userid'			=> $user->m_userid ,
								'm_name'			=> $user->m_name,
								'm_sex'				=> $user->m_sex,
								'm_nick'			=> $user->m_nick,
								'm_type'			=> $user->m_type,
								'm_age'				=> $user->m_age,
								'm_conregion'		=> $user->m_conregion,
								'm_conregion2'		=> $user->m_conregion2,
								'm_type'			=> $user->m_type,
								'm_mobile_chk'		=> $user->m_mobile_chk,
								'status'			=> ($user->activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
								'm_partner'			=> $user->m_partner,
								'm_partner_code'	=> $user->m_partner_code
						));

						if ($user->activated == 0) {							// fail - not activated
							$this->error = array('not_activated' => '');

						} else {												// success

							delete_cache("TotalMembers_login");		//로그인성공시 캐시 삭제

							if ($remember) {
								$this->create_autologin($user->m_num);
							}

							$this->clear_login_attempts($login);

							$this->ci->users->update_login_info(
									$user->m_userid,
									$this->ci->config->item('login_record_ip', 'tank_auth'),
									$this->ci->config->item('login_record_time', 'tank_auth'));

							return TRUE;
						}
					}
				} else {														// fail - wrong password
					$this->increase_login_attempt($login);
					$this->error = array('password' => 'auth_incorrect_password');
				}
			} else {															// fail - wrong login
				$this->increase_login_attempt($login);
				$this->error = array('login' => 'auth_incorrect_login');
			}
		}
		return FALSE;
	}

	/**
	 * Logout user from the site
	 *
	 * @return	void
	 */
	function logout()
	{
		$this->delete_autologin();
		$this->ci->session->sess_destroy();
	}

	/**
	 * Check if user logged in. Also test if user is activated or not.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_logged_in($activated = TRUE)
	{
		if($this->ci->session->userdata('m_userid') == ""){
			return false;
		}else{
			return true;
		}	
	}

	/**
	 * Get user_id
	 *
	 * @return	string
	 */
	function get_user_id()
	{
		return $this->ci->session->userdata('m_userid');
	}

	/**
	 * Get username
	 *
	 * @return	string
	 */
	function get_username()
	{
		return $this->ci->session->userdata('m_name');
	}

	/**
	 * Create new user on the site and return some data about it:
	 * user_id, username, password, email, new_email_key (if any).
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	array
	 */
	function create_user()
	{
		if ((strlen($this->ci->session->userdata('regi_id')) > 0) AND !$this->ci->users->is_userid_available($this->ci->session->userdata('regi_id'))) {
			$this->error = array('userid' => 'auth_userid_in_use');

		}elseif ($this->is_banned_id($this->ci->session->userdata('regi_id'))){
			$this->error = array('userid' => 'auth_userid_in_use');
		}else{
		
			// Hash password using phpass
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			$hashed_password = $hasher->HashPassword($this->ci->session->userdata('regi_pw'));

			$email = $this->ci->session->userdata('regi_email_1')."@".$this->ci->session->userdata('regi_email_2');

			$m_jumin1 = substr($this->ci->session->userdata('regi_birth_year'),2,2).$this->ci->session->userdata('regi_birth_month').$this->ci->session->userdata('regi_birth_day');

			if($this->ci->session->userdata('regi_sex') == "M"){
				$m_jumin2 = "1111111";
				$myavata = "1510001,1010001_0,1310001,0910001";
			}else{
				$m_jumin2 = "2222222";
				$myavata = "1520001,1020001_0,1320001,0920001";
			}

			$m_age = $this->ci->session->userdata('regi_user_age');
			$m_age2 = substr($m_age,0,1);

			if(IS_MOBILE == true){
				//모바일 회원가입의 경우 원하는 만남
				$m_character	= $this->ci->session->userdata('regi_talk_style');
				$m_reason		= $this->ci->session->userdata('regi_reason');

				//인사말
				$my_intro = call_my_intro($this->ci->session->userdata['regi_sex']);

			}else{

				//PC에서 회원가입할경우 원하는만남 대화스타일 랜덤지정
				//대화 스타일
				if($this->ci->session->userdata('regi_sex') == "F"){
					$m_character = rand(101,117);
				}else{
					$m_character = rand(1,19);
				}

				//원하는 만남
				$m_reason = rand(1,13);

				//인사말
				$my_intro = call_my_intro($this->ci->session->userdata['regi_sex']);
				
			}
			
			//중복가입막기
			$member_chk = $this->ci->member_lib->get_member($this->ci->session->userdata('regi_id'));

			if(!empty($member_chk)){
				alert_goto('이미 가입된 아이디 입니다.', '/');
			}
			
			//닉네임에 운영자 관리자가 포함된경우 처리
			$regi_user_nick = str_replace('관리자', '회원'.rand(0, 99), $this->ci->session->userdata('regi_user_nick'));
			$regi_user_nick = str_replace('운영자', '회원'.rand(0, 99), $regi_user_nick);
			$regi_user_nick = str_replace('운영진', '회원'.rand(0, 99), $regi_user_nick);
			$regi_user_nick = str_replace('관리인', '회원'.rand(0, 99), $regi_user_nick);
			$regi_user_nick = str_replace('담당자', '회원'.rand(0, 99), $regi_user_nick);

			//회원가입
			$data = array(
				'm_userid'			=> $this->ci->session->userdata('regi_id'),
				'm_name'			=> $this->ci->session->userdata('regi_user_name'),
				'm_nick'			=> $regi_user_nick,
				'm_pwd'				=> $hashed_password,
				'm_mail'			=> $email,
				'm_ip'				=> $this->ci->input->ip_address(),
				'm_conregion'		=> $this->ci->session->userdata('regi_area_1'),
				'm_conregion2'		=> $this->ci->session->userdata('regi_area_2'),
				'm_jumin1'			=> $m_jumin1,
				'm_jumin2'			=> $m_jumin2,
				'm_sex'				=> $this->ci->session->userdata('regi_sex'),
				'm_age'				=> $m_age,
				'm_age2'			=> $m_age2,
				'm_reason'			=> $m_reason,
				'm_character'		=> $m_character,
				'my_intro'			=> $my_intro,
				'm_avataid'			=> $myavata,
				'm_type'			=> 'F',
				'm_in_date'			=> date("Y-m-d H:i:s"),
				'm_nick_chk'		=> $this->ci->session->userdata['regi_m_nick_chk'],
				'm_partner'			=> $this->ci->session->userdata['regi_partner'],
				'm_partner_code'	=> $this->ci->session->userdata['regi_partner_code'],
				'm_reg_mobile'		=> $this->ci->session->userdata['regi_reg_mobile'],
				'last_login_day'	=> NOW
			);

			if (!is_null($res = $this->ci->users->create_user($data))) {
				//성공시 로그인

				$this->login($this->ci->session->userdata('regi_id'), $this->ci->session->userdata('regi_pw'), '', $this->ci->config->item('login_by_username', 'tank_auth'), $this->ci->config->item('login_by_email', 'tank_auth'));

				//로그인 성공시 로그인 기록 저장 TotalMebers_login
				$TM_LOGIN = $this->ci->member_lib->total_members_log($this->ci->session->userdata['m_userid']);

				//임시세션 지우기, 회원가입 완료 세션 추가
				$this->ci->session->set_userdata(array(
					'regi_id'				=> '',
					'regi_user_name'		=> '',
					'regi_user_nick'		=> '',
					'regi_user_age'			=> '',
					'regi_pw'				=> '',
					'regi_email_1'			=> '',
					'regi_email_2'			=> '',
					'regi_area_1'			=> '',
					'regi_area_2'			=> '',
					'regi_ok'				=> 'y',
					'regi_birth_year'		=> '',
					'regi_birth_month'		=> '',
					'regi_birth_day'		=> '',
					'regi_sex'				=> '',
					'regi_m_nick_chk'		=> null,
					'regi_partner'			=> '',
					'regi_partner_code'		=> ''
				));

				//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
				if(!empty($this->ci->session->userdata['m_partner']) and !empty($this->ci->session->userdata['m_partner_code'])){
					partner_send_curl('JOIN', $this->ci->session->userdata['m_userid'], null);
				}

				get_coordination_member($this->ci->session->userdata['m_userid']);		//회원가입시 선택한 지역에 따른 맵 좌표 생성(latest_helper)

				return "ok";
			}
		}
		return NULL;
	}


	function is_userid_available($user_id)
	{	//일반회원 아이디 중복검사
		return ((strlen($user_id) > 0) AND $this->ci->users->is_userid_available($user_id));
	}

	function is_userid_available2($user_id)
	{	//임시회원아이디 중복검사
		return ((strlen($user_id) > 0) AND $this->ci->users->is_userid_available2($user_id));
	}

	function is_nick_available($user_nick)
	{
		if( strlen($user_nick) > 0 AND $this->ci->users->is_nickname_available($user_nick) == 0){
			return 1; //사용가능
		}else{
			return 0; //불가
		}
	}

	function is_banned_id($user_id) //사용금지 아이디
	{
		$arr = $this->ci->users->banned_id_arr();
		$arr2 = explode(",",$arr['banned_id']);
		if (in_array($user_id, $arr)) {
			 return "1";
		}else{

		}	return "";
	}

	/**
	 * Check if username available for registering.
	 * Can be called for instant form validation.
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		return ((strlen($username) > 0) AND $this->ci->users->is_username_available($username));
	}

	/**
	 * Check if email available for registering.
	 * Can be called for instant form validation.
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		return ((strlen($email) > 0) AND $this->ci->users->is_email_available($email));
	}

	/**
	 * Change email for activation and return some data about user:
	 * user_id, username, email, new_email_key.
	 * Can be called for not activated users only.
	 *
	 * @param	string
	 * @return	array
	 */
	function change_email($email)
	{
		$user_id = $this->ci->session->userdata('m_userid');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, FALSE))) {

			$data = array(
				'user_id'	=> $user_id,
				'username'	=> $user->username,
				'email'		=> $email,
			);
			if ($user->email == $email) {		// leave activation key as is
				$data['new_email_key'] = $user->new_email_key;
				return $data;

			} elseif ($this->ci->users->is_email_available($email)) {
				$data['new_email_key'] = md5(rand().microtime());
				$this->ci->users->set_new_email($user_id, $email, $data['new_email_key'], FALSE);
				return $data;

			} else {
				$this->error = array('email' => 'auth_email_in_use');
			}
		}
		return NULL;
	}

	/**
	 * Activate user using given key
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_user($user_id, $new_email_key)
	{
		$this->ci->users->purge_na($this->ci->config->item('email_activation_expire', 'tank_auth'));

		if ((strlen($user_id) > 0) AND (strlen($new_email_key) > 0)) {
			return $this->ci->users->activate_user($user_id, $new_email_key);
		}
		return FALSE;
	}

	/**
	 * Set new password key for user and return some data about user:
	 * user_id, username, email, new_pass_key.
	 * The password key can be used to verify user when resetting his/her password.
	 *
	 * @param	string
	 * @return	array
	 */
	function forgot_password($login)
	{
		if (strlen($login) > 0) {
			if (!is_null($user = $this->ci->users->get_user_by_login($login, TRUE))) {

				$data = array(
					'user_id'		=> $user->m_num,
					'username'		=> $user->m_name,
					'email'			=> $user->m_mail,
					'new_pass_key'	=> md5(rand().microtime()),
				);

				$this->ci->users->set_password_key($user->m_num, $data['new_pass_key']);
				return $data;

			} else {
				$this->error = array('login' => 'auth_incorrect_email_or_username');
			}
		}
		return NULL;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function can_reset_password($user_id, $new_pass_key)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0)) {
			return $this->ci->users->can_reset_password(
				$user_id,
				$new_pass_key,
				$this->ci->config->item('forgot_password_expire', 'tank_auth'));
		}
		return FALSE;
}

	/**
	 * Replace user password (forgotten) with a new one (set by user)
	 * and return some data about it: user_id, username, new_password, email.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass_key, $new_password)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0) AND (strlen($new_password) > 0)) {

			if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

				// Hash password using phpass
				$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
				$hashed_password = $hasher->HashPassword($new_password);

				if ($this->ci->users->reset_password(
						$user_id,
						$hashed_password,
						$new_pass_key,
						$this->ci->config->item('forgot_password_expire', 'tank_auth'))) {	// success

					// Clear all user's autologins
					$this->ci->load->model('tank_auth/user_autologin');
					$this->ci->user_autologin->clear($user->id);

					return array(
						'user_id'		=> $user_id,
						'username'		=> $user->username,
						'email'			=> $user->email,
						'new_password'	=> $new_password,
					);
				}
			}
		}
		return NULL;
	}

	/**
	 * Change user password (only when user is logged in)
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function change_password($old_pass, $new_pass)
	{
		$user_id = $this->ci->session->userdata('m_userid');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if old password correct
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			if ($hasher->CheckPassword($old_pass, $user->password)) {			// success

				// Hash new password using phpass
				$hashed_password = $hasher->HashPassword($new_pass);

				// Replace old password with new one
				$this->ci->users->change_password($user_id, $hashed_password);
				return TRUE;

			} else {															// fail
				$this->error = array('old_password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	/**
	 * Change user email (only when user is logged in) and return some data about user:
	 * user_id, username, new_email, new_email_key.
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function set_new_email($new_email, $password)
	{
		$user_id = $this->ci->session->userdata('m_userid');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if password correct
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			if ($hasher->CheckPassword($password, $user->password)) {			// success

				$data = array(
					'user_id'	=> $user_id,
					'username'	=> $user->username,
					'new_email'	=> $new_email,
				);

				if ($user->email == $new_email) {
					$this->error = array('email' => 'auth_current_email');

				} elseif ($user->new_email == $new_email) {		// leave email key as is
					$data['new_email_key'] = $user->new_email_key;
					return $data;

				} elseif ($this->ci->users->is_email_available($new_email)) {
					$data['new_email_key'] = md5(rand().microtime());
					$this->ci->users->set_new_email($user_id, $new_email, $data['new_email_key'], TRUE);
					return $data;

				} else {
					$this->error = array('email' => 'auth_email_in_use');
				}
			} else {															// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return NULL;
	}

	/**
	 * Activate new email, if email activation key is valid.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_email_key) > 0)) {
			return $this->ci->users->activate_new_email(
					$user_id,
					$new_email_key);
		}
		return FALSE;
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @param	string
	 * @return	bool
	 */
	function delete_user($password)
	{
		$user_id = $this->ci->session->userdata('m_userid');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if password correct
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			if ($hasher->CheckPassword($password, $user->password)) {			// success

				$this->ci->users->delete_user($user_id);
				$this->logout();
				return TRUE;

			} else {															// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as login or register.
	 *
	 * @return	string
	 */
	function get_error_message()
	{
		return $this->error;
	}

	/**
	 * Save data for user's autologin
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_autologin($user_id)
	{
		$this->ci->load->helper('cookie');
		$key = substr(md5(uniqid(rand().get_cookie($this->ci->config->item('sess_cookie_name')))), 0, 16);

		$this->ci->load->model('tank_auth/user_autologin');
		$this->ci->user_autologin->purge($user_id);

		if ($this->ci->user_autologin->set($user_id, md5($key))) {

			set_cookie(array(
					'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
					'value'		=> serialize(array('user_id' => $user_id, 'key' => $key)),
					'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
			));
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Clear user's autologin data
	 *
	 * @return	void
	 */
	private function delete_autologin()
	{
		$this->ci->load->helper('cookie');
		if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

			$data = unserialize($cookie);

			$this->ci->load->model('tank_auth/user_autologin');
			$this->ci->user_autologin->delete($data['user_id'], md5($data['key']));

			delete_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'));
		}

		//회원 로그인 로그아웃 로그기록 남기기 latest_helper
		user_login_log('logout', $this->ci->session->userdata['m_userid']);
	}

	/**
	 * Login user automatically if he/she provides correct autologin verification
	 *
	 * @return	void
	 */
	private function autologin()
	{

		if (!$this->is_logged_in() AND !$this->is_logged_in(FALSE)) {			// not logged in (as any user)

			$this->ci->load->helper('cookie');
			if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

				$data = unserialize($cookie);

				if (isset($data['key']) AND isset($data['user_id'])) {

					$this->ci->load->model('tank_auth/user_autologin');
					if (!is_null($user = $this->ci->user_autologin->get($data['user_id'], md5($data['key'])))) {

						// Login user
						$this->ci->session->set_userdata(array(
								'user_id'	=> $user->id,
								'username'	=> $user->username,
								'status'	=> STATUS_ACTIVATED,
						));

						// Renew users cookie to prevent it from expiring
						set_cookie(array(
								'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
								'value'		=> $cookie,
								'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
						));

						$this->ci->users->update_login_info(
								$user->id,
								$this->ci->config->item('login_record_ip', 'tank_auth'),
								$this->ci->config->item('login_record_time', 'tank_auth'));
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * Check if login attempts exceeded max login attempts (specified in config)
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_max_login_attempts_exceeded($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			return $this->ci->login_attempts->get_attempts_num($this->ci->input->ip_address(), $login)
					>= $this->ci->config->item('login_max_attempts', 'tank_auth');
		}
		return FALSE;
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 * (if attempts to login is being counted)
	 *
	 * @param	string
	 * @return	void
	 */
	private function increase_login_attempt($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			if (!$this->is_max_login_attempts_exceeded($login)) {
				$this->ci->load->model('tank_auth/login_attempts');
				$this->ci->login_attempts->increase_attempt($this->ci->input->ip_address(), $login);
			}
		}
	}

	/**
	 * Clear all attempt records for given IP-address and login
	 * (if attempts to login is being counted)
	 *
	 * @param	string
	 * @return	void
	 */
	private function clear_login_attempts($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			$this->ci->login_attempts->clear_attempts(
					$this->ci->input->ip_address(),
					$login,
					$this->ci->config->item('login_attempt_expire', 'tank_auth'));
		}
	}

	/**
	 * 로그인 되어있지 않으면 로그인 페이지로
	 * @param none
	 * @return void
	 */
	function is_login()
	{
		if( ! $this->is_logged_in())
		{
			$rpath = str_replace("index.php/", "", $this->ci->input->server('PHP_SELF'));
			$rpath_encode = strtr(base64_encode(addslashes(gzcompress(serialize($rpath), 9))), '+/=', '-_.');
			echo ('<script>window.location.replace("/auth/login/'.$rpath_encode.'")</script>');
			exit;
		}
	}


}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */