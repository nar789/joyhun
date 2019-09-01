<script type="text/javascript">

	function notice_modi(idx){
		if(idx){btn = "수정";}else{btn = "등록";}

		//폼검사
		if(!$("#n_title").val()){
			alert("제목을 입력하세요"); $("#n_title").focus(); return false;
		}
		if(!$("#n_content").val()){
			alert("내용을 입력하세요"); $("#n_content").focus(); return false;
		}


		// 문의내역 답변 등록/수정
		if(confirm("공지사항을 "+btn+"하시겠습니까?")){
			$.ajax({
					type : "post",
					url  : "/admin/service_center/notice/notice_write",
					data : {
							"idx": encodeURIComponent(idx),
							"n_title": encodeURIComponent($("#n_title").val()),
							"n_content": encodeURIComponent($("#n_content").val()),
							"sel1": encodeURIComponent($("#sel1").val())
					},
					cache : false,
					async : false,
					success : function(result){

							alert("정상적으로 "+btn+"되었습니다");
							location.href='/admin/service_center/notice/notice_list/';
					},
					error : function(result){
						alert("실패");
					}
			});

		}

	}
	

	$(document).ready( function(){
		//리스트 가기 버튼
		$("#notice_list").click(function(){
			location.href='/admin/service_center/notice/notice_list/page/<?=$page?>';
		});
	});

<? if($idx){?>
	$(document).ready( function(){
		// 문의내역 삭제
		$("#notice_del").click(function(){
			if(confirm("삭제하시겠습니까?")){
				$.ajax({
						type : "post",
						url  : "/admin/service_center/notice/notice_del",
						data : {
								"idx": encodeURIComponent(<?=$idx?>),
						},
						cache : false,
						async : false,
						success : function(result){
								alert("정상적으로 삭제되었습니다");
								location.href='/admin/service_center/notice/notice_list/page/<?=$page?>';
						},
						error : function(result){
							alert("실패");
						}
				});
			}
		});
		
		//분류 기본값 선택
		$("#sel1").val("<?=$notice['sel1']?>").attr("selected", "selected");
	});
<?}?>
</script>

<!-- 
	MIDDLE 
-->

<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<h1>공지사항 <?=$idx ? "수정" : "글쓰기"?></h1>
		<ol class="breadcrumb">
			<li><a href="#"><?=$idx ? "수정" : "글쓰기"?></a></li>
		</ol>
	</header>
	<!-- /page title -->

	
	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>공지사항 <?=$idx ? "수정" : "글쓰기"?></strong> <!-- panel title -->
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

				<div class="row">
					<div class="form-group">
						<div class="form-group col-md-12 col-sm-12 form-inline">
							분류
							<select name="sel1" id="sel1" class="form-control">
							<?php
								$sfl_arr = array(''=> '==선택==', '메인'=>'메인', '내정보'=>'내정보', '이벤트'=>'이벤트', '결혼재혼'=>'결혼재혼', '조이채팅'=>'조이채팅', '소개팅'=>'소개팅', '친구만들기'=>'친구만들기', '실시간채팅'=>'실시간채팅');

								foreach($sfl_arr as $key => $value)
								{
							?>
								<option value="<?php echo $key?>" ><?php echo $value?></option>
							<?
								}
							?>
							</select>							
						</div>
					</div>
				</div>


				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							제목
							<div class="margin-bottom-6"><input type="text" name="n_title" id="n_title" class="form-control required" value="<?=$idx ? @$notice['n_title'] : ""?>"></div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							내용
							<textarea name="n_content" id="n_content" rows="8" class="form-control required warning" ><?=$idx ? @$notice['n_content'] : ""?></textarea>
						</div>
					</div>
				</div>


				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-primary btn-lg" onclick="notice_modi('<?=$idx?>')"><?=$idx ? "수정" : "글쓰기"?></button>
					<?if($idx){?>
					<button type="button" class="btn btn-danger btn-lg " id="notice_del">삭제</button>
					<?}?>
					<button type="button" class="btn btn-info btn-lg" id="notice_list">목록</button>
				</div>
			</div>
			<!-- /panel content -->
		</form>
	</fieldset>
	<!-- /PANEL -->

	</div>
</div>
</section>
<!-- /MIDDLE -->

