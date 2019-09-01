<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_tabmenu2?>

		<form name="check_form" method="post">
			<div class="tab_content_top_area ">
				<div class="float_right">
					<input type="button" class="text_btn_dcdcdc submenu_allchk_btn" onclick="check_all();" value="전체선택">
					<input type="button" class="text_btn_dcdcdc submenu_allchk_btn" onclick="sms_del('<?=$sms?>');" value="선택삭제">
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="meeting_msm_list">

		<?php

			if( $getTotalData > 0 )
			{

				$i = 0;
				foreach($mlist as $data)
				{

					if ($sms == 're'){		//받은문자

		?>		

				<div class="list_area">
					<div class="light_list_check margin_top_mi_5">
						<input type="checkbox" id="light_list_check_<?=$data['sms_idx']?>" value="<?=$data['sms_idx']?>" name="chk_sms"/>
						<label for="light_list_check_<?=$data['sms_idx']?>"></label>
					</div>
					<div class="list_img2" >
						<a href="/profile/main/user/user_id/<?=$data['s_userid']?>"><?=$this->member_lib->member_thumb($data['s_userid'],68,49)?></a>
					</div>
					<div class="width_471 light_list_con2 margin_top_16 ver_top">
						<b class="color_333 blod">날짜 </b><span class="color_e93d3b blod margin_right_25"><?=substr($data['sms_time'],0,10);?></span>
						<b class="color_333 blod">수신가능시간 </b>
						<span class="color_e93d3b blod margin_right_25">
							<?php if($data['m_receive_time'] == 'Y'){?>항상가능
							<?php }else{ $ex = explode("|",$data['m_receive_time']); echo $ex[0]; echo "시 ~ "; echo $ex[1]; echo "시"; } ?>
						</span>
						<b class="color_333 blod">관심사 </b><span class="color_e93d3b blod margin_right_25"><?=strcut_utf8(job_text($send_arr[$i]['m_job']),6)?> | <?=outstyle_text($send_arr[$i]['m_outstyle'])?> | <?=character_text($send_arr[$i]['m_character'])?></span>
						<div class="width_471 margin_top_8 color_999 padding_bottom_20"><?=$data['s_userid']?></div>
					</div>
					<div class="mybeongae_comment min_height_54 margin_left_154">
						<div class="width_480 block ver_top">
							<img src="<?=IMG_DIR?>/meeting/recv_meeting_arrow.gif" class="my_recv_comment_arrow"><p class="color_0036ff font-size_12 margin_top_8 my_comment_content break_all"><?=$data['sms_content']?></p>
						</div>
						<div class="mybeongae_recv_btn">
							<input type="button" class="text_btn_de4949 sms_mylist_btn" value="답장하기" onclick="sms_phone_btn_add('<?=$data['s_userid']?>');"/>
						</div>
					</div>
				</div>


		<?			}else{					//보낸문자 ?>

				<div class="list_area">
					<div class="light_list_check margin_top_mi_5">
						<input type="checkbox" id="light_list_check_<?=$data['sms_idx']?>" value="<?=$data['sms_idx']?>" name="chk_sms"/>
						<label for="light_list_check_<?=$data['sms_idx']?>"></label>
					</div>
					<div class="list_img2" >
						<a href="/profile/main/user/user_id/<?=$data['r_userid']?>"><?=$this->member_lib->member_thumb($data['r_userid'],68,49)?></a>
					</div>
					<div class="width_471 light_list_con2 margin_top_16 ver_top">
						<b class="color_333 blod">날짜 </b><span class="color_e93d3b blod margin_right_25"><?=substr($data['sms_time'],0,10);?></span>
						<b class="color_333 blod">수신가능시간 </b>
						<span class="color_e93d3b blod margin_right_25">
							<?php if($send_arr[$i]['m_receive_time'] == 'Y'){?>항상가능
							<?php }else{ $ex = explode("|",$send_arr[$i]['m_receive_time']); echo $ex[0]; echo "시 ~ "; echo $ex[1]; echo "시"; } ?>
						</span>
						<b class="color_333 blod">관심사 </b><span class="color_e93d3b blod margin_right_25"><?=strcut_utf8(job_text($send_arr[$i]['m_job']),6)?> | <?=outstyle_text($send_arr[$i]['m_outstyle'])?> | <?=character_text($send_arr[$i]['m_character'])?></span>
						<div class="width_471 margin_top_8 color_999 padding_bottom_20 blod"><?=$data['r_userid']?></div>
					</div>
					<div class="mybeongae_comment min_height_54 margin_left_154">
						<div class="width_480 block ver_top">
							<img src="<?=IMG_DIR?>/meeting/recv_meeting_arrow.gif" class="my_recv_comment_arrow"><p class="color_0036ff font-size_12 margin_top_8 my_comment_content break_all"><?=$data['sms_content']?></p>
						</div>
					</div>
					
				</div>
			<?	
					}

					$i++;
				}
			}else{
			?>
			<div class="list_area border_bottom_2_ececec">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						<?=$page_name?> 문자가 없습니다.<Br>
						상대방에게 문자를 보내고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>
			<?}?>

			</div>
		</form>

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