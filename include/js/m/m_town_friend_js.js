
$(document).ready(function() {
	
	if($(window).width() < "370"){
		$("#btn_position").css("width", "80px");
	}

	//5분거리 리스트 더보기
	$("#more").on("click", function(){

		var page = $(this).attr("page");
		
		$.ajax({

			type : "post",
			url : "/chatting/town_find/more_find_friend",
			data : {
				"page" : page,
				"val1" : encodeURIComponent($("#town_area_1").val()),
				"val2" : encodeURIComponent($("#town_area_2").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "0"){
					alert("마지막 페이지입니다.");
				}else{
					
					$("#tbl").append(result);
					page = parseInt(page)+1;
					$("#more").attr("page", page);

				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});
			
	});


	// 등급있으면 한칸 띄우기
	if ($(".m_intro_text_td > div > b > img").length > 0){
		$(".m_intro_text_td > div > b > img").after('&nbsp;');
	}
	

	//내위치 변경 버튼 클릭시 이벤트
	$("#btn_position").on("click", function(){
		$(location).attr("href", "/chatting/town_find/my_position_map");
	});
	

	//저장버튼 클릭시 이벤트
	$("#btn_save").on("click", function(){
		
		$.ajax({

			type : "post",
			url : "/chatting/town_find/my_position_up",
			data : {
				"val" : encodeURIComponent($("#marker").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "1"){
					alert("위치가 설정되었습니다.");
				}else if(result == "0"){
					alert("위치변경에 실패했습니다.");
				}else if(result == "1000"){
					alert("잘못된 접근입니다.");
				}else{
					alert("실패 ("+ result +")");
				}
				
				$(location).attr("href", "/chatting/town_find/order_login");

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

		
	});

});

//비밀톡챗신청(more부분)
function redirect_chat(i){
	chat_request($("#aaa"+i).attr("m_userid"));
}


//5분거리 회원 검색
function m_area_search(){

	if($("#town_area_1").val() == ""){ alert("시, 도를 선택하세요."); $("#town_area_1").focus(); return;}
	if($("#town_area_2").val() == ""){ alert("구, 군을 선택하세요."); $("#town_area_2").focus(); return;}

	var m_val1 = "", m_val2 = "";

	m_val1 = encodeURIComponent($("#town_area_1").val());		//시, 도
	m_val2 = encodeURIComponent($("#town_area_2").val());		//구, 군
		
	location.href = "/chatting/town_find/order_login/val1/"+encodeURIComponent(m_val1)+"/val2/"+encodeURIComponent(m_val2);
}

//내위치 변경 위치 검색
function m_area_position_search(){

	var m_val1 = "", m_val2 = "";

	m_val1 = encodeURIComponent($("#town_area_1").val());		//시, 도
	m_val2 = encodeURIComponent($("#town_area_2").val());		//구, 군
	
	location.href = "/chatting/town_find/my_position_map/val1/"+encodeURIComponent(m_val1)+"/val2/"+encodeURIComponent(m_val2);
}


//지도클릭시 위치 업데이트 ajax
function m_my_position_ajax(v){
	$.ajax({

		type : "post",
		url : "/chatting/town_find/my_position_up",
		data : {
			"val" : encodeURIComponent(v)
		},
		cache : false,
		async : false,
		success : function(result){
			if(result != "1"){
				alert("잠시후 다시 이용해 주시기 바랍니다.");
				$(location).attr("href", "/chatting/town_find/order_login");
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}