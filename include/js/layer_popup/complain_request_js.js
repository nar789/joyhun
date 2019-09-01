


// 사진등록 디자인
$(document).ready(function(){
	var fileTarget = $('.normal_filebox #comp_upload');

	fileTarget.on('change', function(){  // 값이 변경되면
		if(window.FileReader){  // modern browser
			var filename = $(this)[0].files[0].name;
		}else {  // old IE
			var filename = $(this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
		}

		// 추출한 파일명 삽입
		$(this).siblings('.upload_name').val(filename);
	});

}); 



var btn_count = 0;

// 닉네임 검색하기
function comp_nick_find(){

	if ($("#comp_nick").val() == ''){

		alert("불량이용자의 닉네임을 입력해주세요.");
		return false;

	}

	$.ajax({
		type: "POST",
		url: "/service_center/joy_police/complain_nick_check",
		data: {
			"m_nick": encodeURIComponent($("#comp_nick").val())
		},
		cache: false,
		async: false,
		success: function(data) {

			if (data == '1'){
				$("#comp_check_btn").hide();
				$("#comp_check_text").css('display','inline-block');
				$("#comp_check_text").css('margin-left','10px');
				$("#comp_check_text").text("확인되었습니다.");
				btn_count++;
			} else {
				
				$("#comp_check_text").css('display','inline-block');
				$("#comp_check_text").css('margin-top','4px');
				$("#comp_check_text").css('margin-left','0px');
				$("#comp_check_text").text("존재하지 않는 닉네임입니다. \n다시한번 확인해주세요.");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}

$('#comp_nick').click(function(){     
   $('#comp_nick').val('');
	$("#comp_check_text").css('display','none');
});


function comp_request(cate){

	// MOBILE.ver
	if (cate == 'mobile'){

			if ($("#comp_cate").val() == ''){		 alert("신고사유를 선택해주세요."); return false;
			}else if ($("#comp_content").val() == ''){   alert("신고내용을 입력해주세요.");	return false;
			}

			$('#upload_form').submit();

	// PC.ver
	}else if (cate == 'pc'){

			if ($("#comp_nick").val() == ''){			 alert("불량이용자의 닉네임을 입력해주세요.");	return false;
			}else if (btn_count == 0){  				 alert("불량이용자의 닉네임을 검색해주세요.");  return false;
			}else if ($("#comp_cate").val() == ''){		 alert("신고사유를 선택해주세요."); return false;
			}else if ($("#comp_content").val() == ''){   alert("신고내용을 입력해주세요.");	return false;
			}

			$('#upload_form').submit();

	}

}