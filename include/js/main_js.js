

/*		##	main_TAB	##		*/
$(document).ready(function(){

	$("ul.tabs2 li").mouseover(function() { 

	$("ul.tabs2 li").removeClass("menu01_on");
	$(this).addClass("menu01_on");

	$(".tab_content2").hide() 
	var activeTab = $(this).attr("rel"); 
	$("#"+activeTab).fadeIn()
		
	}); 
  
});

/*		##	main_TAB end	##		*/


/*		##	main_ROLLING_1	##		*/
	function fn_rollToEx2(containerID, slideID){

		// 롤링할 객체를 변수에 담아둔다.
		var el = $('#'+containerID).find('#'+slideID);
		var lastChild;
		var speed = 3000;
		var timer = 0;

		el.data('prev', $('#'+containerID).find('.movi_prev'));	//이전버튼을 data()메서드를 사용하여 저장한다.
		el.data('next', $('#'+containerID).find('.movi_next'));	//다음버튼을 data()메서드를 사용하여 저장한다.
		el.data('size', el.children().outerWidth());		//롤링객체의 자식요소의 넓이를 저장한다.
		el.data('len', el.children().length);				//롤링객체의 전체요소 개수
		el.data('animating',false);

		el.css('width',el.data('size')*el.data('len'));		//롤링객체의 전체넓이 지정한다.

		//el에 첨부된 prev 데이타를 클릭이벤트에 바인드한다.
		el.data('prev').bind({
			click:function(e){
				e.preventDefault();
				movePrevSlide();
			}
		});

		//el에 첨부된 next 데이타를 클릭이벤트에 바인드한다.
		el.data('next').bind({
			click:function(e){
				e.preventDefault();
				moveNextSlide();
			}
		});

		function movePrevSlide(){
			if(!el.data('animating')){
				//롤링객체의 끝에서 요소를 선택하여 복사한후 변수에 저장한다.
				var lastItem = el.children().eq(-2).nextAll().clone(true);
				lastItem.prependTo(el);		//복사된 요소를 롤링객체의 앞에 붙여놓는다.
				el.children().eq(-2).nextAll().remove();	//선택된 요소는 끝에서 제거한다
				el.css('left','-'+(el.data('size')*1+'px'));	//롤링객체의 left위치값을 재설정한다.
			
				el.data('animating',true);	//애니메이션 중복을 막기 위해 첨부된 animating 데이타를 true로 설정한다.

				el.animate({'left': '0px'},'normal',function(){		//롤링객체를 left:0만큼 애니메이션 시킨다.
					el.data('animating',false);
				});
			}
			return false;
		}

		function moveNextSlide(){
			if(!el.data('animating')){
				el.data('animating',true);

				el.animate({'left':'-'+(el.data('size')*1)+'px'},'normal',function(){	//롤링객체를 애니메이션 시킨다.
					//롤링객체의 앞에서 요소를 선택하여 복사한후 변수에 저장한다.
					var firstChild = el.children().filter(':lt('+1+')').clone(true);
					firstChild.appendTo(el);	//복사된 요소를 롤링객체의 끝에 붙여놓는다.
					el.children().filter(':lt('+1+')').remove();	//선택된 요소를 앞에서 제거한다
					el.css('left','0px');	////롤링객체의 left위치값을 재설정한다.

					el.data('animating',false);
				});
			}
			return false;
		}

	}				
/*		##	main_ROLLING_1 end	##		*/


/*		##	main_ROLLING2	##		*/
function fn_rollToEx(containerID, slideID){

	// 롤링할 객체를 변수에 담아둔다.
	var el = $('#'+containerID).find('#'+slideID);
	var lastChild;
	var speed = 3000;
	var timer = 0;

	el.data('prev', $('#'+containerID).find('.prev'));	//이전버튼을 data()메서드를 사용하여 저장한다.
	el.data('next', $('#'+containerID).find('.next'));	//다음버튼을 data()메서드를 사용하여 저장한다.
	el.data('size', el.children().outerWidth());		//롤링객체의 자식요소의 넓이를 저장한다.
	el.data('len', el.children().length);				//롤링객체의 전체요소 개수
	el.data('animating',false);

	el.css('width',el.data('size')*el.data('len'));		//롤링객체의 전체넓이 지정한다.

	//el에 첨부된 prev 데이타를 클릭이벤트에 바인드한다.
	el.data('prev').bind({
	click:function(e){
	e.preventDefault();
	movePrevSlide();
	}
	});

	//el에 첨부된 next 데이타를 클릭이벤트에 바인드한다.
	el.data('next').bind({
	click:function(e){
	e.preventDefault();
	moveNextSlide();
	}
	});

	function movePrevSlide(){
		if(!el.data('animating')){
			//롤링객체의 끝에서 요소를 선택하여 복사한후 변수에 저장한다.
			var lastItem = el.children().eq(-2).nextAll().clone(true);
			lastItem.prependTo(el);		//복사된 요소를 롤링객체의 앞에 붙여놓는다.
			el.children().eq(-2).nextAll().remove();	//선택된 요소는 끝에서 제거한다
			el.css('left','-'+(el.data('size')*1+'px'));	//롤링객체의 left위치값을 재설정한다.

			el.data('animating',true);	//애니메이션 중복을 막기 위해 첨부된 animating 데이타를 true로 설정한다.

			el.animate({'left': '0px'},'normal',function(){		//롤링객체를 left:0만큼 애니메이션 시킨다.
			el.data('animating',false);
			});
		}
		return false;
	}

	function moveNextSlide(){
		if(!el.data('animating')){
			el.data('animating',true);

			el.animate({'left':'-'+(el.data('size')*1)+'px'},'normal',function(){	//롤링객체를 애니메이션 시킨다.
			//롤링객체의 앞에서 요소를 선택하여 복사한후 변수에 저장한다.
			var firstChild = el.children().filter(':lt('+1+')').clone(true);
			firstChild.appendTo(el);	//복사된 요소를 롤링객체의 끝에 붙여놓는다.
			el.children().filter(':lt('+1+')').remove();	//선택된 요소를 앞에서 제거한다
			el.css('left','0px');	////롤링객체의 left위치값을 재설정한다.

			el.data('animating',false);
			});
		}
		return false;
	}

}
/*		##	main_ROLLING2 end	##		*/


$(document).ready(function(e) {

	/*		##	main_over	##		*/
	var member1 = document.getElementById('con_01_menu1');
	var member2 = document.getElementById('con_01_menu2');

	if(member1 != null){

		member1.onmouseover = function(){

			document.getElementById("con_01_content1").style.display = "block";
			document.getElementById("con_01_content2").style.display = "none";
			document.getElementById("con_01_menu1").className = "content_01_right_menu1_on";
			document.getElementById("con_01_menu2").className = "content_01_right_menu2_off";

		}

	}

	if(member2 != null){

		member2.onmouseover = function(){

			document.getElementById("con_01_content1").style.display = "none";
			document.getElementById("con_01_content2").style.display = "block";
			document.getElementById("con_01_menu1").className = "content_01_right_menu1_off";
			document.getElementById("con_01_menu2").className = "content_01_right_menu2_on";

		}

	}

	$(".content_01_sub_menu").each(function(index) {
		$(this).mouseover(function() {
			$("#ie_cr_" + index).css("display", "block");
		});
		$(this).mouseout(function() {
			$("#ie_cr_" + index).css("display", "none");
		});
	});

	$(".content_01_sub_menu2").each(function(index) {
		$(this).mouseover(function() {
			$("#ie_cr2_" + index).css("display", "block");
		});
		$(this).mouseout(function() {
			$("#ie_cr2_" + index).css("display", "none");
		});
	});

	$(".content_01_sub_menu3").each(function(index) {
		$(this).mouseover(function() {
			$("#ie_cr3_" + index).css("display", "block");
		});
		$(this).mouseout(function() {
			$("#ie_cr3_" + index).css("display", "none");
		});
	});

	$(".content_01_sub_menu4").each(function(index) {
		$(this).mouseover(function() {
			$("#ie_cr4_" + index).css("display", "block");
		});
		$(this).mouseout(function() {
			$("#ie_cr4_" + index).css("display", "none");
		});
	});
	/*		##	main_over end	##		*/

});


function rand_chatting(){

	var flied = "";

	// 새내기회원
	if ($("#con_01_menu1").hasClass('content_01_right_menu1_on') == true)
	{
		flied = 'm_in_date';

	// 최근접속회원
	}else{

		flied = 'last_login_day';
	
	}

	$.ajax({
	
		type : "post",
		url : "/main/rand_chatting",
		data : {
			"order" : flied
		},
		cache : false,
		async : false,
		success : function(result){
			chat_request(result);
		},
		error : function(result){
			alert("실패하였습니다. (" + result + ")");
		}
	});

}


$(document).ready(function(){



	/** 로그인 영문+숫자만 **/
	$("input[name=login]").keyup(function(event){ 
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^a-z0-9_]/gi,''));
		}
	});
	/** 로그인 영문+숫자만 **/



	// 나는 원해요 검색
	$(".search_btn").click(function(){
		location.href="/chatting/find_chatting/find_chatting/idx/3/se_sex/"+$("#search_sex").val()+"/se_area/"+$("#search_area").val()+"/se_age/"+$("#search_age").val()+"/se_re/"+$("#search_reason").val();
	});

}); 




$(document).ready(function(){

	$("#tab01").click(function(){
		$("#tab01").addClass("on");
		$("#tab02").removeClass();
		$("#tab_menu_01").show();
		$("#tab_menu_02").hide();
		$("#event_popup").addClass("display_block");
		
	
	});

	$("#tab02").click(function(){
		$("#tab01").removeClass();
		$("#tab02").addClass("on");
		$("#tab_menu_01").hide();
		$("#tab_menu_02").show();
		
		$("#event_popup").addClass("displaynone");
		$("#event_popup").removeClass("display_block");
		music_chat_rolling();
	});

	$("#close").click(function(){
		$("#event_popup").addClass("displaynone");
		$("#event_popup").removeClass("display_block");
		$("#tab_menu_01").show();
		
		
	});

});
	
//음악채팅 롤링
function music_chat_rolling(){
		
	for (i=1; i<6;i++){
		if ($("#live_slide_"+i+" > div").width() > '300')
		{
			var t = new js_rolling('live_slide_'+i);
			t.set_direction(4);
			t.move_gap = 1;	//움직이는 픽셀단위
			t.time_dealy = 55; //움직이는 타임딜레이
			t.time_dealy_pause = 0;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
			t.start();
		}
	}
}

//실시간 매거진 sub 탭메뉴
function magazine_sub_tab(gubn){	

	/*$.ajax({

		type : "post",
		url : "/main/call_magazine_main_view_ajax",
		data : {
			"gubn" : encodeURIComponent(gubn)
		},
		cache : false,
		async : false,
		success : function(result){
			
			if(result == "1000"){
				alert("잘못된 접근입니다.");
				return;
			}else if(result == "1001"){
				$(location).attr("href", "/service_center/joy_magazine/all");
			}else{
				$(".joymagazine_cnt_box").empty();
				$(".joymagazine_cnt_box").html(result);
			}				

		},
		error : function(result){
			alert("실패 ("+ result +")");
		}

	});*/

	$(location).attr("href", "/service_center/joy_magazine/all");

}

//매거진 view 페이지 이동
function magazine_view_goto(idx){
	$(location).attr("href", "/service_center/joy_magazine/magazine_view/idx/"+idx);
}

