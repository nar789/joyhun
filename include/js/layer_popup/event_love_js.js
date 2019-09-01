$(document).ready(function(){
	
	//첫번째 확인버튼 클릭시 이벤트
	$("#btn_join_1").on("click", function(){
		
		if($("#pic_cnt").val() == 0){ alert("프로필 사진을 등록하셔야 참여가 가능합니다."); return; }
		if($("#age").val() == ""){ alert("나이를 입력하세요."); $("#age").focus(); return; }
		if($("#conregion").val() == ""){ alert("지역을 선택하세요."); $("#conregion").focus(); return; }
		if($("#conregion2").val() == ""){ alert("지역을 선택하세요."); $("#conregion2").focus(); return; }
		if($("#hp1").val() == ""){ alert("휴대폰번호를 입력하세요."); $("#hp1").focus(); return; }
		if($("#hp2").val() == ""){ alert("휴대폰번호를 입력하세요."); $("#hp2").focus(); return; }
		if($("#hp3").val() == ""){ alert("휴대폰번호를 입력하세요."); $("#hp3").focus(); return; }
		
		$.ajax({

			type : "post",
			url : "/service_center/event_love/user_join_date",
			data : {
				"age"				: encodeURIComponent($("#age").val()),
				"conregion"			: encodeURIComponent($("#conregion").val()),
				"conregion2"		: encodeURIComponent($("#conregion2").val()),
				"hp1"				: encodeURIComponent($("#hp1").val()),
				"hp2"				: encodeURIComponent($("#hp2").val()),
				"hp3"				: encodeURIComponent($("#hp3").val())
			},
			cache : false,
			ascyn : false, 
			success : function(result){
				
				if(result == "1"){
					$("#step1").hide();
					$("#step2").show();
				}else if(result == "1000"){
					alert("회원만 이용가능합니다.");
					modal.close();
				}else if(result == "1001"){
					alert("프로필 사진 등록후 이용 가능합니다.");
					$(location).attr("href", "/profile/main/user");
				}else{
					alert("입력에 실패했습니다. ("+ result +")");
					return;
				}

			}, 
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});

	//두번째 신청하기 클릭시 이벤트
	$("#btn_join_2").on("click", function(){
		
		if($("#t_context").val() == ""){ alert("자기소개를 입력하세요."); $("#t_context").focus(); return; }

		$.ajax({

			type : "post",
			url : "/service_center/event_love/user_join_intro",
			data : {
				"intro" : encodeURIComponent($("#t_context").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("성공적으로 접수되었습니다.");
					modal.close();
				}else{
					alert("입력에 실패해습니다. ("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});

});