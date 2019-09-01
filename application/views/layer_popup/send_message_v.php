<div class="layout_padding">
	<div class="alarm_chat_area">
		<p class="font-size_14 color_333">
			<?=$mdata['m_nick']?> 
			<span class="font-size_12 color_999"><?=$mdata['m_conregion']?> / <?=$mdata['m_age']?>세</span>
			<span>(무료 잔여횟수 : <font style="color:#000;"><?=$cnt?></font> / <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>)</span>
		</p>
		
		<div class="margin_top_10 swrap">
			<a href="#" onclick="javascript:member_photo_view_pop('<?=$mdata['m_userid']?>');"><?=$this->member_lib->member_thumb($mdata['m_userid'], 123, 124)?></a>
			<textarea class="alarm_chat_text ver_top" placeholder="메세지를 입력해주세요." id="v_msg" name="v_msg"></textarea>
			<span id="counter">0/100</span>
		</div>
	</div>

	<div class="alarm_chat_guid">
		<ul style="padding:10px;">					

			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> 월 <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>회까지 메세지 전송 무료</li>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>회 이상 시 건당 10포인트가 차감됩니다.</li>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> <?=$mdata['m_nick']?>님과 즐거운 시간 되세요.</li>

		</ul>
	</div>

	<div class="margin_top_19 text-center padding_bottom_10">
		<input type="button" class="text_btn_de4949 alarm_chat_btn width_110" value="메세지 보내기" onclick="javascript:send_message_cnt_chk('<?=$this->session->userdata['m_userid']?>', '<?=$mdata['m_userid']?>', '<?=$cnt?>');">
	</div>
</div>
