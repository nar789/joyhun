<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="조이헌팅"/>
	<meta name="keywords" content="조이헌팅"/>
	<link rel="shortcut icon" href="/favicon.ico" />
	<title>조이헌팅 :: 언제나 즐겁고 좋은만남, 조이헌팅</title>

	<link href="<?php echo CSS_DIR?>/component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/layout_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/head_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/right_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/bottom_intro_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/chat/alrim_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo CSS_DIR?>/jq.rolling.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />

	<?if(@$add_css){foreach($add_css as $css_name){?>
		<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
	<?}}?>

	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
	<script src="<?php echo JS_DIR?>/common.js?<?=NOW?>"></script>
	<script src="<?php echo JS_DIR?>/common_pc.js?<?=NOW?>"></script>
	<script src="<?php echo JS_DIR?>/overlay.js"></script>
	<script src="<?php echo JS_DIR?>/jq_rolling.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.form.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo JS_DIR?>/popups.js?<?=NOW?>"></script>

	<? if(IS_LOGIN){ ?><script src="<?php echo JS_DIR?>/chat/alrim_js.js?<?=NOW?>"></script><?}?>

	<?if(@$add_js){foreach($add_js as $js_name){?>
		<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
	<?}}?>

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->


</head>





<!-- header start -->

<!-- ## header end -->