	<div>
		<div>
			<img src="<?=IMG_DIR?>/m/m_super_chat_main.png" class="width_100per">
			<div class="super_top_content">
				<div class="super_top_box">

					<input type="hidden" id="v_mode" name="v_mode" value="super">
					<input type="hidden" id="v_use_point" name="v_use_point" value="">
					<input type="hidden" id="v_sex_flag" name="v_sex_flag" value="<?=$set_data[0]?>">

					<div style="border-bottom:1px solid #ececec;">
						<div style="float: left;line-height: 37px; padding:3%;text-align: left;padding-left: 10px;background: #f4f4f6;width: 25%;">대상자</div>
						<div class="select_box_border float_left padding_3per width_50per">
							<select class="width_125per height_37" id="v_member_num" name="v_member_num" onchange="javascript:call_payment_change(this.value);">
								<? for($i=10; $i<=100; $i+=10){ ?>
								<option value="<?=$i?>">최근 접속한 <?=$set_data[1]?>회원 <?=$i?>명</option>
								<? } ?>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div style="border-bottom:1px solid #ececec;">
						<div style="float: left;line-height: 37px; padding:3%;text-align: left;padding-left: 10px;background: #f4f4f6;width: 25%;">지역</div>
						<div class="select_box_border float_left padding_3per width_50per">
							<select class="width_125per height_37" id="v_conregion" name="v_conregion">
								<option value="">전체지역</option>
								<? for($i=0; $i<count($area); $i++){ ?>
								<option value="<?=$area[$i]?>"><?=$area[$i]?></option>
								<? } ?>								
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div style="border-bottom:1px solid #ececec;">
						<div style="float: left;line-height: 37px; padding:3%;text-align: left;padding-left: 10px;background: #f4f4f6;width: 25%;">나이</div>
						<div class="select_box_border float_left padding_3per width_20per">
							<select class="width_125per height_37" id="v_age_1" name="v_age_1" onchange="javascript:call_search_age_change(this.value);">
								<option value="">전체</option>
								<? for($i=20; $i<70; $i++){ ?>
								<option value="<?=$i?>"><?=$i?></option>
								<? } ?>
							</select>
						</div> 
						<div class="select_box_border float_left padding_3per width_20per">
							<select class="width_125per height_37" id="v_age_2" name="v_age_2">
								<option value="">전체</option>	
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div style="border-bottom:1px solid #ececec;">
						<div class="height_53" style="float: left;line-height: 37px; padding:3%;text-align: left;padding-left: 10px;background: #f4f4f6;width: 25%;">내용</div>
						<div class="select_box_border float_left padding_3per width_50per">
							<textarea id="chat_msg" name="chat_msg" class="super_chat_msgbox"></textarea>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="padding_top_17 width_100per bg_fff">
					<div class="super_top_text_box">
						<div class="color_999 padding_top_10 padding_bottom_13">채팅 신청시 마다 건당 50P 차감됩니다.</div>
						<div class="color_666">회원님의 현재 포인트 : <p><?=number_format($mtp)?>P</p></div>
						<div class="padding_7 color_666" id="use_point">사용될 포인트: <p>500P</p></div>
						<? if(!empty($set_data[2])){ echo $set_data[2]; } ?>
					</div>
				</div>
			</div>
			<div class="padding_top_17 padding_bottom_10 bg_fff">
				<a href="javascript:supser_chat_submit();">
					<div class="super_btn">슈퍼채팅 신청하기</div>
				</a>
			</div>
		</div>

		<div class="chatting_middle_box">
			<div class="padding_top_6per padding_bottom_3per">
				<b class="font-size_16 color_7a00ff">최근 접속</b>
				<b class="font-size_16"> 이성</b>
			</div>
			<div class="bx-wrapper">
				<div class="bx-viewport">
					<div class="slider2">
						<?
						if(!empty($mlist)){
							foreach($mlist as $data){
								$mdata = $this->member_lib->get_member($data['m_userid']);
						?>
						<li id="member_thumb"><?=$this->member_lib->member_thumb($mdata['m_userid'], 250, 250)?>
						<div class="super_bot_txt">
							<?=$this->member_lib->s_symbol($mdata['m_sex'])?>
							<span class="color_fff margin_left_5"><?=$mdata['m_nick']?> (<?=$mdata['m_age']?>세)</span>
						</div>
						<?
								}
							}
						?>
					</div>
				</div>
			</div>

		</div>
	</div>

<script>
$(document).ready(function(){
  $('.slider2').bxSlider({
    slideWidth: 300,
    minSlides: 3,
    maxSlides: 3,
    slideMargin: 10
  });
});
</script>