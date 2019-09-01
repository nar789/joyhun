	<script type="text/javascript">
				
		$(document).ready(function(){
			
			var position = new naver.maps.LatLng('<?=$map_point[1]?>', '<?=$map_point[0]?>');

			//지도 생성시에 옵션을 지정할 수 있습니다.
			var map = new naver.maps.Map('chat_member_map', {
				center: position, //지도의 초기 중심 좌표
				zoom: 8, //지도의 초기 줌 레벨
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
					url: 'http://www.joyhunting.com/images/chatting/your_position.png',
					size: new naver.maps.Size(40,40),
					origin: new naver.maps.Point(0, 0),
					anchor: new naver.maps.Point(11, 35)
				}
			};

			var marker = new naver.maps.Marker(markerOptions);
			
		});

	</script>

<input type="hidden" id="greeting" name="greeting" value="<?=$greeting?>">

<div class="padding_10">

	<b class="color_e15148 font-size_14"><?=$m_nick?>(<?=$m_age?>)</b><span class="color_999 blod"> <?=$m_conregion?> <?=$m_conregion2?></span>
	<span style="float:right;" class="_distance"><font style="font-size:14px;">거리 : <b style="color:#D07C91; font-size:14px;"><?=$to_distance?></b></font></span>

	<div style="border:solid 1px #D1D1D1; position:relative; width:100% !important; height:150px; margin-top:10px; overflow:hidden;" class="_map_area">
		<div id="chat_member_map" style="position:relative; width:300px; overflow:hidden; height:150px;"></div>
	</div>

	<table class="width_98per margin_top_7">
		<tr>
			<td class="width_35per">
				<div class="recv_chat_area pointer" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');">
					<?=$this->member_lib->member_thumb($m_userid,80,125)?>
				</div>
			</td>
			<td class="width_65per">
				<? if($greeting == "1"){ ?>
				<p style="width:100%; height:20px; font-weight:bold; color:#404040; font-size:1.1em;">인사말</p>
				<? } ?>

				<textarea class="send_chat_text border_0" readonly><?=str_replace("(인사말)", "", $chat['contents'])?></textarea>
				<div class="m_chat_info" style="padding-top:5px;">
					<ul>
						<? if($this->session->userdata['m_sex'] == "M"){ ?>
						<li><span class="color_ea3c3c font-size_10 margin_left_mi_4">건당 <?=$chat_pd['m_point']?>P 차감됩니다.
						<? } ?>
						<li><span class="color_999 font-size_10 margin_left_mi_4">회원님의 현재포인트: <?=number_format(@$total_point)?></span></li>
					</ul>
				</div>
			</td>
		</tr>
	</table>

	

</div>

<div class="bg_3e3e3e padding_10">

	<div class="width_100per margin_auto mobile_select">
		<select class="border_none height_28 width_100per bg_fff border_0 text_5" id="deny_msg">
			<option value="">거절메세지를 선택할 수 있습니다.</option>
			<?
				foreach( chat_deny_msg('all') as $key => $val ){	//code change helper
					echo "<option value='$key'>$val</option>";
				}
			?>
			
		</select>
	</div>


	<table style="width:100.5%; margin-top:2%;">
		<tr>
			<td class="width_50per text-left"><input type="button" class="m_pop_btn" value="거절" onclick="chat_deny('<?=$m_userid?>');"></td>
			<td class="width_50per text-right"><input type="button" class="m_pop_btn" value="수락" onclick="chat_accept_flg('<?=$m_userid?>', '<?=$chat['idx']?>');"></td>
		</tr>
	</table>
</div>

<style>
#chat_member_map img{ width:100% !important; height:100% !important; }
</style>