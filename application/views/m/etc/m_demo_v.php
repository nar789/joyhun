<div style="position:relative; width:100%;">
	<img src="<?=IMG_DIR?>/m/demo/demo_menu_<?=$menu?>.png" style="width:100%;">
</div>

<script type="text/javascript">
	
	function reg_modify(){
		
		$.get('/m/regi_demo/reg_modify_layer/'+Math.random(), function(data){
			modal.open({content: data, width : 320, top : 100});
		});

	}

</script>