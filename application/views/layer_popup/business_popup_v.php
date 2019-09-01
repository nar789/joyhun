
		
		<form name="business_form" id="business_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/joy_police/business_pop">

			<input type="hidden" value="<?=$cate?>" name="bu_cate">
			<input type="hidden" value="pver" name="bu_ver">

			<div class="padding_top_20 padding_left_20">
				<p class="color_666 font-size_14 line-height_18">문의해주시면 <span class="color_ea3c3c font-size_14">메일주소로 빠른 답변</span> 드리도록 하겠습니다.</p>

				<table class="popup_border_table width_420 margin_top_18">
					<tr>
						<td>이름</td>
						<td><input type="text" name="bu_name" id="bu_name" class="width_100 height_20 border_1_cccccc color_666"/></td>
					</tr>
					<tr>
						<td>회사명</td>
						<td><input type="text" name="bu_company" id="bu_company" class="width_100 height_20 border_1_cccccc color_666"/></td>
					</tr>
					<tr>
						<td>연락처</td>
						<td><input type="text" name="bu_ph" id="bu_ph" class="width_190 height_20 border_1_cccccc color_666"/></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td>
							<input type="text" name="bu_email_1" class="width_71 height_20 border_1_cccccc color_666" id="bu_email_1"/>
							<span class="color_666"> @ </span>
							<input type="text" name="bu_email_after" class="width_91 height_20 border_1_cccccc color_666" id="bu_email_after"/>
							<div class="select_box_ccc_border">
								<select class="width_111 height_22 bg_position_100" id="bu_email_select" onchange="bu_email_chg();">
									<option value="">선택하세요</option>
									<option value="naver.com">naver.com</option>
									<option value="hanmail.net">hanmail.net</option>
									<option value="nate.com">nate.com</option>
									<option value="gmail.com">gmail.com</option>
									<option value="daum.net">daum.net</option>
									<option value="korea.com">korea.com</option>
									<option value="chollian.net">chollian.net</option>
									<option value="dreamwiz.com">dreamwiz.com</option>
									<option value="1">직접입력</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>회사소개</td>
						<td>
							<textarea class="width_303 height_71 border_1_cccccc color_666 margin_top_9 margin_bottom_6 no_resize" name="bu_info" id="bu_info"></textarea>
						</td>
					</tr>
					<tr>
						<td>문의내용</td>
						<td>
							<textarea class="width_303 height_71 border_1_cccccc color_666 margin_top_9 margin_bottom_6 no_resize" name="bu_content" id="bu_content"></textarea>
						</td>
					</tr>
					<!-- <tr>
						<td>파일첨부</td>
						<td>
							<div class="normal_filebox">
								<input class="upload_name" value="파일선택" disabled="disabled">
								<label for="adver_file">찾아보기</label> 
								<input type="file" name="adver_file" id="adver_file"> 
							</div>
						</td>
					</tr> -->
					<!-- ## 나중에 어떻게 될지 몰라서 주석 -->
					<tr>
						<td colspan="2" class="padding_bottom_3 padding_top_4 line-height_18">
							<input type="checkbox" name="bu_agree" id="bu_agree" class="popup_checkbox" value="1"><label for="bu_agree" class="popup_checkbox_label"> 상담을 위한 개인정보 제공에 동의합니다.</label>
							<div class="color_999 font_no margin_left_19">
								- 수집목적 : 문의 내용의 확인 및 처리<br>
								- 수집항목 : 이름, 회사명, 연락처, 이메일<br>
								- 보유기간 : 문의 처리 및 회신기간. 최대 3년
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="submit" class="text_btn_de4949 width_82 height_30" value="문의하기"/>
			</div>

		</form>