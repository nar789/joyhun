<script type="text/javascript">
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		if($("#q").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/service_center/mail/mail_list';
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
		<h1>메일 카운트 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>메일 검색</strong> <!-- panel title -->
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
					<div class="form-group col-md-10 col-sm-12 form-inline">
		
						<select name="sfl" id="sfl" class="form-control">
						<?php
						$sfl_arr = array('mail_id'=>'메일 아이디',  'mail_adr'=>'메일주소');

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
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
						</div>
						<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
					</div>
					
					<div class="form-group  col-md-2 col-sm-2 text-right">
						<button type="button" class="btn btn-success" id="write_btn" onclick="location.href='/admin/service_center/notice/notice_view'"><i class="fa fa-pencil"></i> 글쓰기</button>
					</div>
				</form>
				</fieldset>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>공지사항 리스트</strong> <!-- panel title -->
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
							<th class="width-50"><nobr>No</nobr></th>
							<th class="width-50"><nobr>Count</nobr></th>
							<th class="width-100"><nobr>메일 아이디</nobr></th>
							<th class="width-100"><nobr>메일주소</nobr></th>
							<th><nobr>제목</nobr></th>
							<th class="width-100"><nobr>보낸날짜</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['em_idx']?></nobr></td>
								<td class="text-center"><nobr><?=$data['em_cnt']?></nobr></td>
								<td class="text-center"><nobr><?=$data['mail_id']?></nobr></td>
								<td class="text-center"><nobr><?=$data['mail_adr']?></nobr></td>
								<td class="text-center"><nobr><?=$data['mail_title']?></nobr></td>
								<td class="text-center"><nobr><?=$data['em_time']?></nobr></td>
							</tr>
							
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="7" style="text-align:center">검색결과가 없습니다.</td>
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
			<!-- panel content end-->

		</div>
	</div>

</section>