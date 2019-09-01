<script type="text/javascript">

	$(document).ready( function(){
		
		//리스트 가기 버튼
		$("#my_question_list").click(function(){
			location.href='/admin/service_center/my_question/my_question_list/page/<?=$page?>';
		});
		
		// 문의내역 답변 수정
		$("#my_question_modi").click(function(){
			if(confirm("수정하시겠습니까?")){

				$.ajax({
						type : "post",
						url  : "/admin/service_center/my_question/my_question_modi",
						data : {
								"f_num": encodeURIComponent(<?=$quest['f_num']?>),
								"f_answer": encodeURIComponent($("#f_answer").val()),
								"f_alrim": encodeURIComponent("<?=$quest['f_userid']?>"),
								"f_email": encodeURIComponent("<?=$quest['f_mail']?>")
						},
						cache : false,
						async : false,
						success : function(result){
								alert("정상적으로 수정되었습니다");
								window.location.reload();
						},
						error : function(result){
							alert("실패");
						}
				});
		
			}

		});
		
		// 문의내역 삭제
		$("#my_question_del").click(function(){
			if(confirm("삭제하시겠습니까?")){

				$.ajax({
						type : "post",
						url  : "/admin/service_center/my_question/my_question_del",
						data : {
								"f_num": encodeURIComponent(<?=$quest['f_num']?>),
						},
						cache : false,
						async : false,
						success : function(result){
								alert("정상적으로 삭제되었습니다");
								location.href='/admin/service_center/my_question/my_question_list/page/<?=$page?>';
						},
						error : function(result){
							alert("실패");
						}
				});

			}
		});


	});


</script>

<!-- 
	MIDDLE 
-->

<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<h1>나의문의내역보기</h1>
		<ol class="breadcrumb">
			<li><a href="#">답변</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>제목 : <?=$quest['f_title']?></strong> <!-- panel title -->
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
						<div class="col-md-12 margin-bottom-6"><strong>카테고리</strong> : 
						<?=@$faq_menu[$quest['f_cate1']]['faq_title'] ? @$faq_menu[$quest['f_cate1']]['faq_title'].">" : ""?>
						<?=@$faq_menu[$quest['f_cate1']]['cate'][$quest['f_cate2']]?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-3"><strong>작성자</strong> : <font color='#008299'><a href="http://joyhunting.com/admin/main/member_view/userid/<?=$quest['f_userid']?>" target="_blank"><?=@$quest['f_userid']?></a></font></div>
						<div class="col-md-8"><strong>문의한 날짜</strong> : <?=@$quest['f_writeday']?></div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-3 margin-top-6"><strong>운영체제</strong> : <?=@$quest['f_os']?></div>
						<div class="col-md-8 margin-top-6"><strong>브라우져</strong> : <?=@$quest['f_browser']?></div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-3 margin-top-6 margin-bottom-6"><strong>E-mail</strong> : <?=@$quest['f_mail']?></div>
						<div class="col-md-8 margin-top-6 margin-bottom-6"><strong>미디어플레이어</strong> : <?=@$quest['f_media']?></div>
					</div>
				</div>

				<? if (@$quest['f_userid'] != 'admin'){?>
				<div class="row">
					<div class="form-group">
						<div class="col-md-3"><strong>입력한 아이디</strong> : <?=@$quest['f_userid']?></div>
						<div class="col-md-8"><strong>이름</strong> : <?=@$quest['f_name']?></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12 margin-top-6 margin-bottom-6"><strong>전화번호</strong> : <?=@$quest['f_tel']?></div>
					</div>
				</div>
				<? }else{ ?>
				<div class="row">
					<div class="form-group">
						<div class="col-md-3"><strong>이름</strong> : <?=@$quest['f_name']?></div>
						<div class="col-md-8 margin-bottom-6"><strong>전화번호</strong> : <?=@$quest['f_tel']?></div>
					</div>
				</div>
				<? } ?>

				<div class="row">
					<div class="form-group">
						<div class="<? if($quest['f_filename'] != ''){?>col-md-6 <?}else{?>col-md-12<?} ?>">
							<textarea name="contents" id="contents" rows="8" class="form-control required warning" readonly><?=@$quest['f_content']?></textarea>
						</div>
						<!-- ## 첨부파일 있을때만 출력 -->
						<? if($quest['f_filename'] != ''){?>
						<div class="col-md-6 question_file">
							<label><strong>* 첨부파일</label></strong><br>
							<img src="/upload/joyhunting_upload/qna/<?=$quest['f_filename']?>">
						</div>
						<? } ?>
					</div>
				</div>
				<div class="row"><div class="form-group"></div></div>
			
				<div class="row">
					<div class="form-group">
						<div class="col-md-3 margin-bottom-6"><strong>답변자</strong> : <?=$quest['f_answerid']?></div>
						<div class="col-md-8 margin-bottom-6"><strong>답변한 날짜</strong> : <?=$quest['f_answerwriteday']?></div>
					</div>
				</div>

 				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<textarea name="f_answer" id="f_answer" rows="8" class="form-control required warning"><?=@$quest['f_answer']?></textarea>
						</div>
					</div>
				</div>

				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-primary btn-lg" id="my_question_modi">수정</button>
					<button type="button" class="btn btn-danger btn-lg " id="my_question_del">삭제</button>
					<button type="button" class="btn btn-info btn-lg" id="my_question_list">목록</button>
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



<style>
	.question_file { height:200px; }
	.question_file img { max-height:200px; }
</style>
