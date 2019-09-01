<div style="padding:20px;">
	<div id="txt_top_box">
		<div style="color:#666666;  height:20px;">인증이 안되시나요?</div>
		<div style="color:#666666;  height:20px">아래의 양식에 맞추어 정보를 입력해주시면,</div>
		<div style="color:#666666;  height:20px">관리자가 확인후 휴대폰 문자를 통해 연락드리겠습니다.</div>
	</div>
	<div id="reg_auth_1">
		<div style="color:#222; font-size:14px; font-weight:bold; height:40px; line-height:45px;">STEP1. 간편본인확인</div>
		<table class="popup_border_table" id="id_search" style="display: block; margin-top:0px;">
			<tr>
				<td>이름</td>
				<td class="width_366">
					<input type="text" class="width_127 height_20" id="regi_user_name" name="regi_user_name" value="">
				</td>
			</tr>
			<tr>
				<td>생년월일</td>
				<td>
					<div class="select_box_ccc_border margin_top_8">
						<select class="width_65 height_20" id="regi_birth_year" name="regi_birth_year">
							<option value=""> 년도 </option>
							<? for($i=(date("Y")-19); $i>=1950; $i--){ ?>
							<option value="<?=$i?>"><?=$i?>년</option>
							<? } ?>
						</select>
						<select class="width_55 height_20" id="regi_birth_month" name="regi_birth_month">
							<option value="">월</option>
							<? for($i=1; $i<=12; $i++){ ?>
							<option value="<?=$i?>"><?=$i?>월</option>
							<? } ?>
						</select>
						<select class="width_55 height_20" id="regi_birth_day" name="regi_birth_day">
							<option value="">일</option>
							<? for($i=1; $i<=31; $i++){ ?>
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
						<input type="radio" id="sex_1" name="regi_sex" value="M" checked><label for="sex_1"></label><span class="color_666">남자</span>
						<input type="radio" id="sex_2" name="regi_sex" value="F"><label for="sex_2"></label><span class="color_666">여자</span>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="background:#fff;border-bottom:none;">
					<div class="margin_top_20 text-center padding_bottom_30" style="display:block;">
						<input type="button" class="text_btn_de4949 width_60 height_30" value="다음" onclick="javascript:register_name_check();">
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div id="reg_auth_2">
		<div style="color:#222; font-size:14px; font-weight:bold; height:40px; line-height:45px;">STEP2. 휴대폰정보 입력</div>
		<table class="popup_border_table" id="id_search" style="display: block; margin-top:0px;">
			<tr>
				<td>통신사</td>
				<td class="width_366">
					<div class="select_box_ccc_border">
						<select class="width_90 height_20" id="commid" name="commid">
							<option value=""> 선택 </option>
							<option value="SKT">SKT</option>
							<option value="KT">KT</option>
							<option value="LGU">LG U+</option>	
							<option value="ETC">알뜰폰</option>
						</select>	
					</div>
				</td>
			</tr>
			<tr>
				<td>휴대폰번호</td>
				<td>
					<div class="select_box_ccc_border margin_top_10 margin_bottom_10" id="pwd_1_display">
						<select class="width_62 height_20" id="hp1" name="hp1">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
						</select>
						-
						<input type="text" class="width_21per height_20" id="hp2" name="hp2" value="" maxlength="4">
						-
						<input type="text" class="width_21per height_20" id="hp3" name="hp3" value="" maxlength="4">
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="background:#fff;border-bottom:none;">
					<div class="margin_top_20 text-center padding_bottom_30" style="display:block;">
						<input type="button" class="text_btn_de4949 width_110 height_30" value="인증번호 받기" onclick="javascript:reg_rand_num_send();">
					</div>
				</td>
			</tr>
		</table>
		<table class="popup_border_table" style="display: block; margin-top:0px;">
			<tr>
				
				<td>인증번호</td>
				<td class="width_366">
					<input type="text" class="width_127 height_20" id="rand_num" name="rand_num" value="" maxlength="6">
				</td>
			</tr>
		</table>
		<textarea class="top_textarea border_1_cccccc width_98per margin_top_20 margin_left_0" style="padding-left:2%; "id="t_context" placeholder="기타 문의내용을 남겨주세요"></textarea>
		<div class="margin_top_20 text-center padding_bottom_30" style="display:block;">
			<input type="button" class="text_btn_de4949 width_60 height_30" value="완료" onclick="javascript:reg_rand_num_chk();">
		</div>
	</div>

	<div id="reg_auth_3">
		<table class="" id="id_search" style="display: block; margin-top:0px; width:100%;">
			<tr>
				<td style="width:440px; height:80px;text-align:center; background:#f5f5f5; border-radius:4px; line-height:22px;">
					<div style="font-weight:bold;">요청 완료되었습니다.</div>
					<div style="color:#666;">관리자가 확인후 휴대폰 문자를 통해 연락드리겠습니다.</div>
				</td>
			</tr>
		</table>
		<div class="margin_top_20 text-center padding_bottom_30" style="display: block;">
			<input type="button" class="text_btn_de4949 width_60 height_30" value="닫기" onclick="javascript:reg_member_layer_close();">
		</div>
	</div>

</div>


<style>
.popup_border_table td:first-child,
.popup_border_table td:nth-child(3) {
	width:30%;
}
</style>