		<div class="vote_top_frame">
			<div class="vote_top_title_box">
				<p class="vote_top_sub_title">너무나도 다른 우리~</p>
				<p class="vote_top_title"><b class="font-size_26">공감</b> POLL</p>
				<img src="<?=IMG_DIR?>/poll_btn.gif" class="margin_top_6 margin_left_10 pointer" onclick="<?user_check("location.href='/friend/vote_poll';");?>">
			</div>
		</div>		<!-- ## vote_top_frame END -->

		<?
			if(!$right_vote = $this->cache->get('right_vote')){
					$right_vote = board_list('1', 'reg_vote_list', '*', 'm_code',"m_use_yn = 'Y'");
					$this->cache->save('right_vote', $right_vote, 600);	//10분 캐시 사용
			}

			foreach( $right_vote as $key => $val)
			{
		?>

		<div class="vote_content_frame">
			<div class="vote_content_box">
				<div class="vote_title">
					<b>Q,</b>
					<p><?=$val['m_title']?></p>
				</div>

				<div class="vote_list">
					<div>
						<input type="radio" id="radio1" name="research"><label for="radio1"><?=$val['m_example1']?></label>
					</div>
					<div>
						<input type="radio" id="radio2" name="research"><label for="radio2"><?=$val['m_example2']?></label>
					</div>
					<div>
						<input type="radio" id="radio3" name="research"><label for="radio3"><?=$val['m_example3']?></label>
					</div>
					<div>
						<input type="radio" id="radio4" name="research"><label for="radio4"><?=$val['m_example4']?></label>
					</div>
					<div>
						<input type="radio" id="radio5" name="research"><label for="radio5"><?=$val['m_example5']?></label>
					</div>
				</div>
			</div>
		</div>

		<? } ?>
		<img src="<?=IMG_DIR?>/main_patt.gif" class="float_left width_100per">
		<div class="clear"></div>
