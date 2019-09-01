<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		$this->load->helper('code_change_helper');

	}

	function index(){

		$navs = array('홈','고객센터'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/privacy_poolicy_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
		
		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/main_v',$data);
		$this->load->view('bottom_v');
	}

	function qna_popup(){
		//문의하기 레이어팝업 AJAX

		$top_data['add_css'] = array("layer_popup/qna_add_popup_css");
		$top_data['add_js'] = array("layer_popup/qna_add_popup_js");
		$top_data['add_title'] = "고객상담 문의하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/qna_add_popup_v');
		$this->load->view('layer_popup/popup_bottom_v');
	}


	function qna_popup_mobile(){
		//문의하기 레이어팝업 AJAX_모바일

		//모바일 로그인 체크
		user_check(null,0);

		$this->load->library('m_top_menu_lib');
		
		$nav = "고객상담 문의하기";

		$data['user_info'] = $this->member_lib->get_member($this->session->userdata['m_userid']);

		$top_data['add_css'] = array("/m/m_mail_css");
		$top_data['add_js'] = array("/m/m_mail_js","/layer_popup/qna_add_popup_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', $nav); //탑메뉴 로딩

		$this->load->view('/m/m_top_v',$top_data);
		$this->load->view('/m/etc/m_question_mail_v', @$data);
		$this->load->view('m/m_bottom0_v');
	}

	
	function check_qna(){
		// 문의하기 로그인체크

		if (@$this->session->userdata['m_userid']){
			echo "7";
		}else{
			echo "4";
		}
	}

	function business_popup(){
		// 광고,사업제휴문의 AJAX

		$data['cate'] = $cate = $this->security->xss_clean(url_explode($this->seg_exp, 'cate')); if(!$cate){exit;}

		$top_data['add_css'] = array("layer_popup/qna_add_popup_css");
		$top_data['add_js'] = array("layer_popup/advertise_add_popup_js");
		$top_data['add_title'] = $cate."하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/business_popup_v',$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	function business_popup_mobile(){
		// 광고,사업제휴문의 AJAX_모바일

		//모바일 로그인 체크
		user_check(null,0);

		$this->load->library('m_top_menu_lib');
		
		$nav = "광고 &middot; 제휴 문의하기";

		$data['user_info'] = $this->member_lib->get_member($this->session->userdata['m_userid']);

		$top_data['add_css'] = array("/m/m_mail_css");
		$top_data['add_js'] = array("/m/m_mail_js","/layer_popup/qna_add_popup_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', $nav); //탑메뉴 로딩

		$this->load->view('/m/m_top_v',$top_data);
		$this->load->view('/m/etc/m_business_mail_v', @$data);
		$this->load->view('m/m_bottom0_v');

	}


	function cert_popup_mobile(){
		//휴대폰인증 1:1문의 레이어팝업 AJAX

		$mode = $this->security->xss_clean(url_explode($this->seg_exp, 'mode'));
		if(empty($mode)){ $mode = 1; }

		if($mode == 1){
			//회원가입
			$data['mode'] = "회원가입";
		}else if($mode == 2){
			//본인인증
			$data['mode'] = "본인인증";
		}

		$top_data['add_css'] = array("layer_popup/qna_add_popup_css");
		$top_data['add_js'] = array("layer_popup/qna_add_popup_js");
		$top_data['add_title'] = "일대일 문의하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('/m/etc/m_cert_popup_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


	function cert_request_mobile(){
		//휴대폰인증 1:1문의 submit

		$mode = $this->input->post('mode', true);
		
		//모드값에 따른 타이틀 변경
		if($mode == "회원가입"){
			$qna_title = "모바일 회원가입 1:1 문의";
		}else if($mode == "본인인증"){
			$qna_title = "모바일 휴대폰인증 1:1 문의";
		}else{
			$qna_title = "모바일 기타 문의사항";
		}

		$browser = get_browser(null, true);

		$tel_1 = strip_tags(rawurldecode($this->input->post('cert_ph_1', true)));
		$tel_2 = strip_tags(rawurldecode($this->input->post('cert_ph_2', true)));

		$cert_birthday_1 = strip_tags(rawurldecode($this->input->post('cert_year', true)));
		$cert_birthday_2 = strip_tags(rawurldecode($this->input->post('cert_month', true)));
		$cert_birthday_3 = strip_tags(rawurldecode($this->input->post('cert_day', true)));

		if(strlen($cert_birthday_2)==1){ $cert_birthday_2 = "0".$cert_birthday_2; }
		if(strlen($cert_birthday_3)==1){ $cert_birthday_3 = "0".$cert_birthday_3; }

		$arr_data = array(
			"f_name"		=> strip_tags(rawurldecode($this->input->post('cert_name', true))),
			"f_userid"		=> "mobile",
			"f_title"		=> $qna_title,
			"f_mail"		=> $cert_birthday_1.".".$cert_birthday_2.".".$cert_birthday_3,
			"f_cate1"		=> '1',
			"f_cate2"		=> '0',
			"f_tel"			=> $tel_1.$tel_2,
			"f_mail"		=> strip_tags(rawurldecode($this->input->post('qna_email', true))),
			"f_content"		=> strip_tags(rawurldecode($this->input->post('cert_content', true))),
			"f_answerYN"	=> "N",
			"f_writeday"	=> NOW,
			"f_os"			=> $browser['platform'],
			"f_browser"		=> $browser['browser']." ".$browser['version']
		);

		$rtn = $this->my_m->insert("Faq_reporter", $arr_data);
		
		echo $rtn;		//정상등록
	}
	
	
	//관리자에게 인증요청하기 레이어팝업
	function reg_member_auth_layer(){
		
		$user_id = @$this->session->userdata['regi_id'];
		if(empty($user_id)){ alert_goto('다시로그인 하십시요.', '/'); }
		
		//여성회원인치 체크후 인증막기
		if(@$this->session->userdata['regi_sex'] == "F"){
			echo "F";
			exit;
		}		

		//인증 대기중 체크
		$cnt = $this->my_m->cnt('reg_member_auth', array('user_id' => $user_id, 'use_yn' => 'Y'));
		if($cnt > 0){ echo "인증대기중"; exit; }
		
		$top_data['add_css'] = array();
		$top_data['add_js'] = array('layer_popup/reg_member_auth_js');
		$top_data['add_title'] = "관리자에게 인증요청하기";
		$top_data['add_text'] = "";
		
		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/manager_request_v');
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//관리자에게 인증요청하기 간편 본인인증 처리 함수
	function reg_member_name_check(){

		$regi_user_name			= rawurldecode($this->input->post('regi_user_name', true));			//이름
		$regi_birth_year		= rawurldecode($this->input->post('regi_birth_year', true));		//년
		$regi_birth_month		= rawurldecode($this->input->post('regi_birth_month', true));		//월
		$regi_birth_day			= rawurldecode($this->input->post('regi_birth_day', true));			//일
		$regi_sex				= rawurldecode($this->input->post('regi_sex', true));				//성별
		
		if(strlen($regi_birth_month) == 1){ $regi_birth_month = "0".$regi_birth_month; }			//1자리 월에 앞에 0 붙이기
		if(strlen($regi_birth_day) == 1){ $regi_birth_day = "0".$regi_birth_day; }					//1자리 일에 앞에 0 붙이기

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
		
		//간편인증에 맞게 성별 코드 변환
		if($regi_sex == "M"){
			$user_sex = "1";		//남성 1 변환
		}else{
			$user_sex = "0";		//여성 0 변환
		}

		$strJumin		= $regi_birth_year.$regi_birth_month.$regi_birth_day;				//생년월일(생년월일8자리)
		$strName		= iconv('utf-8', 'euc-kr', $regi_user_name);						//이름
		$strgender		= $user_sex;														//여성 0, 남성 1 
		
		$iReturnCode  = "1";	

		//$iReturnCode = `$cb_encode_path $sSiteID $sSitePW $strJumin $strgender $strName`;	//생년월일 인증(생년월일8자리, 성별, 이름)

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

		echo $iReturnCode;

	}

	//인증번호 발송하기 함수
	function reg_member_auth_rand_num(){
		
		//변수받기
		$commid		= rawurldecode($this->input->post('commid', true));		//통신사(SKT, KT, LGU, ETC)
		$hp1		= rawurldecode($this->input->post('hp1', true));		//휴대전화번호1
		$hp2		= rawurldecode($this->input->post('hp2', true));		//휴대전화번호2
		$hp3		= rawurldecode($this->input->post('hp3', true));		//휴대전화번호3
		
		//세션 데이터 변수에 넣기
		$user_id			= @$this->session->userdata['regi_id'];				//임시회원 아이디
		$user_name			= @$this->session->userdata['regi_user_name'];		//임시회원 이름
		$user_birth_year	= @$this->session->userdata['regi_birth_year'];		//임시회원 생년월일(년)
		$user_birth_month	= @$this->session->userdata['regi_birth_month'];	//임시회원 생년월일(월)
		$user_birth_day		= @$this->session->userdata['regi_birth_day'];		//임시회원 생년월일(일)
		$user_sex			= @$this->session->userdata['regi_sex'];			//임시회원 성별

		$rand_num = str_pad(mt_rand(0, 999999), 6, 0);		//랜덤 번호 만들기(6자리)
		
		//데이터변수들 배열로 만들기
		$data_arr = array($user_id, $user_name, $user_birth_year, $user_birth_month, $user_birth_day, $user_sex, $commid, $hp1, $hp2, $hp3, $rand_num);

		//인증번호 무제한 발송받기 막기(1일 기준 10번)
		$reg_cnt = $this->my_m->cnt('reg_member_auth', array('user_id' => $user_id, 'ex_data_1' => 'write_date >= "'.date('Y-m-d').' 00:00:00" and write_date <= "'.date('Y-m-d').' 24:00:00"'));

		if($reg_cnt >= 10){
			
			//마지막 인증번호 발송 시간이 1시간이 지났을경우는 인증번호 발송 아닐경우는 1시간 대기
			$last_data = $this->my_m->row_array('reg_member_auth', array('user_id' => $user_id), 'idx', 'desc', '1');

			if(NOW < date("Y-m-d H:i:s", strtotime($last_data['write_date']."+1 hour"))){
				//마지막 인증번호 발송으로 부터 1시간이 안지난경우 error_code 1000
				$rtn = "1000";
			}else{
				//인증번호 새로 발송
				$rtn = $this->reg_member_data_insert($data_arr);
			}
			
		}else{
			$rtn = $this->reg_member_data_insert($data_arr);
		}
		
		echo $rtn;

	}
	
	//임시회원 랜덤번호 발송 및 데이터 추가하기 함수
	function reg_member_data_insert($data_arr){
		
		//0:아이디		1:이름		2:년				  3:월				4:일				  5:성별		 6:통신사	  7,8,9:휴대전화번호		10:인증번호
		//$user_id, $user_name, $user_birth_year, $user_birth_month, $user_birth_day, $user_sex, $commid, $hp1, $hp2, $hp3, $rand_num

		//임시회원 랜덤번호 발송 데이터 추가
		$arrData = array(
			"user_id"		=> $data_arr[0],
			"user_name"		=> $data_arr[1],
			"year"			=> $data_arr[2],
			"month"			=> $data_arr[3],
			"day"			=> $data_arr[4],
			"sex"			=> $data_arr[5],
			"commid"		=> $data_arr[6],
			"hp1"			=> $data_arr[7],
			"hp2"			=> $data_arr[8],
			"hp3"			=> $data_arr[9],
			"rand_num"		=> $data_arr[10],
			"use_yn"		=> "N",
			"write_date"	=> NOW
		);
		
		$rtn = $this->my_m->insert('reg_member_auth', $arrData);
		
		//랜덤번호 문자 발송 처리
		if($rtn == 1){
			$hptele = $data_arr[7].$data_arr[8].$data_arr[9];
			$sms_msg = "조이헌팅입니다.\n인증번호는 ".$data_arr[10]." 입니다.";
			$this->sms_lib->sms_send('', array($hptele), $sms_msg);
		}
		
		return $rtn;
	}

	//인증번호 체크하기 함수(접수 완료 처리 단계)
	function reg_member_auth_rand_num_check(){

		$rand_num = rawurldecode($this->input->post('rand_num', true));		//인증번호
		$etc	  = rawurldecode($this->input->post('etc', true));			//기타내용

		//임시세션 데이터 가져오기
		$user_id = @$this->session->userdata['regi_id'];					//임시회원 아이디
		if(empty($user_id)){ echo "1000"; exit; }							//잘못된 접근
		
		//인증번호 신청받은 데이터 가져오기
		$auth_data = $this->my_m->result_array('reg_member_auth', array('user_id' => $user_id), 'idx', 'desc', null);
		if(empty($auth_data)){ echo "1000"; exit; }
		
		$idx = "";
		foreach($auth_data as $data){
			if($data['rand_num'] == $rand_num){
				$idx = $data['idx'];
				break;
			}
		}

		if(!empty($idx)){
			$rtn = $this->my_m->update('reg_member_auth', array('idx' => $idx), array('use_yn' => 'Y', 'etc' => strip_tags($etc), 'write_date' => NOW));
		}else{
			$rtn = "";
		}

		echo $rtn;

	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/

