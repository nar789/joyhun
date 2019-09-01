$(document).ready(function(){

	if($(".text_box > b").text() == ""){
		$("#block_mail_user").focus();
	}
	
	//이메일 수신거부 처리
	$("#block_btn").on("click", function(){
		
		var v_mail = "";

		if($("#block_mail_user").val() != ""){
			v_mail = $("#block_mail_user").val();
		}else{
			v_mail = $(".text_box > b").text();
		}		 
		
		if(v_mail == ""){
			alert("잘못된 접근입니다.");
			return;
		}else{
			if(confirm("조이헌팅 메일을 수신거부 하시겠습니까?") == true){
				
				$.get('/intro/e_mail/call_email_block/mail/'+encodeURIComponent(v_mail)+'/'+Math.random(), function(data){
					result = data;
					if(result == "1"){
						alert("이메일이 전체 수신거부 되었습니다.");
						return;
					}else{
						alert("에메일 수신거부에 실패하였습니다.\n관라자에게 문의하시기 바랍니다.");
						return;
					}
				});

			}
		}

	});



});