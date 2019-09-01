<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/profile/point/point_list';
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

	
	//포인트 지급 이벤트
	function point_provide(){
		
		if($("#m_userid").val() == ""){ alert("회원 아이디를 입력하세요."); $("#m_userid").focus(); return;}
		if($("#m_point").val() == ""){ alert("지급 포인트를 입력하세요."); $("#m_point").focus(); return;}
		if($("#m_etc").val() == ""){ alert("지급내용을 입력하세요."); $("#m_etc").focus(); return;}
		
		$.ajax({

			type : "post",
			url : "/admin/profile/point/point_provide",
			data : {
				
				"m_userid"		: encodeURIComponent($("#m_userid").val()),
				"m_point"		: encodeURIComponent($("#m_point").val()),
				"m_etc"			: encodeURIComponent($("#m_etc").val())

			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("포인트가 지급되었습니다.");
					location.href = '/admin/profile/point/point_list';
				}else{
					alert("포인트 지급 실패");
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
		<h1>포인트충전내역 관리</h1>
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
						<?
							}
						?>
						</select>
						<div class="input-group">
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
						</div>
					</div>
					<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
					<!-- 포인트 지급 버튼 -->
					<a class="btn btn-danger lightbox" href="/admin/profile/point/provide_pop" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
					<b>포인트지급</b>
					</a>
					<!-- 포인트 지급 버튼 -->

					</form>
				</fieldset>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>포인트 충전내역 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>회원아이디</nobr></th>
							<th class="width-100"><nobr>회원이름</nobr></th>
							<th class="width-100"><nobr>닉네임</nobr></th>
							<th class="width-200"><nobr>구매상품</nobr></th>
							<th class="width-100"><nobr>상품코드</nobr></th>
							<th class="width-100"><nobr>상품가격</nobr></th>
							<th class="width-100"><nobr>포인트</nobr></th>
							<th><nobr>내용</nobr></th>
							<th class="width-200"><nobr>구매날짜</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></nobr></td>
								<td class="text-center"><nobr>
									<a class="lightbox" href="/admin/profile/point/provide_pop/userid/<?=$data['m_userid']?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
										<?=$data['m_userid']?>
									</a>
								</nobr></td>
								<td class="text-center"><nobr><?=$data['m_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_nick']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_goods']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_product_code']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_price']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_point']?></nobr></td>
								<td><?=$data['m_etc']?></td>
								<td class="text-center"><nobr><?=$data['m_writedate']?></nobr></td>
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
						<!--div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div-->
						<div class="col-md-12 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>