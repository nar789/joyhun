// 친구등록 AJAX 레이어 팝업 호출
function friend_request(user_id)
{
	$.get('/friend/friend_add/friend_popup/user_id/'+user_id+'/'+Math.random(), function(data){
		if(data == "exit"){
			alert("회원 본인을 친구로 등록할수 없습니다.");
			return;
		}else if(data == "900"){
			alert("로그인 후 이용가능합니다.");
			$(location).attr("href", "/auth/login");
		}else if(data == "909"){
			alert('정회원 가입후 사용이 가능합니다.');
			location.href='/profile/point/point_charge';
			return;
		}else{
			modal.open({content: data,width : 280});
		}		
	});
}

// 친구등록 AJAX 레이어 팝업 호출 (닉네임방식, 그룹, 메모)
function friend_request_nick(user_nick,group,memo)
{
	$.get('/friend/friend_add/friend_popup/user_nick/'+user_nick+'/group/'+group+'/memo/'+memo+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}

// 그룹등록 AJAX 레이어 팝업 호출
function group_request(user_id)
{
	$.get('/friend/friend_add/group_popup/user_id/'+user_id+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}

// 나쁜친구 등록하기 AJAX 레이어 팝업 호출
function bad_friend_request(user_id)
{
	$.get('/friend/friend_add/bad_friend_popup/user_id/'+user_id+'/'+Math.random(), function(data){

		if(data == "exit"){
			alert("회원 본인을 나쁜친구로 등록할수 없습니다.");
			return;
		}else if(data == "900"){
			alert("로그인후 이용가능합니다.");
			$(location).attr("href", "/auth/login");
		}else{
			modal.open({content: data,width : 280});
		}
	});
}

// 앤되기 팝업창
function anne_request(user_id)
{
	$.get('/friend/anne_add/anne_popup/user_id/'+user_id+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}


//프로포즈 하기 레이어팝업
function propose_reuqest(m_userid, m_type){

	if (m_type == '재혼'){
		m_url = '/open_marry/remarriage/check_remarriage';
		m_type = m_type+"신청";
	}else if (m_type == '결혼'){
		m_url = '/open_marry/marriage/check_marriage';
		m_type = m_type+"신청";
	}else if (m_type == '공개구혼'){
		m_url = '/open_marry/marriage/check_guhon';
	}

	$.ajax({

		type : "post",
		url : m_url,
		data : {
			m_type   : m_type,
			m_userid : m_userid
		},
		cache : false,
		async : false,
		success : function(result){
			// 등록했으면 팝업오픈

			if (result == '1'){
				$.get('/open_marry/marriage/propose_request_popup/m_userid/'+encodeURIComponent(m_userid)+"/m_type/"+encodeURIComponent(m_type)+'/'+Math.random(), function(data){
					modal.open({content: data, width : 280});
				});
			// 안했으면 경고창
			}else if(result == 'error'){
				alert("동성에게 프로포즈는 불가능합니다.");
				return false;
			}else if(result == 'error_2'){
				alert("자신에게 프로포즈는 불가능합니다.");
				return false;
			}else{
				alert("먼저 "+m_type+"을 등록해 주세요.");
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
}




// 고객상담문의하기 팝업
function qna_add(){

	$.ajax({

		type : "post",
		url : "/service_center/main/check_qna",
		data : {
		},
		cache : false,
		async : false,
		success : function(result){
			$.get('/service_center/main/qna_popup/'+Math.random(), function(data){
				modal.open({content: data,width : 460});
			});
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}

// 광고, 사업제휴 문의하기 팝업
function business_add(cate){
	$.get('/service_center/main/business_popup/cate/'+cate+'/'+Math.random(), function(data){
		modal.open({content: data,width : 460});
	});
}

//프로필보기
function view_profile(user_id){

	location.href="/profile/main/user/user_id/"+user_id;

}

//찜하기
function jjim_request(user_id){

	$.get('/profile/jjim/jjim_add_popup/user_id/'+user_id+'/'+Math.random(), function(data){
		if(data == "exit"){
			alert("본인에게 찜하기는 불가능합니다.");
			return;
		}else if(data == "error"){
			alert("동성에게 찜하기는 불가능합니다.");
			return;
		}else{
			modal.open({content: data,width : 280});
		}		
	});
}

//번개팅 요청 레이어팝업 띄우기
function b_request(idx){
	$.get('/meeting/beongae/request_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}

//번개팅 상세보기 팝업
function b_datail_request(idx){
	$.get('/meeting/beongae/detail_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 460});
	});
}


// 내정보관리 > 비밀번호 찾기 팝업
function search_pw(){
	$.get('/profile/my_info/search_pw/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});
}

//충전하기 버튼클릭
function point_add(){
	$.get('/profile/point/point_add_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 520, top:80});
	});

}


//무통장입금 버튼클릭
function mu_account_deposit(mode, code){
	$.get('/profile/point/mu_account_deposit/mode/'+mode+'/code/'+code+'/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});

}

//무통장입금 결과
function mu_account_deposit_result(tid){
	$.get('/profile/point/mu_account_deposit_result/tid/'+tid+'/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});

}

//이상형 설정하기 레이어팝업
function m_reason_layer_popup(){
	$.get('/main/register_ok_popup', function(data){
		modal.open({content: data,width : 560});
	});
}

//포인트 결제 결과 페이지 팝업
function payment_popup(para, mode){
	
	var mode = mode;
	var para = para;

	var strArray = para.split('|');
	
	if(strArray.length == "4"){
		//결제방법이 가상계좌일경우
		var strCode = strArray[0].split('=');
		var strGb	= strArray[1].split('=');
		var strBK	= strArray[2].split('=');
		var strAC	= strArray[3].split('=');

		var code		= strCode[1];			//상품코드
		var pay_gb		= strGb[1];				//결제방법
		var bk_code		= strBK[1];				//은행코드
		var account_no	= strAC[1];				//가상계좌

		var v_url = '/etc/mobilians_'+mode+'/pay_result/code/'+code+'/pay_gb/'+pay_gb+'/bk_code/'+bk_code+"/account_no/"+account_no+'/';

	}else{
		//나머지결제
		var strCode = strArray[0].split('=');
		var strGb	= strArray[1].split('=');

		var code = strCode[1];			//상품코드
		var pay_gb = strGb[1];			//결제방법
		
		var v_url = '/etc/mobilians_'+mode+'/pay_result/code/'+code+'/pay_gb/'+pay_gb+'/';
	}
	
	$.get(v_url+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});

}

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


//휴대전화 본인인증 팝업
//비회원일경우 사용
function reg_phone_chk(mode, userid){
	
	if(userid == ""){
		alert("로그인후 인증 받으시기 바랍니다.");
		return;
	}
	phone_pop(mode, userid);
}


//결제창(임시)
//mode - hp:휴대폰결제, card:신용카드, bk:가상계좌...
//code - 상품코드
function do_payment(mode, code){
	var w = 430;
	var h = 500;

	var res_w = ( screen.availWidth - w ) / 2;
	var res_h = ( screen.availHeight - h ) / 2;
			
	var popUrl = "/etc/payment_start/pay_start/mode/"+mode+"/code/"+code;
	var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=yes, status=no;";  
	var PAY_window = window.open(popUrl, "payment_phone" ,popOption);	

}


//결제완료 결과 팝업
function result_pop(para, mode){
	opener.parent.payment_popup(para, mode);
	//location.href = "https://ipns.kr/pns/service_info?site_code=S222&ctg_code=3&sub_code=1";		//간편로그인팝업
	window.close();		
}


// 처벌 레이어 팝업
function complaint_alrim(user_id,card)
{
	$(document).ready(function(){  
		$.get('/service_center/joy_police/complaint_popup/user_id/'+user_id+'/card/'+card+'/'+Math.random(), function(data){
			modal.open({content: data,width : 460});
		});
	}); 
}

// 신고하기 레이어 팝업
function complain_request(user_id,width_device,recv_mb)
{	
	$.get('/service_center/joy_police/complain_popup/user_id/'+user_id+'/recv_mb/'+recv_mb+'/'+Math.random(), function(data){
		modal.open({content: data,width : width_device});
	});
}

// 신고하기 메세지값 가져가기 팝업 ( 불량자아이디, width, 불량자닉네임, 메세지idx)
function complain_request_mes(user_id,width_device,recv_mb,mes_idx)
{	
	$.get('/service_center/joy_police/complain_popup/user_id/'+user_id+'/recv_mb/'+recv_mb+'/mes_idx/'+mes_idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : width_device});
	});
}


// 휴면계정 > 이메일 인증
function my_email_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_email_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});
}

// 휴면계정 > 가입시 등록한 휴대폰 인증
function my_join_phone_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_join_hpone_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});
}


// 휴면계정 > 본인명의 휴대폰 인증
function my_phone_request()
{
	if ($("#dor_chk").val() == 'check_ok'){
		alert("이미 인증하셨습니다.");
		return false;
	}

	$.get('/etc/dormancy/my_phone_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});
}

// 음악채팅 입장하기 레이어 팝업
function go_music_chat()
{
	$.get('/chatting/music_chatting/go_music_chatting/'+Math.random(), function(data){
		modal.open({content: data,width : 700});
	});

}

function go_music_chat2()
{
	$.get('/chatting/music_chatting/go_music_chatting2/'+Math.random(), function(data){
		modal.open({content: data,width : 700});
	});

}


// 5분거리 팝업
function minutes5()
{
	$.get('/etc/popups/minutes5/'+Math.random(), function(data){
		modal.open({content: data,width : 400});
	});

}

// 이상형접속 팝업
function ideal_type()
{
	$.get('/etc/popups/ideal_type/'+Math.random(), function(data){
		modal.open({content: data,width : 430});
	});

}

// 문자팅 팝업
function munjating()
{
	$.get('/etc/popups/munjating/'+Math.random(), function(data){
		modal.open({content: data,width : 410});
	});

}

// 문자팅 팝업
function message()
{
	$.get('/etc/popups/message/'+Math.random(), function(data){
		modal.open({content: data,width : 260});
	});

}

// 번개팅 팝업
function beongaeting()
{
	$.get('/etc/popups/beongaeting/'+Math.random(), function(data){
		modal.open({content: data,width : 420});
	});

}

// 문자팅 팝업
function special_meeting()
{
	$.get('/etc/popups/special_meeting/'+Math.random(), function(data){
		modal.open({content: data,width : 420});
	});

}


//음악채팅 레이어 팝업
function music_chatting_pop(user_id){

	$.get('/chatting/music_chatting/music_chat_layer/user_id/'+user_id+'/'+Math.random(), function(data){
		modal.open({content:data, width:460});
	});

}

//음악채팅 시작하기
function music_chat_run(){

	alert('음악채팅 서비스는 점검중입니다.\n빠른시일내에 찾아뵐수 있도록하겠습니다');
	return;
	//modal.close();

//점검중
//	var $iFrm = $('<IFRAME id="iFrm" frameBorder="0" name="iFrm" scrolling="no" class="music_frame"></IFRAME>');
//	$iFrm.appendTo('body');
//
//	url="/chatting/music_chatting/iframe_music_chat";
//	document.getElementById("iFrm").src = url;

}

//메세지보내기 및 메세지답장하기 레이어팝업
function send_message(user_id, gubn, idx){

	var v_url = "";

	if(idx){
		v_url = '/profile/message/send_message_layer/user_id/'+user_id+'/gubn/'+gubn+'/idx/'+idx+'/';
	}else{
		v_url = '/profile/message/send_message_layer/user_id/'+user_id+'/gubn/'+gubn+'/';
	}

	$.get(v_url+Math.random(), function(data){
		modal.open({content:data, width:460});
	});

}




//정회원 결제 변경함수
function f_do_payment(mode){

	if($("input[name='pay_dot']").is(":checked") == false){
		alert("결제하실 상품을 선택하세요.");
		return;
	}else{
	
		var v_code = $("input[name='pay_dot']:checked").val();

		if(mode == "mu"){
			mu_account_deposit(mode, v_code);
		}else{
			do_payment(mode, v_code);	
		}
		
	}
	
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

//관리자에게 인증요청하기
function manager_request()
{
	$.get('/etc/popups/manager_request/'+Math.random(), function(data){
		modal.open({content: data,width : 480});
	});

}



