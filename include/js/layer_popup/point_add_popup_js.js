$(document).ready(function(){

	$("#modal").css("position","absolute");

});

//결제방법과 상품코드 받아와서 결제페이지 호출
function purchase_product(mode){
	if(mode == "mu"){
		//무통장입금의 경우
		mu_account_deposit(mode, $("input[name='point_Lv']:checked").val());
	}else{
		//나머지 결제
		do_payment(mode, $("input[name='point_Lv']:checked").val());
	}
	
}

//enter키 처리
function onkeyup_enter(){
	 if(event.keyCode == 13){
          deposit_btn();
     }
}

//무통장입금 결제하기버튼 클릭
function deposit_btn(){

	if($("#m_name").val() == ""){ alert("입금자명을 입력하세요.");	$("#m_name").focus(); return;}
	if($("#m_hp1").val() == ""){ alert("휴대전화번호를 입력하세요.");	$("#m_hp1").focus(); return;}
	if($("#m_hp2").val() == ""){ alert("휴대전화번호를 입력하세요.");	$("#m_hp2").focus(); return;}
	if($("#m_hp3").val() == ""){ alert("휴대전화번호를 입력하세요.");	$("#m_hp3").focus(); return;}

	$.ajax({
		
		type : "post",
		url : "/profile/point/mu_deposit_btn_event",
		data : {
			"code"		: encodeURIComponent($("#m_product_code").val()),
			"m_name"	: encodeURIComponent($("#m_name").val()),
			"m_hp1"		: encodeURIComponent($("#m_hp1").val()),
			"m_hp2"		: encodeURIComponent($("#m_hp2").val()),
			"m_hp3"		: encodeURIComponent($("#m_hp3").val())
		},
		cache : false,
		async : false,
		success : function(result){		
			if(result == "0"){
				alert("실패하였습니다. ("+result+") ");
				console.log(result);
			}else{
				alert("입금정보가 발송되었습니다.");
				mu_account_deposit_result(result);
			}
		},
		error : function(result){
			alert("실패하였습니다. ("+result+") ");
			console.log(result);
		}

	});

}