$(document).ready(function(){
	
	//확인버튼 클릭시 이벤트
	$("#btn_confirm").click(function(){
		
		if($("#m_pwd").val() == ""){ alert("비밀번호를 입력하세요."); $("#m_pwd").focus(); return; }

		$.ajax({

			type : "post",
			url : "/profile/my_info/pw_chk",
			data : {
				"m_pwd" : encodeURIComponent($("#m_pwd").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "true"){
					$(location).attr("href", "/profile/my_info/my_info_modify");
				}else{
					alert("비밀번호가 일치하지 않습니다. ("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});

	//취소버튼 클릭시 이벤트
	$("#btn_cancel").click(function(){
		history.back(-1);
	});

});