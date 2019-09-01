<div class="content">

	<div class="left_main">
		
		<?=$call_top?>
		<div class="padding_top_38">
			<?=$top_text?>
		</div>
		<div class="margin_top_19"></div>

		<?=$call_tabmenu?>

		<div class="height_0 tab_content_top_area margin_top_10">
		</div>			<!-- ## tab_content_top_area end ## -->

		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>

		<div class="min_height_78 list_area">
			<div class="list_img2 margin_left_16" >
				<a onclick="<?user_check("view_profile('$data[m_userid]');");?>" class="pointer">
					<?=$this->member_lib->member_thumb($data['m_userid'],70,51)?>
				</a>
			</div>		<!-- ## light_list_img end ## -->

			<div class="onetr_list_first text_cut">
				<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><span class="color_333"><?=$data['m_nick']?> (<?=$data['m_age']?>세) </span>
			</div>

			<div class="onetr_list_two">
				<span class="color_333"><?=$data['m_conregion']?></span>
			</div>

			<div class="onetr_list_thr height_auto" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden;" title="<?=$data['my_intro']?>">
				<span class="color_333 break_all"><?=$data['my_intro']?></span>
			</div>

			<div class="onetr_list_btn width_204 inline float_right">
				<div class="text_btn_fe727b onetr_chat_btn color_fff pointer" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
					채팅신청&nbsp;
					<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
					<span class="img_heart_btn"></span>
				</div>
			</div>
		</div>		<!-- ## list_area end ## -->

		<?
				}
			}else{
		?>
		<!-- 검색결과가 없을경우 -->
		<div class="list_area">
			<div class="light_img_null">
				<img src="/images/meeting/light_null.gif">
				<div class="margin_top_5">
					검색된 회원이 없습니다.<Br>
					검색 조건을 다시 체크 하시기 바랍니다. 
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>



		<div class="list_footer height_0 padding_0">
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