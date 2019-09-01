<div class="posi_rel width_100per">
	<div class="posi_rel width_100per">
		<img src="<?=IMG_DIR?>/m/m_app_grade_top.png" class="width_100per" id="app_grade_top" useMap="#Map">
		<map id="Map" name="Map">
			<area shape="rect" coords="251,603,414,644" id="app_down" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
			<area shape="rect" coords="60,342,283,387" id="app_score1" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
			<area shape="rect" coords="252,773,413,814" id="app_score2" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
		</map>
	</div>
	
	<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/event/app_grade_upload_pic">
	<input type="hidden" id="upload_gubn" name="upload_gubn" value="<?=@$gubn?>">
	<?
		if(empty($event_data)){
	?>
	<div class="posi_rel width_100per app_grade_main">
		<img src="<?=IMG_DIR?>/m/m_app_grade_main.png" class="width_100per">
	
		<div class="con_box">
			<div>
				<input type="text" id="user_name" name="user_name" value="<?=@$up_data['user_name']?>" maxlength="15">
			</div>
			<div>
				<input type="text" id="file_name" name="file_name" value="" readonly>
				<label for="user_upload_pic">사진찾기</label>
				<input type="file" id="user_upload_pic" name="user_upload_pic">
			</div>
			<div>
				<input type="text" id="user_hp_1" name="user_hp_1" value="<?=@$up_data['hp_1']?>" class="user_phone" maxlength="3">
				<b>-</b>
				<input type="text" id="user_hp_2" name="user_hp_2" value="<?=@$up_data['hp_2']?>" class="user_phone" maxlength="4">
				<b>-</b>
				<input type="text" id="user_hp_3" name="user_hp_3" value="<?=@$up_data['hp_3']?>" class="user_phone" maxlength="4">
			</div>
		</div>

		<div class="event_btn" id="btn_submit">
			등 록
		</div>

	</div>
	<?
		}else{
	?>
	<div class="posi_rel width_100per app_grade_main">
		<img src="<?=IMG_DIR?>/m/m_app_grade_main.png" class="width_100per">
		
		<div class="con_box">
			<div>
				<b class="user_name"><?=$event_data['user_name']?></b>
			</div>
			<div>
				<b class="user_pic" onclick="javascript:user_pic_view();"><등록된 사진 보기></b>
			</div>
			<div>
				<b class="user_phone"><?=$event_data['hp_1']." - ".$event_data['hp_2']." - ".$event_data['hp_3']?></b>
			</div>
		</div>

		<div class="event_btn" id="btn_update">
			수 정
		</div>

	</div>
	<?
		}
	?>

	</form>

</div>
