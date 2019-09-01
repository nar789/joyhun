<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="like_setting">

			<?=$call_tabmenu2?>

			<p class="color_666 font-size_14 margin_top_26 margin_left_42">상대방이 나에게 보낸 '좋아요'입니다.<br>더욱 친해지길 원하시면 <span class="color_ea3c3c font-size_14">'수락'</span>을 눌러 특별한 인연이 되어보세요~</p>


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
						<?=$this->member_lib->member_thumb($data['s_userid'],131,172)?>
					</div>
					<input type="button" class="text_btn_ff87a0 font-size_16 margin_top_7 width_133 height_47" value="수락" onclick="ilike_check('<?=$data['s_useridx']?>')">
				</div>

		<? } ?>

			</div>
			<div class="list_pg margin_top_40">
				<div>
					<?= $pagination_links?>
				</div>
			</div>
			<!-- ## 좋아요 받은게 있으면 ## -->
		<?
			}else{
		?>
		
			<div class="like_null text-center">
				<p class="color_ff87a0 blod font-size_15 block margin_top_100">아직 받은 ‘좋아요’가 없습니다.</p>
				<p class="color_999 blod margin_top_10">세상에서 제일 잘나온 대표사진으로 바꾸면 좋은인연 만나실거에요~</p>
				<input type="button" class="text_btn_36c8e9 width_185 height_47 margin_top_26" value="내 프로필 수정하기" onclick="location.href='/profile/main/user';">
			</div>
			<!-- ## 좋아요 받은게 없으면 ## -->

		<? } ?>
			
		</div>
	</div>

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>