

//이상형 몇명인지 세서 총 차감될 포인트출력

$(document).ready(function(){  
		
	var fn_point = $("div.wanna_chat_list").children().size(); 

	$("#final_point").html(50*fn_point);

});





function chat_submit(){

	var agent = navigator.userAgent.toLowerCase(); 

	if (agent.indexOf("chrome") != -1) {

		alert("크롬 브라우저에서는 이용이 어렵습니다.\n익스플로러를 이용해주세요.");
		return false;

	}

	if($("#sin_msg").val() == ""){
		alert("신청메세지를 입력해 주세요.");
		$("#sin_msg").focus();
		return false;
	}


	var fn_point = $("div.wanna_chat_list").children().size(); 
	var nick_ary = new Array();

	for (i=1; i <= fn_point; i++ ){

		var total_mb = $("div.wanna_chat_list > p:nth-child("+i+")").children().eq(0).text();
		nick_ary[i-1] = total_mb;

	}

	$.ajax({
		
		type : "post",
		url : "/chatting/invite/nick_chage",
		data : {
			"nick_ary"	: encodeURIComponent(nick_ary)
		},
		cache : false,
		async : false,
		success : function(result){
			
			var id_data = result.split(",");

			for (i=0; i<id_data.length; i++){

					if(id_data[i] == ""){
						alert("[오류] 탈퇴된 회원이거나, 잘못된 요청입니다.");
					}else{
						result = "";
						$.ajax({
							type: "POST",
							url: "/chat/chat_request_pro",
							data: {
								"user_id": encodeURIComponent(id_data[i]),
								"contents": encodeURIComponent($("#sin_msg").val())
							},	cache: false,async: false,
							success: function(data) {
								result = data;
							}
						});

						if(result == "9"){alert('탈퇴하였거나 존재하지 않는 회원입니다.');modal.close();}		
						else if(result == "1"){
							window.openChatWindow(id_data[i]);
						}		
						else if(result == "0"){alert('[오류] 데이터 전송이 실패하였습니다.');modal.close();}		
					}

			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}