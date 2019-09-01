<script>
		history.pushState(null, null, "?");

		$(window).on("popstate", function(event){
			window.location.replace("http://www.joyhunting.com");
		});
</script>

<div class="content" onclick="location.replace('/auth/register/');">

	<div class="left_main">

		<div class="met_conbox_1">
			<div class="met_con_title_box">
				<div class="met_con_title_left">
					<span>실시간</span><span class="font-size_16 color_333"> 미팅 신청자</span>
				</div>
				<div class="met_con_title_right" id="TTTLQKF">
					<ul>
						<li>
							<div id="sub_met_menu_over1" class="over" onmouseover="met_menu_over(1);start_setting(0)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu1.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over2" class="out" onmouseover="met_menu_over(2);start_setting(1)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu2.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over3" class="out" onmouseover="met_menu_over(3);start_setting(2)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu3.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over4" class="out" onmouseover="met_menu_over(4);start_setting(3)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu4.png"></a>
							</div>
						</li>
					</ul>
				</div>
			</div>		
			<div class="met_con_sub_box">
			
				<div class="met_con_sub_title">
					<ul>
						<li>
							<div><a href="#" class="font-size_14">20대 미팅참여방</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">30대 미팅참여방</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">40대 미팅참여방</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">50대 미팅참여방</a></div>
						</li>
					</ul>
				</div>

				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_01.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>단아한 비아</span> <span>(31세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>여행</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>서울/성북</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.17~05.19 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>걍 친하게 인사하구~ 지내요~</span>
								</div>
								<a href="#"><a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		
					</div>	

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_02.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">럽미럽미</span> <span id="met_age2">(38세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>영화보기</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>경기/안산</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.18~05.20 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>좋은친구 구해여~ 즐거운 친...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		
					</div>		
				</div>
				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_03.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>☆세븐스타☆</span> <span>(25세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>패션</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>충남/아산</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.20~05.20 (1일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>커피한잔 함께하며..좋은인연</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		
					</div>		
					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_04.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">따뜻한커피</span> <span id="met_age2">(30세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>재테크</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>경기/용인</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.20~05.22 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>마음씨가 따듯한분 어디...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		
					</div>	
				</div>		
				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_05.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>기분좋은날</span> <span>(28세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>음악</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>서울/강서</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.21~05.22 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>낯설지만 편안한 마음으로...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		
					</div>		
					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_06.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">꽃돼지냥냥</span> <span id="met_age2">(38세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>재테크</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>서울/중구</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.22~05.23 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>미팅을 신청해요. 저보다 어린...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		
					</div>		
				</div>		
				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_07.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>순수때론도도</span> <span>(21세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>요리</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>서울/서초</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.23~05.23 (1일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>한남동!! 지금 바로 만나요?!</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>	
					</div>		
					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_08.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">큐티섹시나희</span> <span id="met_age2">(28세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>쇼핑</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>인천/연수구</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.22~05.24 (3일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>소중한 시간을 값지게 보내고 ...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		
					</div>		
				</div>		
				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_09.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>달콤한유혹</span> <span>(28세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>영화보기</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>대구/달서</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.24~05.25 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>나이 좀 있고 편하게 해줄 사람...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		
					</div>		
					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_10.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">너는내운명</span> <span id="met_age2">(31세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>요가</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>부산/북구</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.25~05.25 (1일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>외모보단 맘이 착한분을 기다...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		
					</div>		
				</div>		
				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_11.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span>애교만점</span> <span>(26세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>온라인게임</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>경기/안산</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.25~05.26 (2일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>미팅하실 분~손 이쁘게 들어봥</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		
					</div>		
					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" class="image">
								<img src="<?=IMG_DIR?>/meeting/met_12.gif">
							</div>
							<div class="met_content_top pointer">
								<p><span id="met_nick2">산타손녀</span> <span id="met_age2">(23세)</span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span>요리</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span>경기/안산</span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span>05.27~05.27 (1일간)</span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title pointer">
									<span>오늘 하루가 아닌 꾸준한 만남...</span>
								</div>
								<a href="#"><img src="<?=IMG_DIR?>/meeting/met_btn.gif"></a>
								<div class="icon_btn_bababa met_main_love_ic">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		<!-- ## met_content_box end ## -->
					</div>		<!-- ## met_content end ## -->
				</div>		<!-- ## met_con_content_box end ## -->

			</div>		<!-- ## met_con_title_left end ## -->
		</div>		<!--	## met_conbox_1 end ##	-->
	</div>

	<!-- ## margin_top_8 end ## --><!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->
