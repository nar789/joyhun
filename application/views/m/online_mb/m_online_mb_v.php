<div class="m_main_area">
	<div class="text-center">
		<div id="m_search_area" class="m_search_area">
			<input type="search" id="m_on_search" class="m_search" placeholder="접속자 검색" value="" onkeydown="javascript: if (event.keyCode == 13) {search_m_online_keycheck();}">
		</div>
		<input type="button" class="m_search_btn" value="" id="m_search_btn" onclick="javascript:search_m_online();">
	</div>

	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;내 프로필&nbsp;</p></div>
		<div class="clear"></div>
	</div>
	<div class="bg_fefefe">
		<table class="width_96per margin_auto m_intro_table">
			<tr>
				<td class="width_15per week_td text-center"><?=$this->member_lib->member_thumb(@$member_data['m_userid'], 200, 200)?></td>
				<td class="m_intro_text_td">
					<div class="float_left width_70per margin_top_3 text_cut">
						<b class="color_333 margin_left_3per color_ea3c3c level_m_online_img">
						<?=mb_level_profile($member_data['m_userid'])?><?=strcut_utf8(@$member_data['m_nick'], '10')?></b><b class="color_888">(<?=@$member_data['m_age']?>) <?=@$member_data['m_conregion']?> <?=@$member_data['m_conregion2']?></b>
						<p class=" margin_top_3 margin_left_3per text_cut">
							<?=talk_style_data(@$member_data['m_character'])?> / <?=want_reason_data(@$member_data['m_reason'], @$member_data['m_sex'])?>
						</p>
					</div>
					<div class="float_left width_30per text-right">
						<input type="button" value="수정" class="secret_btn width_70per float_right" onclick="location.href='/profile/main/user'">
					</div>
					<div class="clear"></div>
				</td>
			</tr>
		</table>
	</div>

	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;현재 접속자&nbsp;</p></div>
		<div class="clear"></div>
	</div>


	<div id="div_tbl_on" class="bg_fefefe">
		<table class="width_96per margin_auto m_intro_table">
			<?
				if($getTotalData > 0){

					$i = 1; 

					foreach($mlist as $data){

						if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
						if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }
			?>
			<tr>
				<td class="width_15per now_member pointer text-center" onclick="javascript:chat_request('<?=$data['m_userid']?>');"><?=$this->member_lib->member_thumb($data['m_userid'], 200, 200)?></td>
				<td class="m_intro_text_td">
					<div class="float_left width_70per margin_top_3 text_cut">
						<b class=" color_333 margin_left_3per level_m_online_img <?=$m_color?> pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
						<?=mb_level_profile($data['m_userid'])?><?=strcut_utf8($data['m_nick'],10)?></b>
						<b class="color_888 pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">(<?=$data['m_age']?>) <?=$data['m_conregion']?> <?=$data['m_conregion2']?></b>
						<p class=" margin_top_3 margin_left_3per text_cut">
							<?=talk_style_data($data['m_character'])?> / <?=want_reason_data($data['m_reason'], $data['m_sex'])?>
						</p>
					</div>
					<div class="float_left width_30per text-right">
						<input type="button" value="비밀톡챗신청" class="secret_btn hidden" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
					</div>
					<div class="clear"></div>
				</td>
			</tr>
			<?
					$i++;
					if($i == 5){ echo @$add_html; }
					}
				}else{
			?>
			<!-- 현재 접속자가 없을경우 -->
			<?
				}
			?>
			
			<?=m_list_banner(); //모바일 리스트 배너?>

			<!--<div onclick="javascript:send_kakao('1');">
			<img src="<?=IMG_DIR?>/m/m_banner_for_kakao.gif" class="width_100per margin_top_20" id="kakao-link-btn1">
			</div>-->
		</table>
	</div>
	

	<!--<div onclick="javascript:send_kakao('2');">
		<img src="<?=IMG_DIR?>/m/m_banner_for_kakao.gif" class="width_100per margin_top_20" id="kakao-link-btn2">
	</div>-->

	<?=m_list_banner(); //모바일 리스트 배너?>


	
	<!-- 더보기 리스트 부분 -->
	<div class="bg_fefefe">
		<table id="tbl" class="width_96per margin_auto m_intro_table">
		</table>
	</div>
	<!-- 더보기 리스트 부분 -->

	<div id="more_btn" class="borad_add">
		<div id="more" page="<?=$page+1?>" class="board_more text-center">
			more &nbsp;<div></div>
		</div>
	</div>

</div>

