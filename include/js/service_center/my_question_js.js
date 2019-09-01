function my_question_list(page){
	location.href="/service_center/my_question/my_question_list/page/"+page;
}

function my_question_del(f_num,page){
	alert("삭제하시겠습니까?");

	$.ajax({
			type : "post",
			url : "/service_center/my_question/my_question_del",
			data : {
					"f_num" : encodeURIComponent(f_num)
			},
			cache : false,
			async : false,
			success : function(result){
				if ( result == true )
				{
					alert("정상적으로 삭제되었습니다");
					location.href="/service_center/my_question/my_question_list/page/"+page;						
				}
			},
			error : function(result){
				alert("실패"+result);
			}
	});
}