<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->model('open_marry_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->library('tank_auth');
		$this->load->helper('level_helper');
		$this->load->helper('alrim_helper');
	}

	function index()
	{
		//채팅알림 카운트해서 재정의
		if(IS_LOGIN == true){ 
			user_alrim_cnt($this->session->userdata('m_userid'));
		}

		//임시세션 삭제하기
		if(!empty($this->session->userdata['regi_id'])){
			reg_session_init();
		}

		$this->main_view();
	}

	function start()
	{
		//$this->output->cache(10); //메인페이지 10분 캐싱 (비로그인 상태일때만)
		goto("/");
	}

	function main_view(){

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		// 남자3명
		$search['ex_not'] = "m_special IS NOT NULL";
		$search['m_special'] = "2";
		$search['m_sex'] = 'M';

		if(!$special_m = $this->cache->get('main_special_m')){
				$special_m =   $this->my_m->result_array('TotalMembers', $search);
				$this->cache->save('main_special_m', $special_m, 600);	//10분 캐시 사용
		}

		shuffle($special_m);
		$special_m = array(
						"0" => $special_m[0],
						"1" => $special_m[1],
						"2" => $special_m[2]);
		// 여자4명
		$search['ex_not'] = "m_special IS NOT NULL";
		$search['m_special'] = "2";
		$search['m_sex'] = 'F';

		if(!$special_f = $this->cache->get('main_special_f')){
				$special_f =   $this->my_m->result_array('TotalMembers', $search);
				$this->cache->save('main_special_f', $special_f, 600);	//10분 캐시 사용
		}

		shuffle($special_f);

		$special_f = array(
						"3" => $special_f[0],
						"4" => $special_f[1],
						"5" => $special_f[2],
						"6" => $special_f[3]);

		$data['ideal_type'] = $special_m+$special_f;
		shuffle($data['ideal_type']);

		//음악채팅 방리스트 가져오기
		if(IS_LOGIN == TRUE){
			$data['room_list'] =  $this->my_m->result_array('T_ChatRoom_List',null);
		}else{
			$data['room_list'] =  NULL;
		}

		//채팅방이 부족하면 강제 데이터 셋팅 (code_change_helper)
		$r_data = get_music_chat_rooms();

		for($i=count($data['room_list']);$i<5;$i++){
			$data['room_list'][$i] = $r_data[$i];
		}

		$data['mlist'] = $this->main_m->joy_magazine_rand_list();
		
		//view 설정
		$top_data['top_menu'] = $this->top_menu_lib->view(); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view(); //우측메뉴 로딩

		$top_data['add_css'] = array("main_css");
		$top_data['add_js'] = array("main_js");
		//$this->session->set_userdata('regi_ok','y');
		//회원가입후 첫 로그인일시
		if(IS_LOGIN and $this->session->userdata('regi_ok') == "y"){
			
			//회원가입 완료하면 처음한번 나오는 회원정보 레이어 팝업
			$bot_data['add_script'] = "
				<script>
				$(document).ready(function(){
					$.get('/main/register_ok_popup', function(data){
						modal.open({content: data,width : 560});
					});
				});
				</script>
			";

			$this->session->set_userdata('regi_ok',''); //첫 로그인 끝
		}

		$this->load->view('top_v',$top_data);
		$this->load->view('main_v', $data);
		$this->load->view('bottom_v',@$bot_data);
	}


	function register_ok_popup(){
		//회원가입 완료하면 처음한번 나오는 회원정보 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,0);

		$top_data['add_css'] = array("layer_popup/register_ok_popup_css");
		$top_data['add_js'] = array("layer_popup/register_ok_popup_js");
	
		//회원정보가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//본인의 지역에 해당되는 지역 치환 [지역] => 본인지역2
		if(strpos($member_data['my_intro'], '[지역]') !== false){
			$intro = str_replace('[지역]', $member_data['m_conregion2'], $member_data['my_intro']);
			$member_data = $this->my_m->update('TotalMembers', array('m_userid' => $this->session->userdata['m_userid']), array('my_intro' => $intro));
		}

		$data = array(
			"m_reason"		=> $member_data['m_reason'],
			"m_character"	=> $member_data['m_character'],
			"my_intro"		=> $member_data['my_intro']
		);
		
		if(IS_MOBILE == true){

			$top_data['add_title'] = "미팅정보설정";
			$top_data['add_text'] = "";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/register_ok_popup_m_v',$data);
			$this->load->view('layer_popup/popup_bottom_v');

		}else{
			
			$top_data['add_title'] = "미팅정보설정";
			$top_data['add_text'] = "본인에 맞게 수정하시면 채팅&미팅 성공률이 더~욱 높아집니다.";

			$this->load->view('layer_popup/popup_top_v',$top_data);
			$this->load->view('layer_popup/register_ok_popup_v',$data);
			$this->load->view('layer_popup/popup_bottom_v');
		}
		
	}

	function register_ok_modify(){
		//회원정보 레이어팝업 수정버튼 클릭

		$data_arr = array(
			'm_reason'=> $this->input->post('m_reason',TRUE),
			'm_character'=> $this->input->post('m_character',TRUE),
			'my_intro'=> strip_tags($this->input->post('my_intro',TRUE))
		);

		$rtn = $this->my_m->update("TotalMembers", array("m_userid" => $this->session->userdata('m_userid')), $data_arr);

		echo $rtn;
	}
	
	//모바일 메인
	function index_mobile()
	{
		//이번주 작업랭킹(추천이상형/인기지수 높은순으로)
		//$search_push['m_main_chu'] = "1"; // 추천이상형 삭제로 삭제
		//$data['this_week_rank'] = $this->my_m->result_array('TotalMembers_login', $search_push, 'm_popularity', 'desc', '5');

		if(IS_LOGIN == true){ 
			user_alrim_cnt($this->session->userdata('m_userid')); //채팅알림 카운트해서 재정의
			goto("/m/online_mb");
			//로그인 상태에는 접속자로 강제이동. 대표님지시 2016-09-01
		}
		
		@$search_push['m_special'] = '1';

		if(!$this_week_rank = $this->cache->get('m.this_week_rank')){
			$this_week_rank = $this->my_m->result_array('TotalMembers', $search_push, 'm_popularity', 'desc', '5');
			$this->cache->save('m.this_week_rank', $this_week_rank, 600);	//10분 캐시 사용
		}

		$data['this_week_rank'] = $this_week_rank;


		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = 25; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		If(IS_LOGIN){
			//search helper
			$search['TotalMembers_login.m_sex'] = reverse_sex($this->session->userdata['m_sex']);
			$search['ex_file1'] = "TotalMembers_login.m_nick_chk is null";		//닉네임 필터
		}
		//$m_result = $this->my_m->get_list($start, $rp, @$search, 'TotalMembers_login', 'm_num', 'm_userid', 'desc', 'TotalMembers_login.*');

		$data['noti'] = $this->my_m->row_array('notice_list', '', 'idx');
		
		//$data['mlist'] = $m_result[0];
		//$data['getTotalData'] = $total = $m_result[1];

		// 회원+비회원 모두 접속자 5명으로 바꾸라하심

		if(!$m_result = $this->cache->get('m.TotalMembers_login.main')){
			$m_result = $this->my_m->result_array('TotalMembers_login', @$search, 'm_popularity','desc', $rp = "5");
			$this->cache->save('m.TotalMembers_login.main', $m_result, 600);	//10분 캐시 사용
		}

		$data['m_result'] = $m_result;

		//조이매거진 랜덤리스트(2개)
		$data['magazine_list'] = $this->main_m->joy_magazine_rand_list();

		//view 설정
		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

		$top_data['add_css'] = array("/m/m_main_css");
		$top_data['add_js'] = array("/m/m_main_js");

		//회원가입후 첫 로그인일시 접속자 페이지로 이동
		if(IS_LOGIN and $this->session->userdata('regi_ok') == "y"){

			$bot_data['add_script'] = "
				<script>
				$(document).ready(function(){
					$(location).attr('href', '/m/online_mb');
				});
				</script>
			";

			//$this->session->set_userdata('regi_ok',''); //첫 로그인 끝
		}

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/m_main_v', @$data);
		$this->load->view('m/m_bottom_v',@$bot_data);


	}

	//앱으로 들어왔을때
	function index_joytalk()
	{
		//쿠키굽기 (이후 common 훅에서 체크)

		$cookie = array(
			'name' => 'is_app',
			'value' => true,
			'expire' => '31572500',
			'domain' => '.'.str_replace(":444","",$_SERVER["HTTP_HOST"]),
			'path' => '/',
			'prefix' => '',
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);

		//상수정의
		goto("/");
		exit;
	}

	function rand_chatting()
	{

		$sex = $this->session->userdata['m_sex'];
		if ($sex == 'M'){
			$search['m_sex'] = "F";
		}else{
			$search['m_sex'] = "M";
		}
		$order			 = rawurldecode($this->input->post('order',TRUE));

		$result = $this->my_m->result_array('TotalMembers', $search, $order, "desc", "6");
		shuffle($result); 
		echo $result[0]['m_userid'];

	}
	
	function cachelist(){
		$map = directory_map('/ramdisk/joyhunting_web_cache');
		foreach( $map as $val ) {
			echo $val."<br>";
		}
	}

	//실시간 매거진 관련 함수
	function call_magazine_main_view_ajax(){

		$gubn = rawurldecode($this->input->post('gubn', true));

		if(empty($gubn)){ echo "1000"; exit;}		//잘못된 접근

		$mlist = $this->my_m->result_array('joy_magazine', array('gubn' => $gubn, 'use_yn' => 'Y'), 'idx', 'desc', '2');
		
		$add_html = "";

		if(count($mlist) == "0"){ echo "1001"; exit; }

		if(count($mlist) > 0){

			foreach($mlist as $data){

				$idx = $data['idx'];

				$add_html .= "
					<div class='width_50per float_left' onclick='javascript:magazine_view_goto($idx);'>
						<div class='height_100per float_left'>
							<div class='joymagazine_cnt_img_box'>
								<img src='http://www.joyhunting.com/upload/naver_upload/magazine/".$data['list_img_url']."' style='width:118px; height:142px;'>
							</div>
						</div>			
						<div class='joymagazine_cnt_text_box'> 
							<b>".$data['gubn']."</b><br>
							<b>".$data['title']."</b><br>
							<p>".$data['ahead_text']."</p>
						</div>
					</div>
				";
			}
		}

		echo $add_html;

	}


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */