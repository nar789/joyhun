<form name="login_form" id="login_form" action="https://<?=str_replace(array(":443",":444"),"",$_SERVER["HTTP_HOST"])?>/auth/login/" method="post" accept-charset="utf-8" onsubmit="return login_js();">
<!--<form name="login_form" id="login_form" action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login/" method="post" accept-charset="utf-8" onsubmit="return login_js();">-->

<div class="content">

<!-- 처벌받은 아이디면 레이어팝업호출 -->
<?=@$not_login?>

	<div class="def_log_bg_box">

		<div class="def_log_area_box">
		
			<div class="def_log_area">
				<div class="def_login_box">
					<?php echo form_input($login); ?>
					<div style="height:7px;"></div>
					<?php echo form_password($password); ?>
				</div>
	
				<div class="alert_message">
					<?php echo form_error($login['name']); ?><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
					<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
				</div>

				<?php if ($show_captcha) {?>
				<div>
					<div class="captcha_text">
						<?=$login_max_attempts?>회 이상 비밀번호를 잘못 입력하셨습니다.<br>
						정보보호를 위해 자동입력 방지문자를 함께 입력 후 로그인해 주세요.
					</div>

					<div class="alert_message"><?php echo form_error($captcha['name']); ?></div>
					<div class="captcha_div"><?php echo $captcha_html; ?></div>
					<div class="def_login_box"><?php echo form_input($captcha); ?></div>
				</div>
				<?}?>

				<div class="def_login_btn" id="def_login_btn">로그인</div>

				<div class="def_login_check">
					<div class="login_check_box float_left">
						<?php echo form_checkbox($remember); ?><label for="remember"></label>
						<span class="def_login_subm">로그인 유지</span>
					</div>
					<div class="login_check_box float_left">
						<?php echo form_checkbox($save_id); ?><label for="def_check"></label>
						<span class="def_login_subm block margin_top_2">아이디 저장</span>
					</div>
					<div class="login_area_ip float_right">아이피 보안접속 <span>ON</span></div>
					<div class="clear"></div>
				</div>

				<div class="def_login_footer">
					<div class="def_login_q margin_bottom_11">
						<p>아이디/비밀번호를 분실하셨나요?</p>
						<div class="def_login_link" onclick="search_pw();">아이디/비밀번호 찾기</div>
					</div>
					<div class="def_login_q">
						<p>아직 회원이 아니신가요?</p>
						<div class="def_login_link" id="member_join_btn">회원가입</div>
					</div>				
				</div>
			</div>

		</div>
		<div class="clear"></div>

	</div>

</div>

</form>
