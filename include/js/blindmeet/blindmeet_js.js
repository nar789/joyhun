


/* 소개팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/blindmeet/blind");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/blindmeet/blind/recv_like");	});
});


/* 좋아요관리함 탭메뉴 */
$(document).ready(function(){
	$("#tab_my_menu1").click(function() {	$(location).attr('href',"/blindmeet/blind/recv_like");	});
	$("#tab_my_menu2").click(function() {	$(location).attr('href',"/blindmeet/blind/send_like");	});
	$("#tab_my_menu3").click(function() {	$(location).attr('href',"/blindmeet/blind/together_like");	});
});

// 오늘의 좋아요 마우스오버
function today_over(user, num){

	$("#today_list_"+num).attr('class','today_list_on');
	$("#good_"+num).after("<div class='good_info' id='down_info"+num+"'></div>");

	$.ajax({
	
		type : "post",
		url : "/blindmeet/blind/user_info",
		data : {
			"user"	: user
		},
		cache : false,
		async : false,
		success : function(result){
			
			var print = $.parseJSON(result);

			$('#nick').html(print['m_nick']);
			$('#birthday').html(print['m_birthday']);
			$('#area').html(print['m_conregion']+' '+print['m_conregion2']);
			$('#talk_style').html(print['m_character']);
			$('#want_meeting').html(print['m_reason']);
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

	for(i=1; i<5; i++){

		if(num != i){

			if ( $("#today_list_"+i).length > 0 ) {

				$("#today_list_"+i).attr('class','today_list');
				$('div').remove('#down_info'+i);

			}
		}
	}

}

// 좋아요버튼클릭 1step
function ilike_check(idx){

	$.get('/blindmeet/blind/ilike_v/'+Math.random(), function(data){
		result = data;

		if(result == 'V'){
			if (confirm("좋아요를 보내시겠습니까?") == true){

				ilike(idx);

			}else{ return false; }

		}else{
			alert("정회원만 이용 가능합니다.");
			$(location).attr("href", "/profile/point/point_charge");
		}

	});

	
	
}


// 상대방 알아보기
function id_show(){

	var find = $('.today_list_on').attr('onmouseover').replace("javascript:today_over('","");
	var final_num = find.slice(0,-7);

	$.ajax({
	
		type : "post",
		url : "/blindmeet/blind/id_show",
		data : {
			"idx"  : final_num
		},
		cache : false,
		async : false,
		success : function(result){

			//서로 좋아요가 아니면
			if (result == '9'){
				if (confirm('서로좋아요 후에 아이디보기가 가능합니다.\n\n먼저 좋아요를 보내시겠습니까?') == true){
					ilike(final_num);
				}else{ return false; }

			// 서로 좋아요일 경우 프로필로 이동
			}else{
				location.href="/profile/main/user/user_id/"+result;
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
}


//좋아요 버튼클릭 2step
function ilike(idx){

	$.get('/blindmeet/blind/request_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}



// 소개팅 시작하기
function blind_start(){
	$('.loading_box').removeClass('displaynone');
	$('.blind_start_btn').hide();

	$.ajax({
	
		type : "post",
		url : "/blindmeet/blind/blind_start",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "909"){
				alert("정회원 가입후 이용가능합니다.");
				$(location).attr('href', '/profile/point/point_charge');
			}else{
				$('.today_area').html(
					result
				);
			}
			
		},
		beforeSend:function(){
			$('.loading_box').removeClass('displaynone');
			$('.blind_start_btn').hide();
		},
		complete:function(){
			$('.loading_box').addClass('displaynone');
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}


function one_more(){

	$("#today_more").hide();

	$.ajax({

		type : "post",
		url : "/blindmeet/blind/one_more",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){
			
			$('#today_list_3').after(function() {
				return result;
			});
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});


}