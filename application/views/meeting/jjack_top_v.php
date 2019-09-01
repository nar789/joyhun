		<!--div id="tmp"></div-->

		<div class="meeting_top_area" class="bg_none">
			<div class="meet_jjack_top">
				<div class="meet_jjack_area">
					<div class="top_textarea_img" id="noimg_check">
						<? if (IS_LOGIN){	//로그인 했으면 프로필사진 ?>
							<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71)?>
						<? } else {	//로그인안했으면 user_check ?>
							<a href="#" onclick="<?=user_check("javascript:reg_mate();")?>"><span>대표사진 등록</span></a>
						<? } ?>
					</div>
					<textarea class="top_textarea" placeholder="나의 짝을 찾고있습니다." id="m_cmt" name="m_cmt"></textarea>
					<div class="text_btn_de4949 top_textarea_subbtn" onclick="<?=user_check("javascript:reg_mate();")?>">
						<div class="margin_top_19 font-size_14">애정촌<br>등록하기</div>
					</div>
				</div>
			</div>
		</div>