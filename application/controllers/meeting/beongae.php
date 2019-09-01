<?php

class Beongae extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('meeting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('alrim_helper');

	}

	function beongae_list($tabmenu)
	{
		user_check(null,0);
		//오늘마감 번개팅, 진행중인 번개팅
		if($tabmenu == 2){
			$search['ex_sql'] = "b_day <= '".TODAY."'";
		}else if($tabmenu == 3){
			$search['ex_sql'] = "b_day >= '".TODAY."'";
		}

	    search_sex($data, $search, "T_MeetingDate_Bun", "b_sex"); //자동 성별 검색

		//검색이 있는가?
		if( in_array('region', $this->seg_exp))
		{
			$data['region'] = $search['b_region'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'region')));
			$data['time'] = $search['b_time'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'time')));
			$data['wantcnt'] = $search['b_wantcnt'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'wantcnt')));
			$data['interest'] = $search['b_interest'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'interest')));

			$bot_data['add_script'] = "
				<script>
					$('#region').val('".$data['region']."');
					$('#time').val('".$data['time']."');
					$('#wantcnt').val('".$data['wantcnt']."');
					$('#interest').val('".$data['interest']."');
				</script>
			";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_MeetingDate_Bun', 'idx', 'b_userid'); //번개팅 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$navs = array('미팅신청','번개팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/beongae_js");
		
		$data['call_top'] = $this->call_top(); //번개팅 상단
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //번개팅 탭메뉴
		$data['call_search'] = $this->call_search(); //번개팅 검색창

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/beongae_v', $data);
		$this->load->view('bottom_v',@$bot_data);

	}

	function all()
	{
		$this->beongae_list(1); //전체 번개팅
	}

	function today()
	{
		$this->beongae_list(2); //오늘마감 번개팅
	}

	function ing()
	{
		$this->beongae_list(3); //진행중인 번개팅
	}

	function mypage()
	{
		//내가 등록한 번개팅
		user_check(null,9);

		$this->mypage_delete(); //삭제가 있을시 처리

		$this->seg_exp = $this->seg_exp;


		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);


		//내것만 보이기
		$search['b_userid'] = $this->session->userdata('m_userid');

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_MeetingDate_Bun', 'idx', 'b_userid'); //번개팅 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		//view 설정
		$navs = array('미팅신청','번개팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/beongae_js");
		
		$data['call_top'] = $this->call_top(); //번개팅 상단
		$data['call_tabmenu'] = $this->call_tabmenu(4); //번개팅 탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2(1); //번개팅 > 내번개팅 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/beongae_mypage_v', $data);
		$this->load->view('bottom_v');
	}

	function mypage_delete(){	
		//내가 등록한 번개팅 삭제할 대상이 있을경우
		if($this->input->post('check_item',TRUE) != false and count($this->input->post('check_item',TRUE)) > 0){
			
			foreach($this->input->post('check_item',TRUE) as $key => $value)
			{
				$search['b_userid'] = $this->session->userdata('m_userid');
				$search['idx'] = $value;
				$rtn = $this->my_m->del('T_MeetingDate_Bun', $search);
			}

		}
	}


	function mypage_recv_list($tabmenu,$page_name)
	{
		//받거나 보낸 번개팅 리스트 (공통 사용)
		user_check();

		if($tabmenu == 2){ //받은 번개팅
			$this->mypage_recv_delete();
			$search['beon.b_userid'] = $this->session->userdata('m_userid');
		}else if($tabmenu == 3){ //보낸 번개팅
			$this->mypage_send_delete();
			$search['beon_sin.user_id'] = $this->session->userdata('m_userid');
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);


		$m_result = $this->meeting_m->beongae_list_request($start, $rp, @$search); //번개팅 리스트 요청내역

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$data['page_name'] = $page_name;


		//view 설정
		$navs = array('미팅신청','번개팅'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/beongae_js");
		
		$data['call_top'] = $this->call_top(); //번개팅 상단
		$data['call_tabmenu'] = $this->call_tabmenu(4); //번개팅 탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2($tabmenu); //번개팅 > 내번개팅 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/beongae_mypage_recv_v', $data);  //view 페이지 하나로 공통사용
		$this->load->view('bottom_v');
	}

	function mypage_recv()
	{
		$this->mypage_recv_list($tabmenu = 2, "받은"); //받은 번개팅
	}

	function mypage_send()
	{
		$this->mypage_recv_list($tabmenu = 3, "보낸"); //보낸 번개팅
	}

	function mypage_recv_delete(){	
		//받은 번개팅 삭제할 대상이 있을경우
		if($this->input->post('check_item',TRUE) != false and count($this->input->post('check_item',TRUE)) > 0){
			
			foreach($this->input->post('check_item',TRUE) as $key => $value)
			{
				$search['p_user_id'] = $this->session->userdata('m_userid');
				$search['idx'] = $value;
				$rtn = $this->my_m->del('T_MeetingDate_Bun_request', $search);
			}

		}
	}

	function mypage_send_delete(){	
		//보낸 번개팅 삭제할 대상이 있을경우
		if($this->input->post('check_item',TRUE) != false and count($this->input->post('check_item',TRUE)) > 0){
			
			foreach($this->input->post('check_item',TRUE) as $key => $value)
			{
				$search['user_id'] = $this->session->userdata('m_userid');
				$search['idx'] = $value;
				$rtn = $this->my_m->del('T_MeetingDate_Bun_request', $search);
			}

		}
	}

	function call_top(){
		//번개팅 상단 달력 출력과 등록하기부분
		ob_start();
		
		$this->load->view('meeting/beongae_top_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($num){
		//번개팅 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('meeting/beongae_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu2($num){
		//번개팅 > 내번개팅 탭메뉴

		for($i=1;$i<10;$i++){
				if($i == $num){
					$data["tap_menu_css2_$i"]  = "meeting_2dep_on";			
				}else{
					$data["tap_menu_css2_$i"]  = "meeting_2dep_off";			
				}
		}

		ob_start();
		
		$this->load->view('meeting/beongae_my_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_search(){
		//번개팅 검색
		ob_start();
		
		$this->load->view('meeting/beongae_search_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function reg_beongae(){
		// 번개팅 신규등록
		if(IS_LOGIN){ //로그인일때만 

			user_check(null,9,'exit');

			$data['w_region'] =  rawurldecode($this->input->post('w_region',TRUE));
			$data['w_time'] = rawurldecode($this->input->post('w_time',TRUE));
			$data['w_wantcnt'] = rawurldecode($this->input->post('w_wantcnt',TRUE));
			$data['w_interest'] = rawurldecode($this->input->post('w_interest',TRUE));		
			$data['w_intro'] = strip_tags(rawurldecode($this->input->post('w_intro',TRUE)));
			$data['w_day'] = rawurldecode($this->input->post('w_day',TRUE));					
			if(!$data['w_region'] or !$data['w_time'] or !$data['w_wantcnt'] or !$data['w_interest'] or !$data['w_intro'] or !$data['w_day']){echo "9";exit;}
			
			$search = array('b_userid' => $this->session->userdata['m_userid'], 'ex_b_date' => "b_date like '".TODAY."%'");
			$cnt = $this->my_m->cnt('T_MeetingDate_Bun', $search);		//번개팅 등록여부 확인

			if($cnt > 0){
				echo "3";		//이미등록
			}else{
				$arr_data = array(
					'b_userid' => $this->session->userdata('m_userid'),
					'b_sex' => $this->session->userdata('m_sex'),
					'b_age' => $this->session->userdata('m_age'),
					'b_nick' => $this->session->userdata('m_nick'),
					'b_interest' => $data['w_interest'],
					'b_region' => $data['w_region'],
					'b_day' => $data['w_day'],
					'b_time' => $data['w_time'],
					'b_intro' => $data['w_intro'],
					'b_wantcnt' => $data['w_wantcnt'],
					'b_date' => NOW,
					'b_arsid' => 0
				);

				$rtn = $this->my_m->insert("T_MeetingDate_Bun", $arr_data);

				if($rtn == "1"){
					
					//번개팅 등록시 서로친구에게 알림메시지 및 이메일 보내기 alrim_helper
					joyhunting_alrim_repetition('친구번개팅', $this->session->userdata['m_userid']);
					echo "1";		//정상등록
				}else{
					echo "9";		//오류
				}
			}
			
		}
	}

	function request_popup(){
		//번개팅 요청 레이어팝업 AJAX

		//로그인 여부 체크흑흐
		user_check(null,9);

		$data['idx'] = $idx = $this->security->xss_clean(url_explode($this->seg_exp, 'idx')); if(!$idx){exit;}

		//번개팅 데이터 가져오기
		$m_result = $this->my_m->get_list(0, 1, @$data, 'T_MeetingDate_Bun', 'idx', 'b_userid'); //번개팅 리스트

		$data['mlist'] = $m_result[0][0];
		$data['getTotalData']=$total= $m_result[1];

		$top_data['add_css'] = array("layer_popup/beongae_request_css");
		$top_data['add_js'] = array("layer_popup/beongae_request_js");
		$top_data['add_title'] = "번개팅 요청하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/beongae_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	function request_popup_ok(){
		//번개팅 요청 레이어팝업 저장

		$data = $this->member_lib->get_member(rawurldecode($this->input->post('p_user_id',TRUE)));

		//성별이 같을 경우 번개팅요청불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}

		$arr_data = array(
					'p_idx' => $this->input->post('idx',TRUE),
					'my_msg' => strip_tags(rawurldecode($this->input->post('my_msg',TRUE))),
					'user_id' => $this->session->userdata('m_userid'),
					'w_date' => NOW,
					'p_user_id' => rawurldecode($this->input->post('p_user_id',TRUE))
		);
		$rtn = $this->my_m->insert('T_MeetingDate_Bun_request', $arr_data);

		if($rtn == "1"){

			//번개팅 요청성공시 알림보내기 alrim_helper
			joyhunting_alrim('번개팅', $arr_data['p_user_id'], $arr_data['user_id']);

			//번개팅 조이헌팅 이메일 알림 alrim_helper
			joyhunting_email_alrim('번개팅', $arr_data['p_user_id'], $arr_data['user_id']);

			echo "1"; //정상등록
		}else{
			echo "9"; //오류
		}
	}

	function detail_popup(){
		//번개팅 상세보기 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,9);

		$data['idx'] = $idx = $this->security->xss_clean(url_explode($this->seg_exp, 'idx')); if(!$idx){exit;}

		//번개팅 데이터 가져오기
		$m_result = $this->my_m->get_list(0, 1, @$data, 'T_MeetingDate_Bun', 'idx', 'b_userid'); //번개팅 리스트

		$data['mlist'] = $m_result[0][0];
		$data['getTotalData']=$total= $m_result[1];

		$top_data['add_css'] = array("layer_popup/beongae_request_css");
		$top_data['add_js'] = array("layer_popup/beongae_request_js");
		$top_data['add_title'] = "번개팅 상세보기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/beongae_detail_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */