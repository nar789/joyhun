$(document).ready(function(){	
	
	//요일 셋팅
	get_date();
	
	//모바일 css재정의
	calendar_css();
	
});


function comment_view(t_idx){

	if($("#m_event_comt_"+t_idx).css("display") == "none"){

		$("#m_event_comt_"+t_idx).prev().prev().find(".board_title").addClass('color_ea3c3c');
		$("#m_event_comt_"+t_idx).prev().prev().find("img").attr("src","/images/service_center/faq_up.gif"); 
		$("#m_event_comt_"+t_idx).css("display", "block");

	}else{
		
		$("#m_event_comt_"+t_idx).css("display", "none");
		$("#m_event_comt_"+t_idx).prev().prev().find(".board_title").removeClass('color_ea3c3c');
		$("#m_event_comt_"+t_idx).prev().prev().find("img").attr("src","/images/service_center/faq_down.gif");

	}

}

$(window).resize(function(){
	var ev_height = ($('.event_posit').height())-66;
	$('.event_stam_text').css('top',ev_height);
});


$(function(){

		var ev_height = ($('.event_posit').height())-66;
		$('.event_stam_text').css('top',ev_height);


});


//이벤트 이동 url 이 있는 경우
function m_url_redirect(idx, url){
	
	if(url){
		//이동 url이 있는 경우
		$(location).attr("href", url);
	}else{
		//이동 url이 없는 경우
		$(location).attr("href", "/service_center/event/event_view/m_idx/"+idx);
	}
}


//요일 셋팅
function get_date(){

	var aday = new Array('일', '월', '화', '수', '목', '금', '토');

	var date = new Date();

	var year = date.getFullYear();		//년
	var month = (date.getMonth()+1)>9 ? ''+(date.getMonth()+1) : '0'+(date.getMonth()+1);		//월
	
	var this_month = year+"-"+month+"-01";		//이번달 초기화
	
	var n_date = new Date(this_month);

	var lastDay = ( new Date( year, month, 0) ).getDate();		//매월 마지막 일
	
	if(aday[n_date.getDay()] == "일"){ for(i=1; i<=lastDay; i++){ $("#t_day"+i).html("<div id='s_day"+(i)+"' class='gray_stamp'>"+(i)+"</div>");}	}
	if(aday[n_date.getDay()] == "월"){ for(i=2; i<=lastDay+1; i++){	$("#t_day"+i).html("<div id='s_day"+(i-1)+"' class='gray_stamp'>"+(i-1)+"</div>");}	}
	if(aday[n_date.getDay()] == "화"){ for(i=3; i<=lastDay+2; i++){	$("#t_day"+i).html("<div id='s_day"+(i-2)+"' class='gray_stamp'>"+(i-2)+"</div>");}	}
	if(aday[n_date.getDay()] == "수"){ for(i=4; i<=lastDay+3; i++){	$("#t_day"+i).html("<div id='s_day"+(i-3)+"' class='gray_stamp'>"+(i-3)+"</div>");}	}
	if(aday[n_date.getDay()] == "목"){ for(i=5; i<=lastDay+4; i++){	$("#t_day"+i).html("<div id='s_day"+(i-4)+"' class='gray_stamp'>"+(i-4)+"</div>");}	}
	if(aday[n_date.getDay()] == "금"){ for(i=6; i<=lastDay+5; i++){	$("#t_day"+i).html("<div id='s_day"+(i-5)+"' class='gray_stamp'>"+(i-5)+"</div>");}	}
	if(aday[n_date.getDay()] == "토"){ for(i=7; i<=lastDay+6; i++){	$("#t_day"+i).html("<div id='s_day"+(i-6)+"' class='gray_stamp'>"+(i-6)+"</div>");}	}

}

//회원 출석체크
function attend_member(){
	
	var date = new Date();

	var year = date.getFullYear();																//년
	var month = (date.getMonth()+1)>9 ? ''+(date.getMonth()+1) : '0'+(date.getMonth()+1);		//월
	var day = date.getDate()>9 ? ''+date.getDate() : '0'+date.getDate();						//일

	$.ajax({

		type : "post",
		url : "/service_center/event_stamp/stamp_chk/"+Math.random(),
		data : {
			"year"		: encodeURIComponent(year),
			"month"		: encodeURIComponent(month),
			"day"		: encodeURIComponent(day)
		},
		cache : false,
		async : false,
		success : function(result){
			
			$("#tmp").html(result);

			if(result == "1"){
			//	alert("출석체크 하였습니다.");
				location.reload();
			}else if(result == "0"){
				alert("오늘은 이미 출석체크 하셨습니다.");
				return;
			}else{
				alert("출석체크 실패 ("+result+")");
				$("#tmp").html(result);
				return;
			}
		},
		error : function(result){
			alert("실패 ("+result+")");
		}

	});

}


//이벤트 분홍날짜 class 재정의
function class_adjust(val){
	
	var str_num = val.split('|');

	for(i=0; i<str_num.length; i++){
		$("#s_day"+str_num[i]).removeClass();
		$("#s_day"+str_num[i]).addClass('pink_stamp');
	}

}

//이번달 출석일 이미지 체크
function attend_img_set(val, cnt){
	
	var str_num = val.split('|');
	
	for(i=0; i<str_num.length; i++){
		$("#t_day"+(parseInt(str_num[i])+parseInt(cnt))).empty();
		$("#t_day"+(parseInt(str_num[i])+parseInt(cnt))).append("<img src='http://www.joyhunting.com/images/service_center/event_stamp.gif' style='width:100%; margin-top:5%; margin-left:5%;'>");
		
	}	
}

//모바일 css재정의
function calendar_css(){
	
	//모바일화면이기 때문에 화면 가로사이즈에 따라 이미지의 높이 비율이 다르기 때문에 달력 이미지 height 재설정
	//모바일 사이즈에 맡게 css재정의
	$(".calendar").css("top", $("#calendar_tit").height());
	$(".calendar").css("height", $("#calendar").height());
	$(".week1, .week2, .week3, .week4, .week5, .week6").css("height", $("#calendar").height()/6);
	$(".week2").css("top", $("#calendar").height()/6);
	$(".week3").css("top", 2*($("#calendar").height()/6));
	$(".week4").css("top", 3*($("#calendar").height()/6));
	$(".week5").css("top", 4*($("#calendar").height()/6));
	$(".week6").css("top", 5*($("#calendar").height()/6));
	$(".day1, .day2, .day3, .day4, .day5, .day6, .day7").css("width", $("#calendar").width()/7);
	$(".day1, .day2, .day3, .day4, .day5, .day6, .day7").css("height", "100%");
	$(".day2").css("left", $("#calendar").width()/7);
	$(".day3").css("left", 2*($("#calendar").width()/7));
	$(".day4").css("left", 3*($("#calendar").width()/7));
	$(".day5").css("left", 4*($("#calendar").width()/7));
	$(".day6").css("left", 5*($("#calendar").width()/7));
	$(".day7").css("left", 6*($("#calendar").width()/7));

	
}


/* 여성전용 이벤트 채팅신청 팝업 */
function w_e_guide(){
	$.get('/event/woman_event/w_e_guide/'+Math.random(), function(data){
		modal.open({content: data,width : 320, top:15});
	});
}

/* 여성전용 이벤트 채팅대화 팝업 */
function w_e_guide_second(){
	$.get('/event/woman_event/w_e_guide_second/'+Math.random(), function(data){
		modal.open({content: data,width : 320, top:15});
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
						$(location).attr("href", "/profile/point/point_list");
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