<?php

class Anne_add extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('friend_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('alrim_helper');

	}

	//앤만들기 리스트
	function make_anne()
	{
		user_check(null,0);	

		$navs = array('친구만들기','앤만들기'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('friend',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("friend/friend_css");
		$top_data['add_js'] = array("friend/anne_js");

		$uri_array = $this->seg_exp;

	    search_sex($data, $search, "TotalMembers", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_Joyhunting_Lover', 'm_idx', 'm_userid', "desc");

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		$this->load->view('top_v',$top_data);
		$this->load->view('friend/make_anne_v', $data);
		$this->load->view('bottom_v');
	}

	// 앤만들기 게시물 등록 
	function reg_anne()
	{
		// 로그인시 
		if(IS_LOGIN)
		{	
			
			user_check(null,9,'exit');

			$search = array("m_userid" => $this->session->userdata['m_userid'], "ex_m_date" => "m_date like '". TODAY ."%' ");
			$cnt = $this->my_m->cnt('T_Joyhunting_Lover', $search);

			$data['m_dbcontent'] = strip_tags(rawurldecode($this->input->post('m_dbcontent',TRUE)));

			if($cnt > 0){
				echo "3";		//이미등록
			}else{
				$arr_data = array(
					'm_userid'		=> $this->session->userdata('m_userid'),
					'm_dbcontent'	=> $data['m_dbcontent'],
					'm_date'		=> NOW
				);

				$rtn = $this->my_m->insert("T_Joyhunting_Lover", $arr_data);

				if($rtn == "1"){
					echo "1";		//정상등록
				}else{
					echo "9";		//오류
				}

			}


		}
	}

	############################ 앤만들기 ########################################################

	// 앤등록하기 팝업
	function anne_popup(){
		//앤 레이어팝업 AJAX
		
		//로그인 여부 체크
		user_check();
		
		$user_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));

		// 데이터 가져오기
		$data = $this->member_lib->get_member($user_id); 

		$top_data['add_css'] = array("layer_popup/anne_add_popup_css");
		$top_data['add_js'] = array("layer_popup/anne_add_popup_js");
		$top_data['add_title'] = "앤등록하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/anne_add_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	// 앤등록하기
	function anne_submit()
	{
		//로그인 여부 체크
		user_check();

		$m_fuserid		= rawurldecode($this->input->post('m_fuserid',TRUE));
		$m_dbcontent    = strip_tags(rawurldecode($this->input->post('m_dbcontent',TRUE)));
		$m_fnick		= rawurldecode($this->input->post('m_fnick',TRUE));

		$data['m_userid']	  = $this->session->userdata('m_userid');
		$data['m_nick']	      = $this->session->userdata('m_nick');
		$data['m_sex']	      = $this->session->userdata('m_sex');
		$data['m_age']	      = $this->session->userdata('m_age');
		$data['m_fuserid']	  = $m_fuserid;
		$data['m_fnick']	  = $m_fnick;
		$data['m_content']    = $m_dbcontent;
		$data['m_gubun']    = "앤";
		$data['m_gname']    = "";

		$rtn = $this->friend_m->reg_f_list($data, "insert");

		if($rtn == 1){

			//서로친구 확인여부
			$chk = $this->friend_m->reg_f_chk($data['m_userid'], $data['m_fuserid'], '앤');

			if(!@empty($chk)){
				$mode = "서로앤";
			}else{
				$mode = "앤";
			}
			//조이헌팅 알림 추가 alrim_helper
			joyhunting_alrim($mode, $data['m_fuserid'], $data['m_userid']);

			//앤 조이헌팅 이메일 알림 alrim_helper
			joyhunting_email_alrim($mode, $data['m_fuserid'], $data['m_userid']);

			//(찜, 앤, 친구)등록시 인기점수 +10 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
			member_popularity('1', $data['m_fuserid'], '10');
		}

		echo $rtn;

	}


}

/* End of file main.php */
/* Location: ./application/controllers/*/