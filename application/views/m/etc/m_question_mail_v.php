

<form name="upload_form" id="upload_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/my_question/my_question_write_mobile">
	<div class="padding_10 iphone_padding">
		
		<table class="border_1_cccccc width_100per height_35">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">제목</td>
				<td class="width_80per bg_fff"><input type="text" class="width_100per height_35 border_none text_5" id="qna_title" name="qna_title" value=""></td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">이메일</td>
				<td class="width_80per bg_fff"><input type="email" class="width_100per height_35 border_none text_5" id="qna_email" name="qna_email" value="<?=$user_info['m_mail']?>"></td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">질문분류</td>
				<td class="width_80per bg_fff">
					<div class="mobile_select float_left width_48per qna_right_border">
						<select class="border_none float_left height_34 width_95per border_0 text_5 color_666" onchange="qna_select(this.value,'qna_sub_select');" name="qna_cate_select" id="qna_cate_select">
							<option value="">1차분류</option>
						</select>
					</div>
					<div class="mobile_select float_left width_48per border_none">
						<select class="border_none height_34 width_95per border_0 text_5 color_666" name="qna_sub_select" id="qna_sub_select"> 
							<option value="">선택하세요.</option>
						</select>
					</div>
					<div class="clear"></div>
				</td>
			</tr>
		</table>



		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">첨부파일</td>
				<td class="width_80per bg_fff">
					<p class="color_333 blod line-height_16 font-size_11 margin_top_10 margin_bottom_10">&nbsp;사진의 최대 크기는 1Mb이며,<br>&nbsp;이미지파일만 업로드 가능합니다.</p>
					<div class="normal_filebox margin_bottom_10 text_5">
						<input type="text" class="upload_name" name="upload_name" id="upload_name" value="파일선택" disabled="disabled" style="width:130px;">
						<label for="qna_upload" class="margin_top_mi_2">찾아보기</label> 
						<input type="file" name="qna_upload" id="qna_upload"> 
					</div>
				</td>
			</tr>
		</table>


		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">연락처</td>
				<td class="width_80per bg_fff"><input type="tel" class="width_100per height_35 border_none text_5" id="qna_ph" name="qna_ph" value="<?=$user_info['m_hp1']?><?=$user_info['m_hp2']?><?=$user_info['m_hp3']?>"></td>
			</tr>
		</table>

		<textarea class="m_textarea width_97per margin_top_5 height_214" id="qna_content" name="qna_content" placeholder="답변은 이메일로 발송됩니다.이메일을 꼭 확인해주세요. 
또는 PC버전의 나의 문의내역에서 확인하실 수 있습니다."></textarea>

		<table class="width_100per margin_auto height_55">
			<tr>
				<td class="width_50per"><input type="button" class="m_pop_btn" value="취소" id="btn_cancel" name="btn_cancel"></td>
				<td class="width_50per text-right"><input type="button" class="m_d53b3b_btn" value="문의하기" onclick="javascript:faq_submit('mver');"></td>
			</tr>
		</table>

	</div>
</form>
