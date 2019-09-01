<div class="content">
	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">
			
			<div class="posi_rel width_760">
				
				<div class="posi_rel width_760 margin_top_10">
					
					<div class="app_grade_top">
						<img src="<?=IMG_DIR?>/service_center/app_grade_top.png" useMap="#grade">
						<map id="grade" name="grade">
							<area coords="64, 342, 289, 389" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
							<area coords="60, 766, 200, 800" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
							<area coords="292, 766, 432, 800" href="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';" target="_blank">
						</map>
					</div>

					<div class="app_grade_main">
						<img src="<?=IMG_DIR?>/service_center/app_grade_main.png">
						<div class="user_data_box">
							
							<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/event/app_grade_upload_pic">
							<input type="hidden" id="upload_gubn" name="upload_gubn" value="<?=@$gubn?>">
							<?
								if(empty($event_data)){
							?>
							<table cellspacing=0 cellpadding=0 class="width_100per">
								<tr>
									<th>구글이름</th>
									<td>
										<input type="text" id="user_name" name="user_name" value="<?=@$up_data['user_name']?>" class="width_260" maxlength="15"><br>
										<p class="margin_top_5 color_8f8f8f">※플레이 스토어에 등록된 이름을 기입해주세요.</p>
									</td>
								</tr>
								<tr>
									<th>사진등록</th>
									<td>
										<input type="text" id="file_name" name="file_name" value="" class="width_260" readonly>
										<label for="user_upload_pic">사진찾기</label>
										<input type="file" id="user_upload_pic" name="user_upload_pic">
										<br>
										<p class="margin_top_5 color_8f8f8f">※좌측과 동일한 화면을 캡쳐해서 올려주세요.</p>
									</td>
								</tr>
								<tr>
									<th>휴대폰 번호</th>
									<td>
										<input type="text" id="user_hp_1" name="user_hp_1" value="<?=@$up_data['hp_1']?>" class="width_100 user_phone" maxlength="3">
										-
										<input type="text" id="user_hp_2" name="user_hp_2" value="<?=@$up_data['hp_2']?>" class="width_100 user_phone" maxlength="4">
										-
										<input type="text" id="user_hp_3" name="user_hp_3" value="<?=@$up_data['hp_3']?>" class="width_100 user_phone" maxlength="4">
										<br>
										<p class="margin_top_5 color_e11a1f">※앱을 삭제하시면 별점 내용도 같이 지워집니다. 절대 삭제금지</p>
									</td>
								</tr>
							</table>

							<div class="reg_btn_box">
								<input type="button" id="btn_submit" name="btn_submit" value="등 록">
							</div>
							<?
								}else{
							?>
							<table cellspacing=0 cellpadding=0 class="width_100per">
								<tr>
									<th>구글이름</th>
									<td>
										<p class="font-size_15 bold margin_bottom_10"><?=$event_data['user_name']?></p>
										<p class="margin_top_5 color_8f8f8f">※플레이 스토어에 등록된 이름을 기입해주세요.</p>
									</td>
								</tr>
								<tr>
									<th>사진등록</th>
									<td>
										<p class="font-size_15 bold pointer color_1d1cfc margin_bottom_10" onclick="javascript:user_pic_view();"><등록된 사진보기></p>
										<p class="margin_top_5 color_8f8f8f">※좌측과 동일한 화면을 캡쳐해서 올려주세요.</p>
									</td>
								</tr>
								<tr>
									<th>휴대폰 번호</th>
									<td>
										<p class="font-size_15 bold margin_bottom_10"><?=$event_data['hp_1']."-".$event_data['hp_2']."-".$event_data['hp_3']?></p>
										<p class="margin_top_5 color_e11a1f">※앱을 삭제하시면 별점 내용도 같이 지워집니다. 절대 삭제금지</p>
									</td>
								</tr>
							</table>

							<div class="reg_btn_box">
								<input type="button" id="btn_update" name="btn_update" value="수 정">
							</div>
							<?
								}
							?>
							</form>
							
						</div>
					</div>

				</div>

				<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/event/ing_event'"/>
				
			</div>

		</div>

	</div>

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>

