		<div class="poll_top_left">
			<p>너무나도 다른 우리~</p>
			<p class="poll_title">공감 <span class="poll_title2">POLL</span></p>
		</div>

		<div class="poll_top_right">
			<div class="margin_top_18 margin_left_23">
				<img src="<?=IMG_DIR?>/friend/poll_text.gif" class="ver_bottom">
				<b class="font-size_16 color_333"><?=$m_title?></b>
			</div>
			<div class="vote_box">
				<div class="vote_list margin_top_mi_3 float_left">
					<? for($i=1; $i<=5; $i++){ ?>
					<div>
						<input type="radio" id="radio<?=$i?>" name="poll" value="<?=$i?>"><label for="radio<?=$i?>"></label><span><?=${"m_example".$i}?></span>
					</div>
					<? } ?>
				</div>
				
				<div class="float_right">
					<div class="text_btn_496946 font-size_14 vote_btn" onclick="javascript:member_vote('<?=$m_code?>');">
						투표하기 >
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
