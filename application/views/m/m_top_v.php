<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="Title" content="조이헌팅 ">
	<meta name="keywords" content="채팅, 채팅사이트, 채팅방, 무료채팅, 무료채팅사이트, 결혼, 연애, 음악채팅, 음악방송, 소개팅, 만남, 만남사이트, 완전무료채팅, 40대채팅, 30대채팅, 채팅방사이트, CLUB5678, 클럽5678, 킹카닷컴, 미팅포유, 눈팅, 40대채팅사이트, 애인만들기, 만남채팅, 여자꼬시는법, 여자친구사귀는법, 여자친구만나는법, 남자친구사귀는법, 조이, 조이헌팅, 헌팅, 소개팅대화, 채팅사이트순위, 성인채팅, 인터넷채팅, 번개팅, 즉석만남 " />
	<meta name="Description" content="조이헌팅, 무료채팅, 채팅사이트, 미팅, 음악방송, 소개팅, 결혼재혼, 채팅어플">
	<meta name="robots" content="index,follow" />
	<meta name="author" content="조이헌팅" />
	<meta name="copyright" content="©조이헌팅" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="조이헌팅" />
	<meta property="og:description" content="조이헌팅, 무료채팅, 채팅사이트, 미팅, 음악방송, 소개팅, 결혼재혼, 채팅어플" />
	<meta property="og:image" content="http://www.joyhunting.com/images/head_07.jpg" />
	<meta property="og:url" content="http://www.joyhunting.com" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="조이헌팅">
	<meta name="twitter:description" content="조이헌팅, 무료채팅, 채팅사이트, 미팅, 음악방송, 소개팅, 결혼재혼, 채팅어플">
	<meta name="twitter:image" content="http://blog.naver.com/joyhunting">
	<meta name="twitter:domain" content="조이헌팅">
	<meta name="google-site-verification" content="WU-BfyTPwU3nfGaxpgp0_rXY6OL6VzJ5De0ElbP90Sg" />
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover" />
	<meta name="format-detection" content="telephone=no, address=no, email=no" /><!-- 전화번호,이메일,지도 자동링크 이슈 방지  -->
	
	<? if(IS_LOGIN){ ?>
	<meta http-equiv=Cache-Control content="no-cache; must-revalidate">
	<meta http-equiv=Pragma content=no-cache> 
	<? } ?>

	<link rel="shortcut icon" href="/favicon.ico" />
	<title>조이헌팅 :: 언제나 즐겁고 좋은만남, 조이헌팅</title>

	<link href="<?php echo CSS_DIR?>/component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/layout_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_head_css.css?<?=NOW?>" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/m/m_bottom_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo CSS_DIR?>/jq.rolling.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.bxslider.css" rel="stylesheet" />

	<?if(@$add_css){foreach($add_css as $css_name){?>
		<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
	<?}}?>

	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
	<script src="<?php echo JS_DIR?>/common.js?1<?=TODAY?>1"></script>
	<script src="<?php echo JS_DIR?>/common_m.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/overlay.js"></script>
	<script src="<?php echo JS_DIR?>/jq_rolling.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.form.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo JS_DIR?>/m/m_popups.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/m/m_js.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/jquery.bxslider.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.bxslider.min.js"></script>

	<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
	
	<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?=SITE_NAVER_ID?>&submodules=geocoder"></script>//-->
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=ve6vphxt72"></script>

	<?if(@$add_js){foreach($add_js as $js_name){?>
		<script src="<?php echo JS_DIR?>/<?=$js_name?>.js"></script>
	<?}}?>

	<? if(IS_LOGIN){ ?><script src="<?php echo JS_DIR?>/chat/alrim_mobile_js.js?<?=NOW?>"></script><?}?>

	<script><?if(IS_MOBILE == TRUE){echo "var is_mobile = true; var is_app = '';";}else{echo "var is_mobile = false; var is_app = '';";}?></script>

	<? if(IS_APP){ ?>
		<script type="text/javascript"><? if(APP_OS == "IOS"){ echo "is_app='ios';"; }else{ echo "is_app='android';"; } ?></script>
		<script type="text/javascript" src="<?if(APP_OS == "IOS"){echo APP_ROOT_IOS;}else{echo APP_ROOT;}?>/cordova.js?<?=NOW?>"></script>
		<script type="text/javascript" src="<?if(APP_OS == "IOS"){echo APP_ROOT_IOS;}else{echo APP_ROOT;}?>/cordova_plugins.js?<?=NOW?>"></script>
		<script type="text/javascript" src="<?if(APP_OS == "IOS"){echo APP_ROOT_IOS;}else{echo APP_ROOT;}?>/js/index.js?<?=NOW?>"></script>
	<?}?>

	<? if(IS_LOGIN and  $this->session->userdata['m_sex'] == "M"){ //관리자 사칭 주의 레이어 팝업?>
		<script>
			$(document).ready(function(){  
				warning_open_layer();
			});
		</script>
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

<div class="bg_f6f7f9">
<div id="top_menu">
<?=@$top_menu?>
</div>
<div id="menu_bar"></div>