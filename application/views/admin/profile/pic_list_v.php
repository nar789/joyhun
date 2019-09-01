<script type="text/javascript">

	$(document).ready(function(){
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			var sex_val = $("select[name=sfl2]").val();

			if(sex_val != '' && $("#q").val() == ''){
				var act = '/admin/profile/pic_manage/pic_list';
				act += '/sex/'+sex_val;
				$("#fsearch").attr('action', act).submit();
				return false;
			}else if($("#q").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/profile/pic_manage/pic_list';
				if($("#q").val() && sfl_val){
					act += '/q/'+$("#q").val()+'/sfl/'+sfl_val+'/sex/'+sex_val;
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
		})

		// 체크박스 승인
		$("#for_ok").click(function(){

			if($("#allCheck").prop("checked")) {
				var chk_cnt = $('input:checkbox:checked').length-1;
			}else{
				var chk_cnt = $('input:checkbox:checked').length;
			}
			
			if(chk_cnt == 0){
				alert("하나이상 체크해주세요.");
			}else{

				var chked_val = "";
				$(":checkbox[name='testest']:checked").each(function(pi,po){
					chked_val += ","+po.value;
				});

				if(chked_val!="")chked_val = chked_val.substring(1);

				var asdfarr = chked_val.split(',');
				var cnt_arr= asdfarr.length;

				for(i=0; i<cnt_arr; i++){
					var retu_arr = asdfarr[i].split('+');
					$.get('/admin/profile/pic_manage/pic_ok/idx/'+retu_arr[0]+'/user/'+retu_arr[1], function(data){});
				}
				location.reload();
			}
		});

		// 체크박스 반려
		$("#for_no").click(function(){

			if($("#allCheck").prop("checked")) {
				var chk_cnt = $('input:checkbox:checked').length-1;
			}else{
				var chk_cnt = $('input:checkbox:checked').length;
			}
			
			if(chk_cnt == 0){
				alert("하나이상 체크해주세요.");
			}else if($("#for_select").val() == ""){
				alert("사유를 선택해 주세요.");
				return;
			}else{

				var chked_val = "";
				$(":checkbox[name='testest']:checked").each(function(pi,po){
					chked_val += ","+po.value;
				});

				if(chked_val!="")chked_val = chked_val.substring(1);

				var asdfarr = chked_val.split(',');
				var cnt_arr= asdfarr.length;

				for(i=0; i<cnt_arr; i++){
					var retu_arr = asdfarr[i].split('+');

					$.ajax({
						type: "POST",
						url: "/admin/profile/pic_manage/pic_no",
						data: {
							"idx": encodeURIComponent(retu_arr[0]),
							"ban_text": encodeURIComponent($("#for_select").val())
						},
						cache: false,
						async: false,
						success: function(data) {
						}
					});

				}
				location.reload();
			}

		});

	});


	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}

	//승인
	function list_ok(m_idx,user){
		$.get('/admin/profile/pic_manage/pic_ok/idx/'+m_idx+'/user/'+user, function(data){
			if(data == true){
				location.reload();
			}else{
				alert(data);
			}
		});
	}



	//반려
	function list_no(m_idx){
		if($("#ban_text_"+m_idx).val() == ""){
			alert("사유를 선택해 주세요.");
			return;
		}

		$.ajax({
			type: "POST",
			url: "/admin/profile/pic_manage/pic_no",
			data: {
				"idx": encodeURIComponent(m_idx),
				"ban_text": encodeURIComponent($("#ban_text_"+m_idx).val())
			},
			cache: false,
			async: false,
			success: function(data) {
				if(data == true){
					location.reload();
				}
			}
		});
	}

	//프로필 사진 리스트 삭제
	function list_del(num,user_id){

		if(confirm("정말 삭제하시겠습니까?")){
			$.get('/admin/profile/pic_manage/admin_pic_del/num/'+num+'/user_id/'+user_id + '/<?=NOW?>', function(data){

				if(data == true){
					alert("삭제되었습니다.");
					location.reload();
				}else{
					alert("실패하였습니다. (" + data + ")");
				}
			});
		}

	}

	//특별회원 등록 및 해제
	function special_modi(num, id, cate){
		
		if (cate == 'del'){
			con_text = "을 해제";
		}else{
			con_text = "으로 등록";
		}

		if(confirm("특별회원"+con_text+"하시겠습니까?")){
			$.ajax({
				type: "POST",
				url: "/admin/admin_setting/special_modi",
				data: {
					"m_idx"		: encodeURIComponent(num),
					"m_userid"	: encodeURIComponent(id),
					"cate"		: encodeURIComponent(cate)
				},	cache: false,async: false,
				success: function(result) {
					if ( result == 1 )
					{
						alert("정상적으로 수정되었습니다");
						location.reload();
					}
					else
					{
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
		<h1>프로필 사진 관리</h1>
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

						<select name="sfl2" id="sfl2" class="form-control">
						<?php
							$sfl_arr2 = array(''=>'성별',  'F'=>'여자', 'M'=>'남자');

							while (list($key, $value) = each($sfl_arr2))
							{
								if ($method_sex == $key) {
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
					<strong>프로필 사진 리스트</strong> <!-- panel title -->
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
					<button type="button" class="btn btn-success" id="for_ok"><i class="fa fa-check"></i> 승인</button>
					<select name="for_select" id="for_select" class="form-control width-300 inline-block" style="margin-bottom:-17px;">
						<option></option>
						<option value="얼굴이 가려진 사진은 반려됩니다.">얼굴이 가려진 사진은 반려됩니다.</option>
						<option value="본인의 사진이 아닙니다.">본인의 사진이 아닙니다.</option>
						<option value="본인확인이 어려운 사진은 반려됩니다.">본인확인이 어려운 사진은 반려됩니다.</option>
						<option value="음란물 업로드시 경고조치됩니다.">음란물 업로드시 경고조치됩니다.</option>
					</select>
					<button type="button" class="btn btn-warning"  id="for_no"><i class="fa fa-warning"></i> 반려</button>
					<br>
					<table class="table table-bordered table-vertical-middle margin-top-6">
						<thead>
						<tr>
							<th class="width-50"><nobr>체크</nobr></th>
							<th class="width-200"><nobr>사진</nobr></th>
							<th class="width-100"><nobr>아이디(이름)</nobr></th>
							<th class="width-100"><nobr>나이</nobr></th>
							<th class="width-100"><nobr>등록요청일</nobr></th>
							<th class="width-100"><nobr>처리일</nobr></th>
							<th class="width-100"><nobr>상태</nobr></th>
							<th><nobr>승인</nobr></th>
							<th><nobr>반려</nobr></th>
							<th class="width-90"><nobr>삭제</nobr></th>
							<th class="width-100"><nobr>특별회원관리</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
								if( @$getTotalData > 0 ){
									foreach(@$mlist as $data){
							?>
							<tr>
								<td class="text-center"><nobr><input type="checkbox" name="testest" value="<?=$data['idx']?>+<?=$data['m_userid']?>" id="<?=$data['m_num']?>" class="pointer"></nobr></td>
								<td class="text-center"><nobr><a href="/profile/main/user/user_id/<?=$data['m_userid']?>" target="_blank"><img src="<?=$this->member_lib->profile_thumb($data['pic_num'],$data['user_id'],180,130, 'admin')?>"></a></nobr></td>
								<td class="text-center"><nobr><a href="/admin/main/member_view/userid/<?=$data['m_userid']?>/gubn/new" target="_blank"><?=$data['m_userid']?><br>(<?=$data['m_name']?>)<br><?=$data['m_nick']?></a></nobr></td>
								<td class="text-center"><nobr><?=$data['m_age']?><br><?if($data['m_sex'] == "M"){echo "남";}else{echo "여";}?></nobr></td>
								<td class="text-center"><nobr><?=$data['pic_w_date']?></nobr></td>
								<td class="text-center"><nobr><?=$data['pic_admin_date']?></nobr></td>
								<td class="text-center"><nobr>
									<?if($data['pic_status'] == "인증대기"){echo "<font color='#0000ff'>";}else if($data['pic_status'] == "인증완료"){echo "<font color='#339900'>";}else if($data['pic_status'] == "인증거부"){echo "<font color='#ff3300'>";}?>
									<?=$data['pic_status']?>
									</font>
								</nobr></td>
								<td class="text-center"><nobr><button type="button" class="btn btn-success" id="search_btn" onclick="list_ok('<?=$data['idx']?>','<?=$data['m_userid']?>');"><i class="fa fa-check"></i> 승인</button></nobr></td>
								<td class="text-center"><nobr>

								<form name="fsearch" id="fsearch" method="post" class="form-inline margin-bottom-0" >
								<div class="form-group" class="form-inline">
									<select name="ban_text_<?=$data['idx']?>" id="ban_text_<?=$data['idx']?>" class="form-control">
										<option></option>
										<option value="얼굴이 가려진 사진은 반려됩니다.">얼굴이 가려진 사진은 반려됩니다.</option>
										<option value="본인의 사진이 아닙니다.">본인의 사진이 아닙니다.</option>
										<option value="본인확인이 어려운 사진은 반려됩니다.">본인확인이 어려운 사진은 반려됩니다.</option>
										<option value="음란물 업로드시 경고조치됩니다.">음란물 업로드시 경고조치됩니다.</option>
									</select>
									<script>
										$("#ban_text_<?=$data['idx']?>").val("<?=$data['pic_admin_memo']?>").attr("selected", "selected");									
									</script>

								</div>
								<button type="button" class="btn btn-warning" id="search_btn" onclick="list_no('<?=$data['idx']?>');"><i class="fa fa-warning"></i> 반려</button>
								</form>
				
								</nobr></td>
								<td class="text-center"><nobr><button type="button" class="btn btn-danger" id="search_btn" onclick="list_del('<?=$data['pic_num']?>','<?=$data['user_id']?>');"><i class="fa fa-times"></i> 삭제</button></nobr></td>
								<td class="text-center"><nobr>
									<? if(empty($data['m_special'])){ ?>
									<a href="javascript:special_modi('<?=$data['m_num']?>', '<?=$data['m_userid']?>','add');" class="btn btn-default btn-xs"><i class="fa fa-cog white"></i> 특별회원등록 </a>
									<? }else{ ?>
									<a href="javascript:special_modi('<?=$data['m_num']?>', '<?=$data['m_userid']?>','del');" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> 특별회원해제 </a>
									<? } ?>
								</nobr></td>
							</tr>
							
							<?
								}
							}else{
							?>
							<tr>
								<td colspan="11" style="text-align:center">검색결과가 없습니다.</td>
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