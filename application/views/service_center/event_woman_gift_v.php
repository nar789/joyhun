
<div class="content">

	<div class="woman_gift_bg">
		<div class="height_428"></div>
		<div class="height_361">
			<div class="text-center margin_top_60">
				<b><?=$this->session->userdata['m_nick']?></b>
				<b>님 오늘의 미션 현황 </b>
			</div>
			<div class="text-center margin_top_85">
				<div class="w_g_cnt_box bg_a2b0db">
					<div class="woman_mis_success">
						<b>로그인하기<br></b>
						<b>미션완료</b>
					</div>
				</div>
				<img src="<?=IMG_DIR?>/m/event_w_giftt_ic.gif" class="padding_bottom_15">
				<div class="w_g_cnt_box <?=$req_class[0]?>">
					<div class="<?=$req_class[1]?>">
						<b>채팅신청 10회 보내기 <span class="qus_icon" onclick="javascript:w_e_guide();">?</span><br></b>
						<?=$req_class[2]?>
					</div>
				</div>
				<!--img src="<?=IMG_DIR?>/m/event_w_giftt_ic.gif" class="padding_bottom_15">
				<div class="w_g_cnt_box <?=$chat_class[0]?>">
					<div class="<?=$chat_class[1]?>">
						<b>채팅대화 3회 하기 <span class="qus_icon" onclick="javascript:w_e_guide_second();">?</span><br></b>
						<?=$chat_class[2]?>
					</div>
				</div-->
				<div class="margin_top_15">
					<? if($today_gift == "1"){ ?>
					<img src="<?=IMG_DIR?>/service_center/e_w_gift_chk.png">
					<? }else{ ?>
					<img src="<?=IMG_DIR?>/m/e_w_gift_<?=$GIFT_BTN?>.png" <? if($GIFT_BTN == "on"){ ?> onclick="javascript:woman_event_gift_layer();" style="cursor:pointer;"<? }else if($GIFT_BTN == "off"){?> onclick="javascript:location.href='/secret/talkchat/talk_list';" style="cursor:pointer;"<? } ?>>
					<? } ?>
				</div>
			</div>

			
		</div>
		<div style="poistion:abslute; width:100%; height:80px;">
			<div style="position:relative; width:300px; height:50px; top:17px; left:578px; text-align:center; line-height:50px;">
				<b style="font-size:22px; color:#666;">2016.07.28~ 2016.08.21</b>
			</div>
		</div>
	</div>
	<div class="margin_top_40">
		<div class="w_bottom_gift_list_border">
			<div class="padding_20 text-center">
				<b>최근 선물받은 회원님들</b>
			</div>
			<div class="text-center"><img src="<?=IMG_DIR?>/service_center/e_woman_gift_list.png"></div>
			<div class="w_bottom_cnt">
				<?
					if(!empty($member_gift_list)){
						foreach($member_gift_list as $data){
				?>
				<div class="w_bottom_gift_list_box">
					<div class="w_bottom_gift_list">
						<div class="block">
						<a href="#" onclick="view_profile('<?=$data['RECV_ID']?>');"><div class="girl_icon" style="width:68px; height:49px;"><?=$this->member_lib->member_thumb($data['RECV_ID'], 68, 49)?></div></a>
						</div>
					</div>
					<div class="w_bottom_gift_list_second width_120 color_666"><?=$data['NICK']?></div>
					<div class="w_bottom_gift_list_second width_300 color_666"><?=$data['GIFT_NAME']?></div>
					<div class="w_bottom_gift_list_second width_235 color_999"><?=call_time_change($data['SEND_DATE'])?></div>
				</div>
				<?
						}
					}
				?>
			</div>
		</div>
	</div>

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>
