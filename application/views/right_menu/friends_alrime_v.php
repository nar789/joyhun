			<div class="height_170">
				<div class="mylog_title_box margin_top_mi_12">
					<img src="<?=IMG_DIR?>/right_flo_2.png"><p class="color_69bc5e">친구접속 알리미</p>
				</div>
				<div class="mylog_content_box">

					<?
						if(!@empty($auto_friend_list)){
					?>
					<div class="mCustomScrollbar mylog_con">
						<?
							foreach($auto_friend_list as $data){
								if(!@empty($data['m_userid'])){
									$member_data = $this->member_lib->get_member($data['m_userid']);	//회원정보가져오기
								}								
						?>
						<a href="<?user_check("javascript:view_profile('$data[m_userid]');");?>"><p class="mylog_con_list"><?=@$member_data['m_nick']?></p></a>
						<?
							}
						?>
					</div>
					<?
						}else{
					?>
					<p class="mylog_null">접속중인 <span class="color_69bc5e">이성친구</span>를 <br> 지금 바로 확인하세요!</p>
					<?
						}
					?>
					<input type="button" class="text_btn2_d2d2d2 mylog_btn_2" value="접속친구 바로보기" onclick="javascript:location.href='/profile/my_friend/send_friend';">
				</div>		<!-- ## log_content_box end ## -->
			</div>
		</div>