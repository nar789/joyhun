	<?php
		if($marry_type == ""){ $marry_type = "재혼";} 
	?>
	<div class="remarriage_top_area">
			<div class="marriage_top_padding">
				<div class="marriage_top_title">
					<div class="float_left">
						<p class="color_742b13 blod font-size_14 margin_top_13">평생 함께할 인연을 만나 좋은 만남 되세요~</p>
					</div>
					<div class="float_right">
						<? if(@$marry_data['cnt'] > 0){ ?>
						<input type="button" class="font_900 text_btn2_805222 marriage_btn " value="재혼신청 수정하기" onclick="<?user_check("rem_request();");?>" /> 
						<? }else{ ?>
						<input type="button" class="font_900 text_btn2_805222 marriage_btn " value="재혼신청 등록하기" onclick="<?user_check("rem_request();");?>" /> 
						<? } ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="remarriage_box_area">
					<div class="marriage_box_border">
						<div class="marriage_box_padding">
							<div>
								<div class="select_box_border width_102 height_36">
									<select class="width_102 height_36" id="marry_type" name="marry_type">
										<option value="결혼" <? if($marry_type == "결혼"){ ?> selected <?}?> >결혼</option>
										<option value="재혼" <? if($marry_type == "재혼"){ ?> selected <?}?> >재혼</option>
									</select>
								</div>

								<div class="select_box_border width_122 height_36">
									<select class="width_122 height_36" id="m_conregion" name="m_conregion">
										<option value="">원하는 지역</option>
										<option value="서울" <? if($m_conregion == "서울"){ ?> selected <?}?> >서울</option>
										<option value="인천" <? if($m_conregion == "인천"){ ?> selected <?}?> >인천</option>
										<option value="부산" <? if($m_conregion == "부산"){ ?> selected <?}?> >부산</option>
										<option value="대구" <? if($m_conregion == "대구"){ ?> selected <?}?> >대구</option>
										<option value="대전" <? if($m_conregion == "대전"){ ?> selected <?}?> >대전</option>
										<option value="광주" <? if($m_conregion == "광주"){ ?> selected <?}?> >광주</option>
										<option value="울산" <? if($m_conregion == "울산"){ ?> selected <?}?> >울산</option>
										<option value="경기" <? if($m_conregion == "경기"){ ?> selected <?}?> >경기</option>
										<option value="강원" <? if($m_conregion == "강원"){ ?> selected <?}?> >강원</option>
										<option value="충남" <? if($m_conregion == "충남"){ ?> selected <?}?> >충남</option>
										<option value="충북" <? if($m_conregion == "충북"){ ?> selected <?}?> >충북</option>
										<option value="경남" <? if($m_conregion == "경남"){ ?> selected <?}?> >경남</option>
										<option value="경북" <? if($m_conregion == "경북"){ ?> selected <?}?> >경북</option>
										<option value="전남" <? if($m_conregion == "전남"){ ?> selected <?}?> >전남</option>
										<option value="전북" <? if($m_conregion == "전북"){ ?> selected <?}?> >전북</option>
										<option value="제주" <? if($m_conregion == "제주"){ ?> selected <?}?> >제주</option>
									</select>
								</div>

								<div class="select_box_border width_122 height_36">
									<select class="width_122 height_36" id="m_age" name="m_age">
										<option value="">원하는 나이</option>
										<option value="0" <? if(@$m_age == "0"){ ?> selected <?}?> >상관없음</option>
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
								</div>
							</div>
							<div class="float_left padding_top_18">
								<input type="checkbox" id="marry_img_confirm" class="common_checkbox" <? if($file_ok == "1"){ ?> checked <?}?> ><label for="marry_img_confirm" class="common_checkbox_label"></label><span class="color_fff ver_mid margin_left_7">사진인증 받은 회원</span>
							</div>
							<div class="float_right padding_top_7">
								<input type="button" class="blod bg_742b13 text_btn2_104293 width_87 height_36" value="회원검색하기" onclick="javascript:search_list();"/>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
