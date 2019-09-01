//소셜프로필등록하기 버튼클릭
function socialting_add(){
	$.get('/meeting/socialting/socialting_add_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});

}



//소셜팅 성별검색 기능
function search_sex(url, sex){
	
	location.href="/meeting/socialting/"+url+"/sex/"+ sex + "/";
}



//소셜팅 프로필 등록하기
function profile_insert(){

	if($("#m_content").val() == ''){
		alert("소개글을 입력해주세요.");
		$("#m_content").focus();
		return false;
	}
	
	if(confirm("저장하시겠습니까?") == true){

		var v_result = "";

		$.ajax({
			
			type : "post",
			url : "/meeting/socialting/reg_socialting",
			data : {
				
				"m_content"			: encodeURIComponent($("#m_content").val()),
				"m_kakao"			: encodeURIComponent($("#m_kakao").val()),
				"m_nateon"			: encodeURIComponent($("#m_nateon").val()),
				"m_cyworld"			: encodeURIComponent($("#m_cyworld").val()),
				"m_facebook"		: encodeURIComponent($("#m_facebook").val()),
				"m_facebook_url"	: encodeURIComponent($("#m_facebook_url").val()),
				"m_twitter"			: encodeURIComponent($("#m_twitter").val()),
				"m_me2day"			: encodeURIComponent($("#m_me2day").val())

			},
			cache: false,
			async: false,
			success : function(data){
				if (result == true){
					alert("저장되었습니다.");
					location.href="/meeting/socialting/social_list/sex/";
				}else{
					alert("실패하였습니다. (" + result + ")");
				}
		
			},
			error : function(data){
				alert("실패하였습니다. (" + result + ")");
			}
		});

	}
		

	
}

//소셜팅 프로필 수정하기
function profile_update(){

	if($("#m_content").val() == ''){
		alert("소개글을 입력해주세요.");
		$("#m_content").focus();
		return false;
	}

	if(confirm("수정하시겠습니까?") == true){
		
		var v_result = "";

		$.ajax({
			
			type : "post",
			url : "/meeting/socialting/mod_socialting",
			data : {

				"m_idx"				: encodeURIComponent($("#m_idx").val()),
				"m_userid"			: encodeURIComponent($("#m_userid").val()),
				"m_content"			: encodeURIComponent($("#m_content").val()),
				"m_kakao"			: encodeURIComponent($("#m_kakao").val()),
				"m_nateon"			: encodeURIComponent($("#m_nateon").val()),
				"m_cyworld"			: encodeURIComponent($("#m_cyworld").val()),
				"m_facebook"		: encodeURIComponent($("#m_facebook").val()),
				"m_facebook_url"	: encodeURIComponent($("#m_facebook_url").val()),
				"m_twitter"			: encodeURIComponent($("#m_twitter").val()),
				"m_me2day"			: encodeURIComponent($("#m_me2day").val())

			},
			cache : false,
			async : false,
			success : function(result){
				if (result == '1'){

					alert("수정되었습니다.");
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


//소셜팅 프로필 삭제하기
function profile_delete(){

	if(confirm("삭제하시겠습니까?") == true){

		$.ajax({
			
			type : "post",
			url : "/meeting/socialting/remove_socialting",
			data : {
				"m_userid"			: encodeURIComponent($("#m_userid").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if (result == '1'){
					alert("삭제되었습니다.");
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

//연락처 확인하기
function show_socialting(m_idx, m_userid){
	
	$.get('/meeting/socialting/socialting_check_popup/m_idx/'+m_idx+'/m_userid/'+m_userid+'/'+Math.random(), function(data){
		modal.open({content: data, width : 520});
		
	});
	
}