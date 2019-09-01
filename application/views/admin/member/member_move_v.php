<script>
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		if($("#q").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/meeting/beongae/beongae_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});

});

</script>
	
			
<section id="middle">


	<!-- page title -->
	<header id="page-header">
		<h1>회원 이동경로</h1>
		<ol class="breadcrumb">
			<li><a href="#">이동경로</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>이동경로 리스트</strong> <!-- panel title -->
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

				<div class="table-responsive margin-top-10">
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
							<tr>
								<th class="width-200"><nobr>이동시간</nobr></th>
								<th class="width-100"><nobr>아이디</nobr></th>
								<th class="width-100"><nobr>이름</nobr></th>
								<th class="width-100"><nobr>닉네임</nobr></th>
								<th class="width-100"><nobr>구분</nobr></th>
								<th><nobr>이동경로</nobr></th>								
								<th class="width-200"><nobr>페이지명</nobr></th>
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
								<td class="text-center"><nobr><?=$data['write_date']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_nick']?></nobr></td>
								<td class="text-center"><nobr><? if($data['view_gubn'] == "P"){ echo "피씨"; }else{ echo "모바일"; } ?></nobr></td>
								<td><nobr><?=$data['site_url']?></nobr></td>								
								<td><nobr></nobr></td>
							</tr>
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="6" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?}?>

						</tbody>
					</table>
				<div class="padding-top-20">
					<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format($getTotalData)?> &nbsp;</span>건</div>
					<div class="col-md-8 text-center"><?= $pagination_links?></div>
					<div class="col-md-2"></div>
				</div>


				</div>

			</div>
			<!-- /panel content -->


		</div>
		<!-- /PANEL -->
	</div>

</section>
<!-- /MIDDLE -->


