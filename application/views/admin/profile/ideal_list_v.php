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

			var act = '/admin/profile/ideal_type/ideal_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});
});

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}



// 추천이상형 추가
function add_list(m_userid,m_num,m_sex){

	if(confirm("추천이상형으로 등록하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/profile/ideal_type/manager_add",
			data : {
				m_userid : m_userid,
				m_num	 : m_num,
				m_sex	 : m_sex
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



// 추천이상형 해제
function del_list(m_userid,m_num){

	if(confirm("추천이상형을 해제하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/admin/profile/ideal_type/manager_del",
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
			
			<style>
				.table th, td{text-align:center;}
			</style>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>추천이상형</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원관리</span></li>
						<li class="active">추천이상형</li>
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
$sfl_arr = array('TotalMembers_login.m_userid'=>'아이디',  'TotalMembers_login.m_name'=>'이름', 'TotalMembers_login.m_nick'=>'닉네임');

while (list($key, $value) = each($sfl_arr))
{
	if ($method == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?=$key?>" <?=$chk?>><?=$value?></option>
<?php
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
								<strong>추천이상형 리스트</strong> <!-- panel title -->
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
							
							<table class="table table-bordered table-vertical-middle nomargin">
								<b>남자</b>
								<thead>
									<tr>
										<th>회원사진</th>
										<th>아이디</th>
										<th>닉네임</th>
										<th>이름</th>
										<th>나이</th>
										<th>성별</th>
										<th>주민번호</th>
										<th>등급</th>
										<th>전화번호</th>
										<th>파트너ID</th>
										<th>메일주소</th>
										<th>가입일</th>
										<th>휴대폰인증</th>
										<th class="width-100"><nobr>추천날짜</nobr></th>
										<th class="width-90"><nobr>추천이상형해제</nobr></th>
									</tr>
								</thead>
								<tbody>
								<? 
									if (!empty ($m_ideal)){

										foreach($m_ideal as $key => $val)
										{
								?>

									<tr>
										<td class="text-center"><nobr><?=$this->member_lib->member_thumb($val['m_userid'],68,49)?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_userid']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_name']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_sex']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_age']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_type']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_hp1']?>-<?=$val['m_hp2']?>-<?=$val['m_hp3']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_partner']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_mail']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_in_date']?></nobr></td>
										<td class="text-center"><nobr></nobr></td>
										<td class="text-center"><nobr><?=$val['m_main_chu_date']?></nobr></td>
										<td class="text-center"><nobr><a href="javascript:del_list('<?=$val['m_userid']?>','<?=$val['m_num']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 추천이상형해제 </a></nobr></td>
									</tr>

								<?}
								
								}else{?>
									<tr>
										<td colspan="15"class="text-center">설정한 회원이 없습니다.</td>
									</tr>
								<? } ?>
								</tbody>
							</table>
						</div>

						<div class="panel-body">
							<b>여자</b>
							<table class="table table-bordered table-vertical-middle nomargin">
								<thead>
									<tr>
										<th>회원사진</th>
										<th>아이디</th>
										<th>닉네임</th>
										<th>이름</th>
										<th>나이</th>
										<th>성별</th>
										<th>주민번호</th>
										<th>등급</th>
										<th>전화번호</th>
										<th>파트너ID</th>
										<th>메일주소</th>
										<th>가입일</th>
										<th>휴대폰인증</th>
										<th class="width-100"><nobr>추천날짜</nobr></th>
										<th class="width-90"><nobr>추천이상형해제</nobr></th>
									</tr>
								</thead>
								<tbody>
								<? if (!empty ($f_ideal)){
									foreach($f_ideal as $key => $val)
									{
								?>

									<tr>
										<td class="text-center"><nobr><?=$this->member_lib->member_thumb($val['m_userid'],68,49)?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_userid']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_name']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_sex']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_nick']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_age']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_type']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_hp1']?>-<?=$val['m_hp2']?>-<?=$val['m_hp3']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_partner']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_mail']?></nobr></td>
										<td class="text-center"><nobr><?=$val['m_in_date']?></nobr></td>
										<td class="text-center"><nobr></nobr></td>
										<td class="text-center"><nobr><?=$val['m_main_chu_date']?></nobr></td>
										<td class="text-center"><nobr><a href="javascript:del_list('<?=$val['m_userid']?>','<?=$val['m_num']?>');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 추천이상형해제 </a></nobr></td>
									</tr>

								<? }
								}else{ ?>
									<tr>
										<td colspan="15"class="text-center">설정한 회원이 없습니다.</td>
									</tr>
								<? } ?>


								</tbody>
							</table>
						</div>




					</div>



					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>회원 리스트</strong> <!-- panel title -->
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
											<th>회원사진</th>
											<th>아이디</th>
											<th>닉네임</th>
											<th>이름</th>
											<th>나이</th>
											<th>성별</th>
											<th>주민번호</th>
											<th>등급</th>
											<th>전화번호</th>
											<th>파트너ID</th>
											<th>메일주소</th>
											<th>가입일</th>
											<th>휴대폰인증</th>
											<th class="width-100"><nobr>추천날짜</nobr></th>
											<th class="width-90"><nobr>추천이상형해제</nobr></th>
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
											<td><a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$data['m_userid']?>"><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></a></td>
											<td><a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$data['m_userid']?>"><?=$data['m_userid']?></a></td>
											<td><?=$data['m_nick']?></td>
											<td><?=$data['m_name']?></td>
											<td><?=$data['m_age']?></td>
											<td><?=$data['m_sex']?></td>
											<td><?=$data['m_jumin1']?>-<?=$data['m_jumin2']?></td>
											<td><?=$data['m_type']?></td>
											<td><?=$data['m_hp1']?>-<?=$data['m_hp2']?>-<?=$data['m_hp3']?></td>
											<td><?=$data['m_partner']?></td>
											<td><?=$data['m_mail']?></td>
											<td><?=$data['m_in_date']?></td>
											<td class="hidden-xs"></td>
											<td class="hidden-xs"><?=$data['m_main_chu_date']?></td>
											<td class="text-center"><nobr><a href="javascript:add_list('<?=$data['m_userid']?>','<?=$data['m_num']?>','<?=$data['m_sex']?>');" class="btn btn-default btn-xs"><i class="fa fa-check white"></i> 추천이상형등록 </a></nobr></td>
										</tr>
										<?
											}
										}else{
										?>
										<tr>
											<td colspan="13" style="text-align:center">검색결과가 없습니다.</td>
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