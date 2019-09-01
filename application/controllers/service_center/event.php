<?php

class Event extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->library('m_top_menu_lib');
	}

	function event_list($tabmenu){	// 이벤트 리스트
		
		//매월 1일 이벤트 리스트에 들어올때 출석도장찍기 이벤트 날짜 업데이트
		if(date('d') == "01"){
			$last_day = $this->getTotalDays(date('Y'), date('m'));		//말일 구하기
			
			$attend_event = $this->my_m->row_array('reg_event_list', array('m_idx' => '1001'));

			if($attend_event['m_start_day'] == date('Y-m', strtotime('-1 month'))."-01"){
				$attend_update_rtn = $this->my_m->update('reg_event_list', array('m_idx' => '1001'), array('m_start_day' => date('Y-m')."-01", 'm_last_day' => date('Y-m')."-".$last_day));
			}
		}
				
		//검색조건
		$search['m_use_yn'] = "Y";
		$search['ex_m_gubn'] = "m_gubn in('P', 'A')";

		if($tabmenu == "1"){
			//진행중인 이벤트
			$search['ex_m_last_day'] = "m_last_day >= '".date('Y-m-d')."' ";
			$data['null_text'] = "현재 진행중인 이벤트가 없습니다.";
		}else if($tabmenu == "2"){
			//종료된 이벤트
			$search['ex_m_last_day'] = "m_last_day <= '".date('Y-m-d')."' ";
			$data['null_text'] = "현재 종료된 이벤트가 없습니다.";
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =5; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->service_m->event_list($start, $rp, @$search, 'reg_event_list');

		$data['mlist'] = $result[0];
		$data['getTotalData']=$total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));
		
		//view 설정
		$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy', $navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/event_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //이벤트 탭메뉴

		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/event_v', $data);
		$this->load->view('bottom_v');
	}

	//이벤트 뷰페이지 가기전 예외url 검사
	function event_view_exce(){
		
		$m_idx = rawurldecode($this->input->post('m_idx', true));

		$arrData = $this->my_m->row_array('reg_event_list', array('m_idx' => $m_idx));

		if(!@empty($arrData['m_move_url'])){
			//예외처리 url이 있는경우
			echo $arrData['m_move_url'];
		}else{
			//예외처리 url이 없는경우
			echo "/service_center/event/event_view/m_idx/".$m_idx;
		}

	}

	function event_view(){	// 이벤트 뷰페이지
		
		$m_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_idx')));
		
		if(empty($m_idx) || $m_idx == ""){
			alert_goto("잘못된 접근입니다.", "/service_center/event/ing_event");
		}
	
		$data = $this->my_m->row_array('reg_event_list', array('m_idx' => $m_idx));

		if(IS_MOBILE == true){
			//모바일 버전일 경우

			$this->load->library('m_top_menu_lib');

			//view 설정
			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"이벤트"); //탑메뉴 로딩
			
			$bot_data['add_script'] = "
			<script type='text/javascript'>
				
				$(document).ready(function(){
					$('#event_content img').css('width', '100%');
				});

			</script>
			";
			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_view_v', @$data);
			$this->load->view('m/m_bottom_v', $bot_data);

		}else{
			
			//PC버전일경우

			if($data['m_gubn'] == "P"){
				$data['event_cate'] = "<img src='".IMG_DIR."/service_center/event_cate_online.gif'>";
			}else if($data['m_gubn'] == "M"){
				$data['event_cate'] = "<img src='".IMG_DIR."/service_center/event_cate_mobile.gif'>";
			}else{
				$data['event_cate'] = "<img src='".IMG_DIR."/service_center/event_cate_online.gif'><img src='".IMG_DIR."/service_center/event_cate_mobile.gif'>";
			}

			//view 설정
			$navs = array('홈','고객센터','나의문의내역'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/event_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

			$this->load->view('top_v',$top_data);				
			$this->load->view('service_center/event_read_v',$data);
			$this->load->view('bottom_v');

		}
		
		
	}

	function event_won_list($tabmenu){	// 당첨자발표 리스트


		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->service_m->event_list($start, $rp, @$search, 'reg_event_member');

		$data['mlist'] = $result[0];
		$data['getTotalData']=$total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		//당첨자발표
		$data['null_text'] = "현재 발표된 당첨자가 없습니다.";


		$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/event_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu);

		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/event_won_v',$data);
		$this->load->view('bottom_v');
	}

	function event_mb_view(){	// 당첨자발표 뷰페이지
	
		$m_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_idx')));
		
		if(empty($m_idx) || $m_idx == ""){
			alert_goto("잘못된 접근입니다.", "/service_center/event/ing_event");
		}

		$data = $this->my_m->row_array('reg_event_member', array('m_idx' => $m_idx));

		$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/event_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$this->load->view('top_v',$top_data);				
		$this->load->view('service_center/event_mb_read_v',$data);
		$this->load->view('bottom_v');

	}

	function call_tabmenu($num){
		// 이벤트 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}
		ob_start();
		
		$this->load->view('service_center/event_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function ing_event()
	{	
		if(IS_MOBILE == true){
			//모바일버전의 경우
			//모바일 로그인체크
			user_check(null,0);

			$this->load->library('m_top_menu_lib');

			//검색조건
			$search_data['m_use_yn'] = "Y";
			$search_data['ex_m_gubn'] = "m_gubn in('M', 'A') ";
			
			//종료일이 지나면 안보이는 조건
			//$search_data['ex_m_last_day'] = "m_last_day >= '".date('Y-m-d')."' ";
			
			//이벤트 리스트 가져오기
			$m_result = $this->my_m->result_array('reg_event_list', $search_data, 'm_idx', 'desc');

			$data['mlist'] = $m_result;

			//view 설정

			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"이벤트"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_v', @$data);
			$this->load->view('m/m_bottom_v');

		}else{
			//PC버전의 경우
			$this->event_list(1); //진행중인 이벤트
		}		
	}

	function event_won()
	{
		$this->event_won_list(3); //당첨자발표
	}

	function end_event()
	{
		$this->event_list(2); //종료된 이벤트
	}


	//해당월의 일수구하는함수
    function getTotalDays($year, $month){

        $day=1;
        while(checkdate($month, $day, $year))
        {
            $day++;
        }
            $day=$day-1;
            return $day;
    }





	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성회원 전용 이벤트 관련 (PC, MOBILE 통합)
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	//여성회원 전용 이벤트 페이지
	function woman_event(){
		
		alert("본 이벤트는 종료되었습니다. 곧 새로운 이벤트로 찾아뵙겠습니다.","/");

		user_check(null, 5);
		
		//남성회원의 경우 메인페이지로 이동
		$this->call_man_rtn_url($this->session->userdata['m_sex']);

		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ exit; }
		
		//오늘의 미션횟수 데이터 가져오기
		$event_cnt = $this->service_m->woman_mission_data($user_id);
		
		if(!empty($event_cnt)){
			//오늘의 미션데이터가 있을경우
			if($event_cnt['REQ_CNT'] >= "10"){ $data["REQ_CNT"] = "10"; }else{ $data["REQ_CNT"] = $event_cnt['REQ_CNT']; }		//채팅신청 카운트
			//if($event_cnt['CHAT_CNT'] >= "3"){ $data["CHAT_CNT"] = "3"; }else{ $data["CHAT_CNT"] = $event_cnt['CHAT_CNT']; }	//채팅하기 카운트
			if($event_cnt['GIFT_CNT'] >= "1"){ $data["GIFT_CNT"] = "1"; }else{ $data["GIFT_CNT"] = $event_cnt['GIFT_CNT']; }	//선물 수령여부 카운트
					
			if($data['REQ_CNT'] == "10"){
				//오늘 미션을 모두 클리어했을경우 상품받기 버튼 on
				$data['GIFT_BTN'] = "on";
			}else{
				//오늘 미션을 모두 클리어하지 못했을경우 상품받기 버튼 off
				$data['GIFT_BTN'] = "off";
			}
		}else{
			//오늘의 미션데이터가 없을경우(초기화)
			$data['REQ_CNT']	= "0";
			$data['CHAT_CNT']	= "0";
			$data['GIFT_CNT']	= "0";
			$data['GIFT_BTN']	= "off";
		}

		$data['req_class']		= $this->call_woman_event_class($data["REQ_CNT"]);			//채팅신청 css 클래스 정의
		//$data['chat_class']		= $this->call_woman_event_class($data["CHAT_CNT"]);			//채팅하기 css 클래스 정의
		
		//현재 세션의 아이디의 회원이 총 몇번의 이벤트 상품을 받았는 체크 하기 위한 카운트
		$cnt = $this->call_event_gift_cnt($user_id);
		
		//현재 세션의 아이디가 오늘 상품을 받았는지 체크하기
		$data['today_gift'] = $this->call_recv_gift_event($user_id);

		//최근 선물 받은 회원 리스트
		$data['member_gift_list'] = $this->service_m->woman_event_gift_list('WOMAN_EVENT_01');
		
		if(IS_MOBILE == true){
			//모바일버전의 경우
			
			//view 설정
			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"이벤트"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_woman_gift_v', $data);
			$this->load->view('m/m_bottom0_v');
		}else{
			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/event_js");

			$data['right_menu'] = $this->right_menu_lib->view('#'); //우측메뉴 로딩
			
			$this->load->view('top_v', $top_data);
			$this->load->view('service_center/event_woman_gift_v', $data);
			$this->load->view('bottom_v');
		}
	
	}

	//여성회원 전용 이벤트 선물받기 전 휴대전화 번호 체크 레이어 팝업 ajax
	function woman_event_gift_layer(){
		
		//정회원만 이용가능 
		user_check(null, 9, 'exit');

		//남성회원의 경우 메인페이지로 이동
		$this->call_man_rtn_url($this->session->userdata['m_sex']);

		//회원 세션 아이디 체크
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit;}

		$data['mdata'] = $this->member_lib->get_member($user_id);

		if(IS_MOBILE == true){
			//MOBILE 버전의 경우
			$data['info_url'] = "/profile/my_info";				//모바일버전 내정보수정 버튼 클릭 url
		}else{
			//PC버전의 경우
			$data['info_url'] = "/profile/main/user";			//PC버전 내정보수정 버튼 클릭 url
		}

		$top_data['add_title'] = "선물받기 확인";
		$top_data['add_text'] = "";
		$top_data['add_css'] = array("layer_popup/woman_event_css");

		
		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/woman_gift_take_it_v', @$data);

		$this->load->view('layer_popup/popup_bottom_v');
	}


	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성회원 전용 이벤트 관련 처리 함수
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	//여성회원 전용 이벤트용 이벤트 코드 저장 및 휴대전화 번호 저장 및 체크 처리 함수 ajax
	function call_woman_event_gift_chk(){
		
		//정회원만 이용가능 
		user_check(null, 9, 'exit');

		//남성회원의 경우 메인페이지로 이동
		$this->call_man_rtn_url($this->session->userdata['m_sex']);
		
		//회원 세션 아이디 체크
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit;}
		
		//여성회원 전용 이벤트 코드
		$event_code = "WOMAN_EVENT_01";

		$m_data = $this->member_lib->get_member($user_id);							//회원 데이터 불러오기
		$m_hptele = $m_data['m_hp1']."-".$m_data['m_hp2']."-".$m_data['m_hp3'];		//회원 전화번호 합치기

		//해당 이벤트 코드의 내아이디가 아닌 다른 누군가 휴대전화번호를 사용하고 있는지 체크
		$search = array(
			"V_EVENT_CODE"		=> $event_code,
			"V_SEND_ID"			=> "joyhunting",
			"ex_data_1"			=> "V_RECV_ID <> '".$m_data['m_userid']."' ",
			"V_EVENT_HP"		=> $m_hptele
		);
		
		$chk_cnt = $this->my_m->cnt('GIFT_SEND', $search);

		if($chk_cnt == "0"){
			//선물받기 처리 함수 호출
			$rtn = $this->woman_event_gift_send($event_code, $m_data['m_userid'], $m_hptele);
			echo $rtn; exit;
		}else{
			//다른 누군가 내 전화번호를 사용할 경우 에러처리
			echo "9999"; exit;
		}
		
	}


	//여성회원 전용 이벤트 선물받기 처리 함수
	function woman_event_gift_send($event_code, $user_id, $hptele){

		if(empty($user_id) or empty($hptele)){ echo "1000"; exit; }				//잘못된 접근

		//해당 회원이 오늘날짜에 미션을 모두 완수 하였눈지 또한 선물을 이미 받았는지 체크
		$result = $this->service_m->woman_mission_data($user_id);

		if(empty($result)){
			echo "1002"; exit;		//미션수행결과가 없음
		}else{

			if($result['GIFT_CNT'] >= "1"){ echo "1001"; exit; }		//이미 선물을 지급받은경우
			
			//해당미션을 모두 성공하고 선물을 아직 받지 않은경우
			if($result['REQ_CNT'] >= "10"){
				
				$cnt = $this->call_event_gift_cnt($user_id);

				if($cnt >= "5"){
					//총 다섯번의 선물지급 완료
					echo "1005"; exit;
				}else{

					//상품리스트 배열로 가져오기
					$search = array(
						"V_USE_YN"		=> "Y",
						"ex_data_1"		=> "V_IDX IN('93', '96', '97', '99', '102', '108', '109', '111', '112')"
					);

					$gift_list = $this->my_m->result_array('GIFT_LIST', $search, 'V_IDX', 'DESC', NULL);

					//랜덤 선물 지급
					$rand_num = mt_rand(0, count($gift_list));
					
					$arrData1 = array(
						"V_MODE"			=> "gift",
						"V_SEND_ID"			=> $user_id,
						"V_RECV_ID"			=> "joyhunting",
						"V_WRITE_DATE"		=> NOW,
						"V_ETC"				=> $gift_list[$rand_num]['V_IDX']
					);

					$rtn1 = $this->my_m->insert('WOMAN_EVENT', $arrData1);
					
					if($rtn1 == "1"){
						//선물보내기(여성회원 전용 이벤트에서 수령하는 선물은 바로 발송준비중으로 처리)
						$arrData2 = array(
							"V_SEND_ID"		=> "joyhunting",
							"V_RECV_ID"		=> $user_id,
							"V_GIFT_NUM"	=> $gift_list[$rand_num]['V_IDX'],
							"V_GIFT_CODE"	=> $gift_list[$rand_num]['V_PRODUCT_CODE'],
							"V_RECV_YN"		=> "Y",
							"V_SEND_YN"		=> "I",
							"V_SEND_DATE"	=> NOW,
							"V_RECV_DATE"	=> NOW,
							"V_DELI_DATE"	=> NULL,
							"V_DEL_GUBN"	=> NULL,
							"V_EVENT_CODE"	=> $event_code,
							"V_EVENT_HP"	=> $hptele
						);

						$rtn2 = $this->my_m->insert('GIFT_SEND', $arrData2);
					}else{
						$rtn2 = "0";
					}					

					echo $rtn2; exit;	//선물지급 완료
				}				

			}else{
				//해당미션을 아직 다 못한경우
				echo "1002"; exit;
			}

		}

	}

	//여성회원 전용 이벤트(남성회원이 이벤트 페이지 접근하거나, url로 들어올경우 main 페이지로 강제이동 함수)
	function call_man_rtn_url($m_sex){
		
		if($m_sex == "M"){
			goto("/");
		}else{
			return;
		}
	}

	//여성회원 전용 이벤트 미션상황 배경, 텍스트 클라스 주기 함수
	function call_woman_event_class($val){
		
		if($val >= "10"){
			$bg_class = "bg_a2b0db";
			$ft_class = "woman_mis_success";
			$mission_result = "<b>미션완료</b>";				
		}else{
			$bg_class = "bg_fff";
			$ft_class = "woman_mis_false";
			$mission_result = "<b>미션 ".$val."</b><b>/10</b>";				
		}

		return array($bg_class, $ft_class, $mission_result);

	}

	//이벤트 기간동안 몇번의 상품을 받았는지 확인
	function call_event_gift_cnt($user_id){
		$cnt = $this->my_m->cnt('WOMAN_EVENT', array('V_MODE' => 'gift', 'V_SEND_ID' => $user_id));
		return $cnt;
	}

	//여성회원이 오늘 날짜의 이벤트 상품을 수령했는지 여부 확인 
	function call_recv_gift_event($user_id){

		$search = array(
			"V_MODE"		=> "gift",
			"V_SEND_ID"		=> $user_id,
			"ex_data_1"		=> "V_WRITE_DATE >= '".date('Y-m-d')." 00:00:00' AND V_WRITE_DATE <= '".date('Y-m-d')." 24:00:00' "
		);

		$gift_chk = $this->my_m->row_array('WOMAN_EVENT', $search, 'V_IDX', 'DESC', '1');

		if(!empty($gift_chk)){
			//오늘 이벤트 선물을 받은경우
			return "1";
		}else{
			//오늘 이벤트 선물을 받지 못한경우
			return "0";
		}

	}


	//여성회원 포인트 증정 이벤트(리워드 이벤트)
	function w_e_point(){

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ alert_goto('로그인후 이용가능합니다.', '/'); }
		
		//오픈할때 풀것
		if($this->session->userdata['m_sex'] == "M"){ goto('/'); }	//남성회원 접근제한

		$woman_data = call_woman_event_02_point_chk($user_id);		//popup_helper array(cnt, point)

		$w_cnt				= $woman_data[0];		//오늘 포인트를 지급받았는지 체크
		$data['w_point']	= $woman_data[1];		//오늘 획특포인트
		$data['user_id']	= $user_id;				//회원 아이디

		if($w_cnt > 0){
			//이미 지급받은경우
			$data['img_gubn'] = "on";
			$data['w_function'] = "already_provide";
		}else{
			//아직 미지급상태
			$data['img_gubn'] = "of";
			$data['w_function'] = "non_payment";
		}

		if(IS_MOBILE == true){

			//view 설정
			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"이벤트"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_w_e_point_v', @$data);
			$this->load->view('m/m_bottom0_v');

		}else{

			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/event_js");

			$data['right_menu'] = $this->right_menu_lib->view('#'); //우측메뉴 로딩
			
			$this->load->view('top_v', $top_data);
			$this->load->view('service_center/w_e_point_v', @$data);
			$this->load->view('bottom_v');

		}
	
	}

	//여성회원 포인트 증정 이벤트 함수(리워드이벤트)
	function woman_event_reward_point_ajax(){
		
		$gubn		= rawurldecode($this->input->post('gubn', true));		//구분값
		$user_id	= rawurldecode($this->input->post('user_id', true));	//아이디
		$point		= rawurldecode($this->input->post('point', true));		//포인트

		if($gubn == "on" or empty($user_id) or empty($point)){ echo "1000"; exit; }

		$woman_data = call_woman_event_02_point_chk($user_id);		//popup_helper array(cnt, point)

		if($point <> $woman_data[1]){
			//획득포인트와 다를경우
			echo "1000";
			exit;
		}

		$rtn = call_woman_event_02_point_provide("0", $point, $user_id);		//popup_helper

		echo $rtn;

	}
	

	
	
	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	/* 봄이벤트 관련																																																*/
	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

	function trip(){
		
		$search['event_page'] = 'trip';

		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$data['rp'] = $rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'event_trip_log', 'idx', 'user_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData']= $total= $result[1];

		if(IS_MOBILE == true){
			//모바일버전의 경우
			
			//view 설정
			$top_data['add_css'] = array("/m/m_event_css", "/m/m_trip_css");
			$top_data['add_js'] = array("service_center/trip_js", "jQueryRotate.2.3", "jQueryRotateCompressed.2.3");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"봄바람 이벤트"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_trip_v', @$data);
			$this->load->view('m/m_bottom0_v');

		}else{
			
			//PC버전의 경우

			$this->load->helper('level_helper');

			$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css", "service_center/trip_css");
			$top_data['add_js'] = array("service_center/trip_js", "jQueryRotate.2.3", "jQueryRotateCompressed.2.3");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			
			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/event_trip_v',@$data);
			$this->load->view('bottom_v');

		}

	}

	//포인트 지급처리 및 참여 데이터 insert
	function trip_result_ajax(){
		
		user_check(null, 9, 'ajax');

		$mode = $this->input->post('mode', true);

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$cnt = $this->my_m->cnt('event_trip_log', array('user_id' => $user_id, 'point' => '100', 'event_page' => 'trip'));

		$point = null;
		$rtn = "1";
		if($cnt == 0){
			$point = "100";
			$rtn = $this->my_m->insert('event_trip_log', array('user_id' => $user_id, 'gubn' => $mode, 'point' => $point, 'write_date' => NOW, 'event_page' => 'trip'));
		}
		
		if($rtn == 1 and $point == "100"){
			//포인트지급처리
			$this->load->helper('point_helper');
			member_point_insert($user_id, '0000', '100포인트지급', $point, null, '0000', NOW, '봄이벤트 포인트 지급');
			$rtn = "2";
		}

		echo $rtn;

	}

	//봄사랑 이벤트 모바일 더보기 
	function trip_list_more(){
		
		$search['event_page'] = 'trip';

		//페이징 변수
		$page = $this->input->post('page', true);

		$rp = $this->input->post('rp', true); //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'event_trip_log', 'idx', 'user_id', 'desc', '*');
		$mlist = $m_result[0];

		if(empty($mlist)){
			echo "0";		//데이터가 더이상 없을경우
		}else{

			$add_html = "";
			$i = ($page-1)*$rp;

			foreach($mlist as $data){

				if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
				if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }

				$add_html .= "
					
					<tr>
						<td class='width_17per now_member pointer' onclick='javascript:redirect_chat(".$i.");'>".$this->member_lib->member_thumb($data['m_userid'], 200, 200)."</td>
						<td class='m_intro_text_td padding_top_3per padding_bottom_3per'>
							
							<div class='float_left width_70per'>
								<b class='color_333 margin_left_3per level_m_online_img ".$m_color." pointer' onclick='javascript:redirect_chat(".$i.");');'>
									".$data['m_nick']."
								</b>
								<b class='color_888 pointer' onclick='javascript:redirect_chat(".$i.");');'>(".$data['m_age'].") ".$data['m_conregion']." ".$data['m_conregion2']."</b>
								<p class='margin_top_3 margin_left_3per'>
									".trip_event_code($data['gubn'])."
								</p>
							</div>
							<div class='float_left width_30per text-right'>
								<input type='button' value='비밀채팅신청' id='aaa".$i."' m_userid='".$data['m_userid']."' class='secret_btn block' onclick='javascript:redirect_chat(".$i.");');'>
							</div>
							<div class='clear'></div>
						</td>
					</tr>

				";

				$i++;

			}

			echo $add_html;

		}


	}



	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	/* 안드로이드 어플 병점 이벤트 관련																																												*/
	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	
	//이벤트 메인페이지
	function app_grade(){
		
		$data['gubn'] = $gubn = $this->security->xss_clean(@url_explode($this->seg_exp, 'gubn'));
		
		$user_id = @$this->session->userdata['m_userid'];
		
		if($gubn <> "up"){
			if(empty($user_id)){
				$data['event_data'] = "";
			}else{
				$data['event_data'] = $this->my_m->row_array('app_grade_event', array('user_id' => $user_id), 'write_date', 'desc', '1');
			}			
		}

		if($gubn == "up"){
			$data['up_data'] = $this->my_m->row_array('app_grade_event', array('user_id' => $user_id), 'write_date', 'desc', '1');
		}

		$bot_data['add_script'] = "
		<script type='text/javascript'>
		$(document).ready(function(){
			alert('종료된 이벤트입니다.');
			history.back(-1);
		});
		</script>
		";

		if(IS_MOBILE == true){

			//view 설정
			$top_data['add_css'] = array("m/m_event_app_grade_css");
			$top_data['add_js'] = array("service_center/event_app_grade_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"앱설치 이벤트"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_app_grade_v', @$data);
			$this->load->view('m/m_bottom0_v', @$bot_data);

		}else{
			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/event_app_grade_css");
			$top_data['add_js'] = array("service_center/event_app_grade_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

			$this->load->view('top_v', $top_data);
			$this->load->view('service_center/event_app_grade_v', @$data);
			$this->load->view('bottom_v', @$bot_data);
		}
	}

	//사진 업로드 및 이벤트 등록 처리
	function app_grade_upload_pic(){

		//로그인 여부 체크
		user_check(null,0);

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ exit; }

		//업로드 데이터 받아오기
		$user_name = $this->input->post('user_name', true);		//구글이름
		$user_hp_1 = $this->input->post('user_hp_1', true);		//휴대폰번호1
		$user_hp_2 = $this->input->post('user_hp_2', true);		//휴대폰번호2
		$user_hp_3 = $this->input->post('user_hp_3', true);		//휴대폰번호3

		$upload_gubn = $this->input->post('upload_gubn', true);	//신규등록 or 업데이트

		//업로드 경로 만들기
		$dir = "/resource/user_event/app_grade/".$user_id;
		if(!is_dir($dir) ){ mkdir($dir); }
		
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
		$config['max_size']	= '5120';
		$config['max_width']  = '4096';
		$config['max_height']  = '4096';	
		
		$this->load->library('upload', $config);
		
		$rtn = "";
		if(!$this->upload->do_upload('user_upload_pic')){
			$rtn = strip_tags($this->upload->display_errors());
		}else{
			//리턴값 file_name, file_pth, full_path
			$data = $this->upload->data();
			
			$arrData = array(
				"user_id"		=> $user_id,
				"user_name"		=> $user_name,
				"hp_1"			=> $user_hp_1,
				"hp_2"			=> $user_hp_2,
				"hp_3"			=> $user_hp_3,
				"file_path"		=> $data['full_path'],
				"write_date"	=> NOW
			);
			
			$result = "";
			if($upload_gubn == "up"){
				$result = $this->my_m->update('app_grade_event', array('user_id' => $user_id), $arrData);
			}else{

				$cnt = $this->my_m->cnt('app_grade_event', @$search);
				if($cnt < 150){
					$result = $this->my_m->insert('app_grade_event', $arrData);
				}else{
					$result = $cnt;
				}
				
			}

			$rtn = $result;

		}

		echo $rtn;
	}

	//등록한 사진 보기 레이어팝업
	function reg_user_pic_layer(){

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }
		
		$data = $this->my_m->row_array('app_grade_event', array('user_id' => $user_id), 'write_date', 'desc', '1');

		$top_data['add_title'] = "업로드 사진 확인";
		$top_data['add_text'] = "";
		$top_data['add_css'] = array();
		$top_data['add_js'] = array();
		
		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/app_grade_upload_pic_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}
	

	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	/* 여름휴가 이벤트 관련																																														*/
	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	

	function vacance(){

		$search['event_page'] = 'vacance';

		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$data['rp'] = $rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'event_trip_log', 'idx', 'user_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData']= $total= $result[1];

		if(IS_MOBILE == true){
			//모바일버전의 경우
			
			//view 설정
			$top_data['add_css'] = array("/m/m_event_css", "/m/m_trip_css");
			$top_data['add_js'] = array("service_center/trip_js", "jQueryRotate.2.3", "jQueryRotateCompressed.2.3");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"COOL한 휴가"); //탑메뉴 로딩

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_vacance_v', @$data);
			$this->load->view('m/m_bottom0_v');

		}else{
			
			//PC버전의 경우

			$this->load->helper('level_helper');

			$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css", "service_center/trip_css");
			$top_data['add_js'] = array("service_center/trip_js", "jQueryRotate.2.3", "jQueryRotateCompressed.2.3");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			
			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/event_vacance_v',@$data);
			$this->load->view('bottom_v');

		}

	}

	function vacance_result(){
		
		user_check(null, 9, 'ajax');

		header("Content-Type:application/json");	

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$rand_num = mt_rand(1, 5);

		//이미 참여내역이 있는지 체크 (첫참여 포인트 지급 100포인트)
		$cnt = $this->my_m->cnt('event_trip_log', array('user_id' => $user_id, 'point' => '100', 'event_page' => 'vacance'));

		$point = null;
		$rtn = "1";
		if($cnt == 0){
			$point = "100";
			$rtn = $this->my_m->insert('event_trip_log', array('user_id' => $user_id, 'gubn' => $rand_num, 'point' => $point, 'write_date' => NOW, 'event_page' => 'vacance'));
		}
		
		if($rtn == 1 and $point == "100"){
			//포인트지급처리
			$this->load->helper('point_helper');
			member_point_insert($user_id, '0000', '100포인트지급', $point, null, '0000', NOW, '여름여행이벤트 포인트 지급');
			$rtn = "2";
		}

		echo json_encode(array($rtn, $rand_num));
	}

	//여름여행 이벤트 모바일 더보기 
	function vacance_list_more(){
		
		$search['event_page'] = 'vacance';

		//페이징 변수
		$page = $this->input->post('page', true);

		$rp = $this->input->post('rp', true); //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'event_trip_log', 'idx', 'user_id', 'desc', '*');
		$mlist = $m_result[0];

		if(empty($mlist)){
			echo "0";		//데이터가 더이상 없을경우
		}else{

			$add_html = "";
			$i = ($page-1)*$rp;

			foreach($mlist as $data){

				if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
				if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }

				$add_html .= "
					
					<tr>
						<td class='width_17per now_member pointer' onclick='javascript:redirect_chat(".$i.");'>".$this->member_lib->member_thumb($data['m_userid'], 200, 200)."</td>
						<td class='m_intro_text_td padding_top_3per padding_bottom_3per'>
							
							<div class='float_left width_70per'>
								<b class='color_333 margin_left_3per level_m_online_img ".$m_color." pointer' onclick='javascript:redirect_chat(".$i.");');'>
									".$data['m_nick']."
								</b>
								<b class='color_888 pointer' onclick='javascript:redirect_chat(".$i.");');'>(".$data['m_age'].") ".$data['m_conregion']." ".$data['m_conregion2']."</b>
								<p class='margin_top_3 margin_left_3per'>
									".trip_event_code($data['gubn'])."
								</p>
							</div>
							<div class='float_left width_30per text-right'>
								<input type='button' value='비밀채팅신청' id='aaa".$i."' m_userid='".$data['m_userid']."' class='secret_btn block' onclick='javascript:redirect_chat(".$i.");');'>
							</div>
							<div class='clear'></div>
						</td>
					</tr>

				";

				$i++;

			}

			echo $add_html;

		}


	}


	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
	/* 여름휴가 이벤트 관련																																														*/
	/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

}

/* End of file main.php */
/* Location: ./application/controllers/*/

