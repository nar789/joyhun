
<script type="text/javascript">
				
	$(document).ready(function(){
		
		var position = new naver.maps.LatLng('<?=$map_point[1]?>', '<?=$map_point[0]?>');

		//지도 생성시에 옵션을 지정할 수 있습니다.
		var map = new naver.maps.Map('chat_member_map', {
			center: position, //지도의 초기 중심 좌표
			zoom: 10, //지도의 초기 줌 레벨
			minZoom: 1, //지도의 최소 줌 레벨
			zoomControl: false, //줌 컨트롤의 표시 여부
			zoomControlOptions: { //줌 컨트롤의 옵션
				position: naver.maps.Position.TOP_RIGHT
			}
		});
		
		//신청자위치
		var markerOptions = {
			position: position,
			map: map,
			title: "<?=$m_nick?>님 위치",
			icon: {
				url: '<?=$user_img_src?>',
				size: new naver.maps.Size(40,40),
				origin: new naver.maps.Point(0, 0),
				anchor: new naver.maps.Point(11, 35)
			}
		};

		var marker = new naver.maps.Marker(markerOptions);		
		
		$("#chat_member_map > div > div > div > div > div > div").css("border-radius", "100px");

	});

</script>

<div class="padding_10">

	<b class="color_e15148 font-size_14"><?=$m_nick?></b><span class="color_999 blod"> <?=$add_text?></span>
	<span style="float:right;" class="_distance"><font style="font-size:14px;">거리 : <b style="color:#D07C91; font-size:14px;"><?=$to_distance?></b></font></span>
	
	<div style="border:solid 1px #D1D1D1; position:relative; width:100% !important; height:150px; margin-top:10px; overflow:hidden;" class="_map_area">
		<div id="chat_member_map" style="position:relative; width:300px !important; overflow:hidden; height:150px !important;"></div>
	</div>

	<table class="width_100per margin_top_7">
		<tr>
			<td class="width_35per ver_top">
				<div class="send_chat_area pointer" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');">

					<? if($m_filename){ ?>
						<?=$this->member_lib->member_thumb($m_userid,123,124)?>
					<? }else{ ?>
						<? if($m_sex == 'M'){?>
						<img src="<?=IMG_DIR?>/m/m_popup_man.gif">
						<?}else{?>
						<img src="<?=IMG_DIR?>/m/m_popup_girl.gif">
						<?}?>
						<div class="send_pic_info">
							<p style="margin-top:2px;">사진은 채팅창에서<br>보실 수 있습니다.</p>
						</div>
					<? } ?>
				</div>
			</td>
			<td class="width_65per">
				<textarea class="send_chat_text border_0" style="height:61px;" placeholder="<?=user_chat_words()?>" id="sin_msg" name="sin_msg"></textarea>
				<div class="m_chat_info" style="line-height:18px;padding-top:5px; padding-bottom:5px;">
					<ul>
						<li><span class="color_ea3c3c font-size_10 margin_left_mi_8">
							<? if($m_sex == 'F'){?>건당 70P 차감됩니다. 
								<? if(@$tp['total_point']){ ?>
								<? }else{ ?>
								0 P
								 <? } ?>
							<?}else{?>
								메시지 무료 이용가능
							<?}?>
						</span></li>
						<li><span class="color_999 font-size_10 margin_left_mi_8">회원님의 현재포인트 : <?=number_format(@$tp['total_point'])?> P</span></li>
					</ul>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="bg_3e3e3e padding_10">
	<table style="width:100.5%; ">
		<tr>
			<td class="width_50per text-left"><input type="button" class="m_pop_btn" value="취소" onclick="modal.close();"></td>
			<td class="width_50per text-right"><input type="button" class="m_pop_btn" value="전송" onclick="chat_submit('<?=$m_userid?>', '<?=@$gubn?>');"></td>
		</tr>
	</table>
</div>




<style>
	
	#chat_member_map img{ width:100% !important; height:100% !important; }

</style>

<script>


	$(document).ready(function(){

		var img_src = $(".send_chat_area > img").attr('src');


		// 사진있는회원이면
		if (img_src.indexOf('m_popup_man') == '-1') {
			
			$(".send_chat_area").addClass("send_chat_area2");
		
		}
		

	});

</script>