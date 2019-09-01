		<form name="login_form" id="login_form" action="https://<?=$_SERVER["HTTP_HOST"]?>/auth/login/<?=$rpath_encode?>" method="post" accept-charset="utf-8" onsubmit="return login_js();">
		<!--<form name="login_form" id="login_form" action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login/<?=$rpath_encode?>" method="post" accept-charset="utf-8" onsubmit="return login_js();">-->

		<div class="login_be_box height_202">		

			<div class="login_frame height_auto">
				<div class="login_movie_area">
					<p class="margin_top_3">아이피 보안접속 <span>ON</span></p>

					<div class="login_movie_input margin_top_3">
						<?php echo form_input($login,'','placeholder="아이디"'); ?>
						<?php echo form_password($password,'','placeholder="비밀번호"'); ?>
					</div>
					<div class="login_movie_btn margin_top_3">
						<input type="submit" class="pointer" value="로그인" />
					</div>

					<div class="login_check width_auto">
						<div class="posi_rel float_left width_90"><?php echo form_checkbox($remember); ?><label for="remember"></label><p class="padding_left_33">로그인유지</p></div>
						<div class="posi_rel float_left width_90"><?php echo form_checkbox($save_id); ?><label for="save_id"></label><p class="padding_left_33">아이디저장</p></div>
						<div class="clear"></div>
					</div>

					<div class="login_movie_alink">
						<input type="button" id="member_join_btn" class="blod color_333 join_btn pointer" value="회원가입" /><br>
						<input type="button" id="find_pw_btn" class="blod color_999 find_btn pointer margin_top_3" value="아이디/비밀번호 찾기" />
					</div>
				</div>		<!-- ## login_movie_area END -->
			</div>		<!-- ## login_frame END -->

		</div>		<!-- ## login_be_box end ## -->

		</form>