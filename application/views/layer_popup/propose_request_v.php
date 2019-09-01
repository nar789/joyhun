	<div class="layout_padding">
		<div class="beongae_popup_imgbox pointer" onclick="javascript:member_photo_view_pop('<?=$mlist['m_userid']?>');">
			<?=$this->member_lib->member_thumb($mlist['m_userid'],74,71)?>
		</div>

		<div class="beongae_popup_contentbox">
			<p class="blod line-height_18 color_333"><?=$mlist['m_nick']?> (<?=$mlist['m_age']?>)</p>

			<p class="color_999 line-height_18">
				<?=$mlist['m_conregion']?><br><?=want_reason_data($mlist['m_reason'])?><br><?=$mlist['m_writedate']?><br>
			</p>
		</div>
		<textarea class="beongae_popup_textarea" placeholder="내용을 입력해 주세요" id="my_msg" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_71 height_30" value="보내기" onclick="javascript:p_submit('<?=$mlist['m_idx']?>','<?=$mlist['m_userid']?>');">
		</div>
	</div>