<script type="text/javascript">

	$(document).ready(function(){
		
		//글등록 버튼 클릭 이벤트
		$("#btn_write").click(function(){
			location.href = "/admin/service_center/event/event_write";
		});
	
	});

	//enter키 처리(검색)
	function on_keyup_enter(){
		var keycode = window.event.keyCode;

		if(keycode == 13){
			event_search();
		}
	}

	//검색 이벤트
	function event_search(){
		var f = document.frmSearch;

		f.target = "";
		f.action = "/admin/service_center/event/event_list";
		f.submit();
	}

	//이벤트 view
	function event_url_load(m_idx){

		location.href = "/admin/service_center/event/event_write/m_idx/"+m_idx;

	}

	//이벤트 삭제
	function del_mb_event(m_idx){

		if(confirm("삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/service_center/event/del_mb_event",
				data : {
					"m_idx"		: encodeURIComponent(m_idx)
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("성공");
						location.reload();
					}else{
						alert("삭제실패 ("+result+")");
					}
				},
				error : function(result){
					alert("실패 ("+result+")");
				}

			});

		}
	}


</script>



<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>이벤트 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

			<div id="panel-1" class="panel panel-default">			
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>이벤트 검색</strong> <!-- panel title -->
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
						<div class="form-group">
							<select id="v_search" name="v_search" class="form-control">
								<option value="m_title" <? if($v == "m_title"){ echo "selected"; } ?>>제목</option>
								<option value="m_idx" <? if($v == "m_idx"){ echo "selected"; } ?>>번호</option>
							</select>
							<div class="input-group">
								<input type="text" name="q" value="<?=@$q?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
							</div>
						</div>
						<button type="button" class="btn btn-success" id="btn_search" name="btn_search" onclick="javascript:event_search();"><i class="fa fa-search"></i> <b>검색</b></button>
						<button type="button" class="btn btn-danger" id="btn_write" name="btn_write"><i class="fa fa-pencil"></i> <b>글등록</b></button>
						</form>
					</fieldset>
				</div>
			</div>

			<div id="panel-2" class="panel panel-default">
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>이벤트리스트</strong> <!-- panel title -->
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
						<table class="table table-bordered table-vertical-middle nomargin">
							<thead>
							<tr>
								<th class="width-100"><nobr>번호</nobr></th>
								<th><nobr>제목</nobr></th>
								<th class="width-100"><nobr>게시여부</nobr></th>
								<th class="width-100"><nobr>등록일</nobr></th>
								<th class="width-100"><nobr>시작일</nobr></th>
								<th class="width-100"><nobr>종료일</nobr></th>
								<th class="width-100"><nobr>삭제</nobr></th>
							</tr>
							</thead>
							<tbody>
								<?php
									if( @$getTotalData > 0 ){
										foreach(@$mlist as $data){
								?>
								<tr>
									<td class="text-center"><nobr><?=$data['m_idx']?></nobr></td>	
									<td><nobr><a href="javascript:event_url_load('<?=$data['m_idx']?>');"><?=$data['m_title']?></a></nobr></td>	
									<td class="text-center"><nobr><?=$data['m_use_yn']?></nobr></td>	
									<td class="text-center"><nobr><?=$data['m_write_day']?></nobr></td>	
									<td class="text-center"><nobr><?=$data['m_start_day']?></nobr></td>	
									<td class="text-center"><nobr><?=$data['m_last_day']?></nobr></td>	
									<td class="text-center"><nobr><a href="javascript:del_event('<?=$data['m_idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>	
								</tr>
								<?
									}
								}else{
								?>
								<tr>
									<td colspan="7" style="text-align:center"><b>등록된 글이 없습니다.</b></td>
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
		</div>

	</div>





</section>