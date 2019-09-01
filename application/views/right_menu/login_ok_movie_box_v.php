		<div class="border_1_dcdcdc height_202">
			<div class="login_toparea">
				
				<div class="login_top_box width_auto">
				
					<div class="member_img_box">
						<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),40,40)?><img src="<?=IMG_DIR?>/login_img.png" class="member_img_bg" usemap="#login_img">
						<map name="login_img">
							<area shape="rect" coords="23,26,42,42" href="#">
						</map>
					</div>
					<div class="member_info">
						<a href="#"><span><?=$login_user_nick?>님</span></a>
						<p>경기 / <span class="color_f08a8e blod">&#9792</span>29세</p>

						<!--
						여: class = color_f08a8e, code = &#9792;
						남: class = color_8a98f0, code = &#9794;
						-->
					</div>
					<div class="clear"></div>
				
				</div>

			</div>

			<div class="login_menu">
			
				<div class="login_menu_box width_auto">
					<img src="<?=IMG_DIR?>/new_bage.png">
					<a href="#"><img src="<?=IMG_DIR?>/login_menu1.gif" class="margin_left_9"></a>
					<a href="/message/lists/r/"><img src="<?=IMG_DIR?>/login_menu3.gif" class="margin_left_9"></a>
					<a href="#"><img src="<?=IMG_DIR?>/login_menu4.gif" class="margin_left_9"></a>
					<a href="#"><img src="<?=IMG_DIR?>/login_menu5.gif" class="margin_left_9"></a>
				</div>

			</div>

			<div class="bg_f2f2f2 height_91">
			
				<div class="login_bottom_box width_auto">
					<div class="float_left">
						<span>방문</span><img src="<?=IMG_DIR?>/arow.gif">
						<p>오늘 <span style="color:#ea3c3c">0</span>명 / 총 <span class="color_ea3c3c">40</span>명</p>
					</div>
					<div class="clear"></div>
					<input type="button" class="text_btn_de4949 log_btn_2 width_160 margin_top_16" value="내 관람내역 보기" onclick="<?user_check("movie_request('ttestest');");?>"/>
				</div>		<!-- ## login_bottom_box end ## -->
			</div>		<!-- ## login_bottom_area end ## -->
		</div>		<!-- ## login_be_box end ## -->