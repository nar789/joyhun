	<input type="hidden" id="m_idx" name="m_idx" value="<?=@$my_data['m_idx']?>">
	<input type="hidden" id="m_userid" name="m_userid" value="<?=@$my_data['m_userid']?>">

	<div class="layout_padding">
		<p class="meet_pop_content_p">문자팅을 이용하기 위해 아래의 등록절차를 마치셔야 합니다.</p>

		<div class="meet_pop_box">
			<div class="meet_pop_left">
				<img src="<?=IMG_DIR?>/layer_popup/meet_pop_1.gif" align="top">휴대폰
			</div>
			<div class="meet_pop_mid">
				<a href="#"><span class="meet_pop_mid_text2" id="chk_phone">
					<? if($m_row['m_mobile_chk'] == "1"){ echo $m_row['m_hp1']."-".$m_row['m_hp2']."-".$m_row['m_hp3']?> (인증완료)
					<? }else{ ?> 휴대폰 인증하기 <? } ?>
				</span></a>
				<!-- <span class="meet_pop_mid_text1">010-4084-4448</span> -->
			</div>
			<div class="meet_pop_right">
				<input type="button" value="인증하기" onclick="javascript:name_check();"/>
				<!--input type="button" value="인증하기" onclick="javascript:reg_phone_chk('2', '<?=$m_row['m_userid']?>');"/-->
			</div>
		</div>
		<!--div class="text-center">
		<img src="<?=IMG_DIR?>/layer_popup/meet_pop_arrow.gif">
		</div>
		<div class="meet_pop_box">
			<div class="meet_pop_left">
				<img src="<?=IMG_DIR?>/layer_popup/meet_pop_2.gif" align="top">대표사진
			</div>
			<div class="meet_pop_mid" id="chk_pic">
			<? if (count($pic_row) == '0'){		//사진이 없으면?>
				<a href="/profile/main/user"><span class="meet_pop_mid_text2">대표사진을 인증해주세요.</span></a>
			</div>
			<div class="meet_pop_right">
				<input type="button" value="인증하기" onclick="location.href='/profile/main/user';"/>
			</div>
			<? } else {  //대표사진있으면 ?>
				<a href="/profile/main/user"><span class="meet_pop_mid_text2">인증완료</span></a>
			</div>
			<div class="meet_pop_right">
				<input type="button" value="수정하기" onclick="location.href='/profile/main/user';"/>
			</div>
			<? } ?>

		</div-->
		<div class="text-center">
		<img src="<?=IMG_DIR?>/layer_popup/meet_pop_arrow.gif">
		</div>
		<div class="meet_pop_box">
			<div class="meet_pop_left">
				<img src="<?=IMG_DIR?>/layer_popup/meet_pop_2.gif" align="top">스타일
			</div>
			<div class="meet_pop_mid ver_top width_60per">
				<div class="select_box_border">
					<select class="width_130 height_30" name="m_job" id="m_job">
						<option value="" selected>직업</option>
						<option value="1">학생</option>
						<option value="2">컴퓨터/인터넷</option>
						<option value="3">언론</option>
						<option value="4">공무원</option>
						<option value="5">군인</option>
						<option value="6">서비스업</option>
						<option value="7">교육</option>
						<option value="8">금융/증권/보험업</option>
						<option value="9">유통업</option>
						<option value="10">예술</option>
						<option value="11">의료</option>
						<option value="12">법률</option>
						<option value="13">건설업</option>
						<option value="14">제조업</option>
						<option value="15">부동산업</option>
						<option value="16">운송업</option>
						<option value="17">농/수/임/광산업</option>
						<option value="18">자영업</option>
						<option value="19">가사(주부)</option>
						<option value="20">무직</option>
						<option value="21">기타</option>
					</select>

					<select class="width_65 height_30" name="m_outstyle" id="m_outstyle">
						<option value="">외모</option>
						<option value="1">순수</option>
						<option value="2">예쁨</option>
						<option value="3">지적</option>
						<option value="4">귀여움</option>
						<option value="5">평범</option>
						<option value="6">샤프함</option>
						<option value="7">귀공녀</option>
						<option value="8">폭탄</option>
						<option value="9">섹시</option>
						<option value="10">통통</option>
					</select>

					<select class="width_65 height_30" name="m_character" id="m_character">
							<option value="">성격</option>
							<option value="1">개방적</option>
							<option value="2">화끈</option>
							<option value="3">활달</option>
							<option value="4">터프</option>
							<option value="5">보수적</option>
							<option value="6">차분</option>
							<option value="7">순진</option>
							<option value="8">소심</option>
							<option value="9">내숭</option>
							<option value="10">솔직</option>
							<option value="11">명랑</option>
							<option value="12">깔끔</option>
							<option value="13">새침</option>
					</select>
				</div>
			</div>
		</div>
		<div class="text-center">
			<input type="submit" class="meet_pop_subbtn" value="완료" onclick="s_submit('<?=$this->session->userdata('m_userid');?>','<?=$this->session->userdata('m_nick');?>');" />
	</div>