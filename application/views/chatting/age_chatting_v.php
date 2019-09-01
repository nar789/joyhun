<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

			<?php
			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
					// 테마list를 위한 랜덤 변수
					$list_msg = array("커플이 되고파요","문자팅을 원해요","함께 영화봐요","드라이브 해요","미팅을 원해요","결혼을 원해요","차 한잔해요","바다보러 가요","메일친구해요","스트레스 풀어요","콘서트 가요","함께 여행가요","함께 운동해요","대화상대 구해요","좋은친구 돼요");
					$rand_msg = rand(0,count($list_msg)-1);
			?>

				<div class="min_height_78 list_area">
					<div class="list_img2 margin_left_16" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
						<a href="#"><?=$this->member_lib->member_thumb($data['m_userid'],70,51)?></a>
					</div>		<!-- ## light_list_img end ## -->

					<img src="<?=IMG_DIR?>/chatting/chatting_on.gif" class="login_on">		<!-- 로그인상태 -->
					<!-- <img src="<?=IMG_DIR?>/chatting/chatting_off.gif" class="login_on"> -->				<!-- 로그아웃상태 -->

					<div class="onetr_list_first margin_left_6 width_150">
						<? if ($data['m_sex'] == 'F'){ ?><span class="color_f08a8e font_900">&#9794; </span><? }else{ ?><span class="color_8a98f0 font_900">&#9792; </span><? } ?><span class="color_333"><?=$data['m_userid']?> (<?=$data['m_age']?>세) </span>
					</div>

					<div class="onetr_list_two">
						<span class="color_333"><?=$data['m_conregion']?></span>
					</div>

					<div class="onetr_list_thr width_166 height_auto">
						<span class="color_333 break_all"><?=$list_msg[$rand_msg]?></span>
					</div>

					<div class="onetr_list_btn width_204 inline float_right">
						<div class="text_btn_fe727b onetr_chat_btn color_fff pointer" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
							채팅신청&nbsp;
							<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
						</div>
						<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
							<span class="img_mail_btn"></span>
						</div>
						<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
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
			<div class="list_area text-center">
				<div class="light_img_null padding_15">
					<img src="/images/meeting/light_null.gif">
					<div class="padding_10">
						검색에 해당하는 회원이 없습니다.
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?}?>






		<!-- ## 10개# # FOR END ## -->


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