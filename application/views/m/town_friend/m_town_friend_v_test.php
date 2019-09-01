<script type="text/javascript">
	
	$(document).ready(function(){
		
		//지도 생성시에 옵션을 지정할 수 있습니다.
		var map = new naver.maps.Map('member_map', {
			center: new naver.maps.LatLng('<?=$map_y_point?>', '<?=$map_x_point?>'), //지도의 초기 중심 좌표
			zoom: 12, //지도의 초기 줌 레벨
			minZoom: 1, //지도의 최소 줌 레벨
			zoomControl: false, //줌 컨트롤의 표시 여부
			zoomControlOptions: { //줌 컨트롤의 옵션
				position: naver.maps.Position.TOP_RIGHT
			}
		});
		
		//내위치
		var markerOptions = {
			position: new naver.maps.LatLng('<?=$map_y_point?>', '<?=$map_x_point?>'),
			map: map,
			title: "내위치",
			icon: {
				url: 'http://'+$(location).attr('host')+'/images/chatting/my_position.png',
				size: new naver.maps.Size(55,55),
				origin: new naver.maps.Point(0, 0),
				anchor: new naver.maps.Point(11, 35)
			}
		};
		
		<? if($map_flag == ""){ ?>
		var marker = new naver.maps.Marker(markerOptions);
		<? } ?>
		
		<?=$add_marker?>		//데이터

		$("#member_map > div > div > div > div > div > div").each(function(){
			$(this).css("border-radius", "100px");
		});
	
	});

</script>

<div class="m_main_area">
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
		<div class="select_box_border float_left padding_3per width_14per" onclick="javascript:m_area_search();">
			<div class="m_top_cont_btn pointer">검색</div>
		</div>
		<div class="clear"></div>
	</div>


	
	<!-- ## 지도로보기 ## -->
	<div id="town_map_layer" class="posi_rel width_100per _map_area">
		<div class="m_town_map" id="member_map">
			
		</div>
	</div>
	<div class="posi_rel width_100per _area_text">
		<div class="m_map_text">
			<b class="color_ea3c3c"><?=$getTotalData?>명</b><span class="color_333 blod">의 이성이 5분거리에 있습니다.</span>
		</div>
	</div>
	<img src="<?=IMG_DIR?>/m/map_bottom_text_bg.png" style="width:100%; position:relative; margin-top:10px;" class="_area_text_img">
	<div class="m_mid_text_box">
		<b>5분거리</b>&nbsp;
		<b>접속이성</b>
		<div id="btn_position" class="m_cont_right_box margin_top_7 width_100">
			<div class="m_cont_right_btn_first blod ">내 위치 변경</div>
		</div>
	</div>
	<div id="tbl" style="position:relative; width:100%;">
	<?
		$last_km = (rand(1,2)/10);
		if($getTotalData > 0){
			foreach($mlist2 as $data){

				if($data['m_sex'] == "M"){
					$class_color = "color_02bae2";
				}else{
					$class_color = "color_ea3c3c";
				}

	?>
	<div class="height_60 width_100per line-height_55 border_bottom_1_ececec">
		<div class="member_thumb margin_top_5" ><?=$this->member_lib->member_thumb($data['m_userid'], 80, 80)?></div>


		<b class="color_333 level_m_online_img <?=$class_color?> pointer margin_top_5 media_nick_class"><?=$data['m_nick']?></b>
		<b class="color_888 pointer media_age_class">(<?=$data['m_age']?>)</b>

		<div class="m_cont_right_box" onclick="javascript:chat_request('<?=$data['m_userid']?>', 'map');">
			<div class="m_cont_right_btn blod"><?=$val2?> 채팅신청</div>
		</div>

		<div class="float_right width_60 color_888 media_km_class margin_top_20 _distance">
			<?=$data['to_distance']?>km
		</div>
	</div>
	<?	
				$last_km = $last_km + (rand(1,15) / 100);
			}
		}else{
	?>
	<!-- 동일 지역의 사람이 없을경우 -->
	<?
		}
	?>
	</div>
	
	<div id="more_btn" class="borad_add">
		<div id="more" page="<?=$page+1?>" class="board_more text-center">
			more &nbsp;<div></div>
		</div>
	</div>


</div>
