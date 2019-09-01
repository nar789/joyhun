$(document).ready(function(){

	$('#modal_close_btn').click(function(){
		window.location.reload();
	});

	var go_url = location.pathname;

	if (go_url == '/blindmeet/blind/send_like'){

		$('#like_url').attr('onclick','location.href="/blindmeet/blind/send_like";');

	}

});


