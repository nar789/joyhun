// 사진등록 디자인
$(document).ready(function(){
	var fileTarget = $('.normal_filebox #adver_file');

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



function bu_email_chg(){		// 이메일 자동완성

	var sel = document.getElementById("bu_email_select");
	var email_after = document.getElementById("bu_email_after");
	var val = sel.options[sel.selectedIndex].value;
	
	if (val == '1'){
		email_after.value = '';
		email_after.focus();
	}else{

		email_after.value = val;
	}
}


$(document).ready(function(){

		$("input:text[name=bu_ph]").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
		$("input:text[name=bu_email_1]").keyup(function(){$(this).val( $(this).val().replace(/[^\!-z]/g,"") );} );

		$('#business_form').ajaxForm({
		   //보내기전 validation check가 필요할경우
			beforeSubmit: function (data, frm, opt) {

				if ($("#bu_name").val() == ''){				 alert("이름을 입력해주세요.");	$("#bu_name").focus(); return false;
				}else if ($("#bu_company").val() == ''){	 alert("회사명을 입력해주세요."); $("#bu_company").focus(); return false;
				}else if ($("#bu_ph").val() == ''){			 alert("연락처를 입력해주세요."); $("#bu_ph").focus(); return false;
				}else if ($("#bu_email_1").val() == ''){     alert("이메일을 입력해주세요."); $("#bu_email_1").focus(); return false;
				}else if ($("#bu_email_after").val() == ''){ alert("이메일을 입력해주세요."); $("#bu_email_after").focus(); return false;
				}else if ($("#bu_info").val() == ''){		 alert("회사소개를 입력해주세요."); $("#bu_info").focus();	return false;
				}else if ($("#bu_content").val() == ''){	 alert("문의내용을 입력해주세요.");	$("#bu_content").focus(); return false;
				}else if ($("input:checkbox[name='bu_agree']").is(":checked") == false){		 alert("정보제공에 동의해주세요.");	return false;
				}else{ return true; }
			},
			//submit이후의 처리
			success: function(responseText){
				if(responseText == '1'){
					alert("감사합니다. 확인후 빠른 답변보내드리겠습니다.");
					location.reload();
				}else{
					alert(responseText);
				}
			},
			//ajax error
			error: function(){
				alert("신고 접수중 에러가 발생하였습니다.");
			}
		});

});
