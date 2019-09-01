
<div class="pos_fixed">
	<img src="<?=IMG_DIR?>/layer_popup/gift_top_img.png">
</div>
<div class="gift_list_first">
	<ul>
		<? foreach($gift_list as $data){ ?>
		<li onclick="javascript:gift_detail('<?=$mode?>', '<?=$data['V_IDX']?>', '<?=$user_id?>');">
			<div class="m_gift_box pointer">
				<div><img src="/upload/product_upload/gift/<?=$data['V_IMG_URL']?>"></div>
				<div><?=$data['V_PRODUCT_NAME']?></div>
				<div><?=$data['V_PRICE_P']?>P</div>
			</div>
		</li>
		<? } ?>
	</ul>
</div>
