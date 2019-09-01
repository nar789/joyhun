		<div class="margin_top_8 border_1_dcdcdc">
			<div class="secret_layer">
				<a href="/secret/talkchat/talk_list"><img src="<?=IMG_DIR?>/meeting/main_secret_banner.gif" class="margin_left_mi_1"></a>
				<div class="secret_layer_box height_256" id="meeting_slide_secret">

				<?
					// 1:1 우리끼리 비밀스럽게~
					if(!$right_secret = $this->cache->get('right_secret')){
							$right_secret =  sex_rand('8', 'TotalMembers', '*','m_userid', 'm_sex','last_login_day');
							$this->cache->save('right_secret', $right_secret, 600);	//10분 캐시 사용
					}

					foreach( $right_secret as $key => $val)
					{
				?>

					<div class="secret_box">
						<div class="secret_img_box">
							<? if($val['m_sex'] == "M"){?><img src="<?=IMG_DIR?>/secret_man.gif" class="margin_right_9">
							<? }else{ ?><img src="<?=IMG_DIR?>/secret_girl.gif" class="margin_right_9"><? } ?>
						</div>
						<div class="secret_content">
							<b><?=mb_level_profile($val['m_userid'])?><?=$val['m_nick']?>(<?=$val['m_age']?>)</b>
							<div><p class="width_145 text_cut"><?=talk_style_data($val['m_character'], $val['m_sex']);?> / <?=want_reason_data($val['m_reason']);?></p></div>
							<input type="button" class="text_btn_dcdcdc secret_content_btn" value="신청하기" onclick="<?user_check("chat_request('$val[m_userid]');");?>">
						</div>
					</div>

				<? } ?>

				</div>		<!-- ## secret_layer_box end ## -->
			</div>		<!-- ## secret_layer end ## -->
		</div>

	


<script>

var t = new js_rolling('meeting_slide_secret');
t.set_direction(1);
t.move_gap = 1;	//움직이는 픽셀단위
t.time_dealy = 60; //움직이는 타임딜레이
t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
t.start(); 

</script>