<div style="position:relative; width:100%; text-align:center;">
	<img src="<?=IMG_DIR?>/layer_popup/payment_title_2.png" id="back_url">
	<div style="position:absolute; width:90%; height:171px; top:0%; left:5%; line-height:150px; font-size:2.0em; font-weight:bold;">
		<?=@$result_text?>
	</div>

</div>
<div style="position:relative; width:100%;">
	
	<div style="position:relative; width:90%; top:0%; left:5%;">
		<table id="pay_table" class="popup_border_table">
			<tr>
				<td>결제금액</td>
				<td><?=@$v_goods['m_price']?>원(부가세포함)</td>
			</tr>
			<tr>
				<td>결제상품</td>
				<td><?=@$v_goods['m_goods']?></td>
			</tr>
			<tr>
				<td>결제방법</td>
				<td><?=pay_mode($pay_mode)?></td>
			</tr>
		</table>
	</div>

</div>

<div class="margin_top_20 text-center padding_bottom_30">
	<input type="button" class="text_btn_de4949 width_62 height_30" value="완료" id="pay_result_btn" onclick="javascript:location.href='/profile/point/charge_list';"/>	
</div>

<?=@$add_script?>