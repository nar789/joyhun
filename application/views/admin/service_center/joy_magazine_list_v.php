<script type="text/javascript">

	$(document).ready(function(){
		
		//글등록 버튼 클릭 이벤트
		$("#btn_write").click(function(){
			location.href = "/admin/service_center/joy_magazine/magazine_write";
		});
	
	});

	//enter키 처리(검색)
	function on_keyup_enter(){
		var keycode = window.event.keyCode;

		if(keycode == 13){
			event_search();
		}
	}

	//검색 매거진
	function magazine_search(){
		var f = document.frmSearch;

		f.target = "";
		f.action = "/admin/service_center/joy_magazine/magazine_list";
		f.submit();
	}

	//삭제 함수
	function magazine_del(idx){
		
		if(confirm("조이매거진을 삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/service_center/joy_magazine/magazine_del",
				data : {
					"idx" : idx
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("삭제되었습니다.");
					}else if(result == "0"){
						alert("삭제에 실패했습니다.");
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
		<h1>조이매거진 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

			<div id="panel-1" class="panel panel-default">			
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>뉴스 검색</strong> <!-- panel title -->
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
								<option value="title">제목</option>
								<option value="idx">번호</option>
							</select>
							<div class="input-group">
								<input type="text" name="q" value="<?=@$q?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
							</div>
						</div>
						<button type="button" class="btn btn-success" id="btn_search" name="btn_search" onclick="javascript:magazine_search();"><i class="fa fa-search"></i> <b>검색</b></button>
						<button type="button" class="btn btn-danger" id="btn_write" name="btn_write"><i class="fa fa-pencil"></i> <b>글등록</b></button>
						</form>
					</fieldset>
				</div>
			</div>

			<div id="panel-2" class="panel panel-default">
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>뉴스리스트</strong> <!-- panel title -->
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
								<th class="width-200"><nobr>구분</nobr></th>
								<th><nobr>제목</nobr></th>
								<th class="width-100"><nobr>게시여부</nobr></th>
								<th class="width-200"><nobr>등록일</nobr></th>
								<th class="width-100"><nobr>삭제</nobr></th>
							</tr>
							</thead>
							<tbody>
							<?
								if(@$getTotalData > 0){
									foreach($mlist as $data){
							?>
							<tr>
								<td class="text-center"><?=$data['idx']?></td>
								<td class="text-center"><?=$data['gubn']?></td>
								<td><a href="/admin/service_center/joy_magazine/magazine_write/idx/<?=$data['idx']?>"><?=$data['title']?></a></td>
								<td class="text-center"><?=$data['use_yn']?></td>
								<td class="text-center"><?=$data['write_date']?></td>
								<td class="text-center"><a href="javascript:magazine_del('<?=$data['idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></td>
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