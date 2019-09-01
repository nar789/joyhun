
<div class="lightbox-ajax">

	<!-- title -->
	<h4><?=$user_id."(".$user_name.")님"?> 업로드 파일</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="point_ajax" name="point_ajax" method="post" class="validate">
		<div style="position:relative; width:400px; margin:auto; text-align:center;">
			<img src="<?=str_replace("resource", "upload", $file_path)?>" style="width:80%;">
		</div>
		</form>

	</div>
	<!-- /body -->

</div>

