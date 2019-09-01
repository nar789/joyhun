
		<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/my_question/my_question_write_mobile">
			<input type="hidden" id="mode" name="mode" value="pver">

			<div class="padding_top_20 padding_left_20">
				<p class="color_666 font-size_14 line-height_18">원하시는 정보를 FAQ에서 못 찾으셨나요?<br>문의해주시면 <span class="color_ea3c3c font-size_14">메일주소로 빠른 답변</span> 드리도록 하겠습니다.</p>

				<table class="popup_border_table width_420 margin_top_18">
					<tr>
						<td>이름</td>
						<td><? if(IS_LOGIN){ echo $this->session->userdata('m_nick'); }else{ echo "비회원"; }?></td>
					</tr>
					<tr>
						<td>아이디</td>
						<td><? if(IS_LOGIN){ echo $this->session->userdata('m_userid'); }else{ echo "비회원"; }?></td>
					</tr>
					<tr>
						<td>질문분류</td>
						<td>
							<div class="select_box_ccc_border">
								<select class="width_90 height_20 bg_position_100" onchange="qna_select(this.value,'qna_sub_select');" name="qna_cate_select" id="qna_cate_select">
									<option value="">1차분류</option>
								</select>

								<select class="width_111 height_20 bg_position_100"  name="qna_sub_select" id="qna_sub_select"> 
									<option value="">선택하세요.</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>연락처</td>
						<td><input type="text" name="qna_ph" id="qna_ph" class="width_190 height_20 border_1_cccccc color_666"/></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td>
							<input type="text" name="qna_email_1" id="qna_email_1" class="width_71 height_20 border_1_cccccc color_666"/>
							<span class="color_666"> @ </span>
							<input type="text" name="qna_email_2" class="width_91 height_20 border_1_cccccc color_666" id="qna_email_after"/>
							<div class="select_box_ccc_border">
								<select class="width_111 height_22 bg_position_100" id="faq_email_select" onchange="email_chg();">
									<option value="">선택하세요</option>
									<option value="naver.com">naver.com</option>
									<option value="hanmail.net">hanmail.net</option>
									<option value="nate.com">nate.com</option>
									<option value="gmail.com">gmail.com</option>
									<option value="daum.net">daum.net</option>
									<option value="korea.com">korea.com</option>
									<option value="chollian.net">chollian.net</option>
									<option value="dreamwiz.com">dreamwiz.com</option>
									<option value="1">직접입력</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>제목</td>
						<td><input type="text" name="qna_title" id="qna_title" class="width_303 height_20 border_1_cccccc color_666"/></td>
					</tr>
					<tr>
						<td>질문내용</td>
						<td>
							<textarea name="qna_content" id="qna_content" class="width_303 height_62 border_1_cccccc color_666 margin_top_9 margin_bottom_6 no_resize"></textarea>
						</td>
					</tr>
					<? if(IS_LOGIN){?>
					<tr>
						<td class="height_53 line-height_18">답변알림<br>수신동의</td>
						<td>
							<div class="radio_box">
								<input type="radio" id="rec_ok" name="note_recive" value="Y" checked/><label for="rec_ok"></label><span class="color_666">받음</span>
								<input type="radio" id="rec_no" name="note_recive" value="N"/><label for="rec_no"></label><span class="color_666">안받음</span>
							</div>
						</td>
					</tr>
					<? }else{ ?>
						<div class="radio_box">
							<input type="radio" id="rec_no" name="note_recive" value="N" checked/>
						</div>
					<? } ?>
					<tr>
						<td>첨부파일</td>
						<td>
							<p class="color_333 blod line-height_16 font-size_11 margin_top_10 margin_bottom_10">사진의 최대 크기는 1Mb이며,이미지파일만 업로드 가능합니다.</p>
							<div class="normal_filebox margin_bottom_10">
								<input type="text" class="upload_name" name="upload_name" id="upload_name" value="파일선택" disabled="disabled" style="width:130px;">
								<label for="qna_upload" class="margin_top_mi_2">찾아보기</label> 
								<input type="file" name="qna_upload" id="qna_upload"> 
							</div>
						</td>
					</tr>
				</table>
			</div>


			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="button" class="text_btn_de4949 width_82 height_30" value="문의하기" onclick="javascript:faq_submit('pver');"/>
			</div>

		</form>
