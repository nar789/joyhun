$(document).ready(function(){

	//카테고리 변경
	$("#tabmenu").on("change", function(){
		if($(this).val() == "1"){
			$(location).attr("href", "/service_center/joy_magazine/all");
		}else{
			$(location).attr("href", "/service_center/joy_magazine/menu"+($(this).val()-1));
		}
	});

	//더보기 클릭시 이벤트
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");

		$.ajax({

			type : "post",
			url : "/service_center/joy_magazine/magazine_list_more",
			data : {
				"page" : encodeURIComponent(page),
				"gubn" : encodeURIComponent($("#tabmenu").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "0"){
					alert("마지막 페이지입니다.");
				}else{
					
					$("#more_div").append(result);
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


//매거진 이동
function magazine_view(idx){
	if(idx == ""){ alert("잘못된 접근입니다."); $(location).attr("href", "/service_center/joy_magazine/all"); }
	$(location).attr("href", "/service_center/joy_magazine/magazine_view/idx/"+idx);
}


//이전, 다음, 목록 버튼 클릭시 이벤트
function magazine_btn_click(mode){
	
	$.ajax({

		type : "post",
		url : "/service_center/joy_magazine/call_btn_status_ajax",
		data : {
			"idx"			: encodeURIComponent($("#idx").val()),
			"gubn"			: encodeURIComponent($("#gubn").val()),
			"mode"			: encodeURIComponent(mode)
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1000"){
				alert("잘못된 접근입니다.");
				return;
			}else if(result == "1001"){
				alert("마지막 글입니다.");
				return;
			}else{
				$(location).attr("href", result);
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}
