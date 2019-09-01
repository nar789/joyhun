<?php

class Dormancy extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('tank_auth');
	}



	// 휴면계정 PWD변경
	function mb_dormancy(){

		// 모바일 일경우
		if(IS_MOBILE == true){

			$this->load->library('m_top_menu_lib');

			//view 설정
			$top_data['add_css'] = array("/m/mb_dormancy_css");
			$top_data['add_js'] = array("/m/mb_dormancy_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"비밀번호 변경"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/auth/m_dormancy_v', @$data);
			$this->load->view('m/m_bottom_v');

		// PC버전일 경우
		}else{


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

			$top_data['add_css'] = array("member/mb_dormancy_css");
			$top_data['add_js'] = array("member/mb_dormancy_js");	

			$this->load->view('top_v',$top_data);
			$this->load->view('auth/dormancy_v', @$data);
			$this->load->view('bottom_v');
	
		}

	}

	// user 체크
	function check_user(){

		$bir_1 = $this->input->post('bir_1',TRUE);
		$bir_2 = $this->input->post('bir_2',TRUE);
		$bir_3 = $this->input->post('bir_3',TRUE);

		$bir_1 = substr($bir_1, '2', '2');

		$search['m_jumin1'] = $bir_1.$bir_2.$bir_3;
		$search['m_userid'] = $this->input->post('m_user',TRUE);
		$search['m_name'] = $this->input->post('m_name',TRUE);

		$check_ok =  $this->my_m->cnt("TotalMembers",$search);

		//회원테이블에 데이터가 없을경우 휴먼계정 체크
		if($check_ok == "0"){
			$check_ok =  $this->my_m->cnt("TotalMembers_old",$search);
		}

		if ($check_ok > 0){
			echo "1";
		}else{
			echo "4";
		}
	}


	//이메일 인증
	function my_email_popup(){

		$my_email = $this->session->userdata('mail');
		$m_email = explode("@",$my_email);

		// 이메일 가리기용도
		$email_cnt = strlen($m_email[0]);
		$e_hidden = '';

		for ($i=0;$i<$email_cnt-3; $i++){
			$e_hidden .= '*';
		}

		$data['email_id'] =  substr($m_email[0], 0, 3);
		$data['email_hidden'] = $e_hidden;
		$data['email_sub'] = $m_email[1];

		$top_data['add_css'] = array("member/mb_dormancy_css");
		$top_data['add_js'] = array("member/mb_dormancy_js");
		$top_data['add_title'] = "이메일 인증";
		$top_data['add_text'] = "";

		// 모바일 일경우
		if(IS_MOBILE == true){

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/mobile_email_request_v',@$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}else{

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/m_email_request_v',@$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}

	}

	//가입시 등록한 휴대폰 인증
	function my_join_hpone_popup(){

		$top_data['add_css'] = array("member/mb_dormancy_css");
		$top_data['add_js'] = array("member/mb_dormancy_js");
		$top_data['add_title'] = "가입시 등록한 휴대폰 인증";
		$top_data['add_text'] = "";

		
		$my_hp = $this->session->userdata('phone');

		$data['my_hp1'] =  substr($my_hp, 0, 3);
		$data['my_hp3'] =  substr($my_hp, 7, 4);

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/m_join_ph_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}
	
	//본인명의 휴대폰 인증
	function my_phone_popup(){

		$top_data['add_css'] = array("member/mb_dormancy_css");
		$top_data['add_js'] = array("member/mb_dormancy_js");
		$top_data['add_title'] = "본인명의 휴대폰 인증";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/m_ph_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	// 이메일보내기
	function email_send()
	{

        $config = Array(        
             'mailtype'  => 'html'
         );

		$this->load->library('email',$config);

		$my_email = $this->session->userdata['mail'];
		$my_user  = $this->session->userdata['user'];
		$e_code = mt_rand(1000000000, 9999999999);

		$this->email->from('admin@joyhunting.com', 'joyhunting');
		$this->email->to($my_email." Content-Type:text/html");
		$this->email->subject('조이헌팅 인증메일을 보내드립니다.');
		$this->email->message('조이헌팅 이메일 본인인증을위해<br><br><a href="http://'.$_SERVER["HTTP_HOST"].'/etc/dormancy/email_cert/code/'.$e_code.'">[이곳]</a>을 클릭하세요. ');
		$this->email->send();

		$arr_data = array(
			'send_day'		=> NOW,
			'user_id'		=> $my_user,
			'send_adr'		=> $my_email,
			'cert_code'		=> $e_code
		);

		$s_email =  $this->my_m->insert('code_email', $arr_data);

		echo $s_email;
	}

	//이메일 인증의 메일 팝업
	function email_cert(){

		$search['cert_code'] = $this->security->xss_clean(url_explode($this->seg_exp, 'code')); if(!$search['cert_code']){exit;}
		$search['user_id'] = $this->session->userdata['user']; if(!$search['user_id']){exit;}

		$s_email =  $this->my_m->row_array('code_email', $search);

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"><html xmlns="http://www.w3.org/1999/xhtml">';
		echo '<head><meta http-equiv="content-type" content="text/html; charset=UTF-8"/></head>';


		// 결과값이 없을시
		if(empty($s_email)){ 

			echo "<script>alert('실패하였습니다.관리자에게 문의해주세요.');window.open('', '_self', '');window.close();</script>";

		// 인증완료시
		}else{

			$data_arr = array(
				'check_day'		=> NOW,
				'e_cate'		=> '이메일'
			);

			$email_fin =  $this->my_m->update('code_email', array('user_id' => $search['user_id']),$data_arr);

			if ($email_fin == '1'){
				echo "<script>alert('인증되었습니다.\\n조이헌팅페이지로 돌아가 비밀번호를 변경해주세요.');window.open('', '_self', '');window.close();</script>";
			}else{
				echo "<script>alert('실패하였습니다.관리자에게 문의해주세요.');window.open('', '_self', '');window.close();</script>";
			}
		}
	}
	
	//이메일 체크
	function email_check(){

		$search['user_id'] = $this->session->userdata['user']; if(!$search['user_id']){exit;}
		$email_cnt =  $this->my_m->row_array('code_email', $search);

		if ($email_cnt['check_day'] != null){
			echo "1";
		}else{
			echo "4";
		}
	}


	//가입시 등록한 휴대폰 인증 코드받기
	function m_join_phone(){

		$this->load->library('sms_lib');

		$my_phone = $this->session->userdata['phone'];

		if ($my_phone == '' || $my_phone == NULL ){
			echo "4";
			exit;
		}
		$my_user  = $this->session->userdata['user'];
		$e_code = mt_rand(100000, 999999);
		
		$rtn = $this->sms_lib->sms_send("#1470",array($my_phone),"[www.joyhunting.com] 본인확인 인증번호 [".$e_code."]를 화면에 입력해주세요.");

		$arr_data = array(
			'send_day'		=> NOW,
			'user_id'		=> $my_user,
			'send_adr'		=> $my_phone,
			'cert_code'		=> $e_code
		);

		$m_email =  $this->my_m->insert('code_email', $arr_data);

		echo $m_email;

	}

	function m_join_phone_check(){

		$search['user_id'] =  $this->session->userdata['user'];
		$num_ck = $this->input->post('num_ck',TRUE);

		$check = $this->my_m->row_array('code_email', $search, 'send_day');

		// 사용자 입력코드와 입력코드가 일치하는지 검사
		if ($check['cert_code'] == $num_ck){

			$data_arr = array(
				'check_day'		=> NOW,
				'e_cate'		=> '휴대폰'
			);

			$m_phone_fin =  $this->my_m->update('code_email', array('user_id' => $search['user_id']), $data_arr);

			if ($m_phone_fin == '1'){
				echo "1";
			}else{
				echo "7";
			}

		}else{
			echo "4";
		}

	}

	// 비밀번호 업데이트
	function fin_new_mb(){

		$m_pwd = urldecode(trim($this->input->post('m_pwd',TRUE)));

		$hashed_password = encryption_pass($m_pwd);

		//회원테이블 조회 데이터가 없을경우 휴면계정 테이블 조회
		$member = $this->my_m->row_array('TotalMembers', array('m_userid' => $this->session->userdata['user']), 'm_num', 'desc', '1');

		if(!empty($member)){
			//회원테이블에 데이터가 있을경우
			$rtn = $this->my_m->update('TotalMembers', array("m_userid" => $this->session->userdata['user']), array("m_pwd" =>  "$hashed_password", "last_login_day" => NOW) );
		}else{
			//회원테이블에 데이터가 없을경우(휴면계정)
			$rtn_old = $this->my_m->update('TotalMembers_old', array("m_userid" => $this->session->userdata['user']), array("m_pwd" =>  "$hashed_password", "last_login_day" => NOW) );

			if($rtn_old == "1"){
				$rtn = $this->member_lib->old_member_new($this->session->userdata['user']);
			}

		}		

		echo $rtn;

	}


}