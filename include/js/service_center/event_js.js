/* 이벤트 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/service_center/event/ing_event");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/service_center/event/end_event");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/service_center/event/event_won");	});
});


//이벤트 뷰페이지
function event_view(m_idx){
	
	$.ajax({

		type : "post",
		url : "/service_center/event/event_view_exce",
		data : {
			"m_idx"	: encodeURIComponent(m_idx)
		},
		cache : false,
		async : false,
		success : function(result){
			location.href=result;			
		},
		error : function(result){
			alert("실패 ("+result+")");
		}

	});

}

/* 여성전용 이벤트 채팅신청 팝업 */
function w_e_guide(){
	$.get('/event/woman_event/w_e_guide/'+Math.random(), function(data){
		modal.open({content: data,width : 620, top:100});
	});
}

/* 여성전용 이벤트 채팅대화 팝업 */
function w_e_guide_second(){
	$.get('/event/woman_event/w_e_guide_second/'+Math.random(), function(data){
		modal.open({content: data,width : 582, top:100});
	});
}


/* 여성전용 이벤트2(리워드 이벤트) */
function already_provide(gubn, user_id, point){
	alert("이미 포인트를 지급받으셨습니다.");
	return;
}

/* 여성전용 이벤트2(리워드 이벤트) 포인트 지급 함수 */
function non_payment(gubn, user_id, point){

	if(gubn == "on"){
		alert("이미 포인트를 지급받으셨습니다.");
		return;
	}

	if(point == "0"){
		alert("현재 받으실수 있는 포인트가 없습니다.\n이벤트에 참여하여주시기 바랍니다.");
		return;
	}
	
	if(confirm("현재 포인트를 지급받으시겠습니까?\n지급받으시면 오늘은 더이상 참여가 불가능합니다.") == true){
		
		$.ajax({

			type : "post",
			url : "/service_center/event/woman_event_reward_point_ajax",
			data : {
				"gubn"		: encodeURIComponent(gubn),
				"user_id"	: encodeURIComponent(user_id),
				"point"		: encodeURIComponent(point)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					
					if(confirm("포인트가 지급되었습니다.\n확인하러 가시겠습니까?") == true){
						$(location).attr("href", "/profile/point/charge_list");
					}else{
						location.reload();
					}

				}else if(result == "0"){
					alert("포인트 지급에 실패하였습니다. 다시 시도해주시기 바랍니다.");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다.");
					location.reload();
				}else{
					alert("실패 ("+ result +")");
					location.reload();
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}