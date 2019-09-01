

/* 토크 댓글창 toggle */
function comment_view2(idNum, etc){
	$("#talk_comment_"+idNum).toggle();

	var arrow = etc.childNodes.item(4);

	$(arrow).toggleClass("arrow_rotate");

}

//토크 등록
function talk_insert(v_userid, v_gubn){

	if(v_userid == ""){
		alert("로그인 후에 글등록이 가능합니다.");
		return;
	}

	if($("#t_context").val() == ""){ alert("내용을 입력하세요."); $("#t_context").focus(); return;}

	$.ajax({

		type : "post",
		url : "/etc/talk/reg_talk",
		data : {
			"t_context"			: encodeURIComponent($("#t_context").val()),
			"t_gubn"			: encodeURIComponent(v_gubn)
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == '909'){
				alert('정회원 가입후 사용이 가능합니다.');
				location.href='/profile/point/point_charge';
			}else if (result == '666'){
				alert("토크는 하루 1건만 작성가능합니다.");
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


//댓글 보기 
function comment_view(t_idx, v_userid){
	
	if(v_userid == ""){
		alert("로그인 후에 댓글보기가 가능합니다.");
		return;
	}

	if($("#talk_comment_"+t_idx).css("display") == "none"){

		$.ajax({

			type : "post",
			url : "/etc/talk/comment_view",
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
		url : "/etc/talk/reg_reply",
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
			url : "/etc/talk/del_reply",
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



// 이미지 없는사람은 대표사진등록으로 보이게
$(document).ready(function() {
	if($("#noimg_check div").hasClass("girl_icon") === true || $("#noimg_check div").hasClass("man_icon") === true) {
		$('.top_textarea_img div.girl_icon').css('display','none');
		$('.top_textarea_img div.man_icon').css('display','none');
		$('#noimg_check').html('<a href="#" onclick="go_profile();"><span>대표사진 등록</span></a>');
	}


	//더보기(more)버튼 클릭시 이벤트
	$("#more").on("click", function(){
		
		var page = $(this).attr("page");
		
		$.ajax({

			type : "post",
			url : "/etc/talk/talk_list_more",
			data : {
				"page" : page
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

function go_profile(){

	location.href='/profile/main/user';

}

//비밀톡챗신청(more부분) 리다이렉트
function redirect_chat(i){
	chat_request($("#aaa"+i).attr("m_userid"));
}

//자기 토크 글 삭제
function user_talk_del(num){
	
	if(num == ""){ alert('잘못된 접근입니다.'); return; }

	if(confirm("토크를 삭제 하시겠습니까?") == true){
		
		$.ajax({
			type : "post",
			url : "/etc/talk/user_talk_del",
			data : {
				"num" : num
			},
			cache : false,
			async : false,
			success : function(result){
				
				var rtn = "";
				switch(result){
					case "0" : rtn = "토크 삭제에 실패했습니다."; break;
					case "1" : rtn = "토크가 삭제되었습니다."; break;
					case "1000" : rtn = "잘못된접근입니다."; break;
					case "1001" : rtn = "본인글만 삭제 가능합니다."; break;
					default : rtn = "잘못된접근입니다."; break;
				}

				alert(rtn);
				location.reload();

			},
			error : function(result){
				alert("실패("+ result +")");
				return;
			}
		});

	}

}