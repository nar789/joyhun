
	<!--div class="m_alarm_area">

		<div class="m_alarm_box">
			<div class="m_alarm_align">
				<div class="m_alarm_img">
					<img src='<?=IMG_DIR?>/m/m_man_ic.png' class="width_100per">
				</div>
				<div class="m_alarm_text_area">
					<div class="m_alarm_text">
						<b class="color_fff">시크한 개냥이</b>
						<p class="color_ccc">ㄴㄴ~ 지금은 머하구 있어요??</p>
					</div>
					<div class="m_alarm_exit">
						<img src="<?=IMG_DIR?>/m/mobile_alr.gif">
					</div>
				</div>
			</div>
		</div> 

	</div-->
</div>

</body>

<?if(@$add_script){
	echo $add_script;
}?>

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
?>