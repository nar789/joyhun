			
			<div id="tmp"></div>
			<div class="bg_f4f4f4 height_156">
				<div class="padding_top_20 padding_left_20">
					<div class="popup_img_L ver_top">
						<? if(@$remarry_data['m_userid']){
								echo $this->member_lib->member_thumb($remarry_data['m_userid'], 121, 122);
							}else{
								echo $this->member_lib->member_thumb($this->session->userdata['m_userid'], 121, 122);
							}
						?>
					</div>
					<div class="block width_290 padding_left_6 padding_top_0">
						<input type="text" placeholder="제목" class="color_999 width_435 height_24 margin_left_0 padding_left_9" id="m_title" name="m_title" value="<?=@$remarry_data['m_title']?>" <?=@$remarry_data['read_only']?> />
						<textarea class="marriage_textarea" placeholder="나를 소개하세요." id="m_content" name="m_content" <?=@$remarry_data['read_only']?> ><?=@$remarry_data['m_content']?></textarea>
					</div>
				</div>
			</div>

			<div class="padding_20 padding_bottom_none">
				<table class="popup_border_table">
					<tr>
						<td>재혼사유</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_reason" name="m_reason">
									<option value="" >선택하세요</option>
									<option value="1" <? if(@$remarry_data['m_reason'] == "1"){ ?> selected <?}?> >이혼</option>
									<option value="2" <? if(@$remarry_data['m_reason'] == "2"){ ?> selected <?}?> >결혼생활중</option>
									<option value="3" <? if(@$remarry_data['m_reason'] == "3"){ ?> selected <?}?> >별거중</option>
									<option value="4" <? if(@$remarry_data['m_reason'] == "4"){ ?> selected <?}?> >사별</option>
								</select>
							</div>
						</td>
						<td>최종학력</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_incom" name="m_incom">
									<option value="" >선택하세요</option>
									<option value="1" <? if(@$remarry_data['m_incom'] == "1"){ ?> selected <?}?> >고졸이하</option>
									<option value="2" <? if(@$remarry_data['m_incom'] == "2"){ ?> selected <?}?> >고졸</option>
									<option value="3" <? if(@$remarry_data['m_incom'] == "3"){ ?> selected <?}?> >전문대졸</option>
									<option value="4" <? if(@$remarry_data['m_incom'] == "4"){ ?> selected <?}?> >대졸</option>
									<option value="5" <? if(@$remarry_data['m_incom'] == "5"){ ?> selected <?}?> >대학원졸</option>
									<option value="6" <? if(@$remarry_data['m_incom'] == "6"){ ?> selected <?}?> >박사과정</option>
									<option value="7" <? if(@$remarry_data['m_incom'] == "7"){ ?> selected <?}?> >유학중</option>
									<option value="8" <? if(@$remarry_data['m_incom'] == "8"){ ?> selected <?}?> >기타</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>자녀여부</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_sons" name="m_sons">
									<option value="" >선택하세요</option>
									<option value="1" <? if(@$remarry_data['m_sons'] == "1"){ ?> selected <?}?> >있음</option>
									<option value="2" <? if(@$remarry_data['m_sons'] == "2"){ ?> selected <?}?> >없음</option>
								</select>
							</div>
						</td>
						<td>직업</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_job" name="m_job">
									<option value="">선택하세요.</option>
									<option value="학생" <? if(@$remarry_data['m_job'] == "학생"){ ?> selected <?}?> >학생</option>
									<option value="컴퓨터/인터넷" <? if(@$remarry_data['m_job'] == "컴퓨터/인터넷"){ ?> selected <?}?> >컴퓨터/인터넷</option>
									<option value="언론" <? if(@$remarry_data['m_job'] == "언론"){ ?> selected <?}?> >언론</option>
									<option value="공무원" <? if(@$remarry_data['m_job'] == "공무원"){ ?> selected <?}?> >공무원</option>
									<option value="군인" <? if(@$remarry_data['m_job'] == "군인"){ ?> selected <?}?> >군인</option>
									<option value="서비스업" <? if(@$remarry_data['m_job'] == "서비스업"){ ?> selected <?}?> >서비스업</option>
									<option value="교육" <? if(@$remarry_data['m_job'] == "교육"){ ?> selected <?}?> >교육</option>
									<option value="금융/증권/보험업" <? if(@$remarry_data['m_job'] == "금융/증권/보험업"){ ?> selected <?}?> >금융/증권/보험업</option>
									<option value="유통업" <? if(@$remarry_data['m_job'] == "유통업"){ ?> selected <?}?> >유통업</option>
									<option value="예술" <? if(@$remarry_data['m_job'] == "예술"){ ?> selected <?}?> >예술</option>
									<option value="의료" <? if(@$remarry_data['m_job'] == "의료"){ ?> selected <?}?> >의료</option>
									<option value="법률" <? if(@$remarry_data['m_job'] == "법률"){ ?> selected <?}?> >법률</option>
									<option value="건설업" <? if(@$remarry_data['m_job'] == "건설업"){ ?> selected <?}?> >건설업</option>
									<option value="제조업" <? if(@$remarry_data['m_job'] == "제조업"){ ?> selected <?}?> >제조업</option>
									<option value="부동산업" <? if(@$remarry_data['m_job'] == "부동산업"){ ?> selected <?}?> >부동산업</option>
									<option value="운송업" <? if(@$remarry_data['m_job'] == "운송업"){ ?> selected <?}?> >운송업</option>
									<option value="농/수/임/광산업" <? if(@$remarry_data['m_job'] == "농/수/임/광산업"){ ?> selected <?}?> >농/수/임/광산업</option>
									<option value="자영업" <? if(@$remarry_data['m_job'] == "자영업"){ ?> selected <?}?> >자영업</option>
									<option value="가사(주부)" <? if(@$remarry_data['m_job'] == "가사(주부)"){ ?> selected <?}?> >가사(주부)</option>
									<option value="무직" <? if(@$remarry_data['m_job'] == "무직"){ ?> selected <?}?> >무직</option>
									<option value="기타" <? if(@$remarry_data['m_job'] == "기타"){ ?> selected <?}?> >기타</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>형제관계</td>
						<td>
							<div class="popup_select margin_right_2 block height_24">
								<select class="bg_position padding_right_0 padding_left_2 width_33 height_24" id="m_brother1" name="m_brother1">
									<option value="0" <? if(@$arr_brother[0] == "0"){ ?> selected <?}?> >0</option>
									<option value="1" <? if(@$arr_brother[0] == "1"){ ?> selected <?}?> >1</option>
									<option value="2" <? if(@$arr_brother[0] == "2"){ ?> selected <?}?> >2</option>
									<option value="3" <? if(@$arr_brother[0] == "3"){ ?> selected <?}?> >3</option>
									<option value="4" <? if(@$arr_brother[0] == "4"){ ?> selected <?}?> >4</option>
									<option value="5" <? if(@$arr_brother[0] == "5"){ ?> selected <?}?> >5</option>
									<option value="6" <? if(@$arr_brother[0] == "6"){ ?> selected <?}?> >6</option>
									<option value="7" <? if(@$arr_brother[0] == "7"){ ?> selected <?}?> >7</option>
									<option value="8" <? if(@$arr_brother[0] == "8"){ ?> selected <?}?> >8</option>
									<option value="9" <? if(@$arr_brother[0] == "9"){ ?> selected <?}?> >9</option>
								</select>
								남
								<select class="bg_position padding_right_0 padding_left_2 width_33 height_24 margin_left_11" id="m_brother2" name="m_brother2">
									<option value="0" <? if(@$arr_brother[1] == "0"){ ?> selected <?}?> >0</option>
									<option value="1" <? if(@$arr_brother[1] == "1"){ ?> selected <?}?> >1</option>
									<option value="2" <? if(@$arr_brother[1] == "2"){ ?> selected <?}?> >2</option>
									<option value="3" <? if(@$arr_brother[1] == "3"){ ?> selected <?}?> >3</option>
									<option value="4" <? if(@$arr_brother[1] == "4"){ ?> selected <?}?> >4</option>
									<option value="5" <? if(@$arr_brother[1] == "5"){ ?> selected <?}?> >5</option>
									<option value="6" <? if(@$arr_brother[1] == "6"){ ?> selected <?}?> >6</option>
									<option value="7" <? if(@$arr_brother[1] == "7"){ ?> selected <?}?> >7</option>
									<option value="8" <? if(@$arr_brother[1] == "8"){ ?> selected <?}?> >8</option>
									<option value="9" <? if(@$arr_brother[1] == "9"){ ?> selected <?}?> >9</option>
								</select>
								녀
								<select class="bg_position padding_right_0 padding_left_2 width_33 height_24 margin_left_11" id="m_brother3" name="m_brother3">
									<option value="0" <? if(@$arr_brother[2] == "0"){ ?> selected <?}?> >0</option>
									<option value="1" <? if(@$arr_brother[2] == "1"){ ?> selected <?}?> >1</option>
									<option value="2" <? if(@$arr_brother[2] == "2"){ ?> selected <?}?> >2</option>
									<option value="3" <? if(@$arr_brother[2] == "3"){ ?> selected <?}?> >3</option>
									<option value="4" <? if(@$arr_brother[2] == "4"){ ?> selected <?}?> >4</option>
									<option value="5" <? if(@$arr_brother[2] == "5"){ ?> selected <?}?> >5</option>
									<option value="6" <? if(@$arr_brother[2] == "6"){ ?> selected <?}?> >6</option>
									<option value="7" <? if(@$arr_brother[2] == "7"){ ?> selected <?}?> >7</option>
									<option value="8" <? if(@$arr_brother[2] == "8"){ ?> selected <?}?> >8</option>
									<option value="9" <? if(@$arr_brother[2] == "9"){ ?> selected <?}?> >9</option>
								</select>
								째
							</div>
						</td>
						<td>연소득</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_attainment" name="m_attainment">
									<option value="" >선택하세요.</option>
									<option value="1" <? if(@$remarry_data['m_attainment'] == "1"){ ?> selected <?}?> >1000이하</option>
									<option value="2" <? if(@$remarry_data['m_attainment'] == "2"){ ?> selected <?}?> >1000~1500</option>
									<option value="3" <? if(@$remarry_data['m_attainment'] == "3"){ ?> selected <?}?> >1500~2000</option>
									<option value="4" <? if(@$remarry_data['m_attainment'] == "4"){ ?> selected <?}?> >2000~2500</option>
									<option value="5" <? if(@$remarry_data['m_attainment'] == "5"){ ?> selected <?}?> >2500~3000</option>
									<option value="6" <? if(@$remarry_data['m_attainment'] == "6"){ ?> selected <?}?> >3000~5000</option>
									<option value="7" <? if(@$remarry_data['m_attainment'] == "7"){ ?> selected <?}?> >5000~7000</option>
									<option value="8" <? if(@$remarry_data['m_attainment'] == "8"){ ?> selected <?}?> >7000~1억</option>
									<option value="9" <? if(@$remarry_data['m_attainment'] == "9"){ ?> selected <?}?> >1억이상</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>차량소유</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_car" name="m_car">
									<option value="" >선택하세요.</option>
									<option value="1" <? if(@$remarry_data['m_car'] == "1"){ ?> selected <?}?> >무소유</option>
									<option value="2" <? if(@$remarry_data['m_car'] == "2"){ ?> selected <?}?> >1000CC~1500CC</option>
									<option value="3" <? if(@$remarry_data['m_car'] == "3"){ ?> selected <?}?> >1500CC~2000CC</option>
									<option value="4" <? if(@$remarry_data['m_car'] == "4"){ ?> selected <?}?> >2000CC~2500CC</option>
									<option value="5" <? if(@$remarry_data['m_car'] == "5"){ ?> selected <?}?> >2500CC~3000CC</option>
									<option value="6" <? if(@$remarry_data['m_car'] == "6"){ ?> selected <?}?> >3000CC이상</option>
								</select>
							</div>
						</td>
						<td>종교</td>
						<td>
							<div class="popup_select margin_right_2 block width_165 height_24">
								<select class="padding_left_2 width_165 height_24" id="m_faith" name="m_faith">
									<option value="" >선택하세요</option>
									<option value="1" <? if(@$remarry_data['m_faith'] == "1"){ ?> selected <?}?> >기독교</option>
									<option value="2" <? if(@$remarry_data['m_faith'] == "2"){ ?> selected <?}?> >불교</option>
									<option value="3" <? if(@$remarry_data['m_faith'] == "3"){ ?> selected <?}?> >천주교</option>
									<option value="4" <? if(@$remarry_data['m_faith'] == "4"){ ?> selected <?}?> >기타종교</option>
									<option value="5" <? if(@$remarry_data['m_faith'] == "5"){ ?> selected <?}?> >무교</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td style="vertical-align:top" class="padding_top_10">취미</td>
						<td style="height:220px" colspan="3" class="ver_top">
							<input type="text" placeholder="직접입력" class="color_666 width_435 height_22 margin_left_0 margin_top_9 padding_right_24" id="m_hobby_text" name="m_hobby_text" value="<?=@$remarry_data['m_hobby_text']?>" <?=@$remarry_data['read_only']?> />
							
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_1" class="popup_checkbox" value="1" <? if(@$hobby_check_1 == "1"){ ?> checked <?}?> ><label for="hobby_check_1" class="popup_checkbox_label font_no">  음주가무</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_2" class="popup_checkbox" value="2" <? if(@$hobby_check_2 == "2"){ ?> checked <?}?> ><label for="hobby_check_2" class="popup_checkbox_label font_no">  애완동물</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_3" class="popup_checkbox" value="3" <? if(@$hobby_check_3 == "3"){ ?> checked <?}?> ><label for="hobby_check_3" class="popup_checkbox_label font_no">  미팅&#38;채팅</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_4" class="popup_checkbox" value="4" <? if(@$hobby_check_4 == "4"){ ?> checked <?}?> ><label for="hobby_check_4" class="popup_checkbox_label font_no">  게임</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_5" class="popup_checkbox" value="5" <? if(@$hobby_check_5 == "5"){ ?> checked <?}?> ><label for="hobby_check_5" class="popup_checkbox_label font_no">  종교</label>
								</div>
							</div>
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_6" class="popup_checkbox" value="6" <? if(@$hobby_check_6 == "6"){ ?> checked <?}?> ><label for="hobby_check_6" class="popup_checkbox_label font_no">  봉사활동</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_7" class="popup_checkbox" value="7" <? if(@$hobby_check_7 == "7"){ ?> checked <?}?> ><label for="hobby_check_7" class="popup_checkbox_label font_no">  식도락</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_8" class="popup_checkbox" value="8" <? if(@$hobby_check_8 == "8"){ ?> checked <?}?> ><label for="hobby_check_8" class="popup_checkbox_label font_no">  재테크</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_9" class="popup_checkbox" value="9" <? if(@$hobby_check_9 == "9"){ ?> checked <?}?> ><label for="hobby_check_9" class="popup_checkbox_label font_no">  패션</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_10" class="popup_checkbox" value="10" <? if(@$hobby_check_10 == "10"){ ?> checked <?}?> ><label for="hobby_check_10" class="popup_checkbox_label font_no">  댄스</label>
								</div>
							</div>
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_11" class="popup_checkbox" value="11" <? if(@$hobby_check_11 == "11"){ ?> checked <?}?> ><label for="hobby_check_11" class="popup_checkbox_label font_no">  TV/비디오</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_12" class="popup_checkbox" value="12" <? if(@$hobby_check_12 == "12"){ ?> checked <?}?> ><label for="hobby_check_12" class="popup_checkbox_label font_no">  라디오</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_13" class="popup_checkbox" value="13" <? if(@$hobby_check_13 == "13"){ ?> checked <?}?> ><label for="hobby_check_13" class="popup_checkbox_label font_no">  놀이동산</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_14" class="popup_checkbox" value="14" <? if(@$hobby_check_14 == "14"){ ?> checked <?}?> ><label for="hobby_check_14" class="popup_checkbox_label font_no">  여행</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_15" class="popup_checkbox" value="15" <? if(@$hobby_check_15 == "15"){ ?> checked <?}?> ><label for="hobby_check_15" class="popup_checkbox_label font_no">  요리</label>
								</div>
							</div>
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_16" class="popup_checkbox" value="16" <? if(@$hobby_check_16 == "16"){ ?> checked <?}?> ><label for="hobby_check_16" class="popup_checkbox_label font_no">  드라이브</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_17" class="popup_checkbox" value="17" <? if(@$hobby_check_17 == "17"){ ?> checked <?}?> ><label for="hobby_check_17" class="popup_checkbox_label font_no">  인테리어</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_18" class="popup_checkbox" value="18" <? if(@$hobby_check_18 == "18"){ ?> checked <?}?> ><label for="hobby_check_18" class="popup_checkbox_label font_no">  연극/영화</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_19" class="popup_checkbox" value="19" <? if(@$hobby_check_19 == "19"){ ?> checked <?}?> ><label for="hobby_check_19" class="popup_checkbox_label font_no">  미용</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_20" class="popup_checkbox" value="20" <? if(@$hobby_check_20 == "20"){ ?> checked <?}?> ><label for="hobby_check_20" class="popup_checkbox_label font_no">  정치</label>
								</div>
							</div>
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_21" class="popup_checkbox" value="21" <? if(@$hobby_check_21 == "21"){ ?> checked <?}?> ><label for="hobby_check_21" class="popup_checkbox_label font_no">  사진/영상</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_22" class="popup_checkbox" value="22" <? if(@$hobby_check_22 == "22"){ ?> checked <?}?> ><label for="hobby_check_22" class="popup_checkbox_label font_no">  연예계</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_23" class="popup_checkbox" value="23" <? if(@$hobby_check_23 == "23"){ ?> checked <?}?> ><label for="hobby_check_23" class="popup_checkbox_label font_no">  독서/만화</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_24" class="popup_checkbox" value="24" <? if(@$hobby_check_24 == "24"){ ?> checked <?}?> ><label for="hobby_check_24" class="popup_checkbox_label font_no">  등산</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_25" class="popup_checkbox" value="25" <? if(@$hobby_check_25 == "25"){ ?> checked <?}?> ><label for="hobby_check_25" class="popup_checkbox_label font_no">  쇼핑</label>
								</div>
							</div>
							<div class="margin_top_13">
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_26" class="popup_checkbox" value="26" <? if(@$hobby_check_26 == "26"){ ?> checked <?}?> ><label for="hobby_check_26" class="popup_checkbox_label font_no">  장기/바둑</label>
								</div>
								<div class="width_90 block">
									<input type="checkbox" id="hobby_check_27" class="popup_checkbox" value="27" <? if(@$hobby_check_27 == "27"){ ?> checked <?}?> ><label for="hobby_check_27" class="popup_checkbox_label font_no">  수다떨기</label>
								</div>
								<div class="width_100 block">
									<input type="checkbox" id="hobby_check_28" class="popup_checkbox" value="28" <? if(@$hobby_check_28 == "28"){ ?> checked <?}?> ><label for="hobby_check_28" class="popup_checkbox_label font_no">  컴퓨터</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_29" class="popup_checkbox" value="29" <? if(@$hobby_check_29 == "29"){ ?> checked <?}?> ><label for="hobby_check_29" class="popup_checkbox_label font_no">  낚시</label>
								</div>
								<div class="width_80 block">
									<input type="checkbox" id="hobby_check_30" class="popup_checkbox" value="30" <? if(@$hobby_check_30 == "30"){ ?> checked <?}?> ><label for="hobby_check_30" class="popup_checkbox_label font_no">  기타</label>
								</div>
							</div>

						</td>
					</tr>
				</table>
			</div>
			
			<? if($this->session->userdata['m_userid'] == @$remarry_data['m_userid'] || @$remarry_data['m_userid'] == ""){ ?>
			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="button" class="text_btn_de4949 width_62 height_30" value="완료" onclick="javascript:reg_open_remarry();"/>
			</div>
			<? }else{ ?>			
			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="button" class="text_btn_de4949 width_62 height_30" value="닫기" onclick="modal.close();"/>
			</div>
			
			<? } ?>