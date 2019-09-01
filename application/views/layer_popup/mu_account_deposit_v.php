
<div class="deposit_div">
	
	<div class="tit">
		<div class="fts">
			<?=$deposit_tit?>
		</div>
	</div>

	<div class="contents">
		
		<form id="frmView" name="frmView" method="post">
		<input type="hidden" id="m_product_code" name="m_product_code" value="<?=@$code?>">

		<table id="deposit_table" class="popup_border_table_mobile">
			<tr>
				<td>상품명</td>
				<td><?=$plist['m_goods']?></td>
			</tr>
			<tr>
				<td>결제금액</td>
				<td><?=$plist['m_price']?>원</td>
			</tr>
			<tr height="80">
				<td>입금자명</td>
				<td>
					<input type="text" id="m_name" name="m_name" value="<?=$this->session->userdata['m_name']?>" style="width:100px; height:20px; margin-bottom:1%; margin-top:1%;" onkeyup="javascript:onkeyup_enter();">
					<font style="color:#ed4949; line-height:16px;" class="info_text">
					<br>* 빠른 자동 입금확인을 원하시면,<br>&nbsp;&nbsp; 통장에 찍히는 송금자분 성함을 꼭 일치시켜 주세요. </font>
				</td>
			</tr>
			<tr height="70">
				<td>입금정보<br>전송</td>
				<td>
					<div class="select_box_ccc_border color_666">
					<select id="m_hp1" name="m_hp1" class="width_100 height_22 color_666">
						<option value="010">010</option>
						<option value="011">011</option>
						<option value="016">016</option>
						<option value="017">017</option>
						<option value="018">018</option>
						<option value="019">019</option>
					</select>
					</div>
					-
					<input type="text" id="m_hp2" name="m_hp2" value="" style="width:80px; height:20px;" maxlength="4" onkeyup="javascript:onkeyup_enter();">
					-
					<input type="text" id="m_hp3" name="m_hp3" value="" style="width:80px; height:20px;" maxlength="4" onkeyup="javascript:onkeyup_enter();">
					<br><br>
					<font style="color:#929292;" class="info_text">문자메세지로 예금은행, 입금금액, 계좌번호를 보내드립니다.</font>
					</div>
				</td>
			</tr>
		</table>
		</form>

	</div>

</div>

<div class="margin_top_20 text-center padding_bottom_30">
	<input type="button" class="text_btn_de4949 width_80 height_30" value="결제하기" onclick="javascript:deposit_btn();"/>	
</div>


<style>

	.fts {font-size:12px !important;}
	.deposit_div .tit .fts { top:20px !important;}

	#m_hp1,#m_hp2,#m_hp3 { width:55px !important;}


@media all and (max-width:320px){		/* 작은화면용 (ex.Galaxy S2,S1, iPhone 4, iPhone5)*/
	
	#m_hp2,#m_hp3 { width:32px !important; padding-left:0px !important;}
	.info_text { font-size:10px !important; }

}

@media all and (min-width:430px) and (max-width:599px){		/* 작은화면의 가로모드 (ex.Galaxy S2,S1, iPhone 4, iPhone5) (orientation:landscape) */
}

@media all and (min-width:600px){	/* width:600이상 or 가로모드 (orientation:landscape) */
	.fts {font-size:15px !important;}
	.deposit_div .tit { height:70px; !important;}
}


</style>