		<form name="login_form" id="login_form" action="https://<?=$_SERVER["HTTP_HOST"]?>/auth/login/<?=$rpath_encode?>" method="post" accept-charset="utf-8" onsubmit="return login_js();">
		<!--<form name="login_form" id="login_form" action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login/<?=$rpath_encode?>" method="post" accept-charset="utf-8" onsubmit="return login_js();">-->
		<div class="login_be_box">		

			<div class="login_noti">
				<p><b>공지 &nbsp;<img src="<?=IMG_DIR?>/arow.gif"> </b>
				<?
						if(!$right_notice2 = $this->cache->get('right_notice2')){
								$right_notice2 = board_list('1', 'notice_list', 'n_title,idx', 'n_date');
								$this->cache->save('right_notice2', $right_notice2, 600);	//10분 캐시 사용
						}

						foreach( $right_notice2 as $key => $val)
						{
					?>

					<a href="/service_center/notice/noti_view/idx/<?=$val['idx']?>" class="color_666"><?=trim_text($val['n_title'],42)?></a>

					<? } ?>
				</p>
			</div>

			<div class="login_frame">
				<div class="login_area">
					<p>아이피 보안접속 <span>ON</span></p>

					<div class="login_input">
						<?php echo form_input($login,'','placeholder="아이디"'); ?>
						<?php echo form_password($password,'','placeholder="비밀번호"'); ?>
					</div>
					<div class="login_btn">
						<input type="submit" class="pointer" value="로그인" />
					</div>
					<div class="clear"></div>
					<div class="login_check">
						<div class="posi_rel float_left width_90"><?php echo form_checkbox($remember); ?><label for="remember"></label><p class="padding_left_33">로그인유지</p></div>
						<div class="posi_rel float_left width_90"><?php echo form_checkbox($save_id); ?><label for="save_id"></label><p class="padding_left_33">아이디저장</p></div>
						<div class="clear"></div>
					</div>

					<div class="login_alink">
						<input type="button" id="member_join_btn" class="blod color_ea3c3c border_1_ea3c3c join_btn pointer" value="회원가입" /><input type="button" id="find_pw_btn" class="blod color_999 find_btn pointer ver_top" value="아이디/비밀번호 찾기"/>
					</div>
				</div>		<!-- ## login_area END -->
			</div>		<!-- ## login_frame END -->

		</div>		<!-- ## login_be_box end ## -->

		</form>


	<script>

	// ie v.8용
	$(document).ready(function(){

         var rv = -1;
         if (navigator.appName == 'Microsoft Internet Explorer') {        
              var ua = navigator.userAgent;        
              var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");        
              if (re.exec(ua) != null)            
                  rv = parseFloat(RegExp.$1);    
             }    
         if(rv <= 8){
			 $(".login_check > div > label").css("display","none");
			 $(".login_check > div > input[name='remember']").css("visibility","visible");
			 $(".login_check > div > input[name='save_id']").css("visibility","visible");
			 $(".login_check > div > p").removeClass("padding_left_33");
			 $(".login_check > div > p").addClass("padding_left_17");
			 $(".login_check").css("margin-left","0px");
		 }
	});

	function login_btn(){
		window.open("https://www.sepay.org/spm/join?regSiteCode=UI&ctgCode=1&subCode=1")
	}

</script>