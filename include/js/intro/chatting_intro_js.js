
var t = new js_rolling('new_member_live');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start();

var s = new js_rolling('new_member_age');
s.set_direction(1);
s.move_gap = 1;	//움직이는 픽셀단위
s.time_dealy = 60; //움직이는 타임딜레이
s.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
s.start();

var n = new js_rolling('new_member_area');
n.set_direction(1);
n.move_gap = 1;	//움직이는 픽셀단위
n.time_dealy = 60; //움직이는 타임딜레이
n.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
n.start();


$(document).ready(function() {

	$("#new_member_live").show();
	$("#new_member_age").hide();
	$("#new_member_area").hide();

	$("#popularity").click(function(){
		$(this).addClass('new_member_tab_on');
		$("#age").removeClass("new_member_tab_on");
		$("#area").removeClass("new_member_tab_on");

		$("#new_member_live").show();
		$("#new_member_age").hide();
		$("#new_member_area").hide();
	});

	$("#age").click(function(){
		$(this).addClass('new_member_tab_on');
		$("#popularity").removeClass("new_member_tab_on");
		$("#area").removeClass("new_member_tab_on");

		$("#new_member_live").hide();
		$("#new_member_age").show();
		$("#new_member_area").hide();

	});

	$("#area").click(function(){
		$(this).addClass('new_member_tab_on');
		$("#popularity").removeClass("new_member_tab_on");
		$("#age").removeClass("new_member_tab_on");

		$("#new_member_live").hide();
		$("#new_member_age").hide();
		$("#new_member_area").show();

	});

});