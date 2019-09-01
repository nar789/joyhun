$(document).ready(function(){
	
	$("#tab_menu1").click(function(){ $(location).attr("href", "/service_center/joy_magazine/all"); });		//전체
	$("#tab_menu2").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu1"); });	//이색데이트
	$("#tab_menu3").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu2"); });	//축제속으로
	$("#tab_menu4").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu3"); });	//여행지정보
	$("#tab_menu5").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu4"); });	//공연&전시
	$("#tab_menu6").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu5"); });	//리빙&푸드
	$("#tab_menu7").click(function(){ $(location).attr("href", "/service_center/joy_magazine/menu6"); });	//맛집베스트
	

});

//매거진 뷰페이지
function magazine_view(idx){
	if(idx == ""){ alert("잘못된 접근입니다."); return; }
	$(location).attr("href", "/service_center/joy_magazine/magazine_view/idx/"+idx);
}

//목록으로
function magazine_list_goto(url){

	if(url == "" || url == "http://www.joyhunting.com/" || url == "http://joyhunting.com/"){
		$(location).attr("href", "/service_center/joy_magazine/all");
	}else{
		$(location).attr("href", url);
	}

}