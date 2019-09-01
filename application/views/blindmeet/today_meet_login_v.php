<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="today_login">
			<div class="today_title">
				<p class="font-size_14">
				<span class="font-size_20"><?=date("n");?></span>월 <span class="font-size_20"><?=date("j");?></span>일  <span class="font-size_16">소개팅 회원</span>
				</p>
			</div>

			<div class="today_box blind_start_btn">
				<img src="<?=IMG_DIR?>/blindmeeting/blind_flower.gif">
				<p class="color_ff87a0 font-size_15 blod line-height_20 margin_bottom_30">매일 오전 9시에 회원님과 최상으로 어울리는 이성을 소개해드립니다.<br>호감가는 이성에게 '좋아요'를 눌러보세요~</p>
				<input type="button" class="text_btn_36c8e9 width_180 height_47" value="오늘의 소개팅 시작하기" onclick="blind_start();"/>
			</div>
			<div class="loading_box displaynone">
				<div class="loader6"></div>
				<p class="text-center blod font-size_16 margin_top_40 color_5bd2d6">회원님께 딱맞는 짝을 찾고 있습니다. 잠시만 기다려주세요.</p>
			</div>
			
			<div class="today_area">
			</div>
		</div>

		

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>