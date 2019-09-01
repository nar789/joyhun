

/* 프로필 > 채팅함 > 내 앤 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/profile/my_anne/send_anne");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/profile/my_anne/receive_anne");	});
});




//선택 앤 삭제
function chk_remove_anne(){
	
	if($("input[name='chk_anne']:checked").length < 1){
		alert("하나 이상의 앤을 선택하세요.");
		return;
	}else{

		if(confirm("선택한 앤을 삭제하시겠습니까?") == true){

			$("input[name='chk_anne']:checked").each(function(){
				
				$.ajax({

					type : "post",
					url : "/profile/my_anne/chk_remove_anne",
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
				alert("선택 앤이 삭제되었습니다.");
				window.location.reload();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}


		}

	}
}

//선택 앤 추가
function reg_anne(){

	if($("input[name='chk_anne']:checked").length < 1){
		alert("한명의 앤을 선택하세요.");
		return;
	}else{
		if($("input[name='chk_anne']:checked").length > 1){
			alert("한명의 앤을 선택하세요.");
			return;
		}else{
			anne_request($("input[name='chk_anne']:checked").attr("m_userid"));
		}
	}
}
