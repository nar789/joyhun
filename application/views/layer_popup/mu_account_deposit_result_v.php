
<div class="deposit_div">
	
	<div class="tit">
		<div class="fts">
			<?=$deposit_tit?>
		</div>
	</div>

	<div class="contents">
		
		<table id="deposit_table" class="popup_border_table">
			<tr>
				<td>입금자 성함</td>
				<td><?=$mlist['m_name']?></td>
			</tr>
			<tr>
				<td>입금하실 금액</td>
				<td style="color:red;"><?=number_format($mlist['m_price'])?>원</td>
			</tr>
			<tr>
				<td>입금은행</td>
				<td>우리은행</td>
			</tr>
			<tr>
				<td>입금계좌</td>
				<td>1005-301-131626</td>
			</tr>
			<tr>
				<td>예금주</td>
				<td>위드유(이흥일)</td>
			</tr>
		</table>

	</div>

	<div class="contents">
		<div class="supply_<?=$flg?>">
			<?=$customer_contents?>
		</div>
	</div>

</div>

<div class="margin_top_20 text-center padding_bottom_30">
	<input type="button" class="text_btn_de4949 width_80 height_30" value="닫기" onclick="modal.close();"/>	
</div>

