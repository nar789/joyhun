<script type="text/javascript">

	$(document).ready(function(){
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			location.href = "/admin/service_center/event/event_list";
		});

		//등록 버튼 클릭시 이벤트
		$("#btn_save").click(function(){
			
			submitContents(this);		//에디터 내용을 textarea value 값에 다시쓰기

			//폼체크
			if($("#m_start_day").val() == ""){ alert("이벤트 시작일을 선택하세요."); $("#m_start_day").focus(); return;}
			if($("#m_last_day").val() == ""){ alert("이벤트 종료일을 선택하세요."); $("#m_last_day").focus(); return;}
			if($("#m_title").val() == ""){ alert("이벤트 제목을 입력하세요."); $("#m_title").focus(); return;}
			if($("#m_sub_content").val() == ""){ alert("이벤트 미리보기 내용을 입력하세요."); $("#m_sub_content").focus(); return;}
			if($("#m_list_file").val() == ""){ alert("리스트 이미지를 등록하세요."); $("#m_list_file").focus(); return;}
			if($("#m_main_file").val() == ""){ alert("메인 섬네일이미지를 등록하세요."); $("#m_main_file").focus(); return;}
			//if($("#ir1").val() == ""){ alert("세부내용을 입력하세요."); $("#ir1").focus(); return;}

			var m_gubn = $(':radio[name="m_gubn"]:checked').val();

			$.ajax({

				type : "post",
				url : "/admin/service_center/event/reg_event_data",
				data : {
					"fname"				: encodeURIComponent($("#frmName").val()),
					"m_idx"				: encodeURIComponent($("#m_idx").val()),
					"m_start_day"		: encodeURIComponent($("#m_start_day").val()),
					"m_last_day"		: encodeURIComponent($("#m_last_day").val()),
					"m_title"			: encodeURIComponent($("#m_title").val()),
					"m_sub_content"		: encodeURIComponent($("#m_sub_content").val()),
					"m_list_file"		: encodeURIComponent($("#m_list_file").val()),
					"m_main_file"		: encodeURIComponent($("#m_main_file").val()),
					"m_contents"		: encodeURIComponent($("#ir1").val()),
					"m_use_yn"			: encodeURIComponent($("input[id='m_use_yn']:checked").val()),
					"m_move_url"		: encodeURIComponent($("#m_move_url").val()),
					"m_gubn"			: encodeURIComponent(m_gubn)
				},
				cache : false,
				async : false,
				success : function(result){				
					if(result == "1"){
						alert("저장되었습니다.");
						location.href = "/admin/service_center/event/event_list";
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
	
	//리스트 사진 업로드
	function list_photo_upload(set_id){		
		var w = 400;
		var h = 300;

		var res_w = ( screen.availWidth - w ) / 2;
		var res_h = ( screen.availHeight - h ) / 2;
				
		var popUrl = "/admin/service_center/event/list_photo_pop/set_id/"+set_id;
		var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=yes, status=no;";  
		var Photo_window = window.open(popUrl, "list_photo_pop" ,popOption);	
	}
	
</script>

<style>
	input{border: solid 1px #D1D1D1;}
	.w80p{width:80%; text-align:center;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>이벤트 등록</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>이벤트등록</strong> <!-- panel title -->
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
			<input type="hidden" id="frmName" name="frmName" value="<?=$m_type?>">
			<input type="hidden" id="m_idx" name="m_idx" value="<?=@$m_idx?>">

			<div class="panel-body">
				<div class="table-responsive">
					
					<table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<th width="12.5%">게시물번호</th>
							<td width="12.5%"><? if(empty($m_idx)){ echo "자동생성"; }else{ echo $m_idx; } ?></td>
							<th width="12.5%">시작일</th>
							<td width="12.5%"><input type="text" id="m_start_day" name="m_start_day" value="<?=@$m_start_day?>" class="w80p" readonly></td>
							<th width="12.5%">종료일</th>
							<td width="12.5%"><input type="text" id="m_last_day" name="m_last_day" value="<?=@$m_last_day?>" class="w80p" readonly></td>
							<th width="12.5%">조회수</th>
							<td width="12.5%"><? if(empty($m_idx)){ echo "자동생성"; }else{ echo $m_readnum; } ?></td>
						</tr>
						<tr>
							<th width="12.5%">제목</th>
							<td width="62.5%" colspan="5"><input type="text" id="m_title" name="m_title" value="<?=@$m_title?>" style="width:90%;"></td>
							<th width="12.5%">게시여부</th>
							<td width="12.5%">
								게시<input type="radio" id="m_use_yn" name="m_use_yn" value="Y" <? if(@$m_use_yn == "Y"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
								&nbsp;&nbsp;&nbsp;&nbsp;
								게시안함<input type="radio" id="m_use_yn" name="m_use_yn" value="N" <? if(@$m_use_yn == "N"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
							</td>
						</tr>
						<tr>
							<th width="12.5%">미리보기 내용</th>
							<td width="87.5%" colspan="5"><input type="text" id="m_sub_content" name="m_sub_content" value="<?=@$m_sub_content?>" style="width:90%;"></td>
							<th width="12.5%">PC, Mobile, All</th>
							<td width="12.5%">
								P<input type="radio" name="m_gubn" value="P" <? if(@$m_gubn == "P"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
								&nbsp;&nbsp;
								M<input type="radio" name="m_gubn" value="M" <? if(@$m_gubn == "M"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
								&nbsp;&nbsp;
								A<input type="radio" name="m_gubn" value="A" <? if(@$m_gubn == "A"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
							</td>
						</tr>
						<tr>
							<th width="12.5%">리스트이미지</th>
							<td width="87.5%" colspan="7">
								<input type="text" id="m_list_file" name="m_list_file" value="<?=@$m_list_img_url?>" readonly style="width:500px;">
								&nbsp;
								<input type="button" id="btn_photo" name="btn_photo" class="btn btn-danger" value="사진등록" onclick="javascript:list_photo_upload('m_list_file');" style="width:90px; height:30px; line-height:0px;">
							</td>
						</tr>
						<tr>
							<th width="12.5%">메인페이지 섬네일</th>
							<td width="87.5%" colspan="7">
								<input type="text" id="m_main_file" name="m_main_file" value="<?=@$m_main_img_url?>" readonly style="width:500px;">
								&nbsp;
								<input type="button" id="btn_photo" name="btn_photo" class="btn btn-danger" value="사진등록" onclick="javascript:list_photo_upload('m_main_file');" style="width:90px; height:30px; line-height:0px;">
							</td>
						</tr>
						<tr>
							<th width="12.5%" style="line-height:450px;">세부내용</th>
							<td width="87.5%" colspan="7">
								<!-- 네이버 에디터 -->
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
											sSkinURI: "/include/naver/SmartEditor2Skin.html?gubn=<?=$reg_temp?>",	
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
								<!-- 네이버 에디터 -->
							</td>
						</tr>
						<tr>
							<th width="12.5%">예외 경로</th>
							<td width="87.5%" colspan="7"><input type="text" id="m_move_url" name="m_move_url" value="<?=@$m_move_url?>" style="width:80%;"></td>
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