/* 짝/애정촌 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/meeting/jjack/jjack_list");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/meeting/jjack/mypage_recv");	});
	//$("#tab_menu2").click(function() {	$(location).attr('href',"/meeting/jjack/my_propse_recv");	});
});

/* 내 프로포즈관리 탭메뉴 */
$(document).ready(function(){
	$("#tab_my_menu1").click(function() {	$(location).attr('href',"/meeting/jjack/mypage_recv");	});
	$("#tab_my_menu2").click(function() {	$(location).attr('href',"/meeting/jjack/mypage_send");	});
	//$("#tab_my_menu1").click(function() {	$(location).attr('href',"/meeting/jjack/my_propse_recv");	});
	//$("#tab_my_menu2").click(function() {	$(location).attr('href',"/meeting/jjack/my_propse_send");	});
});


// 이미지 없는사람은 대표사진등록으로 보이게
$(document).ready(function() {
	if($("#noimg_check div").hasClass("girl_icon") === true || $("#noimg_check div").hasClass("man_icon") === true) {
		$('.top_textarea_img div.girl_icon').css('display','none');
		$('.top_textarea_img div.man_icon').css('display','none');
		$('#noimg_check').html('<a href="#" onclick="go_profile();"><span>대표사진 등록</span></a>');
	}
});

function go_profile(){

	location.href='/profile/main/user';

}



/* 애정촌 등록하기 클릭시 상단으로 이동 */
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

//애정촌 성별검색 기능
function search_sex(url, sex){
	
	location.href="/meeting/jjack/"+url+"/sex/"+ sex + "/";
}


/* 애정촌 등록하기 */
function reg_mate(){
	
	if($("#m_cmt").val() == ""){
		alert("애정촌 메세지를 입력하세요.");
		$("#m_cmt").focus();
		return;
	}
	else{
		
		if(confirm("등록하시겠습니까?") == true){
			
			$.ajax({
					
				type : "post",
				url : "/meeting/jjack/reg_mate",
				data : {
					"m_cmt"			: encodeURIComponent($("#m_cmt").val())		//애정촌 메세지
				},
				cache : false,
				async : false,
				success : function(result){

					if (result == '909'){
						alert("정회원 가입후 사용이 가능합니다.");
						location.href='/profile/point/point_charge';
					}else if ( result == true ){
						alert("등록되었습니다.");
						location.href="/meeting/jjack/jjack_list/sex/";
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
}

//프로포즈 보내기 레이어 팝업
function b_request(idx){
	$.get('/meeting/jjack/request_popup/m_idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 280});
	});
}

//프로포즈 보내기 버튼 submit
function p_submit(m_idx, m_userid){

	if($("#my_msg").val() == ""){ alert("신청메세지를 입력하세요."); $("#my_msg").focus(); return;};
	
	if(confirm("짝대기를 보내시겠습니까?") == true){
		
		$.ajax({

			type : "post",
			url : "/meeting/jjack/propose_sumit",
			data : {
				"p_idx"				: encodeURIComponent(m_idx),
				"p_user_id"			: encodeURIComponent(m_userid),
				"m_msg"				: encodeURIComponent($("#my_msg").val()),
				"gubn"				: encodeURIComponent($("input:radio[name='wanna_age']:checked").val())
			},
			cache : false,
			async : false,
			success : function(result){

				if ( result == true ){
					alert("짝대기를 보냈습니다.");
					location.href = '/meeting/jjack/jjack_list';
				}else if(result == 'error'){
					alert("동성에게 짝대기 보내기는 불가능합니다.");
					modal.close(); 
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

//프로포즈 댓글보기
function sub_view(p_idx, p_user_id, mode){


	if($("#sub_view"+p_idx).css("display") == "none"){

		$("#jjack_arrow_"+p_idx).removeClass("comment_arrow");
		$("#jjack_arrow_"+p_idx).addClass("comment_arrow2");
		
		$.ajax({

			type : "post",
			url : "/meeting/jjack/sub_view",
			data : {
				"p_idx"			: encodeURIComponent(p_idx),
				"p_user_id"		: encodeURIComponent(p_user_id),
				"mode"			: encodeURIComponent(mode)
			},
			cache : false,
			async : false,
			success : function(result){

				if ( result != '' ){

					$("#sub_view"+p_idx).html(result);
					if(mode == "1"){
						$(".jjack_del_btn :button").css("display", "none");		//받은프로포즈 댓글 삭제버튼 숨기기
					}
					$("#sub_view"+p_idx).css("display", "block");

				}else{
					alert("실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){

				alert("실패하였습니다. (" + result + ")");
			}
		});

	} else{

		$("#sub_view"+p_idx).css("display", "none");
		$("#jjack_arrow_"+p_idx).removeClass("comment_arrow2");
		$("#jjack_arrow_"+p_idx).addClass("comment_arrow");
	}
	
}

//개인이 쓴 댓글 삭제버튼
function btn_del(idx){
	
	if(confirm("삭제하시겠습니까?") ==  true){
		
		$.ajax({

			type : "post",
			url : "/meeting/jjack/user_rpy_del",
			data : {
				"idx" : encodeURIComponent(idx)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if ( result == true ){
					alert("삭제되었습니다.");
				}else{
					alert("실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("실패하였습니다. (" + result + ")");
			}
		});

	};

}


$(document).ready(function(){
	
	//댓글펼치기(기본)
	$(".comment_rep_box").each(function(){
		sub_view($(this).attr('p_idx'), $(this).attr('p_user_id'), $(this).attr('mode'));
	});

});

/* go_to_top scroll end */