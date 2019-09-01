//앤등록하기 게시물 작성
function form_check() 
{

	if($("#m_dbcontent").val() == "")
	{
		alert("내용을 입력해 주십시오");
		$("#m_dbcontent").focus();
	}
	else
	{
		var result = "";

		var m_dbcontent = $("#m_dbcontent").val();

		$.ajax({
			type: "post",
			url: "/friend/anne_add/reg_anne",
			data: {
				"m_dbcontent": encodeURIComponent(m_dbcontent),
			},
			cache: false,
			async: false,
			success: function(result) {
				if (result == "909"){
					alert('정회원 가입후 사용이 가능합니다.');
					location.href='/profile/point/point_charge';
				} else if ( result == "1" ){
					alert("정상적으로 등록되었습니다");
					location.href = "/friend/anne_add/make_anne/sex";
				} else if( result == "3" ) {
					alert("하루에 1번만 작성가능합니다.");
				} else {
					alert("게시물 등록에 실패하였습니다. (" + result + ")");
				}
			},
			error : function(result){
				alert("게시물 등록에 실패하였습니다. (" + result + ")");
			}
		}); 


	}

}

// 성별 Tab 기능
function search_sex(str,sex)
{
	location.href="/friend/anne_add/"+ str + "/sex/"+ sex + "/";
}

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