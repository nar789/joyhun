
function search_m_online_keycheck(){
	 if (event.keyCode == 13) {search_m_online();}
}

// 접속자검색
function search_m_online(){
	
	if($("#m_on_search").val() == ""){ alert("접속자를 입력하세요."); $("#m_on_search").focus(); return; }

	$.ajax({

		type : "post",
		url : "/m/online_mb/online_search_nick",
		data : {
			"search_value" : encodeURIComponent($("#m_on_search").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "0"){
				alert("검색된 회원이 없습니다.");
				return;
			}else{
				$("#div_tbl_on").empty();
				$("#div_tbl_on").html(result);
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}



$(function(){

	$('#m_search_btn').hide();

	$('#m_on_search').focus(function(){
		$(this).attr('class','m_search_no');
		$('#m_search_area').attr('class','m_search_area_no');
		$('#m_search_btn').show();
	});

	//더보기(more)버튼 클릭시 이벤트
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");
		
		$.ajax({

			type : "post",
			url : "/m/online_mb/online_list_more",
			data : {
				"page" : page
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

});

//비밀톡챗신청(more부분) 리다이렉트
function redirect_chat(i){
	chat_request($("#aaa"+i).attr("m_userid"));
}

$(document).ready(function(){

	$(".secret_btn").css("display", "block");

	$(".bg_f6f7f9").css("height","2430px");

	// 등급있으면 한칸 띄우기
	if ($(".level_m_online_img > img").length > 0){
		$(".level_m_online_img > img").after('&nbsp;');
	}
	

	//1분마다 접속자 리스트 리셋
	//setInterval(function(){
	//	location.reload();
	//}, 60000);

});