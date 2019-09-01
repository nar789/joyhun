<?php

class Online_mb extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('level_helper');
		$this->load->helper('alrim_helper');
	}

	function index(){
		//PC버전으로 들어오면 회원검색으로 보냄
		goto("/chatting/find_chatting/find_chatting");
	}

	function index_mobile()
	{	
		//임시세션 삭제하기
		if(!empty($this->session->userdata['regi_id'])){
			reg_session_init();
		}

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

//		회원 세션아이디가 필요할경우 관리자
//		if($this->session->userdata['m_userid'] == "juicy1007" and $_SERVER['REMOTE_ADDR'] == "59.11.70.223"){
//			$this->session->set_userdata(array('m_userid' => 'bom071768'));
//		}

		//로그인 체크

		user_check(null,0);

		$data['member_data'] = $this->member_lib->get_member($this->session->userdata['m_userid']);

		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = 35; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		//본인의 성별과 반대되는 성별만 보이기(search helper)
		$search['TotalMembers_login.m_sex'] = reverse_sex($this->session->userdata['m_sex']);
		$search['ex_file1'] = "TotalMembers_login.m_nick_chk is null";		//닉네임필터

		// 남성회원은 정회원만 보이게
		if (reverse_sex($this->session->userdata['m_sex']) == 'M'){
			$search['TotalMembers.m_type'] = "V";
		}

		//$m_result = $this->my_m->get_list($start, $rp, @$search, 'TotalMembers_login', 'm_num', 'm_userid', 'desc', 'TotalMembers_login.*');

		if(!$m_result = $this->cache->get('m.TotalMembers_login.online.'.$this->session->userdata['m_sex'])){
			$m_result = $this->my_m->get_list($start, $rp, @$search, 'TotalMembers_login', 'last_login_day', 'm_userid', 'desc', 'TotalMembers_login.*');
			$this->cache->save('m.TotalMembers_login.online.'.$this->session->userdata['m_sex'], $m_result, 600);	//10분 캐시 사용
		}		

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $total = $m_result[1];

		if($total >= 5){
			//리스트 5개 보이고 카카오톡 배너 보이기 
			$data['add_html'] = '
				</table>
				
				
					<table class="width_95per margin_auto m_intro_table">
			';
		}

		//$data['add_html'] = '<tr><td colspan="2"><img src="'.IMG_DIR.'/m/m_banner_for_kakao.gif" class="width_100per margin_bottom_10" onclick="javascript:alert();"></td></tr>';
		
		

		//view 설정
		$top_data['add_css'] = array("/m/m_online_mb_css");
		$top_data['add_js'] = array("/m/m_online_mb_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩

		//회원가입후 첫 로그인일시 접속자 페이지로 이동 후 인사말 수정
		if(IS_LOGIN and $this->session->userdata('regi_ok') == "y"){

			$bot_data['add_script'] = "
				<script>
				var w_pop_width = '';

				$(document).ready(function(){

					if($(window).width() >= '450'){
						w_pop_width = '400';
					}else{
						w_pop_width = ($(window).width()/10)*9;
					}	
					$.get('/main/register_ok_popup', function(data){
						modal.open({content: data,width : w_pop_width, top:100});
					});
				});
				</script>
			";

			$this->session->set_userdata('regi_ok',''); //첫 로그인 끝
		}
		
		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/online_mb/m_online_mb_v', @$data);
		$this->load->view('m/m_bottom_v', @$bot_data);

	}
	
	//현재접속자 더보기 버튼 클릭시 이벤트
	function online_list_more(){
		
		//페이징 변수
		$page = rawurldecode($this->input->post('page', true));
		$rp = 25; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		//본인의 성별과 반대되는 성별만 보이기
		if($this->session->userdata['m_sex'] == "M"){
			$search['TotalMembers_login.m_sex'] = "F";
		}else{
			$search['TotalMembers_login.m_sex'] = "M";
			$search['TotalMembers_login.m_type'] = "V";		//남성회원은 정회웜만 보이게
		}

		$m_result = $this->my_m->get_list($start, $rp, @$search, 'TotalMembers_login', 'm_num', 'm_userid', 'desc', 'TotalMembers_login.*');

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
						<td class='width_15per now_member pointer' onclick='javascript:redirect_chat(".$i.");'>".$this->member_lib->member_thumb($data['m_userid'], 200, 200)."</td>
						<td class='m_intro_text_td'>
							<div class='float_left width_70per margin_top_3'>
								<b class='level_m_online_img color_333 margin_left_3per ".$m_color." pointer' onclick='javascript:redirect_chat(".$i.");'>".mb_level_profile($data['m_userid'])." ".$data['m_nick']."</b>
								<b class='color_888 pointer' onclick='javascript:redirect_chat(".$i.");'>(".$data['m_age'].") ".$data['m_conregion']." ".$data['m_conregion2']."</b>
								<p class='color_ccc margin_top_3 margin_left_3per' style='text-overflow: ellipsis; white-space: nowrap; overflow:hidden;'>
									".talk_style_data($data['m_character'])." / ".want_reason_data($data['m_reason'], $data['m_sex'])."
								</p>
							</div>
							<div class='float_left width_30per text-right'>
								<input type='button' value='비밀톡챗신청' id='aaa".$i."' m_userid='".$data['m_userid']."' class='secret_btn' onclick='javascript:redirect_chat(".$i.");'>
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

	//접속자 검색
	function online_search_nick(){

		$search_value = rawurldecode($this->input->post('search_value',TRUE));

		$search['ex_m_nick'] = "m_nick like '%".$search_value."%' ";
		//$search['ex_m_userid'] = "m_userid <> '".$this->session->userdata['m_userid']."' "; 

		$mlist = $this->my_m->result_array('TotalMembers_login', $search, 'last_login_day', 'desc');
		

		if(empty($mlist)){
			echo "0";		//검색조건이 없음
		}else{

			$add_html = "";
			$i = 1;

			foreach($mlist as $data){

				if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
				if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }

				$add_html .= "
				
					<tr>
						<td class='width_15per now_member'>".$this->member_lib->member_thumb($data['m_userid'], 200, 200)."</td>
						<td class='m_intro_text_td'>
							<div class='float_left width_70per margin_top_3'>
								<b class=' color_333 margin_left_3per ".$m_color."'>".$data['m_nick']."</b>
								<b class='color_888'>(".$data['m_age'].") ".$data['m_conregion']." ".$data['m_conregion2']."</b>
								<p class='color_ccc margin_top_3 margin_left_3per' style='text-overflow: ellipsis; white-space: nowrap; overflow:hidden;'>
									".want_reason_data($data['m_reason'])." / ".talk_style_data($data['m_character'], $data['m_sex'])."
								</p>
							</div>
							<div class='float_left width_30per text-right'>
								<input type='button' value='비밀톡챗신청' id='aaa".$i."' m_userid='".$data['m_userid']."' class='secret_btn' onclick='javascript:redirect_chat(".$i.");'>
							</div>
							<div class='clear'></div>
						</td>
					</tr>
				
				";
				$i++;

			}

			//$kakao_banner = "<img src='".IMG_DIR."/m/m_banner_for_kakao.gif' class='width_100per margin_bottom_10' onclick='javascript:alert();'>";

			echo "<table class='width_95per margin_auto m_intro_table'>".$add_html."</table>".@$kakao_banner;

		}

	}
	
	
	function send_chat_popup(){
		//비밀채팅 내가 신청 레이어팝업 AJAX

		$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "비밀채팅신청";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/m_send_chat_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	function recv_chat_popup(){
		//비밀채팅 신청 수락 레이어팝업 AJAX

		$top_data['add_css'] = array("layer_popup/m_popup_chat_css");
		$top_data['add_js'] = array("layer_popup/m_popup_chat_js");
		$top_data['add_title'] = "비밀채팅수락";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/m_recv_chat_request_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */