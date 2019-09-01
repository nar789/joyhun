<div class="content">

	<div class="left_main width_760">

		<?=$call_search?>

		<?=@$call_category?>

		<div class="qna_list">
			<b>구분</b>
			<b>제목</b>
			
			<?php
				if( @$getTotalData > 0){
					foreach(@$flist as $data){
			?>
						<div onclick="javascript:comment_view('<?=$data['idx']?>');"><!-- ## IDX ## -->
							<span><?=$data['gubn2']?></span>
							<span class="qna_title"><?=$data['title']?></span>
							<img src="<?=IMG_DIR?>/service_center/faq_down.gif">
						</div>
						<div class="font-size_14 line-height_18 color_666 bg_fbfbfb padding_1020 cursor_text" style="display:none" id="faq_comment_<?=$data['idx']?>"><!-- ## IDX ## -->
							<!-- FAQ rpy -->
						</div>
					<?
					}
				} 
				?>
		</div>


		<div class="list_pg">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>



	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>