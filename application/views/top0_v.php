<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="조이헌팅"/>
	<meta name="keywords" content="조이헌팅"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<title><?if(@$add_title){echo $add_title;}else{?>조이헌팅 :: 언제나 즐겁고 좋은만남, 조이헌팅<?}?></title>

	<link href="<?php echo CSS_DIR?>/component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo CSS_DIR?>/jq.rolling.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/layout_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/head_css.css" rel="stylesheet" />

	<?if(@$add_css){foreach($add_css as $css_name){?>
		<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css" rel="stylesheet" />
	<?}}?>

	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
	<script src="<?php echo JS_DIR?>/common.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/jq_rolling.js"></script>
	<script src="<?php echo JS_DIR?>/overlay.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.post.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo JS_DIR?>/popups.js?<?=TODAY?>"></script>

	
	<?if(@$add_js){foreach($add_js as $js_name){?>
		<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
	<?}}?>

	<script><?if(IS_MOBILE == TRUE){echo "var is_mobile = true; var is_app = '';";}else{echo "var is_mobile = false; var is_app = '';";}?></script>
	<? if(IS_MOBILE and IS_APP){ ?>
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


</head>
<body>
