<?php

class Jjack extends MY_Controller {

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


	function jjack_list()
	{
		user_check(null,0);
		
		$uri_array = $this->seg_exp;

	    search_sex($data, $search, "T_Event_Mate_Reg", "m_sex"); //자동 성별 검색

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'T_Event_Mate_Reg', 'm_idx', 'm_userid'); //애정촌 리스트

		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$navs = array('미팅신청','짝/애정촌'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/jjack_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu(1); //애정촌 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/jjack_v', $data);
		$this->load->view('bottom_v');
	}
	


	//받거나 보낸 애정촌 리스트 (공통 사용)
	function my_propse_recv($tabmenu, $page_name){
				
		user_check(null,9);
		
		//받은 짝대기
		if($tabmenu == "1"){
			
			$search['mr1.m_userid'] = $this->session->userdata('m_userid');

		}
		//보낸 짝대기
		else if($tabmenu == "2"){

			$search['mr2.user_id'] = $this->session->userdata('m_userid');

		}
		

		$uri_array = $this->seg_exp;

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		

		$m_result = $this->meeting_m->propose_list_request($start, $rp, @$search, $tabmenu); //짝대기 리스트 요청내역
		
		$data['mlist'] = $m_result[0];
		$data['getTotalData']=$total= $m_result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$data['page_name'] = $page_name;
		
		$data['tab_mode'] = $tabmenu;
		
	
		$navs = array('미팅신청','짝/애정촌'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('meeting',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("meeting/main_css");
		$top_data['add_js'] = array("meeting/jjack_js");
		
		$data['call_top'] = $this->call_top(); //본문 상단
		$data['call_tabmenu'] = $this->call_tabmenu(2); //짝/애정촌 탭메뉴
		$data['call_tabmenu2'] = $this->call_tabmenu2($tabmenu); //짝/애정촌 탭메뉴2
		//$data['call_tabmenu2'] = $this->call_tabmenu2(1); //짝/애정촌 탭메뉴2

		$this->load->view('top_v',$top_data);
		$this->load->view('meeting/jjack_my_propse_v', $data);
		$this->load->view('bottom_v');
	}
	

	//받은 짝대기
	function mypage_recv(){
		$this->my_propse_recv($tabmenu = 1, "받은");
	}

	//보낸 짝대기
	function mypage_send(){
		$this->my_propse_recv($tabmenu = 2, "보낸");
	}	
	

	function call_top(){
		//짝/애정촌 본문 상단
		ob_start();
		
		$this->load->view('meeting/jjack_top_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($num){
		// 짝/애정촌 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();
		
		$this->load->view('meeting/jjack_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu2($num){
		// 짝/애정촌 2차 탭메뉴

		for($i=1;$i<10;$i++){
				if($i == $num){
					$data["tap_menu_css2_$i"]  = "meeting_2dep_on";			
				}else{
					$data["tap_menu_css2_$i"]  = "meeting_2dep_off";			
				}
		}

		ob_start();
		
		$this->load->view('meeting/jjack_my_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}



	//애정촌 등록하기
	function reg_mate(){

		//로그인 여부 체크
		user_check(null,9,'exit');

		$data['m_cmt'] = rawurldecode($this->input->post('m_cmt', true));

		$arr_data = array(

			'm_userid'			=> $this->session->userdata('m_userid'),
			'm_sex'				=> $this->session->userdata('m_sex'),
			'm_age'				=> $this->session->userdata('m_age'),
			'm_conregion'		=> $this->session->userdata('m_conregion'), 
			'm_writedate'		=> NOW,
			'm_cmt'				=> strip_tags($data['m_cmt'])

		);

		$search['m_userid'] = $this->session->userdata('m_userid');
		
		$chk = $this->my_m->cnt('T_Event_Mate_Reg', $search);
		
		if($chk == "0"){
			//등록이 안되어있을 경우 insert
			$rtn = $this->my_m->insert('T_Event_Mate_Reg', $arr_data);
		}else{
			//등록되어 있을경우 update
			$rtn = $this->my_m->update('T_Event_Mate_Reg', $search , $arr_data);
		}

		if($rtn == "1"){
			echo true; //정상등록
		}else{
			echo false; //오류
		}


		
	}



	//짝대기 보내기 레이어팝업
	function request_popup(){

		//로그인 여부 체크
		user_check(null,9);
		
		$data['m_idx'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'm_idx')));
		

		//애정촌 데이터 가져오기
		$m_result = $this->my_m->get_list(0, 1, @$data, 'T_Event_Mate_Reg', 'm_idx', 'm_userid');
		$data['mlist'] = $m_result[0][0];
		$data['getTotalData']=$total= $m_result[1];
		
		
		$top_data['add_css'] = array("layer_popup/beongae_request_css");
		$top_data['add_js'] = array("layer_popup/beongae_request_js");
		$top_data['add_title'] = "짝대기 보내기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/propose_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//짝대기 신청하기
	function propose_sumit(){

		//로그인 여부 체크
		user_check(null,9);

		$data = $this->member_lib->get_member(rawurldecode($this->input->post('p_user_id',TRUE)));

		//성별이 같을 경우 번개팅요청불가
		if($this->session->userdata['m_sex'] == $data['m_sex']){
			echo "error"; exit;
		}

		$data['p_idx']			= rawurldecode($this->input->post('p_idx',TRUE));
		$data['user_id']		= $this->session->userdata('m_userid');
		$data['p_user_id']		= rawurldecode($this->input->post('p_user_id',TRUE));
		$data['w_date']			= NOW;
		$data['m_msg']			= strip_tags(rawurldecode($this->input->post('m_msg',TRUE)));
		$data['gubn']			= rawurldecode($this->input->post('gubn',TRUE));

		$arr_data = array(

			"p_idx"			=> $data['p_idx'],
			"user_id"		=> $data['user_id'],
			"p_user_id"		=> $data['p_user_id'],
			"w_date"		=> $data['w_date'],
			"m_msg"			=> $data['m_msg'],
			"gubn"			=> $data['gubn']
		);

		$rtn = $this->my_m->insert('T_Event_Mate_request', $arr_data);

		if($rtn == 1){
			//짝대기 보내기 alrim_helper
			joyhunting_alrim("짝대기", $data['p_user_id'], $data['user_id']);

			//번개팅 조이헌팅 이메일 알림 alrim_helper
			joyhunting_email_alrim('짝대기', $data['p_user_id'], $data['user_id']);

		}

		echo $rtn;
	}

	//짝대기 댓글보기
	function sub_view(){

		$p_idx		= rawurldecode($this->input->post('p_idx',TRUE));
		$p_user_id	= rawurldecode($this->input->post('p_user_id',TRUE));
		$mode		= rawurldecode($this->input->post('mode',TRUE));

		$comment_result = $this->meeting_m->comment_propose($p_idx, $p_user_id, $mode);

		$data['mlist'] = $comment_result[0];
		$data['getTotalData'] = $total = $comment_result[1];
		
		$final_html = "";

		foreach($data['mlist'] as $data){

			//받은짝대기, 보낸짝대기의 레이아웃
			if($data['user_id'] == $this->session->userdata('m_userid')){
				$del_style = "";
				$sub_view_width = 'width_537'; //나의 글일때 게시물을 길게
			}else{
				$del_style = "displaynone"; //삭제버튼 숨기기
				$sub_view_width = 'width_395'; //상대방 글일때 게시물을 짧게
			}

			$final_html = $final_html."
				<div class='margin_top_8 margin_left_18 block'>
					<div class='block ver_top width_36 pointer' onclick='view_profile(\"$data[user_id]\");'>".$this->member_lib->member_thumb($data['user_id'],34,31)."</div>
					<div class='block ver_top width_537 jjack_del_btn'>
						<div class='".$sub_view_width." float_left'>
							<p class='color_333 block margin_left_7 margin_right_22 ver_top'>".$data['m_nick']."</p><span class='color_999 ver_bottom'>".$data['w_date']."</span>
							<input type='button' class='rep_del_btn ".$del_style."' id='d_btn'  onclick='javascript:btn_del(".$data['idx'].");'>
							<div class='margin_left_7 break_all padding_bottom_7 color_666 margin_top_4'>".$data['m_msg']."</div>
						</div>";

			// 타인의 글일때 -> 쪽지보내기 아이콘 버튼 추가
			if($data['user_id'] != $this->session->userdata('m_userid')){

				$final_html = $final_html."
						<div class='float_right padding_bottom_5'>
							<div class='icon_btn_bababa margin_top_3' onclick='view_profile(\"$data[user_id]\");'>
								<span class='img_mail_btn'></span>
							</div>
							<div class='icon_btn_bababa margin_left_1 margin_top_3' onclick='chat_request(\"$data[user_id]\");'>  
								<span class='img_talk_btn'></span>
							</div>
							<div class='icon_btn_bababa margin_left_1 margin_top_3' onclick='jjim_request(\"$data[user_id]\");'>
								<span class='img_heart_btn'></span>
							</div>
						</div>";

			}

			$final_html = $final_html."
					</div>
				</div>
				<div class='margin_left_18 comment_rep_dott'></div>
		";
		};

		 
		echo $final_html;

		
	}

	//짝대기 본인 댓글 삭제
	function user_rpy_del(){

		$search['user_id'] = $this->session->userdata('m_userid');
		$search['idx'] = rawurldecode($this->input->post('idx',TRUE));
		$rtn = $this->my_m->del('T_Event_Mate_request', $search);

		echo $rtn;
	}
	

		

}

/* End of file main.php */
/* Location: ./application/controllers/ */