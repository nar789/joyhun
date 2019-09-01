
		<div class="search_frame_on margin_top_8">
			<div class="search_box_on">

				<div class="search_title2"> 
					<img src="<?=IMG_DIR?>/min5_ic.gif" class="float_left"><p>5분거리 접속이성 찾기</p>
				</div>

				<div id="search_select">
					<div class="min5_select_box">
						<div class="min5_select_area">
							<select onchange="area_select(this.value,'local_second_prim');" name="local_master_prim"> 
								<option value="" selected="selected">--선택--</option>
								<option value="서울">서울</option> 
								<option value="인천">인천</option> 
								<option value="부산">부산</option> 
								<option value="대구">대구</option> 
								<option value="대전">대전</option> 
								<option value="광주">광주</option> 
								<option value="울산">울산</option> 
								<option value="경기">경기</option> 
								<option value="강원">강원</option> 
								<option value="충남">충남</option> 
								<option value="충북">충북</option> 
								<option value="경남">경남</option> 
								<option value="경북">경북</option> 
								<option value="전남">전남</option> 
								<option value="전북">전북</option> 
								<option value="제주">제주</option> 
							</select> 
						</div>
						<div class="min5_select_area2">
							<select name="local_second_prim" id="local_second_prim"> 
								<option value="" selected="selected">--선택--</option>
							</select> 
						</div>
					</div>

					<input type="submit" class="serach_btn2" value="검색" onclick="min_select_show();"/>
				</div>

				<!-- 접속이성 리스트부분 -->
				<div id="search_show_text">
					<div class="float_left"><span class="color_222 blod font-size_13">서울 성동구 </span><b class="color_999 font-size_13">접속이성</b></div>
					<div class="float_right color_ea3c3c font-size_13 blod" id="total_cnt"></div>
					<div class="clear"></div>

					<div class="search_show_box" id="town_find" style="overflow:scroll;overflow-x:hidden;">
					</div>
					<div class="clear"></div>
				</div>
			</div>		<!-- ## search_box end ## -->

			<div id="all_show_find">
				<div class="find_all_show_second" onclick="javascript:location.href='/chatting/town_find/order_login';">전체 이성 보러가기</div>
				<div style="float:right; margin-top:16px;"><img src="<?=IMG_DIR?>/find_min_exit.gif" onclick="min_select_exit();"></div>
				<div class="clear"></div>
			</div>
		</div>		<!-- ## search_frame end ## --> 


<style>

	.find_member_box > div { display:inline-block; }
	.find_member_box > div > img,
	.find_member_box > div > div.girl_icon,
	.find_member_box > div > div.man_icon { border-radius:40px;cursor:pointer; }

	#town_find { -ms-scrollbar-track-color:#f8f8f8; -ms-scrollbar-face-color:#ededed; -ms-scrollbar-shadow-color: #f8f8f8; }

	.find_member_box > ul > li:first-child { width:80px; }

</style>


<script>

$(document).ready(function(){

	var rand_area = new Array('서울', '인천', '부산', '대구', '대전', '광주', '울산', '경기', '강원', '충남', '충북', '경남', '경북', '전남', '전북', '제주');

	var find_area = randomItem(rand_area);

	$("select[name=local_master_prim]").val(find_area).attr("selected", "selected");

	area_select(find_area,'local_second_prim');

	$("#local_second_prim option:eq(2)").attr("selected", "selected");

	function randomItem(a) {
	  return a[Math.floor(Math.random() * a.length)];
	}

}); 


</script>

