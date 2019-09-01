$(document).ready(function(){	
	get_date();
});

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
		$("#t_day"+(parseInt(str_num[i])+parseInt(cnt))).append("<img src='http://www.joyhunting.net/images/service_center/event_stamp.gif' style='margin-top:12px;'>");
		
	}	
}