
<div class="padding_top_10 padding_left_20">

	<table class="popup_border_table width_420 margin_top_18" id="tbl" style="white-space:nowrap;">
		<tr>
			<td class="padding_left_11 width_65">차단분류</td>
			<td class="padding_left_8"><?=$GUBN?></td>
			<td class="padding_left_11 width_65">처벌분류</td>
			<td class="padding_left_8">영구정지</td>
		</tr>
		<tr>
			<td class="padding_left_11 width_65">처벌일</td>
			<td class="padding_left_8"><?=date("Y-m-d", strtotime($block_data['WRITE_DATE']))?></td>
			<td class="padding_left_11 width_65">처벌해제일</td>
			<td class="padding_left_8"><?=date("Y-m-d", strtotime($block_data['BLOCK_DATE']))?></td>
		</tr>
		<tr>
			<td class="padding_left_11 width_65">처벌내용</td>
			<td colspan="3">
				<div id="reason" class="break_all padding_bottom_10 padding_top_10 width_318"><?=$block_data['REASON']?></div>
			</td>
		</tr>
	</table>

	<p class="blod margin_top_20"></p>

</div>

<div class="margin_top_10 text-center padding_bottom_20">
	<input type="button" id="" name="" value="닫기" style="width:100px; height:30px; border-radius:10px; background-color:#E15148; border:0; color:#FFF; font-weight:bold;" onclick="javascript:location.href='/';">
</div>



<script type="text/javascript">

	$(document).ready(function(){
		$("#modal_close_btn").attr("onclick", "");
		$("#modal_close_btn").click(function(){ 
			$(location).attr("href", "/");
		});
		
		if(is_mobile == true){
			$("#tbl").removeClass("width_420");
			$("#tbl").addClass("width_100per");
			$("#tbl > tr > td").width("25%");
			$("#reason").removeClass("width_318");

			if($(window).width() > "360"){
				$(".modal_pop_title_left > b").css("font-size", "1.2em");
			}else{
				$(".modal_pop_title_left > b").css("font-size", "1.1em");
			}
			
		}
	});

</script>
