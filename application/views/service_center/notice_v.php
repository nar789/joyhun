<div class="content">

	<div class="left_main width_760">

		<p class="color_333 blod font-size_18">공지사항</p>

		<table class="board_list" cellspacing="0" cellpadding="0">
			<tr>
				<th>번호</th>
				<th>분류</th>
				<th>제목</th>
				<th>날짜</th>
			</tr>
			<?php
			if( $getTotalData > 0 )
			{
				
				$count = 0;
				foreach($mlist as $data)
				{	
					$number = $getTotalData - ($rp * ($page-1)) - $count;
					$count = $count + 1;
			?>			
			<tr>
				<td><?=$number?></td>
				<td><?=$data['sel1']?></td>
				<td><a href="/service_center/notice/noti_view/idx/<?=$data['idx']?>/page/<?=$page?>" class="margin_left_19"><?=$data['n_title']?></a></td>
				<td><?=change_date($data['n_date'])?></td>
			</tr>
			<!-- ## for end ## -->
			<?
				}
			}else{
			?>
			<tr>
				<td colspan=4>
						등록된 공지사항이 없습니다.
				</td>
			</tr>
			<?}?>

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