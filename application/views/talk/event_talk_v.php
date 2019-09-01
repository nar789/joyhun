<div class="content">
	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">
			
			<div class="board_title">
				<div class="float_left">
					<img src="<?=IMG_DIR?>/service_center/event_cate_online.gif">
					<img src="<?=IMG_DIR?>/service_center/event_cate_mobile.gif">
					<span class="displayblock ver_top font-size_16 color_333 padding_left_6">이번 가을에는 솔로탈출하고 외식상품권 받자~~!!</span>
				</div>
				<div class="float_right color_ccc padding_right_20">기간 : 2016.10.07~2016.11.30</div>
				<div class="clear"></div>
			</div>
			
			<div class="posi_rel width_760 padding_top_40 padding_bottom_40">
				
				<div class="posi_rel width_760 solo_top_bg">

					<div class="solo_text_box">
						<p>하단의 친구찾기 게시판에 글을 남겨주시면 추첨을 통해 <span class="blod font-size_15 color_000">10분에게 VIPS 상품권</span>을 드립니다.</p>
						<span class="font-size_15 color_000 blod ">기간 : 10월7일~11월30일까지</span>
					</div>
					<div class="solo_talk_box">
						<div class="talk_top_box">
							<div>
								<div class="top_textarea_img" id="noimg_check">
									<? if (IS_LOGIN){	//로그인 했으면 프로필사진 ?>
										<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71)?>
									<? } else { //로그인안했으면 user_check ?>
										<a href="#" onclick="<?=user_check("javascript:form_check();")?>"><span>대표사진 등록</span></a>
									<? } ?>
								</div>
								<textarea class="top_textarea border_1_874b0d width_394 height_68" id="t_context" placeholder="안녕하세요~ 반갑습니다."></textarea>
								<div class="text_btn_de4949 top_textarea_subbtn bg_98373c" onclick="<?user_check("talk_insert('$m_userid', '2');");?>">
									<div class="margin_top_19 font-size_14 blod color_fff">토크<br>올리기</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="posi_rel width_760 padding_bottom_30 solo_content_bg">
					<div class=" posi_rel width_90per margin_auto margin_bottom_30 bg_fff">

						<div class="solo_top_area"><b>친구찾기</b></div>
							<div id="tmp">
								<input type="hidden" id="m_userid" name="m_userid" value="a790458">

									<? 
										if($getTotalData > 0){
											foreach($mlist as $data){
									?>
									<div class="list_area min_height_108">
										<div class="float_left talk_thumb" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
											<?=$this->member_lib->member_thumb($data['m_userid'],74,71)?>
										</div>
										<div class="float_right margin_top_16 width_579">
											<div class="float_left padding_bottom_10 margin_left_10">
												<div class="block width_400 ver_top">
													<p class="margin_top_8 level_img_talk">
														<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333333"><?=$data['m_nick']?></b>
														<span class="block color_999 margin_left_21"><?=$data['t_write']?></span>
													</p>
													<div class="color_666 margin_top_10 line-height_16 padding_bottom_8 break_all">
														<?=$data['t_context']?>
													</div>
												</div>
												<div class="comment_box margin_top_47" onclick="javascript:comment_view('<?=$data['t_idx']?>', '<?=$m_userid?>');">
													<span>댓글 </span><em id="rpy_cnt_<?=$data['t_idx']?>"><?=$data['t_repl']?></em>
													<div class="block comment_arrow" id="arrow_<?=$data['t_idx']?>"></div>
												</div>
											</div>
											<div class="float_right margin_bottom_10 width_75 margin_right_10">
												<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="<?user_check("friend_request('$data[m_userid]');");?>">
												<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="메세지" onclick="<?user_check("send_message('$data[m_userid]', 'send', '');");?>">
											</div>
											<div class="clear"></div>

											<div class="comment_rep_box" id="talk_comment_<?=$data['t_idx']?>" style="margin-left:-25px;">
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
											<?= $pagination_links?>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/event/ing_event'"/>
				<div class="clear"></div>
			</div>

		</div>

	</div>

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>


