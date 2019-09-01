


/* 포토미팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/photo/permission/new_photo");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/photo/permission/login");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/photo/permission/change");	});
});

//인증사진 성별검색 기능
function search_sex(url, sex){
	location.href="/photo/permission/"+url+"/sex/"+ sex + "/";
}

//서치메뉴 검색
function photo_permission_search(url){
	
	var m_conregion		= encodeURIComponent($("#m_conregion").val());		//지역
	var m_age			= encodeURIComponent($("#m_age").val());			//나이
	var m_reason		= encodeURIComponent($("#m_reason").val());			//원하는만남

	if(m_conregion == "" && m_age == "" && m_reason == ""){
		alert("한가지 이상의 검색조건을 선택하세요.");
		return;
	}
	
	location.href = "/photo/permission/"+url+"/conregion/"+m_conregion+'/age/'+m_age+'/reason/'+m_reason;
}