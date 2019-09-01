<div class="gift_datail_first_box" <?=$pop_style?>>
	<div class="gift_img_box">
		<div class="margin_auto" style="text-align:center;">
			<img src="/upload/product_upload/gift/<?=$gift_data['V_IMG_URL']?>">
		</div>
		<div class="text-center margin_top_5"><b><?=$gift_data['V_PRODUCT_NAME']?></b></div>
		<div class="text-center margin_top_8">
			<? if($mode == "chat"){ ?>
			<a href="javascript:chk_send_gift('<?=$mode?>', '<?=$gift_data['V_IDX']?>', '<?=$user_id?>');"><img src="<?=IMG_DIR?>/layer_popup/gift_datail_btn.gif"></a>
			<? }else if($mode == "request"){ ?>
			<input type="button" id="gift_request_btn" name="gift_request_btn" value="선물조르기" class="gift_req_btn" onclick="javascript:call_chat_gift_request('<?=$mode?>', '<?=$gift_data['V_IDX']?>', '<?=$user_id?>');">
			<? }else{ ?>
				<input type="button" id="btn_gift_me" name="btn_gift_me" value="나에게선물하기" style="border:0; width:165px; height:40px; font-size:1.1em; color:#fff; background-color:#D53B3B; font-weight:bold;" onclick="javascript:chk_send_gift('<?=$mode?>', '<?=$gift_data['V_IDX']?>', '<?=$this->session->userdata['m_userid']?>');">
				<!--b style="color:#E06B7A; font-size:1.2em;">선물조르기는 채팅창 내에서<br>가능합니다.</b-->
			<? } ?>
		</div>
	</div>
	<div class="gift_list_bd"></div>
	<div class="gift_list_point">
		<div>
			<b>보유포인트</b>
			<b><?=number_format($total_point)?>P</b>
		</div>
		<div class="clear"></div>
	</div>
	<div class="gift_list_bd_top"></div>
	<div class="gift_list_point">
		<div>
			<b class="color_fe1527">결제포인트</b>
			<b class="color_fe1527"><?=number_format($gift_data['V_PRICE_P'])?>P</b>
		</div>
		<div class="clear"></div>
	</div>
	<div class="gift_list_text_box">
		<img src="<?=IMG_DIR?>/layer_popup/gift_datail_saemple02.gif">상품설명
		<textarea id="gift_contents_1" name="gift_contents_1" class="gift_contents_1" readonly style="margin-bottom:20px;"><?=$gift_data['V_CONTENTS_1']?></textarea>
		<!--img src="<?=IMG_DIR?>/layer_popup/gift_datail_saemple02.gif">이용안내
		<textarea id="gift_contents_2" name="gift_contents_2" class="gift_contents_2" readonly><?=$gift_data['V_CONTENTS_2']?></textarea-->
	</div>
	<!--div class="gift_img_box">
		<div class="gift_btn_box">
			<a href=""><img src="<?=IMG_DIR?>/layer_popup/gift_datail_btn.gif"></a>
		</div>
	</div-->
</div>
