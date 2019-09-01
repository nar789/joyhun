function bad_friend_reg(){
	
	if($("#friend_memo").val() == ""){
		alert("한줄메모를 입력하세요.");
		$("#friend_memo").focus();
		return;
	}else{

		$.ajax({

			type : "post",
			url : "/friend/friend_add/bad_friend_reg",
			data : {
				"m_fuserid"		: encodeURIComponent($("#m_userid").val()),
				"m_content"		: encodeURIComponent($("#friend_memo").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "100"){
					alert("이미 등록되어있습니다.");
					modal.close();
				}else{
					alert("나쁜친구로 등록되었습니다.");
					modal.close();
					window.location.reload();
					//$(location).attr('href',"/profile/my_friend/send_friend");
					//$("#tmp").html(result);
				}				
			},
			error : function(result){
				alert("실패");
			}

		});
	}

}