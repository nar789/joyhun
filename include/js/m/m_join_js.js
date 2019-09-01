//회원가입 버튼 체크 변수 선언
var submit_btn_chk = false;

$(document).ready(function(){

	/*	전체 동의 체크박스	*/
	$("#all_agree").click(function(){

		if($("#all_agree").prop("checked")){
			$("input[id=agree_1]").prop("checked",true);
			$("input[id=agree_2]").prop("checked",true);
		}else{
			$("input[id=agree_1]").prop("checked",false);
			$("input[id=agree_2]").prop("checked",false);
		}
	});

	
	//성별 체크시 이벤트(1:남성, 2:여성)
	$("#m_sex_1").click(function(){
		$("#m_sex_2").prop("checked", false);
		m_talk_style_ajax();	//성별 체크시 대화스타일 변경 ajax
	});

	$("#m_sex_2").click(function(){
		$("#m_sex_1").prop("checked", false);
		m_talk_style_ajax();	//성별 체크시 대화스타일 변경 ajax
	});



	//비밀번호 확인
	/*$("#regi_pw_chk").keyup(function(){
		
		if($("#regi_pw").val() == ""){ alert("비밀번호를 입력하세요."); $("#regi_pw_chk").val(""); $("#regi_pw").focus(); return;}
		
		if($("#regi_pw").val() != $("#regi_pw_chk").val()){
			$("#pw_chk").empty();
			$("#pw_chk").removeClass("color_999 color_3F48CC");
			$("#pw_chk").addClass("color_ED1C24");
			$("#pw_chk").html("비밀번호가 일치하지 않습니다.");
		}else{
			$("#pw_chk").empty();
			$("#pw_chk").removeClass("color_999 color_ED1C24");
			$("#pw_chk").addClass("color_3F48CC");
			$("#pw_chk").html("비밀번호가 일치합니다.");
		}

	});*/

	//이메일 항목선택	
	$("#regi_email_2").focus(function(){
		
		$("#sub_email").css("display", "block");

		$("ul").children('li').click(function(){
			if($(this).text() != "직접입력"){
				$("#regi_email_2").val($(this).text());
			}else{
				$("#regi_email_2").val('');
				$("#regi_email_2").focus();
				$("#regi_email_2").css('background','none');
			}
			$("#sub_email").css("display", "none");
		});

	});

	//회원가입 버튼 클릭시 이벤트
	$("#submit_btn").click(function(){
		
		if(submit_btn_chk == false){
			reg_member_formchk();	//폼체크 및 submit
		}else{
			alert('회원가입중입니다.\n잠시만 기다려주세요.');
			return;
		}
		
	});

});

function id_format_check(){
	regi_id = $("#regi_id").val();
	if(regi_id.length < 6){
		alert("6자 이상의 아이디를 입력해 주세요.","#regi_id");	
		return false;
	}else if(regi_id.length > 12){
		alert("잘못된 아이디 입니다.","#regi_id");	
		return false;
	}
	var regType1 = /^[a-z_0-9]+$/;
	if (! regType1.test(regi_id)) { 
		alert("아이디는 영어와 숫자 _만 사용가능합니다.","#regi_id");	
		return false;
	}
}


function nick_format_check(){
	regi_nick = $("#regi_nick").val();
	if(regi_nick.length < 2){
		alert("2자 이상의 닉네임을 입력해 주세요.","#regi_nick");	
		return false;
	}else if(regi_nick.length > 6){
		alert("잘못된 닉네임 입니다.","#regi_nick");	
		return false;
	}

	var regType1 = /^[ㄱ-ㅎ_가-힣_a-z_A-Z_0-9]+$/;
	if (! regType1.test(regi_nick)) { 
		alert("공백 및 특수문자는 사용할수 없습니다.","#regi_nick");	
		return false;
	}

}


//성별 체크시 대화스타일 변경 ajax
function m_talk_style_ajax(){

	if($("#m_sex_1").val() != "" || $("#m_sex_2").val() != ""){
		
		var m_sex = $("input[name='m_sex']:checked").val();

		$.ajax({
			type : "post",
			url : "/auth/m_talk_style_mobile",
			data : {
				"m_sex"	: m_sex
			},
			cache : false,
			async : false,
			success : function(result){
				$("#m_talk_style").empty();
				$("#m_talk_style").html(result);
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}

//아이디 영어 소문자로 자동변환
function upper(e,r)
{
	r.value = r.value.toLowerCase();
}


//아이디체크
function m_id_check(){
	
	if($("#regi_id").val() == ""){ alert("아이디를 입력하세요."); $("#regi_id").focus(); return;}
	if($("#regi_id").val().length < 6){ alert("6자 이상의 아이디를 입력해 주세요."); $("#regi_id").focus(); return;}

	if(id_format_check() == false){
		$("#regi_id").focus();
		return;
	};

	$("#regi_sex").val($("input[name='m_sex']:checked").val());

	$.ajax({
		
		type : "post",
		url : "/auth/id_check",
		data : {
			"regi_id" : encodeURIComponent($("#regi_id").val())
		},
		cache : false,
		async : false,
		success : function(result){
		
			if(result == "1"){
				alert("사용가능한 아이디 입니다.");
				$("#id_chk").css("background-color", "#F4F4F6");
				$("#id_chk").attr("id_chk", "1");
				return;
			}else if(result == "200"){
				alert("금지 아이디 입니다.");
				$("#regi_id").val("");
				return;
			}else{
				alert("이미 등록된 아이디 입니다.");
				$("#regi_id").val("");
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});


}


//닉네임 중복체크
function m_nick_check(){

	if($("#regi_nick").val() == ""){ alert("닉네임을 입력하세요."); $("#regi_nick").focus(); return;}
	
	if(nick_format_check() == false){
		$("#regi_nick").focus();
		return;
	}

	$.ajax({

		type : "post",
		url : "/auth/nick_check",
		data : {
			"regi_nick" : encodeURIComponent($("#regi_nick").val())
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
				$("#regi_nick").val("");
				return;
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

}

//회원가입 항목 폼체크 및 submit
function reg_member_formchk(){

	if($("input[name='m_sex']").is(":checked") == false){ 
		alert("성별을 선택하세요."); 
		return;
	}
	if($("#m_reason").val() == ""){
		alert("원하는 만남을 선택하세요."); 
		$("#m_reason").focus(); 
		return;
	}
	if($("#m_talk_style").val() == ""){ 
		alert("대화스타일을 선택하세요."); 
		$("#m_talk_style").focus(); 
		return;
	}
	if($("#regi_id").val() == ""){ 
		alert("아이디를 입력하세요."); 
		$("#regi_id").focus(); 
		return;
	}
	if($("#id_chk").attr("id_chk") != "1"){ 
		alert("아이디 중복체크를 하세요."); 
		$("#id_chk").attr("id_chk").focus(); 
		return; 
	}
	if($("#regi_pw").val() == ""){ 
		alert("비밀번호를 입력하세요."); 
		$("#regi_pw").focus(); 
		return; 
	}
	/*if($("#regi_pw_chk").val() == ""){ 
		alert("비밀번호 확인을 입력하세요."); 
		$("#regi_pw_chk").focus(); 
		return; 
	}
	if($("#pw_chk").text() != "비밀번호가 일치합니다."){ 
		alert("비밀번호가 일치하지 않습니다."); 
		$("#regi_pw").focus(); 
		return; 
	}*/
	if($("#regi_nick").val() == ""){ 
		alert("닉네임을 입력하세요."); 
		$("#regi_nick").focus(); 
		return;
	}
	if($("#nick_chk").attr("nick_chk") != "1"){ 
		alert("닉네임 중복체크를 하세요."); 
		$("#nick_chk").focus(); 
		return; 
	}
	if($("#regi_age").val() == ""){ 
		alert("닉네임을 입력하세요."); 
		$("#regi_age").focus(); 
		return;
	}
	if($("#regi_email_1").val() == ""){ 
		alert("이메일을 입력하세요."); 
		$("#regi_email_1").focus();
		return;
	}
	if($("#regi_email_2").val() == ""){ 
		alert("이메일을 입력하세요."); 
		$("#regi_email_2").focus(); 
		return;
	}
	if($("#regi_area_1").val() == ""){ 
		alert("지역을 선택하세요."); 
		$("#regi_area_1").focus(); 
		return;
	}
	if($("#regi_area_2").val() == ""){ 
		alert("지역을 선택하세요."); 
		$("#regi_area_2").focus(); 
		return;
	}
	if($("input[id='agree_1']").is(":checked") == false){ 
		alert("이용약관에 동의하셔야 회원가입이 가능합니다."); 
		return;
	}
	if($("input[id='agree_2']").is(":checked") == false){ 
		alert("개인정보 취급방침에 동의하셔야 회원가입이 가능합니다."); 
		return;
	}

	submit_btn_chk = true;	//버튼 체크 변수 변경	
	//회원가입 submit
	m_register_form.submit();
}
