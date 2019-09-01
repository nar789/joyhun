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

			var act = '/admin/service_center/complaint/complain_list';
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
			
			<style>
				.table th, td{text-align:center;}
			</style>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>신고내역 관리</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원관리</span></li>
						<li class="active">신고내역 관리</li>
					</ol>
				</header>
				<!-- /page title -->



				<div id="content" class="padding-20">


					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>회원 검색</strong> <!-- panel title -->
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
$sfl_arr = array('s_id'=>'신고자 아이디',  's_nick'=>'신고자 닉네임', 'r_id'=>'처벌대상 아이디', 'r_nick'=>'처벌대상 닉네임');

while (list($key, $value) = each($sfl_arr))
{
	if ($method == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?=$key?>" <?=$chk?>><?=$value?></option>
<?php

}
?>
									</select>
									<div class="input-group">
										<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
									</div>
								</div>

								<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
								<a class="btn btn-danger lightbox" href="/admin/service_center/punishment/punish_pop" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
									<b>처벌하기</b>
								</a>
								</form>
							</fieldset>

						</div>
					</div>

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>회원 리스트</strong> <!-- panel title -->
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
											<th class="width-80">번호</th>
											<th>신고대상사진</th>
											<th>신고대상</th>
											<th>신고자사진</th>
											<th>신고자</th>
											<th>신고사유</th>
											<th>신고일</th>
											<th>처벌상태</th>
											<th>처벌일</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										if( $getTotalData > 0 )
										{
											$count = 0;

											foreach($mlist as $data)
											{
												$number = $getTotalData - ($rp * ($page-1)) - $count;
												$count = $count + 1;
										?>
										<tr>
											<td><?=$number?></td>
											<td><?=@$this->member_lib->member_thumb($data['r_id'],68,49)?></td>
											<td><a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$data['r_id']?>"  target="_blank"><?=$data['r_id']?></a></td>
											<td><?=$this->member_lib->member_thumb($data['s_id'],68,49)?></td>
											<td><a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$data['s_id']?>"  target="_blank"><?=$data['s_id']?></a></td>
											<td><?=police_cate($data['c_cate'])?></td>
											<td><?=$data['c_date']?></td>
											<td><?=police_ing($data['c_success'])?></td>
											<td><?=$data['cp_date']?></td>
											<td><a href="/admin/service_center/complaint/complain_view/idx/<?=$data['c_idx']?>/page/<?=$page?>" class="btn btn-default btn-xs"><i class="fa fa-search white fa-lg"></i> 자세히보기 </a></td>
										</tr>
										<?
											}
										}else{
										?>
										<tr>
											<td colspan="13" style="text-align:center">검색결과가 없습니다.</td>
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
