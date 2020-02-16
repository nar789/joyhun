<?php
class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		///profile/my_chat/chatting_list/auto_login/ 
		//if($_SERVER['REMOTE_ADDR'] == "14.47.71.6" or $_SERVER['REMOTE_ADDR'] == "124.61.213.129" or $_SERVER['REMOTE_ADDR'] == "180.228.10.89" or $_SERVER['REMOTE_ADDR'] == "14.56.234.60" or $_SERVER['REMOTE_ADDR'] == "14.33.56.55"  or  $_SERVER['REMOTE_ADDR'] == "14.45.186.241" or substr($_SERVER['REMOTE_ADDR'],0,11) == "118.34.164." or substr($_SERVER['REMOTE_ADDR'],0,10) == "222.99.24." or substr($_SERVER['REMOTE_ADDR'],0,10) == "14.33.132." or substr($_SERVER['REMOTE_ADDR'],0,9) == "14.33.56." or substr($_SERVER['REMOTE_ADDR'],0,12) == "211.221.215." or substr($_SERVER['REMOTE_ADDR'],0,11) == "175.195.95." or substr($_SERVER['REMOTE_ADDR'],0,8) == "59.12.2."  or substr($_SERVER['REMOTE_ADDR'],0,11) == "118.34.158." or substr($_SERVER['REMOTE_ADDR'],0,12) == "210.100.160."  or substr($_SERVER['REMOTE_ADDR'],0,11) == "14.56.234."  or substr($_SERVER['REMOTE_ADDR'],0,11) == "14.45.186.241." ){}else{exit;} //사무실만 보이기

		$this->load->model('admin/a_member_m');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->model('admin/payment_m');
		$this->load->model('admin/member_out_m');
		$this->load->model('admin/a_main_total_m');
		$this->load->model('profile_m');

		$this->load->helper('partner_helper');
		$this->load->library('sms_lib');

		admin_check();
	}

	function index()  //관리자 처음화면
	{
		if ($this->session->userdata('auth_code') <= 3){
			goto("/admin/admin_setting/special_chat_list");
		}

		// 전체회원 카운트
		$data['total_mb_cnt'] = $this->a_main_total_m->join_mb('TotalMembers');

		// 이번달 총 가입자 카운트
		$search['ex_start'] = "m_in_date >= '".substr(TODAY,0,7)."-01 00:00:00' ";
		$search['ex_end']   = "m_in_date <= '".TODAY." 23:59:59' ";
		$data['total_mb_month'] = $this->my_m->cnt('TotalMembers', $search);


		// 오늘+어제 가입자,오늘+어제 채팅신청,오늘+어제 메시지전송,오늘+어제 파트너가입 
		$today = array(

					// name
					array( "a.t_chat", "b.t_mes", "c.t_part", "d.t_mb"),
					
					// table
					array( "chat_request", "MESSAGE_LIST", "TotalMembers_login", "TotalMembers"),

					// date
					array( "request_date", "V_WRITE_DATE", "m_in_date", "m_in_date"),

					// search
					array( "", "", "m_partner != 'joyhunting'", "")
				);


		// 오늘 카운트(가입자, 채팅신청, 메세지전송, 파트너가입)
		$t_cnt = $this->a_main_total_m->day_cnt($today,"TODAY");
		$data['today_cnt'] = $t_cnt[0][0];

		// 어제 카운트(가입자, 채팅신청, 메세지전송, 파트너가입)
		$y_cnt = $this->a_main_total_m->day_cnt($today,"YESTERDAY");
		$data['yesterday_cnt'] = $y_cnt[0][0];

		// 최근한달치 채팅 신청
		$chat_month = $this->a_main_total_m->month_total('MESSAGE_LIST','V_WRITE_DATE','1');
		$data['month_mes_ary'] = $chat_month[0];

		// 최근한달치 채팅 신청
		$chat_month = $this->a_main_total_m->month_total('chat_request','request_date','1');
		$data['month_chat_ary'] = $chat_month[0];

		// 최근한달치 파트너가입
		$chat_month = $this->a_main_total_m->month_total('TotalMembers_login','m_in_date','1',array("ex_part_sex" => "m_partner != 'joyHunting'"));
		$data['month_part_ary'] = $chat_month[0];

		// 현재접속자 x명
		$data['live_mb_cnt'] = $this->a_main_total_m->distinct_total("ci_sessions","m_userid","m_userid != ''");

		// 회원문의내역
		$data['question'] = $this->my_m->result_array("Faq_reporter", '', 'f_writeday', 'desc', '7');

		// 신고내역
		$data['complaint'] = $this->my_m->result_array("Police_complaint", '', 'c_date', 'desc', '7');

		// 결제내역
		$pay_ary = $this->a_main_total_m->pay_list();
		$data['pay_main'] = $pay_ary[0];

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/admin_main_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	function member_list()  //회원 관리
	{
		if ($this->session->userdata('auth_code') <= 3){
			goto("/admin/admin_setting/special_chat_list");
		}
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));

		}	
		
		
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->a_member_m->member_list($start, $rp, @$data, 'TotalMembers'); //회원 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));


		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}


	function old_member_list(){		//휴면회원 관리
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->a_member_m->member_list($start, $rp, @$data, 'TotalMembers_old'); //회원 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/old_member_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}


	function join_mb_cnt_list(){

		// 최근 3개월치 가입통계
		$join_month = $this->a_main_total_m->month_total('TotalMembers','m_in_date','3');

		$data['month_join_ary'] = '';

		// 배열로 만들기
		for ($i=0; $i<count($join_month[0]); $i++){
			$data['month_join_ary'] .= strtotime($join_month[0][$i]['months'])."+".$join_month[0][$i]['cnt'];
			
			if($i < count($join_month[0])-1){
				$data['month_join_ary'] .= "/";
			}
		}
		echo $data['month_join_ary'];
	}

	function member_view()  //회원 조회
	{
		$data['gubn'] = $gubn = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'gubn')));
		$userid = $search['m_userid'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));
		if(empty($userid)){alert_only("회원아이디가 넘어오지 않았습니다.");}
		
		// 회원정보 불러오기
		if($gubn == "new"){
			$data['views'] = $this->member_lib->get_member($userid);
		}else if($gubn == "old"){
			$data['views'] = $this->member_lib->get_member_old($userid);
		}else if($gubn == "out"){
			$data['views'] = $this->member_lib->get_member_out($userid);
		}else{
			$data['gubn'] = $gubn = "new";
			$data['views'] = $this->member_lib->get_member($userid);
			//alert_goto('잘못된 접근입니다.', '/admin/main/member_list');	//기본값 지정해놓음
		}
		
		if(empty($data['views'])){alert_only("존재하지 않는 회원입니다.");}

		// 비접속/접속
		$data['login'] = $this->my_m->cnt('ci_sessions', $search);

		// 회원의 총 포인트 가져오기
		@$member_total_point = $this->my_m->row_array('member_total_point', array('m_userid' => $userid));
		$data['t_point'] = @$member_total_point['total_point'];		//개인 총 충전 포인트

		// 포인트 내역
		$data['point_ary'] = $this->my_m->result_array('member_point_list', $search, 'm_idx','desc','10');

		// 프로필 사진
		$data['pic_data1'] = @$this->member_lib->profile_thumb(1, $userid, '150','150');
		$data['pic_row1'] = $this->my_m->row_array('member_pic', array('user_id' => $userid, 'pic_num' => 1));
		$data['pic_data2'] = @$this->member_lib->profile_thumb(2, $userid, '150','150');
		$data['pic_row2'] = $this->my_m->row_array('member_pic', array('user_id' => $userid, 'pic_num' => 2));
		$data['pic_data3'] = @$this->member_lib->profile_thumb(3, $userid, '150','150');
		$data['pic_row3'] = $this->my_m->row_array('member_pic', array('user_id' => $userid, 'pic_num' => 3));
		$data['pic_cnt'] = $this->my_m->cnt('member_pic', array("user_id" => $userid, "pic_status" => "인증완료"));

		// 대표사진
		$pic_sear['user_id'] = $userid;
		$pic_sear['is_main_pic'] = 'y';
		@$main_pic = $this->my_m->row_array("member_pic", $pic_sear);
		$data['main_pic'] = @$main_pic['pic_num'];

		if($data['views']['m_sex'] == 'M'){		//남자
			$data['null_img'] = '<div class="man_icon border_none" style="width:150px; height:150px;">
							<img src="'.IMG_DIR.'/meeting/man_ic.png" class="img_none_icon top_25per height_50per">
						</div>';
		}else{		//여자
			$data['null_img'] = '<div class="girl_icon border_none" style="width:150px; height:150px;">
							<img src="'.IMG_DIR.'/meeting/girl_ic.png" class="img_none_icon top_25per height_50per">
						</div>';
		}
		
		// 신고,처벌내역
		$pay_ary['s_userid'] = $v_search['m_userid'] = $puni_ary['user_id'] = $compl_ary['r_id'] = $cs_ary['m_consult_id'] = $userid;
		$data['coml_ary'] = $this->my_m->result_array('Police_complaint', $compl_ary, 'c_date','desc','10');
		$data['coml_ary_cnt'] = count($data['coml_ary']);
		$data['puni_ary'] = $this->my_m->result_array('Police_punish', $puni_ary, 'p_date','desc','10');
		$data['puni_ary_cnt'] = count($data['puni_ary']);
		$data['puni_cnt'] = $this->my_m->cnt('Police_punish', $puni_ary);

		// CS 내역
		$data['cs_ary'] = $this->my_m->result_array('T_Consult_Admin', $cs_ary, 'm_idx','desc','10');
		$data['cs_ary_cnt'] = count($data['cs_ary']);

		// 충전 내역
		$pay_result = $this->payment_m->payment_result($pay_ary, '', $gubn);
		$data['payment'] = $pay_result[0];
		$data['payment_cnt'] = count($data['payment']);

		// 정회원 결제일
		$v_search['m_product_code'] = '1001';
		@$v_info = $this->my_m->row_array("member_point_list", $v_search, 'm_idx');
		$data['v_date'] = @$v_info['m_writedate'];

		//문자팅 등록여부
		$data['sms_use'] = $this->my_m->cnt('T_JoyHunting_MsgTing', array("m_userid" => $userid));

		$data['user'] = $this->session->userdata('username');

		//회원 이동경로
		$data['site_url'] = $this->my_m->result_array('member_site_analytics', array('user_id' => $userid), 'idx', 'desc', '20');

		if ($data['views']['m_special'] > 0){
			//추가스크립트
			$bot_data['add_script'] = "
			<script>
				$(document).ready(function(){
					$('#m_conregion').val('".$data['views']['m_conregion']."');
					area_select($('#m_conregion').val(), 'm_conregion2');
					$('#m_conregion2').val('".$data['views']['m_conregion2']."');
				});
			</script>
			";
		}
	
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_view_v', $data);
		$this->load->view('admin/admin_bottom_v',@$bot_data);
	}

	function member_filed_change() //회원정보 하나씩 업데이트
	{		
			$gubn = rawurldecode($this->input->post('v_gubn', true));

			if($gubn == "new"){
				$v_table = "TotalMembers";				//일반회원 데이터 수정
			}else if($gubn == "old"){
				$v_table = "TotalMembers_old";			//휴면회원 데이터 수정
			}else{
				echo "1000"; exit;
			}

			$mem = $this->member_lib->get_member($this->input->post('userid',TRUE));

			if($this->input->post('mode',TRUE) == "hp"){
				//휴대폰

				$ph_preg = preg_replace("/\s+/", "", $this->input->post('m_hp',TRUE));
				$ph_str = str_replace('-',"",$ph_preg);

				$m_mobile_chk = urldecode(trim($this->input->post('m_mobile_chk',TRUE)));

				// 010
				if(strlen($ph_str) > 10){

					$tmp[0] = substr($ph_str, 0,3);
					$tmp[1] = substr($ph_str, 3,4);
					$tmp[2] = substr($ph_str, 7,4);
				// 011
				}else{
					$tmp[0] = substr($ph_str, 0,3);
					$tmp[1] = substr($ph_str, 3,3);
					$tmp[2] = substr($ph_str, 6,4);
				}

				//$tmp = explode("-",$this->input->post('m_hp',TRUE));
				$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_mobile_chk" =>  trim($m_mobile_chk), "m_mobile_chke_date" => NOW) );	//휴대폰 인증여부 업데이트

				//여성이면 정회원 변환
				if($mem['m_sex'] == "F" and $m_mobile_chk == "1" ){
					$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_type" =>  "V") );
				}

				$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_hp1" =>  trim($tmp[0])) );
				$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_hp2" =>  trim($tmp[1])) );
				$rtn = $this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_hp3" =>  trim($tmp[2])) );

				echo $rtn;
			}else if($this->input->post('mode',TRUE) == "m_pwd"){
				//비밀번호
				$m_pwd = urldecode(trim($this->input->post('m_pwd',TRUE)));

				$hashed_password = encryption_pass($m_pwd);

				$rtn = $this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_pwd" =>  "$hashed_password", "last_login_day" => NOW) );

				echo $rtn;
			}else if($this->input->post('mode',TRUE) == "m_area"){
				//지역
				$tmp = explode("/",$this->input->post('m_data',TRUE));

				$arrData = array(
					"m_conregion"		=> trim($tmp[0]),
					"m_conregion2"		=> trim($tmp[1])
				);

				$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), $arrData);

				//지역변경에 따른 맵좌표 수정
				$map_data = getGeo($this->input->post('userid', true));
				$rtn = $this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array('m_xpoint' => $map_data[0], 'm_ypoint' => $map_data[1]));

				echo $rtn;
			}else if($this->input->post('mode',TRUE) == "m_jumin"){
				//주민등록번호
				$tmp = explode("/",$this->input->post('m_data',TRUE));

				$this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_jumin1" =>  trim($tmp[0])) );
				$rtn = $this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array("m_jumin2" =>  trim($tmp[1])) );

				echo $rtn;
			}else if($this->input->post('mode',TRUE) == "m_nick"){
				//닉네임변경(닉네임 필터적용)
				$m_userid	= urldecode($this->input->post('userid',TRUE));
				$m_nick		= urldecode(trim($this->input->post('m_data',TRUE)));

				//금지닉네임 체크(비교대상에 있을경우 금지 닉네임 추가)
				$banned = $this->my_m->row_array('admin_setting', array('idx' => '1'));
				$ban = explode(',', $banned['banned_nick']);

				if(count($ban) == ""){
					$total = "1";
				}else{
					$total = count($ban);
				}

				$j=0;
				$nick_chk = "";		//금지어
				
				for($i=0; $i<$total; $i++){
					if(strpos($m_nick, str_replace(' ', '', $ban[$i])) !== false){
						$j++;
						$nick_chk = $ban[$i];
						break;
					}
				}
				
				if($j > 0){
					$rtn = $this->my_m->update($v_table, array('m_userid' => $m_userid), array('m_nick_chk' => $nick_chk, 'm_nick' => $m_nick));
				}else{
					$rtn = $this->my_m->update($v_table, array('m_userid' => $m_userid), array('m_nick_chk' => null, 'm_nick' => $m_nick));
				}

				echo $rtn;
				
			}else{
				//기타
				$m_data = urldecode(trim($this->input->post('m_data',TRUE)));
				$rtn = $this->my_m->update($v_table, array("m_userid" => $this->input->post('userid',TRUE)), array($this->input->post('mode',TRUE) => $m_data) );

				echo $rtn;
			}
	}

	function admin_list()  //운영자 목록
	{
		$this->load->library('pagination');
		$config['page_query_string']=FALSE;

		$config['uri_segment'] = 4;
		$data['perPage']=$config['per_page']='15'; //페이지당 리스트 노출갯수
		$config['base_url']=site_url('admin/main/index/'); //페이징처리 링크주소
		$page=$offset = $this->uri->segment(4, 0);

		if( $this->input->post('search_word', true) )
		{
			$data['mlist'] = $this->a_member_m->member_list('all', $this->input->post('search_word',TRUE), $offset, $config['per_page']); //운영자 리스트
			$data['getTotalData']=$config['total_rows']=$this->a_member_m->getTotalData('all', $this->input->post('search_word',TRUE), $offset, $config['per_page']);
		}
		else
		{
			$data['mlist'] = $this->a_member_m->member_list('all', '', $offset, $config['per_page']); //운영자 리스트
			$data['getTotalData']=$config['total_rows']=$this->a_member_m->getTotalData('all', 'all_keyword', '', '');
		}

		$this->pagination->initialize($config);
		$data['pagenav'] = $this->pagination->create_links();

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/topnav_v');
		$this->load->view('admin/member/member_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}

	function master_add()  //운영자 추가
	{
		$this->load->library('form_validation');
		//폼검증 규칙 설정
		$config = array(
			array(
				'field'   => 'user_id',
				'label'   => '아이디',
				'rules'   => 'callback_userid_check'
				),
		    array(
				'field'   => 'user_nm',
				'label'   => '이름',
				'rules'   => 'required'
				),
		    array(
				'field'   => 'user_pw',
				'label'   => '패스워드',
				'rules'   => 'required|min_length[4]'
			    ),
		    array(
				'field'   => 'user_nickname',
				'label'   => '닉네임',
				'rules'   => 'callback_nick_check'
			    ),
			array(
				 'field'   => 'user_email',
				 'label'   => '이메일',
				 'rules'   => 'required'
				)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/master_add_v');
		}
		else
		{
			if( $this->input->post('status_mode',TRUE) == 'insert' )
			{
				$this->a_member_m->master_add($this->input->post(NULL, true)); //운영자 추가 함수
?>
				<script type="text/javascript"  src="<?php echo JS_DIR?>/jquery-1.3.2.min.js"></script>
				<script type="text/javascript"  src="<?php echo JS_DIR?>/jquery.framedialog.js"></script>
				<script>
					//FrameDialog 닫기
					$(document).ready(function() { jQuery.FrameDialog.closeDialog(); });
					alert('입력되었습니다.');
					parent.document.location.reload();
				</script>
<?php
			}
		}
	}

	//게시판 리스트
	function board()
	{
		$this->load->library('pagination');
		$config['page_query_string']=FALSE;

		$config['uri_segment'] = 4;
		$data['perPage']=$config['per_page']='15'; //페이지당 리스트 노출갯수
		$config['base_url']=site_url('admin/main/board/'); //페이징처리 링크주소
		$page=$offset = $this->uri->segment(4, 0);

		if( $this->input->post('search_word', true) )
		{
			$data['mlist'] = $this->a_member_m->board_list('all', $this->input->post('search_word',TRUE), $offset, $config['per_page']);
			$data['getTotalData']=$config['total_rows']=$this->a_member_m->board_list_count('all', $this->input->post('search_word',TRUE), $offset, $config['per_page']);
		}
		else
		{
			$data['mlist'] = $this->a_member_m->board_list('all', '', $offset, $config['per_page']);
			$data['getTotalData']=$config['total_rows']=$this->a_member_m->board_list_count('all', 'all_keyword', '', '');
		}

		$this->pagination->initialize($config);
		$data['pagenav'] = $this->pagination->create_links();

		$this->load->view('top_v');
		$this->load->view('admin/topnav_v');
		$this->load->view('admin/board_list_v', $data);
		$this->load->view('bottom_v');
	}

	function board_add()  //게시판 추가, 삭제
	{
		$this->load->library('form_validation');
		//폼검증 규칙 설정
		$config = array(
			array(
				'field'   => 'name',
				'label'   => '게시판명',
				'rules'   => 'required|max_length[30]'
				),
		    array(
				'field'   => 'name_en',
				'label'   => '게시판 영문명',
				'rules'   => 'callback_name_check'
				)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/board_add_v');
		}
		else
		{
			if( $this->input->post('status_mode',TRUE) == 'insert' )
			{
				$result = $this->a_member_m->board_add($this->input->post(NULL, true));
				if($result)
				{
?>
					<script type="text/javascript"  src="<?php echo JS_DIR?>/jquery-1.3.2.min.js"></script>
					<script type="text/javascript"  src="<?php echo JS_DIR?>/jquery.framedialog.js"></script>
					<script>
						//FrameDialog 닫기
						alert('입력되었습니다.');
						$(document).ready(function() { jQuery.FrameDialog.closeDialog(); });
						parent.document.location.reload();
					</script>
<?php
				}
				else
				{
					alert('입력하지 못했습니다.', '');
				}
			}
			elseif( $this->input->post('status_mode',TRUE) == 'delete' )
			{
				//삭제후 리퍼러 주소로..
			}
		}

	}

	function userid_check($id)  //아이디 체크 콜백함수
	{
		if (!$id)
		{
			$this->form_validation->set_message('userid_check', '아이디를 입력하세요.');
			return FALSE;
			exit;
		}
		//영어인지 체크
		if (strlen($id) < 4 or strlen($id) > 12)
		{
			$this->form_validation->set_message('userid_check', '아이디는 4자 이상, 12자 이하로 입력하세요.');
			return FALSE;
			exit;
		}

		$str = $this->a_member_m->id_check($id);
		$noids = array('abroad','action','admin','administrator','africa','agency','agent','america','angel','ani','arkadio','art','asia','asiana','auction','auto','baby','backup','bank','baseball','bell','biz','blog','book','bookmark','brand','business','cafe','card','chat','city','collaboration','comic','community','consulting','contents','continent','codeigniter','cook','ceo','cto','cfo','corea','corp','creation','customer','cyber','cyworld','daewoo','daum','diary','directory','drama','dreamwiz','east','economy','emigrant','english','entertainment','europe','exchange','file','finance','flash','food','franchise','free','fuck','gallary','game','gay','global','gmarket','golf','google','group','gseshop','guest','hanatour','hangul','hanja','happy','health','help','hibori','home','homepage','homework','hotel','hyundai','imtel','inbound','index','info','intel','iriver','item','job','keyword','khan','kiamoters','king','koderi','koglian','koglo','korean','koreanair','kralliance','krgame','krnews','krtv','land','lesbian','life','living','local','login','logout','lorita','lotte','lotto','love','mail','main','mall','manager','maps','market','marketing','master','mbc','media','message','microsoft','middleeast','miz','model','modetour','movie','music','myhome','mypage','nate','nateon','nation','naver','netpia','network','news','newsnp','newspaper','north','nude','okmedia','oktour','on','oninfo','onket','open','opencafe','openmarket','outbound','paran','people','phone','photo','plan','planning','play','policy','poll','porno','pornosex','portal','prince','princess','privacy','process','qeen','radio','real','rent','resume','root','samsung','samsungcard','search','sex','sexporno','shinsegae','shop','shopping','south','southpacific','sports','star','stock','study','sysop','time','toolbar','toon','tour','trade','traffic','travel','vod','weather','webmaster','website','west','world','xxx','xxxx','xxxxxx');

		if ($str > 0)
		{
			$this->form_validation->set_message('userid_check', '중복된 아이디입니다.');
			return FALSE;
		}
		else if (in_array($id, $noids))
		{
			$this->form_validation->set_message('userid_check', '사용할 수 없는 아이디입니다.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function nick_check($ju) //닉네임 사용 체크 콜백
	{
		if (!$ju)
		{
			$this->form_validation->set_message('nick_check', '닉네임을 입력하세요.');
			return FALSE;
			exit;
		}

		if (strlen($ju) < 6 or strlen($ju) > 30)
		{
			$this->form_validation->set_message('nick_check', '닉네임은 2자이상 10자이하로 입력하세요.');
			return FALSE;
			exit;
		}

		$str = $this->a_member_m->nick_check($ju);

		if ($str > 0)
		{
			$this->form_validation->set_message('nick_check', '중복된 닉네임입니다.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	//게시판 영문명 체크 콜백
	function name_check($ju)
	{
		if (!$ju)
		{
			$this->form_validation->set_message('name_check', '게시판 영문명을 입력하세요.');
			return FALSE;
			exit;
		}

		if (strlen($ju) < 2 or strlen($ju) > 30)
		{
			$this->form_validation->set_message('name_check', '게시판 영문명은 2자이상 30자이하로 입력하세요.');
			return FALSE;
			exit;
		}

		$str = $this->a_member_m->name_check($ju);

		if ($str > 0)
		{
			$this->form_validation->set_message('name_check', '중복된 게시판 영문명입니다.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	//스패머 강제탈퇴
	function banned()
	{
		$bann_id = $this->uri->segment(4);

		if( $this->session->userdata('auth_code') >= 10 )
		{
			$arr = array(
				'password' => 'fsdfsdfs',
				'activated' => '0',
				'banned' => '1',
				'ban_reason' => 'speamer-작업자 : '.$this->session->userdata('nickname')
			);
			$this->db->where('id', $bann_id);
			$this->db->update('users', $arr);
			alert_close("강제탈퇴 완료");
		}
	}


	//탈퇴회원 조회
	function member_secession(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
	
		$result = $this->a_member_m->member_secession_list($start, $rp, @$data, 'TotalMembers_out'); //회원 리스트
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];

	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_secession_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}


	//회원탈퇴 리스트
	function member_out(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
	
		$result = $this->a_member_m->member_list($start, $rp, @$data, 'TotalMembers'); //회원 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];


		for ($i=0; $i<count($result[0]); $i++){

			$search = '';
			$search['m_userid'] = $result[0][$i]['m_userid'];
	
			// 토탈포인트
			$user_po = $this->my_m->cnt('member_total_point', $search);
			if ($user_po > 0){
				$total_po = $this->my_m->row_array('member_total_point', $search);
				$data['mlist'][$i]['m_point'] = $total_po['total_point'];
			}else{
				$data['mlist'][$i]['m_point'] = 0;
			}

			// 정회원
			$search['m_product_code'] = '1001';
			$user_lv = $this->my_m->cnt('member_point_list', $search);
			if ($user_lv > 0){
				$mb_lev = $this->my_m->row_array('member_point_list', $search);
				$data['mlist'][$i]['m_lev'] = "O";
				$data['mlist'][$i]['m_lev_date'] = $mb_lev['m_writedate'];
			}else{
				$data['mlist'][$i]['m_lev'] = "X";
				$data['mlist'][$i]['m_lev_date'] = '';
			}
		}

		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_out_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	function member_bye(){

		$user_id = urldecode($this->input->post('userid',TRUE));
		if(empty($user_id)){ echo "0"; exit; }
		
		$m_reason				= "0";
		$m_reason_content		= "관리자의 의한 탈퇴";

		$rtn = $this->profile_m->member_secession($user_id, $m_reason, $m_reason_content);

		echo $rtn;
	}


	//임시회원 리스트
	function reg_member_list(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));

			$search = array(
				$data['method'] => $data['s_word'],
				$data['method2'] => $data['s_word2']
			);

			$search1 = array($data['method'], $data['s_word']);
			$search2 = array($data['method2'], $data['s_word2']);
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$m_result = $this->a_member_m->reg_member_list($start, $rp, @$search1, @$search2);

		//$m_result = $this->my_m->get_list_solo($start, $rp, @$search, 'reg_member', 'write_date', 'desc', '*');

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $m_result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'], $limit));
	
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/reg_member_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//임시회원 삭제
	function reg_member_del(){
		
		$user_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id'));
		
		$this->my_m->del('reg_member_auth', array('user_id' => $user_id));		//임시회원 인증신청 내역 삭제
		$rtn = $this->my_m->del('reg_member', array('userid' => $user_id));		//임시회원 삭제
		
		echo $rtn;
	}


	//앱 등록회원 리스트
	function app_member_list(){

		//검색이 있을경우
		if( in_array('q', $this->seg_exp) || in_array('q2', $this->seg_exp) )
		{
			$data['s_word'] = $post['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = $post['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$data['s_word2'] = $post['s_word2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q2')));
			$data['method2'] = $post['method2'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl2')));

			$search = array(
				$data['method'] => $data['s_word'],
				$data['method2'] => $data['s_word2']
			);
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =20; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_result = $this->my_m->get_list_solo($start, $rp, @$search, 'joytalk_id', 'idx', 'desc', '*');

		$data['mlist'] = $m_result[0];
		$data['getTotalData'] = $m_result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'], $limit));
	
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/app_member_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}


	//앱 설치 일일 통계
	function app_member_total(){

		$m_year		= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//년
		$m_month	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//월

		if(empty($m_year)){ $m_year = date('Y'); }			//년도가 없을 경우 초기화
		if(empty($m_month)){ $m_month = date('m'); }		//월이 없을 경우 초기화

		$this_month = $m_year."-".$m_month."-01";			//해당달의 1일 초기화

		$data['m_year']		= $m_year;
		$data['m_month']	= $m_month;
		
		//해달 달의 결제 통계 데이터 가져오기
		$mlist = $this->a_member_m->app_stat($this_month);

		$data['mlist']			= $mlist[0];		//회원가입 통계 데이터
		$data['month_app']	= $mlist[1];		//이달의 앱설치
		$data['total_app']	= $mlist[2];		//전체 앱설치
		$data['month_login']	= $mlist[3];		//앱설치자중 로그인회원

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/app_member_total_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}


	//회원가입 통계
	function register_stat(){

		$m_year		= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//년
		$m_month	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//월

		if(empty($m_year)){ $m_year = date('Y'); }			//년도가 없을 경우 초기화
		if(empty($m_month)){ $m_month = date('m'); }		//월이 없을 경우 초기화

		$this_month = $m_year."-".$m_month."-01";			//해당달의 1일 초기화

		$data['m_year']		= $m_year;
		$data['m_month']	= $m_month;
		
		//해달 달의 결제 통계 데이터 가져오기
		$mlist = $this->a_member_m->register_stat($this_month);

		$data['mlist']			= $mlist[0];		//회원가입 통계 데이터
		$data['total_member']	= $mlist[1];		//정식회원 수
		$data['reg_member']		= $mlist[2];		//임시회원 수 

		$data['total_m']	= "0";
		$data['total_f']	= "0";
		$data['total_a']	= "0";
		$data['total_r']	= "0";
		$data['total_out']	= "0";
		$data['total_mobile_m'] = "0";
		$data['total_mobile_w'] = "0";
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_register_stat_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	//파트너 통계
	function partner_stat(){

		$val1	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//시작날짜
		$val2	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//종료날짜

		//if(empty($val1)){ $from_date = date('Y-m-')."01"; }else{ $from_date = $val1; }
		if(empty($val1)){ $from_date = date("Y-m-d", strtotime("-7day")); }else{ $from_date = $val1; }
		if(empty($val2)){ $to_date = date('Y-m-d'); }else{ $to_date = $val2; }

		$data['from_date']	= $from_date;		//시작날짜 셋팅
		$data['to_date']	= $to_date;			//종료날짜 셋팅

		$list_date[] = "";		//날짜배열 셋팅
		
		for($now = $from_date; $now <= $to_date; $now = date("Y-m-d", strtotime($now." +1 day"))){
			$list_date[] = $now;
		}

		$data['list'] = $list_date;
		
		//선택 기간에 해당하는 파트너 아이디 가져오기
		$partner_id = $this->a_member_m->partner_id_search($from_date, $to_date);
		$data['partner_id'] = $partner_id[0];
		//가져온 파트너 아이디로 날짜별 회원 가입수 가져오기(날짜 배열, 파트너아이디 배열, 시작날짜, 종료날짜, 서브쿼리)
		$partner_data = $this->a_member_m->partner_data($list_date, $partner_id, $from_date, $to_date, $partner_id[1]);
		$data['partner_data']	= $partner_data[0];
		$data['total_members']	= $partner_data[1];
		$data['partner_price'] =  $partner_data[2];
			
		//테이블표 div width값 지정하기
		if(!empty($partner_id)){
			$div_width = 200 + 100*count($list_date);
			$data['div_max_width'] = "width:".$div_width."px;";
		}
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_partner_stat_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	//파트너 전환률 통계
	function partner_per_stat(){

		$val1	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val1'));			//시작날짜
		$val2	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val2'));			//종료날짜
		$val3	= $this->security->xss_clean(@url_explode($this->seg_exp, 'val3'));			//파트너아이디

		if(empty($val1)){ $from_date = date('Y-m-')."01"; }else{ $from_date = $val1; }
		if(empty($val2)){ $to_date = date('Y-m-d'); }else{ $to_date = $val2; }
		if(empty($val3)){ $partner_id = ""; }else{ $partner_id = $val3; }
		
		//날짜 셋팅
		$data['from_date']	= $from_date;	//시작날짜
		$data['to_date']	= $to_date;		//종료날짜

		//파트너 아이디 셋팅
		$data['partner_id'] = $partner_id;	//파트너 아이디

		//날짜기준 파트너 전환률 데이터 불러오기
		$partner_list = $this->a_member_m->partner_per_data($from_date, $to_date, $partner_id);
		$data['partner_list'] = $partner_list;

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_partner_per_stat_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}




	//관리자가 대표사진 등록 
	function set_member_pic(){
		
		$user_id = $this->input->post('user_id', true);
		
		//업로드 경로 만들기
		$dir = $this->member_lib->make_thumb_dir($user_id);
		
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size']	= '1000';
		$config['max_width']  = '2048';
		$config['max_height']  = '1536';

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('member_pic')){
			$rtn = "2";
		}else{	
			//리턴값 file_name, file_pth, full_path
			$data = $this->upload->data();

			//회원의 사진 갯수 체크
			$cnt = $this->my_m->cnt('member_pic', array('user_id' => $user_id));
			
			//회원 대표사진 초기화
			$this->my_m->update('member_pic', array('user_id' => $user_id), array('is_main_pic' => ''));

			if($cnt == "3"){
				//대표사진 최대 갯수 3개일경우 첫번째 사진 삭제후 등록(업데이트 처리)
				$arrData = array(
					"user_id"				=> $user_id,
					"pic_file_name"			=> $data['full_path'],
					"pic_w_date"			=> NOW,
					"pic_status"			=> "인증완료",
					"pic_admin_memo"		=> "",
					"pic_num"				=> "1",
					"pic_admin_date"		=> NOW,
					"is_main_pic"			=> 'y'
				);

				$rtn = $this->my_m->update('member_pic', array('user_id' => $user_id, 'pic_num' => '1'), $arrData);
				
			}else{
				//사진등록가능
				$arrData = array(
					"user_id"				=> $user_id,
					"pic_file_name"			=> $data['full_path'],
					"pic_w_date"			=> NOW,
					"pic_status"			=> "인증완료",
					"pic_admin_memo"		=> "",
					"pic_num"				=> $cnt+1,
					"pic_admin_date"		=> NOW,
					"is_main_pic"			=> 'y'
				);

				$rtn = $this->my_m->insert('member_pic', $arrData);
			}

			$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_filename' => $dir."/".$data['file_name']) );

		}

		//리턴 url
			$rtn_url = "/admin/main/member_view/userid/".$user_id;

		if($rtn == "0"){
			//사진등록 실패
			alert_goto('사진등록을 실패했습니다.', $rtn_url);
		}else if($rtn == "1"){
			//사진등록 성공
			alert_goto('사진이 등록되었습니다..', $rtn_url);
		}else if($rtn == "2"){
			//업로드 파일이 없을 경우
			alert_goto('업로드 파일이 없습니다.', $rtn_url);
		}

	}


	//휴면 회원 일반화원으로 전환
	function call_old_member_new(){

		$user_id = rawurldecode($this->input->post('user_id', true));

		$rtn = $this->member_lib->old_member_new($user_id);
		
		//최근접속시간을 update 안함 회원이 본인이 본인인증 후 변경하도록 하기 위해서 

		echo $rtn;
	}


	//회원 강제 로그아웃 처리
	function member_compulsion_logout(){
		
		$user_id = rawurldecode($this->input->post('user_id', true));

		if(empty($user_id)){ echo "1000"; exit; } //잘못된 접근처리

		$rtn = call_member_log_out($user_id); //회원 로그아웃 헬퍼(latest_helper)

		echo $rtn;
	}

	//회원 성별 변경
	function member_change_sex(){
		
		$user_id = rawurldecode($this->input->post('user_id', true));
		if(empty($user_id)){ echo "1000"; exit; } //잘못된 접근처리

		$mdata = $this->member_lib->get_member($user_id);
		
		//남성일때 여성으로 여성일땐 남성으로 변경
		if($mdata['m_sex'] == "M"){
			
			$set_array = array(
				"m_sex"			=> "F",
				"m_jumin2"		=> "2222222"		
			);

		}else{

			$set_array = array(
				"m_sex"			=> "M",
				"m_jumin2"		=> "1111111",
				"m_type"		=> "F"
			);
		}

		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), $set_array);

		echo $rtn;
	}
	
	//회원 나이 변경
	function member_change_age(){
		
		$user_id = rawurldecode($this->input->post('user_id', true));
		if(empty($user_id)){ echo "1000"; exit; } //잘못된 접근처리

		$mdata = $this->member_lib->get_member($user_id);
		
		//남성일때 여성으로 여성일땐 남성으로 변경
		if(substr($mdata['m_jumin1'],0,2) <  "20" ){
			
			$m_age = date("Y") - (2000+substr($mdata['m_jumin1'],0,2)) + 1;

			$set_array = array(
				"m_age"			=> $m_age
			);

		}else{

			$m_age = date("Y") - (1900+substr($mdata['m_jumin1'],0,2)) + 1;

			$set_array = array(
				"m_age"			=> $m_age
			);

		}

		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), $set_array);

		echo $rtn;
	}

	//임시회원 인증 회원들 정식회원으로 일괄처리
	function reg_member_user_up(){
		
		//회원가입 신청 대기 리스트 가져오기(limit 20명 기준)
		$user_data = $this->a_member_m->reg_member_user_list();

		$num = 0;
		if(!empty($user_data)){

			foreach($user_data as $data){
				//임시회원 회원가입, 인증내역삭제, 임시회원 리스트 삭제, 임시회원 세션 로그아웃 처리 하기
				$rtn = $this->create_reg_user($data);
				if($rtn == 1){ $num++; }
			}

		}

		echo $num;
	}

	//임시회원 회원가입, 인증내역삭제, 임시회원 리스트 삭제, 임시회원 세션 로그아웃 처리 함수
	function create_reg_user($data){
		
		//임시회원 데이터가 없을 경우 return 처리
		if(empty($data)){ return "0"; }

		//생년월일
		$m_jumin1 = substr($data['year'], -2).$data['month'].$data['day'];

		//성별로 구분
		if($data['sex'] == "M"){
			//남성회원의 경우			
			if($data['talk_style'] == "0"){ $m_character = rand(1,19); }else{ $m_character = $data['talk_style']; }		//대화스타일
			
			$m_jumin2	= "1111111";								//남자구분 
			$myavata	= "1510001,1010001_0,1310001,0910001";		//아바타 아이디			
			$m_type		= "F";										//회원등급

		}else if($data['sex'] == "F"){
			//여성회원의 경우			
			if($data['talk_style'] == "0"){ $m_character = rand(101,117); }else{ $m_character = $data['talk_style']; }	//대화스타일
			
			$m_jumin2	= "2222222";								//여자구분 
			$myavata	= "1520001,1020001_0,1320001,0920001";		//아바타 아이디
			$m_type		= "V";										//회원등급

		}else{
			//잘못된 접근
			return "0";
		}

		//원하는만남
		if($data['reason'] == "0"){ $m_reason = rand(1,13); }else{ $m_reason = $data['reason']; }

		//인사말
		$my_intro = call_my_intro($data['sex']);

		//금지 닉네임 체크
		$nick_chk = $this->reg_member_nick_chk($data['nick']);
		if(empty($nick_chk)){ $m_nick_chk = null; }else{ $m_nick_chk = $nick_chk; }

		//중복 회원가입 체크하기
		$user_cnt = $this->my_m->cnt('TotalMembers', array('m_userid' => $data['userid']));
		if($user_cnt > 0){ return "0"; }
		
		//회원가입에 필요한 테이터 배열정리
		$arrData = array(
			'm_userid'			=> $data['userid'],
			'm_name'			=> $data['user_name'],
			'm_nick'			=> $data['nick'],
			'm_pwd'				=> $data['pwd'],
			'm_mail'			=> $data['mail'],
			'm_ip'				=> $data['reg_ip'],
			'm_conregion'		=> $data['conregion'],
			'm_conregion2'		=> $data['conregion2'],
			'm_jumin1'			=> $m_jumin1,
			'm_jumin2'			=> $m_jumin2,
			'm_sex'				=> $data['sex'],
			'm_age'				=> $data['age'],
			'm_age2'			=> substr($data['age'], 0, 1),
			'm_hp1'				=> $data['hp1'],
			'm_hp2'				=> $data['hp2'],
			'm_hp3'				=> $data['hp3'],
			'm_mobile_chk'		=> '1',
			'm_mobile_chke_date'=> NOW,
			'm_reason'			=> $m_reason,
			'm_character'		=> $m_character,
			'my_intro'			=> $my_intro,
			'm_avataid'			=> $myavata,
			'm_type'			=> $m_type,
			'm_in_date'			=> NOW,
			'm_nick_chk'		=> $m_nick_chk,
			'm_partner'			=> $data['partner'],
			'm_partner_code'	=> $data['ad_code'],
			'm_reg_mobile'		=> $data['reg_mobile'],
			'last_login_day'	=> NOW
		);
		
		$rtn = $this->my_m->insert('TotalMembers', $arrData);
		
		if($rtn == 1){
			
			//회원가입이 완료되었을 경우 처리
			$this->my_m->del('reg_member', array('userid' => $data['userid']));				//임시회원 내역 삭제
			$this->my_m->del('reg_member_auth', array('user_id' => $data['userid']));		//임시회원 인증신청 내역 삭제
			$this->my_m->del('ci_sessions', array('m_userid' => $data['userid']));			//임시회원 세션 로그아웃 처리

			//파트너 코드 처리(partner_helper)
			if(!empty($data['partner']) and !empty($data['ad_code'])){
				partner_send_curl('JOIN', $data['userid'], null);
			}

			//회원가입 좌표 만들기(지역좌표)
			get_coordination_member($data['userid']);					//회원가입시 선택한 지역에 따른 맵 좌표 생성(latest_helper)

			//회원가입 문자보내기
			$hptele = $data['hp1'].$data['hp2'].$data['hp3'];			//회원 휴대전화번호
			$sms_msg = $data['userid']."님\n조이헌팅 가입을 축하드립니다.\n\nwww.joyhunting.com";
			$this->sms_lib->sms_send('', array($hptele), $sms_msg);

			//2시간뒤 실시간채팅앱 광고 문자 발송 추가
			reg_member_msg_log($data['userid']);

		}

		return $rtn;

	}

	//회원 닉네임 체크
	function reg_member_nick_chk($user_nick){
		
		$nick_chk = "";		//금지어

		if(empty($user_nick)){ return $nick_chk; }

		$banned = $this->my_m->row_array('admin_setting', array('idx' => '1'), 'idx', 'desc', '1');
		$ban = explode(',', $banned['banned_nick']);

		for($i=0; $i<count($ban); $i++){
			if(strpos($user_nick, str_replace(' ', '', $ban[$i])) !== false){
				$nick_chk = $ban[$i];
				break;
			}
		}

		return $nick_chk;
	}

	//임시회원 문의사항 가져오기
	function reg_member_etc_memo(){
		
		$user_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id'));

		$data = $this->my_m->row_array('reg_member_auth', array('user_id'=> $user_id, 'use_yn' => 'Y'), 'idx', 'desc', '1');
		
		echo $data['etc'];
	}


	//회원 이동경로 상세보기 페이지
	function member_move_list(){

		$user_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id'));
		
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, array('user_id' => $user_id), 'member_site_analytics', 'idx', 'user_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/member_move_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}

	//로그인 시도 기록 모두 초기화
	function clear_login(){

		$result = $this->db->query("delete from login_attempts");

		echo $result;
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/main.php */