<script>
		history.pushState(null, null, "?");

		$(window).on("popstate", function(event){
			window.location.replace("http://www.joyhunting.com");
		});
</script>

<div class="content" onclick="location.replace('/auth/register/');">

	<div class="left_main">		

		<!-- chatting_herder 시작 -->
		<div class="height_294">
			<div class="margin_top_mi_8">
				<ul class="chatting_top_tab">
					<li id="live_age_area_chat" class="area_age_tab_on">
						<p class="margin_top_12 font-size_14">실시간 지역/나이별 대기자</p>
					</li>
					<li id="live_theme_chat">
						<p class="margin_top_12 font-size_14">실시간 테마별 대기자</p>
					</li>
				</ul>
			</div>
			<div class="area_age_tab_content" id="age_area_chat_view">
				<div class="area_age_tab_box">
					<div class="area_age_tab_top">		
						 <img src="<?=IMG_DIR?>/chatting/area_age_girlimg_1_on.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_1_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_1.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_2.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_2_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_2.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_3.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_3_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_3.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_4.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_4_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_4.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_5.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_5_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_5.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_6.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_6_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_6.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_7.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_7_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_7.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_8.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_8_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_8.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_9.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_9_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_9.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_10.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_10_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_10.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_11.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_11_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_11.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_12.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_12_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_12.gif"'>	 
					</div>
					<div class="area_age_tab_bottom">
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn1_on.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn1_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn1.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn2.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn2_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn2.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn3.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn3_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn3.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn4.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn4_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn4.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn5.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn5_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn5.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_agebtn6.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn6_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_agebtn6.gif"'>
					</div>			
				</div>
			</div>
			<!-- <div class="area_age_tab_content" id="theme_chat_view">
				<div class="area_age_tab_box">
					<div class="area_age_tab_top">
						<img src="<?=IMG_DIR?>/chatting/live_ic_1.png" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_1_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_1.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_2.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_2_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_2.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_3.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_3_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_3.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_4.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_4_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_4.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_5.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_5_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_5.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_6.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_6_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_6.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_7.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_7_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_7.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_8.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_8_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_8.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_9.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_9_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_9.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_10.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_10_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_10.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_11.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_11_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_11.gif"'>
						<img src="<?=IMG_DIR?>/chatting/area_age_girlimg_12.gif" onmouseover='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_12_on.gif"' onmouseout='this.src="<?=IMG_DIR?>/chatting/area_age_girlimg_12.gif"'>
					</div>
				</div>
			</div> -->
		</div>	<!-- chatting_herder 끝 -->
		
		<!-- chatting_middle 시작 -->
		<div class="chatting_middle_box">
			<div class="margin_bottom_15">
				<b class="font-size_16 color_7a00ff">포토인증</b>
				<b class="font-size_16"> 친구만들기</b>
			</div>
			<div class="block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/chatting/chatting_main_img_01.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">완다엄마 (31세)</span>
				</div>
				<div class="color_666 margin_top_10">
					서비스직 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 샤프함 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">좋은친구 찾습니다.</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_25 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/chatting/chatting_main_img_02.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">개뿔이나뜯어 (25세)</span>
				</div>
				<div class="color_666 margin_top_10">
					전문직 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 섹시함 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">커플이 되고 싶어요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_35 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/chatting/chatting_main_img_03.gif"></div>
				<div class="margin_top_3">
					<span class="color_8a98f0 font_900">&#9794;</span><span class="color_333 margin_left_5">완전잘생김 (31세)</span>
				</div>
				<div class="color_666 margin_top_10">
					제조업 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 샤프함 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">미팅을 원해요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
			<div class="margin_left_25 block text-center">
				<div class="pointer"><img src="<?=IMG_DIR?>/chatting/chatting_main_img_04.gif"></div>
				<div class="margin_top_3">
					<span class="color_f08a8e font_900">&#9792;</span><span class="color_333 margin_left_5">안개여왕 (45세)</span>
				</div>
				<div class="color_666 margin_top_10">
					판매직 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 귀여움 <img src="<?=IMG_DIR?>/chatting/chatting_main_bg.gif"> 개방적
				</div>
				<div class="color_999 margin_top_5">커플이 되고 싶어요</div>
				<div class="margin_top_14">
					<img src="<?=IMG_DIR?>/chatting/chat_btn.gif" class="pointer">
				</div>
			</div>
		</div> <!-- chatting_middle 끝 -->

		<!-- 실시간 채팅 대기자 시작 -->
		<div class="chtting_bottom_box">
			<div>
				<b class="margin_left_22 margin_top_18 font-size_16">실시간 친구만들기</b>
				<div class="float_right font-size_11 margin_right_22 pointer"><b>+전체보기</b></div>
			</div>
			<div class="margin_top_10 chtting_bottom_bg"></div>
			<div id="chat_live">
				<div class="height_80 border_1_dcdcdc ">
					<div class=" block margin_top_10 margin_left_20"><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_01.gif"></a></div>
					<div class="chtting_text_box">
					<b>커피프린스</b><br>
					<p>부산 / 21세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					지금 접속했는데 님이 매칭회원이라고 뜨네요 ㅋㅋㅋㅋ인연인가...</div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_02.gif"></a></div>
					<div class="chtting_text_box">
					<b>청정원</b><br>
					<p>인천 / 21세</p></div>
					<div class="color_666 block ver_top margin_top_14 line-height_18 pointer">
					월미도에 거주하는 미혼여성입니다.160에 46키로 아담하고 날씬해요~<br>활발하고 명랑하며 개방적이에요~ 이해심많고 배려심 참을성도 많아요^^<br>
					어떤만남 원하시는지 미리 말걸때 얘기해주세요~</div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_03.gif"></a></div>
					<div class="chtting_text_box">
					<b>완다엄마</b><br>
					<p>인천 / 36세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					좋은 친구를 만나고싶어요~~ 나랑친구해줘요~~ </div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_04.gif"></a></div>
					<div class="chtting_text_box">
					<b>내가숯이다</b><br>
					<p>광주 / 23세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					영화보고싶다~ 나랑같이 영화보고 밥먹으러 안갈래요?</div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_05.gif"></a></div>
					<div class="chtting_text_box">
					<b>나는남자다</b><br>
					<p>제주 / 28세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					반가워요~ 저랑 채팅해요~ 오늘 너무 심심해요!!</div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_06.gif"></a></div>
					<div class="chtting_text_box">
					<b>★cj 은비★</b><br>
					<p>인천 / 21세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					안녕하세요^^ 오늘같은 불금 집에만 있을거에요? 저랑 놀아여</div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>
				<div class="height_80 border_1_dcdcdc">
					<div class=" block margin_top_10 margin_left_20""><a href="#"><img src="<?=IMG_DIR?>/chatting/chat_img_03.gif"></a></div>
					<div class="chtting_text_box">
					<b>완다엄마</b><br>
					<p>인천 / 36세</p></div>
					<div class="color_666 block ver_top margin_top_23 line-height_30 pointer">
					좋은 친구를 만나고싶어요~~ 나랑친구해줘요~~ </div>
					<div class="chatting_main_btn pointer">친구신청하기</div>
				</div>
				<div class="clear"></div>


			</div>
		</div> <!-- 실시간 채팅 끝 -->


	</div>
</div>

<div class="right_main">
		<?=$right_menu?>
	</div>

<script>
/*
var t = new js_rolling('chat_live');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start();



$(document).ready(function() {

	$("#age_area_chat_view").show();
	$("#theme_chat_view").hide(); 
	
	$("#live_age_area_chat").mouseover(function() {
		$(this).addClass('area_age_tab_on');
		$("#live_theme_chat").removeClass("area_age_tab_on");
	
	
		$("#age_area_chat_view").show();
		$("#theme_chat_view").hide();
		
	});
	
	$("#live_theme_chat").mouseover(function() {
		$(this).addClass('area_age_tab_on');
		$("#live_age_area_chat").removeClass("area_age_tab_on");
	
	
		$("#age_area_chat_view").hide();
		$("#theme_chat_view").show();
		
	});
	
}); */

</script>