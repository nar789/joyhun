$(document).ready(function(){
	
	if(is_mobile == true){
		//textarea 높이설정
		//모바일의 경우만
		$(".gift_list_text_box").on("keyup", "textarea", function(e){
			$(this).css("height", "auto");
			$(this).height(this.scrollHeight/10*7);
		});

		$('.gift_list_text_box').find('textarea').keyup();
	}	

});