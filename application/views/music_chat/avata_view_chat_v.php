<html>
<head>
<title></title>
<SCRIPT LANGUAGE="JavaScript">
<!--
		if (document.all) { 
			document.onkeydown = function () {
				var key_f5 = 116; // 116 = F5 
				if (key_f5 == event.keyCode) {
					event.keyCode = 0; 
					event.cancelBubble = true; 
					event.returnValue = false;
				}
			}
		}		
		
		function avata_view(){
			   document.all.pic_view.style.display='none';
			   document.all.avata_view.style.display='';
		}

		function pic_view(){
			   document.all.avata_view.style.display='none';
			   document.all.pic_view.style.display='';
		}
//-->
</SCRIPT>
</head>
<body leftmargin="0" topmargin="0" scroll="no" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
	<table border="0" width="113" height="152" cellpadding="0" cellspacing="1" bgcolor="B4B2B2" id="pic_view" style="cursor:hand">
		<tr> 
			<td bgcolor="#FFFFFF" valign="top"><img src="<?=$p_filename?>" width="111" height="150" border="0"></td>
		</tr>
	</table>


</body>
</html>