
// 프로포즈 신청하기
function reg_propose(m_type, p_nick, p_userid, p_idx){

	if($("#m_content").val() == ""){ alert("프로포즈 내용을 입력하세요."); $("#m_content").focus(); return;};
	
	$.ajax({

		type : "post",
		url : "/open_marry/marriage/reg_propose",
		data : {

			"m_type"			: encodeURIComponent(m_type),
			"m_content"			: encodeURIComponent($("#m_content").val()),
			"p_userid"			: encodeURIComponent(p_userid),
			"p_idx"				: encodeURIComponent(p_idx),
			"p_nick"			: encodeURIComponent(p_nick)

		},
		cache : false,
		async : false,
		success : function(result){
			if (result == '1'){
				alert("프로포즈를 보냈습니다.");
				modal.close();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});

}