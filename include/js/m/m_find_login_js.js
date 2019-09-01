function recv_way(v){

	if(v == "1"){	//휴대폰으로 받기
		$("#pwd_1_display").show();
		$("#pwd_2_display").hide();
	}else{	//이메일로 받기
		$("#pwd_1_display").hide();
		$("#pwd_2_display").show();
	}
}

function search_what(what){

	if(what == "1"){	//아이디찾기
		$("#id_search").show();
		$("#pwd_search").hide();
		$("#confirm_id").show();
		$("#confirm_pw").hide();
		$("#id_view").hide();

	}else{	//비밀번호 찾기
		$("#pwd_search").show();
		$("#id_search").hide();
		$("#confirm_id").hide();
		$("#confirm_pw").show();
		$("#id_view").hide();
	}
}



function email_cha(){		//이메일 자동선택

	var sel = document.getElementById("email_selecter");
	var email_after = document.getElementById("email_after");
	var val = sel.options[sel.selectedIndex].value;
	
	if (val == '1'){
		email_after.value = '';
		email_after.focus();
	}else{
		email_after.value = val;
	}
}



$(document).ready(function(){

	if ($('#checked_id').is(":checked")){	//아이디찾기
		$("#id_search").show();
		$("#pwd_search").hide();
		$("#confirm_id").show();
		$("#confirm_pw").hide();

	}else if ($('#checked_pwd').is(":checked")){	//비밀번호 찾기
		$("#id_search").hide();
		$("#pwd_search").show();
		$("#confirm_id").hide();
		$("#confirm_pw").show();

	}
});




//아이디 찾기
function search_id(){

	if($("#m_find_name").val() == ""){ alert("이름을 입력하세요."); $("#m_find_name").focus(); return; }
	if($("#m_find_year").val() == ""){ alert("생년월일을 선택하세요."); $("#m_find_year").focus(); return; }
	if($("#m_find_month").val() == ""){ alert("생년월일을 선택하세요."); $("#m_find_month").focus(); return; }
	if($("#m_find_day").val() == ""){ alert("생년월일을 선택하세요."); $("#m_find_day").focus(); return; }
	if($("input[name='m_sex']:checked").length == "0"){ alert("성별을 선택하세요."); return;}

	$("#id_view").slideDown('slow', function(){

		$.ajax({

			type : "post",
			url : "/m/find_login/search_id",
			data : {
				"m_name"		: encodeURIComponent($("#m_find_name").val()),
				"m_year"		: encodeURIComponent($("#m_find_year").val()),
				"m_month"		: encodeURIComponent($("#m_find_month").val()),
				"m_day"			: encodeURIComponent($("#m_find_day").val()),
				"m_sex"			: encodeURIComponent($("input[name='m_sex']:checked").val())
			},
			cache : false,
			async : false,
			success : function(result){
				$("#id_view").html(result);
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});

	
}



//비밀번호 찾기
function search_pwd(){

	if($("#m_find_id2").val() == ""){ alert("아이디를 입력하세요."); $("#m_find_id2").focus(); return; }
	if($("#m_find_name2").val() == ""){ alert("이름을 입력하세요."); $("#m_find_name2").focus(); return; }
	if($("#m_find_year2").val() == ""){ alert("생년월일을 입력하세요."); $("#m_find_year2").focus(); return; }
	if($("#m_find_month2").val() == ""){ alert("생년월일을 입력하세요."); $("#m_find_month2").focus(); return; }
	if($("#m_find_day2").val() == ""){ alert("생년월일을 입력하세요."); $("#m_find_day2").focus(); return; }
	if($("input[name='m_sex2']:checked").length == "0"){ alert("성별을 선택하세요."); return;}
	if($("input[name='search_receive']:checked").val() == "1"){
		if($("#search_hp1").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#search_hp1").focus(); return; }
		if($("#search_hp2").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#search_hp2").focus(); return; }
		if($("#search_hp3").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#search_hp3").focus(); return; }
	}else{
		if($("#email_id").val() == ""){ alert("이메일계정을 입력하세요."); $("#email_id").focus(); return; }
		if($("#email_selecter").val() == ""){ alert("이메일주소를 선택하세요."); $("#email_selecter").focus(); return; }
	}

	$.ajax({

		type : "post",
		url : "/profile/my_info/pass_search",
		data : {
			"m_userid"		: encodeURIComponent($("#m_find_id2").val()),
			"m_name"		: encodeURIComponent($("#m_find_name2").val()),
			"m_year"		: encodeURIComponent($("#m_find_year2").val()),
			"m_month"		: encodeURIComponent($("#m_find_month2").val()),
			"m_day"			: encodeURIComponent($("#m_find_day2").val()),
			"m_sex"			: encodeURIComponent($("input[name='m_sex2']:checked").val()),
			"m_hp1"			: encodeURIComponent($("#search_hp1").val()),
			"m_hp2"			: encodeURIComponent($("#search_hp2").val()),
			"m_hp3"			: encodeURIComponent($("#search_hp3").val()),
			"m_mail_first"	: encodeURIComponent($("#email_id").val()),
			"m_mail_second"	: encodeURIComponent($("#email_selecter").val()),
			"m_mode"		: encodeURIComponent($("input[name='search_receive']:checked").val())
		},
		cache : false,
		async : false,
		success : function(result){	
							
			if(result == "phone_success"){
				//임시비밀번호 발송완료
				alert("회원님의 휴대전화전번호로 임시비밀번호가 발송되었습니다.\n로그인후 비밀번호를 수정하여주시기 바랍니다.");
			}else if(result == "phone_error"){
				//임시비밀번호 발송실패
				alert("잠시후 다시 시도해 주시기 바랍니다.");
			}else if(result == "phone_discordance"){
				//회원정보가 일치하지 않는경우
				alert("회원 가입 정보가 일치하지 않습니다.");
			}else if(result == "error"){
				//휴대전화 인증을 받은않은 회원
				alert("가입시 휴대전화를 입력하지 않은 회원입니다. \n이메일을 이용하시기 바랍니다.");
			}else{
				alert("준비중입니다.");
			}

		},
		error : function(result){
			alert("실패");
			console.log("error : " + result);
		}

	});


}