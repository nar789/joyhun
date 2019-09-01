<div class="iphone_padding">

	<form name="login_form" id="login_form" action="https://<?=str_replace(":444","",$_SERVER["HTTP_HOST"])?>:444/auth/login/" method="post" accept-charset="utf-8" onsubmit="return login_js();">


	<!-- 처벌받은 아이디면 레이어팝업호출 -->
	<?=@$not_login?>

	<img src="<?=IMG_DIR?>/m/day_banner/day_<?=date('w')?>.jpg" class="width_100per">

	<div class="m_main_area height_100per">

		<div class="padding_top_20">

			<div class="m_login_area">
				<div class="m_login_box">
					<div class="float_left width_75per">
						<?php echo form_input($login); ?>
						<?php echo form_password($password); ?>
					</div>
					<div class="float_right width_25per">
						<input type="submit" value="로그인" class="m_d53b3b_btn height_78">
					</div>
					<div class="clear"></div>
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


					<div class="margin_top_10">

						<?php echo form_checkbox($remember); ?><label for="m_remember" class="color_666 margin_right_20">로그인유지</label>

						<?php echo form_checkbox($save_id); ?><label for="m_save_id" class="color_666" >아이디 저장</label>

					</div>
				</div>
			</div>

			<div class="m_login_box">
				<div class="float_left width_50per">
					<input type="button" class="m_login_bottom_btn" value="아이디/비밀번호 찾기" onclick="location.href='/m/find_login'">
				</div>
				<div class="float_right width_50per">
					<input type="button" class="m_login_bottom_btn" value="회원가입" onclick="location.href='/auth/register/'">
				</div>
				<div class="clear"></div>
				<?/*
				<div class="float_left width_100per margin_top_3per">
					<img src="<?=IMG_DIR?>/m/login_btn_m_box.jpg" style="width:98.5%;" onclick="javascript:login_btn_m_box();">
				</div>
				*/?>
			</div>
		</div>

	</div>

	</form>

</div>