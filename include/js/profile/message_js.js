$(document).ready(function(){
	
	//탭메뉴
	$("#tab_menu1").click(function(){ $(location).attr("href", "/profile/message/all"); });					//전체메세지
	$("#tab_menu2").click(function(){ $(location).attr("href", "/profile/message/send_message"); });		//보낸메세지
	$("#tab_menu3").click(function(){ $(location).attr("href", "/profile/message/recv_message"); });		//받은메세지

});

//전체선택 기능 추가
function message_all_chk(val){
	if(val == "1"){
		$("input[name='chk_message']").prop("checked", true);
	}else if(val == "2"){
		$("input[name='chk_message']").prop("checked", false);
	}	
}

//선택메세지 삭제하기 함수
function select_message_del(mode){

	if($("input[name='chk_message']").is(":checked") == false){
		alert("삭제할 메세지를 선택하세요.");
	}else{
		
		if(confirm("선택한 메세지를 삭제하시겠습니까?") == true){
			
			var chk_value = "";

			$("input[name='chk_message']:checked").each(function(){
				if(chk_value){
					chk_value = chk_value+"|"+$(this).val();
				}else{
					chk_value = $(this).val();
				}
			});
			
			$.ajax({

				type : "post",
				url : "/profile/message/call_mesaage_del",
				data : {
					"v_mode"			: encodeURIComponent(mode),
					"v_chk_value"		: encodeURIComponent(chk_value)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("선택하신 메세지를 삭제했습니다.");
						location.reload();
					}else{
						alert("선택하신 메세지를 삭제하지 못했습니다. ("+ result +")");
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});
			
		}

	}
	
	
}


//메세지 문자열 잘라서 출력하기
function call_message_limit(v_idx){
	
	$.ajax({
		
		type : "post",
		url : "/profile/message/call_msg_contents",
		data : {
			"v_idx"	: encodeURIComponent(v_idx)
		},
		cache : false,
		async : false,
		success : function(result){		
			document.write(cutStr(result, 100));
		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}