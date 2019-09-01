// 앤등록하기 실행
function anne_submit(m_userid, m_nick)
{
	if($("#anne_memo").val() == "")
	{ 
		alert("메모를 입력해주세요"); 
		$("#anne_memo").focus(); 
		return false;
	}

	$.ajax({
		type: "post",
		url: "/friend/anne_add/anne_submit",
		data: {
			"m_dbcontent": encodeURIComponent($("#anne_memo").val()),
			"m_fuserid": encodeURIComponent(m_userid),
			"m_fnick": encodeURIComponent(m_nick)
		},
		cache: false,
		async: false,
		success: function(data) {
			result = data;
		}
	}); 

	if ( result == "1" )
	{
		alert("정상적으로 등록되었습니다");
		modal.close();
	}
	else if( result == "3" )
	{
		alert("이미 등록된 앤 입니다.");
		modal.close();
	}
	else
	{
		alert("등록에 실패하였습니다. (" + result + ")");
	}

}