	<div class="layout_padding">
		<div class="beongae_popup_imgbox pointer" onclick="javascript:member_photo_view_pop('<?=$mlist['b_userid']?>');">
			<?=$this->member_lib->member_thumb($mlist['b_userid'],74,71)?>
		</div>
		<div class="beongae_popup_contentbox">
			<b class="color_333 font-size_12 font_900"><?=$mlist['m_nick']?> (<?=$mlist['b_age']?>세)</b>
			<div class="padding_top_9">
				<table cellspacing="0">
					<tr>
						<td class="width_80 height_17 color_666 font-size_12">원하는 지역</td>
						<td class="color_999"><?=$mlist['b_region']?></td>
					</tr>
					<tr>
						<td class="width_80 height_17 color_666 font-size_12">원하는 날짜</td>
						<td class="color_999"><?=str_replace("-",".",$mlist['b_day'])?></td>
					</tr>
					<tr>
						<td class="width_80 height_17 color_666 font-size_12">원하는 시간</td>
						<td class="color_999"><?=want_time_text($mlist['b_time'])?></td>
					</tr>
				</table>
			</div>
		</div>

		<textarea class="beongae_popup_textarea" placeholder="신청메세지를 입력해 주세요" id="my_msg" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_120 height_30" value="번개팅 요청하기" onclick="b_submit('<?=$idx?>','<?=$mlist['b_userid']?>');">
		</div>
	</div>
