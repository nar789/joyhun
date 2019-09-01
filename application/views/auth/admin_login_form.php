<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = '이메일 또는 아이디';
} else if ($login_by_username) {
	$login_label = '아이디';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember')
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<style>
	.label p {color:red;}
</style>

		<div class="padding-15">

			<div class="login-box">

				<!-- login form -->
				<?if(IS_MOBILE == TRUE){?>
				<form action="https://<?=str_replace(":444","",$_SERVER["HTTP_HOST"])?>:444/auth/admin_login/" method="post" class="sky-form boxed">
				<!--<form action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/admin_login/" method="post" class="sky-form boxed">-->
				<?}else{?>
				<form action="https://<?=str_replace(":444","",$_SERVER["HTTP_HOST"])?>/auth/admin_login/" method="post" class="sky-form boxed">
				<!--<form action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/admin_login/" method="post" class="sky-form boxed">-->
				<?}?>
					<header><i class="fa fa-users"></i> 관리자 로그인 </header>

					<fieldset>	

						<section>
							<label class="label" for="login">아이디</label>
							<label class="input">
								<i class="icon-append fa fa-user"></i>
								<?php echo form_input($login); ?>
								<span class="tooltip tooltip-top-right">아이디를 입력해 주세요</span>
							</label>
							<label class="label color-red">
							<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
							</label>
						</section>
						
						<section>
							<label class="label" for="password">비밀번호</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<?php echo form_password($password); ?>
								<b class="tooltip tooltip-top-right">비밀번호를 입력해 주세요</b>
							</label>
							<label class="label color-red">
							<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
							</label>
							<label class="checkbox"><?php echo form_checkbox($remember); ?> <i></i>자동로그인</label>
						</section>

	<?php if ($show_captcha) {?>	
						<section>
							<label class="label" for="captcha">보안코드</label>
							<label class="input"><?php echo $captcha_html; ?></label>
							<label class="input"><?php echo form_input($captcha); ?></label>
							<label class="label"><?php echo form_error($captcha['name']); ?></label>
						</section>
	<?php } ?>

					</fieldset>

					<footer>
						<button type="submit" class="btn btn-primary pull-right">로그인</button>

					</footer>


				</form>
				<!-- /login form -->

				<hr />

			</div>

		</div>