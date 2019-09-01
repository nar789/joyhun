<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18" id="privacy_title">공지사항</p>

		<div class="board_view">

			<div class="board_title">
				<div class="float_left color_333 font-size_16"><?=$mlist['n_title']?></div>
				<div class="float_right color_ccc padding_right_20">작성일 : <?=change_date($mlist['n_date'])?></div>
				<div class="clear"></div>
			</div>

			<div class="board_content">
				<?=nl2br($mlist['n_content'])?>
			</div>
		</div>

		<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/notice/noti_list/page/<?=$page?>'"/>
		<div class="clear"></div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>