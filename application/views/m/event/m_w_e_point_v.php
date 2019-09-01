<div class="m_event_con">
	<img src="<?=IMG_DIR?>/m/m_w_e_point_bg.jpg" style="width:100%;">
	<div class="m_w_e_point_first_box">
		<div class="m_w_e_point_txt_box">
			<b><?=str_replace("-", "월", date('m-d'))."일"?></b>
			획득포인트
		</div>
		<div class="m_w_e_point_txt_box_second">
			<b><?=$w_point?>P</b>
			<b></b>
		</div>
		<div class="w_e_btn_box">
			<img src="<?=IMG_DIR?>/service_center/w_e_btn_<?=$img_gubn?>.png" <?if(!empty($w_function)){?> onclick="javascript:<?=$w_function?>('<?=$img_gubn?>', '<?=$user_id?>', '<?=$w_point?>');" <?}?>>
		</div>
		<div class="w_e_btn_box_bot">
			<a href="javascript:gift_shop('list', '<?=$user_id?>', 'shop');"><img src="<?=IMG_DIR?>/service_center/w_e_btn_bot.png"></a>
		</div>
	</div>
</div>

