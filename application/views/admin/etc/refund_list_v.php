<script type="text/javascript">
	
	$(document).ready(function(){
		
		
	});

	//검색어 엔터처리
	function on_keyup_enter(){

		var keycode = window.event.keyCode;
		
		if(keycode == 13){
			member_search();
		}
	}
	
	//회원검색처리
	function member_search(){

		//예외처리
		if($("#q").val() == ""){ alert("검색어를 입력하세요."); $("#q").focus(); return; }

		$.ajax({

			type : "post",
			url : "/admin/etc/refund/member_search_ajax",
			data : {
				"sfl"		: encodeURIComponent($("#sfl").val()),
				"q"			: encodeURIComponent($("#q").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "0"){
					alert('일치하는 정회원이 없습니다.');
					return;
				}else{
					$("#refund").empty();
					$("#refund").html(result);
				}

			},
			error : function(result){
				alert("실패 ("+result+")");
			}

		});
	}


	//환불신청 클릭 이벤트
	function reg_refund(){
		
		if($("#m_reason").val() == ""){ alert("사유를 입력하세요."); $("#m_reason").focus(); return;}

		$.ajax({

			type : "post",
			url : "/admin/etc/refund/member_refund_ajax",
			data : {
				"m_userid"		: encodeURIComponent($("#m_userid").val()),
				"m_reason"		: encodeURIComponent($("#m_reason").val()),
				"m_tradeid"		: encodeURIComponent($("#m_tradeid").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					//정회원 결제 환불처리 성공
					alert("환불신청 되었습니다.");
					location.relaod();
				}else if(result == "0"){
					//정회원 결제 환불처리 실패
					alert("환불신청에 실패했습니다. ("+result+")");
					return;
				}else if(result == "9"){
					//원래 준회원
					alert("준회원입니다.");
					return;
				}else{
					alert("잘못된 접근입니다. ("+result+")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+result+")");
			}
			
		});
		
	}
	
</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>환불신청 관리</h1>
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
							$sfl_arr = array('m_userid'=>'아이디');

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
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeyup="javascript:on_keyup_enter();">
						</div>
					</div>
					
					<button type="button" class="btn btn-success" onclick="javascript:member_search();"><i class="fa fa-search"></i> 검색</button>
					</form>
				</fieldset>
			</div>
		</div>

		<div id="refund" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>회원을 검색하세요.</strong>
				</span>
			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>환불 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>닉네임</nobr></th>
							<th class="width-200"><nobr>정회원 가입일</nobr></th>
							<th><nobr>사유</nobr></th>
							<th class="width-200"><nobr>환불일</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center"><?=$data['m_userid']?></td>
							<td class="text-center"><?=$data['m_name']?></td>
							<td class="text-center"><?=$data['m_nick']?></td>
							<td class="text-center"><?=$data['vip_date']?></td>
							<td><?=$data['reason']?></td>
							<td class="text-center"><?=$data['write_day']?></td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="6" class="text-center">검색결과가 없습니다.</td>
						</tr>
						<?
							}
						?>
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


	</div>

</section>