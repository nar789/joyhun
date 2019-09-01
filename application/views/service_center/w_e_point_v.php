<div class="event_con">
	<div class="height_250"></div>
	<div class="w_e_point_txt_box text-center"><b><?=str_replace("-", "월", date('m-d'))."일"?></b> 획득포인트</div>
	<div class="w_e_point_txt_box_second text-center">
		<b><?=$w_point?>P</b>
		<b></b>
	</div>
	<div class="w_e_btn_box text-center">
		<a href="#"><img src="<?=IMG_DIR?>/service_center/w_e_btn_<?=$img_gubn?>.png" <?if(!empty($w_function)){?> onclick="javascript:<?=$w_function?>('<?=$img_gubn?>', '<?=$user_id?>', '<?=$w_point?>');" <?}?>></a>
	</div>
	<div class="w_e_btn_box_bot text-center">
		<a href="/gift_shop/gift/gift_list"><img src="<?=IMG_DIR?>/service_center/w_e_btn_bot.png"></a>
	</div>

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>



