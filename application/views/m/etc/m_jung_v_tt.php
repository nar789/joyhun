<div class="iphone_padding">

	<div class="pay_btn_box_first">
		<div class="pay_text">
			<div class="width_100per">
				<div>
					<input type="radio" class="m_radiobox" id="premium_A_4" name="point_lv" value="2003">
					<label for="premium_A_4" class="color_ea3c3c blod"><? if(IS_APP and APP_OS == "IOS"){ echo "219.99$"; }else{ echo "20만원"; } ?></label>
				</div>
			</div>
		</div>
	</div>
	<div class="pay_btn_box_02">
		<div class="pay_text">
			<div class="width_100per">
				<div>
					<input type="radio" class="m_radiobox" id="premium_A_3" name="point_lv" value="2002">
					<label for="premium_A_3" class="color_ea3c3c blod"><? if(IS_APP and APP_OS == "IOS"){ echo "109.99$"; }else{ echo "10만원"; } ?></label>
				</div>
			</div>
		</div>
	</div>
	<div class="pay_btn_box_03">
		<div class="pay_text">
			<div class="width_100per">
				<div>
					<input type="radio" class="m_radiobox" id="premium_A_2" name="point_lv" value="2001" checked>
					<label for="premium_A_2" class="color_ea3c3c blod"><? if(IS_APP and APP_OS == "IOS"){ echo "54.99$"; }else{ echo "5만원"; } ?></label>
				</div>
			</div>
		</div>
	</div>
	<div class="pay_btn_box_04">
		<div class="pay_text">
			<div class="width_100per">
				<div>
					<input type="radio" class="m_radiobox" id="premium_A_1" name="point_lv" value="5010">
					<label for="premium_A_1" class="color_ea3c3c blod"><? if(IS_APP and APP_OS == "IOS"){ echo "5010"; }else{ echo "3만원"; } ?></label>
				</div>
			</div>
		</div>
	</div>


	<div class="pay_btn_box">
		<table class="width_80per margin_auto">
			<tr>
	<? if(IS_APP){ ?>
		<? if(APP_OS == "IOS"){ ?>
				<td class="text-left" style="width:32%">
					<input type="button" class="text_btn_de4949 pay_btn" value="앱결제" onclick="javascript:apple_payment();">
				</td>
		<? }else{ ?>
				<td class="text-left" style="width:32%">
					<input type="button" class="text_btn_de4949 pay_btn" value="구글결제" onclick="javascript:google_payment();">
				</td>
		<? } ?>
				
	<?}else{?>
				<td class="text-left" style="width:32%">
					<input type="button" class="text_btn_de4949 pay_btn" value="신용카드" onclick="javascript:payment_mobile('card');">
				</td>
				<td style="width:2%"></td>
				<td class="text-center" style="width:32%">
					<input type="button" class="text_btn_de4949 pay_btn" value="휴대폰결제" onclick="javascript:payment_mobile('hp');">
				</td>
	<?}?>
	<? if(IS_APP and APP_OS == "IOS"){ ?>
	<? }else{ ?>
				<td style="width:2%"></td>
				<td class="text-right" style="width:32%">
					<input type="button" class="text_btn_de4949 pay_btn" value="무통장입금" onclick="javascript:payment_mobile('mu');">	
				</td>
	<? } ?>
			</tr>
		</table>
	</div>
	<div>
		<img src="<?=IMG_DIR?>/m/m_first_point.png" class="width_100per">
	</div>

</div>

	<div style="position:absolute;top:200px;left:0;width:100%;height:100%;text-align:center;display:none;" id="pay_loading">
		<span style="display:inline-block;background:#fff;vertical-align:middle;"><img src="/images/Loading_icon.gif" border="0" style="width:250px;"></span><br>
		<span style="display:inline-block;background:#fff;vertical-align:middle;font-size:12px;font-weight:bold;width:250px;text-align:center;">결제가 진행중입니다.<br>잠시만 기다려주세요.</span>
	</div>

<? if(IS_APP and APP_OS == "IOS"){ ?>
<? }else{ ?>
<div class="margin_top_7per" style="text-align:center;">
	<img src="<?=IMG_DIR?>/m/m_point_img.jpg" class="width_94per">
</div>
<? } ?>
<div class="margin_top_7per">
	<img src="<?=IMG_DIR?>/m/m_p_rank.gif" class="width_100per">
</div>