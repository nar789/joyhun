
<div class="m_main_area iphone_padding">

	<table class="width_100per bg_fefefe m_intro_table">
		<tr>
			<td class="width_5per">&nbsp;</td>
			<td class="width_15per week_td"><?=$this->member_lib->member_thumb($member_data['m_userid'], 200, 200)?></td>
			<td class="m_intro_text_td">
				<a href="/profile/main/user">
					<div class="float_left width_80per margin_top_3 margin_left_3per">
						<b class="color_333 margin_top_3 text_cut"><?=@$member_data['m_nick']?>&nbsp;&nbsp;<span class="color_ccc"><?=user_level($member_data['m_level']); ?>등급</span></b>

						<p class="color_999 margin_top_3"><?=talk_style_data($member_data['m_character'], $member_data['m_sex'])?> / <?=want_reason_data($member_data['m_reason'])?></p>
					</div>
					<div class="float_left add_arrow">
						<img src="<?=IMG_DIR?>/m/add_menu_arrow.gif">
					</div>
					<div class="clear"></div>
				</a>
			</td>
		</tr>
	</table>

	<!-- VVIP와 준회원은 안보임 -->
	<? if ($member_data['m_level'] < 5 && $member_data['m_level'] > 0){ ?>
	<div class="add_rating">
		<div class="add_rating_01">
			<div class="add_rating_02">
				<?=mb_level_profile($member_data['m_userid'],'9')?>
				<span class="color_999 margin_left_5">
					 <?=user_level($member_data['m_level']+1); ?> 등급으로 승급하시려면? 
				</span>
				<div class="add_icbox">
					<a href="javascript:rank_info();"><img src="<?=IMG_DIR?>/m/add_menu_ic2.gif" border="0"></a></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<? }?>

	<table cellpadding="5" cellspacing="0" class="add_menu_table">
		<tr>
			
			<td onClick="location.href='/profile/my_info'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_1.gif">
				<p class="color_333 blod">내 정보수정</p>
			</td>
			<td onClick="location.href='/profile/point/point_list'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_2.gif">
				<p class="color_333 blod">포인트충전</p>
			</td>
			<td onClick="location.href='/service_center/joy_magazine/all'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_9.gif">
				<p class="color_333 blod">조이매거진</p>
			</td>
			<td onClick="location.href='/service_center/event/ing_event'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_4.gif">
				<p class="color_333 blod">이벤트</p>
			</td>
		</tr>
		<tr>
			<td onClick="location.href='/etc/privacy_policy/mobile_set'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_5.gif">
				<p class="color_333 blod">설정</p>
			</td>
			<td onClick="location.href='/service_center/main/qna_popup_mobile'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_6.gif">
				<p class="color_333 blod">문의메일</p>
			</td>
			<td onClick="location.href='/service_center/main/business_popup_mobile'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_7.gif">
				<p class="color_333 blod">제휴문의</p>
			</td>
			<td onClick="location.href='/service_center/notice/noti_list'" class="pointer">
				<img src="<?=IMG_DIR?>/m/m_add_btn_3.gif">
				<p class="color_333 blod">공지</p>
			</td>
			<!--<td onclick="javascript:send_kakao('1');">
				<img src="<?=IMG_DIR?>/m/m_add_btn_8.gif" id="kakao-link-btn1">
				<p class="color_333 blod">친구초대</p>
			</td>-->
		</tr>
	</table>
	

	<div class="joymagazine_box">
		<div class="magazine_box">
			<div class="magazine_left"><a href="javascript:joy_magazine_view('<?=$magazine_list[0]['idx']?>');"><img src="/upload/naver_upload/magazine/<?=$magazine_list[0]['m_list_img_url']?>" class="width_100per"></a></div>
			<div class="magazine_right"><a href="javascript:joy_magazine_view('<?=$magazine_list[1]['idx']?>');"><img src="/upload/naver_upload/magazine/<?=$magazine_list[1]['m_list_img_url']?>" class="width_100per"></a></div>
			<div class="clear"></div>
			<div class="magazine_left"><p><a href="javascript:joy_magazine_view('<?=$magazine_list[0]['idx']?>');" style="color:#000;"><?=$magazine_list[0]['title']?></a></p></div>
			<div class="magazine_right"><p><a href="javascript:joy_magazine_view('<?=$magazine_list[1]['idx']?>');" style="color:#000;"><?=$magazine_list[1]['title']?></a></p></div>
			<div class="clear"></div>
		</div>
	</div>

	<? if($member_data['m_mobile_chk'] == "1"){ ?>

	<div class="margin_top_50 width_90per margin_bottom_5per margin_left_5per">
		<div class="add_bottom_btn_box pointer" onclick="javascript:location.href='#'">
			<img src="<?=IMG_DIR?>/m/m_bottom_btn_second.png" class="width_100per">
			<div class="posi_rel add_bottom_textbox">
				<div class="add_bottom_textbox_second">
					<b class="color_fff"><?=$member_data['m_hp1']?>-<?=$member_data['m_hp2']?>-<?=$member_data['m_hp3']?></b>
				</div>
			</div>
		</div>
	</div> 
	
	<? }else{ ?>
	<img src="<?=IMG_DIR?>/m/m_bottom_btn.png" class="margin_left_4per width_92per margin_bottom_20 margin_top_100 pointer" onclick="javascript:name_check();"> 
	<!--img src="<?=IMG_DIR?>/m/m_bottom_btn.png" class="margin_left_4per width_92per margin_bottom_20 margin_top_100 pointer" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata('m_userid')?>');"--> 
	<? } ?>


	<!-- 이전배너 --> 
	<!-- <img src="<?=IMG_DIR?>/m/m_banner_for_secret.gif" class="width_100per margin_bottom_10 margin_top_100" onclick="javascript:location.href='/m/online_mb'"> -->

</div>                                  
