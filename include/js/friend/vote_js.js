$(document).ready(function(){

});

//상단 투표하기 버튼 클릭 이벤트
function member_vote(m_code){

	if($("input[name='poll']").is(":checked") == false){ alert("투표 내용을 선택하세요."); return;}

	$.ajax({

		type : "post",
		url : "/friend/vote_poll/reg_member_vote",
		data : {
			"m_code"		: encodeURIComponent(m_code),
			"m_example"		: encodeURIComponent($("input[name='poll']:checked").val())
		},
		cache : false,
		async : false,
		success : function(result){
			if(result == "1"){
				alert("투표되었습니다.");
				$(location).attr("href", "/friend/vote_poll/poll_view/m_code/"+m_code);
			}else if(result == "0"){
				alert("투표에 실패했습니다 ("+result+")");
			}else if(result == "9"){
				alert("이미 투표하셨습니다.");
				return; 
			}else if(result == "8"){
				alert("투표가 종료되었습니다.");
				return; 
			}else if(result == "909"){
				alert("정회원 가입후 이용해주세요.");
				$(location).attr("href", "/profile/point/point_charge");
				return; 
			}else{
				alert("잘못된 접근입니다. ("+result+")");
			}
		},
		error : function(result){
			alert("실패하였습니다. ("+result+")");
		}

	});

}

//투표 참여하기 버튼 이벤트
function vote_poll(m_code){
	$(location).attr("href", "/friend/vote_poll/poll_list/m_code/"+m_code);
}

//투표 현황보기 버튼 이벤트
function vote_poll_view(m_code){
	$(location).attr("href", "/friend/vote_poll/poll_view/m_code/"+m_code);
}

// 처음 참여회원 보기면 자신이 선택한걸로 보이기
function poll_my_view(user,idx){

	$.ajax({

		type : "post",
		url : "/friend/vote_poll/chk_view",
		data : {
			"user"		: encodeURIComponent(user),
			"idx"		: encodeURIComponent(idx)
		},
		cache : false,
		async : false,
		success : function(result){
			if(result == '666'){
				alert("실패하였습니다. ("+result+")");
			}else{
				var my_arr = result.split(',');
				$(location).attr("href", "/friend/vote_poll/poll_view/m_code/"+my_arr[1]+"/m_idx/"+my_arr[0]);
			}
		},
		error : function(result){
			alert("실패하였습니다. ("+result+")");
		}

	});

}

//참여인원 보기
function poll_view_member(code, idx){	
	if(idx == ""){
		alert('잘못된 접근입니다.');
		return;
	}else{
		$(location).attr("href", "/friend/vote_poll/poll_view/m_code/"+code+"/m_idx/"+idx);
	}
}


//참여회원보기
function poll_detail_view(){
	$(".poll_detail_box").slideToggle("slow");

	var src = ($(".show_img").attr("src") === "/../../../images/friend/yell_arrow_up.png")
		? '/../../../images/friend/yell_arrow_down.png'
		: '/../../../images/friend/yell_arrow_up.png';
	$(".show_img").attr("src", src);
}

//리플달기
function reg_vote_reply(m_code){
	
	if($("#m_reply").val() == ""){ alert("리플 내용을 입력하세요."); $("#m_reply").focus(); return; }
	
	$.ajax({
		
		type : "post",
		url : "/friend/vote_poll/reg_vote_reply",
		data : {
			"m_code"		: encodeURIComponent(m_code),
			"m_reply"		: encodeURIComponent($("#m_reply").val())
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1"){
				alert("저장되었습니다.");
				location.reload();
			}else if(result == "0"){
				alert("실패했습니다. ("+result+")");
			}else{
				alert("잘못된 접근입니다. ("+result+")");
			}
		},
		error : function(result){
			alert("실패 ("+result+")");
		}

	});

}

//본인의 댓글 삭제하기
function rp_del(m_code, m_write_day){

	if(confirm("댓글을 삭제하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/friend/vote_poll/rp_del",
			data : {
				"m_code"		: encodeURIComponent(m_code),
				"m_write_day"	: encodeURIComponent(m_write_day)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("삭제되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("실패했습니다. ("+result+")");
				}else{
					alert("잘못된 접근입니다. ("+result+")");
				}
			},
			error : function(result){
				alert("실패 ("+result+")");
			}

		});

	}
	
}