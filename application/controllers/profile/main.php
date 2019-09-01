<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->model('member_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('alrim_helper');
		$this->load->helper('code_change_helper');
		$this->load->helper('level_helper');
	}

	//PC프로필 메인
	function user()
	{
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

		$data['recv_id'] = $recv_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); //회원 아이디 받기

		if(IS_LOGIN and !$recv_id){
			//내프로필
			$user_id = $this->session->userdata('m_userid');
			$m_row = $this->member_lib->get_member($user_id);
			$data['pic_title'] = $m_row['m_nick']."님! 오늘도 좋은 인연과 함께 행복한 하루되세요~";
			$my_profile = $data['my_profile'] = true; //내 프로필인가
			
			if($m_row['m_mobile_chk'] != '1'){	
				$bot_data['add_script'] ="
					<script>
					mobile_chk_pop();
					</script>
				";
			}

		}else{
			//상대방 프로필이거나, 데모아이디 프로필
			if(!$recv_id){

				$rand_mb = $this->my_m->result_array('TotalMembers', array('m_special' => '1'));
				shuffle($rand_mb);
				$recv_id = $rand_mb[0]['m_userid']; //데모아이디

			}else if(IS_LOGIN){
				//데모 아이디 아닐경우 내 프로필 방문자 DB인서트
				//하루에 한번만 방문기록 남김
				$v_cnt = $this->my_m->cnt('profile_visit', array('user_id' => $recv_id, 'visit_user_id' => $this->session->userdata('m_userid'), 'ex_v_date' => "v_date like '".TODAY."%'"));
				if($v_cnt == 0){ 
				$data_array = array(
						'user_id' => $recv_id,
						'visit_user_id' => $this->session->userdata('m_userid'),
						'v_date' => NOW
					);
				$this->my_m->insert('profile_visit', $data_array);
				}
			}

			$user_id = $recv_id;
			$m_row = $this->member_lib->get_member($user_id);
			$data['pic_title'] = $m_row['m_nick']."의 프로필입니다. 좋은인연 만들어가보세요~";
			$my_profile = $data['my_profile'] = false; //타인의 프로필
		}
		$data['pic_data1'] = $this->member_profile_pic(1, $user_id, $my_profile, $m_row);
		$data['pic_data2'] = $this->member_profile_pic(2, $user_id, $my_profile, $m_row);
		$data['pic_data3'] = $this->member_profile_pic(3, $user_id, $my_profile, $m_row);
		
		$data['m_hptele'] = $m_row['m_hp1']."-".$m_row['m_hp2']."-".$m_row['m_hp3'];
		$data['m_mobile_chk'] = $m_row['m_mobile_chk'];		//휴대폰인증정보

		$data['u_info'] = $m_row; //프로필 회원 정보

		$navs = array('프로필','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/profile_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/main_v', $data);
		$this->load->view('bottom_v',@$bot_data);
	
	}

	//모바일 프로필
	function user_mobile(){

		//모바일 로그인 체크
		//user_check(null,0);

		$this->load->library('m_top_menu_lib');

		$data['recv_id'] = $recv_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id'));		//회원 아이디 받기

		if(empty($data['recv_id'])){
			$data['recv_id'] = $this->session->userdata['m_userid'];
		}
		
		if(IS_LOGIN && empty($recv_id)){
			
			//회원 자신의 프로필
			$user_id = $this->session->userdata['m_userid'];															//아이디 셋팅
			$data['member_data'] = $m_row = $this->member_lib->get_member($this->session->userdata['m_userid']);		//회원정보가져오기
			$my_profile = true;																							//본인 프로필 확인(true : 본인, false : 상대방)

		}else{
			
			//하루에 한번만 방문기록 남김
			$v_cnt = $this->my_m->cnt('profile_visit', array('user_id' => $recv_id, 'visit_user_id' => $this->session->userdata('m_userid'), 'ex_v_date' => "v_date like '".TODAY."%'"));
			if($v_cnt == 0){ 
				$data_array = array(
						'user_id' => $recv_id,
						'visit_user_id' => $this->session->userdata('m_userid'),
						'v_date' => NOW
					);
				$this->my_m->insert('profile_visit', $data_array);
			}


			//원하는 상대의 프로필 방문
			$user_id = $recv_id;																						//아이디 셋팅
			$data['member_data'] = $m_row = $this->member_lib->get_member($recv_id);									//회원정보가져오기
			$my_profile = false;																						//본인 프로필 확인(true : 본인, false : 상대방)

		}

		$data['user_pic1'] = $this->m_member_profile_pic('1', $user_id, $my_profile);	
		$data['user_pic2'] = $this->m_member_profile_pic('2', $user_id, $my_profile);	
		$data['user_pic3'] = $this->m_member_profile_pic('3', $user_id, $my_profile);	
		
		$top_data['add_css'] = array("/m/m_profile_css");
		$top_data['add_js'] = array("/m/m_profile_js", "profile/profile_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"프로필"); //탑메뉴 로딩

		$this->load->view('/m/m_top_v',$top_data);

		if(IS_LOGIN && empty($recv_id)){
			//자기 자신 프로필일때
			$this->load->view('/m/profile/m_profile_v', @$data);
		}else{
			//누군가의 프로필일때
			$this->load->view('/m/profile/m_profile_user_v', @$data);
		}

		$this->load->view('m/m_bottom0_v');

	}


	function member_profile_pic($num,$user_id,$my_profile,$m_row){
		//순서에 맞는 회원 프로필사진정보 가져오기
		$pic_row = $this->my_m->row_array('member_pic', array('user_id' => $user_id, 'pic_num' => $num));

		//내 사진이 아닐땐 인증완료된 사진만 or 내사진일때는 모든사진만 and  프로필 사진이 있을때
		if( ( (@$pic_row['pic_status'] == "인증완료" and !$my_profile)  or $my_profile )  and @$pic_row['idx'] ){
			//썸네일 만들기
			$m_pic = $this->member_lib->profile_thumb($num,$user_id,215,236);

			if($pic_row['pic_admin_memo'] and $my_profile){
				//관리자 인증 거절 사유
				$admin_text = "* <a href='javascript:alert(\"".$pic_row['pic_admin_memo']."\");' class='color_999'>".strcut_utf8($pic_row['pic_admin_memo'],19)."</a>";
			}else{
				$admin_text = "";
			}

			if($pic_row['pic_status'] == "인증대기"){$status_bg = "bg_9c9c9c";}else if($pic_row['pic_status'] == "인증거부"){$status_bg = "bg_42495c";}else if($pic_row['pic_status'] == "인증완료"){$status_bg = "bg_fb7f7f";}
			if($pic_row['is_main_pic'] == "y"){$is_main_pic = "on";}else{$is_main_pic = "off";}

			$str = '
					<div class="height_14">
						<img src="'.IMG_DIR.'/profile/main_num_'.$num.'.gif">
						<div class="float_right width_200 color_999 margin_top_mi_1 text-right">'.@$admin_text.'</a></div>
					</div>

					<div class="profile_pic">';
					
			if($my_profile){  //내 프로필일때만 인증상태 표시 보이기
				$str .= '
						<img src="'.IMG_DIR.'/profile/profile_pic_'.$is_main_pic.'.png" class="profile_on_pic">
						<div class="pic_label '.$status_bg.'">'.$pic_row['pic_status'].'</div>
				';
			}

				$str .= '
						<div class="text-center">
							<img src="'.$m_pic.'" >
						</div>
					</div>
				';		
			
			if($my_profile){ //내 프로필함 일때만 하단 버튼 보이기
				if($pic_row['pic_status'] == "인증완료" && $pic_row['is_main_pic'] != "y"){
					$str .= '
						<div class="delegate_box text-center margin_left_0">
							<input type="button" class="text_btn_de4949" value="대표사진 선택" onclick="set_my_pic('.$num.');">
							<input type="button" class="text_btn_ea3e3e" value="삭제" onclick="my_pic_delete('.$num.');">
						</div>
					';
				}else{
					$str .= '
						<div class="delegate_box text-center margin_left_0">
							<input type="button" class="text_btn_ea3e3e" value="삭제" onclick="pic_delete('.$num.');">
						</div>
					';
				}
			}

		//프로필 사진이 없을때
		}else{
				$str = '
					<div class="height_14">
						<img src="'.IMG_DIR.'/profile/main_num_'.$num.'.gif">
						<div class="float_right width_100 color_999 margin_top_mi_1"></div>
					</div>

					<div class="profile_pic">
						<img src="'.IMG_DIR.'/profile/profile_pic_off.png" class="profile_on_pic">';
				if($my_profile){ //내 프로필함 일때만 사진등록 아이콘 보이기
							$str .='						
						<div class="margin_top_93 text-center pointer">
						<img src="'.IMG_DIR.'/profile/profile_pic_none.png" onclick="pic_upload('.$num.');">
							';
				}else{	//상대방 프로필함 일때
							
							$str .=' <div class="text-center"> ';

							if($m_row['m_sex'] == 'M'){		//남자
								$str .='<div class="man_icon border_none" style="width:215px; height:236px;">
											<img src="'.IMG_DIR.'/meeting/man_ic.png" class="img_none_icon top_25per height_50per">
										</div>';
							}else{		//여자
								$str .='<div class="girl_icon border_none" style="width:215px; height:236px;">
											<img src="'.IMG_DIR.'/meeting/girl_ic.png" class="img_none_icon top_25per height_50per">
										</div>';
							}
				}
				$str .= '
						</div>
					</div>';
			if($my_profile){ //내 프로필함 일때만 하단버튼 보이기
				$str .= '
					<div class="delegate_box text-center margin_left_0">
						<input type="button" class="text_btn_de4949" value="사진 등록" onclick="pic_upload('.$num.');">
					</div>';		
			}

		}

		return $str;

	}

	//모바일 순서에 맞게 회원정보 프로필 사진 가져오기
	function m_member_profile_pic($pic_num, $user_id, $my_profile){
		
		//순서에 맞는 프로필 사진 데이터 가져오기
		$pic_row = $this->my_m->row_array('member_pic', array('user_id' => $user_id, 'pic_num' => $pic_num));

		if(empty($pic_row)){

			if(@$this->session->userdata['m_userid'] == $user_id){
				//해당 순서에 프로필 사진이 없을경우
				$add_html = "
					<div> 
						<img src='".IMG_DIR."/profile/profile_pic_off.png'>
						<img src='".IMG_DIR."/m/m_pic_add.gif' class='bg_fff' onclick='javascript:pic_upload(".$pic_num.");'>
					</div>
				";
			}else{
				$add_html = "
					<div>
						<img src='".IMG_DIR."/profile/profile_pic_off.png'>
						<img src='".IMG_DIR."/m/m_pic_add.gif' class='bg_fff'>
					</div>
					
				";

			}			

		}else{
			if($pic_row['is_main_pic'] == 'y'){
				$flg = "on";
				$display = "style='display:none;'";
			}else{
				$flg = "off";
				$display = "";
			}

			//프로필 사진 썸네일 만들기
			$m_pic = $this->member_lib->profile_thumb($pic_num, $user_id, 200, 200);
			
			$pic_status = "";		//인증 여부

			if($my_profile == true){
				//본인의 프로필인경우
				$pic_status = $pic_row['pic_status'];

				if($pic_status == "인증완료"){
					$btn_val = "
						<div class='margin_top_5'>
						<input type='button' class='text_btn_e5276d margin_top_5 border-radius_2' value='대표등록' onclick='javascript:set_my_pic(".$pic_num.");' 
						".$display."></div>
						<div class='margin_top_20'>
						<input type='button' class='text_btn_ea3e3e margin_top_3 border-radius_2' value='삭제' onclick='javascript:my_pic_delete(".$pic_num.");'>
						</div>
					";
				}else{
					$btn_val = "
						<div class='margin_top_5'>
						<input type='button' class='text_btn_e5276d margin_top_5 border-radius_2' value='".$pic_status."' disabled=disabled>
						</div>
						<div class='margin_top_20'>
						<input type='button' class='text_btn_ea3e3e margin_top_3 border-radius_2' value='삭제' onclick='javascript:pic_delete(".$pic_num.");'>
						</div>
					";
				}
				
				$add_html = "
					<div>
						<img src='".IMG_DIR."/profile/profile_pic_".$flg.".png'>
						<img src='".$m_pic."'>
					</div>
					".$btn_val."
					
				";
				
			}else{
				//상대방의 프로필인경우
				$add_html = "
					<div>
						<img src='".IMG_DIR."/profile/profile_pic_".$flg.".png'>
						<img src='".$m_pic."'>
					</div>
					
				";
			}
		}
		
		return $add_html;
	}

	function upload_pic_pop(){

		//프로필 사진업로드 레이어팝업 AJAX

		//로그인 여부 체크
		user_check(null,0);

		$data['num'] = $num = $this->security->xss_clean(url_explode($this->seg_exp, 'num')); if(!$num){exit;}

		$top_data['add_css'] = array("layer_popup/upload_pic_css");
		$top_data['add_js'] = array("layer_popup/upload_pic_js");
		$top_data['add_title'] = "사진 업로드";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/upload_pic_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//프로필 사진 업로드
	function upload_pic(){

		//로그인 여부 체크
		user_check(null,0);

		//프로필 사진업로드 시작
		$num =  $this->input->post('num',TRUE);

		$chk_pic = $this->my_m->row_array('member_pic', array('user_id' => $this->session->userdata['m_userid'], 'pic_num' => $num), 'idx', 'desc', '1');

		if(!empty($chk_pic)){

		}else{

			//업로드 경로 만들기
			$dir = $this->member_lib->make_thumb_dir( $this->session->userdata('m_userid') );

			$config['upload_path'] = $dir;
			$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
	//		$config['max_size']	= '1000';	//5메가로 상향
	//		$config['max_width']  = '2048';
	//		$config['max_height']  = '1536';
			$config['max_size']	= '5120';
			$config['max_width']  = '4096';
			$config['max_height']  = '4096';	
			
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload('user_upload_pic'))
			{
				echo strip_tags($this->upload->display_errors());
			}	
			else
			{
				//리턴값 file_name, file_pth, full_path
				$data = $this->upload->data();
				
				//사진 테이블에 인서트
				$arr_data = array(
						'user_id' => $this->session->userdata('m_userid'),
						'pic_file_name' => $data['full_path'],
						'pic_w_date' => NOW,
						'pic_status' => '인증대기',
						'pic_admin_memo' => '',
						'pic_num' => $num,
						'pic_admin_date' => NULL
				);

				$rtn = $this->my_m->insert("member_pic", $arr_data);
				echo $rtn; //인서트 성공

			}

		}

		

	}

	//프로필 사진 삭제
	function pic_remove(){

		//로그인 여부 체크
		user_check(null,0);

		$num = $this->security->xss_clean(url_explode($this->seg_exp, 'num')); if(!$num){exit;}

		//정보 불러오기
		$pic_row = $this->my_m->row_array('member_pic', array('user_id' => $this->session->userdata('m_userid'), 'pic_num' => $num));if(!$pic_row){exit;}

		//파일에서 삭제
		$this->member_lib->delete_thumb($pic_row['pic_file_name']);

		//대표사진일때 해제
		if($pic_row['is_main_pic'] == "y"){
			$this->my_m->update("TotalMembers", array("m_userid" => $this->session->userdata('m_userid')), array('m_filename' => ''));
		}

		//DB에서 삭제
		$rtn =	$this->my_m->del('member_pic', array("pic_num" => $num, "user_id" => $this->session->userdata('m_userid') ) );
		echo $rtn;
	}

	//프로필 대표사진으로 선택
	function set_my_pic(){
		//로그인 여부 체크
		user_check(null,0);

		$num = $this->security->xss_clean(url_explode($this->seg_exp, 'num')); if(!$num){exit;}

		//정보 불러오기
		$pic_row = $this->my_m->row_array('member_pic', array('user_id' => $this->session->userdata('m_userid'), 'pic_num' => $num));if(!$pic_row){exit;}

		//대표사진으로 설정
		$this->my_m->update("TotalMembers", array("m_userid" => $this->session->userdata('m_userid')), array('m_filename' => $pic_row['pic_file_name'],'m_filename_update' => NOW));

		//대표사진 모두 취소한 후
		$this->my_m->update("member_pic", array("user_id" => $this->session->userdata('m_userid')), array('is_main_pic' => ''));

		//대표사진으로 설정
		$rtn = $this->my_m->update("member_pic", array("user_id" => $this->session->userdata('m_userid'),'pic_num' => $num), array('is_main_pic ' => 'y'));
		echo $rtn;

		if($rtn == "1"){
			//대표사진 변경시 서로친구인 친구들에게 알림메시지 보내기 alrim_helper
			joyhunting_alrim_repetition('친구사진변경', $this->session->userdata['m_userid']);
		}


	}

	//모바일 프로필수정하기
	function m_profile_modi(){
		
		//모바일 로그인체크
		user_check(null,0);

		$my_intro		= strip_tags(rawurldecode($this->input->post('my_intro', true)));
		$m_reason		= rawurldecode($this->input->post('m_reason', true));
		$m_character	= rawurldecode($this->input->post('m_character', true));

		$arrData = array(
			"my_intro"			=> $my_intro,
			"m_reason"			=> $m_reason,
			"m_character"		=> $m_character
		);

		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $this->session->userdata['m_userid']), $arrData);

		if($rtn == "1"){
			echo "1";		//프로필 수정 성공
		}else{
			echo "0";		//프로필 수정 실패
		}	

	}


	function mobile_chk_pop(){

		$this->load->view('layer_popup/mobile_chk_pop_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}
	
	//메인페이지 테스트
		function test()
	{

		$data['recv_id'] = $recv_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); //회원 아이디 받기

		if(IS_LOGIN and !$recv_id){
			//내프로필
			$user_id = $this->session->userdata('m_userid');
			$m_row = $this->member_lib->get_member($user_id);
			$data['pic_title'] = $m_row['m_nick']."님! 오늘도 좋은 인연과 함께 행복한 하루되세요~";
			$my_profile = $data['my_profile'] = true; //내 프로필인가
			
			if($m_row['m_mobile_chk'] != '1'){	
				$bot_data['add_script'] ="
					<script>
					mobile_chk_pop();
					</script>
				";
			}

		}else{
			//상대방 프로필이거나, 데모아이디 프로필
			if(!$recv_id){

				$rand_mb = $this->my_m->result_array('TotalMembers', array('m_special' => '1'));
				shuffle($rand_mb);
				$recv_id = $rand_mb[0]['m_userid']; //데모아이디

			}else if(IS_LOGIN){
				//데모 아이디 아닐경우 내 프로필 방문자 DB인서트
				//하루에 한번만 방문기록 남김
				$v_cnt = $this->my_m->cnt('profile_visit', array('user_id' => $recv_id, 'visit_user_id' => $this->session->userdata('m_userid'), 'ex_v_date' => "v_date like '".TODAY."%'"));
				if($v_cnt == 0){ 
				$data_array = array(
						'user_id' => $recv_id,
						'visit_user_id' => $this->session->userdata('m_userid'),
						'v_date' => NOW
					);
				$this->my_m->insert('profile_visit', $data_array);
				}
			}

			$user_id = $recv_id;
			$m_row = $this->member_lib->get_member($user_id);
			$data['pic_title'] = $m_row['m_nick']."의 프로필입니다. 좋은인연 만들어가보세요~";
			$my_profile = $data['my_profile'] = false; //타인의 프로필
		}
		$data['pic_data1'] = $this->member_profile_pic(1, $user_id, $my_profile, $m_row);
		$data['pic_data2'] = $this->member_profile_pic(2, $user_id, $my_profile, $m_row);
		$data['pic_data3'] = $this->member_profile_pic(3, $user_id, $my_profile, $m_row);
		
		$data['m_hptele'] = $m_row['m_hp1']."-".$m_row['m_hp2']."-".$m_row['m_hp3'];
		$data['m_mobile_chk'] = $m_row['m_mobile_chk'];		//휴대폰인증정보

		$data['u_info'] = $m_row; //프로필 회원 정보

		$navs = array('프로필','메인'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/profile_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/main_test_v', $data);
		$this->load->view('bottom_v',@$bot_data);
	
	}
	

	//회원 프로필 사진보기 레이어팝업 ajax
	function member_photo_view_layer(){

		$user_id	= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'user_id')));
		$view		= rawurldecode($this->security->xss_clean(url_explode($this->seg_exp, 'view')));

		if(empty($user_id)){ echo "1000"; exit; }		//잘못된접근
		if(empty($view)){ $view = "580"; }

		//회원정보 가져오기
		$mdata = $this->member_lib->get_member($user_id);
		if(empty($mdata)){ echo "1000"; exit; }			//잘못된접근
		
		//회원의 인증완료된 이미지 가져오기
		$img_list = $this->my_m->result_array('member_pic', array('user_id' => $mdata['m_userid'], 'pic_status' => '인증완료'), 'pic_num', 'asc');
		
		//인증사진이 없는경우 프로필 보기로 이동
		if(count($img_list) == "0"){ echo "1001"; exit; }		//인증사진이 없는경우
		
		//회원 사진썸네일 가져오기
		$i=1;
		foreach($img_list as $list){
			
			//이미지 리사이즈
			$img_size = $this->member_lib->img_resize_only($list['pic_file_name'], $view, $view);

			//프로필 이미지 리사이즈 상태로 썸네일만들기
			$data['member_img_'.$i] = $this->member_lib->profile_thumb($list['pic_num'], $mdata['m_userid'], $img_size[0], $img_size[1]);
			
			//원본이미지의 사이즈가 팝업 이미지 보다 작을경우 팝업사이즈에 이미지 맞추기 변수
			if($view > $img_size[0] and $view > $img_size[1]){
				$data['img_chk_'.$i] = "1";
			}else{

				//이미지의 가로사이즈가 더 클경우 해당이미지의 세로 가운데 셋팅 margin_top 계산
				if($img_size[0] > $img_size[1]){
					$margin_top = ($view-$img_size[1])/2;
					$data['img_margin_'.$i] = "style='margin-top:".$margin_top."px;'";
				}

			}			

			$i++;
		}
		
		$data['list_cnt']	= count($img_list);		//등록이미지 총갯수
		$data['v_width']	= $view;				//이미지필드 width값
		$data['v_height']	= $view+50;				//이미지필드 height값

		if(IS_MOBILE){
			$data['v_top'] = ($view-50)/2;			//prev, next 버튼 absolute top값 계산
		}else{
			$data['v_top'] = ($view-80)/2;			//prev, next 버튼 absolute top값 계산
		}

		$top_data['add_css'] = array("layer_popup/member_photo_view_css");
		$top_data['add_js'] = array("jquery.touchSlider", "layer_popup/member_photo_view_js");
		$top_data['add_title'] = $mdata['m_nick'];
		$top_data['add_text'] = "";
		
		$this->load->view('layer_popup/popup_top2_v', $top_data);
		$this->load->view('layer_popup/member_photo_view_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

}

/* End of file main.php */
/* Location: ./application/controllers/ */