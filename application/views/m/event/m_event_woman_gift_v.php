
	<div class="event_woman_gift2">
		<div class="margin_auto">
			<div class="pd_t_89p">
				<b><?=$this->session->userdata['m_nick']?></b>
				<b>님 오늘의 미션 현황 </b>
			</div>
			<div class="pd_t_18p">

				<div class="event_woman_box bg_a2b0db">
					<div class="woman_mis_success">
						<b>로그인하기<br></b>
						<b>미션완료</b>
					</div>
				</div>
				<img src="<?=IMG_DIR?>/m/event_w_giftt_ic.gif" class="w_3p m_1p">
				<div class="event_woman_box <?=$req_class[0]?>">
					<div class="<?=$req_class[1]?>">
						<b>채팅신청 10회 보내기
							<span class="margin_left_1per" onclick="javascript:w_e_guide();">
								<img src="<?=IMG_DIR?>/m/e_w_gift_ic.gif" style="width:5%;vertical-align: top;">
							</span><br>
						</b>
						<?=$req_class[2]?>
					</div>
				</div>
				<!--img src="<?=IMG_DIR?>/m/event_w_giftt_ic.gif" class="w_3p m_1p">
				<div class="event_woman_box <?=$chat_class[0]?>">
					<div class="<?=$chat_class[1]?>">
						<b>채팅대화 3회 하기
							<span class="margin_left_1per" onclick="javascript:w_e_guide_second();">
								<img src="<?=IMG_DIR?>/m/e_w_gift_ic.gif" style="width:5%;vertical-align: top;">
							</span><br>
						</b>
						<?=$chat_class[2]?>
					</div>
				</div-->
				
				<div class="event_woman_gift_btn">
					<? if($today_gift == "1"){ ?>
					<img src="<?=IMG_DIR?>/m/m_e_w_gift_end.png">
					<? }else{ ?>
					<img src="<?=IMG_DIR?>/m/m_e_w_gift_<?=$GIFT_BTN?>.png" <? if($GIFT_BTN == "on"){ ?> onclick="javascript:woman_event_gift_layer();"<? }else if($GIFT_BTN == "off"){ ?> onclick="javascript:location.href='/m/online_mb';"; <? } ?> >
					<? } ?>
				</div>
			</div>
			<div style="position:relative; width:100%; padding-top:84%;">
				<b style="font-size:22px; color:#666;">2016.07.28~ 2016.08.21</b>
			</div>
			<div class="pd_t_110">
				<div class="event_bot_box">
					<div class="w_bottom_cnt">
						
						<div class="padding_10 margin_top_1_per"><b>최근 선물받은 회원님들</b></div>
						<div class="event_bot_img_box">
							<img src="<?=IMG_DIR?>/m/e_w_gift_list.png">
						</div>

						<?
							if(!empty($member_gift_list)){
								foreach($member_gift_list as $data){
						?>
						<div class="event_bot_list">
							<div class="float_left width_30per">
								<div class="width_100per color_666 font-size_11"><?=$data['NICK']?></div>
							</div>
							<div class="float_left width_39per">
								<div class="event_bot_text_box color_666 font-size_11">
								<?=strcut_utf8($data['GIFT_NAME'], 20)?>
								</div>
							</div>
							<div class="float_left width_30per">
								<div class="event_bot_text_box color_999 font-size_11">
								<?=call_time_change($data['SEND_DATE'])?>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<?
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
