

/* 지역/나이채팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_login");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_join_date");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_activity");	});
	$("#tab_menu4").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_activity_cnt");	});
	$("#tab_menu5").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_like_cnt");	});
	$("#tab_menu6").click(function() {	$(location).attr('href',"/chatting/age_chatting/order_manner");	});
});