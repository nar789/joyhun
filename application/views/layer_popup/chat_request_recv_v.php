

<div class="layout_padding">
	<div class="alarm_chat_area">
		<p class="font-size_14 color_333"><?=$m_nick?> <span class="font-size_12 color_999"><?=$add_text?></span></p>
		
		<div class="margin_top_10">
			<a href="#"><?=$this->member_lib->member_thumb($m_userid,123,124)?></a>
			<textarea class="alarm_chat_text ver_top" placeholder="입력해주세요" id="sin_msg" name="sin_msg"></textarea>
		</div>
	</div>


	<div class="alarm_chat_guid height_43">
		<ul class="alarm_chat_guid_box">
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">비밀을 보장해 드립니다. 용기내어 채팅수락해 주세요! </li>
		</ul>
	</div>

	<div class="width_100per margin_auto select_box_border">
		<select class="height_28 width_100per bg_position_98 margin_top_20 text_5" id="deny_msg">
			<option value="">거절메세지를 선택할 수 있습니다.</option>
			<?
				foreach( chat_deny_msg('all') as $key => $val ){	//code change helper
					echo "<option value='$key'>$val</option>";
				}
			?>
			
		</select>
	</div>


	<div class="margin_top_19 text-center padding_bottom_10">
		<input type="button" class="text_btn2_ea3e3e alarm_chat_btn width_95" value="거절하기">
		<input type="button" class="text_btn_de4949 alarm_chat_btn width_95" value="수락하기" onclick="chat_submit('<?=$m_userid?>');">
	</div>
</div>