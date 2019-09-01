var isIE = false;
var req01_AJAX;
var READY_STATE_UNINITIALIZED = 0;
var READY_STATE_LOADING       = 1;
var READY_STATE_LOADED        = 2;
var READY_STATE_INTERACTIVE   = 3;
var READY_STATE_COMPLETE      = 4;
var PayUrl = "";

function displayElement( targetObj, targetText, targetColor ){
	
	if ( targetObj.childNodes.length > 0 ){
	  targetObj.replaceChild( document.createTextNode( targetText ), targetObj.childNodes[ 0 ] );
	}else{
	  targetObj.appendChild( document.createTextNode( targetText ) );
	}
	targetObj.style.color = targetColor;
}

function clearElement( targetObj ){
	for ( var i = ( targetObj.childNodes.length - 1 ); i >= 0; i-- ){
	  targetObj.removeChild( targetObj.childNodes[ i ] );
	}
}



//추가
var controlCss = "css/style_mobile.css";
var isMobile = {
	Android: function() {
	  return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function() {
	  return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function() {
	  return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function() {
	  return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function() {
	  return navigator.userAgent.match(/IEMobile/i);
	},
	any: function() {
	  return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};

if( isMobile.any() ){
	document.getElementById("cssLink").setAttribute("href", controlCss);
}
    



/* kcp web 결제창 호츨 (변경불가) */
function call_pay_form(){

	var v_frm = document.order_info;
	
	$("#sample_wrap").css("display", "none");
	$("#layer_all").css("display", "block");

	v_frm.target = "frm_all";
	v_frm.action = PayUrl;

	if ($("#Ret_URL").val() == ""){
	  /* Ret_URL값은 현 페이지의 URL 입니다. */
	  alert("연동시 Ret_URL을 반드시 설정하셔야 됩니다.");
	  return false;
	}
	else{
	  v_frm.submit();
	}

}

/* kcp 통신을 통해 받은 암호화 정보 체크 후 결제 요청 (변경불가) */
function chk_pay(){
	self.name = "tar_opener";
	var pay_form = document.pay_form;

	if (pay_form.res_cd.value == "3001" ){
	  alert("사용자가 취소하였습니다.");
	  pay_form.res_cd.value = "";
	}else if (pay_form.res_cd.value == "3000" ){
	  alert("30만원 이상 결제를 할 수 없습니다.");
	  pay_form.res_cd.value = "";
	}

	$("#sample_wrap").css("display", "block");
	$("#layer_all").css("display", "none");

	if (pay_form.enc_info.value){
		pay_form.submit();
	}
}



//kcp ajax jquery
//kcp ajax javascript 소스 ->  jquery ajax 로 변경
function kcp_AJAX(){
	
	$.ajax({

		type : "post",
		url : "/etc/kcp_payment/kcp_order_approval",
		data : {
			"site_cd"		: $("#site_cd").val(),
			"ordr_idxx"		: $("#ordr_idxx").val(),
			"good_mny"		: $("#good_mny").val(),
			"pay_method"	: $("#pay_method").val(),
			"escw_used"		: $("#escw_used").val(),
			"good_name"		: $("#good_name").val(),
			"Ret_URL"		: $("#Ret_URL").val()
		},
		cache : false,
		async : false,
//		beforeSend : function(){			
//			$("#kcp_loading").css("display", "block");
//		},
//		complete : function(){
//			$("#kcp_loading").css("display", "none");
//		},
		success : function(result){
			
			var txt = result.split(",");

			if(txt[0] == "0000"){
				//결제등록성공
				$("#approval").val(txt[1].replace(/^\s*/,'').replace(/\s*$/,''));
				PayUrl = txt[2].replace(/^\s*/,'').replace(/\s*$/,'');
				call_pay_form();
			}else{
				//결제실패
				alert("결제등록에 실패했습니다.\n잠시후 다시 시도해 주시기 바랍니다.");
				$(location).attr("href", "/profile/point/point_list");
			}
		},
		error : function(result){
			alert("실패");
		}

	});

}