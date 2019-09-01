<div style="position:relative; width:100%; background-color:#FFF;">
	<div style="width:100%; height:50px; text-align:center; font-size:1.2em; font-weibht:bold; line-height:50px;">신규 차단</div>
	<div class="table-responsive">
		<table class="table table-bordered table-vertical-middle nomargin block_tbl">
			<tr>
				<th style="vertical-align:middle;">종류</th>
				<td>
					<select id="V_GUBN" name="V_GUBN" onchange="javascript:sel_change_gubn(this.value);">
						<option value="HP" <? if(@$V_GUBN == "HP"){ echo "selected"; } ?> >휴대전화번호</option>
						<option value="IP" <? if(@$V_GUBN == "IP"){ echo "selected"; } ?> >아이피</option>
					</select>
				</td>
			</tr>
			<tr id="sel_gubn_val">
				<?=@$add_html?>
			</tr>
			<tr>
				<th style="vertical-align:middle;">차단사유</th>
				<td>
					<input type="text" id="V_REASON" name="V_REASON" value="" class="width-400">
				</td>
			</tr>
			<tr>
				<th style="vertical-align:middle;">관련아이디</th>
				<td>
					<input type="text" id="V_USER_ID" name="V_USER_ID" value="" class="width-200">
				</td>
			</tr>
		</table>
	</div>
	<div style="width:100%; height:80px; text-align:center; font-size:1.2em; font-weibht:bold; line-height:50px;">
		<input type="button" id="btn_block_layer" name="btn_block_layer" value="차단하기" class="btn btn-success" onclick="javascript:member_block_layer();">
	</div>
</div>

<style>
.block_tbl{width:100%;}
.block_tbl tr{height:60px;}
.block_tbl th{width:30%; text-align:center;;}
.block_tbl td{width:70%;}
.block_tbl input[type=checkbox]{cursor:pointer;}
</style>

<script type="text/javascript">

	$(document).ready(function(){
		
	});
	
	//차단종류 변경시 css 변경
	function sel_change_gubn(val){

		if(val == "HP"){
			$("#sel_gubn_val").empty();
			$("#sel_gubn_val").append("<th style='vertical-align:middle;'>대상</th>");
			$("#sel_gubn_val").append("<td><input type='text' id='V_GUBN_VAL_1' namve='V_GUBN_VAL_1' value='' class='width-100' maxlength='3'> - <input type='text' id='V_GUBN_VAL_2' namve='V_GUBN_VAL_2' value='' class='width-100' maxlength='4'> - <input type='text' id='V_GUBN_VAL_3' namve='V_GUBN_VAL_3' value='' class='width-100' maxlength='4'></td>");
		}else if(val == "IP"){
			$("#sel_gubn_val").empty();
			$("#sel_gubn_val").append("<th style='vertical-align:middle;'>대상</th>");
			$("#sel_gubn_val").append("<td><input type='text' id='V_GUBN_VAL_1' namve='V_GUBN_VAL_1' value='' class='width-50' maxlength='3'> . <input type='text' id='V_GUBN_VAL_2' namve='V_GUBN_VAL_2' value='' class='width-50' maxlength='3'> . <input type='text' id='V_GUBN_VAL_3' namve='V_GUBN_VAL_3' value='' class='width-50' maxlength='3'> . <input type='text' id='V_GUBN_VAL_4' namve='V_GUBN_VAL_4' value='' class='width-50' maxlength='3'> <input type='checkbox' id='V_IP_CHK' name='V_IP_CHK' value='' onclick='javascript:ip_chk();'> 0~255대역	</td>");
		}else{
			self.close();
		}

	}
	
	// 0~255 대역대 처리
	function ip_chk(){
		
		if($("#V_IP_CHK").prop("checked")){
			$("#V_GUBN_VAL_4").val("*");
		}else{
			$("#V_GUBN_VAL_4").val("");
		}
	}

	//차단하기 버튼 클릭시 이벤트
	function member_block_layer(){
		
		if($("#V_GUBN").val() == ""){ alert("차단종류를 선택하세요."); $("#V_GUBN").focus(); return; }

		if($("#V_GUBN").val() == "HP"){
			if($("#V_GUBN_VAL_1").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#V_GUBN_VAL_1").focus(); return; }
			if($("#V_GUBN_VAL_2").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#V_GUBN_VAL_2").focus(); return; }
			if($("#V_GUBN_VAL_3").val() == ""){ alert("휴대전화번호를 입력하세요."); $("#V_GUBN_VAL_3").focus(); return; }
		}else if($("#V_GUBN").val() == "IP"){
			if($("#V_GUBN_VAL_1").val() == ""){ alert("아이피를 입력하세요."); $("#V_GUBN_VAL_1").focus(); return; }
			if($("#V_GUBN_VAL_2").val() == ""){ alert("아이피를 입력하세요."); $("#V_GUBN_VAL_2").focus(); return; }
			if($("#V_GUBN_VAL_3").val() == ""){ alert("아이피를 입력하세요."); $("#V_GUBN_VAL_3").focus(); return; }
			if($("#V_GUBN_VAL_4").val() == ""){ alert("아이피를 입력하세요."); $("#V_GUBN_VAL_4").focus(); return; }
		}

		if($("#V_REASON").val() == ""){ alert("차단사유를 입력하세요."); $("#V_REASON").focus(); return; }
		if($("#V_USER_ID").val() == ""){ alert("관련아이디를 입력하세요."); $("#V_USER_ID").focus(); return; }
		
		var gubn = ""

		if($("#V_GUBN").val() == "HP"){
			gubn = "휴대전화번호";
		}else if($("#V_GUBN").val() == "IP"){
			gubn = "아이피";
		}

		$.ajax({

			type : "post",
			url : "/admin/service_center/member_block/reg_member_block",
			data : {
				"v_gubn"			: encodeURIComponent($("#V_GUBN").val()),
				"v_gubn_val_1"		: encodeURIComponent($("#V_GUBN_VAL_1").val()),
				"v_gubn_val_2"		: encodeURIComponent($("#V_GUBN_VAL_2").val()),
				"v_gubn_val_3"		: encodeURIComponent($("#V_GUBN_VAL_3").val()),
				"v_gubn_val_4"		: encodeURIComponent($("#V_GUBN_VAL_4").val()),
				"v_reason"			: encodeURIComponent($("#V_REASON").val()),
				"v_user_id"			: encodeURIComponent($("#V_USER_ID").val())
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("차단되었습니다.");
					opener.parent.location.reload();
					self.close();
				}else if(result == "0"){
					alert("실패했습니다. ("+ result +")");
					return;
				}else if(result == "1001"){
					alert("이미 차단된 "+gubn+" 입니다.");
					return;
				}else if(result == "1002"){
					alert("이미 차단된 아이피 대역대 입니다.");
					return;
				}else if(result == "1003"){
					alert("회사 내부아이피 대역대 입니다.");
					return;
				}else if(result == "1000"){
					alert("잘못된 접근입니다.");
					self.close();
				}else{
					alert("실패 ("+ result +")");
					return;
				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}


</script>