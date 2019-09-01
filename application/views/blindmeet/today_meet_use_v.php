<div class="content">

	<div class="left_main">

		<?=$call_tabmenu?>

		<div class="today_login">
			<div class="today_title">
				<p class="font-size_14">
				<span class="font-size_20"><?=date("n");?></span>월 <span class="font-size_20"><?=date("j");?></span>일  <span class="font-size_16">소개팅 회원</span>
				</p>
			</div>

			<div class="today_area">
				<div class="today_list_on" id="today_list_1" onmouseover="javascript:today_over('<?=$today_list[0]['m_num']?>','1');">
					<div class="pointer">
						<?=$this->member_lib->member_thumb($today_list[0]['m_userid'],131,172)?>
					</div>
					<div class="text_btn_36c8e9 font-size_16 good_btn" id="good_1" onclick="ilike_check('<?=$today_list[0]['m_num']?>')">
						<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top">좋아요
					</div>
					<div class='good_info' id='down_info1'></div>
				</div>
				<div class="today_list" id="today_list_2" onmouseover="javascript:today_over('<?=$today_list[1]['m_num']?>','2');">
					<div class="pointer">
						<?=$this->member_lib->member_thumb($today_list[1]['m_userid'],131,172)?>
					</div>
					<div class="text_btn_36c8e9 font-size_16 good_btn" id="good_2" onclick="ilike_check('<?=$today_list[1]['m_num']?>')">
						<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top">좋아요
					</div>
				</div>
				<div class="today_list" id="today_list_3" onmouseover="javascript:today_over('<?=$today_list[2]['m_num']?>','3');">
					<div class="pointer">
						<?=$this->member_lib->member_thumb($today_list[2]['m_userid'],131,172)?>
					</div>
					<div class="text_btn_36c8e9 font-size_16 good_btn" id="good_3" onclick="ilike_check('<?=$today_list[2]['m_num']?>')">
						<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top"> 좋아요
					</div>
				</div>

				<? if (@$more_cnt == 'confirm'){?>
					<div class="today_list" id="today_list_4" onmouseover="javascript:today_over('<?=$today_list[3]['m_num']?>','4');">
						<div class="pointer">
							<?=$this->member_lib->member_thumb($today_list[3]['m_userid'],131,172)?>
						</div>
						<div class="text_btn_36c8e9 font-size_16 good_btn" id="good_4" onclick="ilike_check('<?=$today_list[3]['m_num']?>')">
							<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top"> 좋아요
						</div>
					</div>
				<? }else{ ?>

				<div class="today_list text-center pointer" id="today_more" onclick="one_more();">
					<img src="<?=IMG_DIR?>/blindmeeting/today_onemore.gif" class="margin_top_55">
					<span class="color_ea3c3c font-size_16 blod block underline margin_top_53">한명 더 소개받기</span>
				</div>

				<? } ?>

				<div class="today_info_box">
					<table class="popup_border_table width_580 margin_auto">
						<tr>
							<td >아이디</td>
							<td class="color_666 width_190">
								<input type="button" class="text_btn_de4949 width_100 height_22" value="상대방 알아보기" onclick="id_show();"/>
							</td>
							<td>닉네임</td>
							<td class="color_666">
								<p id="nick"><?=$today_list[0]['m_nick']?></p>
							</td>
						</tr>
						<tr>
							<td >생년월일</td>
							<td class="color_666">
								<p id="birthday"><? echo "19".substr($today_list[0]['m_jumin1'],0,2).".".substr($today_list[0]['m_jumin1'],2,2).".".substr($today_list[0]['m_jumin1'],4,2); ?></p>
							</td>
							<td>접속지역</td>
							<td class="color_666">
								<p id="area"><?=$today_list[0]['m_conregion']?> <?=$today_list[0]['m_conregion2']?></p>
							</td>
						</tr>
						<tr>
							<td >대화스타일</td>
							<td class="color_666">
								<p id="talk_style"><?=talk_style_data($today_list[0]['m_character'])?></p>
							</td>
							<td>원하는 만남</td>
							<td class="color_666">
								<p id="want_meeting"><?=want_reason_data($today_list[0]['m_reason'])?></p>
							</td>
						</tr>
					</table>
				</div>

			</div>
		</div>

		

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>