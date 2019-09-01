<html>
<head>
<title></title>
<link rel="stylesheet" href="http://www.joyhunting.com/include/css/default.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
	function msg_send_ok(stauserid,stidx){
	}
//-->
</SCRIPT>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="overflow-x:hidden;overflow-y:hidden;">
<table width="468" border="0" cellspacing="0" cellpadding="0" style="font-family:돋움; font-size:12px">

<?php
$i = 1;
if( $getTotalData > 0 )
{
	foreach($mem_data as $key => $val)
	{
		$val['m_nick'] = $val['m_age'];
		$val['m_nick'] = iconv("utf-8","euc-kr",title_style($val['m_nick']));
		$val['m_conregion'] = iconv("utf-8","euc-kr",title_style($val['m_conregion']));
		$val['m_conregion2'] = iconv("utf-8","euc-kr",title_style($val['m_conregion2']));

		If ($val['m_sex'] == "M"){
			$ico_img = "/images/music_chat/new_cafe/s_male.gif";
		}else{
			$ico_img = "/images/music_chat/new_cafe/s_female.gif";
		}

		If (is_null($val['m_filename']) ){
			$img_ck = "/images/music_chat/music_chat/userlist_icon_cam_sx.gif";
		}else{
			$img_ck = "/images/music_chat/music_chat/userlist_icon_cam_s.gif";
		}

			If ($i %2 == 1 ){
				$bg_color = "bgcolor=#FFEFE7";
			}else{
				$bg_color = "";
			}

/*
			m_userid	= Rs(0)
			m_userIndex = Rs(1)
			m_sex		= Rs(2)
			m_age		= Rs(3)
			m_conregion = Rs(4)
			m_conregion2= Left(Rs(5), 3)
			m_nick		= Rs(6)
			m_filename	= Rs(7)		

			If m_sex = True Then
				ico_img = "/images/music_chat/new_cafe/s_male.gif"
			Else
				ico_img = "/images/music_chat/new_cafe/s_female.gif"
			End If
*/
?>			

	<tr height="22" <?=$bg_color?>>
		<td width="38" align="center"><img src="<?=$ico_img?>"></td>
		<td width="46" align="center">웹</td>
		<td width="37" align="center"><?=$val['m_age']?></td>
		<td width="83" align="center"><?=$val['m_conregion']?>/<?=$val['m_conregion2']?></td>
		<td width="122" align="center"><?=$val['m_nick']?></td>
		<td width="74" align="center"><img src="<?=$img_ck?>" width="14" height="15"></td>
		<td width="68" align="center"><a href="javascript:msg_send_ok('<?=$val['m_userid']?>','<?=$val['m_num']?>');"><img src="/images/music_chat/music_chat/btn_popup_invite01.gif" width="36" height="16"></a></td>
	</tr>

<?
		$i++;
	}
}else{
?>
	<tr height="55">
		<td align="center" valign="middle">조건에 맞는 회원이 없습니다.</td>
	</tr>
<?}?>

	<tr>
		<td height="20" colspan="7" align="center" valign="bottom">
			<table width="468" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="70"></td>
					<td width="328" align="center"><?=$page?></td>
					<td width="70" align="center"><b><?=(int)($intNowPage)?></b> / <?=(int)($inttotalpage)?></td>
				</tr>
			</table>
		</td>
	</tr>


</table>


</body>
</html>