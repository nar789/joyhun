

$(document).ready(function(){

	// 로그인 포커스잡히면
	$(".m_login_input").focus(function() {
		$(this).addClass('text_cursor');
	});

	$('.m_login_input').blur(function() {
		$(this).removeClass('text_cursor');
	});

});
