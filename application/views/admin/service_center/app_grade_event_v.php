<script type="text/javascript">

	$(document).ready(function(){
		
	});

	//enter키 처리(검색)
	function on_keyup_enter(){
		var keycode = window.event.keyCode;

		if(keycode == 13){
			event_search();
		}
	}

	//검색 이벤트
	function event_search(){
		var f = document.frmSearch;

		f.target = "";
		f.action = "/admin/service_center/app_grade/event_list";
		f.submit();
	}
	

	//삭제처리
	function app_event_del(user_id){
		
		if(confirm("삭제하시겠습니까?") == true){
			
			$.ajax({
				type : "post",
				url : "/admin/service_center/app_grade/user_del",
				data : {
					"user_id" : user_id
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("삭제되었습니다.");
					}else if(result == "0"){
						alert("삭제 실패");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
					}else{
						alert("실패("+ result +")");
					}

					location.reload();
				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

	//수령여부 변경
	function user_receive_gubn(user_id, rc_yn){
		
		 if(confirm("수령 상태를 변경하시겠습니까?") == true){

			 $.ajax({
				type : "post",
				url : "/admin/service_center/app_grade/user_up",
				data : {
					"user_id"	: user_id,
					"rc_use_yn" : rc_yn
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("수정되었습니다.");
					}else if(result == "0"){
						alert("수정 실패");
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
					}else{
						alert("실패("+ result +")");
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
		<h1>앱 이벤트 별점 이벤트</h1>
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
						<form name="frmSearch" id="frmSearch" method="post" class="form-inline" >
						<div class="form-group">
							<select id="v_search" name="v_search" class="form-control">
								<option value="user_id" <? if(@$v == "user_id"){ echo "selected"; } ?>>아이디</option>
								<option value="user_name" <? if(@$v == "user_name"){ echo "selected"; } ?>>이름</option>
							</select>
							<div class="input-group">
								<input type="text" name="q" value="<?=@$q?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
							</div>
						</div>
						<button type="button" class="btn btn-success" id="btn_search" name="btn_search" onclick="javascript:event_search();"><i class="fa fa-search"></i> <b>검색</b></button>
						</form>
					</fieldset>
				</div>
			</div>

			<div id="panel-2" class="panel panel-default">
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>참여자 리스트</strong> <!-- panel title -->
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
								<th class="width-100"><nobr>아이디</nobr></th>
								<th class="width-100"><nobr>이름</nobr></th>
								<th class="width-300"><nobr>휴대전화번호</nobr></th>
								<th class="width-100"><nobr>파일보기</nobr></th>
								<th class="width-100"><nobr>상품수령상태</nobr></th>
								<th class="width-200"><nobr>등록날짜</nobr></th>
								<th class="width-100"><nobr>삭제</nobr></th>
							</tr>
							</thead>
							<tbody>
								<?php
									if( @$getTotalData > 0 ){
										foreach(@$mlist as $data){
								?>
								<tr>
									<td class="text-center"><nobr><?=$data['user_id']?></nobr></td>	
									<td class="text-center"><nobr><?=$data['user_name']?></nobr></td>	
									<td class="text-center"><nobr><?=$data['hp_1']."-".$data['hp_2']."-".$data['hp_3']?></nobr></td>	
									<td class="text-center"><nobr>
										<a class="lightbox" href="/admin/service_center/app_grade/user_upload_pic/user_id/<?=$data['user_id']?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
											<img src="<?=str_replace("resource", "upload", $data['file_path'])?>" style="width:70px; height:100px;">
										</a>
									</nobr></td>	
									<td class="text-center"><nobr>
										<select id="rc_user_yn" name="rc_user_yn" onchange="javascript:user_receive_gubn('<?=$data['user_id']?>', this.value);">
											<option value="N" <? if($data['rc_use_yn'] == "N"){ echo "selected"; } ?>>미수령</option>
											<option value="Y" <? if($data['rc_use_yn'] == "Y"){ echo "selected"; } ?>>수령</option>
										</select>
									</nobr></td>	
									<td class="text-center"><nobr><?=$data['write_date']?></nobr></td>
									<td class="text-center"><nobr><a href="javascript:app_event_del('<?=$data['user_id']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>	
								</tr>
								<?
									}
								}else{
								?>
								<tr>
									<td colspan="7" style="text-align:center"><b>등록된 글이 없습니다.</b></td>
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
			</div>
		</div>

	</div>





</section>