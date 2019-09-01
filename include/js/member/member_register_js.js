var id_check = "";
var nick_check = "";

//회원가입 버튼 체크 변수 선언
var submit_btn_chk = false;

$(document).ready(function(){
  
/* register TAB */

	  $(".regi_tab").hide(); 
	  $(".regi_tab:first").show(); 

	  
	  $(".regi_privacy ul li").click(function() { 

		  $(".regi_privacy ul li").removeClass(" regi_priv_on regi_priv_off"); 
		  $(this).addClass("regi_priv_on"); 

		  $(".regi_tab").hide() 
		  var activeTab = $(this).attr("rel"); 
		  $("#"+activeTab).show() 

	  }); 
});

/*	이메일 자동 선택	*/
function regi_emailcha(){
	
	if (register_form.regi_email_select.value == '1'){
		register_form.regi_email_2.readonly = false;
		register_form.regi_email_2.value = '';
		register_form.regi_email_2.focus();
	}else{
		register_form.regi_email_2.readonly = true;
		register_form.regi_email_2.value = register_form.regi_email_select.value ;
	}

}

//아이디 영어 소문자로 자동변환
function upper(e,r)
{
	r.value = r.value.toLowerCase();
}


$(document).ready(function(){

	/*	전체 동의 체크박스	*/
	$("#regi_agr_all").click(function(){

			if($("#regi_agr_all").prop("checked")){
				$("input[name=regi_agr_chk]").prop("checked",true);
				$("input[name=regi_agr_chk2]").prop("checked",true);
			}else{
				$("input[name=regi_agr_chk]").prop("checked",false);
				$("input[name=regi_agr_chk2]").prop("checked",false);
			}
	});

	//아이디 중복검사 버튼 클릭
	$("#id_check_btn").click(function(){
		if( id_format_check() == false ){
			return false;
		}

		var result = "";
		$.ajax({
			type: "POST",
			url: "/auth/id_check/",
			data: {
				"regi_id": encodeURIComponent($("#regi_id").val())
			},
			cache: false,
			async: false,
			success: function(data) {
				result = data;
			}
		});

		if(result == "1"){
			text_normal("사용가능한 아이디 입니다.","#regi_id");	
			id_check = "1";
		}else if(result == "200"){
			text_error("사용할수없는 아이디 입니다.","#regi_id");	
			id_check = "";
		}else{
			text_error("이미 사용중인 아이디 입니다.","#regi_id");	
			id_check = "";
		}
	});

	//닉네임 중복검사 버튼 클릭
	$("#nick_check_btn").click(function(){
		if( nick_format_check() == false ){
			return false;
		}

		var result = "";
		$.ajax({
			type: "POST",
			url: "/auth/nick_check/",
			data: {
				"regi_nick": encodeURIComponent($("#regi_nick").val())
			},
			cache: false,
			async: false,
			success: function(data) {
				result = data;
			}
		});

		if(result == "1"){
			text_normal("사용가능한 닉네임 입니다.","#regi_nick");	
			nick_check = "1";
		}else if(result == "200"){
			text_error("사용할수없는 닉네임 입니다.","#regi_nick");	
			nick_check = "";
		}else{
			text_error("이미 사용중인 닉네임 입니다.","#regi_nick");	
			nick_check = "";
		}
	});

	//회원가입 버튼 클릭
	$("#submit_btn").click(function(){

		if(submit_btn_chk == false){
			
			if(id_check == ""){
				alert("아이디 중복확인을 해주세요.");	
				return false;
			}else	if(nick_check == ""){
				alert("닉네임 중복확인을 해주세요.");	
				return false;
			}

			//아이디 체크
			id_format_check();
			//닉네임 체크
			nick_format_check();
			//나머지 폼 체크
			form_format_check();

		}else{
			alert('회원가입중입니다.\n잠시만 기다려주세요.');
			return;
		}
		
	});

	$('#regi_id').blur(function() {
		if ($('#regi_id').val() == ''){
			text_error("아이디를 입력해주세요.","#regi_id");
			return false;
		}
	});
	

	$("#regi_pw").blur(function() {
		if ($("#regi_pw").val() == ''){
			text_error("비밀번호를 입력해주세요.","#regi_pw");
			$("#regi_pw").css("border","1px solid #ea3e3e");
			return false;
		}else if ($("#regi_pw").val().length < 6){
			text_error("6자 이상의 비밀번호를 입력해주세요.","#regi_pw");
			$("#regi_pw").css("border","1px solid #ea3e3e");
			return false;
		}else{
			$("#regi_pw"+'_text')[0].innerHTML = '<span class="" style="color:#333;">비밀번호 확인을 입력해주세요.</span>';
			$("#regi_pw").css("border","1px solid #ccc");
		}
	});

	$("#regi_pw2").blur(function() {
		if ($("#regi_pw2").val() == ''){
			text_error("비밀번호확인을 입력해주세요.","#regi_pw2");
			$("#regi_pw2").css("border","1px solid #ea3e3e");
			return false;
		}else if ($("#regi_pw2").val().length < 6){
			text_error("6자 이상의 비밀번호를 입력해주세요.","#regi_pw2");
			$("#regi_pw2").css("border","1px solid #ea3e3e");
			return false;
		}else if ($("#regi_pw2").val() != $("#regi_pw").val()){
			$("#regi_pw2"+'_text')[0].innerHTML = '<span class="" style="color:#333;"></span>';
			text_error("비밀번호 확인이 일치하지 않습니다.","#regi_pw");	
			$("#regi_pw").css("border","1px solid #ea3e3e");
			$("#regi_pw2").css("border","1px solid #ea3e3e");
			return false;
		}else{
			$("#regi_pw").css("border","1px solid #ccc");
			$("#regi_pw2").css("border","1px solid #ccc");
		}
	});

});


//아이디 형식 체크
function id_format_check(){
	regi_id = $("#regi_id").val();
	if(regi_id.length < 6){
		text_error("6자 이상의 아이디를 입력해 주세요.","#regi_id");	
		return false;
	}else if(regi_id.length > 12){
		text_error("잘못된 아이디 입니다.","#regi_id");	
		return false;
	}
	var regType1 = /^[a-z_0-9]+$/;
	if (! regType1.test(regi_id)) { 
		text_error("아이디는 영어와 숫자 _만 사용가능합니다.","#regi_id");	
		return false;
	}
}

//닉네임 형식 체크
function nick_format_check(){
	regi_nick = $("#regi_nick").val();
	if(regi_nick.length < 2){
		text_error("2자 이상의 닉네임을 입력해 주세요.","#regi_nick");	
		return false;
	}else if(regi_nick.length > 6){
		text_error("잘못된 닉네임 입니다.","#regi_nick");	
		return false;
	}

	var regType1 = /^[ㄱ-ㅎ_가-힣_a-z_A-Z_0-9]+$/;
	if (! regType1.test(regi_nick)) { 
		text_error("닉네임은 영어와 숫자 한글만 사용가능합니다.","#regi_nick");	
		return false;
	}

}

//나머지 폼 체크
function form_format_check(){
	regi_pw = $("#regi_pw").val();
	regi_pw2 = $("#regi_pw2").val();

	if(regi_pw.length < 6){
		alert("6자 이상의 비밀번호를 입력해 주십시오.");	
		$("#regi_pw").css("border","1px solid #ea3e3e");
		return false;
	}

	if(regi_pw != regi_pw2){

		if (regi_pw == ''){

			alert("adfs");
			return false;

		}else{
			alert("비밀번호 확인이 일치하지 않습니다.");	
			$("#regi_pw").css("border","1px solid #ea3e3e");
			$("#regi_pw2").css("border","1px solid #ea3e3e");
			return false;
		}
	}

	regi_age = $("#regi_age").val();

	if(regi_age == ""){
		alert("나이를 선택해 주십시오.");	
		$("#regi_age").focus();
		return false;
	}

	regi_email_1 = $("#regi_email_1").val();
	regi_email_2 = $("#regi_email_2").val();

	if(regi_email_1 == ""){
		alert("이메일을 입력해 주십시오.");	
		$("#regi_email_1").focus();
		return false;
	}

	if(regi_email_2 == ""){
		alert("이메일을 입력해 주십시오.");	
		$("#regi_email_2").focus();
		return false;
	}

	regi_area_1 = $("#regi_area_1").val();
	regi_area_2 = $("#regi_area_2").val();

	if(regi_area_1 == ""){
		alert("지역을 선택해 주십시오.");	
		$("#regi_area_1").focus();
		return false;
	}

	if(regi_area_2 == ""){
		alert("지역을 선택해 주십시오.");	
		$("#regi_area_2").focus();
		return false;
	}
	
	if( $("input:checkbox[id='regi_agr_1']").is(":checked") == false){
		alert("이용약관을 확인하시고 동의해 주십시오.");
		return false
	}

	if( $("input:checkbox[id='regi_agr_2']").is(":checked") == false){
		alert("개인정보의 수집 및 이용을 확인하시고 동의해 주십시오.");
		return false
	}

	submit_btn_chk = true;	//버튼 체크 변수 변경
	register_form.submit();
}


//에러 텍스트 출력
function text_error(msg,object_id){
	$(object_id+'_text')[0].innerHTML = '<span class="regi_td_3_ea3"><img src="/images/member/warring_ic.gif">&nbsp;'+msg+'</span>';
	//$(object_id).focus();
}

//일반 텍스트 출력
function text_normal(msg,object_id){
	$(object_id+'_text')[0].innerHTML = '<span class="" style="color:#333;">'+msg+'</span>';
	//$(object_id).focus();
}