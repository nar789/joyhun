

	<div class="magazine_top_text">
		<div class="float_left line-height_30">
			<b><?=$category?></b>
		</div>
		<div class="float_right width_30per">
			<div class="width_95per margin_auto mobile_select">
				<select id="tabmenu" name="tabmenu" class="border_none height_28 width_100per border_0 text_5 color_666">
					<option value="1" <? if($tabmenu == "1"){ echo "selected"; } ?> >전체</option>
					<option value="2" <? if($tabmenu == "2"){ echo "selected"; } ?> >이색데이트</option>
					<option value="3" <? if($tabmenu == "3"){ echo "selected"; } ?> >축제속으로</option>
					<option value="4" <? if($tabmenu == "4"){ echo "selected"; } ?> >여행지정보</option>
					<option value="5" <? if($tabmenu == "5"){ echo "selected"; } ?> >공연&전시</option>			
					<option value="6" <? if($tabmenu == "6"){ echo "selected"; } ?> >맛집베스트</option>
					<option value="7" <? if($tabmenu == "7"){ echo "selected"; } ?> >카&재테크</option>
				</select>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<?
		if(!empty($mlist)){
			foreach($mlist as $data){
	?>
	<div class="width_95per margin_auto" onclick="javascript:magazine_view('<?=$data['idx']?>');">
		<img src="/upload/naver_upload/magazine/<?=$data['m_list_img_url']?>" class="width_100per">
		<div class="m_event_text margin_bottom_10">
			<div class="width_95per margin_auto line-height_20">
				<b><?=$data['title']?></b>
				<p style="text-overflow: ellipsis; white-space:nowrap; overflow:hidden;"><?=$data['ahead_text']?></p>
			</div>
		</div>
	</div>
	<?
			}
		}else{
	?>
	<!-- 등록된 이벤트가 없을 경우 -->
	<script type="text/javascript">
		alert("아직 등록된 게시물이 없습니다.");
		location.href = "/service_center/joy_magazine/all";
	</script>
	<?
		}
	?>
	
	<div id="more_div"></div>	
	
	<? if(@$getTotalData > 10 ){	//게시물이 10개 이하일때는 more 버튼 숨기기 ?>
	<div id="more_btn" class="borad_add">
		<div id="more" page="<?=$page+1?>" class="board_more text-center">
			more &nbsp;<div></div>
		</div>
	</div>
	<? } ?>
