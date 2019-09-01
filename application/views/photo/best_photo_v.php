<div class="content">

	<div class="left_main">
	
		<?=$call_top?>
		
		<div class="tab_content_top_area">
		</div>

		<div class="gallery_list_area">

			<?
				foreach($mlist as $data){
			?>			
			<div class="gall_list_content_box photo_list_thumb">
				
				<a href="#" onclick="<?user_check("view_profile('$data[m_userid]');");?>"><?=$this->member_lib->member_thumb($data['m_userid'], 143, 144)?></a>

				<div class="gall_text_box">
					
					<p class="best_gall_info"><?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_nick']?> (<?=$data['m_age']?>세)</p>
					<p class="color_666 font-size_12 height_24"><?=want_reason_data($data['m_reason'])?></p>

					<div class="margin_top_26">
				
						<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("javascript:view_profile('$data[m_userid]');");?>">
							<span class="img_mail_btn"></span>
						</div>
						<div class="icon_btn_bababa margin_left_1" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
							<span class="img_talk_btn"></span>
						</div>
						<div class="icon_btn_bababa" onclick="<?user_check("javascript:jjim_request('$data[m_userid]');");?>">
							<span class="img_heart_btn"></span>
						</div>
					</div>
				</div>
				<div class="best_st_bg"><?=$rank?></div>
			</div>
			<?
					$rank = $rank+1;
				}
			?>
		
		</div>		
		
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