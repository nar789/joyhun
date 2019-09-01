
<img src="<?=IMG_DIR?>/m/secession_top.gif" class="width_100per">


<!--div class="width_100per margin_top_7 margin_bottom_16">
	<div class="now_online_li">&nbsp;</div>
	<div class="now_online_hr"><p class="now_online_title">&nbsp;인증&nbsp;</p></div>
	<div class="clear"></div>
</div>

<div class="bg_fefefe">
	<div class="secession_text">
		실명인증을 통해 본인확인 후 탈퇴가 가능합니다.
		<div class="width_20per float_right">
			<input type="button" class="m_fbfbfb_btn" value="실명인증">
		</div>
	</div>
</div-->

<div class="width_100per margin_top_7 margin_bottom_16">
	<div class="now_online_li">&nbsp;</div>
	<div class="now_online_hr"><p class="now_online_title">&nbsp;현재비밀번호&nbsp;</p></div>
	<div class="clear"></div>
</div>

<div class="bg_fefefe">
	<div class="secession_text">
		현재비밀번호를 입력하세요.
		<div class="width_50per float_right">
			<input type="password" class="m_ffffff_btn" id="m_pwd" name="m_pwd" value="" maxlength="12">
		</div>
	</div>
</div>

<div class="width_100per margin_top_7 margin_bottom_16">
	<div class="now_online_li">&nbsp;</div>
	<div class="now_online_hr"><p class="now_online_title">&nbsp;탈퇴사유&nbsp;</p></div>
	<div class="clear"></div>
</div>

<div class="bg_fefefe">
	<div class="m_profile_table_area padding_top_10 padding_bottom_10">
		<table class="mobile_border_table">
			<tr>
				<td class="ver_top padding_top_10">사유</td>
				<td class="ver_top padding_10 line-height_20">
					<input type="radio" class="m_radiobox" id="secession_1" name="secession"><label for="secession_1" class="color_666">&nbsp;&nbsp;&nbsp;이성과의 만남이 이루어지지 않아서</label><br>
					<input type="radio" class="m_radiobox" id="secession_2" name="secession"><label for="secession_2" class="color_666">&nbsp;&nbsp;&nbsp;불량회원 때문에</label><br>
					<input type="radio" class="m_radiobox" id="secession_3" name="secession"><label for="secession_3" class="color_666">&nbsp;&nbsp;&nbsp;컨텐츠가 부족해요</label><br>
					<input type="radio" class="m_radiobox" id="secession_4" name="secession"><label for="secession_4" class="color_666">&nbsp;&nbsp;&nbsp;사이트가 너무 느려요</label><br>
					<input type="radio" class="m_radiobox" id="secession_5" name="secession"><label for="secession_5" class="color_666">&nbsp;&nbsp;&nbsp;사이트가 불안정해요</label><br>
					<input type="radio" class="m_radiobox" id="secession_6" name="secession"><label for="secession_6" class="color_666">&nbsp;&nbsp;&nbsp;사적인이유</label><br>
					<!--input type="radio" class="m_radiobox" id="secession_7" name="secession"><label for="secession_7" class="color_666">&nbsp;&nbsp;&nbsp;기타(기타 탈퇴사유를 기입해주세요)</label><br-->
					<p style="color:#666666;">기타(기타 탈퇴사유를 기입해주세요)</p>
					<textarea class="m_textarea" id="secession_text" name="secession_text" value=""></textarea>
				</td>
			</tr>
		</table>
	</div>
</div>

<div class="width_30per margin_auto">
	<input type="button" class="m_aeaeae_btn margin_top_18 margin_bottom_18 height_40" value="탈퇴하기" onclick="javascript:total_mem_out();">
</div>