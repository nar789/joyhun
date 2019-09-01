<?
	if($mode == 1){
?>
<div class="fulltv_con_1">
	<div class="box_1">
		<img src="<?=IMG_DIR?>/layer_popup/fulltv_img_1.png">
	</div>
	<div class="box_2">
		동의하기를 선택하시면<br>
		성인 인터넷 방송국 노모티비로<br>
		가입과 동시에 입장됩니다.<br><br>
		<b>노모티비의 모든 기본 서비스는 무료입니다!!</b>
	</div>
	<div class="box_3">
		<div onclick="javascript:btn_nomotv('agree');">
			동 의
		</div>
		<div onclick="javascript:btn_nomotv('cancel');">
			취 소
		</div>
	</div>
</div>
<?
	}else if($mode == 2){
?>

<div class="fulltv_con_2">
	<div class="box_1">
		<div>
			노모티비에 가입된 회원입니다.<br>
			<b>
				아이디 : <?=$fulltv_id?><br>
				비밀번호 : <?="!".$fulltv_id?>
			</b>
		</div>
	</div>
	<div class="box_2">
		<div onclick="javascript:btn_nomotv('login');">
			노모티비 로그인
		</div>
	</div>
</div>
<?
	}
?>


<script type="text/javascript">
	
	$(document).ready(function(){
		
	});
	
	//동의하기, 취소하기, 풀티비로그인
	function btn_nomotv(mode){

		if(mode == "agree"){
			nomotv_pop_layer(2);
		}else if(mode == "cancel"){
			modal2.close();
		}else if(mode == "login"){
			
			var pop_url = "";
			$.ajax({
				type : "post",
				url : "/m/m_popup/nomotv_login_ajax",
				data : {
				},
				cache : false,
				async : false,
				success : function(result){
					if(result == "1000"){
						alert("잘못된 접근입니다.");
						return;
					}else{
						var obj = JSON.parse(result);

						v_token = obj.token;
						v_aspCode = obj.aspCode;
						pop_url = obj.popurl;
					}					
				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

			if(pop_url != ""){
				var form = $('<form></form>');
				form.attr('id', 'nomotv_frm');
				form.attr('name', 'nomotv_frm');
				form.attr('action', pop_url);
				form.attr('method', 'post');
				form.attr('target', 'nomotv');

				var token = $("<input type='hidden' id='token' name='token' value='"+v_token+"'>");
				var aspCode = $("<input type='hidden' id='aspCode' name='aspCode' value='"+v_aspCode+"'>");
				
				form.append(token);
				form.append(aspCode);

				window.open('', 'nomotv');
				
				$(document.body).append(form);
				form.submit();
			}

		}
	}

</script>

<style>
.modal_pop_title2{ background-color:#303032; }
#modal_close_btn{ width:25px; height:25px; margin-top:5px; }
#fulltv_logo{ position:absolute; width:25%; top:15px; left:5%; }
#fulltv_title{ position:absolute; top:14px; left:32%; font-size:1.0em; }

.fulltv_con_1{ position:relative; width:100%; }
.fulltv_con_1 .box_1{ position:relative; width:100%; text-align:center; padding:20px 0 20px 0; }
.fulltv_con_1 .box_2{ position:relative; width:90%; margin:auto; background-color:#E7F3FF; border-radius:10px; text-align:center; padding:20px 0 20px 0; font-size:1.3em; line-height:25px; }
.fulltv_con_1 .box_2 b{ font-size:1.1em; color:#F1387B; }
.fulltv_con_1 .box_3{ position:relative; width:90%; height:40px; margin:auto; padding:20px 0 20px 0; }
.fulltv_con_1 .box_3 div:nth-child(1){ position:relative; width:45%; height:40px; float:left; border-radius:4px; background-color:#DB2452; font-size:1.3em; text-align:center; font-weight:bold; line-height:40px; color:#FFF; cursor:pointer; }
.fulltv_con_1 .box_3 div:nth-child(2){ border:solid 1px #DB2452; position:relative; width:45%; height:40px; float:right; border-radius:4px; box-sizing:border-box; font-size:1.3em; text-align:center; font-weight:bold; line-height:40px; color:#DB2452; cursor:pointer; }

.fulltv_con_2{ position:relative; width:100%; }
.fulltv_con_2 .box_1{ position:relative; width:90%; margin:auto; padding:20px 0 20px 0; }
.fulltv_con_2 .box_1 div{ position:relative; width:100%; height:80px; text-align:center; background-color:#E7F3FF; border-radius:10px; padding:20px 0 20px 0; font-weight:bold; font-size:1.3em; line-height:30px; }
.fulltv_con_2 .box_1 div b{ font-size:1.0em; color:#DB2452; }
.fulltv_con_2 .box_2{ position:relative; width:90%; margin:auto; padding:10px 0 20px 0; }
.fulltv_con_2 .box_2 div{ position:relative; width:50%; height:40px; margin:auto; text-align:center; background-color:#DB2452; color:#FFF; font-size:1.3em; line-height:40px; font-weight:bold; border-radius:4px; cursor:pointer; }

@media all and (max-width:320px){
#fulltv_title{ font-size:0.9em; }
.fulltv_con_1 .box_1{ padding:10px 0 10px 0; }
.fulltv_con_1 .box_1 img{ width:40%; }
.fulltv_con_1 .box_2{ font-size:1.1em; line-height:20px; }
.fulltv_con_1 .box_2 b{ font-size:0.9em; }
.fulltv_con_1 .box_3{ padding:10px 0 10px 0; }
}

@media all and (min-width:321px) and (max-width:400px){
	
}

@media all and (min-width:360px) and (max-width:399px){
.fulltv_con_1 .box_2{ font-size:1.2em; }
.fulltv_con_1 .box_2 b{ font-size:1.0em; }
}

@media all and (min-width:400px) and (max-width:429px){		

	
}

@media all and (min-width:430px) and (max-width:599px){

}

@media all and (min-width:480px) and (max-width:599px){

}

@media all and (min-width:540px) and (max-width:599px){

}

@media all and (min-width:600px){
	
}

@media all and (min-width:650px){

}

@media all and (min-width:700px){

} 

</style>
