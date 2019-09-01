<div class="iphone_padding">

	<img src="<?=IMG_DIR?>/m/m_top_first_banner.jpg" class="width_100per">

	<div class="m_cert_title">
		안심본인인증
	</div>
	<div class="bg_fefefe">
		<div class="m_cert_area">

			<div class="m_cert_box_title">
				<div class="width_5per float_left">
					<img src="<?=IMG_DIR?>/m/join_cert_1.gif">
				</div>
				<div class="m_cert_box_text">
					<p>조이헌팅은 개인정보보호와 모든 서비스 이용을 위해 <br>본인인증을 하시면 다양한 서비스를 이용하실 수 있습니다.</p>
				</div>
				<div class="clear"></div>
			</div>

			<div class="m_cert_box_content">
				<div>
					<img src="<?=IMG_DIR?>/m/join_cert_2.gif">
				</div>

				<input type="button" class="m_d53b3b_btn" value="휴대폰 인증" id="m_hp_cert" name="m_hp_cert" onclick="javascript:name_check();">
				<!--input type="button" class="m_d53b3b_btn" value="휴대폰 인증" id="m_hp_cert" name="m_hp_cert" onclick="javascript:reg_phone_chk('1', '<?=$regi_id?>');"-->

			</div>
			
			<div class="m_cert_box_bottom" style="border-bottom:1px solid #ececec;">
				<p class="blod color_333">인증이 안되시나요?<br>
				<b class="color_999">관리자가 정보를 확인후 연락드리겠습니다.</p>
				<a href="javascript:reg_member_auth_layer_pop();"><input type="button" class="m_manager_btn" value="관리자에게 인증요청하기"></a>
			</div>

			<div class="m_cert_box_bottom" style="border-bottom:1px solid #ececec;">
				<p class="blod color_999">
				<b class="color_999">기타 문의사항은 아래 문의하기에 남겨주시면 답변해드리곘습니다.</b></p>
				
				<input type="button" class="m_fbfbfb_btn" value="일대일 문의하기" onclick="javascript:complain_request('2');">
			</div>

			<div class="m_cert_box_bottom">
				<p class="blod color_999">
				<b class="color_999">다른 아이디가 있으신가요?</b></p>
				
				<input type="button" class="m_fbfbfb_btn" value="로그아웃하기" onclick="javascript:location.href='/auth/logout/';">
			</div>

		</div>
	</div>

	<div class="m_cert_area">
		<ul class="m_cert_guide">
			<li>본인 명의의 휴대폰만 사용가능하며 핸드폰 인증 외 다른 용도로는 사용되지 않습니다.</li>
			<li>휴대폰 실제 소유자와 명의인이 다를 경우 인증 받을 수 없으며 타인의 개인정보를 도용할 경우 관계법에 의해 처벌될 수 있습니다.</li>
		</ul>
	</div>

	<style>
	.m_manager_btn { margin-top:3%;width:50%; height:35px; font-weight:bold;  background:#fff; border: 1px solid #d53b3b; color:#d53b3b; border-radius:2px;}
	@media all and (min-width:430px) and (max-width:599px){	

		.m_manager_btn {    
			font-size: 18px;
			height: 50px;
		}
	}

	@media all and (min-width:600px){	/* width:600이상 or 가로모드 (orientation:landscape) */


		.m_manager_btn {    
			height: 60px;
			border-radius: 6px;
			font-size: 26px;
		}
	}

	</style>

</div>