
	<div id="add_chat" class="bg_f9f9f9">
		<div class="day_area">
			<span class="day_text"></span>
		</div>
		<div class="margin_bottom_20">
			<div class="pop_top_box">
				<div class="img_box"><?=$this->member_lib->member_thumb($send_data['m_userid'], '130', '135')?></div>
				<div class="txt_box"><b><?=$send_data['m_nick']?></b>
					<div class="block">
						<span >(<?=$send_data['m_age']?>)</span>
					</div>
					<div class="txt_box_second">지역 : <?=$send_data['m_conregion']?> <?=$send_data['m_conregion2']?>
					</div>
					<div class="txt_box_second">원하는 만남 : <?=want_reason_data($send_data['m_reason'])?>
					</div>
					<div class="txt_box_second">대화스타일 : <?=talk_style_data($send_data['m_character'], $send_data['m_sex'])?>
					</div>
				</div>
			</div>
		</div>
		<div class="width_90per margin_auto">
			<div class=" message_box">
				<div style="text-align:center; display:inline-block; vertical-align:top;width:50px; height:50px; border-radius:100px; overflow:hidden;">
					<?=$this->member_lib->member_thumb($send_data['m_userid'], '50', '50')?>
				</div>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<div class="recv_arrow"></div>
							<div class="recv_chat"><?=$request_data['contents']?></div>
						</td>
					</tr>
					<tr>
						<td class="clock_td"><?=str_replace("PM", "오후", str_replace("AM", "오전", time_stamp_am_pm($request_data['request_date'])))?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="bg_f9f9f9">
		<div class="chat_text_box">
			<input type="hidden" id="user_id" value="cablejung"> 
			<div class="chat_text_area">			
				<input type="text" id="chat_text" class="chat_input_text" placeholder="입력해주세요." onkeydown="if(event.keyCode==13)chat_submit_click()"> 
				<input type="button" value="전송" class="chat_input_button color_ea3c3c" onclick="javascript:chat_submit_click();">
			<div class="clear"></div>
			</div>
		</div>
		<div class="bot_content">
			<div class="bot_btn_01" onclick="javascript:chat_accept('<?=$send_id?>', '<?=$idx?>');">채팅 수락하기</div>
			<div class="bot_btn_02">
				<div class="padding_top_10">채팅 수락시 건당 70P 차감됩니다.</div>
				<div >회원님의 현재 포인트 : <?=number_format($mtp['total_point'])?>P</div>
			</div>
		</div>
	</div>

	<div id="lack_alrim"><?//포인트 부족시 알림?></div>

	<script type="text/javascript">
		
		$(document).ready(function(){

			$(".title_center2 > b").css("font-size", "1.8em");
			$(".modal_pop_title2").css("background-color", "#DD4040");
			$("#modal_close_btn").on("click", function(){
				modal.close();
			});

		});

		//전송버튼 alert
		function chat_submit_click(){
			alert('채팅수락을 하셔야 채팅이 가능합니다.');
		}

	</script>

	