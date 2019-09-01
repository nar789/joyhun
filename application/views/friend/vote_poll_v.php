<div class="content">

	<div class="left_main">

		<?=$call_top?>

		<div class="clear"></div>


		<ul class="poll_table">
			<li class="width_70">번호</li>
			<li class="width_380">투표내용</li>
			<li class="width_93">날짜</li>
			<li class="width_60 text-right">참여자</li>
		</ul>

		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
		<div class="poll_tr">
			<div class="width_70 color_999">
				<?=$data['m_code']?>
			</div>
			<div class="width_380 text-left pointer">

				<? if($data['m_last_day'] >= date('Y-m-d')){ ?>
				<div class="margin_left_15 margin_right_8 text_btn_fd680a">진행중</div>
				<? }else{ ?>
				<div class="block margin_left_15 width_48"></div>
				<? } ?>

				<span class="font-size_14"><?=$data['m_title']?></span>
			</div>
			<div class="width_93 color_999">
				<?=str_replace('-', '.', $data['m_start_day'])?>
			</div>
			<div class="width_60 text-right color_999">
				<?=$data['m_readnum']?>명
			</div>
			<div class="margin_left_23">
				<? if(member_vote_chk($data['m_code']) == "1"){ ?>
				<input type="button" class="text_btn_dcdcdc width_60 height_22 blod color_333" value="현황보기" onclick="javascript:vote_poll_view(<?=$data['m_code']?>);">
				<? }else{ ?>
				<input type="button" class="text_btn_dcdcdc width_60 height_22 blod color_333" value="참여하기" onclick="javascript:vote_poll(<?=$data['m_code']?>);">
				<? } ?>
			</div>
		</div>
		
		<?
				}
			}else{
		?>
		<!-- 등록된 투표가 없을 경우 -->
		<?
			}
		?>

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?=$pagination_links?>
			</div>
		</div>



	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>