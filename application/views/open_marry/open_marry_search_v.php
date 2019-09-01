		<div class="submenu_select_area margin_top_20">		<!-- margin_top_50 -->
			<div class="submenu_select_box text-center">
				<span class="color_333 font-size_14 blod margin_top_10">구혼형태 </span>
				<div class="select_box_border margin_right_8">
					<select class="width_82 height_36" id="m_type" name="m_type">
						<option value="" >전체</option>
						<option value="결혼" <? if(@$m_type == "결혼"){ ?> selected <?}?> >결혼</option>
						<option value="재혼" <? if(@$m_type == "재혼"){ ?> selected <?}?> >재혼</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->
				<span class="color_333 font-size_14 blod margin_top_10">지역 </span>
				<div class="select_box_border margin_right_8">
					<select class="width_82 height_36" id="m_conregion" name="m_conregion">
						<option value="">상관없음</option>
						<option value="서울" <? if(@$m_conregion == "서울"){ ?> selected <?}?> >서울</option>
						<option value="인천" <? if(@$m_conregion == "인천"){ ?> selected <?}?> >인천</option>
						<option value="부산" <? if(@$m_conregion == "부산"){ ?> selected <?}?> >부산</option>
						<option value="대구" <? if(@$m_conregion == "대구"){ ?> selected <?}?> >대구</option>
						<option value="대전" <? if(@$m_conregion == "대전"){ ?> selected <?}?> >대전</option>
						<option value="광주" <? if(@$m_conregion == "광주"){ ?> selected <?}?> >광주</option>
						<option value="울산" <? if(@$m_conregion == "울산"){ ?> selected <?}?> >울산</option>
						<option value="경기" <? if(@$m_conregion == "경기"){ ?> selected <?}?> >경기</option>
						<option value="강원" <? if(@$m_conregion == "강원"){ ?> selected <?}?> >강원</option>
						<option value="충남" <? if(@$m_conregion == "충남"){ ?> selected <?}?> >충남</option>
						<option value="충북" <? if(@$m_conregion == "충북"){ ?> selected <?}?> >충북</option>
						<option value="경남" <? if(@$m_conregion == "경남"){ ?> selected <?}?> >경남</option>
						<option value="경북" <? if(@$m_conregion == "경북"){ ?> selected <?}?> >경북</option>
						<option value="전남" <? if(@$m_conregion == "전남"){ ?> selected <?}?> >전남</option>
						<option value="전북" <? if(@$m_conregion == "전북"){ ?> selected <?}?> >전북</option>
						<option value="제주" <? if(@$m_conregion == "제주"){ ?> selected <?}?> >제주</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->
				<span class="color_333 font-size_14 blod margin_top_10">성별 </span>
				<div class="select_box_border margin_right_8">
					<select class="width_82 height_36" id="m_sex" name="m_sex">
						<option value="">전체</option>
						<option value="M" <? if(@$m_sex == "M"){ ?> selected <?}?> >남자</option>
						<option value="F" <? if(@$m_sex == "F"){ ?> selected <?}?> >여자</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->
				<span class="color_333 font-size_14 blod margin_top_10">나이대 </span>
				<div class="select_box_border">
					<select class="width_136 height_36 margin_left_2" id="m_age" name="m_age">
						<option value="">선 택</option>
						<option value="2024" <? if(@$m_age == "2024"){ ?> selected <?}?> >20세~24세</option>
						<option value="2529" <? if(@$m_age == "2529"){ ?> selected <?}?> >25세~29세</option>
						<option value="3034" <? if(@$m_age == "3034"){ ?> selected <?}?> >30세~34세</option>
						<option value="3539" <? if(@$m_age == "3539"){ ?> selected <?}?> >35세~39세</option>
						<option value="4044" <? if(@$m_age == "4044"){ ?> selected <?}?> >40세~44세</option>
						<option value="4549" <? if(@$m_age == "4549"){ ?> selected <?}?> >45세~49세</option>
						<option value="5054" <? if(@$m_age == "5054"){ ?> selected <?}?> >50세~54세</option>
						<option value="5559" <? if(@$m_age == "5559"){ ?> selected <?}?> >55세~59세</option>
						<option value="6099" <? if(@$m_age == "6099"){ ?> selected <?}?> >60세이상</option>
					</select>
				</div>		 <!-- ##	select_box_border end	## -->

				<input type="button" value="검색" class="float_right margin_right_8" onclick="javascript:open_guhon_search('<?=$this->uri->segment(3)?>');"/>
				
				<div class="clear"></div>
			</div>		<!-- ## submenu_select_box end ## -->
		</div>		<!-- ## submenu_select_area end ## -->