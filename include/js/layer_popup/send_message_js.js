$(document).ready(function(){
	
	//메세지 박스 글자수 제한
	//max_count = 최대 글자수
	var max_conut = 100;

	$('#v_msg').keyup(function (e){
		var content = $(this).val();
		if(content.length <= max_conut){
			$('#counter').html(content.length + '/'+max_conut);
		}else{
			alert("글자수를 초과했습니다.");
			$("#v_msg").html(content.substring(0, max_conut));
			return;
		}
		
    });

    $('#content').keyup();

});


//메세지 보내기전 포인트 차감안내 함수(하루 기본 무료메세지를 다쓴경우)
function send_message_cnt_chk(send_id, recv_id, cnt){
	
	if($("#v_msg").val() == ""){ alert("메세지를 입력하세요."); $("#v_msg").focus(); return; }

	if(cnt == "0"){

		if(confirm("무료메세지를 다 쓰셨습니다.\n지금부터 보내시는 메세지는 10포인트 차감됩니다.\n메세지를 보내시겠습니까?") == true){
			send_message_call(send_id, recv_id);
		}

	}else{
		send_message_call(send_id, recv_id);
	}

}

//메세지 보내기 함수
function send_message_call(send_id, recv_id){
	
	if($("#v_msg").val() == ""){ alert("메세지를 입력하세요."); $("#v_msg").focus(); return; }
	
	$.ajax({

		type : "post",
		url : "/profile/message/call_send_message",
		data : {
			"send_id"		: encodeURIComponent(send_id),
			"recv_id"		: encodeURIComponent(recv_id),
			"contents"		: encodeURIComponent($("#v_msg").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				alert("메세지를 보냈습니다.");
				modal.close();
			}else if(result == "0"){
				alert("메세지 보내기를 실패했습니다. ("+ result +")");
				modal.close();
			}else if(result == "100"){
				if(confirm("포인트가 부족합니다.\n충전하러 가시겠습니까?") == true){
					modal.close();
					point_add();
				}
			}else if(result == "909"){
				alert("정회원 가입후 이용가능합니다.");
				$(location).attr("href", "/profile/point/point_charge");
			}else if(result == "bad"){
				alert("상대방이 나쁜친구로 등록하셨습니다.");
				return;
			}else{
				alert(result);
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}