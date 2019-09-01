<div class="content">

	<div class="left_main">

		<div class="met_conbox_1">
			<div class="met_con_title_box">
				<div class="met_con_title_left">
					<span>실시간</span><span class="font-size_16 color_333"> 미팅 신청자</span>
				</div>
				<div class="met_con_title_right">
					<ul>
						<li>
							<div id="sub_met_menu_over1" class="over" onmouseover="met_menu_over(1);start_setting(0)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu1.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over2" class="out" onmouseover="met_menu_over(2);start_setting(1)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu2.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over3" class="out" onmouseover="met_menu_over(3);start_setting(2)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu3.png"></a>
							</div>
						</li>
						<li>
							<div id="sub_met_menu_over4" class="out" onmouseover="met_menu_over(4);start_setting(3)">
								<a href="#"><img src="<?=IMG_DIR?>/meeting/sub_met_menu4.png"></a>
							</div>
						</li>
					</ul>
				</div>
			</div>		<!-- ## met_con_title_right end ## -->
			<div class="met_con_sub_box" style="height:271px;">
			
				<div class="met_con_sub_title">
					<ul>
						<li>
							<div><a href="#" class="font-size_14">20대 미팅신청자</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">30대 미팅신청자</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">40대 미팅신청자</a></div>
						</li>
						<li>
							<div><a href="#" class="font-size_14">50대 미팅신청자</a></div>
						</li>
					</ul>
				</div>

				<div class="met_con_content_box">

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" id="gal1" class="image">
								<img src="" id="img1"> 
							</div>
							<div class="met_content_top">
								<p><span id="met_nick"></span> <span id="met_age"></span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span id="met_like"></span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span id="met_area"></span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span id="met_day"></span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title">
									<span id="met_title"></span>
								</div>
								<input type="button" class="text_btn_ea3e3e met_content_bottom_btn" id="met_datego" value="데이트신청하기">
								<div class="icon_btn_bababa met_main_love_ic" id="met_love">
									<span class="img_heart_btn"></span>
								</div>
							</div>
						</div>		<!-- ## met_content_box end ## -->
					</div>		<!-- ## met_content end ## -->

					<div class="met_content">
						<div class="met_content_box">
							<div class="met_content_img" id="gal2" class="image">
								<img src="" id="img2">
							</div>
							<div class="met_content_top">
								<p><span id="met_nick2"></span> <span id="met_age2"></span></p>
								<ul>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">관심사 : <span id="met_like2"></span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">만남지역 : <span id="met_area2"></span></li>
									<li><img src="<?=IMG_DIR?>/meeting/lihead.gif">미팅날짜 <span id="met_day2"></span></li>
								</ul>
							</div>

							<div class="met_content_bottom">
								<div class="met_content_bottom_title">
									<span id="met_title2"></span>
								</div>
								<input type="button" class="text_btn_ea3e3e met_content_bottom_btn" id="met_datego2" value="데이트신청하기">
								<div class="icon_btn_bababa met_main_love_ic" id="met_love2">
									<span class="img_heart_btn"></span>
								</div>							
							</div>
						</div>		<!-- ## met_content_box end ## -->
					</div>		<!-- ## met_content end ## -->

				</div>		<!-- ## met_con_content_box end ## -->
			</div>		<!-- ## met_con_title_left end ## -->
		</div>		<!--	## met_conbox_1 end ##	-->


		<div class="margin_top_13">

			<div class="sms_box">
				<img src="<?=IMG_DIR?>/meeting/smsting_banner.gif">

				<div class="sms_con_box">

				<?	
					$i = 0;
					//문자팅 OPEN
					foreach( sex_rand('3', 'T_JoyHunting_MsgTing', '*', 'm_userid', 'T_JoyHunting_MsgTing.m_sex', 'm_update ') as $key => $val)
					{
				?>

					<div class="sms_content">
						<a href="javascript:sms_main_go()">
							<p id="sms_go_<?=$i?>" class="margin_left_2"><?=$val['m_nick']?></p>
							<p><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세</p>
						</a>
					</div>
					
				<? $i++; } ?>

				</div>
			</div>		<!-- ## sms_box end ## -->

			<div class="new_ting">
				<div class="new_ting_title_box">
					<div class="float_left">
						<p>최근 등록된 번개팅</p>
					</div>
					<div class="float_right">
						<a href="/meeting/beongae/all"><img src="<?=IMG_DIR?>/meeting/add_btn2.gif"></a>
					</div>
					<div class="clear"></div>
				</div>
				

				
				<div id="meeting_slide" class="height_235">

					<?
						//최근 등록된 번개팅
						foreach( sex_rand('10', 'T_MeetingDate_Bun', '*', 'b_userid', 'T_MeetingDate_Bun.b_sex', 'b_date') as $key => $val)
						{

							$b_day_1 = substr($val['b_day'], 5, 2);
							$b_day_2= substr($val['b_day'], 8, 2);
					?>
					<div>		
						<div class="new_ting_con_box">
							<div class="new_ting_con1">
								<p>
									<img src="<?=IMG_DIR?>/meeting/up_btn.gif"> &nbsp; <?=$b_day_1?>.<?=$b_day_2?>
								</p>
							</div>
							<div class="new_ting_con2">
								<p class="color_333"><?=want_time_text($val['b_time'])?></p>
								<p class="color_666"><?=strcut_utf8(($val['b_intro']),30)?></p>
							</div>
							<div class="new_ting_con3">
								<div class="text_btn_fe727b beongae_apply_btn" onclick="<?user_check("b_request('$val[idx]');");?>">
									번개팅요청 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
								</div>
								<input type="button" class="text_btn_dcdcdc beongae_detail_view" value="상세보기" onclick="<?user_check("b_datail_request('$val[idx]');");?>">
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<? } ?>
				</div>

			</div>		<!-- ## new_ting end ## -->
		</div>		<!-- ## margin_top_13 end ## -->


		<div class="clear"></div>

		<div class="margin_top_8">

			<div class="poll_box">
			
				<div class="poll_box_left">
					<div class="poll_box_con">
						<p>너무나도 다른 우리~</p>
						<p>공감<span class="font_no font-size_21"> POLL</span></p>
						<img src="<?=IMG_DIR?>/meeting/meeting_poll_btn.gif" class="text_btn_496946 meet_main_votebtn" onclick="<?user_check("location.href='/friend/vote_poll';");?>">
					</div>					
				</div>
			<?
				foreach( board_list('1', 'reg_vote_list', '*', 'm_code',"m_use_yn = 'Y'") as $key => $val)
				{
			?>
				<div class="vote_box">
					<div class="vote_title_box">
						<img src="<?=IMG_DIR?>/meeting/q_text.gif" class="margin_bottom_mi_5"> <?=$val['m_title']?>
					</div>
					
					<div class="vote_list_box">
						<div class="vote_list">
							<div>
								<input type="radio" id="radio1" name="research"><label for="radio1"><?=$val['m_example1']?></label>
							</div>
							<div>
								<input type="radio" id="radio2" name="research"><label for="radio2"><?=$val['m_example2']?></label>
							</div>
							<div>
								<input type="radio" id="radio3" name="research"><label for="radio3"><?=$val['m_example3']?></label>
							</div>
							<div>
								<input type="radio" id="radio4" name="research"><label for="radio4"><?=$val['m_example4']?></label>
							</div>
							<div>
								<input type="radio" id="radio5" name="research"><label for="radio5"><?=$val['m_example5']?></label>
							</div>
						</div>		<!-- ##	vote_list end ## -->
					</div>		<!-- ## vote_list_box end ## -->
				</div>		<!-- ## vote_box end ## -->
				<div class="clear"></div>

				<? } ?>
			</div>		<!-- ## poll_box end ## -->

			<div class="best_click">
			
				<div class="best_click_box">
					<div class="best_click_con_box">
						<div class="best_click_title bg_f4758d">
							<img src="<?=IMG_DIR?>/meeting/medal.png" class="float_left">
							<p>여자찜 <span class="color_f7ff1c">베스트</span></p>
						</div>
			<?
				foreach( jjim_best('F') as $key => $val)
				{
			?>
						<div onclick="view_profile('<?=$val['m_userid']?>');" class="best_click_img"><?=$this->member_lib->member_thumb($val['m_userid'],103,99)?></div>
						<div onclick="view_profile('<?=$val['m_userid']?>');" class="best_click_text"><p><?=$val['m_nick']?>(<?=$val['m_age']?>)</p></div>
			<? } ?>
					</div>

					<div class="best_click_con_box">
						<div class="best_click_title bg_75baf4">
							<img src="<?=IMG_DIR?>/meeting/medal.png" class="float_left">
							<p>남자찜 <span class="color_f7ff1c">베스트</span></p>
						</div>
			<?
				foreach( jjim_best('M') as $key => $val)
				{
			?>
						<div onclick="view_profile('<?=$val['m_userid']?>');" class="best_click_img"><?=$this->member_lib->member_thumb($val['m_userid'],103,99)?></div>
						<div onclick="view_profile('<?=$val['m_userid']?>');" class="best_click_text"><p><?=$val['m_nick']?>(<?=$val['m_age']?>)</p></div>
			<? } ?>
					</div>
					<div class="clear"></div>
				</div>

			</div>
			<div style="clear:both"></div>
		</div>		<!-- ## margin_top_8 end ## -->


		<div class="margin_top_8">
			<div class="secret_layer">
				<a href="/secret/talkchat/talk_list"><img src="<?=IMG_DIR?>/meeting/main_secret_banner.gif"></a>
				<div class="secret_layer_box" id="meeting_slide_secret">

				<?
					// 1:1 우리끼리 비밀스럽게~
					foreach( sex_rand('8', 'TotalMembers', '*','m_userid', 'm_sex','last_login_day') as $key => $val)
					{
				?>

					<div class="secret_box">
						<div class="secret_img_box">
							<? if($val['m_sex'] == "M"){?><img src="<?=IMG_DIR?>/secret_man.gif" class="margin_right_9">
							<? }else{ ?><img src="<?=IMG_DIR?>/secret_girl.gif" class="margin_right_9"><? } ?>
						</div>
						<div class="secret_content">
							<b><?=$val['m_nick']?>(<?=$val['m_age']?>)</b>
							<div><p class="width_145 text_cut"><?=talk_style_data($val['m_character'], $val['m_sex']);?> / <?=want_reason_data($val['m_reason']);?></p></div>

							<input type="button" class="text_btn_dcdcdc secret_content_btn" value="신청하기" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
						</div>
					</div>

				<? } ?>

				</div>		<!-- ## secret_layer_box end ## -->
			</div>		<!-- ## secret_layer end ## -->

			<div class="area_box">
				<div class="area_title">
					<p><span class="color_ff1c24 font-size_14">지역별 </span><span class="font-size_14">미팅회원</span></p>
					<p id="area_title">지역을 선택하시면 해당회원수를 확인하실 수 있습니다.</p>
					<p id="area_cnt_text" style="display:none"><span class="color_ff1c24" id="meet_area_cnt"></span>명이 등록되어 있습니다.</p>
				</div>
				<div class="clear"></div>

				<div id="region1" class="area_member font-size_16 pointer">서울</div>
				<div id="region2" class="area_member font-size_16 pointer">경기</div>
				<div id="region3" class="area_member font-size_16 pointer">인천</div>
				<div id="region4" class="area_member font-size_16 pointer">강원</div>
				<div id="region5" class="area_member font-size_16 pointer">경북</div>
				<div id="region6" class="area_member font-size_16 pointer">경남</div>
				<div id="region7" class="area_member font-size_16 pointer">부산</div>
				<div id="region8" class="area_member font-size_16 pointer">대구</div>
				<div id="region9" class="area_member font-size_16 pointer">전북</div>
				<div id="region10" class="area_member font-size_16 pointer">전남</div>
				<div id="region11" class="area_member font-size_16 pointer">충남</div>
				<div id="region12" class="area_member font-size_16 pointer">광주</div>
				<div id="region13" class="area_member font-size_16 pointer">대전</div>
				<div id="region14" class="area_member font-size_16 pointer">제주</div>
				<div id="region15" class="area_member font-size_16 pointer">해외</div>

			</div>		<!-- ## area_box ## -->

			<div class="pr_box">
				<div class="pr_title_box">
					<p>
						친구사귀기 PR
					</p>
					<p>
						<a href="/friend/friend_add/make_friend"><img src="<?=IMG_DIR?>/meeting/add_btn2.gif"></a>
					</p>
				</div>

				<div class="pr_con_box">

					<?
						// 친구사귀기 PR
						foreach( sex_rand('2', 'T_MakeFriend_PR', '*','m_userid', 'T_MakeFriend_PR.m_sex','m_writedate') as $key => $val)
						{
					?>
					<div class="pr_content">
						<? if($val['m_sex'] == "M"){?><img src="<?=IMG_DIR?>/man_ic.gif">
						<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif"><? } ?>
						
						<a href="/friend/friend_add/make_friend/sex/%20/">
							<p>&nbsp;<?=$val['m_nick']?></p><p class="width_340 text_cut"><?=$val['m_content']?></p>
						</a>
					</div>
					<div class="clear"></div>
					<? } ?>
				</div>

			</div>
			<div style="clear:both"></div>
		
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
var t = new js_rolling('meeting_slide');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start(); 


var t = new js_rolling('meeting_slide_secret');
t.set_direction(0);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start(); 


</script>