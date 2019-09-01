		<div id="tmp"></div>
		<div class="open_marry_sub_top">
			<div class="open_marry_sub_topbox">
				<div class="open_marry_sub_content">
					<div>
						<p class="color_666 blod">내 인연은 내가 찾는다!! 당당하게 공개구혼 해보세요~</p>
						<div class="margin_top_9">
							<div class="top_textarea_img" id="noimg_check">
								<? if (IS_LOGIN){	//로그인 했으면 프로필사진 ?>
									<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71)?>
								<? } else {	//로그인안했으면 user_check ?>
									<a href="#" onclick="<?=user_check("javascript:reg_mate();")?>"><span>대표사진 등록</span></a>
								<? } ?>
							</div>
							<textarea class="top_textarea2" placeholder="나의 인연을 찾고있습니다." id="m_msg"></textarea>
							
							<div class="open_guhon_btn_box">
								<div class="btn01"><a href="javascript:reg_open_guhon('결혼')">결혼구혼 등록</a></div>
								<div class="btn02"><a href="javascript:reg_open_guhon('재혼')">재혼구혼 등록</a></div>
							</div>
							

						</div>
					</div>
				</div>
			</div>
		</div>