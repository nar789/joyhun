

//결혼신청 레이어팝업 띄우기
function m_request(idx){
	$.get('/open_marry/marriage/m_request_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data, width : 620});
	});
}


//유저상세정보보기
function m_request_user(m_userid){

	$.ajax({

		type : "post",
		url : "/open_marry/marriage/check_marriage",
		data : {
			m_userid : m_userid
		},
		cache : false,
		async : false,
		success : function(result){

			if (result == '1'){
				$.get('/open_marry/marriage/m_request_popup/m_userid/'+m_userid+'/'+Math.random(), function(data){
					modal.open({content: data, width : 620});
				});
			// 안했으면 경고창
			}else if(result == '909'){
				alert('정회원 가입후 사용이 가능합니다.');location.href='/profile/point/point_charge';
			}else{
				alert("먼저 결혼신청을 등록해 주세요.");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
	
}

//결혼신청 성별검색 기능
function search_sex(url, sex){

	location.href="/open_marry/marriage/"+url+"/sex/"+ sex + "/";
}

//결혼신청 등록하기
function reg_open_marry(){

	var m_hobby = "";	//선택취미
	
	if($("#m_title").val() == ""){alert("제목을 입력하세요."); $("#m_title").focus(); return;}
	if($("#m_content").val() == ""){alert("내용을 입력하세요."); $("#m_content").focus(); return;}
	if($("#m_incom").val() == ""){alert("최종학력을 선택하세요."); $("#m_incom").focus(); return;}
	if($("#m_job").val() == ""){alert("직업을 선택하세요."); $("#m_job").focus(); return;}
	if($("#m_brother1").val() == ""){alert("형제관계를 선택하세요."); $("#m_brother1").focus(); return;}
	if($("#m_brother2").val() == ""){alert("형제관계를 선택하세요."); $("#m_brother2").focus(); return;}
	if($("#m_brother3").val() == ""){alert("형제관계를 선택하세요."); $("#m_brother3").focus(); return;}
	if($("#m_attainment").val() == ""){alert("연소득을 선택하세요."); $("#m_attainment").focus(); return;}
	if($("#m_car").val() == ""){alert("차량을 선택하세요."); $("#m_car").focus(); return;}
	if($("#m_faith").val() == ""){alert("종교를 선택하세요."); $("#m_faith").focus(); return;}
	
	//취미 checkbox 합산
	$('div').find('input:checkbox').each(function(){
		
		if($(this).is(":checked") == true){
			
			if(m_hobby == ""){
				m_hobby = $(this).val();
			}else{
				m_hobby = m_hobby+","+$(this).val();
			}
		}

	});

	$.ajax({

		type : "post",
		url : "/open_marry/marriage/reg_open_marry",
		data : {

			"m_title"				: $("#m_title").val(),
			"m_content"				: $("#m_content").val(),
			"m_incom"				: $("#m_incom").val(),
			"m_job"					: $("#m_job").val(),
			"m_brother"				: $("#m_brother1").val()+","+$("#m_brother2").val()+","+$("#m_brother3").val(),
			"m_attainment"			: $("#m_attainment").val(),
			"m_car"					: $("#m_car").val(),
			"m_faith"				: $("#m_faith").val(),
			"m_hobby"				: m_hobby,
			"m_hobby_text"			: $("#m_hobby_text").val()

		},
		cache : false,
		async : false,
		success : function(result){

			if (result == '1'){
				alert("저장되었습니다.");
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

//결혼신청 회원검색하기
function search_list(){
	
	if($("#m_conregion").val() == ""){ alert("원하는 지역을 선택하세요."); $("#m_conregion").focus(); return;};
	if($("#m_age").val() == ""){ alert("원하는 나이를 선택하세요."); $("#m_age").focus(); return;};

	//결혼
	if($("#marry_type").val() == "결혼"){
		
		var marry_type		= encodeURIComponent($("#marry_type").val());
		var m_conregion		= encodeURIComponent($("#m_conregion").val());
		var m_age			= encodeURIComponent($("#m_age").val());

		if($("#marry_img_confirm").is(":checked")){
			var file_ok = "1";
		}

		location.href = escape("/open_marry/marriage/marry_list/marry_type/"+marry_type+"/m_conregion/"+m_conregion+"/m_age/"+m_age+"/file_ok/"+file_ok);

	//재혼
	}else{
		
		var marry_type		= encodeURIComponent($("#marry_type").val());
		var m_conregion		= encodeURIComponent($("#m_conregion").val());
		var m_age			= encodeURIComponent($("#m_age").val());

		if($("#marry_img_confirm").is(":checked")){
			var file_ok = "1";
		}

		location.href = escape("/open_marry/remarriage/remarriage_list/marry_type/"+marry_type+"/m_conregion/"+m_conregion+"/m_age/"+m_age+"/file_ok/"+file_ok);
	}

}