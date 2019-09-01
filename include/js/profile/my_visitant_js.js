
//프로필 방문자 화면에서 선택삭제
function v_list_remove(){
	
	if($("input[name='chk_visit']:checked").length < 1){
		alert("하나 이상의 방문자를 선택하세요.");
		return;
	}else{

		if(confirm("선택한 방문자을 삭제하시겠습니까?") == true){

			$("input[name='chk_visit']:checked").each(function(){

				$.ajax({

					type : "post",
					url : "/profile/my_visitant/v_list_remove",
					data : {
						"idx"		: encodeURIComponent($(this).val())
					},
					cache : false,
					async : false,
					success : function(result){
						if(result){
							alert("선택 방문자가 삭제되었습니다.");
							window.location.reload();
						}else{
							alert("실패하였습니다. (" + result + ")");
						}
					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
					}

				});

			});


		}

	}
}