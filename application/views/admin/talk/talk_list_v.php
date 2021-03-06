<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/etc/talk/talk_list';
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

	// 토크 삭제
	function talk_list_del(t_idx, t_id){
		
		if(confirm("삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/etc/talk/talk_list_del",
				data : {

					"t_idx"		: t_idx,
					"t_id"		: t_id

				},
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



	// 토크 체크박스 삭제
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
					url : "/admin/etc/talk/talk_list_del",
					data : {

						"t_idx"		: retu_arr[0],
						"t_id"		: retu_arr[1]

					},
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


	// 댓글보기
	function show_reply(t_idx){

		if($("#show_reply"+t_idx).css("display") == "none"){
			$("#show_reply"+t_idx).css("display", "table-row");
		}else{
			$("#show_reply"+t_idx).css("display", "none");
		}
	}

	// 댓글삭제
	function reply_del(r_idx, r_id, t_idx){

		if(confirm("삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/etc/talk/talk_reply_del",
				data : {
					"r_idx"		: r_idx,
					"r_id"		: r_id,
					"t_idx"		: t_idx
				},
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

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>토크 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->
	<div id="tmp"></div>
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
							$sfl_arr = array('t_id'=>'아이디', 't_nick'=>'닉네임');

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
					<strong>토크 리스트</strong> <!-- panel title -->
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

					<input type="checkbox" id="allCheck" class="pointer"> 전체선택
					<a href="javascript:choice_delete();" class="btn btn-default btn-xs margin-bottom-10" style="height:28px;line-height:24px;"><i class="fa fa-times white"></i> 선택삭제 </a>

					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th><nobr></nobr></th>
							<th class="width-100"><nobr>회원사진</nobr></th>
							<th class="width-100"><nobr>아이디</nobr></th>
							<th class="width-100"><nobr>이름</nobr></th>
							<th><nobr>소개글</nobr></th>
							<th class="width-50"><nobr>댓글갯수</nobr></th>
							<th class="width-150"><nobr>등록시간</nobr></th>
							<th class="width-90"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><input type="checkbox" name="choice_chk" value="<?=$data['t_idx']?>+<?=$data['t_id']?>" class="pointer"></td>
								<td class="text-center pointer"><nobr><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></nobr></td>
								<td class="text-center pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><nobr><?php echo $data['m_userid']?></nobr></td>
								<td class="text-center pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><nobr><?php echo $data['m_name']?></nobr></td>
								<td class="pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><?php echo $data['t_context']?></td>
								<td class="text-center pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><nobr><?php echo $data['t_repl']?></nobr></td>
								<td class="text-center pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><nobr><?php echo $data['t_write']?></nobr></td>
								<td class="text-center pointer" onclick="javascript:show_reply('<?=$data['t_idx']?>');"><nobr><a href="javascript:talk_list_del('<?=$data['t_idx']?>', '<?=$data['t_id']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>
							</tr>
							<tr id="show_reply<?=$data['t_idx']?>" style="background-color:#F9F9F9; display:none;">
								<td colspan="8">
									<div style="position:relative; width:100%;">
										<table class="table table-bordered table-vertical-middle nomargin">
											<thead>
											<tr>
												<th class="width-100"><nobr>회원사진</nobr></th>
												<th class="width-100"><nobr>아이디</nobr></th>
												<th><nobr>댓글</nobr></th>
												<th class="width-150"><nobr>등록시간</nobr></th>
												<th class="width-90"><nobr>삭제</nobr></th>
											</tr>
											</thead>
											<tbody>
											<?php
												$sub_result = $this->my_m->get_list(0, 100, array('t_idx'=> $data['t_idx']),'T_JoyTalk_Reply', 't_idx', 'r_id');
												$data['sub_result'] = $sub_result[0];
												$data['subTotalData'] = $sub_result[1];

												if(@$data['subTotalData'] > 0){
													foreach(@$data['sub_result'] as $values){
											?>
											<tr>
												<td class="text-center"><nobr><?=$this->member_lib->member_thumb($values['m_userid'],34,31)?></nobr></td>
												<td class="text-center"><nobr><?=$values['m_userid']?></nobr></td>
												<td><?=$values['r_context']?></td>
												<td class="text-center"><nobr><?=$values['r_write']?></nobr></td>
												<td class="text-center"><nobr>
													<a href="javascript:reply_del('<?=$values['r_idx']?>', '<?=$values['r_id']?>', '<?=$data['t_idx']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a>
												</nobr></td>
											</tr>
											<?
													}
												}else{
											?>
											<tr>
												<td colspan="5" class="text-center"><b>댓글이 없습니다.</b></td>
											</tr>
											<?}?>
											</tbody>
										</table>
									</div>
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
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>