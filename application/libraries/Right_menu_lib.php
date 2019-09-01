<?php 
/*place this in libraries folder*/ 
class Right_menu_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
	}

	function view($top_style="default"){

		ob_start();
		
		if($top_style =="default"){
			$this->login_box(); //로그인박스
			$this->find_5min(); //빠른회원찾기
			$this->today_talk(); //투데이 토크
			$this->vote_box(); //공감POLL
			$this->secret_talk_chat(); //비밀톡챗
			$this->meeting_banner3(); //하단 배너8
			$this->notice(); //공지사항
		}else 	if($top_style =="meeting"){
			$this->login_box(); //로그인박스
			$this->new_meeting_member(); //신규미팅 신청자
			$this->member_age(); //나이별 접속회원
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->meeting_banner1(); //하단 배너1
			$this->meeting_banner2(); //하단 배너2
		}else 	if($top_style =="meeting_beongae"){
			$this->login_box(); //로그인박스
			$this->lover_alrime(); //이상형 접속 알리미
			$this->friends_alrime(); //친구접속 알리미
			$this->meeting_banner2(); //하단 배너2
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->best_member(); //베스트 회원
			$this->meeting_banner3(); //하단 배너3
		}else if ($top_style =="photo_meeting"){ //포토미팅
			$this->login_box(); //로그인박스
			$this->lover_alrime(); //이상형 접속 알리미
			$this->friends_alrime(); //친구접속 알리미
			$this->meeting_banner5(); //하단 배너5
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->best_member(); //베스트 회원
			$this->meeting_banner2(); //하단 배너2
		}else if ($top_style =="blind_talk"){ //소개팅+토크 배너
			$this->login_box(); //로그인박스
			$this->lover_alrime(); //이상형 접속 알리미
			$this->friends_alrime(); //친구접속 알리미
			$this->meeting_banner7(); //하단 배너7
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->best_member(); //베스트 회원
			$this->meeting_banner3(); //하단 배너3
		}else if ($top_style =="secret_talk"){ //비밀+토크 배너
			$this->login_box(); //로그인박스
			$this->lover_alrime(); //이상형 접속 알리미
			$this->friends_alrime(); //친구접속 알리미
			$this->meeting_banner5(); //하단 배너5
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->best_member(); //베스트 회원
			$this->meeting_banner3(); //하단 배너3
		}else 	if($top_style =="profile_right"){
			$this->login_box(); //로그인박스
			$this->profile_right(); //프로필
		}else 	if($top_style =="blind_like"){	//소개팅
			$this->login_box(); //로그인박스
			$this->my_like_list(); //좋아요
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->best_member(); //베스트 회원
			//$this->meeting_banner4(); //하단 배너4
		}else 	if($top_style =="meeting_smsting"){
			$this->login_box(); //로그인박스
			$this->sms_box(); //문자팅 문자 보내기 박스
			$this->sms_chu_member(); //추천 문자팅 회원
		}else 	if($top_style =="movie"){
			$this->login_movie_box(); //최신영화 로그인박스
			$this->hot_movie(); //HOT movie
			$this->movie_rank(); //오늘의 인기순위
		}else 	if($top_style =="service"){
			$this->service_menu(); //고객센터
		}else 	if($top_style =="intro_meeting"){
			$this->login_box(); //로그인박스
			$this->new_member(); //최근접속회원
			$this->live_beongae(); //실시간 번개팅
			$this->best_photo(); //BEST 사진인증회원
			$this->intro_box(); //채팅
		}else 	if($top_style =="intro_chatting"){
			$this->login_box(); //로그인박스
			$this->age_solo(); //나이별 솔로모임
			$this->chatting_map(); //5분거리 접속이성 탐지기
			$this->chat_new_member(); //신규회원을 소개합니다~
		}else 	if($top_style =="intro_ann"){
			$this->login_box(); //로그인박스
			$this->ann_news(); //내 앤들의 반가운 소식
			$this->vote_box(); //공감 POLL
			$this->ann_invite(); //채팅초대하기
			$this->ann_tags(); //인기태그
		}else 	if($top_style =="intro_beongaetting"){
			$this->login_box(); //로그인박스
			$this->bg_minutes5_box(); //5분거리 접속이성 검색하기
			$this->bg_live_status(); //실시간 번개팅 신청 현황
			$this->bg_online_member(); //현재 접속중인 회원
		}else 	if($top_style =="intro_search"){
			$this->login_box(); //로그인박스
			$this->member_age(); //나이별 접속회원
			$this->best_photo(); //BEST 사진인증회원
			$this->search_bottom(); //연애 결혼성공 
		}else 	if($top_style =="gift_shop"){
			$this->login_box(); //로그인박스
			$this->lover_alrime(); //이상형 접속 알리미
			$this->friends_alrime(); //친구접속 알리미
			$this->meeting_banner2(); //하단 배너2 ( 10명의 이성에게 초대장을 날리세요~)
			$this->find_5min(); //5분거리 접속이성 찾기
			$this->search_fast_member(); //빠른회원찾기
			$this->bg_minutes5_box(); //5분거리 접속이성 검색하기
			$this->best_member(); //베스트 회원
			$this->meeting_banner3(); //하단 배너3 ( 오늘은 다들 무슨재밌는 얘기를 하고있을까? )
			$this->meeting_banner5(); //하단 배너5 ( 우리끼리 비밀스럽게~ )
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	function login_box(){
		//로그인박스
		if (IS_LOGIN) {

			$this->ci->load->helper('alrim_helper');

			//로그인 상태
			$data['login_user_id'] = $this->ci->session->userdata('m_userid');
			$data['login_user_nick'] = $this->ci->session->userdata('m_nick');
			$data['login_user_sex'] = $this->ci->session->userdata('m_sex');
			$data['login_user_age'] = $this->ci->session->userdata('m_age');
			
			//친구등록, 채팅신청, 찜하기가 24시간 이내에 있을경우 new 아이콘 띄우기(alrim_helper)
			$new1 = new_friend_chk($data['login_user_id'], '친구');
			$new2 = new_friend_chk($data['login_user_id'], '톡챗');
			$new3 = new_friend_chk($data['login_user_id'], '찜');
			
			$n_img_val1 = "";
			$n_img_val2 = "";
			$n_img_val3 = "";

			$data['n_img_url1'] = "/profile/my_friend/send_friend";
			$data['n_img_url2'] = "/profile/my_chat/chatting_list";
			$data['n_img_url3'] = "/profile/jjim/send_jjim";

			if(!empty($new1)){
				$n_img_val1 = "<img src='".IMG_DIR."/new_bage.png'>";
				$data['n_img_url1'] = "/profile/my_friend/receive_friend";
			}
			if(!empty($new2)){
				$n_img_val2 = "<img src='".IMG_DIR."/new_bage.png'>";
			}
			if(!empty($new3)){
				$n_img_val3 = "<img src='".IMG_DIR."/new_bage.png'>";
				$data['n_img_url3'] = "/profile/jjim/receive_jjim";
			}

			//NEW 아이콘 처리
			$data['new_icon1'] = $n_img_val1;
			$data['new_icon2'] = $n_img_val2;
			$data['new_icon3'] = $n_img_val3;

			$this->ci->load->view('right_menu/login_ok_box_v',$data);
		}else{
			//로그아웃상태
			$data['login'] = array(
				'name'	=> 'login',
				'id'	=> 'login',
				'value' => $this->ci->input->cookie('do_id_save'),
				'maxlength'	=> 80,
				'size'	=> 30,
			);
			$data['password'] = array(
				'name'	=> 'password',
				'id'	=> 'password',
				'size'	=> 30,
			);
			$data['remember'] = array(
				'name'	=> 'remember',
				'id'	=> 'remember',
				'value'	=> 1,
				'checked'	=> set_value('remember'),
				'style' => 'margin:0;padding:0',
			);
			$data['captcha'] = array(
				'name'	=> 'captcha',
				'id'	=> 'captcha',
				'maxlength'	=> 8,
			);
			$data['save_id'] = array(
				'name'	=> 'save_id',
				'id'	=> 'save_id',
				'value'	=> 1,
				'checked'	=> 'true',
				'style' => 'margin:0;padding:0',
			);

			$data['login_url'] = "/";
			
			if($this->ci->input->server('PHP_SELF') == "/index.php/main/start"){
				$en_url = "/";
			}else{
				$en_url = $this->ci->input->server('PHP_SELF');
			}

			$rpath = str_replace("index.php/", "", $en_url);
			$data['rpath_encode'] = url_code($rpath, 'e');

			$this->ci->load->view('right_menu/login_box_second_v',$data);
		}

	}

	function login_movie_box(){
		//무비 로그인 박스
		
		if (IS_LOGIN) {
			//로그인 상태
			$data['login_user_id'] = $this->ci->session->userdata('m_userid');
			$data['login_user_nick'] = $this->ci->session->userdata('m_nick');
			$this->ci->load->view('right_menu/login_ok_movie_box_v',$data);
		}else{
			//로그아웃상태
			$data['login'] = array(
				'name'	=> 'login',
				'id'	=> 'login',
				'value' => $this->ci->input->cookie('do_id_save'),
				'maxlength'	=> 80,
				'size'	=> 30,
			);
			$data['password'] = array(
				'name'	=> 'password',
				'id'	=> 'password',
				'size'	=> 30,
			);
			$data['remember'] = array(
				'name'	=> 'remember',
				'id'	=> 'remember',
				'value'	=> 1,
				'checked'	=> set_value('remember'),
				'style' => 'margin:0;padding:0',
			);
			$data['captcha'] = array(
				'name'	=> 'captcha',
				'id'	=> 'captcha',
				'maxlength'	=> 8,
			);
			$data['save_id'] = array(
				'name'	=> 'save_id',
				'id'	=> 'save_id',
				'value'	=> 1,
				'checked'	=> $this->ci->input->cookie('do_id_save'),
				'style' => 'margin:0;padding:0',
			);

			$data['login_url'] = "/";

			$rpath = str_replace("index.php/", "", $this->ci->input->server('PHP_SELF'));
			$data['rpath_encode'] = url_code($rpath, 'e');

			$this->ci->load->view('right_menu/login_movie_box_v',$data);
		}

	}

	function search_fast_member(){
		//빠른회원찾기
		$this->ci->load->view('right_menu/search_fast_member_v');
	}

	function secret_talk_chat(){
		//비밀톡챗
		$this->ci->load->helper('level_helper');
		$this->ci->load->view('right_menu/secret_talk_chat_v');
	}

	function vote_box(){
		//공감POLL
		$this->ci->load->view('right_menu/vote_box_v');
	}

	function today_talk(){
		//투데이 토크
		$this->ci->load->view('right_menu/today_talk_v');
	}

	function notice(){
		//공지사항
		$this->ci->load->view('right_menu/notice_v');
	}

	function new_meeting_member(){
		//신규미팅 신청자
		$this->ci->load->view('right_menu/new_meeting_member_v');
	}

	function member_age(){
		//나이별 접속회원
		$this->ci->load->view('right_menu/member_age_v');
	}

	function find_5min(){
		//5분거리 접속이성 찾기
		$this->ci->load->view('right_menu/find_5min_v');
	}

	function meeting_banner1(){
		//하단 배너1 (조이헌팅 소셜팅)
		$this->ci->load->view('right_menu/meeting_banner1_v');
	}

	function meeting_banner2(){
		//하단 배너2 (10명의 이성에게 초대장을 날리세요)
		$this->ci->load->view('right_menu/meeting_banner2_v');
	}

	function meeting_banner3(){
		//하단 배너3 (토크 오늘은 다들 무슨재밌는 얘기를 하고있을까?)
		$this->ci->load->view('right_menu/meeting_banner3_v');
	}

	function meeting_banner4(){
		//하단 배너4 (문자팅하실래요?)
		$this->ci->load->view('right_menu/meeting_banner4_v');
	}

	function meeting_banner5(){
		//하단 배너5 (1:1 우리끼리 비밀스럽게)
		$this->ci->load->view('right_menu/meeting_banner5_v');
	}

	function meeting_banner6(){
		//하단 배너6 (이 영화 보셨나요?)
		$this->ci->load->view('right_menu/meeting_banner6_v');
	}

	function meeting_banner7(){
		//하단 배너6 (하루 세번 소개팅!받고 이상형과 썸타자~)
		$this->ci->load->view('right_menu/meeting_banner7_v');
	}

	function meeting_banner8(){
		//5분거리 접속이성 찾기
		$this->ci->load->view('right_menu/meeting_banner8_v');
	}

	function lover_alrime(){
		//이상형 접속 알리미
		if(IS_LOGIN){
			//회원정보가져오기
			$member_data = $this->ci->member_lib->get_member($this->ci->session->userdata['m_userid']);
			
			if($member_data['m_sex'] == "M"){
				$m_sex = "F";
			}else{
				$m_sex = "M";
			}
			
			//본인의 성별과 반대되는 성별 검색, 원하는만남 또는 대화스타일이 일치하는경우 검색
			$search = array(
				"m_sex"			=> $m_sex,
				"ex_m_reason"	=> "(m_reason = '".$member_data['m_reason']."' or m_character = '".$member_data['m_character']."')"
			);

			$result = $this->ci->my_m->result_array('TotalMembers_login', $search, 'm_num', 'desc');

			
			$i = 0; 
			$arr = array();
			foreach($result as $data){
				$arr[$i] = array($data['m_userid'], $data['m_nick']);		//아이디와 닉네임 2차배열 생성
				$i++;
			}
			
			$data['arr'] = $arr;
			shuffle($data['arr']);

			if(count($data['arr']) <= 10){
				$data['max_num'] = count($data['arr']);
			}else{
				$data['max_num'] = 10;
			}
			
		}

		$this->ci->load->view('right_menu/lover_alrime_v', @$data);
	}

	function friends_alrime(){
		//친구 접속 알리미
		if(IS_LOGIN){
			//로그인상태에서만 
			$data['auto_friend_list'] = auto_friend_alrim($this->ci->session->userdata['m_userid']);	//latest_helper 에서 접속중인 친구목록 가져오기
		}		
		
		$this->ci->load->view('right_menu/friends_alrime_v', @$data);
	}

	function best_member(){
		//베스트 회원
		$this->ci->load->helper('level_helper');
		$this->ci->load->view('right_menu/best_member_v');
	}

	function sms_box(){
		//문자팅 문자 보내기 박스
		$this->ci->load->view('right_menu/sms_box_v');
	}

	function sms_chu_member(){
		//추천 문자팅 회원
		$this->ci->load->view('right_menu/sms_chu_member_v');
	}
	function profile_right(){
		//나의 채팅관리함

		$data['total_chat_cnt'] = $this->ci->my_m->cnt('chat_request', array('send_id' => $this->ci->session->userdata('m_userid') ));
		$data['total_chat_accept'] = $this->ci->my_m->cnt('chat_request', array('send_id' => $this->ci->session->userdata('m_userid'), 'status' => '수락' ));
		$data['total_chat_per'] =  (int)(@($data['total_chat_accept'] / $data['total_chat_cnt']) * 100)."%";

		$this->ci->load->view('right_menu/profile_v',@$data);
	}

	function my_like_list(){
		//소개팅 > 받은좋아요 등등
		if (IS_LOGIN) {
			$search['r_userid'] = $this->ci->session->userdata('m_userid');
			$data['recv_good'] = $this->ci->my_m->cnt('blind_history', $search);

			$search2['s_userid'] = $this->ci->session->userdata('m_userid');
			$data['send_good'] = $this->ci->my_m->cnt('blind_history', $search2);
			
			$data['to_good'] = $this->ci->blind_m->together_cnt('blind_history', 'b_idx', 'r_userid');

			$this->ci->load->view('right_menu/my_like_log_v',$data);

		}else{
			$this->ci->load->view('right_menu/my_like_log_v');
		}
	}

	function hot_movie(){
		//영화 HOT Movie
		$this->ci->load->view('right_menu/hot_movie_v');
	}

	function movie_rank(){
		//영화 인기순위
		$this->ci->load->view('right_menu/movie_rank_v');
	}

	function service_menu(){
		//고객센터 RIGHT_MENU
		$this->ci->load->view('right_menu/service_v');
	}

	function live_beongae(){
		//intro 실시간 번개팅
		$this->ci->load->view('right_menu/live_beongae_v');

	}

	function new_member(){
		//intro 최근접속회원
		$this->ci->load->view('right_menu/new_member_v');

	}

	function best_photo(){
		//intro BEST 사진인증회원
		$this->ci->load->view('right_menu/best_photo_v');

	}

	function intro_box(){
		//intro intro_box
		$this->ci->load->view('right_menu/intro_box_v');

	}

	function age_solo(){
		//chatting 나이별 솔로모임
		$this->ci->load->view('right_menu/age_solo_v');

	}

	function chatting_map(){
		//chatting 5분거리 지도
		$this->ci->load->view('right_menu/chatting_map_v');

	}

	function chat_new_member(){
		//chatting 신규회원소개
		$this->ci->load->view('right_menu/chat_new_member_v');

	}

	//ann_intro

	function ann_news(){
		//내 앤들의 반가운 소식
		$this->ci->load->view('right_menu/ann_news_v');

	}

	function ann_invite(){
		//전체채팅 초대하기
		$this->ci->load->view('right_menu/ann_invite_v');

	}

	function ann_tags(){
		//인기태그
		$this->ci->load->view('right_menu/ann_tags_v');

	}

	function bg_minutes5_box(){
		//5분거리 접속이성 검색하기
		$this->ci->load->view('right_menu/bg_minutes5_box_v');

	}

	function bg_live_status(){
		//실시간 번개팅 신청 현황
		$this->ci->load->view('right_menu/bg_live_status_v');

	}

	function bg_online_member(){
		//현재 접속중인 회원
		$this->ci->load->view('right_menu/bg_online_member_v');

	}

	function search_bottom(){
		//현재 접속중인 회원
		$this->ci->load->view('right_menu/search_bottom_v');

	}
	

}

?>
