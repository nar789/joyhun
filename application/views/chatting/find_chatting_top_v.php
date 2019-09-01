		
		<div class="oneclick_area">
			<div class="margin_left_16 margin_top_14">
				<p class="chat_member_find_title">원클릭 <b class="color_333 font-size_14">채팅상대찾기</b></p>
				<div class="chat_member_find_box width_210">
					<div class="padding_10">
						<p class="color_333 blod line-height_16">최근 3개월간 접속한 회원으로 <br>매일 업데이트됩니다.</p>
						<div style="width:190px;height:104px;">
							<div class="oneclick_find_checkarea margin_top_11">
								<input type="checkbox" name="oneclick_find_checkbox1" id="onclick_same_age1" value="on" <? if($mode == "1"){ echo $v_check1; }else{ echo "checked";}  ?> ><label for="onclick_same_age1"></label>
								<span class="oneclick_find_text">동일한 나이대</span>
							</div>
							<div class="oneclick_find_checkarea margin_top_12">
								<input type="checkbox" name="oneclick_find_checkbox2" id="onclick_same_age2" value="on" <? if($mode == "1"){ echo $v_check2; }else{ echo "checked";}  ?> ><label for="onclick_same_age2"></label>
								<span class="oneclick_find_text">동일한 지역</span>
							</div>
							<div class="oneclick_find_checkarea margin_top_12">
								<input type="checkbox" name="oneclick_find_checkbox3" id="onclick_same_age3" value="on" <? if($mode == "1"){ echo $v_check3; }else{ echo "checked";}  ?> ><label for="onclick_same_age3"></label>
								<span class="oneclick_find_text">동일한 관심사</span>
							</div>
							<div class="oneclick_find_checkarea margin_top_12">
								<input type="checkbox" name="oneclick_find_checkbox4" id="onclick_same_age4" value="on" <? if($mode == "1"){ echo $v_check4; }else{ echo "checked";}  ?> ><label for="onclick_same_age4"></label>
								<span class="oneclick_find_text">사진있는 회원</span>
							</div>
						</div>
						<input type="button" class="text_btn_6d879e chat_member_find_btn margin_top_mi_3 float_right" value="검색" onclick="javascript:to_member_search('1');"/>
					</div>
				</div>	<!-- ## chat_member_find_box end ## -->
			</div>
		</div>		<!-- ## oneclick_area end ## -->

		<div class="member_detail_find_area">
			<div class="margin_left_16 margin_top_14">
				<p class="chat_member_find_title">회원  <b class="color_333 font-size_14">상세찾기</b></p>
				<div class="chat_member_find_box width_444">
					<div class="padding_left_10 padding_right_10">

						<div class="member_detail_tr_1">
							<span class="color_333 blod width_90 block">원하는 나이대</span>
							<div class="wanna_age_box">
								<input type="radio" id="wannae_age_radio1" name="wanna_age" value="00" <? if($mode == "2"){ if($wanna_age == "00"){ echo "checked"; } }else{ echo "checked"; } ?> ><label for="wannae_age_radio1"></label><span>전체</span>
								<input type="radio" id="wannae_age_radio2" name="wanna_age" value="20" <? if(@$wanna_age == "20"){ echo "checked"; } ?> ><label for="wannae_age_radio2"></label><span>20대</span>
								<input type="radio" id="wannae_age_radio3" name="wanna_age" value="30" <? if(@$wanna_age == "30"){ echo "checked"; } ?> ><label for="wannae_age_radio3"></label><span>30대</span>
								<input type="radio" id="wannae_age_radio4" name="wanna_age" value="40" <? if(@$wanna_age == "40"){ echo "checked"; } ?> ><label for="wannae_age_radio4"></label><span>40대</span>
								<input type="radio" id="wannae_age_radio5" name="wanna_age" value="50" <? if(@$wanna_age == "50"){ echo "checked"; } ?> ><label for="wannae_age_radio5"></label><span>50대</span>
								<input type="radio" id="wannae_age_radio6" name="wanna_age" value="60" <? if(@$wanna_age == "60"){ echo "checked"; } ?> ><label for="wannae_age_radio6"></label><span>60대</span>
							</div>
						</div>		<!-- ## member_detail_tr_1 end ## -->

						<div class="member_detail_tr_2">
							<span class="color_333 blod width_90 block ver_top">원하는 지역</span>
							<div class="wanna_area_box block">
								<select id="conregion" name="conregion">
									<option value="00" <? if(@$conregion == "00"){ echo "selected";} ?> >상관없음</option>
									<option value="서울" <? if(@$conregion == "서울"){ echo "selected";} ?> >서울</option>
									<option value="경기" <? if(@$conregion == "경기"){ echo "selected";} ?> >경기</option>
									<option value="인천" <? if(@$conregion == "인천"){ echo "selected";} ?> >인천</option>
									<option value="부산" <? if(@$conregion == "부산"){ echo "selected";} ?> >부산</option>
									<option value="대구" <? if(@$conregion == "대구"){ echo "selected";} ?> >대구</option>
									<option value="광주" <? if(@$conregion == "광주"){ echo "selected";} ?> >광주</option>
									<option value="대전" <? if(@$conregion == "대전"){ echo "selected";} ?> >대전</option>
									<option value="경남" <? if(@$conregion == "경남"){ echo "selected";} ?> >경남</option>
									<option value="경북" <? if(@$conregion == "경북"){ echo "selected";} ?> >경북</option>
									<option value="울산" <? if(@$conregion == "울산"){ echo "selected";} ?> >울산</option>
									<option value="전남" <? if(@$conregion == "전남"){ echo "selected";} ?> >전남</option>
									<option value="전북" <? if(@$conregion == "전북"){ echo "selected";} ?> >전북</option>
									<option value="세종" <? if(@$conregion == "세종"){ echo "selected";} ?> >세종</option>
									<option value="충남" <? if(@$conregion == "충남"){ echo "selected";} ?> >충남</option>
									<option value="충북" <? if(@$conregion == "충북"){ echo "selected";} ?> >충북</option>
									<option value="강원" <? if(@$conregion == "강원"){ echo "selected";} ?> >강원</option>
									<option value="제주" <? if(@$conregion == "제주"){ echo "selected";} ?> >제주</option>
								</select>
							</div>
							<span class="color_999 font-size_11 block margin_left_5">전체검색을 원하시면 상관없음 선택</span>
						</div>	<!-- ## member_detail_tr_2 end ## -->

						<div class="wanna_age_box">
							<div class="member_detail_tr_2 border_none width_424">
								<span class="color_333 blod ver_top">원하는 만남</span>
								<div class="wanna_area_box block width_140">
									<select class="width_140" id="want_reason" name="want_reason">
										<option value=" ">상관없음</option>
										<? 
											$arr = want_reason_data("all");
											foreach ($arr as $key => $value) {
										?>
												<option value="<?=$key?>" <? if(@$want_reason == $key){ echo "selected";} ?>><?=$value?></option>
										<? } ?>
									</select>
								</div>
								
								<div class="float_right">
								<span class="color_333 blod ver_top">대화 스타일</span>
								<div class="wanna_area_box block width_140">
									<select class="width_140" id="character_text" name="character_text">
										<option value=" ">상관없음</option>
										<? 
											if($this->session->userdata('m_sex') == "M"){$m_sex = "F";}else if($this->session->userdata('m_sex') == "F"){$m_sex = "M";}
											$arr = talk_style_data("all", @$m_sex);
											foreach ($arr as $key => $value) {
										?>
											<option value="<?=$key?>"  <? if(@$character_text == $key){ echo "selected";} ?>><?=$value?></option>
										<? } ?>
									</select>
								</div>
								</div>
							</div>
						</div>	<!-- ## wanna_age_box end ## -->
						
						<div>
							<input type="button" class="text_btn_6d879e chat_member_find_btn float_right" value="검색" onclick="javascript:to_member_search('2');"/>
						</div>

					</div>
				</div>	<!-- ## chat_member_find_box end ## -->
			</div>
		</div>	<!-- ## member_detail_find_area end ## -->

		<div class="clear"></div>