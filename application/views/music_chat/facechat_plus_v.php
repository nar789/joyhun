<HTML>
<HEAD>
<TITLE> New Document </TITLE>
</HEAD>

<!-- ���� virtual="/webchat/camchat/fontcolor.asp"  �κ� ���� -->

		<SCRIPT LANGUAGE="JavaScript">
		<!--

		function font_view()
		{
			document.all.div_font.style.display = "";
		}

		function colse3_div()
		{
			document.all.div_font.style.display = "none";
		}

		function setFontColor(color_value)
		{
			style_color = color_value;
			document.all.div_font.style.display = "none";
		}

		function fontBold(){
			if (font_bold == "") {
				font_bold = "<b>";
			} else {
				font_bold = "";
			}
		}

		function fontItalic(){
			if (font_italic == "") {
				font_italic = "<i>";
			} else {
				font_italic = "";
			}
		}

		function fontUnderline(){
			if (font_underline == "") {
				font_underline = "<u>";
			} else {
				font_underline = "";
			}
		}

		function setFont(face)
		{

			if (face == "00" )
			{
				font_face = "����ü";
			}
			else
			{
				font_face = face;
			}
		}
		//-->
		</SCRIPT>

		<div  id='div_font' style='display:none;position:absolute;top:420;left:10;z-index:1000;'>
		<table width="112" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox01.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox02.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td bgcolor="#EDE3C8" style="padding: 0 5 0 5"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td>
					<select name="fontface"  onchange="setFont(this.value)" style="background color: #F9F9F9; border-right: 1px solid; border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid; border-color: #B4B4B4;">
														<option value="00">�۾�ü ��</option>
															<option value="����">����</option>
															<option value="����">����</option>
															<option value="����">����</option>
															<option value="�ü�">�ü�</option>
															<option value="Arial">Arial</option>
															<option value="verdana">verdana</option>
													</select>
				  </td>
				  <td><img src="/images/music_chat/new_jjokji/actm_btn_x.gif" border="0" onclick='javascript:colse3_div();' style="cursor:hand;"></td>
				</tr>
				<tr> 
				  <td></td>
				  <td height="4"></td>
				</tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box01.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box02.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td bgcolor="#FFFFFF" style="padding: 0 5 0 5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							  <td width="22" height="20" valign="top"><img src="/images/music_chat/new_jjokji/actm_btn_fbold.gif" border="0" style='cursor:hand;' onclick='fontBold();'></td>
							</tr>
							<tr> 
							  <td height="20" valign="top"><img src="/images/music_chat/new_jjokji/actm_btn_fline.gif"  border="0" style='cursor:hand;' onclick='fontUnderline();'></td>
							</tr>
							<tr> 
							  <td><img src="/images/music_chat/new_jjokji/actm_btn_fitalic.gif"  border="0" style='cursor:hand;' onclick='fontItalic();'></td>
							</tr>
						  </table></td>
						<td><table width="71" height="57" border="0" cellpadding="0" cellspacing="1">
							<tr> 
							  <td bgcolor="#000000" onclick="setFontColor('#000000');">&nbsp;</td>
							  <td bgcolor="#993300" onclick="setFontColor('#993300');">&nbsp;</td>
							  <td bgcolor="#003366" onclick="setFontColor('#003366');">&nbsp;</td>
							  <td bgcolor="#000080" onclick="setFontColor('#000080');">&nbsp;</td>
							  <td bgcolor="#333399" onclick="setFontColor('#333399');">&nbsp;</td>
							</tr>
							<tr> 
							  <td bgcolor="#FF6600" onclick="setFontColor('#FF6600');">&nbsp;</td>
							  <td bgcolor="#808000" onclick="setFontColor('#808000');">&nbsp;</td>
							  <td bgcolor="#008000" onclick="setFontColor('#008000');">&nbsp;</td>
							  <td bgcolor="#008080" onclick="setFontColor('#008080');">&nbsp;</td>
							  <td bgcolor="#0000FF" onclick="setFontColor('#0000FF');">&nbsp;</td>
							</tr>
							<tr> 
							  <td bgcolor="#FF0000" onclick="setFontColor('#FF0000');">&nbsp;</td>
							  <td bgcolor="#E87E00" onclick="setFontColor('#E87E00');">&nbsp;</td>
							  <td bgcolor="#99CC00" onclick="setFontColor('#99CC00');">&nbsp;</td>
							  <td bgcolor="#800080" onclick="setFontColor('#800080');">&nbsp;</td>
							  <td bgcolor="#00CCFF" onclick="setFontColor('#00CCFF');">&nbsp;</td>
							</tr>
							<tr> 
							  <td bgcolor="#C1007B" onclick="setFontColor('#C1007B');">&nbsp;</td>
							  <td bgcolor="#B96F00" onclick="setFontColor('#B96F00');">&nbsp;</td>
							  <td bgcolor="#198D58" onclick="setFontColor('#198D58');">&nbsp;</td>
							  <td bgcolor="#CC99FF" onclick="setFontColor('#CC99FF');">&nbsp;</td>
							  <td bgcolor="#D27E92" onclick="setFontColor('#D27E92');">&nbsp;</td>
							</tr>
						  </table></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box03.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box04.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox03.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox04.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		</table>
		</div>

<!-- ���� virtual="/webchat/camchat/fontcolor.asp"  �κ� �� -->

<!-- ���� virtual="/webchat/camchat/faceEmoticon.asp" �κ� ���� -->

		<SCRIPT LANGUAGE="JavaScript">
		<!--

		function emo_view(emo_level)
		{
			switch ( emo_level ) {
				case 1:
					document.all.emo1.style.display = "";
					document.all.emo2.style.display = "none";
					document.all.emo3.style.display = "none";
					document.all.emo4.style.display = "none";
					break;
				case 2:
					document.all.emo1.style.display = "none";
					document.all.emo2.style.display = "";
					document.all.emo3.style.display = "none";
					document.all.emo4.style.display = "none";
					break;
				case 3:
					document.all.emo1.style.display = "none";
					document.all.emo2.style.display = "none";
					document.all.emo3.style.display = "";
					document.all.emo4.style.display = "none";
					break;
				case 4: 
					document.all.emo1.style.display = "none";
					document.all.emo2.style.display = "none";
					document.all.emo3.style.display = "none";
					document.all.emo4.style.display = "";
					break;
			}
		}

		function colse_div()
		{
					document.all.emo1.style.display = "none";
					document.all.emo2.style.display = "none";
					document.all.emo3.style.display = "none";
					document.all.emo4.style.display = "none";
					
					document.all.content.focus();
		}

		var now_face = 1;
		function page_down()
		{
			if(now_face > 1){
				now_face = now_face - 1;
			}
			face_view();
		}

		function page_up()
		{
			if(now_face < 3){
				now_face = now_face + 1;
			}			
			face_view();	
		}

		function face_view()
		{
			switch (now_face)
			{
				case 1 :
					document.all.face_emo1.style.display = "";
					document.all.face_emo2.style.display = "";
					document.all.face_emo3.style.display = "none";
					document.all.face_emo4.style.display = "none";
					document.all.face_emo5.style.display = "none";
					document.all.face_emo6.style.display = "none";
				break;
				case 2 :
					document.all.face_emo1.style.display = "none";
					document.all.face_emo2.style.display = "none";
					document.all.face_emo3.style.display = "";
					document.all.face_emo4.style.display = "";
					document.all.face_emo5.style.display = "none";
					document.all.face_emo6.style.display = "none";
				break;
				case 3 :
					document.all.face_emo1.style.display = "none";
					document.all.face_emo2.style.display = "none";
					document.all.face_emo3.style.display = "none";
					document.all.face_emo4.style.display = "none";
					document.all.face_emo5.style.display = "";
					document.all.face_emo6.style.display = "";
				break;
			}
		}

		var now_weahter = 1;
		function page_down01()
		{
			if(now_weahter > 1){
				now_weahter = now_weahter - 1;
			}
			weahter_view();
		}

		function page_up01()
		{
			if(now_weahter < 2){
				now_weahter = now_weahter + 1;
			}			
			weahter_view();	
		}

		function weahter_view()
		{
			switch (now_weahter)
			{
				case 1 :
					document.all.weahter01.style.display = "";
					document.all.weahter02.style.display = "none";
				break;
				case 2 :
					document.all.weahter01.style.display = "none";
					document.all.weahter02.style.display = "";
				break;
			}
		}

		var now_emo = 1;
		function page_down02()
		{
			if(now_emo > 1){
				now_emo = now_emo - 1;
			}
			emoemo_view();
		}

		function page_up02()
		{
			if(now_emo < 3){
				now_emo = now_emo + 1;
			}			
			emoemo_view();	
		}
		function emoemo_view()
		{
		   switch (now_emo)
			{
				case 1 :
					document.all.emo_emo01.style.display = "";
					document.all.emo_emo02.style.display = "none";
					document.all.emo_emo03.style.display = "none";
				break;
				case 2 :
					document.all.emo_emo01.style.display = "none";
					document.all.emo_emo02.style.display = "";
					document.all.emo_emo03.style.display = "none";
				break;
				case 3 :
					document.all.emo_emo01.style.display = "none";
					document.all.emo_emo02.style.display = "none";
					document.all.emo_emo03.style.display = "";
				break;
			}
		}

		var now_special = 1;
		function page_down03()
		{
			if(now_special > 1){
				now_special = now_special - 1;
			}
			special_view();
		}

		function page_up03()
		{
			if(now_special < 2){
				now_special = now_special + 1;
			}			
			special_view();	
		}
		function special_view()
		{
		   switch (now_special)
			{
				case 1 :
					document.all.special01.style.display = "";
					document.all.special02.style.display = "none";
				break;
				case 2 :
					document.all.special01.style.display = "none";
					document.all.special02.style.display = "";
				break;
			}
		}

		//-->
		</SCRIPT>

		<div  id='emo1' style='display:none;position:absolute;top:420;left:60;z-index:1000;'>
		<table width="192" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox01.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox02.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td bgcolor="#EDE3C8" style="padding: 0 5 0 5"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="5">&nbsp;</td>
				  <td><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_01a.gif"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_02.gif" border="0" onclick="javascript:emo_view(2);" style="cursor:hand;" ><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_03.gif" border="0" onclick="javascript:emo_view(3);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_04.gif" border="0" onclick="javascript:emo_view(4);" style="cursor:hand;" ></td>
				</tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box01.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box02.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td bgcolor="#FFFFFF" style="padding: 0 5 0 5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_btn_back2.gif" border="0" style='cursor:hand;' onclick='page_down();'></td>
						<td width="100%" style="padding: 0 1 0 1"><table width="100%" height="45" border="0" cellpadding="0" cellspacing="0">

							<tr align="center" valign="bottom" id="face_emo1" >
							  <td><img src="/images/music_chat/new_jjokji/item_face01.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face01.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face02.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face02.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face03.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face03.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face04.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face04.gif','','0');"></td>
							</tr>
							<tr align="center" valign="bottom" id="face_emo2" > 
							  <td><img src="/images/music_chat/new_jjokji/item_face05.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face05.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face06.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face06.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face07.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face07.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face08.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face08.gif','','0');"></td>
							</tr>

							<tr align="center" valign="bottom" id="face_emo3" style='display:none'> 
							  <td><img src="/images/music_chat/new_jjokji/item_face09.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face09.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face10.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face10.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face11.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face11.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face12.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face12.gif','','0');"></td>
							</tr>
							<tr align="center" valign="bottom" id="face_emo4" style='display:none'> 
							  <td><img src="/images/music_chat/new_jjokji/item_face13.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face13.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face14.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face14.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face15.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face15.gif','','0');"></td>
							  <td><img src="/images/music_chat/new_jjokji/item_face16.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face16.gif','','0');"></td>
							</tr>
							<tr align="center" valign="bottom" id="face_emo5" style='display:none'>  
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_face17.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face17.gif','','0');"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_face18.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_face18.gif','','0');"></td>
							  <td width="39">&nbsp;</td>
							  <td width="39">&nbsp;</td>
							</tr>
							<tr align="center" valign="bottom" id="face_emo6" style='display:none'>  
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>
						  </table></td>
						<td><img src="/images/music_chat/new_jjokji/actm_btn_next2.gif" border="0" style='cursor:hand;' onclick='page_up();'></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box03.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box04.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td height="20" bgcolor="#EDE3C8" align="center" valign="bottom"><img src="/images/music_chat/new_jjokji/actm_btn_popclose.gif" border="0" onclick='javascript:colse_div();' style="cursor:hand;"></td>
		  </tr>
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox03.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox04.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		</table>
		</div>

		<div  id='emo2' style='display:none;position:absolute;top:420;left:60;z-index:1000;'>
		<table width="192" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox01.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox02.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td bgcolor="#EDE3C8" style="padding: 0 5 0 5"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="5">&nbsp;</td>
				  <td><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_01.gif" border="0"  onclick="javascript:emo_view(1);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_02a.gif"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_03.gif" border="0" onclick="javascript:emo_view(3);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_04.gif" border="0" onclick="javascript:emo_view(4);" style="cursor:hand;"></td>
				</tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box01.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box02.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td bgcolor="#FFFFFF" style="padding: 0 5 0 5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_btn_back2.gif" border="0" style='cursor:hand;' onclick='page_down01();'></td>
						<td width="100%" style="padding: 0 1 0 1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr align="center" id="weahter01"> 
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter01.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter01.gif','','0')"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter02.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter02.gif','','0')"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter03.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter03.gif','','0')"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter04.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter04.gif','','0')"></td>
							</tr>
							<tr align="center" id="weahter02" style='display:none;'> 
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter05.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter05.gif','','0')"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter06.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter06.gif','','0')"></td>
							  <td width="39"><img src="/images/music_chat/new_jjokji/item_weahter07.gif" border="0" style='cursor:hand;' onclick="addText('/images/music_chat/new_jjokji/item_weahter07.gif','','0')"></td>
							  <td width="39">&nbsp;</td>
							</tr>
						  </table></td>
						<td><img src="/images/music_chat/new_jjokji/actm_btn_next2.gif" border="0" style='cursor:hand;' onclick='page_up01();'></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box03.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box04.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td height="20" bgcolor="#EDE3C8" align="center" valign="bottom"><img src="/images/music_chat/new_jjokji/actm_btn_popclose.gif" border="0" onclick='javascript:colse_div();' style="cursor:hand;"></td>
		  </tr>
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox03.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox04.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		</table>
		</div>

		<div id='emo3' style='display:none;position:absolute;top:420;left:60;z-index:1000;'>
		<table width="192" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox01.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox02.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td bgcolor="#EDE3C8" style="padding: 0 5 0 5"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="5">&nbsp;</td>
				  <td><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_01.gif" border="0" onclick="javascript:emo_view(1);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_02.gif" border="0" onclick="javascript:emo_view(2);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_03a.gif"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_04.gif" border="0" onclick="javascript:emo_view(4);" style="cursor:hand;"></td>
				</tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box01.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box02.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td bgcolor="#FFFFFF" style="padding: 0 5 0 5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_btn_back2.gif" border="0"  style='cursor:hand;' onclick='page_down02();'></td>

						<td width="100%" style="padding: 0 4 0 4" id="emo_emo01"><table width="100%" border="0" cellspacing="0" cellpadding="2">
							<tr> 
							  <td width="35" height="45" align="center" bgcolor="#EAEBEE"><b>����</b></td>
							  <td style="line-height: 20px"><span onclick="addText(' ^.^ ');" style="cursor:hand;">^.^</span> <span onclick="addText(' *^^* ');" style="cursor:hand;">*^^*</span>  
								<span onclick="addText(' ^��^~~�� ');" style="cursor:hand;">^��^~~��</span> <span onclick="addText(' ^.~ ');" style="cursor:hand;">^.~</span> <span onclick="addText(' (^^)V ');" style="cursor:hand;">(^^)V</span></td>
							</tr>
						  </table></td>

						<td width="100%" style="padding: 0 4 0 4" id="emo_emo02" style="display:none;" ><table width="100%" border="0" cellspacing="0" cellpadding="2">
							<tr> 
							  <td width="35" height="45" align="center" bgcolor="#EAEBEE"><b>���</b></td>
							  <td style="line-height: 20px"><span onclick="addText(' ��.�� ');" style="cursor:hand;">��.��</span> <span onclick="addText(' ^}{^ ');">^}{^</span> <span onclick="addText(' (*^^)��(^_^) ');" style="cursor:hand;">(*^^)��(^_^)</span> <span onclick="addText(' (^*^)kiss ');" style="cursor:hand;">(^*^)kiss</span> <span onclick="addText(' ��..^ ');" style="cursor:hand;">��..^</span></td>
							</tr>
						  </table></td>

						<td width="100%" style="padding: 0 4 0 4" id="emo_emo03" style="display:none;" ><table width="100%" border="0" cellspacing="0" cellpadding="2">
							<tr> 
							  <td width="35" height="45" align="center" bgcolor="#EAEBEE"><b>����</b></td>
							  <td style="line-height: 20px"><span onclick="addText(' ��.�� ');" style="cursor:hand;">��.��</span> <span onclick="addText(' (>_<) ');">(>_<)  </span><span onclick="addText(' TmT ');" style="cursor:hand;">TmT</span> <span onclick="addText(' -_- ');" style="cursor:hand;">-_-</span> <span onclick="addText(' (v_v) ');" style="cursor:hand;">(v_v)</span></td>
							</tr>
						  </table></td>

						<td><img src="/images/music_chat/new_jjokji/actm_btn_next2.gif" border="0" style='cursor:hand;' onclick='page_up02();'></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box03.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box04.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td height="20" bgcolor="#EDE3C8" align="center" valign="bottom"><img src="/images/music_chat/new_jjokji/actm_btn_popclose.gif" border="0" onclick='javascript:colse_div();' style="cursor:hand;"></td>
		  </tr>
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox03.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox04.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		</table>
		</div>

		<div  id='emo4' style='display:none;position:absolute;top:420;left:60;z-index:1000;'>
		<table width="192" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox01.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox02.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td bgcolor="#EDE3C8" style="padding: 0 5 0 5"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td width="5">&nbsp;</td>
				  <td><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_01.gif" border="0" onclick="javascript:emo_view(1);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_02.gif" border="0" onclick="javascript:emo_view(2);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_03.gif" border="0" onclick="javascript:emo_view(3);" style="cursor:hand;"><img src="/images/music_chat/new_jjokji/actm_btn_ptabm1_04a.gif"></td>
				</tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box01.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box02.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td bgcolor="#FFFFFF" style="padding: 0 5 0 5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_btn_back2.gif" border="0" style="cursor:hand;"  onclick='page_down03();'></td>
						<td width="100%" style="padding: 0 4 0 4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							  <td id='special01'>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span> 
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
							  </td>
							  <td id='special02' style="display:none;" >
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
								<span onclick="addText('��');" style="cursor:hand;">��</span>
							  </td>
							</tr>
						  </table></td>
						<td><img src="/images/music_chat/new_jjokji/actm_btn_next2.gif" border="0" style="cursor:hand;" onclick='page_up03();' ></td>
					  </tr>
					</table></td>
				</tr>
				<tr> 
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box03.gif" width="5" height="5"></td>
						<td width="100%" bgcolor="#FFFFFF"></td>
						<td><img src="/images/music_chat/new_jjokji/actm_et_p2box04.gif" width="5" height="5"></td>
					  </tr>
					</table></td>
				</tr>
			  </table></td>
		  </tr>
		  <tr> 
			<td height="20" bgcolor="#EDE3C8" align="center" valign="bottom"><img src="/images/music_chat/new_jjokji/actm_btn_popclose.gif" border="0" onclick='javascript:colse_div();' style="cursor:hand;"></td>
		  </tr>
		  <tr> 
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox03.gif" width="5" height="5"></td>
				  <td width="100%" bgcolor="#EDE3C8"></td>
				  <td><img src="/images/music_chat/new_jjokji/actm_et_pbox04.gif" width="5" height="5"></td>
				</tr>
			  </table></td>
		  </tr>
		</table>
		</div>

<!-- ���� virtual="/webchat/camchat/faceEmoticon.asp" �κ� �� -->


<script language="JavaScript" src="/include/js/music_chat/chatting_filter.js"></script>

<SCRIPT LANGUAGE="JavaScript">
<!--

var frbl;
var messtopframe;
var messerrorstate = "";
var currentChatRoom;
var objMyInfo;
var initiated = false;
var confirmExit = false;
var dlIntro;
var popIntroPic, popSingo, popNick, popMusic, popMusicList, popInvite;
var contextFlag = false;
var ctrlKeyFlag = false;

var font_bold = "";
var font_italic = "";
var font_underline = "";
var weburl = "/webchat/mserver_new/"; // ä�ü��� url
var weburl_pic = '/webchat/camchat/'



// �±� ���� �Լ�
function setTagCode(strString){
	while(strString != (strString = strString.replace("<", "&lt;")));
	while(strString != (strString = strString.replace(">", "&gt;")));
	return strString;
}
// �����̽� ���� �Լ�
function getSpaceCode(strString){
	while(strString != (strString = strString.replace(" ", "|")));
	return strString;
}
function setSpaceCode(strString){
	while(strString != (strString = strString.replace("|", " ")));
	return strString;
}


function Callinit(){

	txtoutput.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
	txtoutput.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll'>");
	txtoutput.document.write("</body>");

	var strInit = '';
	strInit = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
    strInit += '�Ұ����� ���� ����� ����ó�� ����� �� �� �ֽ��ϴ�.<br>�������� ��ڴ� ������� ������ �ʽ��ϴ�.<br><font color=#FF0000>���Ǹ����� ���̷� ���Ա� �䱸, 060��ȭ��ȭ ����, ��ڻ�Ī, ȭ��ä�� ����,<br>�ҹ�����Ʈ ������ �����ϴ� ���� ��Ⱑ �߻��ϰ� ������ �����Ͻñ� �ٶ��ϴ�.</font><br>� ���� �������� ��й�ȣ�� ���� ��й�ȣ�� �˷����� ���ʽÿ�!';
	
	strInit += '<br><br></td></tr></table>';
   
    txtoutput.document.write(strInit);
    txtoutput.document.body.scrollTop=1000000;
    
    initiated = true;

}	


function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

//��Ʈ����
function fontColor(strColor){
	document.all.font_color.value = strColor;
}

//��Ʈü
function fontFace(strFace){
	document.all.font_face.value = strFace;
}
function fontUnderline(){
	if (font_underline == "") {
		font_underline = "<u>";
	} else {
		font_underline = "";
	}
}
//UnderLine
function get_font(index){
	if (index == 1) {
		return font_bold + font_italic + font_underline;
	} else {
		var rtnVal = "";
		if (font_underline) rtnVal += "</u>";
		if (font_italic) rtnVal += "</i>";
		if (font_bold) rtnVal += "</b>";
		return rtnVal
	}
}	

function MsgColor(strColor, strFace, strLine, strBold, strItalic)
{
	document.all.font_color.value = strColor;
	document.all.font_face.value = strFace;
	if (strLine == '1')
	{
		font_underline = "<u>";
	}
	else
	{
		font_underline = "";
	}
	if (strBold == '1')
	{
		font_bold = "<b>";
	}
	else
	{
		font_bold = "";
	}
	if (strItalic == '1')
	{
		font_italic = "<i>";
	}
	else
	{
		font_italic = "";
	}
}

/////////////////////////////////////////////////////////////////////
var inviteUserSerialCount = 0; // 1:1 ä�ý�û�� ī��Ʈ (��û �������)
var arrInviteUser = new Array(); // 1:1 ��û�� Object �迭

// ä�ù� ����� object ������
function chatRoomUser(userID)
{
	this.userID = userID;
}
/////////////////////////////////////////////////////////////////////
function UserInfo(userID)
{
	arrInviteUser[inviteUserSerialCount++] = new chatRoomUser(userID);
}
//ä�� ���� �Ҷ� ����
function inviteUserDel(userID){
	var idx = null;
	if ((idx = getInviteUser(userID)) == null)
	{
		return;
	}
	else
	{
		delete arrInviteUser[idx];

		for (var i=idx; i<inviteUserSerialCount; i++) {
			arrInviteUser[i] = arrInviteUser[i+1];
		}
		
		inviteUserSerialCount--;
	}
}

function getInviteUser(userID){
	for (var i=0; i<inviteUserSerialCount; i++) {
		if (arrInviteUser[i].userID == userID) {
			return i;
		}
	}	
	return null;
}
// ä�� ���� �Ҷ� ��

//ä���� Ȯ��
function confirm_user()
{
	for (var i=0; i<inviteUserSerialCount; i++) 
	{
	}
}
//�������� ������ ��õ�ϼ̽��ϴ� �޼��� �����ֱ�
function stringMsg(strMsg)
{
	var chooMsg = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center height=30><font color=blue><b>'+strMsg+'</b></font><br></td></tr></table>';
	txtoutput.document.write(chooMsg);
    txtoutput.document.body.scrollTop=1000000;
}

//���ǹ�� �ּҺ����ֱ�
function stringMusicURL(strMsg)
{
	var chooMsg = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center height=30><b>'+strMsg+'</b><br></td></tr></table>';
	txtoutput.document.write(chooMsg);
    txtoutput.document.body.scrollTop=1000000;
}

//ä���� Ȯ��
function recv_message(srcID, strRealMsg, MeChk, myNickname, myAvata, mySex, strColor, strFace, strLine, strBold, strItalic)
{

	var ifr_name = eval("document.all.ifr_"+srcID);
	if (ifr_name)
	{
	}
	else
	{
		UserInfo(srcID);
		selectIframe.outerHTML += "<iframe name='ifr_"+ srcID + "' src='' width='665' height='196' scrolling='yes' border='0' frameborder='0'style='display:none;'></iframe>";
		var ifr_css = eval('ifr_' + srcID);
		ifr_css.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
		ifr_css.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll' >");
		ifr_css.document.write("</body>");
	}

	var myAvata = myAvata;
	var style_color = strColor;
	var font_face = strFace ;
	var font_color = "#2B336B";
	var msgUser;
	var strMessage;
	var strBgcol = '';
	var strFncol = '';
	var f_str;

	if (strLine == '1')
	{
		font_underline = "<u>";
	}
	else
	{
		font_underline = "";
	}
	if (strBold == '1')
	{
		font_bold = "<b>";
	}
	else
	{
		font_bold = "";
	}
	if (strItalic == '1')
	{
		font_italic = "<i>";
	}
	else
	{
		font_italic = "";
	}

	while(myNickname != (myNickname = myNickname.replace(";aps", "'")));

	while(strRealMsg != (strRealMsg = strRealMsg.replace("|", " ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace(";aps", "'")));

	while(strRealMsg != (strRealMsg = strRealMsg.replace("/^^/", "<img src = '/images/music_chat/camchat/font/font_01.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ñ�/", "<img src = '/images/music_chat/camchat/font/font_02.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_03.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�޸���/", "<img src = '/images/music_chat/camchat/font/font_04.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/font/font_05.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/font/font_06.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�����/", "<img src = '/images/music_chat/camchat/font/font_07.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_08.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_09.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�޷�/", "<img src = '/images/music_chat/camchat/font/font_10.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�̿�/", "<img src = '/images/music_chat/camchat/font/font_11.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_12.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��й�/", "<img src = '/images/music_chat/camchat/font/font_13.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ǻ�/", "<img src = '/images/music_chat/camchat/font/font_14.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/font/font_15.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�����/", "<img src = '/images/music_chat/camchat/font/font_16.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�÷�/", "<img src = '/images/music_chat/camchat/font/font_17.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ȳ�/", "<img src = '/images/music_chat/camchat/font/font_18.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�Ⱦ���/", "<img src = '/images/music_chat/camchat/font/font_19.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���α���/", "<img src = '/images/music_chat/camchat/font/font_20.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ܷο���/", "<img src = '/images/music_chat/camchat/font/font_21.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�����/", "<img src = '/images/music_chat/camchat/font/font_22.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ȭ��ȣ/", "<img src = '/images/music_chat/camchat/font/font_23.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/font/font_24.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_25.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/font/font_26.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ī/", "<img src = '/images/music_chat/camchat/font/font_27.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/ŷī/", "<img src = '/images/music_chat/camchat/font/font_28.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/font/font_29.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_30.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/font/font_31.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�����ؿ�/", "<img src = '/images/music_chat/camchat/font/font_32.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/HI/", "<img src = '/images/music_chat/camchat/font/font_33.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/NO/", "<img src = '/images/music_chat/camchat/font/font_34.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/OK/", "<img src = '/images/music_chat/camchat/font/font_35.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/YES/", "<img src = '/images/music_chat/camchat/font/font_36.gif'> ")));


	while(strRealMsg != (strRealMsg = strRealMsg.replace("/19/", "<img src = '/images/music_chat/camchat/etc/etc_01.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ȥ/", "<img src = '/images/music_chat/camchat/etc/etc_02.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/etc/etc_03.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/etc/etc_04.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/etc/etc_05.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��/", "<img src = '/images/music_chat/camchat/etc/etc_06.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��/", "<img src = '/images/music_chat/camchat/etc/etc_07.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/etc/etc_08.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/etc/etc_09.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�Լ�/", "<img src = '/images/music_chat/camchat/etc/etc_10.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/etc/etc_11.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/etc/etc_12.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��������/", "<img src = '/images/music_chat/camchat/etc/etc_13.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ڵ���/", "<img src = '/images/music_chat/camchat/etc/etc_14.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/etc/etc_15.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ȭ/", "<img src = '/images/music_chat/camchat/etc/etc_16.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�꽺/", "<img src = '/images/music_chat/camchat/etc/etc_17.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/ķ/", "<img src = '/images/music_chat/camchat/etc/etc_18.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/Ŀ��/", "<img src = '/images/music_chat/camchat/etc/etc_19.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�±ر�/", "<img src = '/images/music_chat/camchat/etc/etc_20.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/etc/etc_21.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ź/", "<img src = '/images/music_chat/camchat/etc/etc_22.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ڵ���/", "<img src = '/images/music_chat/camchat/etc/etc_23.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ݿ�/", "<img src = '/images/music_chat/camchat/etc/etc_24.gif'> ")));


	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�����/", "<img src = '/images/music_chat/camchat/weather/weather_01.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/weather/weather_02.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/������/", "<img src = '/images/music_chat/camchat/weather/weather_03.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ٶ�/", "<img src = '/images/music_chat/camchat/weather/weather_04.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��/", "<img src = '/images/music_chat/camchat/weather/weather_05.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/õ��/", "<img src = '/images/music_chat/camchat/weather/weather_06.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ǳ/", "<img src = '/images/music_chat/camchat/weather/weather_07.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�帲/", "<img src = '/images/music_chat/camchat/weather/weather_08.gif'> ")));



	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_01.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�⺻/", "<img src = '/images/music_chat/camchat/expression/expression_02.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/expression/expression_03.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�޷�2/", "<img src = '/images/music_chat/camchat/expression/expression_04.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�θ�/", "<img src = '/images/music_chat/camchat/expression/expression_05.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_06.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�г�/", "<img src = '/images/music_chat/camchat/expression/expression_07.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_08.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/���/", "<img src = '/images/music_chat/camchat/expression/expression_09.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_10.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_11.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_12.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/��ũ/", "<img src = '/images/music_chat/camchat/expression/expression_13.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_14.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/�ְ�/", "<img src = '/images/music_chat/camchat/expression/expression_15.gif'> ")));
	while(strRealMsg != (strRealMsg = strRealMsg.replace("/����/", "<img src = '/images/music_chat/camchat/expression/expression_16.gif'> ")));

	strMsg = '<font color=' + style_color + ' face=' + font_face;
	strMsg += '>' + get_font(1) + strRealMsg + get_font(0) + '</font>';

	if (MeChk == '0')
	{
		strBgcol = ' bgcolor=' + font_color;
		strFncol = '#FFFFFF';
	}

	strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td valign=top>';

	strMessage += '</td><td width=37 height=29 align=center>' + getSmallAvata(myAvata) + '</td>';
	strMessage += '<td>';
	strMessage += '<table width=105 border=0 cellpadding=0 cellspacing=0' + strBgcol + '>';
	strMessage += '<tr><td></td></tr>';
	strMessage += '<tr><td height=25 ><font color=' + strFncol + '>&nbsp;&nbsp;' + setSpaceCode(myNickname) + '</font></td>';
	strMessage += '<tr><td></td></tr></table></td><td width=5>&nbsp;</td>';
	strMessage += '<td width=510><img src=http://www.joyhunting.com/images/music_chat/camchat/br_color3_moving.gif width=14 height=12> ' + strMsg + '</td>';
	strMessage += '</tr></table>';

	f_str = Filter_Check(strMsg, 5, 560);
	txtoutput.document.write(f_str);
    txtoutput.document.write(strMessage);
    txtoutput.document.body.scrollTop=1000000;

	var personIframe = eval('ifr_'+ srcID);
	personIframe.document.write(f_str);
	personIframe.document.write(strMessage);
    personIframe.document.body.scrollTop=1000000;
 
}
function getSmallAvata(strSAvataID){
	var imgBase;
	imgBase = (new String(strSAvataID).substring(0, 4) == "mini") ? "character" : "www";
	return '<img src=http://' + imgBase + '.joyhunting.com/' + strSAvataID + ' align=absmiddle>';
}
//��û��
function clearText(){
	txtoutput.document.body.innerHTML='';
}

//�ڱ�Ұ�
	function Before_introduce(userid)
	{		
		window.open('/etc/music_chat/showintro/userid/<?=$chatid?>','showintro','width=371,height=290');
	}
	function introduce(userid, exp, nickname)
	{
		while(nickname != (nickname = nickname.replace("\\", ";ws")));
		document.all.ifrm.src = '/etc/music_chat/facechat_introduce/userid/'+userid+'/exp/'+exp+'/r_nickname/'+nickname;
	}

//�����Ұ�
	function Before_picopen(userid)
	{
		window.open('/etc/music_chat/showintro_pic/userid/'+userid);
	}
	function picopen(userid, nickname, msgfile, avatacode)
	{

		while(nickname != (nickname = nickname.replace(";aps", "'")));
		var userid;
		var nickname;
		var msgfile;
		var avatacode;

			var verFlag = false;
			
			var verStr = navigator.userAgent;
			if (verStr.indexOf("MSIE") != -1){
				var ver = verStr.substring(verStr.indexOf("MSIE ") + 5, verStr.indexOf("MSIE ") + 6);
				if (ver >= 6) verFlag = true;
			}
			
		//	if (verFlag) {
				
				strMessage = '<br><table align=center bgcolor=white width=200 height=200 cellpadding=10 style=\"border:C2C2C2; border-style:solid; border-width:1px\" valign=top><tr>';
				strMessage += '<td>��<b>' + nickname + '</b> <font color=#666666>(' + userid + ') </font><br><br>';
				strMessage += '<center><iframe name=avata_page1 frameborder=0 width=113 height=152 src="/etc/music_chat/avata_view_chat/order/pic/filename/' + msgfile + '"></iframe></center>';
				strMessage += '</td></tr></table><br>';
		/*	} else {
				strMessage = '<br><table align=center bgcolor=white width=200 height=200 cellpadding=10 style=\"border:C2C2C2; border-style:solid; border-width:1px\" valign=top><tr>';
				strMessage += '<td>��<b>' + nickname + '</b> <font color=#666666>(' + userid + ') </font><br><br>';
				strMessage += '<center><table border=0 width=113 height=152 cellpadding=0 cellspacing=1 bgcolor=B4B2B2><tr>';
				strMessage += '<td bgcolor=#FFFFFF valign=top><img src=http://img.joyhunting.com/member_pic/' + escape(msgfile) + ' width=111 height=150 border=0></td></tr></table></center>';
				strMessage += '</td></tr></table><br>';
			}*/

		txtoutput.document.write(strMessage);
	    txtoutput.document.body.scrollTop=1000000;
	}

	function TalkNameChange(NewName, OldName)
	{
		var NewName;	//�ٲ� �г���
		var OldName;		//���� �г���

		strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
		strMessage += '<br><font color=#666666>����</font><font color=blue><b> ' + OldName + '</b></font><font color=#666666> ���� ��ȭ���� </font>';
		strMessage += '<font color=blue><b>' + NewName + '</b></font><font color=#666666> �� ����Ǿ����ϴ�!! ����</font><br>';
		strMessage += '</td></tr></table><br>';

		txtoutput.document.write(strMessage);
	    txtoutput.document.body.scrollTop=1000000;
	}

	function RoomIn(userid, nickname, codechk, idHide)
	{
		var userid;
		var nickname;

		while(nickname != (nickname = nickname.replace(";aps", "'")));

		var ifr_name = eval("document.all.ifr_"+userid);
		if (ifr_name)
		{
		}
		else
		{
			UserInfo(userid);
			selectIframe.outerHTML += "<iframe name='ifr_"+ userid + "' src='' width='665' height='196' scrolling='yes' border='0' frameborder='0'style='display:none;'></iframe>";
			var ifr_css = eval('ifr_' + userid);
			ifr_css.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
			ifr_css.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll' >");
			ifr_css.document.write("</body>");
		}

		if (codechk == '1')
		{
			if (idHide == '1')
			{
				strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
				strMessage += '<br><font color=#666666>���� <b>�г��Ӽ����</b>(���̵�����)�Բ��� �����ϼ̽��ϴ�!! ����</font><br>';
				strMessage += '</td></tr></table><br>';
			}
			else
			{
				strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
				strMessage += '<br><font color=#666666>���� <b>' + nickname + '</b>(' + userid + ')�Բ��� �����ϼ̽��ϴ�!! ����</font><br>';
				strMessage += '</td></tr></table><br>';
			}
		}
		else if (codechk == '2')
		{
			if (idHide == '1')
			{
				strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
				strMessage += '<br><font color=#666666>���� <b>�г��Ӽ����</b>(���̵�����)�Բ��� ����ϼ̽��ϴ�!! ����</font><br>';
				strMessage += '</td></tr></table><br>';
			}
			else
			{
				strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
				strMessage += '<br><font color=#666666>���� <b>' + nickname + '</b>(' + userid + ')�Բ��� ����ϼ̽��ϴ�!! ����</font><br>';
				strMessage += '</td></tr></table><br>';
			}
		}

		txtoutput.document.write(strMessage);
		txtoutput.document.body.scrollTop=1000000;
	}
//���� ����
	function RoomOwnChange(userid, nickname)
	{
		while(nickname != (nickname = nickname.replace(";aps", "'")));
		strMessage = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
		strMessage += '<br><font color=#666666>���� <b>' + nickname + '</b>(' + userid + ')������ ������ �ٲ�����ϴ�.!! ����</font><br>';
		strMessage += '</td></tr></table><br>';

		txtoutput.document.write(strMessage);
		txtoutput.document.body.scrollTop=1000000;
	}


function ChatRoomIn(srcID)
{
	UserInfo(srcID);
	selectIframe.outerHTML += "<iframe name='ifr_"+ srcID + "' src='' width='665' height='196' scrolling='yes' border='0' frameborder='0'style='display:none;'></iframe>";	
	var ifr_css = eval('ifr_' + srcID);
	ifr_css.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
	ifr_css.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll' >");
	ifr_css.document.write("</body>");

}

//ó�� ä�� ���ö�
function ChatRoomInOn(srcID)
{
	var aID = srcID.split("-");
	for (i = 0;i < aID.length ;i++ )
	{
		UserInfo(aID[i]);
		selectIframe.outerHTML += "<iframe name='ifr_"+ aID[i] + "' src='' width='665' height='196' scrolling='yes' border='0' frameborder='0'style='display:none;'></iframe>";

		var ifr_css = eval('ifr_' + aID[i]);

		ifr_css.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
		ifr_css.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll' >");
		ifr_css.document.write("</body>");

	}
}
function TextViewChange_a(srcID)
{
	alert('aaaaaaaaaaaaaa');
}
function TextViewChange(srcID)
{
	var srcID=srcID
	if (srcID == 'all')
	{
		for (var i=0; i<inviteUserSerialCount; i++) 
		{
			var displayIframe = eval('document.all.ifr_'+ arrInviteUser[i].userID);

			if(displayIframe.length != "2" ){
				displayIframe.style.display = 'none';
			}

		}
		document.all.txtoutput.style.display = '';
	}
	else
	{
		for (var i=0; i<inviteUserSerialCount; i++) 
		{
			var displayIframe = eval('document.all.ifr_'+ arrInviteUser[i].userID);
			
			if(displayIframe.length != "2" ){
				displayIframe.style.display = 'none';
			}

		}
		document.all.txtoutput.style.display = 'none';
		var displayIframe = eval('document.all.ifr_'+ srcID);
			if(displayIframe.length != "2" ){
			displayIframe.style.display = '';
		}
	}
}

	//���� ���� �߰� �Լ�
	function SetDocumentWriteId(srcID, srcNick)
	{
		txtoutput.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
		txtoutput.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll'>");
		txtoutput.document.write("</body>");
		
		var strInit = '';
		strInit = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
		strInit += '<font color=\#0070C0>'+srcNick+'\('+srcID+'\)�� ���� ������ �Ǽ̽��ϴ�.<\/font>';
		strInit += '</td></tr></table>';
		txtoutput.document.write(strInit);
	}

	//������ ���Ǻ��� �߰� �Լ�
	function SetDocumentWriteNo()
	{
		txtoutput.document.write("<head><link href=\"http://www.joyhunting.com/include/css/music_chat/joyhunting.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">td {font-size: 12px;font-family:����}</style></head>");
		txtoutput.document.write("<body bottommargin=0 topmargin=0 leftmargin=0 rightmargin=0 style='background-attachment:fixed;background-position: 370px 30px;background-repeat:no-repeat;overflow-x:hidden;overflow-y:scroll'>");
		txtoutput.document.write("</body>");
		
		var strInit = '';
		strInit = '<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td align=center>';
		strInit += '<font color=\#595959>����Ǿ��� �ɼǰ� �������� ���Ƿ� ����Ǿ����� <\/font><font color=\#FF0000>\'�����\'<\/font><font color=\#595959> ���� �ٽ� �����Ͻ��� ��ſ� ��ȭ��������.<\/font>';
		strInit += '</td></tr></table>';
		txtoutput.document.write(strInit);
	}
//-->
</SCRIPT>
<body onload="javascript:ChatRoomInOn('<?=$chatid?>');" style="overflow:hidden;" topmargin="0" leftmargin="0">
<input type="hidden" name="font_color">
<input type="hidden" name="font_face">
<table cellpadding="0" cellspacing="0" border="0" width="665" height="196">
<tr>
<td>
<iframe name="txtoutput" src="" width="665" height="196" scrolling="yes" border="0" frameborder="0"></iframe>
<iframe name="ifrm" src="" width="0" height="0" border="0" frameborder="0"></iframe>
<iframe name="myinfo" src="" width="0" height="0" border="0" frameborder="0"></iframe>
<div id="selectIframe"></div>
</td>
</tr>
</table>
</BODY>
</HTML>