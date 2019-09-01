<script>
	function faq_write(idx){
			if(idx){btn = "수정";}else{btn = "등록";}

			//폼검사
			if(!$("#faq_cate_select").val()){
				alert("대분류를 입력하세요"); $("#faq_cate_select").focus(); return false;
			}
			if(!$("#faq_cate_select2").val()){
				alert("소분류를 입력하세요"); $("#faq_cate_select2").focus(); return false;
			}
			if(!$("#order").val()){
				alert("순서를 입력하세요"); $("#order").focus(); return false;
			}
			if(!$("#title").val()){
				alert("질문을 입력하세요"); $("#title").focus(); return false;
			}
			if(!$("#contents").val()){
				alert("답변을 입력하세요"); $("#contents").focus(); return false;
			}

			if(confirm("FAQ를 "+btn+"하시겠습니까?")){
					
				$.ajax({
						type: "post",
						url: "/admin/service_center/faq/faq_write",
						data: {
							"idx": encodeURIComponent(idx),
							"title": encodeURIComponent($("#title").val()),
							"content": encodeURIComponent($("#contents").val()),
							"gubn1": encodeURIComponent($("#faq_cate_select").val()),
							"gubn2": encodeURIComponent($("#faq_cate_select2").val()),
							"order": encodeURIComponent($("#order").val())
						},
						cache: false,
						async: false,
						success: function(result) {

							if ( result == true )
							{
								alert("정상적으로 "+btn+"되었습니다");
								if(idx){
									location.reload();
								}else{
									location.href="/admin/service_center/faq/faq_list";
								}
							}
							else
							{
								alert("실패하였습니다. (" + result + ")");
								location.reload();
							}
						},
						error : function(result){
							alert("실패하였습니다. (" + result + ")");
							location.reload();
						}
					}); 
			}
	}


$(document).ready( function(){
	//리스트 가기 버튼
	$("#faq_list").click(function(){
		location.href='/admin/service_center/faq/faq_list';
	});
});

function qna_select(sel1_val,sel2,idx){ 
	
	if(sel1_val == "개인정보"){ sel1_val = "1";}
	else if(sel1_val == "로그인/접속"){ sel1_val = "2";}
	else if(sel1_val == "서비스"){ sel1_val = "3";}
	else if(sel1_val == "결제"){ sel1_val = "4";}
	
	
	$.get('/service_center/faq/faq_cate2_call/sel1_val/'+sel1_val+'/'+Math.random(), function(data){
		
		$("#"+sel2).empty();	//option값 비우기

		var txt = data.split('♬');

		$("#"+sel2).append("<option value=''>==선택==</option>").attr('selected', 'selected');

		$.each(txt, function(index, val){
			
			$("#"+sel2).append("<option value='"+val+"'>" + val + "</option>");

			if(val == "<?=@$list['gubn2']?>"){
				
					$("#"+sel2).val(val).attr('selected', 'selected');
				
			}	

		}); //end each
			 
	});		

} 

</script>

<!-- 
	MIDDLE 
-->
<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<?	if(empty($idx))	{?>
			<h1>FAQ 글쓰기</h1>
		<?}else{?>
			<h1>FAQ 수정</h1>
		<?}?>
		<ol class="breadcrumb">
			<li><a href="#">답변</a></li>
		</ol>
	</header>
	<!-- /page title -->

	
	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>FAQ  카테고리</strong> <!-- panel title -->
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
					<div class="form-inline">
						<div class="col-md-12 col-sm-12">
						카테고리
						</div>
						<div class="col-md-12 col-sm-12">
							<select name="faq_cate_select" id="faq_cate_select" class="form-control" onchange="javascript:qna_select(this.value, 'faq_cate_select2', '<?=$idx?>');">
								<option value="">==선택==</option>	
							<?php
								$sfl_arr = array( '개인정보'=>'개인정보', '로그인/접속'=>'로그인/접속', '서비스'=>'서비스', '결제'=>'결제');

								foreach($sfl_arr as $key => $value)
								{
										echo "<option value='$value'>$value</option>";
								}
							?>
							</select>
							<select name="faq_cate_select2" id="faq_cate_select2" class="form-control">
								<option value="" >==선택==</option>					
							</select>	
						</div>

					</div>
				</div>

				<div class="row">
					<div class="form-group">

						<div class="col-md-2 col-sm-3">
						순서<input type="text" name="order" value="<?=@$list['order']?>" id="order" class="form-control" size="4" maxlength="4" placeholder="순서">
						</div>

						<div class="col-md-12 col-sm-12">
							질문<input type="text" name="title" id="title" rows="1" class="form-control required" value="<?=@$list['title']?>">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-12 col-sm-12">
							답변<textarea name="contents" id="contents" rows="8" class="form-control required"><?=@$list['content']?></textarea>
						</div>
					</div>
				</div>
	
				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-primary btn-lg"  onclick="faq_write('<?=@$idx?>')"><?=(empty($idx)) ? '저장' : '수정';?></button>
					<button type="button" class="btn btn-info btn-lg" id="faq_list">목록</button>
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

