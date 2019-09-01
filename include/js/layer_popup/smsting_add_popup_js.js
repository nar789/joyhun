function s_submit(m_userid,m_nick){ //idx,p_user_id

	var chk_phone = $("#chk_phone").html();

	if (chk_phone.match('휴대폰')){
		alert("휴대폰 인증후 등록해 주세요");
		return false;
	}else if ($("#m_job").val() == ""){
		alert("직업을 선택해 주세요");
		return false;
	}else if($("#m_outstyle").val() == ""){
		alert("외모를 선택해 주세요");
		return false;
	}else if($("#m_character").val() == ""){
		alert("성격을 선택해 주세요");
		return false;
	}else {
		result = "";
		$.ajax({
			type: "POST",
			url: "/meeting/smsting/reg_smsting",
			data: {
				"m_job": encodeURIComponent($("#m_job").val()),
				"m_outstyle": encodeURIComponent($("#m_outstyle").val()),
				"m_character": encodeURIComponent($("#m_character").val()),
				"m_userid": encodeURIComponent(m_userid),
				"m_nick": encodeURIComponent(m_nick)
			},cache: false,async: false,
			success : function(data){
				alert("저장되었습니다.");
				window.location.reload();
			},
			error : function(data){
				alert("실패");
			}
		});

		if(result == "1"){alert('요청이 전송 되었습니다.');modal.close();}
	}

}

//chk_phone
//chk_pic