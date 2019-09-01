// 친구등록하기 입력
function friend_submit(m_userid, m_nick)
{
	if($("#friend_memo").val() == "")
	{ 
		alert("메모를 입력해주세요"); 
		$("#friend_memo").focus(); 
		return false;
	}

	else if ( $("#friend_group").val() == "" )
	{
		alert("그룹을 선택해주세요."); 
		$("#friend_group").focus(); 
		return false;
	}
	
	if(confirm("친구등록 하시겠습니까?") == true)
	{	

		$.ajax({
			type: "post",
			url: "/friend/friend_add/friend_submit",
			data: {
				"m_fuserid"		: encodeURIComponent(m_userid),
				"m_gname"       : encodeURIComponent($("#friend_group").val()),
				"m_content"     : encodeURIComponent($("#friend_memo").val()),
				"m_fnick"       : encodeURIComponent(m_nick)
			},
			cache: false,
			async: false,
			success: function(data) {
				result = data;
			}
		});

		if(result == '1'){
			alert("정상적으로 등록되었습니다!");
			modal.close();
		}else if (result == '3'){
			alert("이미 등록된 친구입니다. ");
			modal.close();
		}else if (result == '5'){
			alert("이미 나쁜친구로 등록되어있습니다.. ");
			modal.close();
		}else{
			alert("등록에 실패하였습니다. (" + result + ")");
		}


	}	
}