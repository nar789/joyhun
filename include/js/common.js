/**
 * PC/모바일 겸용 유틸리티 스트립트 함수
 */


/*		##	시작페이지로	##		*/
function bookmark(url, title) {

	var agent = navigator.userAgent.toLowerCase();

	// 익스ver문제로 수정했음 ∴IE11 과 IE10이하도 가능, IE12ver 나오면 agent값확인하여 대응하기 //
	if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
		window.external.AddFavorite(url, title);
	}
	// Google Chrome
	else if(window.chrome){
		alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.\n\n");
	}
	// Firefox
	else if (window.sidebar) // firefox  // sidebar 가 활성화돼있어야함.
	{
		window.sidebar.addPanel(title, url, "");
	}
	// Opera
	else if(window.opera && window.print)
	{
		// opera
		var elem = document.createElement('a');
		elem.setAttribute('href',url);
		elem.setAttribute('title',title);
		elem.setAttribute('rel','sidebar');
		elem.click();
	}
}
/*		##	시작페이지로 end	##		*/



//메인화면 로그인폼
var login_ing = false;
function login_js(){

	$("input[name=login]").val($("input[name=login]").val().toLowerCase());

	if(login_ing == true){
		alert("로그인중입니다. 잠시만 기다려주십시오.");
		return false;
	}
	if($("#login").val() == ""){
		alert("아이디를 입력해주세요.");
		$("#login").focus();
		return false;
	}else if($("#password").val() == ""){
		alert("비밀번호를 입력해주세요.");
		$("#password").focus();
		return false;
	}
		login_ing =true;
		return true;
}

//로그인폼 회원가입/비밀번호찾기 버튼
$(document).ready(function(){  
	$("#member_join_btn").click(function(){
		window.location.href='https://www.joyhunting.com/auth/register/';
	});
	$("#find_pw_btn").click(function(){
		search_pw(); //popups.js
	});
	$("#logout_btn").click(function(){
		window.location.href='/auth/logout/';
	});
}); 



/*********** 5분거리 접속이성 찾기 start**********/

var name_서울 = new Array('- 선택 -','강남구','강동구','강북구','강서구','관악구','광진구','구로구','금천구','노원구','도봉구','동대문구','동작구','마포구','서대문구','서초구','성동구','성북구','송파구','양천구','영등포구','용산구','은평구','종로구','중구','중랑구'); 
var code_서울 = new Array('','강남구','강동구','강북구','강서구','관악구','광진구','구로구','금천구','노원구','도봉구','동대문구','동작구','마포구','서대문구','서초구','성동구','성북구','송파구','양천구','영등포구','용산구','은평구','종로구','중구','중랑구'); 
 
var name_인천 = new Array('- 선택 -','강화군','계양구','남구','남동구','동구','부평구','서구','연수구','옹진군','중구'); 
var code_인천 = new Array('','강화군','계양구','남구','남동구','동구','부평구','서구','연수구','옹진군','중구'); 
 
var name_부산 = new Array('- 선택 -','강서구','금정구','기장군','남구','동구','동래구','부산진구','북구','사상구','사하구','서구','수영구','연제구','영도구','중구','해운대구'); 
var code_부산 = new Array('','강서구','금정구','기장군','남구','동구','동래구','부산진구','북구','사상구','사하구','서구','수영구','연제구','영도구','중구','해운대구'); 
 
var name_대구 = new Array('- 선택 -','남구','달서구','달성군','동구','북구','서구','수성구','중구'); 
var code_대구 = new Array('','남구','달서구','달성군','동구','북구','서구','수성구','중구'); 
 
var name_대전 = new Array('- 선택 -','대덕구','동구','서구','유성구','중구'); 
var code_대전 = new Array('','대덕구','동구','서구','유성구','중구'); 
 
var name_광주 = new Array('- 선택 -','광산구','남구','동구','북구','서구'); 
var code_광주 = new Array('','광산구','남구','동구','북구','서구'); 
 
var name_울산 = new Array('- 선택 -','남구','동구','북구','울주군','중구'); 
var code_울산 = new Array('','남구','동구','북구','울주군','중구'); 
 
var name_경기 = new Array('- 선택 -','가평군','고양시','과천시','광명시','광주시','구리시','군포시','김포시','남양주시','동두천시','부천시','성남시','수원시','시흥시','안산시','안성시','안양시','양주시','양평군','여주군','연천군','오산시','용인시','의왕시','의정부시','이천시','파주시','평택시','포천시','하남시','화성시'); 
var code_경기 = new Array('','가평군','고양시','과천시','광명시','광주시','구리시','군포시','김포시','남양주시','동두천시','부천시','성남시','수원시','시흥시','안산시','안성시','안양시','양주시','양평군','여주군','연천군','오산시','용인시','의왕시','의정부시','이천시','파주시','평택시','포천시','하남시','화성시'); 
 
var name_강원 = new Array('- 선택 -','강릉시','고성군','동해시','삼척시','속초시','양구군','양양군','영월군','원주시','인제군','정선군','철원군','춘천시','태백시','평창군','홍천군','화천군','횡성군'); 
var code_강원 = new Array('','강릉시','고성군','동해시','삼척시','속초시','양구군','양양군','영월군','원주시','인제군','정선군','철원군','춘천시','태백시','평창군','홍천군','화천군','횡성군'); 

var name_충남 = new Array('- 선택 -','계룡시','공주시','금산군','논산시','당진군','보령시','부여군','서산시','서천군','아산시','연기군','예산군','천안시','청양군','태안군','홍성군'); 
var code_충남 = new Array('','계룡시','공주시','금산군','논산시','당진군','보령시','부여군','서산시','서천군','아산시','연기군','예산군','천안시','청양군','태안군','홍성군'); 
 
var name_충북 = new Array('- 선택 -','괴산군','단양군','보은군','영동군','옥천군','음성군','제천시','증평군','진천군','청주시','충주시'); 
var code_충북 = new Array('','괴산군','단양군','보은군','영동군','옥천군','음성군','제천시','증평군','진천군','청주시','충주시'); 
 
var name_경남 = new Array('- 선택 -','거제시','거창군','고성군','김해시','남해군','마산시','밀양시','사천시','산청군','양산시','의령군','진주시','진해시','창녕군','창원시','통영시','하동군','함안군','함양군','합천군'); 
var code_경남 = new Array('','거제시','거창군','고성군','김해시','남해군','마산시','밀양시','사천시','산청군','양산시','의령군','진주시','진해시','창녕군','창원시','통영시','하동군','함안군','함양군','합천군'); 
 
var name_경북 = new Array('- 선택 -','경산시','경주시','고령군','구미시','군위군','김천시','문경시','봉화군','상주시','성주군','안동시','영덕군','영양군','영주시','영천시','예천군','울릉군','울진군','의성군','청도군','청송군','칠곡군','포항시'); 
var code_경북 = new Array('','경산시','경주시','고령군','구미시','군위군','김천시','문경시','봉화군','상주시','성주군','안동시','영덕군','영양군','영주시','영천시','예천군','울릉군','울진군','의성군','청도군','청송군','칠곡군','포항시'); 
 
var name_전남 = new Array('- 선택 -','강진군','고흥군','곡성군','광양시','구례군','나주시','담양군','목포시','무안군','보성군','순천시','신안군','여수시','영광군','영암군','완도군','장성군','장흥군','진도군','함평군','해남군','화순군'); 
var code_전남 = new Array('','강진군','고흥군','곡성군','광양시','구례군','나주시','담양군','목포시','무안군','보성군','순천시','신안군','여수시','영광군','영암군','완도군','장성군','장흥군','진도군','함평군','해남군','화순군'); 
 
var name_전북 = new Array('- 선택 -','고창군','군산시','김제시','남원시','무주군','부안군','순창군','완주군','익산시','임실군','장수군','전주시','정읍시','진안군'); 
var code_전북 = new Array('','고창군','군산시','김제시','남원시','무주군','부안군','순창군','완주군','익산시','임실군','장수군','전주시','정읍시','진안군'); 
 
var name_제주 = new Array('- 선택 -','서귀포시','제주시'); 
var code_제주 = new Array('','서귀포시','제주시'); 

var name_세종 = new Array('- 선택 -','반곡동', '소담동', '보람동', '대평동', '가람동', '한솔동', '나성동', '새롬동', '다정동', '어진동', '종촌동', '고운동', '아름동', '도담동', '조치원읍', '연기면', '연동면', '부강면', '금남면', '장군면', '연서면', '전의면', '전동면', '소정면'); 
var code_세종 = new Array('','반곡동', '소담동', '보람동', '대평동', '가람동', '한솔동', '나성동', '새롬동', '다정동', '어진동', '종촌동', '고운동', '아름동', '도담동', '조치원읍', '연기면', '연동면', '부강면', '금남면', '장군면', '연서면', '전의면', '전동면', '소정면');

 
 function area_select(sel1_val,sel2){ 

	if(sel1_val == '') { 
		for(i=sel.length-1; i>=0; i--) 
		sel.options[i] = null; 
		sel.options[0] = new Option('- 선택 -',''); 
		return; 
	} 

	sel = document.getElementById(sel2); 
	var lis = eval('name_'+ sel1_val); 
	var val = eval('code_'+ sel1_val); 
	 
	for(i=sel.length-1; i>=0; i--) 
		sel.options[i] = null; 
		sel.options[0] = new Option(lis[0],val[0], '', 'true'); 
		for(i=1; i<lis.length; i++){ 
			sel.options[i] = new Option(lis[i],val[i]); 
	} 
} 

/*********** 5분거리 접속이성 end **********/



//텍스트 에어리어에 maxlength 효과주기
function textarea_maxlength(obj){ 
	var maxLength = parseInt(obj.getAttribute("maxlength")); 
	if((obj.value.length+1)>maxLength) { 
		alert('글자수가 '+(obj.value.length)+'자 이내로 제한됩니다'); 
		obj.value=obj.value.substring(0,maxLength); 
	} 
}


//체크박스 전체삭제 버튼 스트립트 공통사용
function check_del(){
	check_item = document.getElementsByName("check_item[]");
	cnt = 0;
	for(i=0;i<check_item.length;i++){
		if(check_item[i].checked == true){
			cnt++;
		}
	}

	if(cnt ==0){alert("삭제하실 게시물의 체크박스를 한개이상 선택해 주십시오.");}
	else if(confirm("정말 삭제하시겠습니까?")){
		check_form.submit();
	}
}


//체크박스 전체선택 버튼 스트립트 공통사용
var checkflag = "false";
function check_all() {
	check_item = document.getElementsByName("check_item[]");
	if (checkflag == "false") {
		for(i=0;i<check_item.length;i++){
			check_item[i].checked = true;
		}
		checkflag = "true";
		return "전체해제";
	} else {
		for(i=0;i<check_item.length;i++){
			check_item[i].checked = false;
		}
		checkflag = "false";
		return "전체선택"; 
	}
}



// 하단 알림창
/* 마우스오버 X버튼 */

$(document).ready(function(){

	var exit_btn = document.querySelectorAll("alarm_exit_btn");
	
	$("div.alarm_content_area").hover(function() {
		$(this).find(exit_btn).css("display", "block");
	},function(){
		$(this).find(exit_btn).css("display", "none");
	});

	$("div.alarm_content_area2").hover(function() {
		$(this).find(exit_btn).css("display", "block");
	},function(){
		$(this).find(exit_btn).css("display", "none");
	});

});


//문자열 자르고 ... 붙여주기
function cutStr(str, limit){
	 
	var strLength = 0;
	var strTitle = "";
	var strPiece = "";
	 
	for (i = 0; i < str.length; i++){
		var code = str.charCodeAt(i);
		var ch = str.substr(i,1).toUpperCase();
		//체크 하는 문자를 저장
		strPiece = str.substr(i,1)
		 
		code = parseInt(code);
		 
		if ((ch < "0" || ch > "9") && (ch < "A" || ch > "Z") && ((code > 255) || (code < 0))){
			strLength = strLength + 3; //UTF-8 3byte 로 계산
		}else{
			strLength = strLength + 1;
		}
		 
		if(strLength>limit){ //제한 길이 확인
			strTitle = strTitle + "...";
			break;
		}else{
			strTitle = strTitle+strPiece; //제한길이 보다 작으면 자른 문자를 붙여준다.
		}
		 
	}
	 
	return strTitle;
}
 



//쿠키 가져오기
 function getCookie( cookieName )
 {
	var search = cookieName + "=";
	var cookie = document.cookie;

	if( cookie.length > 0 )
	{
		startIndex = cookie.indexOf( cookieName );

		if( startIndex != -1 )
		{
			startIndex += cookieName.length;

			endIndex = cookie.indexOf( ";", startIndex );

			if( endIndex == -1) endIndex = cookie.length;

				return unescape( cookie.substring( startIndex + 1, endIndex ) );
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
 }

//쿠키 굽기
function setCookie( cookieName, cookieValue, expireDate )
{
	var today = new Date();
	var domain = document.domain;
	domain = domain.replace("m.","");

	today.setDate( today.getDate() + parseInt( expireDate ) );
	document.cookie = cookieName + "=" + escape( cookieValue ) + "; path=/; expires=" + today.toGMTString() + "; domain=."+ domain +";";
}


//쿠키 삭제
function deleteCookie(cookieName){
  var expireDate = new Date();
  //어제 날짜를 쿠키 소멸 날짜로 설정한다.
  expireDate.setDate( expireDate.getDate() - 1 );
  document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString() + "; path=/";
}


	


//자동링크 문자열 자르기
function stripTrailingSlash(str,pos) {
	if(str.substr(-1) == '/') {
		return str.substr(0, str.length - 1);
	}

	var tmp = str.split("/");
	var new_str = "";
	for(i=1;i<tmp.length-pos;i++){
		if(i < 4){
			new_str = new_str + "/"+ tmp[i];
		}
	}

	return new_str;
}


//자동링크 문자열 자르기
function stripTrailingSlash3dep(str,pos) {

	var tmp = str.split("/");
	var new_str = "";
	for(i=1;i<tmp.length-pos;i++){
		if(i < 3){
			new_str = new_str + "/"+ tmp[i];
		}
	}

	return new_str;

}



//모바일 / PC모드 변환
function set_mode(mode){
		//쿠키 구워서 새로고침.
		if(mode == "pc" ){
			setCookie("pc_mode_cookie", "pc", 1);
			var dns = document.location.href;
			dns = dns.replace("m.","");
			location.href=dns;
		}else if(mode == "m" ){
			setCookie("pc_mode_cookie", "m", 1);
			var dns = document.location.href;
			dns = dns.replace("m.","");
			dns = dns.replace("//","//m.");
			location.href=dns;	
		}
}




//채팅 신청
function chat_submit(user_id, gubn){

	var v_gubn = "";

	if(gubn == "map"){
		v_gubn = gubn;
	}

	if($("#sin_msg").val() == ""){
		$("#sin_msg").val($("#sin_msg").attr("placeholder"));
	}
	
	if(user_id == ""){
		alert("[오류] 탈퇴된 회원이거나, 잘못된 요청입니다.");
		return;
	}

	if($("#sin_msg").val() == ""){
		alert("신청메세지를 입력해 주세요.");
		$("#sin_msg").focus();
	}else{
		result = "";
		$.ajax({
			type: "POST",
			url: "/chat/chat_request_pro",
			data: {
				"user_id": encodeURIComponent(user_id),
				"contents": encodeURIComponent($("#sin_msg").val()),
				"v_gubn" : encodeURIComponent(v_gubn)
			},	
			cache: false,
			async: false,
			success: function(result){

				if(result == "9"){
					alert('탈퇴하였거나 존재하지 않는 회원입니다.');modal.close();
				}else if(result == "1"){
					modal.close();
					//window.openChatWindow(user_id); //alrim_js.js 

					$("[id^='chatting_room_rechat_box']").hide();
					$("[id^='chatting_room_chat_box']").show();

					chat_send_alrim();	
				}else if(result == "0"){
					alert('[오류] 데이터 전송이 실패하였습니다.');modal.close();
				}else if(result == "error"){
					slide_alrim("lack_alrim", "보유하신 포인트가 부족합니다.", "2000");
				}else if(result == "10"){
					alert("이미 채팅신청한 회원입니다.\n채팅수락까지 기다려주십시요.");
					modal.close();
				}else if(result == "bad"){
					alert("상대방이 나쁜친구로 등록하셨습니다.");
					return;
				}else{
					alert(result);
				}

			},
			error : function(result){
				alert("실패 ("+result+")");
			}

		});

	}

}

//채팅신청을 보냈습니다. 알림 텍스트
function chat_send_alrim(){

	var pc_chat = $("#chat_send").length;
	var mo_chat = $("#chat_send_m").length;

	if (pc_chat > 0){
		$("#chat_send").slideDown("slow");

		setTimeout(function() {
			$("#chat_send").slideUp("slow");
		}, 1500)
	}else if (mo_chat > 0){
		$("#chat_send_m").slideDown("slow");

		setTimeout(function() {
			$("#chat_send_m").slideUp("slow");
		}, 1500)
	}

}





//채팅방 내에서 선물하기 공용함수들(PC, MOBILE 공용)
//화면 크기에 따른 레이어팝업 width값 조정
function layer_pop_width(w){
	
	if(w <= 320){
		return 300;
	}else if(w >= 360 && w <= 400){
		return 360;
	}else{
		return 400;
	}

}

//선물상점 카테고리 및 카테고리 리스트 레이어팝업 호출
function gift_shop(mode, user_id, category){
	
	if(mode == "chat"){

		//채팅 수락신청 체크
		$.get('/gift_shop/gift/use_chat_yn/user_id/'+user_id+'/'+Math.random(), function(v){

			if(v != "수락"){
				//수락대기중
				alert("채팅수락 대기중입니다.");
				return;
			}else{
				m_gift_shop_layer(mode, user_id, category);	
			}

		});

	}else{
		m_gift_shop_layer(mode, user_id, category);
	}
	
	

}

//선물상점 레이어팝업 띄우기 
function m_gift_shop_layer(mode, user_id, category){

	//진행중인 채팅
	var v_width = layer_pop_width($(window).width());

	var v_url = "";

	if(category == "shop"){
		v_url = '/gift_shop/gift/gift_shop_layer/mode/'+mode+'/user_id/'+user_id+'/';	
	}else{
		var cate = category.replace('/', '^');
		v_url = '/gift_shop/gift/gift_list_layer/mode/'+mode+'/user_id/'+user_id+'/category/'+cate+'/';
	}

	$.get(v_url+Math.random(), function(data){

		if(data == "exit"){
			//등록된 상품이 없을경우
			alert("등록된 상품이 없습니다.");
		}else{
			modal.open({content:data, width:v_width, top:30});
		}		
	});

}

// 선물 상세 보기
function gift_detail(mode, idx, user_id){

	var v_width = layer_pop_width($(window).width());

	$.get('/gift_shop/gift/gift_detail_layer/mode/'+encodeURIComponent(mode)+'/idx/'+encodeURIComponent(idx)+'/user_id/'+encodeURIComponent(user_id)+'/'+Math.random(), function(data){
		modal.open({content:data, width:v_width, top:20});
	});
}

//선물상세보기 페이지에서 선물하기 버튼 클릭 이벤트
function chk_send_gift(mode, idx, user_id){
	
	if(mode != "chat" && mode != "list" || user_id == ""){
		alert("잘못된 접근입니다.");
		return;
	}

	var v_width = layer_pop_width($(window).width());

	var v_mode		= encodeURIComponent(mode);
	var v_idx		= encodeURIComponent(idx);
	var v_user_id	= encodeURIComponent(user_id);
	
	$.get('/gift_shop/gift/send_gift_confirm/mode/'+v_mode+'/idx/'+v_idx+'/user_id/'+v_user_id+'/'+Math.random(), function(data){
		modal.open({content:data, width:v_width, top:40});
	});	

}

//선물하기 함수
function send_gift(mode, idx, user_id){
	
	if(confirm("상품을 선물하시겠습니까?") == true){

		$.ajax({

			type : "post",
			url : "/gift_shop/gift/call_send_gift_ajax", 
			data : {
				"mode"			: encodeURIComponent(mode),
				"idx"			: encodeURIComponent(idx),
				"user_id"		: encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					//상품보내기 성공
					call_get_gift_data('gift', user_id);
					alert("상품을 보냈습니다.");
					modal.close();
				}else if(result == "0"){
					//상품보내기 실패
					alert("상품을 보내는데 실패했습니다.\n다시 시도해주시기 바랍니다.");
					modal.close();
				}else if(result == "exit"){
					//잘못된접근
					alert("잘못된 접근입니다.");
					modal.close();
				}else if(result == "point"){
					//포인트부족
					if(confirm("포인트가 부족합니다.\n충전하러 가시겠습니까?") == true){
						$(location).attr('href', '/profile/point/point_list');
					}else{
						modal.close();
					}
				}else{
					//에러
					alert("실패 ("+ result +")");
				}
			},
			error : function(result){
				//에러
				alert("실패 ("+ result +")");
			}

		});

	}
	
}

//상품조르기 호출 함수
function call_chat_gift_request(mode, idx, user_id){
	
	if(confirm("해당상품을 조르기를 하시겠습니까?") == true){

		$.ajax({
			
			type : "post",
			url : "/gift_shop/gift/call_chat_gift_request",
			data : {
				"mode"			: encodeURIComponent(mode),
				"idx"			: encodeURIComponent(idx),
				"user_id"		: encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				if(result == "1"){
					alert("선물쪼르기를 하였습니다.");
					call_get_gift_data('gift_req', user_id);
					modal.close();
				}else if(result == "0"){
					alert("선물조르기에 실패했습니다.\n잠시후 다시 시도해주시기 바랍니다.\n("+ result +")");
				}else{
					alert(result);
				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}

//본인에게 선물하기 호출 함수
function send_gift_myself(mode, idx, user_id){
	
	if(confirm("본인에게 상품을 선물하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/gift_shop/gift/call_myself_send_gift_ajax",
			data : {
				"mode"			: encodeURIComponent(mode),
				"idx"			: encodeURIComponent(idx),
				"user_id"		: encodeURIComponent(user_id)
			},
			cache : false,
			acync : false,
			success : function(result){
				
				if(result == "1"){
					
					if(confirm("상품을 구매하였습니다.\n선물함으로 이동하시겠습니까?") == true){
						if(is_mobile == true){
							btn_gift_clk('recv');
						}else{
							$(location).attr("href", "/gift_shop/gift/gift_box");
						}						
					}else{
						location.reload();
					}

				}else if(result == "0"){
					alert("선물하기에 실패했씁니다.");
					location.reload();
				}else if(result == "1000"){
					alert("잘못된 접근입니다.");
					location.reload();
				}else if(result == "point"){
					if(confirm("포인트가 부족합니다.\n포인트충전페이지로 이동하시겠습니까?") == true){
						$(location).attr("href", "/profile/point/charge_list");
					}else{
						location.reload();
					}
				}else{
					alert("실패 ("+ result +")");	
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

}

//상품을 보냈을경우나 상품조르기를 할경우 자신의 채팅방 대화내역에 표시하기
function call_get_gift_data(mode, user_id){
	
	$.get('/gift_shop/gift/call_get_gift_data/mode/'+encodeURIComponent(mode)+'/user_id/'+encodeURIComponent(user_id)+'/'+Math.random(), function(data){
		
		if(data != ""){
			//나의 채팅 내용 삽입
			var now = new Date();
			reg_date = now.getHours()+" "+now.getMinutes();
					
			var datas = new Array();
			datas['idx']		= data[0];
			datas['mode']		= data[1];
			datas['contents']	= data[2];
			datas['recv_id']	= data[3];

			add_chat_send(datas, reg_date);
		}	

	});

}


//선물을 보내거나 받았을 경우 채팅창에 선물내역 표시
function call_chat_list_view(mode, idx, user_id){
	
	var add_html = "";
	var gift_success = "";
	
	$.ajax({
		
		type : "post",
		url : "/gift_shop/gift/gift_chat_send",
		data : {
			"mode"			: encodeURIComponent(mode),
			"idx"			: encodeURIComponent(idx.replace('선물(', '').replace(')', '')),
			"user_id"		: encodeURIComponent(user_id)
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1000"){
				alert("잘못된 접근입니다.");
				return;
			}else{

				gift_success = "success";

				v_mode = result[4];
					
				add_html += "<div class='gift_box_chat'>";
				add_html += "<div class='tit_1'>"+result[0]+"</div>";
				add_html += "<div class='tit_2'>"+result[1]+"</div>";
				add_html += "<div class='sub_con_1'>";
				add_html += "<div><img src='"+result[2]+"'></div>";
				add_html += "</div>";
				add_html += "<div class='sub_con_2'>";
				add_html += "<div><div class='btn_gift' onclick='javascript:btn_gift_clk(v_mode);'>"+result[3]+"</div></div>";
				add_html += "</div>";
				add_html += "</div>";

				
			}
			
		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});
	
	//선물보내기 성공했을경우 html 출력
	if(gift_success = "success"){
		return add_html;
	}	
	
}

//받은선물함 혹은 보낸선물함 클릭시 이벤트(채팅방내에서 PC, MOBILE 공통)
function btn_gift_clk(mode){

	if(is_app == "ios"){
		alert("선물상점관련은 PC버전 혹은 모바일버전에서만 가능합니다.");
		return false;
	}
	
	$.get('/gift_shop/gift/gift_box_layer/mode/'+encodeURIComponent(mode)+'/'+Math.random(), function(data){
		
		if(data == "1000"){
			alert("잘못된 접근입니다.");
			return;
		}else{
			modal.open({content:data, width:300, top:30});
		}
		
	});

}

//선물조르기를 보냈거나 받았을경우 채팅장에 선물내역 표시
function call_chat_list_view_req(mode, idx, user_id){

	var add_html = "";
	var gift_req_success = "";

	$.ajax({

		type : "post",
		url : "/gift_shop/gift/gift_req_chat_send",
		data : {
			"mode"			: encodeURIComponent(mode),
			"idx"			: encodeURIComponent(idx.replace('선물쪼르기(', '').replace(')', '')),
			"user_id"		: encodeURIComponent(user_id)
		},
		cache : false,
		async : false,
		success : function(result){

			if(result == "1000"){
				alert("잘못된 접근입니다.");
				return;
			}else{

				gift_success = "success";

				v_mode  = result[4];

				add_html += "<div class='gift_box_chat'>";
				add_html += "<div class='tit_1'>"+result[0]+"</div>";
				add_html += "<div class='tit_2'>"+result[1]+"</div>";
				add_html += "<div class='sub_con_1'>";
				add_html += "<div><img src='"+result[2]+"'></div>";
				add_html += "</div>";
				if(result[3]){
				add_html += "<div class='sub_con_2'>";
				add_html += "<div><div class='btn_gift' onclick='javascript:chk_gift_req_layer("+result[5]+");'>"+result[3]+"</div></div>";
				add_html += "</div>";
				}
				add_html += "</div>";
				
			}

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});

	//선물보내기 성공했을경우 html 출력
	if(gift_success = "success"){
		return add_html;
	}	


}


//선물받기 레이어팝업(PC, MOBILE 공통)
function gift_take_it_layer(v_idx){

	$.get('/gift_shop/gift/gift_take_it_layer/v_idx/'+encodeURIComponent(v_idx)+'/'+Math.random(), function(data){
		
		if(data == "1000"){
			//잘못된접근처리
			alert("잘못된접근입니다.");
			return;
		}else if(data == "1001"){
			//본인인증 처리
			if(confirm("선물을 받으시려면 본인인증을 하셔야 합니다.\n본인인증페이지로 이동하시겠습니까?") == true){
				$(location).attr("href", "/profile/main/user");
			}
		}else if(data == "1002"){
			//발송준비 상태
			alert("발송준비중 입니다.");
			return;
		}else if(data == "1003"){
			//발송처리 완료된 상태
			alert("이미 받으신 상품입니다.");
			return;
		}else{
			modal.open({content:data, width:300});
		}

	});

}

//선물받기 처리 함수(PC, MOBILE 공통)
function call_gift_take(v_idx){
	
	if(confirm("위의 휴대전화번호로 선물받기를 신청하시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/gift_shop/gift/call_gift_take",
			data : {
				"v_idx"		: encodeURIComponent(v_idx)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("상품발송이 신청되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("상품신청에 실패했습니다.\n잠시후 다시 시도해주시기 바랍니다. ("+ result +")");
					location.reload();
				}else{
					alert("실패 ("+ result +")");
				}

			},
			error : function(result){
				alert("실패 ("+ result +")");
			}
						
		});

	}

}

//쪼르기한 선물 보내주기 레이어팝업 호출 체크
function chk_gift_req_layer(idx){

	if(is_app == "ios"){
		alert("선물상점관련은 PC버전 혹은 모바일버전에서만 가능합니다.");
		return false;
	}
	
	var user_id = $(location).attr("pathname").replace("/chat/chatting/", "");
	chk_send_gift('chat', idx, user_id);

}

//여성전용 이벤트 선물 받기전 휴대전화번호 체크 레이어팝업 호출
function woman_event_gift_layer(){

	$.get('/service_center/event/woman_event_gift_layer/'+Math.random(), function(data){
		if(data == "1000"){
			alert("잘못된 접근입니다.");
			return;
		}else{
			modal.open({content:data, width:320});
		}		
	});

}

//여성전용 이벤트 선물 받기 함수
function woman_event_gift_send(){
	
	if(confirm("해당 휴대전화 번호로 선물을 받으시겠습니까?") == true){

		$.get('/service_center/event/call_woman_event_gift_chk/'+Math.random(), function(data){
			
			if(data == "1"){
				if(is_mobile == true){
					if(confirm("선물이 지급되었습니다.\n선물함을 확인하시겠습니까?") == true){
						btn_gift_clk('recv');
					}
				}else{
					if(confirm("선물이 지급되었습니다.\n선물함으로 이동하시겠습니까?") == true){
						$(location).attr("href", "/gift_shop/gift/gift_box");
					}
				}		

			}else if(data == "0"){
				alert("선물 지급에 실패했습니다.\n잠시후 다시 시도해 주시기 바랍니다.");
				modal.close();
				return;
			}else if(data == "1000"){
				alert("잘못된 접근입니다. ("+data+")");
				modal.close();
				return;
			}else if(data == "1001"){
				alert("오늘은 이미 선물을 받으셨습니다.");
				modal.close();
				return;
			}else if(data == "1002"){
				alert("오늘 미션을 아직 모두 성공하지 못했습니다.");
				modal.close();
				return;
			}else if(data == "1005"){
				alert("이벤트 기간내에는 총 5번의 선물만 지급됩니다.");
				modal.close();
				return;
			}else if(data == "9999"){
				alert("이미 이벤트에 참여한 휴대전화 번호 입니다.");
				modal.close();
				return;
			}else{
				alert("잘못된 접근입니다.");
				modal.close();
				return;
			}

		});

	}

}


//IP/HP차단 레이어팝업
function member_block_layer(idx){

	var v_width = "";

	if(is_mobile == true){
		v_width = ($(window).width()/10)*9;
	}else{
		v_width = "460";
	}

	$.get('/service_center/member_block/block_popup_layer/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data, width : v_width});
	});
}


//휴대전화 도용방지 팝업 띄우기
function hp_steal_pop(flg, url){

	if(flg == false){
		//pc 버전의 경우
		var w = 430;
		var h = 500;

		var res_w = ( screen.availWidth - w ) / 2;
		var res_h = ( screen.availHeight - h ) / 2;

		var popUrl = url;
		var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  

		window.open(popUrl, "steal_pop", popOption);	

	}else{
		//mobile 버전의 경우

	}	

}

//임시회원 관리자에게 인증요청하기 레이어팝업 호출
function reg_member_auth_layer_pop(){
	
	if(is_mobile == false){ v_width = "460"; }else{ v_width = "320"; }
	
	$.get('/service_center/main/reg_member_auth_layer/'+Math.random(), function(data){
		if(data == "인증대기중"){
			alert("관리자 인증대기중입니다.\n관리자 확인후 문자로 연락드리겠습니다.");
			return;
		}else if(data == "F"){
			alert('기능이 일시 중단되었습니다.\n고객센터로 문의바랍니다.');
			return;
		}else{
			modal.open({content:data, width:v_width});
		}		
	});

}

//야외데이트 이벤트 레이어팝업
function event_love_layer_pop(){
	if(is_mobile == false){ v_width = "460"; }else{ v_width = "320"; }

	$.get('/service_center/event_love/event_love_layer/'+Math.random(), function(data){
		modal.open({content:data, width : v_width});
	});
}


//복주머니 이벤트 ajax
function bags_event_btn(){
	//이미지 교체
	if(is_mobile == false){ v_width = "440"; }else{ v_width = "320"; }
	
	$.get("/event/woman_event/new_pocket_proc/"+Math.random(), function(data){
		
		$("#bag_event_img2").empty();
		$("#bag_event_img2").html("<img src='/images/bags_img_"+data[1]+".png' width='"+v_width+"'>");
		
		if(data[0] == "0"){
			alert("포인트 지급에 실패했습니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
		}else if(data[0] == "1"){
			$("#bag_event_img").html("<img src='/images/bags_img_01.gif' width='"+v_width+"'>");
			setTimeout("bags_event_timer()", 2000); // 2000ms(2초)가 경과하면 timer_test() 함수를 실행합니다			
		}else if(data[0] == "1000"){
			alert("잘못된 접근입니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
		}else if(data[0] == "1001"){
			alert("회원이 아닙니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
		}else if(data[0] == "5000"){
			alert("이번 시간엔 이미 지급되었습니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
		}else if(data[0] == "9999"){
			alert("정회원만 이용가능합니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
			$(location).attr("href", "/profile/point/point_list");
		}else{
			alert("잘못된 접근입니다.");
			$("#woman_pop").hide();
			$("#woman_pop2").hide();
		}

		
	});

}

//복주머니 팝업창 결과화면
function bags_event_timer(){
	//레이어 hide show 교체
	$("#woman_pop2").show();
	$("#woman_pop").hide();
	alert("포인트가 지급되었습니다.");
}

//복주머니 팝업창 닫기
function bags_event_btn_close(){

	$("#woman_pop").hide();
	$("#woman_pop2").hide();
	
}


//로그인창 사이트 전체 공통
$(document).ready(function() {
	/* 영어+숫자만 */
	$("input[name=login]").keyup(function(event){ 
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
	//		var inputVal = $(this).val();
	//		$(this).val(inputVal.replace(/[^a-z0-9_]/gi,''));
//			$(this).val($(this).val().toLowerCase());
		}
	});
});


//상세 사진 보기 레이어팝업 호출
function member_photo_view_pop(user_id){

	if(is_mobile == true){ var v_width = Math.round(9*($(window).width()/10)); }else{ var v_width = 580; }	
	if(v_width >= 600){ v_width = "580"; }

	$.get("/profile/main/member_photo_view_layer/user_id/"+encodeURIComponent(user_id)+"/view/"+encodeURIComponent(v_width)+"/"+Math.random(), function(data){
		if(data == "1000"){
			alert("잘못된 접근입니다.");
			return;
		}else if(data == "1001"){
			return;
			//location.href = "/profile/main/user/user_id/"+user_id;
		}else{
			modal2.open({content:data, width:v_width});
		}		
	});
}

//슬라이드 알림 함수 공용
function slide_alrim(id, text, timer){
	
	if(timer == "" || timer == undefined){ timer = 2000; }

	$("#"+id).empty();
	$("#"+id).html(text);
	$("#"+id).slideDown("500");
	setTimeout(function(){
		$("#"+id).slideUp("500");
		$(location).attr("href", "/profile/point/point_list");
	}, timer);
}


function warning_open_layer(){
/*
		warning_today3 = getCookie("warning_today3");
		if(warning_today3 == ""){

			if(is_mobile == false){ v_width = "460"; }else{ v_width = "320"; }

			$.get('/service_center/notice/warning_open_layer/'+Math.random(), function(data){
				modal.open({content:data, width : v_width});
			});

		}

*/
}

function warning_open_layer_close(){

			setCookie("warning_today3", "y", 1);
			modal.close();

}