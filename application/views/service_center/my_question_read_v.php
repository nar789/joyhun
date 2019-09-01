<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18" id="privacy_title">나의 문의내역</p>

		<div class="board_view">

			<div class="board_title line-height_no">
				<div class="padding_top_18">
					<div class="float_left color_999"><?=@$faq_menu[$quest['f_cate1']]['faq_title']?> > <?=@$faq_menu[$quest['f_cate1']]['cate'][$quest['f_cate2']]?></div>
					<div class="float_right color_999"><?=$quest['f_writeday']?>
						<?if($quest['f_answerYN']=="Y"){?>
						<div style="text-center" class="text_btn_3f66c7 line-height_22 text-center block margin_left_9">처리완료</div> 
						<?}else{?>
						<div style="text-center" class="text_btn_d4d4d4 width_65 text-center block color_333 line-height_22">접수완료</div> 
						<?}?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="color_333 font-size_16 margin_bottom_18"><?=$quest['f_title']?></div>
			</div>

			<div class="board_content padding_bottom_20">
				<div class="padding_bottom_40">
					<span class="color_999"><?=nl2br($quest['f_content'])?></span>
				</div>

				<? if(!empty($quest['f_answer'])){?>
				<div style="padding:10px 20px;width:680px;background:#f3f3f3;min-height:100px;margin:0 auto;">
					<span class="color_333"><?=$quest['f_answerid'] ? "관리자" : ""?></span><span class="color_999 block margin_left_21"><?=$quest['f_answerwriteday']?></span>
					<div class="color_666 margin_top_2 line-height_20"><?=nl2br($quest['f_answer'])?></div>
				</div>
				<?}?>

			</div>

		</div>
		
		<div class="text-right">
			<input type="button"  class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10" value="삭제" onclick="javascript:my_question_del('<?=$quest['f_num']?>','<?=$page?>');"/>
			<input type="button" class="text_btn2_ea3e3e width_80 height_37 font-size_14 blod margin_top_10" value="목록" onclick="javascript:my_question_list('<?=$page?>');"/>
		</div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>
