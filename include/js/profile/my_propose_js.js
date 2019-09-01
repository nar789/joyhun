
/* 프로포즈 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/profile/propose/send_propose");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/profile/propose/receive_propose");	});

});


//선택프로포즈 삭제
function propose_del(v_mode){

	if(confirm("삭제하시겠습니까?") == true){
		
		$("input[name=propose_chk]:checked").each(function(){
			
			$.ajax({

				type : "post",
				url : "/profile/propose/propose_del",
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
			alert("삭제되었습니다.");
			window.location.reload();
		}
	}

	

}

