
function sece_text(v){

	if(v == "on"){	//기타사유
		document.getElementById('secession_text').style.display = "block";
	}else{
		document.getElementById('secession_text').style.display = "none";
	}

}


//탈퇴신청하기
function total_mem_out(){

	if($("#m_pwd").val() == ""){ alert("현재 비밀번호를 입력하세요."); $("#m_pwd").focus(); return;}
	if($("input[name='secession']:checked").length == "0"){ alert("탈퇴사유를 한가지 선택하세요."); return;	}
	if($("#secession_text").val() == ""){ alert("기타 탈퇴사유를 입력하세요."); $("#secession_text").focus(); return;}
	
	if(confirm("정말 탈퇴하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/profile/secession/total_mem_out",
			data : {
				"m_pwd"					: encodeURIComponent($("#m_pwd").val()),
				"m_reason"				: encodeURIComponent($("input[name='secession']:checked").val()),
				"m_reason_content"		: encodeURIComponent($("#secession_text").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "true"){
					//탈퇴완료
					alert("탈퇴가 완료되었습니다.");
					location.href = '/profile/secession/member_destroy';
				}else if(result == "false"){
					//비밀번호가 틀렸을경우
					alert("현재 비밀번호가 일치하지 않습니다.");
					$("#m_pwd").focus();
					return;
				}

			},
			error : function(result){
				alert("실패");
				console.log("error : " + result);
			}

		});

	}
	

}