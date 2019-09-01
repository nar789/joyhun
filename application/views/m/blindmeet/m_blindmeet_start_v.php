<div class="m_main_area padding_bottom_20">

	<div class="width_95per margin_auto">
		
		<div class="width_100per margin_top_10">
			<img src="<?=IMG_DIR?>/m/blind_top.gif" class="blind_none_img">
		</div>

		<!-- ## 본인인증 안한사람 ## -->
		<div class="width_100per blind_none_area bg_fff">
				<img src="<?=IMG_DIR?>/m/blind_none.gif">

				<div class="width_100per text-center">
					<p class="blind_none_text">소개팅은 서로의 이름과 연락처가<br>공개되는 서비스로써<br>본인인증 후 이용하실 수 있습니다.</p>
				</div>

	 
				<div class="width_95per margin_auto">
					<div class="width_50per float_left">
						<input type="button" class="text_btn_36c8e9 blind_none_btn" value="휴대폰 인증하기" onclick="javascript:name_check();">
						<!--input type="button" class="text_btn_36c8e9 blind_none_btn" value="휴대폰 인증하기" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata['m_userid']?>');"-->
					</div>
					<div class="width_50per float_left">
						<input type="button" class="text_btn_d8d8d8 blind_none_btn" value="대표사진 인증하기">
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</div>

</div>