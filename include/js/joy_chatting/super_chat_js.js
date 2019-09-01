$(document).ready(function(){	
	call_payment_change($('#v_member_num').val());	//기본대상자수 셋팅
});

//대상자를 변경할경우 사용될 포인트 변경
function call_payment_change(val){
	
	$.ajax({

		type : "post",
		url : "/joy_chatting/super_chat/call_use_point",
		data : {
			"val" : val
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1000"){
				alert("잘못된 접근입니다.");
				$(location).attr("href", "/");
			}else{
				$("#use_point").empty();
				$("#use_point").html(result);

				$("#v_use_point").val($("#use_point > p").text().replace("P", "").replace(",", ""));
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//나이검색 change 함수
function call_search_age_change(val){
	
	$("#v_age_2").empty();
	$("#v_age_2").append("<option value=''>전체</option>");
	for(i=val; i<70; i++){
		$("#v_age_2").append("<option value='"+i+"'>"+i+"</option>");
	}

}

//슈퍼채팅 신청하기 버튼 클릭 이벤트
function supser_chat_submit(){

	if($("#v_member_num").val() == ""){ alert("대상자를 선택하세요."); $("#v_member_num").focus(); return; }
	if($("#chat_msg").val() == ""){ alert("내용을 입력하세요."); $("#chat_msg").focus(); return; }

	if(confirm("총 "+$("#v_member_num").val()+"명의 회원에게 슈퍼채팅을 보내시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/joy_chatting/super_chat/call_super_chat_send",
			data : {
				"mode"		: encodeURIComponent($("#v_mode").val()),
				"num"		: encodeURIComponent($("#v_member_num").val()),
				"area"		: encodeURIComponent($("#v_conregion").val()),
				"age_1"		: encodeURIComponent($("#v_age_1").val()),
				"age_2"		: encodeURIComponent($("#v_age_2").val()),
				"contents"	: encodeURIComponent($("#chat_msg").val()),
				"sex"		: encodeURIComponent($("#v_sex_flag").val()),
				"point"		: encodeURIComponent($("#v_use_point").val())
			},
			cache : false,
			async : true,
			beforeSend : function(){
				super_chat_send_loading();
				$('body').css('cursor', 'wait');
			},
			complete : function(){
				$('#mask').hide();
				$('#loadingImg').hide();
				$('body').css('cursor', 'default');
			},
			success : function(result){
				
				if(result == "1"){
					if(confirm("총 "+$("#v_member_num").val()+"명의 이성에게 슈퍼채팅을 보냈습니다.\n채팅함으로 이동하시겠습니까?") == true){
						$(location).attr("href", "/profile/my_chat/chatting_list");
					}
				}else if(result == "0"){
					alert("관리자에게 문의하시기 바랍니다. ("+ result +")");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result +")");
					return;
				}else if(result == "9999"){
					if(confirm("슈퍼채팅을 보내시는데 포인트가 부족합니다.\n포인트를 충전하러 가시겠습니까?") == true){
						if(is_mobile == true){
							$(location).attr("href", "/profile/point/point_list");
						}else{
							point_add_popup();
						}						
					}
				}else{
					alert("실패 ("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}


//로딩 이미지
function super_chat_send_loading(){
	
	var loading_height = $(document).height();
	var loading_width = $(document).width();

	 var mask = "<div id='mask' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
	 var loadingImg = '';

	 if(is_mobile == true){
		 var v_left = "40%";
	 }else{
		 var v_left = "50%";
	 }
	  
	 loadingImg += "<div id='loadingImg' style='position:absolute; left:"+v_left+"; top:40%; display:none; z-index:10000;'>";
	 loadingImg += "<img src='/images/etc/loading.gif'/>"; 
	 loadingImg += "</div>";  

	 $('body').append(mask).append(loadingImg);
	 $('#mask').css({
	   'width' : loading_width,
	   'height': loading_height,
	   'opacity' : '0.3'
	 });  
	
	 $('#mask').show();
	 $('#loadingImg').show();

}