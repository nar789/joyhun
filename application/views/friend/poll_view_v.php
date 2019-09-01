<div class="content">

	<div class="left_main">

		<div class="poll_view_title">
			<div class="float_left">
			<p class="poll_title block">공감 <span class="poll_title2">POLL</span></p>
			<p class="block color_fff font-size_13 font_900 margin_left_10">미묘한 남녀의 심리 Poll 미팅에서 확인하세요!</p>
			</div>
			<div class="float_right">
				<input type="button" class="text_btn2_d2d2d2 width_132 margin_top_9" value="진행 Poll 전체보기" onclick="javascript:location.href='/friend/vote_poll'">
			</div>
			<div class="clear"></div>
		</div>

		<div class="poll_view_box">
			<img src="<?=IMG_DIR?>/friend/poll_text.gif" class="ver_bottom">
			<b class="font-size_16 color_333"><?=vote_title($m_code)?></b>

			<div class="poll_list_box">
				<img src="<?=IMG_DIR?>/friend/poll_badge.gif" class="ver_top">
				<div class="block chart_list">
					
					<?
						if(!@empty($mlist)){
							$i = "";		//순위변수
							foreach($mlist as $data){
								$i+=1;
					?>
					<div class="height_22">						
						<p class="color_ea3c3c font-size_13 width_36"><?=$i?>위</p><p class="<?if($i == "1"){ echo "color_19810f"; }else{ echo "color_333"; } ?> width_360"><?=vote_poll_view($m_code, $data['idx'])?></p>
						<div class="block ver_top margin_top_4">
							<div class="width_90 height_10 border_1_dcdcdc block">
								<div class="bg_79c471 height_10" style="width:<?=$data['per']?>%;"></div>	
							</div>
							<p class="poll_per_text"><?=$data['per']?>%</p>
						</div>
					<? if($data['userid'] == $this->session->userdata['m_userid']){ ?>
						<div class="text_btn_3f9f34 text-center line-height_18 width_88 height_18 blod block" onclick="javascript:poll_view_member('<?=$m_code?>', '<?=$data['idx']?>');">
							<img src="<?=IMG_DIR?>/friend/poll_check.png" class="margin_top_2 ver_top">&nbsp;참여완료
						</div>
					<? }else{ ?>
						<input type="button" class="text_btn_dcdcdc width_90 height_20 blod color_333" value="참여회원 확인" onclick="javascript:poll_view_member('<?=$m_code?>', '<?=$data['idx']?>');">
					<? } ?>
						
					</div>
					
					<?
							}
						}
					?>

				</div>
			</div>

			<div class="poll_detail_box" style="display:none;">
				<div>
					<div class="float_left">
						<img src="<?=IMG_DIR?>/friend/poll_text_2.gif" class="ver_bottom margin_right_9">
						<b class="font-size_16 color_333"><?=$sub_title['m_example'.$m_idx]?></b>
					</div>
					<div class="float_right color_666 margin_top_5">
						총 참여회원 : <?=$getTotalData?>명
					</div>
					<div class="clear"></div>
				</div>
				
				<?
					if($getTotalData > 0){
						foreach($slist as $data){
				?>

				<div class="poll_detail_list">
					<div class="width_113 text-center float_left">
						<?=$this->member_lib->s_symbol($data['m_sex'])?><span class="color_333"><?=$data['m_nick']?></span>
					</div>
					<div class="width_48 float_left"><?=$data['m_age']?>세</div>
					<div class="width_97 text_cut float_left"><?=$data['m_conregion']?> <?=$data['m_conregion2']?> <? if($data['m_conregion']=='' && $data['m_conregion']==''){echo "&nbsp;";}?></div>
					<div class="width_160"><?=want_reason_data($data['m_reason'])?></div>
					<div class="float_right">
						<div class="onetr_list_btn ver_auto">
							<div class="text_btn_fe727b onetr_chat_btn pointer" onclick="<?user_check("javascript:friend_request('$data[m_userid]');");?>">
								친구등록&nbsp;
								<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
							</div>
							<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("javascript:view_profile('$data[m_userid]');");?>">
								<span class="img_mail_btn"></span>
							</div>
							<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("javascript:chat_request('$data[m_userid]');");?>">
								<span class="img_talk_btn"></span>
							</div>
							<div class="icon_btn_bababa" onclick="<?user_check("javascript:jjim_request('$data[m_userid]');");?>">
								<span class="img_heart_btn"></span>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<?
						}
					}else{
				?>
				<div class="list_area">
					<div class="light_img_null">
						<img src="/images/meeting/light_null.gif">
						<div class="margin_top_5">
							공감POLL에 참여한회원이 없습니다.<br>
							투표에 참여하고 새로운 인연을 만나보세요! 
						</div>
						<div class="clear"></div>
					</div>		<!-- ## light_img_null end ## -->
				</div>
				<?
					}
				?>
				

				<div class="list_pg">		<!-- ## 페이징 div ## -->
					<div>
						<?=$pagination_links?>
					</div>
				</div>

			</div>

			<!-- <div class="text_btn_496946 poll_mb_view margin_auto" onclick="poll_detail_view();"> -->
			<div class="text_btn_496946 poll_mb_view margin_auto" onclick="poll_my_view('<?=$this->session->userdata['m_userid']?>','<?=$m_code?>');">
				<p class="font-size_14 block">참여회원 보기</p>&nbsp;<img src="<?=IMG_DIR?>/friend/yell_arrow_down.png" class="show_img">
			</div>

		</div>


		<div class="margin_top_30">

			<img src="<?=IMG_DIR?>/friend/poll_reply.gif" class="margin_right_8">
			<span class="ver_top color_333 font-size_16 blod margin_top_5 block"><?=$sub_title['m_sub_title']?></span>

		</div>

		<div class="reply_add_box">
			<input type="text" placeholder="기타의견 또는 나만의 의견을 자유롭게 작성해 보세요." id="m_reply" name="m_reply" maxlength="40">
			<input type="button" value="의견등록" onclick="javascript:reg_vote_reply('<?=$m_code?>');">
		</div>


		<div class="reply_list_area">

			<?
				if ($r_cnt > 0 ){
					foreach($r_result as $key => $data)
					{

			?>
			<div class="reply_list_box">
				<span class="block color_666 width_90" style="height:36px;"><?=$data['m_nick']?></span>
				<div class="block color_333 width_480" style="white-space:nowrap; text-overflow:ellipsis; overflow:hidden;" title="<?=$data['m_reply']?>"><?=$data['m_reply']?></div>
				<div class="block color_999"><?=date("Y-m-d", strtotime($data['m_write_day']))?></div>
				<? if($data['m_userid'] == $this->session->userdata['m_userid']){ ?>
				<div class="block">&nbsp;<input type="button" class="rep_del_btn margin_top_12" onclick="javascript:rp_del('<?=$m_code?>', '<?=$data['m_write_day']?>');"></div>
				<? } ?>
			</div>
			<?
					}
				}else{
			?>
			<div class="text-center">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif" class="ver_mid"><p class="block margin_left_19 color_999">아직 댓글이 없습니다. 나만의 의견을 등록해주세요.</p>
			</div>
			<?
				}
			?>

		</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>