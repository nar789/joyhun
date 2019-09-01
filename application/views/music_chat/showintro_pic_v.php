<html>
<head>
<title>사진보여주기입니다</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/include/css/music_chat/default.css" rel="stylesheet" type="text/css">

</head>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function introPic(filename){
		location.href = filename;
	}

	function view_pic(p_filename){

		location.href='/etc/music_chat/showintro_pic/p_filename' + p_filename;
	}

//-->
</SCRIPT>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="overflow:hidden">
<table width="281" height="329" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="bottom" background="/images/music_chat/chat_img/img_13.gif"><table width="100" height="329" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="38">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><table width="244" border="0" cellspacing="0" cellpadding="0">
			<?php
			$i = 1;
			if( $getTotalData > 0 )
			{
				foreach($pic_row as $key => $val_array)
				{
					$thumb = $this->member_lib->profile_thumb($val_array['pic_num'], $val_array['user_id'],111,150);

					$p_filename = $thumb;

			?>					  
			  <tr> 
                <td width="152" height="52" align="center">
				<!----------------사진보여주기1  전체----------->
				<table width="238" height="49" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="70" height="49" align="center">
					  <!-------사진열람 1 50*38------------>
					  <table width="56" height="44" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td colspan="3"><img src="/images/music_chat/chat_img/img_15.gif" width="56" height="3"></td>
                          </tr>
                          <tr> 
                            <td width="3"><img src="/images/music_chat/chat_img/img_16.gif" width="3" height="38"></td>
                            <td width="50"><img src="<?=iconv("utf-8","euc-kr",$this->member_lib->profile_thumb($val_array['pic_num'], $val_array['user_id'],50,38))?>"></td>
                            <td width="3"><img src="/images/music_chat/chat_img/img_17.gif" width="3" height="38"></td>
                          </tr>
                          <tr> 
                            <td colspan="3"><img src="/images/music_chat/chat_img/img_18.gif" width="56" height="3"></td>
                          </tr>
                        </table>
						 <!-------사진열람 1 50*38 종료------------>
						</td>
                      <td width="111"  class="a_03">프로필 사진 <?=$i?></td>
                      <td width="57"><a href="javascript:view_pic('<?=$p_filename?>');"><img src="/images/music_chat/chat_img/img_20.gif" width="56" height="21" border="0"></a></td>
                    </tr>
                  </table>
				  <!----------------사진보여주기1  전체 종료----------->
				  </td>
              </tr>
              <tr> 
                <td align="center"><img src="/images/music_chat/chat_img/img_14.gif" width="227" height="2"></td>
              </tr>

			<?
					$i++;
				}
			}else{
			?>
				<tr> 
					<td width="152" height="52" align="center">인증완료된 사진이 없습니다.</td>
				</tr>
			<?}?>

            </table></td>
        </tr>
        <tr> 
          <td height="40" align="center" valign="top"><table width="130" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="63" height="23"><a href="javascript:window.close();"><img src="/images/music_chat/chat_img/img_21.gif" width="63" height="25" border="0"></a></td>
                <td width="4">&nbsp;</td>
                <td width="63"><a href="javascript:window.close();"><img src="/images/music_chat/chat_img/img_22.gif" width="63" height="25" border="0"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>


</body>
</html>
