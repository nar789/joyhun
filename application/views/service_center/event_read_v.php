<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">

			<div class="board_title">
				<div class="float_left">
					<?=$event_cate?>
					<span class="displayblock ver_top font-size_16 color_333"><?=$m_title?></span>
				</div>
				<div class="float_right color_ccc padding_right_20">이벤트 기간 : <?=str_replace('-', '.', $m_start_day)?> ~ <?=str_replace('-', '.', $m_last_day)?></div>
				<div class="clear"></div>
			</div>

			<div class="board_content">
				<div style="position:relative; width:100%;">
					<?=$m_contents?>
				</div>
			</div>
		</div>

		<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/event/ing_event'"/>
		<div class="clear"></div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>