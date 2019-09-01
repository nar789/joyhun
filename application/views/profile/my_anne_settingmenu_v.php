		<div class="margin_top_23">
				<span class="color_999">선택한 앤을</span>

				<? if ($style == '1'){		// 내가 등록한 앤?>

					<input type="button" class="text_btn_dcdcdc width_48 height_20 color_333 blod" value="앤삭제" onclick="javascript:chk_remove_anne();"/>

				<? }else if ($style == '2'){		//나를 등록한 앤 ?>

					<input type="button" class="text_btn_dcdcdc width_95 height_20 color_333 blod" value="내 앤으로 추가 " onclick="javascript:reg_anne();"/>

				<? } ?>
			
			
			<div class="clear"></div>
		</div>