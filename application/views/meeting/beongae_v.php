<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_search?>

			<div class="tab_content_top_area">
				<div class="float_left">
					<p><span class="color_333"></span> 총 <span class="color_333"><?=number_format($getTotalData)?>건</span>의 번개팅이 등록되어있습니다.</p>
				</div>
				<div class="float_right">
					<ul>
						<li class="submenu_gender_<?=$sex_class1?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>',' ');"><a>전체</a></li>
						<li class="submenu_gender_<?=$sex_class2?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','F');"><a>여자</a></li>
						<li class="submenu_gender_<?=$sex_class3?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','M');"><a>남자</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>

			<?php

			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
			?>			
			<!-- ## for start ## -->
			<div class="list_area">
				<div class="light_list_img">
					<a href="#" onclick="<?user_check("view_profile('$data[b_userid]');");?>"><?=$this->member_lib->member_thumb($data['b_userid'],68,49)?></a>
				</div>		<!-- ## light_list_img end ## -->

				<div class="light_list_con margin_top_16">
					<div class="width_68 block">
						<b class="color_333 blod">지역 </b><span class="color_e93d3b blod"><?=$data['b_region']?></span>
					</div>
					<div class="width_109 block">
						<b class="color_333 blod">날짜 </b><span class="color_e93d3b blod"><?=str_replace("-",".",$data['b_day'])?></span>
					</div>
					<div class="width_98 block">
						<b class="color_333 blod">시간 </b><span class="color_e93d3b blod"><?=want_time_text($data['b_time'])?></span>
					</div>
					<div class="block">
						<b class="color_333 blod">관심사 </b><span class="color_e93d3b blod margin_right_25"><?=interest_text($data['b_interest'])?></span>
					</div>
					<div class="margin_top_8 color_999 padding_bottom_20 width_385 line-height_16 break_all">
					<?=$data['b_intro']?>
					</div>
				</div>
				<!-- ## light_list_con end ## -->
				<div class="light_list_btn float_right margin_left_0">
					
					<div class="text_btn_fe727b light_request" onclick="<?user_check("b_request('$data[idx]');");?>">번개팅요청 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif"></div>
					
					<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$data[b_userid]');");?>">
						<span class="img_mail_btn"></span>
					</div>
					<div class="icon_btn_bababa" onclick="javascript:send_message('<?=$data['b_userid']?>', 'send', '');">
						<span class="img_talk_btn"></span>
					</div>
					<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$data[b_userid]');");?>">
						<span class="img_heart_btn"></span>
					</div>
				</div>		<!-- ## light_list_btn end ## -->
				<div class="clear"></div>
			</div>
			<!-- ## for end ## -->
			<?
				}
			}else{
			?>
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						번개팅이 없습니다.<Br>
						번개팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
			<?}?>

			<div class="list_footer">
				<input type="button" class="text_btn_ea3e3e light_add_btn" onclick="go_top();" value="번개팅 등록하기">
			</div>

			<div class="list_pg">		<!-- ## 페이징 div ## -->
				<div>
					<?= $pagination_links?>
				</div>
			</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>