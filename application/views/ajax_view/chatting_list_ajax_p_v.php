<?
	//채팅리스트 ajax view 페이지
	if($getTotalData > 0){
		foreach($mlist as $data){
			
			$flg = "";
			if($data['send_id'] == $this->session->userdata['m_userid']){ $flg = 1; }	//채팅신청자와 세션 아이디가 같을경우
			
			//채팅방 상태에 따라 버튼 클래스 바꾸기
			switch($data['status']){
				case "대기" : if($flg == 1){ $btn_val = "수락대기"; $btn_class = "text_btn_ea3e3e"; }else{ $btn_val = "채팅수락"; $btn_class = "text_btn_bg_red"; } break;
				case "수락" : $btn_val = "다시채팅"; $btn_class = "text_btn_ea3e3e"; break;
				case "거절" : $btn_val = "채팅거절"; $btn_class = "text_btn_ea3e3e"; break;
				case "나감" : $btn_val = "상대나감"; $btn_class = "text_btn_ea3e3e"; break;
			}

?>

<div class="min_height_72 border_bottom_1_ececec">
	<div class="float_left">
		<div class="profile_chat pointer" onclick="<?user_check("view_profile('$data[user_id]');");?>">
			<a><?=$this->member_lib->member_thumb($data['user_id'], 68, 49)?></a>
		</div>
		<div class="width_127 block margin_top_14 margin_left_21 color_333 ver_top">
			<span class="color_f08a8e font_900 line-height_22"></span> <?=$data['m_nick']?> (<?=$data['m_age']?>세)<br><?=$data['m_conregion']?> <?=$data['m_conregion2']?>
		</div>
		<div class="meet_social_textarea block margin_top_14 ver_top line-height_16">
			<div class="float_left color_333"><?=strcut_utf8($data['chat_contents'],60)?></div>
			<div class="float_right">
				<div class="rechat_btn"><?=$data['cnt']?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="margin_top_14 block">
			<input type="button" class="<?=@$btn_class?> margin_left_4 height_47 font-size_12" value="<?=@$btn_val?>" onclick="javascript:open_chat_win('<?=$data['user_id']?>', '<?=@$btn_val?>', '<?=$data['idx']?>');">
		</div>
	</div>
	
</div>

<?
			//}//탈퇴한사람 제외 끝

		} 
	}else{
	//채팅리스트가 없을경우
?>

<div class="list_area border_bottom_2_ececec">
	<div class="light_img_null">
		<img src="/images/meeting/light_null.gif">
		<div class="margin_top_5">
			보관된 채팅내역이 없습니다.<Br>
			채팅내역은 보안을 위해 일정시간이 지나면 자동으로 삭제됩니다.
		</div>
		<div class="clear"></div>
	</div>
</div>

<?
	}
?>

		<!-- ## 페이징 div ## -->
		<!--div class="list_pg margin_top_33">		
			<div>
				<?= $pagination_links?>
			</div>
		</div-->