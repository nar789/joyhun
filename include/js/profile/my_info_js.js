



function email_cha(){

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



var nick_check = "";


//아이디 영어 소문자로 자동변환
function upper(e,r)
{
	r.value = r.value.toLowerCase();
}


$(document).ready(function(){

	//정보수정 버튼 클릭
	$("#submit_btn").click(function(){
		
		if($("#m_nick").attr("old_value") != $("#m_nick").val() && nick_check == "" ){
			alert("닉네임 중복확인을 해주세요.");	
			return false;
		}

		form_format_check();		//폼체크
	});

	//입력비밀번호
	$("#m_pwd").keyup(function(){

		if($("#m_pwd_ok").val() == ""){	
			$("#pw_ok").css("color", "red");
			$("#pw_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;비밀번호를 확인하세요.");
			return;
		}else{
			
			//비밀번호가 일치할경우
			if($("#m_pwd").val() == $("#m_pwd_ok").val()){
				$("#pw_ok").css("color", "blue");
				$("#pw_ok").html("비밀번호가 일치합니다.");
				return;
			//비밀번호가 불일치할경우
			}else{
				$("#pw_ok").css("color", "red");
				$("#pw_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;비밀번호가 불일치합니다.");
				return;
			}
		}

	});

	//입력비밀번호 확인
	$("#m_pwd_ok").keyup(function(){
		
		if($("#m_pwd").val() == ""){
			alert("비밀번호를 입력하세요.");
			$("#m_pwd").focus();
			return;
		}else{
			
			//비밀번호가 일치할경우
			if($("#m_pwd").val() == $("#m_pwd_ok").val()){
				$("#pw_ok").css("color", "blue");
				$("#pw_ok").html("비밀번호가 일치합니다.");
				return;
			//비밀번호가 불일치할경우
			}else{
				$("#pw_ok").css("color", "red");
				$("#pw_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;비밀번호가 불일치합니다.");
				return;
			}
		}

	});

	//닉네임 중복검사
	$("#m_nick_chk").click(function(){
		
		var m_nick = $("#m_nick").val();

		if(m_nick.length < 2){
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "red");
			$("#m_nick_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;2자 이상의 닉네임을 입력해 주세요.");		
			return false;
		}else if(m_nick.length > 6){
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "red");
			$("#m_nick_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;6자 이하의 닉네임을 입력해 주세요.");	
			return false;
		}

		var regType1 = /^[ㄱ-ㅎ_가-힣_a-z_A-Z_0-9]+$/;
		if (! regType1.test(m_nick)) { 
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "red");
			$("#m_nick_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;닉네임은 영어와 숫자 한글만 사용가능합니다.");	
			return false;
		}

		var result = "";
		
		$.ajax({
			type: "POST",
			url: "/auth/nick_check/",
			data: {
				"regi_nick": encodeURIComponent($("#m_nick").val())
			},
			cache: false,
			async: false,
			success: function(data) {
				result = data;
			},
			error : function(data){
				alert("실패");
			}
		});

		if(result == "1"){
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "blue");
			$("#m_nick_ok").html("사용가능한 닉네임입니다.");	
			nick_check = "1";
		}else if(result == "200"){
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "red");
			$("#m_nick_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;사용할수없는 닉네임 입니다.");	
			nick_check = "";
		}else{
			$("#m_nick_ok").removeClass();
			$("#m_nick_ok").css("color", "red");
			$("#m_nick_ok").html("<img src='/images/member/warring_ic.gif' style='vertical-align:middle;'>&nbsp;이미 사용중인 닉네임 입니다.");	
			nick_check = "";
		}

	});


});


//폼 체크
function form_format_check(){

	
	var m_pwd		= $("#m_pwd").val();			//비밀번호 
	var m_pwd_ok	= $("#m_pwd_ok").val();			//비밀번호 확인


	if(m_pwd.length < 6){
		alert("6자 이상의 비밀번호를 입력해 주십시오.");	
		$("#m_pwd").focus();
		return false;
	}

	if(m_pwd != m_pwd_ok){
		alert("비밀번호 확인이 일치하지 않습니다.");	
		return false;
	}

	var m_age		= $("#m_age").val();		//이메일2

	if(m_age == ""){
		alert("나이를 입력해 주십시오.");	
		$("#m_age").focus();
		return false;
	}

	var email_id		= $("#email_id").val();			//이메일1
	var email_after		= $("#email_after").val();		//이메일2

	if(email_id == ""){
		alert("이메일을 입력해 주십시오.");	
		$("#email_id").focus();
		return false;
	}

	if(email_after == ""){
		alert("이메일을 입력해 주십시오.");	
		$("#email_after").focus();
		return false;
	}


	if($("input:radio[name='email_open']").is(":checked") == false){
		alert("이메일 공개여부를 체크하십시오.");
		$(".email_open").focus();
		return false;
	}
	
	if($("input:radio[name='email_recv_agree']").is(":checked") == false){
		alert("이메일 수신여부를 체크하십시오.");
		$(".email_recv_agree").focus();
		return false;
	}

	if($("input:radio[name='sms_recv_agree']").is(":checked") == false){
		alert("SMS 수신여부를 체크하십시오.");
		$(".sms_recv_agree").focus();
		return false;
	}
	var m_conregion		= $("#regi_area_1").val();		//지역1
	var m_conregion2	= $("#regi_area_2").val();		//지역2

	if(m_conregion == ""){
		alert("지역을 선택하세요.");	
		$("#m_conregion").focus();
		return false;
	}

	if(m_conregion2 == ""){
		alert("지역을 선택하세요.");	
		$("#m_conregion2").focus();
		return false;
	}

	var m_reason		= $("#m_reason").val();		//원하는 만남
	var m_character	= $("#m_character").val();		//대화 스타일

	if(m_reason == ""){
		alert("원하는 만남을 선택하세요.");	
		$("#m_reason").focus();
		return false;
	}

	if(m_character == ""){
		alert("대화스타일을 선택하세요.");	
		$("#m_character").focus();
		return false;
	}


	register_form.target = '';
	register_form.action = '/profile/my_info/reg_my_info_modify';
	register_form.submit();

}


//비밀번호 체크
function pw_chk(){	

	$.ajax({

		type : "post",
		url : "/profile/my_info/pw_chk",
		data : {

			"m_pwd" : encodeURIComponent($("#m_pwd").val())

		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "true"){
				location.href = "/profile/my_info/my_info_modify";
			}else{
				alert("비밀번호가 일치하지 않습니다. (" + result + ")");
				return;
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});

}


