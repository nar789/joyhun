<style>

.bdr{border-right:solid 1px #DDDDDD;}
.bdt{border-bottom:solid 1px #DDDDDD;}

.tbl{width:100%; font-size:0.9em;}
.tbl th{width:10%; height:45px; border-top:solid 1px #DDDDDD; border-left:solid 1px #DDDDDD; background-color:#F0F2F8;}
.tbl td{width:15%; height:45px; border-top:solid 1px #DDDDDD; border-left:solid 1px #DDDDDD; padding-left:10px;}

.tbl2{width:100%; font-size:0.9em;}
.tbl2 th{background-color:#F0F2F8; white-space:nowrap;}
.tbl2 td{white-space:nowrap; padding-left:10px; text-align:center;}

.input_text{width:90%; border:solid 1px #DDDDDD;}
.input_cal{width:40%; border:solid 1px #DDDDDD; text-align:center;}
.selector{ width:50%; height:40px; font-size:0.9em;}
.search_btn{width:150px; font-weight:bold;}

.btn_div{position:relative; width:100%; margin-top:20px; height:45px;}
.btn_div span{display:inline-block;}
.btn_div span input{font-weight:bold;}

.img_box{position:relative; width:100px; height:100px; margin:auto;}
.img_box img{width:100%;}

.btn_info_v{border:0; width:80px; height:30px; background-color:#5BC0DE; color:#fff; font-size:1.1em; border-radius:5px;}
.btn_success_v{border:0; width:80px; height:30px; background-color:#5CB85C; color:#fff; font-size:1.1em; border-radius:5px;}
.btn_danger_v{border:0; width:80px; height:30px; background-color:#D9534F; color:#fff; font-size:1.1em; border-radius:5px;}

div#select_box {
    position: relative;
    width: 200px;
    height: 30px;
    background: url('/images/etc/allow.png') 180px center no-repeat; /* 화살표 이미지 */
    border: 1px solid #E9DDDD;
}
div#select_box label {
    position: absolute;
    font-size: 1.0em;
    color: #a97228;
    top: 7px;
    left: 12px;
    letter-spacing: 1px;
}
div#select_box select#sel {
    width: 100%;
    height: 40px;
    min-height: 40px;
    line-height: 40px;
    padding: 0 10px;
    opacity: 0;
    filter: alpha(opacity=0); /* IE 8 */
}

.priority_div{position:relative; width:100%; height:100px;}
.priority_div .box{position:relative; width:100%; height:30px; margin-top:18px; padding-top:10px; background-color:#FFF;}


#triangle-up {
	cursor:pointer;
	margin:auto;
	width: 0;
	height: 0;
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	border-bottom: 20px solid #B2B2B2;
}

#triangle-down {
	cursor:pointer;
	margin:auto;
	width: 0;
	height: 0;
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	border-top: 20px solid #B2B2B2;
}
		

</style>


<script type="text/javascript">

	$(document).ready(function(){
		//달력
		$(".cal").datepicker({			
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			yearSuffix: '년'

		});
		
		//select box 관련 함수
		var select = $("select#sel");

		//select box 기본 셋팅
		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});

		//select box가 selected 되었을경우 기본 셋팅
		if($("select[name='vendor']").val()){
			var select_name = $("select[name='vendor']").children("option:selected").text();
			$("select[name='vendor']").siblings("label").text(select_name);
		}
		
		if($("select[name='category']").val()){
			var select_name = $("select[name='category']").children("option:selected").text();
			$("select[name='category']").siblings("label").text(select_name);
		}

		if($("select[name='delivery']").val()){
			var select_name = $("select[name='delivery']").children("option:selected").text();
			$("select[name='delivery']").siblings("label").text(select_name);
		}
		
		//조건 검색
		$("#btn_search").click(function(){

			var v_url = "/admin/gift/gift_management/gift_list";

			if($("select[name='vendor']").val()){ v_url += "/vendor/"+encodeURIComponent($("select[name='vendor']").val()); }
			if($("select[name='category']").val()){ v_url += "/category/"+encodeURIComponent($("select[name='category']").val()); }
			if($("select[name='delivery']").val()){ v_url += "/delivery/"+encodeURIComponent($("select[name='delivery']").val()); }
			if($("input[name='use_yn']:checked").val()){ v_url += "/use_yn/"+encodeURIComponent($("input[name='use_yn']:checked").val());}
			if($("#date_1").val()){ v_url += "/date_1/"+encodeURIComponent($("#date_1").val()); }
			if($("#date_2").val()){ v_url += "/date_2/"+encodeURIComponent($("#date_2").val()); }
			if($("#price_p").val()){ v_url += "/prict_p/"+encodeURIComponent($("#price_p").val()); }
			if($("#price_w").val()){ v_url += "/prict_w/"+encodeURIComponent($("#price_w").val()); }
			if($("#price_m").val()){ v_url += "/prict_m/"+encodeURIComponent($("#price_m").val()); }
			if($("#product_name").val()){ v_url += "/product_name/"+encodeURIComponent($("#product_name").val()); }
			if($("#product_code").val()){ v_url += "/product_code/"+encodeURIComponent($("#product_code").val()); }
			if($("#product_vendor").val()){ v_url += "/product_vendor/"+encodeURIComponent($("#product_vendor").val()); }

			$(location).attr("href", v_url);
		});


		//체크박스 전체 선택 및 해제
		$("#check_all").click(function(){
			
			if($("#check_all").prop("checked")){
				$("input[id='idx_chk']").prop("checked", true);
			}else{
				$("input[id='idx_chk']").prop("checked", false);
			}

		});
		
	});
	
	//함수(검색기능, 선택삭제, 선택진열, 진열안함, 상품추가)

	//선택삭제
	function btn_select_del(){
		
		if(confirm("선택하신 상품들을 삭제하시겠습니까?") == true){
			$("input[id='idx_chk']:checked").each(function(){
				
				$.ajax({

					type : "post",
					url : "/admin/gift/gift_management/product_del",
					data : {
						"v_idx"		: encodeURIComponent($(this).val())
					},
					cache : false,
					async : false,
					success : function(result){
						data = result;
					},
					error : function(result){
						data = result;
					}

				});

			});

			if(data == "1"){
				alert("선택하신 상품들이 삭제되었습니다.");
				location.reload();
			}else{
				alert("삭제 실패 ("+data+") ");
			}

		}

	}

	//선택진열, 진열안함 공용함수
	function btn_select_display(mode){
		
		if(mode == "Y"){
			var msg = "선택하신 상품들을 진열하시겠습니까?";
			var result_msg = "선택하신 상품들이 진열되었습니다."
		}else if(mode == "N"){
			var msg = "선택하신 상품들을 진열하지 않겠습니까?";
			var result_msg = "선택하신 상품들이 숨겼습니다."
		}

		if(confirm(msg) == true){
			
			$("input[id='idx_chk']:checked").each(function(){

				$.ajax({

					type : "post",
					url : "/admin/gift/gift_management/product_display",
					data : {
						"v_idx"			: encodeURIComponent($(this).val()),
						"v_use_yn"		: encodeURIComponent(mode)
					},
					cache : false,
					async : false,
					success : function(result){
						data = result;
					},
					error : function(result){
						data = result;
					}

				});

			});

			if(data == "1"){
				alert(result_msg);
				location.reload();
			}else{
				alert("실패 ("+data+") ");
			}
		}

	}

	//상품등록 팝업
	function btn_product_reg(v_idx){
		
		var w = 600;
		var h = 850;

		var res_w = ( screen.availWidth - w ) / 2;
		var res_h = ( screen.availHeight - h ) / 2;
		
		var v_url = "/admin/gift/gift_management/reg_product_pop";

		if(v_idx){
			v_url = v_url+"/v_idx/"+v_idx;
		}
		var popUrl = v_url;
		var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  
		var open_window = window.open(popUrl, "reg_product", popOption);	

		if(open_window == null){ 
			alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
		}
			
	}

	//수정하기 함수
	function gift_update(v_idx){
		btn_product_reg(v_idx);
	}

	//삭제하기 함수
	function gift_delete(v_idx){
		
		if(confirm("상품을 삭제하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/gift/gift_management/product_del",
				data : {
					"v_idx"		: encodeURIComponent(v_idx)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("상품을 삭제하였습니다.");
						location.reload();
					}else{
						alert("삭제 실패 ("+ resutl +")");
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

	//상품진열 순서 변경
	function call_gift_priority(mode, idx, category, use_yn){

		if(use_yn == "N"){
			alert("진열상태가 Y인것만 진열순서를 변경 가능합니다.");
			return;
		}
		
		if(confirm("진열순서를 바꾸시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/gift/gift_management/call_product_priority",
				data : {
					"mode"				: encodeURIComponent(mode),
					"idx"				: encodeURIComponent(idx),
					"category"			: encodeURIComponent(category)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("진열순서가 바꼈습니다.");
						location.reload();
					}else if(result == "0"){
						alert("진열순서 바꾸기를 실패했습니다.");
						location.reload();
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else if(result == "1001"){
						alert("최상위 혹은 최하위 진열상품입니다.");
						return;
					}else{
						alert("실패!! ("+ result +")");
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>상품관리</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>검색조건</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>
			<div class="panel-body">
				<div style="position:relative; width:100%;">
					<table cellspacing=0 cellpadding=0 class="tbl">
						<tr>
							<th>벤더</th>
							<td>
								<div id="select_box">
								<label for="sel">- 선택 -</label>
								<select id="sel" name="vendor">
									<option value="">- 선택 -</option>
									<option value="비즈콘" <? if(@$v_vendor == "비즈콘"){ echo "selected"; } ?> >- 비즈콘 -</option>
									<option value="자체상품" <? if(@$v_vendor == "자체상품"){ echo "selected"; } ?> >- 자체상품 -</option>
								</select>
								</div>
							</td>
							<th>카테고리</th>
							<td>
								<div id="select_box">
								<label for="sel">- 선택 -</label>
								<select id="sel" name="category">
									<option value="">- 선택 -</option>
									<option value="커피|음료" <? if(@$v_category == "커피|음료"){ echo "selected"; } ?> >- 커피/음료 -</option>
									<option value="베이커리|도넛" <? if(@$v_category == "베이커리|도넛"){ echo "selected"; } ?> >- 베이커리/도넛 -</option>
									<option value="아이스크림" <? if(@$v_category == "아이스크림"){ echo "selected"; } ?> >- 아이스크림 -</option>
									<option value="외식" <? if(@$v_category == "외식"){ echo "selected"; } ?> >- 외식 -</option>
									<option value="버거|피자" <? if(@$v_category == "버거|피자"){ echo "selected"; } ?> >- 버거/피자 -</option>
									<option value="영화" <? if(@$v_category == "영화"){ echo "selected"; } ?> >- 영화 -</option>
									<option value="식품|건강" <? if(@$v_category == "식품|건강"){ echo "selected"; } ?> >- 식품/건강 -</option>
									<option value="마트|편의점" <? if(@$v_category == "마트/편의점"){ echo "selected"; } ?> >- 마트/편의점 -</option>
									<option value="상품권" <? if(@$v_category == "상품권"){ echo "selected"; } ?> >- 상품권 -</option>
									<option value="레저|여행" <? if(@$v_category == "레저|여행"){ echo "selected"; } ?> >- 레저/여행 -</option>
									<option value="도서" <? if(@$v_category == "도서"){ echo "selected"; } ?> >- 도서 -</option>
									<option value="유아" <? if(@$v_category == "유아"){ echo "selected"; } ?> >- 유아 -</option>
									<option value="뷰티|헤어" <? if(@$v_category == "뷰티|헤어"){ echo "selected"; } ?> >- 뷰티/헤어 -</option>
									<option value="패션|속옷|잡화" <? if(@$v_category == "패션|속옷|잡화"){ echo "selected"; } ?> >- 패션/속옷/잡화 -</option>
									<option value="리빙|가전" <? if(@$v_category == "리빙|가전"){ echo "selected"; } ?> >- 리빙/가전 -</option>
									<option value="문구|소품" <? if(@$v_category == "문구|소품"){ echo "selected"; } ?> >- 문구/소품 -</option>
									<option value="디지털" <? if(@$v_category == "디지털"){ echo "selected"; } ?> >- 디지털 -</option>
									<option value="기타" <? if(@$v_category == "기타"){ echo "selected"; } ?> >- 기타 -</option>
									<option value="배송" <? if(@$v_category == "배송"){ echo "selected"; } ?> >- 배송 -</option>
								</select>
								</div>
							</td>
							<th>배송방식</th>
							<td>
								<div id="select_box">
								<label for="sel">- 선택 -</label>
								<select id="sel" name="delivery">
									<option value="">- 선택 -</option>
									<option value="문자" <? if(@$v_delivery == "문자"){ echo "selected"; } ?> >- 문자발송 -</option>
									<option value="링크" <? if(@$v_delivery == "링크"){ echo "selected"; } ?> >- 링크 -</option>
									<option value="택배" <? if(@$v_delivery == "택배"){ echo "selected"; } ?> >- 택배 -</option>
								</select>
								</div>
							</td>
							<th>진열상태</th>
							<td class="bdr">
								모두 <input type="radio" id="use_yn" name="use_yn" value="A" <? if(@$v_use_yn == "A" or empty($v_use_yn)){ echo "checked"; } ?> > &nbsp;&nbsp;
								진열함 <input type="radio" id="use_yn" name="use_yn" value="Y" <? if(@$v_use_yn == "Y"){ echo "checked"; } ?> > &nbsp;&nbsp;
								진열안 <input type="radio" id="use_yn" name="use_yn" value="N" <? if(@$v_use_yn == "N"){ echo "checked"; } ?> >
							</td>
						</tr>
						<tr>
							<th>등록일자</th>
							<td>
								<input type="text" id="date_1" name="date_1" class="input_cal cal" value="<?=@$v_date_1?>">
								~
								<input type="text" id="date_2" name="date_2" class="input_cal cal" value="<?=@$v_date_2?>">
							</td>
							<th>가격(포인트)</th>
							<td><input type="text" id="price_p" name="price_p" class="input_text" value="<?=@$v_price_p?>"></td>
							<th>가격(원)</th>
							<td><input type="text" id="price_w" name="price_w" class="input_text" value="<?=@$v_price_w?>"></td>
							<th>이익(원)</th>
							<td class="bdr"><input type="text" id="price_m" name="price_m" class="input_text" value="<?=@$v_price_m?>"></td>			
						</tr>
						<tr>
							<th>상품이름</th>
							<td><input type="text" id="product_name" name="product_name" class="input_text" value="<?=@$v_product_name?>"></td>
							<th>상품번호(자체)</th>
							<td><input type="text" id="product_code" name="product_code" class="input_text" value="<?=@$v_product_code?>"></td>
							<th>상품코드(벤더)</th>
							<td><input type="text" id="product_vendor" name="product_vendor" class="input_text" value="<?=@$v_product_vendor?>"></td>
							<th></th>
							<td class="bdr"></td>
						</tr>
						<tr class="bdt">
							<td class="bdr text-center" colspan="8">
								<input type="button" id="btn_search" name="btn_search" class="btn btn-success search_btn" value="검색">
							</td>
						</tr>
					</table>
				</div>
				
				<div class="btn_div">
					<span><input type="button" id="" name="" class="btn btn-danger" value="선택삭제" onclick="javascript:btn_select_del();"></span>
					<span style="width:20px;"></span>
					<span><input type="button" id="" name="" class="btn btn-warning" value="선택진열" onclick="javascript:btn_select_display('Y');"></span>
					<span style="width:20px;"></span>
					<span><input type="button" id="" name="" class="btn btn-warning" value="진열안함" onclick="javascript:btn_select_display('N');"></span>
					<span style="width:20px;"></span>
					<span><input type="button" id="" name="" class="btn btn-info" value="상품등록" onclick="javascript:btn_product_reg();"></span>
				</div>
				
			</div>
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>상품내역 리스트</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-vertical-middle nomargin tbl2">
						<thead>
						<tr>
							<td colspan="12" style="text-align:left;"><b>총 검색 : <?=@$getTotalData?>건</b></td>
						</tr>
						<tr>
							<th class="width-50"><input type="checkbox" id="check_all" name="check_all" value=""></th>
							<th class="width-50">고유번호</th>
							<th class="width-100">카테고리</th>
							<th class="width-100">벤더</th>
							<th class="width-150">상품코드</th>
							<th class="width-150">상품이미지</th>
							<th>이름</th>
							<th class="width-100">포인트</th>
							<th class="width-100">진열상태</th>
							<th class="width-150">등록일시</th>
							<th class="width-100">처리</th>
							<th class="width-50">순서</th>
						</tr>
						</thead>
						<tbody>
						
						<?
							if($getTotalData > 0){
								foreach($plist as $data){
						?>
						<tr>
							<td><input type="checkbox" id="idx_chk" name="idx_chk" value="<?=$data['V_IDX']?>"></td>
							<td><?=$data['V_IDX']?></td>
							<td><?=$data['V_CATEGORY']?></td>
							<td><?=$data['V_VENDOR']?></td>
							<td><?=$data['V_PRODUCT_CODE']?></td>
							<td>
								<div class="img_box">
									<img src="/upload/product_upload/gift/<?=$data['V_IMG_URL']?>">
								</div>
							</td>
							<td><?=$data['V_PRODUCT_NAME']?></td>
							<td><?=$data['V_PRICE_P']?></td>
							<td><?=$data['V_USE_YN']?></td>
							<td><?=$data['V_WRITE_DATE']?></td>
							<td>
								<input type="button" id="btn_update" name="btn_update" class="btn_info_v" value="수정하기" onclick="javascript:gift_update('<?=$data['V_IDX']?>');">
								<br><br>
								<input type="button" id="btn_delete" name="btn_delete" class="btn_danger_v" value="삭제하기" onclick="javascript:gift_delete('<?=$data['V_IDX']?>');">
							</td>
							<td>
								<div class="priority_div">
									<div class="box"><div id="triangle-up" onclick="javascript:call_gift_priority('up', '<?=$data['V_IDX']?>', '<?=$data['V_CATEGORY']?>', '<?=$data['V_USE_YN']?>');"></div></div>
									<div class="box"><div id="triangle-down" onclick="javascript:call_gift_priority('down', '<?=$data['V_IDX']?>', '<?=$data['V_CATEGORY']?>', '<?=$data['V_USE_YN']?>');"></div></div>
								</div>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center bold" colspan="12">검색 결과가 없습니다.</td>
						</tr>
						<?
							}
						?>

						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"></div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>



