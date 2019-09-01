<?
	//상품등록 및 수정 공용 팝업
?>

<style>

.tbl{font-size:0.8em;}
.tbl th{width:15%; background-color:#F0F2F8; text-align:center;}
.tbl td{width:35%; padding-left:10px;}

.btn_info_v{border:0; width:150px; height:30px; background-color:#5BC0DE; color:#fff; font-size:1.1em; border-radius:5px;}
.btn_success_v{border:0; width:150px; height:30px; background-color:#5CB85C; color:#fff; font-size:1.1em; border-radius:5px;}
.textarea{width:100%; border:solid 1px #DDDDDD;}

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

input[type="text"]{border:solid 1px #DDDDDD; width:100%;}

.img_box{position:relative; width:120px; height:120px; margin:auto;}
.img_box img{width:100%;}

</style>


<script type="text/javascript">

	$(document).ready(function(){
		
		//select box 관련 함수
		var select = $("select#sel");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});
		
		//상품을 수정할경우 select box 기본 셋팅
		if($("select[name='v_vendor']").val()){
			var select_name = $("select[name='v_vendor']").children("option:selected").text();
			$("select[name='v_vendor']").siblings("label").text(select_name);
		}
		
		if($("select[name='v_category']").val()){
			var select_name = $("select[name='v_category']").children("option:selected").text();
			$("select[name='v_category']").siblings("label").text(select_name);
		}

		if($("select[name='v_delivery']").val()){
			var select_name = $("select[name='v_delivery']").children("option:selected").text();
			$("select[name='v_delivery']").siblings("label").text(select_name);
		}
		
		//파일 업로드시 파일 경로
		$("#product_img").change(function(){
			$("#v_img_url").val($("#product_img").val());
			
		});

		//상품 추가하기 submit
		$("#btn_reg").click(function(){
			
			//폼체크
			if($("select[name='v_vendor']").val() == ""){ alert("업체를 선택하세요."); $("select[name='v_vendor']").focus(); return;}				//업체
			if($("select[name='v_category']").val() == ""){ alert("카테고리를 선택하세요."); $("select[name='v_category']").focus(); return;}		//카테고리
			if($("select[name='v_delivery']").val() == ""){ alert("배송방식 선택하세요."); $("select[name='v_delivery']").focus(); return;}		//배송방식
			if($("#v_price_p").val() == ""){ alert("가격(포인트)을 입력하세요."); $("#v_price_p").focus(); return; }								//가격(포인트)
			if($("#v_price_w").val() == ""){ alert("가격(원)을 입력하세요."); $("#v_price_w").focus(); return; }									//가격(원)
			if($("#v_product_code").val() == ""){ alert("상품코드를 입력하세요."); $("#v_product_code").focus(); return; }							//상품코드
			if($("#v_product_name").val() == ""){ alert("상품이름을 입력하세요."); $("#v_product_name").focus(); return; }							//상품이름
			if($("#v_img_url").val() == ""){ alert("이미지를 등록하세요."); $("#v_img_url").focus(); return; }										//이미지경로
			if($("#v_contents").val() == ""){ alert("상품설명을 입력하세요."); $("#v_contents").focus(); return; }									//상품내용
			
			var f = document.forms['product_form'];

			f.target = "";
			f.action = "/admin/gift/gift_management/register_product";
			f.submit();
			
		});

	});


</script>

<div id="panel-1" class="panel panel-default">
	<div class="panel-heading">
		<span class="title elipsis">
			<strong><?=$v_title?></strong> <!-- panel title -->
		</span>

	</div>
	<div class="panel-body">
		<form id="product_form" name="product_form" enctype="multipart/form-data" method="post">
		<input type="hidden" id="v_idx" name="v_idx" value="<?=@$pdata['V_IDX']?>">
		<table class="table table-bordered table-vertical-middle nomargin tbl">
			<thead>
			<tr>
				<th colspan="4">상품내역</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th style="vertical-align:middle;">업체</th>
				<td>
					<div id="select_box">
					<label for="sel">- 선택 -</label>
					<select id="sel" name="v_vendor">
						<option value="">- 선택 -</option>
						<option value="비즈콘" <? if(@$pdata['V_VENDOR'] == "비즈콘"){ echo "selected"; } ?> >- 비즈콘 -</option>
						<option value="자체상품" <? if(@$pdata['V_VENDOR'] == "자체상품"){ echo "selected"; } ?> >- 자체상품 -</option>
					</select>
					</div>
				</td>
				<th style="vertical-align:middle;">카테고리</th>
				<td>
					<div id="select_box">
					<label for="sel">- 선택 -</label>
					<select id="sel" name="v_category">
						<option value="">- 선택 -</option>
						<option value="커피/음료" <? if(@$pdata['V_CATEGORY'] == "커피/음료"){ echo "selected"; } ?> >- 커피/음료 -</option>
						<option value="베이커리/도넛" <? if(@$pdata['V_CATEGORY'] == "베이커리/도넛"){ echo "selected"; } ?> >- 베이커리/도넛 -</option>
						<option value="아이스크림" <? if(@$pdata['V_CATEGORY'] == "아이스크림"){ echo "selected"; } ?> >- 아이스크림 -</option>
						<option value="외식" <? if(@$pdata['V_CATEGORY'] == "외식"){ echo "selected"; } ?> >- 외식 -</option>
						<option value="버거/피자" <? if(@$pdata['V_CATEGORY'] == "버거/피자"){ echo "selected"; } ?> >- 버거/피자 -</option>
						<option value="영화" <? if(@$pdata['V_CATEGORY'] == "영화"){ echo "selected"; } ?> >- 영화 -</option>
						<option value="식품/건강" <? if(@$pdata['V_CATEGORY'] == "식품/건강"){ echo "selected"; } ?> >- 식품/건강 -</option>
						<option value="마트/편의점" <? if(@$pdata['V_CATEGORY'] == "마트/편의점"){ echo "selected"; } ?> >- 마트/편의점 -</option>
						<option value="상품권" <? if(@$pdata['V_CATEGORY'] == "상품권"){ echo "selected"; } ?> >- 상품권 -</option>
						<option value="레저/여행" <? if(@$pdata['V_CATEGORY'] == "레저/여행"){ echo "selected"; } ?> >- 레저/여행 -</option>
						<option value="도서" <? if(@$pdata['V_CATEGORY'] == "도서"){ echo "selected"; } ?> >- 도서 -</option>
						<option value="유아" <? if(@$pdata['V_CATEGORY'] == "유아"){ echo "selected"; } ?> >- 유아 -</option>
						<option value="뷰티/헤어" <? if(@$pdata['V_CATEGORY'] == "뷰티/헤어"){ echo "selected"; } ?> >- 뷰티/헤어 -</option>
						<option value="패션/속옷/잡화" <? if(@$pdata['V_CATEGORY'] == "패션/속옷/잡화"){ echo "selected"; } ?> >- 패션/속옷/잡화 -</option>
						<option value="리빙/가전" <? if(@$pdata['V_CATEGORY'] == "리빙/가전"){ echo "selected"; } ?> >- 리빙/가전 -</option>
						<option value="문구/소품" <? if(@$pdata['V_CATEGORY'] == "문구/소품"){ echo "selected"; } ?> >- 문구/소품 -</option>
						<option value="디지털" <? if(@$pdata['V_CATEGORY'] == "디지털"){ echo "selected"; } ?> >- 디지털 -</option>
						<option value="기타" <? if(@$pdata['V_CATEGORY'] == "기타"){ echo "selected"; } ?> >- 기타 -</option>
						<option value="배송" <? if(@$pdata['V_CATEGORY'] == "배송"){ echo "selected"; } ?> >- 배송 -</option>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">배송방식</th>
				<td>
					<div id="select_box">
					<label for="sel">- 선택 -</label>
					<select id="sel" name="v_delivery">
						<option value="">- 선택 -</option>
						<option value="문자" <? if(@$pdata['V_DELIVERY'] == "문자"){ echo "selected"; } ?> >- 문자발송 -</option>
						<option value="링크" <? if(@$pdata['V_DELIVERY'] == "링크"){ echo "selected"; } ?> >- 링크 -</option>
						<option value="택배" <? if(@$pdata['V_DELIVERY'] == "택배"){ echo "selected"; } ?> >- 택배 -</option>
					</select>
					</div>
				</td>
				<th style="vertical-align:middle;">진열여부</th>
				<td>
					<b style="font-size:1.3em;">Y</b> &nbsp;
					<input type="radio" id="v_use_yn" name="v_use_yn" value="Y" style="vertical-align:-1px;" <? if(empty($pdata['V_USE_YN'])){ echo "checked"; } ?> <? if(@$pdata['V_USE_YN'] == "Y"){ echo "checked"; }?> >
					&nbsp;&nbsp;&nbsp;&nbsp;
					<b style="font-size:1.3em;">N</b> &nbsp;
					<input type="radio" id="v_use_yn" name="v_use_yn" value="N" style="vertical-align:-1px;" <? if(@$pdata['V_USE_YN'] == "N"){ echo "checked"; }?> >
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">가격<br>(포인트)</th>
				<td>
					<input type="text" id="v_price_p" name="v_price_p" value="<?=@$pdata['V_PRICE_P']?>">
				</td>
				<th style="vertical-align:middle;">가격(원)</th>
				<td>
					<input type="text" id="v_price_w" name="v_price_w" value="<?=@$pdata['V_PRICE_W']?>">
				</td>
			</tr>
			<tr>
				<th>이익(원)</th>
				<td>
					<input type="text" id="v_price_m" name="v_price_m" value="<?=@$pdata['V_PRICE_M']?>">
				</td>
				<th>상품코드</th>
				<td>
					<input type="text" id="v_product_code" name="v_product_code" value="<?=@$pdata['V_PRODUCT_CODE']?>">
				</td>
			</tr>
			<tr>
				<th>상품이름</th>
				<td colspan="3">
					<input type="text" id="v_product_name" name="v_product_name" value="<?=@$pdata['V_PRODUCT_NAME']?>">
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">이미지</th>
				<td colspan="2">
					<? if(@$pdata['V_IMG_URL']){ ?>
					<div class="img_box">
						<img src="/upload/product_upload/gift/<?=$pdata['V_IMG_URL']?>">
					</div>
					<? } ?>
					<input type="text" id="v_img_url" name="v_img_url" value="<?=@$pdata['V_IMG_URL']?>" readonly>
				</td>
				<td class="text-center">
					<div style="position:relative; width:200px;">
						<input type="button" id="btn_reg_img" name="btn_reg_img" class="btn_success_v" value="이미지 등록">
						<div style="position:absolute; top:0px; left:24px;">
							<input type="file" id="product_img" name="product_img" style="width:150px; height:28px; opacity:0; filter:alpha(opacity=0); cursor:pointer;" />
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">상품설명<br><nobr>(상세정보)</nobr></th>
				<td colspan="3">
					<textarea id="v_contents_1" name="v_contents_1" class="textarea" rows="8"><?=@$pdata['V_CONTENTS_1']?></textarea>
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">상품설명<br>(이용안내)</th>
				<td colspan="3">
					<textarea id="v_contents_2" name="v_contents_2" class="textarea" rows="3"><?=@$pdata['V_CONTENTS_2']?></textarea>
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">메모<br>(관리자용)</th>
				<td colspan="3">
					<textarea id="v_memo" name="v_memo" class="textarea" rows="6"><?=@$pdata['V_MEMO']?></textarea>
				</td>
			</tr>
			<tr>
				<th colspan="4" class="text-center"><input type="button" id="btn_reg" name="btn_reg" class="btn_info_v" value="<?=$v_title?>"></th>
			</tr>

			</tbody>
		</table>
		</form>
	</div>
</div>

