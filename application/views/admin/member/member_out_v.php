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

			var act = '/admin/main/member_out';
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

function mb_bye(user){

	if (confirm("탈퇴시키겠습니까??") == true){ 
	
		$.ajax({

			type : "post",
			url : "/admin/main/member_bye",
			data : {
				"userid"	: encodeURIComponent(user)
			},
			cache : false,
			async : false,
			success : function(result){

				if(result == '1'){
					alert("탈퇴처리를 완료했습니다.");
					location.reload();
				}else{
					alert("탈퇴처리에 실패했습니다.");
					location.reload();
				}
				
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
				console.log(result);
			}

		});

	}

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
					<h1>회원탈퇴관리</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원탈퇴관리</span></li>
						<li class="active">회원조회</li>
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
$sfl_arr = array('m_userid'=>'아이디',  'm_name'=>'이름', 'm_jumin1'=>'생년월일');

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

								<div class="form-group">
									<select name="sfl2" id="sfl2" class="form-control">
<?php
$sfl_arr = array('m_name'=>'이름', 'm_userid'=>'아이디');

while (list($key, $value) = each($sfl_arr))
{
	if ($method2 == $key) {
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
										<input type="text" name="q2" value="<?=@$s_word2?>" id="q2" class="form-control" size="15" maxlength="20" placeholder="검색어 2" onkeypress="board_search_enter(document.q2);">
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
											<th class="width-200">아이디</th>
											<th class="width-200">이름</th>
											<th class="width-300">닉네임</th>
											<th class="width-200">정회원 여부</th>
											<th>정회원 가입일</th>
											<th class="width-300">남은포인트</th>
											<th class="width-100">탈퇴</th>
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
											<td><a href="/admin/main/member_view/userid/<?=$data['m_userid']?>"><?=$data['m_userid']?></a></td>
											<td><?=$data['m_name']?></td>
											<td><?=$data['m_nick']?></td>
											<td><?=$data['m_lev']?></td>
											<td><?=$data['m_lev_date']?></td>
											<td><?=$data['m_point']?> P</td>
											<td class="text-center"><nobr><a href="javascript:mb_bye('<?=$data['m_userid']?>')" class="btn btn-default btn-s"><i class="fa fa-check white"></i> 탈퇴 </a></nobr></td>
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