
/* 번개팅등록 START */
(function($){
	$(window).load(function(){
		var textArea=$(".textarea_scroll textarea");
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

/* 번개팅등록 END */



/* 번개팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/meeting/beongae/all");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/meeting/beongae/today");	});
	$("#tab_menu3").click(function() {	$(location).attr('href',"/meeting/beongae/ing");	});
	$("#tab_menu4").click(function() {	$(location).attr('href',"/meeting/beongae/mypage");	});
});


/* 내 번개팅 탭메뉴 */
$(document).ready(function(){
	$("#tab_my_menu1").click(function() {	$(location).attr('href',"/meeting/beongae/mypage");	});
	$("#tab_my_menu2").click(function() {	$(location).attr('href',"/meeting/beongae/mypage_recv");	});
	$("#tab_my_menu3").click(function() {	$(location).attr('href',"/meeting/beongae/mypage_send");	});
});
/* 내 번개팅 END */


//번개팅 상단달력
$(document).ready(function(){
	$(function() {	
		$( ".calendar_area" ).datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			yearSuffix: '년',
			showMonthAfterYear:true,
			altField : '#w_day'
		});
	});
});


/* 번개팅 등록하기 클릭시 상단으로 이동 */
function go_top(orix,oriy,desx,desy) {
    var Timer;
    if (document.body.scrollTop == 0) {
        var winHeight = document.documentElement.scrollTop;
    } else {
        var winHeight = document.body.scrollTop;
    }
    if(Timer) clearTimeout(Timer);
    startx = 0;
    starty = winHeight;
    if(!orix || orix < 0) orix = 0;
    if(!oriy || oriy < 0) oriy = 0;
    var speed = 7;
    if(!desx) desx = 0 + startx;
    if(!desy) desy = 0 + starty;
    desx += (orix - startx) / speed;
    if (desx < 0) desx = 0;
    desy += (oriy - starty) / speed;
    if (desy < 0) desy = 0;
    var posX = Math.ceil(desx);
    var posY = Math.ceil(desy);
    window.scrollTo(posX, posY);
    if((Math.floor(Math.abs(startx - orix)) < 1) && (Math.floor(Math.abs(starty - oriy)) < 1)){
        clearTimeout(Timer);
        window.scroll(orix,oriy);
    }else if(posX != orix || posY != oriy){
        Timer = setTimeout("go_top("+orix+","+oriy+","+desx+","+desy+")",15);
    }else{
        clearTimeout(Timer);
    }
}

/* go_to_top scroll end */


//번개팅 검색 기능
function b_search(str){
	//지역
		region = encodeURI($("#region").val());
	//시간
		time = encodeURI($("#time").val());
	//인원
		wantcnt = encodeURI($("#wantcnt").val());
	//관심사
		interest = encodeURI($("#interest").val());

	location.href="/meeting/beongae/"+str + "/region/" + region + "/time/" + time + "/wantcnt/" + wantcnt + "/interest/" + interest;
}

//번개팅 성별검색 기능
function search_sex(str,sex){
	//지역
		region = encodeURI($("#region").val());
	//시간
		time = encodeURI($("#time").val());
	//인원
		wantcnt = encodeURI($("#wantcnt").val());
	//관심사
		interest = encodeURI($("#interest").val());

	location.href="/meeting/beongae/"+str + "/region/" + region + "/time/" + time + "/wantcnt/" + wantcnt + "/interest/" + interest + "/sex/"+ sex + "/";
}


//번개팅 신규등록
function form_check(){

	if($("#w_region").val() == ""){
		alert("지역을 선택해 주십시오.");	
		$("#w_region").focus();
		return false;
	}else if($("#w_time").val() == ""){
		alert("시간을 선택해 주십시오.");	
		$("#w_time").focus();
		return false;
	}else if($("#w_wantcnt").val() == ""){
		alert("인원을 선택해 주십시오.");	
		$("#w_wantcnt").focus();
		return false;
	}else if($("#w_interest").val() == ""){
		alert("관심사를 선택해 주십시오.");	
		$("#w_interest").focus();
		return false;
	}else if($("#w_intro").val() == ""){
		alert("내용을 입력해 주십시오.");	
		$("#w_intro").focus();
		return false;
	}else if($("#w_day").val() == ""){
		alert("날짜를 선택해 주십시오.");	
		return false;
	}else{
		var result = "";
		$.ajax({
			type: "POST",
			url: "/meeting/beongae/reg_beongae",
			data: {
				"w_region": encodeURIComponent($("#w_region").val()),
				"w_time": encodeURIComponent($("#w_time").val()),
				"w_wantcnt": encodeURIComponent($("#w_wantcnt").val()),
				"w_interest": encodeURIComponent($("#w_interest").val()),
				"w_intro": encodeURIComponent($("#w_intro").val()),
				"w_day": encodeURIComponent($("#w_day").val())
			},
			cache: false,
			async: false,
			success: function(data) {
				result = data;

				console.log(data);
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});

		if(result == "1"){
			alert("정상적으로 등록되었습니다.");
			location.href = "/meeting/beongae/all/sex/";
		}else if(result == "3"){
			alert("번개팅은 하루에 1번만 작성가능합니다.");
		}else if(result == "909"){
			alert("정회원 가입후 사용이 가능합니다.");
			location.href="/profile/point/point_charge";
		}else{
			alert("게시물 등록에 실패하였습니다. (" + result + ")");
		}

	}
}


//번개팅 요청 레이어팝업 띄우기
function b_request(idx){
	$.get('/meeting/beongae/request_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}


function decoration_style(v, i){
	
	if(v == "on"){
		$('#comment_'+i).css("text-decoration", "underline");
	}else{
		$('#comment_'+i).css("text-decoration", "none");
	}

}