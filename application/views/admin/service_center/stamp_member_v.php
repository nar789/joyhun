
<script type="text/javascript">

	$(document).ready(function(){
	
		
	});
	
	
	//당첨자 보기
	function stamp_member_view(idx){
		
		//당첨자발표가 이루어졌는지 여부 체크
		$.ajax({

			type : "post",
			url : "/admin/service_center/stamp_event/win_member_chk",
			data : {
				"idx"	: encodeURIComponent(idx)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					$(location).attr("href", "/admin/service_center/stamp_event/stamp_member_win/idx/"+encodeURIComponent(idx));
				}else if(result == "0"){
					alert("아직 당첨자 발표가 이루어지지 않았습니다.");
					return;
				}else{
					alert("오류 ("+ result +")");
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}


	//당첨자 추첨
	function call_win_member_fnc(){
		
		if($("#win_member_cnt").val() == ""){ alert("추첨 인원을 입력하세요."); $("#win_member_cnt").focus(); return; }

		$.ajax({

			type : "post",
			url : "/admin/service_center/stamp_event/call_win_member_ajax",
			data : {
				"idx"		: encodeURIComponent($("#idx").val()),
				"cnt"		: encodeURIComponent($("#win_member_cnt").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("추첨이 완료되었습니다.");
					$(location).attr("href", "/admin/service_center/stamp_event/stamp_member_win/idx/"+encodeURIComponent($("#idx").val()));
				}else if(result == "0"){
					alert("추첨 실패 ("+ resutl +")");
					location.reload();
				}else if(result == "2"){
					alert("이미 추첨된 이벤트 입니다.");
					location.reload();
				}else{
					alert("잘못된 접근 실패 ("+ result +")");
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}


</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>출석체크 당첨자 관리</h1>
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
			
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>출석체크 당첨자 리스트</strong> <!-- panel title -->
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
							<th class="width-100">순번</th>
							<th class="width-100">년</th>
							<th class="width-100">월</th>
							<th>제목</th>
							<th class="width-200">시작날짜</th>
							<th class="width-200">종료날짜</th>
							<th class="width-200">당첨자발표</th>
						</tr>
						</thead>
						<tbody>
						
						<?
							if(@$getTotalData > 0){
								foreach($list as $data){
						?>
						<tr>
							<td class="text-center"><?=$data['m_idx']?></td>
							<td class="text-center"><?=$data['m_year']?></td>
							<td class="text-center"><?=$data['m_month']?></td>
							<td><a href="javascript:stamp_member_view('<?=$data['m_idx']?>');"><?=$data['m_year']?>년 <?=$data['m_month']?>월 출석체크 당첨자</a></td>
							<td class="text-center"><?=$data['m_start_day']?></td>
							<td class="text-center"><?=$data['m_end_day']?></td>
							<td class="text-center">
								<? if(!empty($data['m_win_member'])){ echo "완료"; }else{ ?>
								<? if($data['m_month'] != date('m')){ ?>
								<a class="btn btn-success lightbox" href="/admin/service_center/stamp_event/call_win_member/idx/<?=$data['m_idx']?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}' style="width:150px; height:20px; font-size:0.9em; font-weight:bold; line-height:7px;">
								<b>당첨자 추첨</b>
								</a>
								<? } ?>
								<? } ?>
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



