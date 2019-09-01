<?
	//소개팅 시작하기 ajax view 페이지

	$m_data = $this->member_lib->get_member($today_list[0]['m_userid']);		//첫번째 회원 데이터 가져오기 

	$i = 1;
	foreach($today_list as $data){
		if($i == 4){ break; }
?>
<div class="today_list_on" id="today_list_<?=$i?>" onmouseover="javascript:today_over('<?=$data['m_num']?>', '<?=$i?>');">
	<div class="pointer"><?=$this->member_lib->member_thumb($data['m_userid'],131,172)?></div>
	<div class="text_btn_36c8e9 font-size_16 good_btn" id="good_<?=$i?>" onclick="javascript:ilike_check('<?=$data['m_num']?>')">
		<img src="<?=IMG_DIR?>/blindmeeting/good_heart.png" class="ver_top">좋아요
	</div>
	<? if($i == 1){ ?><div class="good_info" id="down_info1"></div> <? } ?>
</div>
<?
		$i++;
	}
?>

<div class="today_list text-center pointer" id="today_more" onclick="javascript:one_more();">
	<img src="<?=IMG_DIR?>/blindmeeting/today_onemore.gif" class="margin_top_55">
	<span class="color_ea3c3c font-size_16 blod block underline margin_top_53">한명 더 소개받기</span>
</div>

<div class="today_info_box">
	<table class="popup_border_table width_580 margin_auto">
		<tr>
			<td >아이디</td>
			<td class="color_666 width_190">
				<input type="button" class="text_btn_de4949 width_100 height_22" value="상대방 알아보기" onclick="javascript:id_show();"/>
			</td>
			<td>닉네임</td>
			<td class="color_666">
				<p id="nick"><?=$m_data['m_nick']?></p>
			</td>
		</tr>
		<tr>
			<td >생년월일</td>
			<td class="color_666">
				<p id="birthday">19<?=substr($m_data['m_jumin1'],0,2)?>.<?=substr($m_data['m_jumin1'],2,2)?>.<?=substr($m_data['m_jumin1'],4,2)?></p>
			</td>
			<td>접속지역</td>
			<td class="color_666">
				<p id="area"><?=$m_data['m_conregion']?> <?=$m_data['m_conregion']?></p>
			</td>
		</tr>
		<tr>
			<td >대화스타일</td>
			<td class="color_666">
				<p id="talk_style"><?=talk_style_data($m_data['m_character'])?></p>
			</td>
			<td>원하는 만남</td>
			<td class="color_666">
				<p id="want_meeting"><?=want_reason_data($m_data['m_reason'])?></p>
			</td>
		</tr>
	</table>
</div>