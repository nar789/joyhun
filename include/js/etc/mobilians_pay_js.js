//모빌리언스 결제 공통함수 스크립트

$(document).ready(function(){
});

//폼데이터 인코딩변환(UTF-8 -> EUC-KR)
function emulAcceptCharset(form){
	if(form.canHaveHTML){
		document.charset = form.acceptCharset;
	}
	return true;
}

//인코딩한 폼데이터를 가지고 모빌리언스 결제창 오픈
function payRequest(){
	emulAcceptCharset(document.payForm);
	MCASH_PAYMENT(document.payForm);
}