<div class="bg_fff">

	<img src="<?=IMG_DIR?>/m/m_dormancy_top.gif" class="border_bottom_1_333 width_100per">


	<div class="width_100per border_bottom_1_d1d1d1">
		<table class="dor_info">
			<tr>
				<td class="text-center width_20per"><img src="<?=IMG_DIR?>/m/m_d_new_1.gif"></td>
				<td>
					<p class="color_333">인기아이템 무료화! 유료아이템 대폭 축소!</p>
					<p class="color_999">각종 유료아이템들을 <span class="color_eb5300">무료로 전환하였습니다.</span></p>
				</td>
			</tr>
		</table>
	</div>

	<div class="width_100per border_bottom_1_d1d1d1">
		<table class="dor_info">
			<tr>
				<td class="text-center width_20per"><img src="<?=IMG_DIR?>/m/m_d_new_2.gif"></td>
				<td>
					<p class="color_333">더 쉽고 즐겁게 채팅을 즐겨보세요!</p>
					<p class="color_999">간편해진 시스템으로 <span class="color_eb5300">즐거운 미팅/채팅</span>을 즐겨보세요.</p>
				</td>
			</tr>
		</table>
	</div>

	<div class="width_100per border_bottom_1_d1d1d1">
		<table class="dor_info">
			<tr>
				<td class="text-center width_20per"><img src="<?=IMG_DIR?>/m/m_d_new_3.gif"></td>
				<td>
					<p class="color_333">각종 엑티브엑스 설치가 사라졌어요.</p>
					<p class="color_999">귀찮고 느려지게 하는 <span class="color_eb5300">엑티브엑스를 싹 없앴습니다!</span></p>
				</td>
			</tr>
		</table>
	</div>



	<!-- 회원존재여부용 -->
	<input type="hidden" value="<?=$this->session->userdata['user']?>" id="user">
	<!-- 인증여부용 -->
	<input type="hidden" value="" id="dor_chk">


	<div class="agree_box">

		<div class="width_95per agree_area">
			<table class="width_95per margin_auto">
				<tr>
					<td>
						<input type="checkbox" class="m_checkbox" id="m_agree_1"><label for="m_agree_1" class="color_333">이용약관에 동의합니다.</label>
					</td>
					<td onclick="location.href='/etc/privacy_policy/policy_list_mobile/gubn/1'">자세히보기</td>
				</tr>
			</table>
		</div>

		<div class="width_95per agree_area">
			<table class="width_95per margin_auto">
				<tr>
					<td>
						<input type="checkbox" class="m_checkbox" id="m_agree_2"><label for="m_agree_2" class="color_333">개인정보 취급방침에 동의합니다.</label>
					</td>
					<td onclick="location.href='/etc/privacy_policy/policy_list_mobile/gubn/2'">자세히보기</td>
				</tr>
			</table>
		</div>
	</div>

	<table class="mobile_border_table">
		<tr>
			<td>이름</td>
			<td>
				<input type="text" class="dorm_name" id="user_name">
			</td>
		</tr>
		<tr>
			<td>생년월일</td>
			<td>
				<div class="width_35per mobile_select block dorm_bir">
					<select class="border_none width_90per border_0 text_5 color_666 dorm_bir" id="bir_1">
						<option value="">년</option>
						<? for($i=date('Y'); $i>=1930; $i--){ ?>
						<option value="<?=$i?>"><?=$i?>년</option>
						<? } ?>
					</select>
				</div>
				<div class="width_25per mobile_select block dorm_bir">
					<select class="border_none width_90per border_0 text_5 color_666 dorm_bir" id="bir_2">
						<option value="">월</option>
						<option value="01">1월</option>
						<option value="02">2월</option>
						<option value="03">3월</option>
						<option value="04">4월</option>
						<option value="05">5월</option>
						<option value="06">6월</option>
						<option value="07">7월</option>
						<option value="08">8월</option>
						<option value="09">9월</option>
						<option value="10">10월</option>
						<option value="11">11월</option>
						<option value="12">12월</option>
					</select>
				</div>
				<div class="width_25per mobile_select block dorm_bir">
					<select class="border_none width_90per border_0 text_5 color_666 dorm_bir" id="bir_3">
						<option value="">일</option>
						<option value="01">1일</option>
						<option value="02">2일</option>
						<option value="03">3일</option>
						<option value="04">4일</option>
						<option value="05">5일</option>
						<option value="06">6일</option>
						<option value="07">7일</option>
						<option value="08">8일</option>
						<option value="09">9일</option>
						<option value="10">10일</option>
						<option value="11">11일</option>
						<option value="12">12일</option>
						<option value="13">13일</option>
						<option value="14">14일</option>
						<option value="15">15일</option>
						<option value="16">16일</option>
						<option value="17">17일</option>
						<option value="18">18일</option>
						<option value="19">19일</option>
						<option value="20">20일</option>
						<option value="21">21일</option>
						<option value="22">22일</option>
						<option value="23">23일</option>
						<option value="24">24일</option>
						<option value="25">25일</option>
						<option value="26">26일</option>
						<option value="27">27일</option>
						<option value="28">28일</option>
						<option value="29">29일</option>
						<option value="30">30일</option>
						<option value="31">31일</option>
					</select>
				</div>
			</td>
		</tr>
	</table>

	<div class="mb_check_area">
		<input type="button" class="width_30per" value="확인" onclick="checked_user();">
	</div>



	<div id="dormancy_show" style="display:none;">
		<table class="mobile_border_table">
			<tr>
				<td>인증방법</td>
				<td>
					<div class="width_95per mobile_select block">
						<select class="border_none height_28 width_95per border_0 text_5 color_666" id="dorm_cate">
							<option value="">인증방법을 선택해주세요.</option>
							<option value="email">이메일 인증</option>
							<option value="join_phone">가입시 등록한 휴대폰</option>
							<option value="my_phone">본인명의 휴대폰</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>새 비밀번호</td>
				<td>
					<input type="password" id="new_pwd">
				</td>
			</tr>
			<tr>
				<td>비밀번호 확인</td>
				<td>
					<input type="password" id="new_pwd2">
				</td>
			</tr>
		</table>

		<div class="mb_check_area">
			<input type="button" class="start_joy" value="시작하기" onclick="my_cert_fin();">
		</div>
	</div>


</div>