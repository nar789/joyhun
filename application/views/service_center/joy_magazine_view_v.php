<div class="content">

	<div class="left_main width_760">

		<a href="http://joyhunting.com/service_center/joy_magazine/all"><p class="color_333 blod font-size_18 block">조이매거진</p></a>

		<div class="board_view_magazine">

			<div class="board_title">
				<div class="float_left">
					<!--img src="<?=IMG_DIR?>/service_center/event_cate_online.gif"-->
					<!--img src="<?=IMG_DIR?>/service_center/event_cate_mobile.gif"-->
					<span class="font-size_16 color_8054f0"><?=$magazine_data['gubn']?></span>
					<span class="displayblock ver_top font-size_16 color_333 padding_left_6 blod"><?=$magazine_data['title']?></span>
				</div>
				<!--div class="float_right color_ccc padding_right_20">조회수 : <?=$magazine_data['read_num']?></div-->
				<div class="float_right color_ccc padding_right_20">등록일 : <?=date("Y-m-d", strtotime($magazine_data['write_date']))?></div>				
				<div class="clear"></div>
			</div>

			<div class="board_content">
				<?=$magazine_data['contents']?>
			</div>
			<!-- ## board_content_end -->
		</div>

		<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="javascript:magazine_list_goto('<?=@$_SERVER['HTTP_REFERER']?>');"/>
		<div class="clear"></div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>

