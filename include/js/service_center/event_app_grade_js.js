$(document).ready(function(){

	if(is_mobile == true){
		imageMap('app_grade_top','760',251,603,414,644,'app_down');		//조이헌팅 앱 다운받기
		imageMap('app_grade_top','760',60,342,283,387,'app_score1');	//별점 등록하러 가기
		imageMap('app_grade_top','760',252,773,413,814,'app_score2');	//별점 등록하러 가기
	}

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
				alert("이벤트에 참여되었습니다.");
				$(location).attr("href", "/service_center/event/app_grade");
			}else if(responseText >= '150'){
				alert('이벤트 참여가 종료 되었습니다.');
				return;
			}else{
				alert(responseText);
			}
		},
		//ajax error
		error: function(){
			alert("사진 업로드중 에러가 발생하였습니다.\n다시 시도하여 주시기 바랍니다.");
			$(location).attr("href", "/service_center/event/app_grade");
		}
	});

	//파일명 변경
	var fileTarget = $('.app_grade_main #user_upload_pic');

	fileTarget.on('change', function(){  // 값이 변경되면
		if(window.FileReader){  // modern browser
			var filename = $(this)[0].files[0].name;
		}else {  // old IE
			var filename = $(this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
		}

		// 추출한 파일명 삽입
		$(this).siblings('#file_name').val(filename);
	});
	
	//휴대전화번호 숫자만 입력
	$(".user_phone").on("keyup", function(){
		$(this).val( $(this).val().replace(/[^0-9]/gi,"") );
	})

	//이벤트 등록하기
	$("#btn_submit").on("click", function(){
		
		if($("#user_name").val() == ""){ alert("구글이름을 입력하세요."); $("#user_name").focus(); return; }
		if($("#file_name").val() == ""){ alert("사진을 업로드하세요."); $("#file_name").focus(); return; }
		if($("#user_hp_1").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#user_hp_1").focus(); return; }
		if($("#user_hp_2").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#user_hp_2").focus(); return; }
		if($("#user_hp_3").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#user_hp_3").focus(); return; }

		$("#upload_form").submit();

	});

	//이벤트 수정하기
	$("#btn_update").on("click", function(){
		$(location).attr("href", "/service_center/event/app_grade/gubn/up");
	});

});

//등록된 사진 보기
function user_pic_view(){

	var v_width = ($(window).width()/10)*9;

	if(v_width >= 450){
		v_width = 400;
	}

	$.get("/service_center/event/reg_user_pic_layer/"+Math.random(), function(data){
		if(data == "1000"){
			alert("잘못된 접근입니다.");
			return;
		}else{
			modal.open({ content:data, width:v_width, top:50 })
		}		
	});
}

