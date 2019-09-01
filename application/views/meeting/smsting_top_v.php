		<div class="meeting_top_area smsting_top_bg">
		<?php if (IS_LOGIN == false || @$my_data['m_userid'] == ""){ //문자팅 등록을 하지 않았을경우 ?>

			<input type="button" value="문자팅 무료등록" class="float_right smsting_top_btn" onclick="javascript:<?=user_check('smsting_add();')?>">
			
			<?php }else{ //등록된 문자팅이 있을경우 ?>

			<input type="button" value="문자팅 수정하기" class="float_right smsting_top_btn" onclick="location.href='/meeting/smsting/my_smsting_setting';">
		
			<?php } ?>

		</div>