<img src="<?=IMG_DIR?>/m/event_ch_top.gif" class="width_100per event_posit">


<div class="width_85per margin_auto">
	<div class="event_stam_text">
		<p>인기지수+포인트+깜짝선물</p>
		<div class="event_stam_box">
			<p>출석도장 찍고 조이헌팅 <span>포인트</span> 받으세요!</p>
		</div>
		<span>기간 : <?=$m_start_day?>~<?=$m_end_day?></span>
	</div>
</div>


<div style="background:#fdfcfa;">
	<div class="width_95per margin_auto">

		<div class="stam_title">
			<p>출석도장 찍고 <b>다양하고 푸짐한 혜택 받아가세요</b></p>
			
			<img src="<?=IMG_DIR?>/m/event_cate_1.gif"><span>&nbsp;핑크도장 출석 완성한 고객</span>
			<img src="<?=IMG_DIR?>/m/event_cate_2.gif"><span>&nbsp;<?=$m_lottery_day?></span>
			
			<div style="margin:0 auto;width:100%;margin-top:20px;">
				<div style="border:solid 0px red; position:relative; width:100%;">
					<img src="<?=IMG_DIR?>/m/event_cal_tit.png" style="width:100%;" id="calendar_tit">
					<img src="<?=IMG_DIR?>/m/event_cal.png" style="width:100%;" id="calendar">

					<div class="calendar">
						<div class="week1">
							<div id="t_day1" class="day1"></div>
							<div id="t_day2" class="day2"></div>
							<div id="t_day3" class="day3"></div>
							<div id="t_day4" class="day4"></div>
							<div id="t_day5" class="day5"></div>
							<div id="t_day6" class="day6"></div>
							<div id="t_day7" class="day7"></div>
						</div>
						<div class="week2">
							<div id="t_day8" class="day1"></div>
							<div id="t_day9" class="day2"></div>
							<div id="t_day10" class="day3"></div>
							<div id="t_day11" class="day4"></div>
							<div id="t_day12" class="day5"></div>
							<div id="t_day13" class="day6"></div>
							<div id="t_day14" class="day7"></div>
						</div>
						<div class="week3">
							<div id="t_day15" class="day1"></div>
							<div id="t_day16" class="day2"></div>
							<div id="t_day17" class="day3"></div>
							<div id="t_day18" class="day4"></div>
							<div id="t_day19" class="day5"></div>
							<div id="t_day20" class="day6"></div>
							<div id="t_day21" class="day7"></div>
						</div>
						<div class="week4">
							<div id="t_day22" class="day1"></div>
							<div id="t_day23" class="day2"></div>
							<div id="t_day24" class="day3"></div>
							<div id="t_day25" class="day4"></div>
							<div id="t_day26" class="day5"></div>
							<div id="t_day27" class="day6"></div>
							<div id="t_day28" class="day7"></div>
						</div>
						<div class="week5">
							<div id="t_day29" class="day1"></div>
							<div id="t_day30" class="day2"></div>
							<div id="t_day31" class="day3"></div>
							<div id="t_day32" class="day4"></div>
							<div id="t_day33" class="day5"></div>
							<div id="t_day34" class="day6"></div>
							<div id="t_day35" class="day7"></div>
						</div>
						<div class="week6">
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
			</div>
			

			<div class="text-center padding_top_10 padding_bottom_20">
				<img src="<?=IMG_DIR?>/m/event_ch_btn.gif" onclick="<?user_check("javascript:attend_member();")?>">
			</div>
		</div>


	</div>

</div>


<img src="<?=IMG_DIR?>/m/ch_bottom.gif" class="width_100per">
<!--img src="<?=IMG_DIR?>/m/event_ch_bottom.gif" class="width_100per"-->

<style>

.gray_stamp { border:5px solid #e0e0e0; color:#aeaeae; }
.pink_stamp { border:5px solid #ffcdc4; color:#ffb3a5; }

.calendar{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week1{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week2{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week3{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week4{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week5{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.week6{border:solid 0px red; position:absolute; width:100%; top:0%; left:0%;}
.day1, .day2, .day3, .day4, .day5, .day6, .day7{border:solid 0px red; position:absolute; top:0%; left:0%;}


.day1 > div, .day2 > div, .day3 > div, .day4 > div, .day5 > div, .day6 > div, .day7 > div{

	position:relative;
	border-radius:60px;
	width:70%;
	height:70%;
	text-align:center;
	line-height:40px;
	font-size:14px;
	font-weight:bold;
	display:inline-block;
	vertical-align:top;
	margin-top:6%;
	margin-left:6%;
}
</style>