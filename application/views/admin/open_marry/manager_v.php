<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/open_marry/manager/manager_list';
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


	// 매니저의 추천회원 추가
	function add_list(m_userid,m_num){

		if(confirm("추천리스트에 등록하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/open_marry/manager/manager_add",
				data : {
					m_userid : m_userid,
					m_num	 : m_num
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == '1'){
						alert("등록되었습니다.");
						window.location.reload();
					}else if (result == '4'){
						alert("추천회원은 3명까지 등록 가능합니다.");
					}else if (result == '8'){
						alert("해당 회원은 이미 추천회원 입니다.");
					}else{
						alert("실패하였습니다. (" + result + ")");
					}
				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}

			});

		}

	}


	// 매니저의 추천리스트 해제
	function del_list(m_userid,m_num){

		if(confirm("추천리스트에서 해제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/open_marry/manager/manager_del",
				data : {
					m_userid : m_userid,
					m_num	 : m_num
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == true){
						alert("해제되었습니다.");
						window.location.reload();
					}else{
						alert("실패하였습니다. (" + result + ")");
					}
				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}

			});

		}

	}



</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>결혼신청 관리</h1>
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
							$sfl_arr = array('TotalMembers.m_userid'=>'아이디',  'TotalMembers.m_name'=>'이름', 'TotalMembers.m_nick'=>'닉네임', 'T_CoupleMarry_OpenguhonMan.b_type'=>'구혼타입');

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
					<strong>매니저의 추천회원 리스트</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>

			<? //print_r($manager);?>

			<!-- panel content -->
			<div class="panel-body">
				<table class="table table-bordered table-vertical-middle nomargin">
					<thead>
						<tr>
							<th class="width-100"><nobr>회원사진</nobr></th>
							<th class="width-100"><nobr>아이디</nobr></th>
							<th class="width-100"><nobr>이름</nobr></th>
							<th class="width-110"><nobr>닉네임</nobr></th>
							<th class="width-110"><nobr>성별</nobr></th>
							<th class="width-110"><nobr>공개구혼타입</nobr></th>
							<th class="width-100"><nobr>지역(나이)</nobr></th>
							<th><nobr>등록글</nobr></th>
							<th class="width-100"><nobr>입력날짜</nobr></th>
							<th class="width-100"><nobr>추천날짜</nobr></th>
							<th class="width-90"><nobr>추천리스트해제</nobr></th>
						</tr>
					</thead>
					<tbody>
					<? foreach($manager as $key => $val){?>

						<tr>
							<td class="text-center"><nobr><?=$this->member_lib->member_thumb($val['m_userid'],68,49)?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_userid']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_name']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
							<td class="text-center"><nobr><?=$val['b_sex']?></nobr></td>
							<td class="text-center"><nobr><?=$val['b_type']?></nobr></td>
							<td class="text-center"><nobr><?=$val['m_conregion']?>(<?=$val['m_age']?>)</nobr></td>
							<td>
								<font style="font-size:0.9em;"><?=$val['b_content']?></font>
							</td>
							<td class="text-center"><nobr><?=$val['b_writedate']?></nobr></td>
							<td class="text-center"><nobr><?=$val['b_manager_date']?></nobr></td>
							<td class="text-center"><nobr><a href="javascript:del_list('<?=$val['m_userid']?>','<?=$val['b_num']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 추천리스트해제 </a></nobr></td>
						</tr>

					<? } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>공개구혼 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>회원사진</nobr></th>
							<th class="width-100"><nobr>아이디</nobr></th>
							<th class="width-100"><nobr>이름</nobr></th>
							<th class="width-110"><nobr>닉네임</nobr></th>
							<th class="width-110"><nobr>성별</nobr></th>
							<th class="width-110"><nobr>공개구혼타입</nobr></th>
							<th class="width-100"><nobr>지역(나이)</nobr></th>
							<th><nobr>등록글</nobr></th>
							<th class="width-100"><nobr>입력날짜</nobr></th>
							<th class="width-90"><nobr>추천리스트등록</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_nick']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_sex']?></nobr></td>
								<td class="text-center"><nobr><?=$data['b_type']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_conregion']?>(<?=$data['m_age']?>세)</nobr></td>
								<td>
									<font style="font-size:0.9em;"><?=$data['b_content']?></font>
								</td>
								<td class="text-center"><nobr><?=$data['b_writedate']?></nobr></td>
								<td class="text-center"><nobr><a href="javascript:add_list('<?=$data['m_userid']?>','<?=$data['b_num']?>');" class="btn btn-default btn-xs"><i class="fa fa-check white"></i> 추천리스트등록 </a></nobr></td>
							</tr>
							
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="8" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?}?>
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