
<div class="m_main_area">
	
	<table class="width_100per bg_fefefe m_intro_table">
		<tr>
			<td class="width_5per">&nbsp;</td>
			<td class="width_15per week_td"><?=$this->member_lib->member_thumb($member_data['m_userid'], 200, 200)?></td>
			<td class="m_intro_text_td">
				<a href="/profile/main/user">
					<div class="float_left width_80per margin_top_3">
						<b class="color_333 margin_top_3 text_cut block"><?=@$member_data['m_nick']?></b>
						<div class="m_add_menu_ic">
							<img src="<?=IMG_DIR?>/m/add_menu_ic.gif">
						</div>
						<div class="m_add_menu_text">VIP</div>
						<p class="color_ccc margin_top_3"><?=want_reason_data($member_data['m_reason'])?> / <?=talk_style_data($member_data['m_character'], $member_data['m_sex'])?></p>
					</div>
					<div class="float_left add_arrow">
						<img src="<?=IMG_DIR?>/m/add_menu_arrow.gif">
					</div>
					<div class="clear"></div>
				</a>
			</td>
		</tr>
	</table>
	<div class="add_rating">
		<div class="add_rating_01">
			<div class="add_rating_02">
				<img src="<?=IMG_DIR?>/m/add_menu_vip.gif">
				<span class="color_ccc margin_left_5">VVIP 등급으로 승급하시려면?</span>
				<div class="add_icbox">
					<a href="javascript:rank_info();"><img src="<?=IMG_DIR?>/m/add_menu_ic2.gif" border="0"></a></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>


	

	<table cellpadding="5" cellspacing="0" class="add_menu_table">
		<tr>
			<td>
				<a href="/profile/my_info">
					<img src="<?=IMG_DIR?>/m/m_add_btn_1.gif">
					<p class="color_333 blod">내 정보수정</p>
				</a>
			</td>
			<td>
				<a href="/profile/point/point_list">
					<img src="<?=IMG_DIR?>/m/m_add_btn_2.gif">
					<p class="color_333 blod">포인트충전</p>
				</a>
			</td>
			<td>
				<a href="/service_center/notice/noti_list">
					<img src="<?=IMG_DIR?>/m/m_add_btn_3.gif">
					<p class="color_333 blod">공지</p>
				</a>
			</td>
			<td>
				<a href="/service_center/event/ing_event">
					<img src="<?=IMG_DIR?>/m/m_add_btn_4.gif">
					<p class="color_333 blod">이벤트</p>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="/etc/privacy_policy/mobile_set">
					<img src="<?=IMG_DIR?>/m/m_add_btn_5.gif">
					<p class="color_333 blod">설정</p>
				</a>
			</td>
			<td>
				<!-- <a href="/service_center/faq/m_mail/g/q"> -->
				<a href="/service_center/main/qna_popup_mobile">
					<img src="<?=IMG_DIR?>/m/m_add_btn_6.gif">
					<!-- <p class="color_333 blod">문의메일</p> -->
					<p class="color_333 blod">고객문의</p>
				</a>
			</td>
			<td>
				<!-- <a href="/service_center/faq/m_mail/g/c"> -->
				<a href="/service_center/main/business_popup_mobile">
					<img src="<?=IMG_DIR?>/m/m_add_btn_7.gif">
					<!-- <p class="color_333 blod">제휴문의</p> -->
					<p class="color_333 blod">광고 &middot; 제휴</p>
				</a>
			</td>
			<td onclick="javascript:send_kakao('1');">
				<a href="#">
					<img src="<?=IMG_DIR?>/m/m_add_btn_8.gif" id="kakao-link-btn1">
					<p class="color_333 blod">친구초대</p>
				</a>
			</td>
		</tr>
	</table>

	<? if($member_data['m_mobile_chk'] == "1"){ ?>

	<div class="margin_top_100 width_90per margin_bottom_5per margin_left_5per">
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
	<img src="<?=IMG_DIR?>/m/m_bottom_btn.png" class="margin_left_4per width_92per margin_bottom_20 margin_top_100 pointer" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata('m_userid')?>');"> 
	<? } ?>


	<!-- 이전배너 --> 
	<!-- <img src="<?=IMG_DIR?>/m/m_banner_for_secret.gif" class="width_100per margin_bottom_10 margin_top_100" onclick="javascript:location.href='/m/online_mb'"> -->

</div>