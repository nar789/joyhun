<?php

class Joy_magazine extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('m_top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->helper('code_change_helper');
	}

	function index(){
		$this->all();
	}

	//탭메뉴 리다이렉트
	function all(){
		$this->magazine_list(1);		//전체
	}
	
	function menu1(){
		$this->magazine_list(2);		//이색데이트
	}

	function menu2(){
		$this->magazine_list(3);		//축제속으로
	}

	function menu3(){
		$this->magazine_list(4);		//여행지정보
	}

	function menu4(){
		$this->magazine_list(5);		//공연&전시
	}

	function menu5(){
		$this->magazine_list(6);		//리빙&푸드
	}

	function menu6(){
		$this->magazine_list(7);		//맛집베스트
	}

	//탭메뉴
	function call_tabmenu($num){
		//조이매거진 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}
		ob_start();
		
		$this->load->view('service_center/joy_magazine_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	//조이매거진 리스트페이지
	function magazine_list($tabmenu) {

		//검색조건
		$search['use_yn'] = "Y";		
		if($this->call_gubn($tabmenu) <> "전체"){ $search['gubn'] = $this->call_gubn($tabmenu); }

		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'joy_magazine', 'idx', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		if($total == "0"){
			$data['null_text'] = "등록된 조이 매거진이 없습니다.";
		}

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		if(IS_MOBILE == true){
			//모바일 페이지
			$data['tabmenu'] = $tabmenu;
			$data['category'] = $this->call_gubn($tabmenu);

			//view 설정
			$top_data['add_css'] = array("/m/m_magazine_css");
			$top_data['add_js'] = array("/m/m_magazine_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', "조이매거진"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/joy_magazine/joy_magazine_list_v', $data);
			$this->load->view('m/m_bottom0_v');

		}else{
			//PC 페이지 

			//view 설정
			$navs = array('홈','고객센터','조이매거진'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy', $navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/joy_magazine_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //조이매거진 탭메뉴

			$this->load->view('top_v',$top_data);
			$this->load->view('service_center/joy_magazine_list_v', $data);
			$this->load->view('bottom_v');

		}
		
	}
		

	//매거진 뷰페이지
	function magazine_view(){

		$idx = $this->security->xss_clean(@url_explode($this->seg_exp, 'idx'));
		if(empty($idx)){ alert_goto('잘못된 접근입나다.', '/service_center/joy_magazine/all'); }

		$magazine_data = $this->my_m->row_array('joy_magazine', array('idx' => $idx, 'use_yn' => 'Y'), 'idx', 'desc', '1');
		if(empty($magazine_data)){ alert_goto('잘못된 접근입나다.', '/service_center/joy_magazine/all'); }

		//조회수 업데이트
		$this->my_m->update('joy_magazine', array('idx' => $idx), array('read_num' => $magazine_data['read_num']+1));

		$data['magazine_data'] = $this->my_m->row_array('joy_magazine', array('idx' => $idx, 'use_yn' => 'Y'), 'idx', 'desc', '1');

		if(IS_MOBILE == true){		
			//모바일 버전의 경우
						
			//view 설정
			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("/m/m_magazine_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back', "조이매거진"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/joy_magazine/joy_magazine_view_v', $data);
			$this->load->view('m/m_bottom0_v');

		}else{
			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','조이매거진'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy', $navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/joy_magazine_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

			$this->load->view('top_v',$top_data);
			$this->load->view('service_center/joy_magazine_view_v', $data);
			$this->load->view('bottom_v');

		}
	}
	
	//탭메뉴에 따른 조건문 함수
	function call_gubn($num){

		if(empty($num)){ goto('/service_center/joy_magazine/all'); }

		if($num == "1"){ $gubn = "전체"; }
		if($num == "2"){ $gubn = "이색데이트"; }
		if($num == "3"){ $gubn = "축제속으로"; }
		if($num == "4"){ $gubn = "여행지정보"; }
		if($num == "5"){ $gubn = "공연&전시"; }
		if($num == "6"){ $gubn = "맛집베스트"; }
		if($num == "7"){ $gubn = "연애&소개팅"; }

		return $gubn;

	}

	//저건 리버스
	function call_gubn_reverse($gubn){

		if($gubn == "이색데이트"){ $num = "1"; }
		if($gubn == "축제속으로"){ $num = "2"; }
		if($gubn == "여행지정보"){ $num = "3"; }
		if($gubn == "공연&전시"){ $num = "4"; }
		if($gubn == "맛집베스트"){ $num = "5"; }
		if($gubn == "연애&소개팅"){ $num = "6"; }
		
		return $num;
	}
	

	//이전, 다음, 목록 모바일전용
	function call_btn_status_ajax(){
		
		$idx		= rawurldecode($this->input->post('idx', true));
		$gubn		= rawurldecode($this->input->post('gubn', true));
		$mode		= rawurldecode($this->input->post('mode', true));
		
		$rtn_url = "";

		if($mode == "list"){

			//목록
			$rtn_url = "/service_center/joy_magazine/menu".$this->call_gubn_reverse($gubn);

		}else if($mode == "prev"){

			//이전글
			$result = $this->my_m->result_array('joy_magazine', array('use_yn' => 'Y', 'gubn' => $gubn, 'ex_data_1' => 'idx <= "'.$idx.'" '), 'idx', 'desc', '2');

			if(count($result) >= "2"){
				$rtn_url = "/service_center/joy_magazine/magazine_view/idx/".$result[1]['idx'];
			}else{
				$rtn_url = "1001";		//마지막글
			}
			
		}else if($mode == "next"){

			//다음글			
			$result = $this->my_m->result_array('joy_magazine', array('use_yn' => 'Y', 'gubn' => $gubn, 'ex_data_1' => 'idx >= "'.$idx.'" '), 'idx', 'asc', '2');

			if(count($result) >= "2"){
				$rtn_url = "/service_center/joy_magazine/magazine_view/idx/".$result[1]['idx'];
			}else{
				$rtn_url = "1001";		//마지막글
			}

		}else{
			//잘못된 접근
			$rtn_url = "1000";
		}

		echo $rtn_url;

	}

	//매거진 더보기 함수
	function magazine_list_more(){
		
		//페이징 변수
		$page = rawurldecode($this->input->post('page', true));
		$gubn = rawurldecode($this->input->post('gubn', true));

		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$search['use_yn'] = "Y";

		if($gubn <> "1"){
			$search['gubn'] = $this->call_gubn($gubn);	
		}		

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'joy_magazine', 'idx', 'desc', '*');

		$mlist = $result[0];

		if(empty($mlist)){
			echo "0";		//데이터가 더이상 없을경우
		}else{

			$add_html = "";
			$i = ($page-1)*$rp;

			foreach($mlist as $data){

				$add_html .= "
					<div class='width_95per margin_auto' onclick='javascript:magazine_view(".$data['idx'].");'>
						<img src='/upload/naver_upload/magazine/".$data['m_list_img_url']."' class='width_100per'>
						<div class='m_event_text margin_bottom_10'>
							<div class='width_95per margin_auto line-height_20'>
								<b>".$data['title']."</b>
								<p style='text-overflow: ellipsis; white-space:nowrap; overflow:hidden;'>".$data['ahead_text']."</p>
							</div>
						</div>
					</div>
				";

				$i++;

			}

			echo $add_html;

		}

	}
	



	
}

/* End of file main.php */
/* Location: ./application/controllers/*/

