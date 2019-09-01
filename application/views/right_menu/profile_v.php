
	<div class="border_1_dcdcdc margin_top_8">
		<div class="right_my_title bg_fff9d2">
			<p class="color_ea3c3c blod font-size_14">나의 채팅내역</p>
		</div>
		<div class="right_my_chat_content">
			<p>총 채팅 신청</p>
			<p><?=@$total_chat_cnt?></p>
			<p>성공한 채팅</p>
			<p><?=@$total_chat_accept?></p>
			<div class="right_chat_success">
				<p>채팅 성공률</p>
				<p class="blod"><?=$total_chat_per?></p>
			</div>
		</div>
	</div>

	<div class="border_1_dcdcdc margin_top_8">
		<div class="right_my_title bg_eeeeee">
			<p class="color_333 blod font-size_14">나의 채팅관리함</p>
		</div>
	
		<div class="m_chat_list_box">
			<div class="border_bottom_1_ededed height_26">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_icon.png" class="margin_left_3"><a href="/profile/my_chat/chatting_list" class="font-size_14"> 채팅함</a>
				</div>
			</div>
			<div class="border_bottom_1_ededed height_65 margin_top_10">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_1.gif"><a href="/profile/message" class="font-size_14" autoclass="/profile/message" ex_serach="/profile/message/all,/profile/message/send_messge,/profile/message/recv_messge">메세지</a>
				</div>
				<ul class="third_depth">
					<li><a href="/profile/message/send_message" autoclass="/profile/message/send_message">- 보낸메세지</a></li>
					<li><a href="/profile/message/recv_message" autoclass="/profile/message/recv_message">- 받은메세지</a></li>
				</ul>
			</div>
			<div class="border_bottom_1_ededed height_65 margin_top_10">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_2.gif"><a href="/profile/my_friend/send_friend" class="font-size_14" autoclass="/profile/my_anne" ex_serach="/profile/my_friend/together_friend,/profile/my_friend/send_friend">친구</a>
				</div>
				<ul class="third_depth">
					<li><a href="/profile/my_friend/send_friend" fourdepth="0" autoclass="/profile/my_friend/together_friend">- 내친구</a></li>
					<li><a href="/profile/my_anne/send_anne" autoclass="/profile/my_anne">- 내앤</a></li>
				</ul>
			</div>
			<div class="border_bottom_1_ededed margin_top_10 height_72">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_3.gif"><a href="/profile/jjim/send_jjim" class="font-size_14" autoclass="/profile/jjim/my_visitant">찜</a>
				</div>
				<ul class="third_depth">
					<li><a href="/profile/jjim/send_jjim" ex_serach="/profile/jjim/send_jjim,/profile/jjim/receive_jjim">- 찜 목록</a></li>
					<li><a href="/profile/jjim/my_visitant" autoclass="/profile/jjim/my_visitant">- 내 프로필 방문자</a></li>
				</ul>
			</div>

			<div class="margin_top_10 height_63">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_4.gif"><a href="/profile/propose/send_propose" class="font-size_14">프로포즈</a>
				</div>
				<ul class="third_depth">
					<li><a href="/profile/propose/send_propose">- 보낸 프로포즈</a></li>
					<li><a href="/profile/propose/receive_propose">- 받은 프로포즈</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="border_1_dcdcdc margin_top_8">
		<div class="right_my_title bg_eeeeee">
			<p class="color_333 blod font-size_14">나의 설정함</p>
		</div>
	
		<div class="m_chat_list_box">
			<div class="border_bottom_1_ededed height_26">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_5.gif"><a href="/profile/point/point_list" class="font-size_14" ex_serach="/profile/point/point_list,/profile/point/charge_list">포인트/충전</a>
				</div>
			</div>

			<div class="height_22 margin_top_10">
				<div class="two_depth">
					<img src="<?=IMG_DIR?>/profile/chat_right_6.gif"><a href="/profile/my_alarm/alarm_list" class="font-size_14" autoclass="">알림</a>
				</div>
			</div>

		</div>
	</div>
