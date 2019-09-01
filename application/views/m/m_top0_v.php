<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="조이헌팅"/>
	<meta name="keywords" content="조이헌팅"/>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="format-detection" content="telephone=no, address=no, email=no" /><!-- 전화번호,이메일,지도 자동링크 이슈 방지 -->

	<link rel="shortcut icon" href="/favicon.ico" />
	<title>조이헌팅 :: 언제나 즐겁고 좋은만남, 조이헌팅</title>

	<link href="<?php echo CSS_DIR?>/component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/layout_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_head_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_bottom_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo CSS_DIR?>/jq.rolling.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />

	<?if(@$add_css){foreach($add_css as $css_name){?>
		<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=TODAY?>" rel="stylesheet" />
	<?}}?>

	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
	<script src="<?php echo JS_DIR?>/common.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/overlay.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/jq_rolling.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.form.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo JS_DIR?>/m/m_popups.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/m/m_js.js?<?=TODAY?>"></script>

	<?if(@$add_js){foreach($add_js as $js_name){?>
		<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=TODAY?>"></script>
	<?}}?>

	<script><?if(IS_MOBILE == TRUE){echo "var is_mobile = true; var is_app = '';";}else{echo "var is_mobile = false; var is_app = '';";}?></script>
	<? if(IS_APP){ ?>
		<script type="text/javascript"><? if(APP_OS == "IOS"){ echo "is_app='ios';"; }else{ echo "is_app='android';"; } ?></script>
	<?}?>

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- ShowGet Widget Script Start -->
<script> var SGscriptPlugIn = new function () { StarADPayment=''; this.loadSBox = function(eSRC,fnc) { var script = document.createElement('script'); script.type = 'text/javascript'; script.charset = 'utf-8'; script.onreadystatechange= function () { if((!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') && fnc!=undefined && fnc!='' ) { eval(fnc); }; }; script.onload = function() { if(fnc!=undefined && fnc!='') { eval(fnc); }; }; script.src= eSRC; document.getElementsByTagName('head')[0].appendChild(script); }; }; </script>
<script> SGscriptPlugIn.loadSBox('//showget.co.kr/js/plugShow.php?withyou8','sg_paycheck.playstart()'); </script>
<!-- ShowGet Widget Script End -->
<!-- ShowGet SCON Script -->
<script>
SGscriptPlugIn.loadSBox('//showget.co.kr/showcorn/js/showconbar.js.php?pid=withyou8',"showconbar.code=new Array('withyou8');showconbar.SCon();");
</script>
<!-- ShowGet SCON Script -->

</head>
<body>