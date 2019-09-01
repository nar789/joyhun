<script type="text/javascript">

	$(document).ready(function(){
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			$(location).attr("href", "/admin/friend/vote/vote_list");
		});

		//등록 버튼 클릭시 이벤트
		$("#btn_save").click(function(){
						
			if($("#m_title").val() == ""){ alert("투표주제를 입력하세요."); $("#m_title").focus(); return;}
			if($("#m_example1").val() == ""){ alert("보기1을 입력하세요."); $("#m_example1").focus(); return;}
			if($("#m_example2").val() == ""){ alert("보기2을 입력하세요."); $("#m_example2").focus(); return;}
			if($("#m_example3").val() == ""){ alert("보기3을 입력하세요."); $("#m_example3").focus(); return;}
			if($("#m_example4").val() == ""){ alert("보기4을 입력하세요."); $("#m_example4").focus(); return;}
			if($("#m_example5").val() == ""){ alert("보기5을 입력하세요."); $("#m_example5").focus(); return;}
			if($("#m_sub_title").val() == ""){ alert("서브주제를 입력하세요."); $("#m_sub_title").focus(); return;}
			if($("#m_start_day").val() == ""){ alert("투표 시작일을 선택하세요."); $("#m_start_day").focus(); return;}
			if($("#m_last_day").val() == ""){ alert("투표 종료일을 선택하세요."); $("#m_last_day").focus(); return;}

			$.ajax({

				type : "post",
				url : "/admin/friend/vote/reg_vote",
				data : {
					"fname"				: encodeURIComponent($("#frmName").val()),
					"m_code"			: encodeURIComponent($("#m_code").val()),
					"m_title"			: encodeURIComponent($("#m_title").val()),
					"m_example1"		: encodeURIComponent($("#m_example1").val()),
					"m_example2"		: encodeURIComponent($("#m_example2").val()),
					"m_example3"		: encodeURIComponent($("#m_example3").val()),
					"m_example4"		: encodeURIComponent($("#m_example4").val()),
					"m_example5"		: encodeURIComponent($("#m_example5").val()),
					"m_sub_title"		: encodeURIComponent($("#m_sub_title").val()),
					"m_use_yn"			: encodeURIComponent($("input[id='m_use_yn']:checked").val()),
					"m_start_day"		: encodeURIComponent($("#m_start_day").val()),
					"m_last_day"		: encodeURIComponent($("#m_last_day").val())
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("저장되었습니다.");
						$("#btn_list").click();
					}else if(result == "0"){
						alert("저장에 실패했습니다. ("+result+")");
					}else{
						alert("잘못된 접근입니다. ("+result+")");
					}
				},
				error : function(result){
					alert("실패 ("+result+")");
				}

			});

		});
		
		//달력
		$(".w80p").datepicker({			
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			yearSuffix: '년'

		});

	});
	
	
	
</script>

<style>
	input{border: solid 1px #D1D1D1;}
	.w80p{width:80%; text-align:center; cursor:pointer;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>공감Poll 등록</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>투표등록</strong> <!-- panel title -->
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

			<form id="frm" name="frm" method="post">
			<input type="hidden" id="frmName" name="frmName" value="<?=$fname?>">
			<input type="hidden" id="m_code" name="m_code" value="<?=$m_code?>">

			<div class="panel-body">
				<div class="table-responsive">
					
					<table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<th width="12.5%">투표번호</th>
							<td width="12.5%"><?=@$m_code?></td>
							<th width="12.5%">시작일</th>
							<td width="12.5%" class="text-center"><input type="text" id="m_start_day" name="m_start_day" value="<?=@$m_start_day?>" class="w80p" readonly></td>
							<th width="12.5%">종료일</th>
							<td width="12.5%" class="text-center"><input type="text" id="m_last_day" name="m_last_day" value="<?=@$m_last_day?>" class="w80p" readonly></td>
							<th width="12.5%">참여자수</th>
							<td width="12.5%"><?=@$cnt?></td>
						</tr>
						<tr>
							<th width="12.5%">투표주제</th>
							<td width="62.5%" colspan="5"><input type="text" id="m_title" name="m_title" value="<?=@$m_title?>" style="width:50%;"></td>
							<th width="12.5%">사용여부</th>
							<td width="12.5%">
								Y<input type="radio" id="m_use_yn" name="m_use_yn" value="Y" <?if(@$m_use_yn == "Y"){ echo "checked"; }?> style="vertical-align:-2px; margin-left:10px;">
								&nbsp;&nbsp;
								N<input type="radio" id="m_use_yn" name="m_use_yn" value="N" <?if(@$m_use_yn == "N"){ echo "checked"; }?> style="vertical-align:-2px; margin-left:10px;">
							</td>
						</tr>
						<tr>
							<th width="12.5%">보기1</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_example1" name="m_example1" value="<?=@$m_example1?>" style="width:30%;"></td>
						</tr>
						<tr>
							<th width="12.5%">보기2</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_example2" name="m_example2" value="<?=@$m_example2?>" style="width:30%;"></td>
						</tr>
						<tr>
							<th width="12.5%">보기3</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_example3" name="m_example3" value="<?=@$m_example3?>" style="width:30%;"></td>
						</tr>
						<tr>
							<th width="12.5%">보기4</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_example4" name="m_example4" value="<?=@$m_example4?>" style="width:30%;"></td>
						</tr>
						<tr>
							<th width="12.5%">보기5</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_example5" name="m_example5" value="<?=@$m_example5?>" style="width:30%;"></td>
						</tr>
						<tr>
							<th width="12.5%">서브주제</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_sub_title" name="m_sub_title" value="<?=@$m_sub_title?>" style="width:50%;"></td>
						</tr>
					</table>
					
				</div>

				<div style="position:relative; width:100%; height:50px; margin-top:20px; text-align:center;">
					<button type="button" class="btn btn-success" id="btn_list" name="btn_list"><i class="fa fa-list"></i><b>목록</b></button>
					&nbsp;&nbsp;
					<button type="button" class="btn btn-danger" id="btn_save" name="btn_save"><i class="fa fa-save"></i><b>등록</b></button>					
				</div>

			</div>

			</form>


	</div>

</section>