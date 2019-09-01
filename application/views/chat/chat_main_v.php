
 <div class="top_area" <? if(IS_MOBILE == false){ echo "style='background:#e15148'"; }?>>
	<div class="width_95per margin_auto">
		<div class="text-center" style="width:15%;float:left">
			<div class="m_back_btn" onclick="javascript:mobile_chat_back();">이전</div>
		</div>

		<div class="top_subject" style="width:65%;">
			<p class="title_text_1"><?=$recv_mem['m_nick']?></p>
		</div>

		<div class="text-center" style="width:20%;float:left">
			
			
			<div class="m_back_btn border_none height_32 line-height_32 pointer" style="background:<? if(IS_MOBILE == false){ echo "#b10a00"; }else{ echo "#7443cd"; }?>;" onclick="javascript:renew_chat_exit('<?=$recv_mem['m_userid']?>');">
				나가기
			</div>
			
			<!--div class="m_back_btn border_none height_32 line-height_32" style="background:<? if(IS_MOBILE == false){ echo "#b10a00"; }else{ echo "#7443cd"; }?>;" onclick="javascript:chat_exit('<?=$recv_mem['m_userid']?>');">
				나가기
			</div-->

		</div>
	</div>
</div>

<div class="chat_area" id="chat_area">
	<img src="<?=IMG_DIR?>/m/chatting_top.jpg" class="width_100per">

				<div class="text-center padding_top_10">
					<img src="<?=IMG_DIR?>/chat/chat_warning.png">
				</div>


	<div id="add_chat"></div>

</div>

<div class="bottom_ic_box">
	<? if(IS_MOBILE and IS_APP and APP_OS == "IOS"){ ?>
	<div class="bottom_ic_area" style="background:#F5F5F5;">
		<div style="position:relative; width:50px; height:50px; float:right; margin-right:10px; background-color:#946cdc; border-radius:10px;">
			<a href="#" onclick="javascript:complain_request('<?=$recv_mem['m_userid']?>','360','<?=$recv_mem['m_nick']?>');">
			<img src="/images/chat/bottom_ic_05.png" class="bottom_ic_img" style="margin-left:11px; margin-top:3px;">
			</a>
			<div class="margin_top_2" style="text-align:center;"><b class="color_fff;"><b style="color:#FFF; font-size:0.9em;">신고하기</b></div>
		</div>
	</div>
	<? }else{ ?>
	<div class="bottom_ic_area" <? if(IS_MOBILE == false){ echo "style='background:#e15148'"; }?>>
		<div class="bottom_ic"> 
			<a href="#" onclick="javascript:gift_shop('chat', '<?=$recv_mem['m_userid']?>', 'shop');">
			<img src="/images/chat/bottom_ic_01.png" class="bottom_ic_img"></a>
			<div class="margin_top_2"><b class="color_fff">선물상점</b></div>
		</div>
		<div class="bottom_ic_bar">
			<? if(IS_MOBILE == 'true'){ ?>
			<img src="/images/chat/bottom_bar.gif" class="bottom_ic_bar_img">
			<?}else{?>
			<img src="/images/chat/bottom_bar_pc.png" class="bottom_ic_bar_img">
			<?}?>
		</div>
		<div class="bottom_ic">
			<a href="#" onclick="javascript:gift_shop('request', '<?=$recv_mem['m_userid']?>', 'shop');">
			<img src="/images/chat/bottom_ic_03.png" class="bottom_ic_img"></a>
			<div class="margin_top_2"><b class="color_fff"><b>선물조르기</b></div>
		</div>
		<div class="bottom_ic_bar">
			<? if(IS_MOBILE == 'true'){ ?>
			<img src="/images/chat/bottom_bar.gif" class="bottom_ic_bar_img">
			<?}else{?>
			<img src="/images/chat/bottom_bar_pc.png" class="bottom_ic_bar_img">
			<?}?>
		</div>
		<div class="bottom_ic">
			<a href="#" onclick="javascript:btn_gift_clk('recv');">
			<img src="/images/chat/bottom_ic_04.png" class="bottom_ic_img">
			<div class="margin_top_4"><b class="color_fff"><b>선물함</b></div>
		</div>
		<div class="bottom_ic_bar">
			<? if(IS_MOBILE == 'true'){ ?>
			<img src="/images/chat/bottom_bar.gif" class="bottom_ic_bar_img">
			<?}else{?>
			<img src="/images/chat/bottom_bar_pc.png" class="bottom_ic_bar_img">
			<?}?>
		</div>
		<div class="bottom_ic">
			<a href="#" onclick="javascript:complain_request('<?=$recv_mem['m_userid']?>','360','<?=$recv_mem['m_nick']?>');">
			<img src="/images/chat/bottom_ic_05.png" class="bottom_ic_img"></a>
			<div class="margin_top_2"><b class="color_fff"><b>신고하기</b></div>
		</div>
		<div class="clear"></div>
	</div>
	<? } ?>

	<div class="chat_text_box">
		
		<input type="hidden" id="user_id" value="<?=$recv_mem['m_userid']?>"/> 

		<div id="chatting_room_chat_box" class="chat_text_area" style="display:block;">
			<input type="text" id="chat_text" class="chat_input_text" placeholder="입력해주세요." onkeydown="if(event.keyCode==13)chkEnter()"/> 
			<input type="button" value="전송" class="chat_input_button <? if(IS_MOBILE == false){?>color_ea3c3c<?}?>" id="chat_submit" />
			<div class="clear"></div>
		</div>

		<div id="chatting_room_rechat_box" class="chat_result" style="display:none;">
			<div class="text pointer" onclick="javascript:chat_exit_sub('2', '<?=$recv_mem['m_userid']?>');">
				다시 채팅하기
			</div>
		</div>

	</div>

</div>
