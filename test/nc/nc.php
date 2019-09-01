<!-- saved from url=(0022)http://internet.e-mail -->
<SCRIPT LANGUAGE=JavaScript>

	function fnSubmit()
	{
		with(document.form1)
		{
			if (jumin.value.length =='' || jumin.value.length < 6)
			{
				alert('주민번호를 확인하세요.');
				jumin.focus();
				return;
			}
			
			if ( name.value == '' )
			{
				alert('성명을 입력하세요..');
				name.focus();
				return;
			}
		}
		
		document.form1.action = "nc_p.php";
		document.form1.submit();
	}
	
	function onlyNumber()
	{
		if((event.keyCode < 48)||(event.keyCode > 57)) 
			event.returnValue=false;
	}
	
</SCRIPT>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<TITLE>간편실명확인</TITLE>
</HEAD>

<BODY bgcolor="#FFFFFF">
<form name="form1" method="post">
    주민번호 앞자리 or 생년월일 : <input type="text" name="jumin" onkeypress="onlyNumber();" maxlength="8"><br>
    성별 : <input type="radio" name="gender" value="0" checked>여성   <input type="radio" name="gender" value="1" >남성<br>
    성명 :&nbsp; <input type="text" name="name" value="" maxlength="10"><br><br>
		<input type="button" name="ok" value=" 확  인 " onclick="JavaScript:fnSubmit();">
</form>
</BODY>
</HTML>

