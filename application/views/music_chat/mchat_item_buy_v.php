<html lang="ko">
<head>
<title> 구매 </title>
<meta http-equiv="Content-type" content="text/html; charset=euc-kr" />
<meta http-equiv="Cache-Control" content="no-cache" />

<LINK href="/include/css/music_chat/joyhunting.css" rel="stylesheet" type="text/css">

</head>
<!--팝업사이즈437*535-->
<body topmargin="0" leftmargin="0" style="overflow=hidden;" onkeydown="javascript:nof11key();" oncontextmenu="return false" onselectstart="return false">
<form name="new_frm" id="new_frm" method="post">
<input type="hidden" name="Nptype" id="Nptype" value="7">
<input type="hidden" name="Nprdtnm" id="Nprdtnm" value="이성작업방">
<input type="hidden" name="Nprice" id="Nprice" value="">
<input type="hidden" name="Ninum" id="Ninum" value="28">
<input type="hidden" name="Nitype" id="Nitype" value="1">
<input type="hidden" name="NplusTerm" id="NplusTerm" value="">
<input type="hidden" name="totalPayMentPage" id="totalPayMentPage" value="">
<input type="hidden" name="NUnikNum" id="NUnikNum" value="">
</form>
<table cellpadding="0" cellspacing="0" width="410">
	<FORM METHOD="POST" ACTION="mchat_item_buy_ok.asp" name="pay_f" id="pay_f" target="proc_frm">
	<input type="hidden" name="myid" id="myid" value="wwkorea1030">
	<input type="hidden" name="item_id" id="item_id" value="28">
	<input type="hidden" name="money" value="46">
	<input type="hidden" name="t_type" value="1">
	<input type="hidden" name="item_img" value="">
	<input type="hidden" name="item_name" value="이성작업방">
	<input type="hidden" name="toID" id="toID" value="">
	<input type="hidden" name="carat_an" id="carat_an" value="">
	<input type="hidden" name="poker" id="poker" value="">
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td width="414" align="center">
				<!--내용 시작-->
				<table cellpadding="0" cellspacing="0" id="RadioCnt">
					<tr>
						<td>
							<!--아이템 미리보기 시작-->
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td width="4"><img src="/images/music_chat/p_item/tbl2_bg1.gif"></td>
									<td width="378" background="/images/music_chat/p_item/tbl2_bg2.gif"></td>
									<td width="4"><img src="/images/music_chat/p_item/tbl2_bg3.gif"></td>
								</tr>
								<tr>
									<td width="4" background="/images/music_chat/p_item/tbl2_bg4.gif"></td>
									<td style="padding-top:10;padding-left:10;padding-bottom:10" width="378">
										<table cellpadding="0" cellspacing="0" width="378">
											<tr>
												<td><img src='/images/music_chat/item_image/<?=$img?>' width=106 height=85 border=0 > </td>
												<td style="padding-top:10;padding-left:10">
													<table cellpadding="0" cellspacing="0" width="250">
														<tr>
															<td><b><?=$title?></b>
															</td>
														</tr>
														<tr>
															<td style="padding-top:10"><?=$str?></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td width="4" background="/images/music_chat/p_item/tbl2_bg5.gif"></td>
								</tr>
								<tr>
									<td width="4"><img src="/images/music_chat/p_item/tbl2_bg6.gif"></td>
									<td background="/images/music_chat/p_item/tbl2_bg7.gif"></td>
									<td width="4"><img src="/images/music_chat/p_item/tbl2_bg8.gif"></td>
								</tr>
							</table>
							<!--아이템 미리보기 끝-->
						</td>
					</tr>

					<tr>
						<td style="padding-top:5">
							<table cellpadding="0" cellspacing="0" width="386" bgcolor="#F5F5F5">
								<tr>
									<td style="padding:30;">
											현재 이벤트 기간중 무료사용 가능한 아이템입니다.<br><br>
													(자동 적용중)
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td style="padding-top:5">
							<table>
								<tr>
									<td><img src="/images/music_chat/item/item_p/icon_1.gif"></td>
									<td><font color="#E35000"><b>구매계산하기</b></font></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td width="386" height="3" background="/images/music_chat/item/item_p/table_bg_line.gif"></td>
								</tr>
								<tr>
									<td>
										<table cellpadding="0" cellspacing="0" align="center">
											<tr>
												<td height="26" width="15" align="center"><img src="/images/music_chat/item/item_p/p_icon5.gif"></td>
												<td width="100"><b>총 결제할 금액</b></td>
												<td width="184"></td>
												<td width="70" style="padding-right:10" align="right"><font color="#FF6600"><b><span class="style3" id=min>0</span></b> 포인트</font></td>
											</tr>
											<tr>
												<td colspan="4" background="/images/music_chat/item/item_p/table_bg_line_1.gif"	height="1"></td>
											</tr>	
											<tr>
												<td height="36" width="15" align="center"><img src="/images/music_chat/item/item_p/p_icon5.gif"></td>
												<td width="100">나의 보유 금액</td>
												<td width="184" align="right">
												</td>
												<td width="70" style="padding-right:10" align="right"><font color="#FF6600"><b>0</b> 포인트</font></td>
											</tr>
											<tr>
												<td colspan="4" background="/images/music_chat/item/item_p/table_bg_line_1.gif" height="1"></td>
											</tr>
											<tr>
												<td height="26" width="15" align="center"><img src="/images/music_chat/item/item_p/p_icon5.gif"></td>
												<td width="100"><b><span id="latetext">남은 금액</span></b></td>
												<td colspan="2" style="padding-right:10px;" align="right"><font color="#FF6600"><b><span class="style3" id=ucash> 0</span></b> 포인트</font></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="386" height="1" bgcolor="#FF4800"></td>
								</tr>
								<tr>
									<td style="padding-top:10">
									
										<table cellpadding="0" cellspacing="0" bgcolor="#F3F3F3" height="29" width="386">
											<tr>
												<td align="center">해당 아이템을 구매하시겠습니까?</td>
												<td style="padding-top:5">
													<table cellpadding="0" cellspacing="0">
														<input type="hidden" name="slide_chk" value="">
														<tr>
															<td><a href="javascript:alert('현재 적용되어있는 아이템 입니다.');"><img src="/images/music_chat/item/item_p/buy_button.gif" width="71" height="26" border="0"></a></td>
															<td style="padding-left:5"><a href="javascript:WinClose();"><img src="/images/music_chat/item/item_p/cancel_button.gif" width="61" height="27" border="0"></a></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
			</table>
			<!--내용 끝-->
		</td>
	</tr>

</table>
</form>


</body>
</html>