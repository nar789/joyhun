<?php

class E_mail extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('alrim_helper');

	}

	function index(){
		
		if($_SERVER['REMOTE_ADDR'] == "59.11.70.223" or $_SERVER['REMOTE_ADDR'] == "14.47.36.51"){
			
			$m_data = $this->member_lib->get_member($this->session->userdata['m_userid']);

			$data['contenst_sub1'] = "
				<font style='color:red; font-weight:bold;'>".$m_data['m_name']."</font> 고객님. 안녕하세요!<br>
				고객님께서는 <font style='color:red; font-weight:bold;'>".date('Y')."</font>년 <font style='color:red; font-weight:bold;'>".date('m')."</font>월 <font style='color:red; font-weight:bold;'>".date('d')."</font>일에 일반회원으로 가입 되셨습니다.<br>
				가입하신 내역은 아래와 같습니다.
			";

			$navs = array('미팅신청','메인'); //상단메뉴에 들어가는 현재위치

			$top_data['add_css'] = array("intro/e_mail_css");
			$top_data['add_js'] = array("intro/meeting_intro_js");

			$this->load->view('top0_v',$top_data);
			$this->load->view('intro/reg_e_mail_v', @$data);
			$this->load->view('bottom0_v');

		}else{

			echo $_SERVER['REMOTE_ADDR']; 
			alert_goto('잘못된 접근입니다.', '/');
			exit;

		} //사무실만 보이기
		
		
	}
	
	//이메일 수신거부
	function block(){

		$data['m_mail'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mail')));
		
//		if(empty($data['m_mail'])){
//			alert_goto('잘못된 접근입니다.', '/');
//		}

		//view 설정
		$navs = array('메인','조이톡소개'); //상단메뉴에 들어가는 현재위치

		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("etc/my_mail_css");
		$top_data['add_js'] = array("etc/my_mail_js");

		$this->load->view('top_v', $top_data);
		$this->load->view('intro/mail_block_v', $data);
		$this->load->view('bottom_v');

	}

	//이메일 수신거부 처리 함수
	function call_email_block(){

		$m_mail = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mail')));

		if(empty($m_mail)){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}
		
		$member = $this->my_m->result_array('TotalMembers', array('m_mail' => $m_mail), 'm_num', 'desc');

		if(empty($member)){
			$member = $this->my_m->result_array('TotalMembers_old', array('m_mail' => $m_mail), 'm_num', 'desc');
		}
		
		if(!empty($member)){

			foreach($member as $data){
				$this->my_m->update('TotalMembers', array('m_userid' => $data['m_userid']), array('m_mail_yn' => 'N'));
				call_email_staus($data['m_userid'], 'N');		//latest_helper 이메실수신거부시 알림이메일도 전부 수신거부처리
			}
		}		

		echo "1";

	}
	
	//알림 이메일
	function e_mail_notice(){
		
		$this->load->view('top0_v');
		//$this->load->view('intro/e_mail_notice_v');
		$this->load->view('intro/e_mail_notice_v2');
		$this->load->view('bottom0_v');
	}



	//리뉴얼 이메일
	function e_mail_renewal(){
		
		$this->load->view('top0_v');
		$this->load->view('intro/e_mail_renewal_v');
		$this->load->view('bottom0_v');
	}
	
	//여성전용선물 이벤트 이메일
	function event_gift_mail(){
		
		$this->load->view('top0_v');
		$this->load->view('intro/event_gift_mail_v');
		$this->load->view('bottom0_v');
	}

	//20160825 굿바이 핫섬머 이벤트
	function event_mail_20160825(){
		
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20160825_v');
		$this->load->view('bottom0_v');
	}

	//20160930 굿바이 가을이야기 이벤트
	function event_mail_20160930(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20160930_v');
		$this->load->view('bottom0_v');
	}

	//20161010 조이헌팅 여성회원 리워드 이벤트
	function event_mail_20161010(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161010_v');
		$this->load->view('bottom0_v');
	}

	//20161014 조이헌팅 가을에는 사랑하게 해주소서 이벤트
	function event_mail_20161014(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161014_v');
		$this->load->view('bottom0_v');
	}

	//20161031 깊어가는 가을, 조이헌팅에서 따뜻한인연 만들어가세요~
	function event_mail_20161031(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161031_v');
		$this->load->view('bottom0_v');
	}

	//20161114 슈퍼문 기운을 받아서 인연만들기 성공!!
	function event_mail_20161114(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161114_v');
		$this->load->view('bottom0_v');
	}


	//20161205 (광고) 떨리는 겨울, 홍길동님에게 뜨거운 사랑이 다가옵니다.
	function event_mail_20161205(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161205_v');
		$this->load->view('bottom0_v');
	}

	//20161221 (광고) 크리스마스에 사랑의 인연을 만들어보세요.
	function event_mail_20161221(){
	
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20161221_v');
		$this->load->view('bottom0_v');
	}

	//20170105 (광고) 새해 복 많이 받으세요.
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170105(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170105_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 놓치고 후회하지 마시고 용기내어 보세요!
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170216(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170216_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 봄맞이 설레는 인연을 만들어보세요!
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170228(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170228_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 화이트데이에 여심을 공략해보세요!!
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170313(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170313_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 황금연휴가 많은 5월 채팅하시고 즐거운 인연만드세요~
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170428(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170428_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 황금연휴가 많은 5월 채팅하시고 즐거운 인연만드세요~
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20170622(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20170622_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 조이헌팅에서 따뜻한 인연만드세요~
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20171117(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20171117_v');
		$this->load->view('bottom0_v');
	}

	
	//(광고) [$m_name$]님 따뜻한 봄, 조이헌팅과 함께 꽃따라 떠나자
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20180320(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20180320_v');
		$this->load->view('bottom0_v');
	}

	//(광고) [$m_name$]님 조이헌팅에서 가장 핫한 분들을 소개해드립니다!
	//대상 남자, 정회원, 이메일수신허용
	function event_mail_20180529(){
			
		$this->load->view('top0_v');
		$this->load->view('intro/event_mail_20180529_v');
		$this->load->view('bottom0_v');
	}


}
/* End of file main.php */
/* Location: ./application/controllers/ */