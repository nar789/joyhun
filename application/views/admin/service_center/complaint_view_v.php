<script>
	$(document).ready( function(){
		//리스트 가기 버튼
		$("#my_question_list").click(function(){
			location.href='/admin/service_center/complaint/complain_list/page/<?=$page?>';
		});
	});
</script>
			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>신고내역 자세히보기</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">회원관리</span></li>
						<li class="active">신고내역 관리</li>
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>신고자</strong> <!-- panel title -->
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

							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td rowspan="2" class="width-100 text-center">
										<div onclick="location.href='/admin/main/member_view/userid/<?=$comp['s_id']?>'" class="pointer"><?=$this->member_lib->member_thumb($comp['s_id'],125,125)?></div>
										</td>
										<td class="width-250">
											<label>신고자 아이디</label>
											<a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$comp['s_id']?>"  target="_blank"><br><?=$comp['s_id']?></a>
											<br><br>
											<label>신고자 닉네임</label>
											<input type="text" value="<?=$comp['s_nick']?>" class="form-control required" readonly>
										</td>
										<td class="width-250">
											<label>신고자 이름</label>
											<input type="text" value="<?=$send['m_name']?>" class="form-control required" readonly>
											<label>신고자 성별</label>
											<input type="text" value="<?=$send['m_sex']?>" class="form-control required" readonly>
											<label>신고자 나이</label>
											<input type="text" value="<?=$send['m_age']?>" class="form-control required" readonly>
										</td>
									</tr>
								</tbody>
							</table>
							<br>

							<style>

								.police_img { max-width:100%; max-height:240px; }

							</style>
							<table class="table table-bordered table-vertical-top nomargin">
								<tbody>
									<tr>
										<td class="width-100" rowspan="2">
											<label class="width-100">신고파일</label>
											<div class="text-center">
											<?if($comp['c_file']){
													if($comp['c_cate'] == 21){	//음악채팅 신고일때
											?>
													<a onclick="javascript:window.open('/upload/joyhunting_upload/music_chat/<?=$comp['c_file2']?>','','top=0,left=0');" style='cursor:hand'>
													<img src="/upload/joyhunting_upload/music_chat/<?=$comp['c_file2']?>" class="police_img">
													</a>
													<div>
													<iframe src="/upload/joyhunting_upload/music_chat/<?=$comp['c_file']?>" style="width:100%;height:150px;"></iframe>
													</div>
												<?	}else{?>
													<a onclick="javascript:window.open('/upload/joyhunting_upload/police/<?=$comp['c_file']?>','','top=0,left=0');" style='cursor:hand'>
													<img src="/upload/joyhunting_upload/police/<?=$comp['c_file']?>" class="police_img">
													</a>
											<?
												}
											}
											?>
											</div>
										</td>
										<td class="width-250">
											<label class="width-100">신고일자</label>
											<input type="text" value="<?=$comp['c_date']?>" class="form-control required" readonly>
										</td>
										<td class="width-250">
											<label class="width-100">신고사유</label>
											<input type="text" value="<?=police_cate($comp['c_cate'])?>" class="form-control required" readonly>
										</td>
									</tr>
									<tr>
										<td class="width-250" colspan="2">
											<label class="width-100">신고내용</label>
											<textarea rows="4" class="form-control required"><?=$comp['c_content']?></textarea>
										</td>
									</tr>
								</tbody>
							</table>
							<? if($comp['c_chat_content']){ ?>
								<br>
								추가정보
								<table class="table table-bordered table-vertical-top nomargin">
									
									<tr>
										<td colspan="3">
											<div style="height:180px;overflow:auto;background:#f5f5f5" class="chat_content">
												<?=$comp['c_chat_content']?>
											</div>
										</td>
									</tr>
								</table>
							<? } ?>
						</div>
						<!-- /panel content -->
					</div>
					<!-- /PANEL -->


					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>신고대상</strong> <!-- panel title -->
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
							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td rowspan="2" class="width-100 text-center">
										<div onclick="location.href='/admin/main/member_view/userid/<?=$comp['r_id']?>'" class="pointer"><?=$this->member_lib->member_thumb($comp['r_id'],125,125)?></div>
										</td>
										<td class="width-250">
											<label>대상자 아이디</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<? echo call_chk_block_member_btn_rtn($comp['r_id'], '2', 'HP'); ?>
											<? echo call_chk_block_member_btn_rtn($comp['r_id'], '2', 'IP'); ?>

											<a href="<?=ADMIN_DIR?>main/member_view/userid/<?=$comp['r_id']?>"  target="_blank"><br><?=$comp['r_id']?></a>
											
											
											<br><br>

											<label>대상자 닉네임</label>
											<input type="text" value="<?=$comp['r_nick']?>" class="form-control required" readonly>
											<label>대상자 아이피</label>
											<input type="text" value="<?=$recv['last_login_ip']?>" class="form-control required" readonly>
										</td>
										<td class="width-250">
											<label>대상자 이름</label>
											<input type="text" value="<?=$recv['m_name']?>" class="form-control required" readonly>
											<label>대상자 성별</label>
											<input type="text" value="<?=$recv['m_sex']?>" class="form-control required" readonly>
											<label>대상자 나이</label>
											<input type="text" value="<?=$recv['m_age']?>" class="form-control required" readonly>
										</td>
									</tr>
								</tbody>
							</table>
							
							<br>
							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td>
											<label>가입일</label>
											<input type="text" value="<?=$recv['m_in_date']?>" class="form-control required" readonly>
										</td>
										<td>
											<label>마지막접속일</label>
											<input type="text" value="<?=@$last_login['last_login_day']?>" class="form-control required" readonly>
										</td>
										<td>
											<label>회원등급</label>
											<input type="text" value="<?=$recv['m_type']?>" class="form-control required" readonly>
										</td>
										<td>
											<label>정회원 가입일</label>
											<input type="text" value="" class="form-control required" readonly>
										</td>
										<td>
											<label>현재 포인트</label>
											<input type="text" value="<? if(@$tp['total_point']){ echo number_format($tp['total_point'])."p"; }else{ echo "0 p"; } ?>" class="form-control required" readonly>
										</td>
									</tr>
								</tbody>
							</table>

						</div>
						<!-- /panel content -->
					</div>
					<!-- /PANEL -->

					<!-- ## 처벌했으면 -->

					<? if ($comp['c_success'] != '1'){?>

					<div id="panel-2" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>처벌상태</strong>
							</span>

							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
						</div>

						<div class="panel-body">
							<table class="table table-bordered table-vertical-middle nomargin">
								<tbody>
									<tr>
										<td>
											<label>사건번호</label>
											<input type="text" value="<?=$puni['p_idx']?>" class="form-control required" readonly>
										</td>
										<td>
											<label>처벌분류</label>
											<input type="text" value="<?=@police_card($puni['p_card'])?>" class="form-control required" readonly>
										</td>
										<td>
											<label>처벌결과</label>
											<input type="text" value="<?=police_ing($puni['p_success'])?>" class="form-control required" readonly>
										</td>
										<td>
											<label>처벌일</label>
											<input type="text" value="<?=$puni['p_date']?>" class="form-control required" readonly>
										</td>
										<td>
											<label>처벌해제일</label>
											<input type="text" value="<?=$puni['p_cancel']?>" class="form-control required" readonly>
										</td>
									</tr><tr>
										<td colspan="5">
											<label>처벌내용</label>
											<input type="text" value="<?=$puni['p_content']?>" class="form-control required" readonly>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<? } else { ?>

					<div id="panel-2" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>처벌하기</strong>
							</span>

							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>

						</div>
						<div class="panel-body">
							<table class="table table-bordered table-vertical-top nomargin">
								<tbody>
									<tr>
										<td>
											<label class="width-100">처벌내용</label>
											<textarea name="punish_text" id="punish_text" rows="4" class="form-control required"><?=@$puni['p_content']?></textarea>
										</td>
										<td class="width-200">
											<label class="width-100">카드선택</label>
											<select class="form-control" id="punish_card">
												<? if (@$puni['p_card']){?>
												<option value="<?=@$puni['p_card']?>"><?=police_card(@$puni['p_card'])?></option>
												<? }else{ ?>
												<option value="">선택</option>
												<? } ?>
												<option value="1">경고</option>
												<option value="2">화이트카드(12시간)</option>
												<option value="3">옐로카드(24시간)</option>
												<option value="4">레드카드(3일)</option>
												<option value="5">블랙카드(영구정지)</option>
											</select>
											<br>
											<button type="button" class="btn btn-default" onclick="not_punish_btn('<?=$comp['c_idx']?>');">판결불가</button>
											<button type="button" class="btn btn-default" onclick="punish_btn('<?=$comp['c_idx']?>');">처벌하기</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<? } ?>

					<div class="text-center ">
						<button type="button" class="btn btn-info btn-lg" id="my_question_list">목록</button>
					</div>

				</div>

			</section>
			<!-- /MIDDLE -->

<script>

$(document).ready(function(){

	// 추가정보에 채팅이있으면 높이값조절
	if($(".recv_arrow").length) {
		$(".recv_arrow").css("display","none");
		$(".send_arrow").css("display","none");
		$(".chat_content").css("height","300px");


	// 메세지에서 온 신고면
	}else if($(".chat_content").length){
		$(".chat_content").css("background-color","#fff");
		$(".chat_content").removeClass("chat_content");
	}
}); 


function punish_btn(idx){

	if($("#punish_text").val() == ''){alert("처벌내용을 입력해주세요"); return false;}else
	if($("#punish_card").val() == ''){alert("카드를 선택해주세요"); return false;}

	$.ajax({
		type: "POST",
		url: "/admin/service_center/complaint/punish_add",
		data: {
			"text": encodeURIComponent($("#punish_text").val()),
			"card": encodeURIComponent($("#punish_card").val()),
			"idx": encodeURIComponent(idx)
		},	cache: false,async: false,
		success: function(result) {

			if ( result == '4' ){
				alert("이미 처벌하셨습니다.");
			}else if (result == '1'){
				alert("정상적으로 처벌하였습니다");
				location.reload();
			}else{
				alert("실패하였습니다. (" + result + ")");
			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}


function not_punish_btn(idx){

	$.ajax({
		type: "POST",
		url: "/admin/service_center/complaint/not_punish",
		data: {
			"text": encodeURIComponent($("#punish_text").val()),
			"idx": encodeURIComponent(idx)
		},	cache: false,async: false,
		success: function(result) {

			if (result == '4'){
				
				alert("이미 처벌하셨습니다.");

			}else if ( result == true ){
				alert("정상적으로 처벌되었습니다");
				location.reload();

			}else{
				alert("실패하였습니다. (" + result + ")");
			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}

</script>



<style>

.float_right { float:right !important; }
.clear { clear:both !important; }

.margin_right_20 { margin-right:20px !important; }

.padding_left_7 { padding-left:7px !important; }
.padding_right_7 { padding-right:7px !important; }

.text-right { text-align:right !important; }
.text-left { text-align:left !important; }

.gift_box_chat{position:relative; width:100%; height:260px; text-align:center; margin-top:40px; padding-bottom:20px;}
.gift_box_chat .tit_1{position:relaitve; width:100%; color:#4D4CF9; font-weight:bold;}
.gift_box_chat .tit_2{position:relaitve; width:100%; font-weight:bold; font-size:1.2em; padding-top:5px;}
.gift_box_chat .sub_con_1{position:relative; width:100%;}
.gift_box_chat .sub_con_1 div:nth-child(1){border:solid 3px #C2BBB3; position:relative; width:150px; margin:auto; margin-top:10px; overflow:hidden; border-radius:10px;}
.gift_box_chat .sub_con_1 img{width:150px;}
.gift_box_chat .sub_con_2{position:relative; width:100%;}
.gift_box_chat .sub_con_2 div:nth-child(1){position:relative; width:180px; height:25px; margin:auto; margin-top:5px; padding-top:5px; text-align:center;}
.gift_box_chat .sub_con_2 .btn_gift{border:0; width:50%; height:20px; border-radius:5px; color:#FFF; background-color:#FF5795; font-weight:bold;}

@import url(http://cdn.jsdelivr.net/font-nanum/1.0/nanumbarungothic/nanumbarungothic.css); 
.chat_content { height: 100%; font-family: Nanum Barun Gothic,"나눔고딕", NanumGothic, Malgun Gothic, "돋움", Dotum, AppleGothic, sans-serif;margin:0;padding:0; list-style:none; text-decoration:none; font-size:12px; }
.chat_content > img { border:none; }

@media all and (min-width: 481px) and (max-width: 1024px){

	.day_text { font-size:22px !important; margin-top:26px !important;} 
	.div_common { padding:0px 20px 0px 20px !important; } 
	.message_box > img { width:60px !important; height:60px !important;}
	.recv_chat { font-size:24px !important; padding:20px !important;}
	.send_arrow { width:0px; height:0px; right:0; border-right: 10px solid transparent; border-top: 10px solid #817fca; display:inline-block; position:absolute; margin-top:8px; margin-right:20px; }
	.send_chat { font-size:24px !important; padding:20px !important; margin-right:8px !important;}
	.clock_td { font-size:20px !important; width:94px !important;}
	.chat_ok { height:90px !important; font-size:22px !important; line-height:90px !important;}
}

@media all and (min-width:1025px){

	.day_area { height:110px !important; }
	.day_text { font-size:22px !important; margin-top:26px !important;} 
	.div_common { padding:0px 20px 0px 20px !important; }
	.message_box > img { width:60px !important; height:60px !important;}
	.recv_chat { font-size:24px !important; padding:20px !important;}
	.send_arrow { width:0px; height:0px; right:0; border-right: 10px solid transparent; border-top: 10px solid #817fca; display:inline-block; position:absolute; margin-top:8px; margin-right:20px; }
	.send_chat { font-size:24px !important; padding:20px !important; margin-right:8px !important;}
	.clock_td { font-size:20px !important; width:94px !important;}
	.chat_ok { height:120px !important; font-size:22px !important; line-height:120px !important;}
}

/* 본문부분 */
.day_area { width:100%;height:80px;display:inline-block;text-align:center;background:url('/images/chat/chat_date_bar.gif'); }
.day_text { display:inline-block;margin-top:32px;color:#777;font-size:12px;background:#f5f5f5;padding:0 10px 0 10px; } 

.div_common { width:calc(100% - 40px);display:inline-block;padding:0px 10px 0px 10px; margin-bottom:2px;}
.message_box { margin-bottom:3px;} /* min-height:14px; */
.message_box > img { display:inline-block;width:40px;height:40px;vertical-align:top;border-radius:50%; }
.message_box > table { display:inline-block; }

.recv_arrow { width:0px; height:0px; border-top:10px solid #fff; border-left: 10px solid transparent; display:inline-block; position:absolute; margin-top:8px;}
.recv_chat { background:#fff; margin-left:10px; min-height:14px; max-width:100%; border-radius:8px; padding:10px 10px 10px 10px; color:#444; font-size:12px; display:inline-block;}

.send_arrow { width:0px; height:0px; right:0; border-right: 10px solid transparent; border-top: 10px solid #817fca; display:inline-block; position:absolute; margin-top:8px; margin-right:20px; }
.send_chat { background:#817fca; margin-right:-3px; min-height:14px; max-width:100%; border-radius:8px; padding:10px 10px 10px 10px; color:#fff; font-size:12px; display:inline-block; float:right; }

.clock_td { width:48px;color:#999;vertical-align:bottom;font-size:10px;}
.chat_td { vertical-align:bottom; }

.chat_ok { height:50px;font-size:11px;text-align:center;line-height:50px; }

.read_cnt { color:#817fca; font-weight:bold; font-size:10px; }



</style>