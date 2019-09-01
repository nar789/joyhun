		<form id="frmData" name="frmData" method="post">
			<input type="hidden" id="m_userid" name="m_userid" value="<?=$m_userid?>">
		</form>
		
		<div id="tmp"></div>		<!-- 결과 찍어보는 용도 -->

		<div class="bg_f4f4f4 height_103">
			<div class="padding_top_20 padding_left_20">
				<div class="popup_img_S ver_mid">
					<?=$this->member_lib->member_thumb($m_userid, 77, 72)?>
				</div>
				<div class="block text-center margin_left_16">
					<b class="color_999"><span class="color_ea3c3c"><?=$m_nick?></span> 님을<br>나쁜친구로 등록합니다.</b>
				</div>
			</div>
		</div>

		<div class="padding_top_10 padding_left_20">			
			<textarea class="friend_textarea" placeholder="한줄메모" id="friend_memo" maxlength="100" onkeyup="return textarea_maxlength(this)"></textarea>
		</div>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_85 height_30" value="등록하기" onclick="javascript:bad_friend_reg();"/>
		</div>

		<div class="height_30"></div>

