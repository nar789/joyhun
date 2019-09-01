

<script>

//<![CDATA[
	function aa(cnt) {
		$('#fileinput_'+cnt).click();
	}
 //]]>

</script>


<style>
	
	input[type="file"] { display:none; }

</style>
						
	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;<?=$member_data['m_nick']?>님의 프로필입니다.&nbsp;</p></div>
		<div class="clear"></div>
	</div>


	<div class="padding_top_10">
		<table class="m_profile_pic_table">
			<tr>
				<td class="width_33per ver_top text-center">
					<?=$user_pic1?>
				</td>
				<td class="width_33per ver_top text-center">
					<?=$user_pic2?>
				</td>
				<td class="width_33per ver_top text-center">
					<?=$user_pic3?>
				</td>
			</tr>
		</table>
	</div>

	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr">
			<p class="now_online_title">&nbsp;인사말&nbsp;</p>
		</div>
		<div class="clear"></div>
	</div>

	<div class="height_100 bg_fefefe text-center">
		<textarea class="m_profile_textarea" id="my_intro" name="my_intro"><?=$member_data['my_intro']?></textarea>
	</div>


	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;기본프로필&nbsp;</p></div>
		<div class="clear"></div>
	</div>

	<div class="m_profile_table_area_second">
		<table class="mobile_border_table">
			<tr>
				<td>나이</td>
				<td>	
					<div class="border_none text_5 color_666 padding_2per"><?=$member_data['m_age']?>세</div>	
				</td>
			</tr>
			<tr>
				<td>지역</td>
				<td>
					<div class="border_none text_5 color_666 padding_2per"><?=$member_data['m_conregion']?> <?=$member_data['m_conregion2']?></div>
				</td>
			</tr>
			<tr>
				<td>원하는 만남</td>
				<td>
					<div class="border_none text_5 color_666 padding_2per"><?=want_reason_data($member_data['m_reason'])?></div>
				</td>
			</tr>
			<tr>
				<td>대화스타일</td>
				<td>
					<div class="border_none text_5 color_666 padding_2per"><?=talk_style_data($member_data['m_character'], $member_data['m_sex'])?></div>
				</td>
			</tr>
		</table>
	</div>
	
	
	<? if(@$this->session->userdata['m_userid'] != $recv_id){ ?>
	<img src="<?=IMG_DIR?>/m/talk_chat_btn.png" class="margin_left_4per margin_bottom_3per margin_top_3per width_92per pointer" onclick="javascript:member_profile_chatting_request('<?=@$this->session->userdata['m_userid']?>', '<?=$member_data['m_userid']?>')"> 
	<? } ?>