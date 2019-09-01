
<script type="text/javascript">
	
	$(document).ready(function(){

		var position = new naver.maps.LatLng('<?=$ypoint?>', '<?=$xpoint?>');

		//지도 생성시에 옵션을 지정할 수 있습니다.
		var map = new naver.maps.Map('member_map', {
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
			title: "내위치",
			icon: {
				url: 'http://'+$(location).attr('host')+'/images/chatting/my_position.png',
				size: new naver.maps.Size(55,55),
				origin: new naver.maps.Point(0, 0),
				anchor: new naver.maps.Point(11, 35)
			}
		};

		var marker = new naver.maps.Marker(markerOptions);
		

		naver.maps.Event.addListener(map, 'click', function(e) {
			marker.setPosition(e.coord);
			$("#marker").val(e.coord);			
			$("#marker").val($("#marker").val().replace('(lat:', '').replace(')', '').replace('lng:', ''));
			
			var $marker = $("#marker").val().split(',');
			$("#marker").val($marker[1]+","+$marker[0]);
			m_my_position_ajax($("#marker").val());
		});
		

	});

</script>

<input type="hidden" id="my_position" name="my_position" value="<?=@$my_position?>">

<div class="border_bottom_1_ececec bg_fff">
	<div class="m_top_cont_box">
		<div class="m_top_cont_img_box">
			<img src="<?=IMG_DIR?>/m/m_town_friend_ic.gif">
		</div>
		<b>현재위치</b>
	</div>
	<div class="select_box_border float_left padding_3per width_21per">
		<select class="width_125per height_37" id="town_area_1" name="town_area_1" onchange="javascript:area_select(this.value,'town_area_2');">
			<option value="서울" <? if($val1 == "서울"){ echo "selected"; } ?> >서울</option> 
			<option value="인천" <? if($val1 == "인천"){ echo "selected"; } ?> >인천</option> 
			<option value="부산" <? if($val1 == "부산"){ echo "selected"; } ?> >부산</option> 
			<option value="대구" <? if($val1 == "대구"){ echo "selected"; } ?> >대구</option> 
			<option value="대전" <? if($val1 == "대전"){ echo "selected"; } ?> >대전</option> 
			<option value="광주" <? if($val1 == "광주"){ echo "selected"; } ?> >광주</option> 
			<option value="울산" <? if($val1 == "울산"){ echo "selected"; } ?> >울산</option> 
			<option value="경기" <? if($val1 == "경기"){ echo "selected"; } ?> >경기</option> 
			<option value="강원" <? if($val1 == "강원"){ echo "selected"; } ?> >강원</option> 
			<option value="세종" <? if($val1 == "세종"){ echo "selected"; } ?> >세종</option> 
			<option value="충남" <? if($val1 == "충남"){ echo "selected"; } ?> >충남</option> 
			<option value="충북" <? if($val1 == "충북"){ echo "selected"; } ?> >충북</option> 
			<option value="경남" <? if($val1 == "경남"){ echo "selected"; } ?> >경남</option> 
			<option value="경북" <? if($val1 == "경북"){ echo "selected"; } ?> >경북</option> 
			<option value="전남" <? if($val1 == "전남"){ echo "selected"; } ?> >전남</option> 
			<option value="전북" <? if($val1 == "전북"){ echo "selected"; } ?> >전북</option> 
			<option value="제주" <? if($val1 == "제주"){ echo "selected"; } ?> >제주</option>
		</select>
	</div> 
	<div class="select_box_border float_left padding_3per width_14per">
		<select class="width_125per height_37" id="town_area_2" name="town_area_2">
			<option value="강남구">강남구</option>
		</select>
	</div>
	<div class="select_box_border float_left padding_3per width_14per" onclick="javascript:m_area_position_search();">
		<div class="m_top_cont_btn pointer">검색</div>
	</div>
	<div class="clear"></div>
</div>

<input type="hidden" id="marker" name="marker" value="<?=$marker?>">
<div id="town_map_layer" style="position:relative; width:100%;">
	<div id="member_map">
	</div>
</div>

<div style="position:relative; width:100%; height:40px; margin-top:30px; text-align:center; font-weight:bold; font-size:1.3em; color:#EA3C3B;">
	지도를 터치하시면 위치를 변경하실 수 있습니다.
</div>

<div style="position:relative; width:100%; height:50px; margin-top:10px;">
	<div id="btn_save" class="my_position_save">
		확인
	</div>
</div>