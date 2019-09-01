<?php

class Gift extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('gift_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('alrim_helper');
	}

	function index(){
		$this->gift_list();
	}

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//선물상점 관련 PC버전 함수
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//선물상점 상품 리스트(PC버전)
	function gift_list(){
		
		//user_check
		user_check(null, 0, null);

		//변수받기
		$v_category = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'category')));
		
		//카테고리 정리함수(default = 커피/음료)
		$data['category'] = $category = $this->call_tab_menu($v_category);
	
		//세션아이디 받기
		$user_id = $this->session->userdata['m_userid'];
		
		//세션아이디가 없을경우 중지
		if(empty($user_id)){ exit; }

		$data['total_point'] = $this->call_member_point($user_id);

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 9; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list_solo($start, $rp, array("V_CATEGORY" => $category, "V_USE_YN" => "Y"), 'GIFT_LIST', 'V_PRIORITY', 'DESC', '*');
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total= $result[1];
				
		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		//view 설정
		$navs = array('선물상점','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('gift_shop',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('gift_shop'); //우측메뉴 로딩

		$top_data['add_css'] = array("gift_shop/gift_shop_css");
		$top_data['add_js'] = array("gift_shop/gift_shop_js");

		$bot_data['add_script'] = "
		<script type='text/javascript'>
			$(document).ready(function(){
				tab_menu_border('$category');
			});
		</script>
		";

		$this->load->view('top_v',$top_data);
		$this->load->view('gift_shop/gift_shop_v', $data);
		$this->load->view('bottom_v', $bot_data);

	}

	
	//받은선물함 및 보낸선물함(PC버전)
	function gift_box($tabmenu = "1"){
		
		//user_check
		user_check(null, 0, null);

		//세션아이디 받기
		$user_id = $this->session->userdata['m_userid'];
		
		//세션아이디가 없을경우 중지
		if(empty($user_id)){ exit; }

		if($tabmenu == "1"){
			$mode = "recv";
			$search = "V_RECV_ID";
			
		}else if($tabmenu == "2"){
			$mode = "send";
			$search = "V_SEND_ID";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->gift_m->gift_box($start, $rp, $search, $user_id, 'list');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		$navs = array('선물상점','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('gift_shop',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('gift_shop'); //우측메뉴 로딩

		$data['call_top'] = $this->call_gift_box_top($tabmenu);

		$top_data['add_css'] = array("gift_shop/gift_shop_css");
		$top_data['add_js'] = array("gift_shop/gift_shop_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('gift_shop/gift_'.$mode.'_box_v', $data);
		$this->load->view('bottom_v');

	}

	//받은선물함 
	function gift_recv_box(){
		$this->gift_box('1');
	}

	//보낸선물함
	function gift_send_box(){
		$this->gift_box('2');
	}

	//선물함 탑메뉴
	function call_gift_box_top($num){

		//세션아이디 받기
		$user_id = $this->session->userdata['m_userid'];
		
		//세션아이디가 없을경우 중지
		if(empty($user_id)){ exit; }

		//회원 보유 총 포인트 가져오기
		$data['total_point'] = $this->call_member_point($user_id);

		if($num == "1"){
			$data['tab_1'] = "tab_on";
			$data['tab_2'] = "tab_off";
		}else if($num == "2"){
			$data['tab_1'] = "tab_off";
			$data['tab_2'] = "tab_on";
		}

		ob_start();
		
		$this->load->view('gift_shop/gift_box_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	//선물리스트 삭제 함수(받은선물함, 보낸선물함 PC버전)
	function call_gift_list_del(){
		
		$chk_list = rawurldecode($this->input->post('chk_list', true));
		
		//삭제할 데이터가 없을경우 중지
		if(empty($chk_list)){ exit; }

		$chk_value = explode('|', $chk_list);
		
		for($i=0; $i<count($chk_value); $i++){
			$rtn = $this->my_m->update('GIFT_SEND', array('V_IDX' => $chk_value[$i]), array('V_DEL_GUBN' => 'D'));
		}

		echo $rtn;

	}


	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//선물상점 관련 MOBILE버전 함수
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	
	//받은선물함 및 보낸선물함 레이어팝업(MOBILE)
	function gift_box_layer(){
		
		//user_check
		user_check(null, 0, null);

		//변수받기
		$mode			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));		//mode : send:보낸, recv:받은 선물함
		
		//세션아이디 체크
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit;}

		if($mode == "send"){

		}else if($mode == "recv"){

		}

		//데이터 불러오기
		$data['recv_data'] = $this->gift_m->gift_box(null, null, 'V_RECV_ID', $user_id);		//받은 데이터
		$data['send_data'] = $this->gift_m->gift_box(null, null, 'V_SEND_ID', $user_id);		//보낸 데이터

		//view 설정
		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물함";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/gift_box_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//선물상점 관련 PC, MOBILE 공용함수
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/	
	//채팅방내에서의 선물상점 레이어팝업(PC, MOBILE 공용)
	function gift_shop_layer(){

		//user_check
		user_check(null, 5, null);

		//변수받기
		$mode			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));		//채팅방 내에서만 선물가능(모드값 : chat)
		$user_id		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));	//선물받을 회원 아이디

		//세션아이디 체크(세션아이디가 없거나, 선물을 받을 회원의 아이디가 없을 경우 중지)
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($user_id) or empty($s_user_id)){ exit; }

		//회원의 보유 포인트 가져오기
		$data['total_point'] = $this->call_member_point($s_user_id);
		$data['mode']		= $mode;			//모드값
		$data['user_id']	= $user_id;			//선물받을 회원
		
		//view 설정
		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물상점";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/gift_shop_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//채팅방내에서의 선물상점 리스트 레이어팝업(PC, MOBILE 공용)
	function gift_list_layer(){

		//user_check
		user_check(null, 5, null);

		//변수받기
		$mode			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));		//채팅방 내에서만 선물가능(모드값 : chat)
		$user_id		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));	//선물받을 회원 아이디
		$category		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'category')));	//카테고리

		//모바일 레이어팝업은 특수문자가 파라미터에 있을경우 잘 안넘어가는 경우가 있어서 커피/음료 -> 음료, 버거/피자 -> 패스트푸트 로 변경하여 넘김
		$cate = $this->gift_category_change($category);
		
		//세션 아이디 체크
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($user_id) or empty($s_user_id)){ exit; }	//세션 아이디 혹은 선물을 받는 회원의 아이디가 없을경우 중지
		
		//선물받을 회원 아이디 넘기기
		$data['user_id'] = $user_id;

		//상품정보 가져오기
		$data['gift_list'] = $gift_list = $this->my_m->result_array('GIFT_LIST', array('V_CATEGORY' => $cate, 'V_USE_YN' => 'Y'), 'V_PRIORITY', 'DESC', null);

		//상품이 없을경우 경고창 호출
		if(empty($gift_list)){ echo "exit"; exit; }

		//모드값 넘기기
		$data['mode'] = $mode;
		
		//view 설정
		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = $cate;
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/gift_list_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//선물 상세보기 레이어팝업(PC, MOBILE 공용)
	function gift_detail_layer(){

		//user_check
		user_check(null, 0, null);

		//변수받기
		$v_mode		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));				//채팅상 내에서인지 아닌지 구분값 (mode : chat, list)
		$v_idx		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));				//상품 고유번호
		$v_user_id  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));			//선물 받을 회원의 아이디

		//세션 아이디 체크
		$s_user_id = $this->session->userdata['m_userid'];

		if(empty($s_user_id)){ exit; }
		
		//회원 보유 포이트 가져오기
		$data['total_point'] = $this->call_member_point($s_user_id);

		//상품 데이터 가져오기
		$data['gift_data'] = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $v_idx));

		//mode 값이 chat 일경우만에 선물하기 가능(채팅방 내에서만 선물하기 가능)
		$data['mode'] = $v_mode;

		//선물받을 회원의 아이디 넘기기
		$data['user_id'] = $v_user_id;
		
		//레이어팝업 pc버전과 mobile버전의 height style 차이
		if(IS_MOBILE == true){
			$data['pop_style'] = "style='height:500px; overflow:scroll; overflow-x:hidden;'";
		}else{
			$data['pop_style'] = "";
		}
		
		//view 설정
		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물상세보기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/gift_detail_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//채팅방내에서 선물하기 클릭시 선물보내기 확인 레이어팝업(PC, MOBILE 공용)
	function send_gift_confirm(){

		//user_check
		user_check(null, 5, null);

		//변수받기
		$v_mode		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));				//채팅상 내에서인지 아닌지 구분값 (mode : chat, list)
		$v_idx		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));				//상품 고유번호
		$v_user_id  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));			//선물 받을 회원의 아이디

		//세션 아이디 체크
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($s_user_id) or empty($v_user_id)){ exit; }

		//선물데이터 가져오기
		$data['gift_data'] = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $v_idx));

		if($v_mode == "chat"){
			$v_gubn = "";
		}else if($v_mode == "list"){
			$v_gubn = "_myself";
		}

		//결제관련 필요한 데이터 넘기기(mode, idx, user_id)
		$data['mode']		= $v_mode;				//모드값
		$data['idx']		= $v_idx;				//상품고유번호
		$data['user_id']	= $v_user_id;			//선물받는 회원 아이디
		$data['gubn']		= $v_gubn;				//본인에게 선물받는것인지 구분자
		
		//view설정
		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물보내기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/send_gift_confirm_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}
	
	//채팅방내에서 선물하기 함수 ajax(PC, MOBILE 공용)
	function call_send_gift_ajax(){

		//user_check
		user_check(null, 9, 'exit');
		
		$mode		= rawurldecode($this->input->post('mode', true));
		$idx		= rawurldecode($this->input->post('idx', true));
		$user_id	= rawurldecode($this->input->post('user_id', true));

		//세션 아이디 체크
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($s_user_id) or empty($user_id)){ echo "exit"; exit; }

		//mode값이 chat이 아닐경우 중지
		if($mode != "chat"){ echo "exit"; exit; }

		//상품정보 불러오기
		$gift_data = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $idx));

		if(empty($gift_data)){ echo "exit"; exit; }

		//포인트검사
		$total_point = $this->call_member_point($s_user_id);
		
		//보유포인트가 상품포인트보다 적거나 0일경우 중지
		if($total_point == "0" or $total_point < $gift_data['V_PRICE_P']){
			echo "point"; exit;
		}
		
		//선물보내기 insert data
		$arrData = array(
			"V_SEND_ID"				=> $s_user_id,										//보내는회원아이디
			"V_RECV_ID"				=> $user_id,										//받는회원아이디
			"V_GIFT_NUM"			=> $gift_data['V_IDX'],								//상품고유번호
			"V_GIFT_CODE"			=> $gift_data['V_PRODUCT_CODE'],					//상품코드
			"V_RECV_YN"				=> 'N',												//수신여부
			"V_SEND_YN"				=> 'N',												//발송여부
			"V_SEND_DATE"			=> NOW,												//보낸날짜
			"V_RECV_DATE"			=> NULL												//수신선청날짜
		);

		$rtn = $this->my_m->insert('GIFT_SEND', $arrData);

		if($rtn == "1"){
			//선물보내기 성공시 포인트 차감(point_helper)
			$mpi = member_point_insert($s_user_id, '9000', '선물보내기차감', '-'.$gift_data['V_PRICE_P'], null, null, NOW, null);
			
			$mpi = "1";

			if($mpi == "1"){
				$this->call_chat_list_data($mode, $gift_data['V_IDX'], $s_user_id, $user_id);
			}

		}
		
		echo $rtn;

	}

	//채팅방 내에서 선물 조르기 함수 ajax
	function call_chat_gift_request(){

		//user_check
		user_check(null, 9, 'exit');

		$mode		= rawurldecode($this->input->post('mode', true));				//mode 값 request(선물조르기)
		$idx		= rawurldecode($this->input->post('idx', true));				//상품고유번호
		$user_id	= rawurldecode($this->input->post('user_id', true));			//조르기대상 회원아이디
		
		//세션아이디 검사
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($user_id) or empty($s_user_id)){ echo "1000"; exit; }	
		
		//현재 대화중인 채팅방 번호 가져오기
		$search = array(
			"ex_data_1"		=> "((send_id = '".$user_id."' AND recv_id = '".$s_user_id."') OR (send_id = '".$s_user_id."' AND recv_id = '".$user_id."'))",
			"ex_data_2"		=> "is_delete is null"
		);
		
		$chat_data = $this->my_m->row_array('chat_request', $search, 'idx', 'desc', '1');
		
		//채팅방 번호가 없을경우 처리
		if(empty($chat_data)){ echo "1000"; exit; }
		
		$arrData = array(
			"V_SEND_ID"				=> $s_user_id,
			"V_RECV_ID"				=> $user_id,
			"V_GIFT_NUM"			=> $idx,
			"V_SEND_DATE"			=> NOW,
			"V_IP"					=> $_SERVER['REMOTE_ADDR'],
			"V_CHAT_REQ"			=> $chat_data['idx'],
			"V_DEL_GUBN"			=> NULL
		);

		//상품조르기 테이블에 insert
		$rtn = $this->my_m->insert('GIFT_REQUEST', $arrData);

		if($rtn == "1"){
			//상품조르기 데이터 insert 성공시 chat테이블에 상품조르기 view 데이터 입력
			$this->call_chat_list_data($mode, $idx, $s_user_id, $user_id);
		}

		echo $rtn;
	}

	//본인에게 선물하기 함수 ajax
	function call_myself_send_gift_ajax(){

		//user_check
		user_check(null, 9, 'exit');

		$mode		= rawurldecode($this->input->post('mode', true));				//mode값
		$idx		= rawurldecode($this->input->post('idx', true));				//상품고유번호
		$user_id	= rawurldecode($this->input->post('user_id', true));			//본인세션아이디

		if($user_id <> $this->session->userdata['m_userid']){ echo "1000"; exit; }	//본인이 본인이게 선물할경우 선물받는 아이디와 세션아이디가 일치하지 않을경우 잘못된접근처리

		//포인트검사
		$total_point = $this->call_member_point($user_id);

		//상품정보 불러오기
		$gift_data = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $idx));
		
		//보유포인트가 상품포인트보다 적거나 0일경우 중지
		if($total_point == "0" or $total_point < $gift_data['V_PRICE_P']){
			echo "point"; exit;
		}

		//선물보내기 insert data
		$arrData = array(
			"V_SEND_ID"				=> $user_id,										//보내는회원아이디
			"V_RECV_ID"				=> $user_id,										//받는회원아이디
			"V_GIFT_NUM"			=> $gift_data['V_IDX'],								//상품고유번호
			"V_GIFT_CODE"			=> $gift_data['V_PRODUCT_CODE'],					//상품코드
			"V_RECV_YN"				=> 'N',												//수신여부
			"V_SEND_YN"				=> 'N',												//발송여부
			"V_SEND_DATE"			=> NOW,												//보낸날짜
			"V_RECV_DATE"			=> NULL												//수신선청날짜
		);

		$rtn = $this->my_m->insert('GIFT_SEND', $arrData);

		if($rtn == "1"){
			//선물보내기 성공시 포인트 차감(point_helper)
			$mpi = member_point_insert($user_id, '9000', '선물보내기차감', '-'.$gift_data['V_PRICE_P'], null, null, NOW, null);

		}
		
		echo $rtn;

	}

	//선물보내기 및 조르기 성공시 채팅테이블에 선물보내기 데이터 입력(PC, MOBIEL 공용)
	function call_chat_list_data($mode, $idx, $send_id, $recv_id){

		//선물고유번호, 선물을 하는 사람이나 받는 사람의 아이디가 없을경우 return
		if(empty($send_id) or empty($recv_id) or empty($idx)){
			return;
		}else{

			//보내는 회원의 회원정보 가져오기
			$send_data = $this->member_lib->get_member($send_id);

			//채팅방번호 가져오기
			$search = array(
				"ex_data_1"		=> "((send_id = '".$send_id."' and recv_id = '".$recv_id."') OR (send_id = '".$recv_id."' AND recv_id = '".$send_id."'))",
				"ex_data_2"		=> "is_delete_gubn is null"
			);

			$chat = $this->my_m->row_array('chat', $search, 'idx', 'desc', '1');

			if($mode == "chat"){
				//선물보내기의 경우
				$v_mode = "gift";
				$v_contents = "선물(".$idx.")";
			}else if($mode == "request"){
				//선물조르기의 경우
				$v_mode = "gift_req";
				$v_contents = "선물쪼르기(".$idx.")";
			}

			//선물보내기 채팅데이터
			$arrData = array(
				"mode"					=> $v_mode,
				"send_id"				=> $send_id,
				"recv_id"				=> $recv_id,
				"reg_date"				=> NOW,
				"read_date"				=> null,
				"contents"				=> $v_contents,
				"send_ip"				=> $_SERVER['REMOTE_ADDR'],
				"is_delete_send"		=> '0',
				"is_delete_recv"		=> '0',
				"send_user_nick"		=> $send_data['m_nick'],
				"req_idx"				=> $chat['req_idx'],
				"is_delete_gubn"		=> null
			);

			$rtn = $this->my_m->insert('chat', $arrData);

			return $rtn;
		}

	}

	
	//회원 보유 포인트 가져오기 함수(PC, MOBIEL 공용)
	function call_member_point($user_id){
		
		$mtp = $this->my_m->row_array('member_total_point', array('m_userid' => $user_id));

		if(!empty($mtp)){
			$total_point = $mtp['total_point'];
		}else{
			$total_point = "0";
		}

		return $total_point;
	}

	//탭메뉴 변수 정리 함수(PC, MOBIEL 공용)
	function call_tab_menu($val){

		if(!empty($val)){
			if(strpos($val, '|')){
				$category = str_replace('|', '/', $val);
			}else{
				$category = $val;
			}
		}else{
			$category = '커피/음료';
		}

		return $category;
	}

	//상품 카테고리 변환함수(PC, MOBIEL 공용)
	function gift_category_change($val){

		if($val == "음료"){
			$category = "커피/음료";
		}else if($val == "편의점"){
			$category = "마트/편의점";
		}else if($val == "베이커리"){
			$category = "베이커리/도넛";
		}else if($val == "패스트푸드"){
			$category = "버거/피자";
		}else{
			$category = $val;
		}

		return $category;
	}

	//선물을 보내거나 조르기를 할경우 본인의 채팅방 리스트에 보여지기 
	function call_get_gift_data(){

		//user_check
		user_check(null, 9, 'exit');
		
		header("Content-Type:application/json");

		//변수받기
		$mode		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));				//gift:선물하기, gift_req:선물조르기 (mode : gift, gift_req)
		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));			//상대방아이디

		//세션아이디 체크
		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($user_id) or empty($s_user_id)){ exit; }

		$gdata = $this->my_m->row_array('chat', array('mode' => $mode, 'send_id' => $s_user_id, 'recv_id' => $user_id, 'is_delete_gubn' => null), 'idx', 'desc', '1');
		
		if(!empty($gdata)){
			
			$tmp[]		= $gdata['idx'];
			$tmp[]		= $gdata['mode'];			
			$tmp[]		= $gdata['contents'];
			$tmp[]		= $gdata['recv_id'];

			echo json_encode($tmp);	
		}
		
	}


	//선물보내기 및 받기 채팅방 view관련 함수
	function gift_chat_send(){

		//user_check
		user_check(null, 9, 'exit');

		header("Content-Type:application/json");
		
		$mode			= rawurldecode($this->input->post('mode', true));				//상품을 받는사람과 보내는사람 구분 (보내는사람 : send, 받는사람 : recv)
		$idx			= rawurldecode($this->input->post('idx', true));				//상품 고유번호
		$user_id		= rawurldecode($this->input->post('user_id', true));			//선물을 보내거나 받는 회원아이디

		$s_user_id = $this->session->userdata['m_userid'];								//선물하는 회원의 아이디(세션 아이디)

		if(empty($user_id) or empty($s_user_id)){ echo "1000"; exit;}					//선물을 받는 회원이나 보내는 회원의 아이디가 없는 경우 에러 처리 

		//선물받거나 보내는 회원의 정보 가져오기
		$rdata = $this->member_lib->get_member($user_id);
		
		//상품정보 가져오기
		$gdata = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $idx));

		if($mode == "send"){
			$tmp[] = "[".$rdata['m_nick']."]님에게 선물을 보냈습니다.";
			$tmp[] = $gdata['V_PRODUCT_NAME'];
			$tmp[] = "/upload/product_upload/gift/".$gdata['V_IMG_URL'];
			$tmp[] = "보낸선물함";
			$tmp[] = $mode;
		}else{
			$tmp[] = "[".$rdata['m_nick']."]님이 선물을 보냈습니다.";
			$tmp[] = $gdata['V_PRODUCT_NAME'];
			$tmp[] = "/upload/product_upload/gift/".$gdata['V_IMG_URL'];
			$tmp[] = "받은선물함";
			$tmp[] = $mode;
		}		

		echo json_encode($tmp);
				
	}

	//선물쪼르기 채팅방 view관련 함수
	function gift_req_chat_send(){

		//user_check
		user_check(null, 9, 'exit');

		header("Content-Type:application/json");
		
		$mode			= rawurldecode($this->input->post('mode', true));				//상품을 받는사람과 보내는사람 구분 (보내는사람 : send, 받는사람 : recv)
		$idx			= rawurldecode($this->input->post('idx', true));				//상품 고유번호
		$user_id		= rawurldecode($this->input->post('user_id', true));			//선물쪼르기를 보내거나 받는 회원아이디

		$s_user_id = $this->session->userdata['m_userid'];								//선물쪼르기하는 회원의 아이디(세션 아이디)
		if(empty($user_id) or empty($s_user_id)){ echo "1000"; exit;}					//선물을 받는 회원이나 보내는 회원의 아이디가 없는 경우 에러 처리 

		//선물받거나 보내는 회원의 정보 가져오기
		$rdata = $this->member_lib->get_member($user_id);

		//상품정보 가져오기
		$gdata = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $idx));

		if($mode == "send"){
			$tmp[] = "[".$rdata['m_nick']."]님에게 선물쪼르기를 보냈습니다.";
			$tmp[] = $gdata['V_PRODUCT_NAME'];
			$tmp[] = "/upload/product_upload/gift/".$gdata['V_IMG_URL'];
			$tmp[] = "";
			$tmp[] = $mode;
			$tmp[] = $idx;
			$tmp[] = $user_id;
		}else{
			$tmp[] = "[".$rdata['m_nick']."]님이 선물쪼르기 보냈습니다.";
			$tmp[] = $gdata['V_PRODUCT_NAME'];
			$tmp[] = "/upload/product_upload/gift/".$gdata['V_IMG_URL'];
			$tmp[] = "선물하기";
			$tmp[] = $mode;
			$tmp[] = $idx;
			$tmp[] = $user_id;
		}		

		echo json_encode($tmp);

	}


	//선물받기 레이어 팝업(PC, MOBILE 공통)
	function gift_take_it_layer(){

		//user_check
		user_check(null, 5, null);
		
		//변수받기
		$data['v_idx'] = $v_idx	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'v_idx')));		//받은상품 관련 idx

		$user_id = $this->session->userdata['m_userid'];

		if(empty($user_id)){ echo "1000"; exit;}

		//선물받을 회원이 정보가져오기
		$mdata = $this->member_lib->get_member($user_id);
		
		if(empty($mdata['m_hp1']) or empty($mdata['m_hp2']) or empty($mdata['m_hp3']) or $mdata['m_mobile_chk'] != "1"){
			echo "1001"; exit; //본인인증 필수 처리
		}

		//상품발송상태 체크
		$gdata = $this->my_m->row_array('GIFT_SEND', array('V_IDX' => $v_idx), 'V_IDX', 'DESC', '1');

		if($gdata['V_SEND_YN'] == "I"){
			echo "1002"; exit;
		}else if($gdata['V_SEND_YN'] == "Y"){
			echo "1003"; exit;
		}
		
		//선물을 받을 회원의 휴대전화번호
		$data['phone_num'] = $mdata['m_hp1']."-".$mdata['m_hp2']."-".$mdata['m_hp3'];
		
		//view설정
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물받기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/gift_take_it_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//선물받기 신청 처리 함수(PC, MOBILE 공통)
	function call_gift_take(){
		
		//user_check
		user_check(null, 5, null);

		//변수받기
		$v_idx = rawurldecode($this->input->post('v_idx', true));
		
		//상품받기 신청 update처리
		$rtn = $this->my_m->update('GIFT_SEND', array('V_IDX' => $v_idx), array('V_RECV_YN' => 'Y', 'V_SEND_YN' => 'I', 'V_RECV_DATE' => NOW));
		
		echo $rtn;

	}

	//채팅 수락여부 확인
	function use_chat_yn(){
		
		
		//변수 받기 
		$user_id	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		//상대방 아이디

		$s_user_id = $this->session->userdata['m_userid'];
		if(empty($user_id) or empty($s_user_id)){ exit; }
	

		$search = array(
			"ex_data_1"		=> "((send_id = '".$s_user_id."' AND recv_id = '".$user_id."') OR (recv_id = '".$s_user_id."' AND send_id = '".$user_id."')) AND is_delete IS NULL"
		);
		

		$chat_data = $this->my_m->row_array('chat_request', $search, 'idx', 'desc', '1');
		
		if(!empty($chat_data)){
			echo $chat_data['status'];
		}else{
			echo "";
		}
		
	}


}


/* End of file main.php */
/* Location: ./application/controllers/*/