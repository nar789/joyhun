
<div class="content">
	<div id="tmp"></div>
	<?
		echo is_null($mdata['m_hp1']);
	?>
	<div class="left_main">

		<form name="register_form" method="post" accept-charset="utf-8">
		<input type="hidden" id="sVal" name="sVal" value="1">

		<p class="font-size_18 color_333 blod">기본정보 입력사항</p>
		<table class="popup_border_table">
			<tr>
				<td class="width_142">아이디</td>
				<td class="color_666">
					<?=$mdata['m_userid']?>
				</td>
			</tr>
			<tr>
				<td>비밀번호</td>
				<td>
					<div class="width_240 block">
						<input type="password" class="width_230 height_20 border_1_cccccc" maxlength="12" id="m_pwd" name="m_pwd" value="">
					</div>
					<span class="color_999">6~12자의 영문과 숫자만 가능합니다.</span>
				</td>
			</tr>
			<tr>
				<td>비밀번호 확인</td>
				<td >
					<input type="password" class="width_230 height_20 border_1_cccccc margin_right_8" id="m_pwd_ok" name="m_pwd_ok" value="" maxlength="12">
					<span id="pw_ok"></span>
				</td>
			</tr>
			<tr>
				<td>닉네임</td>
				<td >
					<div class="width_240 block">
						<input type="text" class="width_127 height_20 border_1_cccccc" maxlength="6" id="m_nick" name="m_nick" value="<?=$mdata['m_nick']?>" old_value="<?=$mdata['m_nick']?>">
						<input type="button" class="text_btn_dcdcdc width_60 height_22" id="m_nick_chk" value="중복확인">
					</div>
					<span class="color_999" id="m_nick_ok">2~6자의 한글과 영문 숫자사용이 가능합니다.</span>
				</td>
			</tr>
			<tr>
				<td>나이</td>
				<td >
					<div class="select_box_ccc_border width_240 block">
						<select class="width_65 bg_position_100 height_22" name="m_age" id="m_age">
							<? for($i=20; $i<70; $i++){?>
							<option value="<?=$i?>" <? if($mdata['m_age'] == $i){?> selected="selected"<?}?>><?=$i?></option>
							<? } ?>
						</select>&nbsp;세
					</div>
				</td>
			</tr>
			<tr>
				<td>이름</td>
				<td class="color_666">
					<?=$mdata['m_name']?>
				</td>
			</tr>
			<tr>
				<td class="ver_top width_142"><p class="margin_top_12">이메일</p></td>
				<td>
					<div class="select_box_ccc_border margin_top_9">
						<input type="text" class="width_122 height_20 border_1_cccccc" id="email_id" name="email_id" value="<?=$email1?>"/>
						@
						<input type="text" class="width_120 height_20 border_1_cccccc" id="email_after" name="email_after" value="<?=$email2?>">

						<select class="width_120 height_22" id="email_selecter" onChange="email_cha();">
							<option value="">선택하세요</option>
							<option value="naver.com" <?if($email2 == "naver.com"){?> selected <?}?> >naver.com</option>
							<option value="hanmail.net" <?if($email2 == "hanmail.net"){?> selected <?}?> >hanmail.net</option>
							<option value="nate.com" <?if($email2 == "nate.com"){?> selected <?}?> >nate.com</option>
							<option value="gmail.com" <?if($email2 == "gmail.com"){?> selected <?}?> >gmail.com</option>
							<option value="daum.net" <?if($email2 == "daum.net"){?> selected <?}?> >daum.net</option>
							<option value="korea.com" <?if($email2 == "korea.com"){?> selected <?}?> >korea.com</option>
							<option value="chollian.net" <?if($email2 == "chollian.net"){?> selected <?}?> >chollian.net</option>
							<option value="dreamwiz.com" <?if($email2 == "dreamwiz.com"){?> selected <?}?> >dreamwiz.com</option>
							<option value="1">직접입력</option>
						</select>
						<p class="color_999 margin_top_8 margin_bottom_13">비밀번호 분실, 조이헌팅 이벤트, 뉴스레터 등 메일발송을 위하여 정확하게 기입하여 주세요.</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>이메일 공개여부</td>
				<td>
					<div id="ie_8_up_email">
						<div class="radio_box">
							<input type="radio" id="open_ok" name="email_open" value="Y" <?if($mdata['m_mail_open_yn'] == "Y"){?> checked <?}?>/><label for="open_ok"></label><span class="color_666">전체공개</span>
							<input type="radio" id="open_no" name="email_open" value="N" <?if($mdata['m_mail_open_yn'] == "N"){?> checked <?}?>/><label for="open_no"></label><span class="color_666">비공개</span>
						</div>
					</div>
					<div id="ie_8_down_email">
						<input type="radio" name="email_open" value="Y" <? if($mdata['m_mail_open_yn'] == "Y"){?> checked <?}?>/>전체공개
						<input type="radio" name="email_open" value="N" <? if($mdata['m_mail_open_yn'] == "N"){?> checked <?}?>/>비공개
					</div>
				</td>
			</tr>
			<tr>
				<td>이메일 수신여부</td>
				<td>
					<div id="ie_8_up_recv_email">
						<div class="radio_box">
							<input type="radio" id="email_agree" name="email_recv_agree" value="Y" <?if($mdata['m_mail_yn'] == 'Y'){?> checked <?}?>/><label for="email_agree"></label><span class="color_666">수신동의</span>
							<input type="radio" id="email_no_agree" name="email_recv_agree" value="N" <?if($mdata['m_mail_yn'] == 'N'){?> checked <?}?>/><label for="email_no_agree"></label><span class="color_666">수신거부</span>
						</div>
					</div>
					<div id="ie_8_down_recv_email">
						<input type="radio" name="email_recv_agree" value="Y" <?if($mdata['m_mail_yn'] == "Y"){?> checked <?}?>/>수신동의
						<input type="radio" name="email_recv_agree" value="N" <?if($mdata['m_mail_yn'] == "N"){?> checked <?}?>/>수신거부
					</div>
				</td>
			</tr>
			<tr>
				<td class="ver_top width_142"><p class="margin_top_12">휴대전화</p></td>
				<td>
					<div class="select_box_ccc_border margin_top_9 color_666">
						<select class="width_113 height_22 color_666" id="m_hp1" name="m_hp1">
							<option value="010" <?if(@$mdata['m_hp1'] == "010"){?> selected <?}?>>010</option>
							<option value="011" <?if(@$mdata['m_hp1'] == "011"){?> selected <?}?>>011</option>
							<option value="016" <?if(@$mdata['m_hp1'] == "016"){?> selected <?}?>>016</option>
							<option value="017" <?if(@$mdata['m_hp1'] == "017"){?> selected <?}?>>017</option>
							<option value="018" <?if(@$mdata['m_hp1'] == "018"){?> selected <?}?>>018</option>
							<option value="019" <?if(@$mdata['m_hp1'] == "019"){?> selected <?}?>>019</option>
						</select>
						&nbsp;-&nbsp;
						<input type="text" class="width_103 height_20 border_1_cccccc" id="m_hp2" name="m_hp2" value="<?=@$mdata['m_hp2']?>" readonly/>
						&nbsp;-&nbsp;
						<input type="text" class="width_103 height_20 border_1_cccccc" id="m_hp3" name="m_hp3" value="<?=@$mdata['m_hp3']?>" readonly/>
						&nbsp;
						<?//if($mdata['m_mobile_chk'] == "1"){?>
						<!--font style="color:red; font-weight:bold;">본인인증완료</font-->
						<?//}else{?>
						<input type="button" class="text_btn_dcdcdc width_60 height_22" id="m_hp_chk" value="본인인증" onclick="javascript:name_check();">
						<?//}?>
						<p class="color_999 margin_top_8 margin_bottom_13">전화번호는 절대 공개되지 않으며,<br>무료경품 메세지와 데이트신청 메세지를 받을 수 있으므로정확히 입력해주셔야 합니다.</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>SMS 수신여부</td>
				<td >
					<div id="ie_8_up_sms">
						<div class="radio_box">
							<input type="radio" id="sms_agree" name="sms_recv_agree" value="1" <? if(@$mdata['m_hp_sms'] == "1"){ echo "checked"; } ?>><label for="sms_agree"></label><span class="color_666">수신동의</span>
							<input type="radio" id="sms_no_agree" name="sms_recv_agree" value="0" <? if(@$mdata['m_hp_sms'] == "0"){ echo "checked"; } ?> class="margin_left_10"/><label for="sms_no_agree"></label><span class="color_666">수신거부</span>
						</div>
					</div>
					<div id="ie_8_down_sms">
						<input type="radio" name="sms_recv_agree" value="1" <?if(@$mdata['m_hp_sms'] == '1'){?> checked <?}?>/>수신동의
						<input type="radio" name="sms_recv_agree" value="0" <?if(@$mdata['m_hp_sms'] == '0'){?> checked <?}?>/>수신거부
					</div>
				</td>
			</tr>
			<tr>
				<td class="ver_top width_142"><p class="margin_top_12">지역</p></td>
				<td>
					<div class="regi_area">
						<select class="regi_area_1" name="regi_area_1" id="regi_area_1" onchange="area_select(this.value,'regi_area_2');">
							<option value="">- 선택 -</option> 
							<option value="서울">서울</option> 
							<option value="인천">인천</option> 
							<option value="부산">부산</option> 
							<option value="대구">대구</option> 
							<option value="대전">대전</option> 
							<option value="광주">광주</option> 
							<option value="울산">울산</option> 
							<option value="경기">경기</option> 
							<option value="강원">강원</option> 
							<option value="세종">세종</option> 
							<option value="충남">충남</option> 
							<option value="충북">충북</option> 
							<option value="경남">경남</option> 
							<option value="경북">경북</option> 
							<option value="전남">전남</option> 
							<option value="전북">전북</option> 
							<option value="제주">제주</option> 
						</select>
						
						<select class="regi_area_2 width_82 margin_top_4" name="regi_area_2" id="regi_area_2" id="local_second_prim">
							<option value="">- 선택 -</option> 
						</select>
					</div>
				</td>
				<!--td>
					<input type="text" class="width_127 height_20 border_1_cccccc margin_top_8"/>
					<input type="button" class="text_btn_dcdcdc width_60 height_22 margin_top_8" value="검색하기" /><br>
					<input type="text" class="width_395 height_20 border_1_cccccc margin_top_4"/><br>
					<input type="text" class="width_395 height_20 border_1_cccccc margin_top_4 margin_bottom_8"/>
				</td-->
			</tr>
		</table>

		<p class="font-size_18 color_333 blod margin_top_40">프로필 입력사항</p>
		<table class="popup_border_table">
			<tr>
				<td class="width_142">원하는 만남</td>
				<td class="width_215">
					<div class="info_modi_select color_666">
						<select class="width_200 height_22 color_666" id="m_reason" name="m_reason">
							<option value="">선택하세요</option>
							<? 
								$arr = want_reason_data("all");
								foreach ($arr as $key => $value) {
							?>
									<option value="<?=$key?>" <? if(@$mdata['m_reason'] == $key){ echo "selected";} ?>><?=$value?></option>
							<? } ?>
						</select>
					</div>
				</td>
				<td class="width_142">대화 스타일</td>
				<td>
					<div class="info_modi_select color_666">
						<select class="width_161 height_22 color_666" id="m_character" name="m_character">
							<option value="">선택하세요</option>
							<? 
								$arr = talk_style_data("all", $this->session->userdata('m_sex'));
								foreach ($arr as $key => $value) {
							?>
								<option value="<?=$key?>"  <? if(@$mdata['m_character'] == $key){ echo "selected";} ?>><?=$value?></option>
							<? } ?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td class="ver_top"><p class="margin_top_12">인사말</p></td>
				<td class="color_999" colspan="3">
					<div style="width:543px;height:102px;border:1px solid #ccc;" class="margin_top_9 margin_bottom_8">
						<textarea id="my_intro" name="my_intro"><?=$mdata['my_intro']?></textarea>
					</div>	<!-- ##임시 추후 radio## -->
				</td>
			</tr>
		</table>

		</form>
		
		<div class="text-center margin_top_20 margin_bottom_10">
			<input type="button" class="text_btn_de4949 width_120 height_37 font-size_14" value="정보수정하기" id="submit_btn"> <!-- id="submit_btn" -->
		</div>

	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->






<script type="text/javascript" charset="utf-8">

	// Internet Explorer 버전 체크
	var IEVersionCheck = function() {

		 var word;
		 var version = "N/A";

		 var agent = navigator.userAgent.toLowerCase();
		 var name = navigator.appName;

		 // IE old version ( IE 10 or Lower )
		 if ( name == "Microsoft Internet Explorer" ) word = "msie ";

		 else {
			 // IE 11
			 if ( agent.search("trident") > -1 ) word = "trident/.*rv:";

			 // IE 12  ( Microsoft Edge )
			 else if ( agent.search("edge/") > -1 ) word = "edge/";
		 }

		 var reg = new RegExp( word + "([0-9]{1,})(\\.{0,}[0-9]{0,1})" );
		 if (  reg.exec( agent ) != null  )
			 version = RegExp.$1 + RegExp.$2;

		 return version;
	};


	// IE 8
	if(IEVersionCheck() == '8.0'){

		// 이메일 공개여부
		$("#ie_8_up_email").remove();
		$("#ie_8_down_email").css("display","inline-block");

		// 이메일 수신여부
		$("#ie_8_up_recv_email").remove();
		$("#ie_8_down_recv_email").css("display","inline-block");
		
		// SMS 수신여부
		$("#ie_8_up_sms").remove();
		$("#ie_8_down_sms").css("display","inline-block");

	}else{

		// 이메일 공개여부
		$("#ie_8_up_email").css("display","inline-block");
		$("#ie_8_down_email").remove();

		// 이메일 수신여부
		$("#ie_8_up_recv_email").css("display","inline-block");
		$("#ie_8_down_recv_email").remove();

		// SMS 수신여부
		$("#ie_8_up_sms").css("display","inline-block");
		$("#ie_8_down_sms").remove();
		

		// IE8적용 후 checked 안먹는현상때문에 (필요)
		var email_open = "<?=$mdata['m_mail_open_yn']?>";
		if(email_open == "Y"){
			$('input:radio[name="email_open"][value="Y"]').prop('checked', true);
		}else{
			$('input:radio[name="email_open"][value="N"]').prop('checked', true);
		}

		var email_ok = "<?=$mdata['m_mail_yn']?>";
		if(email_ok == "Y"){
			$('input:radio[name="email_recv_agree"][value="Y"]').prop('checked', true);
		}else{
			$('input:radio[name="email_recv_agree"][value="N"]').prop('checked', true);
		}
		
		var sms_ok = "<?=@$mdata['m_hp_sms']?>";
		if(sms_ok == "1"){
			$('input:radio[name="sms_recv_agree"][value="1"]').prop('checked', true);
		}else{
			$('input:radio[name="sms_recv_agree"][value="0"]').prop('checked', true);
		}
	}
</script>