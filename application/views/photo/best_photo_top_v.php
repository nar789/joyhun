
		<div class="photo_sub3_toparea">

			<div class="photo_best_2st block ver_top">
				<img src="<?=IMG_DIR?>/photo/best_photo_2st.png" class="best_medal">
				<a href="#" onclick="<?user_check("view_profile('$top2[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($top2['m_userid'], 175, 176)?>
					<div class="best_top_info">
						<p class="color_fff margin_left_7">
						<?=mb_level_profile($top2['m_userid'])?>
						<?=$this->member_lib->s_symbol($top2['m_sex'])?> <?=$top2['m_nick']?> (<?=$top2['m_age']?>세)</p>
					</div>
				</a>
			</div>	<!-- BEST 2 ## -->

			<div class="photo_best_1st block ver_top">
				<img src="<?=IMG_DIR?>/photo/best_photo_1st.png" class="best_medal">
				<a href="#" onclick="<?user_check("view_profile('$top1[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($top1['m_userid'], 205, 206)?>
					<div class="best_top_info">
						<p class="color_fff margin_left_7">
						<?=mb_level_profile($top1['m_userid'])?>
						<?=$this->member_lib->s_symbol($top1['m_sex'])?> <?=$top1['m_nick']?> (<?=$top1['m_age']?>세)</p>
					</div>
				</a>
			</div>	<!-- BEST 1 ## -->

			<div class="photo_best_3st block">
				<img src="<?=IMG_DIR?>/photo/best_photo_3st.png" class="best_medal">
				<a href="#" onclick="<?user_check("view_profile('$top3[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($top3['m_userid'], 175, 176)?>
					<div class="best_top_info">
						<p class="color_fff margin_left_7">
						<?=mb_level_profile($top3['m_userid'])?>
						<?=$this->member_lib->s_symbol($top3['m_sex'])?> <?=$top3['m_nick']?> (<?=$top3['m_age']?>세)</p>
					</div>
				</a>
			</div>	<!-- BEST 3 ## -->
		</div>
