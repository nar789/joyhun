
<div class="content">

	<div class="left_main">

		<div class="my_info_lock">
			<img src="<?=IMG_DIR?>/profile/my_info_img_1.png" class="margin_left_30">
		</div>
		<div class="block">

			<div class="padding_left_10">
			
				<p class="info_title font-size_24">회원님의 소중한 정보를<br><span class="font-size_24">안전하게</span> 관리하세요.</p>

				<p class="info_text_1 font-size_16">회원정보를 수정하려면<br><span class="font-size_16">비밀번호를 입력</span>하셔야 합니다.</p>

				<p class="color_ea3c3c margin_top_33">회원님의 개인 정보 보호를 위한 본인 확인 절차이오니, 사용하시는 비밀번호를 입력해주세요.</p>

				<div class="info_lock_pass">
					<span class="color_333 blod">비밀번호</span><input type="password" id="m_pwd" name="m_pwd" class="info_lock_pwd" onkeypress="board_search_enter(document.m_pwd);"/>
				</div>

				<div class="float_right margin_top_20">
					<input type="button" class="text_btn_ea3e3e font-size_14 margin_right_2 myinfo_btn" value="취소" onclick="location.href='/profile/'; " />
					<input type="button" class="text_btn_de4949 font-size_14 myinfo_btn" id="my_pwd_chk" value="확인" onclick="javascript:pw_chk();"/>
				</div>
				<div class="clear"></div>

			</div>
			<div class="margin_top_100">
				<div class="info_back1" onclick="search_pw();">
					<b class="color_333 font-size_16">비밀번호 확인</b>
					<p class="color_666 blod line-height_16 margin_top_8">사용하시던 비밀번호를<br>잊어버리셨나요?</p>
				</div>
				<div class="info_back2" onclick="location.href='/profile/secession'">
					<b class="color_333 font-size_16">조이헌팅 회원 탈퇴</b>
					<p class="color_666 blod line-height_16 margin_top_8">조이헌팅 웹사이트에서<br>탈퇴하길 원하시나요?</p>
				</div>
			</div>

		</div>
	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->


<script>

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#my_pwd_chk").click();
}
</script>