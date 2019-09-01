
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

  ga('create', 'UA-41246821-2', 'auto');
  ga('send', 'pageview');

</script>

<?
	//회원 이동경로 헬퍼(latest_helper)
	member_site_analytics();
?>