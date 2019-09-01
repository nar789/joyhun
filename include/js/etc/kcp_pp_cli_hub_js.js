$(document).ready(function(){
	document.onkeydown = noRefresh ;		//새로고침방지
	goResult();		//결과 submit
});

function goResult()
{
	//var openwin = window.open( 'proc_win.html', 'proc_win', '' )
	document.pay_info.submit()
	//openwin.close()
}

// 결제 중 새로고침 방지 샘플 스크립트 (중복결제 방지)
function noRefresh()
{
	 /* CTRL + N키 막음. */
	if ((event.keyCode == 78) && (event.ctrlKey == true)){
		event.keyCode = 0;
        return false;
	}
    /* F5 번키 막음. */
    if(event.keyCode == 116){
		event.keyCode = 0;
		return false;
	}
}