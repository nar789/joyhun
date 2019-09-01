		<div class="solo_top_bg_box">	
			<div class="solo_top_bg">
				<div class="solo_text_box">
					<div class="solo_text_box_box">
						<p>하단의 친구찾기 게시판에 글을 남겨주시면 추첨을 통해</p>
						<b>10분에게 VIPS 상품권</b><span>을드립니다.</span>
					</div>
				</div>
				<div style="width:100%; margin-top:1%;">
					<div class="solo_txt_box">10월7일~11월30일까지</div>
				</div>
				<div class="solo_position_box">
					<div class="solo_position"></div>
				</div>
				<div class="width_100per posi_rel">
					<div class="solo_position_box width_6per block">
						<div class="solo_position"></div>
					</div>
					<textarea class="top_textarea border_none" id="t_context" placeholder="나의 짝을 찾고있습니다."></textarea>
					<div class="solo_position_box width_18per block margin_left_-1per">
						<div class="position_ab" onclick="<?user_check("talk_insert('$m_userid', '2');");?>">
							<img src="<?=IMG_DIR?>/m/m_event_solo_btn.png" class="width_102per">
						</div>
					</div>
					<div class="solo_position_box width_5per float_right">
						<div class="solo_position"></div>
					</div>
				</div>
			</div>
		</div>
		<div class=" posi_rel solo_content_bg">

			<div class="bg_fff width_100per">
				<div class="padding_top_3per padding_bottom_3per width_100per bg_f5f5f5">
					<div class="solo_title_left">&nbsp;</div>
					<div class="float_left"><b>&nbsp;친구찾기&nbsp;</b></div>
					<div class="float_right width_78per">
						<div></div>
					</div>
					<div class="clear"></div>
				</div>

				<div id="div_tbl_on" class="bg_fefefe">
					<table class="width_95per margin_auto m_intro_table">
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){

									if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
									if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }
						?>
						<tr>
							<td class="width_17per now_member pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');"><?=$this->member_lib->member_thumb($data['m_userid'], 200, 200)?></td>
							<td class="m_intro_text_td padding_top_3per padding_bottom_3per">
								
								<div class="float_left width_70per">
									<b class=" color_333 margin_left_3per level_m_online_img <?=$m_color?> pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
										<?=$data['m_nick']?>
									</b>
									<b class="color_888 pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">(<?=$data['m_age']?>) <?=$data['m_conregion']?> <?=$data['m_conregion2']?></b>
									<p class="margin_top_3 margin_left_3per">
										<?=$data['t_context']?>	
									</p>
								</div>
								<div class="float_left width_30per text-right">
									<input type="button" value="비밀채팅신청" class="secret_btn blcok" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
								</div>
								<div class="clear"></div>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<!-- 등록된 글이 없을 경우 -->
						<?
							}
						?>
					</table>
				</div>		
			</div>

			<!-- 더보기 리스트 부분 -->
			<div class="bg_fefefe">
				<table id="tbl" class="width_95per margin_auto m_intro_table">
				</table>
			</div>
			<!-- 더보기 리스트 부분 -->

			<div id="more_btn" class="borad_add">
				<div id="more" page="<?=$page+1?>" class="board_more text-center">
				more &nbsp;<div></div>
				</div>
			</div>

		</div>

		

		


