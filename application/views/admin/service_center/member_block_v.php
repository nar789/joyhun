<script type="text/javascript">

	$(document).ready(function(){
		
		//검색버튼 클릭시 이벤트
		$("#search_btn").click(function(){
			var sfl_val = $("select[name='s_terms']").val();
			if($("#s_val").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			}else{
				
				var act = '/admin/service_center/member_block/block_list';
				act += '/s_val/'+encodeURIComponent($("#s_val").val())+'/s_terms/'+encodeURIComponent(sfl_val);
				
				$(location).attr("href", act);
			}
		});	
		
	});
	
	//엔터처리
	function board_search_enter(){
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}

	//차단 해제 버튼 이벤트
	function change_status(idx, status){
		
		if(confirm("선택하신 접속대상을 "+status+" 하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/service_center/member_block/status_change",
				data : {
					"idx"		: encodeURIComponent(idx),
					"status"	: encodeURIComponent(status)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("선택하신 접속대상이 "+status+" 되었습니다.");
						location.reload();
					}else if(result == "0"){
						alert("실패했습니다. ("+ result +")");
						location.reload();
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
						location.reload();
					}else{
						alert("실패 ("+ result +")");
						return;
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

	//차단내역 삭제
	function block_del(idx){
		
		if(confirm("차단내역을 삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/service_center/member_block/block_del",
				data : {
					"idx" : idx
				},
				cache : false,
				asycn : false,
				success : function(result){
					
					if(result == "1"){
						alert("삭제되었습니다.");
						location.reload();
					}else if(result == "0"){
						alert("삭제에 실패했습니다. ("+ result +")");
						location.reload();
					}else if(result == "1000"){
						alert("잘못된 접근입니다. ("+ result +")");
						location.reload();
					}else{
						alert("실패 ("+ result +")");
						return;
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
		<h1>IP/HP 접속 차단</h1>
		<ol class="breadcrumb">
			<li><a href="#">고객센터 / IP,HP 접속차단</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>검색조건</strong> <!-- panel title -->
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
						<select id="s_terms" name="s_terms" class="form-control">
						<?php
							$sfl_arr = array('대상'=>'대상', '차단사유'=>'차단사유', '관련아이디'=>'관련아이디');

							foreach($sfl_arr as $key => $value)
							{
						?>
								<option value="<?php echo $key?>" <? if(@$s_terms == $key){ echo "selected"; } ?> ><?php echo $value?></option>
						<?
							}
						?>
						</select>
						

						<div class="input-group">
							<div class="col-md-6">
								<input type="text" id="s_val" name="s_val" value="<?=@$s_val?>" class="form-control" size="15" maxlength="20" onkeyup="board_search_enter();">
							</div>
						</div>
						<button type="button" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>&nbsp;&nbsp;
						<button type="button" class="btn btn-danger" id="block_btn" onclick="javascript:member_block_pop('HP')"><i class="fa fa-search"></i> 신규차단</button>
					
					</div>
					</form>

				</fieldset>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>차단 리스트</strong> <!-- panel title -->
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
							<th class="width-200"><nobr>차단일</nobr></th>
							<th class="width-150"><nobr>종류</nobr></th>
							<th class="width-200"><nobr>대상</nobr></th>
							<th><nobr>차단사유</nobr></th>
							<th class="width-100"><nobr>관련아이디</nobr></th>
							<th class="width-100"><nobr>상태</nobr></th>
							<th class="width-100"><nobr>해제</nobr></th>
							<th class="width-100"><nobr>삭제</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if(@$getTotalData > 0){
								$i=($getTotalData)-(($page-1)*$rp);
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center"><nobr><?=$i?></nobr></td>
							<td class="text-center"><nobr><?=$data['WRITE_DATE']?></nobr></td>
							<td class="text-center"><nobr>
								<?
									if($data['GUBN'] == "HP"){ echo "휴대전화번호"; }else if($data['GUBN'] == "IP"){ echo "아이피"; }else{ echo "기타"; }
								?>
							</nobr></td>
							<td class="text-center"><nobr><?=$data['GUBN_VAL']?></nobr></td>
							<td><nobr><?=$data['REASON']?></nobr></td>
							<td class="text-center"><nobr><?=$data['USER_ID']?></nobr></td>
							<td class="text-center"><nobr><?=$data['STATUS']?></nobr></td>
							<td class="text-center"><nobr>
								<?
									if($data['STATUS'] == "차단"){ $btn_val = "해제"; $btn_class = "btn-success"; }else if($data['STATUS'] == "해제"){ $btn_val = "차단"; $btn_class = "btn-danger"; }
								?>
								<input type="button" id="btn_status" name="btn_status" value="<?=$btn_val?>" class="btn <?=$btn_class?>" style="width:80px; height:30px;" onclick="javascript:change_status('<?=$data['IDX']?>', this.value);">
							</nobr></td>
							<td class="text-center"><nobr>
								<a href="javascript:block_del('<?=$data['IDX']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a>
							</nobr></td>
						</tr>
						<?
								$i--;
								}
							}else{
						?>
						<tr>
							<td class="text-center bold" colspan="9"><nobr>결과가 없습니다.</nobr></td>
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
			<!-- panel content end-->

		</div>
	</div>

</section>