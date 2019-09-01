<input type="hidden" id="greeting" name="greeting" value="<?=$greeting?>">

<div class="layout_padding">
	<div class="alarm_chat_area">
		<p class="font-size_14 color_333"><?=$m_nick?> <span class="font-size_12 color_999"><?=$add_text?></span> <span style="float:right;"><font style="font-size:14px;">거리 : <b style="color:#D07C91; font-size:14px;"><?=$to_distance?></b></font></span></p>
		
		<div style="border:solid 1px #D1D1D1; width:100%; height:150px; margin-top:10px;">
		<div id="chat_member_map" style="width:420px; height:150px;">

		</div>
		</div>

		<div class="margin_top_10">
			<a href="#" onclick="javascript:member_photo_view_pop('<?=$m_userid?>');"><?=$this->member_lib->member_thumb($m_userid,123,124)?></a>
			<? if($greeting == "1"){ ?>
			<p style="position:absolute; width:265px; height:30px; top:257px; left:152px; line-height:30px; font-size:1.2em; font-weight:bold; color:#404040;">인사말</p>
			<? } ?>
			<textarea class="alarm_chat_text ver_top" placeholder="<?=user_chat_words()?>" id="sin_msg" name="sin_msg" <?=@$readonly?>><?=str_replace("(인사말)", "", @$contents)?></textarea>
			<div class="alarm_chat_guid">
				<ul class="alarm_chat_guid_box">
					<? if($this->session->userdata['m_sex'] == "M"){ ?>
					<li class="padding_bottom_3 color_666"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top"><span class="color_333">채팅 <?=$text_value?>시 건당 70P</span> 차감됩니다.</li>
					<? } ?>
					<li class="color_666 padding_bottom_3"><img src="<?=IMG_DIR?>/layer_popup/chat_apply_li.gif" class="ver_top">회원님의 현재 포인트 : <span class="color_ea3c3c">
						<? if(@$tp['total_point']){ ?>
						 <?=number_format($tp['total_point'])?> P
						 <? }else{ ?>
						 0 P
						 <? } ?></span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="margin_top_30 text-center padding_bottom_10" <?=@$display?>>
		<input type="button" class="text_btn_de4949 alarm_chat_btn" value="<?=$text_value?>하기" onclick="<?user_check($v_function."('".$m_userid."');",5 );?>">
	</div>
</div>

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
				anchor: new naver.maps.Point(0, 35)
			}
		};

		var marker = new naver.maps.Marker(markerOptions);
		
	});

</script>

<style>
#chat_member_map img{ width:100% !important; height:100% !important; }
</style>