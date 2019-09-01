<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<div class="margin_top_20 margin_bottom_8">
			<div class="gift_box_delete pointer">삭제</div>
		</div>


		<div class="send_gift_box">
			<ul class="gift_box_bd">
				<li class="text-center width_170">받은사람</li>
				<li class="text-center width_360">상품명</li>
				<li class="text-center width_140">보낸날짜</li>
			</ul>
			<div class="clear"></div>

			<?
				if($getTotalData > 0){
					foreach($mlist as $data){
			?>
			<div class="min_height_40 border_bottom_1_ececec">
				<div class="float_left">
					<div class="block margin_left_6 margin_top_10 ver_top">
						<input type="checkbox" id="gift_<?=$data['V_IDX']?>" name="chk_gift" class="common_checkbox" value="<?=$data['V_IDX']?>"><label for="gift_<?=$data['V_IDX']?>" class="common_checkbox_label"></label>
					</div>
					<div class="width_155 block margin_top_12 color_333 margin_left_6 ver_top">
						<span class="color_8a98f0 font_900"><?=$this->member_lib->s_symbol($data['RECV_SEX'])?></span> <?=$data['RECV_NICK']?> (<?=$data['RECV_AGE']?>세)
					</div>
					<div class="width_300 block margin_top_12 color_333 ver_top text_cut"><?=$data['GIFT_NAME']?></div>
					<div class="width_180 block margin_top_12 color_333 margin_left_25 ver_top text-center"><?=$data['V_SEND_DATE']?></div>
				</div>
				<div class="clear"></div>
			</div>
			<?
					}
				}else{
			?>
			<div class="list_area border_bottom_2_ececec ">
				<div class="light_img_null">
					<img src="<?=IMG_DIR?>/meeting/light_null.gif">
					<div class="margin_top_5">
						보낸 선물이 없습니다.<Br>
						마음에 드는 이성에게 선물하고 더욱 가까워져 보세요~
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?
				}
			?>
			
			
			<!-- 페이지 -->
			<div class="list_pg margin_top_33">
				<div>
					<?=$pagination_links?>
				</div>
			</div>
		</div>

	</div>		

	<div class="right_main">
		<?=$right_menu?>
	</div>


</div>
