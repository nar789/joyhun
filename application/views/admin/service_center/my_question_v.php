<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == '' && $("#p".val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/service_center/my_question/my_question_list';
				if($("#q").val() && sfl_val){
					act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
				}
				$("#fsearch").attr('action', act).submit();
			}
		});

		$("#quest_cate_select").val("<?=@$sel1?>").attr("selected", "selected");
		$("#quest_cate_select2").val("<?=@$sel2?>").attr("selected", "selected");
		
	});

	function quest_select(sel1_val){ 
		$("#quest_cate_select2").val("").attr("selected", "selected");
		fsearch.submit();

	}

	function quest_select2(sel2_val){ 

		fsearch.submit();

	} 

	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}

</script>

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>나의문의내역 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>나의문의내역 검색</strong> <!-- panel title -->
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
						<select onchange="quest_select(this.value)" name="sel1" id="quest_cate_select" class="form-control">
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
						<select onchange="quest_select2(this.value)" name="sel2" id="quest_cate_select2" class="form-control">
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
							<div class="col-md-6">
								<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="아이디" onkeypress="board_search_enter(document.q);">
							</div>
							<div class="col-md-6">
								<input type="text" name="p" value="<?=@$search_word?>" id="p" class="form-control" size="15" maxlength="20" placeholder="핸드폰번호" onkeypress="board_search_enter(document.p);">
							</div>

						</div>
						<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
					</div>
					</form>

				</fieldset>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>나의문의내역 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>번호</nobr></th>
							<th class="width-100"><nobr>대구분</nobr></th>
							<th class="width-100"><nobr>소구분</nobr></th>
							<th class="width-150"><nobr>제목</nobr></th>
							<th class="width-100"><nobr>작성자(이름)</nobr></th>
							<th class="width-100"><nobr>날짜</nobr></th>
							<th class="width-10"><nobr>답변여부</nobr></th>
							<th class="width-100"><nobr>답변자</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?
								if( @$getTotalData > 0 ){
									foreach(@$my_quest_list as $data){
							?>
							<tr>
								<td class="text-center"><nobr><?=$data['f_num']?></nobr></td>
								<td class="text-center"><nobr><?=@$faq_menu[$data['f_cate1']]['faq_title']?></nobr></td>
								<td class="text-center"><nobr><?=@$faq_menu[$data['f_cate1']]['cate'][$data['f_cate2']]?></nobr></td>
								<td><nobr><a href="/admin/service_center/my_question/my_question_view/f_num/<?=$data['f_num']?>/page/<?=$page?>"><?=$data['f_title']?></a></nobr></td>
								<td class="text-center"><nobr>
								<a href="http://joyhunting.com/admin/main/member_view/userid/<?=$data['f_userid']?>" target="_blank">
									<? if($data['f_userid'] != 'mobile'){ echo $data['f_userid'];}else{ echo $data['f_name']; }?>
								</a>
								</nobr></td>
								<td class="text-center"><nobr><?=$data['f_writeday']?></nobr></td>
								<td class="text-center"><nobr><?=$data['f_answerYN']?></nobr></td>
								<td class="text-center"><nobr><?=$data['f_answerid']?></nobr></td>
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