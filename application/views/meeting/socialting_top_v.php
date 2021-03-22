		<?php
			If (IS_LOGIN == false || @$my_data['m_userid'] == ""){
		?>
		<div class="meeting_top_area socialting_top_bg">
			<!--<input type="button" value="프로필 등록하기" class="float_right socialting_top_btn" onclick="javascript:<php =user_check('socialting_add();')php>">//-->
			<input type="button" value="프로필 등록하기" class="float_right socialting_top_btn" onclick="return false;">
		</div>		
		<?
			}
			else{
		?>
		<div class="meeting_top_area socialting_top_bg">
			<input type="button" value="프로필 수정하기" class="float_right socialting_top_btn" onclick="javascript:<?=user_check('socialting_add();')?>">
		</div>
		<?
			}
		?>
		
		