/* 아이디찾기 버튼등  링크달기 */
$(document).ready(function() {
	$("#member_join_btn").click(function() {	$(location).attr('href',"/auth/register/");	});	
	$("#def_login_btn").click(function() {	if(login_js()){login_form.submit();}  });	
});

/* 로그인창에 엔터쳤을때 */
function login_key_check(obj){
	if(event.keyCode == 13){
		if(login_js()){login_form.submit();}
	}
}


$(document).ready(function() {

	/* 로그인창 captcha 나왔을때 길어지면 배경처리 */
	$(".def_log_area_box").height($(".def_log_area").height() + 73);
	
});

