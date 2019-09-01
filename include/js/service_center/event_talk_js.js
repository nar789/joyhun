//겨울이벤트 PC, MOBILE 공용 스크립트(단발성)

$(document).ready(function(){
	
	//더보기(more)버튼 클릭시 이벤트
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");
		var rp = $(this).attr("rp");
		
		$.ajax({

			type : "post",
			url : "/service_center/event_talk/talk_list_more",
			data : {
				"page" : page,
				"rp"   : rp
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == "0"){
					alert("마지막 페이지입니다.");
				}else{
					
					$("#tbl").append(result);
					page = parseInt(page)+1;
					$("#more").attr("page", page);

				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	});

});

//안부보내기 버튼 클릭 이벤트
function msg_member(){
	
	if($("#t_context").val() == ""){ alert("내용을 입력하세요."); $("#t_context").focus(); return; }

	if(confirm("안부를 보내시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/service_center/event_talk/reg_talk",
			data : {
				"user_array"	: encodeURIComponent($("#user_array").val()),
				"t_context"		: encodeURIComponent($("#t_context").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == '909'){
					alert('정회원 가입후 사용이 가능합니다.');
					location.href='/profile/point/point_charge';
				}else if (result == '666'){
					alert("안부보내기는 하루 1건만 작성가능합니다.");
					window.location.reload();
				}else if (result == '1'){
					alert("등록되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다. (" + result + ")");
				}

			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}

		});

	}

}


//댓글 보기 
function comment_view(t_idx, v_userid){
	
	if(v_userid == ""){
		alert("로그인 후에 댓글보기가 가능합니다.");
		return;
	}

	if($("#talk_comment_"+t_idx).css("display") == "none"){

		$.ajax({

			type : "post",
			url : "/service_center/event_talk/comment_view",
			data : {
				"t_idx" : encodeURIComponent(t_idx)
			},
			cache : false,
			async : false,
			success : function(result){
				$("#talk_comment_"+t_idx).html(result);
				$("#talk_comment_"+t_idx).css("display", "block");
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}

		});
		
		$("#arrow_"+t_idx).removeClass("comment_arrow");
		$("#arrow_"+t_idx).addClass("comment_arrow2");

	}else{
		
		$("#talk_comment_"+t_idx).css("display", "none");

		$("#arrow_"+t_idx).removeClass("comment_arrow2");
		$("#arrow_"+t_idx).addClass("comment_arrow");
	}

	

}


//댓글등록
function reg_reply(t_idx){

	if($("#r_context"+t_idx).val() == ""){ alert("댓글을 입력하세요."); $("#r_context"+t_idx).focus(); return;}

	$.ajax({

		type : "post",
		url : "/service_center/event_talk/reg_reply",
		data : {
			"t_idx"				: t_idx,
			"r_context"			: encodeURIComponent($("#r_context"+t_idx).val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			alert("등록되었습니다.");
			$("#rpy_cnt_"+t_idx).html(result);
			$("#talk_comment_"+t_idx).css("display", "none");
			comment_view(t_idx);
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});

}

//댓글삭제
function del_reply(r_idx, t_idx){
	
	if(confirm("삭제하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/service_center/event_talk/del_reply",
			data : {
				"r_idx" : encodeURIComponent(r_idx),
				"t_idx" : encodeURIComponent(t_idx)
			},
			cache : false,
			async : false,
			success : function(result){

				alert("삭제되었습니다.");
				$("#rpy_cnt_"+t_idx).html(result);
				$("#talk_comment_"+t_idx).css("display", "none");
				comment_view(t_idx);	
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}

		});
	}

}