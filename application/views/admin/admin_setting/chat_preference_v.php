			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>채팅환경설정</h1>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

						<form name="setting_agree" method="POST" action="/admin/admin_setting/chat_preference_modi">
							<div class="col-xs-6">
								<label>* 채팅신청시 포인트(포인트)</label>
								<input type="text" name="chat_request_point" id="chat_request_point" value="<?=$preference['chat_request_point']?>" class="form-control stepper">
							</div>
							<div style="clear:both;height:20px"></div>
							<div class="col-xs-6">
								<label>* 알림새로고침 간격(ex.1초 = 1000)</label>
								<input type="text" name="alarm_refresh" id="alarm_refresh" value="<?=$preference['alarm_refresh']?>" class="form-control stepper">
							</div>
							<div class="col-xs-6">
								<label>* 채팅새로고침 간격(ex.1초 = 1000)</label>
								<input type="text" name="chat_refresh" id="chat_refresh" value="<?=$preference['chat_refresh']?>" class="form-control stepper">
							</div>
						</form>

					<div style="clear:both;"></div>

					<div class="text-center margin-top-20">
						<button type="button" class="btn btn-primary btn-lg" id="chat_preference">적용</button>
					</div>
				</div>

			</section>
			<!-- /MIDDLE -->

		<script>
			$(document).ready( function(){
				$("#chat_preference").click(function(){
					if(confirm("채팅환경설정을 수정하시겠습니까?")){
						
						var chat_request_point = $("#chat_request_point").val();
						var alarm_refresh = $("#alarm_refresh").val();
						var chat_refresh = $("#chat_refresh").val();

						$.ajax({
								type: "post",
								url: "/admin/admin_setting/chat_preference_modi",
								data: {
									"chat_request_point": encodeURIComponent((chat_request_point)),
									"alarm_refresh": encodeURIComponent((alarm_refresh)),
									"chat_refresh": encodeURIComponent((chat_refresh)),
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
