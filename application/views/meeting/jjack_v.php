<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

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

			<div class="meet_social_textbox width_480">
				<div class="width_111 block">
					<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333"><?=$data['m_nick']?></b>
				</div>
				<div class="width_111 block">
					<span class="color_666"><?=$data['m_conregion']?> (<?=$data['m_age']?>세)</span>
				</div>
				<div class="width_111 block">
					<span class="color_999">소심 | 순수 | 마름</span>
				</div>
				<div class="meet_social_textarea width_480 pointer" onclick="this.innerHTML=('<?=$data['m_cmt']?>')">		<!-- ### 최대 3줄 공백포함 180 Byte 한글 90글자 ### -->
					<?=$data['m_cmt']?>
				</div>
				<!-- ## 글자가 길면 div class = 'pointer', onclick추가 ## -->
			</div>
			<div class="meet_social_btnbox inline float_right width_132 margin_right_0">
				<div class="margin_top_4 margin_left_4 width_132">
					<div class="text_btn_fe727b meet_social_fe727b_btn margin_top_11 display_block font_900" onclick="<?user_check("b_request('$data[m_idx]');");?>">
						짝대기 보내기 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
					</div>
					
					<div class="icon_btn_bababa margin_top_3" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
						<span class="img_mail_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1 margin_top_3" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
						<span class="img_talk_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1 margin_top_3" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
						<span class="img_heart_btn"></span>
					</div>
				</div>
			</div>
		</div>		<!-- ## list_area end ## -->
		<?
				}
			}else{
		?>
		<div class="list_area">
			<div class="light_img_null">
				<img src="/images/meeting/light_null.gif">
				<div class="margin_top_5">
					애정촌 리스트가 없습니다.<Br>
					애정촌을 등록하고 새로운 인연을 만나보세요! 
				</div>
				<div class="clear"></div>
			</div>		<!-- ## light_img_null end ## -->
		</div>
		<?}?>

		

		<!-- ## 10개# # FOR END ## -->



		<div class="list_footer">
			<input type="button" class="text_btn_ea3e3e sms_alladd_btn margin_top_10" onclick="go_top();" value="애정촌 등록하기">
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