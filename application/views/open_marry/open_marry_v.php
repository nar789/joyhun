<div class="content">

	<div class="left_main">

	<?=$call_top?>
	
	<?=$call_search?>

		<div class="tab_content_top_area height_0 margin_top_20"></div>
		
		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>

		<div class="list_area min_height_103">
			<div class="float_left">
				<div class="float_left open_marry_sub_thumb" onclick="<?user_check("view_profile('$data[b_userid]');");?>">
					<?=$this->member_lib->member_thumb($data['b_userid'], 78, 54)?>
				</div>
				<div class="float_right" style="width:516px">
					<div class="margin_top_16">
						<? if($data['b_type'] == "재혼"){ ?>
						<img src="<?=IMG_DIR?>/badge_2.gif" alt="재혼">
						<? }else{ ?>
						<img src="<?=IMG_DIR?>/badge_1.gif" alt="결혼">
						<? } ?>
						<div class="ver_top block width_158">
							<?=$this->member_lib->s_symbol($data['b_sex'])?>
							<b class="color_333"><?=@$data['b_nick']?></b><span class="color_666"> (<?=@$data['b_age']?>세)</span>
						</div>
						<div class="ver_top block width_103">
							<b class="color_333 margin_left_18">지역 <span class="color_e93d3b"><?=@$data['b_region']?></span></b>
						</div>
						<div class="block ver_top margin_top_1 margin_left_19">
							<p class="love_per_title block ver_top margin_top_0">러브궁합도</p>
							<div class="love_per_frame float_none block margin_top_0">
								<div class="love_per_frame_box" style="width:<?=love_per($data['b_region'],'',$data['b_age'],$data['b_sex'])?>%;"></div>	<!-- ## style ## -->
							</div>
							<p class="blod font-size_11 color_f08a8e block ver_top margin_top_mi_1"><?=love_per($data['b_region'],'',$data['b_age'],$data['b_sex'])?>%</p>
						</div>
					</div>
					<div class="width_500 color_999 margin_top_5 padding_bottom_19 line-height_16 break_all">
						<?=@$data['b_content']?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="float_right">
				<div class="text_btn_fe727b width_95 height_37 line-height_38 margin_top_27" onclick="javascript:propose_reuqest('<?=$data['b_userid']?>', '공개구혼');">
					프로포즈하기 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
			</div>
			<div class="clear"></div>
		</div>		<!-- ## list_area end ## -->

		<?	
				}
			}else{
		?>

		<div class="list_area border_bottom_1_ececec height_85">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div class="margin_top_10">
					검색에 해당하는 회원이 없습니다.
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<?
			}
		?>
		




		<div class="list_footer">
			<input type="button" class="text_btn_ea3e3e width_165 font-size_14 margin_right_8" value="프로포즈함 가기" onclick="javascript:location.href='/profile/propose/send_propose';">
		</div>
		

		<div class="list_pg margin_top_23">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>
		
	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->
