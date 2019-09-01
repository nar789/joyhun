<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="like_setting">
			
			<?=$call_tabmenu2?>

			<p class="color_666 font-size_14 margin_top_26 margin_left_42">서로의 매력을 알아보셨군요. 지금바로 설레이는 첫마디를 건네보세요.<br> <span class="color_ea3c3c font-size_14">좋은인연 되시길</span> 진심으로 바랍니다.</p>



		<?php
			if( $getTotalData > 0 )
			{
		?>
			<div class="margin_left_23 margin_top_30">

		<?
				$i = 0;
				foreach($mlist as $data)
				{
		?>
			
				<div class="today_list margin_top_20 width_296 height_174">
					<div class="pointer block">
						<?=$this->member_lib->member_thumb($together[$i]['m_userid'],131,172)?>
					</div>
					<div class="width_150 block ver_top margin_top_9 margin_left_7">
						<p class="color_ea3c3c blod  "><?=$together[$i]['m_userid']?></p> 
						<p class="color_333 margin_top_9"><?=$together[$i]['m_nick']?></p>
						<p class="color_666 line-height_18 height_71">
						<? echo "19".substr($together[$i]['m_jumin1'],0,2).".".substr($together[$i]['m_jumin1'],2,2).".".substr($together[$i]['m_jumin1'],4,2); ?>
						<br><?=$together[$i]['m_conregion']?> <?=$together[$i]['m_conregion2']?>
						<br><?=trim_text(talk_style_data($together[$i]['m_character'], $together[$i]['m_sex']),37)?>
						<br><?=trim_text(want_reason_data($together[$i]['m_reason']),37)?></p>
						<div class="margin_top_17">
							<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$user_info');");?>">
								<span class="img_mail_btn"></span>
							</div>
							<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("chat_request('$user_info');");?>">
								<span class="img_talk_btn"></span>
							</div>
							<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$user_info');");?>">
								<span class="img_heart_btn"></span>
							</div>
						</div>
					</div>
				</div>
		<? 
			$i++;
		} ?>
			</div>
			<!-- ## 좋아요 보낸게 있으면 ## -->

			<div class="list_pg margin_top_40">		<!-- ## 페이징 div ## -->
				<div>
					<?= $pagination_links?>
				</div>
			</div>

		<?
			}else{
		?>
			

			<div class="like_null text-center">
				<p class="color_ff87a0 blod font-size_15 block margin_top_100">아직 매칭된 ‘서로좋아요’가 없습니다.</p>
				<p class="color_999 blod margin_top_10">서로의 마음을 좀 더 적극적으로 표현한다면 좋은인연이 될 수 있을 거에요~</p>
				<input type="button" class="text_btn_36c8e9 width_166 height_47 margin_top_26" value="소개팅 하러가기" onclick="location.href='/blindmeet/blind';">
			</div>
			<!-- ## 서로좋아요 없으면 ## -->

		<? } ?>

		</div>


	</div>

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>