
<div class="layout_padding">

	<div class="dor_mb_top">
		<p class="color_333 line-height_18 <? if(IS_MOBILE == true){?>padding_top_10 padding_bottom_10<?}else{?>padding_top_30 padding_bottom_30<?}?>">가입하신 휴대폰
			<b class="color_ea3c3c font-size_14"><?=$my_hp1?>-****-<?=$my_hp3?></b>
		으로<? if(IS_MOBILE == true){?><br><?}?>인증문자를 보내드립니다.</p>
	</div>

	<div class="padding_top_20 text-center">
		<input type="button" class="text_btn_de4949 width_110 height_30" value="인증코드 받기" onclick="javascript:my_join_phone();">
	</div>

	<div id="dor_join_show">
		<div class="dor_mb_bottom height_108">
			<p class="color_666 margin_bottom_10 padding_top_18">인증코드를 확인해주세요.</p>
			<input type="text" class="width_130 <? if(IS_MOBILE == true){?>height_30<?}else{?>height_20<?}?>" id="check_num" maxlength="6">
			<input type="button" class="text_btn2_ea3e3e <? if(IS_MOBILE == true){?>height_32<?}else{?>height_22<?}?> width_40 margin_left_2" value="확인" onclick="javascript:my_join_phone_ok();">
			<p class="color_999 margin_top_7">(환경에따라 도착시까지 <? if(IS_MOBILE == false){?>1~<?}?>5분정도 소요될 수 있습니다.)</p>
		</div>
	</div>

</div>