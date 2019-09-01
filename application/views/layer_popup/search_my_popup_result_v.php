			<input type="hidden" id="chk_val" name="chk_val" value="id">
			<div class="padding_top_10 padding_left_20">
				
				<div class="margin_top_30">
					<p class="color_333 blod font-size_14">아이디 검색결과는 총 <?=$total_num?>개입니다.</p>
				</div>
				
				<!-- 아이디 찾기결과 -->
				<table class="popup_border_table width_480" id="id_search">
					<tr>
						<td>아이디</td>
						<td class="width_366">
							<div class="select_box_ccc_border">
							<select class="width_120 height_22" id="search_id" name="search_id">
								<option value="">아이디 검색결과</option>
								<?
									for($i=0; $i<$total_num; $i++){
								?>
								<option value="<?=$v_member_id[$i]?>"><?=$v_member_id[$i]?></option>
								<?
									}
								?>
							</select>
							</div>
						</td>
					</tr>
					
				</table>
				<!-- 아이디 찾기결과 -->
					
			</div>
			
			<div class="margin_top_20 text-center padding_bottom_30" id="confirm_id">
				<input type="button" class="text_btn_de4949 width_98 height_30" value="닫기" onclick="javascript:close_popup('id');"/>
			</div>
			