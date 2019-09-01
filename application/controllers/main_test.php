<?php

class Main_test extends MY_Controller {

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
		$this->load->helper('chat_helper');
		$this->load->library('tank_auth');
	}


	function index()
	{
		//echo phpinfo();
		//$this->main_view();
		chat_auto_reply();
	}

	function start()
	{
		//$this->output->cache(10); //메인페이지 10분 캐싱 (비로그인 상태일때만)
		goto("/");
	}

	function main_view(){
		
		// 매니저의 추천 회원
		$search_mana['b_manager'] = '1';
		$data['manager'] =  $this->open_marry_m->result_array('T_CoupleMarry_OpenguhonMan', $search_mana);

		// 남자3명
		$search['ex_not'] = "m_special IS NOT NULL";
		$search['m_special'] = "2";
		$search['m_sex'] = 'M';
		$special_m = $this->my_m->result_array('TotalMembers', $search);
		shuffle($special_m);
		$special_m = array(
						"0" => $special_m[0],
						"1" => $special_m[1],
						"2" => $special_m[2]);
		// 여자4명
		$search['ex_not'] = "m_special IS NOT NULL";
		$search['m_special'] = "2";
		$search['m_sex'] = 'F';
		$special_f = $this->my_m->result_array('TotalMembers', $search);
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


		//view 설정
		$top_data['top_menu'] = $this->top_menu_lib->view(); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view(); //우측메뉴 로딩

		$top_data['add_css'] = array("main_test_css");
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

		$this->load->view('top_test_v',$top_data);
		$this->load->view('main_test_v', $data);
		$this->load->view('bottom_v',@$bot_data);
	}


	function register_ok_popup(){
		//회원가입 완료하면 처음한번 나오는 회원정보 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,0);

		$top_data['add_css'] = array("layer_popup/register_ok_popup_css");
		$top_data['add_js'] = array("layer_popup/register_ok_popup_js");
		$top_data['add_title'] = "미팅정보설정";
		$top_data['add_text'] = "본인에 맞게 수정하시면 채팅&미팅 성공률이 더~욱 높아집니다.";
		
		//회원정보가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);

		$data = array(
			"m_reason"		=> $member_data['m_reason'],
			"m_character"	=> $member_data['m_character'],
			"my_intro"		=> $member_data['my_intro']
		);

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/register_ok_popup_v',$data);
		$this->load->view('layer_popup/popup_bottom_v');
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


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */