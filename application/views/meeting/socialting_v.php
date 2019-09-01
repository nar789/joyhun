<div class="content">

	<div class="left_main">
		
		<?=$call_top?>
		
		<div class="tab_content_top_area">
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
		<div class="list_area">
			<div class="meet_social_img" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
				
				<?=$this->member_lib->member_thumb($data['m_userid'],74,71)?>

			</div>		<!-- ## light_list_img end ## -->

			<div class="meet_social_textbox">
				<div class="width_120 block text_cut ver_top">
					<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333"><?=$data['m_nick']?></b>
				</div>
				<div class="width_150 block">
					<span class="color_666"><?=$data['m_conregion']?>&nbsp;<?=$data['m_conregion2']?> (<?=$data['m_age']?>세)</span>
				</div>
				<div class="block">
					<span class="color_999"><?=character_text($data['m_character'])?></span>
				</div>
				<div class="meet_social_textarea pointer" onclick="this.innerHTML=('<?=$data['m_content']?>');">	<!-- ## 길면 pointer 클래스 추가 -->
					<?=$data['m_content']?>
				</div>
			</div>
			<div class="meet_social_btnbox float_right">
				<div class="meet_social_ic_bg">
					<img src="<?=IMG_DIR?>/meeting/social_kakao<?if($data['m_kakao'] <> "") echo "_on";?>.png"><img src="<?=IMG_DIR?>/meeting/social_nate<?if($data['m_nateon'] <> "") echo "_on";?>.png"><img src="<?=IMG_DIR?>/meeting/social_cyworld<?if($data['m_cyworld'] <> "") echo "_on";?>.png"><img src="<?=IMG_DIR?>/meeting/social_facebook<?if($data['m_facebook'] <> "") echo "_on";?>.png"><img src="<?=IMG_DIR?>/meeting/social_twitter<?if($data['m_twitter'] <> "") echo "_on";?>.png"><img src="<?=IMG_DIR?>/meeting/social_me2day<?if($data['m_me2day'] <> "") echo "_on";?>.png">
				</div>
				<div class="margin_top_4 margin_left_2 width_267">
					
					<a href="javascript:show_socialting('<?=@$data['m_idx']?>', '<?=@$data['m_userid']?>');">
					<div class="text_btn_fe727b meet_social_fe727b_btn font_900">연락처 확인하기 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif"></div>
					</a>
					
					<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
						<span class="img_mail_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
						<span class="img_talk_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
						<span class="img_heart_btn"></span>
					</div>
				</div>
			</div>		<!-- ## light_list_btn end ## -->
		</div>		<!-- ## list_area end ## -->
		
		<?
				}
			}else{
			?>
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						소셜팅이 없습니다.<Br>
						소셜팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
			<?}?>

		



		<div class="list_footer height_0">
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