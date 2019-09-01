		<div class="bg_f4f4f4 height_103">
			<div class="padding_top_20 padding_left_20">
				<div class="popup_img_S ver_mid pointer" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');">
					<?=$this->member_lib->member_thumb($m_userid,74,71)?>
				</div>
				<div class="block text-center margin_left_16">
					<b class="color_999"><span class="color_ea3c3c"><?=$m_nick?></span> 님을<br>나의 앤으로 등록합니다.</b>
				</div>
			</div>
		</div>

		<div class="padding_top_10 padding_left_20">
			<textarea class="friend_textarea" placeholder="한줄메모" id="anne_memo" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
		</div>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_85 height_30" value="등록하기" onclick="anne_submit('<?=$m_userid?>','<?=$m_nick?>');">
		</div>

		<div class="height_30"></div>