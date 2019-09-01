<div class="content">

	<div class="left_main">
		
		<b style="font-size:18px;">인증사진</b>

		<?=$call_tabmenu?>

		<?=$call_search?>

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
		
		<?
			if($getTotalData > 0){ 
		?>
		<div class="gallery_list_area">
			
			<?
				foreach($mlist as $data){
			?>
			
			<div class="gall_list_content_box">
				<div class="pointer" onclick="<?user_check("view_profile('$data[m_userid]');");?>"><?=$this->member_lib->member_thumb($data['m_userid'], 143, 144)?></div>

				<div class="gall_text_box">

					<p class="gall_text_1 color_333"><?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_nick']?> (<?=$data['m_age']?>세)</p>
					<p class="gall_text_2 color_666"><?=$data['m_conregion']?> <?=$data['m_conregion2']?></p>
					<p class="gall_text_2 color_999 margin_top_14">인증일 <?=date('Y-m-d', strtotime($data['pic_admin_date']))?></p>
					<div class="margin_top_26">
						
						<div class="icon_btn_bababa margin_left_1" title="프로필 보기" onclick="<?user_check("javascript:view_profile('$data[m_userid]');");?>">
							<span class="img_mail_btn"></span>
						</div>
						<div class="icon_btn_bababa margin_left_1" title="메세지 보내기" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
							<span class="img_talk_btn"></span>
						</div>
						<div class="icon_btn_bababa" title="찜하기" onclick="<?user_check("javascript:jjim_request('$data[m_userid]');");?>">
							<span class="img_heart_btn"></span>
						</div>
					</div>
				</div>
			</div>
			<?
				}
			?>

		</div>	

		<?
			}else{
		?>
		<div class="list_area">
			<div class="light_img_null">
				<img src="/images/meeting/light_null.gif">
				<div class="margin_top_5">
					검색결과가 없습니다.<br>
					다른검색 조건으로 검색해 보세요.
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>



		<div class="list_footer padding_0 height_0">
		</div>
		

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
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
