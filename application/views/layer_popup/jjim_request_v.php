


		<div class="bg_f4f4f4 height_103">
			<div class="padding_top_20 padding_left_20">
				<div class="popup_img_S ver_mid float_left pointer" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');">
					<?=$this->member_lib->member_thumb($m_userid, 77, 72)?>
				</div>
				<div class="float_right width_168 margin_top_23">
					<span class="blod color_ea3c3c"><?=$m_nick?></span>
					<p class="color_999 margin_top_3">님을 찜하였습니다.</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="padding_top_10 padding_left_20">			
			<textarea class="friend_textarea" placeholder="한줄메모" id="jjim_memo" maxlength="100" onkeyup="return textarea_maxlength(this)"></textarea>
		</div>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_85 height_30" value="찜 하기" onclick="javascript:jjim_add_chk('<?=$m_userid?>','<?=$m_nick?>','<?=$m_sex?>');"/>
		</div>

		<div class="height_30"></div>

