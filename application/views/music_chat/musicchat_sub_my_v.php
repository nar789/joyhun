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
<table width="280" border="0" cellspacing="0" cellpadding="0">


<?php
$i = 1;
if( $getTotalData > 0 )
{
	foreach($title_row as $key => $val)
	{
		//idx, m_title, m_cert
		$val['m_title'] = iconv("utf-8","euc-kr",$val['m_title']);
		//$t_text = title_style($val['m_title']);
		$t_text = title_style2($val['m_title'], $val['m_cert'], 215, 290);


?>			

	  <tr>
		<td width="20" height="23"><input type="radio" name="s_title" id="s_title<?=$val['idx']?>" value="<?=$val['m_title']?>" class="radio" onclick="javascript:parent.Set_Radio(3);"></td>
		<td><p class="font_01"><?=$t_text?></td>
	  </tr>
	  <tr>
		<td height="1" colspan="3" background="/images/music_chat/title_room/dot_bg2.gif"></td>
	  </tr>

<?
		$i++;
	}
}else{
?>
  <tr>
    <td style="padding-left:15px; padding-top:15px;"><p class="font_01"><img src="/images/music_chat/title_room/icon_01.gif"> 나만의 방제목을 만들어 주세요.</p></td>
  </tr>
  <tr>
    <td height="1" background="/images/music_chat/title_room/dot_bg2.gif"></td>
  </tr>
<?}?>

</table>
</body>
</html>