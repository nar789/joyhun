	<div class="layout_padding">

		<div class="width_135 float_left">
			<?=$this->member_lib->member_thumb($mlist['b_userid'],123,124)?>
		</div>


		<div class="float_left">

			<textarea class="beongae_detail" readonly><?=$mlist['b_intro']?></textarea>	

			<div class="float_left margin_left_7">
				<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$mlist[b_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div><br>
				<div class="icon_btn_bababa margin_top_8" onclick="<?user_check("chat_request('$mlist[b_userid]');");?>">
					<span class="img_talk_btn"></span>
				</div><br>
				<div class="icon_btn_bababa margin_top_8" onclick="<?user_check("jjim_request('$mlist[b_userid]');");?>">
					<span class="img_heart_btn"></span>
				</div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

		<table class="popup_border_table">
			<tr>
				<td>닉네임</td>
				<td class="width_120"><?=$mlist['b_nick']?></td>
				<td>나이</td>
				<td class="width_120"><?=$mlist['m_age']?> 세</td>
			</tr>
			<tr>
				<td>원하는 지역</td>
				<td><?=$mlist['b_region']?></td>
				<td>원하는 날짜</td>
				<td><?=str_replace("-",".",$mlist['b_day'])?></td>
			</tr>
			<tr>
				<td>원하는 시간</td>
				<td><?=want_time_text($mlist['b_time'])?></td>
				<td>관심사</td>
				<td><?=interest_text($mlist['b_interest'])?></td>
			</tr>
		</table>

		<div class="margin_top_20 text-center">
			<input type="button" class="text_btn_de4949 width_120 height_30" value="번개팅 요청하기" onclick="b_request('<?=$mlist['idx']?>');">
		</div>
	</div>