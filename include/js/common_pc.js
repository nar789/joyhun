/**
 * PC모드일때만 쓰는 각종 공용 스트립트
 */


//좌측 따라다니는 배너 스크립트
$(document).ready(function(){  
  var $doc           = $(document);  
  var position       = 0;  
  var top = $doc.scrollTop(); //현재 스크롤바 위치  
  var screenSize     = 0;        // 화면크기  
  var halfScreenSize = 0;    // 화면의 반  
  
  /*사용자 설정 값 시작*/  
  var pageWidth      = 1000; // 페이지 폭, 단위:px  
  var leftOffet      = 478;  // 중앙에서의 폭(왼쪽 -, 오른쪽 +), 단위:px  
  var leftMargin     = 965; // 페이지 폭보다 화면이 작을때 옵셋, 단위:px, leftOffet과 pageWidth의 반만큼 차이가 난다.  
  var speed          = 1500;     // 따라다닐 속도 : "slow", "normal", or "fast" or numeric(단위:msec)  
  var easing         = 'swing'; // 따라다니는 방법 기본 두가지 linear, swing  
  var $layer         = $('#floating'); // 레이어 셀렉팅  
  var layerTopOffset = 100;   // 레이어 높이 상한선, 단위:px  
  $layer.css('z-index', 0);   // 레이어 z-인덱스  

  var start_offset = 213; //시작위치
  var end_offset = 875; //하단 멈출 위치 (바닥부터 배너 최상단까지의 값)

  /*사용자 설정 값 끝*/  
  
  //좌우 값을 설정하기 위한 함수  
  function resetXPosition()  
  {  
    $screenSize = $('body').width();// 화면크기  
    halfScreenSize = $screenSize/2;// 화면의 반  
    xPosition = halfScreenSize + leftOffet;  
    if ($screenSize < pageWidth)  
		xPosition = leftMargin;  
		$layer.css('left', xPosition);  
	}  
  
  // 스크롤 바를 내린 상태에서 리프레시 했을 경우를 위해  
  if (top > 0 )  
    $doc.scrollTop(layerTopOffset+top);  
  else  
    $doc.scrollTop(0);  
  
	// 최초 레이어가 있을 자리 세팅  
	$layer.css('top',start_offset);  
	resetXPosition();  
  
  //윈도우 크기 변경 이벤트가 발생하면  
  $(window).resize(resetXPosition);  
  
  //스크롤이벤트가 발생하면  
  $(window).scroll(function(){  
    yPosition = $doc.scrollTop()+layerTopOffset;  
	if(yPosition < start_offset){yPosition = start_offset;}

	var dh = $(document).height(); 
	if(yPosition > (dh - end_offset)){yPosition = (dh - end_offset);}

    $layer.animate({"top":yPosition }, {duration:speed, easing:easing, queue:false});  
  });  
});  





//좌측배너중 이미지 롤링
$(document).ready(function(){  
	$("#rolling").rolling(95,224,{ 
		delay: 5000 
	}); 
}); 





//나이별 접속회원 시작
$(document).ready(function(){
  
	  $(".age_tab_con").hide(); 
	  $(".age_tab_con:first").show(); 

	  
	  $("ul.age_tabs li").mouseover(function() { 
	 
		  $("ul.age_tabs li").removeClass(" age_on"); 
		  $(this).addClass("age_on"); 

		  $(".age_tab_con").hide();
		  var activeTab = $(this).attr("rel"); 
		  $("#"+activeTab).show();
	 
	  }); 
  
});
//나이별 접속회원 끝





/*		##사이트맵 열기 닫기	##		*/

$(document).ready(function(){
	var dropthe = document.getElementById('drop_btn');

	if (dropthe != null){
		dropthe.onclick = function(){

			var nonnon = $("#box-sh").css("display");

			if (nonnon == 'none'){

				$("#box-sh").css('display','block');
				$("#arrow_none").css('display','none');
				var imgmg = $("#drop_btn").find("img").attr("src").split("on.gif").join("over.png");

				$("#drop_btn").find("img").attr("src",imgmg);

				document.getElementById("menu_left").className = "menu_left_wide";
				document.getElementById("menu_right").className = "menu_none";

			} else {

				$('#box-sh').css('display','none');
				$("#arrow_none").css('display','block');
				var imgmg = $("#drop_btn").find("img").attr("src").split("over.png").join("on.gif");
				
				$("#drop_btn").find("img").attr("src",imgmg);

				document.getElementById("menu_left").className = "menu_left";
				document.getElementById("menu_right").className = "menu_right";

			}
		}

	}
});




/*		##	RIGHT_login_box ie <> chrome	##		*/

$(document).ready(function(e) {
	var agent = navigator.userAgent;
	if (agent.indexOf('MSIE') > 0 || agent.indexOf('Trident') > 0) {
			$(".member_img_bg").addClass("margin_left_mi_44"); 
	}
});

/*		##	RIGHT_login_box ie <> chrome end	##		*/






//상단메뉴 클래스 자동링크 (top_sub_menu 클래스 자동적용)
$( document ).ready(function() {
	$(function(){
	  var url = window.location.pathname;  
	  var activePage = stripTrailingSlash(url,0);

	  $('.top_sub_menu > a').each(function(){ 
		var currentPage = stripTrailingSlash($(this).attr('href'),0);
		if (activePage == currentPage) {
		  $(this).addClass('de_on'); 
		}

		//autoclass 항목에도 주소를 적어주면 별도로 class 변경
		if($(this).attr('autoclass') != undefined){
			var currentPage2 = stripTrailingSlash($(this).attr('autoclass'),0);
			var activePage2 = stripTrailingSlash3dep(url,1);

			if (activePage2 == currentPage2) {
				$(this).addClass('de_on'); 
			}
		}

		if($(this).attr('ex_serach') != undefined){

			var currentPage3 = stripTrailingSlash3dep($(this).attr('ex_serach'),0);
			var activePage3 = stripTrailingSlash3dep(url,0);


			if(url.indexOf(",")){	// on되어야하는 url 이 2개이상인경우, 남녀검색이있을경우

				var Pagecnt_on = $(this).attr('ex_serach').split(",");

				for (i=0; i < Pagecnt_on.length; i++ ){
					if (activePage3 == Pagecnt_on[i]){
						$(this).addClass('de_on'); 
					}
				}
			}

			if (activePage3 == currentPage3) {
			  $(this).addClass('de_on'); 
			}

			
			
		}



	  });

	});
});




//서브페이지 좌측메뉴 자동오픈 (3depth_menu 2depth_menu 클래스 자동적용)

$( document ).ready(function() {
	$(function(){
	  var url = window.location.pathname;  

	  var activePage = stripTrailingSlash(url,1);
	  $('.two_depth > a').each(function(){  //2depth
		var currentPage = stripTrailingSlash($(this).attr('href'),1);
		if (activePage == currentPage) {
		  $(this).addClass('color_ea3c3c'); 
		} 

		//autoclass 항목에도 주소를 적어주면 별도로 class 변경
		if($(this).attr('autoclass') != undefined){
			var currentPage = stripTrailingSlash($(this).attr('autoclass'),0);
			if (activePage == currentPage) {
			  $(this).addClass('color_ea3c3c'); 
			} 
		}

		if($(this).attr('ex_serach') != undefined){

			var currentPage3 = stripTrailingSlash3dep($(this).attr('ex_serach'),0);
			var activePage3 = stripTrailingSlash(url,0);

			if(url.indexOf(",")){	// on되어야하는 url 이 2개이상인경우, 남녀검색, GET값이있을경우

				var Pagecnt_on = $(this).attr('ex_serach').split(",");

				for (i=0; i < Pagecnt_on.length; i++ ){
					if (activePage3 == Pagecnt_on[i]){
						$(this).addClass('color_ea3c3c');
					}
				}
			}

			if (activePage3 == currentPage3) {
			  $(this).addClass('color_ea3c3c'); 
			}
		}

	  });

	  var activePage = stripTrailingSlash(url,0);
	  $('.third_depth li a').each(function(){  //3depth
		var currentPage = stripTrailingSlash($(this).attr('href'),0);
		if (activePage == currentPage) {
		  $(this).addClass('color_333'); 
		} 

		//autoclass 항목에도 주소를 적어주면 별도로 class 변경
		if($(this).attr('autoclass') != undefined){
			var currentPage = stripTrailingSlash($(this).attr('autoclass'),0);
			if (stripTrailingSlash(url,1) == currentPage) {
			  $(this).addClass('color_333'); 
			} 
		}

		

		// 3depth 안의 4depth 탭메뉴 있을경우
		if ($(this).attr('fourdepth') != undefined){
			var activePage_four = stripTrailingSlash(url,1);
			var currentPage_four = stripTrailingSlash($(this).attr('href'),1);
			if (activePage_four == currentPage_four) {
			  $(this).addClass('color_333'); 
			} 
		}

		if($(this).attr('ex_serach') != undefined){

			var currentPage3 = stripTrailingSlash3dep($(this).attr('ex_serach'),0);
			var activePage3 = stripTrailingSlash(url,0);

			if(url.indexOf(",")){	// on되어야하는 url 이 2개이상인경우, 남녀검색, GET값이있을경우

				var Pagecnt_on = $(this).attr('ex_serach').split(",");

				for (i=0; i < Pagecnt_on.length; i++ ){
					if (activePage3 == Pagecnt_on[i]){
						$(this).addClass('color_333');
					}
				}
			}

			if (activePage3 == currentPage3) {
			  $(this).addClass('color_333'); 
			}
		}



	  });

	});

});





/* ## 위아래 롤링 ## */

var js_rolling = function(this_s){
	// 시간단위는 ms로 1000이 1초
	if(this_s.nodeType==1){
		this.this_s = this_s;
	}else{
		this.this_s = document.getElementById(this_s);
	}
	this.is_rolling = false;
	this.direction = 1; //1:top, 2:right, 3:bottom, 4:left (시계방향) // 1번과 4번만 됨
	this.children =	null;
	this.move_gap = 1;	//움직이는 픽셀단위
	this.time_dealy = 100; //움직이는 타임딜레이
	this.time_dealy_pause = 1000;//하나의 대상이 새로 시작할 때 멈추는 시간, 0 이면 적용 안함
	this.time_timer=null;
	this.time_timer_pause=null;
	this.mouseover=false;
	this.init();
	this.set_direction(this.direction);
}
js_rolling.prototype.init = function(){
	this.this_s.style.position='relative';
	this.this_s.style.overflow='hidden';
	var children = this.this_s.childNodes;
	for(var i=(children.length-1);0<=i;i--){
		if(children[i].nodeType==1){
			children[i].style.position='relative';
		}else{
			this.this_s.removeChild(children[i]);
		}
	}
	var this_s=this;
	this.this_s.onmouseover=function(){
		this_s.mouseover=true;
		if(!this_s.time_timer_pause){
			this_s.pause();
		}
	}
	this.this_s.onmouseout=function(){
		this_s.mouseover=false;
		if(!this_s.time_timer_pause){
			this_s.resume();
		}
	}	
}
js_rolling.prototype.set_direction = function(direction){
	this.direction=direction;
	if(this.direction==2 ||this.direction==4){
		this.this_s.style.whiteSpace='nowrap';
	}else{
		this.this_s.style.whiteSpace='normal';
	}
	var children = this.this_s.childNodes;
	for(var i=(children.length-1);0<=i;i--){
			if(this.direction==1){
				children[i].style.display='block';
			}else if(this.direction==2){
				children[i].style.textlign='right';
				children[i].style.display='inline';
			}else if(this.direction==3){
				children[i].style.display='block';
			}else if(this.direction==4){
				children[i].style.display='inline';
			}
	}
	this.init_element_children();	
}
js_rolling.prototype.init_element_children = function(){
	var children = this.this_s.childNodes;
	this.children = children;
	for(var i=(children.length-1);0<=i;i--){
			if(this.direction==1){
				children[i].style.top='0px';
			}else if(this.direction==2){
				children[i].style.left='-'+this.this_s.firstChild.offsetWidth+'px';
			}else if(this.direction==3){
				children[i].style.top='-'+this.this_s.firstChild.offsetHeight+'px';
			}else if(this.direction==4){
				children[i].style.left='0px';
			}
	}
}
js_rolling.prototype.act_move_up = function(){
	for(var i = 0,m=this.children.length;i<m;i++){
		var child = this.children[i];
		child.style.top=(parseInt(child.style.top)-this.move_gap)+'px';
	}
	if((this.children[0].offsetHeight+parseInt(this.children[0].style.top))<=0){
		this.this_s.appendChild(this.children[0]);
		this.init_element_children();
		this.pause_act();		
	}
}
js_rolling.prototype.move_up = function(){
	if(this.direction!=1&&this.direction!=3){return false;}
	this.this_s.appendChild(this.children[0]);
	this.init_element_children();
	this.pause_act();	
}
js_rolling.prototype.act_move_down = function(){
	for(var i = 0,m=this.children.length;i<m;i++){
		var child = this.children[i];
		child.style.top=(parseInt(child.style.top)+this.move_gap)+'px';
	}
	if(parseInt(this.children[0].style.top)>=0){
		this.this_s.insertBefore(this.this_s.lastChild,this.this_s.firstChild);
		this.init_element_children();
		this.pause_act();	
	}
}
js_rolling.prototype.move_down = function(){
	if(this.direction!=1&&this.direction!=3){return false;}	
	this.this_s.insertBefore(this.this_s.lastChild,this.this_s.firstChild);
	this.init_element_children();
	this.pause_act();
}
js_rolling.prototype.act_move_left = function(){
	for(var i = 0,m=this.children.length;i<m;i++){
		var child = this.children[i];
		child.style.left=(parseInt(child.style.left)-this.move_gap)+'px';
	}
	if((this.children[0].offsetWidth+parseInt(this.children[0].style.left))<=0){
		this.this_s.appendChild(this.this_s.firstChild);
		this.init_element_children();
		this.pause_act();		
	}
}
js_rolling.prototype.move_left = function(){
	if(this.direction!=2&&this.direction!=4){return false;}		
	this.this_s.appendChild(this.this_s.firstChild);
	this.init_element_children();
	this.pause_act();		
}
js_rolling.prototype.act_move_right = function(){
	for(var i = 0,m=this.children.length;i<m;i++){
		var child = this.children[i];
		child.style.left=(parseInt(child.style.left)+this.move_gap)+'px';
	}
	
	if(parseInt(this.this_s.lastChild.style.left)>=0){
		this.this_s.insertBefore(this.this_s.lastChild,this.this_s.firstChild);
		this.init_element_children();
		this.pause_act();		
	}
}
js_rolling.prototype.move_right = function(){
	if(this.direction!=2&&this.direction!=4){return false;}			
	this.this_s.insertBefore(this.this_s.lastChild,this.this_s.firstChild);
	this.init_element_children();
	this.pause_act();
}
js_rolling.prototype.start = function(){ //롤링 시작
	var this_s = this;
	this.stop();
	this.is_rolling = true;
	var act = function(){
		if(this_s.is_rolling){
			if(this_s.direction==1){this_s.act_move_up();}
			else if(this_s.direction==2){this_s.act_move_right();}
			else if(this_s.direction==3){this_s.act_move_down();}
			else if(this_s.direction==4){this_s.act_move_left();}
		}
	}
	this.time_timer = setInterval(act,this.time_dealy);
}
js_rolling.prototype.pause_act = function(){ //일시 동작
	if(this.time_dealy_pause){
		var this_s = this;
		var act = function(){this_s.resume();this_s.time_timer_pause=null;}
		if(this.time_timer_pause){clearTimeout(this.time_timer_pause);}
		this.time_timer_pause = setTimeout(act,this.time_dealy_pause);
		this.pause();
	}
}
js_rolling.prototype.pause = function(){ //일시 멈춤
	this.is_rolling = false;
}
js_rolling.prototype.resume = function(){ //일시 멈춤 해제
	if(!this.mouseover){
		this.is_rolling = true;
	}
}
js_rolling.prototype.stop = function(){ //롤링을 끝냄
	this.is_rolling = false;
	if(!this.time_timer){
		clearInterval(this.time_timer);
	}
	this.time_timer = null
}





/** 5분거리 접속이성 찾기 **/	

//검색 클릭
function min_select_show(){

	var select_1 = $("select[name=local_master_prim]").val();
	var select_2 = $("select[name=local_second_prim]").val();

	if (select_1 == ''){
		alert("검색할 지역을 선택해주세요");
		return false;
	}else if (select_2 == ''){
		alert("검색할 구,군을 선택해주세요");
		return false;
	}

	$.ajax({
		type: "post",
		url: "/chatting/town_find/banner_cnt",
		data: {
			"m_conregion": encodeURIComponent(select_1),
			"m_conregion2": encodeURIComponent(select_2)
		},
		cache: false,
		async: false,
		success: function(data) {

			var five_area = data.split('##');

			$("#town_find").html(five_area[1]);
			$("#total_cnt").html("총 "+five_area[0]+"명");

			$("#search_show_text div span").html(select_1+" "+select_2+" ");

			$("#search_show_text").show();
			$("#all_show_find").show();
			$("#search_select").hide();
			$(".today_frame").css('display','none');
			$(".search_frame_on").css('height','386px');
			//$(".search_show_box").addClass('mCustomScrollbar');
		}
	}); 
	
}

// 5분거리 접속이성찾기 검색 후 채팅 user체크 후 채팅신청
function chat_user(test){

	$.ajax({
		type: "post",
		url: "/chatting/town_find/user_check",
		data: {
		},
		cache: false,
		async: false,
		success: function(data) {

			// 로그인 안했으면
			if (data == '4'){
				alert("로그인 후 이용가능합니다.");
				return false;
			// 로그인 했으면 채팅
			}else{
				chat_request(test);
			}
		}
	}); 
}



// 검색 후 EXIT 버튼 클릭시
function min_select_exit(){
	$("#search_show_text").hide();
	$("#all_show_find").hide();
	$("#search_select").show();
	$(".today_frame").css('display','block');
	$(".search_frame_on").css('height','90px');
}

/** 5분거리 접속이성 찾기 끝 **/



/* 빨간 탭메뉴 */

$(document).ready(function(){ 

	//탭메뉴 갯수구하기
	var tab_cnt = $("ul.tab_bg").children().size();

	//탭메누 갯수만큼 반복
	for (i=1; i<=tab_cnt; i++ ){

		//on되어있으면
		if ($("#tab_menu"+i).hasClass("tab_on")){

			for (x=1; x<=tab_cnt; x++){

				//자기자신이 아닌것중에
				if (x != i){
					
					//오른쪽탭들의 border-left 숨김
					if (x > i){
						$("#tab_menu"+x).css("border-left","#f8f8f8");
					//왼쪽탭들의 border-left 숨김
					}else{
						$("#tab_menu"+x).css("border-right","#f8f8f8");
					}
				}
				
			}

		}
	}

});



// 엔터 + 버튼클릭시 value값 검사
function chk_val(){

	var select_1 = $("select[name=search_what]").val();
	var select_2 = $("input[name=search_text]").val();

	if (select_2 == ''){

		if (select_1 == 'm_userid'){
			alert("검색할 아이디를 입력해주세요");
			return false;
		}else if (select_1 == 'm_nick'){
			alert("검색할 닉네임을 입력해주세요");
			return false;
		}
	}

	fast_find_mb(select_1, select_2);
}

// 빠른회원찾기
function fast_find_mb(cate,val){

	$.ajax({
		type: "post",
		url: "/meeting/main/find_mb",
		data: {
			"m_cate": encodeURIComponent(cate),
			"m_val": encodeURIComponent(val)
		},
		cache: false,
		async: false,
		success: function(user) {

			if (user == '4'){
				alert("로그인 후 사용이 가능합니다.");
			}else if (user == '8'){
				alert("해당하는 회원이 없습니다.");
			}else{

				location.href='/profile/main/user/user_id/'+user;

			}
		}
	}); 
}


//음악채팅 바로가기
function go_musicchat(){
	location.href="/chatting/music_chatting";
}



// 팝업
$(document).ready(function() {
	var url = window.location.pathname;  
	var activePage = stripTrailingSlash(url,2);

	if(activePage == "/meeting" || activePage == "/chatting" || activePage == "/photo" || activePage == "/friend" || activePage == "/open_marry" || activePage == "/secret" || activePage == ""){
		
		// 3초뒤에 실행
		setTimeout(function(){
			$.get('/etc/popups/call_popup/'+Math.random(), function(data){
				if(data != "" && data.substr(0,20) != "<div id='codeigniter"){
					modal.open({content: data,width : 280});
				}
			});	
		},1000);		
	}
});


//나의 채팅 목록 보기
function chat_list_show_all(){
	location.href="/profile/my_chat/chatting_list";
}


//랭킹정보 레이어 팝업 PC용
function rank_info(){
	$.get('/profile/rank/rank_info/'+Math.random(), function(data){
		modal.open({content: data,width : 520});
	});
}



// 프리로드 이미지
var preloadImage = function(images) {
        if (document.images) {
                var i = 0;
                var imageArray = new Array();
                imageArray = images.split(',');
                var imageObj = new Image();
                for(i=0; i<=imageArray.length-1; i++) {
                        imageObj.src=imageArray[i];
                }
        }
};

preloadImage("/images/meeting/light_ic_001.png,/images/meeting/light_ic_002.png,/images/meeting/light_ic_003.png,/images/meeting/light_ic_004.png"); // 미리 불러올 이미지 경로를 ,를 붙인 문자열로 작성하여 함수 호출


var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10) { dd='0'+dd } 
if(mm<10) { mm='0'+mm } 
var today = yyyy+'-' + mm+'-'+dd;



// 포인트단위 변경 CLOSE 버튼
function point_close(){

	if($("input:checkbox[id='today_show_none']").is(":checked") == true){
		setCookie('point_change', today, 60*60*24 );
	}

	$(".changep_pop_bg").css("display","none");
}

// 포인트단위 변경 체크박스 클릭
function today_show_nope(){
		setCookie('point_change', today, 60*60*24 );
		$(".changep_pop_bg").css("display","none");
}


// 포인트단위 변경 팝업
/*
$(document).ready(function(){
	
	//쿠키값이 없을때만 띄우기
	if(getCookie('point_change') == false){

		$.ajax({
			type: "post",
			url: "/etc/change_point_pop/pop_open",
			data: { },
			cache: false,
			async: false,
			success: function(data) {
				if(data){
					$('body').append(data);
				}
			}
		});	

	}	

});
*/



//여성회원 전용 상단 탑 팝업 닫기(오늘하루 안보이기)
function call_woman_pop(){
	
	if(confirm("오늘하루 그만 보시겠습니까?") == true){
		setCookie('woman_pop', today, 60*60*24 );
		$("#woman_pop").css("display", "none");
	}
	
}