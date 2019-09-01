<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="like_setting">
			
			<?=$call_tabmenu2?>

			<p class="color_666 font-size_14 margin_top_26 margin_left_42">내가 상대방에게 보낸 '좋아요'입니다. 기다려도 상대방이 수락하지 않으면<br> <span class="color_ea3c3c font-size_14">다시 '좋아요'</span>를 보내서 꼭 인연을 만들어보세요~</p>

		<?php
			if( $getTotalData > 0 )
			{
		?>
			<div class="margin_left_23 margin_top_30">

		<?
				foreach($mlist as $data)
				{
		?>
				<div class="today_list margin_top_20">
					<div class="pointer">
						<img src="<?=IMG_DIR?>/blindmeeting/good_stamp.png" class="position_ab">
						<?=$this->member_lib->member_thumb($data['r_userid'],131,172)?>
					</div>
					<div class="text_btn_36c8e9 font-size_16 good_btn" onclick="ilike_check('<?=$data['r_useridx']?>','<?=$_SERVER['REQUEST_URI']?>')">
						<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top"> 좋아요
					</div>
				</div>
			<!-- ## 좋아요 보낸게 있으면 ## -->
		<? } ?>

			</div>
			<div class="list_pg margin_top_40">
				<div>
					<?= $pagination_links?>
				</div>
			</div>

		<?
			}else{
		?>

			
			<div class="like_null text-center">
				<p class="color_ff87a0 blod font-size_15 block margin_top_100">아직 보낸 ‘좋아요’가 없습니다.</p>
				<p class="color_999 blod margin_top_10">내 인연이 숨어있을지 몰라요~ 좋아요 누르고 좋은인연 만들어보세요~</p>
				<input type="button" class="text_btn_36c8e9 width_166 height_47 margin_top_26" value="소개팅 하러가기" onclick="location.href='/profile/main/user';">
			</div>
			<!-- ## 좋아요 보낸게 없으면 ## -->
		<? } ?>

		</div>
	</div>

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>