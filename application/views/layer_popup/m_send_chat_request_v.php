
<div class="padding_10">

	<b class="color_e15148 font-size_14"><?=$m_nick?></b><span class="color_999 blod"> <?=$add_text?></span>

	<table class="width_98per margin_top_7">
		<tr>
			<td class="width_35per">
				<div class="send_chat_area">

					<? if($m_filename){ ?>
						<?=$this->member_lib->member_thumb($m_userid,123,124)?>
					<? }else{ ?>
						<? if($m_sex == 'M'){?>
						<img src="<?=IMG_DIR?>/m/m_popup_man.gif">
						<?}else{?>
						<img src="<?=IMG_DIR?>/m/m_popup_girl.gif" style="margin-top:-10px;">
						<?}?>
						<div class="send_pic_info">
							<p style="margin-top:2px;">사진은 채팅창에서<br>보실 수 있습니다.</p>
						</div>
					<? } ?>
				</div>
			</td>
			<td class="width_65per">
				<textarea class="send_chat_text border_0" style="height:112px;" placeholder="메세지를 입력해 주세요" id="sin_msg" name="sin_msg"></textarea>
			</td>
		</tr>
	</table>

	<div class="m_chat_info" style="line-height:16px;padding-top:3px;">
		<ul>
			<li><span class="color_ea3c3c font-size_10 margin_left_mi_4">
				<? if($m_sex == 'F'){?>건당 70P 차감됩니다. 회원님의 현재포인트: 
					<? if(@$tp['total_point']){ ?>
					<?=number_format($tp['total_point'])?> P
					<? }else{ ?>
					0 P
					 <? } ?>
				<?}else{?>
					<div class="block">메시지 무료 이용가능</div>
				<?}?>
			</span></li>
			<li><span class="color_999 font-size_10 margin_left_mi_4">비밀을 보장해 드립니다. 채팅 무료 이용가능</span></li>
		</ul>
	</div>

</div>

<div class="bg_3e3e3e height_55">
	<table class="width_90per margin_auto height_55">
		<tr>
			<td class="width_50per"><input type="button" class="m_pop_btn" value="취소" onclick="modal.close();"></td>
			<td class="width_50per"><input type="button" class="m_pop_btn" value="전송" onclick="chat_submit('<?=$m_userid?>', '<?=@$gubn?>');"></td>
		</tr>
	</table>
</div>




<style>

	.send_chat_area2 { height:102px;padding-top:10px;padding-bottom:10px; }

</style>

<script>


	$(document).ready(function(){

		var img_src = $(".send_chat_area > img").attr('src');


		// 사진있는회원이면
		if (img_src.indexOf('m_popup_man') == '-1') {
			
			$(".send_chat_area").addClass("send_chat_area2");
		
		}
		

	});

</script>