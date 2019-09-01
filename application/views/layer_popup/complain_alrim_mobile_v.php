

			
			<div class="padding_top_10 padding_left_10">

				<table class="popup_border_table margin_top_18">
					<tr>
						<td>처벌사유</td>
						<td><?=police_cate($punish['p_cate'])?></td>
					</tr>
					<tr>
						<td>처벌분류</td>
						<td><?=police_card($punish['p_card'])?></td>
					</tr>
					<tr>
						<td>처벌일</td>
						<td><?=$punish['p_date']?></td>
					</tr>
					<tr>
						<td>처벌해제일</td>
						<td><? if ($punish['p_card'] == '1'){ echo NOW; }else if($punish['p_card'] =='5'){ echo ""; }else{echo $punish['p_cancel']; }?></td>
					</tr>
					<tr>
						<td>처벌내용</td>
						<td>
							<div class="break_all"><?=$punish['p_content']?></div>
						</td>
					</tr>
				</table>

			</div>

			<div class="margin_top_10 text-center padding_bottom_20">
			</div>
