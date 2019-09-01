

$(document).ready(function(){ 
	$('.bg_f6f7f9').css('height', $(window).height()); 

	//취소버튼 클릭시 이벤트
	$("#btn_cancel").click(function(){
		history.back(-1);
	});

});