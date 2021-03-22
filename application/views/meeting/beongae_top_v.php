		<div class="meeting_top_area">
			<img src="<?=IMG_DIR?>/meeting/met_sub1_topimg.gif" class="beongae_top_img">
			<div class="calendar_area ll-skin-vigo"></div>
			<input type=hidden name="w_day" id="w_day" value="<?=date("Y-m-d")?>">
			<div class="light_add_area">
				<div class="light_add_box">
					<div class="select_box_border">
						<select class="calendar_select" name="w_region" id="w_region">
							<option value="">지역</option>
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
							<option value="해외">해외</option>
						</select>
					</div>
					<div class="select_box_border">
						<select class="calendar_select" name="w_time" id="w_time">
							<option value="">시간</option>
							<option value="1">상관없음</option>
							<option value="2">02시~06시</option>
							<option value="3">06시~10시</option>
							<option value="4">10시~14시</option>
							<option value="5">14시~18시</option>
							<option value="6">18시~22시</option>
							<option value="7">22시~02시</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class="select_box_border">
						<select class="calendar_select" name="w_wantcnt" id="w_wantcnt">
							<option value="">인원</option>
							<option value="1">1:1</option>
							<option value="2">2:2</option>
							<option value="3">3:3</option>
							<option value="4">4:4</option>
							<option value="5">5:5</option>
						</select>
					</div>
					<div class="select_box_border">
						<select class="calendar_select" name="w_interest" id="w_interest">
							<option value="">관심사</option>
							<option value="1">패션</option>
							<option value="2">스포츠</option>
							<option value="3">음악</option>
							<option value="4">인터넷</option>
							<option value="5">연극/영화</option>
							<option value="6">재테크</option>
							<option value="7">요리</option>
							<option value="8">종교</option>
							<option value="9">TV/비디오</option>
							<option value="10">자동차</option>
							<option value="11">온라인게임</option>
							<option value="12">여행</option>
							<option value="13">정치/사회</option>
							<option value="14">기타</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class="light_textarea">
						<div class="textarea_scroll">
							<textarea placeholder="내용을 입력하세요."  name="w_intro" id="w_intro" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
						</div>
					</div>
					<!--<input type="button" class="text_btn_ea3e3e light_add_btn" value="번개팅 등록하기" onclick="<php user_check("form_check();",1);php>">//-->
					<input type="button" class="text_btn_ea3e3e light_add_btn" value="번개팅 등록하기" onclick="return false;">
				</div>
			</div>
		</div>