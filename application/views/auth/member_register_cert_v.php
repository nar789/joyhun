<div class="content">

	<div class="register_box1">
		<div class="register_title">간편 본인 인증</div>
		<div class="register_area1">
			<div class="regi_tab_box">
				<!--div class="regi_tab_1 regi1_off">
					<img src="<?=IMG_DIR?>/member/regi_2_1_on.png" align="absmiddle">간편확인	
				</div-->
				<div class="regi_tab_2 regi2_on">
					<img src="<?=IMG_DIR?>/member/regi_2_2_off.png" align="absmiddle">휴대폰 인증
				</div>
				<div class="clear"></div>
			</div>

			<!--div class="regi2_content">
				<div class="regi2_box">
					<div class="regi2_title">
						<b>간편확인이란?</b>
						<p>이름, 생년월일, 성별만 기입하여 본인임을 확인하는 서비스입니다. </p>
					</div>
					<div class="regi2_tr">
						<div class="regi2_td">
							<img src="<?=IMG_DIR?>/member/check_ic.gif">이름
						</div>
						<div class="inline">
							<input type="text" class="regi2_textbox" name="regi_user_name" id="regi_user_name" maxlength="10">
						</div>
					</div>
					<div class="regi2_tr">
						<div class="regi2_td">
							<img src="<?=IMG_DIR?>/member/check_ic.gif">생년월일
						</div>
						<div class="inline">
							<div class="regi_sel_1">
								<select name="regi_birth_year" id="regi_birth_year">
									<option value="">생년</option>
									<? for($i = (date("Y") - 19);$i > 1900;$i--){?>
									<option value="<?=$i?>"><?=$i?></option>
									<?}?>
								</select>
							</div>
							<div class="regi_sel_2">
								<select name="regi_birth_month" id="regi_birth_month">
									<option value="">월</option>
									<option value="01">1</option>
									<option value="02">2</option>
									<option value="03">3</option>
									<option value="04">4</option>
									<option value="05">5</option>
									<option value="06">6</option>
									<option value="07">7</option>
									<option value="08">8</option>
									<option value="09">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
							</div>
							<div class="regi_sel_2">
								<select name="regi_birth_day" id="regi_birth_day">
									<option value="">일</option>
									<option value="01">1</option>
									<option value="02">2</option>
									<option value="03">3</option>
									<option value="04">4</option>
									<option value="05">5</option>
									<option value="06">6</option>
									<option value="07">7</option>
									<option value="08">8</option>
									<option value="09">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
								</select>
							</div>
						</div>
					</div>
					<div class="regi2_tr2">
						<div class="regi2_td">
							<img src="<?=IMG_DIR?>/member/check_ic.gif">성별
						</div>
						<div class="regi2_radiobox">
							<input type="radio" value="M" name="regi_sex" id="regi_sex_M" checked>남
							<input type="radio" value="F" name="regi_sex" id="regi_sex_F" class="margin_left_7">여
						</div>
					</div>
					<div class="regi2_subbtn1">
						<input type="button" value="확인하고 들어가기" id="submit_btn_1">
					</div>
				</div>
			</div-->
			<div class="regi2_content">
				<div class="regi2_box">
					<div class="regi2_title">
						<b>휴대폰 인증이란?</b>
						<p>기존 실명인증에서 사용된 휴대폰인증으로 본인임을 확인하는 서비스입니다.</p>
					</div>
					<div class="regi2_subbtn2">
						<input type="button" value="확인하고 들어가기" class="regi2_btn" id="submit_btn_2" onclick="javascript:name_check();">
						<!--input type="button" value="확인하고 들어가기" id="submit_btn_2" onclick="javascript:reg_phone_chk('1', '<?=$this->session->userdata('regi_id')?>');"-->
					</div>

					<div class="regi3_title" style="padding-top:29px; border:none;">
						<b>인증이 안되시나요?</b>
						<p>관리자가 정보를 확인후 연락드리겠습니다.</p>
					</div>
					<div class="regi2_subbtn2" style="border:none;">
						<a href="javascript:reg_member_auth_layer_pop();"><input type="button" value="관리자에게 인증요청하기" class="regi3_btn"></a>
						<!--a href="javascript:manager_request();"><input type="button" value="관리자에게 인증요청하기" class="regi3_btn"></a-->
					</div>

				</div>
			</div>
			
		</div>
		<div style="display:inline-block; font-weight:bold; padding-top:30px; padding-left:27px; padding-right:5px;">기타 문의사항은 일대일 문의하기에 남겨주시면 답변해드리겠습니다.</div>
		<div style="cursor: pointer; padding:10px; border:1px solid #333; width:100px; text-align:center; display:inline-block;"onclick="javascript:qna_add();">일대일 문의하기</div>
	</div>		<!-- ##	register_box end ## -->
	

	<div class="regi_right_area">
		<img src="<?=IMG_DIR?>/member/register_top.jpg" class="margin_bottom_6">
		<img src="<?=IMG_DIR?>/member/register_bottom.jpg">
	</div>		<!-- ## regi_right_area end ## -->

</div>