<script type="text/javascript">
	
	$(document).ready(function(){
		
		setInterval(function(){
			
			$("#mapping").attr("src", "/test/map_test/map_iframe");

		}, 10000);

	});
	

</script>

<div style="border:solid 1px #333; position:relative; width:100%; height:500px;">
	<iframe src="/test/map_test/map_iframe" id="mapping" name="mapping"  frameborder=0 style="width:100%; height:100%;"></iframe>
</div>