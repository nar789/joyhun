<script type="text/javascript">
	
	$(document).ready(function(){
		
	});
	
	function name_check(){
		
		var w = 430;
		var h = 500;

		var res_w = ( screen.availWidth - w ) / 2;
		var res_h = ( screen.availHeight - h ) / 2;

		var popUrl = "/etc/name_check/name_check_request";
		var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  
		var CBA_window = window.open(popUrl,"phone_chk",popOption);	


		CBA_window.addEventListener('loadstart', function(event) {
			 if (event.url.match("app/close")) {
				 CBA_window.close();
				 location.href = "/";
			 }
		 }); 

		if(CBA_window == null){ 
			alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
		}


	}

</script>


<input type="button" id="btn" name="btn" value="본인인증 버튼" onclick="javascript:name_check();">