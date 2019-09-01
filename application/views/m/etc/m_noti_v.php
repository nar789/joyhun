<div id="noti_box" class="iphone_padding">

	<?
		if($getTotalData > 0){

			foreach($mlist as $data){
	?>
	<div>
		<div class="board_area" onclick="javascript:comment_view('<?=$data['idx']?>');" id="<?=$data['idx']?>">
			<div class="width_95per margin_auto">
				<div class="float_left width_70per height_47">
					<b class="board_title text_cut">[공지] <?=$data['n_title']?></b>
				</div>
				<div class="float_right ">
					<span class="board_day color_999 width_25per ver_top"> <?=date('Y.m.d', strtotime($data['n_date']))?> </span>
					<img src="<?=IMG_DIR?>/service_center/faq_down.gif">
				</div>
			</div>
		</div>
		<div class="clear"></div>

		<div id="m_noti_comt_<?=$data['idx']?>" class="board_comt">
			<?=nl2br($data['n_content'])?>
		</div>
	</div>
	<?
			}
		}else{
	?>
	<div class="board_area bold text-center">
		등록된 공지사항이 없습니다.
	</div>
	<?
		}
	?><!-- 
	<div class="borad_add">
		<div id="more" page="<?=$page+1?>" class="board_more text-center">
			more &nbsp;<div></div>
		</div>
	</div> -->
	
	<div id="notice_list" alt="<?=$scroll?>">
	</div>

	<? if(count($mlist) > 10){ ?>

	<div class="borad_add">
		<div id="more" name="more" onclick="noti_more();" class="board_more text-center">
			more &nbsp;<div></div>
		</div>
	</div>

	<? } ?>
	
</div>

<script>

function noti_more(){

	location.href='/service_center/notice/noti_list/page/<?=$page+10?>/start/<?=$data["idx"]?>';
}
</script>