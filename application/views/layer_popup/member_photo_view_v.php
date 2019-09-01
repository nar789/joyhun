<div class="member_view_layer width_<?=$v_width?> height_<?=$v_height?>">	
    
	<div id="member_view_slide" class="width_<?=$v_width?> height_<?=$v_width?>">
		<ul>
			<? for($i=1; $i<=$list_cnt; $i++){ ?>
			<li <? if(!empty(${"img_margin_".$i})){ echo ${"img_margin_".$i}; } ?> >
				<img src="<?=${"member_img_".$i}?>" <? if(!empty(${"img_chk_".$i})){ ?> style="width:<?=$v_width?>px; height:<?=$v_width?>px;" <? } ?>>
			</li>
			<? } ?>
		</ul>		
    </div>
	
	<? if($list_cnt > 1){ ?>
	<div class="btn_box" style="top:<?=$v_top?>px;">
		<div id="btn_prev"><img src="<?=IMG_DIR?>/slide_btn_left.png"></div>
		<div id="btn_next"><img src="<?=IMG_DIR?>/slide_btn_right.png"></div>
	</div>
	<div class="paging margin_top_5"></div>
	<? } ?>

</div>
