<?php

class My_info extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		$this->load->helper('code_change_helper');
	}

	function index()
	{
		
		if(IS_MOBILE == true){
			//모바일 버전의 경우
			//모바일 로그인 체크
			user_check(null,0);

			$this->load->library('m_top_menu_lib');

			$top_data['add_css'] = array("/m/m_check_modi_css");
			$top_data['add_js'] = array("/m/m_check_modi_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"비밀번호 확인"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/auth/m_check_modi_v', @$data);

		}else{
			//PC버전의 경우
			//로그인 체크 
			user_check(null,0);

			$data['user_id'] = $this->session->userdata('m_userid');

			$navs = array('프로필','내정보관리'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

			$top_data['add_css'] = array("profile/profile_css");
			$top_data['add_js'] = array("profile/my_info_js");
			
			$this->load->view('top_v',$top_data);
			$this->load->view('profile/my_info_v', $data);
			$this->load->view('bottom_v');
		}
		}
		


	function search_pw(){

		//비밀번호 확인 레이어팝업 AJAX

		$top_data['add_css'] = array("layer_popup/search_my_popup_css");
		$top_data['add_js'] = array("layer_popup/search_my_popup_js");
		$top_data['add_title'] = "아이디/비밀번호 찾기";
		$top_data['add_text'] = "";

		@$data['user_id'] = $this->session->userdata('m_userid');

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/search_my_popup_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	//패스워드 체크
	function pw_chk(){

		$rtn = $this->member_lib->password_check(rawurldecode($this->input->post('m_pwd', true)));
		
		if($rtn == "1"){
			echo "true";
		}else{
			echo "false";
		}

	}

	//내정보수정
	function my_info_modify(){

		if(IS_MOBILE == true){
			//모바일버전의 경우

			//로그인 체크 
			user_check(null,0);

			$this->load->library('m_top_menu_lib');

			$data['mdata'] = $member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
			
			//이메일 주소 분리
			if(!@empty($member_data['m_mail'])){
				
				$email = explode('@', $member_data['m_mail']);

				$data['m_mail1'] = $email[0];
				$data['m_mail2'] = $email[1];
			}

			$top_data['add_css'] = array("/m/m_info_modi_css","/m/m_join_css");
			$top_data['add_js'] = array("/m/m_info_modi_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"기본정보"); //탑메뉴 로딩
			
			//지역 셋팅
			$bot_data['add_script'] = "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#regi_area_1').val('".$member_data['m_conregion']."');
					area_select($('#regi_area_1').val(), 'regi_area_2');
					$('#regi_area_2').val('".$member_data['m_conregion2']."');
				});
			</script>
			";

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/auth/m_info_modi_v', @$data);
			$this->load->view('m/m_bottom0_v', $bot_data);

		}else{
			//PC버전의 경우
			//PC 로그인 체크
			user_check(null,0);

			$navs = array('프로필','내정보관리'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩
			
			$top_data['add_css'] = array("profile/profile_css", "member/member_css");
			$top_data['add_js'] = array("profile/my_info_js");
			
			$data['mdata'] = $this->member_lib->get_member($this->session->userdata['m_userid']);		//개인 회원정보

			//이메일1, 2분리
			$data['email'] = strstr($data['mdata']['m_mail'], '@');
			$data['email1'] = str_replace($data['email'], '', $data['mdata']['m_mail']);		//이메일 아이디
			$data['email2'] = str_replace('@', '', $data['email']);								//이메일 주소
						
			//추가스크립트
			$bot_data['add_script'] = "
			<script>
				$(document).ready(function(){
					$('#regi_area_1').val('".$data['mdata']['m_conregion']."');
					area_select($('#regi_area_1').val(), 'regi_area_2');
					$('#regi_area_2').val('".$data['mdata']['m_conregion2']."');
				});
			</script>
			";
			
			$this->load->view('top_v',$top_data);
			$this->load->view('profile/my_info_modi_v', @$data);
			$this->load->view('bottom_v', $bot_data);
		}

		

	}

	//내정보 수정완료저장
	function reg_my_info_modify(){

		
		$m_pwd = strip_tags(rawurldecode($this->input->post('m_pwd', true)));

		$hashed_password = encryption_pass($m_pwd);		//비밀번호 암호화
		
		if(IS_MOBILE == true){
			//모바일버전의 경우
			//모바일버전 로그인 체크
			user_check(null,0);

			//변수들 html태그 제거
			$m_nick			= strip_tags(rawurldecode($this->input->post('m_nick', true)));
			$m_mail1		= strip_tags(rawurldecode($this->input->post('m_mail1', true)));
			$m_mail2		= strip_tags(rawurldecode($this->input->post('m_mail2', true)));
			$email_agree	= strip_tags(rawurldecode($this->input->post('email_agree', true)));
			$sms_agree		= strip_tags(rawurldecode($this->input->post('sms_agree', true)));
			$m_conregion	= strip_tags(rawurldecode($this->input->post('m_conregion', true)));
			$m_conregion2	= strip_tags(rawurldecode($this->input->post('m_conregion2', true)));

			//닉네임에 운영자 관리자가 포함된경우 처리
			$m_nick = str_replace('관리자', '회원'.rand(0, 99), $m_nick);
			$m_nick = str_replace('운영자', '회원'.rand(0, 99), $m_nick);
			$m_nick = str_replace('운영진', '회원'.rand(0, 99), $m_nick);
			$m_nick = str_replace('관리인', '회원'.rand(0, 99), $m_nick);
			
			if($m_conregion == "세종"){
				$addr = "세종특별자치시";
			}else{
				$addr = $m_conregion." ".$m_conregion2;
			}

			$map_data = get_map_addr($addr);		//지역으로 랜덤 맵좌표 만들기(code_change_helper) array(x좌표, y좌표)

			$arr_data = array(
				"m_pwd"				=> $hashed_password,
				"m_age"				=> $this->input->post('m_age', true),
				"m_age2"			=> substr($this->input->post('m_age', true),0,1),
				"m_nick"			=> $m_nick,
				"m_mail"			=> $m_mail1."@".$m_mail2,
				"m_mail_yn"			=> $email_agree,
				"m_hp_sms"			=> $sms_agree,
				"m_conregion"		=> $m_conregion,
				"m_conregion2"		=> $m_conregion2,
				"m_nick_chk"		=> $this->session->userdata['regi_m_nick_chk'],
				"m_xpoint"			=> $map_data[0],
				"m_ypoint"			=> $map_data[1]
			);

		}else{
			//PC버전의 경우
			//PC버전 로그인 체크
			user_check(null,0);

			if($this->input->post('regi_area_1', true) == "세종"){
				$addr = "세종특별자치시";
			}else{
				$addr = $this->input->post('regi_area_1', true)." ".$this->input->post('regi_area_2', true);
			}
			
			$map_data = get_map_addr($addr);		//지역으로 랜덤 맵좌표 만들기(code_change_helper) array(x좌표, y좌표)
			
			//닉네임에 운영자 관리자가 포함된경우 처리
			$m_nick = str_replace('관리자', '회원'.rand(0, 99), $this->input->post('m_nick', true));
			$m_nick = str_replace('운영자', '회원'.rand(0, 99), $m_nick);
			$m_nick = str_replace('운영진', '회원'.rand(0, 99), $m_nick);
			$m_nick = str_replace('관리인', '회원'.rand(0, 99), $m_nick);

			$arr_data = array(

				"m_pwd"				=> $hashed_password,
				"m_nick"			=> $m_nick,
				"m_age"				=> $this->input->post('m_age', true),
				"m_age2"			=> substr($this->input->post('m_age', true),0,1),
				"m_mail"			=> $this->input->post('email_id', true)."@".$this->input->post('email_after', true),
				"m_mail_open_yn"	=> $this->input->post('email_open', true),
				"m_mail_yn"			=> $this->input->post('email_recv_agree', true),
				"m_hp_sms"			=> $this->input->post('sms_recv_agree', true),
				"m_conregion"		=> $this->input->post('regi_area_1', true),
				"m_conregion2"		=> $this->input->post('regi_area_2', true),
				"m_reason"			=> $this->input->post('m_reason', true),
				"m_character"		=> $this->input->post('m_character', true),
				"my_intro"			=> strip_tags($this->input->post('my_intro', true)),
				"m_nick_chk"		=> @$this->session->userdata['regi_m_nick_chk'],
				"m_xpoint"			=> $map_data[0],
				"m_ypoint"			=> $map_data[1]

			);
		}
		

		$search['m_userid'] = $this->session->userdata['m_userid'];

		$rtn = $this->my_m->update('TotalMembers', $search, $arr_data);
		
		//정보수정한 회원데이터가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);

		//정보수정완료후 세션변경
		$this->session->set_userdata(array(		
			'm_nick'			=> $member_data['m_nick'],
			'm_conregion'		=> $member_data['m_conregion'],
			'm_age'				=> $member_data['m_age'],
			'm_conregion2'		=> $member_data['m_conregion2'],
			'regi_m_nick_chk'	=> null
		));

		//알림변경사항 설정
		$this->member_alrim_setting($member_data['m_userid'], $member_data['m_mail_yn']);
		
		if(IS_MOBILE == true){
			if($rtn == "1"){
				echo "1";		//수정성공
			}else{
				echo "0";		//수정실패
			}
		}else{
			echo "<script>alert('정보가 수정되었습니다.');</script>";
			$this->my_info_modify();
		}
		

	}


	//아이디 찾기
	function search_id(){

		$m_name		= rawurldecode($this->input->post('m_name', true));			//이름
		$m_year		= rawurldecode($this->input->post('m_year', true));			//년
		$m_month	= rawurldecode($this->input->post('m_month', true));		//월
		$m_day		= rawurldecode($this->input->post('m_day', true));			//일
		$m_sex		= rawurldecode($this->input->post('m_sex', true));			//성별
		
		if(strlen($m_month) == "1"){ $m_month = "0".$m_month; }
		if(strlen($m_day) == "1"){ $m_day = "0".$m_day; }

		$m_birth = substr($m_year, 2, 2).$m_month.$m_day;						//생년월일
		
		$arr_data = array(
			"m_name"		=> $m_name,
			"m_jumin1"		=> $m_birth,
			"m_sex"			=> $m_sex
		);
		
		$v_result = $this->profile_m->my_id_find('TotalMembers', $arr_data);		//회원아이디 검색

		$result		= $v_result[0];		//아이디결과값
		$total_rows = $v_result[1];		//아이디총갯수

		$v_member_id = "";
		foreach($result as $data){
			$v_member_id = $v_member_id.$data['m_userid']."|";
		}

		echo $total_rows."||".$v_member_id;
		
		
	}

	//아이디 찾기 결과 레이어팝업
	function my_id_find(){

		$result = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'result')));

		$v_result = explode('||', $result);		//총갯수와 아이디나누기

		$data['total_num'] = $v_result[0];		//아이디총갯수
		$data['v_member_id'] = split('\\|', $v_result[1]);	//아이디나누니

		$top_data['add_css'] = array("layer_popup/search_my_popup_css");
		$top_data['add_js'] = array("layer_popup/search_my_popup_js");
		$top_data['add_title'] = "아이디찾기 결과";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/search_my_popup_result_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//비밀번호 찾기
	function pass_search(){

		$m_userid			= rawurldecode($this->input->post('m_userid', true));			//아이디
		$m_name				= rawurldecode($this->input->post('m_name', true));				//이름
		$m_year				= rawurldecode($this->input->post('m_year', true));				//년
		$m_month			= rawurldecode($this->input->post('m_month', true));			//월
		$m_day				= rawurldecode($this->input->post('m_day', true));				//일
		$m_sex				= rawurldecode($this->input->post('m_sex', true));				//성별
		$m_hp1				= rawurldecode($this->input->post('m_hp1', true));				//핸드폰번호1
		$m_hp2				= rawurldecode($this->input->post('m_hp2', true));				//핸드폰번호2
		$m_hp3				= rawurldecode($this->input->post('m_hp3', true));				//핸드폰번호3
		$m_mail_first		= rawurldecode($this->input->post('m_mail_first', true));		//이메일1
		$m_mail_second		= rawurldecode($this->input->post('m_mail_second', true));		//이메일2
		$m_mode				= rawurldecode($this->input->post('m_mode', true));				//구분자(1.휴대전화검색, 2.이메일검색)

	
		$m_birth = substr($m_year, 2, 2).$this->add_zero($m_month).$this->add_zero($m_day);						//생년월일

		$m_mail = $m_mail_first."@".$m_mail_second;		//이메일주소
		
		if($m_mode == "1"){
			//휴대전화검색
			$arr_data = array(
				"m_userid"		=> $m_userid,
				"m_name"		=> $m_name,
				"m_jumin1"		=> $m_birth,
				"m_sex"			=> $m_sex,
				"m_hp1"			=> $m_hp1,
				"m_hp2"			=> $m_hp2,
				"m_hp3"			=> $m_hp3
			);

				//폰인증받은회원
				$member_data = $this->my_m->row_array('TotalMembers', $arr_data);		//회원검색(휴대전화검색)

				if(@$member_data['m_userid'] <> ""){
					//회원정보가 일치할경우
					$temp_password = GenerateString('6');		//임시비밀번호생성

					$mem_update_rtn = $this->my_m->update('TotalMembers', array('m_userid' => $m_userid), array('m_pwd' => encryption_pass($temp_password)) );		//임시비밀번호 업데이트
					
					if($mem_update_rtn == "1"){
						$sms_rtn = $this->sms_lib->sms_send('', array($m_hp1.$m_hp2.$m_hp3), "회원님의 임시비밀번호는 ".$temp_password."입니다.");		//문자메시지 발송
						echo "phone_success";
					}else{
						echo "phone_error";
					}
					exit;
				}else{
					//회원정보가 일치하지않을경우

					$phone_chk = $this->my_m->row_array('TotalMembers', array('m_userid' => $m_userid, 'm_name' => $m_name, 'm_jumin1' => $m_birth, 'm_sex' => $m_sex));		//휴대전화 인증 체크
					if(@$phone_chk['m_mobile_chk'] == "1"){
						//폰인증안받은회원
						echo "error";
						exit;
					}

					echo "phone_discordance";
					exit;
				}
		

		}else if($m_mode == "2"){
			//이메일검색
			$arr_data = array(
				"m_userid"		=> $m_userid,
				"m_name"		=> $m_name,
				"m_jumin1"		=> $m_birth,
				"m_sex"			=> $m_sex,
				"m_mail"		=> $m_mail
			);

			$member_data = $this->my_m->row_array('TotalMembers', $arr_data);		//회원검색(이메일검색)

			if($member_data['m_userid'] <> ""){
				//가입정보가 일치할경우
				echo "1";
				exit;
			}else{
				//가입정보가 일치하지않을경우
				echo "1";
				exit;
			}
		}

				

	}

	//월, 일 한자리수일경우
	function add_zero($val){
		
		if(strlen($val) == "1"){
			$val = "0".$val;
		}

		return $val;
	}
	
	 
	//내정보 수정에서 알림 이메일수신 거부시 알림설정
	function member_alrim_setting($m_userid, $m_mail_yn){
		
		$m_alrim = $this->my_m->row_array('set_member_alarm', array('m_userid' => $m_userid));

		if(empty($m_alrim)){
			
			//latest_helper 알림등록
			$alrim = auto_member_alrim($m_userid);

			if($alrim == "1"){
				//latest_helper
				$rtn = call_email_staus($m_userid, $m_mail_yn);
			}

		}else{
			//latest_helper
			$rtn = call_email_staus($m_userid, $m_mail_yn);
		}

		if($rtn == "1"){
			return "1";			//알림변경성공
		}else if($rtn == "0"){
			return "2";			//알림변경실패
		}else{
			return "9";			//잘못된접근
		}

	}
	
	
}

/* End of file main.php */
/* Location: ./application/controllers/*/