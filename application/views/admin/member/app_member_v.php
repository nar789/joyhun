<script>

$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		var sfl_val2 = $("select[name=sfl2]").val();
		if($("#q").val() == '' && $("#q2").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/main/app_member_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});

	$("#app_btn1").click(function(){
		location.href= "/admin/main/app_member_total";
	});

	$("#app_btn2").click(function(){
		location.href= "/admin/main/app_member_list";
	});

});


function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}
</script>
			
			<style>
				.table th, td{text-align:center;}
			</style>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>앱 설치회원 리스트</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">앱 설치회원 리스트</span></li>
						<li class="active">앱 설치회원 조회</li>
					</ol>
				</header>
				<!-- /page title -->


				<div class="panel-body">

					<div class="tabs nomargin">

						<!-- tabs -->
						<ul class="nav nav-tabs nav-justified">
							<li>
								<a aria-expanded="true" href="#" data-toggle="tab" id="app_btn1">
									<i class="fa fa-heart"></i> 앱설치 일일 통계
								</a>
							</li>
							<li  class="active">
								<a aria-expanded="false" href="#" data-toggle="tab" id="app_btn2">
									<i class="fa fa-cogs"></i> 앱설치 회원 목록
								</a>
							</li>
						</ul>

					</div>

				</div>


				<div id="content" class="padding-20">


					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>앱 설치회원 검색</strong> <!-- panel title -->
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
								<form name="fsearch" id="fsearch" method="post" class="form-inline" >
								<div class="form-group">

									<select name="sfl" id="sfl" class="form-control">
<?php
$sfl_arr = array('m_userid'=>'아이디','reg_id'=>'GCM 아이디','device_id'=>'단말기 번호');

while (list($key, $value) = each($sfl_arr))
{
	if ($method == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
<?php
}
?>
									</select>
									<div class="input-group">
										<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어 1" onkeypress="board_search_enter(document.q);">
									</div>
								</div>


								<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
								</form>
							</fieldset>

						</div>
					</div>

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>앱 설치회원 리스트</strong> <!-- panel title -->
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
											<th class="width-200">설치일</th>
											<th class="width-200">아이디</th>
											<th class="width-200">GCM 아이디</th>
											<th class="">단말기 번호</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if( $getTotalData > 0 )
										{

											foreach($mlist as $data)
											{
										?>
										<tr>
											<td><nobr><?=$data['reg_date']?></nobr></td>
											<td><nobr><?=$data['m_userid']?></nobr></td>
											<td><?=$data['reg_id']?></td>
											<td><nobr><?=$data['device_id']?></nobr></td>
										</tr>
										<?
											}
										}else{
										?>
										<tr>
											<td colspan="9" style="text-align:center">검색결과가 없습니다.</td>
										</tr>
										<?}?>
										<!--	## search for end -->
									</tbody>
								</table>
							</div>
							<div class="row padding-top-20">
								<div class="col-md-2 margin-left-20"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format($getTotalData)?> &nbsp;</span>명</div>
								<div class="col-md-8 text-center"><?= $pagination_links?></div>
								<div class="col-md-2"></div>
							</div>
						</div>
						<!-- /panel content -->

					</div>
					<!-- /PANEL -->

				</div>

			</section>
			<!-- /MIDDLE -->