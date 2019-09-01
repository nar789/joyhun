<?php

class Notice extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->helper('code_change_helper');
	}

	function index(){
		$this->noti_list();
	}

	function noti_list(){


		if(IS_MOBILE == true){
			//모바일 버전의 경우

		@$page	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
		if (@$page){
			$data['page'] = $page;
		}else{
			$data['page'] = 0;
		}
		@$start	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'start')));
		if (@$page){
			$data['scroll'] = $start;
		}else{
			$data['scroll'] = '';
		}

		$m_result = $this->my_m->get_list_solo('0', '10'+$data['page'], @$search, 'notice_list', 'idx');

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

			
			$this->load->library('m_top_menu_lib');
			//view 설정

			$top_data['add_css'] = array("/m/m_noti_css");
			$top_data['add_js'] = array("/m/m_noti_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"공지사항"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/etc/m_noti_v', @$data);
			$this->load->view('m/m_bottom_v');

		}else{
			
		
		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = $data['rp'] =15; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list_solo($start, $rp, @$search, 'notice_list', 'idx');

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

			//PC버전의 경우
			$navs = array('홈','고객센터','공지사항'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/notice_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/notice_v',$data);
			$this->load->view('bottom_v');
		}
	}
	
	//PC버전 공지사항 view 페이지
	function noti_view(){

		$data['page']	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
		$data['idx'] = $search['idx'] 	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		if(empty($data['page'])){ $data['page'] = '1'; }

		$navs = array('홈','고객센터','공지사항'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/notice_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$data['mlist'] = $this->my_m->row_array('notice_list', $search, "", "desc");

		$this->load->view('top_v',$top_data);			
		$this->load->view('service_center/notice_read_v',$data);
		$this->load->view('bottom_v');
	}

	//모바일 버전 공지사항 리스트 더보기(more 버튼)
	function notice_more(){
		
		//페이징 변수
		$page = rawurldecode($this->input->post('page', true));
		$rp = $data['rp'] = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
			
		$m_result = $this->my_m->get_list($start, $rp, @$search, 'notice_list', 'idx', 'userid', 'desc');
		
		$mlist = $m_result[0];
		
		if(empty($mlist)){
			echo "0";		//데이터가 더이상 없을경우
		}else{
			
			$add_html = "";

			foreach($mlist as $data){
				$add_html .= "
					<div class='board_area' onclick='javascript:comment_view(".$data['idx'].");'>
						<div class='width_95per margin_auto'>
							<div class='float_left width_93per height_47'>
								<b class='board_title text_cut'>[공지".$data['idx']."] ".$data['n_title']."</b>
								<span class='board_day color_999 width_25per ver_top'> ".date('Y.m.d', strtotime($data['n_date']))." </span>
							</div>
							<div class='float_right'>
								<img src='".IMG_DIR."/service_center/faq_down.gif'>
							</div>
						</div>
					</div>
					<div class='clear'></div>

					<div id='m_noti_comt_".$data['idx']."' class='board_comt'>
						".$data['n_content']."
					</div>
				";
			}
			
			echo $add_html;
		}
	}

	//관리자 사칭 경고 레이어 팝업
	function warning_open_layer(){
		$top_data['add_title'] = "안내";
		$top_data['add_text'] = "";
		$top_data['add_css'] = array("layer_popup/woman_event_css");

		
		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/warning_layer_v', @$data);

		$this->load->view('layer_popup/popup_bottom_v');
	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/

