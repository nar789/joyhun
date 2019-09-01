<html>
<head>
<title>방제목 설정하기</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="http://www.joyhunting.com/include/css/default.css">
<style type="text/css">
<!--
body {
	padding-top:0px;
	margin: 0px;
	scrollbar-3dlight-color:#DADADA;
	scrollbar-arrow-color:#DADADA;
	scrollbar-track-color:#DADADA;
	scrollbar-darkshadow-color:#DADADA;
	scrollbar-face-color:#FFFFFF;
	scrollbar-highlight-color:#FFFFFF;
	scrollbar-shadow-color:#DADADA;
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
	width:324px;
	padding:2;
	height:23;
}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
	var my_cnt = '<?=$my_cnt?>';
	var myid = '<?=$myid?>';
	var item_chk = 'Y';
	var i_flag = '<?=$i_flag?>';
	var now_style = 1;
	var parent_val = '';
	var p_t_type = 2;

	function Set_Title()
	{
		var check_my, arr_tt;

		if (p_t_type == 1){
			arr_tt = sub_ifr1.document.getElementsByName("s_title");
		}else if (p_t_type == 3){
			arr_tt = sub_ifr3.document.getElementsByName("s_title");
		}else{
			arr_tt = sub_ifr2.document.getElementsByName("s_title");
		}

		if (parent_val == ''){
			alert('방제목을 선택하세요.');
		}else{
			if (i_flag == '1'){
				self.location.href = "javascript:Set_Title_Ok('"+parent_val+"');";
			}else{
				if (p_t_type == 1){
					self.location.href = "javascript:request_item();";
				}else if (p_t_type == 3){
					for (i=0 ; i<arr_tt.length; i++){
						if (arr_tt[i].checked == true){
							check_my = Style_Check(arr_tt[i].value);

							if (check_my == 0){
								self.location.href = "javascript:request_item();";
							}else{
								parent_val = check_my;
								self.location.href = "javascript:Set_Title_Ok('"+parent_val+"');";
							}
						}
					}
				}else{
					self.location.href = "javascript:Set_Title_Ok('"+parent_val+"');";
				}
			}
		}
	}

	function Set_Title_Ok(t_text)
	{
	}

	function request_item()
	{
	}

	function Item_ReCheck(i_param)
	{
		var aa_ary = sub_ifr2.document.getElementsByName("s_title");

		if (i_param == 1){
			i_flag = '1';
			Set_Title();
		}else{
			i_flag = '0';
			Set_Radio(2);
			aa_ary[0].checked = true;
			parent_val = aa_ary[0].value;
		}
	}

	function Item_BuyCheck(i_param)
	{
		if (i_param == 1){
			item_chk = 'Y';
			i_flag = '1';
		}else{
		}
	}

	function Reg_MyTitle()
	{
		document.getElementById("main_div").style.display = 'none';
		document.getElementById("sub_ifr4").src = '/etc/music_chat/musicchat_sub_reg/myid/<?=$myid?>';
		document.getElementById("reg_div").style.display = '';
	}

	function Reg_MyTitle_Ok()
	{
		document.getElementById("reg_div").style.display = 'none';
		document.getElementById("sub_ifr3").src = '/etc/music_chat/musicchat_sub_my/myid/<?=$myid?>';
		document.getElementById("main_div").style.display = '';
	}

	function Reg_MyTitle_Ok2()
	{
		document.getElementById("main_div").style.display = 'none';
		document.getElementById("sub_ifr4").src = '/etc/music_chat/musicchat_sub_reg/myid/<?=$myid?>';
		document.getElementById("reg_div").style.display = '';
	}

	function My_Title_Reg()
	{

		var title_ck = document.getElementById("i_title").value;

			if (parseInt(my_cnt) > 9){
				alert('최대 10개까지만 등록이 가능합니다.');
			}else{
				if (title_ck == ''){
					alert('제목을 입력해 주세요.');
					document.getElementById("i_title").focus();
				}else{

					document.getElementById("m_mode").value = '';
					document.getElementById("reg_frm").submit();
				}
			}

	}

	function Del_MyTitle(idx)
	{
		document.getElementById("t_idx").value = idx;
		document.getElementById("m_mode").value = 'del';
		document.getElementById("reg_frm").submit();
	}

	function MyTitle_Mod(i_val, t_idx)
	{
		document.getElementById("m_mode").value = 'mod';
		document.getElementById("t_idx").value = i_val;
		document.getElementById("t_title").value = document.getElementById(t_idx).value;
		document.getElementById("mod_frm").submit();
	}

	function MyTitle_Del(i_val)
	{
		document.getElementById("m_mode").value = 'del';
		document.getElementById("t_idx").value = i_val;
		document.getElementById("mod_frm").submit();
	}

	function Style_Prev()
	{
		var decim_check, new_i, click_num, new_val;
		var img_tag = document.getElementsByName("s_img");
		var chk_tag = document.getElementById("r_style").checked;

		if (chk_tag == false){
			alert('방제목 꾸미기를 선택하세요.');
		}else{
//			if (i_flag == 1){
				now_style = now_style - 1;
				new_val = '';

				if (now_style < 1){
					now_style = 1;
				}else{
					for (i=0; i<img_tag.length; i++){
						decim_check = now_style + i;
						click_num = decim_check - 1;

						if (decim_check < 10){
							new_i = '0' + decim_check;
						}else{
							new_i = decim_check;
						}

						if (new_i > 24){
							new_val += '<img src="/images/music_chat/title_room/room_t_img_w_'+new_i+'.gif" name="s_img" border="0" onclick="javascript:Set_Style('+click_num+');" style="cursor:hand;" />';

							if (i < img_tag.length-1){
								new_val += '&nbsp;&nbsp;&nbsp;';
							}
						}else{
							new_val += '<img src="/images/music_chat/title_room/room_t_img_w_'+new_i+'.gif" name="s_img" width="70" border="0" onclick="javascript:Set_Style('+click_num+');" style="cursor:hand;" />';

							if (i < img_tag.length-1){
								new_val += '&nbsp;';
							}
						}
					}

					document.getElementById("s_td").innerHTML = new_val;
				}

		}
	}

	function Style_Next()
	{
		var decim_check, new_i, click_num, new_val;
		var img_tag = document.getElementsByName("s_img");
		var chk_tag = document.getElementById("r_style").checked;

		if (chk_tag == false){
			alert('방제목 꾸미기를 선택하세요.');
		}else{
//			if (i_flag == 1){
				now_style = now_style + 1;
				new_val = '';

				if (now_style > 29){
					now_style = 29;
				}else{
					for (i=0; i<img_tag.length; i++){
						decim_check = now_style + i;
						click_num = decim_check - 1;

						if (decim_check < 10){
							new_i = '0' + decim_check;
						}else{
							new_i = decim_check;
						}

						if (new_i > 24){
							new_val += '<img src="/images/music_chat/title_room/room_t_img_w_'+new_i+'.gif" name="s_img" border="0" onclick="javascript:Set_Style('+click_num+');" style="cursor:hand;" />';

							if (i < img_tag.length-1){
								new_val += '&nbsp;&nbsp;&nbsp;';
							}
						}else{
							new_val += '<img src="/images/music_chat/title_room/room_t_img_w_'+new_i+'.gif" name="s_img" width="70" border="0" onclick="javascript:Set_Style('+click_num+');" style="cursor:hand;" />';

							if (i < img_tag.length-1){
								new_val += '&nbsp;';
							}
						}
					}

					document.getElementById("s_td").innerHTML = new_val;
				}
//			}else{
//				alert('아이템 구매를 해주시기 바랍니다.');
//				self.location.href = "javascript:i_buy('29');";
//			}
		}
	}
	
	function Set_Style(s_val)
	{
		var chk_tag = document.getElementById("r_style").checked;
		var i_tag = document.getElementById("i_title").value;
		var new_val = '';

		if (chk_tag == false){
			alert('방제목 꾸미기를 선택하세요.');
		}else{
//			if (i_flag == 1){
				document.getElementById("i_title").value = i_tag + '$' + s_val + '$'; 
				Set_Preview();
				document.getElementById("i_title").focus();
//			}else{
//				alert('아이템 구매를 해주시기 바랍니다.');
//				self.location.href = "javascript:i_buy('29');";
//			}
		}
	}

	function Set_Thema(t_val)
	{
		if (t_val == ''){
			alert('테마를 선택해 주세요.');
		}else{
			document.getElementById("sub_ifr1").src = '/etc/music_chat/musicchat_sub_new/t_val/'+t_val;
			document.getElementById("sub_ifr2").src = '/etc/music_chat/musicchat_sub_default/t_val/'+t_val;
		}
	}

	function Set_Preview()
	{
		var split_val, tmp_cnt, total_cnt, see_len;
		var i_cnt = 0;
		var t_cnt = 0;
		var t_val = document.getElementById("i_title").value;
		var new_val = '';

		split_val = t_val.split("$");

		if (event.keyCode == 13){  //엔터키 입력시 전송처리
			return false;
		}

		tmp_cnt = Check_Len(split_val[0]);
		t_cnt += tmp_cnt;

		for (i=1; i<split_val.length; i++){
			if ((parseInt(split_val[i]) > -1) && (parseInt(split_val[i]) < 32)){
				i_cnt += 1;
			}else{
				tmp_cnt = Check_Len(split_val[i]);
				t_cnt += tmp_cnt;
			}
		}

		total_cnt = t_cnt + (i_cnt * 2);
		see_len = (t_cnt * 6) + (i_cnt * 70);

		if (total_cnt <= 50){
			if (see_len <= 320){
				new_val = replace_ico(t_val);
				document.getElementById("t_prev").innerHTML = new_val;
			}else{
				new_val = replace_ico(t_val);
				document.getElementById("t_prev").innerHTML = '<marquee scrollamount=4>'+new_val+'</marquee>';
			}
		}else{
			alert('최대 25자까지 입력가능합니다.');
			document.getElementById("i_title").value = '';
			document.getElementById("t_prev").innerHTML = '';
		}
	}

	function Check_Len(vals)
	{
		var i;
		var tmp_len = 0;

		for (i=0; i<vals.length; i++){
			if(vals.charCodeAt(i) > 127){
				tmp_len += 2;
			}else{
				tmp_len += 1;
			}
		}

		return tmp_len;
	}

	function replace_ico(w_val)
	{
		var re_val, i_vals;

		for (i=0; i<32; i++){
			if (i < 9){
				i_vals = "0" + (i+1);
			}else{
				i_vals = i + 1;
			}
			while(w_val != (w_val = w_val.replace("$"+i+"$", "<img src='/images/music_chat/title_room/room_t_img_w_"+i_vals+".gif' align='absmiddle' border='0' />")));
		}

		re_val = w_val;

		return re_val;
	}

	function Set_Radio(t_type)
	{
		var arr_t1, arr_t2, arr_t3, sel_val;
		p_t_type = t_type;

		if (t_type == 1){
			arr_t1 = sub_ifr2.document.getElementsByName("s_title");
			arr_t2 = sub_ifr3.document.getElementsByName("s_title");
			arr_t3 = sub_ifr1.document.getElementsByName("s_title");
		}else if (t_type == 3){
			arr_t1 = sub_ifr1.document.getElementsByName("s_title");
			arr_t2 = sub_ifr2.document.getElementsByName("s_title");
			arr_t3 = sub_ifr3.document.getElementsByName("s_title");
		}else{
			arr_t1 = sub_ifr1.document.getElementsByName("s_title");
			arr_t2 = sub_ifr3.document.getElementsByName("s_title");
			arr_t3 = sub_ifr2.document.getElementsByName("s_title");
		}

		for (i=0 ; i<arr_t1.length; i++){
			arr_t1[i].checked = false;
		}

		for (i=0 ; i<arr_t2.length; i++){
			arr_t2[i].checked = false;
		}

		for (i=0 ; i<arr_t3.length; i++){
			if (arr_t3[i].checked == true){
				parent_val = arr_t3[i].value;
			}
		}
	}

	function Style_Check(s_vals)
	{
		var check_str, re_val;
		re_val = s_vals;

		for (i=0; i<32; i++){
			check_str = s_vals.split("$"+i+"$");

			if (check_str.length > 1){
				re_val = 0;
				break;
			}
		}

		return re_val;
	}

	function nof11key(){
		if((event.keyCode==116) || (event.keyCode==122)){ 
			event.keyCode = 0; 
			event.cancelBubble = true; 
			event.returnValue = false; 
		} 
	} 
//-->
</SCRIPT>
</head>
<body topmargin="0" leftmargin="0" oncontextmenu="return false;" onselectstart="return false;" onkeydown="nof11key();">
<div id="main_div" style="position:absolute; display:'';">
	<table width="360" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_t.gif" ></td>
	  </tr>
	  <tr>
		<td valign="top" background="/images/music_chat/title_room/bg_p_c.gif">
		  <table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td>
				<table width="348" border="0" align="center" cellpadding="0" cellspacing="0" background="/images/music_chat/title_room/bg_select.gif">
				  <tr>
					<td height="30"></td>
				  </tr>
				  <tr>
					<td height="30" align="center" valign="top">
					  <select name="sel_th" class="input2" id="sel_th" onchange="javascript:Set_Thema(this.value);">
						<option value="0" selected>전체 보기</option>
						<option value="1">동영상,영화,노래 감상하는 방</option>
						<option value="2">이성과의 진솔한 대화를 나누는 방</option>
						<option value="3">언제든, 어디든 모임을 위한 방</option>
						<option value="4">편안한 동성 혹은 이성 친구를 만나는 방</option>
						<option value="5">하루의 소소한 이야기를 나누는 방</option>
					  </select>
					</td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td style="padding:10px 0px 5px 0px;"><img src="/images/music_chat/title_room/title_01.gif" ></td>
			</tr>
			<tr>
			  <td>
				<table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td><img src="/images/music_chat/title_room/box_s_top.gif" ></td>
				  </tr>
				  <tr>
					<td height="70" valign="top" background="/images/music_chat/title_room/box_s_c.gif">
					  <table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td><img src="/images/music_chat/title_room/box_w_t.gif" /></td>
						</tr>
						<tr>
						  <td height="70" align="center" background="/images/music_chat/title_room/box_w_c.gif"><iframe src="/etc/music_chat/musicchat_sub_new" name="sub_ifr1" width="330" marginwidth="0" height="70" marginheight="0" scrolling="Auto" frameborder="0" id="sub_ifr1"></iframe></td>
						</tr>
						<tr>
						  <td><img src="/images/music_chat/title_room/box_w_b.gif" /></td>
						</tr>
					  </table>
					</td>
				  </tr>
				  <tr>
					<td height="10" valign="top"><img src="/images/music_chat/title_room/box_s_b.gif" ></td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td style="padding:10px 0px 5px 0px;"><img src="/images/music_chat/title_room/title_02.gif" ></td>
			</tr>
			<tr>
			  <td valign="top">
				<table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_t_1.gif" ></td>
				  </tr>
				  <tr>
					<td align="center" background="/images/music_chat/title_room/box_w_c_1.gif"><iframe width="340" height="60" frameborder="0" name="sub_ifr2" id="sub_ifr2" marginheight="0" marginwidth="0" scrolling="auto" src="/etc/music_chat/musicchat_sub_default"></iframe></td>
				  </tr>
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_b_1.gif" ></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_b.gif" ></td>
	  </tr>
	  <tr>
		<td height="5" bgcolor="#A5205A"></td>
	  </tr>
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_t.gif" ></td>
	  </tr>
	  <tr>
		<td valign="top" background="/images/music_chat/title_room/bg_p_c.gif">
		  <table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td align="left" valign="top">
				<table width="348" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="24" align="left" valign="middle"><img src="/images/music_chat/title_room/title_03.gif" ></td>
					<td align="right" valign="middle"><a href="javascript:Reg_MyTitle();"><img src="/images/music_chat/title_room/btn_register.gif" border="0" /></a></td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td valign="top">
				<table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_t_1.gif" ></td>
				  </tr>
				  <tr>
					<td align="center" background="/images/music_chat/title_room/box_w_c_1.gif"><iframe width="340" height="70" frameborder="0" name="sub_ifr3" id="sub_ifr3" marginheight="0" marginwidth="0" scrolling="auto" src="/etc/music_chat/musicchat_sub_my/myid/<?=$myid?>"></iframe></td>
				  </tr>
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_b_1.gif" ></td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td align="center" valign="middle"  style="padding:5px 0px 0px 0px;"><a href="javascript:Set_Title();"><img src="/images/music_chat/title_room/btn_yes.gif" border="0" /></a></td>
			</tr>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_b.gif" ></td>
	  </tr>
	  <tr>
		<td height="1" bgcolor="#A5205A"></td>
	  </tr>
	</table>
</div>

<div id="reg_div" style="position:absolute;display:none;">
  <form name="reg_frm" id="reg_frm" action="/etc/music_chat/musicchat_mytitle" target="view_frm" onSubmit="return false;" method="post">
   <input type="hidden" name="myid" id="myid" value="<?=$myid?>">
   <input type="hidden" name="m_mode" id="m_mode" value="">
   <input type="hidden" name="t_idx" id="t_idx" value="">
	<table width="360" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_t.gif"></td>
	  </tr>
	  <tr>
		<td height="100" align="left" valign="top" background="/images/music_chat/title_room/bg_p_c.gif">
		  <table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td align="left" style="padding:0px 0px 5px 0px;"><img src="/images/music_chat/title_room/title_04.gif" ></td>
			</tr>
			<tr>
			  <td><img src="/images/music_chat/title_room/box_s_top2.gif" ></td>
			</tr>
			<tr>
			  <td background="/images/music_chat/title_room/box_s_c.gif">
				<table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_t.gif" ></td>
				  </tr>
				  <tr>
					<td height="104" align="center" valign="top" background="/images/music_chat/title_room/box_w_c.gif">
					  <table width="320" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td><input type="checkbox" name="r_style" id="r_style" checked><span class="bd02">방제목 꾸미기 사용</span></td>
						</tr>
						<tr>
						  <td>
							<table width="320" border="0" cellpadding="0" cellspacing="1" bgcolor="#707070">
							  <tr>
								<td bgcolor="#FFFFFF">
								  <table width="324" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td width="20" height="30" align="left"><img src="/images/music_chat/title_room/btn_prev.gif" onclick="javascript:Style_Prev();" style="cursor:hand;" /></td>
									  <td align="center" valign="middle" id="s_td"><img src="/images/music_chat/title_room/room_t_img_w_01.gif" name="s_img" border="0" onclick="javascript:Set_Style(0);" style="cursor:hand;" />&nbsp;<img src="/images/music_chat/title_room/room_t_img_w_02.gif" name="s_img" border="0" onclick="javascript:Set_Style(1);" style="cursor:hand;" />&nbsp;<img src="/images/music_chat/title_room/room_t_img_w_03.gif" name="s_img" border="0" onclick="javascript:Set_Style(2);" style="cursor:hand;" />&nbsp;<img src="/images/music_chat/title_room/room_t_img_w_04.gif" name="s_img" border="0" onclick="javascript:Set_Style(3);" style="cursor:hand;" /></td>
									  <td width="20" align="right"><img src="/images/music_chat/title_room/btn_next.gif"  onclick="javascript:Style_Next();" style="cursor:hand;" /></td>
									</tr>
								  </table>
								</td>
							  </tr>
							</table>
						  </td>
						</tr>
						<tr>
						  <td height="4"></td>
						</tr>
						<tr>
						  <td height="1" background="/images/music_chat/title_room/bg_dot.gif"></td>
						</tr>
						<tr>
						  <td height="4"></td>
						</tr>
						<tr>
						  <td><input name="i_title" type="text" class="input2" id="i_title" onkeyup="javascript:Set_Preview();"></td>
						</tr>
						<tr>
						  <td height="4"></td>
						</tr>
						<tr>
						  <td height="1" background="/images/music_chat/title_room/bg_dot.gif"></td>
						</tr>
						<tr>
						  <td height="4"></td>
						</tr>
						<tr>
						  <td height="30"><span id="t_prev"></span></td>
						</tr>
					  </table>
					</td>
				  </tr>
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_b.gif" ></td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td><img src="/images/music_chat/title_room/box_s_b.gif"></td>
			</tr>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td height="20" align="center" background="/images/music_chat/title_room/bg_p_c.gif" style="padding-top:10px;"><a href="javascript:My_Title_Reg();"><img src="/images/music_chat/title_room/btn_register2.gif" border="0" /></a></td>
	  </tr>
	  <tr>
		<td height="10"><img src="/images/music_chat/title_room/bg_p_b.gif" ></td>
	  </tr>
	  <tr>
		<td height="5" bgcolor="#A5205A"></td>
	  </tr>
	  <tr>
		<td><img src="/images/music_chat/title_room/bg_p_t.gif"></td>
	  </tr>
	  <tr>
		<td background="/images/music_chat/title_room/bg_p_c.gif">
		  <table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td align="left" valign="top" style="padding:0px 0px 5px 0px;"><img src="/images/music_chat/title_room/title_05.gif" ></td>
			</tr>
			<tr>
			  <td valign="top">
				<table width="348" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_t_1.gif" ></td>
				  </tr>
				  <tr>
					<td align="center" background="/images/music_chat/title_room/box_w_c_1.gif"><iframe width="340" height="108" frameborder="0" name="sub_ifr4" id="sub_ifr4" marginheight="0" marginwidth="0" scrolling="auto" src="/etc/music_chat/musicchat_sub_reg/myid/<?=$myid?>"></iframe></td>
				  </tr>
				  <tr>
					<td><img src="/images/music_chat/title_room/box_w_b_1.gif" ></td>
				  </tr>
				</table>
			  </td>
			</tr>
			<tr>
			  <td align="center" valign="middle"  style="padding:5px 0px 0px 0px;"><a href="javascript:Reg_MyTitle_Ok();"><img src="/images/music_chat/title_room/btn_yes.gif" border="0" /></a></td>
			</tr>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td><img src="/images/music_chat/title_room/bg_p_b.gif"></td>
	  </tr>
	  <tr>
		<td height="1" bgcolor="#A5205A"></td>
	  </tr>
	</table>
  </form>
</div>
<iframe name="view_frm" id="view_frm" frameborder="0" width="0" height="0"></iframe>
</body>
</html>