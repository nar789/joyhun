$(document).ready(function(){
	
});

//채팅창(채팅상대방아이디, 상태, 채팅방번호)
function onchatting_view(user_id, status, req_idx){

	if(status == "수락" || status == "나감"){
		$(location).attr("href", "/chat/chatting/"+user_id);
	}else{
		recv_chat_request(user_id, req_idx);
		//send_chat_request(user_id, req_idx);
	}

}


var tmp_page = "";

//채팅함 내용 AJAX 호출
function get_chatting_data(page){

	tmp_page = page;

	$.get('/profile/my_chat/ajax_chatting_list/page/'+page + '/'+Math.random(), function(data){
		$("#chat_list_div")[0].innerHTML = data;
	});		

}