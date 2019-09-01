
<div class="content">

	<div class="dormancy_top">
		<div><b class="font-size_30">새로운 조이헌팅</b>에 오신것을 환영합니다.<br><span>다양한 혜택</span>이 늘어났습니다.</div>

		<p>고객님의 개인정보 보호를 위해, 비밀번호 변경과 회원가입 약관에 동의해주세요.</p>
	</div>


	<div class="dormancy_box">
		<div class="float_left">
			<img src="<?=IMG_DIR?>/member/d_new_1.gif">
		</div>
		<div class="float_right">
			<p>인기아이템 무료화! 유료아이템 대폭 축소!</p>
			<p>회원님들의 이익을 위해 각종 유료아이템들을 <span>무료로 전환하였습니다.</span></p>
		</div>
	</div>
	<div class="clear"></div>
	<div class="dormancy_box">
		<div class="float_left">
			<img src="<?=IMG_DIR?>/member/d_new_2.gif">
		</div>
		<div class="float_right">
			<p>더 쉽고 즐겁게 채팅을 즐겨보세요!</p>
			<p>간편해진 시스템과 알림을 통해 <span>즐거운 미팅/채팅을 즐겨보세요!</span></p>
		</div>
	</div>
	<div class="clear"></div>
	<div class="dormancy_box">
		<div class="float_left">
			<img src="<?=IMG_DIR?>/member/d_new_3.gif">
		</div>
		<div class="float_right">
			<p>각종 엑티브엑스 설치가 사라졌어요.</p>
			<p>회원님을 귀찮게 하고 느려지는 <span>엑티브엑스를 싹 없앴습니다!</span></p>
		</div>
	</div>


	<div id="detail_box">

		<div class="float_left">
			<input type="checkbox" id="agree_1" class="margin_left_10" value="Y">
			<label for="agree_1" class="common_checkbox_label margin_left_10"></label>
			<span class="color_333 font-size_14">이용약관에 동의합니다.</span>
		</div>
		<div class="float_right">
			<a><span id="show_detail_1">자세히보기</span></a>
		</div>

		<div class="clear"></div>

		<div id="detail_1">

			<textarea><?=@$agree1?></textarea>
		</div>
	</div>


	<div id="detail_box2" class="margin_top_10">

		<div class="float_left">
			<input type="checkbox" id="agree_2" class="margin_left_10" value="Y">
			<label for="agree_2" class="common_checkbox_label margin_left_10"></label>
			<span class="color_333 font-size_14">개인정보의 수집 및 이용에 동의합니다.</span>
		</div>
		<div class="float_right">
			<a><span id="show_detail_2">자세히보기</span></a>
		</div>

		<div class="clear"><div>

		<div id="detail_2">

			<textarea><?=@$agree2?><br><?=@$agree3?><br><?=@$agree4?></textarea>
		
		</div>

	</div>

	<!-- 회원존재여부용 -->
	<input type="hidden" value="<?=$this->session->userdata['user']?>" id="user">
	<!-- 인증여부용 -->
	<input type="hidden" value="" id="dor_chk">

	<div class="dor_info_box">
		<div class="margin_top_26">
			<p class="font-size_16 width_166 block">이름</p>
			<input type="text" class="dor_mb_input border_bottom_1_f36523" id="user_name" name="user_name" placeholder="이름">
		</div>
		<div class="margin_top_26 select_box">
			<p class="font-size_16 width_166 block">생년월일</p>
			<select class="width_127 dor_mb_select" id="bir_1" name="bir_1">
				<option value="">년</option>
				<? for($i=date('Y'); $i>=1930; $i--){ ?>
				<option value="<?=$i?>"><?=$i?>년</option>
				<? } ?>
			</select>

			<select class="width_79 margin_left_8 dor_mb_select" id="bir_2" name="bir_2">
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

			<select class="width_79 margin_left_8 dor_mb_select" id="bir_3" name="bir_3">
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

			<input type="button" class="text_btn_f36523 margin_left_12" value="확인" onclick="checked_user();">
		</div>
		<div class="start_dormancy" style="display:none">

			<div class="margin_top_26">
				<p class="font-size_16 width_166 block">인증방법</p>
				<div type="button" class="text_btn2_d2d2d2 dor_mb_btn width_127" onclick="javascript:my_email_request();">
					<img src="<?=IMG_DIR?>/member/d_ic_1.gif">이메일
				</div>
				<div type="button" class="text_btn2_d2d2d2 dor_mb_btn width_215" onclick="javascript:my_join_phone_request();">
					<img src="<?=IMG_DIR?>/member/d_ic_2.gif">가입시 등록한 휴대폰
				</div>
				<div type="button" class="text_btn2_d2d2d2 dor_mb_btn width_185" onclick="javascript:my_phone_request();">
					<img src="<?=IMG_DIR?>/member/d_ic_3.gif">본인명의 휴대폰
				</div>
			</div>


			<div class="margin_top_26">
				<p class="font-size_16 width_166 block">새로운 비밀번호</p>
				<input type="password" class="dor_mb_input border_bottom_1_dcdcdc" id="new_pwd" name="new_pwd" placeholder="비밀번호 입력">
			</div>
			<div class="margin_top_26">
				<p class="font-size_16 width_166 block">비밀번호 확인</p>
				<input type="password" class="dor_mb_input border_bottom_1_dcdcdc" id="new_pwd2" name="new_pwd2" placeholder="비밀번호 재입력">
			</div>
		</div>
	</div>

	<div class="margin_top_38 text-center start_dormancy" style="display:none">
		<input type="button" class="start_joy" value="시작하기" onclick="my_cert_fin();">
	</div>


</div>