<?$data['idx'] = 1;?>

<div class="content">

	<div class="left_main">
				
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_tabmenu2?>

		<form name="check_form" method="post">
		<div class="tab_content_top_area">
			<div class="float_left">
				<p>총 <span class="color_333"><?=number_format($getTotalData)?>건</span>의 애정촌 리스트가 등록되어 있습니다.</p>
			</div>
			<div class="clear"></div>
		</div>			<!-- ## meet_content_top_area end ## -->

		<?php
			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
		?>

		<div class="list_area">
			<div class="meet_social_img">
				<?=$this->member_lib->member_thumb($data['m_userid'],74,71)?>
			</div>

			<div class="meet_social_textbox <? if ($tab_mode == '2'){?>width_480<? }else{ ?>width_618<? } ?>">
				<div class="width_111 block">
					<?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333"><?=$data['m_nick']?></b>
				</div>
				<div class="width_111 block">
					<span class="color_666"><?=$data['m_conregion']?> (<?=$data['m_age']?>세)</span>
				</div>
				<div class="width_111 block">
					<span class="color_999">소심 | 순수 | 마름</span>
				</div>
				<div class="comment_box cmt_<?=$data['p_idx']?> <? if ($tab_mode == '2'){?>width_136<? }else{ ?>width_270<? } ?> text-right" onclick="javascript:sub_view('<?=$data['p_idx']?>', '<?=$data['m_userid']?>', '<?=$tab_mode?>');">
					<span>댓글</span> <em><?=$data['cnt']?></em>
					<div class="block comment_arrow" id="jjack_arrow_<?=$data['p_idx']?>"></div>
				</div>
				<div class="meet_social_textarea <? if ($tab_mode == '2'){?>width_480<? }else{ ?>width_618<? } ?> pointer" onclick="this.innerHTML='<?=$data['m_cmt']?>'">
					<?=$data['m_cmt']?>
				</div>
			</div>

			<? if ($tab_mode == '2'){?>

			<div class="meet_social_btnbox inline float_right width_132 margin_right_0">
				<div class="margin_top_4 margin_left_4 width_132">
					<div class="meet_social_fe727b_btn margin_top_11 display_block font_900">&nbsp;</div>
					
					<div class="icon_btn_bababa margin_top_3" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
						<span class="img_mail_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1 margin_top_3" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
						<span class="img_talk_btn"></span>
					</div>
					<div class="icon_btn_bababa margin_left_1 margin_top_3" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
						<span class="img_heart_btn"></span>
					</div>
				</div>
			</div>
			<!-- ## light_list_btn end ## -->
			<? } ?>

			<div class="clear"></div>
			<div class="width_620 margin_left_95">
				<div id="sub_view<?=$data['p_idx']?>" p_user_id="<?=$data['p_user_id']?>" p_idx="<?=$data['p_idx']?>" mode="<?=$tab_mode?>" class="comment_rep_box" style="width:100%;"><!-- ##댓글 --></div>
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
						<?=$page_name?> 짝대기 리스트가 없습니다.<Br>
						애정촌을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
		<?}?>

		<!-- ## 10개# # FOR END ## -->

		</form>


		<div class="list_footer">
			<input type="button" class="text_btn_ea3e3e sms_alladd_btn margin_top_10" value="애정촌 등록하기">
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