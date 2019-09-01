


function comment_view(t_idx){
//FAQ 답변
	if($("#faq_comment_"+t_idx).css("display") == "none"){
		$.ajax({

			type : "post",
			url : "/service_center/faq/qna_rpy_view",
			data : {
				"t_idx" : t_idx
			},
			cache : false,
			async : false,
			success : function(result){

				$("#faq_comment_"+t_idx).prev().find(".qna_title").addClass('color_ea3c3c');
				$("#faq_comment_"+t_idx).prev().find("img").attr("src","/images/service_center/faq_up.gif"); 

				$("#faq_comment_"+t_idx).html(result);
				$("#faq_comment_"+t_idx).css("display", "block");	

			},
			error : function(result){
				alert("실패");
			}
		});
	}else{
		
		$("#faq_comment_"+t_idx).css("display", "none");
		$("#faq_comment_"+t_idx).prev().find(".qna_title").removeClass('color_ea3c3c');
		$("#faq_comment_"+t_idx).prev().find("img").attr("src","/images/service_center/faq_down.gif"); 
	}

}



function faq_cate(seg,faq_title,faq_sub){
//2차 카테고리 분류
	
	faq_title = faq_title.replace('/','|');
	faq_sub = faq_sub.replace('/','|');
	
	var faq_title = encodeURI(faq_title);
	var faq_sub = encodeURI(faq_sub);
	
	
	
	location.href="/service_center/faq/"+seg+"/f1/"+faq_title+"/f2/"+faq_sub;

}


$(document).ready(function() {
	
	//FAQ 카테고리 선택
	$('ul#faq_cate li').click(function(e){
		$('.faq_cate_on').removeClass("faq_cate_on");
		$(this).addClass("faq_cate_on");
	});	
});