/****************************** MOBILE ******************************/

//휴대전화 본인인증
//mode 1 비회원, 2회원
//결제 페이지 등록때문에 파라미터 코드 사용
function phone_pop(mode, userid){
	
	var w = 430;
    var h = 500;

	var res_w = ( screen.availWidth - w ) / 2;
    var res_h = ( screen.availHeight - h ) / 2;
		
	var popUrl = "/etc/hp_cert/phone_pop?mode="+mode+"&userid="+userid;
	var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  
	var CBA_window = window.open(popUrl,"phone_chk",popOption);	
		

	CBA_window.addEventListener('loadstart', function(event) {
		 if (event.url.match("app/close")) {
			 CBA_window.close();
			 location.href = "/";
		 }
	 }); 


	if(CBA_window == null){ 
		alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
    }
	
}


//앱용 휴대전화 본인인증
//mode 1 비회원, 2회원
//결제 페이지 등록때문에 파라미터 코드 사용
function reg_phone_chk_app(mode, userid){

	var popUrl = "/etc/hp_cert/phone_pop?mode="+mode+"&userid="+userid;

	var ref = cordova.InAppBrowser.open(popUrl, '_blank', 'location=yes');

}


//휴대전화 본인인증 팝업
//비회원일경우 사용
function reg_phone_chk(mode, userid){
	
	if(userid == ""){
		alert("로그인후 인증 받으시기 바랍니다.");
		return;
	}
	phone_pop(mode, userid);
}


//모바일 포인트 결제 결과 페이지 팝업
function payment_popup(para, mode){
	
	var mode = mode;
	var para = para;

	if(mode == "hp"){
		var pay_gb = "HP";		
	}else if(mode == "card"){
		var pay_gb = "CD";
	}	

	var v_url = '/etc/mobilians_hp/pay_result/code/'+para+'/pay_gb/'+pay_gb+'/';

	$.get(v_url+Math.random(), function(data){
		
		modal.open({content: data,width : layer_pop_width($(window).width()), top:15});
		
		$("#back_url").css("width", "100%");
		$("#pay_result_btn").attr("onclick", null);
		$("#pay_result_btn").on("click", function(){
			$(location).attr("href", "/profile/point/point_list");
		});

	});

}


//포인트 결제완료이벤트
function result_pop(para, mode){

	var mode = mode;
	var para = para;

	var strArray = para.split('|');

	var strCode = strArray[0].split('=');
	
	$(location).attr("href", "/profile/point/point_list/code/"+strCode[1]+"/mode/"+mode);
}


//무통장입금 버튼클릭
function mu_account_deposit(mode, code){
	$.get('/profile/point/mu_account_deposit/mode/'+mode+'/code/'+code+'/'+Math.random(), function(data){
		modal.open({content: data,width : layer_pop_width($(window).width()), top:15});
	});

}

//무통장입금 결과
function mu_account_deposit_result(tid){
	$.get('/profile/point/mu_account_deposit_result/tid/'+tid+'/'+Math.random(), function(data){
		modal.open({content: data,width : layer_pop_width($(window).width()), top:15});
	});

}


// 처벌 레이어 팝업 (MOBILE용)
function complaint_alrim_mobile(user_id,card)
{
	$.get('/service_center/joy_police/complaint_popup_mobile/user_id/'+user_id+'/card/'+card+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280, top:15});
	});

}



// 모바일 휴대폰인증 일대일문의하기 레이어 팝업
function complain_request(mode)
{
	$.get('/service_center/main/cert_popup/mode/'+mode+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280, top:15});
	});
}


//본인인증(페이레터)
function name_check(){
		
	var w = 430;
	var h = 500;

	var res_w = ( screen.availWidth - w ) / 2;
	var res_h = ( screen.availHeight - h ) / 2;

	var popUrl = "/etc/name_check/name_check_request";
	var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  
	var CBA_window = window.open(popUrl,"phone_chk",popOption);	

	CBA_window.addEventListener('loadstart', function(event) {
		 if (event.url.match("app/close")) {
			 CBA_window.close();
			 location.href = "/";
		 }
	 }); 

	if(CBA_window == null){ 
		alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
	}


}



//풀티비 레이어팝업
function fulltv_pop_layer(mode){

	var layer_max_width = 400;
	if($(window).width() <= layer_max_width){
		layer_max_width = ($(window).width()/10)*9;
	}

	var pop_url = "";
	$.ajax({
		type : "post",
		url : "/m/m_popup/fulltv_layer",
		data : {
			"mode" : mode
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1000"){
				alert('잘못된 접근입니다.');
				return;
			}else if(result == "9999"){
				
				$.ajax({
					type : "post",
					url : "/m/m_popup/fulltv_login_ajax",
					data : {
					},
					cache : false,
					async : false,
					success : function(result2){
						if(result2 == "1000"){
							alert("잘못된 접근입니다.");
							return;
						}else{
							var obj = JSON.parse(result2);

							v_token = obj.token;
							v_aspCode = obj.aspCode;
							pop_url = obj.popurl;
						}						
					},
					error : function(result2){
						alert("실패 ("+ result2 +")");
					}

				});

			}else{
				modal2.open({content: result, width:layer_max_width, top:30});
			}	

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}
	});

	//팝업열기
	if(pop_url != ""){

		var form = $('<form></form>');
		form.attr('id', 'fulltv_frm');
		form.attr('name', 'fulltv_frm');
		form.attr('action', pop_url);
		form.attr('method', 'post');
		form.attr('target', 'fulltv');

		var token = $("<input type='hidden' id='token' name='token' value='"+v_token+"'>");
		var aspCode = $("<input type='hidden' id='aspCode' name='aspCode' value='"+v_aspCode+"'>");
		
		form.append(token);
		form.append(aspCode);

		window.open('', 'fulltv');
		
		$(document.body).append(form);
		form.submit();
	
	}

}



//노모티비 레이어팝업
function nomotv_pop_layer(mode){

	var layer_max_width = 400;
	if($(window).width() <= layer_max_width){
		layer_max_width = ($(window).width()/10)*9;
	}

	var pop_url = "";
	$.ajax({
		type : "post",
		url : "/m/m_popup/nomotv_layer",
		data : {
			"mode" : mode
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1000"){
				alert('잘못된 접근입니다.');
				return;
			}else if(result == "9999"){
	
				$.ajax({
					type : "post",
					url : "/m/m_popup/nomotv_login_ajax",
					data : {
					},
					cache : false,
					async : false,
					success : function(result2){
						if(result2 == "1000"){
							alert("잘못된 접근입니다.");
							return;
						}else{
							var obj = JSON.parse(result2);

							v_token = obj.token;
							v_aspCode = obj.aspCode;
							pop_url = obj.popurl;
						}						
					},
					error : function(result2){
						alert("실패 ("+ result2 +")");
					}

				});

			}else{
				modal2.open({content: result, width:layer_max_width, top:30});
			}	

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}
	});

	//팝업열기
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
