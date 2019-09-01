

$(document).ready(function(){  

	// 인증팝업띄우기
	$("#dorm_cate").change(function() {

		if($("#dorm_cate").val() == 'email'){

			my_email_request();

		}else if($("#dorm_cate").val() == 'join_phone'){

			my_join_phone_request();

		}else if($("#dorm_cate").val() == 'my_phone'){

			my_phone_request();

		}

	});




	$("input:checkbox[id='m_agree_1']").click(function(){
		if ($("input:checkbox[id='m_agree_1']").is(":checked") == true){
			$(".agree_box > div.agree_area:first-child").css("border","1px solid #999");
		}
	});

	$("input:checkbox[id='m_agree_2']").click(function(){
		if ($("input:checkbox[id='m_agree_2']").is(":checked") == true){
			$(".agree_box > div.agree_area:last-child").css("border","1px solid #999");
		}
	});


});




// 리뉴얼 로그인 > 이메일 인증
function my_email_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_email_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 320});
	});
}

// 리뉴얼 로그인 > 가입시 등록한 휴대폰 인증
function my_join_phone_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_join_hpone_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 320});
	});
}


// 리뉴얼 로그인 > 본인명의 휴대폰 인증
function my_phone_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_phone_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 320});
	});
}








// 확인클릭시
function checked_user(){


	if ($("input:checkbox[id='m_agree_1']").is(":checked") == false){
		alert("이용약관에 동의해주세요.");
		$(".agree_box > div.agree_area:first-child").css("border","1px solid #f36523");
		return false;
	}
	if ($("input:checkbox[id='m_agree_2']").is(":checked") == false){
		alert("개인정보의 수집 및 이용에 동의해주세요.");
		$(".agree_box > div.agree_area:last-child").css("border","1px solid #f36523");
		return false;
	}
	if ($("#user_name").val() == ''){
		alert("이름을 입력하세요");
		$("#user_name").focus();
		return false;
	}
	if ($("#bir_1").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		$("#bir_1").focus();
		return false;
	}
	if ($("#bir_2").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		$("#bir_2").focus();
		return false;
	}
	if ($("#bir_3").val() == ''){
		alert("생년월일을 정확히 입력하세요");
		$("#bir_3").focus();
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
				$("#dormancy_show").show();
				$(".mb_check_area > input[type=button].width_30per").css("background","#766a6a");
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


function my_cert_fin(){

	alert("asdfadf");
	return false;

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