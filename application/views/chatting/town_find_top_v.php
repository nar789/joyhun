
<div class="town_area">

	<div class="float_left">
		<p class="color_333 font-size_18 blod margin_left_4 margin_top_5">5분거리 접속이성 찾기</p>
		<div class="town_box margin_top_9 padding_left_9 padding_top_10">
			<span class="color_999">지금 내 주변에 이성을 한눈에~<br>같은 지역에 접속한 이성은 누구?</span>

			<div class="select_box_border margin_top_19 float_left">
				<select class="width_71 height_36" name="town_area_1" id="town_area_1" onchange="area_select(this.value,'town_area_2');">
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
			<div class="select_box_border margin_top_19 margin_left_2 float_left">
				<select class="width_91 height_36" name="town_area_2" id="town_area_2">
					<option value="강남구">강남구</option>
				</select>
			</div>
			<input type="button" class="text_btn_ea3e3e width_165 height_37 margin_top_5" value="검색하기" onclick="javascript:m_area_search();">
		</div>
	</div>
	
	<div class="float_right" id="member_map" style="width:506px; height:188px;">
	
	</div>

</div>
<div class="clear"></div>


<script type="text/javascript">
			
	$(document).ready(function(){

		//지도 생성시에 옵션을 지정할 수 있습니다.
		var map = new naver.maps.Map('member_map', {
			center: new naver.maps.LatLng('<?=$map_y_point?>', '<?=$map_x_point?>'), //지도의 초기 중심 좌표
			zoom: 10, //지도의 초기 줌 레벨
			minZoom: 1, //지도의 최소 줌 레벨
			zoomControl: false, //줌 컨트롤의 표시 여부
			zoomControlOptions: { //줌 컨트롤의 옵션
				position: naver.maps.Position.TOP_RIGHT
			}
		});

		<?=@$member_geo?>
	
	});

</script>


<style>
#member_map img{ width:100% !important; height:100% !important; }
</style>