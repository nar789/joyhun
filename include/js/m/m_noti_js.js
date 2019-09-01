$(document).ready(function(){
	
	//더보기
	/*
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");
		
		$.ajax({

			type : "post",
			url : "/service_center/notice/notice_more",
			data : {
				"page" : page
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "0"){
					alert("마지막 페이지입니다.");
				}else{
					
					$("#notice_list").append(result);
					page = parseInt(page)+1;
					$("#more").attr("page", page);

				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});*/

	// more 하고 스크롤
	if($("#notice_list").attr('alt')){

		var num = $("#notice_list").attr('alt');
		var aTag = $("#"+num);
		$('html,body').animate({scrollTop: aTag.offset().top},'slow');
	}



	var test = $(window).height();

	$("#noti_box").css("min-height",test-200);




});



function comment_view(t_idx){

	if($("#m_noti_comt_"+t_idx).css("display") == "none"){

		$("#m_noti_comt_"+t_idx).prev().prev().find(".board_title").addClass('color_ea3c3c');
		$("#m_noti_comt_"+t_idx).prev().prev().find(".board_day").addClass('color_ea3c3c');
		$("#m_noti_comt_"+t_idx).prev().prev().find("img").attr("src","/images/service_center/faq_up.gif"); 
		$("#m_noti_comt_"+t_idx).css("display", "block");

	}else{
		
		$("#m_noti_comt_"+t_idx).css("display", "none");
		$("#m_noti_comt_"+t_idx).prev().prev().find(".board_title").removeClass('color_ea3c3c');
		$("#m_noti_comt_"+t_idx).prev().prev().find(".board_day").removeClass('color_ea3c3c');
		$("#m_noti_comt_"+t_idx).prev().prev().find("img").attr("src","/images/service_center/faq_down.gif");

	}

}