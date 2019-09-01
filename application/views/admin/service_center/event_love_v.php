<script type="text/javascript">

	$(document).ready(function(){
			
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
		f.action = "/admin/service_center/event_love/event_list";
		f.submit();
	}

	//삭제
	function event_love_del(idx){
		
		if(idx == ""){ return; }
		
		if(confirm("삭제하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/service_center/event_love/event_love_del",
				data : {
					"idx" : idx
				},
				cache : false,
				asycn : false,
				success : function(result){
					
					if(result == "1"){
						alert("삭제되었습니다.");
						location.reload();
					}else{
						alert("삭제에 실패했습니다. ("+ result +")");
						return;
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
								<option value="m_userid" <? if($v_search == "m_userid"){ echo "selected"; } ?> >아이디</option>
								<option value="m_name" <? if($v_search == "m_name"){ echo "selected"; } ?> >이름</option>
							</select>
							<div class="input-group">
								<input type="text" name="q" value="<?=@$q?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
							</div>
						</div>
						<button type="button" class="btn btn-success" id="btn_search" name="btn_search" onclick="javascript:event_search();"><i class="fa fa-search"></i> <b>검색</b></button>
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
								<th class="width-100"><nobr>사진</nobr></th>
								<th class="width-100"><nobr>아이디</nobr></th>
								<th class="width-100"><nobr>이름</nobr></th>
								<th class="width-100"><nobr>성별</nobr></th>
								<th class="width-100"><nobr>나이</nobr></th>
								<th class="width-100"><nobr>지역</nobr></th>
								<th><nobr>자기소개</nobr></th>
								<th class="width-200"><nobr>접수날짜</nobr></th>
								<th class="width-100"><nobr>삭제</nobr></th>
							</tr>
							</thead>
							<tbody>
								<?php
									if( @$getTotalData > 0 ){
										foreach(@$mlist as $data){
								?>
								<tr>
									<td class="text-center"><?=$data['idx']?></td>
									<td class="text-center"><?=$this->member_lib->member_thumb($data['user_id'], 80, 80)?></td>
									<td class="text-center"><?=$data['user_id']?></td>
									<td class="text-center"><?=$data['m_name']?></td>
									<td class="text-center"><?=$data['m_sex']?></td>
									<td class="text-center"><?=$data['age']?></td>
									<td class="text-center"><?=$data['conregion']?><br><?=$data['conregion2']?></td>
									<td class="text-center"><?=$data['intro']?></td>
									<td class="text-center"><?=$data['write_date']?></td>
									<td><a href="Javascript:event_love_del('<?=$data['idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></td>
								</tr>
								<?
									}
								}else{
								?>
								<tr>
									<td colspan="9" style="text-align:center"><b>등록된 글이 없습니다.</b></td>
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