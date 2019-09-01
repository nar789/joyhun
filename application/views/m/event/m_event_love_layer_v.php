<div class="padding_15">
	<div id="step1" style="display:block;">
		<div class="width_100per height_20">
			<div style="width:1%; height:15px; background:#ea3c3c; display:inline-block;"></div>
			<div style="display:inline-block; font-size:14px; vertical-align:top; color:#333; margin-top:-1px; font-weight:bold;">내 프로필에 사진이 한개 이상 필요합니다.</div>
		</div>
		<div class="width_100per padding_bottom_5per bg_f4f5f7 text-center">
			<div class="color_666 padding_bottom_2per blod" style="padding-top: 4.5%;">등록된 사진 : <?=$pic_cnt?>개</div>
			<div class="width_43per text-center margin_auto color_e15148 border_1_e15148 padding_2per blod bg_fff pointer" onclick="javascript:location.href='/profile/main/user';"> 내 프로필사진 관리</div>
		</div>

		<div id="">
			<div class="width_100per height_40 line-height_50">
				<div class="width_1per height_15 bg_ea3c3c block ver_text"></div>
				<div class="font-size_14 blod  block ver_top">정보를 정확하게 확인 및 수정해주세요.</div>
			</div>
			<table class="popup_border_table" style="margin-top:0px;">
				<tr>
					<td>나이</td>
					<td class="width_366">
						<input type="hidden" id="pic_cnt" name="pic_cnt" value="<?=$pic_cnt?>">
						<input type="text" class="width_20per height_20" id="age" name="age" value="<?=$age?>">
					</td>
				</tr>
				<tr>
					<td>지역</td>
					<td>
						<div class="select_box_ccc_border margin_top_8">
							<select class="width_65 height_20" id="conregion" name="conregion" onchange="area_select(this.value,'conregion2');">
								<option value="">- 선택 -</option> 
								<option value="서울">서울</option> 
								<option value="인천">인천</option> 
								<option value="부산">부산</option> 
								<option value="대구">대구</option> 
								<option value="대전">대전</option> 
								<option value="광주">광주</option> 
								<option value="울산">울산</option> 
								<option value="경기">경기</option> 
								<option value="강원">강원</option> 
								<option value="충남">충남</option> 
								<option value="충북">충북</option> 
								<option value="경남">경남</option> 
								<option value="경북">경북</option> 
								<option value="전남">전남</option> 
								<option value="전북">전북</option> 
								<option value="제주">제주</option> 
							</select>
							<select class="width_85 height_20" id="conregion2" name="conregion2">
								<option value="">- 선택 -</option> 
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>전화번호</td>
					<td>
						<div class="select_box_ccc_border margin_top_10 margin_bottom_10">
							<input type="text" class="width_21per height_20" id="hp1" name="hp1" value="<?=$hp1?>" maxlength="3">
							-
							<input type="text" class="width_21per height_20" id="hp2" name="hp2" value="<?=$hp2?>" maxlength="4">
							-
							<input type="text" class="width_21per height_20" id="hp3" name="hp3" value="<?=$hp3?>" maxlength="4">
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="bg_fff border_none">
						<div class="margin_top_20 text-center padding_bottom_30">
							<input type="button" id="btn_join_1" class="text_btn_de4949 width_50per height_40" value="확인">
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div id="step2" style="display:none;">
		<div style="width_100per height_20">
			<div class="width_1per height_15 bg_ea3c3c block ver_text"></div>
			<div class="font-size_14 blod  block ver_top">이성에게 자기소개를 해보세요.</div>
		</div>
		<textarea class="top_textarea border_1_cccccc width_98per margin_top_20 margin_left_0" style="padding-left:2%; "id="t_context"
		placeholder="저는 서울에서 직장을 다니고 있습니다.평범하지만 화목한가정에서 바르게자란 30살의 처녀입니다.좋은분을 만나서, 행복한 인연을 시작하고 싶어서 신청하게 되었습니다.진실되고 지혜로운분과 만나고싶습니다."><?=$intro?></textarea>	
		<table class="width_100per">
			<tr>
				<td colspan="2" style="background:#fff; border-bottom:none;">
					<div class="margin_top_20 text-center padding_bottom_30">
						<input type="button" id="btn_join_2" class="text_btn_de4949 width_50per height_40" value="신청하기">
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<style>
.top_textarea { 
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	margin-top:5px !important;
	height:80px;
}
.text_btn_de4949 {
	font-size:18px;
}
</style>


<?=@$add_script?>