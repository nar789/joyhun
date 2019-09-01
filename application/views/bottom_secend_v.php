<!-- ## footer_frame-->
<div class="footer_frame_second">
	<div class="footer_border_second"></div>

	<div class="footer_second">
		<div class="footer_menu blod">
			<a href="/etc/privacy_policy/policy_1" class="color_fff font-size_14">개인정보 취급방침 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="#" class="color_fff font-size_14"> 회사소개 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="#" onclick="business_add('사업제휴문의')" class="color_fff font-size_14"> 사업제휴문의 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="#" onclick="business_add('광고문의')" class="color_fff font-size_14"> 광고문의 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="/etc/privacy_policy/policy_3" class="color_fff font-size_14"> 청소년보호정책 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="/etc/privacy_policy/policy_2" class="color_fff font-size_14"> 이용약관 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="/service_center" class="color_fff font-size_14"> 고객센터 </a>&nbsp;&nbsp;<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;<a href="#" class="color_fff font-size_14"> 권리침해신고센터 </a>
		</div>		<!-- ## footer_menu END -->

		<div class="footer_mid">
		상호 : 위드유&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표 : 이흥일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주소:경기도 수원시 팔달구 경수대로 446번길48, 701호<br>
		대표전화 : 070-7434-2782 (평일 : 10:00~17:00 / 점심시간 :13:00~14:00)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이메일 : youclub@nate.com<br>
		사업자등록번호 : 135-24-79774&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;통신판매업신고 : 제 2017-수원팔달-0318호&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;결혼정보업 : 경기-수원-국내-12-0003
		</div>

		<div class="footer_copy">
		COPYRIGHTS (C) 2016 JOYHUNTING. All Rights Reserved.
		</div>

		<img src="<?=IMG_DIR?>/intro/key_bottom_rogo.gif">
	</div>		<!-- ## footer END -->

	<div class="footer_bottom_bg">
		<div class="footer_bottom">
			<img src="<?=IMG_DIR?>/main_2_06.gif"><img src="<?=IMG_DIR?>/main_2_07.gif"><img src="<?=IMG_DIR?>/main_2_03.gif">
		</div>
	</div>		<!-- ## footer_bottom_bg END -->

</div>		
<!-- ## footer_frame END -->


<!-- ## 좌측 따라다니는 배너 ## -->
<!-- ## 좌측 따라다니는 배너 끝 ## -->
<?if(@$add_script){
	echo $add_script;
}?>

	<div id="alrim_wrap"></div>
	<div id="alrim_chat_status_wrap"></div>
	<div id="alrim_msg_status_wrap"></div>
	<div id="alrim_joy_status_wrap"></div>
	<div id="alrim_chat_list_wrap"></div>
	<div id="alrim_msg_list_wrap"></div>
	<div id="alrim_joy_list_wrap"></div>

</body>
</html>

<?	if($this->mobile_detect->isMobile() == true and IS_MOBILE == false){  //모바일 기계로 들어왔고, PC보기 상태라면?>
		<input type="button" value="모바일로 보기" onclick="set_mode('m');" style="width:100%;height:100px;font-size:50px;">
<?	}?>