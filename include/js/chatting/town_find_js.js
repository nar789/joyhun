

/* 지역/나이채팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_login"+para);	
	});
	$("#tab_menu2").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_join_date"+para);	
	});
	$("#tab_menu3").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_activity_v"+para);	
	});
	$("#tab_menu4").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_activity_cnt"+para);	
	});
	$("#tab_menu5").click(function() {
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_like_cnt"+para);	
	});
	$("#tab_menu6").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/town_find/order_manner"+para);	
	});


});


//5분거리 회원 검색
function m_area_search(){
	
	if($("#town_area_1").val() == ""){ alert("시, 도를 선택하세요."); $("#town_area_1").focus(); return;}
	if($("#town_area_2").val() == ""){ alert("구, 군을 선택하세요."); $("#town_area_2").focus(); return;}

	var m_val1 = "", m_val2 = "";

	m_val1 = encodeURIComponent($("#town_area_1").val());		//시, 도
	m_val2 = encodeURIComponent($("#town_area_2").val());		//구, 군
		
	location.href = "/chatting/town_find/order_login/val1/"+m_val1+"/val2/"+m_val2;
}

//5분거리 회원검색 메뉴
//url 파라미터만 남기기
function para_url(url){
	
	//www가 있을경우와 없을경우
	if($(location).attr('host').indexOf('www') == "-1"){
		var v_para = url.replace("http://joyhunting.com/chatting/town_find/", "").replace("order_login", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}else{
		var v_para = url.replace("http://www.joyhunting.com/chatting/town_find/", "").replace("order_login", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}
	
	return v_para;
}