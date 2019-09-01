<div class="padding_top_20 padding_left_20 padding_bottom_20" style="background:#f4f4f4">
	<div class="alarm_chat_area">
		<div class="float_left">
		<p class="font-size_14 color_333">
			<?=$mdata['m_nick']?> 
			<span class="font-size_12 color_999"><?=$mdata['m_conregion']?> / <?=$mdata['m_age']?>세</span>
		</p>
		</div>
		<div class="float_right">
			<div class="text-right pointer float_right" onclick="javascript:complain_request_mes('<?=$mdata['m_userid']?>','360','<?=$mdata['m_nick']?>','<?=$sdata['V_IDX']?>');">
				<img src="<?=IMG_DIR?>/chat/comp_btn.png">
			</div>
			<div class="msg_send_chat float_right margin_right_5">
				<input id="msg_send_chat_btn" type="button" value="채팅신청하기" onclick="chat_request('<?=$mdata['m_userid']?>');">
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		
		<div class="margin_top_5">
			<div class="float_left">
				<a href="#"><?=$this->member_lib->member_thumb($mdata['m_userid'], 123, 124)?></a>
			</div>
			<div class="float_right">
				<textarea class="alarm_chat_text ver_top bg_fcfcfc" id="send_msg" name="send_msg" readonly><?=$sdata['V_CONTENTS']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

		<div class="text-right color_999">
			<?=$sdata['V_WRITE_DATE']?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="padding_left_20 padding_bottom_20">
	<div class="resend_area">
		<p class="font-size_15 color_333 b">
		답장하기
		<? if(@$this->session->userdata['m_sex'] == "M"){ ?>
		<span>(무료 잔여횟수 : <font style="color:#000;"><?=$cnt?></font> / <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>)</span>
		<? } ?>
		</p>

		<div class="margin_top_10 rwrap">
			<textarea class="resend_textarea ver_top" placeholder="메세지를 입력해주세요." id="v_msg" name="v_msg"></textarea>
			<span id="counter">0/100</span>
		</div>

	</div>

	<div class="alarm_chat_guid">
		<ul class="alarm_chat_guid_box">						
			<? if(@$this->session->userdata['m_sex'] == "M"){ ?>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> 월 <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>회까지 메세지 전송 무료</li>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> <? if(@$this->session->userdata['m_sex'] == "M"){ echo "30";}else{echo "300";}?>회 이상 시 건당 10포인트가 차감됩니다.</li>
			<? }else{ ?>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"> <?=$mdata['m_nick']?>님과 즐거운 메세지를 보내세요.</li>
			<? } ?>
		</ul>
	</div>

	<div class="margin_top_19 text-center padding_bottom_10">
		<input type="button" class="text_btn_de4949 alarm_chat_btn width_110" value="답장하기" onclick="javascript:send_message_cnt_chk('<?=$this->session->userdata['m_userid']?>', '<?=$mdata['m_userid']?>', '<?=$cnt?>');">
	</div>
</div>
