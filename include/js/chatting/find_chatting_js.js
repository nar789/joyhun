

/* 채팅상대찾기 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/find_chatting"+para);	
	});
	$("#tab_menu2").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/order_join_date"+para);	
	});
	$("#tab_menu3").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/order_activity_v"+para);	
	});
	$("#tab_menu4").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/order_activity_cnt"+para);	
	});
	$("#tab_menu5").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/order_like_cnt"+para);	
	});
	$("#tab_menu6").click(function() {	
		var para = para_url($(location).attr('href'));
		$(location).attr('href',"/chatting/find_chatting/order_manner"+para);	
	});
});



//회원상세 찾기 검색
function to_member_search(idx){
	
	//원클릭 채팅상대찾기
	if(idx == "1"){
		
		var chk1 = "", chk2 = "", chk3 = "", chk4 = "";

		if($("#onclick_same_age1").is(":checked") == true){ chk1 = $("#onclick_same_age1").val(); }else{ chk1 = "off"; }		//동일한 나이대
		if($("#onclick_same_age2").is(":checked") == true){ chk2 = $("#onclick_same_age2").val(); }else{ chk2 = "off"; }		//동일한 지역
		if($("#onclick_same_age3").is(":checked") == true){ chk3 = $("#onclick_same_age3").val(); }else{ chk3 = "off"; }		//동일한 관심사
		if($("#onclick_same_age4").is(":checked") == true){ chk4 = $("#onclick_same_age4").val(); }else{ chk4 = "off"; }		//사진있는 회원

		if(chk1 == "off" && chk2 == "off" && chk3 == "off" && chk4 == "off"){
			alert("하나 이상의 조건을 선택하세요.");
			return;
		}else{
			location.href = "/chatting/find_chatting/find_chatting/idx/"+idx+"/chk1/"+chk1+"/chk2/"+chk2+"/chk3/"+chk3+"/chk4/"+chk4;
		}
	}
	

	//회원 상세찾기
	if(idx == "2"){
		
		var v_val1 = $("input[name='wanna_age']:checked").val();		//원하는 나이대
		var v_val2 = $("#conregion").val();								//원하는 지역
		var v_val3 = $("#want_reason").val();							//원하는 만남
		var v_val4 = $("#character_text").val();						//대화 스타일

		location.href = "/chatting/find_chatting/find_chatting/idx/"+idx+"/val1/"+v_val1+"/val2/"+encodeURIComponent(v_val2)+"/val3/"+v_val3+"/val4/"+v_val4;
	}

}


//회원검색메뉴
//url 파라미터만 남기기
function para_url(url){
	
	//www가 있을경우와 없을경우
	if($(location).attr('host').indexOf('www') == "-1"){
		var v_para = url.replace("http://joyhunting.com/chatting/find_chatting/", "").replace("find_chatting", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}else{
		var v_para = url.replace("http://www.joyhunting.com/chatting/find_chatting/", "").replace("find_chatting", "").replace("order_join_date", "").replace("order_activity_v", "").replace("order_activity_cnt", "").replace("order_like_cnt", "").replace("order_manner", "");
	}
	
	return v_para;
}