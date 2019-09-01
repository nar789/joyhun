

function met_menu_over(num){

	$("#sub_met_menu_over1").removeClass("over out"); 
	$("#sub_met_menu_over2").removeClass("over out"); 
	$("#sub_met_menu_over3").removeClass("over out"); 
	$("#sub_met_menu_over4").removeClass("over out"); 

	if (num == '1') {
		$("#sub_met_menu_over1").addClass("over"); 
		$("#sub_met_menu_over2").addClass("out"); 
		$("#sub_met_menu_over3").addClass("out"); 
		$("#sub_met_menu_over4").addClass("out"); 
	}else if (num == '2'){
		$("#sub_met_menu_over1").addClass("out"); 
		$("#sub_met_menu_over2").addClass("over"); 
		$("#sub_met_menu_over3").addClass("out"); 
		$("#sub_met_menu_over4").addClass("out"); 
	}else if (num == '3'){
		$("#sub_met_menu_over1").addClass("out"); 
		$("#sub_met_menu_over2").addClass("out"); 
		$("#sub_met_menu_over3").addClass("over"); 
		$("#sub_met_menu_over4").addClass("out"); 
	}else if (num == '4'){
		$("#sub_met_menu_over1").addClass("out"); 
		$("#sub_met_menu_over2").addClass("out"); 
		$("#sub_met_menu_over3").addClass("out"); 
		$("#sub_met_menu_over4").addClass("over"); 
	}

}

//메인 > 문자팅 OPEN
function sms_main_go(){

	location.href="/meeting/smsting/all/nick1/"+$("#sms_go_0").text()+"/nick2/"+$("#sms_go_1").text()+"/nick3/"+$("#sms_go_2").text()+""

}




$(document).ready(function(e) {

	/*		##	meeting main icon_btn_bababa ie <> chrome	##		*/

	var agent = navigator.userAgent;

	if (agent.indexOf('MSIE') > 0 || agent.indexOf('Trident') > 0) {
	}else{

		$(".met_main_love_ic").addClass("margin_left_4"); 

	}
	/*		##	meeting main icon_btn_bababa ie <> chrome end	##		*/

	
	$(".area_member").click(function(){

			$("#area_title").hide();
			$("#area_cnt_text").show();

		for(i=1; i<16; i++){

			if($(this).attr("id") == "region"+i){
				$("#region"+i).removeClass("area_member");
				$("#region"+i).addClass("area_member_on");

				// 한번도 ajax보낸적 없으면
				if ($("#region"+i).attr('area_cnt') == undefined || $("#region"+i).attr('area_cnt') == ''){

					$.ajax({
						type: "post",
						url: "/meeting/main/area_meeting_mb",
						data: {
							search : $("#region"+i).text()
						},
						cache: false,
						async: false,
						success: function(data) {


							$("#meet_area_cnt").text(Number(data).toLocaleString('en'));
							$("#region"+i).attr('area_cnt',Number(data).toLocaleString('en'));
							
						}
					}); 

				// 보낸적있으면 ajax안쓰고 속성값가져와서 뿌림
				}else{
					$("#meet_area_cnt").text($("#region"+i).attr('area_cnt'));
				}

			}else{
				$("#region"+i).removeClass("area_member_on");
				$("#region"+i).addClass("area_member");				
			}
		}

	});

});










/*	img roll */

	var mdata = [];
	mdata["0"] = [];
	mdata["1"] = [];
	mdata["2"] = [];
	mdata["3"] = [];
	//mdata["0"] = ["영화보기","술친구","스포츠","드라이브"];

	var objTimer = 0;
	var objTimer2 = 0;
	var Timer2 = 0;
	var eventCheck = false;
	var eventCheck2 = false;
	var cnt = 0;
	var now_cate = 0;

function timerstart(){
	Timer2 = window.setInterval(rotate, 5000);
	//alert(Timer2);
}

function rotate(){

	if(cnt == 6){cnt = 0;}

	$('#gal1').flipgallery(1,mdata[now_cate][cnt][0]);
	$('#gal2').flipgallery2(1,mdata[now_cate][cnt+1][0]);

	insert_data(0,500);

}

function insert_data(cate,time){
	

	window.setTimeout(function() {

		document.getElementById("met_nick").innerHTML = mdata[now_cate][cnt][1];
		document.getElementById("met_age").innerHTML = mdata[now_cate][cnt][2];
		document.getElementById("met_like").innerHTML = mdata[now_cate][cnt][3];
		document.getElementById("met_area").innerHTML = mdata[now_cate][cnt][4];
		document.getElementById("met_day").innerHTML = mdata[now_cate][cnt][5];
		document.getElementById("met_title").innerHTML = mdata[now_cate][cnt][6];
		$('#met_datego').attr('onClick',"b_request('"+mdata[now_cate][cnt][7]+"')" )
		$('#met_love').attr('onClick',"jjim_request('"+mdata[now_cate][cnt][8]+"')" )
		$('#gal1').attr('onClick',"view_profile('"+mdata[now_cate][cnt][8]+"')" )

		sub_cnt = cnt + 1;

		document.getElementById("met_nick2").innerHTML = mdata[now_cate][sub_cnt][1];
		document.getElementById("met_age2").innerHTML = mdata[now_cate][sub_cnt][2];
		document.getElementById("met_like2").innerHTML = mdata[now_cate][sub_cnt][3];
		document.getElementById("met_area2").innerHTML = mdata[now_cate][sub_cnt][4];
		document.getElementById("met_day2").innerHTML = mdata[now_cate][sub_cnt][5];
		document.getElementById("met_title2").innerHTML = mdata[now_cate][sub_cnt][6];
		$('#met_datego2').attr('onClick',"b_request('"+mdata[now_cate][sub_cnt][7]+"')" )
		$('#met_love2').attr('onClick',"jjim_request('"+mdata[now_cate][sub_cnt][8]+"')" )
		$('#gal2').attr('onClick',"view_profile('"+mdata[now_cate][sub_cnt][8]+"')" )

		cnt = cnt + 2;

	}, time);


}


function start_setting(cate){
	cnt = 0;
	now_cate = cate;

	document.getElementById("gal1").innerHTML = mdata[now_cate][0][0];
	document.getElementById("gal2").innerHTML = mdata[now_cate][1][0];
	insert_data(0,0);
}


	(function($) {
		$.fn.flipgallery = function(obj,src) {

			var choose = 1;
			var duration = 250;
			var images = $(this).children();

			objTimer = window.setInterval(flip, 500);

			function flip() {
				if (eventCheck == false)
				{
					var numbers = new Array();

					numbers.push(0);
					$(numbers).each(function(index, value) {


					eventCheck = true;
						var width = $(images[this]).width();
						var height = $(images[this]).height();
						var margin = $(images[this]).width() / 2;

						$(images[value]).stop().animate({width: '0px', height: '' + height + 'px', marginLeft: '' + margin + 'px', opacity: '0.5'}, {duration: duration});
						window.setTimeout(function() {

							$(images[value]).stop().animate({width: width, height: '' + height + 'px', marginLeft: '0px', opacity: '1'}, {duration: duration});
							document.getElementById("gal1").innerHTML = src;
						}, duration);
						
						
					});
					eventCheck = false;
					clearInterval(objTimer);
				}

			}

		};


	})(jQuery);


	(function($) {
		$.fn.flipgallery2 = function(obj,src) {

			var choose = 1;
			var duration = 250;
			var images = $(this).children();

			objTimer2 = window.setInterval(flip, 500);

			function flip() {
				if (eventCheck2 == false)
				{
					var numbers = new Array();

					numbers.push(0);
					$(numbers).each(function(index, value) {


					eventCheck2 = true;
						var width = $(images[this]).width();
						var height = $(images[this]).height();
						var margin = $(images[this]).width() / 2;

						$(images[value]).stop().animate({width: '0px', height: '' + height + 'px', marginLeft: '' + margin + 'px', opacity: '0.5'}, {duration: duration});
						window.setTimeout(function() {

							$(images[value]).stop().animate({width: width, height: '' + height + 'px', marginLeft: '0px', opacity: '1'}, {duration: duration});
							document.getElementById("gal2").innerHTML = src;
						}, duration);
						
						
					});
					eventCheck2 = false;
					clearInterval(objTimer2);
				}

			}

		};


	})(jQuery);



$(document).ready(function() {

	timerstart();
	start_setting(0);
});

/* img roll end*/


