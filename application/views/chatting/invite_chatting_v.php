<div class="content">

	<div class="left_main">
		

		<?=$call_top?>

		<?=$call_tabmenu?>


		<div class="submenu_select_area text-center">
			<div class="submenu_select_box">
				<p>지역</p>
				<div class="select_box block">
					<select style="width:82px;height:36px;" id="m_conregion" name="m_conregion">
						<option value="" <? if($val1 == ""){ echo "selected"; }?> >선택</option>
						<option value="서울" <? if($val1 == "서울"){ echo "selected"; }?> >서울</option>
						<option value="경기" <? if($val1 == "경기"){ echo "selected"; }?> >경기</option>
						<option value="인천" <? if($val1 == "인천"){ echo "selected"; }?> >인천</option>
						<option value="강원" <? if($val1 == "강원"){ echo "selected"; }?> >강원</option>
						<option value="경남" <? if($val1 == "경남"){ echo "selected"; }?> >경남</option>
						<option value="부산" <? if($val1 == "부산"){ echo "selected"; }?> >부산</option>
						<option value="경북" <? if($val1 == "경북"){ echo "selected"; }?> >경북</option>
						<option value="대구" <? if($val1 == "대구"){ echo "selected"; }?> >대구</option>
						<option value="전북" <? if($val1 == "전북"){ echo "selected"; }?> >전북</option>
						<option value="전남" <? if($val1 == "전남"){ echo "selected"; }?> >전남</option>
						<option value="광주" <? if($val1 == "광주"){ echo "selected"; }?> >광주</option>
						<option value="충북" <? if($val1 == "충북"){ echo "selected"; }?> >충북</option>
						<option value="충남" <? if($val1 == "충남"){ echo "selected"; }?> >충남</option>
						<option value="대전" <? if($val1 == "대전"){ echo "selected"; }?> >대전</option>
						<option value="제주" <? if($val1 == "제주"){ echo "selected"; }?> >제주</option>
						<option value="울산" <? if($val1 == "울산"){ echo "selected"; }?> >울산</option>
						<option value="해외" <? if($val1 == "해외"){ echo "selected"; }?> >해외</option>
					</select>
				</div>		 <!-- ##	select_box end	## -->
				<p class="padding_left_10">나이</p>
				<div class="select_box block">
					<select style="width:102px;height:36px;" id="m_age" name="m_age">
						<option value="00" <? if($val2 == "00"){ echo "selected"; }?> >전체</option>
						<option value="1020" <? if($val2 == "1020"){ echo "selected"; }?> >10~20대</option>
						<option value="30" <? if($val2 == "30"){ echo "selected"; }?> >30대</option>
						<option value="40" <? if($val2 == "40"){ echo "selected"; }?> >40대</option>
						<option value="50" <? if($val2 == "50"){ echo "selected"; }?> >50대 이상</option>
					</select>
				</div>		 <!-- ##	select_box end	## -->
				<p class="padding_left_10">성별</p>
				<div class="select_box block">
					<select style="width:82px;height:36px;" id="m_sex" name="m_sex">
						<option value="F" <? if($val3 == "F"){ echo "selected"; }?> >여자</option>
						<option value="M" <? if($val3 == "M"){ echo "selected"; }?> >남자</option>
					</select>
				</div>		 <!-- ##	select_box end	## -->
				<input type="button" value="검색" class="margin_left_6" onclick="javascript:ideal_search();" />
				
				<div class="clear"></div>
			</div>		<!-- ## light_select_box end ## -->
		</div>		<!-- ## light_select_area end ## -->


		<div class="tab_content_top_area">
			<div class="float_left">
				<!-- <p><span class="color_333">1월 23일</span> 총 <span class="color_333">23건</span>의 번개팅이 등록되어있습니다.</p> -->
				<!-- ??? -->
			</div>
		</div>

		<?

			if($getTotalData > 0){
				foreach($mlist as $data){
		?>

		<div class="min_height_78 list_area">
			<div class="list_img2 margin_left_16" >
				<a href="#" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($data['m_userid'],70,51)?>
				</a>
			</div>		<!-- ## light_list_img end ## -->

			<div class="onetr_list_first">
				<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><span class="color_333"><?=$data['m_nick']?> (<?=$data['m_age']?>세) </span>
			</div>

			<div class="onetr_list_two">
				<span class="color_333"><?=$data['m_conregion']?></span>
			</div>

			<div class="onetr_list_thr height_auto" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden;" title="<?=$data['my_intro']?>">
				<span class="color_333 break_all"><?=$data['my_intro']?></span>
			</div>
			<div class="onetr_list_btn inline float_right">
				<div class="text_btn_fe727b onetr_chat_btn" onclick="<?user_check("chat_request('$data[m_userid]');");?>">
					채팅신청&nbsp;
					<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
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
		<!-- 검색결과가 없을경우 -->
		<div class="list_area">
			<div class="light_img_null">
				<img src="/images/meeting/light_null.gif">
				<div class="margin_top_5">
					검색된 회원이 없습니다.<Br>
					검색 조건을 다시 체크 하시기 바랍니다. 
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>

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