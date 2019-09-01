


/* right_핸드폰 textarea */
(function($){
	$(window).load(function(){
		var textArea=$(".sms_textarea_scroll textarea");
		textArea.wrap("<div class='textarea-wrapper' />");
		var textAreaWrapper=textArea.parent(".textarea-wrapper");
		textAreaWrapper.mCustomScrollbar({
			scrollInertia:0,
			advanced:{autoScrollOnFocus:false}
		});
		var hiddenDiv=$(document.createElement("div")),
			textarea_scroll=null;
		hiddenDiv.addClass("hiddendiv");
		$("body").prepend(hiddenDiv);
		textArea.bind("keyup",function(e){
			textarea_scroll=$(this).val();
			var clength=textarea_scroll.length;
			var cursorPosition=textArea.getCursorPosition();
			textarea_scroll="<span>"+textarea_scroll.substr(0,cursorPosition)+"</span>"+textarea_scroll.substr(cursorPosition,textarea_scroll.length);
			textarea_scroll=textarea_scroll.replace(/\n/g,"<br />");
			hiddenDiv.html(textarea_scroll+"<br />");
			$(this).css("height",hiddenDiv.height());
			textAreaWrapper.mCustomScrollbar("update");
			var hiddenDivSpan=hiddenDiv.children("span"),
				hiddenDivSpanOffset=0,
				viewLimitBottom=(parseInt(hiddenDiv.css("min-height")))-hiddenDivSpanOffset,
				viewLimitTop=hiddenDivSpanOffset,
				viewRatio=Math.round(hiddenDivSpan.height()+textAreaWrapper.find(".mCSB_container").position().top);
			if(viewRatio>viewLimitBottom || viewRatio<viewLimitTop){
				if((hiddenDivSpan.height()-hiddenDivSpanOffset)>0){
					textAreaWrapper.mCustomScrollbar("scrollTo",hiddenDivSpan.height()-hiddenDivSpanOffset);
				}else{
					textAreaWrapper.mCustomScrollbar("scrollTo","top");
				}
			}
		});
		$.fn.getCursorPosition=function(){
			var el=$(this).get(0),
				pos=0;
			if("selectionStart" in el){
				pos=el.selectionStart;
			}else if("selection" in document){
				el.focus();
				var sel=document.selection.createRange(),
					selLength=document.selection.createRange().text.length;
				sel.moveStart("character",-el.value.length);
				pos=sel.text.length-selLength;
			}
			return pos;
		}
	});
})(jQuery);


/* 핸드폰모양 BYTE 수 세기 검사 */
function chkMsgLength(intMax,objMsg,st){
	var length = lengthMsg(objMsg.value);
	st.innerHTML = length;//현재 byte수를 넣는다
		if (length > intMax) {
		alert("최대 " + intMax + "byte이므로 초과된 글자수는 자동으로 삭제됩니다.\n");
		objMsg.value = objMsg.value.replace(/\r\n$/, "");
		objMsg.value = assertMsg(intMax,objMsg.value,st );
	}
}

/* 핸드폰모양 BYTE 수 세기 */
function lengthMsg(objMsg) {
	var nbytes = 0;
	for (i=0; i<objMsg.length; i++) {
		var ch = objMsg.charAt(i);

		if(escape(ch).length > 4) {
			nbytes += 2;
		} else if (ch == '\n') {
			if (objMsg.charAt(i-1) != '\r') {
				nbytes += 1;
			}
		} else if (ch == '<' || ch == '>') {
			nbytes += 4;
		} else {
			nbytes += 1;
		}
	}
	return nbytes;
}

/* 핸드폰모양 BYTE 출력 */
function assertMsg(intMax,objMsg,st) {
	var inc = 0;
	var nbytes = 0;
	var msg = "";

	var msglen = objMsg.length;
	for (i=0; i<msglen; i++) {
		var ch = objMsg.charAt(i);
		if (escape(ch).length > 4) {
			inc = 2;
		} else if (ch == '\n') {
			if (objMsg.charAt(i-1) != '\r') {
				inc = 1;
			}
		} else if (ch == '<' || ch == '>') {
			inc = 4;
		} else {
			inc = 1;
		}
		if ((nbytes + inc) > intMax) {
			break;
		}
		nbytes += inc;
		msg += ch;
	}
	st.innerHTML = nbytes; //현재 byte수를 넣는다
	return msg;
}



/* 내문자팅 관리함 전체선택 */
var sms_checkflag = "false";
	function sms_check(field) {

	if (sms_checkflag == "false") {
		for (i = 0; i < field.length; i++) {
			field[i].checked = true;
		}
		sms_checkflag = "true";
		return "전체해제";
	} else {
		for (i = 0; i < field.length; i++) {
			field[i].checked = false;
		}
		sms_checkflag = "false";
		return "전체선택"; 
	}
}

//내 문자팅 관리함에서 수정
function sms_my_modi(){

	if(confirm("수정하시겠습니까?") == true){
	
		var v_result = "";
		var m_receive_time = "Y";
		var radio1 = $("input:radio[name='sms_time_radio']:radio[value='1']").is(':checked');

		if (radio1 == false){

			var time_1 = $("#ex_time_1").val();
			var time_2 = $("#ex_time_2").val();

			if (time_1 == time_2){
				alert("수신시간을 정확히 설정해주세요.");
				$("#ex_time_1").focus();
				return false;
			}else{
				m_receive_time = $("#ex_time_1").val()+"|"+$("#ex_time_2").val();
			}
		}

		$.ajax({
			
			type : "post",
			url : "/meeting/smsting/modi_smsting",
			data : {
				"m_receive_time"	: m_receive_time,
				"m_job"				: encodeURIComponent($("#m_job").val()),
				"m_outstyle"		: encodeURIComponent($("#m_outstyle").val()),
				"m_character"		: encodeURIComponent($("#m_character").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if ( result == '1' ){
					alert("수정되었습니다.");
					window.location.reload();
				}else{
					alert("실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});
	}

}

// 내 문자팅 관리함 > 받은,보낸문자 삭제
function sms_del(sms){

	if($("input[name='chk_sms']:checked").length < 1){
		alert("삭제하실 문자의 체크박스를 한개이상 선택해 주십시오.");
		return;
	}else if(confirm("상대방이 삭제하지않으면 상대방에게는 기록이 남아있습니다.\n정말 삭제하시겠습니까?")){
	
		$("input[name='chk_sms']:checked").each(function(){
			$.ajax({
				type : "post",
				url : "/meeting/smsting/remove_mysms",
				data : {
					"mode"		: sms,
					"m_idx"		: encodeURIComponent($(this).val())
				},
				cache : false,
				async : false,
				success : function(result){

					if ( result == '1' ){
						alert("삭제되었습니다.");
						window.location.reload();
					}else{
						alert("실패하였습니다ㄴㄴ. (" + result + ")");
					}
				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});
		});
	}
}

//내 문자팅 관리함에서 해지
function sms_delete(){

	if(confirm("정말 해지하시겠습니까??") == true){
		$.ajax({
			type : "post",
			url : "/meeting/smsting/remove_smsting",
			data : {

			},
			cache : false,
			async : false,
			success : function(result){
				if ( result == '1' ){
					alert("삭제되었습니다.");
					location.href='/meeting/smsting/all';
				}else{
					alert("실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});
	}
}


//문자보내기 상자에서 해지
function sms_chk_delete(user){

	if(confirm("정말 해지하시겠습니까??") == false){
		return;
	}

	$.ajax({
		type : "post",
		url : "/meeting/smsting/remove_smsting",
		data : {
			"m_userid": user
		},
		cache : false,
		async : false,
		success : function(result){
			if(result == 2){
				alert("문자팅 등록을 먼저해 주세요.");
			}else if(result == 9){
				alert("실패하였습니다. (" + result + ")");
			}else{
				alert("삭제되었습니다.");
				window.location.reload();
			}
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});
}


// 10명 모두 추가하기
function sms_ten_add(str_array){

	str = getCookie('sms_list');

	if(str.split('|').length == 10){
		alert("문자팅은 최대 10명까지 가능합니다.");
		return;
	}
	
	if(str != false){
		deleteCookie('sms_list');
		mCSB_1_container.innerHTML = ""; //리스트 지우기
	}

	var new_cookie = "";

	if(str_array == "" || str_array == "undefined"){
		alert("추천회원이 없습니다.");
		return;
	}else{
		arraystr = str_array.split('|');

		for(i=0; i<arraystr.length; i++){
			
			list_num = i+1;

			$.ajax({

				type : "post",
				url : "/meeting/smsting/check_smsting_time",
				data : {
					"m_nick"	: encodeURIComponent(arraystr[i])
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == "1"){

						if(new_cookie){
							new_cookie = new_cookie + "|" + arraystr[i];
						}else{
							new_cookie = arraystr[i];
						}

						setCookie('sms_list',new_cookie,1);
						insert_sms_list(list_num, arraystr[i]);
					}

				},
				error : function(reuslt){
					alert("실패 ("+ result+")");
				}

			});

		}


	}
	
}


// 핸드폰모양 회원검색
function sms_phone_search(){

	var val = document.getElementById('sms_search_id').value;
	
	if (val == undefined || val == ""){		//검색하려는 값이 없으면
		alert("검색할 회원의 아이디를 입력해주세요.");
		document.getElementById('sms_search_id').focus();
		return;
	}


	$.ajax({
		type : "post",
		url: "/meeting/smsting/sms_phone_search",
		data : {
			"search_nick": encodeURIComponent(val)
		},
		cache : false,
		async : false,
		success : function(result){

			var m_userid = result;
			
			if(m_userid != ""){
				//문자팅에 등록이 되어있는 경우
				if(confirm(val+"님을 추가하시겠습니까?") == true){
					
					$.ajax({		// 수신시간설정확인
						type : "post",
						url: "/meeting/smsting/check_smsting_time",
						data : {
							"user_id" : encodeURIComponent(m_userid)
						},
						cache : false,
						async : false,
						success : function(result){
							
							if (result == '1'){		//수신시간 가능
								sms_phone_btn_add(val, m_userid);
								$('#sms_search_id').val('');
							}else if (result == '9'){
								alert("수신 가능 시간이 아닙니다.");
								$("#sms_search_id").val('');
								$("#sms_search_id").focus();
							}else{
								alert("실패하였습니다. (" + result + ")");
							}

						},
						error : function(result){
							alert("실패하였습니다. (" + result + ")");
						}
					});
				
				}

			}else{
				//문자팅에 등록이 되어있지 않은경우
				alert("문자팅에 등록이 되어있지 않습니다.");
				return;
			}

		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}

	});
}

//문자팅 검색 기능
function sms_search(str){
	//지역
		conregion = encodeURI($("#conregion").val());
	//나이
		age2 = encodeURI($("#age2").val());

	location.href="/meeting/smsting/"+str + "/conregion/" + conregion + "/age2/" + age2;
}


/* 문자팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/meeting/smsting/all");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/meeting/smsting/min5_friends");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/meeting/smsting/peer_friends");	});
	$("#tab_menu4").click(function() {	$(location).attr('href',"/meeting/smsting/my_smsting_recv");	});
});

/* 내 문자팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_my_menu1").click(function() {	$(location).attr('href',"/meeting/smsting/my_smsting_recv");	});
	$("#tab_my_menu2").click(function() {	$(location).attr('href',"/meeting/smsting/my_smsting_send");	});
	$("#tab_my_menu3").click(function() {	$(location).attr('href',"/meeting/smsting/my_smsting_setting");	});
});


//문자팅 무료등록 버튼클릭
function smsting_add(){
	$.get('/meeting/smsting/smsting_add_popup/'+Math.random(), function(data){
		modal.open({content: data,width : 560});
	});		
}

// 문자팅 보내기
function sms_send_request(data) {
	
	//임시로 막아놈
	//alert("준비중입니다.");
	//return false;
	
	var text = $("#sms_text").val();

	if (text == undefined || text == ""){	//내용이 없으면
		alert("보내실 문자 내용을 입력해주세요.");
		return;
	}else if (data == undefined || data == ''){
		alert("받으실 분을 선택해주세요.");
		return;
	}

	if(confirm("문자팅은 메세지 건당 70포인트 차감됩니다.\n문자메세지를 보내시겠습니까?") == true){

		$.ajax({
			type : "post",
			url: "/meeting/smsting/sms_send_request",
			data : {
				"sms_text": encodeURIComponent(text),
				"recv_member": encodeURIComponent(data)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if ( result != '' ){

					if(result == 909){
						alert("정회원 가입후 사용이 가능합니다.");	// 정회원아니면
						location.href='/profile/point/point_charge';
					}else if(result == 2){
						alert("문자팅 등록을 먼저해 주세요.");	// 문자팅에 등록하지 않았으면
					}else if(result == 4){
						alert("포인트가 부족합니다.\n(문자팅은 한 회원당 70P가 차감됩니다.");	// 포인트가 부족하면
					}else if (result == 9){
						alert("대표사진등록을 먼저 해주세요.");	//대표사진이 없으면
						location.href='/profile/main/user';
					}else if(result == 0){
						alert("문자메시지 수신을 허용한 회원이 없습니다.");
						return;
					}else if(result == "error"){
						alert("문자팅 보내기 실패 ("+result+")");
						return;
					}else {
						alert("문자 수신에 동의하신 \n"+result+"님께 전송되었습니다.");		//수신 동의한사람에게만 전송
					}

				}else{
					alert("문자 수신에 동의하신 회원이 없습니다.");
				}

			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});

	}

	

}

// 문자팅 받는사람 추가하기 버튼
var str = "";
var new_cookie = "";

function sms_phone_btn_add(m_nick, user_id){
	
	str = getCookie('sms_list');
	
	arraystr = load_number(m_nick);

	encodeURIComponent(m_nick);

	if (arraystr.indexOf(m_nick) > -1){	//중복이면

		alert("이미 등록되어 있는 회원입니다.");

	}else{	//중복이 아니면

		$.ajax({		// 수신시간설정확인
			type : "post",
			url: "/meeting/smsting/check_smsting_time",
			data : {
				"user_nick" : encodeURIComponent(m_nick)
			},
			cache : false,
			async : false,
			success : function(result){

				if (result == '1'){		//수신시간 가능

					var list_num = arraystr.length+1;

					if (list_num > 10){
						alert("최대 10명까지 등록할 수 있습니다.");
						return;
					}else{

						if(str != "" && str != undefined){
							new_cookie = str + "|" + m_nick;
							//new_cookie = str + "|" + m_nick+"**"+user_id;
						}else{
							new_cookie = m_nick;
							//new_cookie = m_nick+"**"+user_id;
						}

						setCookie('sms_list',new_cookie,1);
						insert_sms_list(list_num,m_nick);
					}

					if ($("input[name=meet_sms_list]:checkbox:checked").length > 0){
						$("input[name=meet_sms_list]:checkbox").attr("checked", false);
					}

				}else if (result == '9'){
					alert("수신 가능 시간이 아닙니다.");
				}else{
					alert("실패하였습니다. (" + result + ")");
				}

			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});
	}
}

// 선택회원 한번에 추가
function sms_chk() {
	var items=[];
	$('input[name="meet_sms_list"]:checkbox:checked').each(function(){
		sms_phone_btn_add($(this).val());	
	});
}

// 체크박스 한번에 추가
function sms_phone_chkbox(user_id,m_nick,number){

	arraystr = load_number(m_nick);

	encodeURIComponent(m_nick);

	if (arraystr.indexOf(m_nick) > -1){	//중복이면

		alert("이미 등록되어 있는 회원입니다.");
		$("#meet_sms_list_"+number).attr("checked", false);	//체크해제

	}else{
	
		$.ajax({		// 수신시간설정확인
				type : "post",
				url: "/meeting/smsting/check_smsting_time",
				data : {
					"user_id" : user_id
				},
				cache : false,
				async : false,
				success : function(result){

					if (result == '1'){		//수신시간 가능
					}else if (result == '9'){
						alert("수신 가능 시간이 아닙니다.");
						$("#meet_sms_list_"+number).attr("checked", false);	//체크해제
					}else{
						alert("실패하였습니다. (" + result + ")");
					}

				},
				error : function(result){
					alert("실패하였습니다. (" + result + ")");
				}
			});

	}
}

//쿠키 배열로 정렬
function load_number(m_nick){

	str = getCookie('sms_list');

	if(str != "" && str != undefined){
		arraystr = str.split('|');
		return arraystr;
	}else{
		return "";
	}
}


// 핸드폰모양 X btn 클릭 삭제
function delete_number(m_nick){

	arraystr = load_number(m_nick);

	deleteCookie('sms_list');
	var str = "";
	var del_cnt = 0;

	for(i = 0; i < arraystr.length; i++){

		if (m_nick != arraystr[i]){

			if (del_cnt == 0){
				str = arraystr[i];
				del_cnt++;
			}else{
				str = str + "|" + arraystr[i];
				del_cnt++;
			}

			setCookie('sms_list',str,1);

		}
	}
	mCSB_1_container.innerHTML = ""; //리스트 지우기

	docu_read(0); //타이머 시간 0
}


$(document).ready(function(){		// 오른쪽 핸드폰 list 유지
	
	docu_read(400);

});

//시작시 자동으로 번호 불러와서 넣기
function docu_read(load_time){ //load_time

	str = getCookie('sms_list');

	if(str != "" && str != undefined){
		arraystr = str.split('|');
	}else{
		return;
	}

	var list_num = arraystr.length;

	var final_str = 0;
	var final_ary = new Array();


	// 쿠키에 저장되어있던 list안의 user수신시간확인 후 안맞는사람 쿠키자동삭제
	for (i = 0; i < list_num; i++ )	{

		var final_ary_final = arraystr[i].split('**');


		$.ajax({ // 수신시간설정확인
			type : "post",
			url: "/meeting/smsting/check_smsting_time",
			data : {
				"user_id" : final_ary_final[1]
			},
			cache : false,
			async : false,
			success : function(result){

				if (result == 1){

					final_ary[final_str] = final_ary_final[0];
					final_str = final_str +1;

				}
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});

	}

	var final_num = final_ary.length;

	setTimeout( function(){

		deleteCookie('sms_list');	//수신시간 안맞는사람 제외한 쿠키재설정
		
		var str = "";
		var del_cnt = 0;

		for(i = 0; i < final_num; i++){

			if (del_cnt == 0){
				str = final_ary[i];
				del_cnt++;
			}else{
				str = str + "|" + final_ary[i];
				del_cnt++;
			}

		}

		setCookie('sms_list',str,1);


		for(i = 0; i < final_num; i++){
			num = i+1;
			insert_sms_list(num,final_ary[i]);
		}

	},load_time);

	//arraystr = load_number(user_id);

}

//핸드폰모양 목록추가
function insert_sms_list(num,m_nick){
	mCSB_1_container.innerHTML +=  '<div class="sms_phone_member_list">'+num+'. '+'<input type="text" value="'+m_nick+'" class="sms_phone_add" readonly="readonly"><input type="button" class="sms_phone_member_btn" onclick="delete_number(\''+m_nick+'\');"></div>';
}

