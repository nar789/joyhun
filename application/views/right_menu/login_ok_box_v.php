		<div class="login_be_box">
			<div class="login_toparea">
				
				<div class="login_top_box">
				
					<div class="member_img_box">
						<div>
							<?=$this->member_lib->member_thumb($login_user_id,40,40)?><img src="<?=IMG_DIR?>/login_img.png" class="member_img_bg" usemap="#login_img">
						</div>
						<map name="login_img">
							<area shape="rect" coords="23,26,42,42" href="/profile/my_info">
						</map>
					</div>
					<div class="member_info">
						<a href="/profile/my_info"><span><?=$login_user_nick?>님</span></a>
						<p><?=$this->session->userdata('m_conregion')?> / <?=$this->member_lib->s_symbol($login_user_sex)?> <?=$login_user_age?>세</p>
					</div>
					<div class="login_btn_box">
						<input type="button" id="logout_btn" value="로그아웃" />
					</div>
					<div class="clear"></div>
				
				</div>

			</div>

			<div class="login_menu">
			
				<div class="login_menu_box">
					
					<a href="/profile/point/point_list"><img src="<?=IMG_DIR?>/login_menu1.gif" class="margin_left_6"></a>
					<?=$new_icon1?>
					<a href="<?=$n_img_url1?>"><img src="<?=IMG_DIR?>/login_menu2.gif" class="margin_left_6"></a>
					
					<a href="/profile/main/user"><img src="<?=IMG_DIR?>/login_menu3.gif" class="margin_left_6"></a>
					<?=$new_icon2?>
					<a href="<?=$n_img_url2?>"><img src="<?=IMG_DIR?>/login_menu4.gif" class="margin_left_6"></a>
					<?=$new_icon3?>
					<a href="<?=$n_img_url3?>"><img src="<?=IMG_DIR?>/login_menu5.gif" class="margin_left_6"></a>
				</div>

			</div>
			<div class="login_bottom_area">
				<div class="login_bottom_box">

					<div class="float_left">
						<span>방문</span><img src="<?=IMG_DIR?>/arow.gif">
						<p>오늘 <span style="color:#ea3c3c"><?=profile_visit($login_user_id,TODAY)?></span>명 / 총 <span class="color_ea3c3c"><?=profile_visit($login_user_id)?></span>명</p>
					</div>
					<div class="float_right">
						<input type="button" value="확인" onclick="javascript:location.href='/profile/jjim/my_visitant'"/>
					</div>
					<div class="clear"></div>
					<div class="margin_top_13">
						<div class="log_btn_1 pointer" onclick="javascript:location.href='/profile/main/user'">내 프로필 가기</div>
						<div class="log_btn_1 pointer" onclick="javascript:location.href='/profile/my_info'">개인정보변경</div>
						<div class="clear"></div>
					</div>
					
					<? if($this->session->userdata('m_type') == 'F'){ ?>
						<input type="button" class="text_btn_de4949 log_btn_2" value="정회원 결제하기" onclick="javascript:location.href='/profile/point/point_charge'">
					<? }else{ ?>
						<input type="button" class="text_btn_de4949 log_btn_2" value="포인트 충전하기" onclick="javascript:location.href='/profile/point/charge_list'">
					<? } ?>
				</div>
			</div>
		</div>
