		<div class="age_area">
		
			<div class="age_title_box">
				<div class="float_left">
					<p><span class="color_ff1c24 font-size_14">나이별</span> 접속회원</p>
				</div>
				<div class="float_right">
					<a href="#"><img src="<?=IMG_DIR?>/add_btn.png" class="margin_bottom_mi_2"></a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="age_menu_box">
				<ul class="age_tabs">
					<li class="age_on pointer" rel="tab_1">20대</li>
					<li class="pointer" rel="tab_2">30대</li>
					<li class="pointer" rel="tab_3">40대 이상</li>
					<li class="clear"></li>
				</ul>
			</div>

			<div class="age_tab_con" id="tab_1">
	
				<div class="age_con_box mCustomScrollbar">
					<div class="age_con_list_box">

				<?
						if(!$right_age_login_20 = $this->cache->get('right_age_login_20')){
								$right_age_login_20 = sex_rand('20', 'TotalMembers_login', '*','m_userid', 'TotalMembers_login.m_sex','last_login_day',array('TotalMembers_login.m_age2' => '2'));
								$this->cache->save('right_age_login_20', $right_age_login_20, 600);	//10분 캐시 사용
						}

					// 나이별 접속회원 * 20대 *
					foreach( $right_age_login_20 as $key => $val)
					{
				?>
						<!-- for start -->
						<div class="age_list_box">
							<div class="float_left">
								<? if ($val['m_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif" class="float_left">
								<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif" class="float_left"><? } ?><a href="#" class="color_666"><?=$val['m_nick']?></a>
							</div>
							<div class="float_right margin_right_8">
								<img src="<?=IMG_DIR?>/newic_1.png" class="pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_2.gif" class="pointer" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_3.gif" class="pointer" onclick="<?user_check("jjim_request('$val[m_userid]');");?>">
							</div>
							<div class="clear"></div>
						</div>
						<!-- for end -->

				<? } ?>

					</div>		<!-- ## age_con_list_box end ## -->
				</div>		<!-- ## age_con_box end ## -->
			</div>		<!-- ## age_tab_con end ## -->


			<div class="age_tab_con" id="tab_2">
				<div class="age_con_box mCustomScrollbar">
					<div class="age_con_list_box">

				<?
						if(!$right_age_login_30 = $this->cache->get('right_age_login_30')){
								$right_age_login_30 = sex_rand('20', 'TotalMembers_login', '*','m_userid', 'TotalMembers_login.m_sex','last_login_day',array('TotalMembers_login.m_age2' => '3'));
								$this->cache->save('right_age_login_30', $right_age_login_30, 600);	//10분 캐시 사용
						}

					// 나이별 접속회원 * 30대 *
					foreach( $right_age_login_30 as $key => $val)
					{
				?>
						<!-- for start -->
						<div class="age_list_box">
							<div class="float_left">
								<? if ($val['m_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif" class="float_left">
								<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif" class="float_left"><? } ?><a href="#" class="color_666"><?=$val['m_nick']?></a>
							</div>
							<div class="float_right margin_right_8">
								<img src="<?=IMG_DIR?>/newic_1.png" class="pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_2.gif" class="pointer" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_3.gif" class="pointer" onclick="<?user_check("jjim_request('$val[m_userid]');");?>">
							</div>
							<div class="clear"></div>
						</div>
						<!-- for end -->

				<? } ?>
					</div>		<!-- ## age_con_box end ## -->
				</div>		<!-- ## age_con_list_box end ## -->
			</div>		<!-- ## age_tab_con end ## -->


			<div class="age_tab_con" id="tab_3">
				<div class="age_con_box mCustomScrollbar">
					<div class="age_con_list_box">
				<?
						if(!$right_age_login_40 = $this->cache->get('right_age_login_40')){
								$right_age_login_40 = sex_rand('20', 'TotalMembers_login', '*','m_userid', 'TotalMembers_login.m_sex','last_login_day',array('ex_m_age2' => 'TotalMembers_login.m_age2 >= 4'));
								$this->cache->save('right_age_login_40', $right_age_login_40, 600);	//10분 캐시 사용
						}

					// 나이별 접속회원 * 40대이상 *
					foreach( $right_age_login_40 as $key => $val)
					{
				?>
						<!-- for start -->
						<div class="age_list_box">
							<div class="float_left">
								<? if ($val['m_sex'] == 'M'){ ?><img src="<?=IMG_DIR?>/man_ic.gif" class="float_left">
								<? }else{ ?><img src="<?=IMG_DIR?>/girl_ic.gif" class="float_left"><? } ?><a href="#" class="color_666"><?=$val['m_nick']?></a>
							</div>
							<div class="float_right margin_right_8">
								<img src="<?=IMG_DIR?>/newic_1.png" class="pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_2.gif" class="pointer" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
								<img src="<?=IMG_DIR?>/newic_3.gif" class="pointer" onclick="<?user_check("jjim_request('$val[m_userid]');");?>">
							</div>
							<div class="clear"></div>
						</div>
						<!-- for end -->

				<? } ?>
					</div>		<!-- ## age_con_list_box end ## -->
				</div>		<!-- ## age_con_box end ## -->
			</div>		<!-- ## age_tab_con end ## -->

		</div>