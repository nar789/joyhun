function jjim_add_chk(m_userid, m_nick, m_sex){
	
	if($("#jjim_memo").val() == ""){
		alert("한줄메모를 입력하세요.");
		$("#jjim_memo").focus();
		return;
	}else{

		$.ajax({

			type : "post",
			url : "/profile/jjim/jjim_add_reg",
			data : {
				"m_fuserid"		: encodeURIComponent(m_userid),
				"m_fnick"		: encodeURIComponent(m_nick),
				"m_fsex"		: encodeURIComponent(m_sex),
				"m_content"     : encodeURIComponent($("#jjim_memo").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "7"){
					alert("이미 찜을 하셨습니다.");
					modal.close();
				}else if(result == '1'){
					alert("찜하셨습니다.");
					modal.close();
					window.location.reload();
				}else{
					alert("등록에 실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("실패. (" + result + ")");
			}

		});
	}

}