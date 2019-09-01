<div class="content">
	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">
			
			<div class="posi_rel width_760">
				
				<div class="posi_rel width_760">
					
					<input type="hidden" id="user_nick" name="user_nick" value="<?=@$this->session->userdata['m_nick']?>">

					<div class="vacance_img_bg">
						<img src="<?=IMG_DIR?>/service_center/vacance_bg.gif" id="vacance_img" useMap="#Map">
						<div class="result"></div>
					</div>
					
					<div style="position:relative; width:100%; background-color:#F2F0E9;">
						<div style="position:relative; width:96%; margin:auto; background-color:#FFF;">
							<div class="solo_top_area"><b>최근 이벤트 참여자</b></div>

							<?
								if(@$getTotalData > 0){
									foreach($mlist as $data){
							?>
							<div class="list_area min_height_108">
								<div class="float_left talk_thumb" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
									<?=$this->member_lib->member_thumb($data['m_userid'],74,71)?>
								</div>
								<div class="float_right  width_610">
									<div class="float_left padding_bottom_10 ">
										<div class="block width_455 ver_top">
											<p class="margin_top_24 level_img_talk">
												<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333333"><?=$data['m_nick']?></b>
												<span class="block color_999 margin_left_21"><?=$data['write_date']?></span>
											</p>
											<div class="color_666 margin_top_10 line-height_16  break_all">
												<?=vacance_event_code($data['gubn'])?>
											</div>
										</div>
									</div>
									<div class="float_right margin_bottom_10 width_75 margin_right_10 margin_top_10">
										<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="<?user_check("friend_request('$data[m_userid]');");?>">
										<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="메세지" onclick="<?user_check("send_message('$data[m_userid]', 'send', '');");?>">
									</div>
									<div class="clear"></div>									
								</div>	
								<div class="clear"></div>
							</div>
							<?
									}
								}else{
							?>
							<div class="list_area min_height_108">
								<div class="light_img_null">
									<img src="/images/meeting/light_null.gif" style="margin-top:10px;">
									<div>
										참여자가 없습니다.<Br>
										이벤트에 참여하시고 새로운 인연을 만나보세요! 
									</div>
									<div class="clear"></div>
								</div>		<!-- ## light_img_null end ## -->
							</div>
							<?
								}
							?>

							<div class="list_pg paddin_top_33 padding_bottom_50">		<!-- ## 페이징 div ## -->
								<div>
									<?=@$pagination_links?>
								</div>
							</div>
							<div class="clear"></div>

						</div>
						<div class="clear" style="height:10px;"></div>
					</div>
					
				</div>

				<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/event/ing_event'"/>
				
			</div>

		</div>

	</div>

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>

<map id="Map" name="Map">
<area coords="237,1021,521,1089" id="v_btn_01" name="v_btn_01" onfocus="blur();" onclick="javascript:<?user_check("sel_card_clk();");?>" onMouseOver="vacance_img.style.cursor='pointer';" onMouseOut="vacance_img.style.cursor='auto';">
</map>

<map id="result_map" name="result_map">
<area coords="124,755,400,827" id="v_btn_02" name="v_btn_02" onfocus="blur();" onclick="javascript:location.href='/secret/talkchat/talk_list';" onMouseOver="result_img.style.cursor='pointer'" onMouseOut="result_img.style.cursor='auto'">
</map>