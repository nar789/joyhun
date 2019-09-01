<div class="iphone_padding">

	<img src="<?=IMG_DIR?>/m/day_banner/day_<?=date('w')?>.jpg" class="width_100per">

	<form id="m_register_form" name="m_register_form" method="post" accept-charset="utf-8">

	<input type="hidden" id="regi_sex" name="regi_sex" value="">

	<div class="bg_fefefe padding_top_15 padding_bottom_13">
		
		<div class="width_95per margin_auto">
			<table class="mobile_border_table width_100per margin_top_20 ">
				<tr>
					<td>성별</td>
					<td>
						<div class="width_95per margin_auto">
							<input type="radio" class="m_radiobox" id="m_sex_1" name="m_sex" value="M" checked><label for="m_sex_1" class="color_666">&nbsp;&nbsp;남성</label>
							<input type="radio" class="m_radiobox" id="m_sex_2" name="m_sex" value="F"><label for="m_sex_2" class="color_666 margin_left_40">&nbsp;&nbsp;여성</label>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="width_95per margin_auto">
			<table class="mobile_border_table width_100per margin_top_20 ">
				<tr>
					<td>원하는 만남</td>
					<td>
						<div class="width_95per margin_auto mobile_select">
							<select id="m_reason" name="m_reason" class="border_none height_28 width_95per border_0 text_5 color_666">
								<option value="">선택하세요.</option>
								<? for($i=1; $i<=15; $i++){ ?>
								<option value="<?=$i?>"><?=want_reason_data($i)?></option>
								<? } ?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>대화스타일</td>
					<td>
						<div class="width_95per margin_auto mobile_select">
							<select id="m_talk_style" name="m_talk_style" class="border_none height_28 width_95per border_0 text_5 color_666">
								<option value="">선택하세요.</option>	
								<? for($i=1; $i<=15; $i++){ ?>
								<option value="<?=$i?>"><?=talk_style_data($i)?></option>
								<? } ?>
							</select>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="width_95per margin_auto">
			<table class="mobile_border_table width_100per margin_top_20">
				<tr>
					<td>아이디</td>
					<td>
						<div class="width_95per margin_auto">
							<div class="m_join_id">
								<input type="text" class="m_join_text" id="regi_id" name="regi_id" value="" maxlength="12" onkeyup="javascript:upper(event,this);">
							</div>
							<div class="width_30per float_right">
								<input type="button" class="m_fbfbfb_btn" value="중복확인" id="id_chk" id_chk="" onclick="javascript:m_id_check();">
							</div>
							<div class="clear"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="ver_top padding_top_10">비밀번호</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<div class="m_join_pwd">
								<input type="password" class="m_join_text" id="regi_pw" name="regi_pw" value="" maxlength="12">
							</div>
						</div>
						<p class="width_95per margin_auto color_999 padding_0500">6~12자의 영문과 숫자만 가능합니다.</p>
					</td>
				</tr>
				<!--tr>
					<td class="ver_top padding_top_10">비밀번호확인</td>
					<td class="ver_top padding_top_5">
						<div class="width_95per margin_auto">
							<div class="m_join_pwd">
								<input type="password" class="m_join_text" id="regi_pw_chk" name="regi_pw_chk" value="" maxlength="12">
							</div>
						</div>
						<p id="pw_chk" class="width_95per margin_auto color_999 padding_0500"></p>
					</td>
				</tr-->
				<tr>
					<td>닉네임</td>
					<td>
						<div class="width_95per margin_auto">
							<div class="m_join_id">
								<input type="text" class="m_join_text" id="regi_nick" name="regi_nick" value="" maxlength="6">
							</div>
							<div class="width_30per float_right">
								<input type="button" class="m_fbfbfb_btn" value="중복확인" id="nick_chk" nick_chk="" onclick="javascript:m_nick_check();">
							</div>
							<div class="clear"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>나이</td>
					<td>
						<div class="width_95per margin_auto">
							<div class="width_30per mobile_select float_left">
								<select class="border_none height_28 width_100per border_0 text_5 color_666" name="regi_age" id="regi_age">
									<option value="" selected="selected">- 선택 -</option>
									<? for($i=20; $i<70; $i++){?>
									<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
								</select>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>이메일</td>
					<td>
						<div class="width_95per margin_auto m_join_email">
							<div>
								<input type="text" class="m_join_text" id="regi_email_1" name="regi_email_1" value="">
							</div>
							<div>
								@
							</div>
							<div>
								<input type="text" class="m_join_text" id="regi_email_2" name="regi_email_2" value="" style="background: #fff url(<?=IMG_DIR?>/arrow_btn.gif) no-repeat 95% 50%;">
								<div id="sub_email">
									<ul>
										<li>직접입력</li>
										<li>naver.com</li>
										<li>hanmail.net</li>
										<li>nate.com</li>
										<li>gmail.com</li>
										<li>daum.net</li>
										<li>korea.com</li>
									</ul>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>만남지역</td>
					<td>
						<div class="width_95per margin_auto">
							<div class="width_30per mobile_select float_left">
								<select class="border_none height_28 width_100per border_0 text_5 color_666" name="regi_area_1" id="regi_area_1" onchange="area_select(this.value,'regi_area_2');">
									<option value="">지역</option> 
									<option value="서울">서울</option> 
									<option value="인천">인천</option> 
									<option value="부산">부산</option> 
									<option value="대구">대구</option> 
									<option value="대전">대전</option> 
									<option value="광주">광주</option> 
									<option value="울산">울산</option> 
									<option value="경기">경기</option> 
									<option value="강원">강원</option> 
									<option value="세종">세종</option> 
									<option value="충남">충남</option> 
									<option value="충북">충북</option> 
									<option value="경남">경남</option> 
									<option value="경북">경북</option> 
									<option value="전남">전남</option> 
									<option value="전북">전북</option> 
									<option value="제주">제주</option> 
								</select>
							</div>
							<div class="width_35per mobile_select float_left margin_left_9">
								<select class="border_none height_28 width_100per border_0 text_5 color_666" name="regi_area_2" id="regi_area_2">
									<option>세부지역</option>
								</select>
							</div>
							<div class="clear"></div>
							<div class="padding_top_10 padding_bottom_5 color_ea3c3c blod">* 정확한 지역은 채팅성공 확률이 높습니다.<div>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="margin_top_20">
			<div class="width_95per margin_auto">
				<div class="m_join_all_agree">
					<input type="checkbox" class="m_checkbox" id="agree_1"><label for="agree_1" class="color_666 margin_right_20">&nbsp;이용약관에 동의합니다. <a href="/etc/privacy_policy/policy_list_mobile/gubn/1" class="color_666">[약관보기]</a></label>
				</div>
			</div>

			<div class="width_95per margin_auto">
				<div class="m_join_all_agree">
					<input type="checkbox" class="m_checkbox" id="agree_2"><label for="agree_2" class="color_666 margin_right_20">&nbsp;개인정보취급방침에 동의합니다. <a href="/etc/privacy_policy/policy_list_mobile/gubn/2" class="color_666">[개인정보취급방침]</a></label>
				</div>
			</div>
		</div>

	</div>

	</form>

		<div class="width_95per margin_auto">
			<input type="button" value="회원가입" class="m_d53b3b_btn border-radius_4 margin_top_20 margin_bottom_18 height_36" id="submit_btn" >
		</div>
		
		<div class="width_95per margin_auto" style="text-align:right; padding:10px 5px 30px 5px; background-color:#F6F7F9;">
			<font style="font-size:1.2em; color:#989898; cursor:pointer; border-bottom:solid 1px #989898; padding-bottom:2px;" onclick="javascript:complain_request('1');">회원가입이 잘 안되시나요?</font>
		</div>

</div>