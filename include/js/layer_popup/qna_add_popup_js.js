

$(document).ready(function(){

	$.get('/service_center/faq/faq_cate1_call/sel1_val/all/'+Math.random(), function(data){

		var txt = data.split('♬');
		jQuery.each( txt, function( index, val ) {
		  $( "#qna_cate_select" ).append("<option value='"+(index+1)+"'>" + val + "</option>");
		});
	});

	var null_chk = $("#qna_cate_select > option:selected").val();

  
});


 
function qna_select(sel1_val,sel2){ 

	var null_chk = $("#qna_cate_select > option:selected").val();

	if (null_chk != 'undefined' && null_chk != '' ){			//1차분류가 선택되어있으면

		$("#"+sel2).css("display", "inline-block");

		$.get('/service_center/faq/faq_cate2_call/sel1_val/'+sel1_val+'/'+Math.random(), function(data){
		
			$("#"+sel2).empty();	//option값 비우기

			var txt = data.split('♬');

			jQuery.each( txt, function( index, val ) {
				$("#"+sel2).append("<option value='"+index+"'>" + val + "</option>");
			});
		});


	}else{													//1차분류가 선택되어 있지않으면

		$("#"+sel2).css("display", "none");
	}
} 


function email_chg(){		// 이메일 자동완성

	var sel = document.getElementById("faq_email_select");
	var email_after = document.getElementById("qna_email_after");
	var val = sel.options[sel.selectedIndex].value;
	
	if (val == '1'){
		email_after.value = '';
		email_after.focus();
	}else{

		email_after.value = val;
	}
}

//고객상담 문의하기
function faq_submit(mode){
	//폼검사
	if(!$("#qna_title").val()){
		alert("제목을 입력하세요"); $("#qna_title").focus(); return false;
	}
	if(!$("#qna_cate_select").val()){
		alert("대분류를 입력하세요"); $("#qna_cate_select").focus(); return false;
	}
	if(!$("#qna_sub_select").val()){
		alert("소분류를 입력하세요"); $("#qna_sub_select").focus(); return false;
	}
	if(!$("#qna_ph").val()){
		alert("연락처를 입력하세요"); $("#qna_ph").focus(); return false;
	}
	if(!$("#qna_content").val()){
		alert("내용을 입력하세요"); $("#qna_content").focus(); return false;
	}

	// PC 버전이면, 이메일폼 따로 검사 + 답변알림검사
	if (mode == 'pver'){

		if($("input:radio[name='note_recive']").is(":checked") == false){
			alert("답변알림 수신 여부를 체크하십시오.");
			$(".note_recive").focus();
			return false;
		}
		if(!$("#qna_email_1").val()){
			alert("이메일를 입력하세요"); $("#qna_email_1").focus(); return false;
		}
		if(!$("#qna_email_after").val()){
			alert("이메일를 입력하세요"); $("#qna_email_after").focus(); return false;
		}
	// 모바일버전이면 이메일폼 하나로 검사
	}else if (mode == 'mver'){
		if(!$("#qna_email").val()){
			alert("이메일를 입력하세요"); $("#qna_email").focus(); return false;
		}
	}

	if(confirm("문의하시겠습니까?")){

		$(".text_btn_de4949").val("전송중입니다. 잠시만기다려주세요.");
		$(".text_btn_de4949").removeClass("width_82");
		$(".text_btn_de4949").addClass("width_200");
		$(".text_btn_de4949").prop("disabled", true);

		$('#upload_form').submit();

	}
}


// 첨부파일등록 디자인
$(document).ready(function(){
	var fileTarget = $('.normal_filebox #qna_upload');

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


var m_qna_up = 0;


//일대일문의하기 넘기기
$(document).ready(function(){

		//일대일문의하기 폼전송
		$('#upload_cert_form').ajaxForm({
		   //보내기전 validation check가 필요할경우
				beforeSubmit: function (data, frm, opt) {

					if(m_qna_up != 0){
						alert("전송중입니다. 잠시만 기다려주세요.");
						return false;
					}
					if($("#cert_name").val() == ""){
						alert("이름을 입력해주세요.");
						$("#cert_name").focus();
						return false;
					}
					if($("select[name=cert_year]").val() == ""){
						alert("생년월일을 정확히 입력해주세요.");
						$("select[name=cert_year]").focus();
						return false;
					}
					if($("select[name=cert_month]").val() == ""){
						alert("생년월일을 정확히 입력해주세요.");
						$("select[name=cert_month]").focus();
						return false;
					}
					if($("select[name=cert_day]").val() == ""){
						alert("생년월일을 정확히 입력해주세요.");
						$("select[name=cert_day]").focus();
						return false;
					}
					if($("select[name=cert_ph_1]").val() == ""){
						alert("휴대폰번호를 정확히 입력해주세요.");
						$("select[name=cert_ph_1]").focus();
						return false;
					}
					if($("input:text[name=cert_ph_2]").val() == ""){
						alert("휴대폰번호를 정확히 입력해주세요.");
						$("input:text[name=cert_ph_2]").focus();
						return false;
					}
					if($("#qna_email").val() == ""){
						alert("이메일을 입력해주세요.");
						$("#qna_email").focus();
						return false;
					}
					if($("#cert_content").val() == ""){
						alert("사유을 입력해주세요.");
						$("#cert_content").focus();
						return false;
					}
					return true;
				},
				//submit이후의 처리
				success: function(responseText, statusText){
					if(responseText == '1'){
						alert("업로드되었습니다. 관리자의 확인후 처리해드리겠습니다.");
						location.reload();
					}else{
						console.log(responseText);
					}
				},
				beforeSend:function(){
					m_qna_up = m_qna_up+1;
				},
				//ajax error
				error: function(){
					alert("문의 업로드중 에러가 발생하였습니다.");
				}
		});

});