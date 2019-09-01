
	<div class="blind_area">
		<div class="padding_15">
			<div class="float_left">
				<img src="<?=IMG_DIR?>/arow.gif" class="margin_right_5">받은 좋아요
			</div>
			<div class="float_right"><span class="color_ea3c3c"><? if(@$recv_good != NULL){ echo $recv_good; }else{ echo "0"; }?></span></div>
			<div class="clear"></div>
			
			<div class="margin_top_6">
				<div class="float_left">
					<img src="<?=IMG_DIR?>/arow.gif" class="margin_right_5">보낸 좋아요
				</div>
				<div class="float_right"><span class="color_ea3c3c"><? if(@$send_good != NULL){ echo $send_good; }else{ echo "0"; }?></span></div>
				<div class="clear"></div>
			</div>

			<div class="margin_top_6">
				<div class="float_left">
					<img src="<?=IMG_DIR?>/arow.gif" class="margin_right_5">서로 좋아요
				</div>
				<div class="float_right"><span class="color_ea3c3c"><? if(@$to_good != NULL){ echo $to_good; }else{ echo "0"; }?></span></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>