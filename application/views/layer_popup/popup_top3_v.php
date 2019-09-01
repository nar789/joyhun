<!-- 제목이 중앙정렬 , 큰 X버튼 top -->

<link href="<?php echo CSS_DIR?>/layer_popup/modal_layout3_css.css" rel="stylesheet" />
<link href="<?php echo CSS_DIR?>/layer_popup/component_layout_css.css" rel="stylesheet" />


<?if(@$add_css){foreach($add_css as $css_name){ file_read_echo($css_name, 'css'); }} ?>
<?if(@$add_js){foreach($add_js as $js_name){ file_read_echo($js_name, 'js'); }} ?>


<div class="modal_layer">

	<div class="modal_pop_title2 text-center">
		<div class="title_center2">
			<b><?=@$add_title?></b>
			<span><?=@$add_text?></span>
		</div>
		<div class="modal_pop_title_right2">
			<img src="<?=IMG_DIR?>/layer_exit_btn.png" id="modal_close_btn" onclick="modal2.close();">
		</div>
		<div class="clear"></div>
	</div>

	<div class="modal_pop_content2">