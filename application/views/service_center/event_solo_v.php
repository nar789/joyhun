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
			
			<div class="posi_rel width_760">
				
				<div class="posi_rel width_760 solo_top_bg">

					<div class="solo_text_box">
						<p>하단의 친구찾기 게시판에 글을 남겨주시면 추첨을 통해 <span class="blod font-size_15 color_000">10분에게 VIPS 상품권</span>을 드립니다.</p>
						<span class="font-size_15 color_000 blod ">기간 : 10월7일~11월30일까지</span>
					</div>
					<div class="solo_talk_box">
						<div class="talk_top_box">
							<div>
								<div class="top_textarea_img" id="noimg_check">
									<img src="<?=IMG_DIR?>/service_center/solo_noimg.gif">	<!-- 대표사진 없을때 -->										
								</div>
								<textarea class="top_textarea border_1_874b0d width_385 height_68" id="t_context" placeholder="안녕하세요~ 반갑습니다."></textarea>
								<div class="text_btn_de4949 top_textarea_subbtn bg_98373c" onclick="talk_insert('a790458',1);">
									<div class="margin_top_19 font-size_14 blod color_fff">토크<br>올리기</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="posi_rel width_760 solo_content_bg">
					<div class=" posi_rel width_90per margin_auto margin_bottom_30 bg_fff">

						<div class="solo_top_area"><b>친구찾기</b></div>
							<div id="tmp">
								<input type="hidden" id="m_userid" name="m_userid" value="a790458">

									<? for($i=0; $i<10; $i++){ ?>
									<div class="list_area min_height_108">
										<div class="float_left talk_thumb" onclick="view_profile('aceh123');">
											<img src="http://joyhunting.com/upload/thumb/ac/aceh/aceh123/2016-07-05_22.47_.03_.jpg.74x71.jpg">		
										</div>
										<div class="float_right margin_top_16 width_579">
											<div class="float_left padding_bottom_10 margin_left_10">
												<div class="block width_400 ver_top">
													<p class="margin_top_8 level_img_talk">
														<img src="http://joyhunting.com/images/profile/main_top_silver.png">
														<span class="color_8a98f0 font_900">♂</span><b class="color_333333">한국신문</b>
														<span class="block color_999 margin_left_21">2016-10-05 01:38:39</span>
													</p>
													<div class="color_666 margin_top_10 line-height_16 padding_bottom_8 break_all">
														제주도 아무지역이나 편안하게 연락하실분~mose6217톡주세용ㅋㅋㅇㄴㄹㅇㄴㄹㄹ
													</div>
												</div>
												<div class="comment_box margin_top_47 margin_left_10" onclick="javascript:comment_view('29941', 'a790458');">
													<span>댓글 </span><em id="rpy_cnt_29941">0</em>
													<div class="block comment_arrow" id="arrow_29941"></div>
												</div>
											</div>
											<div class="float_right margin_bottom_10 width_75 margin_right_10">
												<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="friend_request('aceh123');">
												<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="앤되기" onclick="anne_request('aceh123');">
											</div>
											<div class="clear"></div>
											<div class="comment_rep_box" id="talk_comment_29941"></div>
											
										</div>	
									</div>
									<? } ?>

									<div class="list_pg paddin_top_33 padding_bottom_50">		<!-- ## 페이징 div ## -->
										<div>
											<ul class="pagination">
												<li><a href="http://joyhunting.com/etc/talk/talk_list/page/1" title="Go to the previous page" class="prev_page ver_wbm">
												<img src="<?=IMG_DIR?>/paging_arrow.gif"></a></li>
												<li class="active"><a href="http://joyhunting.com/etc/talk/talk_list/page/1" title="Go to page 1" class="page">1</a></li>
												<li><a href="#" title="Go to page 2" class="page">2</a></li>
												<li><a href="#" title="Go to page 3" class="page">3</a></li>
												<li><a href="#" title="Go to page 4" class="page">4</a></li>
												<li><a href="#" title="Go to page 5" class="page">5</a></li>
												<li><a href="#" title="Go to page 6" class="page">6</a></li>
												<li><a href="#" title="Go to page 7" class="page">7</a></li>
												<li><a href="#" title="Go to page 8" class="page">8</a></li>
												<li><a href="#" title="Go to page 9" class="page">9</a></li>
												<li><a href="#" title="Go to the next page" class="next_page ver_wbm">
												<img src="<?=IMG_DIR?>/paging_arrow.gif" class="paging_right_btn"></a></li>
											</ul>
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
<!--div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">

			<div class="board_title">
				<div class="float_left">
					<img src="<?=IMG_DIR?>/service_center/event_cate_online.gif">
					<img src="<?=IMG_DIR?>/service_center/event_cate_mobile.gif">
					<span class="displayblock ver_top font-size_16 color_333 padding_left_6">이번 가을에는 소롤탈출하고 외식상품권 받자~~!!</span>
				</div>
				<div class="float_right color_ccc padding_right_20">기간 : 2016.10.07~2016.10.31</div>
				<div class="clear"></div>
			</div>

			<div class="board_content">
				<div class="chulchek_bg_second">
					<div class="solo_text_box">
						<p style="color:#888; font-size:15px;">하단의 친구찾기 게시판에 글을 남겨주시면 추첨을 통해 <span class="blod font-size_15 color_000">10분에게 VIPS 상품권</span>을 드립니다.</p>
						<span class="font-size_15 color_000 blod padding_top_5 ">기간 : <?=$m_start_day?>~<?=$m_end_day?></span>
					</div>
					<div class="solo_talk_box">
						<div class="talk_top_box">
							<div class="">
								<div class="top_textarea_img" id="noimg_check">
									<img src="">											
								</div>
								<textarea class="top_textarea border_1_7b5dfb width_394 height_73" id="t_context" placeholder="안녕하세요~ 반갑습니다."></textarea>
								<div class="text_btn_de4949 top_textarea_subbtn bg_98373c" onclick="talk_insert('a790458',1);">
									<div class="margin_top_19 font-size_14 blod color_fff">토크<br>올리기</div>
								</div>
							</div>
						</div>
					</div>
					
					<div style="margin-top:100px;"></div>
					<div style="margin:auto; background:#fff; width:729px; height:765px;">
						<div class="tab_content_top_area"></div>
						<div id="tmp">
							<input type="hidden" id="m_userid" name="m_userid" value="a790458">
								<div class="list_area min_height_108">
									<div class="float_left talk_thumb" onclick="view_profile('aceh123');">
										<img src="http://joyhunting.com/upload/thumb/ac/aceh/aceh123/2016-07-05_22.47_.03_.jpg.74x71.jpg">		
									</div>
									<div class="float_right margin_top_16 width_605">
										<div class="float_left padding_bottom_10">
											<div class="block width_454 ver_top">
												<p class="margin_top_8 level_img_talk">
													<img src="http://joyhunting.com/images/profile/main_top_silver.png">
													<span class="color_8a98f0 font_900">♂</span><b class="color_333333">한국신문</b>
													<span class="block color_999 margin_left_21">2016-10-05 01:38:39</span>
												</p>
												<div class="color_666 margin_top_10 line-height_16 padding_bottom_8 break_all">
													제주도 아무지역이나 편안하게 연락하실분~
														mose6217톡주세용ㅋㅋ
												</div>
											</div>
											<div class="comment_box margin_top_47" onclick="javascript:comment_view('29941', 'a790458');">
												<span>댓글 </span><em id="rpy_cnt_29941">0</em>
												<div class="block comment_arrow" id="arrow_29941"></div>
											</div>
										</div>
										<div class="float_right margin_bottom_10 width_75">
											<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="friend_request('aceh123');">
											<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="앤되기" onclick="anne_request('aceh123');">
										</div>
										<div class="clear"></div>
										<div class="comment_rep_box" id="talk_comment_29941"></div>
										
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

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div-->

