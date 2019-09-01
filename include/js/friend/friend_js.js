//내PR하기 등록
function form_check() 
{

	if($("#m_content").val() == "")
	{
		alert("내용을 입력해 주십시오");
		$("#m_content").focus();
	}
	else
	{
		var m_content = $("#m_content").val();

		$.ajax({
			type: "post",
			url: "/friend/friend_add/reg_fri",
			data: {
				"m_content": encodeURIComponent((m_content)),
			},
			cache: false,
			async: false,
			success: function(result) {
				if ( result == "1" ){
					alert("정상적으로 등록되었습니다");
					location.href = "/friend/friend_add/make_friend/sex";
				} else if( result == "3" ) {
					alert("내 PR하기는 하루에 1번만 작성가능합니다.");
				} else {
					alert("게시물 등록에 실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("게시물 등록에 실패하였습니다. (" + result + ")");
			}
		}); 


	}

}


// 성별 Tab 기능
function search_sex(str,sex)
{
	location.href="/friend/friend_add/"+ str + "/sex/"+ sex + "/";
}



function top_frined_add(){

	var nick_check = $("input[name=friend_add_id]").val();
	var group_check = $("select[name=friend_add_group]").val();
	var memo_check = $("input[name=friend_add_memo]").val();

	if (nick_check == ''){
		alert("검색할 아이디를 입력하세요");
		return false;
	}else if (group_check == ''){
		alert("그룹을 선택해주세요");
		return false;
	}else if (memo_check == ''){
		alert("메모를 입력해주세요");
		return false;
	}

	$.ajax({
		type: "post",
		url: "/friend/friend_add/chek_fri",
		data: {
			"m_nick": encodeURIComponent(nick_check)
		},
		cache: false,
		async: false,
		success: function(result) {

			if(result == '909'){
				alert('정회원 가입후 사용이 가능합니다.');
				location.href='/profile/point/point_charge';
			}else if (result == '0'){
				alert("해당 닉네임의 회원이 없습니다.\n닉네임을 다시 확인해주세요.");
			}else if(result > 0){
				friend_request_nick(nick_check,group_check,memo_check);
			}else{
				alert("휴대폰 본인인증 후 사용이 가능합니다.");
				location.href='/profile/main/user';
			}
		},
		error : function(result){
			alert("친구등록에 실패하였습니다. (" + result + ")");
		}
	}); 

}