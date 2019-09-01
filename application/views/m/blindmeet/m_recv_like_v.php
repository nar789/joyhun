
	<?=$call_tabmenu?>

	<div class="width_95per margin_auto">

		<? if($getTotalData > 0){ ?>
		<table class="m_recv_list">
			
			<? 
				$j = 0;
				$k = 1;
				for($i=0; $i<=$max_row; $i++){ 
					if(!empty($mlist[$j]['s_userid']) || !empty($mlist[$k]['s_userid'])){
			?>
			<tr>
				<td>
					<div class="m_recv_box">
						<div class="dis_table width_95per margin_auto">
							<div class="m_good_thum">
								<?=$this->member_lib->member_thumb($mlist[$j]['s_userid'], 200, 200)?>
							</div>
							<div class="dis_row">
								<div class="m_good_btn" onclick="javascript:m_ilike_check('<?=$mlist[$j]['s_useridx']?>');">
									수락
								</div>
							</div>
						</div>
					</div>
				</td>
				<td>
					<? if($dot == "null" && $i == $max_row){}else{ ?>
					<div class="m_recv_box">
						<div class="dis_table width_95per margin_auto">
							<div class="m_good_thum">
								<?=$this->member_lib->member_thumb($mlist[$k]['s_userid'], 200, 200)?>
							</div>
							<div class="dis_row">
								<div class="m_good_btn" onclick="javascript:m_ilike_check('<?=$mlist[$k]['s_useridx']?>');">
									수락
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
		<div class="padding_top_10">
			<p class="color_666 line-height_18">상대방이 나에게 보낸‘좋아요’입니다.<br>
			더욱 친해지길 원하시면 <span class="color_ea3c3c">‘수락’</span>을 눌러 특별한 인연이 되어보세요~</p>
		</div>


		<div class="good_none">
			<img src="<?=IMG_DIR?>/m/good_setting.gif" class="width_100per">

			<p class="color_ff87a0 blod">아직 받은 ‘좋아요’가 없습니다.</p>

			<p class="color_999 blod margin_top_10 line-height_20">세상에서 제일 잘나온 대표사진으로<br>바꾸면 좋은인연 만나실거에요~</p>

			<input type="button" class="profile_go_btn" value="내 프로필 수정하기" onclick="javascript:location.href='/profile/main/user'">
		</div>
		<? } ?>


	</div>