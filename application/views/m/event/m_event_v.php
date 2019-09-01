

	<div class="margin_top_10"></div>
	
	<?
		if(!@empty($mlist)){
			foreach($mlist as $data){
	?>
	<div class="width_95per margin_auto" onclick="javascript:m_url_redirect('<?=$data['m_idx']?>', '<?=$data['m_move_url']?>');">
		<img src="/upload/naver_upload/event/<?=$data['m_list_img_url']?>" class="width_100per">
		<div class="m_event_text margin_bottom_10">
			<div class="width_95per margin_auto line-height_20">
				<b><?=$data['m_title']?></b>
				<p style="text-overflow: ellipsis; white-space:nowrap; overflow:hidden;"><?=$data['m_sub_content']?></p>
			</div>
		</div>
	</div>
	<?
			}
		}else{
	?>
	<!-- 등록된 이벤트가 없을 경우 -->
	<?
		}
	?>

	