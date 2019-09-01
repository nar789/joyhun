		<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/joy_police/complain_pop">

			<textarea id="comp_text" name="comp_text" style="display:none"><?=$mes_content?></textarea>

			<div class="<? if (IS_MOBILE == false){ ?>padding_top_20<? }?> padding_left_20">
				<? if (IS_MOBILE == false){ ?><p class="color_666 font-size_14">조이헌팅 서비스 이용 시 불량이용자 신고 내용입니다.</p><? } ?>

				<table class="popup_border_table margin_top_18 width_93per">
					<tr>
						<td class="width_30per <? if(IS_MOBILE == true){?>padding_left_10<?}?>">신고자</td>
						<td><?=$user_id?></td>
					</tr>
					<tr>
						<? 
						// 모바일일경우 채팅창에서 바로 닉네임뽑아오기, 메세지일 경우 바로 닉네임 뽑아오기
						if (IS_MOBILE == true || ($recv_nick == true && $recv_nick != 'undefined')){ ?>
							<td class="padding_left_10">불량이용자</td>
							<td><?=$recv_nick?></td>
							<input type="hidden" name="comp_user" value="<?=$recv_id?>">
						<?
						// PC버전이면 검색
						}else{?>
							<td class="line-height_18 height_50">불량이용자<br>닉네임</td>
							<td>
								<input type="text" name="comp_nick" id="comp_nick" class="width_120 height_20 border_1_cccccc color_666"/>
								<input type="button" id="comp_check_btn" class="text_btn_dcdcdc height_24 width_65" value="검색하기" onclick="javascript:comp_nick_find()">
								<b id="comp_check_text" class="color_ea3c3c" style="display:none;margin-left:5px;">확인</b>
							</td>
						<? } ?>
					</tr>
					<tr>
						<td<? if(IS_MOBILE == true){?> class="padding_left_10"<?}?>>신고사유</td>
						<td>
							<div class="select_box_ccc_border width_100per">
								<select class="height_22 bg_position_100" name="comp_cate" id="comp_cate" style="<?if (IS_MOBILE == true){ ?>width:95%;<?}else{?>width:40%;<?}?>">
									<option value="" selected>선택</option>
									<option value="1">욕설</option>
									<option value="2">음담패설</option>
									<option value="3">음란사진등록</option>
									<option value="4">불량게시물</option>
									<option value="5">개인정보 도용</option>
									<option value="6">불건전이용</option>
									<option value="7">현금거래</option>
									<option value="8">운영자사칭</option>
									<option value="9">기타</option>
									<option value="10">불법광고 타사이트 홍보</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td<? if(IS_MOBILE == true){?> class="padding_left_10"<?}?>>신고내용</td>
						<td>
							<textarea name="comp_content" id="comp_content" style="<? if (IS_MOBILE == true){?>width:80%;height:80px;<?}else{?>width:90%;height:156px;<?}?>" class="padding_10 border_1_cccccc color_666 margin_top_9 margin_bottom_6 no_resize"></textarea>
						</td>
					</tr>
					<tr>
						<td<? if(IS_MOBILE == true){?> class="padding_left_10"<?}?>>파일 첨부</td>
						<td>
							<? if(IS_MOBILE == true){?>
							<div class="normal_filebox margin_bottom_10">
								<input type="text" style="width:50%;display:inline-block;margin-top:15px;" class="upload_name" name="upload_name" id="upload_name" value="파일선택" disabled="disabled">
								<label for="comp_upload" class="margin_top_mi_2">찾아보기</label> 
								<input type="file" name="comp_upload" id="comp_upload" style="margin-top:-3px"> 
							</div>
							<?}else{?>
							<p class="color_333 blod line-height_16 margin_top_10 margin_bottom_10">사진의 최대 크기는 1Mb이며,이미지파일만 업로드 가능합니다.</p>
							<div class="normal_filebox margin_bottom_10">
								<input type="text" class="upload_name" name="upload_name" id="upload_name" value="파일선택" disabled="disabled" style="width:130px;">
								<label for="comp_upload" class="margin_top_mi_2">찾아보기</label> 
								<input type="file" name="comp_upload" id="comp_upload"> 
							</div>
							<? } ?>
						</td>
					</tr>
				</table>
			</div>

			<!-- 메세지에서 온 신고하기면 메세지출력 -->
			<textarea id="comp_chat" name="comp_chat" style="width:0;height:0;display:none;"><? if($mes_idx == true){ echo $mes_content; }?></textarea>

			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="button" class="text_btn_de4949 width_82 height_30" value="신고하기" onclick="javascript:comp_request('<? if(IS_MOBILE == true || $recv_nick == true){?>mobile<?}else{?>pc<?}?>');"/>
			</div>

		</form>

<script>


$(document).ready(function() {

	var comp_chat = $("#add_chat").html();
	$("#comp_chat").text(comp_chat);

});

</script>