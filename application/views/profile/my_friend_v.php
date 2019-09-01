
<div class="content">

	<div class="left_main">
		
		<p class="font-size_18 color_333 blod">내 친구</p>

		<?=$call_tabmenu?>

		<?=$call_setting?>

		<ul class="profile_table margin_top_5">
			<? if ($style != '2'){ ?>
			<li class="text-center width_70 padding_left_37">사진</li>
			<li class="width_148 text-center">닉네임(나이)</li>
			<li class="width_103 text-center">접속지역</li>
			<li class="text-center width_256">메모</li>
			<? }else{ ?>
			<li class="text-center width_115 padding_left_17">사진</li>
			<li class="width_454 text-center">닉네임(나이)</li>
			<? } ?>

		</ul>

		<div id="tmp"><input type="hidden" id="success_val" name="success_val" value=""></div>			<!-- 데이터 결과값 찍어보는 용도 -->
		
		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
		<div class="min_height_72 border_bottom_1_ececec">
			<div class="float_left">
				<div class="block margin_left_6 margin_top_26 ver_top">
					<input type="checkbox" id="my_friend_<?=$data['m_idx']?>" name="f_chk" class="common_checkbox" value="<?=$data['m_idx']?>" user_id=
					'<?=$data['m_'.$f.'userid']?>'><label for="my_friend_<?=$data['m_idx']?>" class="common_checkbox_label"></label>
				</div>
				<div class="profile_chat width_82 pointer" onclick="<? if($f != ''){ user_check("view_profile('$data[m_fuserid]');"); }else{ user_check("view_profile('$data[m_userid]');"); }?>">

					<?=$this->member_lib->member_thumb($data['m_'.$f.'userid'], 68, 49)?>
				</div>

				<? if ($style != '2'){ ?>
					<div class="width_148 block margin_top_30 color_333 margin_left_6 ver_top">
						<?=$this->member_lib->s_symbol($data['m_'.$f.'sex'])?> <?=$data['m_'.$f.'nick']?> (<?=$data['m_'.$f.'age']?>세)
					</div>
					<div class="width_120 block margin_top_30 color_333 ver_top">
						<?=$data['m_'.$f.'conregion']?>&nbsp;<?=$data['m_'.$f.'conregion2']?>
					</div>
					<div class="width_180 block margin_top_30 color_333 padding_left_4 padding_bottom_20 break_all">
						<?=$data['m_content'];?>
					</div>
				<? }else{ ?>
				<div class="width_454 block margin_top_30 color_333 margin_left_6 ver_top text-center">
					<?=$this->member_lib->s_symbol($data['m_'.$f.'sex'])?> <?=$data['m_'.$f.'nick']?> (<?=$data['m_'.$f.'age']?>세)
				</div>
				<? } ?>

			</div>
			
			<div class="float_right margin_top_18">
				<div class="icon_btn_bababa" <? if ($f != ''){?>onclick="<?user_check("view_profile('$data[m_fuserid]');"); }else{?> onclick="<?user_check("view_profile('$data[m_userid]');"); } ?>">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa" <? if ($f != ''){?>onclick="javascript:send_message('<?=$data['m_fuserid']?>', 'send', '');"<?}else{?>onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');"<? } ?>>
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa" <? if ($f != ''){?>onclick="<?user_check("jjim_request('$data[m_fuserid]');"); }else{?> onclick="<?user_check("jjim_request('$data[m_userid]');"); } ?>">
					<span class="img_heart_btn"></span>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?
				}
			}else{
		?>

		<div class="list_area border_bottom_2_ececec">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div class="margin_top_5">
					등록한 친구가 없습니다.<Br>
					친구등록하고 친구소식을 바로바로 알아보세요.
				</div>
				<div class="clear"></div>
			</div>
		</div>		
		
		<?}?>

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>

	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->