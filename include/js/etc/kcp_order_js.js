/* Payplus Plug-in 실행 */
function  jsf__pay( form )
{
	var RetVal = false;

	/* Payplus Plugin 실행 */
    if ( MakePayMessage( form ) == true )
    {
		//openwin = window.open( "proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
        RetVal = true ;
    }
            
    else
    {
		/*  res_cd와 res_msg변수에 해당 오류코드와 오류메시지가 설정됩니다.
			ex) 고객이 Payplus Plugin에서 취소 버튼 클릭시 res_cd=3001, res_msg=사용자 취소
            값이 설정됩니다.
        */
        res_cd  = document.order_info.res_cd.value ;
        res_msg = document.order_info.res_msg.value ;

    }
	
	return RetVal ;
}


/* onLoad 이벤트 시 Payplus Plug-in이 실행되도록 구성하시려면 다음의 구문을 onLoad 이벤트에 넣어주시기 바랍니다. */
function onload_pay()
{
	if( jsf__pay(document.order_info) )
		document.order_info.submit();
}

$(document).ready(function(){

});