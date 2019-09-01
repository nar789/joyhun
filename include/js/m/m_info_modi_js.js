$(document).ready(function(){
	
	//이메일 변경 선택시 값 변경
	$("#select_email").change(function(){
		$("#m_mail2").val($("#select_email").val());
	});

	//닉네임 입력시 특수문자 처리
	$("#m_nick, #m_pwd").bind("keyup",function(){
		
		var re = /[~!@\#$%^&*\()\-=+_']/gi; 

		var temp1 = $("#m_nick").val();
		var temp2 = $("#m_pwd").val();

		if(re.test(temp1) || re.test(temp2)){ 
			alert("특수문자는 입력하실수 없습니다.");
			$("#m_nick").val(temp1.replace(re, "")); 
			$("#m_pwd").val(temp2.replace(re, "")); 
		} 
	});


});

//수정하기 버튼 클릭시 이벤트
function member_modify(){
	
	if($("#m_pwd").val() == ""){ alert("비밀번호를 입력하세요."); $("#m_pwd").focus(); return;}
	if($("#m_nick").val() == ""){ alert("닉네임을 입력하세요."); $("#m_nick").focus(); return;}
	if($("#nick_chk").attr("nick_chk") == ""){ alert("닉네임 중복확인을 하세요."); $("#nick_chk").focus(); return; }
	if($("#m_age").val() == ""){ alert("나이를 입력하세요."); $("#m_age").focus(); return; }
	if($("#m_mail1").val() == ""){ alert("이메일을 입력하세요."); $("#m_mail1").focus(); return; }
	if($("#m_mail2").val() == ""){ alert("이메일을 입력하세요."); $("#m_mail2").focus(); return; }
	if($("#regi_area_1").val() == ""){ alert("지역을 선택하세요."); $("#regi_area_1").focus(); return; }
	if($("#regi_area_2").val() == ""){ alert("지역을 선택하세요."); $("#regi_area_2").focus(); return; }
	
	$.ajax({

		type : "post",
		url : "/profile/my_info/reg_my_info_modify",
		data : {
			"m_pwd"				: encodeURIComponent($("#m_pwd").val()),
			"m_nick"			: encodeURIComponent($("#m_nick").val()),
			"m_age"			: encodeURIComponent($("#m_age").val()),
			"m_mail1"			: encodeURIComponent($("#m_mail1").val()),
			"m_mail2"			: encodeURIComponent($("#m_mail2").val()),
			"email_agree"		: encodeURIComponent($("input[name='email_agree']:checked").val()),
			"sms_agree"			: encodeURIComponent($("input[name='sms_agree']:checked").val()),
			"m_conregion"		: encodeURIComponent($("#regi_area_1").val()),
			"m_conregion2"		: encodeURIComponent($("#regi_area_2").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				alert("정보가 수정되었습니다.");
				location.href = "/m/add_menu";
			}else{
				alert("정보수정에 실패했습니다. \n잠시후 다시 시도하시기 바랍니다. ("+ result +")");
				location.href = "/m/add_menu";
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//닉네임 중복체크
function m_nick_check(){

	if($("#m_nick").val() == ""){ alert("닉네임을 입력하세요."); $("#m_nick").focus(); return;}

	$.ajax({

		type : "post",
		url : "/auth/nick_check",
		data : {
			"regi_nick" : encodeURIComponent($("#m_nick").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				alert("사용가능한 닉네임 입니다.");
				$("#nick_chk").css("background-color", "#F4F4F6");
				$("#nick_chk").attr("nick_chk", "1");
				return;
			}else{
				alert("이미 사용중인 닉네임 입니다.");
				$("#m_nick").val("");
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}