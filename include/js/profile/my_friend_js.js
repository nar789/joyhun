

/* 프로필 > 채팅함 > 내 친구 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/profile/my_friend/send_friend");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/profile/my_friend/receive_friend");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/profile/my_friend/together_friend");	});
	$("#tab_menu4").click(function() {	$(location).attr('href',"/profile/my_friend/bad_friend");	});
});


//그룹이동
function f_group_move(){

	if($("#f_group_n").val() == ""){ alert("그룹을 선택하세요."); $("#f_group_n").focus(); return; }

	if($("input[name='f_chk']").is(":checked") == false){
		alert("친구를 선택하세요.");
		return;
	}else{

		$("input[name='f_chk']:checked").each(function(){

			$.ajax({

				type : "post",
				url : "/profile/my_friend/f_group_move",
				data : {
					"m_idx"			: encodeURIComponent($(this).val()),
					"m_gname"		: encodeURIComponent($("#f_group_n").val())
				},
				cache : false,
				async : false,
				success : function(result){				
					$("#success_val").attr("value", "");
					$("#success_val").attr("value", "success");
				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}

			});

		});

		if($("#success_val").val() == "success"){
			alert("선택 친구가 그룹 이동되었습니다.");
			window.location.reload();
		}else{
			alert("실패하였습니다. (" + result + ")");
		}
	}
}


//그룹별 보기
function f_group_view(group){

	var tabmenu = $("#tabmenu").val();
	
	if(group == ""){
		if(tabmenu == "1"){
			$(location).attr("href", "/profile/my_friend/send_friend");
		}else if(tabmenu == "3"){
			$(location).attr("href", "/profile/my_friend/together_friend");
		}		
	}else{
		$("#v_group").val(encodeURIComponent(group));

		var v_group = $("#v_group").val();

		if(tabmenu == "1"){
			$(location).attr("href", "/profile/my_friend/send_friend/v_group/"+encodeURIComponent(v_group)+"/tabmenu/"+tabmenu);
		}else if(tabmenu == "3"){
			$(location).attr("href", "/profile/my_friend/together_friend/v_group/"+encodeURIComponent(v_group)+"/tabmenu/"+tabmenu);
		}
	}
	
	
}

//친구삭제
function f_list_remove(){

	if($("input[name='f_chk']").is(":checked") == false){
		alert("삭제할 친구를 선택하세요.");
		return;
	}else{
		
		if(confirm("선택한 친구를 삭제하시겠습니까?") == true){
			
			$("input[name='f_chk']:checked").each(function(){
			
				$.ajax({

					type : "post",
					url : "/profile/my_friend/f_list_remove",
					data : {
						"m_idx" : encodeURIComponent($(this).val())
					},
					cache : false,
					async : false,
					success : function(result){				
						$("#success_val").attr("value", "");
						$("#success_val").attr("value", "success");
					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
					}


				});

			});

			if($("#success_val").val() == "success"){
				alert("선택 친구가 삭제되었습니다.");
				window.location.reload();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}


		}
		

	}
	
}

//나쁜친구 등록 레이어 팝업
function reg_bad_friend(){
	if($("input[name='f_chk']").is(":checked") == false){
		alert("친구를 선택하세요.");
		return;
	}else{
		
		if($("input[name='f_chk']:checked").length > 1){
			alert("한명만 선택하세요.");
			return;
		}else{
			var user_id = $("input[name='f_chk']:checked").attr("user_id");
			
			bad_friend_request(user_id);
			
		}
	}
}

//내친구로 등록
function reg_my_friend(){
	
	if($("input[name='f_chk']").is(":checked") == false){
		alert("친구를 선택하세요.");
		return;
	}else{

		if($("input[name='f_chk']:checked").length > 1){
			alert("한명만 선택하세요.");
			return;
		}else{
			var user_id = $("input[name='f_chk']:checked").attr("user_id");

			friend_request(user_id);
		}

	}
}

//나쁜친구 해제
function remove_bad_friend(){
	
	if($("input[name='f_chk']").is(":checked") == false){
		alert("친구를 선택하세요.");
		return;
	}else{

		if(confirm("나쁜친구를 해제하시겠습니까?") == true){
			
			$("input[name='f_chk']:checked").each(function(){

				$.ajax({

					type : "post",
					url : "/profile/my_friend/remove_bad_friend",
					data : {
						"m_idx" : encodeURIComponent($(this).val())
					},
					cache : false,
					async : false,
					success : function(result){
						$("#success_val").attr("value", "");
						$("#success_val").attr("value", "success");
					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
					}

				});

			});

			if($("#success_val").val() == "success"){
				alert("선택 나쁜친구가 해제되었습니다.");
				$(location).attr('href',"/profile/my_friend/bad_friend");
			}else{
				alert("실패하였습니다. (" + result + ")");
			}

		}

	}
}


