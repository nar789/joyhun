<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->config('tank_auth', TRUE);
		$this->load->helper(array('form', 'url','alert_helper', 'code_change_helper', 'alrim_helper', 'partner_helper','alert_helper'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth_admin');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->library('top_menu_lib');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
	}


	function index()
	{
		redirect('/auth/login/');
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */

	function login()
	{
		//$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		//$hashed_password = $hasher->HashPassword('niceday1');
		//echo "<script>alert('".$hashed_password."');</script>";

		if(!empty($this->session->userdata['regi_id'])){
			reg_session_init();
		}



		if(reg_member_chk($this->input->post('login', true), $this->input->post('password', true)) == "0" || @$this->session->userdata['regi_id']){
			if(IS_MOBILE == true){
				goto('/m/regi_demo/demo1');
			}else{
				goto('/auth/register_cert');
			}			
		}

		if(!@$this->uri->segment(3)) {
			$returnUrl = '/';
		} else {
			$returnUrl = @unserialize(gzuncompress(stripslashes(base64_decode(strtr($this->uri->segment(3), '-_.', '+/=')))));
		}
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {

			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
			$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', '아이디', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', '비밀번호', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', '자동로그인', 'integer');
			$this->form_validation->set_rules('save_id', '아이디저장', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login',TRUE))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				if ($data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', '자동입력 방지문자', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', '자동입력 방지문자', 'trim|xss_clean|required|callback__check_captcha');
			}
			$data['errors'] = array();
			

			if ($this->form_validation->run()) {								// validation ok


				$block_chk = call_block_member_chk($this->form_validation->set_value('login'));
				if(!empty($block_chk)){ redirect('/auth/send_again/block/'.$block_chk); }
				

				//call_member_type_up($this->form_validation->set_value('login'));


				$punish_chk = $this->member_lib->login_punish_check($this->form_validation->set_value('login'));
				

				$sql = "";
				$sql .= " SELECT * FROM login_attempts WHERE 1=1 and login = '".$this->form_validation->set_value('login')."' and time <= date_add(sysdate(), interval -10 second) ORDER BY id DESC limit 1 ";

				$attempt_chk_query = $this->db->query($sql);

				$chk_attempt = $attempt_chk_query->row_array();

				if(count($chk_attempt) == "0"){
					$this->my_m->del('login_attempts', array('ip_address' => $_SERVER['REMOTE_ADDR']));
				}
				

				if($punish_chk == '777'){ 				
					
					if($this->tank_auth->login(
						
							$this->form_validation->set_value('login'),
							$this->form_validation->set_value('password'),
							$this->form_validation->set_value('remember'),
							$data['login_by_username'],
							$data['login_by_email'])) {								// success


						if($this->form_validation->set_value('save_id') == "1"){
							$cookie = array(
								'name' => 'id_save',
								'value' => $this->form_validation->set_value('login'),
								'expire' => '31572500',
								'domain' => '.'.str_replace(":444","",$_SERVER["HTTP_HOST"]),
								'path' => '/',
								'prefix' => 'do_',
								'secure' => FALSE
							);
							$this->input->set_cookie($cookie);

						}else{
							delete_cookie('do_id_save','.'.str_replace(":444","",$_SERVER["HTTP_HOST"]),'/');
						}
						

						$TM_LOGIN = $this->member_lib->total_members_log($this->session->userdata['m_userid']);


						//if($this->session->userdata['m_sex'] == "F"){
						//	goto('/service_center/event/woman_event');
						//}
						
						redirect("http://".str_replace(":444","",$_SERVER["HTTP_HOST"]).$returnUrl);
					} else {
						$errors = $this->tank_auth->get_error_message();
						if (isset($errors['banned'])) {								// banned user
							$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);
							return;

						} elseif (isset($errors['not_activated'])) {				// not activated user
							redirect('/auth/send_again/');

						} else {													// fail
							foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
						}
					}


				}else{


					if(IS_MOBILE == true){

						$data['not_login'] = "<script>complaint_alrim_mobile('".$this->form_validation->set_value('login')."','".$punish_chk."');</script>";


					}else{
						
						$data['not_login'] = "<script>complaint_alrim('".$this->form_validation->set_value('login')."','".$punish_chk."');</script>";

					}
				}
			}

			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			$data['login_max_attempts'] = $this->config->item('login_max_attempts', 'tank_auth');
			

			$block_idx = $this->security->xss_clean(@url_explode($this->seg_exp, 'block'));

			if(!empty($block_idx)){
				
				$bot_data['add_script'] = "
				<script type='text/javascript'>
					
					$(document).ready(function(){
						member_block_layer('$block_idx');
					});

				</script>
				";
			}


			$inlove_data = $this->member_lib->get_member($this->form_validation->set_value('login')."z");
			if(!empty($inlove_data)){
				$msg = "혹시 몰래한사랑 회원이셨다면,\\n아이디 뒤에 영문자z를 붙여서 로그인을 해주세요.\\n예)".$inlove_data['m_userid'];
				$bot_data['add_script'] = "
					<script type='text/javascript'>
						$(document).ready(function(){
							setTimeout(function(){ alert('$msg'); }, 500);
						});
					</script>
				";
			}

			//VIEW 설정

			if(IS_MOBILE == true){ //모바일 모드일때

				$data['login'] = array(
					'name'	=> 'login',
					'id'	=> 'login',
					'value' => $this->input->cookie('do_id_save'),
					'maxlength'	=> 80,
					'size'	=> 30,
					'class' => 'm_login_input'
				);
				$data['password'] = array(
					'name'	=> 'password',
					'id'	=> 'password',
					'size'	=> 30,
					'class' => 'm_login_input margin_top_10'
				);
				$data['remember'] = array(
					'name'	=> 'remember',
					'id'	=> 'm_remember',
					'value'	=> 1,
					'checked'	=> set_value('remember'),
					'checked'	=> 'true',
					'class' => 'm_checkbox'
				);
				$data['captcha'] = array(
					'name'	=> 'captcha',
					'id'	=> 'captcha',
					'maxlength'	=> 8,
					'class' => 'captcha_input',
					'placeholder'=>'자동입력 방지문자',
					'onkeydown'=>'login_key_check(this);'
				);
				$data['save_id'] = array(
					'name'	=> 'save_id',
					'id'	=> 'm_save_id',
					'value'	=> 1,
					'checked'	=> $this->input->cookie('do_id_save'),
					'checked'	=> 'true',
					'class' => 'm_checkbox'
				);

				$top_data['add_css'] = array("/m/m_login_css");
				$top_data['add_js'] = array("/m/m_login_js", "/member/member_login_js");

				$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"로그인"); //탑메뉴 로딩

				$this->load->view('m/m_top_v',$top_data);
				$this->load->view('m/auth/m_login_v', @$data);
				$this->load->view('m/m_bottom0_v', @$bot_data);

			}else{	//PC 모드일때

				$data['login'] = array(
					'name'	=> 'login',
					'id'	=> 'login',
					'value' => $this->input->cookie('do_id_save'),
					'maxlength'	=> 80,
					'size'	=> 30,
					'placeholder'=>'아이디',
					'onkeydown'=>'login_key_check(this);'
				);
				$data['password'] = array(
					'name'	=> 'password',
					'id'	=> 'password',
					'size'	=> 30,
					'placeholder'=>'비밀번호',
					'onkeydown'=>'login_key_check(this);'
				);
				$data['remember'] = array(
					'name'	=> 'remember',
					'id'	=> 'remember',
					'value'	=> 1,
					'checked'	=> set_value('remember'),
					//'style' => 'margin:0;padding:0',
					'style' => 'margin-left:-14px',
				);
				$data['captcha'] = array(
					'name'	=> 'captcha',
					'id'	=> 'captcha',
					'maxlength'	=> 8,
					'class' => 'captcha_input',
					'placeholder'=>'자동입력 방지문자',
					'onkeydown'=>'login_key_check(this);'
				);
				$data['save_id'] = array(
					'name'	=> 'save_id',
					'id'	=> 'def_check',
					'value'	=> 1,
					'checked'	=> 'true',
					//'style' => 'margin:0;padding:0',
					'style' => 'margin-left:-14px',
					'class' => 'checkbox_align'
				);

				$top_data['top_menu'] = $this->top_menu_lib->view(); //탑메뉴 로딩

				$top_data['add_css'] = array("member/member_css");
				$top_data['add_js'] = array("member/member_login_js");	
				
				
				$this->load->view('top_v',$top_data);
				$this->load->view('auth/member_login_v', $data);
				$this->load->view('bottom_v', @$bot_data);

			}

		}
	}

	function admin_login()
	{
		if($this->session->userdata('admin_mode') == "mo"){
			$returnUrl = "/admin/mo";
		}else{
			$returnUrl = ADMIN_DIR;
		}

		if ($this->tank_auth_admin->is_logged_in()) {									// logged in
			redirect('/');

		}elseif ($this->tank_auth_admin->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		}else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', '아이디', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', '비밀번호', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', '자동로그인', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login',TRUE))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if ($this->tank_auth_admin->is_max_login_attempts_exceeded($login)) {
				if ($data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', '자동입력 방지문자', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', '자동입력 방지문자', 'trim|xss_clean|required|callback__check_captcha');
			}
			$data['errors'] = array();

			

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth_admin->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {								// success

					redirect($returnUrl);
				} else {
					$errors = $this->tank_auth_admin->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);
						return;

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth_admin->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			$this->load->view('admin/admin_top0_v');
			$this->load->view('auth/admin_login_form', $data);
			$this->load->view('admin/admin_bottom0_v');
		}
	}


	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();
		alert($this->lang->line('auth_message_logged_out'), '/');
		redirect('', 'refresh');
	}

	function admin_logout()
	{
		$this->tank_auth->logout();
		alert($this->lang->line('auth_message_logged_out'), ADMIN_DIR);
		redirect('', 'refresh');
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));
			return;

		} else {
			


			$block_chk = call_block_member_ip_chk($_SERVER['REMOTE_ADDR']);
			if(!empty($block_chk)){ redirect('/auth/send_again/block/'.$block_chk); }
			
			$this->form_validation->set_rules('regi_id', '아이디', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('regi_pw', '비밀번호', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']');
			$this->form_validation->set_rules('regi_age', '나이', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_email_1', '이메일', 'trim|required|xss_clean');
			$this->form_validation->set_rules('regi_email_2', '이메일뒤', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_area_1', '지역', 'trim|required|xss_clean');
			$this->form_validation->set_rules('regi_area_2', '지역', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_nick', '닉네임', 'trim|required|xss_clean|min_length[2]|max_length[6]|korean_alpha_dash');
			$this->form_validation->set_rules('regi_sex', '성별', 'trim|required|xss_clean');

			if(IS_MOBILE == true){
				$this->form_validation->set_rules('m_reason', '원하는만남', 'trim|required|xss_clean');
				$this->form_validation->set_rules('m_talk_style', '대화스타일', 'trim|required|xss_clean');	
			}
		
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');
			
			if($this->form_validation->run()){								// validation ok

					$regi_id = strtolower($this->form_validation->set_value('regi_id'));
					

					if(IS_MOBILE == true){
						$m_reg_mobile = "M";
					}else{
						$m_reg_mobile = "P";
					}


					$this->session->set_userdata(array(
						'regi_id'			=> $this->form_validation->set_value('regi_id'),
						'regi_user_nick'	=> $this->form_validation->set_value('regi_nick'),
						'regi_user_age'		=> $this->form_validation->set_value('regi_age'),
						'regi_pw'			=> $this->form_validation->set_value('regi_pw'),
						'regi_email_1'		=> $this->form_validation->set_value('regi_email_1'),
						'regi_email_2'		=> $this->form_validation->set_value('regi_email_2'),
						'regi_area_1'		=> $this->form_validation->set_value('regi_area_1'),
						'regi_area_2'		=> $this->form_validation->set_value('regi_area_2'),
						'regi_reason'		=> @$this->form_validation->set_value('m_reason'),
						'regi_talk_style'	=> @$this->form_validation->set_value('m_talk_style'),
						'regi_sex'			=> $this->form_validation->set_value('regi_sex'),
						'regi_partner'		=> partner_cookie_data(get_cookie('partner_id')),		//partner_helper(파트너 아이디)
						'regi_partner_code'	=> partner_cookie_data(get_cookie('partner_code')),		//partner_helper(파트너 광고코드)
						'regi_reg_mobile'	=> $m_reg_mobile
					));	

					if($this->session->userdata['regi_partner'] == "joyHunting" and $this->session->userdata['regi_partner_code'] == "joyHunting"){
						$this->session->set_userdata(array('regi_partner_code' => null));
					}
					
					$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
					$hashed_password = $hasher->HashPassword($this->session->userdata('regi_pw'));

					$regi_data = array(
						"userid"			=> $this->session->userdata['regi_id'],
						"nick"				=> $this->session->userdata['regi_user_nick'],
						"age"				=> $this->session->userdata['regi_user_age'],
						"sex"				=> $this->session->userdata['regi_sex'],
						"pwd"				=> $hashed_password,
						"mail"				=> $this->session->userdata['regi_email_1']."@".$this->session->userdata['regi_email_2'],
						"conregion"			=> $this->session->userdata['regi_area_1'],
						"conregion2"		=> $this->session->userdata['regi_area_2'],
						"reason"			=> @$this->session->userdata['regi_reason'],
						"talk_style"		=> @$this->session->userdata['regi_talk_style'],
						"nick_chk"			=> @$this->session->userdata['regi_m_nick_chk'],
						"write_date"		=> NOW,
						"partner"			=> $this->session->userdata['regi_partner'],
						"ad_code"			=> $this->session->userdata['regi_partner_code'],
						"reg_mobile"		=> $m_reg_mobile,
						"reg_ip"			=> $_SERVER['REMOTE_ADDR']
					);
					

					$regi_cnt = $this->my_m->cnt('reg_member', array('userid' => $this->session->userdata['regi_id']));

					if($regi_cnt > 0){						
						//로그인페이지로 이동
						alert_goto('임시회원으로 가입되어있는 아이디입니다.\n로그인하시기 바랍니다.', '/auth/login');
					}

					$this->my_m->insert('reg_member', $regi_data);

					/////인증생략 코드 //start
					/*

							$this->session->set_userdata(array(		
								"regi_user_name"		=> $regi_data['nick'],
								"regi_birth_year"		=> '1988',
								"regi_birth_month"		=> '11',
								"regi_birth_day"		=> '11'
							));
					        if(!is_null($data = $this->tank_auth->create_user())){	//회원가입성공
								$arrData = array(
									"m_hp1"					=> '010',
									"m_hp2"					=> '111',
									"m_hp3"					=> '222',
									"m_mobile_chk"			=> "1",
									"m_mobile_chke_date"	=> NOW
								);
								//여성회원이 본인인증을 할경우 바로 정회원 처리
								if($regi_data['sex'] == "F"){
									$arrData['m_type'] = "V";
								}
								//회원 테이블 업데이트
								$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $regi_data['userid']), $arrData);
								//echo "<script>alert('".$rtn."');</script>";
								if($rtn == 1){

									//업데이트후 회원 데이터 다시 가져오기
									$mdata = $this->member_lib->get_member($regi_data['userid']);
									//세션 업데이트
									$this->session->set_userdata(array(
										"m_mobile_chk"	=> $mdata['m_mobile_chk'],
										"m_type"		=> $mdata['m_type']
									));
								}
							}
							*/
					/////인증생략 코드 //end
							

					
					if(IS_MOBILE == true){
						redirect("/m/regi_demo/demo1");
						//redirect("/"); //for skip cert.
					}else{
						redirect("/auth/register_cert/");
					}
					
					
			}else{

				if(!empty($_POST)){
					$browser = get_browser(null, true);
					$user_ip = $this->input->ip_address();

					//운영체제, 브라우저, 버전, 아이피
					$user_data = $browser['platform']."|||".$browser['browser']."|||".$browser['version']."|||".$user_ip."|||";

					$this->my_m->insert('test_auth_log', array('contents' => $user_data.serialize($_POST), 'write_date' => NOW));
				}	
			}


			//VIEW 설정
			if(IS_MOBILE == true){ //모바일 모드일때
		
				$top_data['add_css'] = array("/m/m_join_css");
				$top_data['add_js'] = array("/m/m_join_js");

				$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"회원가입"); //탑메뉴 로딩

				$this->load->view('m/m_top_v',$top_data);
				$this->load->view('m/auth/m_join_v', @$data);
				$this->load->view('m/m_bottom0_v');		

			}else{ //PC 모드일때
				
				$agree_arr =  $this->my_m->row_array("admin_setting", array('idx' => 1) );

				$data['agree1'] = nl2br($agree_arr['agree1']);
				$data['agree2'] = nl2br($agree_arr['agree2']);
				$data['agree3'] = nl2br($agree_arr['agree3']);
				$data['agree4'] = nl2br($agree_arr['agree4']);

				$data['agree1'] = strip_tags($data['agree1']);
				$data['agree2'] = strip_tags($data['agree2']);
				$data['agree3'] = strip_tags($data['agree3']);
				$data['agree4'] = strip_tags($data['agree4']);

				$top_data['top_menu'] = $this->top_menu_lib->view(); //탑메뉴 로딩

				$top_data['add_css'] = array("member/member_css");
				$top_data['add_js'] = array("member/member_register_js");

				$this->load->view('top_v', $top_data);
				$this->load->view('auth/member_register_v', $data);
				$this->load->view('bottom_v');

			}

		}
	}

	//회원가입 - 본인인증화면
	function register_cert(){

		//VIEW 설정
		if(IS_MOBILE == true){ //모바일 모드일때

			if($this->session->userdata('regi_id') == ""){
				redirect('/auth/register/');
			}

			$data['regi_id'] = $this->session->userdata['regi_id'];

			$top_data['add_css'] = array("/m/m_join_css");
			$top_data['add_js'] = array("/m/member_register_cert_js");

			
			
			if(@$this->session->userdata['regi_id']){
				$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩
			}else{
				$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', "회원가입"); //탑메뉴 로딩
			}

			$this->load->view('m/m_top_v', $top_data);				
			$this->load->view('m/auth/member_register_cert_v', @$data);
			$this->load->view('m/m_bottom0_v');
			

		}else{ //PC 모드일때

			if($this->session->userdata('regi_id') == ""){
				redirect('/auth/register/');
			}

			$top_data['top_menu'] = $this->top_menu_lib->view(); //탑메뉴 로딩

			$top_data['add_css'] = array("member/member_css");
			$top_data['add_js'] = array("member/member_register_cert_js");

			$data = "";

			$this->load->view('top_v', $top_data);
			$this->load->view('auth/member_register_cert_v', $data);
			$this->load->view('bottom_v');
		}
	}

	function register_run(){

		if($this->session->userdata('regi_id') == ""){
			redirect('/auth/register/');
		}

		if (!is_null($data = $this->tank_auth->create_user())) {									// success
			
			//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
			if(!empty($this->session->userdata['m_partner']) and !empty($this->session->userdata['m_partner_code'])){
				partner_send_curl('JOIN', $this->session->userdata['m_userid'], null);
			}

			//회원가입이메일 보내기
			$this->reg_member_email($this->session->userdata['m_userid']);

		}else{
			$this->session->sess_destroy();
			alert_only("회원가입에 실패하였습니다. 고객센터로 문의주시기 바랍니다.");
			redirect('/');
		}

		redirect('/');
	}


	function register_name_check(){
		//간편 본인 확인

		$regi_user_name			= rawurldecode($this->input->post('regi_user_name', true));			//이름
		$regi_birth_year		= rawurldecode($this->input->post('regi_birth_year', true));		//년
		$regi_birth_month		= rawurldecode($this->input->post('regi_birth_month', true));		//월
		$regi_birth_day			= rawurldecode($this->input->post('regi_birth_day', true));			//일
		$regi_sex				= rawurldecode($this->input->post('regi_sex', true));				//성별
		
		//임시세션 굽기
		if(!empty($regi_user_name)){
			$this->session->set_userdata(array(
				"regi_user_name"		=> $regi_user_name,
				"regi_birth_year"		=> $regi_birth_year,
				"regi_birth_month"		=> $regi_birth_month,
				"regi_birth_day"		=> $regi_birth_day,
				"regi_sex"				=> $this->session->userdata['regi_sex']
			));
		}
		
		//간편본인인증
		$sSiteID = "AC26";  		// 사이트 코드
		$sSitePW = "53497206";      // 사이트 패스워드

		$cb_encode_path = "/home/joyhunting/www/include/nice/SNameCheck";			// SNameCheck 모듈이 설치된 위치의 절대경로와 SNameCheck 모듈명까지 입력한다.
		
		if($regi_sex == "M"){
			$user_sex = "1";		//남성 1 변환
		}else{
			$user_sex = "0";		//여성 0 변환
		}

		$strJumin		= $regi_birth_year.$regi_birth_month.$regi_birth_day;				//생년월일(생년월일8자리)
		$strName		= iconv('utf-8', 'euc-kr', $regi_user_name);						//이름
		$strgender		= $user_sex;														//여성 0, 남성 1 
		
		$iReturnCode  = "";	

		$iReturnCode = `$cb_encode_path $sSiteID $sSitePW $strJumin $strgender $strName`;	//생년월일 인증(생년월일8자리, 성별, 이름)

		//간편 본인인증 로그남기기
		$arrData = array(
			"userid"			=> $this->session->userdata['regi_id'],
			"name"				=> $regi_user_name,
			"sex"				=> $user_sex,
			"birth"				=> $strJumin,
			"result"			=> $iReturnCode,
			"write_date"		=> NOW
		);
		//간편 본인인증 로그insert
		$rtn = $this->my_m->insert('sname_check_log', $arrData);
		
		//간편확인 성공시 임시회원 삭제처리
		if($iReturnCode == "1"){
			$this->my_m->del('reg_member', array('userid' => $this->session->userdata['regi_id']));
		}

		echo $iReturnCode;
		
	}

	/**
	 * Modify user on the site
	 *
	 * @return void
	 */
	function modify()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logout
			$aa = base64_encode('/auth/modify');
			redirect('/auth/login/'.$aa);

		} else {
			//$this->form_validation->set_rules('nickname', '별명', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', '비밀번호', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', '비밀번호 재입력', 'trim|required|xss_clean|matches[password]');

			if ($this->form_validation->run()) {								// validation ok

				$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
				$hashed_password = $hasher->HashPassword($this->input->post('password',TRUE));

				$data = array(
							   //'nickname' => $this->input->post('nickname'),
							   'email' => $this->input->post('email',TRUE),
							   'password' => $hashed_password
							);

				$this->db->where('id', $this->tank_auth->get_user_id());
				$this->db->update('users', $data);

				redirect('/auth/modify');

			}

			$this->db->select("*");
			$this->db->where('id', $this->tank_auth->get_user_id());
			$query = $this->db->get('users');
			$data['views'] = $views= $query->row_array();


			$this->load->view('top_v');
			$this->load->view('auth/modify_form', $data);
			$this->load->view('bottom_v');
		}
	}


	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated

			$idx = $this->security->xss_clean(@url_explode($this->seg_exp, 'block'));

			$aa = base64_encode('/auth/change_password');
			redirect('/auth/login/'.$aa.'/block/'.$idx);

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));
					return;
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}

			$this->load->view('top_v');
			$this->load->view('auth/send_again_form', $data);
			$this->load->view('bottom_v');
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user

		$this->load->view('top_v');
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor(site_url('/auth/login/'), 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
		$this->load->view('bottom_v');
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));
					return;

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('top_v');
			$this->load->view('auth/forgot_password_form', $data);
			$this->load->view('bottom_v');
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor(site_url('/auth/login/'), 'Login'));
				return;

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
				return;
			}
		} else {
			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
				return;
			}
		}
		$this->load->view('top_v');
		$this->load->view('auth/reset_password_form', $data);
		$this->load->view('bottom_v');
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			$aa = base64_encode('/auth/change_password');
			redirect('/auth/login/'.$aa);

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));
					return;

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('top_v');
			$this->load->view('auth/change_password_form', $data);
			$this->load->view('bottom_v');
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			$aa = base64_encode('/auth/change_email');
			redirect('/auth/login/'.$aa);
		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));
					return;

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('top_v');
			$this->load->view('auth/change_email_form', $data);
			$this->load->view('bottom_v');
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		$this->load->view('top_v');
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor(site_url('/auth/login/'), 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
		$this->load->view('bottom_v');
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			$aa = base64_encode('/auth/unregister');
			redirect('/auth/login/'.$aa);

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));
					return;

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('top_v');
			$this->load->view('auth/unregister_form', $data);
			$this->load->view('bottom_v');
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->load->view('auth/general_message', array('message' => $message));
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'word'			=> mt_rand(10274536, 90853127),
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{

		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}


	//아이디 중복검사
	function id_check(){

		$user_id = rawurldecode($this->input->post('regi_id', true));

		if( $user_id != ""){
				if($this->tank_auth->is_banned_id( $user_id ) ){ //금지아이디인지? 200금지
					echo "200";
					exit;
				}

				echo $this->tank_auth->is_userid_available2( $user_id ); //이미 가입인지? 1:미가입

		}
	}


	//닉네임 중복검사
	function nick_check(){
		if( $this->input->post('regi_nick',TRUE) != ""){

			//금지닉네임 체크(비교대상에 있을경우 세션값 추가)
			$banned = $this->my_m->row_array('admin_setting', array('idx' => '1'));
			$ban = explode(',', $banned['banned_nick']);

			if(count($ban) == ""){
				$total = "1";
			}else{
				$total = count($ban);
			}

			$j=0;
			$nick_chk = "";		//금지어
			
			for($i=0; $i<$total; $i++){
				if(@strpos($this->input->post('regi_nick', TRUE), str_replace(' ', '', $ban[$i])) !== false){
					$j++;
					$nick_chk = $ban[$i];
					break;
				}
			}
			
			if($j > 0){
				$this->session->set_userdata(array('regi_m_nick_chk' => $nick_chk));		
			}else{
				$this->session->set_userdata(array('regi_m_nick_chk' => null));				
			}

			echo $this->tank_auth->is_nick_available( urldecode($this->input->post('regi_nick',TRUE)) ); //이미 사용중인지? 1:미가입

		}

	}
	


	function m_talk_style_mobile(){
		
		if(IS_MOBILE == true){
			
			$m_sex = $this->input->post('m_sex', true);

			if($m_sex == "M"){				
				
				$option = "<option value=''>선택하세요.</option>";
				for($i=1; $i<20; $i++){
					$option .= "<option value='".$i."'>".talk_style_data($i, $m_sex)."</option>";
				}

				echo $option;

			}else if($m_sex == "F"){

				$option = "<option value=''>선택하세요.</option>";
				for($i=101; $i<118; $i++){
					$option .= "<option value='".$i."'>".talk_style_data($i, $m_sex)."</option>";
				}

				echo $option;

			}else{
				alert_goto('잘못된 접근입니다.', '/');
				exit;
			}
		
		}else{
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}
	}


	function reg_member_email($user_id){
		
		if(!@empty($user_id)){
			$data['m_data'] = $m_data = $this->member_lib->get_member($user_id);

			$data['contenst_sub1'] = "
				<font style='color:red; font-weight:bold;'>".$m_data['m_name']."</font> 고객님. 안녕하세요!<br>
				고객님께서는 <font style='color:red; font-weight:bold;'>".date('Y')."</font>년 <font style='color:red; font-weight:bold;'>".date('m')."</font>월 <font style='color:red; font-weight:bold;'>".date('d')."</font>일에 일반회원으로 가입 되셨습니다.<br>
				가입하신 내역은 아래와 같습니다.
			";
			
			$html = "";
			$html .= $this->load->view('top0_v', @$top_data, true);
			$html .= $this->load->view('intro/reg_e_mail_v', @$data, true);
			$html .= $this->load->view('bottom0_v', @$bot_data, true);
			
			$email_rtn = joyhunting_email($m_data['m_mail'], '조이헌팅 회원가입을 축하드립니다.', $html);

			return $email_rtn;
		}
		
	}
	

	function reg_member_msg(){		
		if($this->mobile_detect->is('iPhone')){
			goto('http://www.joyhunting.com');
		}else{
			goto('https://goo.gl/XXi59L');
		}
	}

	function register_test(){

		$_POST = unserialize('a:12:{s:8:"regi_sex";s:1:"F";s:5:"m_sex";s:1:"F";s:8:"m_reason";s:2:"10";s:12:"m_talk_style";s:1:"3";s:7:"regi_id";s:8:"hihi0521";s:7:"regi_pw";s:10:"!!33625ee2";s:9:"regi_nick";s:12:"섹시요염";s:8:"regi_age";s:2:"25";s:12:"regi_email_1";s:9:"Kimhk8684";s:12:"regi_email_2";s:8:"nate.com";s:11:"regi_area_1";s:6:"경기";s:11:"regi_area_2";s:12:"세부지역";}');

		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));
			return;

		} else {			


			

			$block_chk = call_block_member_ip_chk($_SERVER['REMOTE_ADDR']);
			if(!empty($block_chk)){ redirect('/auth/send_again/block/'.$block_chk); }
			
			$this->form_validation->set_rules('regi_id', '아이디', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('regi_pw', '비밀번호', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']');

			$this->form_validation->set_rules('regi_age', '나이', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_email_1', '이메일', 'trim|required|xss_clean');
			$this->form_validation->set_rules('regi_email_2', '이메일뒤', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_area_1', '지역', 'trim|required|xss_clean');
			$this->form_validation->set_rules('regi_area_2', '지역', 'trim|required|xss_clean');

			$this->form_validation->set_rules('regi_nick', '닉네임', 'trim|required|xss_clean|min_length[2]|max_length[6]|korean_alpha_dash');
			$this->form_validation->set_rules('regi_sex', '성별', 'trim|required|xss_clean');

			if(IS_MOBILE == true){
				$this->form_validation->set_rules('m_reason', '원하는만남', 'trim|required|xss_clean');
				$this->form_validation->set_rules('m_talk_style', '대화스타일', 'trim|required|xss_clean');	
			}
		
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');
			
			if ($this->form_validation->run()) {								// validation ok

				echo "ok";		
			}else{

				echo "no";		

			}

		}
	}


	function email_test(){
		
		$data['contenst_sub1'] = "
			<font style='color:red; font-weight:bold;'>테스트</font> 고객님. 안녕하세요!<br>
			고객님께서는 <font style='color:red; font-weight:bold;'>".date('Y')."</font>년 <font style='color:red; font-weight:bold;'>".date('m')."</font>월 <font style='color:red; font-weight:bold;'>".date('d')."</font>일에 일반회원으로 가입 되셨습니다.<br>
			가입하신 내역은 아래와 같습니다.
		";
		
		$html = "";
		$html .= $this->load->view('top0_v', @$top_data, true);
		$html .= $this->load->view('intro/reg_e_mail_v', @$data, true);
		$html .= $this->load->view('bottom0_v', @$bot_data, true);
		
		$email_rtn = joyhunting_email("rainbowforest@hanmail.net", '조이헌팅 회원가입을 축하드립니다.', $html);

		return $email_rtn;
	}



	function forman_register(){
		
		$result = 0;
		$user_id = $this->session->userdata['regi_id'];
		
		$this->session->set_userdata(array(		
			'regi_user_name'		=> '',
			'regi_birth_year'		=> date('Y'),
			'regi_birth_month'		=> date('m'),
			'regi_birth_day'		=> date('d')
		));

		if(!is_null($data = $this->tank_auth->create_user())){

			$arrData = array(
				'm_name'				=> '본인인증패스회원',
				'm_hp1'					=> '010',
				'm_hp2'					=> '0000',
				'm_hp3'					=> '0000',
				'm_mobile_chk'			=> '1',
				'm_mobile_chke_date'	=> NOW
			);


			$this->my_m->update('TotalMembers', array('m_userid' => $user_id), $arrData);
			

			$mdata = $this->member_lib->get_member($user_id);
			

			$this->session->set_userdata(array(
				"m_mobile_chk"		=> $mdata['m_mobile_chk'],
				"m_type"			=> $mdata['m_type']
			));


			if(!empty($mdata['m_partner']) and !empty($mdata['m_partner_code'])){
				partner_send_curl('AUTH', $mdata['m_userid'], null);
			}
			

			$cnt = $this->my_m->cnt('reg_member', array('userid' => $user_id));
			if($cnt > 0){
				$this->my_m->del('reg_member', array('userid' => $user_id));
			}


			$result = 1;		

		}

		return $result;

	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */