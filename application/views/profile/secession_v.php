<div id="tmp"></div>
<div class="content">

	<div class="left_main">
		<img src="<?=IMG_DIR?>/profile/secession_img_02.png">

		<table class="popup_border_table">
			<tr>
				<td class="width_142">현재 비밀번호</td>
				<td class="color_666"><input type="password" id="m_pwd" name="m_pwd" class="info_lock_pwd2" /></td>
			</tr>
			<tr class="min_height_294">
				<td class="ver_top width_142"><p class="margin_top_12">탈퇴 사유</p></td>
				<td class="ver_top">
					<div class="margin_top_16">
						<input type="radio" id="secession_1" name="secession" value="1" class="ver_mid"><label for="secession_1"></label><span> 이성과의 만남이 이루어지지 않아서</span>
					</div>
					<div class="margin_top_16">
						<input type="radio" id="secession_2" name="secession" value="2" class="ver_mid"><label for="secession_2"></label><span> 불량회원 때문에</span>
					</div>
					<div class="margin_top_16">
						<input type="radio" id="secession_3" name="secession" value="3" class="ver_mid"><label for="secession_3"></label><span> 컨텐츠가 부족해요</span>
					</div>
					<div class="margin_top_16">
						<input type="radio" id="secession_4" name="secession" value="4" class="ver_mid"><label for="secession_4"></label><span> 사이트가 너무 느려요</span>
					</div>
					<div class="margin_top_16">
						<input type="radio" id="secession_5" name="secession" value="5" class="ver_mid"><label for="secession_5"></label><span> 사이트가 불안정 해요</span>
					</div>
					<div class="margin_top_16">
						<input type="radio" id="secession_6" name="secession" value="6" class="ver_mid"><label for="secession_6"></label><span> 사적인 이유</span>
					</div>
					<div class="margin_top_16">
						(기타 탈퇴사유)
					</div>
					<div class="padding_bottom_13">
						<textarea class="secession_text" name="secession_text" id="secession_text" ></textarea>
					</div>
					
				</td>
			</tr>
		</table>
		
		<div class="secession_btn_box">
			<input type="button" class="text_btn_ea3e3e font-size_14 margin_right_2 secession_btn" value="다시생각해보기" onclick="javascript:history.back(-1);"/>
			<input type="button" class="text_btn_de4949 font-size_14 secession_btn" value="탈퇴신청하기" onclick="javascript:total_mem_out();"/>
		</div>

	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->