<?php

class Friend_add extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('friend_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('alrim_helper');
	}

	function make_friend()
	{
		user_check(null,0);	

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		$navs = array('친구만들기','친구만들기'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('friend',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$uri_array = $this->seg_exp;

	    search_sex($data, $search, "T_MakeFriend_PR", "m_sex"); //자동 성별 검색

		// 친구 리스트  

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_MakeFriend_PR', 'm_idx', 'm_userid', 'desc');

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		// 로그인시 추천이성친구
		if(IS_LOGIN){ $data['user_info'] = $this->member_lib->get_member($this->session->userdata['m_userid']);

		// 로그인안했으면 서울기준
		}else{ $data['user_info']['m_sex'] = 'M'; $data['user_info']['m_reason'] = '3'; $data['user_info']['m_conregion'] = '서울'; }


		// View 설정 
		$top_data['add_css'] = array("friend/friend_css");
		$top_data['add_js'] = array("friend/friend_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('friend/make_friend_v', $data);
		$this->load->view('bottom_v');
	}

	function chek_fri(){

		user_check(null,9,'exit');

		$search['m_nick'] = strip_tags(rawurldecode($this->input->post('m_nick',TRUE)));
		$chek_cnt = $this->my_m->cnt('T_MakeFriend_PR', $search);

		echo $chek_cnt;

	}

	// 내 PR하기 게시물 등록 
	function reg_fri()
	{
		// 로그인시 
		if(IS_LOGIN)
		{	
			user_check(null,9);

			$data['m_content'] = strip_tags(rawurldecode($this->input->post('m_content',TRUE)));

			//내 PR등록여부 확인
			$search = array("m_userid" => $this->session->userdata['m_userid'], "ex_m_writedate" => "m_writedate like '". TODAY ."%' ");
			$cnt = $this->my_m->cnt('T_MakeFriend_PR', @$search);

			if($cnt > 0){
				echo "3";		//이미등록
			}else{

				$arr_data = array(
					'm_userid'			=> $this->session->userdata('m_userid'),
					'm_sex'				=> $this->session->userdata('m_sex'),
					'm_age'				=> $this->session->userdata('m_age'),
					'm_nick'            => $this->session->userdata('m_nick'),
					'm_conregion'       => $this->session->userdata('m_conregion'),
					'm_content'			=> $data['m_content'],
					'm_writedate'		=> NOW
				);

				$rtn = $this->my_m->insert("T_MakeFriend_PR", $arr_data);

				if($rtn == "1"){
					echo "1";	//정상등록
				}else{
					echo "9";	//오류
				}

			}
		}
	}

	// 친구등록하기 팝업창 
	function friend_popup(){
		//친구등록 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,9,'exit');

		$user_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));
		$user_nick    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_nick')));
		
		if(empty($user_id)){
			//아이디가 없으면 닉네임으로 찾아오기
			$search['m_nick'] = $user_nick;
			$nick_picup = $this->my_m->row_array('TotalMembers', $search);

			$user_id = $nick_picup['m_userid'];
		}

		//본인이 본인 친구추가할경우 예외처리
		if($user_id == $this->session->userdata['m_userid']){
			echo "exit";
			exit;
		}

		// 데이터 가져오기
		$data = $this->member_lib->get_member($user_id); 
		
		@$data['f_group']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'group')));
		@$data['f_memo']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'memo')));

		$top_data['add_css'] = array("layer_popup/friend_add_popup_css");
		$top_data['add_js'] = array("layer_popup/friend_add_popup_js");
		$top_data['add_title'] = "친구등록하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/friend_add_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	// 친구등록하기
	function friend_submit()
	{
		//로그인 여부 체크
		user_check();

		$data['m_userid']	  = $this->session->userdata('m_userid');
		$data['m_nick']	      = $this->session->userdata('m_nick');
		$data['m_sex']	      = $this->session->userdata('m_sex');
		$data['m_age']	      = $this->session->userdata('m_age');
		$data['m_writedate']  = NOW;
		$data['m_fuserid']	  = rawurldecode($this->input->post('m_fuserid',TRUE));
		$data['m_fnick']	  = rawurldecode($this->input->post('m_fnick',TRUE));
		$data['m_content']    = strip_tags(rawurldecode($this->input->post('m_content',TRUE)));
		$data['m_gname']	  = rawurldecode($this->input->post('m_gname',TRUE));
		$data['m_gubun']	  = "친구";

		$rtn = $this->friend_m->reg_f_list($data);

		if($rtn == 1){

			//서로친구 확인여부
			$chk = $this->friend_m->reg_f_chk($data['m_userid'], $data['m_fuserid'], '친구');

			if(!@empty($chk)){
				$mode = "서로친구";
			}else{
				$mode = "친구등록";
			}
			//조이헌팅 알림 추가 alrim_helper
			joyhunting_alrim($mode, $data['m_fuserid'], $data['m_userid']);

			//조이헌팅 이메일 알림 추가 alrim_helper
			joyhunting_email_alrim($mode, $data['m_fuserid'], $data['m_userid']);

			//(찜, 앤, 친구)등록시 인기점수 +10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
			member_popularity('1', $data['m_fuserid'], '10');

		}

		echo $rtn;

	}

	function group_popup(){
		//그룹수정 레이어팝업 AJAX

		//로그인 여부 체크
		user_check();

		$data['user_id']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));

		$top_data['add_css']    = array("layer_popup/group_popup_css");
		$top_data['add_js']     = array("layer_popup/group_popup_js");
		$top_data['add_title']  = "친구등록하기";
		$top_data['add_text']   = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/group_popup_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	// 그룹추가 및 수정 실행
	function fri_group_add()
	{
		//로그인 여부 체크
		user_check();
		
		$m_gname    = $this->input->post('m_gname',TRUE);

		//보유 그룹 모두 지우기
		$this->my_m->del('T_MakeFriend_Group', array("m_userid" => $this->session->userdata['m_userid']));

		//하나씩 저장하기
		$num = 1;
		foreach ($m_gname as $value){
			
			$arr_data = array(
				"m_userid "		=> $this->session->userdata('m_userid'),
				"m_gnum"		=> $num,
				"m_gname "		=> $value
			);
			$this->my_m->insert('T_MakeFriend_Group', $arr_data);

			$num++;
		} 

		echo "ok";
	}

	// 나쁜친구 등록하기 레이어 팝업
	function bad_friend_popup(){
		//로그인 여부 체크
		user_check(null,9);

		$user_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));

		//본인이 본인 나쁜친구추가할경우 예외처리
		if($user_id == $this->session->userdata['m_userid']){
			echo "exit";
			exit;
		}

		// 데이터 가져오기
		$data = $this->member_lib->get_member($user_id); 
		
		$top_data['add_css']    = array("layer_popup/bad_friend_add_css");
		$top_data['add_js']     = array("layer_popup/bad_friend_add_js");
		$top_data['add_title']  = "나쁜친구 등록하기";
		$top_data['add_text']   = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/bad_friend_add_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//나쁜친구등록처리
	function bad_friend_reg(){

		user_check();
		
		$data['m_fuserid']			= rawurldecode($this->input->post('m_fuserid', true));					//나쁜친구로 등록할 유저아이디
		$data['m_content']			= strip_tags(rawurldecode($this->input->post('m_content', true)));		//한줄메모

		$arr_data = array(
			"m_fuserid"			=> $data['m_fuserid'],
			"m_content"			=> $data['m_content'],
			"m_gubun"			=> "나쁜친구"
		);


		$v_cnt1 = array('m_userid' => $this->session->userdata['m_userid'], 'm_fuserid' => $data['m_fuserid'], 'm_gubun' => '나쁜친구');
		$bad_chk_rtn = $this->my_m->cnt('T_MakeFriend_List', $v_cnt1);		//나쁜친구 등록여부확인

		if($bad_chk_rtn > 0){
			echo "100";		//이미 나쁜친구로 등록되었을 경우 100을 반환
		}else{
			$v_cnt2 = array('m_userid' => $this->session->userdata['m_userid'], 'm_fuserid' => $data['m_fuserid'], 'm_gubun' => '');
			$friend_chk = $this->my_m->cnt('T_MakeFriend_List', $v_cnt2);
			
			if($friend_chk > 0){
				$rtn = $this->my_m->update('T_MakeFriend_List', array('m_userid' => $this->session->userdata['m_userid'], 'm_fuserid' => $data['m_fuserid']), $arr_data);	//나쁜친구 등록 업데이트
			}else{
				
				$arr_data = array(

					"m_userid"			=> $this->session->userdata('m_userid'),
					"m_nick"			=> $this->session->userdata('m_nick'),
					"m_sex"				=> $this->session->userdata('m_sex'),
					"m_age"				=> $this->session->userdata('m_age'),
					"m_fuserid"			=> $data['m_fuserid'],
					"m_fnick"			=> "",
					"m_content"			=> $data['m_content'],
					"m_gubun"			=> "나쁜친구",
					"m_gname"			=> ""
				);
				
				$rtn = $this->friend_m->reg_f_list($arr_data);		//나쁜친구 등록 insert
				
				echo "200";
			}
		}


	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/