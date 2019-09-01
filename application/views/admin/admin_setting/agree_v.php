			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>약관설정</h1>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div id="panel-2" class="panel panel-default">			

						<form name="setting_agree" >
							<!-- panel content -->
							<div class="panel-body">

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>이용약관</label>
											<textarea name="agree1" id="agree1" rows="4" class="form-control required"><?=$list['agree1'];?></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>수집하는 개인정보의 항목</label>
											<textarea name="agree2" id="agree2" rows="4" class="form-control required"><?=$list['agree2'];?></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>개인정보의 수집 및 이용 목적</label>
											<textarea name="agree3" id="agree3" rows="4" class="form-control required"><?=$list['agree3'];?></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>개인정보의 보유 및 이용기간</label>
											<textarea name="agree4" id="agree4" rows="4" class="form-control required"><?=$list['agree4'];?></textarea>
										</div>
									</div>
								</div>							

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>청소년보호정책</label>
											<textarea name="agree5" id="agree5" rows="4" class="form-control required"><?=$list['agree5'];?></textarea>
										</div>
									</div>
								</div>		

								<div class="text-center margin-top-20">
									<button type="button" class="btn btn-primary btn-lg" id="admin_agree">적용</button>
								</div>
							</div>
							<!-- /panel content -->
						</form>
					</div>
					<!-- /PANEL -->

				</div>

			</section>
			<!-- /MIDDLE -->

		<script>
			$(document).ready( function(){
				$("#admin_agree").click(function(){
					if(confirm("이용약관을 수정하시겠습니까?")){
						
						var agree1 = $("#agree1").val();
						var agree2 = $("#agree2").val();
						var agree3 = $("#agree3").val();
						var agree4 = $("#agree4").val();
						var agree5 = $("#agree5").val();

						$.ajax({
								type: "post",
								url: "/admin/admin_setting/agree_modi",
								data: {
									"agree1": encodeURIComponent((agree1)),
									"agree2": encodeURIComponent((agree2)),
									"agree3": encodeURIComponent((agree3)),
									"agree4": encodeURIComponent((agree4)),
									"agree5": encodeURIComponent((agree5))
								},
								cache: false,
								async: false,
								success: function(result) {

									if ( result == true )
									{
										alert("정상적으로 수정되었습니다");
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
				});

			});
		</script>
