		<div class="tab_content_top_area meet_height_56">
			<div class="float_left margin_top_10">
				<div class="select_box_border">
					<select class="sms_select" name="conregion" id="conregion">
						<option value=" ">지역</option>
						<option value="서울">서울</option>
						<option value="경기">경기</option>
						<option value="인천">인천</option>
						<option value="강원">강원</option>
						<option value="경남">경남</option>
						<option value="부산">부산</option>
						<option value="경북">경북</option>
						<option value="대구">대구</option>
						<option value="전북">전북</option>
						<option value="전남">전남</option>
						<option value="광주">광주</option>
						<option value="충북">충북</option>
						<option value="충남">충남</option>
						<option value="대전">대전</option>
						<option value="제주">제주</option>
						<option value="울산">울산</option>
						<option value="16">해외</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->

				<div class="select_box_border">
					<select class="sms_select" name="age2" id="age2">
						<option value=" ">나이</option>
						<option value=" ">전체회원</option>
						<option value="2">20대회원</option>
						<option value="3">30대회원</option>
						<option value="4">40대회원</option>
						<option value="5">50대회원</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->
				
				<input type="button" class="meeting_search_btn" value="검색" id="search_btn" onclick="sms_search('<?=$this->uri->segment(3)?>');" />

			</div>

			<div class="float_right">
				<input type="button" class="text_btn_ea3e3e sms_alladd_btn margin_top_10" value="선택회원 한번에 추가" onclick="javascript:sms_chk();">
			</div>
			<div class="clear"></div>
		</div>