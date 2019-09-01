<div class="iphone_padding">

	<table class="find_tab">
		<tr>
			<td class="blod color_ea3c3c width_50per">
				<label>
					<input type="radio" name="search_what" value="1" id="checked_id" onclick="javascript:search_what(1);" checked><span>아이디 찾기</span>
				</label>
			</td>
			<td class="blod width_50per">
				<label>
					<input type="radio" name="search_what" value="2" id="checked_pwd" onclick="javascript:search_what(2);"><span>비밀번호 찾기</span>
				</label>
			</td>
		</tr>
	</table>


	<div class="find_area">

		<div class="width_95per margin_auto padding_bottom_10">
			<p class="color_333 padding_top_10 margin_bottom_10">회원가입시 입력한 정보를 정확히 입력해주세요.</p>

			<!-- ## 아이디 찾기 ## -->
			<table class="mobile_border_table width_100per margin_top_10" id="id_search">
				<tr>
					<td>이름</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<input type="text" class="m_join_text" id="m_find_name">
						</div>
					</td>
				</tr>
				<tr>
					<td class="ver_top padding_top_10">생년월일</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<div class="width_27per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_year">
									<option value="">생년</option>
									<? for($i=date('Y'); $i>=1940; $i--){ ?>
									<option value="<?=$i?>"><?=$i?>년</option>
									<? } ?>
								</select>
							</div>
							<div class="width_22per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_month">
									<option value="">월</option>
									<? for($i=1; $i<13; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>월</option>
									<? } ?>
								</select>
							</div>
							<div class="width_22per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_day">
									<option value="">일</option>
									<? for($i=1; $i<32; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>일</option>
									<? } ?>
								</select>
							</div>
						</div>
						<div class="clear"></div>
						<p class="width_95per margin_auto color_999 padding_0500">주민등록상의 생년월일을 입력해주세요.</p>
					</td>
				</tr>
				<tr>
					<td>성별</td>
					<td>
						<div class="width_95per margin_auto">
							<input type="radio" class="m_radiobox" id="m_sex_man" name="m_sex" value="M" checked><label for="m_sex_man" class="color_666 margin_right_15">&nbsp;&nbsp;남자</label>
							<input type="radio" class="m_radiobox" id="m_sex_girl" name="m_sex" value="F"><label for="m_sex_girl" class="color_666 margin_right_15">&nbsp;&nbsp;여자</label>
						</div>
					</td>
				</tr>
			</table>
			<!---->


			<!-- ## 비밀번호 찾기 ## -->
			<table class="mobile_border_table width_100per margin_top_10" id="pwd_search">
				<tr>
					<td>아이디</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<input type="text" class="m_join_text" id="m_find_id2">
						</div>
					</td>
				</tr>
				<tr>
					<td>이름</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<input type="text" class="m_join_text" id="m_find_name2">
						</div>
					</td>
				</tr>
				<tr>
					<td class="ver_top padding_top_10">생년월일</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<div class="width_27per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_year2">
									<option value="">생년</option>
									<? for($i=date('Y'); $i>=1940; $i--){ ?>
									<option value="<?=$i?>"><?=$i?>년</option>
									<? } ?>
								</select>
							</div>
							<div class="width_22per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_month2">
									<option value="">월</option>
									<? for($i=1; $i<13; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>월</option>
									<? } ?>
								</select>
							</div>
							<div class="width_22per float_left border_1_cccccc mobile_select">
								<select class="border_none width_100per border_0 text_5 color_666" id="m_find_day2">
									<option value="">일</option>
									<? for($i=1; $i<32; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>일</option>
									<? } ?>
								</select>
							</div>
						</div>
						<div class="clear"></div>
						<p class="width_95per margin_auto color_999 padding_0500">주민등록상의 생년월일을 입력해주세요.</p>
					</td>
				</tr>
				<tr>
					<td>성별</td>
					<td>
						<div class="width_95per margin_auto">
							<input type="radio" class="m_radiobox" id="m_sex_man2" name="m_sex2" value="M" checked><label for="m_sex_man2" class="color_666 margin_right_15">&nbsp;&nbsp;남자</label>
							<input type="radio" class="m_radiobox" id="m_sex_girl2" name="m_sex2" value="F"><label for="m_sex_girl2" class="color_666 margin_right_15">&nbsp;&nbsp;여자</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>회신방법</td>
					<td>
						<div class="width_95per margin_auto">
							<div class="margin_top_10">
								<input type="radio" class="m_radiobox" id="recv_ph" name="search_receive" value="1" checked onclick="recv_way(1);"><label for="recv_ph">&nbsp;&nbsp;휴대폰으로 받기</label>
								<input type="radio" class="m_radiobox" id="recv_em" name="search_receive" value="2" onclick="recv_way(2);"><label for="recv_em">&nbsp;&nbsp;이메일로 받기</label>
							</div>

							<div class="select_box_ccc_border margin_top_10 margin_bottom_10" id="pwd_1_display">
								<select id="search_hp1" name="search_hp1">
									<option value="010">010</option>
									<option value="011">011</option>
									<option value="016">016</option>
									<option value="017">017</option>
									<option value="018">018</option>
									<option value="019">019</option>
								</select>
								-
								<input type="text" id="search_hp2" name="search_hp2" value=""/>
								-
								<input type="text" id="search_hp3" name="search_hp3" value=""/>
							</div>
							<div class="select_box_ccc_border margin_top_10 margin_bottom_10" id="pwd_2_display" style="display:none;">
								<input type="text" id="email_id"/>
								@
								<input type="text" id="email_after">
								<select id="email_selecter" onChange="javascript:email_cha();">
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
						</div>				
					</td>
				</tr>
			</table>

		</div>
		

		<div class="width_95per margin_auto padding_bottom_10" style="height:100px; display:none;" id="id_view">
			
		</div>

	</div>

	<div class="width_100per text-center margin_top_10">
		<input type="button" class="find_btn" id="confirm_id" value="아이디 확인" onclick="javascript:search_id();"/>
		<input type="button" class="find_btn" id="confirm_pw" value="비밀번호 확인" onclick="javascript:search_pwd();"/>
	</div>

</div>