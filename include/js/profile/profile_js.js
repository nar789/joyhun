
//사진등록 레이어팝업 띄우기
function pic_upload(num){

	if(is_mobile == true){
		var pop_width = 9*($(window).width()/10);
	}else{
		var pop_width = "460";
	}

	$.get('/profile/main/upload_pic_pop/num/'+num+'/'+Math.random(), function(data){
		modal.open({content: data, width : pop_width});
	});
}

//대표사진인것 삭제
function pic_delete(num){
	if(confirm("사진을 삭제하겠습니까?")){
		$.get('/profile/main/pic_remove/num/'+num, function(data){
			if(data == true){
				alert("삭제되었습니다.");
			}else{
				alert("삭제에 실패하였습니다.");
			}	
				location.reload();
		});
	}
}

//대표사진인것 삭제
function my_pic_delete(num){
	if(confirm("재등록시 다시 인증받으셔야 합니다. 삭제하겠습니까?")){
		$.get('/profile/main/pic_remove/num/'+num, function(data){
			if(data == true){
				alert("삭제되었습니다.");
			}else{
				alert("삭제에 실패하였습니다.");
			}	
				location.reload();			
		});
	}
}

function set_my_pic(num){
		$.get('/profile/main/set_my_pic/num/'+num, function(data){
			if(data == true){
				alert("대표사진으로 변경되었습니다.");
			}else{
				alert("오류가 발생하였습니다.");
			}	

				location.reload();		
		});
}



//휴대폰인증하시오 팝업
function mobile_chk_pop(){
	$.get('/profile/main/mobile_chk_pop/'+Math.random(), function(data){
		modal.open({content: data,width : 360});
	});
}