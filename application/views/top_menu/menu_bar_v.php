	<div class="menu">
		<div id="drop_btn" class="pointer">
			<img src="<?=IMG_DIR?>/l_menu_on.gif" id="dropthe">
		</div>
		<div class="menu_left" id="menu_left">
			<ul>
				<li><a href="/meeting<?if(IS_LOGIN){?>/beongae/all<?}?>">미팅신청</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<!-- <li><a href="/chatting/age_chatting/order_login">조이채팅</a></li> -->
				<li><a href="/chatting/find_chatting/find_chatting">조이채팅</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<li><a href="/photo/permission/new_photo">포토미팅</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<li><a href="/friend/friend_add/make_friend">친구만들기</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<li><a href="/profile/main/user">프로필</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<li><a href="/open_marry">공개구혼</a></li>
				<li><img src="<?=IMG_DIR?>/left_menu_bar.gif"></li>
				<li><a href="/secret/talkchat/talk_list">비밀톡챗</a></li>
			</ul>
		</div>

		<div class="menu_right" id="menu_right">
			<ul>
				<li><a href="/blindmeet/blind" class="<?=$right_top_on1?>">소개팅</a></li>
				<li><img src="<?=IMG_DIR?>/right_menu_bar.gif"></li>
				<li><a href="/etc/talk/talk_list" class="<?=$right_top_on2?>">토크</a></li>
				<li><img src="<?=IMG_DIR?>/right_menu_bar.gif"></li>
				<li><a href="/gift_shop/gift/gift_list" class="<?=$right_top_on3?>">선물상점</a></li>
			</ul>
		</div>

		<!-- 전체 펼침메뉴 -->
		<div class="box-sh" id="box-sh">

			<div class="submenu">
				<ul>
					<li><a href="/meeting/beongae/all">번개팅</a></li>
					<li><a href="/meeting/beongae/all">전체 번개팅등록회원</a></li>
					<li><a href="/meeting/beongae/today">오늘마감 번개팅</a></li>
					<li><a href="/meeting/beongae/ing">진행중인 번개팅</a></li>
					<li><a href="/meeting/beongae/mypage">내 번개팅관리함</a></li>
					<li class="color_999"><a href="/meeting/beongae/mypage">- 내가등록한번개팅</a></li>
					<li class="color_999"><a href="/meeting/beongae/mypage_recv">- 받은번개팅</a></li>
					<li class="color_999"><a href="/meeting/beongae/mypage_send">- 보낸번개팅</a></li>
				</ul>
				<ul>
					<li><a href="/meeting/smsting/all">문자팅</a></li>
					<li><a href="/meeting/smsting/all">전체 문자팅등록회원</a></li>
					<li><a href="/meeting/smsting/min5_friends">같은동네 친구</a></li>
					<li><a href="/meeting/smsting/peer_friends">또래 친구</a></li>
					<li><a href="/meeting/smsting/my_smsting_recv">내 문자팅관리함</a></li>
					<li class="color_999"><a href="/meeting/smsting/my_smsting_recv">- 받은문자팅</a></li>
					<li class="color_999"><a href="/meeting/smsting/my_smsting_send">- 보낸문자팅</a></li>
					<li class="color_999"><a href="/meeting/smsting/my_smsting_setting">- 수신설정관리</a></li>
				</ul>
				<ul>
					<li><a href="/meeting/socialting/social_list">소셜팅</a></li>
				</ul>
				<ul>
					<li><a href="/meeting/jjack/jjack_list">짝/애정촌</a></li>
					<li><a href="/meeting/jjack/jjack_list">애정촌리스트</a></li>
					<li><a href="/meeting/jjack/mypage_recv">내 프로포즈관리</a></li>
					<li class="color_999"><a href="/meeting/jjack/mypage_recv">- 받은 짝대기</a></li>
					<li class="color_999"><a href="/meeting/jjack/mypage_send">- 보낸 짝대기</a></li>
				</ul>
			</div>

			<div class="submenu">
				<!-- <ul>
					<li><a href="#">실시간 지역/나이채팅</a></li>
					<li><a href="#">지역나이채팅</a></li>
					<li><a href="#">테마채팅</a></li>
				</ul> -->
				<ul>
					<li><a href="/chatting/music_chatting">음악채팅</a></li>
				</ul>
				<ul>
					<li><a href="/chatting/find_chatting/find_chatting">회원검색</a></li>
					<li><a href="/chatting/find_chatting/find_chatting">최근접속순</a></li>
					<li><a href="/chatting/find_chatting/order_join_date">최근가입순</a></li>
					<li><a href="/chatting/find_chatting/order_activity_v">활동량많은순</a></li>
					<li><a href="/chatting/find_chatting/order_activity_cnt">활동현황순</a></li>
					<li><a href="/chatting/find_chatting/order_like_cnt">인기지수순</a></li>
					<li><a href="/chatting/find_chatting/order_manner">매너점수순</a></li>
				</ul>
				<ul>
					<li><a href="/chatting/invite/invite">이상형초대</a></li>
					<li><a href="/chatting/invite/invite">최근접속순</a></li>
					<li><a href="/chatting/invite/order_join_date">최근가입순</a></li>
					<li><a href="/chatting/invite/order_activity_v">활동량많은순</a></li>
					<li><a href="/chatting/invite/order_activity_cnt">활동현황순</a></li>
					<li><a href="/chatting/invite/order_like_cnt">인기지수순</a></li>
					<li><a href="/chatting/invite/order_manner">매너점수순</a></li>
				</ul>
				<ul>
					<li><a href="/chatting/town_find/order_login">5분거리 친구찾기</a></li>
					<li><a href="/chatting/town_find/order_login">최근접속순</a></li>
					<li><a href="/chatting/town_find/order_join_date">최근가입순</a></li>
					<li><a href="/chatting/town_find/order_activity_v">활동량많은순</a></li>
					<li><a href="/chatting/town_find/order_activity_cnt">활동현황순</a></li>
					<li><a href="/chatting/town_find/order_like_cnt">인기지수순</a></li>
					<li><a href="/chatting/town_find/order_manner">매너점수순</a></li>
				</ul>
				 <ul>
					-<li><a href="/joy_chatting/super_chat">슈퍼채팅신청</a></li>
				</ul> 
			</div>


			<div class="submenu">
				<ul>
					<li><a href="/photo/permission/new_photo">인증사진</a></li>
					<li><a href="/photo/permission/new_photo">신규 인증사진</a></li>
					<li><a href="/photo/permission/login">최근 로그인한 회원</a></li>
					<li><a href="/photo/permission/change">최근 사진변경 회원</a></li>
				</ul>
				<ul>
					<li><a href="/photo/bestphoto/photo_list">베스트사진</a></li>
				</ul>
			</div>

			<div class="submenu">
				<ul>
					<li><a href="/friend/friend_add/make_friend">친구만들기</a></li>
				</ul>
				<ul>
					<li><a href="/friend/anne_add/make_anne">앤 만들기</a></li>
				</ul>
				<ul>
					<li><a href="/friend/vote_poll/poll_list">공감 Poll</a></li>
				</ul>
			</div>

			<div class="submenu">
				<!-- <ul>
					<li><a href="/profile/main/user">프로필</a></li>
				</ul> -->
				<ul>
					<li><a href="/profile/my_info">내정보관리</a></li>
				</ul>
				<ul>
					<li><a href="/profile/my_chat/chatting_list">채팅함</a></li>
				</ul>
				<ul>
					<li><a href="/profile/message">메세지</a></li>
					<li><a href="/profile/message/send_message">보낸메시지</a></li>
					<li><a href="/profile/message/recv_message">받은메세지</a></li>
				</ul>
				<ul>
					<li><a href="/profile/my_friend/send_friend">친구</a></li>
					<li><a href="/profile/my_friend/send_friend">내친구</a></li>
					<li><a href="/profile/my_anne/send_anne">내앤</a></li>
				</ul>
				<!--<ul>
					<li><a href="/profile/my_anne/send_anne">앤</a></li>
					<li><a href="/profile/my_anne/send_anne">내가 등록한 앤</a></li>
					<li><a href="/profile/my_anne/receive_anne">나를 등록한 앤</a></li>
				</ul>-->
				<ul>
					<li><a href="/profile/jjim/send_jjim">찜</a></li>
					<li><a href="/profile/jjim/send_jjim">찜 목록</a></li>
					<li><a href="/profile/jjim/my_visitant">내 프로필 방문자</a></li>
				</ul>
				<ul>
					<li><a href="/profile/propose/send_propose">프로포즈</a></li>
					<li><a href="/profile/propose/send_propose">보낸 프로포즈</a></li>
					<li><a href="/profile/propose/receive_propose">받은 프로포즈</a></li>
				</ul>
				<ul>
					<li><a href="/profile/point/point_list">포인트/충전</a></li>
					<li><a href="/profile/point/point_list">포인트 사용내역</a></li>
					<li><a href="/profile/point/charge_list">포인트 충전내역</a></li>
					<li><a href="/profile/point/point_charge">포인트 충전하기</a></li>
				</ul>
				<ul>
					<li><a href="/profile/my_alarm/alarm_list">알림</a></li>
				</ul>
			</div>

			<div class="submenu">
				<ul>
					<li><a href="/open_marry">공개구혼</a></li>
					<li><a href="/open_marry/marriage/marry_list">결혼신청</a></li>
					<li><a href="/open_marry/remarriage/remarriage_list">재혼신청</a></li>
					<li><a href="/open_marry/open_marry/open_guhon_list">공개구혼</a></li>
					<!--<li><a href="#">결혼상담</a></li>-->
				</ul>
			</div>

			<div class="submenu">
			</div>

		</div>
		<!-- ## box-sh end -->
		<!-- 전체 펼침메뉴 끝-->

	</div>