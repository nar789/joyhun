<div class="content">

	<div class="left_main">
		
		<p class="font-size_18 color_333 blod">내 프로필 방문자</p>
		

		<div class="margin_top_23">
			<span class="color_999">선택한 방문자를</span>
			<input type="button" class="text_btn_dcdcdc width_40 height_20 color_333 margin_left_2 blod" value="삭제" onclick="javascript:v_list_remove();"/>

		</div>

		<ul class="profile_table margin_top_5">
			<li class="text-center width_120">사진</li>
			<li class="padding_left_20 width_142">아이디(나이)</li>
			<li class="padding_left_9 width_100">접속지역</li>
			<li class="padding_left_25">원하는 만남</li>
		</ul>
		

		<?
			$i = 0;
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
		
		<div class="height_72 border_bottom_1_ececec">
			<div class="float_left">
				<div class="block margin_left_6 margin_top_30 ver_top">
					<input type="checkbox" id="my_friend_<?=$i?>" name="chk_visit" class="common_checkbox" value="<?=$data['idx']?>"><label for="my_friend_<?=$i?>" class="common_checkbox_label"></label>
				</div>
				<div class="profile_chat width_82">
					<?=$this->member_lib->member_thumb($data['m_userid'], 68, 49)?>
				</div>
				<div class="width_158 block margin_top_30 color_333 margin_left_6 ver_top">
					<?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_userid']?> (<?=$data['m_age']?>세)
				</div>
				<div class="width_100 block margin_top_30 color_333 ver_top">
					<?=$data['m_conregion']?> <?=$data['m_conregion2']?>
				</div>
				<div class="width_180 block margin_top_30 color_333 padding_left_4">
					<?=want_reason_data($data['m_reason'])?>
				</div>
				<!--
				<div class="visit_opacity font-size_14" onclick="alert('결제??');">
					상대방의 정보를 확인하고 싶으시면 클릭하세요!
				</div>
				-->
			</div>
			
			<div class="float_right margin_top_18">
				<div class="icon_btn_bababa" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div>
				<?
					//쪽지보내기 테스트용
					if(@$this->session->userdata['m_userid'] == "juicy1007"){
				?>
				<div class="icon_btn_bababa" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
					<span class="img_talk_btn"></span>
				</div>
				<? }else{ ?>
				<div class="icon_btn_bababa" onclick="javascript:push_massage();">
					<span class="img_talk_btn"></span>
				</div>
				<? } ?>

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
				<div class="margin_top_5">
					내 프로필을 방문한 사람이 없습니다.<Br>
					더욱더 활발한 활동을 통해 자신을 홍보해보세요.
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