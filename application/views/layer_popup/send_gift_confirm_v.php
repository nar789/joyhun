<div class="gift_confirm_contents">
	<div class="tit_img">
		<div class="tit">
			<?=$gift_data['V_PRODUCT_NAME']?>
		</div>
		<div class="img">
			<div>
				<img src="/upload/product_upload/gift/<?=$gift_data['V_IMG_URL']?>">
			</div>
		</div>
		<div class="alrim">
			선물보내기 버튼을 누르시면<br>
			<?=number_format($gift_data['V_PRICE_P'])?>포인트가 차감됩니다.<br>
			선물을 보내시겠습니까?
		</div>
	</div>
	<div class="btn_box">
		<div class="box_1">
			<input type="button" id="" name="" value="선물보내기" onclick="javasript:send_gift<?=$gubn?>('<?=$mode?>', '<?=$idx?>', '<?=$user_id?>');">
		</div>
		<div class="box_2">
			<input type="button" id="" name="" value="닫기" onclick="javasript:modal.close();">
		</div>
	</div>
</div>
