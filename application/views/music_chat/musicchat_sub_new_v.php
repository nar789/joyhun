<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title></title>
<style type="text/css">
<!--
.font_01 {
	font-family:굴림;
	color: #111111;
	font-size: 12px;
}
.red {
	color: #ce2108;
	font-weight: bold;
	font-size: 14px;
}
body {
	margin: 0px;
	scrollbar-3dlight-color:#ffffff;
	scrollbar-arrow-color:#ffffff;
	scrollbar-track-color:#ffffff;
	scrollbar-darkshadow-color:#ffffff;
	scrollbar-face-color:#DADADA;
	scrollbar-highlight-color:#DADADA;
	scrollbar-shadow-color:#ffffff;
}
.input, select {
	font-size:12px;
	font-family:돋움, dotum;
	color:#707070;
	border:#d7d7d7 solid 1;
	padding:2;
	height:20;
}
.input2 {
	font-size:12px;
	font-family:돋움, dotum;
	color:#707070;
	border:#d7d7d7 solid 1;
	padding:2;
	height:16;
}
.radio {
	font-size:12px;
	font-family:돋움, dotum;
	color:#707070;
	padding:2;
	height:16;
}
-->
</style>
</head>
<body topmargin="0" leftmargin="0">
<table width="310" border="0" cellspacing="0" cellpadding="0">
<?php
$i = 1;
if( $getTotalData > 0 )
{
	foreach($title_row as $key => $val)
	{
		$val['t_text'] = iconv("utf-8","euc-kr",$val['t_text']);
		$t_text2 = title_style($val['t_text']);
?>			

	 <tr>
		<td width="20" height="23"><input type="radio" name="s_title" id="s_title<?=$i?>" value="<?=$val['t_text']?>" class="radio" onclick="javascript:parent.Set_Radio(1);"></td>
		<td><p class="font_01"><?=$t_text2?></p></td>
	  </tr>
	  <tr>
		<td height="1" colspan="2" background="/images/music_chat/title_room/dot_bg2.gif"></td>
	  </tr>

<?
		$i++;
	}
}else{
?>
  <tr>
    <td colspan="2"><p class="font_01">등록된 제목이 없습니다.</p></td>
  </tr>
  <tr>
    <td height="1" colspan="2" background="/images/music_chat/title_room/dot_bg2.gif"></td>
  </tr>
<?}?>


</table>
</body>
</html>