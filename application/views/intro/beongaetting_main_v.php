<script>
		history.pushState(null, null, "?");

		$(window).on("popstate", function(event){
			window.location.replace("http://www.joyhunting.com");
		});
</script>

<div class="content" onclick="location.replace('/auth/register/');">

	<div class="left_main">
		<div class="bg_tab_box">
			<a href="#"><div class="bg_first_tab">
			<b>나이별 추천</b>
			</div></a>
			<a href="#"><div class="bg_tab_menu">
			<b> 관심사별 추천</b>
			</div></a> 
			<a href="#"><div class="bg_tab_menu">
			<b>지역별 추천</b>
			</div></a>
			<a href="#"><div class="bg_tab_list_menu">
			<b>시간별 추천</b>
			</div></a>
		</div>
		<div class="bg_top_box">
			<div class="width_690 margin_auto" id="bg_main_photo">
			<div class="block height_141  margin_top_10">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_01.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">대구 (31세)</div>
			</div>
			<div class="block height_141  margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_02.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">서울 (30세)</div>
			</div>
			<div class="block height_141 margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_03.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">광주 (27세)</div>
			</div>
			<div class="block height_141 margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_04.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">인천 (23세)</div>
			</div>
			<div class="block height_141 margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_05.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">대구 (34세)</div>
			</div>
			<div class="block height_141 margin_top_10">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_01_02.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">경남 (28세)</div>
			</div>
			<div class="block height_141 margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_01_01.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">제주 (25세)</div>
			</div>
			<div class="block height_141 margin_top_10 ">
				<div class="block width_142">
					<a href="#"><img src="<?=IMG_DIR?>/intro/bg_img_01_03.gif"></a>
				</div>
				<div class="color_333 text-center line_height_22">경기 (22세)</div>
			</div>
			</div>
		</div> <!-- left top end -->

		<!-- left middle start -->
		<div class="margin_top_8 height_250 border_1_36c5b8">
			<div class="height_44 bg_36c5b8 line-height_44">
				<span class="color_fff margin_left_18 font-size_16 blod">지역별 번개팅 대기자</span>
				<div class="block bg_fff height_11 width_1  margin_left_8 margin_right_4"></div>
				<div class="block"><b class="color_dbfffc">내가 원하는 지역의 번개팅만 골라 바로 만나요~</b></div>
				<div class="bg_right_btn pointer">
					<p>지역별 번개팅 더보기</p>
					<div class="bg_arrow_right"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="padding_10 block pointer">
				<img src="<?=IMG_DIR?>/intro/bg_town_tab.gif">
			</div>

			<!-- left list start -->
			<div class="bg_arrow_left ver_top margin_top_20 margin_right_5"></div>
			<div class="bg_left_box">
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_06.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>경기 파주시</p>
					</div>
				</div>
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_07.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>경기 안양시</p>
					</div>
				</div>
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_08.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>경기 수원시</p>
					</div>
				</div>
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_09.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>서울 서초구</p>
					</div>
				</div>
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_10.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>서울 관악구</p>
					</div>
				</div>
				<div class="bg_mid_box pointer">
					<div class="block margin_top_6 margin_left_6">
						<img src="<?=IMG_DIR?>/intro/bg_img_11.gif">
					</div>
					<div class="bg_mid_text_box">
						<p>보라돌이 (29)</p>
						<p>서울 강동구</p>
					</div>
				</div>
			</div> <!-- left list end -->
		</div> <!-- left middle end -->

		<div class="bg_live_box"> 
			<div class="bg_live_content">
				<div class="bg_live_content_box">
					<div class="block">현재 총 번개팅 신청자: 
					<span>234170</span>명</div>
					<div class="block margin_left_28 margin_right_28">인기지역: 
					<span>서울</span></div>
					<div class="block">만남조건 : 
					<span>술한잔 같이 할 사람</span></div>
				</div>
				<div class="search_select_second_02 margin_top_10">
				<select name="search_what">
					<option value="#">관심사</option>
					<option value="#">스마트폰</option>
					<option value="#">영화</option>
					<option value="#">음악</option>
					<option value="#">연예인</option>
					<option value="#">음식</option>
					<option value="#">여행</option>
					<option value="#">문화</option>
					<option value="#">언어</option>
					<option value="#">역사</option>
					<option value="#">이성</option>
					<option value="#">그림</option>
					<option value="#">IT</option>
				</select>
				</div>
				<div class="search_select_second_02 margin_top_10">
				<select name="search_what">
					<option value="#">성격</option>
					<option value="#">도발적인</option>
					<option value="#">차분한</option>
					<option value="#">배려있는</option>
					<option value="#">모범적인</option>
					<option value="#">내숭있는</option>
					<option value="#">내숭없는</option>
					<option value="#">조용한</option>
					<option value="#">활동적인</option>
					<option value="#">소심한</option>
					<option value="#">모험심강한</option>
					<option value="#">정열적인</option>
				</select>
				</div>
				<div class="search_select_second_02 margin_top_10">
				<select name="search_what">
					<option value="#">만남조건</option>
					<option value="#">술친구</option>
					<option value="#">드라이브</option>
					<option value="#">여행</option>
					<option value="#">이성친구</option>
					<option value="#">나만의비밀친구</option>
					<option value="#">진지한만남</option>
					<option value="#">영화보기</option>
					<option value="#">1:1데이트</option>
				</select>
				</div>
				<div class="search_select_second_02 margin_top_10">
				<select name="search_what">
					<option value="#">경기</option>
					<option value="#">서울</option>
					<option value="#">광주</option>
					<option value="#">인천</option>
					<option value="#">대전</option>
					<option value="#">대구</option>
					<option value="#">전남</option>
					<option value="#">전북</option>
					<option value="#">경남</option>
					<option value="#">경북</option>
					<option value="#">거제</option>
					<option value="#">제주도</option>
					<option value="#">독도</option>
				</select>
				</div>
				<div class="search_select_second_02 margin_top_10 margin">
				<select name="search_what">
					<option value="#">만남날짜</option>
					<option value="#">2016년6월1일</option>
					<option value="#">2016년6월2일</option>
					<option value="#">2016년6월3일</option>
					<option value="#">2016년6월4일</option>
					<option value="#">2016년6월5일</option>
					<option value="#">2016년6월6일</option>
					<option value="#">2016년6월7일</option>
					<option value="#">2016년6월8일</option>
					<option value="#">2016년6월9일</option>
					<option value="#">2016년6월10일</option>
				</select>
				</div>
			</div>
			<div class="bg_live_content_btn">번개팅 상대 찾기</div>
		</div><!-- end -->

		<div class="bg_bottom_box">
			<div class="font-size_16 margin_top_18 margin_left_20 block">
				<b>시간대별</b>
				<b>오늘의 스페셜 번개팅</b>
			</div>
			<div class="bg_bottom_btn_01 pointer">
				<p>지역별 번개팅 더보기</p>
				<div class="bg_arrow_right"></div>
			</div>
			<div class="width_676 height_58 margin_auto pointer">
				<img src="<?=IMG_DIR?>/intro/bg_live_tab.gif">
			</div>
			<div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_01.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="bg_bottom_text_box_01">
							<div class="width_120 block"><span>커피프린스 (26세)</span></div>
							<div class="width_110 block"><b>원하는지역 : </b> 인천</div>
							<div class="width_136 block"><b>원하는 시간 : </b> 20~02시</div>
							<div class="width_110 block"><b>관심사 :</b> 연극/영화</div>
							<div class="width_90 block"><b>성격 :</b> 쾌활</div>
						</div>
						<div class="bg_bottom_text_box_02 pointer">인천인데 같이 저녁먹구 영화어때요? 제가 쏠게요~~안심심해요??
						</div>
						<div class="bg_bottom_btn_02">번개팅 신청</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_02.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="bg_bottom_text_box_01">
							<div class="width_120 block"><span>노루엉덩이 (36세)</span></div>
							<div class="width_110 block"><b>원하는지역 : </b> 서울</div>
							<div class="width_136 block"><b>원하는 시간 : </b> 18시~02시</div>
							<div class="width_110 block"><b>관심사 :</b> 술/먹방</div>
							<div class="width_90 block"><b>성격 :</b> 화끈</div>
						</div>
						<div class="bg_bottom_text_box_02 pointer">맛있는거 먹고~ 술한잔 하는거 좋아해요ㅎㅎ 오세요~
						</div>
						<div class="bg_bottom_btn_02">번개팅 신청</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_03.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="bg_bottom_text_box_01">
							<div class="width_120 block"><span>따뜻한햇살 (22세)</span></div>
							<div class="width_110 block"><b>원하는지역 : </b> 서울</div>
							<div class="width_136 block"><b>원하는 시간 : </b> 20시~24시</div>
							<div class="width_110 block"><b>관심사 :</b> 골프</div>
							<div class="width_90 block"><b>성격 :</b> 명랑</div>
						</div>
						<div class="bg_bottom_text_box_02 pointer">나이 상관없어요~ 그냥 가볍게 만나서 부담없이 편하게 보고싶어요~
						</div>
						<div class="bg_bottom_btn_02">번개팅 신청</div>
					</div>
					<div class="clera"></div>
				</div>
				<div class="width_676 height_80 border_bottom_1_ececec margin_auto">
					<div class="width_71 float_left margin_top_10">
						<a href="#"><img src="<?=IMG_DIR?>/intro/chat_img_04.gif"></a>
					</div>
					<div class="width_605 float_right height_80">
						<div class="bg_bottom_text_box_01">
							<div class="width_120 block"><span>쑤기쑤기 (25세)</span></div>
							<div class="width_110 block"><b>원하는지역 : </b> 경남</div>
							<div class="width_136 block"><b>원하는 시간 : </b> 22시~01시</div>
							<div class="width_110 block"><b>관심사 :</b> 패션/뷰티</div>
							<div class="width_90 block"><b>성격 :</b> 애교</div>
						</div>
						<div class="bg_bottom_text_box_02 pointer">오늘 저녁에 삼겹살 먹고 쇼핑하러 같이 가주실분~~?!
						</div>
						<div class="bg_bottom_btn_02">번개팅 신청</div>
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


<script>
var t44 = new js_rolling('bg_main_photo');
t44.set_direction(4);
t44.move_gap = 1;	//움직이는 픽셀단위
t44.time_dealy = 40; //움직이는 타임딜레이
t44.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t44.start();

</script>
