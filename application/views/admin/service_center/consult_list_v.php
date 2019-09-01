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

			var act = '/admin/service_center/cs/cs_question';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});

});

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}

</script>

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>CS 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>CS 검색</strong> <!-- panel title -->
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
							$sfl_arr = array('m_consult_hp'=>'문의자 핸드폰', 'm_consult_name'=>'문의자 이름',  'm_consult_id'=>'문의자 아이디', 'm_admin_name'=>'작성자');

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
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
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
					<strong>상담 리스트</strong> <!-- panel title -->
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
							<th class="width-50"><nobr>번호</nobr></th>
							<th><nobr>문의 분야</nobr></th>
							<th class="width-150"><nobr>문의자 ID</nobr></th>
							<th class="width-150"><nobr>추가상담</nobr></th>
							<th class="width-150"><nobr>결과</nobr></th>
							<th class="width-200"><nobr>작성시간</nobr></th>
							<th class="width-150"><nobr>작성자</nobr></th>
							<th class="width-200"><nobr>수정/삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><?=$data['m_idx']?></td>
								<td class="text-center"><a href="/admin/service_center/cs/cs_question_view/idx/<?=$data['m_idx']?>"><?=consult_sel($data['m_consult_sel'])?></a></td>
								<td class="text-center"><a href="/admin/service_center/cs/cs_question_view/idx/<?=$data['m_idx']?>"><?=$data['m_consult_id']?></a></td>
								<td class="text-center"><?=consult_add($data['m_consult_add'])?></td>
								<td class="text-center"><?=consult_results($data['m_consult_results'])?></td>
								<td class="text-center"><?=$data['m_admin_date']?></td>
								<td class="text-center"><?=$data['m_admin_name']?></td>
								<td class="text-center"><a href="javascript:cs_modi_click('<?=$data['m_idx']?>')" class="btn btn-default btn-s" id="modi_<?=$data['m_idx']?>"><i class="fa fa-cog white"></i> 수정 </a><a href="javascript:cs_del('<?=$data['m_idx']?>');" class="btn btn-default btn-s"><i class="fa fa-times white"></i> 삭제 </a></td>
							</tr>
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="5" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?}?>
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

</section>