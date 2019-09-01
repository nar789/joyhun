<div class="iphone_padding">

	<img src="<?=IMG_DIR?>/m/point_bottom.gif" class="width_100per margin_bottom_18">


	<div class="width_95per margin_auto">
		<div class="my_point">
			<div class="width_95per margin_auto color_fff">
				<div class="float_left blod">내 포인트</div>
				<div class="float_right blod"><?=number_format($total_point)?></div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="width_100per bg_fff">
			<table class="point_pay">
				<?
					if(!@empty($product_list)){
						$i = 0;
						foreach($product_list as $data){
						$i++;

						if(IS_APP and $i == 1){
								continue;
						}
				?>
				<tr>
					<td class="width_33per">
						<input type="radio" class="m_radiobox" id="premium_A_<?=$i?>" name="point_lv" value="<?=$data['m_product_code']?>" <?if($i==2){echo "checked";}?>><label for="premium_A_<?=$i?>" class="color_328dcc blod">
						<? if(IS_APP and APP_OS == "IOS"){ echo $data['m_goods_web_ios']."$"; }else{ echo $data['m_goods_web']; } ?>
						</label>
					</td>
					<td>
						<p class="color_666"><? if(IS_APP and APP_OS == "IOS"){ echo $data['m_goods_web_ios']."$"; }else{ echo number_format($data['m_price'])."원"; } ?> <?=number_format($data['m_point'])?>포인트</p>
						<b class="color_67dbe5"><?=$data['m_etc']?></b>
					</td>
					<td class="width_20per">
						<div><b class="color_fff">+ <?=$data['m_add_per']?>%</b><span class="color_333 blod"> 추가</span></div>
					</td>
				</tr>
				<?
						}
					}else{
				?>
				<tr>
					<td class="width_100per blod height_28 text-center">
						등록된 상품이 없습니다.	
					</td>
				</tr>
				<?
					}
				?>
			</table>
		</div>

		<div class="width_100per margin_top_26">
			<b class="color_333">결제금액을 선택해 주세요.</b>

			<table class="width_100per margin_top_10">
				<tr>

		<? if(IS_APP){ ?>
			<? if(APP_OS == "IOS"){ ?>
					<td class="text-left" style="width:32%">
						<input type="button" class="m_d53b3b_btn width_97per border-radius_2 height_40" value="앱결제" onclick="javascript:apple_payment();">
					</td>
			<? }else{ ?>
					<td class="text-left" style="width:32%">
						<input type="button" class="m_d53b3b_btn width_97per border-radius_2 height_40" value="구글결제" onclick="javascript:google_payment();">
					</td>
			<? } ?>
					
		<?}else{?>
					<td class="width_33per">
						<input type="button" class="m_d53b3b_btn width_97per border-radius_2 height_40" value="신용카드" onclick="javascript:payment_mobile('card', 'v');">
					</td>
					<td class="width_33per">
						<input type="button" class="m_d53b3b_btn width_97per border-radius_2 height_40" value="휴대폰결제" onclick="javascript:payment_mobile('hp', 'v');">
					</td>
		<?}?>
		<? if(IS_APP and APP_OS == "IOS"){ ?>
		<? }else{ ?>
					<td class="width_33per">
						<input type="button" class="m_d53b3b_btn width_97per border-radius_2 height_40" value="무통장입금" onclick="javascript:payment_mobile('mu', 'v');">
					</td>
		<? } ?>
				</tr>
			</table>
		</div>
	</div>

	<!--div id="v_loading" style="position:absolute; width:100%; top:0%; left:0%; text-align:center; display:none;">
		<img src="<?=IMG_DIR?>/etc/loading.gif">
	</div-->

		<div style="position:absolute;top:200px;left:0;width:100%;height:100%;text-align:center;display:none;" id="pay_loading">
			<span style="display:inline-block;background:#fff;vertical-align:middle;"><img src="/images/Loading_icon.gif" border="0" style="width:250px;"></span><br>
			<span style="display:inline-block;background:#fff;vertical-align:middle;font-size:12px;font-weight:bold;width:250px;text-align:center;">결제가 진행중입니다.<br>잠시만 기다려주세요.</span>
		</div>


	<? if(IS_APP and APP_OS == "IOS"){ ?>
	<? }else{ ?>
	<div class="margin_top_7per text-center">
		<img src="<?=IMG_DIR?>/m/m_point_img.jpg" class="width_94per">
	</div>
	<? } ?>

	<div class="margin_top_7per">
		<img src="<?=IMG_DIR?>/m/m_p_rank.gif" class="width_100per">
	</div>

		<!--<input type=button value="ref" onclick="restorePurchases();">-->
</div>