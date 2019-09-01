<div class="content">

	<div class="left_main width_760">
		<a href="http://joyhunting.com/service_center/joy_magazine/all"><p class="color_333 blod font-size_18 block">조이매거진</p></a>

		<?=$call_tabmenu?>
			
		<div class="event_box">
			
			<?
				if($getTotalData > 0){
					foreach($mlist as $data){
			?>

			<div class="mgagazine_list">
				<img src="/upload/naver_upload/magazine/<?=$data['list_img_url']?>" class="pointer" onclick="javascript:magazine_view('<?=$data['idx']?>');">
				<div class="float_right">
					<a href="javascript:magazine_view('<?=$data['idx']?>');">
						<p class="color_7C59FE font-size_13 margin_top_20 blod uline"><?=$data['gubn']?></p>
						<p class="color_333 font-size_16 margin_top_10 uline"><?=$data['title']?></p>
						<p class="color_999 line-height_18 margin_top_16 uline"><?=$data['ahead_text']?></p>
					</a>
					<input type="button" class="text_btn2_d2d2d2 width_120 height_20 margin_top_28" value="자세히 보기" onclick="javascript:magazine_view('<?=$data['idx']?>');">
				</div>
			</div>
		
			<?
					}
				}else{
			?>
			<!-- 이벤트가 없는경우 -->
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="ver_top margin_top_12">
						<?=$null_text?>
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
			<?
				}
			?>

		</div>

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>
	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>
