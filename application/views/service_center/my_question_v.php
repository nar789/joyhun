<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">나의 문의내역</p>

		<table class="board_list" cellspacing="0" cellpadding="0">
			<tr>
				<th class="width_150">분류</th>
				<th class="width_435">제목</th>
				<th class="width_auto">처리현황</th>
				<th>등록일</th>
			</tr>
			<?php
				if( @$getTotalData > 0){
					foreach(@$flist as $data){
			?>
					<tr>
						<td><?=@$faq_menu[$data['f_cate1']]['faq_title']?> > <?=@$faq_menu[$data['f_cate1']]['cate'][$data['f_cate2']]?></td>
						<td class="text-left"><a href="/service_center/my_question/my_question_view/f_num/<?=$data['f_num']?>/page/<?=$page?>" class="color_333 font-size_14 margin_left_30"><?=$data['f_title']?></a></td>
						<td class="text-center padding_0">
							<?if($data['f_answerYN']=='Y'){?>
							<div style="text-center" class="text_btn_3f66c7 width_65 line-height_22 margin_auto">처리완료</div>		<!-- ## 처리완료 -->
							<?}else{?>
							<div style="text-center" class="text_btn_d4d4d4 width_65 color_333 line-height_22 margin_auto">접수완료</div><!-- ## 접수완료 -->
							<?}?>
						</td>
						<td><div class="line-height_20"><?=$data['f_writeday']?></div></td>
					</tr>
			<?	
					} 
				}else{
			?>
				<tr>
					<td colspan="4">
						<div class="list_area border_none">
							<div class="light_img_null width_204 padding_top_20 padding_left_0 margin_auto">
								<img src="/images/meeting/light_null.gif">
								<div class="margin_top_0">
									나의 문의내역이 없습니다.
								</div>
								<div class="clear"></div>
							</div>		<!-- ## light_img_null end ## -->
						</div>
					</td>
				</tr>

			<? } ?>
		</table>


		
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
