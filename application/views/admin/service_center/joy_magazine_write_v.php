<script type="text/javascript">
	
	var oEditors = [];

	$(document).ready(function(){

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
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			location.href = "/admin/service_center/joy_magazine/magazine_list";
		});

		//등록 버튼 클릭시 이벤트
		$("#btn_save").click(function(){
			
			//폼체크
			if($("#m_title").val() == ""){ alert("조이매거진 제목을 입력하세요."); $("#m_title").focus(); return;}
			if($("#m_sub_content").val() == ""){ alert("조이매거진 미리보기 내용을 입력하세요."); $("#m_sub_content").focus(); return;}
			if($("#m_list_file").val() == ""){ alert("PC 리스트 이미지를 등록하세요."); $("#m_list_file").focus(); return;}
			if($("#m_list_file_mobile").val() == ""){ alert("모바일 리스트 이미지를 등록하세요."); $("#m_list_file_mobile").focus(); return;}
			if($("input:radio[id='m_use_yn']").is(":checked") == false){ alert("게시여부를 선택하세요."); return; }
		
			oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

			if($("#ir1").val() == ""){ alert("본문 내용이 없습니다."); return;}

			$.ajax({

				type : "post",
				url : "/admin/service_center/joy_magazine/reg_magazine_data",
				data : {
					"fname"					: encodeURIComponent($("#frmName").val()),
					"m_idx"					: encodeURIComponent($("#m_idx").val()),
					"m_title"				: encodeURIComponent($("#m_title").val()),
					"m_sub_content"			: encodeURIComponent($("#m_sub_content").val()),
					"m_list_file"			: encodeURIComponent($("#m_list_file").val()),
					"m_list_file_mobile"	: encodeURIComponent($("#m_list_file_mobile").val()),
					"m_contents"			: encodeURIComponent($("#ir1").val()),
					"m_use_yn"				: encodeURIComponent($("input[id='m_use_yn']:checked").val()),
					"m_gubn"				: encodeURIComponent($("#m_gubn").val())
				},
				cache : false,
				async : false,
				success : function(result){	

					if(result == "1"){
						alert("저장되었습니다.");
						location.href = "/admin/service_center/joy_magazine/magazine_list";
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

	});
	
	//리스트 사진 업로드
	function list_photo_upload(set_id){		
		var w = 400;
		var h = 300;

		var res_w = ( screen.availWidth - w ) / 2;
		var res_h = ( screen.availHeight - h ) / 2;
				
		var popUrl = "/admin/service_center/joy_magazine/list_photo_pop/set_id/"+set_id;
		var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=yes, status=no;";  
		var Photo_window = window.open(popUrl, "list_photo_pop" ,popOption);	
	}

	
</script>

<style>
	input{border: solid 1px #D1D1D1;}
</style>

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>매거진 등록</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>매거진등록</strong> <!-- panel title -->
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
			<input type="hidden" id="frmName" name="frmName" value="<?=@$m_type?>">
			<input type="hidden" id="m_idx" name="m_idx" value="<?=@$idx?>">

			<input type="hidden" id="tmp" name="tmp" value="">

			<div class="panel-body">
				<div class="table-responsive">
					
					<table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<th width="12.5%">게시물번호</th>
							<td width="50%"><? if(empty($idx)){ echo "자동생성"; }else{ echo $idx; } ?></td>
							<th width="12.5%">조회수</th>
							<td width="25%"><? if(empty($idx)){ echo "자동생성"; }else{ echo $read_num; } ?></td>
						</tr>
						<tr>
							<th>제목</th>
							<td><input type="text" id="m_title" name="m_title" value="<?=@$title?>" style="width:90%;"></td>
							<th>게시여부</th>
							<td>
								게시<input type="radio" id="m_use_yn" name="m_use_yn" value="Y" <? if(@$use_yn == "Y"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
								&nbsp;&nbsp;&nbsp;&nbsp;
								게시안함<input type="radio" id="m_use_yn" name="m_use_yn" value="N" <? if(@$use_yn == "N"){ echo "checked"; } ?> style="vertical-align:-2px; margin-left:10px;">
							</td>
						</tr>
						<tr>
							<th>미리보기 내용</th>
							<td><input type="text" id="m_sub_content" name="m_sub_content" value="<?=@$ahead_text?>" style="width:90%;"></td>
							<th>구분</th>
							<td>
								<select id="m_gubn" name="m_gubn">
									<option value="이색데이트" <? if(@$gubn == "이색데이트"){ echo "selected"; } ?> >이색데이트</option>
									<option value="축제속으로" <? if(@$gubn == "축제속으로"){ echo "selected"; } ?> >축제속으로</option>
									<option value="여행지정보" <? if(@$gubn == "여행지정보"){ echo "selected"; } ?> >여행지정보</option>
									<option value="공연&전시" <? if(@$gubn == "공연&전시"){ echo "selected"; } ?> >공연&전시</option>
									<!--option value="리빙&푸드" <? if(@$gubn == "리빙&푸드"){ echo "selected"; } ?> >리빙&푸드</option-->
									<option value="맛집베스트" <? if(@$gubn == "맛집베스트"){ echo "selected"; } ?> >맛집베스트</option>
									<option value="연애&소개팅" <? if(@$gubn == "연애&소개팅"){ echo "selected"; } ?> >연애&소개팅</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>PC 리스트이미지</th>
							<td colspan="3">
								<input type="text" id="m_list_file" name="m_list_file" value="<?=@$list_img_url?>" readonly style="width:500px;">
								&nbsp;
								<input type="button" id="btn_photo" name="btn_photo" class="btn btn-danger" value="사진등록" onclick="javascript:list_photo_upload('m_list_file');" style="width:90px; height:30px; line-height:0px;">
							</td>
						</tr>
						<tr>
							<th>모바일 리스트이미지</th>
							<td colspan="3">
								<input type="text" id="m_list_file_mobile" name="m_list_file_mobile" value="<?=@$m_list_img_url?>" readonly style="width:500px;">
								&nbsp;
								<input type="button" id="btn_photo" name="btn_photo" class="btn btn-danger" value="사진등록" onclick="javascript:list_photo_upload('m_list_file_mobile');" style="width:90px; height:30px; line-height:0px;">
							</td>
						</tr>
						<tr>
							<th style="line-height:450px;">세부내용</th>
							<td colspan="3">
								<!-- 네이버 에디터 -->
								<div style="border:solid 0px red; position:relative; width:100%; height:500px;">
									
									<form id="s_frm" name="s_frm" method="post">
										<textarea name="ir1" id="ir1" rows="10" cols="100" style="width:100%; height:412px; display:none;"><?=@$contents?></textarea>			
									</form>

								</div>
								<!-- 네이버 에디터 -->
							</td>
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