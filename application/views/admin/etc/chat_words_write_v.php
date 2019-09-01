<script type="text/javascript">

	$(document).ready(function(){

		//등록 or 수정 버튼 이벤트
		$("#btn_reg").on("click", function(){

			if($("#sex").val() == ""){ alert("성별을 선택하세요."); $("#sex").focus(); return; }
			if($("#chat_words").val() == ""){ alert("채팅문구를 입력하세요."); $("#chat_words").focus(); return; }
			
			if($("#status").val() == ""){
				alert("잘못된 접근입니다.");
				$(location).attr("href", "/admin/etc/chat_words/words_list");
				return;
			}

			$.ajax({

				type : "post",
				url : "/admin/etc/chat_words/register_chat_words",
				data : {
					"idx"			: encodeURIComponent($("#idx").val()),
					"sex"			: encodeURIComponent($("#sex").val()),
					"chat_words"	: encodeURIComponent($("#chat_words").val()),
					"status"		: encodeURIComponent($("#status").val())
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert($("#status").val()+"되었습니다.");
						$(location).attr("href", "/admin/etc/chat_words/words_list");
					}else if(result == "0"){
						alert($("#status").val()+"에 실패했습니다.");
					}else if(result == "1000"){
						alert("잘못된접근입니다.");
						$(location).attr("href", "/admin/etc/chat_words/words_list");
					}else{
						alert("잘못된접근입니다. ("+ result +") ");
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		});

		//삭제 버튼 이벤트
		$("#btn_del").on("click", function(){
			del_chat_words();
		});

		//목록 버튼 이벤트
		$("#btn_list").on("click", function(){
			rtn_list_url();	
		});

	});
	

	//삭제하기
	function del_chat_words(){

		if(confirm("채팅문구를 삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/etc/chat_words/del_chat_words",
				data : {
					"idx"	: encodeURIComponent($("#idx").val())
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("채팅문구를 삭제했습니다.");
						rtn_list_url();
					}else if(result == "0"){
						alert("삭제에 실패했습니다.");
						rtn_list_url();
					}else if(result == "1000"){
						alert("잘못된 접근입니다.");
					}else{
						alert("잘못된 접근입니다. ("+ result +")");
					}
				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

	//리스트 리턴 url
	function rtn_list_url(){
		if($("#page").val()){
			$(location).attr("href", "/admin/etc/chat_words/words_list/page/"+$("#page").val());
		}else{
			$(location).attr("href", "/admin/etc/chat_words/words_list");
		}	
	}

</script>

<!-- 
	MIDDLE 
-->

<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<h1>채팅문구 <?=$status_text?></h1>
		<ol class="breadcrumb">
			<li><a href="#"><?=$status_text?></a></li>
		</ol>
	</header>
	<!-- /page title -->

	
	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>채팅문구 <?=$status_text?></strong> <!-- panel title -->
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
							성별
							<select name="sex" id="sex" class="form-control">
							<?php
								$sfl_arr = array(''=> '==선택==', 'A' => '전체', 'M' => '남성', 'F' => '여성');

								foreach($sfl_arr as $key => $value)
								{
							?>
								<option value="<?php echo $key?>" <? if( $key == @$chat_words['sex']){ echo "selected"; } ?> ><?php echo $value?></option>
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
							채팅문구
							<div class="margin-bottom-6"><input type="text" id="chat_words" name="chat_words" class="form-control required" value="<?=@$chat_words['chat_words']?>"></div>
						</div>
					</div>
				</div>


				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-primary btn-lg" id="btn_reg"><?=$status_text?></button>
					<? if($status_text == "수정"){ ?>
					<button type="button" class="btn btn-danger btn-lg" id="btn_del" style="margin-left:20px;">삭제</button>
					<? } ?>
					<button type="button" class="btn btn-info btn-lg" id="btn_list" style="margin-left:20px;">목록</button>
				</div>
			</div>
			<!-- /panel content -->

	</fieldset>
	<!-- /PANEL -->

	</div>
</div>
</section>
<!-- /MIDDLE -->

<input type="hidden" id="idx" name="idx" value="<?=@$chat_words['idx']?>">
<input type="hidden" id="status" name="status" value="<?=$status_text?>">
<input type="hidden" id="page" name="page" value="<?=@$page?>">