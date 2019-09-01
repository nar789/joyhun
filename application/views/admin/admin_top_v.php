<!doctype html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>조이헌팅 관리자</title>
		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?=BS_ADM_DIR?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?=BS_ADM_DIR?>/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?=BS_ADM_DIR?>/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?=BS_ADM_DIR?>/css/component_css.css" rel="stylesheet" type="text/css" />
		<link href="<?=BS_ADM_DIR?>/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
		
		<link href="<?=CSS_DIR?>/admin.css" rel="stylesheet" type="text/css" />
		<link href="<?=CSS_DIR?>/jquery-ui-1.11.4.css" rel="stylesheet" />

		<?if(@$add_css){foreach($add_css as $css_name){?>
			<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
		<?}}?>

		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '<?=BS_ADM_DIR?>/plugins/';</script>
		<script type="text/javascript" src="<?=BS_ADM_DIR?>/plugins/jquery/jquery-2.1.4.min.js"></script>		
		<script type="text/javascript" src="<?=BS_ADM_DIR?>/js/app.js"></script>
		<script type="text/javascript" src="<?php echo JS_DIR ?>/jquery.post.js"></script>
		<script type="text/javascript" src="<?php echo JS_DIR?>/admin.js"></script>

		<script type="text/javascript" src="<?=JS_DIR?>/jquery-ui-1.11.4.min.js"></script>
		
		<script type="text/javascript" src="<?php echo JS_DIR?>/jquery.form.js"></script>
		
		<?if(@$add_js){foreach($add_js as $js_name){?>
			<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
		<?}}?>

	</head>
	<body>

		<!-- WRAPPER -->
		<div id="wrapper">

			<!-- 
				ASIDE 
				Keep it outside of #wrapper (responsive purpose)
			-->
			<aside id="aside">
				<!--
					Always open:
					<li class="active alays-open">

					LABELS:
						<span class="label label-danger pull-right">1</span>
						<span class="label label-default pull-right">1</span>
						<span class="label label-warning pull-right">1</span>
						<span class="label label-success pull-right">1</span>
						<span class="label label-info pull-right">1</span>
				-->
				<nav id="sideNav"><!-- MAIN MENU -->
					<ul class="nav nav-list">
					<?		if($this->session->userdata('auth_code') >= 5){?>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-user"></i> <span>회원관리</span>
							</a>
							<ul><!-- submenus -->
								<li><a href="/admin/main/member_list">회원조회</a></li>
								<li><a href="/admin/main/old_member_list">휴면회원 조회</a></li>
								<li><a href="/admin/main/reg_member_list">임시회원 조회</a></li>
								<li><a href="/admin/main/member_secession">탈퇴회원 조회</a></li>
								<li><a href="/admin/main/member_out">회원 탈퇴</a></li>
								<li><a href="/admin/profile/pic_manage/pic_list">프로필 사진인증</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-krw"></i> <span>결제관리</span>
							</a>
							<ul><!-- submenus -->
								<li><a href="/admin/etc/payment/payment_list">결제내역관리</a></li>
								<li><a href="/admin/profile/point/point_list">포인트관리</a></li>
								<li><a href="/admin/etc/refund/refund_list">환불신청관리</a></li>
								<li><a href="/admin/etc/payment_partner">결제사 리스트</a></li>
								<li><a href="#">선물상점관리</a>
									<ul>
										<li><a href="/admin/gift/gift_management/gift_list">상품관리</a></li>
										<li><a href="/admin/gift/member_gift/delivery_list">배송관리</a></li>
										<li><a href="/admin/gift/member_gift/member_gift_list">선물리스트</a></li>
									</ul>
								</li>
								<li><a href="/admin/etc/mu_recognition_log/log_list">무통장입금로그관리</a></li>
								<li><a href="/admin/etc/mu_alrim_msg_log/log_list">무통장메세지재발송로그</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-pencil-square-o"></i> <span>서비스관리</span>
							</a>
							<ul><!-- submenus -->
								<li><a href="#">미팅신청</a>
									<ul>
										<li><a href="/admin/meeting/beongae/beongae_list">번개팅</a></li>
										<li><a href="/admin/meeting/smsting/smsting_list">문자팅</a></li>
										<li><a href="/admin/meeting/socialting/social_list">소셜팅</a></li>
										<li><a href="/admin/meeting/jjack/jjack_list">짝/애정촌</a></li>
									</ul>
								</li>
								<li><a href="#">친구만들기</a>
									<ul>
										<li><a href="/admin/friend/friend/friend_list">친구만들기</a></li>
										<li><a href="/admin/friend/anne/anne_list">앤만들기</a></li>
										<li><a href="/admin/friend/vote/vote_list">공감Poll</a></li>
									</ul>
								</li>
								<li><a href="#">프로필</a>
									<ul>
										<li><a href="/admin/profile/message/message_list">메세지관리</a></li>
										<li><a href="/admin/profile/propose/propose_list">프로포즈관리</a></li>
									</ul>
								</li>
								<li><a href="#">공개구혼</a>
									<ul>
										<li><a href="/admin/open_marry/manager/manager_list">매니저의 추천회원</a></li>
										<li><a href="/admin/open_marry/marriage/marriage_list">결혼신청</a></li>
										<li><a href="/admin/open_marry/remarriage/remarriage_list">재혼신청</a></li>
										<li><a href="/admin/open_marry/open_marry/open_guhon_list">공개구혼</a></li>
									</ul>
								</li>
								<li><a href="/admin/blindmeet/blind/blind_list">소개팅</a></li>
								<li><a href="/admin/etc/talk/talk_list">토크</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-comment"></i> <span>고객센터</span>
							</a>
							<ul><!-- submenus -->
								<li><a href="/admin/service_center/cs/cs_question">CS문의</a></li>
								<li><a href="/admin/service_center/faq/faq_list">FAQ</a></li>
								<li><a href="/admin/service_center/notice/notice_list">공지사항</a></li>
								<li><a href="/admin/service_center/joy_magazine/magazine_list">조이매거진</a></li>
								<li><a href="/admin/service_center/event/event_list">이벤트</a></li>
								<li><a href="/admin/service_center/event_love/event_list">일대일이벤트</a></li>
								<li><a href="/admin/service_center/app_grade/event_list">앱별점이벤트</a></li>
								<li><a href="/admin/service_center/stamp_event/stamp_member">출석체크 당첨자</a></li>
								<li><a href="/admin/service_center/event_mb/event_list">당첨자발표</a></li>
								<li><a href="/admin/service_center/my_question/my_question_list">회원문의내역</a></li>
								<li><a href="/admin/service_center/complaint/complain_list">신고내역 관리</a></li>
								<li><a href="/admin/service_center/punishment/punish_list">처벌내역 관리</a></li>
								<li><a href="/admin/service_center/member_block/block_list">IP/HP 접속차단</a></li>
								<li><a href="/admin/service_center/business/business_list">광고,사업제휴문의 관리</a></li>
								<li><a href="/admin/service_center/mail/mail_list">메일 카운트 관리</a></li>
							</ul>
						</li>
					<?}?>
					<?if($this->session->userdata('auth_code') >= 8){?>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-book"></i> <span>채팅관리</span>
							</a>
							<ul><!-- submenus -->
						<?		if($this->session->userdata('auth_code') >= 8){?>
								<li><a href="/admin/admin_setting/special_id">특별아이디관리</a></li>								
						<?		}?>
						<?		if($this->session->userdata('auth_code') >= 3){?>
								<li><a href="/admin/admin_setting/special_chat_list">특별아이디채팅관리</a></li>
						<?		}?>
						<?if($this->session->userdata('auth_code') >= 5){?>
								<li><a href="/admin/admin_setting/special_id2">메인추천아이디</a></li>
						<?}?>
								<li><a href="/admin/chatting/total_woman_pic/pic_list">전체 여성회원 사진</a></li>
						<?		if($this->session->userdata('auth_code') >= 10){?>
								<li><a href="/admin/chatting/chat_time/setting">채팅신청 시간설정</a></li>								
								<li><a href="/admin/chatting/super_chat/super_send">슈퍼채팅 보내기</a></li>
						<?		}?>
						<?		if($this->session->userdata('auth_code') >= 8){?>
								<li><a href="/admin/chatting/chat_app_push/user_list">앱푸쉬 보내기</a></li>
								<li><a href="/admin/etc/chat_words/words_list">채팅신청 메시지 관리</a></li>
						<?		}?>
						<?		if($this->session->userdata('auth_code') >= 10){?>
								<li><a href="/admin/admin_setting/intro_list">인사말 관리</a></li>
						<?		}?>
							</ul>
						</li>
						<?}?>
					<?		if($this->session->userdata('auth_code') >= 5){?>
						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-bar-chart-o"></i> <span>사이트 통계</span>
							</a>
							<ul>
								<li><a href="/admin/main/register_stat">회원가입 통계</a></li>
						<?		if($this->session->userdata('auth_code') >= 10){?>
								<li><a href="/admin/etc/payment_stat">결제내역통계</a></li>
						<?		}?>
								<li><a href="/admin/main/app_member_total">앱설치회원 통계</a></li>
								<!--li><a href="/admin/service_center/woman_event/woman_event_stat">여성회원이벤트통계</a></li-->
								<li><a href="/admin/service_center/reward_event/reward_event_stat">여성회원리워드통계</a></li>
								<li><a href="/admin/main/partner_stat">파트너 통계</a></li>
								<li><a href="/admin/main/partner_per_stat">파트너 전환률 통계</a></li>
								<li><a href="/admin/chatting/user_super_chat_log/chat_list">사용자 슈퍼채팅 로그</a></li>
								<li><a href="/admin/chatting/test">테스트</a></li>
								<li><a href="/admin/chatting/test/cs_question_second">테스트2</a></li>
							</ul>
						</li>
							<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-wrench"></i> <span>시스템설정</span>
							</a>
							<ul>
						<?		if($this->session->userdata('auth_code') >= 10){?>
								<li><a href="/admin/admin_setting/manager_set">관리자설정</a></li>
						<?		}?>
								<li><a href="/admin/admin_setting/agree">약관설정</a></li>
								<li><a href="/admin/admin_setting/banned">금지아이디설정</a></li>
								<li><a href="/admin/admin_setting/chat_preference">채팅환경설정</a></li>
							</ul>
						</li>
					</ul>
				<?}?>
				</nav>

				<span id="asidebg"><!-- aside fixed background --></span>
			</aside>
			<!-- /ASIDE -->


			<!-- HEADER -->
			<header id="header">

				<!-- Mobile Button -->
				<button id="mobileMenuBtn"></button>

				<!-- Logo -->
				<span class="logo pull-left">
					<a href="<?=ADMIN_DIR?>"><img src="<?=IMG_DIR?>/admin/top_logo.png" alt="admin panel" height="35" border=0 /></a>
				</span>

				<form method="get" action="#" class="search pull-left hidden-xs" onsubmit="return mem_search();">
					<div style="width:30%;float:left;padding-top:9px;">
						<select id="top_sfl" style="height:32px;padding:5px;background-color:#586566;color:#ffffff" class="form-control">
							<option value="m_userid">아이디</option>
							<option value="m_name">이름</option>
							<option value="m_nick">닉네임</option>
							<option value="m_jumin1">주민번호</option>
							<option value="m_hp">핸드폰번호</option>
							<option value="m_mail">메일주소</option>
							<option value="m_partner">파트너아이디</option>
						</select>
					</div>
					<div style="width:70%;float:left;padding-top:9px;">
						<input type="text" id="top_q" class="form-control" style="height:32px;padding:5px;background-color:#586566;color:#ffffff;border:1px soild #ffffff;" name="k" placeholder=" 회원검색" />
					</div>
				</form>

				<nav>

					<!-- OPTIONS LIST -->
					<ul class="nav pull-right">

						<!-- USER OPTIONS -->
						<li class="dropdown pull-left">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img class="user-avatar" alt="" src="<?=BS_ADM_DIR?>/images/noavatar.jpg" height="34" /> 
								<span class="user-name">
									<span class="hidden-xs">
										<?=$this->session->userdata('username')?> <i class="fa fa-angle-down"></i>
									</span>
								</span>
							</a>
							<ul class="dropdown-menu hold-on-click">
								<li><!-- my calendar -->
									<a href="calendar.html"><i class="fa fa-calendar"></i> 달력</a>
								</li>
								<li><!-- my inbox -->
									<a href="#"><i class="fa fa-envelope"></i> 메일
										<span class="pull-right label label-default">0</span>
									</a>
								</li>
								<li><!-- settings -->
									<a href="page-user-profile.html"><i class="fa fa-cogs"></i> 설정</a>
								</li>

								<li class="divider"></li>

								<li><!-- lockscreen -->
									<a href="page-lock.html"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li><!-- logout -->
									<a href="/auth/admin_logout"><i class="fa fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
						<!-- /USER OPTIONS -->

					</ul>
					<!-- /OPTIONS LIST -->

				</nav>

			</header>
			<!-- /HEADER -->