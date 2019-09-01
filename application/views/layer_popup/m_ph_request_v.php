
<div class="layout_padding">

	<div class="dor_mb_top">
		<p class="color_333 line-height_18 padding_top_30 padding_bottom_30">가입하신 <b class="color_ea3c3c font-size_14">본인명의와 일치하는 휴대폰으로<? if(IS_MOBILE == true){?><br><?}?>본인 인증</b>을 받으실 수 있습니다.<br>
		가족 또는 타인의 휴대폰은 인증이 불가능합니다.</p>
	</div>

	<div class="padding_top_20 text-center">
		<input type="button" class="text_btn_de4949 width_110 height_30" value="본인인증하기" onclick="javascript:name_check(); this.disabled=true;">
		<!--input type="button" class="text_btn_de4949 width_110 height_30" value="본인인증하기" onclick="javascript:phone_pop('3', '<?=$this->session->userdata('user')?>'); this.disabled=true;"-->
	</div>

</div>