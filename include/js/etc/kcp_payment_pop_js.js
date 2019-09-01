$(document).ready(function(){
	resizeTo('620', '700');		//리사이즈
});


function  jsf__chk_plugin(){
				
	var f = document.hidden_form;		//form name

	// IE 일경우 기존 로직을 타게끔
	if ((navigator.userAgent.indexOf('MSIE') > 0) || (navigator.userAgent.indexOf('Trident/7.0') > 0)){
		
		if ( document.Payplus.object != null ){	
		
			f.target = '';
			f.action = '/etc/kcp_payment/kcp_order'
			f.submit();
			}
		}
		// 그 외 브라우져에서는 체크로직이 변경됩니다.
		else{
			
			var inst = 0;
			for (var i = 0; i < navigator.plugins.length; i++){
				
				if (navigator.plugins[i].name == 'KCP'){
					inst = 1;
				}
		}

		if (inst == 1){
				
			f.target = '';
			f.action = '/etc/kcp_payment/kcp_order'
			f.submit();
		}
		else{
			document.location.href=GetInstallFile();
		}
	}
}