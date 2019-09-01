<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="today_not_login">
			<div class="today_title">
				<p class="font-size_14">
				<span class="font-size_20"><?=date("n");?></span>월 <span class="font-size_20"><?=date("j");?></span>일  <span class="font-size_16">소개팅 회원</span>
				</p>
			</div>
			
			<div class="today_box">

				<img src="<?=IMG_DIR?>/blindmeeting/blind_flower.gif">

				<p class="color_ff87a0 font-size_15 blod line-height_20 margin_bottom_30">소개팅은 서로의 이름과 연락처가 공개되는 서비스로써<br>본인인증 후 이용하실 수 있습니다.</p>

				<input type="button" class="text_btn_36c8e9 width_168 height_47" value="휴대폰 인증하기" onclick="alert('로그인 후 사용이 가능합니다.');"/>
				<input type="button" class="text_btn_d8d8d8 width_168 height_47" value="대표사진 인증하기" onclick="alert('로그인 후 사용이 가능합니다.');"/>
			</div>
		</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>