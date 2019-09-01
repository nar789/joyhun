	//채팅창안에서 채팅신청 레이어팝업 호출
	function chat_request(user_id){

		$.get('/chat/chat_request/user_id/'+user_id+'/'+Math.random(), function(data){
			if(data == "error"){
				alert("동성간의 채팅은 불가능합니다.");
				return;
			}else if(data == "alreay_chat"){
				if(confirm("이미 채팅중인 회원입니다.\n채팅창으로 이동하시겠습니까?") == true){
					$(location).attr("href", "/chat/chatting/"+user_id);
				}else{
					modal.close();
				}
			}else if(data == "ban"){
				alert("이미 채팅신청을 한 회원입니다.\n채팅수락 대기중입니다.");
				return;
			}else{
				modal.open({content: data, width : 320});
			}		
		});
	}