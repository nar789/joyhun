			<div class="bg_f4f4f4 height_126 padding_left_20 padding_top_20">
				<p class="color_333 blod font-size_14">이상형 채팅현황</p>
				<div class="wanna_chat_list margin_top_9">
				<?
					// 이상형 채팅현황
					foreach(push_invite() as $key => $val)
					{
				?>
					<p class="margin_bottom_6"><span class="color_ea3c3c"><?=$val['m_nick']?></span><!-- <span class="color_666"> (빛에물들다)</span> -->
					<span class="color_999">  <?=$val['m_conregion']?> / <?=$val['m_age']?>세</span></p>

				<? } ?>
				</div>
			</div>

			<div class="padding_20 padding_bottom_none">
				<!-- <p class="color_333 blod font-size_14">초대 인사말</p>
				<div class="margin_top_9">
					<div class="popup_img_L ver_top">
						<img src="<?=IMG_DIR?>/sample/asdfasdf_47.gif">
					</div>
					<div class="block margin_left_mi_3">
						<div class="wanna_invite_text padding_6 color_999">
							<?=$my_intro?>
						</div>
						<table class="margin_left_6">
							<tr>
								<td class="width_80 height_20 padding_left_8 color_666">지역</td>
								<td class="width_190 color_999"><?=$m_conregion?></td>
							</tr>
							<tr>
								<td class="width_80 height_20 padding_left_8 color_666">나이</td>
								<td class="width_190 color_999"><?=$m_age2?>0대</td>
							</tr>
							<tr>
								<td class="width_80 height_20 padding_left_8 color_666">원하는 만남</td>
								<td class="width_190 color_999"><?=want_reason_data($m_reason)?></td>
							</tr>
							<tr>
								<td class="width_80 height_20 padding_left_8 color_666">대화 스타일</td>
								<td class="width_190 color_999"><?=talk_style_data($m_character,$m_sex)?></td>
							</tr>
						</table>
					</div>
				</div> -->

				<div class="alarm_chat_area">
					<p class="font-size_14 color_333"><?=$m_nick?> <span class="font-size_12 color_999"><?=$add_text?></span></p>
					
					<div class="margin_top_10">
						<a href="#"><?=$this->member_lib->member_thumb($m_userid,123,124)?></a>
						<textarea class="alarm_chat_text ver_top" placeholder="입력해주세요" id="sin_msg" name="sin_msg"></textarea>
					</div>
				</div>
			</div>

			<div class="margin_top_20 text-center">
				<input type="button" class="text_btn_de4949 width_82 height_30" value="초대하기" onclick="chat_submit();">
			</div>


			<div class="padding_20">
				<div class="alarm_chat_guid">
					<ul class="alarm_chat_guid_box padding_bottom_30">
						<li class="padding_bottom_3 color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"><span class="color_333">채팅 신청시 건당 70P 총 
							<b class="color_ea3c3c"><span id="final_point">70</span> P</b> 차감됩니다. 회원님의 현재 포인트 : 
							<span class="color_ea3c3c">
								<? if(@$tp['total_point']){ ?>
								 <?=number_format($tp['total_point'])?> P
								 <? }else{ ?>
								 0 P
								 <? } ?>
							</span> 
						</li>
						<li class="color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">절대비밀보장! 용기내어 채팅신청해 주세요. </li>
					</ul>
				</div>
			</div>