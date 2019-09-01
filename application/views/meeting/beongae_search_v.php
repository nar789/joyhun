			<div class="submenu_select_area" id="light_select_area">
				<div class="submenu_select_box">
					<p>지역</p>
					<div class="select_box">
						<select class="meeting_search1" name="region" id="region">
							<option value=" ">선택</option>
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
					</div>		 <!-- ##	select_box end	## -->
					<p>시간</p>
					<div class="select_box">
						<select class="meeting_search1" name="time" id="time">
							<option value=" ">선택</option>
							<option value="1">상관없음</option>
							<option value="2">02시~06시</option>
							<option value="3">06시~10시</option>
							<option value="4">10시~14시</option>
							<option value="5">14시~18시</option>
							<option value="6">18시~22시</option>
							<option value="7">22시~02시</option>
						</select>
					</div>		 <!-- ##	select_box end	## -->
					<p>인원</p>
					<div class="select_box">
						<select class="meeting_search1" name="wantcnt" id="wantcnt">
							<option value=" ">선택</option>
							<option value="1">1:1</option>
							<option value="2">2:2</option>
							<option value="3">3:3</option>
							<option value="4">4:4</option>
							<option value="5">5:5</option>
						</select>
					</div>		 <!-- ##	select_box end	## -->
					<p>관심사</p>
					<div class="select_box">
						<select class="meeting_search2" name="interest" id="interest">
							<option value=" ">선택</option>
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
					</div>		 <!-- ##	select_box end	## -->
					<input type="button" value="검색" id="search_btn" onclick="b_search('<?=$this->uri->segment(3)?>');" />
					
					<div class="clear"></div>
				</div>		<!-- ## light_select_box end ## -->
			</div>		<!-- ## light_select_area end ## -->