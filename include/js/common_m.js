/**
 * 모바일모드일때만 쓰는 각종 공용 스트립트
 */

//상단메뉴 클래스 자동링크 (top_sub_menu 클래스 자동적용)
$( document ).ready(function() {
	$(function(){
	  var url = window.location.pathname;  
	  var activePage = stripTrailingSlash(url,0);

	  $('.top_sub_menu').each(function(){ 
		var currentPage = stripTrailingSlash($(this).attr('href'),0);
		if (activePage == currentPage) {
		  $(this).parent().addClass('bg_e15148'); 
		}

	  });


	});
	
	//카카오
	Kakao.init('0acd65db510aa8e434c64976cd4ec74e');

	//상단 고정
	$("#menu_bar").css("height", $("#top_menu").height());

});

//카카오톡 공유하기
function send_kakao(val){

	if(val == ""){
		val = "1";
	}

	var container = "#kakao-link-btn"+val;

	Kakao.Link.createTalkLinkButton({
		container: container,
		
		image: {
			src: 'http://www.joyhunting.net/images/etc/joyhunting_share.jpg',
			width: '300',
			height: '200'
		},

		label: '[조이헌팅 채팅 & 미팅]\n조이헌팅에서 단둘이 비밀톡챗하고 인연을 만들어 보아요^^',

		webButton: {
			text: '조이헌팅으로 이동하기',
			url: 'http://m.joyhunting.com' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		}
    });

}

//랭킹정보 레이어 팝업 모바일용
function rank_info(){

	// 팝업 위아래 간격 안맞아서
	var set_margin = ($(window).height()-447)/2;

	$.get('/profile/rank/rank_info/'+Math.random(), function(data){
		modal.open({content: data,width : 320,top:set_margin});
	});

}



// 팝업
$(document).ready(function() {
	var url = window.location.pathname;

	if(url == "/" || url == "/m/online_mb" || url == "/chatting/town_find/order_login"){

		// 3초뒤에 실행
		setTimeout(function(){
			$.get('/etc/popups/call_popup/'+Math.random(), function(data){
				if(data != "" && data.substr(0,20) != "<div id='codeigniter"){
					modal.open({content: data,width : 280, top:15});
				}
			});	
		},1000);

	}
});

//조이매거진 view 페이지로 이동
function joy_magazine_view(idx){
	if(idx == ""){ alert("잘못된 접근입니다."); return; }
	$(location).attr("href", "/service_center/joy_magazine/magazine_view/idx/"+idx);
}

function joy_magazine_view_login(idx){
	$(location).attr("href", "/auth/register");
}



//회원 프로필 view 페이지로 이동
function member_profile_view(user_id){
	
	//if(user_id == ""){ alert("잘못된 접근입니다."); return; }
	//$(location).attr("href", "/profile/main/user/user_id/"+user_id);
	$(location).attr("href", "/auth/register");
}

//프로필 보기에서 비밀톡챗 신청하기
function member_profile_chatting_request(session, user_id){
	if(session == ""){ alert("로그인이 필요한 메뉴입니다."); $(location).attr("href", "/auth/login"); }else{ chat_request(user_id); }
}

//모바일 리사이즈 맵핑
function imageMap(rimg,rwidth,x1,y1,x2,y2,mapid){

	var rxsize = $("#"+rimg).width();

	var xp1 = rxsize / rwidth * x1;
	var yp1 = rxsize / rwidth * y1;
	var xp2 = rxsize / rwidth * x2;
	var yp2 = rxsize / rwidth * y2;

	$("#"+mapid).attr("coords",xp1+","+yp1+ ","+xp2+","+yp2);

}