<div class="content">

	<div class="left_main width_760">
		<p class="color_333 blod font-size_18">이벤트</p>

		<?=$call_tabmenu?>
			
		<div class="event_box">
			
			<?
				if($getTotalData > 0){
					foreach($mlist as $data){
			?>

			<div class="event_list">
				<img src="/upload/naver_upload/event/<?=$data['m_list_img_url']?>" class="pointer" onclick="javascript:event_view('<?=$data['m_idx']?>');">
				<div class="float_right">
					<a href="javascript:event_view('<?=$data['m_idx']?>');">
						<p class="color_333 font-size_16 margin_top_18"><?=$data['m_title']?></p>
						<p class="color_999 line-height_18 margin_top_4"><?=$data['m_sub_content']?></p>
						<div class="margin_top_16">
							<span class="color_666">기간</span><span class="color_ccc margin_left_18"><?=str_replace('-', '.', $data['m_start_day'])?> ~ <?=str_replace('-', '.', $data['m_last_day'])?></span>
						</div>
					</a>
					<input type="button" class="text_btn2_d2d2d2 width_120 height_20 margin_top_28" value="이벤트 참여하기" onclick="javascript:event_view('<?=$data['m_idx']?>');">
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
