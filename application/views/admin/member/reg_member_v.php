<script>
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		var sfl_val2 = $("select[name=sfl2]").val();
		if($("#q").val() == '' && $("#q2").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/main/reg_member_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});

	//일괄처리 함수
	$("#btn_user_send").on("click", function(){
		
		if(confirm("인증신청회원들을 일괄처리 하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/admin/main/reg_member_user_up",
				data : {
				},
				cache : false,
				async : true,
				success : function(result){
					alert("총 "+ result +"명의 임시회원을 회원가입 하였습니다.");
					location.reload();
				},
				beforeSend : function(){
					$("#ajax_loading").show();
				},
				complete : function(){
					$("#ajax_loading").hide();
				},				
				error : function(result){
					alert("실패 ("+ result +")");
					console.log(result);
				}

			});

		}

	});

});


function reg_member_del(user_id){
	
	if(confirm("임시회원을 삭제 하시겠습니까?") == true){

		$.get('/admin/main/reg_member_del/user_id/'+user_id+'/'+Math.random(), function(data){
		
			if(data == "1"){
				alert(user_id+"을 삭제했습니다.");
				location.reload();
			}else{
				alert("임시회원 삭제에 실패했습니다.");
			}

		});

	}
	
}

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}

function qna_box(mode, user_id){
	
	$.get('/admin/main/reg_member_etc_memo/user_id/'+user_id+'/'+Math.random(), function(data){

		var etc = "";
		etc = data;

		if(mode == "show"){
			var add_html = "";
			add_html = "<b>"+user_id+"님의 문의사항입니다.</b><br><br>"+etc;

			$(".qna_box").show();
			$(".qna_box").empty();
			$(".qna_box").html(add_html);
		}else if(mode == "hide"){
			$(".qna_box").empty();
			$(".qna_box").hide();
		}

	});

}

</script>
			
			<style>
				.table th, td{text-align:center;}
			</style>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>임시회원조회</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">임시회원관리</span></li>
						<li class="active">임시회원조회</li>
					</ol>
				</header>
				<!-- /page title -->



				<div id="content" class="padding-20">
					

					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>임시회원 검색</strong> <!-- panel title -->
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
$sfl_arr = array('userid'=>'아이디',  'nick'=>'닉네임', 'mail'=>'메일주소', 'partner' => '파트너');

while (list($key, $value) = each($sfl_arr))
{
	if (@$method == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
<?php
}
?>
									</select>
									<div class="input-group">
										<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어 1" onkeypress="board_search_enter(document.q);">
									</div>
								</div>

								<div class="form-group">
									<select name="sfl2" id="sfl2" class="form-control">
<?php
$sfl_arr = array('nick'=>'닉네임', 'userid'=>'아이디', 'mail'=>'메일주소', 'partner' => '파트너');

while (list($key, $value) = each($sfl_arr))
{
	if (@$method2 == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
<?php
}
?>
									</select>
									<div class="input-group">
										<input type="text" name="q2" value="<?=@$s_word2?>" id="q2" class="form-control" size="15" maxlength="20" placeholder="검색어 2" onkeypress="board_search_enter(document.q2);">
									</div>
								</div>

								<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
								&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn btn-danger" id="btn_user_send"><i class="fa fa-send"></i> 일괄처리</button>
								</form>
							</fieldset>

						</div>
					</div>

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>임시회원 리스트</strong> <!-- panel title -->
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

							<div id="ajax_loading" class="ajax_loading"><img src="<?=IMG_DIR?>/etc/ajax_loader4.gif"></div>
							<div class="qna_box"></div>

							<div class="table-responsive">
								<table class="table table-bordered table-vertical-middle nomargin">
									<thead>
										<tr>
											<th class="width-100">아이디</th>
											<th class="width-100">닉네임</th>
											<th class="width-100">나이</th>
											<th class="width-100">성별</th>
											<th>이메일</th>
											<th class="width-100">지역1</th>
											<th class="width-100">지역2</th>
											<th class="width-200">가입일</th>
											<th class="width-200">이름</th>
											<th class="width-200">생년월일</th>
											<th class="width-100">통신사</th>
											<th class="width-200">파트너</th>
											<th class="width-200">휴대폰번호</th>
											<th class="width-100">문의사항</th>
											<th class="width-200">인증신청일</th>
											<th class="width-100">삭제</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if( $getTotalData > 0 )
										{

											foreach($mlist as $data)
											{
										?>
										<tr>
											<td><nobr><?=$data['userid']?></nobr></td>
											<td><nobr><?=$data['nick']?></nobr></td>
											<td><nobr><?=$data['age']?></nobr></td>
											<td><nobr><?=$data['sex']?></nobr></td>
											<td><nobr><?=$data['mail']?></nobr></td>
											<td><nobr><?=$data['conregion']?></nobr></td>
											<td><nobr><?=$data['conregion2']?></nobr></td>
											<td><nobr><?=$data['write_date']?></nobr></td>
											<td><nobr><?=$data['user_name']?></nobr></td>
											<td><nobr><?=$data['year']?>.<?=$data['month']?>.<?=$data['day']?></nobr></td>
											<td><nobr><?=$data['commid']?></nobr></td>
											<td><nobr><?=$data['partner']?></nobr></td>
											<td><nobr><?=$data['hp1']?>-<?=$data['hp2']?>-<?=$data['hp3']?></nobr></td>
											<td><nobr>
												<? if(!empty($data['etc'])){ ?>
												<i class="fa fa-file white pointer" title="<?=$data['etc']?>" onMouseOver="javascript:qna_box('show', '<?=$data['userid']?>');" onMouseOut="javascript:qna_box('hide', '<?=$data['userid']?>');"></i>
												<? } ?>
											</nobr></td>
											<td><nobr><?=$data['wrdate']?></nobr></td>
											<td class="text-center"><nobr><a href="javascript:reg_member_del('<?=$data['userid']?>');" class="btn btn-default"><i class="fa fa-check white"></i> 삭제 </a></nobr></td>
										</tr>
										<?
											}
										}else{
										?>
										<tr>
											<td colspan="15" style="text-align:center">검색결과가 없습니다.</td>
										</tr>
										<?}?>
										<!--	## search for end -->
									</tbody>
								</table>
							</div>
							<div class="row padding-top-20">
								<div class="col-md-2 margin-left-20"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format($getTotalData)?> &nbsp;</span>명</div>
								<div class="col-md-8 text-center"><?= $pagination_links?></div>
								<div class="col-md-2"></div>
							</div>
						</div>
						<!-- /panel content -->

					</div>
					<!-- /PANEL -->

				</div>

			</section>
			<!-- /MIDDLE -->


<style>
	.ajax_loading{position:absolute; width:100%; top:0%; left:0%; text-align:center; display:none;}
	.qna_box{border:solid 1px #000; position:absolute; width:50%; height:80px; top:0%; left:25%; background-color:#FFF; display:none; padding:10px 10px 10px 10px;}
</style>