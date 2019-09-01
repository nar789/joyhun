<script type="text/javascript">
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		if($("#q").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/etc/chat_words/words_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});
});



function del_chat_words(idx){

	if(confirm("채팅문구를 삭제하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/etc/chat_words/del_chat_words",
			data : {
				"idx"	: encodeURIComponent(idx)
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("채팅문구를 삭제했습니다.");
					location.reload();
				}else if(result == "0"){
					alert("삭제에 실패했습니다.");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다.");
				}else{
					alert("잘못된 접근입니다. ("+ result +")");
				}
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
		<h1>채팅신청 기본문구 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>채팅문구 검색</strong> <!-- panel title -->
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
						$sfl_arr = array('chat_words'=>'채팅문구');

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
						<button type="button" class="btn btn-success" id="write_btn" onclick="location.href='/admin/etc/chat_words/words_write'"><i class="fa fa-pencil"></i> 글쓰기</button>
					</div>
				</form>
				</fieldset>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>채팅문구 리스트 (채팅신청시 기분문구로 사용됨)</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>성별</nobr></th>
							<th><nobr>채팅문구</nobr></th>
							<th class="width-200"><nobr>등록일</nobr></th>
							<th class="width-200"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if(@$getTotalData > 0){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['idx']?></nobr></td>
								<td class="text-center"><nobr>
									<?
										switch($data['sex']){
											case "A" : $sex_gubn = "전체"; break;
											case "M" : $sex_gubn = "남성"; break;
											case "F" : $sex_gubn = "여성"; break;
										}

										echo $sex_gubn;
									?>
								</nobr></td>
								<td><nobr>
									<a href="/admin/etc/chat_words/words_write/idx/<?=$data['idx']?>/page/<?=$page?>"><?=$data['chat_words']?></a>
								</nobr></td>
								<td class="text-center"><nobr><?=$data['write_date']?></nobr></td>
								<td class="text-center"><nobr>
									<a href="javascript:del_chat_words('<?=$data['idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> 삭제하기 </a>
								</nobr></td>
							</tr>
							
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="5" class="text-center bold">검색결과가 없습니다.</td>
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