<script type="text/javascript">

	$(document).ready(function(){
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			location.href = "/admin/service_center/cs/cs_question";
		});

		// 아이디 입력시 존재여부 검사 후 이름추가입력
		$('#userid').blur(function() {
		  if ($("#userid").val() != ""){

			 $.ajax({

				type : "post",
				url : "/admin/service_center/cs/username_chk",
				data : {
					"m_userid"		: encodeURIComponent($("#userid").val())
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == "4"){
						alert("존재하지 않는 회원입니다.");
						$('#userid').focus();
						$('#userid').val('');
					}else{
						$('#userid').val($('#userid').val()+' ('+result+')');
					}				
				},
				error : function(result){
					alert("실패");
				}
			});
		  }
		});
	});

	// 등록버튼 클릭
	function cs_add(){

		if($("#userid").val() == '' && $("#userphone").val() == ''){
			alert("아이디나 핸드폰번호 둘중 하나를 입력해주세요.");
			return false;
		}else if ($("#cs_content").val() == ''){
			alert("CS내용을 입력해주세요.");
			return false;
		}else{
			 $.ajax({

				type : "post",
				url : "/admin/service_center/cs/cs_add",
				data : {
					"c_userid"		: encodeURIComponent($("#userid").val()),
					"c_phone"		: encodeURIComponent($("#userphone").val()),
					"c_content"		: encodeURIComponent($("#cs_content").val())
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("정상적으로 등록되었습니다.");
							window.location.reload();
					}else{
						alert("실패하였습니다."+result);
					}				
				},
				error : function(result){
					alert("실패"+result);
				}
			});
		}
	}

	// 수정버튼 클릭
	function cs_modi(num){
		
		if($("#id_"+num).val() == '' && $("#phone_"+num).val() == ''){
			alert("아이디나 핸드폰번호 둘중 하나를 입력해주세요.");
			return false;
		}else if ($("#content_"+num).val() == ''){
			alert("CS내용을 입력해주세요.");
			return false;
		}else{
			 $.ajax({

				type : "post",
				url : "/admin/service_center/cs/cs_modi",
				data : {
					"c_userid"		: encodeURIComponent($("#id_"+num).val()),
					"c_phone"		: encodeURIComponent($("#phone_"+num).val()),
					"c_content"		: encodeURIComponent($("#content_"+num).val()),
					"c_num"			: encodeURIComponent(num)
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("정상적으로 수정되었습니다.");
						window.location.reload();
					}else{
						alert("실패하였습니다."+result);
					}				
				},
				error : function(result){
					alert("실패"+result);
				}
			});
		}
		
	}

	// 삭제버튼 클릭
	function cs_del(num){

		if(confirm('정말 삭제하시겠습니까?') == true){

			$.ajax({

				type : "post",
				url : "/admin/service_center/cs/cs_del",
				data : {
					"c_num"			: encodeURIComponent(num)
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1"){
						alert("정상적으로 삭제되었습니다.");
						window.location.reload();
					}else{
						alert("실패하였습니다."+result);
					}				
				},
				error : function(result){
					alert("실패"+result);
				}
			});

		}

	}

	
</script>

<style>
	input{border: solid 1px #D1D1D1;}
	.w80p{width:80%; text-align:center;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>CS 목록</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>CS 등록</strong> <!-- panel title -->
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

			<div class="panel-body">
				<div class="table-responsive">
					<div class="panel-body">
						<div class="row">
							<div class="form-group">
								<div class="col-md-3 col-sm-3">
									<label>아이디</label>
									<input type="text" id="userid" name="userid" value="" class="form-control required">
								</div>
								<div class="col-md-3 col-sm-3">
									<label>핸드폰</label>
									<input type="text" id="userphone" name="userphone" value="" class="form-control required">
								</div>
								<div class="col-md-3 col-sm-3 padding-0">
									<button type="button" class="btn btn-success" style="margin-top:24px;" id="write_btn" onclick="javascript:cs_add();"><i class="fa fa-pencil"></i> 등록</button>
								</div>
							</div>
						</div>
						<div class="row margin-top-10">
							<div class="form-group">
								<div class="col-md-12 col-sm-12">
									<textarea name="cs_content" id="cs_content" rows="6" class="form-control required">사유 : 

조취결과 :</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>
		</div>

		
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>CS 목록</strong> <!-- panel title -->
			</span>

			<!-- right options -->
			<ul class="options pull-right list-inline">
				<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
				<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
			</ul>
			<!-- /right options -->
		</div>

<? foreach(@$cs as $data){ ?>
		<div class="table-responsive">
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-3 col-sm-3">
							<label>아이디</label>
							<input type="text" id="id_<?=$data['c_num']?>" value="<?=$data['c_userid']?>" class="form-control required">
						</div>
						<div class="col-md-3 col-sm-3">
							<label>핸드폰</label>
							<input type="text" id="phone_<?=$data['c_num']?>" value="<?=$data['c_phone']?>" class="form-control required">
						</div>
						<div class="col-md-3 col-sm-3 padding-0">
							<button type="button" class="btn btn-success" style="margin-top:24px;" onclick="javascript:cs_modi('<?=$data['c_num']?>');"><i class="fa fa-pencil"></i> 수정</button>
							&nbsp;
							<button type="button" class="btn btn-danger" style="margin-top:24px;" onclick="javascript:cs_del('<?=$data['c_num']?>');"><i class="fa fa-pencil"></i> 삭제</button>
						</div>
					</div>
				</div>
				<div class="row margin-top-10">
					<div class="form-group">
						<div class="col-md-12 col-sm-12">
							<textarea name="cs_content" rows="6"  id="content_<?=$data['c_num']?>" class="form-control required"><?=$data['c_content']?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
<? } ?>


	<div style="position:relative; width:100%; height:50px; margin-top:20px; text-align:center;">
		<button type="button" class="btn btn-danger" id="btn_list" name="btn_list"><i class="fa fa-list"></i><b>목록</b></button>			
	</div>

</div>


	</div>

</section>