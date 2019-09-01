<script type="text/javascript">

	$(document).ready(function(){
		
		//검색
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			var sfl_val2 = $("select[name=sfl2]").val();
			if($("#q").val() == '' && $("#q2").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/profile/message/message_list';
				if($("#q").val() && sfl_val){
					act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
				}
				if($("#q2").val() && sfl_val2){
					act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
				}
				$("#fsearch").attr('action', act).submit();
			}
		});
		
		//체크박스 전체 선택 및 제거
		$("#all_msg_chk").click(function(){
			
			if($("#all_msg_chk").prop("checked")){
				$("input[name='msg_chk']").prop('checked', true);
			}else{
				$("input[name='msg_chk']").prop('checked', false);
			}

		});

	});

	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}


	//선택항목 삭제 함수
	function chk_msg_del(){
		
		if($("input[name='msg_chk']").is(":checked") == false){
			alert("삭제할 메세지를 선택하세요.");
			return;
		}else{
			
			var chk_value = "";

			$("input[name='msg_chk']:checked").each(function(){
				if(chk_value){
					chk_value = chk_value+"|"+$(this).val();
				}else{
					chk_value = $(this).val();
				}
			});

			$.ajax({

				type : "post",
				url : "/admin/profile/message/call_chk_msg_del",
				data : {
					"chk_value"	: encodeURIComponent(chk_value)
				},
				cache : false,
				async : false,
				success : function(result){
					var v_result = result.replace(/^\s+|\s+$/g,'');
					if(v_result == "1"){
						alert("선택한 메세지가 삭제되었습니다.");
						location.reload();
					}else{
						alert("선택 메세지 삭제를 실패했습니다. ("+ v_result +")");
					}
				},
				error : function(result){
					var v_result = result.replace(/^\s+|\s+$/g,'');
					alert("실패 ("+ v_result +")");
				}

			})

		}

	}

	//한개씩 삭제함수
	function msg_del(v_idx){
		
		if(confirm("메세지를 삭제하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/profile/message/call_msg_del",
				data : {
					"v_idx"	: encodeURIComponent(v_idx)
				},
				cache : false,
				async : false,
				success : function(result){
					var v_result = result.replace(/^\s+|\s+$/g,'');

					if(v_result == "1"){
						alert("메세지가 삭제되었습니다.");
						location.reload();
					}else{
						alert("메세지 삭제를 실패했습니다. ("+ v_result +")");
					}

				},
				error : function(result){
					var v_result = result.replace(/^\s+|\s+$/g,'');
					alert("실패 ("+ v_result +")");
				}

			});

		}

	}
	

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>메세지 관리</h1>
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

					</form>
				</fieldset>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>메세지 리스트</strong> <!-- panel title -->
					&nbsp;&nbsp;
					<span><a href="javascript:chk_msg_del();" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 선택삭제 </a></span>
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
							<th class="width-50"><input type="checkbox" id="all_msg_chk" name="all_msg_chk" value=""></th>
							<th class="width-100"><nobr>회원사진</nobr></th>
							<th class="width-100"><nobr>보낸아이디</nobr></th>
							<th class="width-100"><nobr>받은아이디</nobr></th>
							<th class="width-100"><nobr>보낸회원이름</nobr></th>
							<th class="width-100"><nobr>보낸회원닉네임</nobr></th>
							<th><nobr>메세지내용</nobr></th>
							<th class="width-100"><nobr>보낸시간</nobr></th>
							<th class="width-100"><nobr>수신시간</nobr></th>
							<th class="width-50"><nobr>삭제여부</nobr></th>
							<th class="width-50"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>						
								<td class="text-center"><input type="checkbox" id="msg_chk" name="msg_chk" value="<?=$data['V_IDX']?>"></td>
								<td class="text-center"><nobr><?=$this->member_lib->member_thumb($data['m_userid'], '50', '50')?></nobr></td>
								<td class="text-center"><nobr><?=$data['V_SEND_ID']?></nobr></td>
								<td class="text-center"><nobr><?=$data['V_RECV_ID']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_name']?></nobr></td>
								<td class="text-center"><nobr><?=$data['m_nick']?></nobr></td>
								<td><?=$data['V_CONTENTS']?></td>
								<td class="text-center"><nobr><?=$data['V_WRITE_DATE']?></nobr></td>
								<td class="text-center"><nobr><?=$data['V_READ_DATE']?></nobr></td>
								<td class="text-center"><nobr><? if(empty($data['V_DEL_GUBN'])){ echo "N"; }else{ echo "Y"; } ?></nobr></td>
								<td class="text-center"><nobr>
									<? if(empty($data['V_DEL_GUBN'])){ ?>
									<a href="javascript:msg_del('<?=$data['V_IDX']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 삭제 </a>
									<? } ?>
								</nobr></td>
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
						<div class="col-md-12 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>