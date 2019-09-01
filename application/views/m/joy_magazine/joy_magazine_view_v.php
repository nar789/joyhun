	
	<input type="hidden" id="idx" name="idx" value="<?=$magazine_data['idx']?>">
	<input type="hidden" id="gubn" name="gubn" value="<?=$magazine_data['gubn']?>">

	<div class="magazine_top_text">
		<div><b>[<?=$magazine_data['gubn']?>]</b></div>
		<div class="magazine_title"><?=$magazine_data['title']?></div>
		<div class="magazine_date"><?=date("Y.m.d", strtotime($magazine_data['write_date']))?></div>
		<div class="magazine_bg"></div>
		<div class="margin_top_5per"></div>
	</div>
	
	<div id="magazine_view" class="width_95per margin_auto">
		<?=$magazine_data['contents']?>
	</div>
	<div class="magazine_bg_box">
		<div class="magazine_bg"></div>
	</div>
	<div class="magazine_btn_box">
		<div class="width_333per float_left"><input type="button" class="magazine_btn" value="이전" id="btn_prev" name="btn_prev" onclick="javascript:magazine_btn_click('prev');"></div>
		<div class="width_333per float_left"><input type="button" class="magazine_btn_second" value="목록" id="btn_list" name="btn_list" onclick="javascript:magazine_btn_click('list');"></div>
		<div class="width_333per float_left"><input type="button" class="magazine_btn" value="다음" id="btn_next" name="btn_next" onclick="javascript:magazine_btn_click('next');"></div>
		<div class="clear"></div>
	</div>
	

	<style>
		#magazine_view img{width:100%;}
		p { font-size:14px; line-height:24px; color:#999;}
		.magazine_top_text { padding-top:5%; padding-left:2%; padding-right:2%; }
		.magazine_top_text > div > b { color:#8054f0; } 
		.magazine_title { padding-top:3%; color:#333; font-weight:bold; font-size:20px; }
		.magazine_date { padding-top:4%; padding-bottom:4%; color:#999; }
		.magazine_bg_box { margin-bottom:5%; margin-left:3%; margin-right:3%; }
		.magazine_bg { width:100%; height:1px; background:#d6d6d6; margin:auto; }
		.magazine_btn_box { margin:auto; width:70%; margin-bottom:5%; }
		.magazine_btn { width:90%;height:35px;background:#fff;border:1px solid #e15148;border-radius:2px;color:#ea3c3b;font-weight:bold; }
		.magazine_btn_second { width:90%;height:35px;background:#e15148;border:1px solid #e15148;border-radius:2px;color:#fff;font-weight:bold; }

		#magazine_view p, div{color:#333; text-align:center;}
	</style>