
			<!-- 
				MIDDLE 
			-->
			<section id="middle">
				<!-- page title -->
				<header id="page-header">
					<h1>슈퍼채팅+슈퍼찜 보내기</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">채팅관리</span></li>
						<li class="active">슈퍼채팅+슈퍼찜</li>
					</ol>
				</header>
				<!-- /page title -->

				<div id="content" class="padding-20">
					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>받는 회원 조건</strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->
						</div>
						<div class="panel-body ">
							<table cellspacing=0 cellpadding=0 class="s_tbl">
								<tr>
									<th class="bd_l" width="10%"><nobr>포인트</nobr></th>
									<td><nobr>
										<input type="text" id="search_point" name="search_point" class="form-control" value="<?if(@$point != 'null'){echo @$point;}?>" placeholder="포인트를 입력해주세요." style="width:80%;display:inline-block;"><p style="display:inline-block">&nbsp;P 이상</p>
									</nobr></td>
									<th width="10%"><nobr>지역</nobr></th>
									<td><nobr>
										<select class="form-control" id="search_area" name="search_area">
											<option value="">선택하세요.</option>
											<option value="1" <? if(@$area == '1'){ echo "selected"; }?>>서울/경기/인천</option>
											<option value="2" <? if(@$area == '2'){ echo "selected"; }?>>부산/울산/경남</option>
											<option value="3" <? if(@$area == '3'){ echo "selected"; }?>>대구/경북</option>
											<option value="4" <? if(@$area == '4'){ echo "selected"; }?>>광주/전남/전북</option>
											<option value="5" <? if(@$area == '5'){ echo "selected"; }?>>대전/충남/충북</option>
											<option value="6" <? if(@$area == '6'){ echo "selected"; }?>>강원</option>
											<option value="7" <? if(@$area == '7'){ echo "selected"; }?>>제주</option>
											<option value="8" <? if(@$area == '8'){ echo "selected"; }?>>해외</option>
										</select>
									</nobr></td>
									<th width="10%"><nobr>나이</nobr></th>
									<td width="20%"><nobr>
										<select class="col-md-5" id="search_age_start" name="search_age_start">
											<option value="">선택하세요.</option>
										<? for ($i=20; $i<70; $i++){?>
											<option value="<?=$i?>" <?if(@$Sage == $i){ echo "selected"; }?>><?=$i?></option>
										<? } ?>
										</select>
										<div style="float:left;height:46px;line-height:46px;font-weight:bold;">&nbsp;~&nbsp;</div>
										<select class="col-md-5" id="search_age_end" name="search_age_end">
											<?if(@$Eage){?>
												<option value="<?=$Eage?>" selected><?=$Eage?></option>
											<?}?>
										</select>
									</nobr></td>
								</tr>
								<tr>
									<th style="height:60px;"><nobr>접속날짜</nobr></th>
									<td><nobr>
										<input type="text" id="online_date_1" name="online_date_1" value="<?if(@$Sonline != 'null'){echo @$Sonline;}?>" class="w40p form-control" style="width:45%;float:left">
										<span style="width:10%;float:left;font-weight:bold;line-height:40px;">&nbsp;~&nbsp;</span>
										<input type="text" id="online_date_2" name="online_date_2" value="<?if(@$Eonline != 'null'){echo @$Eonline;}?>" class="w40p form-control" style="width:45%;float:left">
									</nobr></td>
									<th><nobr>가입날짜</nobr></th>
									<td><nobr>
										<input type="text" id="join_date_1" name="join_date_1" value="<?if(@$Sjoin != 'null'){echo @$Sjoin;}?>" class="w40p form-control" style="width:45%;float:left">
										<span style="width:10%;float:left;font-weight:bold;line-height:40px;">&nbsp;~&nbsp;</span>
										<input type="text" id="join_date_2" name="join_date_2" value="<?if(@$Ejoin != 'null'){echo @$Ejoin;}?>" class="w40p form-control" style="width:45%;float:left">
									</nobr></td>
									<th><nobr>정회원여부</nobr></td>
									<td><nobr>
										<select class="form-control" id="search_type" name="search_type">
											<option value="A" <? if(@$type == 'A' || @$type == 'null' || @$type == ''){ echo "selected"; }?>>정회원+준회원</option>
											<option value="V" <? if(@$type == 'V'){ echo "selected"; }?>>정회원만</option>
											<option value="F" <? if(@$type == 'F'){ echo "selected"; }?>>준회원만</option>
										</select>
									</nobr></td>
								</tr>
								<tr>
									<td colspan="6" style="text-align:right">
										<button type="button" class="btn btn-success margin-top-3" id="search_btn"><i class="fa fa-search"></i> 검색</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<!-- /PANEL -->

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>받는회원 리스트</strong> <!-- panel title -->
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
							<table class="table nomargin">
								<tr>
									<td class="width-150">사진</td>
									<td class="width-250">아이디</td>
									<td class="width-250">닉네임</td>
									<td class="width-150">나이</td>
									<td class="width-200">지역</td>
									<td class="width-350">정회원여부</td>
									<td>포인트</td>
								</tr>
							</table>
							<div style="max-height:300px;overflow:auto;">
								<table class="table nomargin">


								<? if (!empty($recv_mb)){
								
										foreach($recv_mb as $data){ ?>
									<tr>
										<td class="width-150"><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></td>
										<td class="width-250"><?=$data['m_userid']?></td>
										<td class="width-250"><?=$data['m_nick']?></td>
										<td class="width-150"><?=$data['m_age']?></td>
										<td class="width-200"><?=$data['m_conregion']?> / <?=$data['m_conregion2']?></td>
										<td class="width-350"><?=$data['m_type']?></td>
										<td><?=$data['total_point']?></td>
									</tr>
								<? }  }else{ ?>
									<tr>
										<td colspan="6" class="text-center">검색된 회원이 없습니다.</td>
									</tr>
								<? } ?>
								</table>
							</div>
						</div>
					</div>
					<!-- /PANEL -->

					<div id="panel-3" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>보내기 설정</strong>
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
							<div class="col-md-6 col-sm-6">
								<label>스페셜 아이디</label><br>

									<? //echo $m_special[0]['m_userid'];
									//echo count($m_special);?>
								<select class="form-control" id="search_id" name="search_id">
									<option value="">선택하세요.</option>

									<? for($i=0; $i<count($m_special); $i++){ ?>
									<option value="<?=$m_special[$i]['m_userid']?>"><?=$m_special[$i]['m_userid']?> / <?=$m_special[$i]['m_age']?></option>
									<? } ?>
								</select>
								<table class="table nomargin" style="height:260px">
									<tr>
										<td rowspan="4" style="width:260px;">
											<div id="add_pic"></div>
										</td>
										<td class="width-100" style="vertical-align: middle;">
											아이디
										</td>
										<td class="text-left" style="vertical-align: middle;">
											<span id="add_id"></span>
										</td>
									</tr>
									<tr>
										<td class="width-100" style="vertical-align: middle;">
											닉네임
										</td>
										<td class="text-left" style="vertical-align: middle;">
											<span id="add_nick"></span>
										</td>
									</tr>
									<tr>
										<td class="width-100" style="vertical-align: middle;">
											나이
										</td>
										<td class="text-left" style="vertical-align: middle;">
											<span id="add_age"></span>
										</td>
									</tr>
									<tr>
										<td class="width-100" style="vertical-align: middle;">
											지역
										</td>
										<td class="text-left" style="vertical-align: middle;">
											<span id="add_area"></span>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6 col-sm-6">
								<label class="radio-inline">
									<input type="radio" name="taget_send" id="taget_chat_radio" value="chat" onclick="javascript:search_what('chat');" checked> 채팅
								</label>
								<label class="radio-inline">
									<input type="radio" name="taget_send" id="taget_jjim_radio" value="jjim" onclick="javascript:search_what('jjim');"> 찜
								</label>
								<label class="radio-inline">
									<input type="radio" name="taget_send" id="taget_profile_radio" value="profile" onclick="javascript:search_what('profile');"> 프로필이미지쪽지
								</label>
								<label class="radio-inline">
									<input type="radio" name="taget_send" id="taget_message_radio" value="message" onclick="javascript:search_what('message');"> 메세지
								</label>
								<label class="radio-inline">
									<input type="radio" name="taget_send" id="taget_map_radio" value="map" onclick="javascript:search_what('map');"> 지도표시
								</label>

								<div class="margin-top-10" id="taget_chat">
									<label>채팅내용</label>
									<a class="btn btn-danger btn-xs" href="javascript:add_text('#sin_msg_1');">[지역] 추가 </a>												
									<br>
									<textarea rows="6" class="form-control required" id="sin_msg_1"></textarea>
									총 <span id="all_mb_cnt"><?=@$all_recv_mb?></span> 명 검색<br><input type="text" value="<?=@$all_recv_mb?>" id="send_mb_cnt" style="display:inline-block;width:100px;" class="form-control required">&nbsp;명에게
									<button type="submit" class="btn btn-success" onclick="javascript:send_mb('send');"><i class="fa fa-search"></i> 채팅 보내기</button>
								</div>

								<div class="margin-top-10" id="taget_jjim">
									총 <span id="all_mb_cnt"><?=@$all_recv_mb?></span> 명 검색<br><input type="text" value="<?=@$all_recv_mb?>" id="send_mb_cnt" style="display:inline-block;width:100px;" class="form-control required">&nbsp;명에게
									<button type="submit" class="btn btn-success" onclick="javascript:send_mb('send');"><i class="fa fa-search"></i> 찜 보내기</button>
								</div>

								<div class="margin-top-10" id="taget_profile">
									총 <span id="all_mb_cnt"><?=@$all_recv_mb?></span> 명 검색<br><input type="text" value="<?=@$all_recv_mb?>" id="send_mb_cnt" style="display:inline-block;width:100px;" class="form-control required">&nbsp;명에게
									<button type="submit" class="btn btn-success" onclick="javascript:send_mb('send');"><i class="fa fa-search"></i> 프로필이미지쪽지 보내기</button>
								</div>

								<div class="margin-top-10" id="taget_message">
									<label>메세지내용</label>
									<a class="btn btn-danger btn-xs" href="javascript:add_text('#sin_msg_2');">[지역] 추가 </a>												
									<br>
									<textarea rows="6" class="form-control required" id="sin_msg_2"></textarea>
									총 <span id="all_mb_cnt"><?=@$all_recv_mb?></span> 명 검색<br><input type="text" value="<?=@$all_recv_mb?>" id="send_mb_cnt" style="display:inline-block;width:100px;" class="form-control required">&nbsp;명에게
									<button type="submit" class="btn btn-success" onclick="javascript:send_mb('send');"><i class="fa fa-search"></i> 메세지 보내기</button>
								</div>

								<div class="margin-top-10" id="taget_map">
									<label>채팅내용(지도표시)</label>
									<a class="btn btn-danger btn-xs" href="javascript:add_text('#sin_msg_3');">[지역] 추가 </a>												
									<br>
									<textarea rows="6" class="form-control required" id="sin_msg_3"></textarea>
									총 <span id="all_mb_cnt"><?=@$all_recv_mb?></span> 명 검색<br><input type="text" value="<?=@$all_recv_mb?>" id="send_mb_cnt" style="display:inline-block;width:100px;" class="form-control required">&nbsp;명에게
									<button type="submit" class="btn btn-success" onclick="javascript:send_mb('send');"><i class="fa fa-search"></i> 채팅 보내기</button>
								</div>


								<div class="booking_div">
									<select id="v_year" name="v_year" style="width:100px;">
										<option value=""> 년도 </option>
										<? for($i=2016; $i<=date("Y", strtotime("+2 year")); $i++){ ?>
										<option value="<?=$i?>" <? if($v_year == $i) { echo "selected"; } ?> > <? echo $i;?>년 </option>
										<? } ?>
									</select>

									<select id="v_month" name="v_month" style="width:100px;">
										<option value=""> 월 </option>
										<? for($i=1; $i<=12; $i++){ ?>
										<option value="<?=zero_num($i)?>" <? if($v_month ==  zero_num($i)){ echo "selected"; } ?> > <? echo zero_num($i);?>월 </option>
										<? } ?>
									</select>

									<select id="v_day" name="v_day" style="width:100px;">
										<option value=""> 일 </option>
										<? for($i=1; $i<=31; $i++){ ?>
										<option value="<?=zero_num($i)?>" <? if($v_day ==  zero_num($i)){ echo "selected"; } ?> > <? echo zero_num($i);?>일 </option>
										<? } ?>
									</select>

									<select id="v_time" name="v_time" style="width:100px;">
										<option value=""> 시간 </option>
										<? for($i=1; $i<=23; $i++){ ?>
										<option value="<?=zero_num($i)?>"> <? echo zero_num($i);?>시 </option>
										<? } ?>
									</select>

									<select id="v_minute" name="v_minute" style="width:100px;">
										<option value="00">0분</option>
										<option value="10">10분</option>
										<option value="20">20분</option>
										<option value="30">30분</option>
										<option value="40">40분</option>
										<option value="50">50분</option>
									</select>

									<input type="button" id="btn_book" name="btn_book" value="예약발송" class="btn btn-info" onclick="javascript:send_mb('book');">
								</div>

							</div>
						</div>
					</div>
					<!-- /PANEL -->

					<div id="panel-4" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>예약발송내역</strong>
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->
						</div>
						<div class="panel-body" style="widht:100%; height:500px; overeflow:hidden; overflow-y:scroll;">
							<table class="table table-bordered table-vertical-middle nomargin" style="white-space:nowrap;">
								<thead>
								<tr>
									<th>발송구분</th>
									<th>발송분류</th>
									<th>보내는이</th>
									<th>받는회원 조건</th>
									<th>내용</th>
									<th>대상수</th>
									<th>발송상태</th>
									<th>날짜</th>
									<th>취소</th>
								</tr>
								</thead>
								<tbody>
								<?
									if(!empty($SUP100_LIST)){
										foreach($SUP100_LIST as $data){
								?>
								<tr>
									<td><?=$data['V_GUBN']?></td>
									<td><? if($data['V_MODE'] == "chat"){ echo "채팅"; }else if($data['V_MODE'] == "jjim"){ echo "찜"; }else if($data['V_MODE'] == "profile"){ echo "프로필이미지쪽지"; }else if($data['V_MODE'] == "message"){ echo "메세지"; }else if($data['V_MODE'] == "map"){ echo "채팅(지도표시)"; }else{ echo "기타"; } ?></td>
									<td>
										<?=$data['V_SEND_ID']?><br>
										<?=$data['V_SEND_NICK']?><br>
										(<?=$data['V_SEND_AGE']?>세)
									</td>
									<td style="text-align:left; padding-left:10px;">
										포인트 : <?=$data['V_POINT']?> P 이상<br>
										지역 : <?=@call_super_chat_area($data['V_AREA'])?><br>
										나이 : <?=$data['V_AGE_1']?> ~ <?=$data['V_AGE_2']?><br>
										접속날짜 : <?=$data['V_ONLINE_1']?> ~ <?=$data['V_ONLINE_2']?><br>
										가입날짜 : <?=$data['V_JOIN_1']?> ~ <?=$data['V_JOIN_2']?><br>
										회원등급 : <?=call_super_chat_type($data['V_TYPE'])?>
									</td>
									<td><?=$data['V_CONTENTS']?></td>
									<td><?=$data['V_CNT']?></td>
									<td><?=$data['V_STAT']?></td>
									<td style="text-align:left;">
										접수 : <?=$data['V_WRITE_DATE']?><br>
										예약 : <?=$data['V_BOOK_DATE']?><br>
										완료 : <?=$data['V_OK_DATE']?>
									</td>
									<td>
										<? if($data['V_STAT'] == "예약"){ ?>
										<input type="button" id="btn_cancel" name="btn_cancel" value="취소" class="btn btn-danger" onclick="javascript:call_book_cancel('<?=$data['V_IDX']?>');">
										<? } ?>
									</td>
								</tr>
								<?
										}
									}else{
								?>
								<tr>
									<td colspan="10"><b>결과가 없습니다.</b></td>
								</tr>
								<?
									}
								?>
								</tbody>
							</table>
						</div>
					</div>

				</div>

			</section>
			<!-- /MIDDLE -->


<script>

$(document).ready(function(){


	// 라디오 ready 설정
	if($("#taget_chat_radio").is(":checked")){
		$("#taget_chat").show();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if($("#taget_jjim_radio").is(":checked")){
		$("#taget_chat").hide();
		$("#taget_jjim").show();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if($("#taget_profile_radio").is(":checked")){
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").show();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if($("#taget_message_radio").is(":checked")){
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").show();
		$("#taget_map").hide();
	}else {
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").show();
	}


	// 접속날짜, 가입날짜
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

	// 채팅설정 아이디 설정
	$("#search_id").change(function() {

		if($("#search_id").val() == ''){
			return false;
		}else{
			$.ajax({
				type : "post",
				url : "/admin/chatting/super_chat/special_search",
				data : {
					"user"	: encodeURIComponent($("#search_id").val())
				},
				cache : false,
				async : false,
				success : function(result){

					var user = result.split(',');

					$("#add_id").text(user[0]);
					$("#add_nick").text(user[1]);
					$("#add_age").text(user[2]);
					$("#add_area").text(user[3]); 
					$("#add_pic").text('');
					$("#add_pic").append(user[4]);

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
					console.log(result);
				}
			});
		}
	});

	// 나이선택
	$("#search_age_start").change(function() {

		if($("#search_age_start").val() == ''){
			$("#search_age_end option").remove();
			return false;

		}else{
			var age_start = Number($("#search_age_start option:selected").val());
			$("#search_age_end option").remove();

			for (i=age_start+1; i<70; i++){
				$("#search_age_end").append("<option value='"+i+"'>"+i+"</option>");
			}
		}
	});

	// 접속날짜 검사
	$("#online_date_2").change(function() {

		if($("#online_date_1").val() == ''){

			alert("시작날짜를 먼저 설정해주세요");
			$("#online_date_2").val('');
			return false;

		}else{
			var startDate	 = $("#online_date_1").val().split("-");
			var endDate		 = $("#online_date_2").val().split("-");
			var sDate		 = new Date(startDate[0], startDate[1], startDate[2]).valueOf();
			var eDate		 = new Date(endDate[0], endDate[1], endDate[2]).valueOf();

			if(sDate > eDate ){
				alert("접속날짜를 다시 설정해주세요.");
				$("#online_date_1").val('');
				$("#online_date_2").val('');
				return false;
			}
		}
	});

	// 가입날짜 검사
	$("#join_date_2").change(function() {

		if($("#join_date_1").val() == ''){
			alert("가입날짜를 먼저 설정해주세요");
			$("#join_date_1").val('');
			return false;

		}else{
			var startDate	 = $("#join_date_1").val().split("-");
			var endDate		 = $("#join_date_2").val().split("-");
			var sDate		 = new Date(startDate[0], startDate[1], startDate[2]).valueOf();
			var eDate		 = new Date(endDate[0], endDate[1], endDate[2]).valueOf();

			if(sDate > eDate ){

				alert("가입날짜를 다시 설정해주세요.");
				$("#join_date_1").val('');
				$("#join_date_2").val('');
				return false;
			}
		}
	});

	// 채팅받을 회원 검색
	$("#search_btn").click(function(){

		if($("#search_point").val())		{ var point = encodeURIComponent($("#search_point").val()); }else{ var point = 'null' }
		if($("#search_area").val())			{ var area = encodeURIComponent($("#search_area").val()); }else{ var area = 'null' }
		if($("#search_age_start").val())	{ var Sage = encodeURIComponent($("#search_age_start").val()); }else{ var Sage = 'null' }
		if($("#search_age_end").val())		{ var Eage = encodeURIComponent($("#search_age_end").val()); }else{ var Eage = 'null' }
		if($("#online_date_1").val())		{ var Sonline = encodeURIComponent($("#online_date_1").val()); }else{ var Sonline = 'null' }
		if($("#online_date_2").val())		{ var Eonline = encodeURIComponent($("#online_date_2").val()); }else{ var Eonline = 'null' }
		if($("#join_date_1").val())			{ var Sjoin = encodeURIComponent($("#join_date_1").val()); }else{ var Sjoin = 'null' }
		if($("#join_date_2").val())			{ var Ejoin = encodeURIComponent($("#join_date_2").val()); }else{ var Ejoin = 'null' }
		if($("#search_type").val())			{ var type = encodeURIComponent($("#search_type").val()); }else{ var type = 'null' }

		location.href='/admin/chatting/super_chat/super_send/point/'+point+'/area/'+area+'/Sage/'+Sage+'/Eage/'+Eage+'/Sonline/'+Sonline+'/Eonline/'+Eonline+'/Sjoin/'+Sjoin+'/Ejoin/'+Ejoin+'/type/'+type;

	});



}); // document END


// 채팅설정 찜,채팅 폼검사
function send_mb(gubn){

	var mode = $("input[name='taget_send']:checked").val();
	
	// url에 채팅받을 회원조건 검색기록이없으면
	if ($(location).attr('pathname').indexOf('point') == '-1') {
		alert("채팅신청 받을 회원을 먼저 검색해주세요.");
		return false;
	}

	if ($("#search_id").val() == ''){
		alert("보낼 아이디를 선택해주세요.");
		return false;
	}

	
	// 채팅신청이면 채팅내용검사
	if(mode == 'chat'){
		if ($("#sin_msg_1").val() == ''){
			alert("채팅내용을 입력해주세요.");
			return false;
		}
	}else if(mode == 'message'){
		if ($("#sin_msg_2").val() == ''){
			alert("메세지내용을 입력해주세요.");
			return false;
		}
	}else if(mode == 'map'){
		if ($("#sin_msg_3").val() == ''){
			alert("채팅내용(지도표시)을 입력해주세요.");
			return false;
		}
	}

	var fin_mb_cnt = Number($("#send_mb_cnt").val());
	var search_mb_cnt = Number($("#all_mb_cnt").text());

	if(fin_mb_cnt == ''){
		alert("보낼 회원수를 입력해주세요.");
		return false;
	}

	if(search_mb_cnt < fin_mb_cnt){
		alert("검색값보다 설정값이 더 큽니다.");
		return false;
	}

	var v_msg = "";

	if(mode == "chat"){
		v_msg = "채팅을";
	}else if(mode == "jjim"){
		v_msg = "찜을";
	}else if(mode == "profile"){
		v_msg = "프로필이미지 쪽지보내기를";
	}else if(mode == "message"){
		v_msg = "메세지를";
	}else if(mode == "map"){
		v_msg = "채팅(지됴표시)을";
	}

	if(gubn == "book"){

		//예약발송의 경우
		if($("#v_year").val() == ""){ alert("년도를 선택하세요."); $("#v_year").focus(); return; }
		if($("#v_month").val() == ""){ alert("월을 선택하세요."); $("#v_month").focus(); return; }
		if($("#v_day").val() == ""){ alert("일을 선택하세요."); $("#v_day").focus(); return; }
		if($("#v_time").val() == ""){ alert("시간을 선택하세요."); $("#v_time").focus(); return; }

		if($("#search_point").val())		{ var point = encodeURIComponent($("#search_point").val()); }else{ var point = '' }
		if($("#search_area").val())			{ var area = encodeURIComponent($("#search_area").val()); }else{ var area = '' }
		if($("#search_age_start").val())	{ var Sage = encodeURIComponent($("#search_age_start").val()); }else{ var Sage = '' }
		if($("#search_age_end").val())		{ var Eage = encodeURIComponent($("#search_age_end").val()); }else{ var Eage = '' }
		if($("#online_date_1").val())		{ var Sonline = encodeURIComponent($("#online_date_1").val()); }else{ var Sonline = 'null' }
		if($("#online_date_2").val())		{ var Eonline = encodeURIComponent($("#online_date_2").val()); }else{ var Eonline = 'null' }
		if($("#join_date_1").val())			{ var Sjoin = encodeURIComponent($("#join_date_1").val()); }else{ var Sjoin = 'null' }
		if($("#join_date_2").val())			{ var Ejoin = encodeURIComponent($("#join_date_2").val()); }else{ var Ejoin = 'null' }
		if($("#search_type").val())			{ var type = encodeURIComponent($("#search_type").val()); }else{ var type = 'null' }
		if($("#search_id").val())			{ var send_id = encodeURIComponent($("#search_id").val()); }
		if($("#add_nick").text())			{ var send_nick = encodeURIComponent($("#add_nick").text()); }
		if($("#add_age").text())			{ var send_age = encodeURIComponent($("#add_age").text()); }
		
		if(mode == "chat"){
			if($("#sin_msg_1").val())				{ var content = encodeURIComponent($("#sin_msg_1").val()); }
		}else if(mode == "message"){
			if($("#sin_msg_2").val())				{ var content = encodeURIComponent($("#sin_msg_2").val()); }
		}else if(mode == "map"){
			if($("#sin_msg_3").val())				{ var content = encodeURIComponent($("#sin_msg_3").val()); }
		}else{
			var content = "";
		}
		

		// 찜보내기는 메모 필요없어서 공란
		if(mode == 'jjim'){
			var content = '';
		}	
		
		if(confirm("예약 발송을 등록하시겠습니까?") == true){

			$.ajax({
				type : "post",
				url : "/admin/chatting/super_chat/super_send_request",
				data : {
					"super_cnt"		: encodeURIComponent(fin_mb_cnt),
					"point"			: encodeURIComponent(point),
					"area"			: encodeURIComponent(area),
					"Sage"			: encodeURIComponent(Sage),
					"Eage"			: encodeURIComponent(Eage),
					"Sonline"		: encodeURIComponent(Sonline),
					"Eonline"		: encodeURIComponent(Eonline),
					"Sjoin"			: encodeURIComponent(Sjoin),
					"Ejoin"			: encodeURIComponent(Ejoin),
					"type"			: encodeURIComponent(type),
					"send_id"		: encodeURIComponent(send_id),
					"send_nick"		: encodeURIComponent(send_nick),
					"send_age"		: encodeURIComponent(send_age),
					"content"		: encodeURIComponent(content),
					"mode"			: encodeURIComponent(mode),
					"gubn"			: encodeURIComponent(gubn),
					"v_year"		: encodeURIComponent($("#v_year").val()),
					"v_month"		: encodeURIComponent($("#v_month").val()),
					"v_day"			: encodeURIComponent($("#v_day").val()),
					"v_time"		: encodeURIComponent($("#v_time").val()),
					"v_minute"		: encodeURIComponent($("#v_minute").val())
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("예약되었습니다.");
						location.reload();
					}else if(result == "1000"){
						alert("예약시간이 현재시간보다 작습니다.");
						return;
					}else if(result == "0"){
						alert("실패 ("+ result +")");
						return;
					}else{
						alert("잘못된 접근입니다. ("+result+")");
						return;
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
					console.log(result);
				}
			});

		}
		
	}else if(gubn == "send"){
		//즉시발송의 경우
		if(confirm('총 '+fin_mb_cnt+'명에게 '+v_msg+' 보내시겠습니까?') == true){

			$("#super_send").css("display","inline-block");
			$("#super_info").text("총 "+fin_mb_cnt+"명에게 채팅초대 전송 중 입니다.<br>2000명 발송시 5~6분 걸립니다. 닫지마세요.");

			setTimeout(function(){
				send_chat(fin_mb_cnt,
					
					//callback
					function() {
						$("#super_info").text("총 "+fin_mb_cnt+" 명에게 전송 완료하였습니다.");
						setTimeout(function(){
							$("#super_send").css("display","none");
						},1500);
				},mode, gubn);
			},100);
		}
	}else{
		//잘못된 접근
		alert("잘못된 접근입니다.");
		return;
	}

	
}

// 채팅,찜 보내기 설정+보내기 부분
function send_chat(fin_mb_cnt,callback,mode, gubn){

	var total_roop = 1;
	var start = 0;
	var limit = 500;

	// 총 회원수가 500보다 크면
	if(fin_mb_cnt > 500){
		total_roop = Math.ceil(fin_mb_cnt/500);
	}

	if($("#search_point").val())		{ var point = encodeURIComponent($("#search_point").val()); }else{ var point = '' }
	if($("#search_area").val())			{ var area = encodeURIComponent($("#search_area").val()); }else{ var area = '' }
	if($("#search_age_start").val())	{ var Sage = encodeURIComponent($("#search_age_start").val()); }else{ var Sage = '' }
	if($("#search_age_end").val())		{ var Eage = encodeURIComponent($("#search_age_end").val()); }else{ var Eage = '' }
	if($("#online_date_1").val())		{ var Sonline = encodeURIComponent($("#online_date_1").val()); }else{ var Sonline = 'null' }
	if($("#online_date_2").val())		{ var Eonline = encodeURIComponent($("#online_date_2").val()); }else{ var Eonline = 'null' }
	if($("#join_date_1").val())			{ var Sjoin = encodeURIComponent($("#join_date_1").val()); }else{ var Sjoin = 'null' }
	if($("#join_date_2").val())			{ var Ejoin = encodeURIComponent($("#join_date_2").val()); }else{ var Ejoin = 'null' }
	if($("#search_type").val())			{ var type = encodeURIComponent($("#search_type").val()); }else{ var type = 'null' }
	if($("#search_id").val())			{ var send_id = encodeURIComponent($("#search_id").val()); }
	if($("#add_nick").text())			{ var send_nick = encodeURIComponent($("#add_nick").text()); }
	if($("#add_age").text())			{ var send_age = encodeURIComponent($("#add_age").text()); }
	
	if(mode == "chat"){
		if($("#sin_msg_1").val())				{ var content = encodeURIComponent($("#sin_msg_1").val()); }
	}else if(mode == "message"){
		if($("#sin_msg_2").val())				{ var content = encodeURIComponent($("#sin_msg_2").val()); }
	}else if(mode == "map"){
		if($("#sin_msg_3").val())				{ var content = encodeURIComponent($("#sin_msg_3").val()); }
	}else{
		var content = "";
	}


	// 찜보내기는 메모 필요없어서 공란
	if(mode == 'jjim' || mode == 'profile'){
		var content = '';
	}

	// 총갯수에서 /500 한만큼 반복
	//for(i=0;i<total_roop;i++){


		$.ajax({
			type : "post",
			url : "/admin/chatting/super_chat/super_send_request",
			data : {
				"start"			: encodeURIComponent(start),
				"limit"			: encodeURIComponent(limit),
				"super_cnt"		: encodeURIComponent(fin_mb_cnt),
				"point"			: encodeURIComponent(point),
				"area"			: encodeURIComponent(area),
				"Sage"			: encodeURIComponent(Sage),
				"Eage"			: encodeURIComponent(Eage),
				"Sonline"		: encodeURIComponent(Sonline),
				"Eonline"		: encodeURIComponent(Eonline),
				"Sjoin"			: encodeURIComponent(Sjoin),
				"Ejoin"			: encodeURIComponent(Ejoin),
				"type"			: encodeURIComponent(type),
				"send_id"		: encodeURIComponent(send_id),
				"send_nick"		: encodeURIComponent(send_nick),
				"send_age"		: encodeURIComponent(send_age),
				"content"		: encodeURIComponent(content),
				"mode"			: encodeURIComponent(mode),
				"gubn"			: encodeURIComponent(gubn)
			},
			cache : false,
			async : false,
			success : function(result){
				
				//alert(result);

				//console.log(result);
				//return false;
				
				// search가 아예 없거나, 오류일때
				if(result == '9'){
					alert("실패하였습니다. (" + result + ")");
					console.log(result);
				}else{
					callback();
				}

			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
				console.log(result);
			}
		});
		//start = start + 500;

		if(start > fin_mb_cnt){
			$("#super_info").text("총 "+fin_mb_cnt+"명에게 채팅초대 전송을 완료했습니다.");
		}
	//}	// for end

}

// radio show taget
function search_what(taget){
	if(taget == 'chat'){
		$("#taget_chat").show();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if(taget == "jjim"){
		$("#taget_chat").hide();
		$("#taget_jjim").show();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if(taget == "profile"){
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").show();
		$("#taget_message").hide();
		$("#taget_map").hide();
	}else if(taget == 'map'){
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").hide();
		$("#taget_map").show();
	}else{
		$("#taget_chat").hide();
		$("#taget_jjim").hide();
		$("#taget_profile").hide();
		$("#taget_message").show();
		$("#taget_map").hide();
	}
}


//예약 취소 실행 함수
function call_book_cancel(idx){

	if(confirm("발송예약을 취소하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/chatting/super_chat/call_book_cancel",
			data : {
				"idx"		: encodeURIComponent(idx)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("취소되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("발송 취소 실패 ("+ result +")");
					return;
				}else{
					alert("잘못된접근입니다. ("+ result +")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}


function add_text(id){
	$(id).val( $(id).val() + '[지역]');
}

</script>


<style>
	.s_tbl{width:100%;border-top:1px solid #e5e5e5;}
	.s_tbl th{border-bottom: solid 1px #E5E5E5; border-right: solid 1px #E5E5E5;background-color:#F1F2F7;}
	.s_tbl td{border-bottom: solid 1px #E5E5E5; border-right: solid 1px #E5E5E5; text-align:center;}
	.s_tbl td input{border: solid 1px #E5E5E5;}
	.s_tbl td select{border:1px solid #e5e5e5;}

	.s_tbl tr:last-child td, .s_tbl tr:last-child th { border:none;}
	
	.bd_l{border-left:solid 1px #E5E5E5;}
	.bd_b{border-bottom:solid 1px #E5E5E5;}

	#chat_content { height:240px; }

	.table th, td{text-align:center;}

	/* 예약발송 css 추가 */
	.booking_div{position:relative; width:100%; height:50px; margin-top:10px;}
	.booking_div select{width:120px;}
	.booking_div select:nth-child(2){margin-left:10px;}
	.booking_div select:nth-child(3){margin-left:10px;}
	.booking_div select:nth-child(4){margin-left:10px;}
	.booking_div input{width:100px; margin-left:30px;}
	/* 예약발송 css 추가 */

</style>




