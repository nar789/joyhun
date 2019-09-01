<?php

class Bestphoto extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('photo_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index(){
		$this->photo_list();
	}

	function photo_list()
	{
		//페이징 변수
		$page = $this->pre_paging();
		$rp =8; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		$total = "1000";			//순위 1000등까지만 보이기
		
		if($page == "" || $page == "1"){ 
			$data['rank'] = "4";			//기본 순위 초기화 4등
		}else{
			$data['rank'] = ($page-1)*8+4;	//페이지별 순위 초기화
		}
		$result = $this->photo_m->popularity_top4_down($start, $rp);		//인기순위 4위부터 가져오기

		$data['mlist'] = $result;
	
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp, $total,$limit));
		
		//view 설정
		$navs = array('포토미팅','베스트사진'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('photo',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('photo_meeting'); //우측메뉴 로딩

		$top_data['add_css'] = array("photo/photo_css");
		$top_data['add_js'] = array("photo/photo_js");

		$data['call_top'] = $this->call_top();	//본문 상단

		$this->load->view('top_v',$top_data);
		$this->load->view('photo/best_photo_v', $data);
		$this->load->view('bottom_v');
	}

	
	//베스트 사진 상단 부분
	function call_top(){

		ob_start();

		$arrData = $this->photo_m->popularity_top3();		//인기순위 상위 3명가져오기

		//인기순위 1, 2, 3위 top1, top2, top3에 각각 배열로 추가
		foreach($arrData as $arrData){
			
			for($i=1; $i<4; $i++){
				if($i == $arrData['rownum']){
					$data['top'.$i] = array(
						"rownum"		=> $arrData['rownum'],
						"m_userid"		=> $arrData['m_userid'],
						"m_nick"		=> $arrData['m_nick'],
						"m_age"			=> $arrData['m_age'],
						"m_sex"			=> $arrData['m_sex']
					);

				}
			}
		}
		
		$this->load->view('photo/best_photo_top_v', @$data);

		$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}
}

/* End of file main.php */
/* Location: ./application/controllers/*/