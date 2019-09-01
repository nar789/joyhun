$(document).ready(function(){
	
	//기본셋팅
	$("#reg_auth_1").show();
	$("#reg_auth_2").hide();
	$("#reg_auth_3").hide();

	//한글만 입력하기
	$("#regi_user_name").on("keyup", function(){
		$(this).val( $(this).val().replace(/[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"\\]/g,"") );
	});

	//숫자만 입력하기
	$("#hp2, #hp3, #rand_num").on("keyup", function(){
		$(this).val( $(this).val().replace(/[^0-9]/gi,"") );
	});

});

//간편본인인증 하기 함수 
function register_name_check(){

	if($("#regi_user_name").val() == ""){ alert("이름을 입력하세요."); $("#regi_user_name").focus(); return; }
	if($("#regi_birth_year").val() == ""){ alert("생년월일을 선택하세요."); $("#regi_birth_year").focus(); return; }
	if($("#regi_birth_month").val() == ""){ alert("생년월일을 선택하세요."); $("#regi_birth_month").focus(); return; }
	if($("#regi_birth_day").val() == ""){ alert("생년월일을 선택하세요."); $("#regi_birth_day").focus(); return; }

	$.ajax({

		type : "post",
		url : "/service_center/main/reg_member_name_check",
		data : {
			"regi_user_name"		: encodeURIComponent($("#regi_user_name").val()),
			"regi_birth_year"		: encodeURIComponent($("#regi_birth_year").val()),
			"regi_birth_month"		: encodeURIComponent($("#regi_birth_month").val()),
			"regi_birth_day"		: encodeURIComponent($("#regi_birth_day").val()),
			"regi_sex"				: encodeURIComponent($("input[name='regi_sex']:checked").val())
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1"){
				//간편인증 성공
				$("#reg_auth_1").hide();
				$("#reg_auth_2").show();
			}else{
				//간편인증 실패
				alert("본인인증에 실패했습니다.\r\n다시 시도해주시기 바랍니다.");
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//인증번호 받기 함수
function reg_rand_num_send(){
	
	if($("#commid").val() == ""){ alert("통신사를 선택하세요."); $("#commid").focus(); return; }
	if($("#hp1").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#hp1").focus(); return; }
	if($("#hp2").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#hp2").focus(); return; }
	if($("#hp3").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#hp3").focus(); return; }
	
	$.ajax({

		type : "post",
		url : "/service_center/main/reg_member_auth_rand_num",
		data : {
			"commid"  : encodeURIComponent($("#commid").val()),
			"hp1"	  : encodeURIComponent($("#hp1").val()),
			"hp2"	  : encodeURIComponent($("#hp2").val()),
			"hp3"	  : encodeURIComponent($("#hp3").val())
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1"){
				alert("인증번호가 발송되었습니다.");
				$("#rand_num").focus();
				return;
			}else if(result == "1000"){
				alert("오늘 하루 10번의 인증번호를 받으셨습니다.\n1시간뒤에 이용가능합니다.");
				return;
			}else{
				alert("잘못된 접근입니다.");
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//인증번호 체크함수
function reg_rand_num_chk(){

	if($("#rand_num").val() == ""){ alert("인증번호를 입력하세요."); $("#rand_num").focus(); return; }

	$.ajax({

		type : "post",
		url : "/service_center/main/reg_member_auth_rand_num_check",
		data : {
			"rand_num"	: encodeURIComponent($("#rand_num").val()),
			"etc"		: encodeURIComponent($("#t_context").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				alert("인증요청이 접수되었습니다.");
				$("#reg_auth_2").hide();
				$("#reg_auth_3").show();
				return;
			}else if(result == "0"){
				alert("인증 오류입니다. \n다시 시도해 주시기 바랍니다.");
				modal.close();
			}else if(result == "1000"){
				alert("잘못된 접근입니다.");
				$(location).attr("href", "/");
			}else{
				alert("올바른 인증번호를 입력하세요.");
				$("#rand_num").focus();
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//인증 레이어 팝업 닫기
function reg_member_layer_close(){
	modal.close();
	location.reload();
}