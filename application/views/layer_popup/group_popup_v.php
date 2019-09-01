		<form action="/friend/friend_add/fri_group_add" method="post" name="g_form" id="g_form">
			<div class="layout_padding">				
				<p class="color_666">그룹등록은 4개까지 가능합니다.</p>

				<table class="popup_border_table">
					<? foreach (call_friend_group($this->session->userdata['m_userid']) as $k => $v){ @$i++;?>
					<tr name="group_tr">					
						<td class="padding_0 width_33 text-center">
							<input type="checkbox" id="group_checkbox_<?=$i?>" class="popup_checkbox" name="chkList" value="<?=$i?>">
							<label for="group_checkbox_<?=$i?>" class="popup_checkbox_label"></label>
						</td>
						<td>					
						<input type="text" class="group_text color_666 g_name" name="m_gname[]" maxlength="8" value="<?=$v?>"/>						
						</td>						
					</tr>
					<? } ?>
				</table>

				<div class="margin_top_10 text-right">
					<div class="text_btn_dcdcdc group_btn blod" id="group_add_btn">
						<img src="<?=IMG_DIR?>/layer_popup/group_add.gif" class="margin_right_5">추가
					</div>
					<div class="text_btn_dcdcdc group_btn blod" id="group_del_btn">
						<img src="<?=IMG_DIR?>/layer_popup/group_del.gif" class="margin_right_5">삭제
					</div>
				</div>

				<div class="margin_top_20 text-center">
					<input type="submit" class="text_btn_de4949 width_62 height_30" value="수정" >
				</div>
			</div>
		</form>

<script>
	//친구등록하기로 돌아가기위한 대상 아이디
	var user_id = "<?=$user_id?>";

</script>