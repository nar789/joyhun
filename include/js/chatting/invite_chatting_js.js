

/* 채팅상대찾기 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/invite"+para);	
	});
	$("#tab_menu2").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/order_join_date"+para);	
	});
	$("#tab_menu3").click(function() {
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/order_activity_v"+para);	
	});
	$("#tab_menu4").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/order_activity_cnt"+para);	
	});
	$("#tab_menu5").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/order_like_cnt"+para);	
	});
	$("#tab_menu6").click(function() {
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/invite/order_manner"+para);	
	});
});



function invite_request(){
	$.get('/chatting/invite/invite_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 460});
	});
}


//이상형 찾기 검색
function ideal_search(){
	
	if($("#m_conregion").val() == ""){ alert("지역을 선택하세요."); $("#m_conregion").focus(); return;}

	var m_val1 = "", m_val2 = "", m_val3 = "";

	m_val1	= encodeURIComponent($("#m_conregion").val());
	m_val2	= encodeURIComponent($("#m_age").val());
	m_val3	= encodeURIComponent($("#m_sex").val());

	location.href = "/chatting/invite/invite/val1/"+m_val1+"/val2/"+m_val2+"/val3/"+m_val3;
}

//이상형찾기검색메뉴
//url 파라미터만 남기기
function para_url(url){
	
	//www가 있을경우와 없을경우
	if($(location).attr('host').indexOf('www') == "-1"){
		var v_para = url.replace("http://joyhunting.com/chatting/invite/", "").replace("invite", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}else{
		var v_para = url.replace("http://www.joyhunting.com/chatting/invite/", "").replace("invite", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}	
	
	return v_para;
}