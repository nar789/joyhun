$(document).ready(function(){
	
	//더보기(more)버튼 클릭시 이벤트
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");
		var rp = $(this).attr("rp");
		var gubn = $(this).attr("gubn");
		
		$.ajax({

			type : "post",
			url : "/service_center/event/"+gubn+"_list_more",
			data : {
				"page" : page,
				"rp"   : rp
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

var is_rotating		= false;
var is_rotated		= false;
var is_reset		= false;


//룰렛돌리기
function call_rotate(img_id) {

	if(is_rotating) return;
	is_rotating = true;
	
	var duration = 4000;					//돌리는 시간 : 1/1000초
	more_angle = generateRandom(0, 360);	//돌리는 각

	tmp = Math.floor(Math.random()*100);

	cnt = 5;				//기본 바퀴
	if(tmp < 50) cnt+=3;	//추가1바퀴
	else cnt+=4;			//추가2바퀴
	angle = ( 360 * cnt ) + more_angle - 22.5;
	
	$('#'+img_id).rotate({
		duration: duration,
		animateTo:angle,
		callback: function(){

			is_rotating = false;
			is_rotated = true;
			
			var gubn = "";

			if(more_angle >= 0 && more_angle <= 45){
				gubn = "1";
			}else if(more_angle > 45 && more_angle <= 90){
				gubn = "2";
			}else if(more_angle > 90 && more_angle <= 135){
				gubn = "3";
			}else if(more_angle > 135 && more_angle <= 180){
				gubn = "4";
			}else if(more_angle > 180 && more_angle <= 225){
				gubn = "5";
			}else if(more_angle > 225 && more_angle <= 270){
				gubn = "6";
			}else if(more_angle > 270 && more_angle <= 315){
				gubn = "7";
			}else if(more_angle > 315 && more_angle <= 360){
				gubn = "8";
			}else{
				gubn = "8";
			}
			
			rotate_result(gubn);

		}
	});

}

//결과 리턴 ajax
function rotate_result(mode){

	$.ajax({

		type : "post",
		url : "/service_center/event/trip_result_ajax",
		data : {
			"mode" : mode
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				//alert("이벤트에 참여하셨습니다.");
				trip_result_view(mode);
			}else if(result == "2"){
				alert("이벤트 참여 100포인트가 지급되었습니다.");
				trip_result_view(mode);
			}else if(result == "0"){
				alert("이벤트 참여에 실패했습니다.");
			}else if(result == "1000"){
				alert("잘못된 접근입니다.");
			}else{
				alert("잘못된 접근입니다 ("+ result +")");
			}

			reset();

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//룰렛돌리기
function getRotateNum(){

	if(is_rotated == false){
		call_rotate('img_start');
	}else if (is_reset == true){
		location.reload();
	}
	
}

//리셋버튼 활성화
function reset(){
	$("#event_btn").empty();
	$("#event_btn").html('다시하기');
	is_reset = true;
}


//랜덤 숫자 생성
function generateRandom(min, max){
	var ranNum = Math.floor(Math.random()*(max-min+1)) + min;
	return ranNum;
}

//결과 보기
function trip_result_view(mode){

	var view_gubn = "w";

	if(is_mobile == true){
		view_gubn = "m";
	}

	$("#img_start").hide();
	$(".rt_center").hide();
	$("#img_result").attr("src", "/images/service_center/"+view_gubn+"_roulette_img_"+mode+".png");
	$("#img_result").fadeIn("2000");
}


//카드뽑기
function sel_card_clk(){

	$.get("/service_center/event/vacance_result/"+Math.random(), function(data){

		var data1 = data[0];
		var data2 = data[1];

		if(data2 == "1000" || data == "1000"){
			alert("잘못된 접근입니다.");
			return;
		}else if(data2 == "909" || data == "909"){
			alert("정회원만 이용 가능합니다.");
			return;
		}else{

			if(data1 == 2){
				alert("100포인트가 지급되었습니다.");
			}

			if(is_mobile == true){
				var $result = $(".m_contents .result");
			}else{
				var $result = $(".vacance_img_bg .result");
			}
			
			$result.empty();
			$result.html("<img src='/images/service_center/vc_result_"+data2+".png' id='result_img' name='result_img' useMap='#result_map' style='width:100%;'>");
			$result.show();

			if(is_mobile == true){
				imageMap("result_img","518","124","755","400","827","v_btn_02");
			}

		}
	});

}