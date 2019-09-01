<div class="content">

	<div class="left_main">
		<div>
			<img src="<?=IMG_DIR?>/gift_shop/gift_shop_top_banner.gif">
		</div>
		<div class="gift_box_point">
			<b>보유포인트 </b>
			<b><?=number_format($total_point)?>P</b>
		</div>

		<div class="margin_top_50">
			<table border="0" cellpadding="0" cellspacing="10" id="tabs"> 
				<tr>
					<td class="gift_tab_on pointer" onclick="javascript:tab_menu_click('커피/음료');">
						<img src="<?=IMG_DIR?>/gift_shop/gift_shop_ic01.gif">
						<div><b>커피/음료</b></div>		
					</td>
					<td class="gift_tab_off pointer" onclick="javascript:tab_menu_click('마트/편의점');">
						<img src="<?=IMG_DIR?>/gift_shop/gift_shop_ic02.gif">
						<div><b>마트/편의점</b></div>
					</td>
					<td class="gift_tab_off pointer" onclick="javascript:tab_menu_click('베이커리/도넛');">
						<img src="<?=IMG_DIR?>/gift_shop/gift_shop_ic03.gif">
						<div><b>베이커리/도넛</b></div>
					</td>
					<td class="gift_tab_off pointer" onclick="javascript:tab_menu_click('버거/피자');">
						<img src="<?=IMG_DIR?>/gift_shop/gift_shop_ic04.gif">
						<div><b>버거/피자</b></div>
					</td>
					<td class="gift_tab_off pointer" onclick="javascript:tab_menu_click('아이스크림');">
						<img src="<?=IMG_DIR?>/gift_shop/gift_shop_ic05.gif">
						<div><b>아이스크림</b></div>
					</td>
				</tr>
			</table>
		</div>	
		<? 
			//선물상점 선물 리스트
			if($getTotalData > 0){ 
		?>
		<div class="tab_content">
			<div class="margin_top_20 margin_left_10"><b class="font-size_20"><?=$category?></b></div>
			<div class="gift_list">
				<ul>
					<? foreach($mlist as $data){ ?>
					<li>
						<div class="gift_box" onclick="javascript:gift_detail('list', '<?=$data['V_IDX']?>', '');">
							<div>
								<div><img src="/upload/product_upload/gift/<?=$data['V_IMG_URL']?>"></div>
								<div><?=$data['V_PRODUCT_NAME']?></div>
								<div><?=number_format($data['V_PRICE_P'])?>P</div>
							</div>
						</div>					
					</li>
					<? } ?>
				</ul>
			</div>
		</div>
		<? 
			}else{
		?>
		<?
			}
		?>
		<div class="list_pg margin_top_33">
			<div>
				<?=$pagination_links?>
			</div>
		</div>
		

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	
</div>
