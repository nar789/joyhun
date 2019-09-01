$(document).ready(function(){

	for (i=1; i<6;i++){
		if ($("#live_slide_"+i+" > div").width() > '300')
		{
			var t = new js_rolling('live_slide_'+i);
			t.set_direction(4);
			t.move_gap = 1;	//움직이는 픽셀단위
			t.time_dealy = 30; //움직이는 타임딜레이
			t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
			t.start();
		}
	}

	$('.autoplay').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
	});

});


