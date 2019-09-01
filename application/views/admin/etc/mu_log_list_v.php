<script type="text/javascript">
	
	$(document).ready(function(){
		
		
	});

	//검색어 엔터처리
	function on_keyup_enter(){

		var keycode = window.event.keyCode;
		
		if(keycode == 13){
			member_search();
		}
	}
	
	function member_search(){
		
		$("#fsearch").submit();
	}


	//비고 저장
	function etc_save(idx){
		
		if(confirm("비고를 등록하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/etc/mu_recognition_log/log_etc_save",
				data : {
					"idx" : encodeURIComponent(idx),
					"etc" : encodeURIComponent($("#etc_"+idx).val())
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("저장되었습니다.");
					}else if(result == "0"){
						alert("저장에 실패했습니다.");
					}else if(result == "1000"){
						alert("잘못된접근입니다.");
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
		<h1>무통장입금 로그 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>회원 검색</strong> 
				</span>


				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>

			</div>
			<div class="panel-body">
				<fieldset>
					<form name="fsearch" id="fsearch" method="post" class="form-inline" >
					<div class="form-group">
						<select name="sfl" id="sfl" class="form-control">
						<?php
							$sfl_arr = array('m_name'=>'이름');

							while (list($key, $value) = each($sfl_arr))
							{
								if ($method == $key) {
									$chk = ' selected';
							} else {
								$chk = '';
							}
						?>
							<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
						<?
							}
						?>
						</select>
						<div class="input-group">
							<input type="text" name="q" value="<?=@$q?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
						</div>
					</div>
					
					<button type="button" class="btn btn-success" onclick="javascript:member_search();"><i class="fa fa-search"></i> 검색</button>
					</form>
				</fieldset>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>무통장 입금처리 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>순번</nobr></th>
							<th><nobr>발신</nobr></th>
							<th><nobr>결과</nobr></th>
							<th class="width-200"><nobr>날짜</nobr></th>
							<th class="width-300"><nobr>비고</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if(@$getTotalData > 0){
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center"><?=$data['idx']?></td>
							<td><?=$data['credit']?></td>
							<td><?=$data['result']?></td>
							<td class="text-center"><?=$data['write_date']?></td>
							<td>
								<input type="text" id="etc_<?=$data['idx']?>" name="etc_<?=$data['idx']?>" value="<?=$data['etc']?>" class="width-200" style="border:solid 1px #D2D2D2;">
								<a href="javascript:etc_save('<?=$data['idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-save white"></i> 저장 </a>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="5" class="text-center bold">검색결과가 없습니다.</td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		
		</div>


	</div>

</section>