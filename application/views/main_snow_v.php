<!------- CONTENT START ------------>
<canvas id="snow"></canvas>
<div class="content">

	<div class="left_main">

		<div class="content_01_left">

			<div class="content_01_left_box">

					<div class="content_01_menu menu01_def">
						<ul class="tabs2"> 
							<li class="font-size_14 menu01_on " id="main_top_menu_0" rel="content_01_00">추천이상형</li>
							<li class="font-size_14" id="main_top_menu_1" rel="content_01_01">공식인증사진</li>
							<li class="font-size_14" id="main_top_menu_2" rel="content_01_02">베스트인기사진</li>
							<li class="font-size_14" id="main_top_menu_3" rel="content_01_03">최근접속자</li><!-- IE 는 margin-top:-145px; -->
						</ul>
					</div>		<!-- content_01_menu end -->

					<div class="tab_container"> 

						<div id="content_01_00" class="tab_content2">
						<? 
							$i = 0;
							// 추천이상형
							foreach($ideal_type as $key => $val)
							{
						?>
							<div class="content_01_sub_menu pointer">
								<a href="#"><?=$this->member_lib->member_thumb($val['m_userid'],105,142)?></a>		<!-- 103x99 -->
								<div id="ie_cr_<?=$i?>" class="content01_img_grad" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
									<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
								</div>
							</div>

						<? $i++; } ?>
									
						</div>

						<div id="content_01_44" class="tab_content2" style="display:none;">
						<? 
							$i = 0;
							// 추천이상형
							foreach($test_type as $key => $val)
							{
						?>
							<div class="content_01_sub_menu pointer">
								<a href="#"><?=$this->member_lib->member_thumb($val['m_userid'],105,142)?></a>		<!-- 103x99 -->
								<div id="ie_cr_<?=$i?>" class="content01_img_grad" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
									<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
								</div>
							</div>

						<? $i++; } ?>
									
						</div>
				
						<!-- ## content_01_00 end -->
						
						
						<div id="content_01_01" class="tab_content2" style="display:none;">
						<?
							if(!$main_member_pic = $this->cache->get('main_member_pic')){
									$main_member_pic =   sex_rand('7', 'member_pic', '*', 'user_id', 'TotalMembers.m_sex', 'pic_admin_date',array('pic_status' => '인증완료','is_main_pic'  => 'y'));
									$this->cache->save('main_member_pic', $main_member_pic, 600);	//10분 캐시 사용
							}

							$i = 0;
							// 공식인증사진
							foreach( $main_member_pic as $key => $val)
							{
						?>
							<div class="content_01_sub_menu2 pointer">
								<a href="#"><?=$this->member_lib->member_thumb($val['m_userid'],105,142)?></a>
								<div id="ie_cr2_<?=$i?>" class="content01_img_grad"  onclick="<?user_check("view_profile('$val[m_userid]');");?>">
									<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
								</div>
							</div>

						<? $i++;} ?>
						</div>


						<div id="content_01_02" class="tab_content2" style="display:none;">
						<?
							if(!$main_best_pic = $this->cache->get('main_best_pic')){
									$main_best_pic =   sex_rand('7', 'TotalMembers', '*', 'm_userid', 'm_sex', 'm_popularity',array("m_filename !=" => "null","ex_file" => "m_filename != ''"));
									$this->cache->save('main_best_pic', $main_best_pic, 600);	//10분 캐시 사용
							}

							$i = 0;
							// 베스트인기사진
							foreach( $main_best_pic as $key => $val)
							{
						?>
							<div class="content_01_sub_menu3 pointer">
								<a href="#"><?=$this->member_lib->member_thumb($val['m_userid'],105,142)?></a>
								<div id="ie_cr3_<?=$i?>" class="content01_img_grad"  onclick="<?user_check("view_profile('$val[m_userid]');");?>">
									<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
								</div>
							</div>
						<? $i++;} ?>

						</div>

						<div id="content_01_03" class="tab_content2" style="display:none;">
						<?
							if(!$main_login_pic = $this->cache->get('TotalMembers_login.main_pic')){
									$main_login_pic =  sex_rand('7', 'TotalMembers_login', '*', 'm_userid', 'TotalMembers_login.m_sex', 'last_login_day',array("ex_file1" =>"TotalMembers_login.m_filename IS NOT null","ex_file2" => "TotalMembers_login.m_filename != ''", "ex_file3" => "TotalMembers_login.m_nick_chk is null"));
									$this->cache->save('TotalMembers_login.main_pic', $main_login_pic, 600);	//10분 캐시 사용
							}

							$i = 0;
							// 최근접속자
							foreach( $main_login_pic as $key => $val)
							{
						?>

							<div class="content_01_sub_menu4 pointer">
								<a href="#"><?=$this->member_lib->member_thumb($val['m_userid'],105,142)?></a>
								<div id="ie_cr4_<?=$i?>" class="content01_img_grad"  onclick="<?user_check("view_profile('$val[m_userid]');");?>">
									<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
								</div>
							</div>
						<? $i++;} ?>

						</div>
						<!-- ## content_01_03 end -->
					</div>
					<!-- ## tab_container end ## -->
				</div>
				<!-- ## content_01_left_box end ## -->
		</div>
		<!-- ## content_01_left end ## -->


		<div class="content_01_right">
			<div class="content_01_right_menu1_on" id="con_01_menu1">
				<p>새내기 회원</p>
			</div>
			<div class="content_01_right_menu2_off" id="con_01_menu2">
				<p>현재접속 회원</p>
			</div>

			<div class="content_01_right_show1 mCustomScrollbar" id="con_01_content1" style="overflow:hidden">
				<?
					if(!$main_new_member = $this->cache->get('main_new_member')){
							$main_new_member =  sex_rand('12', 'TotalMembers', 'm_userid,m_nick,m_sex', 'm_userid', 'm_sex', 'm_in_date', array("ex_file1" => "TotalMembers.m_nick_chk is null"));
							$this->cache->save('main_new_member', $main_new_member, 600);	//10분 캐시 사용
					}

					// 새내기 회원
					foreach( $main_new_member as $key => $val)
					{
				?>
				<div class="show">
					<? if ($val['m_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif" class="float_left">
					<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif" class="float_left"><? } ?>
					<p class="float_left pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><?=$val['m_nick']?></p>
					<div class="margin_left_5 float_right">
						<img src="<?=IMG_DIR?>/newic_1.png" class="pointer" title="프로필 보기" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
						<img src="<?=IMG_DIR?>/newic_2.gif" class="pointer" title="채팅신청" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
						<img src="<?=IMG_DIR?>/newic_3.gif" class="pointer" title="찜하기" onclick="<?user_check("jjim_request('$val[m_userid]');");?>">
					</div>
				</div>
				<?
					}
				?>

			</div>		<!-- ## content_01_right_show1 end ## -->
			<div class="content_01_right_show2 mCustomScrollbar" id="con_01_content2">

				<?
					// 현재접속 회원.	구조상 TotalMembers 테이블에서 가져왔으나, 로그인시 캐시삭제를 위해 이름을 TotalMembers_login.main_list 으로 지음.
					if(!$main_login_list = $this->cache->get('TotalMembers_login.main_list')){
							$main_login_list =  sex_rand('12', 'TotalMembers', 'm_userid,m_nick,m_sex', 'm_userid', 'm_sex','last_login_day', array("ex_file1" => "TotalMembers.m_nick_chk is null"));
							$this->cache->save('TotalMembers_login.main_list', $main_login_list, 600);	//10분 캐시 사용
					}

					foreach( $main_login_list  as $key => $val)
					{
				?>

				<div class="show">
					<? if ($val['m_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif" class="float_left">
					<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif" class="float_left"><? } ?>
					<p class="float_left pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><?=$val['m_nick']?></p>
					<div class="margin_left_5 float_right">
						<img src="<?=IMG_DIR?>/newic_1.png" class="pointer" title="프로필 보기" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
						<img src="<?=IMG_DIR?>/newic_2.gif" class="pointer" title="채팅신청" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
						<img src="<?=IMG_DIR?>/newic_3.gif" class="pointer" title="찜하기" onclick="<?user_check("jjim_request('$val[m_userid]');");?>">
					</div>
				</div>
				<?
					}
				?>
			</div>		<!-- ## content_01_right_show2 end	## -->

			<div class="text-center">
				<!-- <input type="button" class="text_btn_ea3e3e rand_btn" value="랜덤채팅 보내기" onclick="rand_chatting('<?=$login_user_sex?>');"> -->
				<input type="button" class="text_btn_ea3e3e rand_btn" value="랜덤채팅 보내기" onclick="<?user_check("rand_chatting('')");?>">
			</div>
		</div>
		<!-- ## content_01_right end ## -->

		<div class="content_02" id="container">
		
		<div class="live_on_ribbon_second">
				<div class="joymagazine_title">
					<ul class="tab" id="tab">
						 <li id="tab01" class="on">실시간 매거진</li>
						 <li id="tab02">실시간 채팅 ON</li>
					</ul>
				</div>
			</div>
			<div class="tab_con" id="tab_con">
				<div class="live_on_menu_area_second" id="tab_menu_01" style="display:block;">
					<div class="margin_left_30">
						<b class="live_on_channel">On 채널</b>
						<div class="arrow_right_3_ff5f0c margin_top_13"></div>
						<ul class="live_on_menu">
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('이색데이트');">이색데이트</b></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('축제속으로');">축제속으로</b></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('여행지정보');">여행지정보</b></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('공연&전시');">공연&전시</b></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('맛집베스트');">맛집베스트</b></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><b class="uline color_8054f0 pointer" onclick="javascript:magazine_sub_tab('카&재테크');">카&재테크</b></li>
						</ul>
					</div>

					<div class="joymagazine_cnt_box">
						<?
							if(count($mlist) > 0){
								foreach($mlist as $data){
						?>
						<div class="width_50per float_left pointer" onclick="javascript:magazine_view_goto('<?=$data['idx']?>');">
							<div class="height_100per float_left">
								<div class="joymagazine_cnt_img_box">
									<img src="http://www.joyhunting.com/upload/naver_upload/magazine/<?=$data['list_img_url']?>" style="width:118px; height:142px;">
								</div>
							</div>			
							<div class="joymagazine_cnt_text_box"> 
								<b class="uline"><?=$data['gubn']?></b><br>
								<b class="uline"><?=$data['title']?></b><br>
								<p class="uline"><?=$data['ahead_text']?></p>
							</div>
						</div>
						<?
								}
							}
						?>
					</div>
					
				</div>
				
				<div class="live_on_menu_area"  id="tab_menu_02" style="display:none;">
					<div class="margin_left_30">
						<b class="live_on_channel">On 채널</b>
						<div class="arrow_right_3_ff5f0c margin_top_13"></div>
						<ul class="live_on_menu">
							<li><a href="#"><b class="uline color_8054f0 pointer">음악듣기방</b></a></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><a href="#"><b class="uline color_8054f0 pointer">영화보기방</b></a></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><a href="#"><b class="uline color_8054f0 pointer">편안한대화</b></a></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><a href="#"><b class="uline color_8054f0 pointer">이성사귀기</b></a></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><a href="#"><b class="uline color_8054f0 pointer">카페채팅방</b></a></li>
							<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
							<li><a href="#"><b class="uline color_8054f0 pointer">1:1데이트</b></a></li>
						</ul>
					</div> 
					<ul class="live_on_list">
						<?
								//음악채팅 방 리스트
								for($r=0;$r<count($room_list);$r++){
										?>
										<li class="pointer">
											<div><?=($r+1)?></div>
											<div><?=music_chat_code($room_list[$r]['c_cate'])?></div>
											<div id="live_slide_<?=($r+1)?>">
												<div><?=title_style(iconv('euc-kr','utf-8',urldecode($room_list[$r]['c_title'])))?></div>
											</div>
											<div><?=$room_list[$r]['c_nowin']?>/<?=$room_list[$r]['c_inwon']?></div>
											<div onclick="go_musicchat();">
												채팅방 입장하기 <div class="arrow_right_3_fff ver_auto"></div>
											</div>
											<div class="clear"></div>
										</li>
									<?
								}
						?>
					</ul>
				</div>
				
			</div>  <!-- ## tab_con end ## -->

		<!--	<img src="<?=IMG_DIR?>/conte_02_ribbon.gif" class="live_on_ribbon">
			<div class="live_on_menu_area">
				<div class="margin_left_30">
					<b class="live_on_channel">On 채널</b>
					<div class="arrow_right_3_ff5f0c margin_top_13"></div>
					<ul class="live_on_menu">
						<li><a href="#"><b>음악듣기방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="#"><b>영화보기방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="#"><b>편안한대화</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="#"><b>이성사귀기</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="#"><b>카페채팅방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="#"><b>1:1데이트</b></a></li>
					</ul>
				</div> 
			</div>
			<ul class="live_on_list">
<?
		//음악채팅 방 리스트
		for($r=0;$r<count($room_list);$r++){
				?>
				<li class="pointer">
					<div><?=($r+1)?></div>
					<div><?=music_chat_code($room_list[$r]['c_cate'])?></div>
					<div id="live_slide_<?=($r+1)?>">
						<div><?=title_style(iconv('euc-kr','utf-8',urldecode($room_list[$r]['c_title'])))?></div>
					</div>
					<div><?=$room_list[$r]['c_nowin']?>/<?=$room_list[$r]['c_inwon']?></div>
					<div onclick="go_musicchat();">
						채팅방 입장하기 <div class="arrow_right_3_fff ver_auto"></div>
					</div>
					<div class="clear"></div>
				</li>
			<?
		}
?>
			</ul> --> 
		</div>		<!-- ## content_02 end ## -->

		<div class="content_03">

			<img src="<?=IMG_DIR?>/open_love.gif">
			<div class="content_03_frame">

				<div class="content_03_title">
					<p class="pointer" onclick="javascript:location.href='/open_marry/open_marry/open_guhon_list';">신규 <span class="color_e74769 font-size_14">업데이트 회원</span></p>
					<a href="/open_marry/open_marry/open_guhon_list"><img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>

				<div id="slider">
					<div class="content_03_leftbox">
						<a href="#" id="prev2" class="prev"><img src="<?=IMG_DIR?>/main_left_btn.png"></a>
					</div>
					
					<div class="slide-wrap">
						<ul id="photo" class="slide-list mt15">

				<?
					if(!$main_OpenguhonMan = $this->cache->get('main_OpenguhonMan')){
							$main_OpenguhonMan =  sex_rand('4', 'T_CoupleMarry_OpenguhonMan', '*', 'b_userid', 'b_sex', 'b_writedate', array("ex_file1" => "TotalMembers.m_nick_chk is null"));
							$this->cache->save('main_OpenguhonMan', $main_OpenguhonMan, 600);	//10분 캐시 사용
					}

					// 신규 업데이트 회원
					foreach( $main_OpenguhonMan as $key => $val)
					{
				?>
							<li>
								<div class="con_03_content">
									<div class="float_left pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
										<?=$this->member_lib->member_thumb($val['b_userid'],130,162)?>
									</div>

									<div class="con_03_top">
										<? if ( $val['b_type'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif" class="float_left margin_right_5">
										<? }else if ( $val['b_type'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif" class="float_left margin_right_5"><? } ?>
										<p class="con_03_top_title"><?=trim_text($val['m_nick'],9)?></p>
										<p class="con_03_top_bir">
											<?=$this->member_lib->s_symbol($val['b_sex'])?> <?=$val['b_ageyear']?>년 (<?=$val['b_age']?>)
										</p>
										<p class="con_03_top_cate"><?=trim_text($val['b_content'],28)?></p>
									</div>

									<div class="love_per_box">
										<p class="love_per_title">러브궁합도</p>
										<div class="love_per_frame">
										<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
											<div class="love_per_frame_box" style="width:<?=love_per($val['b_region'],'',$val['b_age'],$val['b_sex'])?>%;"></div>
										<? }else{ ?>
											<div class="love_per_frame_box" style="width:50%;"></div>
										<? } ?>
										</div>
										<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
											<p class="love_per_name"><?=love_per($val['b_region'],'',$val['b_age'],$val['b_sex'])?>%</p>
										<? }else{ ?>
											<p class="love_per_name">50%</p>
										<? } ?>
										<div class="icon_btn_bababa margin_top_14" onclick="<?user_check("jjim_request('$val[b_userid]');");?>">
											<span class="img_heart_btn"></span>
										</div>
										<input type="button" class="text_btn_ea3e3e margin_top_14" value="프로포즈" onclick="propose_reuqest('<?=$val['b_userid']?>', '<?=$val['b_type']?>');">
									</div>
								</div>
							</li>
				<? } ?>
						</ul>
					</div>		<!-- ## slide-wrap END ## -->

					<div class="content_03_righttbox">
						<a href="#" id="next2" class="next"><img src="<?=IMG_DIR?>/main_right_btn.png"></a>
					</div>
				</div>		<!-- ## slider END ## -->
			</div>		<!-- ## content_03_frame END ## -->

			<div class="content_03_frame">

				<div class="content_03_title">
					<p>매니저의 <span class="color_477ce7 font-size_14">추천 회원</span></p>
					<a href="/open_marry/open_marry/open_guhon_list"><img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>

				<div class="content_03_right_box">
				<? 

					if(!$main_manager = $this->cache->get('main_manager')){

						// 매니저의 추천 회원
						$main_manager =  $this->open_marry_m->result_array('T_CoupleMarry_OpenguhonMan', array('b_manager' => '1') );
						$this->cache->save('main_manager', $main_manager, 600);	//10분 캐시 사용
						//delete_cache("main_manager");  //캐시 지우는방법. common_helper 최하단.
					}

					// 매니저의 추천회원
					foreach($main_manager as $key => $val){
				?>
					<div class="content_03_right_list">
						<div class="content_03_right_img" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
							<?=$this->member_lib->member_thumb($val['m_userid'],80,56)?>
						</div>
						<div class="con_03_text_box">
							<? if ( $val['b_type'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif" class="float_left margin_right_5">
							<? }else if ( $val['b_type'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif" class="float_left margin_right_5"><? } ?><p class="con_03_id"><?=$val['m_nick']?></p>
							<p class="con_03_con"><?=$this->member_lib->s_symbol($val['b_sex'])?><?=$val['m_age']?>세 / <?=trim_text($val['b_content'],18)?></p>
						</div>
						<input type="button" class="text_btn_ea3e3e margin_top_10" value="프로포즈" onclick="propose_reuqest('<?=$val['b_userid']?>', '<?=$val['b_type']?>');">
					</div>

				<? } ?>

					<div class="clear"></div>
				</div>		<!-- ## content_03_right_box END -->

				<script type="text/javascript">fn_rollToEx('slider', 'photo');</script>

			</div>		<!-- ## content_03_frame END -->
		</div>		<!-- ## content_03 END -->

		<div class="clear"></div>

		<div class="content_04">
			<p class="float_left">나는</p>
			<div class="main_select_box width_90">
				<select name="name1" id="search_age">
					<option value="20" selected>20~24세</option>
					<option value="25">25~29세</option>
					<option value="30">30~34세</option>
					<option value="35">35~39세</option>
					<option value="40">40~44세</option>
					<option value="45">45~49세</option>
					<option value="50">50~54세</option>
					<option value="55">55~59세</option>
					<option value="60">60~64세</option>
					<option value="65">65~69세</option>
					<option value="70">70세이상</option>
				</select>
			</div>
			<div class="main_select_box width_56">
				<select id="search_area">
					<option value="서울" selected>서울</option>
					<option value="경기">경기</option>
					<option value="인천">인천</option>
					<option value="대전">대전</option>
					<option value="대구">대구</option>
					<option value="부산">부산</option>
					<option value="광주">광주</option>
					<option value="울산">울산</option>
					<option value="충북">충북</option>
					<option value="충남">충남</option>
					<option value="전북">전북</option>
					<option value="전남">전남</option>
					<option value="경북">경북</option>
					<option value="경남">경남</option>
					<option value="강원">강원</option>
					<option value="제주">제주</option>
					<option value="해외">해외</option>
				</select>					
			</div>
			<p> 에 사는 </p>
			<!-- 
			<div class="main_select_box width_82">
				<select>
					<option value="" selected>사진있는</option>
					<option value="">사진없는</option>
				</select>
			</div>
			-->
			<div class="main_select_box width_56 bg_position_98">
				<select id="search_sex">
					<option value="F" selected>여성</option>
					<option value="M">남성</option>
					<!-- <option value="A">모든분</option> -->
				</select>
			</div>
			<p> 과 </p>
			<div class="main_select_box2 bg_position_98">
				<select id="search_reason">
					<? 
						$arr = want_reason_data("all");
						foreach ($arr as $key => $value) {
					?>
							<option value="<?=$key?>"><?=$value?></option>
					<? } ?>
				</select>
			</div>
			<p> 을 원해요! </p>

			<input type="submit" class="search_btn" value="">
		</div>  <!-- ## content_04 end ## -->

		<div class="content_05">

			<div class="content_05_left">

				<img src="<?=IMG_DIR?>/confirm_1.gif" class="content_05_title">

				<div class="content_05_left_box">
					<div class="con_05_left_title">
						<a href="/meeting/smsting/all"><p>실시간 <span class="color_ff1c24 font-size_18">문자팅</span></p></a>
						<a href="/meeting/smsting/all"><img src="<?=IMG_DIR?>/add_btn.png"></a>
					</div>		<!-- ## con_05_left_title END -->
					<div class="con_05_left_list">

					<?
						if(!$main_msgting = $this->cache->get('main_msgting')){

							// 매니저의 추천 회원

							$main_msgting =  sex_rand('2', 'T_JoyHunting_MsgTing','*','m_userid','T_JoyHunting_MsgTing.m_sex', 'm_update', array("ex_file1" => "TotalMembers.m_nick_chk is null", "m_filename !=" => "null","ex_file" => "m_filename != ''"));
							$this->cache->save('main_msgting', $main_msgting, 600);	//10분 캐시 사용
							//delete_cache("main_msgting");  //캐시 지우는방법. common_helper 최하단.
						}

						// 실시간 문자팅
						foreach($main_msgting  as $key => $val)
						{
					?>
						<div class="con_05_left_list_box pointer">
							<div onclick="<?user_check("view_profile('$val[m_userid]');");?>">
								<?=$this->member_lib->member_thumb($val['m_userid'],103,99)?>
								<p class="text_cut"><a href="#" class="color_999"><?=$val['m_nick']?></a></p>
							</div>
							<input type="button" class="text_btn_dcdcdc con_05_left_list_btnbox" value="문자보내기" onclick="javascript:location.href='/meeting/smsting/all';">
						</div>

					<? } ?>

					</div>		<!-- ## con_05_left_list end ## -->
				</div>		<!-- ## content_05_left_box end ## -->
			</div>    <!-- ## content_05_left end ## -->

			<div class="content_05_right">
				
				<div class="posi_rel">
					<img src="<?=IMG_DIR?>/confirm_2.gif" class="content_05_title">
				</div>

				<div class="content_05_right_box">
					<div class="con_05_right_title">
						<p>퍼펙트 <span class="color_53af1e font-size_18">공식인증회원</span></p>
						<a href="/photo/permission/new_photo"><img src="<?=IMG_DIR?>/add_btn.png"></a>
					</div>

					<div class="con_05_right_list"><!-- m_in_date -->
					<?
						if(!$main_perfect = $this->cache->get('main_perfect')){
							// 퍼펙트 공식 인증 회원
							$main_perfect =  sex_rand('4', 'TotalMembers', '*','m_userid','m_sex', 'm_in_date', array("ex_file1" => "TotalMembers.m_nick_chk is null", "m_filename !=" => "null","ex_file" => "m_filename != ''"));
							$this->cache->save('main_perfect', $main_perfect, 600);	//10분 캐시 사용
						}

						// 퍼펙트 공식 인증 회원
						foreach( $main_perfect as $key => $val)
						{
					?>
						
						<div class="con_05_right_list_box">
							<div class="pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><?=$this->member_lib->member_thumb($val['m_userid'],103,99)?></div>
							<p class="area_age"><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?><?=$val['m_age']?>세</p>
							<p class="con_05_title text_cut"><?=talk_style_data($val['m_character'],$val['m_sex'])?></p>
						</div>

					<? } ?>
					</div>		<!-- ## con_05_right_list END -->
				</div>		<!-- ## content_05_right_box END -->

			</div>		<!-- ## content_05_right end ## -->
		</div>		<!-- ## content_05 end ## -->

		<div class="content_06">

			<div class="content_06_web_app">
				<p class="pointer" onclick="javascript:location.href='/etc/joy_guide';">국내최초 웹연동 채팅어플</p>
				<img src="<?=IMG_DIR?>/appimg_02.png" class="pointer" onclick="javascript:location.href='/etc/joy_guide';">
				<input type="button" class="text_btn_ea3e3e content_06_web_app_btn" onclick="javascript:location.href='/etc/joy_guide';" value="조이헌팅앱 서비스안내">
			</div>		<!-- ## content_06_web_app END -->

			<div class="content_06_bg_box">

				<div class="content_06_title">
					<a href="/gift_shop/gift"><p>선물상점</p></a>
					<a href="/gift_shop/gift"><img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>
				<div class="clear"></div>

				<div class="margin_top_27 text-center">
					<ul>
						<li>
							<div>
								<a href="/gift_shop/gift"><img src="<?=IMG_DIR?>/main_gift_text_img.png"></a>
							</div>
						</li>
						<li>
							<div class="margin_top_23">
								<a href="/gift_shop/gift"><img src="<?=IMG_DIR?>/main_gift_shop_img.png"></a>
							</div>
						</li>
					</ul>
				</div>				
			</div>		<!-- ##	content_06_bg_box end ## -->
	
			<div class="content_06_bg_box">

				<div class="content_06_title">
					<a href="/service_center/event/ing_event"><p>이벤트</p></a>
					<a href="/service_center/event/ing_event"><img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>

				<div class="con_06_ev_box">

					<?
						if(!$main_event = $this->cache->get('main_event')){
							// 이벤트 배너
							$main_event =  board_list('2', 'reg_event_list', '*', 'm_idx','(m_gubn = "P" or m_gubn = "A") and m_use_yn = "Y" ');
							$this->cache->save('main_event', $main_event, 600);	//10분 캐시 사용
						}

						foreach( $main_event as $key => $val)
						{
					?>

					<div class="con_06_ev_list">
						<a href="<? if(!@empty($val['m_move_url'])){ echo $val['m_move_url']; }else{ ?>/service_center/event/event_view/m_idx/<? echo $val['m_idx']; } ?>">
						<img src="/upload/naver_upload/event/<?=$val['m_main_img_url']?>"></a>
						<div class="con_06_ev_text pointer" onclick="javascript:location.href='<? if(!@empty($val['m_move_url'])){ echo $val['m_move_url']; }else{ ?>/service_center/event/event_view/m_idx/<? echo $val['m_idx']; } ?>';">
							<p><?=strcut_utf8($val['m_title'],11)?></p>
							<p><?=strcut_utf8($val['m_sub_content'],12)?></p>
						</div>
					</div>

					<? } ?>

				</div>		<!-- ## con_06_ev_box END -->
			</div>		<!-- ##	content_06_bg_box end ## -->
		</div>		<!-- ## content_06 end ## -->

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!----------- CONTENT END  ------------------->



<script>
window.onload = function(){

            jQuery(".snowStop").show();

            var snow_layer = document.getElementById("snow");

            var snow = snow_layer.getContext("2d");

            var w_width = jQuery(window).width();

            var w_height = jQuery(window).height();

            snow_layer.width = w_width;

            snow_layer.height = w_height;




                    var snow_cnt = 80; //눈 갯수

            var snow_max_size = 3; // 눈 크기

                    var grain = [];

            for(var i=0; i<snow_cnt; i++) {

                grain.push({ x:Math.random()*w_width, y:Math.random()*w_height, r:Math.random()*snow_max_size+1, d:Math.random()*snow_cnt });

            }

            

            function draw() {

                snow.clearRect(0, 0, w_width, w_height);

                snow.fillStyle = "rgba(250, 250, 250, 0.8)";

                snow.beginPath();

                for(var i=0; i<snow_cnt; i++) {

                var p = grain[i];

                snow.moveTo(p.x, p.y);

                snow.arc(p.x, p.y, p.r, 0, Math.PI*2, true);

                }

                snow.fill();

                update();

            }

            

            var angle = 0;

            function update() {

                angle += 0.01;

                for(var i=0; i<snow_cnt; i++) {

                var p = grain[i];

                p.y += Math.cos(angle+p.d)+1+(p.r/2);

                p.x += Math.sin(angle)*2;

            

                if(p.x>w_width+5 || p.x<-5 || p.y>w_height) {

                    if(i%3 > 0) {

                    grain[i] = {x:Math.random()*w_width, y:-10, r:p.r, d:p.d};

                    } else {

                    if(Math.sin(angle)>0)

                        grain[i] = {x:-5, y: Math.random()*w_height, r:p.r, d:p.d};

                    else

                        grain[i] = {x:w_width+5, y:Math.random()*w_height, r:p.r, d:p.d};

                    }

                }

                }

            }

            

            setInterval(draw, 33);

            }

</script>
<style>
#snow { height: 100%; left: 0; pointer-events: none; position: fixed; top: 0; width: 100%; z-index: 1000; }
</style>