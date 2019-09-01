
	<!-- <div class="bg_e7e7e7 width_100per">
		<div class="m_bottom_a_area">
		<?if(IS_LOGIN == true){?>
			<a href="/auth/logout/"><span>로그아웃</span></a><img src="<?=IMG_DIR?>/m/m_bottom_bar.gif" class="block ver_mid"><a href="/profile/main/user"><span>프로필</span></a><img src="<?=IMG_DIR?>/m/m_bottom_bar.gif" class="block ver_mid"><a href="javascript:set_mode('pc');"><span>PC버전</span></a>
		<?}else{?>
			<a href="/auth/login/"><span>로그인</span></a><img src="<?=IMG_DIR?>/m/m_bottom_bar.gif" class="block ver_mid"><a href="/auth/register/"><span>회원가입</span></a><img src="<?=IMG_DIR?>/m/m_bottom_bar.gif" class="block ver_mid"><a href="javascript:set_mode('pc');"><span>PC버전</span></a>
		<?}?>
		</div>
	</div> -->


	<div class="m_bottom_text" style="bottom:0px;">
	위드유 | 이흥일 | 사업자등록번호:135-24-79774<br>
	통신판매업신고 : 제 2017-수원팔달-0318호<br> 
	경기도 수원시 팔달구 경수대로 446번길48,701호<br>
	Tel : 070-7434-2782 | email : joyhunting2016@nate.com<br>
	전화문의 (평일 : 09:00~16:00 / 점심시간 :12:30~13:30 /<br>
	금요일 : 09:00~12:30)
	<br><br>
	
	<p class="color_777">COPYRIGHTS (C) 2016 조이헌팅. All Rights Reserved.
	</p>
	</div>

	<a href="#" class="tothe_top"><span class="top_arrow"></span><p>TOP</p></a>

	<div class="m_alarm_area" id="m_alarm_area">
	</div>


<?if(@$add_script){
	echo $add_script;
}?>

	<div class="width_100per margin_auto">
		<div id="chat_send_m">채팅신청을 보냈습니다.</div>
	</div>
</div>
<?=bags_event();?>
</body>
</html>


<script>
  //구글아날리틱스
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41246821-3', 'auto');
  ga('send', 'pageview');

</script>

<?
	//회원 이동경로 헬퍼(latest_helper)
	member_site_analytics();

	if(APP_OS == "IOS"){
	?>
		<script>
			function test1(){
				alert(1);
				store.order('1001');
			}
		</script>
		<!--<input type=button value="test" onclick="test1();">-->
	<?
	}
?>