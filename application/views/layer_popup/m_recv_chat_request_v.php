
<div class="padding_10">

	<b class="color_e15148 font-size_14"><?=$m_nick?>(<?=$m_age?>)</b><span class="color_999 blod"> <?=$m_conregion?> <?=$m_conregion2?></span>
	<span style="float:right;"><font style="font-size:14px;">거리 : <b style="color:#D07C91; font-size:14px;"><?=$to_distance?></b></font></span>

	<table class="width_98per margin_top_7">
		<tr>
			<td class="width_35per">
				<div class="recv_chat_area">
					<?=$this->member_lib->member_thumb($m_userid,80,125)?>
				</div>
			</td>
			<td class="width_65per">
				<textarea class="send_chat_text border_0" readonly><?=$chat['contents']?></textarea>
			</td>
		</tr>
	</table>

	<div class="m_chat_info">
		<ul>
			<? if($this->session->userdata['m_sex'] == "M"){ ?>
			<li><span class="color_ea3c3c font-size_10 margin_left_mi_4">건당 <?=$chat_pd['m_point']?>P 차감됩니다. 회원님의 현재포인트: <?=number_format($total_point)?></span></li>
			<? } ?>
			<li><span class="color_999 font-size_10 margin_left_mi_4">비밀을 보장해 드립니다. 용기내어 채팅수락해 주세요!</span></li>
		</ul>
	</div>

</div>

 <div class="bg_3e3e3e padding_5per">

	<div class="width_100per margin_auto mobile_select">
		<select class="border_none height_28 width_100per bg_fff border_0 text_5" id="deny_msg">
			<option value="">거절메세지를 선택할 수 있습니다.</option>
			<?
				foreach( chat_deny_msg('all') as $key => $val ){	//code change helper
					echo "<option value='$key'>$val</option>";
				}
			?>
			
		</select>
	</div>


	<table class="width_100per margin_auto height_55">
		<tr>
			<td class="width_50per text-left"><input type="button" class="m_pop_btn" value="거절" onclick="chat_deny('<?=$m_userid?>');"></td>
			<td class="width_50per text-right"><input type="button" class="m_pop_btn" value="수락" onclick="chat_accept_flg('<?=$m_userid?>', '<?=$chat['idx']?>');"></td>
		</tr>
	</table>
</div>

