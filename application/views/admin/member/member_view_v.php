<script>
	//특별회원 등록 및 해제
	function special_modi(num, id, cate){
		
		if (cate == 'del'){
			con_text = "을 해제";
		}else{
			con_text = "으로 등록";
		}

		if(confirm("특별회원"+con_text+"하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/admin_setting/special_modi",
				data: {
					"m_idx"		: encodeURIComponent(num),
					"m_userid"	: encodeURIComponent(id),
					"cate"		: encodeURIComponent(cate)
				},	cache: false,async: false,
				success: function(result) {
					if ( result == 1 )
					{
						alert("정상적으로 수정되었습니다");
						location.reload();
					}
					else
					{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	}


	//채팅추천 금지등록
	function stop_chat(num, id, cate){
		
		if (cate == 'del'){
			con_text = "를 해제";
		}else{
			con_text = "로 등록";
		}

		if(confirm("채팅추천 금지"+con_text+"하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/admin_setting/stop_chat",
				data: {
					"m_idx"		: encodeURIComponent(num),
					"m_userid"	: encodeURIComponent(id),
					"cate"		: encodeURIComponent(cate)
				},	cache: false,async: false,
				success: function(result) {
					if ( result == 1 )
					{
						alert("정상적으로 수정되었습니다");
						location.reload();
					}
					else
					{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	}

</script>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1><? if($gubn == "old"){ echo "휴면"; }elseif($gubn == "out"){ echo "탈퇴"; } ?>회원조회</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원관리</span></li>
						<li class="active">회원조회</li>
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>회원 리스트</strong> <!-- panel title -->
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
								<div class="row">
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-body">
													<form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
													<input type="hidden" id="v_gubn" name="v_gubn" value="<?=$gubn?>">
														<fieldset>
															<input type="hidden" name="action" value="contact_send" />
															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label><b style="color:blue;"><? if($views['m_type']=='F'){?>[등급 : 준회원]<?}else{?>[등급 : 정회원]<?}?></b> <? if($login==0){?><span style="color:#999;">비접속중<?}else{?><span style="color:red;">현재 접속중<?}?></span></label>
																		<a class="btn btn-default btn-xs" href="javascript:member_log_out('<?=$views['m_userid']?>');"><i class="fa fa-power-off white"></i> 로그아웃 </a>
																		<br>
																		<input type="text" name="contact[id]" value="<?=$views['m_userid']?>" class="form-control required" readonly style="<? if ($views['m_type'] == 'V'){?>width:100%<? }else{ ?>width:47%;<? } ?>float:left;">
																		<? if ($views['m_type'] == 'F'){ ?>
																		<select style="float:left;width:35%;" class="form-control" id="regular_mb">
																			<option value=""> - 선택 - </option>
																			<option value="1">정회원 전환</option>
																			<option value="3">정회원 전환 (포인트없음)</option>
																			<option value="2">TEST</option>
																		</select>
																		<button type="button" class="btn btn-default" style="width:18%" id="regular_btn">확인</button>
																		<? } ?>
																	</div>

																	<div class="col-md-6 col-sm-6">
																		<label>비밀번호 변경</label> <a class="btn btn-default btn-xs" href="javascript:clear_login();">로그인시도 초기화</a><br>
																		<input type="text" name="m_pwd" id="m_pwd" value="" class="form-control" style="width:37%;float:left;">
																		<button type="button" id="pwd_modify_btn" class="btn btn-default" style="width:18%">변경</button>
																		<button type="button" class="btn btn-default" style="width:40%">임시비번발송</button>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>이름</label>
																		<?if($this->session->userdata('auth_code') >= 10){																		
																			if(empty($views['m_special'])){ ?>
																			<a href="javascript:special_modi('<?=$views['m_num']?>', '<?=$views['m_userid']?>','add');" class="btn btn-default btn-xs"><i class="fa fa-cog white"></i> 특별회원등록 </a>
																			<? }else{ ?>
																			<a href="javascript:special_modi('<?=$views['m_num']?>', '<?=$views['m_userid']?>','del');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 특별회원해제 </a>
																			<? }
																		}?>

																		<?//if($this->session->userdata('auth_code') >= 10){																		
																			if(empty($views['m_send_stop'])){ ?>
																			<a href="javascript:stop_chat('<?=$views['m_num']?>', '<?=$views['m_userid']?>','add');" class="btn btn-default btn-xs"><i class="fa fa-cog white"></i> 채팅추천 금지등록 </a>
																			<? }else{ ?>
																			<a href="javascript:stop_chat('<?=$views['m_num']?>', '<?=$views['m_userid']?>','del');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 채팅추천 금지해제 </a>
																			<? }
																		//}?>
																		
																		<!--
																		<? if ($views['m_special']){?>
																			<br><input type="text" name="m_name" id="m_name" value="<?=$views['m_name']?>" class="form-control required" style="width:80%;float:left;">
																			<button type="button" id="name_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																		<?}else{?>
																			<input type="text" name="contact[name]" value="<?=$views['m_name']?>" class="form-control required" readonly>
																		<? } ?>
																		-->
																		<br><input type="text" name="m_name" id="m_name" value="<?=$views['m_name']?>" class="form-control required" style="width:80%;float:left;">
																		<button type="button" id="name_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>지역</label><br>
																		<select name="m_conregion" id="m_conregion" class="form-control pointer required" style="width:40%;float:left;"  onchange="area_select(this.value,'m_conregion2');">
																			<option value="">- 선택 -</option> 
																			<option value="서울">서울</option> 
																			<option value="인천">인천</option> 
																			<option value="부산">부산</option> 
																			<option value="대구">대구</option> 
																			<option value="대전">대전</option> 
																			<option value="광주">광주</option> 
																			<option value="울산">울산</option> 
																			<option value="경기">경기</option> 
																			<option value="강원">강원</option> 
																			<option value="세종">세종</option> 
																			<option value="충남">충남</option> 
																			<option value="충북">충북</option> 
																			<option value="경남">경남</option> 
																			<option value="경북">경북</option> 
																			<option value="전남">전남</option> 
																			<option value="전북">전북</option> 
																			<option value="제주">제주</option> 
																		</select>

																		<select name="m_conregion2" id="m_conregion2" class="form-control pointer required" style="width:40%;float:left;">
																			<option value="">- 선택 -</option> 
																		</select>
																		<button type="button" id="m_area_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>주민등록번호</label>
																		<a class="btn btn-default btn-xs" href="javascript:change_member_sex('<?=$views['m_userid']?>');"><i class="fa fa-user white"></i> 성별변경 </a>
																		<label>&nbsp;나이 <?=$views['m_age']?></label>
																		<a class="btn btn-default btn-xs" href="javascript:change_age('<?=$views['m_userid']?>');">나이맞추기 </a>

																		<? if ($views['m_special']){?>
																			<br>
																			<input type="text" name="m_jumin1" id="m_jumin1" value="<?=$views['m_jumin1']?>" class="form-control required" style="width:40%;float:left;">
																			<select name="m_jumin2" id="m_jumin2" class="form-control pointer required" style="width:40%;float:left;">
																				<option value="1111111" <? if ($views['m_jumin2'] == '1111111'){ echo "selected"; } ?>>1111111</option>
																				<option value="2222222" <? if ($views['m_jumin2'] == '2222222'){ echo "selected"; } ?>>2222222</option>
																			</select>
																			<button type="button" id="m_jumin_btn" class="btn btn-default" style="width:20%">수정</button>

																		<?}else{?>
																			<input type="text" name="contact[resident]" value="<?=$views['m_jumin1']?>-<?=$views['m_jumin2']?>" class="form-control required" readonly>
																		<? } ?>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>닉네임 <span style="color:red;"><? if($views['m_nick_chk']){ echo "(닉네임 필터 : ".$views['m_nick_chk'].")"; }?></span></label></label><br>
																		<input type="text" name="m_nick" id="m_nick" value="<?=$views['m_nick']?>" class="form-control required" style="width:80%;float:left;">
																		<button type="button" id="nick_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>휴대폰</label>
																		<? echo call_chk_block_member_btn_rtn($views['m_userid'], '1', 'HP'); ?>
																		<br>
																		<input type="text" name="m_hp" id="m_hp" class="form-control" value="<?=$views['m_hp1']?> - <?=$views['m_hp2']?> - <?=$views['m_hp3']?>" placeholder="" style="width:50%;float:left">
																		<select name="m_mobile_chk" id="m_mobile_chk" class="form-control pointer required" style="width:30%;float:left;">
																			<option value="1"> 인증 </option>
																			<option value="0"> 미인증 </option>
																		</select>
																		<button type="button" id="hp_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																	<div class="col-md-3 col-sm-3">
																		<label>문자전송 허용여부</label><br>
																		<select name="m_hp_sms" id="m_hp_sms" class="form-control pointer required" style="width:60%;float:left;">
																			<option value="1"> Y </option>
																			<option value="0"> N </option>
																		</select>
																		<button type="button" id="m_hp_sms_btn" class="btn btn-default" style="width:40%;">수정</button>
																	</div>
																	<div class="col-md-3 col-sm-3">
																		<label>문자팅 등록여부</label><br>
																		<input type="text" name="contact[sms_ting]" value="<? if($sms_use == '0'){ echo "미등록"; }else{ echo "등록"; }?>" class="form-control required" readonly>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>메일 주소</label><br>
																		<input type="text" name="m_mail" id="m_mail" value="<?=$views['m_mail']?>" class="form-control required" style="width:80%;float:left">
																		<button type="button" id="mail_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>메일링 허용여부</label><br>
																		<select name="m_mail_yn" id="m_mail_yn" class="form-control pointer required" style="width:80%;float:left;">
																			<option value="Y"> Y </option>
																			<option value="N"> N </option>
																		</select>
																		<button type="button" id="mailling_modify_btn" class="btn btn-default" style="width:20%">수정</button>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>회원가입일</label>
																		<input type="text" name="contact[join]" value="<?=$views['m_in_date']?>" class="form-control required" readonly>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>파트너ID</label>
																		<input type="text" name="contact[par_id]" value="<?=$views['m_partner']?>" class="form-control required" readonly>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>가입시 IP</label>
																		<input type="text" name="contact[join_ip]" value="<?=$views['m_ip']?>" class="form-control required" readonly>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>총 로그인 수</label>
																		<input type="text" name="contact[all_login]" value="<?=$views['m_login_cnt']?> 번" class="form-control required" readonly>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>마지막로그인 날짜</label>
																		<input type="text" name="contact[last_loginday]" value="<?=$views['last_login_day']?>" class="form-control required" readonly>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>마지막로그인 IP</label>
																		<? echo call_chk_block_member_btn_rtn($views['m_userid'], '1', 'IP'); ?>
																		<input type="text" name="contact[last_login]" value="<?=$views['last_login_ip']?>" class="form-control required" readonly>
																	</div>
																</div>
															</div>


															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>정회원 결제일</label>
																		<input type="text" name="contact[real_join]" value="<?=$v_date?>" class="form-control required" readonly>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>현재 포인트</label>
																		<input type="text" name="contact[country]" value="<? if($t_point == ''){ echo "0 P"; }else{ echo $t_point.' P'; }?>" class="form-control required" readonly>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="form-group">
																	<div class="col-md-6 col-sm-6">
																		<label>휴대폰 인증</label>
																		<input type="text" name="contact[girl_]" value="<? if($views['m_mobile_chk']){ echo $views['m_mobile_chk']." / ".$views['m_mobile_chke_date']; }?>" class="form-control required text-red" readonly>
																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label>신고 처벌횟수</label>
																		<input type="text" name="contact[faulty_cnt]" value="<?=$puni_cnt?>회" class="form-control required text-red" readonly>
																	</div>
																</div>
															</div>

													

													</form>

											</div>

										</div>
										<!-- /----- -->

									</div>

									<div class="col-md-6">

										<div class="panel panel-default">
											<div class="panel-body">
												<div id="panel-ui-tan-l4" class="panel panel-default">
											<div class="panel-heading">
												<span class="elipsis"><!-- panel title -->
													<strong><h4><b>회원 상세 링크</b></h4></strong>
												</span>
											</div>

											<!-- panel content -->
											<div class="panel-body" style="text-align:center">

												<div class="toggle margin-bottom-10">
													<label>포인트내역 (<? if($t_point == ''){ echo "0 P"; }else{ echo $t_point.' P'; }?> )</label>
													<div class="toggle-content">
														<div class="table-responsive">
															<table class="table table-hover nomargin">
																<tr>
																	<td class="width-100">남은 포인트 : </td>
																	<td class="text-left"><b><? if($t_point == ''){ echo "0 P"; }else{ echo $t_point.' P'; }?></b></td>
																</tr>
															</table>
														</div>

														<!-- ## 포인트 사용 -->
														<div class="table-responsive">
															<table class="table table-hover nomargin">
																<tr>
																	<td><b>번호</b></td>
																	<td><b>사용/구매</b></td>
																	<td><b>포인트</b></td>
																	<td><b>날짜</b></td>
																</tr>
															<?
															if($point_ary){
																foreach($point_ary as $key => $val){
															?>
																<tr>
																	<td><?=$val['m_idx']?></td>
																	<td><?=$val['m_goods']?></td>
																	<td><?=$val['m_point']?></td>
																	<td><?=$val['m_writedate']?></td>
																</tr>
															<? } 
																if (count($point_ary) >= 10){
															?>
																<tr>
																	<td colspan="5" class="pointer" onclick="location.href='/admin/profile/point/point_list/q/<?=$views['m_userid']?>/sfl/TotalMembers.m_userid';"><b>더보기</b></td>
																</tr>
															<?
																}
															}else{?>

																<tr>
																	<td colspan="5">포인트 이용내역이 없습니다.</td>
																</tr>
															<? } ?>

															</table>
														</div>
														
													</div>		<!-- ## toggle-content end -->
												</div>

												<!-- ## 충전내역 -->
												<div class="toggle margin-bottom-10">
													<label>충전 내역 (<?=$payment_cnt?> 건)</label>
													<div class="toggle-content">
														<div class="table-responsive">
															<table class="table table-hover nomargin">
																<tr>
																	<td><b>결제수단</b></td>
																	<td><b>결제상태</b></td>
																	<td><b>상품명</b></td>
																	<td><b>주문번호</b></td>
																	<td><b>결제금액(포인트)</b></td>
																</tr>
															<?

															if($payment){
																foreach($payment as $key => $val){

																if($val['pay_gubn'] == "성공"){ $f_color = "blue"; }
																if($val['pay_gubn'] == "실패" || $val['pay_gubn'] == "취소"){ $f_color = "red"; }
																if($val['pay_gubn'] == "시도"){ $f_color = "black"; }
															?>
																<tr>
																	<td><?=$val['pay_method']?></td>
																	<? if($val['pay_gubn'] == "시도" && $val['pay_method'] == '무통장입금'){?>
																		<td><input type="button" class="btn btn-default btn-s" value="확인" onclick="javascript:mu_chked('<?=$val['tid']?>');"></td>
																	<? }else{ ?>
																		<td style="color:<?=$f_color?>;"><?=$val['pay_gubn']?></td>
																	<? } ?>
																	<td><?=$val['goods']?></td>
																	<td>
																		<?=$val['tid']?>
																		<? if(!empty($val['m_ok_name'])){ echo "<br>승인 : ".$val['m_ok_name']; } ?>
																		<? if(!empty($val['m_cancel_name'])){ echo "<br>취소 : ".$val['m_cancel_name']; } ?>
																	</td>
																	<td><? echo number_format($val['price'])."(".$val['point'].")";?></td>
																</tr>
															<? }
																if (count($payment) >= 10){
															?>
																<tr>
																	<td colspan="5" class="pointer" onclick="location.href='/admin/etc/payment/payment_list/user/<?=$views['m_userid']?>';"><b>더보기</b></td>
																</tr>
															<?
																}
															}else{?>

																<tr>
																	<td colspan="5">포인트 충전내역이 없습니다.</td>
																</tr>
															<? } ?>

															</table>
														</div>
														
													</div>		<!-- ## toggle-content end -->
												</div>

												<!-- ## 신고내역 -->
												<div class="toggle margin-bottom-10">
													<label>신고내역 (<?=$coml_ary_cnt?> 건)</label>
													<div class="toggle-content">
														<div class="table-responsive">
															<table class="table table-hover nomargin table-bordered">
																<tr>
																	<td class="width-50"><b>번호</b></td>
																	<td class="width-110"><b>신고사유</b></td>
																	<td class="halfwidth"><b>신고내용</b></td>
																	<td><b>신고일자</b></td>
																</tr>
															<?
															if($coml_ary){
																foreach($coml_ary as $key => $val){
															?>
																<tr>
																	<td><?=$val['c_idx']?></td>
																	<td><?=police_cate($val['c_cate'])?></td>
																	<td class="text-left"><?=$val['c_content']?></td>
																	<td><?=$val['c_date']?></td>
																</tr>
															<? } 
																if (count($coml_ary) >= 10){
															?>
																<tr>
																	<td colspan="4" class="pointer" onclick="location.href='/admin/service_center/complaint/complain_list/q/<?=$views['m_userid']?>/sfl/r_id';"><b>더보기</b></td>
																</tr>
															<?
																}
															}else{?>

																<tr>
																	<td colspan="5">신고내역이 없습니다.</td>
																</tr>
															<? } ?>
																	
															</table>
														</div>
													</div>		<!-- ## toggle-content end -->
												</div>

												<!-- ## 처벌내역 -->
												<div class="toggle margin-bottom-10">
													<label>처벌내역 (<?=$puni_ary_cnt?> 건)</label>
													<div class="toggle-content">
														<div class="table-responsive">
														</div>


														<div class="table-responsive">

															<table class="table table-hover nomargin table-bordered">
																<tr>
																	<td class="width-50"><b>처벌번호</b></td>
																	<td class="width-100"><b>처벌사유</b></td>
																	<td class="halfwidth"><b>처벌내용</b></td>
																	<td><b>처벌일자</b></td>
																	<td><b>처벌해제</b></td>
																</tr>

															<?

															if ($puni_ary){
																foreach($puni_ary as $key => $val){
															?>
																<tr>
																	<td><b><?=$val['p_idx']?></b></td>
																	<td><b><?=police_cate($val['p_cate'])?></b></td>
																	<td class="halfwidth"><b><?=$val['p_content']?></b></td>
																	<td><b><?=$val['p_date']?></b></td>
																	<td><b><?=$val['p_cancel']?></b></td>
																</tr>
															<? }
																if (count($puni_ary) >= 10){
															?>
																<tr>
																	<td colspan="4" class="pointer" onclick="location.href='/admin/service_center/punishment/punish_list/q/<?=$views['m_userid']?>/sfl/Police_punish.user_id';"><b>더보기</b></td>
																</tr>
															<?
																}
															}else{?>

																<tr>
																	<td colspan="5">처벌내역이 없습니다.</td>
																</tr>

															<? } ?>

															</table>
														</div>

														<div class="table-responsive charge_detail" style="display:none">
															<table class="table table-hover nomargin">
																<tr>
																	<td><b>번호</b></td>
																	<td><b>포인트</b></td>
																	<td><b>사용</b></td>
																	<td><b>날짜</b></td>
																</tr>
																		<!-- ## 상세내역 for문 start -->
																<tr>
																	<td>1</td>
																	<td>20 포인트</td>
																	<td>프리채팅 초대장(3일)</td>
																	<td>11-07-12 12:06:19</td>
																</tr>
																		<!-- ## 상세내역 for문 end -->
																<tr>
																	<td>2</td>
																	<td>30 포인트</td>
																	<td>쪽지스킨 자유이용권(60일)</td>
																	<td>11-07-12 12:01:06</td>
																</tr>
															</table>
														</div>
														
													</div>		<!-- ## toggle-content end -->
												</div>

												<!-- ## CS 상담 현황 -->
												<div class="toggle margin-bottom-10">
													<label>CS 상담 현황 (<?=$cs_ary_cnt?> 건)</label>
													<div class="toggle-content">
														<div class="table-responsive">
														</div>

														<div class="table-responsive">
															<table class="table table-hover nomargin table-bordered">
																<tr>
																	<td><b>상담내용</b></td>
																</tr>
																<tr>
																	<td>
																		<div class="col-md-6 col-sm-6">
																			<label>문의 분야</label>
																			<select class="form-control" id="consult_sel">
																				<option value="">선택하세요.</option>
																				<option value="1">가입/탈퇴 문의</option>	
																				<option value="2">포인트 사용 문의</option>	
																				<option value="3">사용자 인증 문의</option>	
																				<option value="4">사진인증 요청</option>	
																				<option value="5">결제 관련(정회원/포인트)</option>	
																				<option value="6">사이트 이용방법 문의</option>	
																				<option value="7">결제 취소/환불</option>	
																				<option value="8">오류 문의</option>	
																				<option value="9">개인정보 및 사진 도용</option>	
																				<option value="10">060 신고</option>	
																				<option value="11">기타</option>	
																			</select>
																		</div>
																		<div class="col-md-6 col-sm-6">
																			<label>작성자</label>
																			<input type="text" id="m_admin_name" name="m_admin_name" value="<?=$user?>" class="form-control required">
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><textarea rows="6" class="form-control required" id="cs_content"></textarea></td>
																</tr>
																<tr>
																	<td>
																		<div class="col-md-4 col-sm-4">
																			<label>추가 상담 여부</label>
																			<select class="form-control" id="consult_add">
																				<option value="">선택하세요.</option>
																				<option value="1">필요</option>
																				<option value="2" selected>불필요</option>
																			</select>
																		</div>
																		<div class="col-md-4 col-sm-4">
																			<label>처리 결과</label>
																			<select class="form-control" id="consult_results">	
																				<option value="">선택하세요.</option>
																				<option value="1">보고</option>
																				<option value="2" selected>해결</option>
																				<option value="3">미해결</option>
																			</select>
																		</div>
																		<div class="col-md-4 col-sm-4">
																			<label>진상 점수</label>
																			<select class="form-control" id="jinsang_point">
																				<option value="0">0점</option>	
																				<option value="1">1점</option>
																				<option value="2">2점</option>
																				<option value="3">3점</option>	
																				<option value="4">4점</option>
																				<option value="5">5점</option>	
																			</select>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><button type="button" class="btn btn-success" id="write_btn" onclick="javascript:cs_add();"><i class="fa fa-pencil"></i> 등록</button></td>
																</tr>
															</table>

															<table class="table table-hover table-bordered margin-top-10">
																<tr>
																	<td class="width-50"><b>상담번호</b></td>
																	<td class="halfwidth"><b>상담내용</b></td>
																	<td class="width-50"><b>상담날짜</b></td>
																</tr>

															<?

															if ($cs_ary){
																foreach($cs_ary as $key => $val){
															?>
																<tr>
																	<td><b><?=$val['m_idx']?></b></td>
																	<td class="halfwidth"><b><?=nl2br($val['m_consult_comment'])?><br><br><?=$val['m_admin_name']?></b></td>
																	<td><b><?=$val['m_admin_date']?></b></td>
																</tr>
															<? }
																if (count($cs_ary) >= 10){
															?>
																<tr>
																	<td colspan="4" class="pointer" onclick="location.href='/admin/service_center/cs/cs_question/q/<?=$views['m_userid']?>/sfl/m_consult_id';"><b>더보기</b></td>
																</tr>
															<?
																}
															}else{?>

																<tr>
																	<td colspan="5">상담내역이 없습니다.</td>
																</tr>

															<? } ?>

															</table>
														</div>
													</div>		<!-- ## toggle-content end -->
												</div>

												<div class="toggle margin-bottom-10">
													<label>회원 이동 경로</label>
													<div class="toggle-content">
														<div class="table-responsive">
															<table class="table table-hover nomargin">
																<tr>
																	<td><nobr><b>구분</b></nobr></td>
																	<td><nobr><b>사이트경로 / 접속시간</b></nobr></td>
																</tr>
																<?
																	if(count($site_url) > 0){
																		foreach($site_url as $data){
																?>
																<tr>
																	<td><nobr><? if($data['view_gubn'] == "P"){ echo "피씨"; }else{ echo "모바일"; } ?></nobr></td>
																	<td class="text-left"><nobr><?=$data['site_url']?> <br><?=$data['write_date']?></nobr></td>
																</tr>
																<?
																		}

																		if(count($site_url) >= 5){
																?>
																<tr>
																	<td colspan="2" class="pointer" onclick="javascript:location.href='/admin/main/member_move_list/user_id/<?=$data['user_id']?>';"><b>더보기</b></td>
																</tr>
																<?
																		}

																	}else{
																?>
																<tr>
																	<td colspan="4">접속내역이 없습니다.</td>
																</tr>
																<?
																	}
																?>															
															</table>
														</div>
														
													</div>		<!-- ## toggle-content end -->
												</div>

												<div class="accordion panel-group" id="accordion">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#acordion2" class="collapsed">
																	<i class="fa fa-check"></i>
																	프로필 사진 (<?=$pic_cnt?> 개)
																</a>
															</h4>
														</div>
														<div id="acordion2" class="collapse">
															<div class="panel-body">
																<div class="inline-block" style="vertical-align:top;position:relative;">
																	<? if(@$pic_row1['pic_status'] == "인증완료"){?>
																		<? if (@$main_pic == '1'){?><img src="<?=IMG_DIR?>/profile/profile_pic_on.png" style="position:absolute;"><? } ?>
																		<? if ($pic_data1){?><img src="<?=$pic_data1?>"><?}else{ echo $null_img; }?>
																	<?}?>
																</div>
																<div class="inline-block" style="vertical-align:top;position:relative;">
																	<? if(@$pic_row2['pic_status'] == "인증완료"){?>
																		<? if (@$main_pic == '2'){?><img src="<?=IMG_DIR?>/profile/profile_pic_on.png" style="position:absolute;"><? } ?>
																		<? if ($pic_data2){?><img src="<?=$pic_data2?>"><?}else{ echo $null_img; }?>
																	<?	}?>
																</div>
																<div class="inline-block" style="vertical-align:top;position:relative;">
																	<? if(@$pic_row3['pic_status'] == "인증완료"){?>
																		<? if (@$main_pic == '3'){?><img src="<?=IMG_DIR?>/profile/profile_pic_on.png" style="position:absolute;"><? } ?>
																		<? if ($pic_data3){?><img src="<?=$pic_data3?>"><?}else{ echo $null_img; }?>
																	<?}?>
																</div>
															</div>

															<div class="panel-body" style="position:relative; width:150px; height:45px; margin:auto;">
																<input type="button" id="admin_photo" name="admin_photo" value="사진 등록하기"  class="btn btn-info" data-toggle="modal" data-target="#member_pic" style="width:150px; height:40px; margin-top:-13px; margin-left:-14px;">
															</div>

														</div>
													</div>
												</div>

											</div>
											<!-- /panel content -->
										</div>
										<!-- /Accordion -->

										<div class="alert alert-bordered margin-bottom-3"></span>
											<div class="row">
												<div class="form-group">
													<div class="col-md-12 col-sm-12">
														<h4><strong>인사말</strong></h4>
														<textarea name="contact[experience]" id="my_intro" rows="4" class="form-control required"><?=$views['my_intro']?></textarea>
														<button type="button" id="my_intro_btn" class="btn btn-default" style="width:15%">수정</button>
													</div>
												</div>

												<div class="form-group">
													<div class="col-md-12 col-sm-12 margin-top-10">
														<h4><strong>원하는만남</strong></h4>
														<input type="text" value="<?=want_reason_data($views['m_reason'])?>" class="form-control required" readonly>
													</div>
												</div>

												<div class="form-group">
													<div class="col-md-12 col-sm-12 margin-top-10">
														<h4><strong>대화스타일</strong></h4>
														<input type="text" value="<?=talk_style_data($views['m_character'],$views['m_sex'])?>" class="form-control required" readonly>
													</div>
												</div>

											</div>
										</div>
					
									</div>

								</div>



						</div>
						<!-- /panel content -->

					</div>
					<!-- /PANEL -->

				</div>

			</section>
			<!-- /MIDDLE -->

<script>
$(document).ready( function(){

	//셀렉트 디폴트 값
	$("#m_hp_sms").val("<?=$views['m_hp_sms']?>");
	$("#m_mail_yn").val("<?=$views['m_mail_yn']?>");
	$("#m_mobile_chk").val("<?=$views['m_mobile_chk']?>");

	<?if($views['m_conregion']){?>
		$("#m_conregion").val("<?=$views['m_conregion']?>");
		area_select('<?=$views['m_conregion']?>','m_conregion2');
		$("#m_conregion2").val("<?=$views['m_conregion2']?>");
	<?}?>

	//휴대폰 수정버튼 클릭
	var result;
	$("#hp_modify_btn").click(function(){
		if(confirm("휴대폰을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("hp"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_hp": encodeURIComponent($("#m_hp").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val()),
					"m_mobile_chk" : encodeURIComponent($("#m_mobile_chk").val())
				},	cache: false,async: false,
				success: function(result) {
					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//메일 수정버튼 클릭
	var result;
	$("#mail_modify_btn").click(function(){
		if(confirm("이메일을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_mail"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_mail").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//메일링 허용여부 수정버튼 클릭
	var result;
	$("#mailling_modify_btn").click(function(){
		if(confirm("메일링 허용여부를 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_mail_yn"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_mail_yn").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//문자전송 허용여부 수정버튼 클릭
	var result;
	$("#m_hp_sms_btn").click(function(){
		if(confirm("메일링 허용여부를 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_hp_sms"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_hp_sms").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//닉네임 수정버튼 클릭
	var result;
	$("#nick_modify_btn").click(function(){
		if(confirm("닉네임을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_nick"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_nick").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//비밀번호 변경버튼 클릭
	var result;
	$("#pwd_modify_btn").click(function(){

		if($("#m_pwd").val() == ""){
			alert("수정할 비밀번호를 입력해 주세요.");
			$("#m_pwd").focus();
		}else{
			if(confirm("비밀번호를 변경하시겠습니까?")){
				$.ajax({
					type: "POST",
					url: "/admin/main/member_filed_change",
					data: {
						"mode": encodeURIComponent("m_pwd"),
						"userid": encodeURIComponent("<?=$views['m_userid']?>"),
						"m_pwd": encodeURIComponent($("#m_pwd").val()),
						"v_gubn" : encodeURIComponent($("#v_gubn").val())
					},	cache: false,async: false,
					success: function(result) {

						if ( result == "1" ){
							alert("정상적으로 수정되었습니다");
						}else if(result == "1000"){
							alert("잘못된 접근입니다.");
							return;
						}else{
							alert("실패하였습니다. (" + result + ")");
						}

					},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
					}
				});

			}

		}
	});

	//이름 수정버튼 클릭
	var result;
	$("#name_modify_btn").click(function(){
		if(confirm("이름을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_name"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_name").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//지역 수정버튼 클릭
	var result;
	$("#m_area_btn").click(function(){


		if(confirm("지역을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_area"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_conregion").val())+"/"+encodeURIComponent($("#m_conregion2").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});


	//주민등록번호 수정버튼 클릭
	var result;
	$("#m_jumin_btn").click(function(){


		if(confirm("주민등록번호를 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("m_jumin"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#m_jumin1").val())+"/"+encodeURIComponent($("#m_jumin2").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	//인사말 수정버튼 클릭
	var result;
	$("#my_intro_btn").click(function(){
		if(confirm("인사말을 수정하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/main/member_filed_change",
				data: {
					"mode": encodeURIComponent("my_intro"),
					"userid": encodeURIComponent("<?=$views['m_userid']?>"),
					"m_data": encodeURIComponent($("#my_intro").val()),
					"v_gubn" : encodeURIComponent($("#v_gubn").val())
				},	cache: false,async: false,
				success: function(result) {

					if ( result == "1" ){
						alert("정상적으로 수정되었습니다");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

		}
	});

	
	// 정회원전환
	$("#regular_btn").click(function() {

		if ($("#regular_mb").val() != ''){

			if (confirm("정회원으로 전환을 하시겠습니까?") == true){ 

				if ($("#regular_mb").val() == '1'){

					$.ajax({
						type: "POST",
						url: "/admin/etc/payment/regular_mb",
						data: {

							user : encodeURIComponent("<?=$views['m_userid']?>")
							
						},	cache: false,async: false,
						success: function(result) {

							if ( result == true )
							{
								alert("정상적으로 수정되었습니다");
							}
							else
							{
								alert("실패하였습니다. (" + result + ")");
							}

						},
						error : function(result){
							alert("실패하였습니다. (" + result + ")");
						}
					});

				}
			
				if ($("#regular_mb").val() == '3'){

					$.ajax({
						type: "POST",
						url: "/admin/etc/payment/regular_mb2",
						data: {

							user : encodeURIComponent("<?=$views['m_userid']?>")
							
						},	cache: false,async: false,
						success: function(result) {

							if ( result == true )
							{
								alert("정상적으로 수정되었습니다");
							}
							else
							{
								alert("실패하였습니다. (" + result + ")");
							}

						},
						error : function(result){
							alert("실패하였습니다. (" + result + ")");
						}
					});

				}

			}
		}

	});


	//회원의 구분값이 휴면이거나, 탈퇴회원일경우 버튼 클래스 막기
	var member_gubn = "<?=$gubn?>";
	
	if(member_gubn == "out" || member_gubn == "old"){
		$(".btn-default").each(function(){
			$(this).addClass("disabled");
		});
	}	


});

// 무통장승인
function mu_chked(tid){


	if(tid != ""){

		if (confirm("승인하시겠습니까??") == true){ 
		
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

	}else{
		alert("거래번호가 없습니다. 관리자에게 문의하시기 바랍니다.");
		return;
	}
}


// 등록버튼 클릭
function cs_add(){

	if($("#consult_sel").val()==''){
		alert("문의 분야를 선택해 주세요.");
		return false;
	}else if ($("#m_admin_name").val() == ''){
		alert("작성자를 입력해주세요.");
		return false;
	}else if ($("#cs_content").val() == ''){
		alert("CS내용을 입력해주세요.");
		return false;
	}else if($("#consult_add").val()==''){
		alert("추가 상담 여부를 선택해 주세요.");
		return false;
	}else if($("#consult_results").val()==''){
		alert("처리 결과를 선택해 주세요.");
		return false;
	}else{
		 $.ajax({

			type : "post",
			url : "/admin/service_center/cs/cs_add",
			data : {
				"m_consult_sel"		: encodeURIComponent($("#consult_sel").val()),
				"m_consult_id"		: encodeURIComponent("<?=$views['m_userid']?>"),
				"m_consult_name"	: encodeURIComponent("<?=$views['m_name']?>"),
				"m_consult_hp"		: encodeURIComponent("<?=$views['m_hp1']?> - <?=$views['m_hp2']?> - <?=$views['m_hp3']?>"),
				"m_consult_comment"	: encodeURIComponent($("#cs_content").val()),
				"m_consult_add"		: encodeURIComponent($("#consult_add").val()),
				"m_consult_results"	: encodeURIComponent($("#consult_results").val()),
				"m_jinsang_point"	: encodeURIComponent($("#jinsang_point").val())
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("정상적으로 등록되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다."+result);
				}				
			},
			error : function(result){
				alert("실패"+result);
			}
		});
	}
}



//회원 강제 로그아웃 처리
function member_log_out(user_id){
	
	if(confirm("해당 회원을 로그아웃 시키시겠습니까?") ==  true){

		$.ajax({

			type : "post",
			url : "/admin/main/member_compulsion_logout",
			data : {
				"user_id" : encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("해당회원이 로그아웃 되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("해당회원이 로그아웃에 실패했습니다..");
					location.reload();
				}else if(result == "3"){
					alert("해당회원은 비로그인중입니다.");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result +")");
					return;
				}else{
					alert("실패 ("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}


//회원 성별 변경
function change_member_sex(user_id){
	
	if(confirm("해당 회원의 성별을 변경하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/main/member_change_sex",
			data : {
				"user_id" : encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("성별이 변경되었습니다.");
				}else if(result == "0"){
					alert("성별 변경에 실패했습니다.");
				}else if(result == "1000"){
					alert("잘못된접근입니다.");
				}else{
					alert("실패 ("+ result +").");
				}

				location.reload();

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}


//나이변경
function change_age(user_id){
	
	if(confirm("해당 회원의 나이를 원상복구 하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/main/member_change_age",
			data : {
				"user_id" : encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("나이가 변경되었습니다.");
				}else if(result == "0"){
					alert("나이 변경에 실패했습니다.");
				}else if(result == "1000"){
					alert("잘못된접근입니다.");
				}else{
					alert("실패 ("+ result +").");
				}

				location.reload();

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}

//로그인 시도 초기화
function clear_login(){

	if(confirm("로그인 시도기록을 삭제하겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/main/clear_login",
			data : {
			
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("처리되었습니다.");
				}else{
					alert("실패 ("+ result +").");
				}

				location.reload();

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}
</script>


<!-- 프로필 사진 등록하기 modal-->
<div id="member_pic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">회원 대표사진 등록하기</h4>
      </div>

	  <form id="upload_form" name="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/admin/main/set_member_pic">
      <div class="modal-body" style="text-align:center;">
			<input type="hidden" id="user_id" name="user_id" value="<?=$views['m_userid']?>">
			<input type="file" id="member_pic" name="member_pic" style="width:400px;">
      </div>
      <div class="modal-footer">
		<input type="submit" id="" name="" value="등록하기" class="btn btn-success"></input>
		&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
      </div>
	  </form>

    </div>
	

  </div>
</div>