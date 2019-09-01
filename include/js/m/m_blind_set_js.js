
/* 좋아요관리함 탭메뉴 */
$(document).ready(function(){
	$("#tab_my_menu1").click(function() {	$(location).attr('href',"/blindmeet/blind/recv_like");	});
	$("#tab_my_menu2").click(function() {	$(location).attr('href',"/blindmeet/blind/send_like");	});
	$("#tab_my_menu3").click(function() {	$(location).attr('href',"/blindmeet/blind/together_like");	});
});


$(function(){

		$('.m_good_thum img').each(function(){ 

			$(this).hide();

			if (this.naturalWidth > this.naturalHeight){		//썸네일의 가로값이 더 길면 가로기준
				$(this).css('height','auto');
			}else if (this.naturalHeight > this.naturalWidth){	//썸네일의 세로값이 더 길면 세로기준
				$(this).css('height','100%');
			}

			$(this).show();

		});

		
		$('.toget_img_box img').each(function(){ 

			$(this).hide();

			console.log(this.naturalWidth+","+this.naturalHeight);


			if (this.naturalWidth > this.naturalHeight){		//썸네일의 가로값이 더 길면 가로기준
				$(this).css('height','auto');
			}else if (this.naturalHeight > this.naturalWidth){	//썸네일의 세로값이 더 길면 세로기준
				$(this).css('height','100%');
			}

			$(this).show();

		});
});