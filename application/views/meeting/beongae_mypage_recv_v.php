<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_tabmenu2?>

			<form name="check_form" method="post">
				<div class="tab_content_top_area">
					<div class="float_left">
						<p>총 <span class="color_333"><?=number_format($getTotalData)?>건</span>의 <?=$page_name?> 번개팅이 등록되어 있습니다.</p>
					</div>
					<div class="float_right">
						<input type="button" class="text_btn_dcdcdc submenu_allchk_btn" onclick="check_all();" value="전체선택">
						<input type="button" class="text_btn_dcdcdc submenu_allchk_btn" onclick="check_del();" value="선택삭제">
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>			<!-- ## tab_content_top_area end ## -->

			<?php
			if( $getTotalData > 0 )
			{
				
				$i=0;
				foreach($mlist as $data)
				{
			?>		

				<div class="list_area">
					<div class="light_list_check">
						<input type="checkbox" id="light_list_check_<?=$data['idx']?>" value="<?=$data['idx']?>" name="check_item[]"/>
						<label for="light_list_check_<?=$data['idx']?>"></label>
					</div>
					<div class="list_img2">
						<a href="#" onclick="<?user_check("view_profile('$data[b_userid]');");?>"><?=$this->member_lib->member_thumb($data['b_userid'],68,49)?></a>
					</div>		<!-- ## light_list_img end ## -->
					<div class="light_list_con2 margin_top_16">

						<b class="color_333 blod">지역 </b><span class="color_e93d3b blod margin_right_25"><?=$data['b_region']?></span>
						<b class="color_333 blod">날짜 </b><span class="color_e93d3b blod margin_right_25"><?=str_replace("-",".",$data['b_day'])?></span>
						<b class="color_333 blod">시간 </b><span class="color_e93d3b blod margin_right_25"><?=want_time_text($data['b_time'])?></span>
						<b class="color_333 blod">관심사 </b><span class="color_e93d3b blod margin_right_25"><?=interest_text($data['b_interest'])?></span>
						<div class="margin_top_8 color_999 padding_bottom_10">
							<?=$data['b_intro']?>
						</div>
						<div class="mybeongae_comment">
							<div class="width_480 block ver_top">						
								<a <? if($data['user_id'] != $this->session->userdata['m_userid']){?> href="javascript:send_message('<?=$data['user_id']?>', 'send', '');" <? }else{ ?> href="#" <? } ?> >
								<img src="<?=IMG_DIR?>/meeting/recv_meeting_arrow.gif" class="my_recv_comment_arrow"><p id="comment_<?=$i?>" class="color_0036ff font-size_12 margin_top_8 my_comment_content break_all" onmouseover="javascript:decoration_style('on', '<?=$i?>');" onmouseout="javascript:decoration_style('off', '<?=$i?>');"> [<?=$data['sin_m_nick']?>] <?=$data['my_msg']?></p>
								</a>
							</div>
							<?php if ($data['b_wantcnt'] == '2'){?>
							<div class="mybeongae_recv_btn">
								<input type="button" class="recv_btn" value="답장하기"/>
							</div>
							<?php } ?>
						</div>	<!-- ### mybeongae_comment end ## -->
					</div>
				</div>

			<?
				$i++;
				}
			}else{
			?>
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div>
						<?=$page_name?> 번개팅이 없습니다.<Br>
						번개팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
			<?}?>

			</form>

			<div class="list_footer">
				<input type="button" class="text_btn_ea3e3e light_add_btn" onclick="go_top();" value="번개팅 등록하기">
			</div>

			<div class="list_pg">		<!-- ## 페이징 div ## -->
				<div>
					<?= $pagination_links?>
				</div>
			</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>