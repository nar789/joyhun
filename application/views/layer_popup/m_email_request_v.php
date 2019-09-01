
<div class="layout_padding">

	<div class="dor_mb_top">
		<p class="color_333 line-height_18 padding_top_30 padding_bottom_30">가입하신 이메일
		<b class="color_ea3c3c font-size_14"><?=$email_id?><?=$email_hidden?>@<?=$email_sub?></b>으로 인증메일을 보내드립니다.</p>
	</div>

	<div class="padding_top_20 text-center" id="recv_email">
		<input type="button" class="text_btn_de4949 width_110 height_30" value="인증메일 받기" onclick="javascript:dor_mb_mail('<?=$email_sub?>'); this.disabled=true; ">
	</div>

	<div id="dor_mail_show">
		<div class="dor_mb_bottom height_50 line-height_50">
			<span class="color_666">인증메일을 확인해주세요.</span><span class="color_999">(환경에따라 도착시까지 1~5분정도 소요될 수 있습니다.)</span>
		</div>
	</div>

	<div class="padding_top_20 text-center" id="chekd_email">
		<input type="button" class="text_btn_de4949 width_180 height_30" value="여기를 클릭해주세요." onclick="javascript:my_email_ok();">
	</div>
</div>