			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>채팅신청 시간설정</h1>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<form name="setting_agree" method="POST" action="/admin/admin_setting/chat_preference_modi">
						<div id="panel-1" class="panel panel-default col-xs-6">	
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>채팅신청 대기시간</strong> <!-- panel title -->
								</span>

								<!-- right options -->
								<ul class="options pull-right list-inline">
									<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
									<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
									<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
								</ul>
								<!-- /right options -->

							</div>
							<div class="panel-body">
								<div>
									<label>
										미결제한 준회원일 경우만 채팅신청 보냄<br>
										인사말 뽑아와서 지정된 시간후 전송.
									</label>
								</div>
								<div>
									<label>* 첫번째 채팅신청 대기시간 (초) - 미사용시 빈칸 또는 0으로 선택하면 됩니다.</label>
									&nbsp;<input type="checkbox" name="chat_style_1" id="chat_style_1" value="map" <?if(@$preference['chat_style_1'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_1" id="chat_time_1" value="<?=@$preference['chat_time_1']?>" class="form-control">
								</div>

								<div>
									<label>* 이후 두번째 채팅신청 대기시간 (초) - 첫번째 30초, 두번째 60초 셋팅시 총 90초 소요</label>
									&nbsp;<input type="checkbox" name="chat_style_2" id="chat_style_2" value="map" <?if(@$preference['chat_style_2'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_2" id="chat_time_2" value="<?=@$preference['chat_time_2']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 세번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_3" id="chat_style_3" value="map" <?if(@$preference['chat_style_3'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_3" id="chat_time_3" value="<?=@$preference['chat_time_3']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 네번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_4" id="chat_style_4" value="map" <?if(@$preference['chat_style_4'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_4" id="chat_time_4" value="<?=@$preference['chat_time_4']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 다섯번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_5" id="chat_style_5" value="map" <?if(@$preference['chat_style_5'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_5" id="chat_time_5" value="<?=@$preference['chat_time_5']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 여섯번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_6" id="chat_style_6" value="map" <?if(@$preference['chat_style_6'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_6" id="chat_time_6" value="<?=@$preference['chat_time_6']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 일곱번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_7" id="chat_style_7" value="map" <?if(@$preference['chat_style_7'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_7" id="chat_time_7" value="<?=@$preference['chat_time_7']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 여덟번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_8" id="chat_style_8" value="map" <?if(@$preference['chat_style_8'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_8" id="chat_time_8" value="<?=@$preference['chat_time_8']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 아홉번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_9" id="chat_style_9" value="map" <?if(@$preference['chat_style_9'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_9" id="chat_time_9" value="<?=@$preference['chat_time_9']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 열번째 채팅신청 대기시간 (초)</label>
									&nbsp;<input type="checkbox" name="chat_style_10" id="chat_style_10" value="map" <?if(@$preference['chat_style_10'] == "map"){echo "checked";}?>> 지도스타일
									<input type="text" name="chat_time_10" id="chat_time_10" value="<?=@$preference['chat_time_10']?>" class="form-control">
								</div>
							</div>
						</div>


						<div id="panel-2" class="panel panel-default col-xs-6">	
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>준회원팝업 대기시간</strong> <!-- panel title -->
								</span>

								<!-- right options -->
								<ul class="options pull-right list-inline">
									<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
									<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
									<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
								</ul>
								<!-- /right options -->

							</div>
							<div class="panel-body">
								<div>
									<label>
									남성 준회원일 경우만 발송<br>
									* 첫번째 팝업 대기시간 (초) - 미사용시 빈칸 또는 0으로 선택하면 됩니다.<br>(5분안에 만날수 있는 이성)</label>
									<input type="text" name="popup_time_1" id="popup_time_1" value="<?=@$preference['popup_time_1']?>" class="form-control">
								</div>
								<div>
									<label>* 이후 두번째 팝업 대기시간 (초) - 첫번째 30초, 두번째 60초 셋팅시 총 90초 소요<br>(이상형 접속 알림!! 4인 출력)</label>
									<input type="text" name="popup_time_2" id="popup_time_2" value="<?=@$preference['popup_time_2']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 세번째 팝업 대기시간 (초)<br>(사진과 문자를 동시에 주고받는 문자팅)</label>
									<input type="text" name="popup_time_3" id="popup_time_3" value="<?=@$preference['popup_time_3']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 네번째 팝업 대기시간 (초)<br>(메시지 스타일)</label>
									<input type="text" name="popup_time_4" id="popup_time_4" value="<?=@$preference['popup_time_4']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 다섯번째 팝업 대기시간 (초)<br>(오늘 번개팅 하실래요?)</label>
									<input type="text" name="popup_time_5" id="popup_time_5" value="<?=@$preference['popup_time_5']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 여섯번째 팝업 대기시간 (초)<br>(스폐셜 매칭 회원)</label>
									<input type="text" name="popup_time_6" id="popup_time_6" value="<?=@$preference['popup_time_6']?>" class="form-control">
								</div>
							</div>
						</div>

						<div id="panel-3" class="panel panel-default col-xs-6">	
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>정회원팝업 대기시간</strong> <!-- panel title -->
								</span>

								<!-- right options -->
								<ul class="options pull-right list-inline">
									<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
									<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
									<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
								</ul>
								<!-- /right options -->

							</div>
							<div class="panel-body">
								<div>
									<label>
									남성 정회원일 경우만 발송<br>
									1~10. 정회원 비밀채팅 추천팝업<br>
									11. 추천회원 접속 알림!! 4인 출력<br>
									12. 오늘 번개팅 하실래요??<br>
									13. 스폐셜 매칭 회원<br>
									* 첫번째 팝업 대기시간 (초) - 비밀채팅추천 - 미사용시 빈칸 또는 0으로 선택하면 됩니다.</label>
									<input type="text" name="v_popup_time_1" id="v_popup_time_1" value="<?=@$preference['v_popup_time_1']?>" class="form-control">
								</div>
								<div>
									<label>* 이후 두번째 팝업 대기시간 (초) - 비밀채팅추천 - 첫번째 30초, 두번째 60초 셋팅시 총 90초 소요</label>
									<input type="text" name="v_popup_time_2" id="v_popup_time_2" value="<?=@$preference['v_popup_time_2']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 세번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_3" id="v_popup_time_3" value="<?=@$preference['v_popup_time_3']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 네번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_4" id="v_popup_time_4" value="<?=@$preference['v_popup_time_4']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 다섯번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_5" id="v_popup_time_5" value="<?=@$preference['v_popup_time_5']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 여섯번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_6" id="v_popup_time_6" value="<?=@$preference['v_popup_time_6']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 일곱번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_7" id="v_popup_time_7" value="<?=@$preference['v_popup_time_7']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 여덟번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_8" id="v_popup_time_8" value="<?=@$preference['v_popup_time_8']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 아홉째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_9" id="v_popup_time_9" value="<?=@$preference['v_popup_time_9']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 열번째 팝업 대기시간 (초) - 비밀채팅추천</label>
									<input type="text" name="v_popup_time_10" id="v_popup_time_10" value="<?=@$preference['v_popup_time_10']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 열한번째 팝업 대기시간 (초)</label>
									<input type="text" name="v_popup_time_11" id="v_popup_time_11" value="<?=@$preference['v_popup_time_11']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 열두번째 팝업 대기시간 (초)</label>
									<input type="text" name="v_popup_time_12" id="v_popup_time_12" value="<?=@$preference['v_popup_time_12']?>" class="form-control">
								</div>
								<div>
									<label>*  이후 열세번째 팝업 대기시간 (초)</label>
									<input type="text" name="v_popup_time_13" id="v_popup_time_13" value="<?=@$preference['v_popup_time_13']?>" class="form-control">
								</div>
							</div>
						</div>

					</form>

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

						if( $("#chat_style_1").is(":checked") == true){chat_style_1 = $("#chat_style_1").val();}else{chat_style_1 = "";}
						if( $("#chat_style_2").is(":checked") == true){chat_style_2 = $("#chat_style_2").val();}else{chat_style_2 = "";}
						if( $("#chat_style_3").is(":checked") == true){chat_style_3 = $("#chat_style_3").val();}else{chat_style_3 = "";}
						if( $("#chat_style_4").is(":checked") == true){chat_style_4 = $("#chat_style_4").val();}else{chat_style_4 = "";}
						if( $("#chat_style_5").is(":checked") == true){chat_style_5 = $("#chat_style_5").val();}else{chat_style_5 = "";}
						if( $("#chat_style_6").is(":checked") == true){chat_style_6 = $("#chat_style_6").val();}else{chat_style_6 = "";}
						if( $("#chat_style_7").is(":checked") == true){chat_style_7 = $("#chat_style_7").val();}else{chat_style_7 = "";}
						if( $("#chat_style_8").is(":checked") == true){chat_style_8 = $("#chat_style_8").val();}else{chat_style_8 = "";}
						if( $("#chat_style_9").is(":checked") == true){chat_style_9 = $("#chat_style_9").val();}else{chat_style_9 = "";}
						if( $("#chat_style_10").is(":checked") == true){chat_style_10 = $("#chat_style_10").val();}else{chat_style_10 = "";}

						$.ajax({
							type: "post",
							url: "/admin/chatting/chat_time/setting_mod",
							data: {
								"chat_time_1": encodeURIComponent(($("#chat_time_1").val())),
								"chat_time_2": encodeURIComponent(($("#chat_time_2").val())),
								"chat_time_3": encodeURIComponent(($("#chat_time_3").val())),
								"chat_time_4": encodeURIComponent(($("#chat_time_4").val())),
								"chat_time_5": encodeURIComponent(($("#chat_time_5").val())),
								"chat_time_6": encodeURIComponent(($("#chat_time_6").val())),
								"chat_time_7": encodeURIComponent(($("#chat_time_7").val())),
								"chat_time_8": encodeURIComponent(($("#chat_time_8").val())),
								"chat_time_9": encodeURIComponent(($("#chat_time_9").val())),
								"chat_time_10": encodeURIComponent(($("#chat_time_10").val())),
								"chat_style_1": encodeURIComponent(chat_style_1),
								"chat_style_2": encodeURIComponent(chat_style_2),
								"chat_style_3": encodeURIComponent(chat_style_3),
								"chat_style_4": encodeURIComponent(chat_style_4),
								"chat_style_5": encodeURIComponent(chat_style_5),
								"chat_style_6": encodeURIComponent(chat_style_6),
								"chat_style_7": encodeURIComponent(chat_style_7),
								"chat_style_8": encodeURIComponent(chat_style_8),
								"chat_style_9": encodeURIComponent(chat_style_9),
								"chat_style_10": encodeURIComponent(chat_style_10),
								"popup_time_1": encodeURIComponent(($("#popup_time_1").val())),
								"popup_time_2": encodeURIComponent(($("#popup_time_2").val())),
								"popup_time_3": encodeURIComponent(($("#popup_time_3").val())),
								"popup_time_4": encodeURIComponent(($("#popup_time_4").val())),
								"popup_time_5": encodeURIComponent(($("#popup_time_5").val())),
								"popup_time_6": encodeURIComponent(($("#popup_time_6").val())),
								"v_popup_time_1": encodeURIComponent(($("#v_popup_time_1").val())),
								"v_popup_time_2": encodeURIComponent(($("#v_popup_time_2").val())),
								"v_popup_time_3": encodeURIComponent(($("#v_popup_time_3").val())),
								"v_popup_time_4": encodeURIComponent(($("#v_popup_time_4").val())),
								"v_popup_time_5": encodeURIComponent(($("#v_popup_time_5").val())),
								"v_popup_time_6": encodeURIComponent(($("#v_popup_time_6").val())),
								"v_popup_time_7": encodeURIComponent(($("#v_popup_time_7").val())),
								"v_popup_time_8": encodeURIComponent(($("#v_popup_time_8").val())),
								"v_popup_time_9": encodeURIComponent(($("#v_popup_time_9").val())),
								"v_popup_time_10": encodeURIComponent(($("#v_popup_time_10").val())),
								"v_popup_time_11": encodeURIComponent(($("#v_popup_time_11").val())),
								"v_popup_time_12": encodeURIComponent(($("#v_popup_time_12").val())),
								"v_popup_time_13": encodeURIComponent(($("#v_popup_time_13").val()))
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
