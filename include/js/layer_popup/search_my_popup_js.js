


function recv_way(v){

	if(v == "1"){	//휴대폰으로 받기
		$("#pwd_1_display").css("display", "block");
		$("#pwd_2_display").css("display", "none");
	}else{	//이메일로 받기
		$("#pwd_1_display").css("display", "none");
		$("#pwd_2_display").css("display", "block");
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


function search_what(what){

	if(what == "1"){	//아이디찾기
		$("#id_search").css("display", "block");
		$("#pwd_search").css("display", "none");
		$("#confirm_id").css("display", "block");
		$("#confirm_pw").css("display", "none");		

	}else{	//비밀번호 찾기
		$("#id_search").css("display", "none");
		$("#pwd_search").css("display", "block");
		$("#confirm_id").css("display", "none");
		$("#confirm_pw").css("display", "block");
	}
}


//아이디 찾기
function search_id(){

	if($("#search_name1").val() == ""){ alert("이름을 입력하세요."); $("#search_name1").focus(); return; }
	if($("#search_year1").val() == ""){ alert("생년월일을 선택하세요."); $("#search_year1").focus(); return; }
	if($("#search_month1").val() == ""){ alert("생년월일을 선택하세요."); $("#search_month1").focus(); return; }
	if($("#search_day1").val() == ""){ alert("생년월일을 선택하세요."); $("#search_day1").focus(); return; }
	if($("input[name='search_sex1']:checked").length == "0"){ alert("성별을 선택하세요."); return;}
	
	$.ajax({

		type : "post",
		url : "/profile/my_info/search_id",
		data : {
			"m_name"		: encodeURIComponent($("#search_name1").val()),
			"m_year"		: encodeURIComponent($("#search_year1").val()),
			"m_month"		: encodeURIComponent($("#search_month1").val()),
			"m_day"			: encodeURIComponent($("#search_day1").val()),
			"m_sex"			: encodeURIComponent($("input[name='search_sex1']:checked").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			//hp_steal_pop(is_mobile, 'https://ipns.kr/pns/service_info?site_code=S222&ctg_code=1&sub_code=1');		//휴대전화 도용방지 팝업 띄우기(popup.js)

			$.get('/profile/my_info/my_id_find/result/'+result+'/'+Math.random(), function(data){
				modal.open({content: data,width : 520});
			});
		},
		error : function(result){
			alert("실패");
			console.log("error : " + result);
		}

	});

}

//비밀번호 찾기
function search_pwd(){

	if($("#search_id2").val() == ""){ alert("아이디를 입력하세요."); $("#search_id2").focus(); return; }
	if($("#search_name2").val() == ""){ alert("이름을 입력하세요."); $("#search_name2").focus(); return; }
	if($("#search_year2").val() == ""){ alert("생년월일을 입력하세요."); $("#search_year2").focus(); return; }
	if($("#search_month2").val() == ""){ alert("생년월일을 입력하세요."); $("#search_month2").focus(); return; }
	if($("#search_day2").val() == ""){ alert("생년월일을 입력하세요."); $("#search_day2").focus(); return; }
	if($("input[name='search_sex2']:checked").length == "0"){ alert("성별을 선택하세요."); return;}
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
			"m_userid"		: encodeURIComponent($("#search_id2").val()),
			"m_name"		: encodeURIComponent($("#search_name2").val()),
			"m_year"		: encodeURIComponent($("#search_year2").val()),
			"m_month"		: encodeURIComponent($("#search_month2").val()),
			"m_day"			: encodeURIComponent($("#search_day2").val()),
			"m_sex"			: encodeURIComponent($("input[name='search_sex2']:checked").val()),
			"m_hp1"			: encodeURIComponent($("#search_hp1").val()),
			"m_hp2"			: encodeURIComponent($("#search_hp2").val()),
			"m_hp3"			: encodeURIComponent($("#search_hp3").val()),
			"m_mail_first"	: encodeURIComponent($("#email_id").val()),
			"m_mail_second"	: encodeURIComponent($("#email_after").val()),
			"m_mode"		: encodeURIComponent($("input[name='search_receive']:checked").val())
		},
		cache : false,
		async : false,
		success : function(result){			
			
			if(result == "phone_success"){
				//임시비밀번호 발송완료

				//hp_steal_pop(is_mobile, 'https://ipns.kr/pns/service_info?site_code=S222&ctg_code=2&sub_code=1');		//휴대전화 도용방지 팝업 띄우기(popup.js)
				
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
				alert("준비중입니다."+result);
			}
			modal.close();

		},
		error : function(result){
			alert("실패");
			console.log("error : " + result);
		}

	});
	
}

function close_popup(gubn){

	if(gubn == "id"){
		url  = "https://ipns.kr/pns/service_info?site_code=S222&ctg_code=1&sub_code=1";		//아이디찾기
	}else if(gubn == "pw"){
		url  = "https://ipns.kr/pns/service_info?site_code=S222&ctg_code=2&sub_code=1";		//비밀번호찾기
	}else{
		return;
	}
	
	//hp_steal_pop(is_mobile, url);	//휴대전화 도용방지 팝업 띄우기(popup.js)
	modal.close();

}

