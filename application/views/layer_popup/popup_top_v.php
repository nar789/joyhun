<!-- 제목이 좌측정렬 top -->

<link href="<?php echo CSS_DIR?>/layer_popup/modal_layout_css.css" rel="stylesheet" />
<link href="<?php echo CSS_DIR?>/layer_popup/component_layout_css.css" rel="stylesheet" />

<?if(@$add_css){foreach($add_css as $css_name){ file_read_echo($css_name, 'css'); }} ?>
<?if(@$add_js){foreach($add_js as $js_name){ file_read_echo($js_name, 'js'); }} ?>

<!--link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script-->

<script type="text/javascript">
	
	$(document).ready(function(){
	
		$("#modal_close_btn").on("click", function(){
			
			if($("#chk_val").val()){
				$(this).attr("onclick", "");
				close_popup($("#chk_val").val());
			}else{
				modal.close();
			}

		});

	});

</script>

<div class="modal_layer">

	<div class="modal_pop_title">
		<div class="modal_pop_title_left">
			<b><?=@$add_title?></b>
			<span><?=@$add_text?></span>
		</div>
		<div class="modal_pop_title_right">
			<img src="<?=IMG_DIR?>/lay_exit2.gif" id="modal_close_btn">
		</div>
		<div class="clear"></div>
	</div>

	<div class="modal_pop_content">