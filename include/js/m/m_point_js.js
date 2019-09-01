$(document).ready(function(){
	
});


//결제페이지 이동
function payment_mobile(gubn){
	
	var code = "";

	if($("input[name='point_lv']:checked").length == "0"){
		alert("하나의 상품을 선택하세요.");
		return;
	}
	
	code = $("input[name='point_lv']:checked").val();
	

	if(gubn == "mu"){
		mu_account_deposit(gubn, code);
	}else{

		//$("#v_loading").css("display", "block");
		//$("#v_loading").css("top", 4*($(window).height()/10));

		$(location).attr("href", "/etc/payment_start/pay_start/mode/"+gubn+"/code/"+code);
	}
	
}


