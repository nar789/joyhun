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

div#select_box_age {
    position: relative;
    width: 100px;
    height: 30px;
    background: url('/images/etc/allow.png') 80px center no-repeat; /* 화살표 이미지 */
    border: 1px solid #E9DDDD;
	display:inline-block;
}
div#select_box_age label {
    position: absolute;
    font-size: 1.0em;
    color: #a97228;
    top: 5px;
    left: 12px;
    letter-spacing: 1px;
}
div#select_box_age select#sel {
    width: 100%;
    height: 40px;
    min-height: 40px;
    line-height: 40px;
    padding: 0 10px;
    opacity: 0;
    filter: alpha(opacity=0); /* IE 8 */
}

.it_40{border:solid 1px #D5D5D5; width:40%;}
.it_70{border:solid 1px #D5D5D5; width:70%;}
.it_85{border:solid 1px #D5D5D5; width:85%;}

#panel_tit span:nth-child(2){padding-left:100px;}
#panel_tit span:nth-child(3){padding-left:100px;}

input[type=radio]{vertical-align:-2px; cursor:pointer;}

.send_box{position:absolute; width:700px; height:130px; top:35px; left:550px;}
.send_btn_box{position:relative; width:100%; height:50px; margin-top:20px;}

.btn_style{width:200px; height:30px; font-weight:bold;}

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

		if($("select[name='area']").val()){
			var area = $("select[name='area']").children("option:selected").text();
			$("select[name='area']").siblings("label").text(area);
		}
		
		if($("select[name='age_1']").val()){
			var age_1 = $("select[name='age_1']").children("option:selected").text();
			$("select[name='age_1']").siblings("label").text(age_1);
		}

		if($("select[name='age_2']").val()){
			var age_2 = $("select[name='age_2']").children("option:selected").text();
			$("select[name='age_2']").siblings("label").text(age_2);
		}

		if($("select[name='type']").val()){
			var type = $("select[name='type']").children("option:selected").text();
			$("select[name='type']").siblings("label").text(type);
		}
		
		if($("select[name='year']").val()){
			var year = $("select[name='year']").children("option:selected").text();
			$("select[name='year']").siblings("label").text(year);
		}
		
		if($("select[name='month']").val()){
			var month = $("select[name='month']").children("option:selected").text();
			$("select[name='month']").siblings("label").text(month);
		}

		if($("select[name='day']").val()){
			var day = $("select[name='day']").children("option:selected").text();
			$("select[name='day']").siblings("label").text(day);
		}

		//input type들 엔터처리
		$('input').keyup(function(e) {
			if(e.keyCode == 13) btn_search();        
		});

	});

	//나이선택
	function change_age(age){
		
		if(age == ''){
			$("select[name='age_2'] option").remove();
			return false;
		}else{
			var age_start = Number(age);
			$("select[name='age_2'] option").remove();

			for (i=age_start+1; i<70; i++){
				$("select[name='age_2']").append("<option value='"+i+"'>"+i+"</option>");
			}

			if($("select[name='age_2']").val()){
				var age_2 = $("select[name='age_2']").children("option:selected").text();
				$("select[name='age_2']").siblings("label").text(age_2);
			}
		}

	}

	//검색버튼 클릭시 이벤트 함수
	function btn_search(){
		
		//파라미터
		var para = "";
		
		if($("input[id='sex']:checked").val()){ var sex = $("input[id='sex']:checked").val(); para += "/sex/"+encodeURIComponent(sex); }
		if($("#point").val()){ var point = $("#point").val(); para += "/point/"+encodeURIComponent(point); }
		if($("select[name='area']").val()){ var area = $("select[name='area']").val(); para += "/area/"+encodeURIComponent(area); }
		if($("select[name='age_1']").val()){ var age_1 = $("select[name='age_1']").val(); para += "/age_1/"+encodeURIComponent(age_1); }
		if($("select[name='age_2']").val()){ var age_2 = $("select[name='age_2']").val(); para += "/age_2/"+encodeURIComponent(age_2); }
		if($("select[name='type']").val()){ var type = $("select[name='type']").val(); para += "/type/"+encodeURIComponent(type); }
		if($("#join_date_1").val()){ var join_date_1 = $("#join_date_1").val(); para += "/join_date_1/"+encodeURIComponent(join_date_1); }
		if($("#join_date_2").val()){ var join_date_2 = $("#join_date_2").val(); para += "/join_date_2/"+encodeURIComponent(join_date_2); }
		if($("#reg_date_1").val()){ var reg_date_1 = $("#reg_date_1").val(); para += "/reg_date_1/"+encodeURIComponent(reg_date_1); }
		if($("#reg_date_2").val()){ var reg_date_2 = $("#reg_date_2").val(); para += "/reg_date_2/"+encodeURIComponent(reg_date_2); }
		
		if(para == ""){
			alert("하나이상의 검색조건을 입력하세요.");
			return;
		}else{
			$(location).attr("href", "/admin/chatting/chat_app_push/user_list"+para);
		}

	}

	//발송함수 이벤트
	function notice_send(gubn){

		var msg_gubn;

		if(gubn == "send"){
			msg_gubn = "즉시발송";
		}else if(gubn == "book"){
			msg_gubn = "예약발송";
		}else{
			alert("잘못된 접근입니다.");
			return;
		}
		
		if($("#search_value").val() == ""){ alert("먼저 받는 회원을 검색해 주세요."); return; }
		if($("#title").val() == ""){ alert("공지사항 제목을 입력하세요."); $("#title").focus(); return; }
		if($("#notice_text").val() == ""){ alert("공지사항 내용을 입력하세요."); $("#notice_text").focus(); return; }
		if($("#total_cnt").val == "0"){ alert("검색된 회원이 없습니다.\n다시 검색해주세요."); return; }

		if(confirm("공지사항을 "+ msg_gubn +" 하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/chatting/chat_app_push/call_notice_send",
				data : {
					"gubn"			: encodeURIComponent(gubn),
					"query"			: encodeURIComponent($("#query").val()),
					"title"			: encodeURIComponent($("#title").val()),
					"notice_text"	: encodeURIComponent($("#notice_text").val()),
					"year"			: encodeURIComponent($("select[name='year']").val()),
					"month"			: encodeURIComponent($("select[name='month']").val()),
					"day"			: encodeURIComponent($("select[name='day']").val()),
					"time"			: encodeURIComponent($("select[name='time']").val()),
					"minute"		: encodeURIComponent($("select[name='minute']").val())
				},
				cache : false,
				asycn : false,
				success : function(result){

					if(result == "1"){
						alert(msg_gubn+"을 완료했습니다.");
					}else if(result == "0"){
						alert(msg_gubn+"에 실패했습니다.");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
					}else{
						alert("실패 ("+ result +")");
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}
		
	}

	//예약발송 취소버튼 클릭시 이벤트
	function app_push_cancel(idx){
		
		if(confirm("예약발송을 취소하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/chatting/chat_app_push/call_book_send_cancel_ajax",
				data : {
					"idx" : idx
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == "1"){
						alert("예약발송이 취소되었습니다.");
					}else if(result == "0"){
						alert("예약발송 취소에 실패했습니다.");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
					}else{
						alert("실패 ("+ result +")");
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

<section id="middle">
	<!-- page title -->
	<header id="page-header">
		<h1>앱회원 푸쉬보내기</h1>
		<ol class="breadcrumb">
			<li><span class="text-info">채팅관리</span></li>
			<li class="active">앱회원 푸쉬</li>
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
			<div class="panel-body">
				
				<div style="position:relative; width:100%;">
					<table cellspacing=0 cellpadding=0 class="tbl">
						<tr>
							<th>받는회원</th>
							<td>
								전체 <input type="radio" id="sex" name="sex" value="A" <? if($sex == "A"){ echo "checked"; } ?> >&nbsp;&nbsp;
								남자 <input type="radio" id="sex" name="sex" value="M" <? if($sex == "M"){ echo "checked"; } ?> >&nbsp;&nbsp;
								여자 <input type="radio" id="sex" name="sex" value="F" <? if($sex == "F"){ echo "checked"; } ?> >
							</td>
							<th>포인트</th>
							<td>
								<input type="text" id="point" name="point" value="<?=$point?>" class="it_70"> P이상
							</td>
							<th>지역</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="area">
										<option value="">- 전체 -</option>
										<option value="1" <? if($area == "1"){ echo "selected"; } ?> >서울/경기/인천</option>
										<option value="2" <? if($area == "2"){ echo "selected"; } ?> >부산/울산/경남</option>
										<option value="3" <? if($area == "3"){ echo "selected"; } ?> >대구/경북</option>
										<option value="4" <? if($area == "4"){ echo "selected"; } ?> >광주/전남/전북</option>
										<option value="5" <? if($area == "5"){ echo "selected"; } ?> >대전/충남/충북</option>
										<option value="6" <? if($area == "6"){ echo "selected"; } ?> >강원</option>
										<option value="7" <? if($area == "7"){ echo "selected"; } ?> >제주</option>
										<option value="8" <? if($area == "8"){ echo "selected"; } ?> >해외</option>								
									</select>
								</div>
							</td>
							<th>나이</th>
							<td>
								<div id="select_box_age">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="age_1" onchange="javascript:change_age(this.value);">
										<option value="">- 전체 -</option>
										<? for($i=20; $i<70; $i++){ ?>
											<option value="<?=$i?>" <? if($age_1 == $i){ echo "selected"; } ?> ><?=$i?></option>
										<? } ?>						
									</select>
								</div>
								~
								<div id="select_box_age">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="age_2">
										<? if(!empty($age_2)){ ?>
											<option value="<?=$age_2?>" selected><?=$age_2?></option>
										<? } ?>
									</select>
								</div>
							</td>
							
						</tr>
						<tr>
							<th>접속날짜</th>
							<td>
								<input type="text" id="join_date_1" name="join_date_1" value="<?=$join_date_1?>" class="it_40 cal">
								~
								<input type="text" id="join_date_2" name="join_date_2" value="<?=$join_date_2?>" class="it_40 cal">
							</td>
							<th>가입날짜</th>
							<td>
								<input type="text" id="reg_date_1" name="reg_date_1" value="<?=$reg_date_1?>" class="it_40 cal">
								~
								<input type="text" id="reg_date_2" name="reg_date_2" value="<?=$reg_date_2?>" class="it_40 cal">
							</td>
							<th>정회원여부</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="type">
										<option value="">- 전체 -</option>
										<option value="V" <? if($type == "V"){ echo "selected"; } ?> >정회원</option>
										<option value="F" <? if($type == "F"){ echo "selected"; } ?> >준회원</option>
									</select>
								</div>
							</td>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<td colspan="8" class="text-center">
								<input type="button" id="btn_search" name="btn_search" value="검색" class="btn btn-success btn_style" onclick="javasscript:btn_search();">
							</td>
						</tr>
					</table>
				</div>

			</div>
		</div>
		
		
		<!-- /PANEL -->
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>받는회원 리스트  <? if(!empty($total_cnt)){ echo "( ".$total_cnt."명)"; } ?></strong> <!-- panel title -->
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
				<input type="hidden" id="search_value" name="search_value" value="<?=@$search_value?>">
				<input type="hidden" id="total_cnt" name="total_cnt" value="<?=@$total_cnt?>">
				<input type="hidden" id="query" name="query" value="<?=@$query?>">
				<table class="table nomargin">
					<tr>
						<td class="width-150">사진</td>
						<td class="width-250">아이디</td>
						<td class="width-250">닉네임</td>
						<td class="width-150">나이</td>
						<td class="width-200">지역</td>
						<td class="width-100">정회원여부</td>
						<td class="width-100">포인트</td>
						<td>고유아이디</td>
					</tr>
				</table>
				<div style="max-height:200px;overflow:auto;">
					<table class="table nomargin">
					<? 
						if(!empty($mlist)){	
							foreach($mlist as $data){ 
					?>
						<tr>
							<td class="width-150"><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></td>
							<td class="width-250"><?=$data['m_userid']?></td>
							<td class="width-250"><?=$data['m_nick']?></td>
							<td class="width-150"><?=$data['m_age']?></td>
							<td class="width-200"><?=$data['m_conregion']?> / <?=$data['m_conregion2']?></td>
							<td class="width-100"><?=$data['m_type']?></td>
							<td class="width-100"><?=$data['total_point']?></td>
							<td><?=$data['device_id']?></td>
						</tr>
					<? 
							}  
						}else{ 
					?>
						<tr>
							<td colspan="6" class="text-center">검색된 회원이 없습니다.</td>
						</tr>
					<? 
						} 
					?>
					</table>
				</div>
			</div>
		</div>
		<!-- /PANEL -->

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
				
				<div class="col-md-12 col-sm-12">

					<div class="margin-top-10">
						<label>제목</label><br>
						<input type="text" id="title" name="title" value="" class="form-control required" style="width:500px;">
					</div>

					<div class="margin-top-10">
						<label>내용</label><br>
						<textarea rows="6" class="form-control required" id="notice_text" name="notice_text" style="width:500px;"></textarea>
					</div>
					<div class="send_box">
						
						<div id="select_box_age">
							<label for="sel">- 전체 -</label>
							<select id="sel" name="year">
								<option value="">- 전체 -</option>
								<? for($i=2016; $i<=date("Y", strtotime("+2 year")); $i++){ ?>
									<option value="<?=$i?>" <? if($year == $i) { echo "selected"; } ?> > <? echo $i;?>년 </option>
								<? } ?>					
							</select>
						</div>

						<div id="select_box_age" style="margin-left:10px;">
							<label for="sel">- 전체 -</label>
							<select id="sel" name="month">
								<option value="">- 전체 -</option>
								<? for($i=1; $i<=12; $i++){ ?>
									<option value="<?=zero_num($i)?>" <? if($month ==  zero_num($i)){ echo "selected"; } ?> > <? echo zero_num($i);?>월 </option>
								<? } ?>			
							</select>
						</div>

						<div id="select_box_age" style="margin-left:10px;">
							<label for="sel">- 전체 -</label>
							<select id="sel" name="day">
								<option value="">- 전체 -</option>
								<? for($i=1; $i<=31; $i++){ ?>
									<option value="<?=zero_num($i)?>" <? if($day ==  zero_num($i)){ echo "selected"; } ?> > <? echo zero_num($i);?>일 </option>
								<? } ?>		
							</select>
						</div>

						<div id="select_box_age" style="margin-left:10px;">
							<label for="sel">- 전체 -</label>
							<select id="sel" name="time">
								<option value="">- 전체 -</option>
								<? for($i=1; $i<=23; $i++){ ?>
									<option value="<?=zero_num($i)?>"> <? echo zero_num($i);?>시 </option>
								<? } ?>	
							</select>
						</div>

						<div id="select_box_age" style="margin-left:10px;">
							<label for="sel">- 전체 -</label>
							<select id="sel" name="minute">
								<option value="">- 전체 -</option>
								<option value="00">0분</option>
								<option value="30">30분</option>
							</select>
						</div>
						
						<div class="send_btn_box">
							<input type="button" id="btn_send" name="btn_send" value="즉시발송" class="btn btn-danger btn_style" onclick="javascript:notice_send('send');">
							&nbsp&nbsp;
							<input type="button" id="btn_book" name="btn_book" value="예약발송" class="btn btn-info btn_style" onclick="javascript:notice_send('book');">
						</div>

					</div>

				</div>
			</div>
		</div>
		<!-- /PANEL -->

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
						<th class="width-100">발송구분</th>
						<th>제목</th>
						<th>내용</th>
						<th class="width-100">발송카운트</th>
						<th class="width-200">보낸날짜</th>
						<th class="width-200">예약날짜</th>
						<th class="width-100">취소</th>
					</tr>
					</thead>
					<tbody>
					<?
						if(!empty($log)){
							foreach($log as $data){
					?>
					<tr>
						<td class="text-center"><? if($data['V_GUBN'] == "send"){ echo "즉시발송"; }else if($data['V_GUBN'] == "book"){ echo "예약발송"; }else{ echo $data['V_GUBN']; } ?></td>
						<td class="text-center"><?=$data['V_TITLE']?></td>
						<td><?=$data['V_MSG']?></td>
						<td class="text-center"><?=$data['V_CNT']?></td>
						<td class="text-center"><?=$data['V_WRITE_DATE']?></td>
						<td class="text-center"><?=$data['V_BOOK_DATE']?></td>
						<td class="text-center">
							<? if(empty($data['V_WRITE_DATE'])){ ?>
							<input type="button" id="btn_cancel" name="btn_cancel" value="취소" class="btn btn-danger" onclick="javascript:app_push_cancel('<?=$data['V_IDX']?>');">
							<? }else if($data['V_WRITE_DATE'] <= $data['V_BOOK_DATE']){ echo "취소"; }else{ echo "발송완료"; } ?>
						</td>
					</tr>
					<?
							}
						}else{
					?>
					<tr>
						<td colspan="6" class="text-center bold">결과가 없습니다.</td>
					</tr>
					<?
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /PANEL -->


	</div>

</section>
