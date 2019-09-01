		<div class="today_frame width_232">

			<div class="content_06_title">
				<p>Today's 토크</p>
				<a href="/etc/talk/talk_list"><img src="<?=IMG_DIR?>/add_btn.png"></a>
			</div>


			<div class="today_content c_ffffff width_215" id="top_slide">
				<?			
					if(!$right_today_talk = $this->cache->get('right_today_talk')){
							$right_today_talk =  sex_rand('16', 'T_JoyTalk', '*','t_id', 't_sex', 't_write','','',array('t_write' => 'INTERVAL -3 DAY'));
							$this->cache->save('right_today_talk', $right_today_talk, 600);	//10분 캐시 사용
					}

					foreach($right_today_talk  as $key => $val)
					{
				?>
				<div class="today_list">
					<div class="today_img pointer" onclick="<?user_check("view_profile('$val[t_id]');");?>"><?=$this->member_lib->member_thumb($val['t_id'],40,40)?></div>
					<div class="today_talk_box">
						<div class="today_id"><?=$val['m_nick']?></div>
						<div>
							<div class="comment" style="position:inherit">
								<div class="chat"><p>
									<?
										echo eregi_replace("([0-9]+)([0-9\-]+)([0-9])", "010-****-****", $val['t_context']); 
									?>
								</p></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<? } ?>
				<div class="today_list">
				</div>
			</div>


		</div>		<!-- ## today_frame end ## -->


<script>
var t = new js_rolling('top_slide');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 40; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start();
</script>