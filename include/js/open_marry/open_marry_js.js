
//공개구혼 검색
function open_guhon_search(url){
	
	var m_type			 = encodeURIComponent($("#m_type").val());				//구혼형태
	var m_conregion		 = encodeURIComponent($("#m_conregion").val());			//지역
	var m_sex			 = encodeURIComponent($("#m_sex").val());				//성별
	var m_age			 = encodeURIComponent($("#m_age").val());				//나이대
	
	if(m_type == "" && m_conregion == "" && m_sex == "" && m_age == ""){
		location.href = escape("/open_marry/open_marry/"+url);	
	}else{
		location.href = escape("/open_marry/open_marry/"+url+"/m_type/"+m_type+"/m_conregion/"+m_conregion+"/m_sex/"+m_sex+"/m_age/"+m_age);	
	}
	

}

//공개구혼 등록
function reg_open_guhon(m_gubn){

	if($("#m_msg").val() == ""){ alert("메세지를 입력하세요."); $("#m_msg").focus(); return;}

	$.ajax({

		type : "post",
		url : "/open_marry/open_marry/reg_open_guhon",
		data : {

			"b_type"			: encodeURIComponent(m_gubn),
			"b_content"			: encodeURIComponent($("#m_msg").val())

		},
		cache : false,
		async : false,
		success : function(result){
			if (result == '1'){
				alert("등록되었습니다.");
				window.location.reload();
			}else if(result == '44'){
				alert("휴대폰 본인인증 후 사용이 가능합니다.");
				location.href='/profile/main/user';
			}else if(result == '909'){
				alert("정회원 가입후 사용이 가능합니다.");
				location.href='/profile/point/point_charge';					
			}else{
				alert("실패하였습니다. (" + result + ")");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});

}


// 이미지 없는사람은 대표사진등록으로 보이게
$(document).ready(function() {
	if($("#noimg_check div").hasClass("girl_icon") === true || $("#noimg_check div").hasClass("man_icon") === true) {
		$('.top_textarea_img div.girl_icon').css('display','none');
		$('.top_textarea_img div.man_icon').css('display','none');
		$('#noimg_check').html('<a href="#" onclick="go_profile();"><span>대표사진 등록</span></a>');
	}
});

function go_profile(){

	location.href='/profile/main/user';

}