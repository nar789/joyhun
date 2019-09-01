<?php

class Music_chat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('code_change_helper');
		$this->load->model('music_chat_m');
		$this->load->library('member_lib');
	}	

	function test(){
		echo urlencode(base64_encode("songi1634"));
	}

	function musicchat_info(){

			//음악채팅 로그인시 회원 데이터 리턴
			//기존 118번서버 /include/xml/MusicChat_info.asp
			//http://joyhunting.net/etc/music_chat/musicchat_info/userid/c29uZ2kxNjM0

			//echo urlencode(base64_encode("wwkorea1030"))."<br>";
			//Echo urlencode(base64_encode("qlqjs"));

			$userid = base64_decode(urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid'))));

	//		$passwd = urldecode(base64_decode($this->security->xss_clean(@url_explode($this->seg_exp, 'passwd'))));

			header ("Content-Type:text/xml");
			echo '<?xml version="1.0" encoding="euc-kr"?>
			';

//			if(empty($userid) or empty($passwd)){
			if(empty($userid) ){
				echo iconv("utf-8","euc-kr","<userInfo>
							<err_code>001</err_code>
							<err_text>변수가 부족합니다.</err_text>
						</userInfo>
				");
				exit;
			}

			//아이디, 비밀번호 검사
			/*
			if(@$this->member_lib->password_check($passwd, $userid) == false){

				//비밀번호 틀린횟수 체크
				$before = date("Y-m-d H:i:s", strtotime(NOW." -5 min"));

				$cnt = $this->my_m->cnt('music_login_log', array('user_id' => $userid, 'ex_date' => "log_time > '$before'"));
				if($cnt >= 9){
					echo iconv("utf-8","euc-kr","<userInfo>
								<err_code>002</err_code>
								<err_text>비밀번호를 10회이상 틀리셨습니다. 5분후 다시 시도해주세요.</err_text>
							</userInfo>
					");
					exit;
				}


				//로그인 시도 인서트
				$this->my_m->insert('music_login_log', array('user_id' => $userid, 'user_ip' => $this->input->ip_address(), 'log_time' => NOW) );

				echo iconv("utf-8","euc-kr","<userInfo>
							<err_code>003</err_code>
							<err_text>비밀번호가 일치하지 않습니다.</err_text>
						</userInfo>
				");
				exit;				
			}
			*/

			//회원정보 가져오기

			$search['m_userid'] = $userid;
			$m_data = $this->my_m->row_array('TotalMembers', $search);

			$m_userid	= $m_data["m_userid"];
			$m_nick		= Trim($m_data["m_nick"]);
			$m_avata		= $m_data["m_avataid"];
			$m_age		= $m_data["m_age"];
			$m_sex		= $m_data["m_sex"];

			$tmp = explode(" ", $m_data["m_conregion"]);
			$m_c			= Trim($tmp[0]);
			
			$tmp2 = explode(" ", $m_data["m_conregion2"]);
			$m_c2		= Trim($tmp2[0]);
			$m_filename		= $m_data["m_filename"];

			//아이템 모두 사용중으로 설정
			$RealCode = "010006,010007,010002,010004,010009,010005,010010";

			//회원 대표사진 검사
			if(empty($m_filename)){
				$file_chk = 0;
			}else{
				$file_chk = 1;
			}

			//성별
			If($m_sex=="M"){
				$m_sex ="1";
				$m_char = "0";
			}else{
				$m_sex ="2";
				$m_char = "5";
			}

			//지역 1
			If (empty($m_c)){
				$m_c = "서울";
			}

			//지역 2
			If (empty($m_c2)){
				$m_c2 = "강남구";
			}
			
			//지역 재조합
			$m_c4 = str_replace(" ", "",$m_c.$m_c2);

			//휴대전화 인증여부 확인 (기존 t_060wom_cut) 추후 작업필요
			$hp_auth = 1;
			
			//아바타 설정 - 기본 아바타로 모두 되돌림
			If ($m_sex == "1"){
				$m_smallavata = "/images/music_chat/ic_boy_black.gif";
			}else{
				$m_smallavata = "/images/music_chat/ic_girl_pink.gif";
			}

			$m_nick		= str_replace("&gt;",">",$m_nick);
			$m_nick		= str_replace("&lt;","<",$m_nick);

			$m_c4		= str_replace("&gt;",">",$m_c4);
			$m_c4		= str_replace("&lt;","<",$m_c4);

			$xmlStr =  "nick=".$m_nick."&avataPath=".$m_smallavata."&age=".$m_age."&sex=".$m_sex."&region=".$m_c4."&iteminfo=".$RealCode."&CharInfo=".$m_char."&MyPic=".$file_chk."&auth_hp=".$hp_auth;

			$xmlStr = iconv("utf-8","euc-kr",$xmlStr);

			$xmlArr = explode("&",$xmlStr);
			
			//비밀번호 입력횟수 초기화
			$this->my_m->del('music_login_log', array('user_id' => $userid));

			echo "<userInfo>";

			For($i=0;$i < count($xmlArr);$i++){
				$listStr = $xmlArr[$i];
				$listArr = explode("=",$listStr);
				echo "
					<".$listArr[0].">
						$listArr[1]
					</".$listArr[0].">";
			}
			
			echo "</userInfo>";

	}

	function camchat_photoview(){
		//프로필에서 사진보기
		//http://www.joyhunting.com/etc/music_chat/camchat_photoview/userid/songi1634
		$this->show_pic('110x150');

	}
	
	function facechat_plus(){
		//채팅 내용
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/facechat_plus.asp
		// http://www.joyhunting.net/etc/music_chat/facechat_plus
		//음악채팅은 ANSI 사용

		$data['chatid']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'chatid')));

		if(empty($data['chatid'])){exit;}

		$this->load->view('music_chat/facechat_plus_v',@$data);
		
	}

	function showintro(){
		//자기소개 보기
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/showintro.asp?userid=wwkorea1030
		// http://www.joyhunting.net/etc/music_chat/showintro/userid/wwkorea1030

		$userid    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));
		$exp    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'exp')));

		if(empty($userid)){exit;}
		
		$data = $this->my_m->row_array("TotalMembers", array('m_userid' => $userid) );

		$data['m_name'] = iconv("utf-8","euc-kr",$data['m_name']);
		
		if($data['m_sex'] == "M"){$data['m_sex'] = "남";}else{$data['m_sex'] = "여";}
		$data['m_sex'] = iconv("utf-8","euc-kr",$data['m_sex']);

		$data['exp'] = $exp;

		$this->load->view('music_chat/showintro_v',@$data);

	}

	function facechat_introduce(){
		//자기소개하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/facechat_introduce.asp?userid=wwkorea1030&exp=test123&r_nickname=test
		// http://www.joyhunting.net/etc/music_chat/facechat_introduce/userid/wwkorea1030/exp/test123/r_nickname/test

		$userid   = $data['userid']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));
		$content   = $data['content'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'exp')));
		$r_nickname  = $data['r_nickname']   = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'R_nickname')));

		if(empty($userid)){exit;}

		$r_nickname = str_replace(";np","&",$r_nickname);
		$r_nickname = str_replace(";aps","\'",$r_nickname);
		$r_nickname = str_replace(";ws","\\",$r_nickname);
		$r_nickname = str_replace(";sp","#",$r_nickname);
		$r_nickname = str_replace(";pl","+",$r_nickname);
		$r_nickname = str_replace(";mn","-",$r_nickname);

		$content = str_replace(";sp","#",$content);
		$content = str_replace(";aps","\'",$content);
		$content = str_replace(";np","&",$content);
		$content = str_replace(";pl","+",$content);
		$content = str_replace(";mn","-",$content);

		$data = $this->my_m->row_array("TotalMembers", array('m_userid' => $userid) );

		$data['m_nick'] =iconv("utf-8","euc-kr", $data['m_nick']);
		$data['m_age'] = $data['m_age'];
		$data['m_sex'] = $data['m_sex'];
		If ($data['m_sex'] == "M"){
			$data['sex_value'] = iconv("utf-8","euc-kr","남자"); 
		}else{
			$data['sex_value'] =  iconv("utf-8","euc-kr","여자"); 
		}

		$data['m_reason'] = iconv("utf-8","euc-kr",want_reason_data($data['m_reason']));
		$data['m_character'] = iconv("utf-8","euc-kr",talk_style_data($data['m_character']));

		$data['content'] = iconv("utf-8","euc-kr",$content);
		$data['r_nickname'] = iconv("utf-8","euc-kr",$r_nickname);

		$this->load->view('music_chat/facechat_introduce_v',@$data);

	}

	function showintro_pic(){
		//내 프로필 사진 리스트
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/showintro_pic.asp?userid=youclub
		//http://www.joyhunting.net/etc/music_chat/showintro_pic/userid/wwkorea1030

		$userid  = $data['userid']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));
		if(empty($userid)){exit;}

		$data['pic_row'] = $this->my_m->result_array('member_pic', array('user_id' => $userid, 'pic_status' => '인증완료'));

		$data['getTotalData'] = $this->my_m->cnt('member_pic', array('user_id' => $userid, 'pic_status' => '인증완료'));

		$this->load->view('music_chat/showintro_pic_v',@$data);

	}

	function avata_view_chat(){
		//내 사진 띄우기
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/avata_view_chat.asp?filename=경로&order=pic
		//http://www.joyhunting.net/etc/music_chat/avata_view_chat/filename/wwkorea1030

		$order  = $data['order']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'order')));
		$m_avataid  = $data['m_avataid']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'avataid')));		

		$seg_exp = implode("/",$this->seg_exp);
		$tmp = explode("filename", $seg_exp);
		
		$p_filename  = $data['p_filename']  = $tmp[1];

		$this->load->view('music_chat/avata_view_chat_v',@$data);

	}

	function show_pic($mode = null){
		//내 프로필 사진 보이기
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/camchat_jjokji_2.asp?myid=Y&widimg=160&charid=0&userid=wwkorea1030
		//http://www.joyhunting.net/etc/music_chat/show_pic/userid/wwkorea1030/myid/Y/widimg/160/charid/0

		$userid  = $data['userid']   = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));
		if(empty($userid)){exit;}
		$myid  = $data['myid']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));			//내 이미지인가?
		$wid_img  = $data['widimg']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'widimg')));		//이미지 가로길이
		$charid  = $data['charid']  = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'charid')));		//기존 아바타 번호

		if(empty($charid)){
			$charid = 1;
		}
		
		if($mode == "110x150"){
			$data['width_val'] = 110;
			$data['height_val'] = 150;
		}else If($wid_img == "352" || $wid_img == "352"){
			$data['width_val'] = 352;
			$data['height_val'] = 285;
		}else{
			$data['width_val'] = 160;
			$data['height_val'] = 120;
		}

		$member_pic = @$this->member_lib->member_thumb($userid,$data['width_val'],$data['height_val']);

		$charid_num = $charid;

		if(strpos($member_pic, "man_icon") > 0){
			$member_pic = "<img src='".IMG_DIR."/music_chat/m_chat/new_img/character_m0".$charid_num."_a.gif' width='".$data['width_val']."'  width='".$data['height_val']."'>";
		}

		if(strpos($member_pic, "girl_icon") > 0){
			$member_pic = "<img src='".IMG_DIR."/music_chat/m_chat/new_img/character_f0".$charid_num."_a.gif'>";
		}

		$data['member_pic'] = $member_pic;

		$this->load->view('music_chat/show_pic_v',@$data);

	}

	function chat_item_new(){
		//아이템 구입 - 리스트
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/chat_item_new.asp?myid=wwkorea1030
		//http://www.joyhunting.net/etc/music_chat/chat_item_new/userid/wwkorea1030
		$userid  = $data['userid']   = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));

		$this->load->view('music_chat/chat_item_new_v',@$data);

	}

	function mchat_item_buy(){
		//아이템 구입 - 상세보기
		//기존 118번 서버 http://www.joyhunting.com/item_mall/mchat_item_buy.asp?myid=wwkorea1030&i_id=28
		//http://www.joyhunting.net/etc/music_chat/mchat_item_buy/userid/wwkorea1030
		$myid    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));
		$i_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'i_id')));

		switch ($i_id) {

				case 28  : 
					$data['title'] = iconv("utf-8","euc-kr","이성작업방");
					$data['str'] = iconv("utf-8","euc-kr","내가 만든 채팅방에 오직 <FONT color=#ff4800><STRONG>이성만 입장</STRONG></FONT>할 수 있게 해주는 아이템 입니다.");
					$data['img'] = "othersex_room.gif";
					break;
				case 29  : 
					$data['title'] = iconv("utf-8","euc-kr","방제목꾸미기");
					$data['str'] = iconv("utf-8","euc-kr","여러채팅방중에 <FONT color=#ff4800><STRONG>내방제목을 눈에 확 띄게 </STRONG></FONT>꾸며드립니다.");
					$data['img'] = "room_name.gif";
					break;
				case 8  : 
					$data['title'] = iconv("utf-8","euc-kr","채팅 아이디 숨기기");
					$data['str'] = iconv("utf-8","euc-kr","채팅방에 <FONT color=#ff4800><STRONG>본인의 ID</STRONG></FONT>와 개인정보를 숨기고 <FONT color=#ff4800><STRONG>비공개</STRONG></FONT>로 입장 가능한 아이템");
					$data['img'] = "item_img01.gif";
					break;
				case 26  : 
					$data['title'] = iconv("utf-8","euc-kr","비밀방");
					$data['str'] = iconv("utf-8","euc-kr","내가 만든 채팅방을 비공개로 개설하는 아이템입니다.남들이 들어오지 못하는 <FONT color=#ff4800><STRONG>나만의 비밀채팅방</STRONG></FONT>을 만들어 보세요");
					$data['img'] = "secret_room.gif";
					break;
				case 31  : 
					$data['title'] = iconv("utf-8","euc-kr","이모티콘자유이용");
					$data['str'] = iconv("utf-8","euc-kr","채팅방에서 <FONT color=#ff4800><STRONG>나만의 이모티콘을 사용</STRONG></FONT>하여 나의 글을 돋보이게 나를 더욱 눈에 띄게 해주는 아이템");
					$data['img'] = "emoticom_free.gif";
					break;
				case 27  : 
					$data['title'] = iconv("utf-8","euc-kr","우선노출");
					$data['str'] = iconv("utf-8","euc-kr","채팅방을 생성할때 <FONT color=#ff4800><STRONG>내가 만든방이 </STRONG></FONT>대기실 <FONT color=#ff4800><STRONG>최상단노출</STRONG></FONT> 시켜 모든회원들이 내 채팅방을 가장먼저 볼 수 있도록 해줍니다");
					$data['img'] = "first_see.gif";
					break;
				case 66  : 
					$data['title'] = iconv("utf-8","euc-kr","음악채팅 자유이용권");
					$data['str'] = iconv("utf-8","euc-kr","<FONT color=#ff4800><STRONG>1일 무제한으로 </STRONG></FONT>모든 <FONT color=#ff4800><STRONG>음악채팅 아이템</STRONG> </FONT>사용이 가능합니다. 이성작업방, 비밀방, 우선노출 등 모든 아이템을 자유롭게 이용하세요.");
					$data['img'] = "musicchat_free.gif";
					break;
		}		

		$this->load->view('music_chat/mchat_item_buy_v',@$data);

	}


	function item_check(){
		//아이템 사용가능한지 체크 (항상사용)
		//기존 118번 서버 http://www.joyhunting.com/item_mall/item_check.asp?myid=wwkorea1031&i_id=27
		//http://www.joyhunting.net/etc/music_chat/chat_item_new/userid/wwkorea1030
		$userid    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));
		$i_id    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'i_id')));

		if($i_id == "28" or $i_id == "29" or $i_id == "8" or $i_id == "26" or $i_id == "31" or $i_id == "27" or $i_id == "66"){
			echo "Y";
		}

	}

	function musicchat_title(){
		//채팅방 만들기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_title.asp?myid=wwkorea1031
		//http://www.joyhunting.net/etc/music_chat/musicchat_title/myid/wwkorea1031/i_flag/아이템

		$data['myid']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));
		$data['i_flag']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'i_flag')));

		
		$search['m_userid'] = $data['myid'];
		$data['my_cnt'] = $this->my_m->cnt('T_MyChat_Title', $search);

		$this->load->view('music_chat/musicchat_title_v',@$data);

	}
	
	function musicchat_sub_new(){
		//눈에 띄는 방제목 선택하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_sub_new.asp?t_val=
		//http://www.joyhunting.net/etc/music_chat/musicchat_sub_new/t_val/
		$t_val    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 't_val')));
		$data['t_val'] = $t_val;

		$search['t_use'] = 0;
		if($t_val > 0){
			$search['t_thema'] = $t_val;
		}

		$data['title_row'] = $this->my_m->result_array('T_MusicChat_Title', $search);

		$data['getTotalData'] = $this->my_m->cnt('T_MusicChat_Title', $search);

		$this->load->view('music_chat/musicchat_sub_new_v',@$data);

	}

	function musicchat_sub_default(){
		//기본 방제목 선택하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_sub_default.asp?t_val=
		//http://www.joyhunting.net/etc/music_chat/musicchat_sub_default/t_val/
		$t_val    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 't_val')));
		$data['t_val'] = $t_val;

		$search['t_use'] = 1;
		if($t_val > 0){
			$search['t_thema'] = $t_val;
		}

		$data['title_row'] = $this->my_m->result_array('T_MusicChat_Title', $search);

		$data['getTotalData'] = $this->my_m->cnt('T_MusicChat_Title', $search);

		$this->load->view('music_chat/musicchat_sub_default_v',@$data);
	}

	function musicchat_sub_my(){
		//내가 만든 방제목 선택하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_sub_my.asp?myid=wwkorea1031
		//http://www.joyhunting.net/etc/music_chat/musicchat_sub_my/myid/wwkorea1031
		$data['myid']    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));

		$search['m_userid'] = $data['myid'];
		$search['m_cert'] = 1;

		$data['title_row'] = $this->my_m->result_array('T_MyChat_Title', $search,'idx');

		$data['getTotalData'] = $this->my_m->cnt('T_MyChat_Title', $search);

		$this->load->view('music_chat/musicchat_sub_my_v',@$data);

	}

	function musicchat_mytitle(){
		//채팅방 만들기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_title.asp?myid=wwkorea1031
		//http://www.joyhunting.net/etc/music_chat/musicchat_title/myid/wwkorea1031/i_flag/아이템

			$myid		=  $this->input->post('myid',TRUE);	//내아이디
			$m_mode = $this->input->post('m_mode',TRUE);	//추가/수정 모드

			$i_title		= $this->input->post('i_title',TRUE);	//추가할 제목

			$m_idx		= $this->input->post('t_idx',TRUE);	//수정할 제목 Index
			$m_title		= $this->input->post('t_title',TRUE);	//수정할 제목

			if(empty($myid)){exit;}

			if($m_mode == "del"){ //삭제 모드
				
				$search['idx'] = $m_idx;
				$search['m_userid'] = $myid;
				$rtn = $this->my_m->del('T_MyChat_Title', $search);

				if($rtn){
					?>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<SCRIPT LANGUAGE="JavaScript">
						<!--
							alert('삭제되었습니다.');
							parent.my_cnt = parseInt(parent.my_cnt) - 1;
							parent.document.getElementById("i_title").value = '';
							parent.document.getElementById("t_prev").innerHTML = '';
							parent.Reg_MyTitle_Ok2();
						//-->
						</SCRIPT>
					<?
				}

			}else{

				If ($m_mode == "mod"){			//수정 모드

				}else{	//추가 모드

					$message_vals = "나만의 방제목이 추가되었습니다.";
					$BMODE = "BMODE1";
					//$i_title = iconv("utf-8","euc-kr",$i_title);

					$search = array('m_userid' => $myid, 'm_cert' => '1');
					$title_cnt = $this->my_m->cnt('T_MyChat_Title', $search);
					if($title_cnt < 10){ //추가는 10개까지만 가능



						$data_array = array('m_userid' => $myid, 'm_title' => $i_title);
						$this->my_m->insert('T_MyChat_Title', $data_array);
					}

				}

				$message_vals = str_replace(" ", "|",$message_vals);

				?>
				<SCRIPT LANGUAGE="JavaScript">
				<!--
					if ('<?=$m_mode?>' == 'mod'){
						alert('수정되었습니다.');
					}else{
						window.open('/etc/music_chat/my_title_pop', '', 'width=304,height=185,top=200,left=300;');
						//alert('추가되었습니다.');
						parent.my_cnt = parseInt(parent.my_cnt) + 1;
						parent.document.getElementById("i_title").value = '';
						parent.document.getElementById("t_prev").innerHTML = '';
					}
					parent.Reg_MyTitle_Ok2();
				//-->
				</SCRIPT>
				<?

			}

	}

	function my_title_pop(){
		//방개설 완료 팝업
		//기존 118번 서버 http://www.joyhunting.com/popup/my_title_pop.asp
		//http://www.joyhunting.net/popup/my_title_pop

		$this->load->view('music_chat/my_title_pop_v',@$data);

	}

	function musicchat_sub_reg(){
		//내가 등록한 방제목 관리하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/applyweb/musicchat_sub_reg.asp?myid=wwkorea1030
		//http://www.joyhunting.net/etc/music_chat/musicchat_sub_reg/myid/wwkorea1030

		$myid    = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));	//내 아이디

		$search = array('m_userid' => $myid);

		$data['title_row'] = $this->my_m->result_array('T_MyChat_Title', $search, 'idx');
		$data['getTotalData'] = $this->my_m->cnt('T_MyChat_Title', $search);

		$this->load->view('music_chat/musicchat_sub_reg_v',@$data);

	}

	function search_mem_room(){
		$this->search_mem_wait();
	}

	function search_mem_wait(){
		//회원 초대하기
		//기존 118번 서버 http://www.joyhunting.com/webchat/camchat/search_mem_wait.asp?myid=wwkorea1030
		//http://www.joyhunting.net/etc/music_chat/search_mem_wait/myid/wwkorea1030/cAge/연령대/cArea/지역/cGen/성별/cCons/검색조건/cStr/검색문구/cOne/원클릭검색

		$data['myid']	= $myid =  rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'myid')));  			//내 아이디
		$data['rAge'] = $rAge	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cAge'))); 			//연령대(0: 전체, 20, 30, 40, 50)
		$data['rArea']	= $rArea = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cArea')));  	//지역(all: 전체, 지역)
		$data['rGen']	= $rGen = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cGen')));  		//성별(0: 모두, 1: 남, 2: 여)
		$data['rCons'] = $rCons = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cCons')));   	//검색조건(0: 미사용, 1: 아이디, 2: 닉네임)
		$data['rStr'] = $rStr	= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cStr')));   		//검색문구
		$data['rOne'] = $rOne = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'cOne')));   		//원클릭검색(0: 일반, 1: 친구, 2: 최근 채팅회원, 3: 추천 대화상대)

		$data['page'] = $page = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));   		//페이지

		//0 일반만 남기고 나머지는 삭제함.

		If ($rCons == "1"){
			$age_cons = "";
			$are_cons = "";
			$gen_cons = "";
			$ser_cons = " AND m_userid = '".$rStr."'";
		}else if($rCons == "2"){
			$age_cons = "";
			$are_cons = "";
			$gen_cons = "";
			$ser_cons = " AND m_nick = '".$rStr."'";
		}else{
			$ser_cons = "";

			If (Is_Null($rAge) Or $rAge == "" Or $rAge == "0"){
				$age_cons = "";
			}else{
				$mod_val = (int)($rAge / 10);
				If ($mod_val > 4){
					$age_cons = " AND m_age2 >= 5";
				}else{
					$age_cons = " AND m_age2 = ".$mod_val;
				}
			}

			If (Is_Null($rArea) Or $rArea == "" Or $rArea == "all"){
				$are_cons = "";
			}else{
				$are_cons = " AND m_conregion = '".$rArea."'";
			}
				
			If (Is_Null($rGen) Or $rGen = "" Or $rGen = "0"){
				$gen_cons = "";
			}else{
				If ($rGen == "1"){
					$gen_cons = " AND m_sex = 1";
				}else{
					$gen_cons = " AND m_sex = 0";
				}
			}
		}


		if ( empty($page) ){
			$page=1;
		}

		$intPageSize = 7;
		$intBlockPage	= 5;
		
		If(@$pStatus == "1"){
			$intNowPage = $data['intNowPage'] = $page + ($intBlockPage - 1);
		}else{
			$intNowPage = $data['intNowPage'] = $page;
		}

		$start = (($page-1) * $intPageSize);

		$total_cons = $age_cons.$are_cons.$gen_cons.$ser_cons;

		$data['getTotalData'] = $intTotalCount = $this->my_m->cnt('TotalMembers_login', @$search);
		$inttotalpage = $data['inttotalpage'] = ceil($intTotalCount / $intPageSize);
		$data['page'] = $this->Paging_music_2("/etc/music_chat/search_mem_wait","myid/".$myid."/cAge/".$rAge."/cArea/".$rArea."/cGen/".$rGen."/cCons/".$rCons."/cStr/".$rStr."/cOne/".$rOne,$intNowPage,$intBlockPage, $inttotalpage);

		$this->db->select('*')->from('TotalMembers_login');
		$this->db->where("m_userid != '$myid'");
		$query = $this->db->order_by('m_num', 'desc')->limit($intPageSize, $start)->get();
		$data['mem_data'] = $query->result_array();


		$this->load->view('music_chat/search_mem_wait_v',@$data);

	}


	//회원초대하기 하단의 페이징기능
	Function Paging_music_2($pageid,$returnParam,$intNowPage,$intBlockPage,$intTotalPage){

		$intTemp = (Int)(($intNowPage - 1) / $intBlockPage) * $intBlockPage + 1;

        If ($intTemp == 1){
			$tmp = "[이전]&nbsp;&nbsp;";
		}else{ 
			$tmp = "<a href=".$pageid."/page/" .($intTemp - $intBlockPage)."/".$returnParam.">[이전]</a>&nbsp;&nbsp;";
		}

		$intLoop = 1;

		$is_while = true;
		while($is_while){

			If ($intTemp == (Int)$intNowPage){
				If ($intLoop == $intBlockPage Or $intTemp == $intTotalPage){
					$tmp = $tmp."<b><font color=red>".$intTemp."</font></b>&nbsp;";
				}else{
					$tmp = $tmp."<b><font color=red>".$intTemp."</font></b>&nbsp;|";
				}
			}else{
				If ($intLoop == $intBlockPage Or $intTemp == $intTotalPage){
					$tmp = $tmp."<a href=".$pageid."/page/".$intTemp."/".$returnParam.">".$intTemp."</a>&nbsp;";
				}else{
					$tmp = $tmp."<a href=".$pageid."/page/".$intTemp."/".$returnParam.">".$intTemp."</a>&nbsp;|";
				}
			}

			$intTemp = $intTemp + 1;
			$intLoop = $intLoop + 1;

			if($intLoop > $intBlockPage Or $intTemp > $intTotalPage){
				$is_while = false;
			}
		}

		If ($intTemp > $intTotalPage){
			$tmp = $tmp."&nbsp;&nbsp;[다음]";
		}else{
			$tmp = $tmp."&nbsp;&nbsp;<a href=".$pageid."/page/".$intTemp."/".$returnParam.">[다음]</a>";
		}

		$tmp =  iconv("utf-8","euc-kr",$tmp);

		return $tmp;

	}

	//신고하기
	function facechat_singoupload_ok(){
		
		$help_id =  rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'help_id')));  	
		$singo_id =  rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'singo_id')));  	
		$singo_reason =  rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'singo_reason')));  	

		$config['upload_path'] = '/resource/joyhunting_upload/music_chat/';
		$config['allowed_types'] = 'gif|jpg|png|bmp|htm';
		$config['max_size']	= '1000';

		$this->load->library('upload', $config);

		if(!empty($_FILES['file1']['name'])){

			$_FILES['userfile']['name'] =  $_FILES['file1']['name'];
			$_FILES['userfile']['type'] =  $_FILES['file1']['type'];
			$_FILES['userfile']['tmp_name'] =  $_FILES['file1']['tmp_name'];
			$_FILES['userfile']['error'] =  $_FILES['file1']['error'];
			$_FILES['userfile']['size'] =  $_FILES['file1']['size'];

			if ( ! $this->upload->do_upload())
			{
				$error = $this->upload->display_errors();
				
			}

		}

		if(!empty($_FILES['file2']['name'])){

			$_FILES['userfile']['name'] =  $_FILES['file2']['name'];
			$_FILES['userfile']['type'] =  $_FILES['file2']['type'];
			$_FILES['userfile']['tmp_name'] =  $_FILES['file2']['tmp_name'];
			$_FILES['userfile']['error'] =  $_FILES['file2']['error'];
			$_FILES['userfile']['size'] =  $_FILES['file2']['size'];

			if ( ! $this->upload->do_upload())
			{
				$error = $this->upload->display_errors();
				
			}

		}

		$help_m = $this->member_lib->get_member($help_id);
		$singo_m = $this->member_lib->get_member($singo_id);

		$data_arr = array(
			's_id' => $help_id , 
			's_nick' => $help_m['m_nick'],
			'r_id' => $singo_id ,
			'r_nick' => $singo_m['m_nick'],
			'c_cate' => 21,
			'c_content' => $singo_reason,
			'c_file' =>  $_FILES['file1']['name'],
			'c_file2' =>  $_FILES['file2']['name'],
			'c_date' => NOW,
			'c_success' => 1
		);

		$this->my_m->insert("Police_complaint", $data_arr);

		//$error = "11";
		//$this->my_m->insert("test_table", array('help_id' => $help_id, 'singo_id' => $singo_id, 'singo_reason' => $help_m['m_nick']." ".$singo_m['m_nick']) );

	}


}

/* End of file main.php */
/* Location: ./application/controllers/music_chat.php */