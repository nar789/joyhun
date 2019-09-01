$("#modal_myinfo_submit").click(function(){
	if($("#my_intro").val() == ""){
		alert("인사말을 입력해 주세요.");
		$("#my_intro").focus();
	}else{
		result = "";
		$.ajax({
			type: "POST",
			url: "/main/register_ok_modify",
			data: {
				"m_reason": encodeURIComponent($("#m_reason").val()),
				"m_character": encodeURIComponent($("#m_character").val()),
				"my_intro": encodeURIComponent($("#my_intro").val())
			},	cache: false,async: false,
			success: function(data) {
				if(data == true){modal.close();}
			}
		});

	}
});