<div class="posi_rel">
	<img src="<?=IMG_DIR?>/layer_popup/gift_shop_banner.gif" class="margin_top_mi_2 ">
	<div class="gift_shop_text">
		<b>보유포인트:</b>
		<b><?=number_format($total_point)?>P</b>
	</div>
	<div class="padding_20 text-center bg_f4f5f7 height_230">
		<div class="border_1_dddddd block width_31per pointer" onclick="javascript:gift_shop('<?=$mode?>', '<?=$user_id?>', '음료');">
			<img src="<?=IMG_DIR?>/layer_popup/gift_shop_01.gif">
		</div>
		<div class="border_1_dddddd block width_31per margin_left_1per pointer" onclick="javascript:gift_shop('<?=$mode?>', '<?=$user_id?>', '편의점');">
			<img src="<?=IMG_DIR?>/layer_popup/gift_shop_02.gif">
		</div>
		<div class="border_1_dddddd block width_31per margin_left_1per pointer" onclick="javascript:gift_shop('<?=$mode?>', '<?=$user_id?>', '베이커리');">
			<img src="<?=IMG_DIR?>/layer_popup/gift_shop_03.gif">
		</div>
		<div class="padding_top_20"></div>
		<div class="border_1_dddddd block width_31per pointer" onclick="javascript:gift_shop('<?=$mode?>', '<?=$user_id?>', '패스트푸드');">
			<img src="<?=IMG_DIR?>/layer_popup/gift_shop_04.gif">
		</div>
		<div class="border_1_dddddd block width_31per margin_left_1per pointer" onclick="javascript:gift_shop('<?=$mode?>', '<?=$user_id?>', '아이스크림');">
			<img src="<?=IMG_DIR?>/layer_popup/gift_shop_05.gif">
		</div>
	</div>
</div>
