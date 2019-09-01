

/* 포인트/충전 탭메뉴 */
$(document).ready(function(){
	$("#tab_menu1").click(function() {	$(location).attr('href',"/profile/point/point_list");	});
	$("#tab_menu2").click(function() {	$(location).attr('href',"/profile/point/charge_list");	});
	$("#tab_menu3").click(function(){ point_charg_flg($(this).attr('flg')); });


});


//월, 일 문자열길이 1일 경우 앞에 0붙이기
function date_length(str){

	if(str.length == "1"){
		return "0"+str;
	}else{
		return str;
	}
}

//일정기간 조회 버튼 클릭시
function date_search_btn(v, tabmenu){
	
	
	var before_date = new Date();
	var after_date = new Date();

	before_date.setDate(before_date.getDate()-v);	//조건값을 뺀 날짜로 다시 셋팅

	var b_year = before_date.getFullYear();
	var b_month = (before_date.getMonth()+1)>9 ? ''+(before_date.getMonth()+1) : '0'+(before_date.getMonth()+1);
	var b_day = before_date.getDate()>9 ? ''+before_date.getDate() : '0'+before_date.getDate();

	var a_year = after_date.getFullYear();
	var a_month = (after_date.getMonth()+1)>9 ? ''+(after_date.getMonth()+1) : '0'+(after_date.getMonth()+1);
	var a_day = after_date.getDate()>9 ? ''+after_date.getDate() : '0'+after_date.getDate();
	
	var b_date = b_year +''+ b_month +''+ b_day;		//조회기간설정 before_date	
	var a_date = a_year +''+ a_month +''+ a_day;		//조회기간설정 after_date

	for(i=1; i<5; i++){

		if($("#btn_date"+i).attr("on_value") == v){
			var mode = i;
			$("#btn_date"+i).removeClass("term_chos_no").addClass("term_chos");
		}else{
			$("#btn_date"+i).removeClass("term_chos").addClass("term_chos_no");
		}
	}
	
	if(tabmenu == "1"){
		location.href = "/profile/point/point_list/before_date/"+b_date+"/after_date/"+a_date+"/i/"+mode;
	}else{
		location.href = "/profile/point/charge_list/before_date/"+b_date+"/after_date/"+a_date+"/i/"+mode;
	}
	

}

//조회버튼 클릭시
function point_btn_search(tabmenu){

	var b_date = "", a_date = "";

	b_date = $("#before_year").val()+date_length($("#before_month").val())+date_length($("#before_day").val());		//앞 조회기간
	a_date = $("#after_year").val()+date_length($("#after_month").val())+date_length($("#after_day").val());		//뒤 조회기간
		
	if(tabmenu == "1"){
		location.href = "/profile/point/point_list/before_date/"+b_date+"/after_date/"+a_date;
	}else{
		location.href = "/profile/point/charge_list/before_date/"+b_date+"/after_date/"+a_date;
	}

}

//포인트충전하기 버튼 클릭시 이벤트
function point_charg_flg(flg){
	if(flg == "F"){
		$(location).attr('href',"/profile/point/point_charge");	
	}else{
		point_add();
	}
}


//정회원 결제 상품 증가로 인한 함수 수정
//결제함수 호출 함수
//mode = 결제 방법 코드 휴대폰 결제(hp),카드결제(card),실시간계좌이체(account),일반전화 받기(pb),일반전화 걸기(tp),가상계좌(bk),무통장입금(mu)
//function call_payment_fnc(mode){
//	
//	if($("input[name='pay_chk']").is(":checked") == false){
//		alert("결제 상품을 선택하세요.");
//		return;
//	}else{
//		var v_product_code = $("input[name='pay_chk']:checked").val();
//	}
//	
//}