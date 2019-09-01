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

			var act = '/admin/admin_setting/special_id';
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

function special_modi(num, id, cate){
	

	if (cate == 'del'){
		con_text = "을 해제";
	}else{
		con_text = "으로 등록";
	}

	if(confirm("특별회원"+con_text+"하시겠습니까?")){
		$.ajax({
			type: "POST",
			url: "/admin/admin_setting/special_modi",
			data: {
				"m_idx"		: encodeURIComponent(num),
				"m_userid"	: encodeURIComponent(id),
				"cate"		: encodeURIComponent(cate)
			},	cache: false,async: false,
			success: function(result) {
				if ( result == 1 )
				{
					alert("정상적으로 수정되었습니다");
					location.reload();
				}
				else
				{
					alert("실패하였습니다. (" + result + ")");
				}

			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});

	}

}


//스페셜 아이디 선택지역 저장 함수
function sel_conregion_click(){
	
	var sel_conregion = "";

	for(i=1; i<17; i++){
		if($("input[name='chk_"+i+"']").is(":checked")){

			if(sel_conregion == ""){
				sel_conregion = $("input[name='chk_"+i+"']").val();
			}else{
				sel_conregion += "/"+$("input[name='chk_"+i+"']").val();
			}
		}
	}

	if(sel_conregion == "" || $("#user_id").val() == ""){
		alert("지역을 선택하세요.");
		return;
	}else{

		$.ajax({

			type : "post",
			url : "/admin/admin_setting/sel_conregion_up",
			data : {
				"user_id"			: encodeURIComponent($("#user_id").val()),
				"sel_conregion"		: encodeURIComponent(sel_conregion),
			},
			async : false,
			cache : false,
			success : function(result){
				
				if(result == "1"){
					alert("선택지역이 변경되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("선택지역이 변경에 실패했습니다. ("+ result +")");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result+")");
					location.reload();
				}else{
					alert("실패 ("+ result +")");
					return;
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
		<h1>특별회원 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
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
							$sfl_arr = array('m_userid'=>'아이디',  'm_name'=>'이름', 'm_nick'=>'닉네임', 'ex_data_1'=>'지역');

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


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->


		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>특별회원 리스트</strong> <!-- panel title -->
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
				
				<table class="table table-bordered table-vertical-middle nomargin">
					<thead>
						<tr>
							<th class="width-100"><nobr>회원사진</nobr></th>
							<th class="width-50"><nobr>성별</nobr></th>
							<th class="width-100"><nobr>아이디</nobr></th>
							<th class="width-110"><nobr>닉네임</nobr></th>
							<th class="width-100"><nobr>이름</nobr></th>
							<th class="width-100"><nobr>나이</nobr></th>
							<th class="width-100"><nobr>지역</nobr></th>
							<th class="width-100"><nobr>선택지역</nobr></th>
							<th class="width-90"><nobr>특별회원수정</nobr></th>
							<th class="width-90"><nobr>특별회원해제</nobr></th>
						</tr>
					</thead>
					<tbody>
					<? 
						if (!empty($m_special)){

							foreach($m_special as $key => $val)
							{
					?>

						<tr>
							<td class="text-center"><nobr><?=$this->member_lib->member_thumb($val['m_userid'],68,49)?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_sex']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_userid']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_name']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_age']?> 세</nobr></td>
							<td class="text-center"><nobr>
								<?=$val['m_conregion']?> / <?=$val['m_conregion2']?>
								<? if(!empty($val['m_xpoint']) and !empty($val['m_ypoint'])){ ?>
								<br>x : <?=$val['m_xpoint']?>, y : <?=$val['m_ypoint']?>
								<? } ?>
							</nobr></td>
							<td class="text-center"><nobr>
								<? if(empty($val['m_select_conregion'])){ ?>
								<a class="btn btn-danger lightbox" href="/admin/admin_setting/conregion_layer/user_id/<?=$val['m_userid']?>/<?=mt_rand(0, 999999)?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
									선택안함
								</a>
								<? }else{ ?>
								<a class="lightbox" href="/admin/admin_setting/conregion_layer/user_id/<?=$val['m_userid']?>/<?=mt_rand(0, 999999)?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
									<?=$val['m_select_conregion']?>
								</a>
								<? } ?>
							</nobr></td>
							<td class="text-center"><nobr><a href="javascript:location.href='/admin/main/member_view/userid/<?=$val['m_userid']?>'" class="btn btn-default btn-xs"><i class="fa fa-cog white"></i> Modified </a></nobr></td>
							<td class="text-center"><nobr><a href="javascript:special_modi('<?=$val['m_num']?>', '<?=$val['m_userid']?>','del');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>
						</tr>

					<?}
					
					}else{?>
						<tr>
							<td colspan="15"class="text-center">설정한 회원이 없습니다.</td>
						</tr>
					<? } ?>
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