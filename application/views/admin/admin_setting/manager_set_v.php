<script>


	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/admin_setting/manager_set';
				if($("#q").val() && sfl_val){
					act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
				}
				$("#fsearch").attr('action', act).submit();
			}
		});
	});

	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}

	//관리자 등록
	function manager_add(){
		
		if($("#auth_code").val() == ""){ alert("권한을 선택하세요."); return;}
		if($("#userid").val() == ""){ alert("아이디를 입력하세요."); $("#userid").focus(); return;}
		if($("#username").val() == ""){ alert("이름을 입력하세요."); $("#username").focus(); return;}
		if($("#nickname").val() == ""){ alert("닉네임을 입력하세요."); $("#nickname").focus(); return;}
		if($("#pawd").val() == ""){ alert("비밀번호를 입력하세요."); $("#pawd").focus(); return;}

		// 수정이면
		if($("#modi").length > 0 ){
			var is_modi = encodeURIComponent($("#modi").val());
			var alert_type = "수정";

		// 신규등록이면
		}else{
			var is_modi = "";
			var alert_type = "등록";
		}
		
		$.ajax({

			type : "post",
			url : "/admin/admin_setting/manager_add",
			data : {
				
				"auth_code"		: encodeURIComponent($("#auth_code").val()),
				"userid"		: encodeURIComponent($("#userid").val()),
				"username"		: encodeURIComponent($("#username").val()),
				"nickname"		: encodeURIComponent($("#nickname").val()),
				"pawd"			: encodeURIComponent($("#pawd").val()),
				"is_modi"		: is_modi

			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert(alert_type+"되었습니다.");
					location.href = '/admin/admin_setting/manager_set';
				}else if(result == '6'){
					alert("이미 존재하는 아이디입니다.");
					return false;
				}else{
					alert("관리자"+alert_type+" 실패");
					console.log("error : " + result);
				}
								
			},
			error : function(result){
				alert("실패");
				console.log("error : " + result);
			}

		});

	}

	//관리자 삭제
	function manager_del(del_user){
		
		$.ajax({

			type : "post",
			url : "/admin/admin_setting/manager_del",
			data : {
				"userid"		: del_user
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("삭제되었습니다.");
					location.href = '/admin/admin_setting/manager_set';
				}else{
					alert("관리자삭제 실패");
					console.log("error : " + result);
				}	
			},
			error : function(result){
				alert("실패");
				console.log("error : " + result);
			}

		});

	}


</script>
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>관리자 설정</h1>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">
					

		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>관리자 검색</strong> <!-- panel title -->
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
							$sfl_arr = array('userid'=>'아이디',  'username'=>'이름', 'nickname'=>'닉네임');

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
					<!-- 관리자 등록 버튼 -->
					<a class="btn btn-danger lightbox" href="/admin/admin_setting/manager_add_pop" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
						<b>관리자 등록</b>
					</a>
					<!-- 관리자 등록 버튼 -->

					</form>
				</fieldset>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>관리자 리스트</strong> <!-- panel title -->
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
							<th><nobr>권한</nobr></th>
							<th><nobr>아이디</nobr></th>
							<th><nobr>이름</nobr></th>
							<th><nobr>닉네임</nobr></th>
							<th><nobr>등록일</nobr></th>
							<th><nobr>수정일</nobr></th>
							<th><nobr>마지막 로그인</nobr></th>
							<th class="width-100"><nobr>수정</nobr></th>
							<th class="width-100"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['auth_code']?></nobr></td>
								<td class="text-center"><nobr><?=$data['userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['username']?></nobr></td>
								<td class="text-center"><nobr><?=$data['nickname']?></nobr></td>
								<td class="text-center"><nobr><?=$data['created']?></nobr></td>
								<td class="text-center"><nobr><?=$data['modified']?></nobr></td>
								<td class="text-center"><nobr><?=$data['last_login']?></nobr></td>
								<td class="text-center"><nobr><a class="btn lightbox btn-default btn-xs" href="/admin/admin_setting/manager_add_pop/userid/<?=$data['userid']?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'><i class="fa fa-cog white"></i> 수정 </a></nobr></td>
								<td class="text-center"><nobr><a class="btn btn-default btn-xs" onclick="manager_del('<?=$data['userid']?>')"><i class="fa fa-times white"></i> 삭제 </a></nobr></td>
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
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div>
						<div class="col-md-12 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>



				</div>

			</section>
			<!-- /MIDDLE -->
