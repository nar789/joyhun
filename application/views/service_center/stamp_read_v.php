<div id="tmp"></div>
<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">이벤트</p>

		<div class="board_view">

			<div class="board_title">
				<div class="float_left">
					<img src="<?=IMG_DIR?>/service_center/event_cate_online.gif"><img src="<?=IMG_DIR?>/service_center/event_cate_mobile.gif">
					<span class="displayblock ver_top font-size_16 color_333 padding_left_6">매일매일 출석도장 찍기</span>
				</div>
				<div class="float_right color_ccc padding_right_20">기간 : <?=$m_start_day?>~<?=$m_end_day?></div>
				<div class="clear"></div>
			</div>

			<div class="board_content">
				<div class="chulchek_bg">
					<div class="chulcheck_title_box">
						<p class="chulcheck_title">인기지수+포인트+깜짝선물</p>
						<div class="chulcheck_guid">
							<p class="color_284e6d font-size_20">핑크 도장을 모두 찍고<span class="color_fefefe font-size_20">즉석선물</span> 받으세요!</p>
						</div>
						<span class="color_bfbfb font-size_16 chulcheck_term">기간 : <?=$m_start_day?>~<?=$m_end_day?></span>
					</div>
					<div class="check_cal_title_box">
						<b class="font-size_32">출석도장 찍고 </b><b class="font-size_32">다양하고 푸짐한 혜택 받아가세요</b>
						<div class="margin_left_30 margin_top_13">
							<div class="check_cal_title_guid">대상</div>
							<span class="check_cal_title_guid_text">핑크도장 출석 완성한 고객</span>
							<div class="check_cal_title_guid margin_left_18">당첨자 발표</div>
							<span class="check_cal_title_guid_text"><?=$m_lottery_day?></span>
						</div>
					</div>
					
					<!-- 도장 찍는 화면 -->
					<div class="calendar">
						
						<div class="view">
							<div id="week1" class="week"><!-- 1주차 -->
								<div id="t_day1" class="day1"></div>
								<div id="t_day2" class="day2"></div>
								<div id="t_day3" class="day3"></div>
								<div id="t_day4" class="day4"></div>
								<div id="t_day5" class="day5"></div>
								<div id="t_day6" class="day6"></div>
								<div id="t_day7" class="day7"></div>
							</div>
							<div id="week2" class="week"><!-- 2주차 -->
								<div id="t_day8" class="day1"></div>
								<div id="t_day9" class="day2"></div>
								<div id="t_day10" class="day3"></div>
								<div id="t_day11" class="day4"></div>
								<div id="t_day12" class="day5"></div>
								<div id="t_day13" class="day6"></div>
								<div id="t_day14" class="day7"></div>
							</div>
							<div id="week3" class="week"><!-- 3주차 -->
								<div id="t_day15" class="day1"></div>
								<div id="t_day16" class="day2"></div>
								<div id="t_day17" class="day3"></div>
								<div id="t_day18" class="day4"></div>
								<div id="t_day19" class="day5"></div>
								<div id="t_day20" class="day6"></div>
								<div id="t_day21" class="day7"></div>
							</div>
							<div id="week4" class="week"><!-- 4주차 -->
								<div id="t_day22" class="day1"></div>
								<div id="t_day23" class="day2"></div>
								<div id="t_day24" class="day3"></div>
								<div id="t_day25" class="day4"></div>
								<div id="t_day26" class="day5"></div>
								<div id="t_day27" class="day6"></div>
								<div id="t_day28" class="day7"></div>
							</div>
							<div id="week5" class="week"><!-- 5주차 -->
								<div id="t_day29" class="day1"></div>
								<div id="t_day30" class="day2"></div>
								<div id="t_day31" class="day3"></div>
								<div id="t_day32" class="day4"></div>
								<div id="t_day33" class="day5"></div>
								<div id="t_day34" class="day6"></div>
								<div id="t_day35" class="day7"></div>
							</div>
							<div id="week6" class="week"><!-- 6주차 -->
								<div id="t_day36" class="day1"></div>
								<div id="t_day37" class="day2"></div>
								<div id="t_day38" class="day3"></div>
								<div id="t_day39" class="day4"></div>
								<div id="t_day40" class="day5"></div>
								<div id="t_day41" class="day6"></div>
								<div id="t_day42" class="day7"></div>
							</div>
							
						</div>

					</div>

					<div class="text-center">
						<img src="<?=IMG_DIR?>/service_center/check_btn.gif" class="pointer margin_top_40" onclick="<?user_check("javascript:attend_member();")?>">
					</div>

					<div class="padding_left_40 padding_top_140">
						<b class="font-size_26 color_fff">출석도장 찍고 인기지수+포인트+깜짝선물 받으세요!!</b>
						<p class="color_58daf6 margin_top_10 letter-spacing_mi1">도장을 찍을때마다 인기지수가 올라가서 마음에 드는 이성을 만날 수 있게 됩니다.</p>

						<div class="width_236 block margin_top_40">
							<div class="float_left">
							<img src="<?=IMG_DIR?>/service_center/check_icon_1.gif">
							</div>
							<div class="float_right width_158 margin_top_8">
								<b class="font-size_16 color_fff">매일 인기지수 5점</b>
								<p class="color_fff margin_top_10">출석도장을 찍을 때마다<br>매일 인기지수 5점 지급!!</p>
							</div>
							<div class="clear"></div>
						</div>

						<div class="width_236 block margin_top_40">
							<div class="float_left">
							<img src="<?=IMG_DIR?>/service_center/check_icon_2.gif">
							</div>
							<div class="float_right width_158 margin_top_8">
								<b class="font-size_16 color_fff">포인트 지급</b>
								<p class="color_fff margin_top_10">출석도장 찍으면<br>5포인트 지급!!</p>
							</div>
							<div class="clear"></div>
						</div>

						<div class="width_236 block margin_top_40">
							<div class="float_left">
							<img src="<?=IMG_DIR?>/service_center/check_icon_3.gif">
							</div>
							<div class="float_right width_158 margin_top_8">
								<b class="font-size_16 color_fff">깜짝선물 펑펑</b>
								<p class="color_fff margin_top_10">핑크도장 모두 출석하면<br>추첨을 통해 깜짝선물!!</p>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- ## board_content_end -->
		</div>

		<input type="button" class="text_btn_de4949 width_80 height_37 font-size_14 blod margin_top_10 float_right" value="목록" onclick="location.href='/service_center/event/ing_event'"/>
		<div class="clear"></div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>

