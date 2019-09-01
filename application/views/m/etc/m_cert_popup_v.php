<div  class="iphone_padding">
<form name="upload_cert_form" id="upload_cert_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/main/cert_request_mobile">
	<input type="hidden" id="mode" name="mode" value="<?=$mode?>">
	<div class="padding_10">

		<div class="padding_bottom_10">
			<p class="blod color_999"><?=$mode?>이 안되는 회원님들은<br>
			<b class="color_333">이름 / 생년월일 / 휴대폰번호 / 이메일 / 사유</b> 를 적어주시면<br>
			메일주소로 빠른 답변 드리도록 하겠습니다.</p>
		</div>

		<table class="border_1_cccccc width_100per height_35">
			<tr>
				<td class="width_25per bg_f0f0f0 text_5">이름</td>
				<td class="width_80per bg_fff"><input type="text" class="width_100per height_35 border_none text_5 padding_0" id="cert_name" name="cert_name" value=""></td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_25per bg_f0f0f0 text_5">생년월일</td>
				<td class="width_80per bg_fff">

					<div class="width_35per mobile_select float_left height_35 line-height_35" style="border:none;border-right:1px solid #dbdbdb">
						<select class="border_none height_28 width_100per border_0 text_5 color_666" name="cert_year">
							<option value="">년도</option> 
							<? for($i=date('Y'); $i>=1915; $i--){ ?>
							<option value="<?=$i?>"><?=$i?></option>
							<? } ?>
						</select>
					</div>
					
					<div class="width_30per mobile_select float_left height_35 line-height_35" style="border:none;border-right:1px solid #dbdbdb">
						<select class="border_none height_28 width_100per border_0 text_5 color_666" name="cert_month">
							<option value="">월</option>
							<? for($i=1; $i<=12; $i++){ ?>
							<option value="<?=$i?>"><? if(strlen($i)==1){ echo "0".$i; }else{ echo $i; } ?></option>
							<? } ?>
						</select>
					</div>

					<div class="width_30per mobile_select border_none float_left height_35 line-height_35">
						<select class="border_none height_28 width_100per border_0 text_5 color_666" name="cert_day">
							<option value="">일</option> 
							<? for($i=1; $i<=31; $i++){ ?>
							<option value="<?=$i?>"><? if(strlen($i)==1){ echo "0".$i; }else{ echo $i; } ?></option>
							<? } ?>
						</select>
					</div>
				</td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_25per bg_f0f0f0 text_5">휴대폰번호</td>
				<td class="width_80per bg_fff">
					<div class="width_35per mobile_select float_left height_35 line-height_35" style="border:none;border-right:1px solid #dbdbdb">
						<select class="border_none height_28 width_100per border_0 text_5 color_666" name="cert_ph_1">
							<option value="">선택</option>
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
						</select>
					</div>
					<div class="width_60per mobile_select border_none border_right_dbdbdb float_left height_35 line-height_35 margin_left_5">
						<input type="text" class="width_100per height_30 border_none" name="cert_ph_2">
					</div>
				</td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_25per bg_f0f0f0 text_5">이메일</td>
				<td class="width_80per bg_fff"><input type="email" class="width_100per height_35 border_none text_5" id="qna_email" name="qna_email" value=""></td>
			</tr>
		</table>

		<textarea class="m_textarea width_97per margin_top_5 height_141" id="cert_content" name="cert_content" placeholder="답변은 이메일로 발송됩니다.
이메일을 꼭 확인해주세요."></textarea>

		<div class="margin_top_10 text-center padding_bottom_10">
			<input type="submit" class="text_btn_de4949 width_50per height_30" value="문의하기"/>
		</div>

	</div>

</form>
</div>