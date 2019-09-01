	<?if($m_type == "결혼신청" || $m_type == "재혼신청" || $m_type == "공개구혼"){?>

	<div class="layout_padding">
		<div class="beongae_popup_imgbox pointer" onclick="javascript:member_photo_view_pop('<?=$p_userid?>');">
			<?=$this->member_lib->member_thumb(@$p_userid,74,71)?>
		</div>

		<div class="beongae_popup_contentbox">
			<p class="blod line-height_18 color_333"><?=$m_nick?> (<?=@$m_age?>)</p>

			<p class="color_999 line-height_18">
				<?=@$m_conregion?><br><?=@$m_job?><br><?=@$m_writedate?><br>
			</p>
		</div>
		<textarea class="beongae_popup_textarea" placeholder="내용을 입력해 주세요" id="m_content" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_71 height_30" value="보내기" onclick="javascript:reg_propose('<?=$m_type?>', '<?=$m_nick?>', '<?=$p_userid?>', '<?=$m_idx?>');">
		</div>
	</div>

	<?}else{?>

	<!-- 공개구혼 
	<input type="hidden" id="p_age" name="p_age" value="<?=@$mlist['b_age']?>">
	<input type="hidden" id="p_conregion" name="p_conregion" value="<?=@$mlist['b_region']?>">
	<input type="hidden" id="p_conregion2" name="p_conregion2" value="">
	-->

	<div class="layout_padding">
		<div class="beongae_popup_imgbox">
			<?=$this->member_lib->member_thumb(@$b_userid,74,71)?>
		</div>

		<div class="beongae_popup_contentbox">
			<p class="blod line-height_18 color_333"><?=$m_nick?> (<?=@$mlist['b_age']?>)</p>

			<p class="color_999 line-height_18">
				<?=@$mlist['b_region']?><br><?=@$mlist['b_job']?><br><?=@$mlist['b_writedate']?><br>
			</p>
		</div>
		<textarea class="beongae_popup_textarea" placeholder="내용을 입력해 주세요" id="m_content" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_71 height_30" value="보내기" onclick="javascript:reg_propose('<?=$this->session->userdata['m_userid']?>', '<?=$b_type?>', '<?=$m_nick?>',  '<?=$b_userid?>', '<?=$b_num?>');">
		</div>
	</div>

	<?}?>

