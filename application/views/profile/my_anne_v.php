
<div class="content">

	<div class="left_main">
		
		<p class="font-size_18 color_333 blod">내 앤</p>

		<?=$call_tabmenu?>

		<?=$call_setting?>

		<ul class="profile_table margin_top_5">
			<li class="color_333 blod line-height_40 block text-center width_120">사진</li>
			<li class="color_333 blod line-height_40 block padding_left_20 width_142">아이디(나이)</li>		
			<li class="color_333 blod line-height_40 block padding_left_9 width_122">접속지역</li>
			<? if ($style != '2'){  // 나를 등록한사람의 메모는 보이지않음 ?>	
			<li class="color_333 blod line-height_40 block padding_left_25">메모</li>
			<? } ?>
		</ul>

		<div id="tmp"><input type="hidden" id="success_val" name="success_val" value=""></div>			<!-- 데이터 결과값 찍어보는 용도 -->
		
		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
		
		<div class="min_height_72 border_bottom_1_ececec">
			<div class="float_left">
				<div class="block margin_left_6 <? if ($style == '2'){?>margin_top_30<?}?>">
					<input type="checkbox" id="marry_img_confirm_<?=$data['m_idx']?>" name="chk_anne" class="common_checkbox" m_userid = '<?=$data['m_userid']?>' value="<?=$data['m_idx']?>"><label for="marry_img_confirm_<?=$data['m_idx']?>" class="common_checkbox_label"></label>
				</div>
				<div class="profile_chat width_82 pointer" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($data['m_userid'], 68, 49)?>
				</div>
				<div class="width_148 block margin_top_30 color_333 margin_left_6 ver_top">
					<?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_userid']?> (<?=$data['m_age']?>세)
				</div>
				<div class="width_120 block margin_top_30 color_333 ver_top">
					<?=$data['m_conregion']?> <?=$data['m_conregion2']?>
				</div>

				<? if ($style != '2'){  // 나를 등록한사람의 메모는 보이지않음 ?>
				<div class="width_180 block margin_top_30 color_333 padding_left_4 padding_bottom_20 break_all">
					<?=$data['m_'.$f.'content']?>
				</div>
				<? } ?>
			</div>
			
			<div class="float_right margin_top_18">
				<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
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
				<div>
					등록한 앤이 없습니다.<Br>
					앤등록하고 더욱 더 가까워져 보세요~
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>



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