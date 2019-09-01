<script type="text/javascript">

	$(document).ready(function(){
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			location.href = "/admin/service_center/event_mb/event_list";
		});

		//등록 버튼 클릭시 이벤트
		$("#btn_save").click(function(){
			
			submitContents(this);		//에디터 내용을 textarea value 값에 다시쓰기

			//폼체크
			if($("#m_start_day").val() == ""){ alert("이벤트 시작일을 선택하세요."); $("#m_start_day").focus(); return;}
			if($("#m_last_day").val() == ""){ alert("이벤트 종료일을 선택하세요."); $("#m_last_day").focus(); return;}
			if($("#m_title").val() == ""){ alert("제목을 입력하세요."); $("#m_title").focus(); return;}
			if($("#m_contents").val() == ""){ alert("내용을 입력하세요."); $("#m_title").focus(); return;}

			$.ajax({

				type : "post",
				url : "/admin/service_center/event_mb/reg_event_mb_data",
				data : {
					"fname"				: encodeURIComponent($("#frmName").val()),
					"m_idx"				: encodeURIComponent($("#m_idx").val()),
					"m_start_day"		: encodeURIComponent($("#m_start_day").val()),
					"m_last_day"		: encodeURIComponent($("#m_last_day").val()),
					"m_title"			: encodeURIComponent($("#m_title").val()),
					"m_contents"		: encodeURIComponent($("#ir1").val())
				},
				cache : false,
				async : false,
				success : function(result){		

					if(result == "1"){
						alert("저장되었습니다.");
						location.href = "/admin/service_center/event_mb/event_list";
					}else if(result == "0"){
						alert("저장에 실패했습니다. ("+result+")");
					}else if(result == "9"){
						alert("잘못된 접근입니다. ("+result+")");
					}else{
						alert(result);
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
	.w80p{width:80%; text-align:center;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>상담내역</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>상담내역 작성</strong> <!-- panel title -->
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

			<form id="frm" name="frm" method="post"><!-- 
			<input type="hidden" id="frmName" name="frmName" value="<?=$m_type?>">
			<input type="hidden" id="m_idx" name="m_idx" value="<?=@$m_idx?>"> -->

			<div class="panel-body">
				<div class="table-responsive">

					<table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<td class="width-200">작성자</td>
							<td colspan="6">
								<input type="text" name="order" value="<?=$user?>" id="m_admin_name" class="form-control">
							</td>
						</tr>
						<tr>
							<td>문의 분야</td>
							<td colspan="6">
								<select class="form-control">
									<option value="">선택하세요.</option>	
								</select>
							</td>
						</tr>
						<tr>
							<td rowspan="4">문의자 정보</td>
						</tr>
						<tr>
							<td class="width-200">ID</td>
							<td><input type="text" name="order" value="" id="m_consult_id" class="form-control"></td>
							<td class="width-200">이름</td>
							<td><input type="text" name="order" value="" id="m_consult_name" class="form-control"></td>
							<td class="width-200">성별</td>
							<td><input type="text" name="order" value="" id="m_consult_sex" class="form-control"></td>
						</tr>
						<tr>
							<td class="width-200">나이</td>
							<td><input type="text" name="order" value="" id="m_consult_age" class="form-control"></td>
							<td class="width-200">가입일</td>
							<td><input type="text" name="order" value="" id="m_consult_in_date" class="form-control"></td>
							<td class="width-200">연락처</td>
							<td><input type="text" name="order" value="" id="m_consult_hp" class="form-control"></td>
						</tr>
						<tr>
							<td class="width-200">포인트</td>
							<td><input type="text" name="order" value="" id="m_consult_hp" class="form-control"></td>
							<td class="width-200">정회원여부</td>
							<td><input type="text" name="order" value="" id="m_consult_hp" class="form-control"></td>
							<td class="width-200">정회원 가입일</td>
							<td><input type="text" name="order" value="" id="m_consult_hp" class="form-control"></td>
						</tr>
						<tr>
							<td>상세 내용</td>
							<td colspan="6">
								<textarea style="width:100%;height:400px;" id="m_consult_comment"><?=@$m_contents?></textarea>		
							</td>
						</tr>
						<tr>
							<td>추가상담여부</td>
							<td colspan="6">
								<input type="radio" name="m_consult_add" value="1">불필요
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="2">필요<br>
								<span style="display:inline-block;margin-top:10px;color:#ea3c3c">! 추가상담 여부 필요시 언제 재연락 하실 예정인지 고객과 약속한 시간을 적어주세요.</span>
							</td>
						</tr>
						<tr>
							<td>처리 결과</td>
							<td colspan="6">
								<input type="radio" name="m_consult_add" value="1">보고
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="2">해결
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="3">미해결
							</td>
						</tr>
						<tr>
							<td>진상 점수</td>
							<td colspan="6">
								<input type="radio" name="m_consult_add" value="5">5점
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="4">4점
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="3">3점
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="2">2점
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="1">1점
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="m_consult_add" value="0">0점
							</td>
						</tr>
					</table>
					
					<!-- <table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<th width="16.6%">작성자</th>
							<td width="16.6%">작성자인풋</td>
							<th width="16.6%">시작일</th>
							<td width="16.6%"><input type="text" id="m_start_day" name="m_start_day" value="<?=@$m_start_day?>" class="w80p" readonly></td>
							<th width="16.6%">종료일</th>
							<td width="16.6%"><input type="text" id="m_last_day" name="m_last_day" value="<?=@$m_last_day?>" class="w80p" readonly></td>
						</tr>
						<tr>
							<th>제목</th>
							<td colspan="5"><input type="text" id="m_title" name="m_title" value="<?=@$m_title?>" style="width:90%;"></td>
						</tr>
						<tr>
							<th width="12.5%" style="line-height:450px;">세부내용</th>
							<td width="87.5%" colspan="7">
								<div style="border:solid 0px red; position:relative; width:100%; height:500px;">
									
									<form id="s_frm" name="s_frm" method="post">
										<textarea name="ir1" id="ir1" rows="10" cols="100" style="width:100%; height:412px; display:none;"><?=@$m_contents?></textarea>			
									</form>

									<script type="text/javascript">
										var oEditors = [];

										// 추가 글꼴 목록
										//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

										nhn.husky.EZCreator.createInIFrame({
											oAppRef: oEditors,
											elPlaceHolder: "ir1",
											sSkinURI: "/include/naver/SmartEditor2Skin.html",	
											htParams : {
												bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
												bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
												bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
												//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
												fOnBeforeUnload : function(){
													//alert("완료!");
												}
											}, //boolean
											fOnAppLoad : function(){
												//예제 코드
												//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
											},
											fCreator: "createSEditor2"
										});


										function pasteHTML() {
											var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
											oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
										}

										function showHTML() {
											var sHTML = oEditors.getById["ir1"].getIR();
											alert(sHTML);
										}
											
										function submitContents(elClickedObj) {
											oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
											
											// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
											
											try {
												elClickedObj.form.submit();
											} catch(e) {}
										}

										function setDefaultFont() {
											var sDefaultFont = '궁서';
											var nFontSize = 24;
											oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
										}
										</script>
								
								</div>
							</td>
						</tr>
					</table> -->
					
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