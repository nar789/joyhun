
	<?=$call_tabmenu?>

	<div class="width_95per margin_auto">

		<div class="padding_top_10">
			<p class="color_666 line-height_18">내가 상대방에게 보낸 ‘좋아요’입니다.<br>
			상대방이 수락하지 않으면 <span class="color_ea3c3c">다시 ‘좋아요’</span>를 보내보세요~</p>
		</div>
		
		<? if($getTotalData > 0){ ?>

		<table class="m_recv_list">

			<? 
				$j = 0;
				$k = 1;
				for($i=0; $i<=$max_row; $i++){ 
					if(!empty($mlist[$j]['r_useridx']) || !empty($mlist[$k]['r_useridx'])){
			?>
			<tr>

<?

$searchName_G = "/m/m_girl_ic.png";
$searchName_M = "/m/m_man_ic.png";

 ?>
				<td>
					<div class="m_recv_box">
						<div class="dis_table width_90per margin_auto">
							<div class="m_good_thum">
								
								<? 
									$user_pic = $this->member_lib->member_thumb($mlist[$j]['m_userid'], 200, 200);
									
									// 프로필사진이없는 여자
									if(strpos($user_pic, $searchName_G) !== false) {  ?>
										<div class="bg_fdbdba m_like_bg">
											<?=$this->member_lib->member_thumb($mlist[$j]['m_userid'], 200, 200);?>
										</div>
									<?
									// 프로필사진없는 남자
									}else if(strpos($user_pic, $searchName_M) !== false) {  ?>
										<div class="bg_b2e4ef m_like_bg">
											<?=$this->member_lib->member_thumb($mlist[$j]['m_userid'], 200, 200);?>
										</div>
									<?
									// 프로필사진있으면
									} else {  ?>
										<?=$this->member_lib->member_thumb($mlist[$j]['m_userid'], 200, 200);?>
									<?
									}  
								?>
							</div>
							<div class="g_stamp_per">
								<img src="<?=IMG_DIR?>/m/good_stamp.png">
							</div>
							<div class="dis_row">
								<div class="blind_good_btn" onclick="javascript:m_ilike_check('<?=$mlist[$j]['r_useridx']?>');">
									<img src="<?=IMG_DIR?>/m/good_ic.png"> 좋아요
								</div>
							</div>
						</div>
					</div>
				</td>

				<td>
					<? if($dot == "null" && $i == $max_row){}else{ ?>
					<div class="m_recv_box">
						<div class="dis_table width_90per margin_auto">
							<div class="m_good_thum">
								<? 
									$user_pic = $this->member_lib->member_thumb($mlist[$k]['m_userid'], 200, 200);
									
									// 프로필사진이없으면
									if(strpos($user_pic, $searchName_G) !== false) {  ?>
										<div class="bg_fdbdba m_like_bg">
											<?=$this->member_lib->member_thumb($mlist[$k]['m_userid'], 200, 200);?>
										</div>
									<?
									// 프로필사진없는 남자
									}else if(strpos($user_pic, $searchName_M) !== false) {  ?>
										<div class="bg_b2e4ef m_like_bg">
											<?=$this->member_lib->member_thumb($mlist[$j]['m_userid'], 200, 200);?>
										</div>
									<?
									// 프로필사진있으면
									} else {  ?>
										<?=$this->member_lib->member_thumb($mlist[$k]['m_userid'], 200, 200);?>
									<?
									}  
								?>
							</div>
							<div class="g_stamp_per">
								<img src="<?=IMG_DIR?>/m/good_stamp.png">
							</div>
							<div class="dis_row">
								<div class="blind_good_btn" onclick="javascript:m_ilike_check('<?=$mlist[$k]['r_useridx']?>');">
									<img src="<?=IMG_DIR?>/m/good_ic.png"> 좋아요
								</div>
							</div>
						</div>
					</div>
					<? } ?>
				</td>
				
			</tr>
			<? 
				$j = $j+2;
				$k = $k+2;
					}
				} 
			?>

		</table>

		<? }else{ ?>

		<div class="good_none">
			<img src="<?=IMG_DIR?>/m/good_setting.gif" class="width_100per">

			<p class="color_ff87a0 blod">아직 보낸 ‘좋아요’가 없습니다.</p>

			<p class="color_999 blod margin_top_10 line-height_20">내 인연이 숨어있을지 몰라요~<br>좋아요 누르고 좋은인연 만들어보세요~</p>

			<input type="button" class="profile_go_btn" value="소개팅 하러가기" onclick="javascript:location.href='/blindmeet/blind';">
		</div>

		<? } ?>


	</div>