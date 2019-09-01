

/* 프로필 > 채팅함 > 내 친구 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/profile/jjim/send_jjim");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/profile/jjim/receive_jjim");	});
});


function chk_remove_jjim1(){
	
	if($("input[name='chk_jjim']:checked").length < 1){
		alert("하나 이상의 찜을 선택하세요.");
		return;
	}else{

		if(confirm("선택한 찜을 삭제하시겠습니까?") == true){

			$("input[name='chk_jjim']:checked").each(function(){
				
				$.ajax({

					type : "post",
					url : "/profile/jjim/chk_remove_jjim",
					data : {
						"m_idx"		: encodeURIComponent($(this).val())
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
				alert("선택 찜이 삭제되었습니다.");
				window.location.reload();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}


		}

	}
}



function chk_remove_jjim2(){
	
	if($("input[name='chk_jjim']:checked").length < 1){
		alert("하나 이상의 찜을 선택하세요.");
		return;
	}else{

		if(confirm("선택한 찜을 삭제하시겠습니까2?") == true){

			$("input[name='chk_jjim']:checked").each(function(){
				
				$.ajax({

					type : "post",
					url : "/profile/jjim/chk_remove_jjim2",
					data : {
						"m_idx"		: encodeURIComponent($(this).val())
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
				alert("선택 찜이 삭제되었습니다.");
				window.location.reload();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}


		}

	}
}