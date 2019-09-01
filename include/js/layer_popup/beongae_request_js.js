function b_submit(idx,p_user_id){


	if($("#my_msg").val() == ""){
		alert("신청메세지를 입력해 주세요.");
		$("#my_msg").focus();
	}else{
		result = "";
		$.ajax({
			type: "POST",
			url: "/meeting/beongae/request_popup_ok",
			data: {
				"my_msg": encodeURIComponent($("#my_msg").val()),
				"p_user_id": encodeURIComponent(p_user_id),
				"idx": idx
			},	cache: false,async: false,
			success: function(data) {
				result = data;
			}
		});

		if(result == "1"){alert('요청이 전송 되었습니다.');modal.close();
		}else if(result == 'error'){ alert("동성에게 번개팅요청은 불가능합니다.");modal.close(); }
	}


}