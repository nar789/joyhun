<?php

class Event_talk extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
		$this->load->helper('point_helper');
		$this->load->helper('level_helper');
		$this->load->helper('code_change_helper');
	}

	function index(){
		$this->talk_list();
	}

	function talk_list(){	// 이벤트 뷰페이지		

		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트
			
			$data['m_userid'] = $this->session->userdata['m_userid'];
			$msg_search['m_sex'] = reverse_sex($this->session->userdata['m_sex']);
		}else{
			$data['m_userid'] = "";
			$msg_search['m_sex'] = "F";
		}

		$msg_search['ex_data_1'] = "m_filename is not null and m_filename <> ''";		//사진 있는 회원들만

		//최근 접속 회원 5명 가져오기
		$data['msg_member'] = $msg_member = $this->my_m->result_array('TotalMembers', @$msg_search, 'last_login_day', 'desc', '5');
		
		$user_id_array = "";
		foreach($msg_member as $user_val){
			if(empty($user_id_array)){ $user_id_array .= $user_val['m_userid']; }else{ $user_id_array .= "|".$user_val['m_userid']; }
		}
		
		$data['user_array'] = $user_id_array;


		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$data['rp'] = $rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//이벤트 토크 리스트 가져오기
		$result = $this->my_m->get_list($start, $rp, array('t_gubn' => '4'), 'T_JoyTalk', 't_idx', 't_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData']= $total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		if(IS_MOBILE == true){
			//모바일버전의 경우

			$this->load->library('m_top_menu_lib');
			
			//view 설정

			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("service_center/event_talk_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"인연만들기"); //탑메뉴 로딩
			
			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_talk_v', $data);
			$this->load->view('m/m_bottom_v');

		}else{
			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/event_talk_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			
			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/event_talk_v',$data);
			$this->load->view('bottom_v');

		}

		
	}

	//토크등록
	function reg_talk(){

		//로그인 여부 체크
		user_check(null,9,'exit');

		$user_array = rawurldecode($this->input->post('user_array', true));
		$msg_user_id = explode("|", $user_array);
	
		//오늘 토크 올렸는지 체크
		$talk_cnt = $this->my_m->cnt('T_JoyTalk', array("t_id" => $this->session->userdata['m_userid'], "ex_t_write" => "t_write LIKE '%".TODAY."%'", "t_gubn" => "4"));

		// 오늘 올렸으면 오류 리턴
		if($talk_cnt > 0){
			echo "666"; exit;
		}

		$data['t_context'] = $t_context = rawurldecode($this->input->post('t_context', true));
		$arr_data = array(	
			"t_id"				=> $this->session->userdata['m_userid'],
			"t_sex"				=> $this->session->userdata['m_sex'],
			"t_nick"			=> $this->session->userdata['m_nick'],
			"t_context"			=> strip_tags($data['t_context']),
			"t_write"			=> NOW,
			"t_gubn"			=> "4"
		);

		$rtn = $this->my_m->insert('T_JoyTalk', $arr_data);

		//메세지 보내기		
		for($i=0; $i<count($msg_user_id); $i++){
			$this->winter_msg_send($this->session->userdata['m_userid'], $msg_user_id[$i], strip_tags($t_context));
		}		

		echo $rtn;
	}
	
	//댓글보기
	function comment_view(){

		$t_idx = rawurldecode($this->input->post('t_idx', true));		//부모토크 idx
		
		$search = array('t_idx'=> $t_idx);

		$m_result = $this->my_m->get_list(0, 100, @$search, 'T_JoyTalk_Reply', 'r_write', 'r_id ', 'asc');

		$data['mlist'] = $m_result[0];
		$data['getTotalRows'] = $m_result[1];
		
		$add_style = "style='display:none;'";

		$add_table = "";

		if($data['getTotalRows'] > 0){

			foreach($data['mlist'] as $data){
				
				//본인만 삭제버튼 보이기 
				if($data['r_id'] == $this->session->userdata['m_userid']){
					$add_style = "";		
				};
				
				//댓글 부분html
				$add_table = $add_table."
					<div class='margin_top_8 margin_left_18 block'>
						<div class='block ver_top width_36 pointer' onclick='view_profile(\"".$data['r_id']."\");'>".$this->member_lib->member_thumb($data['r_id'],34,31)."</div>
						<div class='block ver_top width_537'>
							<p class='color_333 block margin_left_7 margin_right_22 ver_top'>".$data['m_nick']."</p><span class='color_999 ver_bottom'>".$data['r_write']."</span>
							<input type='button' class='rep_del_btn' onclick='javascript:del_reply(".$data['r_idx'].", ".$t_idx.");' ".$add_style.">
							<p class='margin_left_7 margin_top_5 line-height_16 color_666 padding_bottom_7 width_515'>".$data['r_context']."</p>
						</div>
					</div>
					<div class='margin_left_18 comment_rep_dott'></div>
				";
			};
		};
		
		//글등록 부분html
		$last_table = "
			<div class='height_53'>
				<div class='margin_top_10 margin_left_18 talk_com_thumb'>
					".$this->member_lib->member_thumb($this->session->userdata['m_userid'],34,31)."
					<input type='text' class='comment_rep_input ver_top' id='r_context".$t_idx."'><input type='button' class='comment_rep_submit ver_top' value='등록' onclick='javascript:reg_reply(".$t_idx.");'/>
				</div>
			</div>
		";
		
		//댓글부분 + 글등록부분 return
		echo "<div class='rep_list_box'>".$add_table.$last_table."</div>";

	}

	//댓글등록
	function reg_reply(){

		//로그인 여부 체크
		user_check();
		
		$t_idx = rawurldecode($this->input->post('t_idx', true));
		$r_context = rawurldecode($this->input->post('r_context', true));
		
		$arr_data = array(

			"r_id"				=> $this->session->userdata['m_userid'],
			"r_sex"				=> $this->session->userdata['m_sex'],
			"r_nick"			=> $this->session->userdata['m_nick'],
			"r_context"			=> strip_tags($r_context),
			"r_write"			=> NOW,
			"t_idx"				=> $t_idx

		);

		$query = $this->my_m->insert('T_JoyTalk_Reply', $arr_data);		//댓글 저장
		
		$cnt = $this->my_m->cnt('T_JoyTalk_Reply', array('t_idx' => $t_idx));				//댓글 갯수

		$rtn = $this->my_m->update('T_JoyTalk', array('t_idx'=>$t_idx) , array('t_repl' => $cnt)); //댓글갯수 업데이트

		echo $cnt;

	}

	//댓글삭제
	function del_reply(){

		//로그인 여부 체크
		user_check();

		$r_idx = rawurldecode($this->input->post('r_idx', true));
		$t_idx = rawurldecode($this->input->post('t_idx', true));

		$query = $this->my_m->del('T_JoyTalk_Reply', array('r_idx' => $r_idx, 'r_id' => $this->session->userdata['m_userid'], 't_idx' => $t_idx) );		//댓글 삭제

		$cnt = $this->my_m->cnt('T_JoyTalk_Reply', array('t_idx' => $t_idx));				//댓글 갯수

		$rtn = $this->my_m->update('T_JoyTalk', array('t_idx'=>$t_idx) , array('t_repl' => $cnt)); //댓글갯수 업데이트
		
		echo $cnt;

	}
	

	//메세지 보내기 봄이벤트
	function winter_msg_send($send_id, $recv_id, $contents){

		if(empty($send_id) or empty($recv_id) or empty($contents)){ return; }

		$arrData = array(
			"V_SEND_ID"			=> $send_id,
			"V_RECV_ID"			=> $recv_id,
			"V_CONTENTS"		=> $contents,
			"V_WRITE_DATE"		=> NOW,
			"V_EVENT_GUBN"		=> '봄꽃이벤트'
		);

		$rtn = $this->my_m->insert('MESSAGE_LIST', $arrData);

		return $rtn;
	}


	//모바일 토크 더보기 버튼 클릭시 이벤트
	function talk_list_more(){
		
		//페이징 변수
		$page = $this->input->post('page', true);

		$rp = $this->input->post('rp', true); //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list($start, $rp, array('t_gubn' => '4'), 'T_JoyTalk', 't_idx', 't_id', 'desc');
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
									".$data['t_context']."
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


}

/* End of file main.php */
/* Location: ./application/controllers/*/

