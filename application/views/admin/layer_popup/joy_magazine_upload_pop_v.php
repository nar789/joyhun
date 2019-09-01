<script type="text/javascript">
	
	$(document).ready(function(){
		
	});

</script>

<div style="position:relative; width:100%;">
	
	<div style="position:relative width:100%; height:50px; background-color:red; color:#fff; font-weight:bold; font-size:1.2em; line-height:55px;">
		&nbsp;&nbsp;조이매거진 이미지 업로드
	</div>
	<div style="position:relative; width:90%; height:200px; margin-top:20px; margin-left:5%; text-align:center;">
		<?php echo form_open_multipart('admin/service_center/joy_magazine/list_img_reg/set_id/'.$set_id);?>

		<input type="file" name="userfile" size="20"/>
		
		<div style="position:relative; width:100%; height:80px; text-align:left; padding-top:20px;">
			※매거진 PC 리스트 이미지 사이즈 152 * 181<br>
			※매거진 모바일 리스트 이미지 사이즈 600 * 270
		</div>
		

		<input type="submit" value="이미지 등록" />

		</form>

	</div>
	
</div>