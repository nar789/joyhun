<script type="text/javascript">

	$(document).ready(function(){
		
		$(".w40p").datepicker({			
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
			
	});
	
	//enter키 처리(검색)
	function on_keyup_enter(){
		var keycode = window.event.keyCode;

		if(keycode == 13){
			payment_submit();
		}
	}

	

	//검색 
	function payment_submit(){
		
		//페이징때문에 get 방식으로 변경

		var v_para = "";
		
		if($("#m_payment_gb").val()){ v_para += "/m_payment_gb/"+encodeURIComponent($("#m_payment_gb").val()); }
		if($("#m_result").val()){ v_para += "/m_result/"+encodeURIComponent($("#m_result").val()); }
		if($("#m_writedate_1").val()){ v_para += "/m_writedate_1/"+encodeURIComponent($("#m_writedate_1").val()); }
		if($("#m_writedate_2").val()){ v_para += "/m_writedate_2/"+encodeURIComponent($("#m_writedate_2").val()); }
		if($("#m_okdate_1").val()){ v_para += "/m_okdate_1/"+encodeURIComponent($("#m_okdate_1").val()); }
		if($("#m_okdate_2").val()){ v_para += "/m_okdate_2/"+encodeURIComponent($("#m_okdate_2").val()); }
		if($("#m_name").val()){ v_para += "/m_name/"+encodeURIComponent($("#m_name").val()); }
		if($("#m_hptele").val()){ v_para += "/m_hptele/"+encodeURIComponent($("#m_hptele").val()); }
		if($("#m_userid").val()){ v_para += "/m_userid/"+encodeURIComponent($("#m_userid").val()); }
		if($("#m_tid").val()){ v_para += "/m_tid/"+encodeURIComponent($("#m_tid").val()); }
		if($("#m_member_gubn").val()){ v_para += "/m_member_gubn/"+encodeURIComponent($("#m_member_gubn").val()); }
		if($("#m_partner").val()){ v_para += "/m_partner/"+encodeURIComponent($("#m_partner").val()); }
		if($("#m_partner_code").val()){ v_para += "/m_partner_code/"+encodeURIComponent($("#m_partner_code").val()); }		
		
		$(location).attr("href", "/admin/etc/payment/payment_list"+v_para);
	}

	//취소처리
	function payment_cencel(tid){

		if(confirm("거래를 취소하시겠습니까?") == true){

			if(tid != ""){
			
				$.ajax({

					type : "post",
					url : "/admin/etc/payment/payment_cancel",
					data : {
						"tid"	: encodeURIComponent(tid)
					},
					cache : false,
					async : false,
					success : function(result){

						if(result == "success"){
							alert("결제취소하였습니다.");
							location.reload();
						}else if(result == "error"){
							alert("결제취소를 실패했습니다.");
							location.reload();
						}
					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
						console.log(result);
					}

				});

			}
			else{
				alert("거래번호가 없습니다. 관리자에게 문의하시기 바랍니다.");
				return;
			}

		}
		
		
	}

	//무통장입금 승인처리
	function payment_success(tid){

		if(tid != ""){
			
			if(confirm("무통장입금을 승인하시겠습니까?") == true){

				$.ajax({

					type : "post",
					url : "/admin/etc/payment/payment_success",
					data : {
						"tid"	: encodeURIComponent(tid)
					},
					cache : false,
					async : false,
					success : function(result){
						
						if(result == "success"){
							alert("승인처리를 완료했습니다.");
							location.reload();
						}else if(result == "error"){
							alert("승인처리에 실패했습니다.");
							location.reload();
						}
						
					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
						console.log(result);
					}

				});

			}			

		}
		else{
			alert("거래번호가 없습니다. 관리자에게 문의하시기 바랍니다.");
			return;
		}
	}
	

</script>

<style>
	.s_tbl{width:100%;}
	.s_tbl tr{height:45px;}
	.s_tbl th{border-top: solid 1px #E5E5E5; border-right: solid 1px #E5E5E5;background-color:#F1F2F7;}
	.s_tbl td{border-top: solid 1px #E5E5E5; border-right: solid 1px #E5E5E5; text-align:center;}
	.s_tbl td input{border: solid 1px #E5E5E5;}
	.s_tbl td select{border:0; width:100%;}
	
	.bd_l{border-left:solid 1px #E5E5E5;}
	.bd_b{border-bottom:solid 1px #E5E5E5;}
	.w40p{width:40%;}
	.w90p{width:90%;}

	.cancel_btn{width:50px; height:25px; font-size:1.0em; line-height:10px; font-weight:bold;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>결제내역 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>회원 검색</strong> <!-- panel title -->
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
				<fieldset>
					<form name="frmSearch" id="frmSearch" method="post" class="form-inline" >
					<div class="form-group" style="position:relative; width:100%;">
						
						<table cellspacing=0 cellpadding=0 class="s_tbl">
							<tr>
								<th class="bd_l" width="10%"><nobr>결제수단</nobr></th>
								<td width="10%"><nobr>
									<select id="m_payment_gb" name="m_payment_gb">
										<option value="" <? if($s_payment_gb == ""){ echo "selected"; } ?> >전체</option>
										<option value="HP" <? if($s_payment_gb == "HP"){ echo "selected"; } ?> >휴대폰결제</option>
										<option value="CARD" <? if($s_payment_gb == "CARD"){ echo "selected"; } ?> >카드결제</option>
										<option value="ACCOUNT" <? if($s_payment_gb == "ACCOUNT"){ echo "selected"; } ?> >실시간계좌이체</option>
										<option value="PB" <? if($s_payment_gb == "PB"){ echo "selected"; } ?> >일반전화(받기)</option>
										<option value="TP" <? if($s_payment_gb == "TP"){ echo "selected"; } ?> >일반전화(걸기)</option>
										<option value="BK" <? if($s_payment_gb == "BK"){ echo "selected"; } ?> >가상계좌</option>
										<option value="MU" <? if($s_payment_gb == "MU"){ echo "selected"; } ?> >무통장입금</option>
										<option value="GG" <? if($s_payment_gb == "GG"){ echo "selected"; } ?> >구글인앱</option>
									</select>
								</nobr></td>
								<th width="10%"><nobr>결제상태</nobr></th>
								<td width="10%"><nobr>
									<select id="m_result" name="m_result">
										<option value="">전체</option>
										<option value="성공" <? if($s_result == "성공"){ echo "selected"; } ?> >성공</option>
										<option value="실패" <? if($s_result == "실패"){ echo "selected"; } ?> >실패</option>
										<option value="시도" <? if($s_result == "시도"){ echo "selected"; } ?> >시도</option>
										<option value="취소" <? if($s_result == "취소"){ echo "selected"; } ?> >취소</option>
									</select>
								</nobr></td>
								<th width="10%"><nobr>시도일자</nobr></th>
								<td width="20%"><nobr>
									<input type="text" id="m_writedate_1" name="m_writedate_1" value="<?=$s_writedate_1?>" class="w40p">
									-
									<input type="text" id="m_writedate_2" name="m_writedate_2" value="<?=$s_writedate_2?>" class="w40p">
								</nobr></td>
								<th width="10%"><nobr>완료일자</nobr></th>
								<td width="20%"><nobr>
									<input type="text" id="m_okdate_1" name="m_okdate_1" value="<?=$s_okdate_1?>" class="w40p">
									-
									<input type="text" id="m_okdate_2" name="m_okdate_2" value="<?=$s_okdate_2?>" class="w40p">
								</nobr></td>
							</tr>
							<tr>
								<th class="bd_l" width="10%"><nobr>입금자명</nobr></th>
								<td width="10%"><input type="text" id="m_name" name="m_name" value="<?=$s_name?>" class="w90p" onkeyup="javascript:on_keyup_enter();"><nobr>
									
								</nobr></td>
								<th width="10%"><nobr>휴대전화번호</nobr></th>
								<td width="10%"><input type="text" id="m_hptele" name="m_hptele" value="<?=$s_hptele?>" class="w90p" onkeyup="javascript:on_keyup_enter();"><nobr>
									
								</nobr></td>
								<th width="10%"><nobr>아이디</nobr></th>
								<td width="20%"><nobr><input type="text" id="m_userid" name="m_userid" value="<?=$s_userid?>" class="w90p" onkeyup="javascript:on_keyup_enter();"></nobr></td>
								<th width="10%"><nobr>주문번호</nobr></th>
								<td width="20%"><nobr><input type="text" id="m_tid" name="m_tid" value="<?=$s_tid?>" class="w90p" onkeyup="javascript:on_keyup_enter();"></nobr></td>
							</tr>
							<tr>
								<th class="bd_l bd_b">회원구분</th>
								<td class="bd_b">
									<select id="m_member_gubn" name="m_member_gubn">
										<option value="">전체</option>
										<option value="회원" <? if($s_member_gubn == "회원"){ echo "selected"; } ?> >회원</option>
										<option value="탈퇴회원" <? if($s_member_gubn == "탈퇴회원"){ echo "selected"; } ?> >탈퇴회원</option>
									</select>
								</td>
								<th class="bd_b"></th>
								<td class="bd_b"></td>
								<th class="bd_b">파트너아이디</th>
								<td class="bd_b"><input type="text" id="m_partner" name="m_partner" value="<?=$s_m_partner?>" class="w90p"></td>
								<th class="bd_b">광고코드</th>
								<td class="bd_b"><input type="text" id="m_partner_code" name="m_partner_code" value="<?=$s_m_partner_code?>" class="w90p"></td>
							</tr>
						</table>
						
						<div style="position:relative; width:100%; height:60px; padding-top:20px; text-align:right;">
							<input type="button" id="search_btn" name="search_btn" value="검색" class="btn btn-success" style="width:100px; height:35px; font-weight:bold;" onclick="javascript:payment_submit();">
						</div>
					</div>
					</form>
				</fieldset>
			</div>
		</div>


		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>결제 리스트</strong> <!-- panel title -->
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
				<div class="table-responsive" style="font-size:0.9em;">
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th class="width-100"><nobr>결제수단</nobr></th>
							<th class="width-100"><nobr>결제상태</nobr></th>
							<th class="width-100"><nobr>결제코드</nobr></th>
							<th><nobr>주문자(입금자, 전화번호)</nobr></th>
							<th class="width-100"><nobr>닉네임</nobr></th>
							<th class="width-300"><nobr>[결제횟수]주문번호</nobr></th>
							<th class="width-100"><nobr>상품명</nobr></th>
							<th class="width-100"><nobr>결제금액</nobr></th>
							<th class="width-100"><nobr>포인트</nobr></th>
							<th class="width-100"><nobr>시도일자</nobr></th>
							<th class="width-100"><nobr>완료일자</nobr></th>
							<th class="width-100"><nobr>처리</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
										if($data['pay_gubn'] == "성공"){ $f_color = "blue"; }
										if($data['pay_gubn'] == "실패" || $data['pay_gubn'] == "취소"){ $f_color = "red"; }
										if($data['pay_gubn'] == "시도"){ $f_color = "black"; }
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['pay_method']?></nobr></td>
								<td class="text-center" style="color:<?=$f_color?>;"><nobr><?=$data['pay_gubn']?></nobr></td>
								<td class="text-center"><nobr><?=$data['result_code']?></nobr></td>
								<td class="text-center"><nobr>
									<? if($data['pay_method'] == "무통장입금"){ ?>
									<?=$data['userid']?> [<?=$data['m_mstr']?> : <?=$data['hptele']?>]
									<? }else{ ?>
									<?=$data['userid']?> [<?=$data['name']?> : <?=$data['hptele']?>]
									<? } ?>

									<? if($data['member_gubn'] == "탈퇴회원"){ ?>
									<b style="color:red;"> (탈퇴)</b>
									<? } ?>

								</nobr></td>
								<td class="text-center"><nobr><a href="/admin/main/member_view/userid/<?=$data['userid']?>/gubn/new" target="_blank"><?=$data['m_nick']?></a></nobr></td>
								<td class="text-center"><nobr><?=$data['tid']?>
								<?if($data['m_mobilid'] != ""){echo "<br>".$data['m_mobilid'];}?>
								</nobr></td>
								<td class="text-center"><nobr><?=$data['goods']?></nobr></td>
								<td class="text-center"><nobr><?=number_format($data['price'])?>원</nobr></td>
								<td class="text-center"><nobr><?=$data['point']?></nobr></td>
								<td class="text-center"><nobr><?=$data['writedate']?></nobr></td>
								<td class="text-center"><nobr>
									<?=$data['okdate']?>
									<? if(!empty($data['m_ok_name'])){ echo "<br>승인 : ".$data['m_ok_name']; } ?>
									<? if(!empty($data['m_cancel_name'])){ echo "<br>취소 : ".$data['m_cancel_name']; } ?>
								</nobr></td>
								<td class="text-center"><nobr>
									<?
										if($data['pay_method'] == "무통장입금"){
											if($data['pay_gubn'] == "시도"){
									?>
										<input type="button" class="btn btn-success cancel_btn" value="승인" onclick="javascript:payment_success('<?=$data['tid']?>');">	
									<?
											}else if($data['pay_gubn'] == "성공"){
									?>
										<input type="button" class="btn btn-danger cancel_btn" value="취소" onclick="javascript:payment_cencel('<?=$data['tid']?>');">
									<?
											}else if($data['pay_gubn'] == "취소"){
									?>
										<b>취소완료</b>
									<?
											}
										}else{
											if($data['pay_gubn'] == "성공"){
									?>
										<input type="button" class="btn btn-danger cancel_btn" value="취소" onclick="javascript:payment_cencel('<?=$data['tid']?>');">
									<?
											}
										}
										
									?>									
								</nobr></td>
							</tr>
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="12" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?}?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
			</div>
		</div>


	</div>

</section>