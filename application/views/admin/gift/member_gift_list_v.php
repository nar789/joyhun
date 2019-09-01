<style>
.tbl{width:100%; font-size:0.9em;}
.tbl tr{height:40px;}
.tbl th{width:10%; background-color:#F0F2F8; border-top:solid 1px #D5D5D5; border-left:solid 1px #D5D5D5;}
.tbl td{width:15%; border-top:solid 1px #D5D5D5; border-left:solid 1px #D5D5D5; padding-left:10px;}
.tbl tr:last-child{border-bottom:solid 1px #D5D5D5;}
.tbl tr td:last-child{border-right:solid 1px #D5D5D5;}

.tbl2{width:100%; font-size:0.9em;}
.tbl2 th{width:25%;}

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
    top: 5px;
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

.it{border:solid 1px #D5D5D5; width:85%;}
.it_50{border:solid 1px #D5D5D5; width:40%;}

#panel_tit span:nth-child(2){padding-left:100px;}
#panel_tit span:nth-child(3){padding-left:100px;}


.member_div{position:relative; width:100%; height:150px;}
.member_div div:nth-child(1){position:relative; width:40%; height:100%; overflow:hidden; text-align:center;}
.member_div div:nth-child(2){position:absolute; width:60%; height:100%; top:0%; left:40%;}
.member_div div:nth-child(2) ul{list-style:none; line-height:20px; margin:0; padding:10px 10px 10px 10px;}

.gift_div{position:relative; width:100%; height:150px;}
.gift_div div:nth-child(1){position:relative; width:40%; height:100%; overflow:hidden; text-align:center;}
.gift_div div:nth-child(1) img{width:100%;}
.gift_div div:nth-child(2){position:absolute; width:60%; height:100%; top:0%; left:40%;}
.gift_div div:nth-child(2) ul{list-style:none; line-height:20px; margin:0; padding:10px 10px 10px 10px;}

.deli_div{position:relative; width:100%; height:150px;}
.deli_div ul{list-style:none; line-height:25px; margin:0; padding:10px 10px 10px 10px;}
.deli_div li:nth-child(1){font-weight:bold; color:#ED1C24;}

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

		if($("select[name='vendor']").val()){
			var vendor = $("select[name='vendor']").children("option:selected").text();
			$("select[name='vendor']").siblings("label").text(vendor);
		}
		
		if($("select[name='category']").val()){
			var category = $("select[name='category']").children("option:selected").text();
			$("select[name='category']").siblings("label").text(category);
		}

		if($("select[name='delivery']").val()){
			var delivery = $("select[name='delivery']").children("option:selected").text();
			$("select[name='delivery']").siblings("label").text(delivery);
		}

		if($("select[name='gift_stat']").val()){
			var gift_stat = $("select[name='gift_stat']").children("option:selected").text();
			$("select[name='gift_stat']").siblings("label").text(gift_stat);
		}
		
		//input type들 엔터처리
		$('input').keyup(function(e) {
			if(e.keyCode == 13) btn_search();        
		});

	});

	//검색버튼 클릭시 이벤트 함수
	function btn_search(){
		
		//파라미터
		var v_para = "";
		
		//검색조건
		if($("select[name='vendor']").val()){ var v_vendor = $("select[name='vendor']").val(); v_para += "/vendor/"+encodeURIComponent(v_vendor); }							//업체(벤더)
		if($("select[name='category']").val()){ var v_category = $("select[name='category']").val(); v_para += "/category/"+encodeURIComponent(v_category); }				//카테고리
		if($("select[name='delivery']").val()){ var v_delivery = $("select[name='delivery']").val(); v_para += "/delivery/"+encodeURIComponent(v_delivery); }				//배송방식
		if($("select[name='gift_stat']").val()){ var v_gift_stat = $("select[name='gift_stat']").val(); v_para += "/gift_stat/"+encodeURIComponent(v_gift_stat); }			//선물상태
		if($("#gift_name").val()){ var v_gift_name = $("#gift_name").val(); v_para += "/gift_name/"+encodeURIComponent(v_gift_name); }										//상품이름
		if($("#gift_num").val()){ var v_gift_num = $("#gift_num").val(); v_para += "/gift_num/"+encodeURIComponent(v_gift_num); }											//상품고유번호
		if($("#gift_code").val()){ var v_gift_code = $("#gift_code").val(); v_para += "/gift_code/"+encodeURIComponent(v_gift_code); }										//상품코드(벤더)
		if($("#date_1").val()){ var v_date_1 = $("#date_1").val(); v_para += "/date_1/"+encodeURIComponent(v_date_1); }														//일자 from
		if($("#date_2").val()){ var v_date_2 = $("#date_2").val(); v_para += "/date_2/"+encodeURIComponent(v_date_2); }														//일자 to
		if($("#s_user_id").val()){ var v_s_user_id = $("#s_user_id").val(); v_para += "/s_user_id/"+encodeURIComponent(v_s_user_id); }										//보낸아이디
		if($("#s_user_num").val()){ var v_s_user_num = $("#s_user_num").val(); v_para += "/s_user_num/"+encodeURIComponent(v_s_user_num); }									//보낸회원번호
		if($("#s_nick").val()){ var v_s_nick = $("#s_nick").val(); v_para += "/s_nick/"+encodeURIComponent(v_s_nick); }														//보낸닉네임
		if($("#r_user_id").val()){ var v_r_user_id = $("#r_user_id").val(); v_para += "/r_user_id/"+encodeURIComponent(v_r_user_id); }										//받은아이디
		if($("#r_user_num").val()){ var v_r_user_num = $("#r_user_num").val(); v_para += "/r_user_num/"+encodeURIComponent(v_r_user_num); }									//받은회원번호
		if($("#r_nick").val()){ var v_r_nick = $("#r_nick").val(); v_para += "/r_nick/"+encodeURIComponent(v_r_nick); }														//받은닉네임

		if(v_para == ""){
			alert("하나이상의 검색조건을 입력하세요.");
			return;
		}else{
			$(location).attr("href", "/admin/gift/member_gift/member_gift_list"+v_para);
		}

	}


</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>선물리스트</h1>
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
				<!-- 검색조건 -->
				<div style="position:relative; width:100%;">
					<table cellspacing=0 cellpadding=0 class="tbl">
						<tr>
							<th>업체(벤더)</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="vendor">
										<option value="">- 전체 -</option>
										<option value="엠콘" <? if(@$vendor == "엠콘"){ echo "selected"; }?> >- 엠콘 -</option>
										<option value="자체상품" <? if(@$vendor == "자체상품"){ echo "selected"; }?> >- 자체상품 -</option>
									</select>
								</div>
							</td>
							<th>카테고리</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="category">
										<option value="">- 전체 -</option>
										<option value="커피|음료" <? if(@$category == "커피/음료"){ echo "selected"; }?> >- 커피/음료 -</option>
										<option value="마트|편의점" <? if(@$category == "마트/편의점"){ echo "selected"; }?> >- 마트/편의점 -</option>
										<option value="베이커리|도넛" <? if(@$category == "베이커리/도넛"){ echo "selected"; }?> >- 베이커리/도넛 -</option>
										<option value="버거|피자" <? if(@$category == "버거/피자"){ echo "selected"; }?> >- 버거/피자 -</option>
										<option value="아이스크림" <? if(@$category == "아이스크림"){ echo "selected"; }?> >- 아이스크림 -</option>
										<option value="외식" <? if(@$category == "외식"){ echo "selected"; }?> >- 외식 -</option>
										<option value="영화" <? if(@$category == "영화"){ echo "selected"; }?> >- 영화 -</option>
										<option value="식품|건강" <? if(@$category == "식품/건강"){ echo "selected"; }?> >- 식품/건강 -</option>
										<option value="상품권" <? if(@$category == "상품권"){ echo "selected"; }?> >- 상품권 -</option>
										<option value="레저|여행" <? if(@$category == "레저/여행"){ echo "selected"; }?> >- 레저/여행 -</option>
										<option value="도서" <? if(@$category == "도서"){ echo "selected"; }?> >- 도서 -</option>
										<option value="유아" <? if(@$category == "유아"){ echo "selected"; }?> >- 유아 -</option>
										<option value="뷰티|헤어" <? if(@$category == "뷰티/헤어"){ echo "selected"; }?> >- 뷰티/헤어 -</option>
										<option value="패션|속옷|잡화" <? if(@$category == "페션/속옷/잡화"){ echo "selected"; }?> >- 패션/속옷/잡화 -</option>
										<option value="리빙|가전" <? if(@$category == "리빙/가전"){ echo "selected"; }?> >- 리빙/가전 -</option>
										<option value="문구|소품" <? if(@$category == "문구/소품"){ echo "selected"; }?> >- 문구/소품 -</option>
										<option value="디지털" <? if(@$category == "디지털"){ echo "selected"; }?> >- 디지털 -</option>
										<option value="기타" <? if(@$category == "기타"){ echo "selected"; }?> >- 기타 -</option>
										<option value="배송" <? if(@$category == "배송"){ echo "selected"; }?> >- 배송 -</option>
									</select>
								</div>
							</td>
							<th>배송방식</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="delivery">
										<option value="">- 전체 -</option>
										<option value="문자" <? if(@$delivery == "문자"){ echo "selected"; }?> >- 문자 -</option>
										<option value="택배" <? if(@$delivery == "택배"){ echo "selected"; }?> >- 택배 -</option>
									</select>
								</div>
							</td>
							<th>선물상태</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="gift_stat">
										<option value="">- 전체 -</option>
										<option value="Y" <? if(@$gift_stat == "Y"){ echo "selected"; }?> >- 선물받음 -</option>
										<option value="I" <? if(@$gift_stat == "I"){ echo "selected"; }?> >- 발송대기중 -</option>
										<option value="N" <? if(@$gift_stat == "N"){ echo "selected"; }?> >- 미발송 -</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<th>받은날짜</th>
							<td><input type="text" id="date_1" name="date_1" value="<?=@$date_1?>" class="it_50 cal"> ~ <input type="text" id="date_2" name="date_2" value="<?=@$date_2?>" class="it_50 cal"></td>
							<th>상품이름</th>
							<td><input type="text" id="gift_name" name="gift_name" value="<?=@$gift_name?>" class="it"></td>
							<th>상품고유번호</th>
							<td><input type="text" id="gift_num" name="gift_num" value="<?=@$gift_num?>" class="it"></td>
							<th>상품코드(벤더)</th>
							<td><input type="text" id="gift_code" name="gift_code" value="<?=@$gift_code?>" class="it"></td>
						</tr>
						<tr>
							<th>보낸파트너</th>
							<td>
								<div id="select_box">
									<label for="sel">- 선택안함 -</label>
									<select id="sel" name="">
										<option value="">- 선택안함 -</option>
									</select>
								</div>
							</td>
							<th>보낸아이디</th>
							<td><input type="text" id="s_user_id" name="s_user_id" value="<?=@$s_user_id?>" class="it"></td>
							<th>보낸회원번호</th>
							<td><input type="text" id="s_user_num" name="s_user_num" value="<?=@$s_user_num?>" class="it"></td>
							<th>보낸닉네임</th>
							<td><input type="text" id="s_nick" name="s_nick" value="<?=@$s_nick?>" class="it"></td>
						</tr>
						<tr>
							<th>받은파트너</th>
							<td>
								<div id="select_box">
									<label for="sel">- 선택안함 -</label>
									<select id="sel" name="">
										<option value="">- 선택안함 -</option>
									</select>
								</div>
							</td>
							<th>받은아이디</th>
							<td><input type="text" id="r_user_id" name="r_user_id" value="<?=@$r_user_id?>" class="it"></td>
							<th>받은회원번호</th>
							<td><input type="text" id="r_user_num" name="r_user_num" value="<?=@$r_user_num?>" class="it"></td>
							<th>받은닉네임</th>
							<td><input type="text" id="r_nick" name="r_nick" value="<?=@$r_nick?>" class="it"></td>
						</tr>
						<tr>
							<td colspan="8" class="text-center">
								<input type="button" id="" name="" value="검색" class="btn btn-success" style="width:200px; height:30px;" onclick="javasscript:btn_search();">
							</td>
						</tr>
					</table>
				</div>
				
				
			</div>
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div id="panel_tit" class="panel-heading">
				<span><b> 총 건수 : <?=$getTotalData?>건 </b></span>
				<span><b> 총 포인트 : <?=number_format($total_p)?> P </b></span>
				<span><b> 총 가격 : <?=number_format($total_w)?> 원 </b></span>

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
							<th>보낸회원</th>
							<th>받은회원</th>
							<th>선물</th>
							<th>받음/받기/배송</th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){
									
									if(empty($data['SEND_ID'])){ 
										exit; 
									}else{ 
										$sdata = $this->member_lib->get_member($data['SEND_ID']); 
										if(empty($sdata)){ $sdata = $this->member_lib->get_member_out($data['SEND_ID']); $out1 = "out"; }else{ $out1 = ""; }
									}

									if(empty($data['RECV_ID'])){ 
										exit; 
									}else{ 
										$rdata = $this->member_lib->get_member($data['RECV_ID']); 
										if(empty($rdata)){ $rdata = $this->member_lib->get_member_out($data['RECV_ID']); $out2 = "out"; }else{ $out2 = ""; }
									}
						?>
						<tr>
							<td>
								<div class="member_div">
									<div><? if($out1 == "out"){}else{ ?><?=$this->member_lib->member_thumb(@$sdata['m_userid'])?> <? } ?></div>
									<div>
										<ul>
											<li>회원 번호 : <?=@$sdata['m_num']?></li>
											<li><?=@$sdata['m_userid']?></li>
											<li><?=@$sdata['m_nick']?></li>
											<li><?=@$this->member_lib->s_symbol(@$sdata['m_sex'])?> <?=@$sdata['m_name']?> (<?=@$sdata['m_age']?>세)</li>
											<li><?=@$sdata['m_mail']?></li>
											<li><?=@$sdata['m_hp1']."-".@$sdata['m_hp2']."-".@$sdata['m_hp3']?> <? if($out2 == "out"){ echo "(탈퇴회원)"; } ?></li>
										</ul>
									</div>
								</div>
							</td>
							<td>
								<div class="member_div">
									<div><? if($out2 == "out"){}else{ ?><?=$this->member_lib->member_thumb(@$rdata['m_userid'])?> <? } ?></div>
									<div>
										<ul>
											<li>회원 번호 : <?=@$rdata['m_num']?></li>
											<li><?=@$rdata['m_userid']?></li>
											<li><?=@$rdata['m_nick']?></li>
											<li><?=@$this->member_lib->s_symbol(@$rdata['m_sex'])?> <?=@$rdata['m_name']?> (<?=@$rdata['m_age']?>세)</li>
											<li><?=@$rdata['m_mail']?></li>
											<li><?=@$rdata['m_hp1']."-".@$rdata['m_hp2']."-".@$rdata['m_hp3']?> <? if($out2 == "out"){ echo "(탈퇴회원)"; } ?></li>
										</ul>
									</div>
								</div>
							</td>
							<td>
								<div class="gift_div">
									<div><img src="/upload/product_upload/gift/<?=$data['IMG_URL']?>"></div>
									<div>
										<ul>
											<li><b><?=$data['GIFT_NAME']?></b></li>
											<li>상품고유번호 : <?=$data['GIFT_NUM']?></li>
											<li>가격 : <?=$data['PRICE_P']?>P</li>
										</ul>
									</div>
								</div>
							</td>
							<td>
								<div class="deli_div">
									<ul>
										<li><? if($data['SEND_YN'] == "Y"){ echo "선물받음"; }else if($data['SEND_YN'] == "N"){ echo "안받음"; }else if($data['SEND_YN'] == "I"){ echo "배송준비중"; }?></li>
										<li>받은 날짜 : <?=$data['SEND_DATE']?></li>
										<li>받기 완료 : <?=$data['RECV_DATE']?></li>
										<li>배송 날짜 : <?=$data['DELI_DATE']?></li>
									</ul>
								</div>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center bold" colspan="4">결과가 없습니다.</td>
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



