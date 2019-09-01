<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_tabmenu2?>

			<form name="check_form" method="post">
				<div class="tab_content_top_area">
					<div class="float_left">
						<p>총 <span class="color_333"><?=number_format($getTotalData)?>건</span>의 나의 번개팅이 등록되어 있습니다.</p>
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

				foreach($mlist as $data)
				{
			?>	

				<div class="list_area">
					<div class="light_list_check">
						<input type="checkbox" id="light_list_check_<?=$data['idx']?>" value="<?=$data['idx']?>" name="check_item[]"/>
						<label for="light_list_check_<?=$data['idx']?>"></label>
					</div>
					<div class="list_img2" >
						<a href="#"><?=$this->member_lib->member_thumb($data['b_userid'],68,49)?></a>
					</div>		<!-- ## light_list_img end ## -->
					<div class="light_list_con2 margin_top_16">
						<b class="color_333 blod">지역 </b><span class="color_e93d3b blod margin_right_25"><?=$data['b_region']?></span>
						<b class="color_333 blod">날짜 </b><span class="color_e93d3b blod margin_right_25"><?=str_replace("-",".",$data['b_day'])?></span>
						<b class="color_333 blod">시간 </b><span class="color_e93d3b blod margin_right_25"><?=want_time_text($data['b_time'])?></span>
						<b class="color_333 blod">관심사 </b><span class="color_e93d3b blod margin_right_25"><?=interest_text($data['b_interest'])?></span>
						<div class="margin_top_8 color_999 break_all padding_bottom_7">
							<?=$data['b_intro']?>
						</div>
					</div>
				</div>
				<!-- ## for end ## -->
			<?
				}
			}else{
			?>

			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						내가 등록한 번개팅이 없습니다.<Br>
						번개팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>

			<?
			}
			?>

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