<?php

class Joy_police extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->model('my_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function police_list($police_view,$tab_menu = null){

		@$chk_cnt = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chk_cnt')));
		
		// 처벌내용 확인했으면 처벌해제일 업데이트
		if(@$chk_cnt == 'q'){

			$cnt_search['user_id'] = $this->session->userdata('m_userid');
			$cnt_search['p_card'] = '1';
			$set_array = array('p_cancel' => NOW);
			$up_cnt = $this->my_m->update('Police_punish', $cnt_search, $set_array);
		}

		if ($police_view == 'my_caution_v' || $police_view == 'my_caution2_v'){
	
			$data['user'] = $this->member_lib->get_member($this->session->userdata('m_userid'));

			$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));

			//페이징 변수
			$page = $data['page'] = $this->pre_paging();
			$rp = $data['rp'] =10; //리스트 갯수
			$limit = 9; //보여줄 페이지수
			$start = (($page-1) * $rp);

			if ($police_view == 'my_caution_v'){

				$search['user_id'] = $this->session->userdata('m_userid');
				$m_result = $this->my_m->get_list($start, $rp, @$search, 'Police_punish', 'p_idx', 'user_id');

			}else{

				$search['s_id'] = $this->session->userdata('m_userid');
				$m_result = $this->my_m->get_list($start, $rp, @$search, 'Police_complaint', 'c_idx', 's_id');

			}

			$data['mlist'] = $m_result[0];
			$data['getTotalData']=$total= $m_result[1];
		
			$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));


		}

		$navs = array('홈','고객센터','조이폴리스'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/joy_police_css");
		$top_data['add_js'] = array("service_center/joy_police_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$data['tab_menu'] = @$tab_menu;	//탭메뉴가 있을때 받아오기

		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/'.$police_view, $data);
		$this->load->view('bottom_v');
	}

	function declaration(){		//신고방법
		$this->police_list("police_v");
	}

	function  punishment(){		//처벌기준

		$tab_menu = $this->load->view('service_center/punishment_tabmenu_v', array('tab_menu_on' =>1), TRUE);	//탭메뉴 호출

		$this->police_list("punishment_v",$tab_menu);

	}

	function  punishment2(){		//처벌안내

		$tab_menu = $this->load->view('service_center/punishment_tabmenu_v', array('tab_menu_on' =>2), TRUE);	//탭메뉴 호출

		$this->police_list("punishment2_v",$tab_menu);

	}

/*
	function  punishment3(){		//처벌예시

		$tab_menu = $this->load->view('service_center/punishment_tabmenu_v', array('tab_menu_on' =>3), TRUE);	//탭메뉴 호출

		$this->police_list("punishment3_v",$tab_menu);

	}
*/

	function my_caution(){		//나의 경고기록 (처벌내용)

		user_check(null,0);

		$tab_menu = $this->load->view('service_center/my_caution_tabmenu_v', array('tab_menu_on' =>1), TRUE);	//탭메뉴 호출

		$this->police_list("my_caution_v",$tab_menu);

	}

	function my_caution2(){		//신고내용

		$tab_menu = $this->load->view('service_center/my_caution_tabmenu_v', array('tab_menu_on' =>2), TRUE);	//탭메뉴 호출

		$this->police_list("my_caution2_v",$tab_menu);

	}

	function fraud_ex(){		//사기 피해사례 (조건만남 사기사례)

		$tab_menu = $this->load->view('service_center/fraud_ex_tabmenu_v', array('tab_menu_on' =>1), TRUE);	//탭메뉴 호출

		$this->police_list("fraud_ex_v",$tab_menu);

	}

	function fraud_ex2(){		//060전화 사기사례

		$tab_menu = $this->load->view('service_center/fraud_ex_tabmenu_v', array('tab_menu_on' =>2), TRUE);	//탭메뉴 호출

		$this->police_list("fraud_ex2_v",$tab_menu);

	}

	function fraud_ex3(){		//화상전화 홍보사례

		$tab_menu = $this->load->view('service_center/fraud_ex_tabmenu_v', array('tab_menu_on' =>3), TRUE);	//탭메뉴 호출

		$this->police_list("fraud_ex3_v",$tab_menu);

	}

	function fraud_ex4(){		//조건만남 처벌기준

		$tab_menu = $this->load->view('service_center/fraud_ex_tabmenu_v', array('tab_menu_on' =>4), TRUE);	//탭메뉴 호출

		$this->police_list("fraud_ex4_v",$tab_menu);

	}

	function baduse_ex(){		//불량이용사례 쪽지

		$tab_menu = $this->load->view('service_center/baduse_ex_tabmenu_v', array('tab_menu_on' =>1), TRUE);	//탭메뉴 호출

		$this->police_list("baduse_ex_v",$tab_menu);

	}

	function baduse_ex2(){		//PC방

		$tab_menu = $this->load->view('service_center/baduse_ex_tabmenu_v', array('tab_menu_on' =>2), TRUE);	//탭메뉴 호출

		$this->police_list("baduse_ex2_v",$tab_menu);

	}

	function baduse_ex3(){		//방지책

		$tab_menu = $this->load->view('service_center/baduse_ex_tabmenu_v', array('tab_menu_on' =>3), TRUE);	//탭메뉴 호출

		$this->police_list("baduse_ex3_v",$tab_menu);

	}

	function complain_popup(){
		//신고하기 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,0);

		// 내아이디
		$data['user_id'] = $this->session->userdata('m_userid');

		// 처벌대상 아이디(닉네임과 구분)
		$data['recv_id'] = $recv_mb_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); if(!$recv_mb_id){exit;}
		@$data['recv_nick'] = $recv_mb = $this->security->xss_clean(url_explode($this->seg_exp, 'recv_mb')); if(!$recv_mb){exit;}

		// 메세지 신고하기면 idx로 메세지내용 가지고 가기
		@$data['mes_idx'] = $this->security->xss_clean(url_explode($this->seg_exp, 'mes_idx'));

		if(@$data['mes_idx'] == true){

			$mes_ary = $this->my_m->row_array('MESSAGE_LIST', array("V_IDX" => $data['mes_idx']));
			$data['mes_content'] = $mes_ary['V_CONTENTS'];
		}

		//print_r($data);

		$top_data['add_js'] = array("layer_popup/complain_request_js");
		$top_data['add_title'] = "신고하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/complain_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	function complain_nick_check(){
		//불량이용자 닉네임 존재 여부 체크

		$search['m_nick'] = $this->input->post('m_nick',TRUE);

		$m_result = $this->my_m->cnt('TotalMembers', $search);

		echo $m_result;
	}


	function complain_pop(){

		user_check(null,0);


		@$comp_user		 = rawurldecode($this->input->post('comp_user', true));
		@$comp_nick		 = rawurldecode($this->input->post('comp_nick', true));
		$comp_cate		 = rawurldecode($this->input->post('comp_cate', true));
		$comp_content	 = rawurldecode($this->input->post('comp_content', true));
		@$comp_text		 = rawurldecode($this->input->post('comp_chat', true));

		// text 없으면 빈값
		if(@$comp_text == false){ $comp_text = '';}

		// ID 검색(메세지,채팅에서 신고)
		if($comp_nick == false){
			$search['m_userid'] = $comp_user;

		// NICK 검색(나의경고기록 > 신고하기)
		}else{
			$search['m_nick'] = $comp_nick;
		}

		//불량회원 정보검색
		$recv_user = $this->my_m->row_array('TotalMembers', $search);

		//첨부파일이 있으면
		if(@$_FILES['comp_upload']['name']) { 

			$config['upload_path'] = '/resource/joyhunting_upload/police/';;
			$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
			$config['max_size']	= '1000';
			$config['max_width']  = '2048';
			$config['max_height']  = '1536';
			
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload('comp_upload'))
			{
				echo strip_tags($this->upload->display_errors());
				exit;
			}	
			else
			{
				//리턴값 file_name, file_pth, full_path
				$data = $this->upload->data();
			}

		}

		//신고 테이블에 인서트
		$arr_data = array(
			's_id' =>  $this->session->userdata('m_userid'),
			's_nick' => $this->session->userdata('m_nick'),
			'r_id' => $recv_user['m_userid'],
			'r_nick' => $recv_user['m_nick'],
			'c_cate' => $comp_cate,
			'c_content' => $comp_content,
			'c_file' => @$data['file_name'],
			'c_success' => '1',
			'c_date' => NOW,
			'c_chat_content' => $comp_text
		);

		$rtn = $this->my_m->insert("Police_complaint", $arr_data);

		// 인서트 성공했을때
		if ($rtn == '1'){

			// 모바일이면
			if (IS_MOBILE == true){
				
				// 한글깨져서 meta추가
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><script> alert('접수되었습니다. 관리자의 확인후 처벌됩니다.'); history.go(-1); </script>";
				
			// PC면
			}else{

				// 나의경고기록 > 신고하기 였으면 신고내용으로
				if($comp_nick == true){
					echo "<script> alert('접수되었습니다. 관리자의 확인후 처벌됩니다.');</script>";
					$tab_menu = $this->load->view('service_center/my_caution_tabmenu_v', array('tab_menu_on' =>2), TRUE);
					$this->police_list("my_caution2_v",$tab_menu);
				}else{
					echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><script> alert('접수되었습니다. 관리자의 확인후 처벌됩니다.');  history.go(-1);</script>";
				}

			}
		}
	}


	// 처벌 레이어팝업 (PC)
	function complaint_popup(){
		$data['user_id'] = $idx = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); if(!$idx){exit;}
		$data['card'] = $card = $this->security->xss_clean(url_explode($this->seg_exp, 'card')); if(!$card){exit;}

		$search['user_id'] = $data['user_id'];

		$data['punish'] = $punish = $this->my_m->row_array('Police_punish', $search, 'p_idx');

		//경고일경우
		if ($card == '1'){
			$puni_title = "경고입니다.";
			$data['puni_add'] = "※ 다시 로그인 해주세요.";
		
		//영구정지일경우
		}else if ($card == '5'){
			$puni_title = "접속이 제한되었습니다.";
			$data['puni_add'] = "※ 자세한 문의사항은 대표번호(070-7439-4260)로 연락주시기 바랍니다.";
		
		//화이트,옐로,레드카드일경우
		}else {
			$puni_title = "일시적으로 접속이 제한되었습니다.";
		}

		$top_data['add_js'] = array("layer_popup/complain_request_js");
		$top_data['add_title'] = $data['user_id']."님은 ".$puni_title;
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/complain_alrim_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

		
		//경고였을경우 처벌해제일 업데이트
		if ($card == '1'){

			//처벌 테이블 업데이트
			$set_array = array(
				'p_cancel'		=>	NOW
			);

			$search_idx['p_idx'] = $punish['p_idx'];

			$rtn = $this->my_m->update('Police_punish', $search_idx, $set_array);

			// 신고에의한 처벌이였을경우 신고테이블도 업데이트
			if (@$punish['c_idx'] != ''){

				$com_idx['c_idx'] = $punish['c_idx'];

				$comp_array = array(
					'c_cancel'		=>	NOW
				);

				$punich_rtn = $this->my_m->update('Police_complaint', $com_idx, $comp_array);	
			}

		}
	}



	// 처벌 레이어팝업 (MOBILE)
	function complaint_popup_mobile(){
	
		$data['user_id'] = $idx = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); if(!$idx){exit;}
		$data['card'] = $card = $this->security->xss_clean(url_explode($this->seg_exp, 'card')); if(!$card){exit;}

		$search['user_id'] = $data['user_id'];

		$data['punish'] = $punish = $this->my_m->row_array('Police_punish', $search, 'p_idx');

		$top_data['add_js'] = array("layer_popup/complain_request_js");
		$top_data['add_title'] = '처벌대상입니다.';
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/complain_alrim_mobile_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

		
		//경고였을경우 처벌해제일 업데이트
		if ($card == '1'){

			//처벌 테이블 업데이트
			$set_array = array(
				'p_cancel'		=>	NOW
			);

			$search_idx['p_idx'] = $punish['p_idx'];

			$rtn = $this->my_m->update('Police_punish', $search_idx, $set_array);

			// 신고에의한 처벌이였을경우 신고테이블도 업데이트
			if (@$punish['c_idx'] != ''){

				$com_idx['c_idx'] = $punish['c_idx'];

				$comp_array = array(
					'c_cancel'		=>	NOW
				);

				$punich_rtn = $this->my_m->update('Police_complaint', $com_idx, $comp_array);	
			}

		}
	}



	// 광고, 사업제휴 문의하기 //모바일과 공용
	function business_pop(){

		$bu_ver		 = rawurldecode($this->input->post('bu_ver', true));

		if ($bu_ver == 'pver'){
			$bu_name		 = rawurldecode($this->input->post('bu_name', true));
			$bu_email_1		 = rawurldecode($this->input->post('bu_email_1', true));
			$bu_email_after	 = rawurldecode($this->input->post('bu_email_after', true));
			$bu_email = $bu_email_1."@".$bu_email_after;
		}else{
			$bu_email		 = rawurldecode($this->input->post('bu_email', true));
			$bu_name		 = $this->session->userdata('m_name');
		}

		$bu_cate		 = rawurldecode($this->input->post('bu_cate', true));
		$bu_company		 = rawurldecode($this->input->post('bu_company', true));
		$bu_ph			 = rawurldecode($this->input->post('bu_ph', true));
		$bu_info		 = rawurldecode($this->input->post('bu_info', true));
		$bu_content		 = rawurldecode($this->input->post('bu_content', true));

		if(empty($bu_company) or empty($bu_content)){
			echo 0;
			return;
		}

		$data_array = array(
			'bu_cate'		=>	$bu_cate,
			'bu_name'		=>	$bu_name,
			'bu_company'	=>	$bu_company,
			'bu_phone'		=>	$bu_ph,
			'bu_email'		=>	$bu_email,
			'bu_info'		=>	$bu_info,
			'bu_content'	=>	$bu_content
		);

		$rtn = $this->my_m->insert('business_call', $data_array);

		echo $rtn;

	}



}

/* End of file main.php */
/* Location: ./application/controllers/*/

