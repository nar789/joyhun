<div class="content">

	<div class="guide_top_area">
		
		<div class="guide_top_btn pointer" onclick="javascript:location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk'">
			<img src='<?=IMG_DIR?>/etc/google_ic_1.gif' class="margin_top_12 margin_right_9 ver_top">구글플레이 다운로드<img src='<?=IMG_DIR?>/etc/google_ic_2.gif' class="margin_top_16 margin_left_9 ver_top">
		</div>
	</div>



	<div id="wrapper" class="guide_content">
		<ul id="pagination" class="guide_menu">
			<li onclick="slideshow.pos(0)"><div class="slide_1"></div><p>채팅</p></li>
			<li onclick="slideshow.pos(1)"><div class="slide_2"></div><p>신청</p></li>
			<li onclick="slideshow.pos(2)"><div class="slide_3"></div><p>5분거리</p></li>
			<li onclick="slideshow.pos(3)"><div class="slide_4"></div><p>소개팅</p></li>
			<li onclick="slideshow.pos(4)"><div class="slide_5"></div><p>메뉴</p></li>
			<li onclick="slideshow.pos(5)"><div class="slide_6"></div><p>프로필</p></li>
		</ul>
		<div class="clear"></div>
		<div class="slide_area">
			<div class="sliderbutton"><img src='<?=IMG_DIR?>/etc/guide_left.gif' onclick="slideshow.move(-1)"></div>
				<div id="slider">
					<ul>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_01.png'></li>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_02.png'></li>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_03.png'></li>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_04.png'></li>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_05.png'></li>
						<li><img src='<?=IMG_DIR?>/etc/joy_banner_06.png'></li>
					</ul>
				</div>
				<div class="sliderbutton"><img src='<?=IMG_DIR?>/etc/guide_right.gif' onclick="slideshow.move(1)"/></div>
			</div>
		</div>
	</div>
	<div class="height_40"></div>
</div>


<script type="text/javascript">
var slideshow=new TINY.slider.slide('slideshow',{
	id:'slider',
	auto:3,
	resume:true,
	vertical:false,
	navid:'pagination',
	activeclass:'current',
	position:0
});
</script>