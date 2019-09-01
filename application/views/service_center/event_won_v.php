<div class="content">

	<div class="left_main width_760">
		<p class="color_333 blod font-size_18">이벤트</p>

		<?=$call_tabmenu?>

		<table class="board_list" cellspacing="0" cellpadding="0">
			<tr>
				<th class="width_90">번호</th>
				<th class="width_auto">제목</th>
				<th class="text-center">날짜</th>
			</tr>
			<?php

			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
			?>		
			<tr>
				<td><?=$data['m_idx']?></td>
				<td class="text-left padding_left_60"><a href="/service_center/event/event_mb_view/m_idx/<?=$data['m_idx']?>" class="color_333 font-size_14"><?=$data['m_title']?></a></td>
				<td class="text-center padding_0"><?=$data['m_write_day']?></td>
			</tr>
<?
				}
			}else{
			?>
			<tr>
				<td colspan="3">
					<div class="light_img_null">
						<img src="/images/meeting/light_null.gif">
						<div class="ver_top margin_top_0">
							<?=$null_text?>
						</div>
						<div class="clear"></div>
					</div>		<!-- ## light_img_null end ## -->
				</td>
			</tr>
			<? } ?>
		</table>

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>
	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>
