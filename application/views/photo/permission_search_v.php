
			<div class="submenu_select_area">
				<div class="submenu_select_box text-center">
					<p>지역</p>
					<div class="select_box_border">
						<select class="width_82 height_36" id="m_conregion" name="m_conregion">
							<option value="">선택</option>
							<option value="서울" <? if($m_conregion == "서울"){ echo "selected"; } ?> >서울</option>
							<option value="경기" <? if($m_conregion == "경기"){ echo "selected"; } ?> >경기</option>
							<option value="인천" <? if($m_conregion == "인천"){ echo "selected"; } ?> >인천</option>
							<option value="강원" <? if($m_conregion == "강원"){ echo "selected"; } ?> >강원</option>
							<option value="경남" <? if($m_conregion == "경남"){ echo "selected"; } ?> >경남</option>
							<option value="부산" <? if($m_conregion == "부산"){ echo "selected"; } ?> >부산</option>
							<option value="경북" <? if($m_conregion == "경북"){ echo "selected"; } ?> >경북</option>
							<option value="대구" <? if($m_conregion == "대구"){ echo "selected"; } ?> >대구</option>
							<option value="전북" <? if($m_conregion == "전북"){ echo "selected"; } ?> >전북</option>
							<option value="전남" <? if($m_conregion == "전남"){ echo "selected"; } ?> >전남</option>
							<option value="광주" <? if($m_conregion == "광주"){ echo "selected"; } ?> >광주</option>
							<option value="충북" <? if($m_conregion == "충북"){ echo "selected"; } ?> >충북</option>
							<option value="충남" <? if($m_conregion == "충남"){ echo "selected"; } ?> >충남</option>
							<option value="대전" <? if($m_conregion == "대전"){ echo "selected"; } ?> >대전</option>
							<option value="제주" <? if($m_conregion == "제주"){ echo "selected"; } ?> >제주</option>
							<option value="울산" <? if($m_conregion == "울산"){ echo "selected"; } ?> >울산</option>
							<option value="해외" <? if($m_conregion == "해외"){ echo "selected"; } ?> >해외</option>
						</select>
					</div>		 <!-- ##	select_box_border end	## -->
					<p class="padding_left_10">나이</p>
					<div class="select_box_border">
						<select class="width_82 height_36" id="m_age" name="m_age">
							<option value="">전체</option>
							<option value="20" <? if($m_age == "20"){ echo "selected"; } ?> >20대</option>
							<option value="30" <? if($m_age == "30"){ echo "selected"; } ?> >30대</option>
							<option value="40" <? if($m_age == "40"){ echo "selected"; } ?> >40대</option>
							<option value="50" <? if($m_age == "50"){ echo "selected"; } ?> >50대 이상</option>
						</select>
					</div>		 <!-- ##	select_box_border end	## -->
					<p class="padding_left_10">원하는 만남</p>
					<div class="select_box_border">
						<select class="width_166 height_36 margin_left_5" id="m_reason" name="m_reason">
							<option value="">선택</option>
							<? for($i=1; $i<=15; $i++){ ?>
							<option value="<?=$i?>" <? if($m_reason == $i){ echo "selected"; } ?> ><?=want_reason_data($i)?></option>
							<? } ?>
						</select>
					</div>		 <!-- ##	select_box_border end	## -->
					<input type="button" value="검색" class="margin_left_7" id="photo_search_btn" name="photo_search_btn" onclick="javascript:photo_permission_search('<?=$this->uri->segment(3)?>');"/>
					
					<div class="clear"></div>
				</div>		<!-- ## submenu_select_box end ## -->
			</div>		<!-- ## submenu_select_area end ## -->