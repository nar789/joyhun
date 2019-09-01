<div  class="iphone_padding">

<form name="business_form" id="business_form" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/service_center/joy_police/business_pop">

<input type="hidden" value="mver" name="bu_ver">
	<div class="padding_10">

		<table class="border_1_cccccc width_100per height_35">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">카테고리</td>
				<td class="width_80per bg_fff">
					<div class="mobile_select float_left width_98per border_none">
						<select class="border_none height_34 width_95per border_0 text_5 color_666" name="bu_cate" id="bu_cate"> 
							<option value="">선택하세요.</option>
							<option value="사업제휴문의">사업제휴문의</option>
							<option value="광고문의">광고문의</option>
						</select>
					</div>	
				</td>
			</tr>
		</table>
		
		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">회사명</td>
				<td class="width_80per bg_fff"><input type="text" class="width_100per height_35 border_none text_5" maxlength='50' id="bu_company" name="bu_company" value=""></td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">연락처</td>
				<td class="width_80per bg_fff"><input type="tel" class="width_100per height_35 border_none text_5" maxlength='20' id="bu_ph" name="bu_ph" value="<?=$user_info['m_hp1']?><?=$user_info['m_hp2']?><?=$user_info['m_hp3']?>"></td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">이메일</td>
				<td class="width_80per bg_fff"><input type="email" class="width_100per height_35 border_none text_5" maxlength='50' id="bu_email" name="bu_email" value="<?=$user_info['m_mail']?>"></td>
			</tr>
		</table>


		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">회사소개</td>
				<td class="width_80per bg_fff">
					<textarea class=" width_98per no_resize border_none height_141" id="bu_info" name="bu_info"></textarea>
				</td>
			</tr>
		</table>

		<table class="border_1_cccccc width_100per height_35 margin_top_5">
			<tr>
				<td class="width_20per bg_f0f0f0 text_5">문의내용</td>
				<td class="width_80per bg_fff">
					<textarea class=" width_98per no_resize border_none height_141" id="bu_content" name="bu_content" placeholder="답변은 이메일로 발송됩니다.
이메일을 꼭 확인해주세요."></textarea>
				</td>
			</tr>
		</table>
		

		<table class="width_100per margin_auto height_55">
			<tr>
				<td class="width_50per"><input type="button" class="m_pop_btn" value="취소" id="btn_cancel" name="btn_cancel"></td>
				<td class="width_50per text-right"><input type="submit" class="m_d53b3b_btn" value="문의하기"></td>
			</tr>
		</table>

	</div>

</form>



<script>

$(document).ready(function(){

	$('#business_form').ajaxForm({
	   //보내기전 validation check가 필요할경우
		beforeSubmit: function (data, frm, opt) {

			if ($("#bu_cate").val() == ''){				 alert("카테고리를 선택하세요.");	$("#bu_cate").focus(); return false;
			}else if ($("#bu_company").val() == ''){	 alert("회사명을 입력해주세요."); $("#bu_company").focus(); return false;
			}else if ($("#bu_ph").val() == ''){			 alert("연락처를 입력해주세요."); $("#bu_ph").focus(); return false;
			}else if ($("#bu_email").val() == ''){       alert("이메일을 입력해주세요."); $("#bu_email").focus(); return false;
			}else if ($("#bu_info").val() == ''){		 alert("회사소개를 입력해주세요."); $("#bu_info").focus();	return false;
			}else if ($("#bu_content").val() == ''){	 alert("문의내용을 입력해주세요.");	$("#bu_content").focus(); return false;
			}else{ return true; }
		},
		//submit이후의 처리
		success: function(responseText){
			if(responseText == '1'){
				alert("감사합니다. 확인후 빠른 답변보내드리겠습니다.");
				location.href='/m/add_menu';
			}else{
				alert(responseText);
			}
		},
		//ajax error
		error: function(){
			alert("신고 접수중 에러가 발생하였습니다.");
		}
	});

});

</script>

</div>