<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/profile/propose/propose_list';
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

	//프로포즈 리스트 삭제
	function del_list(m_idx, m_userid){

		if(confirm("정말 삭제하시겠습니까?")){
			$.ajax({

				type : "post",
				url : "/admin/profile/propose/del_propose/m_idx/"+m_idx+"/m_userid/"+m_userid,
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
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


	// 프로포즈 체크박스 삭제
	function choice_delete(){

		if($("#allCheck").prop("checked")) {
			var chk_cnt = $('input:checkbox:checked').length-1;
		}else{
			var chk_cnt = $('input:checkbox:checked').length;
		}

		if(chk_cnt == 0){
			alert("하나이상 체크해주세요.");
		}else{

			var chked_val = "";

			$(":checkbox[name='choice_chk']:checked").each(function(pi,po){
				chked_val += ","+po.value;
			});

			if(chked_val!="")chked_val = chked_val.substring(1);

			var asdfarr = chked_val.split(',');
			var cnt_arr= asdfarr.length;

			for(i=0; i<cnt_arr; i++){
				var retu_arr = asdfarr[i].split('+');

				$.ajax({

					type : "post",
					url : "/admin/profile/propose/del_propose/m_idx/"+retu_arr[0]+"/m_userid/"+retu_arr[1],
					cache : false,
					async : false,
					success : function(result){},
					error : function(result){
						alert("실패하였습니다. (" + result + ")");
					}

				});
			}
			alert("삭제되었습니다.");
			location.reload();
		}
	}



</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>프로포즈 관리</h1>
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
							$sfl_arr = array('TotalMembers.m_userid'=>'보낸아이디',  'TotalMembers.m_name'=>'보낸이름', 'TotalMembers.m_nick'=>'보낸닉네임');

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
					<strong>보낸 프로포즈 리스트</strong> <!-- panel title -->
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
				<a href="javascript:choice_delete();" class="btn btn-default btn-xs" style="height:28px;line-height:24px;"><i class="fa fa-times white"></i> 선택삭제 </a>

				<div class="table-responsive margin-top-10">
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th><nobr></nobr></th>
							<th class="width-100"><nobr>보낸회원사진</nobr></th>
							<th class="width-100"><nobr>보낸사람</nobr></th>
							<th class="width-100"><nobr>보낸사람이름</nobr></th>
							<th class="width-100"><nobr>받은사람</nobr></th>
							<th class="width-100"><nobr>구분</nobr></th>
							<th><nobr>등록글</nobr></th>
							<th class="width-100"><nobr>입력날짜</nobr></th>
							<th class="width-90"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><input type="checkbox" name="choice_chk" value="<?=$data['m_idx']?>+<?=$data['m_userid']?>" class="pointer"></td>
								<td class="text-center"><nobr><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['p_userid']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_gubn']?></nobr></td>
								<td><?=$data['m_content']?></td>
								<td class="text-center"><nobr><?=$data['m_writedate']?></nobr></td>
								<td class="text-center"><nobr><a href="javascript:del_list('<?=$data['m_idx']?>', '<?=$data['m_userid']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>
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
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>