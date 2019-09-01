<div class="content">

	<div class="left_main">
		<div class="charge_area">
			<div class="padding_30 charge_box">
				<div class="radio_box charge_selec">
					<span><input type="radio" id="pay_chk" name="pay_chk" value="33000" checked><label for="" class="margin_top_10"></label></span>
					<span><b class="color_ea3c3c blod font-size_15">1년 3만원</b> <b class="color_666 font-size_15"> + 1500포인트 지급</b><b class="color_ccc">(부가세 별도)</b></span>
				</div>

				<b class="color_333 font-size_16 block margin_top_30">결제방법을 선택해 주세요.</b>
				<div class="margin_top_10 charge_btn">
					<div onclick="javascript:do_payment('hp', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_1.gif"><b class="color_fff font-size_16 ver_top">휴대폰결제</b>
					</div>
					<div onclick="javascript:do_payment('card', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_2.gif"><b class="color_fff font-size_16 ver_top">카드결제</b>
					</div>
					<div onclick="javascript:do_payment('account', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_3.gif"><b class="color_fff font-size_16 ver_top">실시간계좌이체</b>
					</div>
					<div onclick="javascript:do_payment('pb', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_5.gif"><b class="color_fff font-size_16 ver_top">일반전화</b><b class="color_fff ver_top">(받기)</b>
					</div>
					<div onclick="javascript:do_payment('tp', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_6.gif"><b class="color_fff font-size_16 ver_top">일반전화</b><b class="color_fff ver_top">(걸기)</b>
					</div>
					<div onclick="javascript:do_payment('bk', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_9.gif"><b class="color_fff font-size_16 ver_top">가상계좌</b>
					</div>
					<div onclick="javascript:mu_account_deposit('mu', '1001');">
						<img src="<?=IMG_DIR?>/profile/payment_9.gif"><b class="color_fff font-size_16 ver_top">무통장입금</b>
					</div>
				</div>
			</div>
		</div>

		<div class="boon_area">
			<div class="padding_top_35 text-center">
				<b class="color_fe8eab font-size_28">정회원만의 다양한 혜택을 누리세요!!</b>
				<p class="color_f088a3 font-size_13 line-height_18 margin_top_5">조이헌팅 대표메뉴 미팅신청, 실시간채팅, 음악채팅<br>이외에도 다양한 서비스들로 가득합니다.</p>
			</div>
			<div class="text-center margin_top_8">
				<a href="/chatting/music_chatting"><img src="<?=IMG_DIR?>/profile/point_circle_1.gif"></a><a href="/friend/friend_add/make_friend"><img src="<?=IMG_DIR?>/profile/point_circle_2.gif"></a><a href="/movie"><img src="<?=IMG_DIR?>/profile/point_circle_3.gif"></a>
			</div>
			<div class="margin_left_40">
				<div class="meeting_box">
					<img src="<?=IMG_DIR?>/profile/txt_1.gif">
					<p class="color_555 line-height_16">지역, 시간 등 나에게 맞는 조건으로<br>미팅을 등록해보세요.</p>
					<div class="meeting_btn" onclick="location.href='/meeting';">미팅등록</div>
				</div>
				<div class="meeting_date">
					<img src="<?=IMG_DIR?>/profile/txt_2.gif">
					<div class="float_right line-height_29 margin_right_4"><span class="color_555">실시간 미팅등록자 </span><span class="color_ea3c3c">198명</span></div>
					<div class="clear"></div>
					<div class="margin_top_11">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_01.gif"></a>
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_06.gif"></a>
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_03.gif"></a>
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_04.gif"></a>
					</div>
				</div>
				<div class="width_303 block margin_top_35">
					<img src="<?=IMG_DIR?>/profile/txt_3.gif" class="margin_bottom_6">
					<div class="real_time" onclick="location.href='/chatting/find_chatting/find_chatting'">
						<div class="float_left color_333 font-size_14 blod padding_left_20">나이별 채팅</div>
						<div class="float_right color_fff blod margin_right_15">입장하기 <img src="<?=IMG_DIR?>/profile/go_ic.png" class="ver_sub"></div>
						<div class="clear"></div>
					</div>
					<div class="real_time" onclick="location.href='/chatting/find_chatting/find_chatting'">
						<div class="float_left color_333 font-size_14 blod padding_left_20">지역별 채팅</div>
						<div class="float_right color_fff blod margin_right_15">입장하기 <img src="<?=IMG_DIR?>/profile/go_ic.png" class="ver_sub"></div>
						<div class="clear"></div>
					</div>
					<div class="real_time" onclick="location.href='/chatting/find_chatting/find_chatting'">
						<div class="float_left color_333 font-size_14 blod padding_left_20">테마별 채팅</div>
						<div class="float_right color_fff blod margin_right_15">입장하기 <img src="<?=IMG_DIR?>/profile/go_ic.png" class="ver_sub"></div>
						<div class="clear"></div>
					</div>

					<hr class="point_hr">
					
					<div class="music_chat" onclick="location.href='/chatting/music_chatting'">
						<div class="float_left color_333 font-size_14 blod padding_left_20">음악 채팅방</div>
						<div class="float_right color_fff blod margin_right_15">입장하기 <img src="<?=IMG_DIR?>/profile/go_ic.png" class="ver_sub"></div>
						<div class="clear"></div>
					</div>
					<div class="music_chat" onclick="location.href='/chatting/music_chatting'">
						<div class="float_left color_333 font-size_14 blod padding_left_20">음악 듣기방</div>
						<div class="float_right color_fff blod margin_right_15">입장하기 <img src="<?=IMG_DIR?>/profile/go_ic.png" class="ver_sub"></div>
						<div class="clear"></div>
					</div>

				</div>
				<div class="block ver_top margin_top_35">
					<img src="<?=IMG_DIR?>/profile/txt_4.gif">
					<div class="area_real_chat">
						<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/intro/bg_img_01_04.gif"></a>
						<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/intro/bg_img_01_02.gif"></a>
					</div>
				</div>

				<div class="width_303 block margin_top_40">
					<img src="<?=IMG_DIR?>/profile/txt_5.gif" class="margin_bottom_6">
					<div class="marry_area pointer" onclick="location.href='/open_marry/open_marry/open_guhon_list'">
						<div class="float_left margin_left_21">
							<img src="<?=IMG_DIR?>/profile/marry_ic1.gif" class="margin_top_mi_3">
						</div>
						<div class="float_right width_165">
							<b class="color_333 font-size_16">같이 살아 볼래요?</b>
							<p class="color_999 font-size_11">289,501명</p>
						</div>
						<div class="clear"></div>
					</div>

					<div class="marry_area margin_top_5 pointer" onclick="location.href='/open_marry/marriage/marry_list'">
						<div class="float_left margin_left_21">
							<img src="<?=IMG_DIR?>/profile/marry_ic1.gif" class="margin_top_mi_3">
						</div>
						<div class="float_right width_165">
							<b class="color_333 font-size_16">배우자를 찾습니다!</b>
							<p class="color_999 font-size_11">267,412명</p>
						</div>
						<div class="clear"></div>
					</div>

					<div class="marry_area margin_top_5 pointer" onclick="location.href='/open_marry/remarriage/remarriage_list'">
						<div class="float_left margin_left_21">
							<img src="<?=IMG_DIR?>/profile/marry_ic2.gif" class="margin_top_mi_3">
						</div>
						<div class="float_right width_165">
							<b class="color_333 font-size_16">다시 사랑하고 싶어요</b>
							<p class="color_999 font-size_11">248,063명</p>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="block ver_top margin_top_10 area_map">
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_1.png" alt="서울"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_2.png" alt="인천/경기"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_3.png" alt="강원"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_4.png" alt="대구/경북"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_5.png" alt="부산/경남"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_6.png" alt="광주/전남"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_7.png" alt="전주/전북"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_8.png" alt="대전/충남"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_9.png" alt="청주/충북"></a>
					<a href="/chatting/find_chatting/find_chatting"><img src="<?=IMG_DIR?>/profile/point_area_10.png" alt="제주/해외"></a>
				</div>
			</div>			
		</div>
	</div>
	<!-- ## left_main end ## -->
	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->