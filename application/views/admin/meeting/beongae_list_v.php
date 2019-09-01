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



	//전체선택 체크박스 클릭
	$("#allCheck").click(function(){
		if($("#allCheck").prop("checked")) {
			$("input[type=checkbox]").prop("checked",true);
		} else {
			$("input[type=checkbox]").prop("checked",false);
		}
	});




});

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}


function b_delete_confirm(idx) {
	if (confirm ('삭제하시겠습니까?'))
	{
		b_delete(idx);
	}
}

function b_delete(idx){
	$.get('/admin/meeting/beongae/beongae_del/idx/'+idx, function(data){
		if (data)
		{
			alert("삭제되었습니다");
			window.location.reload(true);
		}else{
			alert("삭제가 실패했습니다.");
		}
	});
}

// 선택삭제
function b_choice_delete(){

	if($("#allCheck").prop("checked")) {
		var chk_cnt = $('input:checkbox:checked').length-1;
	}else{
		var chk_cnt = $('input:checkbox:checked').length;
	}

	if(chk_cnt == 0){
		alert("하나이상 체크해주세요.");
	}else{
		$("input[name='choice_chk']:checked").each(function() {
			var de_idx = $(this).val();
			$.get('/admin/meeting/beongae/beongae_del/idx/'+de_idx, function(data){});
		});
		alert("삭제되었습니다.");
		location.reload();
	}

}



</script>


			
			
			
			
			
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>번개팅 관리</h1>
					<ol class="breadcrumb">
						<li><a href="#">미팅신청</a></li>
						<li class="active">번개팅</li>
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
$sfl_arr = array('TotalMembers.m_userid'=>'아이디',  'TotalMembers.m_name'=>'이름', 'TotalMembers.m_nick'=>'닉네임');

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
								</div>


								<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
								</form>
							</fieldset>

						</div>
					</div>


					<div id="panel-2" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>번개팅리스트</strong> <!-- panel title -->
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
							<input type="checkbox" id="allCheck" class="pointer"> 전체선택
							<a href="javascript:b_choice_delete();" class="btn btn-default btn-xs" style="height:28px;line-height:24px;"><i class="fa fa-times white"></i> 선택삭제 </a>

							<div class="table-responsive margin-top-10">
								<table class="table table-bordered table-vertical-middle nomargin">
									<thead>
										<tr>
											<th class="width-20"><nobr></nobr></th>
											<th class="width-90"><nobr>회원사진</nobr></th>
											<th class="width-100"><nobr>아이디</nobr></th>
											<th class="width-100"><nobr>이름</nobr></th>
											<th class="width-110"><nobr>닉네임</nobr></th>
											<th class="width-50"><nobr>지역</nobr></th>
											<th class="width-90"><nobr>날짜</nobr></th>
											<th class="width-90"><nobr>시간</nobr></th>
											<th class="width-100"><nobr>관심사</nobr></th>
											<th>번개팅</th>
											<th class="width-90"><nobr>삭제</nobr></th>
										</tr>
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
											<td><input type="checkbox" name="choice_chk" value="<?=$data['idx']?>" class="pointer"></td>
											<td class="text-center">
											<div onclick="location.href='/admin/main/member_view/userid/<?=$data['b_userid']?>'" class="pointer"><?=$this->member_lib->member_thumb($data['b_userid'],68,49)?>
											</div></td>
											<td><?php echo $data['b_userid']?></td>
											<td><?php echo $data['m_name']?></td>
											<td><?php echo $data['b_nick']?></td>
											<td><?php echo $data['b_region']?></td>
											<td><?php echo str_replace("-",".",$data['b_day'])?></td>
											<td><?=want_time_text($data['b_time'])?></td>
											<td><?=interest_text($data['b_interest'])?></td>
											<td><?php echo $data['b_intro']?></td>
											<td><a href="Javascript:b_delete_confirm(<?=$data['idx']?>);" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></td>
										</tr>
										<?
											}
										}else{
										?>
										<tr>
											<td colspan="10" style="text-align:center">검색결과가 없습니다.</td>
										</tr>
										<?}?>

									</tbody>
								</table>
							<div class="padding-top-20">
								<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format($getTotalData)?> &nbsp;</span>명</div>
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


