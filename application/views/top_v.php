<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<title>조이헌팅</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR"/>
	<meta http-equiv="content-script-type" content="text/javascript"/>
	<meta http-equiv="Content-Style-Type" content="text/css">
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
	
	<? if(IS_LOGIN){ ?>
	<meta http-equiv=Cache-Control content="no-cache; must-revalidate">
	<meta http-equiv=Pragma content=no-cache> 
	<? } ?>

	<link href="<?php echo CSS_DIR?>/component_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/layout_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/head_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/right_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/bottom_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/chat/alrim_css.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo CSS_DIR?>/jq.rolling.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />
	<link href="<?php echo CSS_DIR?>/jquery.bxslider.css" rel="stylesheet" />
	<?if(@$add_css){foreach($add_css as $css_name){?>
	  <link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=TODAY?>" rel="stylesheet" />
	<?}}?>

	<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.event.drag-1.5.1.min.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.touchSlider.js"></script>
	<script src="<?php echo JS_DIR?>/common.js?1<?=TODAY?>1"></script>
	<script src="<?php echo JS_DIR?>/common_pc.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/overlay.js"></script>
	<script src="<?php echo JS_DIR?>/jq_rolling.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.form.js"></script>
	<script src="<?php echo JS_DIR?>/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo JS_DIR?>/popups.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/jquery.bxslider.js?<?=TODAY?>"></script>
	<script src="<?php echo JS_DIR?>/jquery.bxslider.min.js?<?=TODAY?>"></script>
	
	<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?=SITE_NAVER_ID?>&submodules=geocoder"></script>//-->
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=<?=SITE_NAVER_ID?>&submodules=geocoder"></script>


	<? if(IS_LOGIN){ ?><script src="<?php echo JS_DIR?>/chat/alrim_js.js?<?=TODAY?>"></script><?}?>

	<?if(@$add_js){foreach($add_js as $js_name){?>
	  <script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=TODAY?>"></script>
	<?}}?>

	<script>
	<?if(IS_MOBILE == TRUE){echo "var is_mobile = true;";}else{echo "var is_mobile = false;";}?>
	<? reg_member_redirect();  /*모바일에서 본인인증안한 임시회원 PC접속시 리다이렉트*/?>
	</script>

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

</head>
<body>

<!-- header start -->
<div class="header">
	<?
		//여성회원전용 상단 탑 배너(popup_helper)
		call_woman_event_pop(); 
		
	?>

	<div class="top_border">
		
		<div class="top_box">

			<div class="top_left">
				<p class="padding_top_8"><a href="#" onclick="javascript:bookmark('http://#','조이헌팅');"><b class="color_ea3c3c">조이헌팅</b>&nbsp;즐겨찾기에 추가</a></p>
			</div>
			<!-- ## top_left end -->

			<div class="top_right">
				<ul class="padding_top_8">
					<? if (IS_LOGIN){ ?>
					<!-- @@ if 회원 -->
					<li><a href="/auth/logout/" class="color_666 uline">로그아웃</a></li>
					<li class="main_id_style uline"><a href="/profile/my_info">내정보관리&nbsp;<p> &#9662;</p></a></li>
					<?}else{?>
					<!-- @@ if 비회원 -->
					<li><a href="https://<?=$_SERVER["HTTP_HOST"]?>/auth/login/" class="color_666 uline">로그인</a></li>
					<!--<li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login/" class="color_666 uline">로그인</a></li>-->
					<li><a href="https://<?=$_SERVER["HTTP_HOST"]?>/auth/register/" class="color_ea3c3c uline">회원가입</a></li>
					<!--<li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/register/" class="color_ea3c3c uline">회원가입</a></li>-->
					<?}?>
					
					<li><a href="/secret/talkchat/" class="color_666 uline">비밀톡챗</a></li>
					<li><a href="/profile/point/point_list" class="color_666 uline">내포인트/충전</a></li>
					<li><a href="/service_center" class="color_666 uline">고객센터</a></li>
				</ul>
			</div>
			<!-- ## top_right end -->

		</div>
		<!-- ## top_box end -->
	</div>
	<!-- ## top_border end -->

	<div class="mid_logo">
		<a href="/"><div class="main_left_logo"></div></a>

		<div class="float_right">
			<!-- 여성회원 전용 이벤트 오른쪽팝업 -->
			<div class="logo_area">
				<?
					//여성회원 전용 이벤트 로고배너
					call_woman_event_logo();
				?>
			</div>
		</div>
	</div>
	<!-- ## mid_logo end -->

	<?=$top_menu?>

	<!-- ## menu end -->

</div>
<!-- ## header end -->