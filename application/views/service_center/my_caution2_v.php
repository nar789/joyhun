<div class="content">

	<div class="left_main width_760">
		<div class="margin_bottom_30">
			<b class="font-size_18 color_333">나의 경고기록</b>
		</div>
		
		<div class="police_caution_hader">
			<div class="police_caution_img">
				<?=$this->member_lib->member_thumb($user['m_userid'],128,143)?>
			</div>

			<div class="width_512 height_250 ver_top block">
				<div class="police_caution_box_01">
					<span class="blod font-size_16 color_333"><?=$user['m_userid']?></span>
					<span class="blod font-size_16 color_999">님은 처벌 내용이 없습니다.</span>
				</div>

				<div class="width_512 height_122 block ver_top margin_left_18" >
					<table class="police_border_table">
						<tr>
							<td class="police_td_01">닉네임</td> 
							<td class="police_td_02"><?=$user['m_nick']?></td>
							<td class="police_td_01">지역</td>
							<td class="police_td_02"><?=$user['m_conregion']?> <?=$user['m_conregion2']?></td>
						</tr>
						<tr>
							<td class="police_td_01">포인트</td> 
							<td class="police_td_02"><? if(@$tp['total_point']){ echo number_format($tp['total_point'])?> p <? }else{ ?>0 p<? } ?></td>
							<td class="police_td_01">원하는만남</td>
							<td class="police_td_02"><?=want_reason_data($user['m_reason'])?></td>
						</tr>
						<!-- <tr>
						<td class="police_td_01">등급</td> 
						<td class="police_td_02">폭탄</td>
						<td class="police_td_01">신뢰도</td> 
						<td class="police_td_02">228</td>
						</tr> -->
					</table><!-- 
					<div class="margin_top_45 color_999">
						* 처벌단계는 <b>처벌기준>처벌예시</b>에서 확인이 가능합니다.
						<input type="button" class="text_btn_dcdcdc blod width_85 height_22" value="등급안내" onclick="javascirpt:location.href='/service_center/joy_police/punishment3';">
					</div> -->
				</div>
			</div>
		</div>
		

		
		<!-- 신고내용 시작 -->
		
		<?=$tab_menu?>

		<div class="margin_top_32 margin_bottom_10">
			<span class="font-size_16 color_333">나의 신고내용을 확인할 수 있습니다.</span>
			<div class="police_btn_01 pointer" onclick="complain_request('<?=$user['m_userid']?>','460')">신고하기</div>
		</div>
		<div class="clear"></div>

		<ul class="police_table_2">
			<li class="width_70">번호</li>
			<li class="width_130">닉네임</li>
			<li class="width_170">신고사유</li>
			<li class="width_110">신고일</li>
			<li	class="width_150">처벌상태</li>
			<li	class="width_110">처벌일</li>
		</ul>
		<?php
		if( $getTotalData > 0 )
		{

			$count = 0;

			foreach($mlist as $data)
			{
					$number = $getTotalData - ($rp * ($page-1)) - $count;
					$count = $count + 1;
		?>		

		<div class="height_40 border_bottom_1_ececec">
			<div class="width_70 block color_999 line-height_40 text-center"><?=$number?></div>
			<div class="width_130 block color_999 line-height_40 text-center"><?=$data['r_nick']?></div>
			<div class="width_170 block color_999 line-height_40 text-center"><?=police_cate($data['c_cate'])?></div>
			<div class="width_110 block color_999 line-height_40 text-center"><?=trim_text($data['c_date'],10,'')?></div> 
			<div class="width_150 block color_999 line-height_40 text-center"><?=police_ing($data['c_success'])?></div>
			<div class="width_110 block color_999 line-height_40 text-center"><?=trim_text($data['cp_date'],10,'')?></div>
		</div>
		
		<? }
		}else{?>

		<div class="height_81 border_bottom_2_ececec">
			<div class="margin_auto text-center">
				<div class="block">
				<img src='<?=IMG_DIR?>/service_center/joy_police_05_02.gif' class="margin_top_20 block">
				</div>
				<div class="color_999 ver_top padding_top_35 padding_left_13 block ">
				해당 내역이 없습니다.</div>
			</div>
		</div>
		<?php } ?>


		<div class="list_pg margin_top_15">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>
	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>