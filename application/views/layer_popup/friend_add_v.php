
		
		<div class="bg_f4f4f4 height_103">
			<div class="padding_top_20 padding_left_20">
				<div class="popup_img_S ver_mid pointer" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');">
					<?=$this->member_lib->member_thumb($m_userid,74,71)?>
				</div>
				<div class="block text-center margin_left_16">
					<b class="color_999"><span class="color_ea3c3c"><?=$m_nick?></span> 님을<br>나의 친구로 등록합니다.</b>
				</div>
			</div>
		</div>

		<div class="padding_top_10 padding_left_20">
			<div class="popup_select width_175 height_22 margin_right_2 block">
				<select class="width_175 height_22 padding_left_2" name="friend_group" id="friend_group">

					<? 
					// 친구등록에서 검색후 추가 시
					if ($f_group != ''){ ?>
						<option value="<?=$f_group?>"><?=$f_group?></option>
					<?
					// 목록에서 추가 시	
					}else{ ?>
						<option value="">그룹선택</option>
						<? foreach (call_friend_group($this->session->userdata['m_userid']) as $k => $v){ ?>
								<option value="<?=$v;?>"><?=$v;?></option>
						<? } ?>
					<? } ?>
				</select>
			</div>
			<div class="text_btn_dcdcdc group_btn" id="group_add_btn" onclick="group_request('<?=$m_userid ?>');">
				<img src="<?=IMG_DIR?>/layer_popup/group_add.gif" class="margin_right_5">추가
			</div>
			
			<textarea class="friend_textarea" placeholder="한줄메모" id="friend_memo" maxlength="100" onkeyup="return textarea_maxlength(this)"><?=$f_memo;?></textarea>
		</div>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_85 height_30" value="등록하기" onclick="friend_submit('<?=$m_userid?>','<?=$m_nick?>');">
		</div>

		<div class="height_30"></div>