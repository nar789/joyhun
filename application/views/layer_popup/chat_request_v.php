<div class="layout_padding">
	<div class="alarm_chat_area">
		<p class="font-size_14 color_333"><?=$m_nick?> <span class="font-size_12 color_999"><?=$add_text?></span> <span style="float:right;"><font style="font-size:14px;">거리 : <b style="color:#D07C91; font-size:14px;"><?=@$to_distance?></b></font></span></p>
		
		<div class="margin_top_10">
			<a href="#"><?=$this->member_lib->member_thumb($m_userid,123,124)?></a>
			<textarea class="alarm_chat_text ver_top" placeholder="입력해주세요" id="sin_msg" name="sin_msg" <?=@$readonly?>><?=@$contents?></textarea>
		</div>
	</div>

	<div class="alarm_chat_guid">
		<ul class="alarm_chat_guid_box">
			<? if($this->session->userdata['m_sex'] == "M"){ ?>
			<li class="padding_bottom_3 color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"><span class="color_333">채팅 <?=$text_value?>시 건당 70P</span> 차감됩니다. 회원님의 현재 포인트 : <span class="color_ea3c3c">
				<? if(@$tp['total_point']){ ?>
				 <?=number_format($tp['total_point'])?> P
				 <? }else{ ?>
				 0 P
				 <? } ?>
			</span> </li>
			<? } ?>

			<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"><?=$inner_text?> </li>
		</ul>
	</div>

	<div class="margin_top_19 text-center padding_bottom_10" <?=@$display?>>
		<input type="button" class="text_btn_de4949 alarm_chat_btn" value="<?=$text_value?>하기" onclick="<?user_check($v_function."('".$m_userid."');",5 );?>">
	</div>
</div>
