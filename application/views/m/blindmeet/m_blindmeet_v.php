<div class="m_main_area padding_bottom_20">

	<div class="width_95per margin_auto">
		
		<div class="width_100per margin_top_10">
			<img src="<?=IMG_DIR?>/m/blind_top.gif" class="blind_none_img">
		</div>


		<? 
			//cnt 값이 0일 경우 오늘 소개팅을 받지 않은 회원
			//cnt 값이 0보다 클 경우 오늘 소개팅을 받은 회원
			if($cnt == "0"){ 
		?>

		<div class="width_100per blind_none_area bg_fff">
				<img src="<?=IMG_DIR?>/m/blind_none.gif">

				<div class="width_100per text-center">
					<p class="blind_none_text">매일 오전 9시 회원님과 어울리는 이성을 소개해드립니다.<br>호감가는 이성에게 '좋아요'를 눌러보세요~</p>
				</div>

	 
				<div class="width_95per margin_auto">
					<input type="button" class="text_btn_36c8e9 blind_none_btn width_100per" value="소개팅시작하기" onclick="javascript:m_blind_start();">
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<? }else{ ?>

		<!-- ## 본인인증 한사람 소개팅 리스트 ## -->
		<div id="blind_slider">
			<ul>

				<? for($i=0; $i<3; $i++){ ?>
				<li>
					<div class="blind_thum">
						<?=$this->member_lib->member_thumb(${"today_list_".$i}['m_userid'], 200, 200)?>
					</div>
					<div class="blind_text">
						<p><?=${"today_list_".$i}['m_nick']?> <span class="color_999"><?=${"today_list_".$i}['m_age']?>세</span></p>
						<p class="color_666"><?=${"today_list_".$i}['m_conregion']?> <?=${"today_list_".$i}['m_conregion2']?> | <?=want_reason_data(${"today_list_".$i}['m_reason'])?></p>
					</div>
					<div class="blind_good_btn" onclick="javascript:m_ilike_check('<?=${"today_list_".$i}['m_num']?>');">
						<img src="<?=IMG_DIR?>/m/good_ic.png"> 좋아요
					</div>
				</li>
				<? } ?>
				
				<? 
					//한명더 추가로 소개팅을 받았을때의 조건 
					if(empty($more_cnt)){ 
				?>
				<li id="one_more">
					<div class="blind_thum">
						<img src="<?=IMG_DIR?>/m/goo_ic.gif">
						<p class="good_text">좋아요~누르고 커플되자!</p>
					</div>
					<div class="blind_text" onclick="javascript:m_one_more();">
						<b>한명더 소개받기</b>
					</div>
				</li>
				<? }else{ ?>
				<li>
					<div class="blind_thum">
						<?=$this->member_lib->member_thumb($today_list_3['m_userid'], 200, 200)?>
					</div>
					<div class="blind_text">
						<p><?=$today_list_3['m_nick']?> <span class="color_999"><?=$today_list_3['m_age']?>세</span></p>
						<p class="color_666"><?=$today_list_3['m_conregion']?> <?=$today_list_3['m_conregion2']?> | <?=want_reason_data($today_list_3['m_reason'])?></p>
					</div>
					<div class="blind_good_btn" onclick="javascript:m_ilike_check('<?=$today_list_3['m_num']?>');">
						<img src="<?=IMG_DIR?>/m/good_ic.png"> 좋아요
					</div>
				</li>
				<? } ?>

			</ul>
		</div>
		<div class="btn_area">
			<div class="btn_prev"><img src="<?=IMG_DIR?>/m/m_blindarrow.png" style="width:40%;"></div>
			<div class="btn_next"><img src="<?=IMG_DIR?>/m/m_blindarrow_r.png" style="width:40%;"></div>
		</div>

		<div class="paging margin_top_5"></div>

		<div class="mgood_setting" onclick="location.href='/blindmeet/blind/recv_like'">
			좋아요 관리함
		</div>

		<? } ?>

	</div>

</div>