//사진등록 넘기기

$(document).ready(function(){


		//사진 업로드 폼전송
		$('#upload_form').ajaxForm({
		   //보내기전 validation check가 필요할경우
				beforeSubmit: function (data, frm, opt) {
					if($("#user_upload_pic").val() == ""){
						alert("업로드 할 사진을 선택해 주세요.");
						$("#user_upload_pic").focus();
						return false;
					}
					return true;
				},
				//submit이후의 처리
				success: function(responseText, statusText){
					if(responseText == '1'){
						alert("업로드되었습니다. 관리자의 확인후 인증이 완료됩니다.");
						location.reload();
					}else if(responseText == "app_grade"){
						alert("업로드되었습니다.");
						modal.close();
					}else if(responseText == ""){
						return;
					}else{
						alert(responseText);
					}
				},
				//ajax error
				error: function(){
					alert("사진 업로드중 에러가 발생하였습니다.");
				}
		});

});

// 사진등록 디자인
$(document).ready(function(){
	var fileTarget = $('.filebox #user_upload_pic');

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