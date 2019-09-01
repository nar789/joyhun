<div class="padding_20">
	<div class="bg_e7f4ff text-center padding_20 line-height_16 border-radius_4">
		<b>핸드폰 :</b>
		<b class="color_ea3c3c"><?=$phone_num?></b>
		<p class="color_666">위 번호로 선물을 받으시겠습니까?</p>
	</div>
	<div class="padding_20">
		<div class="gift_take_it_btn pointer" onclick="javascript:call_gift_take('<?=$v_idx?>');">
			<b>확인</b>
		</div>
	</div>
	<div class="bg_f5f5f5 text-center border-radius_4 height_44 line-height_44">
		<p class="color_999 font-size_11">번호변경은 더보기 > 내정보수정 에서 가능합니다.<p>
	</div>
</div>

<style>
.gift_take_it_btn {width: 100px;height: 35px;background:#ed4949;text-align:center;line-height: 35px;border-radius: 4px;margin: auto; }
.gift_take_it_btn b { color:#fff; }

#gift_list_border tr td:first-child { border-right:1px solid #e5e5e5; border-bottom:1px solid #e5e5e5; }
#gift_list_border tr td:last-child { border-bottom:1px solid #e5e5e5; }
</style>