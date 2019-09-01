
			
			<div id="tmp"></div>
			<input type="hidden" id="chk_val" name="chk_val" value="pw">
			<div class="padding_top_20 padding_left_20">
				<div class="radio_submenu">
					<label>
						<input type="radio" name="search_what" value="1" id="checked_id" onclick="javascript:search_what(1);"><span>아이디 찾기</span>
					</label>
					<label>
						<input type="radio" name="search_what" value="2" id="checked_pwd" onclick="javascript:search_what(2);" checked><span>비밀번호 찾기</span>
					</label>
				</div>

				<div class="margin_top_30">
					<p class="color_333 blod font-size_14">회원가입시 입력한 이름과 생년월일, 성별을 정확히 입력해주세요.</p>
				</div>
				
				<!-- 아이디 찾기 -->
				<table class="popup_border_table width_480" id="id_search" style="display:none;">
					<tr>
						<td>이름</td>
						<td class="width_366">
							<input type="text" class="width_127 height_20" id="search_name1" name="search_name1" value=""/>
						</td>
					</tr>
					<tr>
						<td class="ver_top"><p class="margin_top_12">생년월일</p></td>
						<td>
							<div class="select_box_ccc_border margin_top_8">
								<select class="width_70 height_20" id="search_year1" name="search_year1">
									<option value=""> 생년 </option>
									<? for($i=date('Y'); $i>=1940; $i--){ ?>
									<option value="<?=$i?>"><?=$i?>년</option>
									<? } ?>
								</select>
								<select class="width_62 height_20" id="search_month1" name="search_month1">
									<option value="">월</option>
									<? for($i=1; $i<13; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>월</option>
									<? } ?>
								</select>
								<select class="width_62 height_20" id="search_day1" name="search_day1">
									<option value="">일</option>
									<? for($i=1; $i<32; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>일</option>
									<? } ?>
								</select>
							</div>
							<p class="color_999 margin_top_7 margin_bottom_13">주민등록상의 생년월일을 입력해주세요.</p>
						</td>
					</tr>
					<tr>
						<td>성별</td>
						<td>
							<div class="radio_box">
								<input type="radio" id="man" name="search_sex1" value="M"/><label for="man"></label><span class="color_666">남자</span>
								<input type="radio" id="girl" name="search_sex1" value="F"/><label for="girl"></label><span class="color_666">여자</span>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="background:#fff;border-bottom:none;">
							<div class="margin_top_20 text-center padding_bottom_30" id="confirm_id">
								<input type="button" class="text_btn_de4949 width_98 height_30" value="아이디 확인" onclick="javascript:search_id();"/>
							</div>
						</td>
					</tr>
				</table>
				<!-- 아이디 찾기 -->
				
				<!-- 비밀번호 찾기 -->
				<table class="popup_border_table width_480" id="pwd_search">
					<tr>
						<td>아이디</td>
						<td class="width_366">
							<input type="text" class="width_127 height_20" id="search_id2" name="search_id2" value="<?=@$user_id?>"/>
						</td>
					</tr>
					<tr>
						<td>이름</td>
						<td>
							<input type="text" class="width_127 height_20" id="search_name2" name="search_name2" value=""/>
						</td>
					</tr>
					<tr>
						<td class="ver_top"><p class="margin_top_12">생년월일</p></td>
						<td>
							<div class="select_box_ccc_border margin_top_8">
								<select class="width_70 height_20" id="search_year2" name="search_year2">
									<option value=""> 생년 </option>
									<? for($i=date('Y'); $i>=1940; $i--){ ?>
									<option value="<?=$i?>"><?=$i?>년</option>
									<? } ?>
								</select>
								<select class="width_62 height_20" id="search_month2" name="search_month2">
									<option value="">월</option>
									<? for($i=1; $i<13; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>월</option>
									<? } ?>
								</select>
								<select class="width_62 height_20" id="search_day2" name="search_day2">
									<option value="">일</option>
									<? for($i=1; $i<32; $i++){ ?>
									<option value="<?=$i?>"><?=$i?>일</option>
									<? } ?>
								</select>
							</div>
							<p class="color_999 margin_top_7 margin_bottom_13">주민등록상의 생년월일을 입력해주세요.</p>
						</td>
					</tr>
					<tr>
						<td>성별</td>
						<td>
							<div class="radio_box">
								<input type="radio" id="pw_man" name="search_sex2" value="M"/><label for="pw_man"></label><span class="color_666">남자</span>
								<input type="radio" id="pw_girl" name="search_sex2" value="F"/><label for="pw_girl"></label><span class="color_666">여자</span>
							</div>
						</td>
					</tr>
					<tr>
						<td class="ver_top"><p class="margin_top_12">회신방법</p></td>
						<td>
							<div class="radio_box margin_top_14">
								<input type="radio" id="phone" name="search_receive" value="1" checked onclick="recv_way(1);"/><label for="phone"></label><span class="color_666">휴대폰으로 받기</span>
								<input type="radio" id="email" name="search_receive" value="2" onclick="recv_way(2);"/><label for="email"></label><span class="color_666">이메일로 받기</span>
							</div>

							<div class="select_box_ccc_border margin_top_10 margin_bottom_10" id="pwd_1_display">
								<select class="width_62 height_20" id="search_hp1" name="search_hp1">
									<option value="010">010</option>
									<option value="011">011</option>
									<option value="016">016</option>
									<option value="017">017</option>
									<option value="018">018</option>
									<option value="019">019</option>
								</select>
								-
								<input type="text" class="width_82 height_20" id="search_hp2" name="search_hp2" value=""/>
								-
								<input type="text" class="width_82 height_20" id="search_hp3" name="search_hp3" value=""/>
							</div>

							<div class="select_box_ccc_border margin_top_10 margin_bottom_10" id="pwd_2_display" style="display:none;">
								<input type="text" class="width_82 height_20" id="email_id"/>
								@
								<input type="text" class="width_120 height_20" id="email_after">
								<select class="width_120 height_22" id="email_selecter" onChange="javascript:email_cha();">
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
						<td colspan="2" style="background:#fff;border-bottom:none;">
							<div class="margin_top_20 text-center padding_bottom_30" id="confirm_pw">
								<input type="button" class="text_btn_de4949 width_98 height_30" value="비밀번호 확인" onclick="javascript:search_pwd();"/>
							</div>
						</td>
					</tr>
				</table>
				<!-- 비밀번호 찾기 -->
			</div>