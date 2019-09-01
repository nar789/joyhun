<div class="content">

	<div class="left_main">
		
		<div class="open_marry_top">
			<div class="padding_10">
				<div class="text-right">
					<input type="button" class="text_btn_aa72fe" value="결혼신청 등록하기" onclick="<?user_check("m_request();");?>"/>
				</div>
				<div class="marry_index_content">
					<div class="select_box_border">
						<select class="width_102 height_37" id="marry_type" name="marry_type">
							<option value="결혼" selected>결혼</option>
							<option value="재혼">재혼</option>	
						</select>
					</div>
					<div class="select_box_border margin_left_2">
						<select class="width_122 height_37" id="m_conregion" name="m_conregion">
							<option value="">원하는 지역</option>
							<option value="서울"> 서울 </option>
							<option value="경기"> 경기 </option>
							<option value="인천"> 인천 </option>
							<option value="강원"> 강원 </option>
							<option value="경남"> 경남 </option>
							<option value="부산"> 부산 </option>
							<option value="경북"> 경북 </option>
							<option value="대구"> 대구 </option>
							<option value="전북"> 전북 </option>
							<option value="전주"> 전주 </option>
							<option value="전남"> 전남 </option>
							<option value="광주"> 광주 </option>
							<option value="충북"> 충북 </option>
							<option value="청주"> 청주 </option>
							<option value="충남"> 충남 </option>
							<option value="대전"> 대전 </option>
							<option value="제주"> 제주 </option>
							<option value="울산"> 울산 </option>
							<option value="기타"> 기타 </option>
						</select>
					</div>
					<div class="select_box_border margin_left_2">
						<select class="width_122 height_37" id="m_age" name="m_age">
							<option value="">원하는 나이</option>
							<option value="0">상관없음</option>
							<option value="2024">20세~24세</option>
							<option value="2529">25세~29세</option>
							<option value="3034">30세~34세</option>
							<option value="3539">35세~39세</option>
							<option value="4044">40세~44세</option>
							<option value="4549">45세~49세</option>
							<option value="5054">50세~54세</option>
							<option value="5559">55세~59세</option>
							<option value="6099">60세이상</option>
						</select>
					</div>
					<div class="marry_index_bottom">
						<div class="float_left">
							<input type="checkbox" id="marry_img_confirm" class="common_checkbox"><label for="marry_img_confirm" class="common_checkbox_label"></label>
							<span class="color_666 ver_mid">사진인증 받은 회원</span>
						</div>
						<div class="float_right padding_right_44">
							<input type="button" class="text_btn2_ea3e3e width_87 height_37" value="회원검색하기" onclick="<?user_check("search_list('');");?>"/>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="float_left">
			<div class="margin_top_8 marry_search_box">
				<div class="marry_search_title">
					<span class="font-size_16 color_fff">결혼재혼</span>에서 평생을 함께할<br>내인연을 만나세요
				</div>
				<div class="padding_left_9 margin_top_1">
					<div class="marry_search_check margin_left_1"><input type="checkbox" id="marriage_chk" class="common_checkbox" value="결혼" checked><label for="marriage_chk" class="common_checkbox_label"></label><span class="color_666 ver_mid padding_left_6">결혼</span></div>
					<div class="marry_search_check margin_left_mi_2"><input type="checkbox" id="remarriage_chk" class="common_checkbox" value="재혼"><label for="remarriage_chk" class="common_checkbox_label"></label><span class="color_666 ver_mid padding_left_6">재혼</span></div>
				</div>
				
				<div class="marry_search_content">
					<div class="marry_search_list_title">
						<span class="color_ff5e00">추천지역</span>
						<div class="marry_recommend margin_top_4 margin_bottom_8">
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_area('서울');">서울</a>
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_area('대전');">대전</a>
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_area('부산');">부산</a>
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_area('경기');">경기</a>
							<a href="#" class="underline color_666" onclick="javascript:find_area('전남');">전남</a>
						</div>

						<span class="color_ff5e00">추천나이</span>
						<div class="marry_recommend margin_top_4 margin_bottom_8">
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_age('2');">20대</a>
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_age('3');">30대</a>
							<a href="#" class="underline margin_right_4 color_666" onclick="javascript:find_age('4');">40대</a>
							<a href="#" class="underline color_666" onclick="javascript:find_age('5');">50대</a>
						</div>

						<span class="color_ff5e00">추천직업</span>
						<div class="marry_recommend margin_top_4">
							<a href="#" class="underline margin_right_3 color_666" onclick="javascript:find_job('공무원');">공무원</a>
							<a href="#" class="underline margin_right_3 color_666" onclick="javascript:find_job('서비스업');">서비스업</a>
							<a href="#" class="underline margin_right_3 color_666" onclick="javascript:find_job('예술');">예술</a>
							<a href="#" class="underline color_666" onclick="javascript:find_job('의료');">의료</a>
						</div>
					</div>
				</div>
				<input type="button" class="text_btn_343433 width_174 height_20 margin_left_10" value="다른조건으로 검색" onclick="javascript:chk_url();"/>
			</div>
		</div>

		<div class="float_right">
			<div class=" margin_top_8">
				<div class="marry_today_bg">
					
					<? $today_jjim = $today['b_userid'];?>
					<div class="padding_left_20 height_38 line-height_38">
						<span class="font-size_18 color_ffff00 blod">TODAY <b class="color_fff font-size_18">매칭회원!</b></span> <b class="color_ffff00 padding_left_4"><?=date("n");?>월 <?=date("j");?>일</b><span class="color_fff"> 소개해드리는 추천회원입니다.</span>
					</div>
					<div class="float_left padding_top_15 padding_left_13"><a href="#"><?=$this->member_lib->member_thumb($today['b_userid'],92,112)?><a/></div>
					<div class="float_left margin_left_14 width_382 padding_top_16">
						<div class="float_left">
							<div><? if ( $today['b_type'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif">
							<? }else if ( $today['b_type'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif"><? } ?><span class="color_333 blod ver_top margin_left_5"><?=$today['b_nick']?></span></div>
							<div class="color_666 marry_today_info">
								<?=$this->member_lib->s_symbol($today['b_sex'])?> <?=$today['b_ageyear']?>년 (<?=$today['b_age']?>)<br>
								<?=trim_text(want_reason_data(@$today['m_reason']),24)?>
							</div>
							<div class="block width_150 ver_top">
								<p class="love_per_title">러브궁합도</p>
								<div class="love_per_frame">
									<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
										<div class="love_per_frame_box" style="width:<?=love_per($today['b_region'],'',$today['b_age'],$today['b_sex'])?>%;"></div>
									<? }else{ ?>
										<div class="love_per_frame_box" style="width:50%;"></div>
									<? } ?>
								</div>
								<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
									<p class="love_per_name"><?=love_per($today['b_region'],'',$today['b_age'],$today['b_sex'])?>%</p>
								<? }else{ ?>
									<p class="love_per_name">50%</p>
								<? } ?>
							</div>
						</div>
						<div class="float_right">
							<div class="icon_btn_bababa margin_top_14" onclick="<?user_check("jjim_request('$today_jjim');");?>">
								<span class="img_heart_btn"></span>
							</div>
							<input type="button" class="text_btn_ea3e3e margin_top_14" value="프로포즈" onclick="propose_reuqest('<?=$today['b_userid']?>', '<?=$today['b_type']?>');">						
						</div>
						<div class="clear"></div>
						<a href="open_marry/open_marry/open_guhon_list"><div class="marry_today_text"><?=$today['b_content']?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="margin_top_8 marry_update_text">
					<p class="color_666 margin_top_16 margin_bottom_10">내가 등록한 <b class="color_333 font-size_16">결혼&#38;재혼을 업데이트</b> 해주세요!</p>
					<img src="<?=IMG_DIR?>/open_marry/marry01_btn.gif" class="pointer" onclick="<?user_check('m_request();');?>">
					<img src="<?=IMG_DIR?>/open_marry/marry02_btn.gif" class="pointer" onclick="<?user_check('rem_request();');?>">
				</div>
			</div>
		</div>

		<div class="clear"></div>


		<div class="content_03">
			<img src="<?=IMG_DIR?>/open_love.gif">
			<div class="content_03_frame">

				<div class="content_03_title"> 
					<p class="content_03_titlep">신규 <span class="color_e74769 font-size_14">업데이트 회원</span></p>
					<img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>

				<div id="slider">
					<div class="content_03_leftbox">
						<a href="#" id="prev2" class="prev"><img src="<?=IMG_DIR?>/main_left_btn.png"></a>
					</div>
					
					<div class="slide-wrap">
						<ul id="photo" class="slide-list mt15">

				<?
					// 신규 업데이트 회원
					foreach( sex_rand('4', 'T_CoupleMarry_OpenguhonMan', '*', 'b_userid', 'b_sex', 'b_writedate',array("m_filename !=" => "null", "ex_file" => "m_filename != ''")) as $key => $val)
					{
				?>
							<li>
								<div class="con_03_content">
									<div class="float_left pointer" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
										<?=$this->member_lib->member_thumb($val['b_userid'],130,162)?>
									</div>

									<div class="con_03_top">
										<? if ( $val['b_type'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif" class="float_left margin_right_5">
										<? }else if ( $val['b_type'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif" class="float_left margin_right_5"><? } ?>
										<p class="con_03_top_title"><?=strcut_utf8($val['b_nick'],9)?></p>
										<p class="con_03_top_bir">
											<?=$this->member_lib->s_symbol($val['b_sex'])?> <?=$val['b_ageyear']?>년 (<?=$val['b_age']?>)
										</p>
										<p class="con_03_top_cate"><?=trim_text($val['b_content'],28)?></p>
									</div>

									<div class="love_per_box">
										<p class="love_per_title">러브궁합도</p>
										<div class="love_per_frame">
										<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
											<div class="love_per_frame_box" style="width:<?=love_per($val['b_region'],'',$val['b_age'],$val['b_sex'])?>%;"></div>
										<? }else{ ?>
											<div class="love_per_frame_box" style="width:50%;"></div>
										<? } ?>
										</div>
										<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
											<p class="love_per_name"><?=love_per($val['b_region'],'',$val['b_age'],$val['b_sex'])?>%</p>
										<? }else{ ?>
											<p class="love_per_name">50%</p>
										<? } ?>
										<div class="icon_btn_bababa margin_top_14" onclick="<?user_check("jjim_request('$val[b_userid]');");?>">
											<span class="img_heart_btn"></span>
										</div>
										<input type="button" class="text_btn_ea3e3e margin_top_14" value="프로포즈" onclick="propose_reuqest('<?=$val['b_userid']?>', '공개구혼');">
									</div>
								</div>
							</li>
				<? } ?>
						</ul>
					</div>		<!-- ## slide-wrap END ## -->

					<div class="content_03_righttbox">
						<a href="#" id="next2" class="next"><img src="<?=IMG_DIR?>/main_right_btn.png"></a>
					</div>
				</div>		<!-- ## slider END ## -->
			</div>		<!-- ## content_03_frame END ## -->

			<div class="content_03_frame">

				<div class="content_03_title">
					<p>매니저의 <span class="color_477ce7 font-size_14">추천 회원</span></p>
					<a href="/open_marry/open_marry/open_guhon_list"><img src="<?=IMG_DIR?>/add_btn.png"></a>
				</div>

				<div class="content_03_right_box">

				<? 
					// 매니저의 추천회원
					foreach($manager as $key => $val){
				?>
					<div class="content_03_right_list">
						<div class="content_03_right_img" onclick="<?user_check("view_profile('$val[m_userid]');");?>">
							<?=$this->member_lib->member_thumb($val['m_userid'],80,56)?>
						</div>
						<div class="con_03_text_box">
							<? if ( $val['b_type'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif" class="float_left margin_right_5">
							<? }else if ( $val['b_type'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif" class="float_left margin_right_5"><? } ?><p class="con_03_id"><?=$val['m_nick']?></p>
							<p class="con_03_con"><?=$this->member_lib->s_symbol($val['b_sex'])?><?=$val['m_age']?>세 / <?=trim_text($val['b_content'],18)?></p>
						</div>
						<input type="button" class="text_btn_ea3e3e margin_top_10" value="프로포즈" onclick="propose_reuqest('<?=$val['b_userid']?>', '공개구혼');">
					</div>

				<? } ?>
					<div class="clear"></div>
				</div>		<!-- ## content_03_right_box END -->

				<script type="text/javascript">fn_rollToEx('slider', 'photo');</script>

			</div>		<!-- ## content_03_frame END -->
		</div>		<!-- ## content_03 END -->

		<div class="new_ting margin_top_8 width_716 height_auto margin_left_0">
			<div class="new_ting_title_box">
				<div class="float_left">
					<p>업데이트된 결혼 &#38; 재혼 </p>
				</div>
				<div class="float_right">
					<a href="/open_marry/open_marry/open_guhon_list"><img src="<?=IMG_DIR?>/meeting/add_btn2.gif"></a>
				</div>
				<div class="clear"></div>
			</div>

			<div id="marray_slide" class="padding_0 height_275">


				<?
					// 업데이트된 결혼 & 재혼
					foreach( new_marry_member() as $key => $val)
					{
				?>
					<!-- ## for start ## -->
					<div class="padding_top_10 padding_bottom_10 border_bottom_1_ececec margin_left_15">
						<div class="new_ting_con_box width_100per">
							<div class="new_ting_con1 width_160">
								<div class="block">
									<? if ( $val['m_cate'] == '재혼' ) {?><img src="<?=IMG_DIR?>/badge_2.gif">
									<? }else if ( $val['m_cate'] == '결혼' ) {?><img src="<?=IMG_DIR?>/badge_1.gif"><? } ?>
								</div>
								<div class="ver_top block width_100 margin_left_2">
									<b class="ver_top"><?=trim_text($val['m_nick'],18)?></b>
									<div class="height_6"></div>
									<span class="color_666"><?=$this->member_lib->s_symbol($val['m_sex'])?> <?=$val['m_age']?>세 / <?=$val['m_conregion']?></span>
								</div>
							</div>
							<div class="new_ting_con2 width_444">
								<span class="love_per_title ver_top">러브궁합도</span>
								<div class="love_per_frame float_none block">
									<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
										<div class="love_per_frame_box" style="width:<?=love_per($val['m_conregion'],$val['m_conregion2'],$val['m_age'],$val['m_sex'])?>%;"></div>
									<? }else{ ?>
										<div class="love_per_frame_box" style="width:50%;"></div>
									<? } ?>
								</div>

								<? if (IS_LOGIN){	//로그인 했으면 내기준 궁합도 ?>
									<p class="love_per_name float_none block ver_top margin_top_mi_2 margin_left_mi_3"><?=love_per($val['m_conregion'],$val['m_conregion2'],$val['m_age'],$val['m_sex'])?>%</p>
								<? }else{ ?>
									<p class="love_per_name float_none block ver_top margin_top_mi_2 margin_left_mi_3">50%</p>
								<? } ?>
								
								<p class="color_666"><?=trim_text($val['m_content'],100)?></p> <!-- ## 글자짤리면 ...로대체 ## -->
							</div>
							<div class="new_ting_con3">
								<div class="text_btn_fe727b beongae_apply_btn width_85" onclick="propose_reuqest('<?=$val['m_userid']?>', '<?=$val['m_cate']?>');">
									프로포즈하기 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
								</div>
								<input type="button" class="text_btn_dcdcdc beongae_detail_view width_85" value="상세보기" onclick="javascript:m_request_user('<?=$val['m_userid']?>','<?=$val['m_cate']?>');">
							</div>
							<div class="clear"></div>
						</div>
					</div>
				<? } ?>
		

			</div>

		</div>

		
	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->


<script>
var s = new js_rolling('marray_slide');
s.set_direction(1);
s.move_gap = 1;	//움직이는 픽셀단위
s.time_dealy = 60; //움직이는 타임딜레이
s.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
s.start();
</script>

