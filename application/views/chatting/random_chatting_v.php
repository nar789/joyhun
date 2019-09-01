<div class="content">

	<div class="left_main">
		

		<img src="<?=IMG_DIR?>/chatting/chat_sub5_topimg1.jpg" class="border_1_dcdcdc" usemap="#chat_sub4_img1">
		<map name="chat_sub4_img1">
			<area shape="poly" coords="230,288,488,288,501,293,510,302,516,319,510,337,501,345,487,350,229,350,216,345,206,336,201,319,206,302,215,294," href="#">
		</map>
		
		
		
		
		<div class="tab_content_top_area">
			<div class="float_left">
				<p class="color_333 font-size_16 blod margin_0">최근 접속회원</p>
			</div>
		</div>

<? for ($i=0; $i < 6; $i++) { ?>
		<div class="min_height_82 list_area">
			<div class="list_img2 margin_left_16" >
				<a href="#">
					<div class="man_icon" style="width:70px; height:51px;">
						<img src="<?=IMG_DIR?>/meeting/man_ic.png" class="img_none_icon">
					</div>
				</a>
			</div>		<!-- ## light_list_img end ## -->

			<div class="onetr_list_first">
				<span class="color_8a98f0 font_900">&#9794; </span><span class="color_333">jjsdflskdnng (31세) </span>
			</div>

			<div class="onetr_list_two">
				<span class="color_333">서울</span>
			</div>

			<div class="onetr_list_thr height_auto">
				<span class="color_333 break_all">좋은친구를 찾습니다.</span>
			</div>

			<div class="onetr_list_btn inline float_right">
				<div class="text_btn_fe727b onetr_chat_btn">
					<a href="#">채팅신청&nbsp;</a>
					<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
				<div class="icon_btn_bababa margin_left_1">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa margin_left_1">
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa">
					<span class="img_heart_btn"></span>
				</div>
			</div>
		</div>		<!-- ## list_area end ## -->
<?  } ?>
		
		
		<div class="list_footer padding_0 height_40">
		</div>
		
		
		
		
		
		
		<img src="<?=IMG_DIR?>/chatting/chat_sub5_topimg2.gif" class="border_1_dcdcdc" usemap="#chat_sub4_img2">
		<map name="chat_sub4_img2">
			<area shape="rect" coords="191,120,338,158" href="#">
		</map>



	</div>		<!-- ## LEFT_MAIN END ## -->


	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>