<div class="content">

	<div class="left_main">

		<div class="main_top_title">
			<p class="blod color_fff padding_top_12 margin_left_10 font-size_14 block ">
			<?=mb_level_profile($u_info['m_userid'], '9', "javascript:rank_info();")?>
			<?=$pic_title?></p>
			<?if(!$my_profile){?>
			<input type="button" class="text_btn_dcdcdc float_right bad_friend_add " value="나쁜친구등록 +" onclick="javascript:bad_friend_request('<?=$u_info['m_userid']?>');">
			<input type="button" class="text_btn_dcdcdc color_ea3c3c float_right border_1_ea3c3c bad_friend_add" value="내 친구로 추가 +" onclick="javascript:friend_request('<?=$u_info['m_userid']?>');">
			<?}?>
		</div>
		<div class="profile_box">

			<div class="padding_top_20 padding_left_20">

				<div class="profile_content">
					<?=$pic_data1?>
				</div>

				<div class="profile_content">
					<?=$pic_data2?>
				</div>

				<div class="profile_content">
					<?=$pic_data3?>
				</div>


				<div class="profile_text">
					<?=$u_info['my_intro']?><br>
				</div>
				
				<?if($my_profile){?>
					<input type="button" class="text_btn2_d2d2d2 block profile_text_modi" value="인사말 변경" onclick="javascript:location.href='/profile/my_info';"/>
				<?}else{?>
					<div class="block ver_bottom margin_left_6">
						<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("view_profile('$recv_id');");?>"><span class="img_mail_btn"></span></div>
						<div class="icon_btn_bababa margin_left_1"" onclick="javascript:send_message('<?=$recv_id?>', 'send', '');"><span class="img_talk_btn"></span></div>
						<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$recv_id');");?>"><span class="img_heart_btn"></span></div>
					</div>
				<?}?>

				<table class="profile_info" colspan="0" cellspacing="0">
					<tr>
						<td>나이</td>
						<td><?=$u_info['m_age']?>세</td>
						<td>원하는 만남</td>
						<td><?=want_reason_data($u_info['m_reason'])?></td>
					</tr>
					<tr>
						<td>지역</td>
						<td><?=$u_info['m_conregion']?> <?=$u_info['m_conregion2']?></td>
						<td>대화스타일</td>
						<td><?=talk_style_data($u_info['m_character'],$u_info['m_sex'])?></td>
					</tr>

					<?if($my_profile){?>
					<tr>
						<td>이메일</td>
						<td><?=$u_info['m_mail']?></td>
						<td>핸드폰번호</td>
						<td><?=$u_info['m_hp1']?>-<?=$u_info['m_hp2']?>-<?=$u_info['m_hp3']?></td>
					</tr>
					<? } ?>

				</table>

			<?if($my_profile){?>
				<div class="text-right">
					<input type="button" class="text_btn2_d2d2d2 my_info_modi" value="내 정보수정" onclick="javascript:location.href='/profile/my_info';"/>
				</div>
			<? } ?>

			<div class="text-left">
				<img src="<?=IMG_DIR?>/profile_information.jpg" style="padding-bottom:5px;">
			</div>

			</div>
		</div>

		<?if($my_profile){?>
		<div class="margin_top_8">
			<div class="float_left confirm_left">
				<p class="color_333 blod padding_top_17 padding_left_20 font-size_14">꼭 인증을 받으세요!</p>
				<p class="color_666 padding_top_8 padding_left_20">휴대폰 인증을 받고 조이헌팅의<br>다양한 서비스를 누려보세요!</p>
			</div>
			<div class="float_right confirm_right">
				<p class="font-size_14">휴대폰 인증정보</p>

				<div class="font-size_14">
					<? if($m_mobile_chk == "1"){ echo $m_hptele; }else{ ?>
					인증해주세요.
					<? } ?>
				</div>
				<img src="<?=IMG_DIR?>/profile/profile_phone.gif" class="confirm_btn pointer" onclick="javascript:name_check();"/>
				<!--img src="<?=IMG_DIR?>/profile/profile_phone.gif" class="confirm_btn pointer" onclick="javascript:reg_phone_chk('2', '<?=@$this->session->userdata['m_userid']?>');"/-->
			</div>
			<div class="clear"></div>
		</div>
		<? } ?>
		

		<div class="margin_top_8">
			<div class="confirm_member float_left margin_right_8">
				<div class="height_22">
					<span class="color_2a5692 font-size_18 font_900">같은지역</span> <span class="color_ff1c24 font-size_18 font_900">인증회원</span>
					<a href="/photo/permission/new_photo" class="color_999 block margin_left_116">더많은 회원보기</a>
				</div>

				<?
					// 같은지역 인증회원
					foreach( sex_rand('3', 'TotalMembers', '*','m_userid', 'm_sex','last_login_day', array('ex_pic' => 'm_filename is not null' , 'm_conregion' => $this->session->userdata('m_conregion'), 'ex_notme' => "m_userid not in('".$this->session->userdata('m_userid')."')") ) as $key => $val)
					{
				?>

				<div class="confirm_member_box pointer" onclick="view_profile('<?=$val['m_userid']?>');">
					<?=$this->member_lib->member_thumb($val['m_userid'],130,99)?>
					<b class="text_cut"><?=mb_level_profile($val['m_userid'])?><?=$val['m_nick']?></b>
					<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?></span><?=$val['m_age']?>세</p>
				</div>

				<? } ?>
			</div>
			<div class="confirm_member float_left">
				<div class="height_22">
					<span class="color_025101 font-size_18 font_900">같은또래</span> <span class="color_53af1e font-size_18 font_900">인증회원</span>
					<a href="/photo/permission/new_photo" class="color_999 block margin_left_116">더많은 회원보기</a>
				</div>

				<?
					// 같은또래 인증회원
					foreach( sex_rand('3', 'TotalMembers', '*','m_userid', 'm_sex','last_login_day', array('ex_pic' => 'm_filename is not null' , 'm_age2' => $this->session->userdata('m_age2'), 'ex_notme' => "m_userid not in('".$this->session->userdata('m_userid')."')") ) as $key => $val)
					{
				?>

				<div class="confirm_member_box pointer" onclick="view_profile('<?=$val['m_userid']?>');">
					<?=$this->member_lib->member_thumb($val['m_userid'],130,99)?>
					<b class="text_cut"><?=mb_level_profile($val['m_userid'])?><?=$val['m_nick']?></b>
					<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?></span><?=$val['m_age']?>세</p>
				</div>

				<? } ?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="mybox_roadmap">
			<span class="color_333 blod font-size_14">내 관리함 한눈에 보기</span>
			<span class="color_c73900">&nbsp;매일매일 체크하세요~</span>

			<div class="mybox_roadmap_text">
				<div><a href="/profile/my_chat">채팅함</a></div>
				<div><a href="/profile/my_anne/send_anne">내앤</a><br><a href="/profile/my_friend/send_friend">내친구</a></div>
				<div><a href="/profile/jjim/send_jjim">찜</a><br><a href="/profile/jjim/send_jjim">목록</a><br><a href="/profile/jjim/my_visitant">내프로필 방문자</a></div>
				<div><a href="/profile/propose/send_propose">보낸 프로포즈</a><br><a href="/profile/propose/receive_propose">받은 프로포즈</a></div>
				<div><a href="/profile/point/point_list">포인트</a></div>
				<div><a href="/profile/my_alarm/alarm_list">알림</a></div>
			</div>
		</div>
		
		<div class="margin_top_8">
			<a href="/blindmeet/blind"><img src="<?=IMG_DIR?>/profile/profile_logo_1.gif" class="margin_right_5"></a>
			<a href="/open_marry"><img src="<?=IMG_DIR?>/profile/profile_logo_2.gif" class="margin_right_5"></a>
			<a href="/photo/bestphoto"><img src="<?=IMG_DIR?>/profile/profile_logo_3.gif" class="float_right"></a>
			<div class="clear"></div>
		</div>
	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->