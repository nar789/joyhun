<style>
.tbl{width:100%;}
.tbl tr{height:40px;}
.tbl th{width:20%; border-left:solid 1px #D5D5D5; border-top:solid 1px #D5D5D5; background-color:#F1F2F7; white-space:nowrap;}
.tbl td{width:30%; border-left:solid 1px #D5D5D5; border-top:solid 1px #D5D5D5; padding-left:20px;}
.tbl td:nth-last-child(-n+3){border-right:solid 1px #D5D5D5; border-bottom:solid 1px #D5D5D5;}
.tbl input{width:150px; height:30px; border:solid 1px #D2D2D2;}

input[type=checkbox]{cursor:pointer;}

.user_div{position:relative; width:100%; height:100px;}
.user_div div:nth-child(1){border:solid 1px #F2F2F2; position:relative; width:40%; height:100%; overflow:hidden;}
.user_div div:nth-child(2){position:absolute; width:60%; height:100%; top:0%; left:40%; text-align:left; font-size:0.9em; overflow:hidden;}
.user_div div:nth-child(2) ul{margin:0; padding-left:10px; list-style:none;}
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
		
		//검색버튼 클릭 이벤트
		$("#btn_search").click(function(){
			
			var v_para = "";

			if($("#date_1").val()){ var v_date_1 = $("#date_1").val(); v_para += "/v_date_1/"+encodeURIComponent(v_date_1); }
			if($("#date_2").val()){ var v_date_2 = $("#date_2").val(); v_para += "/v_date_2/"+encodeURIComponent(v_date_2); }
			if($("#user_id").val()){ var v_user_id = $("#user_id").val(); v_para += "/v_user_id/"+encodeURIComponent(v_user_id); }

			if(v_para == ""){
				alert("하나이상의 검색조건을 입력하세요.");
				return;
			}else{
				$(location).attr("href", "/admin/service_center/woman_event/woman_event_list"+v_para);
			}

		});
		
		//input 엔터처리
		$('input').keyup(function(e) {
			if(e.keyCode == 13) $("#btn_search").click();        
		});

		//체크박스 전체 선택, 선택해제 처리
		$("#all_chk").click(function(){
			
			if($("#all_chk").prop("checked")){
				$("input[id='event_chk']").prop("checked", true);
			}else{
				$("input[id='event_chk']").prop("checked", false);
			}

		});

		//선택한 상품 삭제하기 이벤트 함수
		$("#btn_del_sel").click(function(){

			var chk_value = "";

			$("input[id='event_chk']:checked").each(function(){
				
				if(chk_value){
					chk_value = chk_value+"|"+$(this).val();
				}else{
					chk_value = $(this).val();
				}
			});

			if(chk_value){
				call_list_del(chk_value);
			}else{
				alert("삭제할 리스트를 선택하세요.");
				return;
			}

		});

	});

	//삭제함수
	function call_list_del(val){

		if(confirm("선택한 리스트를 삭제하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/service_center/woman_event/woman_event_list_del",
				data : {
					"chk_val" : encodeURIComponent(val)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("삭제되었습니다.");
						location.reload();
					}else if(result == "0"){
						alert("삭제에 실패했습니다.");
						location.reload();
					}else{
						alert("삭제 실패 ("+ result +")");
						return;
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

	//개인별 이벤트 통계표 보이기
	function call_member_event_stat(){
		
		var date_1 = $("#date_1").val();
		var date_2 = $("#date_2").val();
		var user_id = $("#user_id").val();

		if(date_1 == "" || date_2 == "" || user_id == ""){
			return;
		}else{
			
			$.ajax({

				type : "post",
				url : "/admin/service_center/woman_event/call_woman_event_member_stat",
				data : {
					"date_1"		: encodeURIComponent(date_1),
					"date_2"		: encodeURIComponent(date_2),
					"user_id"		: encodeURIComponent(user_id)
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1000"){
						$("#event_tmp").empty();
						alert("잘못된 접근입니다.");
						return;
					}else{
						$("#event_tmp").empty();
						$("#event_tmp").html(result);
					}					
				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}
	}

	$(document).ready(function(){
		$("#app_btn1").click(function(){
			location.href= "/admin/service_center/woman_event/woman_event_stat";
		});

		$("#app_btn2").click(function(){
			location.href= "/admin/service_center/woman_event/woman_event_list";
		});
	});


</script>

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>여성회원 이벤트 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->


	<div class="panel-body">

		<div class="tabs nomargin">

			<!-- tabs -->
			<ul class="nav nav-tabs nav-justified">
				<li>
					<a aria-expanded="true" href="#" data-toggle="tab" id="app_btn1">
						<i class="fa fa-heart"></i> 여성회원 이벤트 통계
					</a>
				</li>
				<li  class="active">
					<a aria-expanded="false" href="#" data-toggle="tab" id="app_btn2">
						<i class="fa fa-cogs"></i> 여성회원 이벤트 상세정보
					</a>
				</li>
			</ul>


		</div>

	</div>


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
				<fieldset>
					
					<div style="position:relative; width:100%;">
						<table cellspacing=0 cellpadding=0 class="tbl">
							<tr>
								<th>날짜</th>
								<td>
									<input type="text" id="date_1" name="v_date_1" value="<?=$v_date_1?>" class="cal text-center pointer">
									~
									<input type="text" id="date_2" name="v_date_2" value="<?=$v_date_2?>" class="cal text-center pointer">
								</td>
								<th>아이디</th>
								<td>
									<input type="text" id="user_id" name="user_id" value="<?=$v_user_id?>">
								</td>
							</tr>
							<tr>
								<td colspan="4" class="text-center"><input type="button" id="btn_search" name="btn_search" value="검색" class="btn btn-success"></td>
							</tr>
						</table>
					</div>

				</fieldset>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading" style="height:70px;">
				<span class="title elipsis">
					<strong>리스트</strong> <!-- panel title -->
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
				<div style="position:relative; width:100%; height:50px; margin-bottom:5px;">
					<input type="button" id="btn_del_sel" name="btn_del_sel" value="선택삭제" class="btn btn-danger">
				</div>

				<div id="event_tmp"></div>

				<div class="table-responsive">
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th class="width-100"><input type="checkbox" id="all_chk" name="all_chk" value=""></th>
							<th class="width-150">날짜</th>
							<th class="width-100">미션</th>
							<th class="width-300">보낸회원아이디</th>
							<th class="width-300">받은회원아이디</th>
							<th>받은상품</th>
							<th class="width-100">삭제</th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){
									$sdata = $this->member_lib->get_member($data['V_SEND_ID']);
									$rdata = $this->member_lib->get_member($data['V_RECV_ID']);
									if(empty($sdata)){ $sdata = $this->member_lib->get_member_out($data['V_SEND_ID']); $sout = "out"; }else{ $sout = ""; }		//보낸회원 정보가 없을 경우 탈퇴회원에서 가져오기
									if(empty($rdata)){ $rdata = $this->member_lib->get_member_out($data['V_RECV_ID']); $rout = "out"; }else{ $rout = ""; }		//받은회원 정보가 없을 경우 탈퇴회원에서 가져오기
						?>
						<tr>
							<td class="text-center"><input type="checkbox" id="event_chk" name="event_chk" value="<?=$data['V_IDX']?>"></td>
							<td class="text-center"><?=$data['V_WRITE_DATE']?></td>
							<td class="text-center">
								<?
									if($data['V_MODE'] == "request"){ echo "채팅신청"; }
									if($data['V_MODE'] == "msg"){ echo "메세지3회"; }
									if($data['V_MODE'] == "chat"){ echo "채팅3회"; }
									if($data['V_MODE'] == "gift"){ echo "선물지급"; }
								?>
							</td>
							<td class="text-center">
								<div class="user_div">
									<div>
										<? if(empty($sout)){ ?>
										<?=$this->member_lib->member_thumb($sdata['m_userid'], 100, 100)?>
										<? }else{ ?>
										탈퇴회원
										<? } ?>
									</div>
									<div>
										<? if(empty($sout)){ ?>
										<ul>
											<li><?=$sdata['m_userid']?> (<?=$sdata['m_age']?>세)</li>
											<li><?=$sdata['m_nick']?></li>
											<li><?=$sdata['m_name']?></li>
											<li><?=$sdata['m_mail']?></li>
											<li><?=$sdata['m_hp1']?> - <?=$sdata['m_hp2']?> - <?=$sdata['m_hp3']?></li>
										</ul>
										<? }else{ ?>
										<ul>
											<li><?=$sdata['m_userid']?></li>
											<li><?=$sdata['m_name']?></li>
											<li><?=$sdata['m_mail']?></li>
											<li><?=$sdata['m_hp']?></li>
										</ul>
										<? } ?>
									</div>
								</div>
							</td>
							<td class="text-center">
								<div class="user_div">
									<div>
										<? if(empty($rout)){ ?>
										<?=$this->member_lib->member_thumb($rdata['m_userid'], 100, 100)?>
										<? }else{ ?>
										탈퇴회원
										<? } ?>
									</div>
									<div>
										<? if(empty($rout)){ ?>
										<ul>
											<li><?=$rdata['m_userid']?> (<?=$rdata['m_age']?>세)</li>
											<li><?=$rdata['m_nick']?></li>
											<li><?=$rdata['m_name']?></li>
											<li><?=$rdata['m_mail']?></li>
											<li><?=$rdata['m_hp1']?> - <?=$rdata['m_hp2']?> - <?=$rdata['m_hp3']?></li>
										</ul>
										<? }else{ ?>
										<ul>
											<li><?=$rdata['m_userid']?></li>
											<li><?=$rdata['m_name']?></li>
											<li><?=$rdata['m_mail']?></li>
											<li><?=$rdata['m_hp']?></li>
										</ul>
										<? } ?>
									</div>
								</div>
							</td>
							<td style="padding-left:20px;"><?=$data['V_PRODUCT_NAME']?> <? if(!empty($data['V_PRODUCT_CODE'])){ echo "(".$data['V_PRODUCT_CODE'].")"; } ?></td>
							<td class="text-center">
								<a href="javascript:call_list_del('<?=$data['V_IDX']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="7" class="text-center bold">결과가 없습니다.</td>
						</tr>
						<?
							}
						?>

						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
			<!-- panel content end-->

		</div>
	</div>

</section>