<div class="content">
	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">
			
			<div class="posi_rel width_760">
				
				<div class="posi_rel width_760 winter_bg">
					
					<input type="hidden" id="user_array" name="user_array" value="<?=$user_array?>">

					<div class="winter_text_box">
						<div class="con_list">	
							<?
								if(!empty($msg_member)){
									foreach($msg_member as $data){
							?>
							<div class="con_list_box">
								<div class="pointer" onclick="javascript:view_profile('<?=$data['m_userid']?>');"><?=$this->member_lib->member_thumb($data['m_userid'], 103, 99)?></div>
								<p class="area_age"><?=$data['m_conregion']?> / <?=$this->member_lib->s_symbol($data['m_sex'])?><?=$data['m_age']?>세</p>
								<p class="con_title text_cut"><?=talk_style_data($data['m_character'], $data['m_sex'])?></p>
							</div>							
							<?
									}
								}
							?>
						</div>
					</div>
					<div class="winter_talk_box">
						<div style="margin_left:-10px;">
							<textarea class="top_textarea border_1_874b0d width_576 height_63 border-radius_4 font-size_14 line-height_22" id="t_context" placeholder="많이 춥고 힘든 계절이지만, 우리맘속에 따뜻한 온기 한점은 잃지 말자.&#10;건강 조심하고 잘지내세요."></textarea>
						</div>
					</div>
					<div class="winter_btn border-radius_4 pointer" onclick="<?=user_check('javascript:msg_member();')?>">
						<div>안부 보내기</div>
					</div>
				</div>

				<div class="posi_rel width_760 winter_content_bg">
					<div class=" posi_rel width_96per margin_auto margin_bottom_30 bg_fff">

						<div class="solo_top_area"><b>겨울 메세지</b></div>

							<?
								if($getTotalData > 0){
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
												<span class="block color_999 margin_left_21"><?=$data['t_write']?></span>
											</p>
											<div class="color_666 margin_top_10 line-height_16  break_all">
												<?=$data['t_context']?>
											</div>
										</div>
										<div class="comment_box margin_top_60" onclick="javascript:comment_view('<?=$data['t_idx']?>', '<?=$m_userid?>');">
											<span>댓글 </span><em id="rpy_cnt_<?=$data['t_idx']?>"><?=$data['t_repl']?></em>
											<div class="block comment_arrow" id="arrow_<?=$data['t_idx']?>"></div>
										</div>
									</div>
									<div class="float_right margin_bottom_10 width_75 margin_right_10 margin_top_10">
										<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="<?user_check("friend_request('$data[m_userid]');");?>">
										<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="메세지" onclick="<?user_check("send_message('$data[m_userid]', 'send', '');");?>">
									</div>
									<div class="clear"></div>
									<div class="comment_rep_box" id="talk_comment_<?=$data['t_idx']?>">
										<!-- reply list -->
									</div>	
									
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
										토크 리스트가 없습니다.<Br>
										토트를 등록하고 새로운 인연을 만나보세요! 
									</div>
									<div class="clear"></div>
								</div>		<!-- ## light_img_null end ## -->
							</div>
							<?
								}
							?>

							<div class="list_pg paddin_top_33 padding_bottom_50">		<!-- ## 페이징 div ## -->
								<div>
									<?=$pagination_links?>
								</div>
							</div>
							<div class="clear"></div>

						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

	</div>

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>
