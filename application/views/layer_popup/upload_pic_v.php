
	<div class="padding_20">

	<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/profile/main/upload_pic">

		<p class="color_333 blod font-size_14">사진의 최대 크기는 1Mb이며, 이미지파일만 업로드 가능합니다.</p>
		<div class="filebox" style="width:100%;">
			<input class="upload_name" value="파일선택" disabled="disabled">
			<label for="user_upload_pic">찾아보기</label> 
			<input type="file" name="user_upload_pic" id="user_upload_pic"> 
		</div>

		<div class="margin_top_20 text-center">
			<input type="submit" class="text_btn_de4949 width_120 height_30" id="btn_profile_submit" value="파일 업로드" >
		</div>
	
		<input type="hidden" name="num" value="<?=$num?>">

	</form>

	</div>