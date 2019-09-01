
	<?=$call_tabmenu?>

	<div class="width_95per margin_auto">

		<div class="padding_top_10">
			<p class="color_666 line-height_18">서로의 매력을 알아보셨군요.<br>지금바로 설레이는 첫마디를 건네 <span class="color_ea3c3c">좋은인연</span>만들어보세요.</p>
		</div>
		
		<? 
			if($getTotalData > 0){ 
				$i = 0;
				foreach($mlist as $data){
		?>

		<div class="toget_area">
			<div class="toget_box">
				<div class="float_left width_48per">
					<div class="toget_img_area">
						<div class="toget_img_box">
							<?=$this->member_lib->member_thumb($together[$i]['m_userid'], 200, 200)?>
						</div>
					</div>
				</div>
				<div class="float_left together_text width_52per">
					<p class="color_333"><?=$together[$i]['m_nick']?><span class="color_999">&nbsp;<?=$together[$i]['m_age']?>세</span></p>
					<span class="color_666">
						<?=$together[$i]['m_conregion']?> <?=$together[$i]['m_conregion2']?><br>
						<?=trim_text(talk_style_data($together[$i]['m_character'], $together[$i]['m_sex']),37)?><br>
						<?=trim_text(want_reason_data($together[$i]['m_reason']),37)?>
					</span>

					<div class="good_ic_area">
						<img src="<?=IMG_DIR?>/m/good_ic_btn_1.gif" onclick="location.href='/profile/main/user/user_id/<?=$together[$i]['m_userid']?>'">
						<img src="<?=IMG_DIR?>/m/good_ic_btn_2.gif" onclick="javascript:chat_request('<?=$together[$i]['m_userid']?>');">
						<img src="<?=IMG_DIR?>/m/good_ic_btn_3.gif">
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>

		<? 
				$i++;
				}
			}else{ 
		?>

		<div class="good_none">
			<img src="<?=IMG_DIR?>/m/good_setting.gif" class="width_100per">

			<p class="color_ff87a0 blod">아직 매칭된 ‘서로좋아요’가 없습니다.</p>

			<p class="color_999 blod margin_top_10 line-height_20">서로의 마음을 좀 더 적극적으로<br>표현한다면 좋은인연이 될 수 있을거에요~</p>

			<input type="button" class="profile_go_btn" value="소개팅 하러가기">
		</div>

		<? } ?>


	</div>