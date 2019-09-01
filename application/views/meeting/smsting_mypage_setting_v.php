<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_tabmenu2?>

		<div class="margin_top_28">
			<div class="sms_my_sub3_left">
				<div class="padding_top_10 padding_left_8">
					<?=$this->member_lib->member_thumb($sms_set['m_userid'],165,166)?>
				</div>
				<div class="margin_top_10 margin_left_9">
					<div class="width_165">
						<div class="sms_my_sub3_td1">대표사진</div>
							<div class="margin_left_mi_4 block">
								<input type="button" class="text_btn_d4d4d4 width_87" value="대표사진변경" onclick="location.href='/profile/main/user'">
							</div>
						</div>
					<div class="width_165 margin_top_7">
						<div class="sms_my_sub3_td1">휴대폰번호</div>
						<div class="margin_left_mi_4 block">
							<?=$m_result['m_hp1']?>-<?=$m_result['m_hp2']?>-<?=$m_result['m_hp3']?>
						</div>
					</div>

					<div class="width_165 margin_top_16">
						<div class="sms_my_sub3_td1">전송가능문자</div>
						<div class="sms_my_sub3_td2 width_48"><?=$m_use_cnt?>건</div>
						<div class="margin_left_mi_4 block">
							<input type="button" class="text_btn_d4d4d4" value="충전">
						</div>
					</div>

					<div class="width_165 margin_top_16">
						<div class="sms_my_sub3_td1">보낸문자</div>
						<div class="sms_my_sub3_td2">
							<?=$sms_se_cnt?>건
						</div>
					</div>
					<div class="width_165 margin_top_7">
						<div class="sms_my_sub3_td1">받은문자</div>
						<div class="sms_my_sub3_td2">
							<?=$sms_re_cnt?>건
						</div>
					</div>

					<div class="width_165 margin_top_16">
						<div class="sms_my_sub3_td1">수신가능시간</div>
						<div class="sms_my_sub3_td2">
							<? if ($sms_set['m_receive_time'] == 'Y') {?>
								항상가능
							<? }else{ echo $times[0]; echo "시 ~ "; echo $times[1]; echo "시"; } ?>
						</div>
					</div>

					<div class="width_165 margin_top_16">
						<div class="sms_my_sub3_td1">스타일</div>
						<div class="sms_my_sub3_td2 width_87 ver_top">
							<?=job_text($sms_set['m_job'])?> &middot; <?=outstyle_text($sms_set['m_outstyle'])?> &middot; <?=character_text($sms_set['m_character'])?>
						</div>
					</div>

				</div>
			</div>
			<div class="sms_my_sub3_right">
			
				<div class="margin_top_9 margin_left_19">
					<div class="sms_my_sub3_right_border padding_top_10">
						<div class="sms_my_sub3_right_title">
							문자 수신번호
						</div>
						<div class="padding_top_15 block select_box_border">
							<input type="text" class="m_sms_ph" maxlength='3' value="<?=$m_result['m_hp1']?>" name="m_phone_1" readonly/>&nbsp;-&nbsp;
							<input type="text" class="m_sms_ph" maxlength='4' value="<?=$m_result['m_hp2']?>" name="m_phone_2" readonly/>&nbsp;-&nbsp;
							<input type="text" class="m_sms_ph" maxlength='4' value="<?=$m_result['m_hp3']?>" name="m_phone_3" readonly/>
							<input type="button" class="text_btn_dcdcdc sms_my_sub3_right_btn" value="변경" onclick="javascript:name_check();"/>
							<!--input type="button" class="text_btn_dcdcdc sms_my_sub3_right_btn" value="변경" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata['m_userid']?>');"/-->
							<p class="margin_top_10 color_999">&#8251; 상대방에게 절대 노출되지 않습니다. </p>
						</div>
					</div>
					<div class="sms_my_sub3_right_border">
						<div class="sms_my_sub3_right_title">
							문자 수신시간 변경
						</div>
						<div class="padding_top_15 block sms_my_sub3_radio">
							<div class="sms_my_sub3_radio_box">
								<input type="radio" id="sms_my_sub3_radio1" name="sms_time_radio" value="1" <? if ($sms_set['m_receive_time'] == 'Y') {?>checked<? } ?>/><label for="sms_my_sub3_radio1"></label><span> 항상수신 (권장)</span>
							</div>
							<div class="sms_my_sub3_radio_box margin_top_13">
								<input type="radio" id="sms_my_sub3_radio2" name="sms_time_radio" value="2" <? if ($sms_set['m_receive_time'] != 'Y') {?>checked<? } ?>/><label for="sms_my_sub3_radio2"></label><span> 수신시간 설정</span>
								<div class="select_box_border">
									<select class="width_45 height_20" id="ex_time_1" name="ex_time_1" onchange="document.getElementById('sms_my_sub3_radio2').checked=true;">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
									</select>
								</div>
								 시 ~ 
								<div class="select_box_border">
									<select class="width_45 height_20" id="ex_time_2" name="ex_time_2" onchange="document.getElementById('sms_my_sub3_radio2').checked=true;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
									</select>
								</div>
								시
							</div>
						</div>
					</div>
					<div class="sms_my_sub3_right_border height_62">
						<div class="sms_my_sub3_right_title">
							스타일
						</div>
						<div class="padding_top_15 block select_box_border">
							<select class="width_130 height_30" name="m_job" id="m_job">
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
							<select class="width_65 height_30 margin_bottom_16" name="m_character" id="m_character">
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
					<div class="margin_top_10 text-center margin_bottom_18">
						<input type="button" class="text_btn_de4949 sms_sub_btn" value="저장" onclick="sms_my_modi();">
					</div>
					<div class="sms_sub2_right_bg blod margin_top_55">문자팅 등록을 해지합니다. <input type="button" class="text_btn_dcdcdc sms_my_sub3_right_btn" value="확인" onclick="sms_delete();"/></div>
					<!-- <p class="margin_top_10 color_999">&#8251; 문자팅을 해지하면 보유하신 문자팅 아이템이 모두 삭제됩니다. </p> -->
				</div>
				
			</div>
		</div>


	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>


		<script>
			$("#m_job").val("<?=$sms_set['m_job']?>").attr("selected", "selected");
			$("#m_outstyle").val("<?=$sms_set['m_outstyle']?>").attr("selected", "selected");
			$("#m_character").val("<?=$sms_set['m_character']?>").attr("selected", "selected");
			
			$("#ex_time_1").val("<?=$times[0]?>").attr("selected", "selected");
			$("#ex_time_2").val("<?=$times[1]?>").attr("selected", "selected");

		</script>