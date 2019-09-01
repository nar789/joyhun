<?php

class Jjim extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->model('friend_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('alrim_helper');
	}

	function ma_jjim($tabmenu)
	{

		user_check(null,0);

		//변수		
		$v_table = 'T_MakeFriend_List';		
		$order_filed = 'm_idx';				
		if($tabmenu == "1"){ 
			$m_userid = 'm_fuserid'; 
			$search[$v_table.'.m_userid'] = $this->session->userdata['m_userid'];
			$data['f'] = "f";

		}else{ 
			$m_userid = 'm_userid';
			$search[$v_table.'.m_fuserid'] = $this->session->userdata['m_userid'];
			$search['ex_to_delete'] = "to_delete != 'D'";
			$data['f'] = "";
		}

		$search['m_gubun'] = "찜";		//구분값
		

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);	
		
		$result = $this->my_m->get_list($start, $rp, $search, $v_table, $order_filed, $m_userid);

		$data['mlist'] = $result[0];
		$data['getTotalData']=$total= $result[1];
		
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$navs = array('프로필','찜'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/jjim_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //찜 탭메뉴

		$data['tabmenu'] = $tabmenu; //스크립트에서 쓰기 위해

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/jjim_v', @$data);
		$this->load->view('bottom_v');
	}

	//내 프로필 방문자 리스트 화면
	function ma_visi($tabmenu)
	{

		user_check(null,0);

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, array('user_id'  => $this->session->userdata('m_userid')), 'profile_visit', 'idx', 'visit_user_id'); //내 프로필 방문자 리스트 가져오기

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		//VIEW 정의

		$navs = array('프로필','찜'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/my_visitant_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/my_visitant_v', $data);
		$this->load->view('bottom_v');
	}

	function send_jjim()
	{
		$this->ma_jjim(1); //내가 등록한 찜
	}
	function receive_jjim()
	{
		$this->ma_jjim(2); //나를 등록한 찜
	}

	function my_visitant()
	{
		$this->ma_visi(3);	//내 프로필 방문자
	}

	function call_tabmenu($num){
		//찜 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('profile/jjim_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	function jjim_add_popup(){
		//찜하기 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,0);

		$user_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		if(!$user_id){exit;}

		//본인에게 본인이 찜하기 보낼경우 예외처리
		if($user_id == $this->session->userdata['m_userid']){
			echo "exit";
			exit;
		}

		$data = $this->member_lib->get_member($user_id); 

		//성별이 같을 경우 찜하기 불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error";
			exit;
		}

		$top_data['add_css'] = array("layer_popup/jjim_css");
		$top_data['add_js'] = array("layer_popup/jjim_js");
		$top_data['add_title'] = "찜하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/jjim_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	function jjim_add_reg(){
	//찜하기 저장

		//로그인 여부 체크
		user_check(null,0);

		$data['m_userid']	  = $this->session->userdata('m_userid');
		$data['m_nick']	      = $this->session->userdata('m_nick');
		$data['m_sex']	      = $this->session->userdata('m_sex');
		$data['m_age']	      = $this->session->userdata('m_age');
		$data['m_writedate']  = NOW;
		$data['m_fuserid']	  = rawurldecode($this->input->post('m_fuserid',TRUE));
		$data['m_fnick']	  = rawurldecode($this->input->post('m_fnick',TRUE));
		$data['m_fsex']		  = rawurldecode($this->input->post('m_fsex',TRUE));
		$data['m_content']    = strip_tags(rawurldecode($this->input->post('m_content',TRUE)));
		$data['m_gubun']	  = "찜";

		if(empty($data['m_fuserid'])){
			echo 9;	exit; //아이디가 안넘어왔을경우 입력실패
		}

		$rtn = $this->friend_m->reg_f_list($data);

		if($rtn == 1){
			//찜 조이헌팅알림 alrim_helper
			joyhunting_alrim("찜", $data['m_fuserid'], $data['m_userid']);

			//찜 조이헌팅 이메일 알림 alrim_helper
			joyhunting_email_alrim("찜", $data['m_fuserid'], $data['m_userid']);
			
			//(찜, 앤, 친구)등록시 인기점수 +10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
			member_popularity('1', $data['m_fuserid'], '10');
		}

		echo $rtn;

	}

	function chk_remove_jjim(){
	//프로필 찜화면에서 선택삭제 (내가 등록한 찜)

		$testsets = rawurldecode($this->input->post('m_idx', true));

		$v_table = "T_MakeFriend_List";
		$data['m_idx']		= rawurldecode($this->input->post('m_idx', true));			//순번
		$arr_data = array(
			"m_idx"			=> $data['m_idx'],
			"m_userid"		=> $this->session->userdata['m_userid']
		);

		//(찜, 앤, 친구) 삭제 전에 인기지수 -10 하기
		$member_data = $this->my_m->row_array('T_MakeFriend_List', array('m_idx' => $data['m_idx']));

		//(찜, 앤, 친구)등록시 인기점수 -10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
		member_popularity('2', $member_data['m_fuserid'], '10');

		$rtn = $this->my_m->del($v_table, $arr_data);

		echo $rtn;
	}


	function chk_remove_jjim2(){
	//프로필 찜화면에서 선택삭제 (나를 등록한 찜)

		$testsets = rawurldecode($this->input->post('m_idx', true));

		$v_table = "T_MakeFriend_List";
		$data['m_idx']		= rawurldecode($this->input->post('m_idx', true));			//순번
		$arr_data = array(
			"m_idx"			=> $data['m_idx'],
			"m_fuserid"		=> $this->session->userdata['m_userid']
		);

		$rtn = $this->my_m->update($v_table, $arr_data, array("to_delete" => 'D'));

		echo $rtn;
	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/