
<div class="content">
	
	<form name="register_form" method="post" accept-charset="utf-8">

	<div class="register_box1">
		<div class="register_title">무료 회원가입</div>
		<div class="register_area1">
			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>아이디(ID)</span>
				</div>
				<div class="regi_td_2">
					<input type="text" name="regi_id" class="regi_id regi_mode" id="regi_id" maxlength="12" onkeyup="upper(event,this);">
					<input type="button" value="중복확인" class="pointer" id="id_check_btn">
				</div>
				<div class="regi_td_3_999" id="regi_id_text">
					<span class="regi_td_3_999">6~12자의 영문과 숫자 _만 가능합니다.</span>
				</div>
			</div>		<!-- ## regi_hr end ## -->

			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>닉네임</span>
				</div>
				<div class="regi_td_2">
					<input type="text" name="regi_nick" class="regi_id" id="regi_nick" maxlength="6" >
					<input type="button" value="중복확인" class="pointer" id="nick_check_btn">
				</div>
				<div class="regi_td_3_999" id="regi_nick_text">
					<span class="regi_td_3_999">2~6자의 한글과 영문 숫자사용이 가능합니다.</span>
				</div>
			</div>

			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>나이</span>
				</div>
				<div class="regi_td_2">
					<div class="regi_area width_220">
						<select class="regi_area_1" name="regi_age" id="regi_age">
							<option value="" selected="selected">- 선택 -</option>
							<? for($i=20; $i<70; $i++){?>
							<option value="<?=$i?>"><?=$i?></option>
							<? } ?>
						</select>&nbsp;세
					</div>
				</div>
			</div>	<!-- ## regi_hr end ## -->
			<div class="clear"></div>

			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>성별</span>
				</div>
				<div class="regi2_radiobox">
					<input type="radio" value="M" name="regi_sex" id="regi_sex_M" checked>남
					<input type="radio" value="F" name="regi_sex" id="regi_sex_F" class="margin_left_7">여
				</div>
			</div>	<!-- ## regi_hr end ## -->
			<div class="clear"></div>



			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>비밀번호</span>
				</div>
				<div class="regi_td_2">
					<input type="password" name="regi_pw" id="regi_pw" maxlength="12">
				</div>
				<div class="regi_td_3_999" id="regi_pw_text">
					<span class="regi_td_3_999">6자 이상의 비밀번호를 입력해 주십시오.</span>
				</div>
			</div>	<!-- ## regi_hr end ## -->
			<div class="clear"></div>

			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>비밀번호 확인</span>
				</div>
				<div class="regi_td_2">
					<input type="password" name="regi_pw2" id="regi_pw2" maxlength="12">
				</div>
				<div class="regi_td_3_ea3" id="regi_pw2_text">
				</div>
				<div class="clear"></div>
			</div>	<!-- ## regi_hr end ## -->

			<div class="regi_hr">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>이메일</span>
				</div>
				<div class="regi_col">
					<input type="text" class="regi_email_1 regi_mode" name="regi_email_1" id="regi_email_1"><span>&nbsp;@&nbsp;</span><input type="text" class="regi_email_2" id="regi_email_2" name="regi_email_2">
					<div class="regi_eamil_select">
						<select id="regi_email_select" onChange="regi_emailcha();">
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
			</div>	<!-- ## regi_hr end ## -->

			<div class="regi_hr_end">
				<div class="regi_td_1">
					<img src="<?=IMG_DIR?>/member/check_ic.gif"><span>만남지역</span>
				</div>
				<div class="regi_col">
					<div class="regi_area width_220">
						<select class="regi_area_1" name="regi_area_1" id="regi_area_1" onchange="area_select(this.value,'regi_area_2');">
							<option value="" selected="selected">- 선택 -</option> 
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
						<select class="regi_area_2 width_82 margin_top_4" name="regi_area_2" id="regi_area_2" id="local_second_prim">
							<option value="" selected="selected">- 선택 -</option> 
						</select>
					</div>
					<div class="regi_td_3_999" id="regi_pw_text">
						<span class="color_ea3c3c blod block ">* 정확한지역 선택시 채팅성공 확률이 높습니다.</span>
					</div>
				</div>
			</div>	<!-- ## regi_hr_end end ## -->
		</div>		<!-- ## register_area end ##  -->

		<div class="height_467">
			<div class="agree_box">
				<div class="regi_agrarea">
					<input type="checkbox" id="regi_agr_all" class="regi_agr_all_chk"><label for="regi_agr_all" class="regi_agr_all_label" id="aaa"></label><span>전체 동의합니다.</span>
				</div>

				<div class="regi_agrarea">
					<input type="checkbox" id="regi_agr_1" class="regi_agr_1_chk" name="regi_agr_chk"><label for="regi_agr_1" class="regi_agr_1_label"></label><span>이용약관에 동의합니다..</span>
				</div>

				<textarea class="regi_terms">
					<?=$agree1?>
				</textarea>
				
				<div class="regi_agrarea2">
					<input type="checkbox" id="regi_agr_2" class="regi_agr_2_chk" name="regi_agr_chk2"><label for="regi_agr_2" class="regi_agr_2_label"></label><span>개인정보의 수집 및 이용에 동의합니다.</span>
				</div>

				<div class="regi_privacy">
					<ul>
						<li class="regi_priv_on" rel="regi_tab1">
							수집하는 개인정보의 항목
						</li>
						<li class="regi_priv_off" rel="regi_tab2">
							개인정보의 수집 및 이용 목적
						</li>
						<li class="regi_priv_off" rel="regi_tab3">
							개인정보의 보유 및 이용기간
						</li>
						<li class="clear"></li>
					</ul>

					<textarea id="regi_tab1" class="regi_tab">
						<?=$agree2?>
					</textarea>

					<textarea id="regi_tab2" class="regi_tab">
						<?=$agree3?>
					</textarea>

					<textarea id="regi_tab3" class="regi_tab">
						<?=$agree4?>
					</textarea>
				</div>		<!-- ## regi_privacy end ## -->
				<input type="button" class="regi_btn" value="회원가입" id="submit_btn" style="margin-top:20px;">

			</div>		<!-- ## agree_box end ## -->

			<div style="position:relative; width:100%; text-align:right; padding:20px 5px 5px 5px;">
				<img src="<?=IMG_DIR?>/etc/qna_icon.png" style="vertical-align:-4px;">
				<font style="font-size:1.2em; color:#989898; cursor:pointer; border-bottom:solid 1px #989898; padding-bottom:2px;" onclick="javascript:qna_add();">회원가입이 잘 안되시나요?</font>
			</div>
			
		</div>		<!-- ## height_467 end ## -->
	</div>		<!-- ##	register_box end ## -->

	</form>

	<div class="regi_right_area">
		<img src="<?=IMG_DIR?>/member/register_top.gif" class="margin_bottom_6">
		<img src="<?=IMG_DIR?>/member/register_bottom.gif">
	</div>		<!-- ## regi_right_area end ## -->


</div>



<script>
var Browser = {
    chk : navigator.userAgent.toLowerCase()
}
  
Browser = {
    ie6 : Browser.chk.indexOf('msie 6') != -1,
    ie7 : Browser.chk.indexOf('msie 7') != -1,
    ie8 : Browser.chk.indexOf('msie 8') != -1
}
  
if ((Browser.ie8) || (Browser.ie7) || (Browser.ie6)) {

	$("#regi_agr_all").css("display","inline-block");
	$(".regi_agr_all_label").css("display","none");
	$(".regi_agrarea > span").addClass("padding_left_6");

	$("#regi_agr_1").css("display","inline-block");
	$(".regi_agr_1_label").css("display","none");
	$(".regi_agrarea > span").addClass("padding_left_6");

	$("#regi_agr_2").css("display","inline-block");
	$(".regi_agr_2_label").css("display","none");
	$(".regi_agrarea2 > span").addClass("padding_left_6");

	$(".regi_priv_on").addClass("regi_priv_ie");
	$(".regi_priv_off").addClass("regi_priv_ie");
    
}
</script>