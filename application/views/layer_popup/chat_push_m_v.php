<div class="padding_10">
	<p class="color_ea3c3c font-size_14"><?=$push_info[0]['m_nick']?>(<?=$push_info[0]['m_age']?>) <span class="color_999"><?=$push_info[0]['m_conregion']?> <?=$push_info[0]['m_conregion2']?></span></p>

	<div class="margin_top_10">
		<div class="float_left use_img pointer" style="width:30%" onclick="javascript:member_photo_view_pop('<?=$push_info[0]['m_userid']?>');">
			<?=$this->member_lib->member_thumb($push_info[0]['m_userid'],123,124)?>
		</div>
		<div class="float_right" style="width:70%">
			<div class="chat_push_box_m">
				<ul class="chat_push_li_m">
					<li><b>원하는 만남</b><b class="text_cut"><?=want_reason_data($push_info[0]['m_reason'])?></b></li>
					<li><b>대화스타일</b><b class="text_cut"><?=talk_style_data($push_info[0]['m_character'],$push_info[0]['m_sex'])?></b></li>
				</ul>
			</div>
			<textarea class="alarm_chat_text width_90per ver_top height_44 padding_5" id="sin_msg" name="sin_msg" readonly><?=$push_info[0]['my_intro']?></textarea>
		</div>
		<div class="clear"></div>
	</div>


	<div class="alarm_chat_guid_2 width_100per height_53">
		<ul class="padding_left_4 padding_top_10">
			<li class="padding_bottom_3 color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">
				<span class="color_ea3c3c font-size_11">최근접속한 비밀채팅추천 이성회원입니다.</span>
			</li>
			<li class="color_666 font-size_11"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">
				지금 채팅 신청시, 채팅 성공률이 매우 높습니다.
			</li>
		</ul>
	</div>


	<div class="margin_top_10 text-center padding_bottom_10">
		<input type="button" class="text_btn_de4949 alarm_chat_btn width_100per" onclick="chat_request('<?=$push_info[0]['m_userid']?>');" value="비밀채팅 신청하기">
	</div>
</div>

<style>
.use_img img { width:100%; height:100px; }
.alarm_chat_guid_2 {     
	height: 47px;
    background: #fcfcfc;
    width: 284px;
	float:right;
}
</style>