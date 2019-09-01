<img src="<?=IMG_DIR?>/layer_popup/point_title.jpg">

<div class="padding_20">
	<div class="point_list_title">
		<div class="float_left blod font-size_20 color_fff padding_left_20">내 포인트</div>
		<div class="float_right font-size_20 color_fff padding_right_20"><?=number_format($t_point)?><!--포인트--></div>
	</div>

	<div class="charge_list">
		<?
			if(is_array($mlist) == "1"){
				foreach($mlist as $data){
		?>
		<div class="charge">
			<div class="float_left width_127 radio_box">
				<input type="radio" id="point_Lv_<?=$data['m_idx']?>" name="point_Lv" value="<?=$data['m_product_code']?>" <?if($data['m_idx'] == '3'){ echo "checked"; } ?> >
				<label for="point_Lv_<?=$data['m_idx']?>" class="margin_top_4"></label>
				<span class="color_328dcc font-size_20 blod"><?=$data['m_goods_web']?></span>
			</div>
			<div class="float_left width_182 line-height_22 margin_top_mi_2">
				<p class="color_666 font-size_13"><b style="font-size:1.1em;"><?=number_format($data['m_point']-$data['m_add_point'])?>포인트</b> <b style="font-size:1.0em; color:#22CDDC;">+ <?=number_format($data['m_add_point'])?>포인트</b></p>
			</div>
			<div class="float_left">
				<div class="charge_badge">
					<b class="font-size_15 color_fff">+<?=$data['m_add_per']?>%</b><b class="font-size_15 color_333"> 추가</b>
				</div>
			</div>

		</div>
		<?
				}
			}
		?>
	</div>

	<div class="point_charge_list">
		<b class="color_333 font-size_16 block margin_top_18">결제방법을 선택해 주세요.</b>
		<div class="charge_btn margin_top_11">
			<div onclick="javascript:purchase_product('hp');">
				<img src="<?=IMG_DIR?>/profile/payment_1.gif"><b class="color_fff font-size_18 ver_top">휴대폰결제</b>
			</div>
			<div onclick="javascript:purchase_product('card');">
				<img src="<?=IMG_DIR?>/profile/payment_2.gif"><b class="color_fff font-size_18 ver_top">카드결제</b>
			</div>
			<div onclick="javascript:purchase_product('account');">
				<img src="<?=IMG_DIR?>/profile/payment_3.gif"><b class="color_fff font-size_18 ver_top">계좌이체</b>
			</div>
			<!--div onclick="alert('해외카드');">
				<img src="<?=IMG_DIR?>/profile/payment_4.gif"><b class="color_fff font-size_18 ver_top">해외카드</b>
			</div-->
			<div onclick="javascript:purchase_product('pb');">
				<img src="<?=IMG_DIR?>/profile/payment_5.gif"><b class="color_fff font-size_18 ver_top">일반전화</b><b class="color_fff ver_top">(받기)</b>
			</div>
			<div onclick="javascript:purchase_product('tp');">
				<img src="<?=IMG_DIR?>/profile/payment_6.gif"><b class="color_fff font-size_18 ver_top">일반전화</b><b class="color_fff ver_top">(걸기)</b>
			</div>
			<!--div onclick="alert('카드포인트');">
				<img src="<?=IMG_DIR?>/profile/payment_7.gif"><b class="color_fff font-size_18 ver_top">카드포인트</b>
			</div-->
			<!--div onclick="alert('티머니 결제');">
				<img src="<?=IMG_DIR?>/profile/payment_8.gif"><b class="color_fff font-size_18 ver_top">티머니 결제</b>
			</div-->
			<div onclick="javascript:purchase_product('bk');">
				<img src="<?=IMG_DIR?>/profile/payment_9.gif"><b class="color_fff font-size_18 ver_top">가상계좌</b>
			</div>
			<div onclick="javascript:purchase_product('mu');">
				<img src="<?=IMG_DIR?>/profile/payment_9.gif"><b class="color_fff font-size_18 ver_top">무통장 입금</b>
			</div>
		</div>
	</div>

	<div class="height_20"></div>

</div>

