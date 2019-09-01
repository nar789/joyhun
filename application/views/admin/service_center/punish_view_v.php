			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>처벌내역 자세히보기</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원관리</span></li>
						<li class="active">처벌내역 관리</li>
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>처벌대상</strong> <!-- panel title -->
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

							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td rowspan="2" class="width-100 text-center"><?=$this->member_lib->member_thumb($puni['user_id'],125,125)?></td>
										<td class="width-250">
											<label>처벌대상 아이디</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<? echo call_chk_block_member_btn_rtn($puni['user_id'], '2', 'HP'); ?>
											<? echo call_chk_block_member_btn_rtn($puni['user_id'], '2', 'IP'); ?>

											<a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$puni['user_id']?>"  target="_blank"><br><?=$puni['user_id']?></a>
											<br><br>
											<label>처벌대상 닉네임</label>
											<input type="text" value="<?=$puni['user_nick']?>" class="form-control required" readonly><br>
											<label>처벌대상 이름</label>
											<input type="text" value="<?=$recv['m_name']?>" class="form-control required" readonly>
										</td>
										<td class="width-250">
											<label>처벌대상 성별</label>
											<input type="text" value="<?=$recv['m_sex']?>" class="form-control required" readonly><br>
											<label>처벌대상 나이</label>
											<input type="text" value="<?=$recv['m_age']?>" class="form-control required" readonly><br>
											<label>처벌대상 아이피</label>
											<input type="text" value="<?=$recv['last_login_ip']?>" class="form-control required" readonly>
										</td>
									</tr>
								</tbody>
							</table>
							<br>
							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td>가입일</td>
										<td>마지막 접속일</td>
										<td>회원등급</td>
										<td>정회원가입일</td>
										<td>현재포인트</td>
										<td rowspan="2" class="text-center">
											<a class="btn btn-danger lightbox" href="/admin/service_center/punishment/punish_pop/userid/<?=$puni['user_id']?>/<?=$punish_rand?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
												<b>처벌하기</b>
											</a>
										</td>
									</tr>
									<tr>
										<td><input type="text" value="<?=$recv['m_in_date']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=@$last_login['last_login_day']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=$recv['m_type']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?//=$recv['m_sex']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<? if(@$tp['total_point']){ echo number_format($tp['total_point'])."p"; }else{ echo "0 p"; } ?>" class="form-control required" readonly></td>
									</tr>
								</tbody>
							</table>

						</div>
						<!-- /panel content -->
					</div>
					<!-- /PANEL -->

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>처벌기록</strong> <!-- panel title -->
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
							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
								<? 
									if (!empty($puni_list)){
										
										foreach($puni_list as $key => $val){ ?> 
									<tr>
										<td class="text-center">사건번호</td>
										<td class="text-center">처벌일</td>
										<td class="text-center">분류</td>
										<td class="text-center">처벌해제일</td>
										<td class="text-center">처벌결과</td>
									</tr>
									<tr>
										<td><input type="text" value="<?=$val['p_idx']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=$val['p_date']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=@police_card($val['p_card'])?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=$val['p_cancel']?>" class="form-control required" readonly></td>
										<td><input type="text" value="<?=police_ing($val['p_success'])?>" class="form-control required" readonly></td>
									</tr>
									<tr>
										<td colspan="5">처벌내용</td>
									</tr>
									<tr>
										<td colspan="5"><textarea name="punish_text" id="punish_text" rows="4" class="form-control required"><?=@$val['p_content']?></textarea></td>
									</tr>
								<? } }else { ?>
									<tr>
										<td class="text-center"></td>
									</tr>
								<? } ?>
								</tbody>
							</table>
						</div>
						<!-- /panel content -->
					</div>

					<div class="text-center ">
						<button type="button" class="btn btn-info btn-lg" id="my_question_list">목록</button>
					</div>

				</div>

			</section>
			<!-- /MIDDLE -->


<script>

function punish_btn(idx){

	if($("#punish_text").val() == ''){alert("처벌내용을 입력해주세요"); return false;}else
	if($("#punish_card").val() == ''){alert("카드를 선택해주세요"); return false;}

	$.ajax({
		type: "POST",
		url: "/admin/service_center/complaint/punish_add",
		data: {
			"text": encodeURIComponent($("#punish_text").val()),
			"card": encodeURIComponent($("#punish_card").val()),
			"idx": encodeURIComponent(idx)
		},	cache: false,async: false,
		success: function(result) {

			if ( result == '4' ){
				alert("이미 처벌하셨습니다.");
			}else if (result == '1'){
				alert("정상적으로 처벌하였습니다");
			}else{
				alert("실패하였습니다. (" + result + ")");
			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}


function not_punish_btn(idx){

	$.ajax({
		type: "POST",
		url: "/admin/service_center/complaint/not_punish",
		data: {
			"idx": encodeURIComponent(idx)
		},	cache: false,async: false,
		success: function(result) {

			if (result == '4'){
				
				alert("이미 처벌하셨습니다.");

			}else if (result == true){

				alert("판결불가로 설정합니다.");
			}
			else
			{
				alert("실패하였습니다. (" + result + ")");
			}
		}
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}

</script> 

<script>
	$(document).ready( function(){
		//리스트 가기 버튼
		$("#my_question_list").click(function(){
			location.href='/admin/service_center/punishment/punish_list/page/<?=$page?>';
		});
	});
</script>