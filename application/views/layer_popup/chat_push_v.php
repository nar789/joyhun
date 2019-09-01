<div class="layout_padding">
	<div class="alarm_chat_area">
		<p class="font-size_14 color_333"><?=$push_info[0]['m_nick']?> <span class="font-size_12 color_999"><?=$push_info[0]['m_conregion']?> <?=$push_info[0]['m_conregion2']?></span></p>
		
		<div class="margin_top_10">
			<div class="float_left user_img">
				<a href="#" onclick="javascript:member_photo_view_pop('<?=$push_info[0]['m_userid']?>');"><?=$this->member_lib->member_thumb($push_info[0]['m_userid'],123,124)?></a>
			</div>
			<div class="float_right">
				<div class="chat_push_box">
					<ul class="chat_push_li">
						<li><b>원하는 만남</b><b><?=want_reason_data($push_info[0]['m_reason'])?></b></li>
						<li><b>대화스타일</b><b><?=talk_style_data($push_info[0]['m_character'],$push_info[0]['m_sex'])?></b></li>
					</ul>
				</div>
				<textarea class="alarm_chat_text ver_top height_47" id="sin_msg" name="sin_msg" readonly><?=$push_info[0]['my_intro']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="alarm_chat_guid_second width_100per">
		<ul class="alarm_chat_guid_box">
			<li class="padding_bottom_3 color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">
				<span class="color_ea3c3c">최근접속한 비밀채팅추천 이성회원입니다.</span>
			</li>
			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">
				지금 채팅 신청시, 채팅 성공률이 매우 높습니다.
			</li>
		</ul>
	</div>

	<div class="margin_top_19 text-center padding_bottom_10">
		<input type="button" class="text_btn_de4949 alarm_chat_btn width_118" onclick="chat_request('<?=$push_info[0]['m_userid']?>');" value="비밀채팅 신청하기">
	</div>
</div>


<script>
$("#md_content").css("width","<?=$width?>");
</script>


<style>
.user_img > a > img { border: 1px solid #dcdcdc; display: inline-block; vertical-align: top;}
</style>