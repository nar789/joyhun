		<div class="mylog_box">
			<div class="height_170">
				<div class="mylog_title_box">
					<img src="<?=IMG_DIR?>/right_flo_1.png"><p class="color_e96f70">이상형 접속 알리미</p>
				</div>
				<div class="mylog_content_box">
					<? if(count(@$arr) > 0){ ?>
					<div class="mCustomScrollbar mylog_con">
						<? for($i=0; $i<$max_num; $i++){ ?>
						<a href="/profile/main/user/user_id/<?=$arr[$i][0]?>"><p class="mylog_con_list"><?=$arr[$i][1]?></p></a>
						<? } ?>
					</div>
					<? }else{ ?>
					<p class="mylog_null">접속중인 <span class="color_e96f70">이성친구</span>를 <br> 지금 바로 확인하세요!</p>
					<? } ?>				

					<input type="button" class="text_btn2_ea3e3e mylog_btn_1" value="이상형 설정하기" onclick="javascript:m_reason_layer_popup();">
				</div>		<!-- ## log_content_box end ## -->
			</div>