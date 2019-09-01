<div class="content">

	<div class="left_main">

		<div class="super_main_bg">
			<div class="super_top_content">
				<div class="super_top_box">
					<div class="padding_top_15">
						<div id="super_loading"><img src="<?=IMG_DIR?>/etc/loading.gif"></div>

						<input type="hidden" id="v_mode" name="v_mode" value="super">
						<input type="hidden" id="v_use_point" name="v_use_point" value="">
						<input type="hidden" id="v_sex_flag" name="v_sex_flag" value="<?=$set_data[0]?>">

						<div class="block width_100 text-left font-size_14">대상자</div>
						<div class="select_box_border">
							<select class="width_235 height_37" id="v_member_num" name="v_member_num" onchange="javascript:call_payment_change(this.value);">
								<? for($i=10; $i<=100; $i+=10){ ?>
								<option value="<?=$i?>">최근 접속한 <?=$set_data[1]?>회원 <?=$i?>명</option>
								<? } ?>
							</select>
						</div>
					</div>
					<div class="padding_top_15">
						<div class="block width_100 text-left font-size_14">원하는 지역</div>
						<div class="select_box_border">
							<select class="width_235 height_37" id="v_conregion" name="v_conregion">
								<option value="">전체지역</option>
								<? for($i=0; $i<count($area); $i++){ ?>
								<option value="<?=$area[$i]?>"><?=$area[$i]?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<div class="padding_top_15">
						<div class="block width_100 text-left font-size_14 margin margin_left_mi_65">나이</div>
						<div class="select_box_border">
							<select class="width_70 height_37" id="v_age_1" name="v_age_1" onchange="javascript:call_search_age_change(this.value);">
								<option value="">전체</option>
								<? for($i=20; $i<70; $i++){ ?>
								<option value="<?=$i?>"><?=$i?></option>
								<? } ?>
							</select>
						</div> 
						&nbsp;&nbsp;~&nbsp;&nbsp;
						<div class="select_box_border">
							<select class="width_70 height_37" id="v_age_2" name="v_age_2">
								<option value="">전체</option>
							</select>
						</div>
					</div>
					<div class="padding_top_15">
						<div class="block width_100 height_50 text-left font-size_14" style="vertical-align:top; padding-top:30px;">내용</div>
						<div class="block width_235 height_59">
							<textarea id="chat_msg" name="chat_msg" class="super_chat_msgbox"></textarea>
						</div>
					</div>
					<div class="padding_top_17">
						<div class="super_top_text_box">
							<div class="color_999 padding_top_10 padding_bottom_10">채팅 신청시 마다 건당 50P 차감됩니다.</div>
							<div class="color_666">회원님의 현재 포인트 : <p><?=number_format($mtp)?>P</p></div>
							<div class="padding_7 color_666" id="use_point">사용될 포인트: <p>500P</p></div>
							<? if(!empty($set_data[2])){ echo $set_data[2]; } ?>							
						</div>
					</div>
				</div>
			</div>
			<div class="padding_top_17">
				<a href="javascript:supser_chat_submit();">
					<div class="super_btn">슈퍼채팅 신청하기</div>
				</a>
			</div>
		</div>

		<div class="chatting_middle_box">
			<div class="margin_bottom_15">
				<b class="font-size_16 color_7a00ff">최근 접속</b>
				<b class="font-size_16"> 이성</b>
			</div>
			<!--<div class="btn_area">
				<div class="btn_prev">
					<img src="http://joyhunting.com/images/main_left_btn.png"></a>
				</div>
			</div>-->
			<div class="width_690 margin_auto" id="bg_main_photo">
				
				<?
					if(!empty($mlist)){
						foreach($mlist as $data){
							$mdata = $this->member_lib->get_member($data['m_userid']);
				?>
				<div class="block height_141 margin_top_10 ">
					<div class="block width_142 text-center">
						<a href="#" onclick="<?user_check("view_profile('$data[m_userid]');");?>"><?=$this->member_lib->member_thumb($mdata['m_userid'], 125, 146)?></a>
					</div>
					<div class="color_333 text-center line_height_22 margin_top_5">
						<?=$this->member_lib->s_symbol($mdata['m_sex'])?>
						<span class="margin_left_5"><?=$mdata['m_nick']?> (<?=$mdata['m_age']?>세)</span>
					</div>
				</div>
				<?
						}
					}
				?>

			</div>
		</div>

		<div class="super_bottom_bg">
			<div class="super_bottom_btn_box">
				<a href="javascript:location.href='/secret/talkchat/talk_list'">
					<div class="super_bottom_btn">비밀채팅 하러가기</div>
				</a>
				<div class="clear"></div>
			</div>
		</div>

	</div>



	<!-- ## margin_top_8 end ## --><!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->


<script>
$(document).ready(function() {
	
	$("#touchSlider4").touchSlider({
		roll : true,
		view : 4,
		autoplay : true,
		speed : 2000,
		btn_prev : $("#touchSlider4").prev().find(".btn_prev"),
		btn_next : $("#touchSlider4").next().find(".btn_next")
	});

	var t44 = new js_rolling('bg_main_photo');
	t44.set_direction(4);
	t44.move_gap = 1;	//움직이는 픽셀단위
	t44.time_dealy = 40; //움직이는 타임딜레이
	t44.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
	t44.start();

});
</script>