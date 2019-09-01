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
	font-size: 12px;
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
<table width="320" border="0" cellspacing="0" cellpadding="0">


<?php
$i = 1;
if( $getTotalData > 0 )
{
	foreach($title_row as $key => $val)
	{
		//idx, m_title, m_cert
		$m_title = iconv("utf-8","euc-kr",$val['m_title']);
		$m_title = title_style2($m_title, $val['m_cert'], 215, 290);
		$m_idx = $val['idx'];
		$m_cert = $val['m_cert'];
?>			

		  <tr height="<?If($i == 1){echo "28";}else{echo "24";}?>">
			<td width="10" align="center"><img src="/images/music_chat/title_room/icon_01.gif"></td>

		<?	If ($m_cert == 0){?>
			<td width="215"><p class="font_01"><?=$m_title?></p></td>
			<td width="75" align="center" class="red">인증대기중</td>
		<?}else{?>
			<td width="290" colspan="2"><p class="font_01"><?=$m_title?></p></td>
		<?}?>

			<td align="center" valign="top" style="padding-top:2px;"><a href="javascript:parent.Del_MyTitle('<?=$m_idx?>');"><img src="/images/music_chat/title_room/btn_del.gif" border="0" align="absmiddle" /></a></td>
		</tr>

<?
		$i++;
	}
}else{
?>
  <tr>
    <td style="padding-left:15px; padding-top:15px;"><p class="font_01"><img src="/images/music_chat/title_room/icon_01.gif"> 승인된 방제목이 없습니다.</p></td>
  </tr>
  <tr>
    <td height="1" background="/images/music_chat/title_room/dot_bg2.gif"></td>
  </tr>
<?}?>

</table>
</body>
</html>