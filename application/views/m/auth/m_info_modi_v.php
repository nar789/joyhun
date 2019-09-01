<div class="iphone_padding">

	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;기본프로필&nbsp;</p></div>
		<div class="clear"></div>
	</div>

	<div class="bg_fefefe">

	<div class="m_profile_table_area padding_top_10 padding_bottom_10">
		<table class="mobile_border_table">
			<tr>
				<td class="profile_td">아이디</td>
				<td>
					<div class="width_95per margin_auto"><?=$mdata['m_userid']?></div>
				</td>
			</tr>
			<tr>
				<td class="ver_top padding_top_10">비밀번호</td>
				<td class="ver_top padding_top_5">
					<div class="width_95per margin_auto">
						<div class="m_join_pwd">
							<input type="password" class="m_join_text" id="m_pwd" name="m_pwd" value="" maxlength="12">
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
							<input type="password" class="m_join_text" id="m_pwd_chk" name="m_pwd_chk" value="" maxlength="12">
						</div>
					</div>
					<p class="width_95per margin_auto color_999 padding_0500"></p>
				</td>
			</tr-->
			<tr>
				<td>닉네임</td>
				<td>
					<div class="width_95per margin_auto">
						<div class="m_join_id">
							<input type="text" class="m_join_text" id="m_nick" name="m_nick" value="<?=$mdata['m_nick']?>" maxlength="6">
						</div>
						<div class="width_30per float_right">
							<input type="button" class="m_fbfbfb_btn" id="nick_chk" name="nick_chk" value="중복확인" nick_chk="" onclick="javascript:m_nick_check();">
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
							<select class="border_none height_28 width_100per border_0 text_5 color_666" name="m_age" id="m_age">
								<? for($i=20; $i<70; $i++){?>
								<option value="<?=$i?>" <? if($mdata['m_age'] == $i){?> selected="selected"<?}?>><?=$i?></option>
								<? } ?>
							</select>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="profile_td">이름</td>
				<td>
					<div class="width_95per margin_auto"><?=$mdata['m_name']?></div>
				</td>
			</tr>
			<tr>
				<td class="ver_top padding_top_10">이메일</td>
				<td class="ver_top padding_top_5 padding_bottom_5">
					<div class="width_95per margin_auto m_join_email">
						<div>
							<input type="text" class="m_join_text" id="m_mail1" name="m_mail1" value="<?=@$m_mail1?>">
						</div>
						<div>
							@ 
						</div>
						<div>
							<input type="text" class="m_join_text" id="m_mail2" name="m_mail2" value="<?=@$m_mail2?>">
						</div>
						<div class="clear"></div>
					</div>
					<div class="height_10"></div>
					<div class="width_95per margin_auto mobile_select">
						<select class="border_none height_28 width_100per border_0 text_5 color_666" id="select_email">
							<option value="">선택하세요</option>
							<option value="naver.com" <? if(@$m_mail2 == "naver.com"){ echo "selected"; } ?>>naver.com</option>
							<option value="hanmail.net" <? if(@$m_mail2 == "hanmail.net"){ echo "selected"; } ?>>hanmail.net</option>
							<option value="nate.com" <? if(@$m_mail2 == "nate.com"){ echo "selected"; } ?>>nate.com</option>
							<option value="gmail.com" <? if(@$m_mail2 == "gmail.com"){ echo "selected"; } ?>>gmail.com</option>
							<option value="daum.net" <? if(@$m_mail2 == "daum.net"){ echo "selected"; } ?>>daum.net</option>
							<option value="korea.com" <? if(@$m_mail2 == "korea.com"){ echo "selected"; } ?>>korea.com</option>
							<option value="chollian.net" <? if(@$m_mail2 == "chollian.com"){ echo "selected"; } ?>>chollian.net</option>
							<option value="dreamwiz.com" <? if(@$m_mail2 == "dreamwiz.com"){ echo "selected"; } ?>>dreamwiz.com</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td class="profile_td">이메일수신</td>
				<td>
					<div class="width_95per margin_auto">
						<input type="radio" class="m_radiobox" id="email_agr_1" name="email_agree" value="Y" <? if($mdata['m_mail_yn'] == "Y"){ echo "checked"; } ?>><label for="email_agr_1" class="color_666 margin_right_15">&nbsp;&nbsp;수신동의</label>
						<input type="radio" class="m_radiobox" id="email_agr_2" name="email_agree" value="N" <? if($mdata['m_mail_yn'] == "N"){ echo "checked"; } ?>><label for="email_agr_2" class="color_666">&nbsp;&nbsp;수신거부</label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="ver_top padding_top_10">휴대전화</td>		<!-- 휴대전화는 인증으로 업데이트 -->
				<td class="ver_top padding_top_10">
					<div class="width_95per margin_auto">
						<div class="width_25per float_left border_1_cccccc mobile_select">
							<select class="border_none height_26 width_100per border_0 text_5 color_666" id="m_hp1" name="m_hp1">
								<option value="">- 선택 -</option>
								<option value="010" <? if(@$mdata['m_hp1'] == "010"){ echo "selected"; } ?>>010</option>
								<option value="011" <? if(@$mdata['m_hp1'] == "011"){ echo "selected"; } ?>>011</option>
								<option value="016" <? if(@$mdata['m_hp1'] == "016"){ echo "selected"; } ?>>016</option>
								<option value="017" <? if(@$mdata['m_hp1'] == "017"){ echo "selected"; } ?>>017</option>
								<option value="018" <? if(@$mdata['m_hp1'] == "018"){ echo "selected"; } ?>>018</option>
								<option value="019" <? if(@$mdata['m_hp1'] == "019"){ echo "selected"; } ?>>019</option>
							</select>
						</div>
						<div class="width_5per float_left line-height_29 text-center">-</div>
						<div class="width_30per float_left border_1_cccccc">
							<input type="tel" class="m_join_text" id="m_hp2" name="m_hp2" value="<?=@$mdata['m_hp2']?>" readonly>
						</div>
						<div class="width_5per float_left line-height_29 text-center">-</div>
						<div class="width_30per float_left border_1_cccccc">
							<input type="tel" class="m_join_text" id="m_hp3" name="m_hp3" value="<?=@$mdata['m_hp3']?>" readonly>
						</div>
						<div class="clear"></div>
					</div>
					<div class="margin_top_5">
						<p class="width_95per margin_auto color_666 padding_0500 font-size_14">휴대폰인증받고 다양한 혜택을 누려보세요.</p>
					</div>
					<div class="width_95per margin_left_3per margin_bottom_5per">
						<input type="button" class="m_certification_btn" id="nick_chk" name="nick_chk" value="휴대폰 인증 받기" onclick="javascript:name_check();">
						<!--input type="button" class="m_certification_btn" id="nick_chk" name="nick_chk" value="휴대폰 인증 받기" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata('m_userid')?>');"-->
					</div>
				</td>
			</tr>
			<tr>
				<td class="profile_td">SMS수신</td>
				<td>
					<div class="width_95per margin_auto">
						<input type="radio" class="m_radiobox" id="sms_agr_1" name="sms_agree" value="1" <? if($mdata['m_hp_sms'] == "1"){ echo "checked"; } ?>><label for="sms_agr_1" class="color_666 margin_right_15">&nbsp;&nbsp;수신동의</label>
						<input type="radio" class="m_radiobox" id="sms_agr_2" name="sms_agree" value="0" <? if($mdata['m_hp_sms'] == "0"){ echo "checked"; } ?>><label for="sms_agr_2" class="color_666">&nbsp;&nbsp;수신거부</label>
					</div>
				</td>
			</tr>
			<tr>
				<td>지역</td>
				<td>
					<div class="width_95per margin_auto">
						<div class="width_30per float_left border_1_cccccc mobile_select">
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
								<option>세부 지역</option>
							</select>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>

	</div>

	<div class="text-center padding_bottom_20">
		<input type="button" class="m_d53b3b_btn border-radius_2 margin_top_10 width_30per height_40" value="수정하기" onclick="javascript:member_modify();">
	</div>

</div>