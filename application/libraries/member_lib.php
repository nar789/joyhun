<?php 
/*place this in libraries folder*/ 
class Member_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	//회원정보 가져오기
	function get_member($user_id){

		//회원정보 하나 불러오기

		if(empty($user_id)){goto("/");exit;} //totalmembers 슬로우 쿼리 방지

		$data = $this->ci->my_m->row_array('TotalMembers', array('m_userid' => $user_id) );

		return $data;

	}

	//탈퇴회원정보 가져오기
	function get_member_out($user_id){

		//회원정보 하나 불러오기

		if(empty($user_id)){goto("/");exit;} //totalmembers 슬로우 쿼리 방지

		$data = $this->ci->my_m->row_array('TotalMembers_out', array('m_userid' => $user_id) );

		return $data;

	}
	
	//휴면계정 정보가져오기
	function get_member_old($user_id){

		//회원정보 하나 불러오기

		if(empty($user_id)){goto("/");exit;} //totalmembers 슬로우 쿼리 방지

		$data = $this->ci->my_m->row_array('TotalMembers_old', array('m_userid' => $user_id) );

		return $data;

	}

	//대표사진 썸네일 불러오기
	function member_thumb($user_id,$width = 130,$height = 162, $mode = "TotalMembers" ){
		
		if(empty($user_id)){return "";}

		if($mode == "TotalMembers_old"){
			$member = $this->get_member_old($user_id);
		}else if($mode == "TotalMembers_out"){
			$member = $this->get_member_out($user_id);
		}else{
			$member = $this->get_member($user_id);
		}

		$ori_file = UPLOAD_ROOT."/member_pic/".$member['m_filename']; //구경로 원본파일

		if(!is_file($ori_file)){
			//신경로 한번더 검색
			$ori_file = $member['m_filename']; //원본파일
		}

		if($member['m_userid']  and is_file($ori_file)){  //업로드 파일이 있을때

			$thumb_dir = $this->make_thumb_dir($user_id); //썸네일 디렉토리 만들기

			$tmp = explode("/",$member['m_filename']);
			$new_name = $tmp[count($tmp)-1].".".$width."x".$height.".jpg"; //새로운 파일이름 jpg
			$thumb_file = $thumb_dir."/".$new_name;

			if(!is_file($thumb_file)){
				$this->make_thumb_image($ori_file,$thumb_dir,$width,$height,$new_name); //썸네일 만들기
			}
			
			$thumb_file_dir = BASE_URL.str_replace("/home/joyhunting/www","",$thumb_file);

			if(IS_MOBILE == true){
				return "<img src='$thumb_file_dir'>";
			}else{
				return "<img src='$thumb_file_dir'>";
			}		

		}else{  //업로드 파일이 없을때
			
			if(IS_MOBILE == true){
				//모바일버전일경우
				if($member['m_sex'] == "M"){
					return "<img src='".IMG_DIR."/m/m_man_ic.png'>";
				}else{
					return "<img src='".IMG_DIR."/m/m_girl_ic.png'>";
				}

			}else{
				//PC버전일경우
				if($member['m_sex'] == "M"){
					return "<div class='man_icon' style='width:".$width."px; height:".$height."px;'><img src='".IMG_DIR."/meeting/man_ic.png' class='img_none_icon'></div>";
				}else{
					return "<div class='girl_icon' style='width:".$width."px; height:".$height."px;'><img src='".IMG_DIR."/meeting/girl_ic.png' class='img_none_icon'></div>";
				}
			}
			
		}

	}

	
	function make_thumb_dir($user_id){
		$depth1 = UPLOAD_ROOT."/thumb/".substr($user_id,0,2);
		if(!is_dir($depth1) ){	mkdir($depth1); }

		$depth2 = $depth1."/".substr($user_id,0,4);
		if(!is_dir($depth2) ){	mkdir($depth2); }

		$depth3 = $depth2."/".$user_id;
		if(!is_dir($depth3) ){	mkdir($depth3); }
		
		return $depth3;
	}

	function make_thumb_image($ori_file, $thumbnail_path,$width,$height,$img_name){

	    list($img_width,$img_height, $type) = getimagesize($ori_file);
		if ($type!=1 && $type!=2 && $type!=3 && $type!=15) return;
		if ($type==1) $img_sour = imagecreatefromgif($ori_file);
		else if ($type==2 ) $img_sour = imagecreatefromjpeg($ori_file);
		else if ($type==3 ) $img_sour = imagecreatefrompng($ori_file);
		else if ($type==15) $img_sour = imagecreatefromwbmp($ori_file);

		$img_dest = imagecreatetruecolor($width,$height); 
		imagecopyresampled($img_dest, $img_sour,0,0,0,0,$width,$height,$img_width,$img_height); 
		$img_last = imagecreatetruecolor($width,$height); 
		imagecopy($img_last,$img_dest,0,0,0,0,$width,$height);
		imagedestroy($img_dest);

		imagejpeg($img_last, $thumbnail_path."/".$img_name, 100);
		imagedestroy($img_last);

	}

	//프로필 사진 1,2,3번 가져오기
	function profile_thumb($num,$user_id,$width = 215,$height = 236){
		
		$member = $this->get_member($user_id);
		
		//휴면계정 데이터 조회
		if(empty($member)){
			$member = $this->get_member_old($user_id);
		}

		//탈퇴회원일 경우
		if(empty($member)){
			$member = $this->get_member_out($user_id);
		}
		
		$m_pic = $this->ci->my_m->row_array('member_pic', array('user_id' => $user_id, 'pic_num' => $num));
		$ori_file = @$m_pic['pic_file_name']; //원본파일

		//인증대기 도는 인증거부일때
		if($m_pic['pic_status'] <> '인증완료'){

			if(IS_MOBILE){ $view_flag = "m"; }else{ $view_flag = "p"; }
			if($m_pic['pic_status'] == '인증대기'){ $pic_gubn = "wait"; }else{ $pic_gubn = "reject"; }
			
			if(empty($this->ci->session->userdata['userid'])){
				$ori_file = "./images/profile/profile_pic_".$pic_gubn."_".$view_flag.".png";
			}
			
		}
		
		if($member['m_userid']  and is_file($ori_file)){  //업로드 파일이 있을때
			
			$thumb_dir = $this->make_thumb_dir($user_id); //썸네일 디렉토리 만들기

			$tmp = explode("/",$ori_file);
			$new_name = $tmp[count($tmp)-1].".".$width."x".$height.".jpg"; //새로운 파일이름 jpg
			$thumb_file = $thumb_dir."/".$new_name;

			if(!is_file($thumb_file)){
				$this->make_thumb_image($ori_file,$thumb_dir,$width,$height,$new_name); //썸네일 만들기
			}
			
			$thumb_file_dir = str_replace("/home/joyhunting/www","",$thumb_file);

			return $thumb_file_dir;

		}else{  //업로드 파일이 없을때 추후 필요시 개발

			
		}

	}

	

	//경로로 해당 파일 찾아지우기
	function delete_thumb($full_file_name){
		$tmp = explode("/",$full_file_name);
		$file_name =  $tmp[count($tmp)-1]; //파일이름
		$file_dir =  str_replace($file_name,"",$full_file_name); //파일 경로

		$handle = @opendir($file_dir); //디렉토리 열기

		if (is_dir($file_dir)) {
			while(false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if(substr($file,0,strlen($file_name)) == $file_name){
						unlink($file_dir.$file);
					}
				}
			}
		}

		@closedir($handle);

	}

	
	//패스워드 확인(회원)
	function password_check($passwd, $userid = null){
		
		if(empty($userid)){$userid = $this->ci->session->userdata('m_userid');}

		require_once(LIB_ROOT.'phpass-0.1/PasswordHash.php');

		$hasher = new PasswordHash(8, false);

		$mem = $this->get_member($userid);

		if ($hasher->CheckPassword($passwd, $mem['m_pwd'])) {		// password ok
			return true;
		}else{
			return false;
		}

	}

	//패스워드 확인(임시회원)
	function reg_password_check($passwd, $userid = null){
		
		if(empty($userid)){
			goto('/main/start');
		}

		require_once(LIB_ROOT.'phpass-0.1/PasswordHash.php');

		$hasher = new PasswordHash(8, false);

		$mem = $this->ci->my_m->row_array('reg_member', array('userid' => $userid));

		if ($hasher->CheckPassword($passwd, $mem['pwd'])) {		// password ok
			return true;
		}else{
			return false;
		}

	}

	//성별 심볼
	function s_symbol($m_sex){
		if($m_sex == "M"){ return '<span class="color_8a98f0 font_900">&#9794;</span>'; }
		if($m_sex == "F"){ return '<span class="color_f08a8e font_900">&#9792;</span>'; }
	}


	//회원 로그인시 로그 기록 저장
	//로그인 기록은 최대 2000개까지만 저장
	function total_members_log($userid, $super_gubn = null){

		$member_data = $this->get_member($userid);		//회원정보가져오기

		//m_special이 1 또는 2인 경우 return(나중에 뺄수도 있음)
		//if($member_data['m_special'] == "1" or $member_data['m_special'] == "2"){ return; }

		$max_cnt = $this->ci->my_m->cnt('TotalMembers_login', @$search_val);		//로그인기록 총갯수
		
		//로그인 로그 기록이 2000개 이상일 경우 m_num이 제일 작은 기록 삭제
		if($max_cnt >= "2000"){
			$m_min = $this->ci->db->select('MIN(m_num) AS minimum')->from('TotalMembers_login')->get();
			$m_del_min = $this->ci->my_m->del('TotalMembers_login', array('m_num' => $m_min->row()->minimum));
		}
		
		$m_cnt = $this->ci->my_m->cnt('TotalMembers_login', array('m_userid' => $member_data['m_userid']));		//본인의 로그인기록 저장여부
		
		$m_maxnum = $this->ci->db->select('CASE WHEN ISNULL(MAX(m_num)) THEN 1 ELSE MAX(m_num)+1 END AS maxnum', false)->from('TotalMembers_login')->get();			//m_num의 max값 +1
		
		if($super_gubn == "super"){
			//슈퍼채팅용
			$last_login_day = date("Y-m-d H:i:s", strtotime(NOW. "-1 day"));
		}else{
			$last_login_day = $member_data['last_login_day'];
		}

		//로그기록 arrData
		$arrData = array(
			'm_num'				=> $m_maxnum->row()->maxnum,
			'm_userid'			=> $member_data['m_userid'],
			'm_name'			=> $member_data['m_name'],
			'm_nick'			=> $member_data['m_nick'],
			'm_jumin1'			=> $member_data['m_jumin1'],
			'm_jumin2'			=> $member_data['m_jumin2'],
			'm_age'				=> $member_data['m_age'],
			'm_age2'			=> $member_data['m_age2'],
			'm_sex'				=> $member_data['m_sex'],
			'm_post1'			=> $member_data['m_post1'],
			'm_post2'			=> $member_data['m_post2'],
			'm_addr1'			=> $member_data['m_addr1'],
			'm_addr2'			=> $member_data['m_addr2'],
			'm_hp1'				=> $member_data['m_hp1'],
			'm_hp2'				=> $member_data['m_hp2'],
			'm_hp3'				=> $member_data['m_hp3'],
			'm_mail'			=> $member_data['m_mail'],
			'm_reason'			=> $member_data['m_reason'],
			'm_file'			=> $member_data['m_file'],
			'm_filename'		=> $member_data['m_filename'],
			'm_filename_update'	=> $member_data['m_filename_update'],
			'm_popularity'		=> $member_data['m_popularity'],
			'm_in_date'			=> $member_data['m_in_date'],
			'm_instyle'			=> $member_data['m_instyle'],
			'm_outstyle'		=> $member_data['m_outstyle'],
			'm_character'		=> $member_data['m_character'],
			'm_conregion'		=> $member_data['m_conregion'],
			'm_conregion2'		=> $member_data['m_conregion2'],
			'm_conregion3'		=> $member_data['m_conregion3'],
			'last_login_day'	=> $last_login_day,
			'my_intro'			=> $member_data['my_intro'],
			'm_main_chu'		=> $member_data['m_main_chu'],
			'm_main_chu_date'	=> $member_data['m_main_chu_date'],
			'm_nick_chk'		=> $member_data['m_nick_chk'], 
			'm_type'			=> $member_data['m_type'],
			'm_partner'			=> $member_data['m_partner'],
			'm_partner_code'	=> $member_data['m_partner_code']

		);

		if($m_cnt == "0"){
			//로그 기록이 없을경우
			$m_rtn = $this->ci->my_m->insert('TotalMembers_login', $arrData);		//로그인 기록저장
		}else{
			//로그 기록이 있을경우
			$TM_login_delete = $this->ci->my_m->del('TotalMembers_login', array('m_userid' => $member_data['m_userid']));		//기존의 로그기록 삭제
			$m_rtn = $this->ci->my_m->insert('TotalMembers_login', $arrData);		//로그인 기록저장
		}

		//회원 로그인 기록 저장 latest_helper
		user_login_log('login', $userid);

		return $m_rtn;
	}


	function login_punish_check($userid){

		$search['user_id'] = $userid;

		$rtn = $this->ci->my_m->cnt('Police_punish', $search);
		
		// 처벌내역없으면 로그인
		if($rtn == 0){
			return "777";

		// 처벌내역있으면
		}else{
			$check_punish = $this->ci->my_m->row_array('Police_punish', $search, 'p_idx');

			// 경고
			if ($check_punish['p_card'] == '1'){

				$search['p_cancel'] = "0000-00-00 00:00:00";
				$rtn_check = $this->ci->my_m->cnt('Police_punish', $search);

				// 중복값 검사
				if ($rtn_check == 0){
						return "777";
				}else{
					
					$last_chk['user_id'] = $userid;
					$last_chk['ex_pdate'] = "p_date <= '".NOW."'";
					$last_chk['ex_pcancel'] = "p_cancel >= '".NOW."'";

					$rtn_check = $this->ci->my_m->cnt('Police_punish', $last_chk);

					//기간이 지났으면
					if ($rtn_check == 0){
						return "777";
					}else{
						return "1";
					}
				}


			// 영구정지
			}else if ($check_punish['p_card'] == '5'){
				return "5";
			// 화이트,옐로,레드카드
			}else{
				$search['ex_pdate'] = "p_date <= '".NOW."'";
				$search['ex_pcancel'] = "p_cancel >= '".NOW."'";

				$rtn_check = $this->ci->my_m->cnt('Police_punish', $search);

				//기간이 지났으면
				if ($rtn_check == 0){
					return "777";
				}else{
					return "3";
				}
			}
		}
		
	}


	//본인인증, 비밀번호 변경한 휴면계정 회원테이블로 이동
	function old_member_new($user_id){
		
		$old_member = $this->ci->my_m->row_array('TotalMembers_old', array('m_userid' => $user_id), 'm_num', 'desc', '1');


		if(!empty($old_member)){
			
			$sql = "";
			$sql .= " insert TotalMembers ";
			$sql .= " select * ";
			$sql .= " from TotalMembers_old ";
			$sql .= " where m_userid = '".$old_member['m_userid']."' ";
			
			$rtn = $this->ci->db->query($sql);

			if($rtn == "1"){
				$this->ci->my_m->del('TotalMembers_old', array('m_userid' => $old_member['m_userid']));
			}

		}else{
			$rtn = "0";
		}

		return $rtn;

	}


	//특별아이디 자동로그인
	function login_special_member(){
		//특별아이디 불러오기
		$strSQL = "select * from TotalMembers where m_special = '1' order by rand() limit 1";
		$query = $this->ci->db->query($strSQL);
		$row = $query->row_array();

		//데이타 인서트
		$this->total_members_log($row['m_userid']);

	}


	//사진 비율대로 사이즈 줄이기(이미지경로, 최대가로값, 최대세로값)
	function img_resize_only($img_path, $maxwidth = "400", $maxheight = "400"){

		$imgsize = getimagesize($img_path);
		
		if($imgsize[0]>$maxwidth || $imgsize[1]>$maxheight) { 
			
			//가로길이가 가로limit값보다 크거나 세로길이가 세로limit보다 클경우 
			$sumw = (100*$maxheight)/$imgsize[1]; 
			$sumh = (100*$maxwidth)/$imgsize[0]; 

			if($sumw < $sumh){ 
				//가로가 세로보다 클경우 
				$img_width = ceil(($imgsize[0]*$sumw)/100); 
				$img_height = $maxheight; 
			}else{ 
				//세로가 가로보다 클경우 
				$img_height = ceil(($imgsize[1]*$sumh)/100); 
				$img_width = $maxwidth; 
			} 
		}else{ 
			// limit보다 크지 않는 경우는 원본 사이즈 그대로
			$img_width = $imgsize[0]; 
			$img_height = $imgsize[1]; 
		} 

		$imgsize[0] = $img_width;
		$imgsize[1] = $img_height;
		
		return $imgsize;
	}



}
?>
