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
	
	
</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>무통장입금 메세지 재발송 로그</h1>
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
							$sfl_arr = array('m_userid'=>'아이디');

							while (list($key, $value) = each($sfl_arr))
							{
								if ($method == $key) {
									$chk = ' selected';
							} else {
								$chk = '';

							

							}

						?>
							<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
							<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
							<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
						<?
							}
						?>
						</select>
						<div class="input-group">
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
						</div>
					</div>
					
					<button type="button" class="btn btn-success" onclick="javascript:member_search();"><i class="fa fa-search"></i> 검색</button>
					</form>
				</fieldset>
			</div>
		</div>

		<div id="refund" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>회원을 검색하세요.</strong>
				</span>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>무통장 입금 재발송 메세지 리스트</strong> <!-- panel title -->
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
							<th><nobr>회원아이디</nobr></th>
							<th><nobr>휴대전화번호</nobr></th>
							<th><nobr>메세지내용</nobr></th>
							<th class="width-200"><nobr>날짜</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if(@$getTotalData > 0){
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center"><?=$data['idx']?></td>
							<td class="text-center"><?=$data['user_id']?></td>
							<td class="text-center"><?=$data['hp_num']?></td>
							<td class="text-center"><?=$data['msg']?></td>
							<td class="text-center"><?=$data['write_date']?></td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="4" class="text-center bold">검색결과가 없습니다.</td>
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