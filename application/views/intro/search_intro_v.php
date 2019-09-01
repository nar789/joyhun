<script>
		history.pushState(null, null, "?");

		$(window).on("popstate", function(event){
			window.location.replace("http://www.joyhunting.com");
		});
</script>

<div class="content" onclick="location.replace('/auth/register/');">

	<div class="left_main">

		<div class="search_header_bg">
			<div class="margin_top_108">
				<div class="text-center">
					<div class="select_box_border margin_right_5">
						<select class="width_90 height_34" id="m_type" name="m_type">
						<option value="남자">남자</option>
						<option value="여자">여자</option>
						</select>
					</div>
					<div class="select_box_border margin_right_5">
						<select class="width_110 height_34" id="m_type" name="m_type">
						<option value="20~30대">20~30대</option>
						<option value="30~40대">30~40대</option>
						<option value="40~50대">40~50대</option>
						<option value="50~60대">50~60대</option>
						<option value="60대이상">60대이상</option>
						</select>
					</div>
					<div class="select_box_border margin_right_5">
						<select class="width_110 height_34" id="m_type" name="m_type">
						<option value="서울 강남구">서울 강남구</option>
						<option value="서울 강북구">서울 강북구</option>
						<option value="서울 강동구">서울 강동구</option>
						<option value="서울 강서구">서울 강서구</option>
						<option value="서울 광진구">서울 광진구</option>
						<option value="서울 관악구">서울 관악구</option>
						<option value="서울 서초구">서울 서초구</option>
						<option value="서울 송파구">서울 송파구</option>
						<option value="서울 동대문구">서울 동대문구</option>
						<option value="서울 중랑구">서울 중랑구</option>
						<option value="서울 성동구">서울 성동구</option>
						<option value="서울 마포구">서울 마포구</option>
						<option value="서울 서대문구">서울 서대문구</option>
						<option value="서울 영등포구">서울 영등포구</option>
						<option value="서울 구로구">서울 구로구</option>
						</select>
					</div>
					<div class="select_box_border margin_right_10">
						<select class="width_166 height_34" id="m_type" name="m_type">
						<option value="돌싱들의 화끈한 대화">돌싱들의 화끈한 대화</option>
						<option value="우리둘만의 비밀채팅">우리둘만의 비밀채팅</option>
						<option value="드라이브가요~">드라이브가요~</option>
						<option value="영화한편 때리자~">영화한편 때리자~</option>
						<option value="고민있어요">고민있어요</option>
						</select>
					</div>
					<div class="block ver_top">
						<a href="#"><img src="<?=IMG_DIR?>/intro/search_btn_01.png"></a>
					</div>
				</div>
			</div>
			<div class="margin_top_87">
				<div class="text-center">
					<div class="select_box_border margin_right_5">
						<select class="width_110 height_34" id="m_type" name="m_type">
						<option value="이상형 키">이상형 키</option>
						<option value="160미만">160미만</option>
						<option value="160~165">160~165</option>
						<option value="165~170">165~170</option>
						<option value="170~175">170~175</option>
						<option value="175~180">175~180</option>
						<option value="180~185">180~185</option>
						<option value="185~190">185~190</option>
						<option value="190이상">190이상</option>
						</select>
					</div>
					<div class="select_box_border margin_right_5">
						<select class="width_126 height_34" id="m_type" name="m_type">
						<option value="공무원">공무원</option>
						<option value="CEO">CEO</option>
						<option value="보험설계사">정직원</option>
						<option value="일용직">일용직</option>
						<option value="회사원">회사원</option>
						</select>
					</div>
					<div class="select_box_border margin_right_10">
						<select class="width_248 height_34" id="m_type" name="m_type">
						<option value="같이 드라이브 할 사람 찾아요~">같이 드라이브 할 사람 찾아요~</option>
						<option value="오늘 같이 먹방찍으실분~">오늘 같이 먹방찍으실분~</option>
						<option value="진지한 만남을 원해요">진지한 만남을 원해요</option>
						<option value="돌아온 싱글 내반쪽을 찾아요">돌아온 싱글 내반쪽을 찾아요</option>
						<option value="지금 바로 만나실분~">지금 바로 만나실분~</option>
						</select>
					</div>
					<div class="block ver_top">
						<a href="#"><img src="<?=IMG_DIR?>/intro/search_btn_02.png"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="search_main_box">
			<div class="margin_bottom_15">
				<b class="font-size_16 color_eb5300">관리자가 인증한</b>
				<b class="font-size_16"> 인기회원!!</b>
				<a href="#">
					<div class="search_view_more">더보기 +</div>
				</a>
			</div>
			<div class="block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/intro/search_img_01.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">★파란하늘★ (27세)</span>
				</div>
				<div class="color_666 margin_top_10">
					전문직 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 명랑 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">좋은친구 찾습니다.</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_25 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/intro/search_img_02.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">스테파니리 (28세)</span>
				</div>
				<div class="color_666 margin_top_10">
					영어강사 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 차분함 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">커플이 되고 싶어요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_35 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/intro/search_img_03.gif"></div>
				<div class="margin_top_3">
					<span class="color_8a98f0 font_900">&#9794;</span><span class="color_333 margin_left_5">닥터슬럼프 (34세)</span>
				</div>
				<div class="color_666 margin_top_10">
					의사 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 포근함 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 배려
				</div>
				<div class="color_999 margin_top_5">결혼할 사람 찾아요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_25 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/intro/search_img_04.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">안개여왕 (29세)</span>
				</div>
				<div class="color_666 margin_top_10">
					사무직 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 세련 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">커플이 되고 싶어요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
		</div>
		<div class="search_bottom_box">
			<div class="font-size_16 margin_top_18 margin_left_20 block">
				<b>테마별 미팅대기자</b>
				<b>지금 나랑 미팅할래요??</b>
			</div>
			<div class="width_676 height_50 margin_auto pointer">
				<div class="search_bottom_tab_box">
					<a href="#"><div class="search_bottom_tab_01">친구만들기 <b>(2430명)</b></div></a>
					<a href="#"><div class="search_bottom_tab_02">차한잔 해요(986명)</div></a>
					<a href="#"><div class="search_bottom_tab_02">드라이브해요 (592명)</div></a>
					<a href="#"><div class="search_bottom_tab_03">영화 함께봐요 (429명)</div></a>
				</div>
				<div class="clear"></div>
			</div> 
			<div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_01.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="search_bottom_text_box_01">
							<div class="width_118 block"><span>커피프린스 (26세)</span></div>
							<div class="width_68 block"><b>지역 : </b><b>인천</b></div>
							<div class="width_104 block"><b>관심사: </b><b>연극/영화</b></div>
							<div class="width_69 block"><b>성격 : </b><b>쾌활</b></div>
							<div class="width_120 block"><b>상태 : </b><b>화려한 돌싱</b></div>
						</div>
						<div class="search_bottom_text_box_02 pointer">인천인데 같이 저녁먹구 영화어때요? 제가 쏠게요~~안심심해요??
						</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_02.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="search_bottom_text_box_01">
							<div class="width_120 block"><span>넘나더운것 (25세)</span></div>
							<div class="width_75 block"><b>지역 : </b><b>대전</b></div>
							<div class="width_110 block"><b>관심사: </b><b>술/게임</b></div>
							<div class="width_75 block"><b>성격 : </b><b>도도함</b></div>
							<div class="width_120 block"><b>상태 : </b><b>외로운 싱글</b></div>
						</div>
						<div class="search_bottom_text_box_02 pointer">맛있는거 먹고~ 술한잔 하는거 좋아해요ㅎㅎ 오세요~
						</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_03.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="search_bottom_text_box_01">
							<div class="width_120 block"><span>백만송이 (29세)</span></div>
							<div class="width_75 block"><b>지역 : </b><b>경기</b></div>
							<div class="width_110 block"><b>관심사: </b><b>인테리어</b></div>
							<div class="width_75 block"><b>성격 : </b><b>내조적</b></div>
							<div class="width_120 block"><b>상태 : </b><b>모태솔로</b></div>
						</div>
						<div class="search_bottom_text_box_02 pointer">나이 상관없어요~ 그냥 가볍게 만나서 부담없이 편하게 보고싶어요~
						</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_04.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="search_bottom_text_box_01">
							<div class="width_120 block"><span>내사랑그대 (27세)</span></div>
							<div class="width_75 block"><b>지역 : </b><b>서울</b></div>
							<div class="width_110 block"><b>관심사: </b><b>연극/연애</b></div>
							<div class="width_75 block"><b>성격 : </b><b>쾌활</b></div>
							<div class="width_120 block"><b>상태 : </b><b>자유로운 연애</b></div>
						</div>
						<div class="search_bottom_text_box_02 pointer">서로 배려하며 자유로운 연애를 꿈꾸고있습니다 ^^
						</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_05.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="search_bottom_text_box_01">
							<div class="width_120 block"><span>남자의자존심 (28세)</span></div>
							<div class="width_75 block"><b>지역 : </b><b>인천</b></div>
							<div class="width_110 block"><b>관심사: </b><b>차/시계</b></div>
							<div class="width_75 block"><b>성격 : </b><b>지적</b></div>
							<div class="width_120 block"><b>상태 : </b><b>완벽한 남자</b></div>
						</div>
						<div class="search_bottom_text_box_02 pointer">오늘 저녁에 쇼핑하러 갈래요?  A8 스파이더 대기중 ^^ 빵빵
						</div>
					</div>
					<div class="clera"></div>
				</div>
			</div>
		</div>
	</div>
	


	<!-- ## margin_top_8 end ## --><!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->
