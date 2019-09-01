			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>회원 금지 아이디</h1>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div id="panel-2" class="panel panel-default">			

						<form name="setting_agree" method="POST" action="/admin/chatting/test/banned_modi">
							<!-- panel content -->
							<div class="panel-body">
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>회원 금지아이디 (콤마로 구분)</label>
											<textarea name="banned_id" id="banned_id" rows="4" class="form-control required"><?=$banned['banned_id'];?></textarea>
										</div>
									</div>
								</div>
								<div class="text-center margin-top-20">
									<button type="button" class="btn btn-primary btn-lg" id="banned_id_btn">적용</button>
								</div>
							</div>
							<!-- /panel content -->

							<!-- panel content -->
							<div class="panel-body">
								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>회원 금지닉네임 (콤마로 구분)</label>
											<textarea name="banned_nick" id="banned_nick" rows="4" class="form-control required"><?=$banned['banned_nick'];?></textarea>
										</div>
									</div>
								</div>
								<div class="text-center margin-top-20">
									<button type="button" class="btn btn-primary btn-lg" id="banned_nick_btn">적용</button>
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
				$("#banned_id_btn").click(function(){
					if(confirm("회원 금지아이디를 수정하시겠습니까?")){
						
						var banned_id = $("#banned_id").val();

						$.ajax({
								type: "post",
								url: "/admin/chatting/test/banned_modi",
								data: {
									"banned_id": encodeURIComponent((banned_id))
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


				$("#banned_nick_btn").click(function(){
					if(confirm("회원 금지닉네임을 수정하시겠습니까?")){
						
						var banned_nick = $("#banned_nick").val();

						$.ajax({
								type: "post",
								url: "/admin/chatting/test/banned_modi_nick",
								data: {
									"banned_nick": encodeURIComponent((banned_nick))
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
