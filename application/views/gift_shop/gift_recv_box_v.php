<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<div class="margin_top_20 margin_bottom_8">
			<div class="gift_box_delete pointer">삭제</div>
		</div>


		<div class="also_received_gifts">
			<ul class="gift_box_bd">
				<li class="text-center width_170">보낸사람</li>
				<li class="text-center width_360">상품명</li>
				<li class="text-center width_60">남은날짜</li>
				<li class="text-left width_56 float_right">상태</li>
			</ul>
			<div class="clear"></div>
			
			<?
				if($getTotalData > 0){
					foreach($mlist as $data){
						if($data['V_SEND_YN'] == "Y"){ $gift_stat = "발송완료"; }
						if($data['V_SEND_YN'] == "N"){ $gift_stat = "선물받기"; }
						if($data['V_SEND_YN'] == "I"){ $gift_stat = "발송준비"; }
			?>
			<div class="min_height_40 border_bottom_1_ececec">
				<div class="float_left">
					<div class="block margin_left_6 margin_top_10 ver_top">
						<input type="checkbox" id="gift_<?=$data['V_IDX']?>" name="chk_gift" class="common_checkbox" value="<?=$data['V_IDX']?>"><label for="gift_<?=$data['V_IDX']?>" class="common_checkbox_label"></label>
					</div>
					<div class="width_155 block margin_top_12 color_333 margin_left_6 ver_top">
						<span class="color_8a98f0 font_900"><?=$this->member_lib->s_symbol($data['SEND_SEX'])?></span> <?=$data['SEND_NICK']?>
					</div>
					<div class="width_300 block margin_top_12 color_333 ver_top text_cut"><?=$data['GIFT_NAME']?></div>
					<div class="width_142 block margin_top_12 color_333 margin_left_6 ver_top text-center">	
						<? if($data['V_SEND_YN'] == 'Y'){ ?>
						완료
						<? }else{ ?>
						<? if($data['USE_DATE'] >= 0) { ?> <?=$data['USE_DATE']?>일 남음 <? }else{ echo "만료"; }?> 
						<? } ?>
					</div>
				</div>
				<div class="float_right margin_top_9 margin_right_11">
					<? if($data['V_SEND_YN'] == 'Y'){ ?>
						완료
						<? }else{ ?>
					<? if($data['USE_DATE'] >= 0) { ?>
					<div class="gift_box_btn pointer" onclick="javascript:gift_take_it_layer('<?=$data['V_IDX']?>');"><?=$gift_stat?></div>
					<? }else{ echo "기간만료"; }?>
					<? } ?>
				</div>
				<div class="clear"></div>
			</div>
			<?
					}
				}else{
			?>
			<div class="list_area border_bottom_2_ececec">
				<div class="light_img_null">
					<img src="<?=IMG_DIR?>/meeting/light_null.gif">
					<div class="margin_top_5">
						받은 선물이 없습니다.<Br>
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
