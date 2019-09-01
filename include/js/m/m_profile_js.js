

$(document).ready(function() {
	$('.bg_f6f7f9').css('height',$(document).height());
});

//프로필 수정하기
function m_profile_modi(){
	
	if(confirm("프로필을 수정하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/profile/main/m_profile_modi",
			data : {
				"my_intro"			: encodeURIComponent($("#my_intro").val()),
				"m_reason"			: encodeURIComponent($("#m_reason").val()),
				"m_character"		: encodeURIComponent($("#m_character").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("프로필이 수정되었습니다.");
					location.reload();
				}else{
					alert("프로필 수정에 실패했습니다\n잠시후 다시 시도해 주시기 바랍니다.("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}