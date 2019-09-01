<html>
<head>
<title>화상채팅 자기소개 입니다.</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/include/css/music_chat/default.css" rel="stylesheet" type="text/css">
</head>
<SCRIPT LANGUAGE="JavaScript">
<!--
	var opener;
	var id = '<?=$m_userid?>';
	var objMyInfo;
	
	document.onkeydown = click;

	function click(){
		if ((event.button==2) || (event.button==3) || (event.keyCode == 93) || (event.keyCode == 116)) {
			event.keyCode=null;
			return false;
	    } else if((event.ctrlKey) && (event.keyCode > 0)) {
			alert("조이헌팅입니다.");
			event.keyCode=null;
			return false;
		}
	}

	function init(){

		myid.innerHTML = '<?=$m_userid?>';
		myname.innerHTML = '<?=$m_name?>';
		mysex.innerHTML = '<?=$m_sex?>';
		myage.innerHTML = '<?=$m_age?>' + '세';
		window.focus();
	}

	function showprofile(exp){
		location.href = '/etc/music_chat/showintro/userid/<?=$m_userid?>/exp/' + exp;
	}

//-->
</SCRIPT>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" style="overflow:hidden">
<!-----------자기소개 전체 입니다-------------->
<table width="371" height="290" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="bottom" background="/images/music_chat/chat_img/img_01.jpg">
	<table width="371" height="253" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="103" colspan="3" align="center">
		  
		  <!-----------상단테이블 bg t시작-------------->
		  <table width="327" height="83" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="6" height="8"><img src="/images/music_chat/chat_img/img_02.gif" width="6" height="8"></td>
                <td width="314" height="8" background="/images/music_chat/chat_img/img_04.gif"></td>
                <td width="7" height="8"><img src="/images/music_chat/chat_img/img_03.gif" width="7" height="8"></td>
              </tr>
              <tr align="center"> 
                <td height="67" background="/images/music_chat/chat_img/img_23.gif">&nbsp;</td>
                <td height="67" bgcolor="#FFFFFF">
				<!--------회원정보 뿌려줍니다.------------->
				<table width="100" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="18" colspan="2"  class="a_01" style="padding-left:10"><img src="/images/music_chat/chat_img/img_10.gif" width="8" height="9"> 
                        <?=$m_name?>(<?=$m_userid?>/<?=$m_age?>/<?=$m_sex?>)</td>
                    </tr>
                    <tr> 
                      <td colspan="2"><img src="/images/music_chat/chat_img/img_09.gif" width="314" height="2"></td>
                    </tr>
					<tr>
						<td height=5></td>
					</tr>
                    <tr> 
                      <td width="214" class="a_02" style="padding-left:10"><img src="/images/music_chat/chat_img/img_10.gif" width="8" height="9"> 
                        <strong>대화스타일</strong> : <font color="333333"><?=iconv("utf-8","euc-kr",talk_style_data($m_character))?></font></td>
                    </tr>
                    <tr> 
                      <td style="padding-left:10" class="a_02"><img src="/images/music_chat/chat_img/img_10.gif" width="8" height="9"> 
                        <strong>원하는만남</strong> &nbsp;&nbsp;: <font color="333333"><?=iconv("utf-8","euc-kr",want_reason_data($m_reason))?></font></td>
                    </tr>
                  </table>
				  <!--------회원정보 뿌려------------->
				  </td>
                <td height="67" background="/images/music_chat/chat_img/img_24.gif">&nbsp;</td>
              </tr>
              <tr> 
                <td width="6" height="8"><img src="/images/music_chat/chat_img/img_05.gif" width="6" height="8"></td>
                <td height="8" background="/images/music_chat/chat_img/img_08.gif"></td>
                <td width="7" height="8"><img src="/images/music_chat/chat_img/img_06.gif" width="7" height="8"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="6" colspan="3"></td>
        </tr>
        <tr> 
          <td style="padding-top:5" "width="85" align="right" valign="top" class="a_01"><img src="/images/music_chat/chat_img/img_10.gif" width="8" height="9"> 
            소개글 : 
			</td>
          <td width="265" align="center">
		  	<!-------------------자기소개글 테이블 테두리를 위한 ------------------------->
		  <table width="257" height="92" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td bgcolor="BB8B99">
				<!-------------------자기소개글 테이블 시작-------------------------->
				<table width="258" height="92" border="0" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td width="254" bgcolor="#FFFFFF"><textarea cols="40" rows="6" id="expression" name="myinfo"></textarea></td>
                    </tr>
                  </table>
				  	<!-------------------자기소개글 테이블 종료-------------------------->
				  </td>
              </tr>
            </table> </td>
          <td width="21">&nbsp;</td>
        </tr>
        <tr align="center"> 
          <td height="52" colspan="3"><table width="175" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="106"><a href="javascript:do_btn();"><img src="/images/music_chat/chat_img/img_11.gif" width="106" height="25" border="0"></a></td>
                <td width="6">&nbsp;</td>
                <td width="63"><a href="javascript:window.close();"><img src="/images/music_chat/chat_img/img_12.gif" width="63" height="25" border="0"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-----------자기소개 전체  종료입니다-------------->
</body>
</html>

<script>
	function do_btn(){
		location.href = '/etc/music_chat/showintro/userid/<?=$m_userid?>/exp/' + document.all.myinfo.value;
	}
</script>