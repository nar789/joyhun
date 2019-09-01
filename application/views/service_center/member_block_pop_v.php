<div style="position:relative; width:100%;">
	<div style="position:relative; width:100%; height:50px; background-color:#D53B3B; color:#FFF; font-size:1.3em; line-height:50px; text-align:center; font-weight:bold;">
		<?=$add_title?>
	</div>
	<div style="position:relative; width:100%; text-align:center; font-weight:bold;">
		<table cellspacing=0 cellpadding=0 style="width:100%; padding-top:20px;" class="block_tbl">
			<tr height="50">
				<td style="width:25%; background-color:#F4F4F6;">차단분류</td>
				<td style="width:25%;"><?=$GUBN?></td>
				<td style="width:25%; background-color:#F4F4F6;">처벌분류</td>
				<td style="width:25%;">영구정지</td>
			</tr>
			<tr height="50">
				<td style="background-color:#F4F4F6;">처벌일</td>
				<td><?=date("Y-m-d", strtotime($block_data['WRITE_DATE']))?></td>
				<td style="background-color:#F4F4F6;">처벌해제일</td>
				<td><?=date("Y-m-d", strtotime($block_data['BLOCK_DATE']))?></td>
			</tr>
			<tr height="50">
				<td style="background-color:#F4F4F6;">처벌내용</td>
				<td colspan="3" style="text-align:left; padding-left:10px;"><?=$block_data['REASON']?></td>
			</tr>
		</table>
	</div>
	
</div>

<style>
.block_tbl{border:solid 1px #E3E3E7;}
.block_tbl td:nth-child(1){border-top:solid 1px #E3E3E7; border-left:solid 1px #E3E3E7;}
.block_tbl td:nth-child(2){border-top:solid 1px #E3E3E7; border-left:solid 1px #E3E3E7;}
.block_tbl td:nth-child(3){border-top:solid 1px #E3E3E7; border-left:solid 1px #E3E3E7;}
.block_tbl td:nth-child(4){border-top:solid 1px #E3E3E7; border-left:solid 1px #E3E3E7;}
</style>