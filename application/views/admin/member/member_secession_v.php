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

			var act = '/admin/main/member_secession';
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
					<h1>탈퇴회원조회</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">탈퇴회원관리</span></li>
						<li class="active">탈퇴회원조회</li>
					</ol>
				</header>
				<!-- /page title -->



				<div id="content" class="padding-20">


					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>탈퇴회원 검색</strong> <!-- panel title -->
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
$sfl_arr = array('m_userid'=>'아이디',  'm_name'=>'이름', 'm_jumin1'=>'생년월일', 'm_hp'=>'핸드폰번호', 'm_mail'=>'메일주소', 'm_partner'=>'파트너아이디', 'm_partner_code'=>'광고코드', 'm_ip'=>'아이피');

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
$sfl_arr = array('m_name'=>'이름', 'm_userid'=>'아이디',  'm_jumin1'=>'생년월일', 'm_hp'=>'핸드폰번호', 'm_mail'=>'메일주소', 'm_partner'=>'파트너아이디', 'm_partner_code'=>'광고코드', 'm_ip'=>'아이피');

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
								<strong>탈퇴회원 리스트</strong> <!-- panel title -->
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
											<th>아이디</th>
											<th>이름</th>
											<th>성별</th>
											<th>생년월일</th>
											<th>전화번호</th>
											<th>파트너ID</th>
											<th>메일주소</th>
											<th>가입일</th>
											<th>탈퇴일</th>
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
											<td><a href="/admin/main/member_view/userid/<?=$data['m_userid']?>/gubn/out"><?php echo $data['m_userid']?></a></td>
											<td><?php echo $data['m_name']?></td>
											<td><?php if(substr($data['m_jumin2'], 0, 1) == "1"){ echo "M";}else{ echo "F";}?></td>
											<td><?php echo $data['m_jumin1']?></td>
											<td><?php echo $data['m_hp1']."-".$data['m_hp2']."-".$data['m_hp3']?></td>
											<td><?php echo $data['m_partner']?></td>
											<td><?php echo $data['m_mail']?></td>
											<td><?php echo $data['m_in_date']?></td>
											<td><?php echo $data['m_member_out']?></td>
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