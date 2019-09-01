<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/service_center/faq/faq_list';
				if($("#q").val() && sfl_val){
					act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
				}
				$("#fsearch").attr('action', act).submit();
			}
		});

		$("#faq_cate_select").val("<?=@$sel1?>").attr("selected", "selected");
		$("#faq_cate_select2").val("<?=@$sel2?>").attr("selected", "selected");
		
	});

	function faq_select(sel1_val){ 
		$("#faq_cate_select2").val("").attr("selected", "selected");
		fsearch.submit();

	} 

	function faq_select2(sel2_val){ 

		fsearch.submit();

	} 

	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}


	//faq 리스트 삭제
	function del_list(idx){
		
		if(confirm("정말 삭제하시겠습니까?")){
			$.ajax({

				type : "post",
				url : "/admin/service_center/faq/del_faq/idx/"+idx,
				cache : false,
				async : false,
				success : function(result){
					if(result == true){
						alert("삭제되었습니다.");
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



	//자주묻는질문 등록
	function add_choice(idx){

		var num = $("#choice_"+idx).val();

		
		if(confirm("자주묻는 질문의 "+num+"번째로 등록하시겠습니까?")){

			$.ajax({

				type : "post",
				url : "/admin/service_center/faq/add_question/idx/"+idx+"/num/"+num,
				cache : false,
				async : false,
				success : function(result){
					if(result == '1'){
						alert("설정되었습니다.");
						window.location.reload();
					}else if (result == '4'){
						alert("이미 할당된 순서입니다.");
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
		<h1>FAQ 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>FAQ 검색</strong> <!-- panel title -->
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
						<select onchange="faq_select(this.value)" name="sel1" id="faq_cate_select" class="form-control">
						<?php
							$sfl_arr = array(''=> '==선택==', '개인정보'=>'개인정보', '로그인/접속'=>'로그인/접속', '서비스'=>'서비스', '결제'=>'결제');

							foreach($sfl_arr as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value?></option>
						<?
							}
						?>
						</select>
						<select onchange="faq_select2(this.value)" name="sel2" id="faq_cate_select2" class="form-control <?=$faq_sub_select_style?>">
							<option value="" >==선택==</option>
						<?php
							foreach($sfl_arr2 as $key => $value)
							{
						?>
							<option value="<?php echo $value?>" ><?php echo $value?></option>
						<?
							}
						?>
						</select>

						<div class="input-group">
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
						</div>
						<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
					</div>
					
					<div class="form-group  col-md-2 col-sm-2 text-right">
						<button type="button" class="btn btn-success" id="write_btn" onclick="location.href='/admin/service_center/faq/faq_modi'"><i class="fa fa-pencil"></i> 글쓰기</button>
					</div>
					</form>

				</fieldset>
			</div>
		</div>

		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading" style="height:70px;">
				<span class="title elipsis">
					<strong>FAQ 리스트</strong> <!-- panel title -->
					&nbsp;&nbsp;&nbsp;<button class="btn btn-success" id="search_btn" onclick="location.href='/admin/service_center/faq/faq_list/view_mode/top10';"><i class="fa fa-search"></i> 자주묻는질문 TOP10 보기</button>
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
							<th class="width-100"><nobr>ID</nobr></th>
							<th class="width-100"><nobr>작성자</nobr></th>
							<th class="width-100"><nobr>대구분</nobr></th>
							<th class="width-100"><nobr>소구분</nobr></th>
							<th class="width-100"><nobr>순서</nobr></th>
							<th><nobr>질문</nobr></th>
							<th class="width-100"><nobr>입력날짜</nobr></th>
							<th class="width-90"><nobr>삭제</nobr></th>
							<th class="width-90"><nobr>자주묻는질문</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['nick']?></nobr></td>
								<td class="text-center"><nobr><?=$data['gubn1']?></nobr></td>
								<td class="text-center"><nobr><?=$data['gubn2']?></nobr></td>
								<td class="text-center"><nobr><?=$data['order']?></nobr></td>
								<td class="text-left"><nobr><a href="/admin/service_center/faq/faq_modi/idx/<?=$data['idx']?>"><?=$data['title']?></a></nobr></td>
								<td class="text-center"><nobr><?=$data['f_date']?></nobr></td>
								<td class="text-center"><nobr><a href="javascript:del_list('<?=$data['idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>
								<td class="text-center"><nobr>
									<input type="text" id="choice_<?=$data['idx']?>" value="<?=@$data['choice']?>" class="width-50 form-control" style="display:inline-block">
									<button type="button" class="btn btn-default" onclick="add_choice('<?=$data['idx']?>')">번째</button></nobr>
								</td>
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