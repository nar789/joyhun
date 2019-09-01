<!-- ## footer_frame-->
<div class="footer_frame">
	<div class="footer_border"></div>

	<div class="footer">
		<div class="footer_menu blod">
			<a href="/etc/privacy_policy/policy_1" class="color_888 font-size_14 uline">개인정보 취급방침 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;
			<!--<a href="#" class="color_888 font-size_14">회사소개 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span> &nbsp;&nbsp; -->
			<a href="/etc/privacy_policy/policy_2" class="color_888 font-size_14 uline"> 이용약관 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;
			<a href="/etc/privacy_policy/policy_3" class="color_888 font-size_14 uline"> 청소년보호정책 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;
			<a href="#" onclick="business_add('사업제휴문의')" class="color_888 font-size_14 uline"> 사업제휴문의 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;
			<a href="#" onclick="business_add('광고문의')" class="color_888 font-size_14 uline"> 광고문의 </a>&nbsp;&nbsp;
			<span class="border_right_dbdbdb"></span>&nbsp;&nbsp;
			<a href="/service_center" class="color_888 font-size_14 uline"> 고객센터 </a>&nbsp;&nbsp;
			<!--<span class="border_right_dbdbdb">
			</span>&nbsp;&nbsp;<a href="#" class="color_888 font-size_14"> 권리침해신고센터 </a>-->
		</div>		<!-- ## footer_menu END -->

		<div class="footer_mid">
		상호 : 위드유&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표 : 이흥일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주소:경기도 수원시 팔달구 경수대로 446번길48, 701호<br>
		대표전화 : 070-7434-2782 (평일 : 09:00~16:00 / 점심시간 :12:30~13:30 / 금요일 : 09:00~12:30) <input type="button" class="text_btn_dcdcdc color_888 height_20 width_50 blod" onclick="javascript:qna_add();" value="1:1문의">&nbsp;&nbsp;이메일 : joyhunting2016@nate.com<br>
		사업자등록번호 : 135-24-79774&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;통신판매업신고 : 제 2017-수원팔달-0318호
		</div>

		<input type="button" style="background:#fff;border:1px solid #fff;color:#fff;" value="TEST" onclick="location.href='/auth/testest'">
		
		<div class="footer_copy">
		COPYRIGHTS (C) 2016 JOYHUNTING. All Rights Reserved.
		</div>

		<a href="/"><img src="<?=IMG_DIR?>/bottom_img.gif"></a>
	</div>		<!-- ## footer END -->

	<div class="footer_bottom_bg">
		<div class="footer_bottom">
			<img src="<?=IMG_DIR?>/remote_Support.gif" style="cursor:pointer; vertical-align: super;" onclick="location.href='/data/joy.exe'">
			<img src="<?=IMG_DIR?>/main_2_06.jpg" style="margin-left:38px;">
		</div>
	</div>		<!-- ## footer_bottom_bg END -->

</div>		
<!-- ## footer_frame END -->


<!-- ## 좌측 따라다니는 배너 ## -->
<div id="floating" >
  <div class="banner_area">

	<div class="rolling_wrap">    
		<div id="rolling">        
			<ul>            
				<!--li><a href="/service_center/event_talk/talk_list"><img src="<?=IMG_DIR?>/banner_1_4.jpg" class="banner_1"></a></li--> 
				<li><a href="/etc/joy_guide"><img src="<?=IMG_DIR?>/banner_1_1.gif" class="banner_1"></a></li> 
				<li><a href="/secret/talkchat/talk_list"><img src="<?=IMG_DIR?>/banner_1_2.gif" class="banner_1"></a></li> 
			</ul> 
		</div>    
		<div class="pages_box">
			<ul class="pages"></ul> 
		</div>
	</div> 

    <a href="/service_center/event_stamp/stamp_event"><img src="<?=IMG_DIR?>/banner_2.gif" class="banner_2"></a>
    <a href="/secret/talkchat/talk_list"><img src="<?=IMG_DIR?>/banner_4.gif" class="banner_3"></a>

    <div class="banner_alink" style="height:110px;">
      <div><a href="/etc/guide">채팅성공 팁</a></div>
      <div><a href="/photo/bestphoto/photo_list">조이 포토샷</a></div>
      <div onclick="<?user_check("location.href='/profile/my_alarm/alarm_list';");?>"><a href="#">실시간 알림</a></div>
    </div>
	
	
  </div>
</div>
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

	<div class="width_960 margin_auto">
		<div id="chat_send">채팅신청을 보냈습니다.</div>
	</div>

	<?=bags_event();?>

</body>
</html>

<?	if($this->mobile_detect->isMobile() == true and IS_MOBILE == false){  //모바일 기계로 들어왔고, PC보기 상태라면?>
		<input type="button" value="모바일로 보기" onclick="set_mode('m');" style="width:100%;height:100px;font-size:50px;">
<?	}?>


<script>
  //구글아날리틱스
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41246821-2', 'auto');
  ga('send', 'pageview');
	
</script>

<?
	//회원 이동경로 헬퍼(latest_helper)
	member_site_analytics();
?>