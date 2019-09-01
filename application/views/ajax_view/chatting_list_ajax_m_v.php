<?
	//채팅리스트 ajax view 페이지
	if($getTotalData > 0){
?>

<div class="min_height_350">
	<table class="width_95per margin_auto m_intro_table">
		<?
			foreach($mlist as $data){ 
				
				if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
				if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }
		?>
		<tr>
			<td class="width_15per now_member"><?=$this->member_lib->member_thumb($data['user_id'], 160, 160)?></td>
			<td class="m_intro_text_td pointer border_bottom_2_e9e9e9" onclick="javascript:onchatting_view('<?=$data['user_id']?>', '<?=$data['status']?>', '<?=$data['idx']?>');">
				<div class="float_left width_70per margin_top_3">
					<b class="<?=$m_color?> color_333 margin_left_3per"><?=$data['m_nick']?></b><b class="color_888">(<?=$data['m_age']?>) <?=$data['m_conregion']?> <?=$data['m_conregion2']?></b>
					<p class="color_999 margin_top_3 margin_left_3per"><?=trim_text($data['chat_contents'],'85')?></p>
				</div>
				<div class="float_left width_30per text-right">
					<div class="text-right width_80per">
						<p><?=time_stamp_am_pm($data['chat_date'])?></p>
						<?
							//채팅 카운트 없으면 안나오게
							if($data['cnt'] > 0){
						?>
						<div class='list_chat_cnt'><?=$data['cnt']?></div>
						<?
							}
						?>
					</div>
				</div>
				<div class="clear"></div>
			</td>
		</tr>
		<? 
			} 
		?>
	</table>
</div>

<?
	}else{
	//채팅리스트가 없을경우
?>

<div class="m_list_none">
	<img src="<?=IMG_DIR?>/m/m_chatlist_none.png">
	
	<div class="blod color_666 margin_top_16">
		대화중인 채팅이 없습니다.<br>
		접속중인 이성에게 채팅신청을 해 보세요!
	</div>

	<div class="blod color_b0afaf margin_top_16">
		조이헌팅 비밀톡챗은 <b class="color_d89090">24시간후에 채팅신청이 삭제</b>되고<br>
		100%비밀보장, 철통보안으로 사생활을 지켜드립니다.
	</div>
</div>

<?
	}
?>