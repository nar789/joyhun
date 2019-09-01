

			
			<div class="padding_top_10 padding_left_20">

				<table class="popup_border_table width_420 margin_top_18">
					<tr>
						<td class="padding_left_11 width_65">처벌사유</td>
						<td class="padding_left_8"><?=police_cate($punish['p_cate'])?></td>
						<td class="padding_left_11 width_65">처벌분류</td>
						<td class="padding_left_8"><?=police_card($punish['p_card'])?></td>
					</tr>
					<tr>
						<td class="padding_left_11 width_65">처벌일</td>
						<td class="padding_left_8"><?=$punish['p_date']?></td>
						<td class="padding_left_11 width_65">처벌해제일</td>
						<td class="padding_left_8"><? if ($punish['p_card'] == '1'){ echo NOW; }else if($punish['p_card'] =='5'){ echo ""; }else{echo $punish['p_cancel']; }?></td>
					</tr>
					<tr>
						<td class="padding_left_11 width_65">처벌내용</td>
						<td colspan="3">
							<div class="break_all padding_bottom_10 padding_top_10 width_318"><?=$punish['p_content']?></div>
						</td>
					</tr>
				</table>

				<p class="blod margin_top_20"><?=@$puni_add?></p>

			</div>

			<div class="margin_top_10 text-center padding_bottom_20">
			</div>
