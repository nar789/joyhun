<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

	<title>테스트페이지</title>
	
	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	
	<script type="text/javascript">
		
		$(document).ready(function(){

		});
		
		history.pushState(null, null, "");

		$(window).on("popstate", function(event){
			//두번째페이지 url
			window.location.replace("http://www.joyhunting.com/test/test_1/aaa");

		});

	</script>
</head>
<body>

첫번째페이지

</body>
</html>