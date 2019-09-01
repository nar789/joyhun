		<div class="smsting_member_box">
			<img src="<?=IMG_DIR?>/meeting/sms_right_badge.gif" class="smsting_badge">
			<div class="height_43">
				<p class="smsting_title">문자팅회원</p>
				<a href="#"><img src="<?=IMG_DIR?>/meeting/add_btn2.gif" class="smsting_add_btn"></a>
			</div>
			<div class="smsting_list_box width_210">
				<ul class="smsting_member_list c_ffffff width_215" id="sms_rolling">
				<?
					$array_nick = "";
					// 추천 문자팅 회원

					if(!$right_msg_ting = $this->cache->get('right_msg_ting')){
							$right_msg_ting = sex_rand('10', 'T_JoyHunting_MsgTing', '*','m_userid', 'T_JoyHunting_MsgTing.m_sex','m_update',array('ex_m_file' => 'TotalMembers.m_filename IS NOT NULL','ex_m_file2' => 'TotalMembers.m_filename != ""'));
							$this->cache->save('right_msg_ting', $right_msg_ting, 600);	//10분 캐시 사용
					}

					foreach( $right_msg_ting as $key => $val)
					{
						if(empty($array_nick)){ $array_nick = $val['m_nick']; }else{ $array_nick .= '|'.$val['m_nick']; }
						

				?>
					<li class="width_215 height_80">
						<div class="block smsting_img">
							<div><?=$this->member_lib->member_thumb($val['m_userid'],70,60)?></div>
						</div>
						<div class="width_115 block ver_top">
							<div class="height_38">
								<p class="color_333 font-size_12"><b class="color_f08a8e font_900">&#9792;</b><?=$val['m_nick']?>(<?=$val['m_age']?>) </p>
								<p class="color_999 font-size_12 margin_top_4"><?=$val['m_conregion']?>/<?=$val['m_conregion2']?></p>
							</div>
							<input type="button" class="text_btn_dcdcdc width_115 meeting_sms_list_btn" value="받는사람 추가하기" onclick="sms_phone_btn_add('<?=$val['m_nick']?>','<?=$val['m_userid']?>');">
						</div>
						<div class="clear"></div>
					</li>
				<? } ?>
				</ul>
			</div>
			<div class="text-center margin_top_10">
				<input type="button" class="text_btn2_ea3e3e sms_member_btn" value="10명 모두 추가하기" onclick="sms_ten_add('<?=$array_nick?>');">
			</div>
		</div>


<script>
var a = new js_rolling('sms_rolling');
a.set_direction(1);
a.move_gap = 2;	//움직이는 픽셀단위
a.time_dealy = 70; //움직이는 타임딜레이
a.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
a.start();
</script>