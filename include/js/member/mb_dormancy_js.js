
$(document).ready(function() {
	$('#show_detail_1').click(function() {

		if ($('#detail_1').css("display") == 'none'){

			$('#detail_box').css("height","319px");
			$(this).text("닫기");
			$(this).css("color","#ec6719");
			$("#detail_1").show();

		}else{

			$('#detail_box').css("height","68px");
			$(this).text("자세히보기");
			$(this).css("color","#333");
			$("#detail_1").hide();
		}
	});


	$('#show_detail_2').click(function() {

		if ($('#detail_2').css("display") == 'none'){

			$('#detail_box2').css("height","319px");
			$(this).text("닫기");
			$(this).css("color","#ec6719");
			$("#detail_2").show();

		}else{

			$('#detail_box2').css("height","68px");
			$(this).text("자세히보기");
			$(this).css("color","#333");
			$("#detail_2").hide();
		}
	});

	$("#user_name").blur(function(){
		if ($("#user_name").val() == '' || $("#bir_1").val() != ''){
			return false;
		}else{
			$("#bir_1").addClass("dor_mb_selected");
			$("#user_name").removeClass("border_bottom_1_f36523");
			$("#user_name").addClass("border_bottom_1_dcdcdc");
		}
	});

	$("#bir_1").blur(function(){
		if ($("#bir_1").val() == '' || $("#bir_2").val() != ''){
			return false;
		}else{
			$("#bir_1").removeClass("dor_mb_selected");
			$("#bir_2").addClass("dor_mb_selected");
		}
	});

	$("#bir_2").blur(function(){
		if ($("#bir_2").val() == '' || $("#bir_3").val() != ''){
			return false;
		}else{
			$("#bir_2").removeClass("dor_mb_selected");
			$("#bir_3").addClass("dor_mb_selected");
		}
	});

	$("#bir_3").blur(function(){
		if ($("#bir_3").val() == ''){
			return false;
		}else{
			$("#bir_3").removeClass("dor_mb_selected");
		}
	});

	$("#new_pwd").blur(function(){
		if ($("#new_pwd").val() == ''){
			$("#new_pwd").removeClass("border_bottom_1_dcdcdc");
			$("#new_pwd").addClass("border_bottom_1_f36523");
			return false;
		}else{
			$("#new_pwd2").removeClass("border_bottom_1_dcdcdc");
			$("#new_pwd2").addClass("border_bottom_1_f36523");
			$("#new_pwd").removeClass("border_bottom_1_f36523");
			$("#new_pwd").addClass("border_bottom_1_dcdcdc");
		}
	});

	$("#new_pwd2").blur(function(){
		if ($("#new_pwd2").val() == ''){
			$("#new_pwd2").removeClass("border_bottom_1_dcdcdc");
			$("#new_pwd2").addClass("border_bottom_1_f36523");
			return false;
		}else{
			$("#new_pwd2").removeClass("border_bottom_1_f36523");
			$("#new_pwd2").addClass("border_bottom_1_dcdcdc");
		}
	});

	$("input:checkbox[id='agree_1']").click(function(){
		if ($("input:checkbox[id='agree_1']").is(":checked") == true){
			$("#detail_box").css("border","1px solid #999");
		}
	});

	$("input:checkbox[id='agree_2']").click(function(){
		if ($("input:checkbox[id='agree_2']").is(":checked") == true){
			$("#detail_box2").css("border","1px solid #999");
		}
	});


});

// 확인클릭시
function checked_user(){


	if ($("input:checkbox[id='agree_1']").is(":checked") == false){
		alert("이용약관에 동의해주세요.");
		$("#detail_box").css("border","1px solid #f36523");
		return false;
	}
	if ($("input:checkbox[id='agree_2']").is(":checked") == false){
		alert("개인정보의 수집 및 이용에 동의해주세요.");
		$("#detail_box2").css("border","1px solid #f36523");
		return false;
	}
	if ($("#user_name").val() == ''){
		alert("이름을 입력하세요");
		return false;
	}
	if ($("#bir_1").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		return false;
	}
	if ($("#bir_2").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		return false;
	}
	if ($("#bir_3").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		return false;
	}

	$.ajax({
					
		type : "post",
		url : "/etc/dormancy/check_user",
		data : {
			"m_user"			: encodeURIComponent($("#user").val()),			// 회원아이디
			"m_name"			: encodeURIComponent($("#user_name").val()),	// 이름
			"bir_1"				: encodeURIComponent($("#bir_1").val()),		// 생일(년)
			"bir_2"				: encodeURIComponent($("#bir_2").val()),		// 생일(월)
			"bir_3"				: encodeURIComponent($("#bir_3").val())			// 생일(일)
		},
		cache : false,
		async : false,
		success : function(result){

			if ( result == '1' ){
				$(".start_dormancy").show();
				$(".dor_info_box").css("padding-bottom","0px");
				$(".text_btn_f36523").css("background","#766a6a");

			}else if (result = '4'){
				alert("해당하는 회원이 없습니다.\n정보를 다시 확인해주세요.");
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});
}



// 휴면계정 > 인증완료
function my_cert_ok(){
	
	modal.close();

	$("#new_pwd").removeClass("border_bottom_1_dcdcdc");
	$("#new_pwd").addClass("border_bottom_1_f36523");

	$("#dor_chk").val("check_ok");
	
	$("#new_pwd").focus();

}


// 이메일 인증 전송
function dor_mb_mail(pop_site){

	$.ajax({
					
		type : "post",
		url : "/etc/dormancy/email_send",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){

			if (result == '1'){
				$(".dor_mb_bottom").css("display","inline-block");
				alert("인증메일이 전송되었습니다. 이메일을 확인해주세요.");
				window.open("http://www."+pop_site,"_blank","scrollbars=yes resizable=yes");
				$("#chekd_email").show();
				$("#dor_mail_show").hide();
				$("#recv_email").hide();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});
}

// 이메일 인증
function my_email_ok(){

	$.ajax({
					
		type : "post",
		url : "/etc/dormancy/email_check",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){

			if (result == '1'){
				alert("정상적으로 인증되었습니다.");
				my_cert_ok();
			}else if (result == '4'){
				alert("인증되지 않았습니다.\n이메일 확인후 링크를 눌러주세요.");
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}

// 가입시 등록한 휴대폰 인증 코드받기
function my_join_phone(){

	$.ajax({
					
		type : "post",
		url : "/etc/dormancy/m_join_phone",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){
			if (result == '1'){
				$(".dor_mb_bottom").css("display","inline-block");
			}else if (result == '4'){
				alert("가입된 휴대폰번호가 없습니다.\n다른 인증수단을 이용해주세요.");
				modal.close();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
}

// 인증코드 숫자만입력 //check_num
$(document).ready(function(){

	$("#check_num").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^0-9]/gi,''));
		}
	});
});


// 가입시 등록한 휴대폰 인증 코드 검사
function my_join_phone_ok(){

	if($('#check_num').val() == '' || $('#check_num').val() == null){
		alert("인증코드를 입력해주세요.");
		$("#check_num").css("border","1px solid #f36523");
		$("#check_num").focus();
		return false;
	}
	$.ajax({
					
		type : "post",
		url : "/etc/dormancy/m_join_phone_check",
		data : {
			num_ck	:	$('#check_num').val()
		},
		cache : false,
		async : false,
		success : function(result){

			if (result == 1){
				alert("정상적으로 인증되었습니다.");
				my_cert_ok();
			}else if(result == 4){
				alert("인증코드를 다시 확인해주세요");
				$("#check_num").css("border","1px solid #f36523");
				$("#check_num").focus();
				return false;
			}else{
				alert("실패하였습니다. (" + result + ")");
			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
}


function my_cert_fin(){

	// 인증 안했을경우
	if ($("#dor_chk").val() == '' || $("#dor_chk").val() == 'undefined'){
		alert("인증방법을 택하여 인증해주세요.");

	// 인증 했을경우
	}else{

		if ($("#new_pwd").val() == ''){
			alert("새로운 비밀번호를 입력해주세요.");
			return false;
		}else if($("#new_pwd2").val() == ''){
			alert("비밀번호 확인을 입력해주세요.");
			return false;
		}else if ($("#new_pwd").val() != $("#new_pwd2").val()){
			alert("비밀번호가 일치하지 않습니다.");
			$("#new_pwd").removeClass("border_bottom_1_dcdcdc");
			$("#new_pwd").addClass("border_bottom_1_f36523");
			$("#new_pwd2").removeClass("border_bottom_1_dcdcdc");
			$("#new_pwd2").addClass("border_bottom_1_f36523");
			return false;
		}else if($("#new_pwd").val().length < 6){
			alert("6자 이상의 비밀번호를 입력해 주세요.");
			return false;
		
		// 성공, 비밀번호 변경
		}else{

			$.ajax({
							
				type : "post",
				url : "/etc/dormancy/fin_new_mb",
				data : {
					m_pwd	:  encodeURIComponent($("#new_pwd").val())
				},
				cache : false,
				async : false,
				success : function(result){
					if (result == '1'){
						alert("비밀번호 변경에 성공하셨습니다.\n다시 로그인해주세요.");
						location.href='/';
					}
				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}

	}
}