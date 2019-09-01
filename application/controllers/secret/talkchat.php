<?php

class Talkchat extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('secret_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');

	}

	function index(){
		$this->talk_list();
	}

	function talk_list(){

		if(IS_LOGIN){ //로그인일때만 
		
			member_session_up(); //latest_helper 세션값 업데이트 

			$uri_array = $this->seg_exp;


			search_sex($data, $search, "TotalMembers", "m_sex"); //자동 성별 검색

			//페이징 변수
			$page = $this->pre_paging();
			$rp =10; //리스트 갯수
			$limit = 9; //보여줄 페이지수
			$start = (($page-1) * $rp);

			if ($search['TotalMembers.m_sex'] == 'M'){
				$search['TotalMembers.m_type'] = "V";
			}
			
			$m_result = $this->secret_m->secret_list($start, $rp, @$search);

			$data['mlist'] = $m_result[0];
			$data['getTotalData']=$total= $m_result[1];
		
			$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

			$navs = array('비밀톡챗','비밀톡챗 리스트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('secret',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

			$top_data['add_css'] = array("secret/secret_css");
			$top_data['add_js'] = array("secret/secret_js");

			$this->load->view('top_v',$top_data);
			$this->load->view('secret/secret_v', $data);
			$this->load->view('bottom_v');

		}else{ //로그인 안했을때

			$uri_array = $this->seg_exp;

			search_sex($data, $search, "TotalMembers", "m_sex"); //자동 성별 검색

			//페이징 변수
			$page = $this->pre_paging();
			$rp =10; //리스트 갯수
			$limit = 9; //보여줄 페이지수
			$start = (($page-1) * $rp);
			
			$m_result = $this->secret_m->secret_list($start, $rp, @$search);

			$data['mlist'] = $m_result[0];
			$data['getTotalData']=$total= $m_result[1];
		
			$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

			$navs = array('비밀톡챗','비밀톡챗 리스트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('secret',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

			$top_data['add_css'] = array("intro/secret_chat_css");
			$top_data['add_js'] = array("intro/secret_chat_js");

			$this->load->view('top_v',$top_data);
			$this->load->view('intro/secret_chat_v', $data);
			$this->load->view('bottom_v');
		}

	}
	
	//채팅신청 리뉴얼
	//채팅신청 테스트용으로 사용
	function talk_list_test(){

		$uri_array = $this->seg_exp;

		search_sex($data, $search, "TotalMembers", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		if ($search['TotalMembers.m_sex'] == 'M'){
			$search['TotalMembers.m_type'] = "V";
		}
		
		$m_result = $this->secret_m->secret_list($start, $rp, @$search);

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$navs = array('비밀톡챗','비밀톡챗 리스트'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('secret',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("secret/secret_css");
		$top_data['add_js'] = array("secret/secret_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('secret/secret_test_v', $data);
		$this->load->view('bottom_v');

	}
}

/* End of file main.php */
/* Location: ./application/controllers/*/

