//휴대전화 본인인증
var https;
function set_http(){
	https = "http";
}
function set_https(){
	https = "https";
}

function hp_cert(mode, userid){
	
	//mode		: 1.비회원인증, 2.회원인증
	//userid	: 1.비회원아이디세션 2.회원아이디세션

	$.ajax({

		type : "post",
		url : "/etc/hp_cert/phone_chk/"+Math.random(),
		data : {
			"mode"			: encodeURIComponent(mode),
			"userid"		: encodeURIComponent(userid)
		},
		cache : false,
		async : false,
		success :function(result){
			
			var $form = $('<form></form>');
			$form.attr('name', 'reqCBAForm');
			$form.attr('action', 'https://pcc.siren24.com/pcc_V3/jsp/pcc_V3_j10.jsp');
			$form.attr('method', 'post');
			$form.appendTo('body');

			var reqInfo = $('<input type="hidden" name="reqInfo" value="'+result+'">');
			var retUrl = $('<input type="hidden" name="retUrl" value="32'+https+'://'+window.location.host+'/etc/hp_cert/phone_result">');
						
			$form.append(reqInfo).append(retUrl);
			$form.submit();

		},
		error : function(result){
			alert("실패");
		}

	});

}

//인증결과
function hp_cert_result(v_result, mode){
	
	if(mode == "1"){
	//비회원일경우
		if(v_result == "Y"){
			alert("회원가입이 완료되었습니다.");
			location.href= '/etc/app/close';	//앱용도용 새창 colse 이벤트 리스너가 대기중 (/lnclude/js/popup.js   phone_pop 부분) 
			self.close();
			opener.location.href = "/";
		}else{
			alert("인증에 실패했습니다.");
			location.href= '/etc/app/close';
			self.close();
		}
	}else if(mode == "3"){
	// 휴면계정일 경우
		if(v_result == "Y"){
			alert("새로운 비밀번호를 입력해주세요.");
			opener.location.href="javascript:my_cert_ok();";
			self.close();
		}else{
			alert("인증에 실패했습니다.");
			location.href= '/etc/app/close';
			self.close();
		}
	}else if(mode == "4"){
	// 미성년자일 경우
		if(v_result != "Y"){
			alert("미성년자는 가입이 불가능합니다.");
			opener.location.href = "/";
			location.href= '/etc/app/close';
			self.close();
		}
	}else{
	//회원일경우
		if(v_result == "Y"){
			alert("인증에 성공했습니다.");
			opener.location.reload();
			location.href= '/etc/app/close';
			self.close();
		}else{
			alert("인증에 실패했습니다.");
			location.href= '/etc/app/close';
			self.close();
		}
	}
	
	
}




