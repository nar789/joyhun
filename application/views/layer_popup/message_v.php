<div class="message_main">
	<div class="float_right margin_right_5 margin_bottom_mi_2">
		<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
	</div>
	<div class="clear"></div>
	<div class="message_textbox">
		<div class="padding_11 block">
			<div class="message_imgbd pointer" onclick="javascript:member_photo_view_pop('<?=$rand_mb['m_userid']?>');">
				<?=$this->member_lib->member_thumb($rand_mb['m_userid'],68,78)?>
			</div>			
		</div>
		<div class="block margin_top_15 ver_top line-height_16">
			<p style="width:145px;height:50px;"><? if($rand_mb['my_intro'] ==''){ echo strcut_utf8(my_intro_data($rand_num),'45'); }else{ echo $rand_mb['my_intro']; }?><?//=strcut_utf8($rand_mb['my_intro'], '45');?></p>
		</div>
		<div class="message_btnbox">
			<a href="#">
				<div class="message_btn01" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
					<b>수락</b>
				</div>
			</a>
			<a href="#">
				<div class="message_btn02 pointer" onclick="modal.close();">
					<b>거절</b>
				</div>
			</a>
		</div>
	</div>
</div>



<?if(@$add_css){foreach($add_css as $css_name){?>
	<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
<?}}?>


<?if(@$add_js){foreach($add_js as $js_name){?>
	<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
<?}}?>

