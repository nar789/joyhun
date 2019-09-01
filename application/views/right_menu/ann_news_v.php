<div class="height_210 height_304 margin_top_8 border_1_dcdcdc">
	<div class="height_38 bg_f6f6f6 border_bottom_1_ececec">
		<div class="margin_left_4 block"><img src="<?=IMG_DIR?>/intro/news_ic_01.png"></div>
		<div class="block margin_top_11 ver_top">
			<b class="font-size_15">내 앤들의 </b>
			<b class="font-size_15 color_42d0ff">반가운 소식</b>
			<div class="margin_left_30 block ver_text_top pointer"><img src="<?=IMG_DIR?>/intro/news_ic_02.png"></div>
		</div>
	</div>
	<div class="height_234" id="ann_news">
		<div class="news_box">
			<a href="#"><img src="<?=IMG_DIR?>/intro/news_img_40x40_02.gif"></a>
			<div class="news_text_box pointer">
				<p>귀염둥이현숙</p>
				<p>님이</p>
				<p>반가운 인사</p>
				<p>를</p><br>
				<p>등록하였습니다.</p>
			</div>
		</div>
		<div class="news_box">
			<a href="#"><img src="<?=IMG_DIR?>/intro/news_img_40x40_03.gif"></a>
			<div class="news_text_box pointer">
				<p>코코</p>
				<p>님이</p>
				<p>프로필 사진</p>
				<p>을</p><br>
				<p>등록하였습니다.</p>
			</div>
		</div>
		<div class="news_box">
			<a href="#"><img src="<?=IMG_DIR?>/intro/news_img_40x40_03.gif"></a>
			<div class="news_text_box pointer">
				<p>너의눈코입</p>
				<p>님이</p>
				<p>반가운 인사</p>
				<p>를</p><br>
				<p>등록하였습니다.</p>
			</div>
		</div>
		<div class="news_box">
			<a href="#"><img src="<?=IMG_DIR?>/intro/news_img_40x40_04.gif"></a>
			<div class="news_text_box pointer">
				<p>누리마루</p>
				<p>님이</p>
				<p>프로필 사진</p>
				<p>을</p><br>
				<p>등록하였습니다.</p>
			</div>
		</div>
		<div class="news_box">
			<a href="#"><img src="<?=IMG_DIR?>/intro/news_img_40x40_04.gif"></a>
			<div class="news_text_box pointer">
				<p>누리마루</p>
				<p>님이</p>
				<p>프로필 사진</p>
				<p>을</p><br>
				<p>등록하였습니다.</p>
			</div>
		</div>
	</div>
	<div class="news_btn">
		<span>새소식 새로고침하기</span>
		<div class="block margin_top_5 ver_top"><img src="<?=IMG_DIR?>/intro/news_ic_03.png"></div>
	</div>
</div>

<script>

var t = new js_rolling('ann_news');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start(); 

</script>