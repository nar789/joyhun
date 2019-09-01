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

			var act = '/admin/chatting/test/cs_question_second';
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

// 등록버튼 클릭
function cs_add(){

	if($("#consult_sel").val()==''){
		alert("부서를 입력해주세요.");
		return false;
	}else if ($("#m_admin_name").val() == ''){
		alert("이름을 입력해주세요.");
		return false;
	}else if ($("#cs_content").val() == ''){
		alert("내용을 입력해주세요.");
		return false;
	}else if($("#consult_add").val()==''){
		alert("성별을 입력해주세요.");
		return false;
	}else if($("#consult_results").val()==''){
		alert("장애 여부를 선택해 주세요.");
		return false;
	}else{
		 $.ajax({

			type : "post",
			url : "/admin/chatting/test/cs_add",
			data : {
				"m_consult_sel"		: encodeURIComponent($("#consult_sel").val()),
				"m_consult_id"		: encodeURIComponent($("#userid").val()),
				"m_consult_name"	: encodeURIComponent($("#username").val()),
				"m_consult_hp"		: encodeURIComponent($("#userphone").val()),
				"m_consult_comment"	: encodeURIComponent($("#cs_content").val()),
				"m_consult_add"		: encodeURIComponent($("#consult_add").val()),
				"m_consult_results"	: encodeURIComponent($("#consult_results").val()),
				"m_jinsang_point"	: encodeURIComponent($("#jinsang_point").val())
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("정상적으로 등록되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다."+result);
				}				
			},
			error : function(result){
				alert("실패"+result);
			}
		});
	}
}

// 보기버튼 클릭
function cs_view_click(num){

	$("#tr_"+num).css("display","table-cell");
	$("#view_"+num).css("display","none");
}

// 수정버튼 클릭
function cs_modi_click(num){
	
	$("#tr_"+num).css("display","table-cell");
	$("#modi_"+num).css("display","none");
	$("#view_"+num).css("display","none");
}

// 수정버튼 클릭
function cs_modi(num){

	if ($("#content_"+num).val() == ''){
		alert("CS내용을 입력해주세요.");
		return false;
	}else{
		 $.ajax({

			type : "post",
			url : "/admin/chatting/test/cs_modi",
			data : {
				"m_consult_sel"		: encodeURIComponent($("#consult_sel_"+num).val()),
				"m_consult_id"		: encodeURIComponent($("#id_"+num).val()),
				"m_consult_name"	: encodeURIComponent($("#name_"+num).val()),
				"m_consult_hp"		: encodeURIComponent($("#ph_"+num).val()),
				"m_consult_comment"	: encodeURIComponent($("#content_"+num).val()),
				"m_consult_add"		: encodeURIComponent($("#consult_add_"+num).val()),
				"m_consult_results"	: encodeURIComponent($("#consult_results_"+num).val()),
				"m_jinsang_point"	: encodeURIComponent($("#jinsang_point_"+num).val()),
				"m_idx"			: encodeURIComponent(num)
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("정상적으로 수정되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다."+result);
				}				
			},
			error : function(result){
				alert("실패"+result);
			}
		});
	}

}

// 삭제버튼 클릭
function cs_del(num){

	if(confirm("정말 삭제하시겠습니까?") == true){
		$.ajax({

			type : "post",
			url : "/admin/service_center/cs/cs_del",
			data : {
				"m_idx"			: encodeURIComponent(num)
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("정상적으로 삭제되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다."+result);
				}				
			},
			error : function(result){
				alert("실패"+result);
			}
		});
	}

}
</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>테스트2</h1>
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
							$sfl_arr = array('m_admin_name'=>'이름', 'm_consult_id'=>'직급',  'm_consult_name'=>'생년월일', 'm_consult_hp'=>'전화번호');

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
					<strong>사원 등록</strong> <!-- panel title -->
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
				<div class="row ">
					<div class="col-md-1 col-sm-1">
						<label>이름</label>
						<input type="text" id="m_admin_name" name="m_admin_name" value="<?=$user?>" class="form-control required">
					</div>
					<div class="form-group">
						<div class="col-md-1 col-sm-1">
							<label>직급</label>
							<input type="text" id="userid" name="userid" value="" class="form-control required">
						</div>
						<div class="col-md-2 col-sm-2">
							<label>생년월일</label>
							<input type="text" id="username" name="username" value="1900-01-01" class="form-control required">
						</div>
						<div class="col-md-2 col-sm-2">
							<label>전화번호</label>
							<input type="text" id="userphone" name="userphone" value="" class="form-control required">
						</div>
					</div>
				</div>
				<div class="row margin-top-10">
					<div class="form-group">
						<div class="col-md-12 col-sm-12">
							<textarea name="cs_content" id="cs_content" rows="6" class="form-control required"></textarea>
						</div>
					</div>
				</div>
				<div class="row margin-top-10">
					<div class="col-md-1 col-sm-1">
						<label>성별</label>
						<select class="form-control" id="consult_add">
							<option value="">선택하세요.</option>	
							<option value="1">남</option>
							<option value="2" selected>여</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-2">
						<label>장애여부</label>
						<select class="form-control" id="consult_results">
							<option value="">선택하세요.</option>	
							<option value="1">장애</option>
							<option value="2" selected>비장애</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-1">
						<label>근속년수</label>
						<select class="form-control" id="jinsang_point">
							<option value="0">0년차</option>	
							<option value="1">1년차</option>
							<option value="2">2년차</option>
							<option value="3">3년차</option>	
							<option value="4">4년차</option>
							<option value="5">5년차</option>	
							<option value="6">6년차</option>	
							<option value="7">7년차</option>
							<option value="8">8년차</option>
							<option value="9">9년차</option>	
							<option value="10">10년차이상</option>
						</select>
					</div>
					<div class="col-md-3 col-sm-3 padding-0">
						<button type="button" class="btn btn-success" style="margin-top:24px;" id="write_btn" onclick="javascript:cs_add();"><i class="fa fa-pencil"></i> 등록</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5 col-sm-5">
						<span style="display:inline-block;margin-top:10px;color:#ea3c3c"></span>
					</div>
				</div>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>사원 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>이름</nobr></th>
							<th class="width-150"><nobr>직급</nobr></th>
							<th class="width-150"><nobr>생년월일</nobr></th>
							<th class="width-150"><nobr>전화번호</nobr></th>
							<th class="width-150"><nobr>등록일</nobr></th>
							<th class="width-50"><nobr>성별</nobr></th>
							<th class="width-50"><nobr>장애여부</nobr></th>
							<th class="width-50"><nobr>근속년수</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['m_idx']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_admin_name']?></nobr></td>
								<td class="text-center"><nobr><a href="http://joyhunting.com/admin/main/member_view/userid/<?=$data['m_consult_id']?>" target="_blank"><?=$data['m_consult_id']?></a></nobr></td>
								<td class="text-center"><nobr><?=$data['m_consult_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_consult_hp']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_admin_date']?></nobr></td>

								<td class="text-center"><nobr><?=consult_add_test($data['m_consult_add'])?></nobr></td>
								<td class="text-center"><nobr><?=consult_results_test($data['m_consult_results'])?></nobr></td>

								<td class="text-center"><nobr><?=$data['m_jinsang_point']?></nobr></td>

								<td class="text-center"><nobr><a href="javascript:cs_view_click('<?=$data['m_idx']?>');" class="btn btn-default btn-s" id="view_<?=$data['m_idx']?>"><i class="fa fa-cog white"></i> 보기 </a><a href="javascript:cs_modi_click('<?=$data['m_idx']?>');" class="btn btn-default btn-s" id="modi_<?=$data['m_idx']?>"><i class="fa fa-pencil white"></i> 수정 </a><a href="javascript:cs_del('<?=$data['m_idx']?>');" class="btn btn-default btn-s"><i class="fa fa-times white"></i> 삭제 </a></nobr></td>
							</tr>
							<tr>
								<td id="tr_<?=$data['m_idx']?>" colspan="10" style="display:none;">
									<div class="panel-body">
									
										<div class="row">
											<div class="col-md-1 col-sm-1">
												<label>이름</label>
												<input type="text" id="admin_name_<?=$data['m_idx']?>" name="admin_name_<?=$data['m_idx']?>" value="<?=$data['m_admin_name']?>" class="form-control required">
											</div>
											<div class="col-md-1 col-sm-1">
												<label>직급</label>
												<input type="text" id="id_<?=$data['m_idx']?>" name="id_<?=$data['m_idx']?>" value="<?=$data['m_consult_id']?>" class="form-control required">
											</div>
											<div class="form-group">
												<div class="col-md-2 col-sm-2">
													<label>생년월일</label>
													<input type="text" id="name_<?=$data['m_idx']?>" name="name_<?=$data['m_idx']?>" value="<?=@$data['m_consult_name']?>" class="form-control required">
												</div>
												<div class="col-md-2 col-sm-2">
													<label>전화번호</label>
													<input type="text" id="ph_<?=$data['m_idx']?>" name="ph_<?=$data['m_idx']?>" value="<?=@$data['m_consult_hp']?>" class="form-control required">
												</div>
											</div>
										</div>
										<div class="row margin-top-10">
											<div class="form-group">
												<div class="col-md-12 col-sm-12">
													<textarea name="content_<?=$data['m_idx']?>"  id="content_<?=$data['m_idx']?>" rows="6" class="form-control required"><?=$data['m_consult_comment']?></textarea>
												</div>
											</div>
										</div>
										
										<div class="row margin-top-10">
											<div class="col-md-1 col-sm-1">
												<label>성별</label>
												<select class="form-control" id="consult_add_<?=$data['m_idx']?>">
													<option value="1" <? if($data['m_consult_add'] == '1'){ ?> selected <? }?>>남</option>
													<option value="2" <? if($data['m_consult_add'] == '2'){ ?> selected <? }?>>여</option>
												</select>
											</div>
											<div class="col-md-2 col-sm-2">
												<label>장애여부</label>
												<select class="form-control" id="consult_results_<?=$data['m_idx']?>">	
													<option value="1" <? if($data['m_consult_results'] == '1'){ ?> selected <? }?>>장애</option>
													<option value="2" <? if($data['m_consult_results'] == '2'){ ?> selected <? }?>>비장애</option>
												</select>
											</div>
											<div class="col-md-1 col-sm-1">
												<label>근속년수</label>
												<select class="form-control" id="jinsang_point_<?=$data['m_idx']?>">
													<option value="0" <? if($data['m_jinsang_point'] == '0'){ ?> selected <? }?>>0년차</option>	
													<option value="1" <? if($data['m_jinsang_point'] == '1'){ ?> selected <? }?>>1년차</option>
													<option value="2" <? if($data['m_jinsang_point'] == '2'){ ?> selected <? }?>>2년차</option>
													<option value="3" <? if($data['m_jinsang_point'] == '3'){ ?> selected <? }?>>3년차</option>	
													<option value="4" <? if($data['m_jinsang_point'] == '4'){ ?> selected <? }?>>4년차</option>
													<option value="5" <? if($data['m_jinsang_point'] == '5'){ ?> selected <? }?>>5년차</option>	
													<option value="6" <? if($data['m_jinsang_point'] == '6'){ ?> selected <? }?>>6년차</option>
													<option value="7" <? if($data['m_jinsang_point'] == '7'){ ?> selected <? }?>>7년차</option>
													<option value="8" <? if($data['m_jinsang_point'] == '8'){ ?> selected <? }?>>8년차</option>
													<option value="9" <? if($data['m_jinsang_point'] == '9'){ ?> selected <? }?>>9년차</option>
													<option value="10" <? if($data['m_jinsang_point'] == '10'){ ?> selected <? }?>>10년차이상</option>
												</select>
											</div>
											<div class="col-md-3 col-sm-3 padding-0">
												<button type="button" class="btn btn-success" style="margin-top:24px;" id="write_btn" onclick="javascript:cs_modi('<?=$data['m_idx']?>');"><i class="fa fa-pencil"></i> 수정</button>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?
									}
								}else{
							?>
							<tr>
								<td colspan="10" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?
								}
							?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		</div>

	</div>

</section>