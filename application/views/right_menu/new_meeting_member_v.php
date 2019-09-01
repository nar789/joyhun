		<div class="new_met_area">
		
			<div class="new_met_title_box">
				<div class="float_left">
					<p><span class="color_ff1c24 font-size_14">신규미팅</span> 신청자</p>
				</div>
				<div style="float:right">
					<a href="#"><img src="<?=IMG_DIR?>/add_btn.png" class="margin_bottom_mi_2"></a>
				</div>
				<div class="clear"></div>
			</div>
		



			<div class="mCustomScrollbar new_met_con_box">

				<div style="width:200px;">
				<?
					if(!$right_new_meet_member = $this->cache->get('right_new_meet_member')){
							$right_new_meet_member = new_meet_member();
							$this->cache->save('right_new_meet_member', $right_new_meet_member, 600);	//10분 캐시 사용
					}

					// 신규미팅 신청자
					foreach( $right_new_meet_member as $key => $val)
					{
				?>
					<!-- for start -->
					<div class="new_met_content_box">
						<div class="float_left">
								<? if (@$val['m_sex'] == 'M' || @$val['b_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif"><? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif"><? } ?><a href="#" class="color_666"><?=$val['m_nick']?></a>
						</div>
						<div class="float_right margin_right_8">
							<a href="#"><img src="<?=IMG_DIR?>/newic_1.png" onclick="<?user_check("view_profile('$val[m_userid]');");?>"></a><a href="#"><img src="<?=IMG_DIR?>/newic_2.gif" onclick="<?user_check("chat_request('$val[m_userid]');");?>"></a><a href="#"><img src="<?=IMG_DIR?>/newic_3.gif" onclick="<?user_check("jjim_request('$val[m_userid]');");?>"></a>
						</div>
						<div class="clear"></div>
					</div>
					<!-- for end -->
				<?
					}
				?>
				</div>
			</div>		<!-- ## mCustomScrollbar new_met_con_box end ## -->		
		</div>		<!-- ## new_met_area end ## -->