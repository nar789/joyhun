		<form id="frmSearch" name="frmSearch" method="get">
			<input type="hidden" id="tabmenu" name="tabmenu" value="<?=@$tabmenu?>">
			<input type="hidden" id="v_group" name="v_group" value="<?=@$v_group?>">
		</form>
		<div class="margin_top_23">
			<div class="float_left">
				<span class="color_999">선택한 친구를</span>

				<? if ($style == '1'){		// 내가 등록한 친구?>

				<div class="select_box_ccc_border">
					<select class="my_friend_select width_82" id="f_group_n" name="f_group_n">
						<option value="">그룹선택</option>
						<? foreach (call_friend_group($this->session->userdata['m_userid']) as $k => $v){ ?>
						<option value="<?=$v?>"><?=$v?></option>
						<? } ?>
					</select>
				</div>
				<input type="button" class="text_btn_dcdcdc width_40 height_20 color_333 margin_left_2 blod" value="이동" onclick="javascript:f_group_move();"/>
				<input type="button" class="text_btn_dcdcdc width_60 height_20 color_333 margin_left_7 blod" value="친구삭제" onclick="javascript:f_list_remove();"/>
				<div class="text_btn_dcdcdc width_95 height_18 color_666 block text-center ver_top line-height_18 margin_left_2 blod" onclick="javascript:reg_bad_friend();">
					나쁜친구 등록 <span class="color_ea3c3c">+</span>
				</div>
				<!-- ## 나쁜친구는 한명씩만 등록가능 => 팝업 ## -->
			</div>
			<div class="float_right">
				<div class="select_box_ccc_border">
					<select class="my_friend_select width_103" id="f_group_v" name="f_group_v" onchange="javascript:f_group_view(this.value);">
						<option value="">그룹별 보기</option>
						<? foreach (call_friend_group($this->session->userdata['m_userid']) as $k => $v){ ?>
						<option value="<?=$v?>" <?if($v == @$v_group){?> selected <?}?>><?=$v?></option>
						<? } ?>
					</select>
				</div>
			</div>

			<? }else if ($style == '2'){		//나를 등록한 친구 ?>

				<!--div class="select_box_ccc_border">
					<select class="my_friend_select width_82">
						<option>그룹선택</option>
					</select>
				</div>
				<input type="button" class="text_btn_dcdcdc width_40 height_20 color_333 margin_left_2 blod" value="이동" onclick="javascript:f_group_list('2');" /-->
				<input type="button" class="text_btn_dcdcdc width_87 height_20 color_333 margin_left_7 blod" value="내 친구로 추가" onclick="javascript:reg_my_friend();"/>
				<div class="text_btn_dcdcdc width_95 height_18 color_666 block text-center ver_top line-height_18 margin_left_2 blod" onclick="javascript:reg_bad_friend();">
					나쁜친구 등록 <span class="color_ea3c3c">+</span>
				</div>
			</div>

			<? }else{		//나쁜 친구 ?>
				<div class="text_btn_dcdcdc width_95 height_18 color_666 block text-center line-height_18 margin_left_2 blod" onclick="remove_bad_friend();;">
					나쁜친구 해제 <span class="color_ea3c3c">-</span>
				</div>
			</div>
			<? } ?>
			
			
			<div class="clear"></div>
		</div>